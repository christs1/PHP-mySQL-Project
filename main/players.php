<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once '../includes/session_check.php';

// Initialize permission flags
$is_league_manager = (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1);
$is_coach = (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2);
$is_statistician = (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3);
$is_player = (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 4);

// For coaches, get their team_id from users table
$coach_team_id = null;
if ($is_coach && isset($_SESSION['user_id'])) {
    $coach_query = "SELECT team_id FROM users WHERE user_id = ? AND role_id = 2";
    $stmt = $pdo->prepare($coach_query);
    $stmt->execute([$_SESSION['user_id']]);
    $coach = $stmt->fetch();
    $coach_team_id = $coach ? $coach['team_id'] : null;
}

// For players, get their player_id
$user_player_id = null;
if ($is_player && isset($_SESSION['user_id'])) {
    $player_query = "SELECT player_id FROM players WHERE user_id = ?";
    $stmt = $pdo->prepare($player_query);
    $stmt->execute([$_SESSION['user_id']]);
    $player = $stmt->fetch();
    $user_player_id = $player ? $player['player_id'] : null;
}

// Handle player update with permission checks
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_player_id'])) {
    $can_edit = false;
    $player_id = $_POST['edit_player_id'];
    
    if ($is_league_manager) {
        $can_edit = true;
    } elseif ($is_coach) {
        // Check if player belongs to coach's team
        $check_query = "SELECT 1 FROM players WHERE player_id = ? AND team_id = ?";
        $stmt = $pdo->prepare($check_query);
        $stmt->execute([$player_id, $coach_team_id]);
        $can_edit = $stmt->fetchColumn() ? true : false;
    } elseif ($is_player) {
        $can_edit = ($player_id == $user_player_id);
    }

    if ($can_edit) {
        $first_name = $_POST['edit_first_name'];
        $last_name = $_POST['edit_last_name'];
        $team_id = !empty($_POST['edit_team_id']) ? $_POST['edit_team_id'] : null;
        $jersey_number = !empty($_POST['edit_jersey_number']) ? $_POST['edit_jersey_number'] : null;
        $position = $_POST['edit_position'];
        $height = $_POST['edit_height'];
        $weight = $_POST['edit_weight'];
        $date_of_birth = $_POST['edit_date_of_birth'];
        $status = $_POST['edit_status'];

        // For players, only allow updating certain fields
        if ($is_player) {
            $sql = "UPDATE players SET height = :height, weight = :weight WHERE player_id = :player_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':height' => $height,
                ':weight' => $weight,
                ':player_id' => $player_id
            ]);
        } else {
            $sql = "UPDATE players SET first_name = :first_name, last_name = :last_name, team_id = :team_id, 
                    jersey_number = :jersey_number, position = :position, height = :height, weight = :weight, 
                    date_of_birth = :date_of_birth, status = :status WHERE player_id = :player_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':first_name' => $first_name,
                ':last_name' => $last_name,
                ':team_id' => $team_id,
                ':jersey_number' => $jersey_number,
                ':position' => $position,
                ':height' => $height,
                ':weight' => $weight,
                ':date_of_birth' => $date_of_birth,
                ':status' => $status,
                ':player_id' => $player_id
            ]);
        }
    }
    header('Location: players.php');
    exit;
}

// Handle add player (league manager and coaches for their team)
if (($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_player'])) && 
    ($is_league_manager || ($is_coach && isset($_POST['add_team_id']) && $_POST['add_team_id'] == $coach_team_id))) {
    
    $first_name = $_POST['add_first_name'];
    $last_name = $_POST['add_last_name'];
    $team_id = !empty($_POST['add_team_id']) ? $_POST['add_team_id'] : null;
    
    // For coaches, force their team_id
    if ($is_coach) {
        $team_id = $coach_team_id;
    }
    
    $jersey_number = !empty($_POST['add_jersey_number']) ? $_POST['add_jersey_number'] : null;
    $position = $_POST['add_position'];
    $height = $_POST['add_height'];
    $weight = $_POST['add_weight'];
    $date_of_birth = $_POST['add_date_of_birth'];
    $status = $_POST['add_status'];

    // Insert into players only, user_id is NULL
    $playerStmt = $pdo->prepare("INSERT INTO players (user_id, first_name, last_name, team_id, jersey_number, position, height, weight, date_of_birth, status) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $playerStmt->execute([$first_name, $last_name, $team_id, $jersey_number, $position, $height, $weight, $date_of_birth, $status]);
    header('Location: players.php');
    exit;
}

// Handle player delete (league manager and coaches for their team)
if (isset($_POST['delete_player_id'])) {
    $player_id = $_POST['delete_player_id'];
    $can_delete = false;

    if ($is_league_manager) {
        $can_delete = true;
    } elseif ($is_coach && $coach_team_id) {
        // Check if player belongs to coach's team
        $check_query = "SELECT team_id FROM players WHERE player_id = ?";
        $stmt = $pdo->prepare($check_query);
        $stmt->execute([$player_id]);
        $player = $stmt->fetch();
        
        if ($player && $player['team_id'] == $coach_team_id) {
            $can_delete = true;
        }
    }

    if ($can_delete) {
        // First delete from player_statistics to maintain referential integrity
        $pdo->prepare("DELETE FROM player_statistics WHERE player_id = ?")->execute([$player_id]);
        $pdo->prepare("DELETE FROM players WHERE player_id = ?")->execute([$player_id]);
        $_SESSION['success_message'] = "Player deleted successfully.";
    } else {
        $_SESSION['error_message'] = "You do not have permission to delete this player.";
    }
    header('Location: players.php');
    exit;
}

// Fetch all teams for dropdown
$teams = $pdo->query("SELECT team_id, team_name FROM teams ORDER BY team_name ASC")->fetchAll();

// Fetch all players with team info and player name
$sql = "SELECT p.player_id, p.first_name, p.last_name, p.team_id, t.team_name, p.jersey_number, p.position, p.height, p.weight, p.date_of_birth, p.status FROM players p LEFT JOIN teams t ON p.team_id = t.team_id ORDER BY p.player_id ASC";
$stmt = $pdo->query($sql);
$players = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        NFL Players
    </title>
    <meta name="description" content="NFL Players">
    <?php
        include '../templates/partials/all_accounts/head_imports.php';
    ?>
</head>

<body class="mod-bg-1">
    <?php
        include '../templates/partials/load_theme.php';
    ?>
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <?php
                $active_page = 'players';
                include '../templates/partials/role_aside.php';
            ?>
            <div class="page-content-wrapper">
                <?php
                    include '../templates/partials/header.php';
                ?>
                <main id="js-page-content" role="main" class="page-content">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">NFL Dashboard</a></li>
                        <li class="breadcrumb-item active">Players</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span
                                class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-user'></i> Players
                            <small>
                                Manage player information and statistics.
                            </small>
                        </h1>
                    </div>
                    <!-- Your main content goes below here: -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-g">
                                <div class="card-header">
                                    <div class="card-title">Player Management</div>
                                    <div class="card-tools">
                                        <?php if ($is_league_manager || $is_coach): ?>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-player-modal">
                                            <i class="fal fa-plus"></i> Add Player
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="input-group input-group-lg shadow-1 rounded">
                                            <input type="text" class="form-control shadow-inset-2" id="players-table-filter" placeholder="Search players...">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button"><i class="fal fa-search mr-lg-2"></i><span class="hidden-md-down">Search</span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-hover table-striped w-100" id="players-table">
                                        <thead class="bg-primary-600">
                                            <tr>
                                                <th>Player ID</th>
                                                <th>Name</th>
                                                <th>Team</th>
                                                <th>Jersey #</th>
                                                <th>Position</th>
                                                <th>Height</th>
                                                <th>Weight</th>
                                                <th>Date of Birth</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($players as $player): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($player['player_id']) ?></td>
                                                <td><?= htmlspecialchars($player['first_name'] . ' ' . $player['last_name']) ?></td>
                                                <td><?= htmlspecialchars($player['team_name'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($player['jersey_number'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($player['position']) ?></td>
                                                <td><?= htmlspecialchars($player['height'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($player['weight'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($player['date_of_birth'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($player['status']) ?></td>
                                                <td>
                                                    <?php 
                                                    $can_edit = false;
                                                    $can_delete = false;
                                                    
                                                    if ($is_league_manager) {
                                                        $can_edit = true;
                                                        $can_delete = true;
                                                    } elseif ($is_coach && $coach_team_id == $player['team_id']) {
                                                        $can_edit = true;
                                                        $can_delete = true; // Allow coaches to delete players on their team
                                                    } elseif ($is_player && $user_player_id == $player['player_id']) {
                                                        $can_edit = true;
                                                    }

                                                    if ($can_edit): ?>
                                                        <button class="btn btn-sm btn-info edit-player-btn" 
                                                            data-player='<?= json_encode($player) ?>'
                                                            data-user-role="<?= $_SESSION['role_id'] ?>"
                                                            data-toggle="modal" data-target="#edit-player-modal">
                                                            <i class="fal fa-edit"></i>
                                                        </button>
                                                    <?php endif; ?>

                                                    <?php if ($can_delete): ?>
                                                        <form method="post" action="" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this player?');">
                                                            <input type="hidden" name="delete_player_id" value="<?= $player['player_id'] ?>">
                                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fal fa-trash-alt"></i></button>
                                                        </form>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Player Modal -->
                    <?php if ($is_league_manager || $is_coach): ?>
                    <div class="modal fade" id="add-player-modal" tabindex="-1" role="dialog" aria-labelledby="addPlayerModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="post" class="modal-content">
                                <input type="hidden" name="add_player" value="1">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addPlayerModalLabel">Add Player</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="add_first_name">First Name</label>
                                        <input type="text" class="form-control" name="add_first_name" id="add_first_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="add_last_name">Last Name</label>
                                        <input type="text" class="form-control" name="add_last_name" id="add_last_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="add_team_id">Team</label>
                                        <select class="form-control" name="add_team_id" id="add_team_id" <?= $is_coach ? 'disabled' : '' ?>>
                                            <option value="">-- None --</option>
                                            <?php foreach ($teams as $team): ?>
                                                <option value="<?= $team['team_id'] ?>" <?= $is_coach && $team['team_id'] == $coach_team_id ? 'selected' : '' ?>><?= htmlspecialchars($team['team_name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="add_jersey_number">Jersey Number</label>
                                        <input type="number" class="form-control" name="add_jersey_number" id="add_jersey_number">
                                    </div>
                                    <div class="form-group">
                                        <label for="add_position">Position</label>
                                        <input type="text" class="form-control" name="add_position" id="add_position" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="add_height">Height</label>
                                        <input type="text" class="form-control" name="add_height" id="add_height">
                                    </div>
                                    <div class="form-group">
                                        <label for="add_weight">Weight</label>
                                        <input type="number" step="0.01" class="form-control" name="add_weight" id="add_weight">
                                    </div>
                                    <div class="form-group">
                                        <label for="add_date_of_birth">Date of Birth</label>
                                        <input type="date" class="form-control" name="add_date_of_birth" id="add_date_of_birth">
                                    </div>
                                    <div class="form-group">
                                        <label for="add_status">Status</label>
                                        <select class="form-control" name="add_status" id="add_status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Injured">Injured</option>
                                            <option value="Suspended">Suspended</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Add Player</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Edit Player Modal -->
                    <div class="modal fade" id="edit-player-modal" tabindex="-1" role="dialog" aria-labelledby="editPlayerModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="post" class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPlayerModalLabel">Edit Player</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="edit_player_id" id="edit_player_id">
                                    <div class="form-group">
                                        <label for="edit_first_name">First Name</label>
                                        <input type="text" class="form-control" name="edit_first_name" id="edit_first_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_last_name">Last Name</label>
                                        <input type="text" class="form-control" name="edit_last_name" id="edit_last_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_team_id">Team</label>
                                        <select class="form-control" name="edit_team_id" id="edit_team_id">
                                            <option value="">-- None --</option>
                                            <?php foreach ($teams as $team): ?>
                                                <option value="<?= $team['team_id'] ?>"><?= htmlspecialchars($team['team_name']) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_jersey_number">Jersey Number</label>
                                        <input type="number" class="form-control" name="edit_jersey_number" id="edit_jersey_number">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_position">Position</label>
                                        <input type="text" class="form-control" name="edit_position" id="edit_position" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_height">Height</label>
                                        <input type="text" class="form-control" name="edit_height" id="edit_height">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_weight">Weight</label>
                                        <input type="number" step="0.01" class="form-control" name="edit_weight" id="edit_weight">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_date_of_birth">Date of Birth</label>
                                        <input type="date" class="form-control" name="edit_date_of_birth" id="edit_date_of_birth">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_status">Status</label>
                                        <select class="form-control" name="edit_status" id="edit_status">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                            <option value="Injured">Injured</option>
                                            <option value="Suspended">Suspended</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </main>
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                <?php
                    include '../templates/partials/footer.php';
                ?>
                <?php
                    include '../templates/partials/js_color_profile.php';
                ?>
            </div>
        </div>
    </div>
    <?php
        include '../templates/partials/all_accounts/js_imports.php';
    ?>
    <script>
    // Fill modal with player data on edit and handle field permissions
    $(document).on('click', '.edit-player-btn', function() {
        var player = $(this).data('player');
        var userRole = $(this).data('user-role');
        
        $('#edit_player_id').val(player.player_id);
        $('#edit_first_name').val(player.first_name);
        $('#edit_last_name').val(player.last_name);
        $('#edit_team_id').val(player.team_id);
        $('#edit_jersey_number').val(player.jersey_number);
        $('#edit_position').val(player.position);
        $('#edit_height').val(player.height);
        $('#edit_weight').val(player.weight);
        $('#edit_date_of_birth').val(player.date_of_birth);
        $('#edit_status').val(player.status);

        // Restrict fields based on user role
        if (userRole == 4) { // Player
            // Players can only edit height and weight
            $('#edit_first_name, #edit_last_name, #edit_team_id, #edit_jersey_number, #edit_position, #edit_date_of_birth, #edit_status').prop('disabled', true);
            $('#edit_height, #edit_weight').prop('disabled', false);
        } else if (userRole == 2) { // Coach
            // Coaches can edit all fields
            $('#edit_first_name, #edit_last_name, #edit_team_id, #edit_jersey_number, #edit_position, #edit_height, #edit_weight, #edit_date_of_birth, #edit_status').prop('disabled', false);
        }
    });

    // Table filter for players
    $('#players-table-filter').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#players-table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    </script>
</body>
</html>