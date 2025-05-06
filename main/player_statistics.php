<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once '../includes/session_check.php';

// Initialize permission flags
$is_league_manager = (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1);
$is_statistician = (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 4);
$can_edit_statistics = $is_league_manager || $is_statistician;

// Handle statistics update - only for league manager and statistician
if (isset($_POST['edit_stat_id']) && $can_edit_statistics) {
    $stat_id = $_POST['edit_stat_id'];
    $games_played = $_POST['edit_games_played'];
    $passing_yards = $_POST['edit_passing_yards'];
    $rushing_yards = $_POST['edit_rushing_yards'];
    $receiving_yards = $_POST['edit_receiving_yards'];
    $touchdowns = $_POST['edit_touchdowns'];
    $interceptions = $_POST['edit_interceptions'];
    $tackles = $_POST['edit_tackles'];
    $sacks = $_POST['edit_sacks'];
    $fg_made = $_POST['edit_field_goals_made'];
    $fg_att = $_POST['edit_field_goals_attempted'];
    
    $sql = "UPDATE player_statistics SET games_played = :games_played, passing_yards = :passing_yards, rushing_yards = :rushing_yards, receiving_yards = :receiving_yards, touchdowns = :touchdowns, interceptions = :interceptions, tackles = :tackles, sacks = :sacks, field_goals_made = :fg_made, field_goals_attempted = :fg_att WHERE stat_id = :stat_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':games_played' => $games_played,
        ':passing_yards' => $passing_yards,
        ':rushing_yards' => $rushing_yards,
        ':receiving_yards' => $receiving_yards,
        ':touchdowns' => $touchdowns,
        ':interceptions' => $interceptions,
        ':tackles' => $tackles,
        ':sacks' => $sacks,
        ':fg_made' => $fg_made,
        ':fg_att' => $fg_att,
        ':stat_id' => $stat_id
    ]);
    
    $_SESSION['success_message'] = "Statistics updated successfully.";
    header('Location: player_statistics.php');
    exit;
} elseif (isset($_POST['edit_stat_id']) && !$can_edit_statistics) {
    $_SESSION['error_message'] = "You do not have permission to edit statistics.";
    header('Location: player_statistics.php');
    exit;
}

// Fetch player statistics with player and team info
$sql = "
SELECT ps.*, 
       p.first_name, p.last_name, p.position, t.team_name AS player_team, 
       opp.team_name AS opponent_team
FROM player_statistics ps
JOIN players p ON ps.player_id = p.player_id
LEFT JOIN teams t ON p.team_id = t.team_id
LEFT JOIN teams opp ON ps.opponent_team_id = opp.team_id
ORDER BY player_team ASC, p.last_name ASC, p.first_name ASC, ps.game_date DESC
";
$stats = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        NFL Dashboard
    </title>
    <meta name="description" content="NFL Dashboard">
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
                $active_page = 'player_statistics';
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
                        <li class="breadcrumb-item">Player Statistics</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span
                                class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-user'></i> Player Statistics
                            <small>
                                View player statistics for the current season.
                            </small>
                        </h1>
                    </div>
                    <!-- Your main content goes below here: -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-g">
                                <div class="card-header">
                                    <div class="card-title">Player Game Statistics</div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover table-striped w-100" id="stats-table">
                                        <thead class="bg-primary-600">
                                            <tr>
                                                <th>Date</th>
                                                <th>Player</th>
                                                <th>Team</th>
                                                <th>Position</th>
                                                <th>Games Played</th>
                                                <th>Passing Yards</th>
                                                <th>Rushing Yards</th>
                                                <th>Receiving Yards</th>
                                                <th>Touchdowns</th>
                                                <th>Interceptions</th>
                                                <th>Tackles</th>
                                                <th>Sacks</th>
                                                <th>FG Made</th>
                                                <th>FG Att</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($stats as $row): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['game_date']) ?></td>
                                                <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                                                <td><?= htmlspecialchars($row['player_team'] ?? '-') ?></td>
                                                <td><?= htmlspecialchars($row['position']) ?></td>
                                                <td><?= htmlspecialchars($row['games_played']) ?></td>
                                                <td><?= htmlspecialchars($row['passing_yards']) ?></td>
                                                <td><?= htmlspecialchars($row['rushing_yards']) ?></td>
                                                <td><?= htmlspecialchars($row['receiving_yards']) ?></td>
                                                <td><?= htmlspecialchars($row['touchdowns']) ?></td>
                                                <td><?= htmlspecialchars($row['interceptions']) ?></td>
                                                <td><?= htmlspecialchars($row['tackles']) ?></td>
                                                <td><?= htmlspecialchars($row['sacks']) ?></td>
                                                <td><?= htmlspecialchars($row['field_goals_made']) ?></td>
                                                <td><?= htmlspecialchars($row['field_goals_attempted']) ?></td>
                                                <td>
                                                    <?php if ($can_edit_statistics): ?>
                                                    <button class="btn btn-sm btn-info edit-stat-btn" data-stat='<?= json_encode($row) ?>' data-toggle="modal" data-target="#edit-stat-modal">
                                                        <i class="fal fa-edit"></i>
                                                    </button>
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
                    <!-- Edit Stat Modal -->
                    <div class="modal fade" id="edit-stat-modal" tabindex="-1" role="dialog" aria-labelledby="editStatModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="post" class="modal-content">
                                <input type="hidden" name="edit_stat_id" id="edit_stat_id">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editStatModalLabel">Edit Player Statistics</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="edit_games_played">Games Played</label>
                                        <input type="number" class="form-control" name="edit_games_played" id="edit_games_played" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_passing_yards">Passing Yards</label>
                                        <input type="number" class="form-control" name="edit_passing_yards" id="edit_passing_yards">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_rushing_yards">Rushing Yards</label>
                                        <input type="number" class="form-control" name="edit_rushing_yards" id="edit_rushing_yards">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_receiving_yards">Receiving Yards</label>
                                        <input type="number" class="form-control" name="edit_receiving_yards" id="edit_receiving_yards">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_touchdowns">Touchdowns</label>
                                        <input type="number" class="form-control" name="edit_touchdowns" id="edit_touchdowns">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_interceptions">Interceptions</label>
                                        <input type="number" class="form-control" name="edit_interceptions" id="edit_interceptions">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_tackles">Tackles</label>
                                        <input type="number" class="form-control" name="edit_tackles" id="edit_tackles">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_sacks">Sacks</label>
                                        <input type="number" class="form-control" name="edit_sacks" id="edit_sacks">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_field_goals_made">Field Goals Made</label>
                                        <input type="number" class="form-control" name="edit_field_goals_made" id="edit_field_goals_made">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_field_goals_attempted">Field Goals Attempted</label>
                                        <input type="number" class="form-control" name="edit_field_goals_attempted" id="edit_field_goals_attempted">
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
    // Fill modal with stat data on edit
    $(document).on('click', '.edit-stat-btn', function() {
        var stat = $(this).data('stat');
        $('#edit_stat_id').val(stat.stat_id || stat.id || stat.player_stat_id || stat.id_stat || stat["stat_id"]);
        $('#edit_games_played').val(stat.games_played);
        $('#edit_passing_yards').val(stat.passing_yards);
        $('#edit_rushing_yards').val(stat.rushing_yards);
        $('#edit_receiving_yards').val(stat.receiving_yards);
        $('#edit_touchdowns').val(stat.touchdowns);
        $('#edit_interceptions').val(stat.interceptions);
        $('#edit_tackles').val(stat.tackles);
        $('#edit_sacks').val(stat.sacks);
        $('#edit_field_goals_made').val(stat.field_goals_made);
        $('#edit_field_goals_attempted').val(stat.field_goals_attempted);
    });
    </script>
</body>
</html>