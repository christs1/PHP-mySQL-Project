<?php
session_start();
require_once __DIR__ . '/../config/db.php';

// Only allow league manager to add/edit/delete
$is_league_manager = (isset($_SESSION['role_name']) && $_SESSION['role_name'] === 'leaguemanager');

// Handle add team
if ($is_league_manager && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_team'])) {
    $team_name = $_POST['add_team_name'];
    $city = $_POST['add_city'];
    $division = $_POST['add_division'];
    $conference = $_POST['add_conference'];
    $head_coach_id = !empty($_POST['add_head_coach_id']) ? $_POST['add_head_coach_id'] : null;
    $stmt = $pdo->prepare("INSERT INTO teams (team_name, city, division, conference, head_coach_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$team_name, $city, $division, $conference, $head_coach_id]);
    header('Location: teams.php');
    exit;
}

// Handle edit team
if ($is_league_manager && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_team_id'])) {
    $team_id = $_POST['edit_team_id'];
    $team_name = $_POST['edit_team_name'];
    $city = $_POST['edit_city'];
    $division = $_POST['edit_division'];
    $conference = $_POST['edit_conference'];
    $head_coach_id = !empty($_POST['edit_head_coach_id']) ? $_POST['edit_head_coach_id'] : null;
    $stmt = $pdo->prepare("UPDATE teams SET team_name = ?, city = ?, division = ?, conference = ?, head_coach_id = ? WHERE team_id = ?");
    $stmt->execute([$team_name, $city, $division, $conference, $head_coach_id, $team_id]);
    header('Location: teams.php');
    exit;
}

// Handle delete team
if ($is_league_manager && isset($_POST['delete_team_id'])) {
    $team_id = $_POST['delete_team_id'];
    $stmt = $pdo->prepare("DELETE FROM teams WHERE team_id = ?");
    $stmt->execute([$team_id]);
    header('Location: teams.php');
    exit;
}

// Fetch all coaches for dropdown
$coaches = $pdo->query("SELECT user_id, first_name, last_name FROM users WHERE role_id = 2 ORDER BY last_name, first_name")->fetchAll();

// Fetch all teams with coach name
$sql = "SELECT t.*, u.first_name AS coach_first, u.last_name AS coach_last FROM teams t LEFT JOIN users u ON t.head_coach_id = u.user_id ORDER BY t.team_id ASC";
$teams = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        NFL Teams
    </title>
    <meta name="description" content="NFL Teams">
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
                $active_page = 'teams';
                include '../templates/partials/leaguemanager/left_aside.php';
            ?>
            <div class="page-content-wrapper">
                <?php
                    include '../templates/partials/header.php';
                ?>
                <main id="js-page-content" role="main" class="page-content">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">NFL Dashboard</a></li>
                        <li class="breadcrumb-item active">Teams</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span
                                class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-users'></i> Teams
                            <small>
                                Manage team information and rosters.
                            </small>
                        </h1>
                    </div>
                    <!-- Your main content goes below here: -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-g">
                                <div class="card-header">
                                    <div class="card-title">Team Management</div>
                                    <div class="card-tools">
                                        <?php if ($is_league_manager): ?>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-team-modal">
                                            <i class="fal fa-plus"></i> Add Team
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover table-striped w-100">
                                        <thead class="bg-primary-600">
                                            <tr>
                                                <th>Team ID</th>
                                                <th>Team Name</th>
                                                <th>City</th>
                                                <th>Division</th>
                                                <th>Conference</th>
                                                <th>Coach</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($teams as $team): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($team['team_id']) ?></td>
                                                <td><?= htmlspecialchars($team['team_name']) ?></td>
                                                <td><?= htmlspecialchars($team['city']) ?></td>
                                                <td><?= htmlspecialchars($team['division']) ?></td>
                                                <td><?= htmlspecialchars($team['conference']) ?></td>
                                                <td><?= htmlspecialchars(trim(($team['coach_first'] ?? '') . ' ' . ($team['coach_last'] ?? ''))) ?: '-' ?></td>
                                                <td>
                                                    <?php if ($is_league_manager): ?>
                                                    <button class="btn btn-sm btn-info edit-team-btn" data-team='<?= json_encode($team) ?>' data-toggle="modal" data-target="#edit-team-modal"><i class="fal fa-edit"></i></button>
                                                    <form method="post" action="" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this team?');">
                                                        <input type="hidden" name="delete_team_id" value="<?= $team['team_id'] ?>">
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
    <?php if ($is_league_manager): ?>
    <!-- Add Team Modal -->
    <div class="modal fade" id="add-team-modal" tabindex="-1" role="dialog" aria-labelledby="addTeamModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content">
                <input type="hidden" name="add_team" value="1">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTeamModalLabel">Add Team</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="add_team_name">Team Name</label>
                        <input type="text" class="form-control" name="add_team_name" id="add_team_name" required>
                    </div>
                    <div class="form-group">
                        <label for="add_city">City</label>
                        <input type="text" class="form-control" name="add_city" id="add_city" required>
                    </div>
                    <div class="form-group">
                        <label for="add_division">Division</label>
                        <input type="text" class="form-control" name="add_division" id="add_division" required>
                    </div>
                    <div class="form-group">
                        <label for="add_conference">Conference</label>
                        <input type="text" class="form-control" name="add_conference" id="add_conference" required>
                    </div>
                    <div class="form-group">
                        <label for="add_head_coach_id">Coach</label>
                        <select class="form-control" name="add_head_coach_id" id="add_head_coach_id">
                            <option value="">-- None --</option>
                            <?php foreach ($coaches as $coach): ?>
                                <option value="<?= $coach['user_id'] ?>"><?= htmlspecialchars($coach['first_name'] . ' ' . $coach['last_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Team</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit Team Modal -->
    <div class="modal fade" id="edit-team-modal" tabindex="-1" role="dialog" aria-labelledby="editTeamModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content">
                <input type="hidden" name="edit_team_id" id="edit_team_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTeamModalLabel">Edit Team</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_team_name">Team Name</label>
                        <input type="text" class="form-control" name="edit_team_name" id="edit_team_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_city">City</label>
                        <input type="text" class="form-control" name="edit_city" id="edit_city" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_division">Division</label>
                        <input type="text" class="form-control" name="edit_division" id="edit_division" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_conference">Conference</label>
                        <input type="text" class="form-control" name="edit_conference" id="edit_conference" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_head_coach_id">Coach</label>
                        <select class="form-control" name="edit_head_coach_id" id="edit_head_coach_id">
                            <option value="">-- None --</option>
                            <?php foreach ($coaches as $coach): ?>
                                <option value="<?= $coach['user_id'] ?>"><?= htmlspecialchars($coach['first_name'] . ' ' . $coach['last_name']) ?></option>
                            <?php endforeach; ?>
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
    <?php endif; ?>
    <script>
    // Fill modal with team data on edit
    $(document).on('click', '.edit-team-btn', function() {
        var team = $(this).data('team');
        $('#edit_team_id').val(team.team_id);
        $('#edit_team_name').val(team.team_name);
        $('#edit_city').val(team.city);
        $('#edit_division').val(team.division);
        $('#edit_conference').val(team.conference);
        $('#edit_head_coach_id').val(team.head_coach_id);
    });
    </script>
</body>
</html> 