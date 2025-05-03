<?php
session_start();
require_once __DIR__ . '/../config/db.php';

// Only allow league manager to add/edit/delete
$is_league_manager = (isset($_SESSION['role_name']) && $_SESSION['role_name'] === 'leaguemanager');

// Handle player update
if ($is_league_manager && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_player_id'])) {
    $player_id = $_POST['edit_player_id'];
    $first_name = $_POST['edit_first_name'];
    $last_name = $_POST['edit_last_name'];
    $team_id = !empty($_POST['edit_team_id']) ? $_POST['edit_team_id'] : null;
    $jersey_number = !empty($_POST['edit_jersey_number']) ? $_POST['edit_jersey_number'] : null;
    $position = $_POST['edit_position'];
    $height = $_POST['edit_height'];
    $weight = $_POST['edit_weight'];
    $date_of_birth = $_POST['edit_date_of_birth'];
    $status = $_POST['edit_status'];

    $sql = "UPDATE players SET first_name = :first_name, last_name = :last_name, team_id = :team_id, jersey_number = :jersey_number, position = :position, height = :height, weight = :weight, date_of_birth = :date_of_birth, status = :status WHERE player_id = :player_id";
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
    header('Location: players.php');
    exit;
}

// Handle player delete
if ($is_league_manager && isset($_POST['delete_player_id'])) {
    $player_id = $_POST['delete_player_id'];
    // Only delete from players table
    $pdo->prepare("DELETE FROM players WHERE player_id = ?")->execute([$player_id]);
    header('Location: players.php');
    exit;
}

// Handle add player
if ($is_league_manager && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_player'])) {
    $first_name = $_POST['add_first_name'];
    $last_name = $_POST['add_last_name'];
    $team_id = !empty($_POST['add_team_id']) ? $_POST['add_team_id'] : null;
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
                include '../templates/partials/leaguemanager/left_aside.php';
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
                                        <?php if ($is_league_manager): ?>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-player-modal">
                                            <i class="fal fa-plus"></i> Add Player
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover table-striped w-100">
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
                                                    <?php if ($is_league_manager): ?>
                                                    <button class="btn btn-sm btn-info edit-player-btn" 
                                                        data-player='<?= json_encode($player) ?>' 
                                                        data-toggle="modal" data-target="#edit-player-modal">
                                                        <i class="fal fa-edit"></i>
                                                    </button>
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
                    <?php if ($is_league_manager): ?>
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
                                        <select class="form-control" name="add_team_id" id="add_team_id">
                                            <option value="">-- None --</option>
                                            <?php foreach ($teams as $team): ?>
                                                <option value="<?= $team['team_id'] ?>"><?= htmlspecialchars($team['team_name']) ?></option>
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
    // Fill modal with player data on edit
    $(document).on('click', '.edit-player-btn', function() {
        var player = $(this).data('player');
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
    });
    </script>
</body>
</html> 