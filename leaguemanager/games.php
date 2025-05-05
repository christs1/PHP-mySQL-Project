<?php
session_start();
require_once __DIR__ . '/../config/db.php';

// Only allow league manager to add/edit/delete
$is_league_manager = ((isset($_SESSION['role_id']) && ($_SESSION['role_id'] == 1)));

// Handle add game
if ($is_league_manager && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_game'])) {
    $game_date = $_POST['add_game_date'];
    $game_time = $_POST['add_game_time'];
    $home_team_id = $_POST['add_home_team_id'];
    $away_team_id = $_POST['add_away_team_id'];
    $venue = $_POST['add_venue'];
    $game_status = $_POST['add_game_status'];
    $season_year = $_POST['add_season_year'];
    $week_number = $_POST['add_week_number'];
    $stmt = $pdo->prepare("INSERT INTO team_schedule (home_team_id, away_team_id, game_date, venue, game_status, season_year, week_number) VALUES (?, ?, CONCAT(?, ' ', ?), ?, ?, ?, ?)");
    $stmt->execute([$home_team_id, $away_team_id, $game_date, $game_time, $venue, $game_status, $season_year, $week_number]);
    header('Location: games.php');
    exit;
}

// Handle edit game
if ($is_league_manager && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_game_id'])) {
    $game_id = $_POST['edit_game_id'];
    $game_date = $_POST['edit_game_date'];
    $game_time = $_POST['edit_game_time'];
    $home_team_id = $_POST['edit_home_team_id'];
    $away_team_id = $_POST['edit_away_team_id'];
    $venue = $_POST['edit_venue'];
    $game_status = $_POST['edit_game_status'];
    $season_year = $_POST['edit_season_year'];
    $week_number = $_POST['edit_week_number'];
    $stmt = $pdo->prepare("UPDATE team_schedule SET home_team_id = ?, away_team_id = ?, game_date = CONCAT(?, ' ', ?), venue = ?, game_status = ?, season_year = ?, week_number = ? WHERE game_id = ?");
    $stmt->execute([$home_team_id, $away_team_id, $game_date, $game_time, $venue, $game_status, $season_year, $week_number, $game_id]);
    header('Location: games.php');
    exit;
}

// Handle delete game
if ($is_league_manager && isset($_POST['delete_game_id'])) {
    $game_id = $_POST['delete_game_id'];
    $stmt = $pdo->prepare("DELETE FROM team_schedule WHERE game_id = ?");
    $stmt->execute([$game_id]);
    header('Location: games.php');
    exit;
}

// Fetch all teams for dropdowns
$teams = $pdo->query("SELECT team_id, team_name FROM teams ORDER BY team_name ASC")->fetchAll();

// Fetch all games with team names
$sql = "SELECT g.*, ht.team_name AS home_team, at.team_name AS away_team FROM team_schedule g LEFT JOIN teams ht ON g.home_team_id = ht.team_id LEFT JOIN teams at ON g.away_team_id = at.team_id ORDER BY g.game_date ASC";
$games = $pdo->query($sql)->fetchAll();

// Split games into upcoming and past
$upcoming_games = [];
$past_games = [];
$today = new DateTime('today');
foreach ($games as $game) {
    $game_dt = new DateTime($game['game_date']);
    if ($game_dt < $today) {
        $past_games[] = $game;
    } else {
        $upcoming_games[] = $game;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        NFL Games Schedule
    </title>
    <meta name="description" content="NFL Games Schedule">
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
                $active_page = 'games';
                include '../templates/partials/leaguemanager/left_aside.php';
            ?>
            <div class="page-content-wrapper">
                <?php
                    include '../templates/partials/header.php';
                ?>
                <main id="js-page-content" role="main" class="page-content">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">NFL Dashboard</a></li>
                        <li class="breadcrumb-item active">Games</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span
                                class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-calendar'></i> Games Schedule
                            <small>
                                View and manage upcoming game schedules.
                            </small>
                        </h1>
                    </div>
                    <!-- Your main content goes below here: -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-g">
                                <div class="card-header">
                                    <div class="card-title">Upcoming Games</div>
                                    <div class="card-tools">
                                        <?php if ($is_league_manager): ?>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-game-modal">
                                            <i class="fal fa-plus"></i> Add Game
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover table-striped w-100">
                                        <thead class="bg-primary-600">
                                            <tr>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Home Team</th>
                                                <th>Away Team</th>
                                                <th>Location</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($upcoming_games as $game): ?>
                                            <?php
                                                $dt = new DateTime($game['game_date']);
                                                $date = $dt->format('M d, Y');
                                                $time = $dt->format('g:i A');
                                            ?>
                                            <tr>
                                                <td><?= htmlspecialchars($date) ?></td>
                                                <td><?= htmlspecialchars($time) ?></td>
                                                <td><?= htmlspecialchars($game['home_team'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($game['away_team'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($game['venue'] ?? '-') ?></td>
                                                <td><span class="badge badge-success"><?= htmlspecialchars($game['game_status']) ?></span></td>
                                                <td>
                                                    <?php if ($is_league_manager): ?>
                                                    <button class="btn btn-sm btn-info edit-game-btn" data-game='<?= json_encode($game) ?>' data-toggle="modal" data-target="#edit-game-modal"><i class="fal fa-edit"></i></button>
                                                    <form method="post" action="" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this game?');">
                                                        <input type="hidden" name="delete_game_id" value="<?= $game['game_id'] ?>">
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
                            <!-- Past Games Section -->
                            <div class="card mb-g">
                                <div class="card-header">
                                    <div class="card-title">Past Games</div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover table-striped w-100">
                                        <thead class="bg-primary-600">
                                            <tr>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Home Team</th>
                                                <th>Away Team</th>
                                                <th>Location</th>
                                                <th>Home Score</th>
                                                <th>Away Score</th>
                                                <th>Winner</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($past_games as $game): ?>
                                            <?php
                                                $dt = new DateTime($game['game_date']);
                                                $date = $dt->format('M d, Y');
                                                $time = $dt->format('g:i A');
                                                $home_score = $game['home_score'];
                                                $away_score = $game['away_score'];
                                                $winner = '-';
                                                if (is_numeric($home_score) && is_numeric($away_score)) {
                                                    if ($home_score > $away_score) {
                                                        $winner = '<span class="badge badge-primary">' . htmlspecialchars($game['home_team']) . ' (Home)</span>';
                                                    } elseif ($away_score > $home_score) {
                                                        $winner = '<span class="badge badge-success">' . htmlspecialchars($game['away_team']) . ' (Away)</span>';
                                                    } else {
                                                        $winner = '<span class="badge badge-warning">Tie</span>';
                                                    }
                                                }
                                            ?>
                                            <tr>
                                                <td><?= htmlspecialchars($date) ?></td>
                                                <td><?= htmlspecialchars($time) ?></td>
                                                <td><?= htmlspecialchars($game['home_team'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($game['away_team'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($game['venue'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($home_score ?? '-') ?></td>
                                                <td><?= htmlspecialchars($away_score ?? '-') ?></td>
                                                <td><?= $winner ?></td>
                                                <td><span class="badge badge-success"><?= htmlspecialchars($game['game_status']) ?></span></td>
                                                <td>
                                                    <?php if ($is_league_manager): ?>
                                                    <button class="btn btn-sm btn-info edit-game-btn" data-game='<?= json_encode($game) ?>' data-toggle="modal" data-target="#edit-game-modal"><i class="fal fa-edit"></i></button>
                                                    <form method="post" action="" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this game?');">
                                                        <input type="hidden" name="delete_game_id" value="<?= $game['game_id'] ?>">
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
    <!-- Add Game Modal -->
    <div class="modal fade" id="add-game-modal" tabindex="-1" role="dialog" aria-labelledby="addGameModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content">
                <input type="hidden" name="add_game" value="1">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGameModalLabel">Add Game</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="add_game_date">Date</label>
                        <input type="date" class="form-control" name="add_game_date" id="add_game_date" required>
                    </div>
                    <div class="form-group">
                        <label for="add_game_time">Time</label>
                        <input type="time" class="form-control" name="add_game_time" id="add_game_time" required>
                    </div>
                    <div class="form-group">
                        <label for="add_home_team_id">Home Team</label>
                        <select class="form-control" name="add_home_team_id" id="add_home_team_id" required>
                            <option value="">-- Select --</option>
                            <?php foreach ($teams as $team): ?>
                                <option value="<?= $team['team_id'] ?>"><?= htmlspecialchars($team['team_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add_away_team_id">Away Team</label>
                        <select class="form-control" name="add_away_team_id" id="add_away_team_id" required>
                            <option value="">-- Select --</option>
                            <?php foreach ($teams as $team): ?>
                                <option value="<?= $team['team_id'] ?>"><?= htmlspecialchars($team['team_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add_venue">Location</label>
                        <input type="text" class="form-control" name="add_venue" id="add_venue" required>
                    </div>
                    <div class="form-group">
                        <label for="add_game_status">Status</label>
                        <select class="form-control" name="add_game_status" id="add_game_status">
                            <option value="Scheduled">Scheduled</option>
                            <option value="Completed">Completed</option>
                            <option value="Postponed">Postponed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="add_season_year">Season Year</label>
                        <input type="number" class="form-control" name="add_season_year" id="add_season_year" required>
                    </div>
                    <div class="form-group">
                        <label for="add_week_number">Week Number</label>
                        <input type="number" class="form-control" name="add_week_number" id="add_week_number" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Game</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Edit Game Modal -->
    <div class="modal fade" id="edit-game-modal" tabindex="-1" role="dialog" aria-labelledby="editGameModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" class="modal-content">
                <input type="hidden" name="edit_game_id" id="edit_game_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGameModalLabel">Edit Game</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_game_date">Date</label>
                        <input type="date" class="form-control" name="edit_game_date" id="edit_game_date" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_game_time">Time</label>
                        <input type="time" class="form-control" name="edit_game_time" id="edit_game_time" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_home_team_id">Home Team</label>
                        <select class="form-control" name="edit_home_team_id" id="edit_home_team_id" required>
                            <option value="">-- Select --</option>
                            <?php foreach ($teams as $team): ?>
                                <option value="<?= $team['team_id'] ?>"><?= htmlspecialchars($team['team_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_away_team_id">Away Team</label>
                        <select class="form-control" name="edit_away_team_id" id="edit_away_team_id" required>
                            <option value="">-- Select --</option>
                            <?php foreach ($teams as $team): ?>
                                <option value="<?= $team['team_id'] ?>"><?= htmlspecialchars($team['team_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_venue">Location</label>
                        <input type="text" class="form-control" name="edit_venue" id="edit_venue" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_game_status">Status</label>
                        <select class="form-control" name="edit_game_status" id="edit_game_status">
                            <option value="Scheduled">Scheduled</option>
                            <option value="Completed">Completed</option>
                            <option value="Postponed">Postponed</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_season_year">Season Year</label>
                        <input type="number" class="form-control" name="edit_season_year" id="edit_season_year" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_week_number">Week Number</label>
                        <input type="number" class="form-control" name="edit_week_number" id="edit_week_number" required>
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
    // Fill modal with game data on edit
    $(document).on('click', '.edit-game-btn', function() {
        var game = $(this).data('game');
        var dt = new Date(game.game_date);
        var dateStr = dt.toISOString().slice(0,10);
        var timeStr = dt.toTimeString().slice(0,5);
        $('#edit_game_id').val(game.game_id);
        $('#edit_game_date').val(dateStr);
        $('#edit_game_time').val(timeStr);
        $('#edit_home_team_id').val(game.home_team_id);
        $('#edit_away_team_id').val(game.away_team_id);
        $('#edit_venue').val(game.venue);
        $('#edit_game_status').val(game.game_status);
        $('#edit_season_year').val(game.season_year);
        $('#edit_week_number').val(game.week_number);
    });
    </script>
</body>
</html> 