<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once '../includes/session_check.php';


// Only allow league manager access
$is_league_manager = ((isset($_SESSION['role_id']) && ($_SESSION['role_id'] == 1)));
$active_page = 'users';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update_role':
                $user_id = $_POST['user_id'];
                $new_role = $_POST['new_role'];
                $stmt = $pdo->prepare("UPDATE users SET role_id = (SELECT role_id FROM roles WHERE role_name = ?) WHERE user_id = ?");
                $stmt->execute([$new_role, $user_id]);
                break;

            case 'assign_team':
                $user_id = $_POST['user_id'];
                $team_id = $_POST['team_id'];
                $role = $_POST['role'];
                
                // Update the user's team_id in the users table
                $stmt = $pdo->prepare("UPDATE users SET team_id = ? WHERE user_id = ?");
                $stmt->execute([$team_id, $user_id]);
                
                // Also update role-specific tables if needed
                if ($role === 'player') {
                    // Check if player record exists
                    $check_stmt = $pdo->prepare("SELECT player_id FROM players WHERE user_id = ?");
                    $check_stmt->execute([$user_id]);
                    $player = $check_stmt->fetch();

                    if ($player) {
                        // Update existing player
                        $stmt = $pdo->prepare("UPDATE players SET team_id = ? WHERE user_id = ?");
                        $stmt->execute([$team_id, $user_id]);
                    } else {
                        // Get user info for new player record
                        $user_stmt = $pdo->prepare("SELECT first_name, last_name FROM users WHERE user_id = ?");
                        $user_stmt->execute([$user_id]);
                        $user = $user_stmt->fetch();

                        // Create new player record
                        $stmt = $pdo->prepare("INSERT INTO players (user_id, first_name, last_name, team_id, status) VALUES (?, ?, ?, ?, 'Active')");
                        $stmt->execute([$user_id, $user['first_name'], $user['last_name'], $team_id]);
                    }
                } else if ($role === 'coach') {
                    $stmt = $pdo->prepare("UPDATE teams SET head_coach_id = ? WHERE team_id = ?");
                    $stmt->execute([$user_id, $team_id]);
                } else if ($role === 'statistician') {
                    $stmt = $pdo->prepare("UPDATE teams SET statistician_id = NULL WHERE statistician_id = ?");
                    $stmt->execute([$user_id]);
                    
                    // Then assign the user as statistician to the selected team
                    $stmt = $pdo->prepare("UPDATE teams SET statistician_id = ? WHERE team_id = ?");
                    $stmt->execute([$user_id, $team_id]);
                }
                break;

            case 'delete_user':
                $user_id = $_POST['user_id'];
                // Set head_coach_id to NULL in teams where this user is the coach
                $stmt = $pdo->prepare("UPDATE teams SET head_coach_id = NULL WHERE head_coach_id = ?");
                $stmt->execute([$user_id]);
                // Set statistician_id to NULL in teams where this user is the statistician
                $stmt = $pdo->prepare("UPDATE teams SET statistician_id = NULL WHERE statistician_id = ?");
                $stmt->execute([$user_id]);
                // Now delete the user
                $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
                $stmt->execute([$user_id]);
                break;
        }
    }
}

$query = "
    SELECT DISTINCT u.*, r.role_name, 
    CASE 
        WHEN u.role_id = 3 THEN p.team_id  -- Player
        WHEN u.role_id = 2 THEN (SELECT team_id FROM teams WHERE head_coach_id = u.user_id LIMIT 1)  -- Coach
        WHEN u.role_id = 4 THEN (SELECT team_id FROM teams WHERE statistician_id = u.user_id LIMIT 1)  -- Statistician
        ELSE NULL 
    END as team_id,
    t.team_name
    FROM users u
    LEFT JOIN roles r ON u.role_id = r.role_id
    LEFT JOIN players p ON u.user_id = p.user_id
    LEFT JOIN teams t ON 
        (u.role_id = 3 AND p.team_id = t.team_id) OR  -- Player's team
        (u.role_id = 2 AND t.head_coach_id = u.user_id) OR  -- Coach's team
        (u.role_id = 4 AND t.statistician_id = u.user_id)  -- Statistician's team
    ORDER BY u.last_name, u.first_name
";
$result = $pdo->query($query);

// Fetch all teams for dropdown
$stmt = $pdo->prepare("SELECT team_id, team_name FROM teams ORDER BY team_name ASC");
$stmt->execute();
$teams = $stmt->fetchAll();

// Fetch all roles for dropdown
$roles_query = "SELECT role_name FROM roles ORDER BY role_name";
$roles_result = $pdo->query($roles_query);
$roles = $roles_result->fetchAll(PDO::FETCH_ASSOC);

// Fetch all games
$stmt = $pdo->prepare("SELECT g.*, ht.team_name AS home_team, at.team_name AS away_team 
                       FROM team_schedule g 
                       LEFT JOIN teams ht ON g.home_team_id = ht.team_id 
                       LEFT JOIN teams at ON g.away_team_id = at.team_id 
                       ORDER BY g.game_date ASC");
$stmt->execute();
$games = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Management</title>
    <meta name="description" content="User Management">
    <?php include '../templates/partials/all_accounts/head_imports.php'; ?>
</head>

<body class="mod-bg-1">
    <?php include '../templates/partials/load_theme.php'; ?>
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <?php
                $active_page = 'users';
                include '../templates/partials/role_aside.php';
            ?>
            <div class="page-content-wrapper">
                <?php include '../templates/partials/header.php'; ?>
                <main id="js-page-content" role="main" class="page-content">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">NFL Dashboard</a></li>
                        <li class="breadcrumb-item active">User Management</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-user-cog'></i> User Management
                            <small>
                                Manage system users and their roles
                            </small>
                        </h1>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-g">
                                <div class="card-header">
                                    <div class="card-title">User Management</div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Team</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($user = $result->fetch(PDO::FETCH_ASSOC)): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                                    <td>
                                                        <form class="role-form" method="POST">
                                                            <input type="hidden" name="action" value="update_role">
                                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                                            <select name="new_role" class="form-control form-control-sm" onchange="this.form.submit()">
                                                                <?php foreach ($roles as $role): ?>
                                                                    <option value="<?php echo $role['role_name']; ?>" 
                                                                            <?php echo ($role['role_name'] === $user['role_name']) ? 'selected' : ''; ?>>
                                                                        <?php echo ucfirst($role['role_name']); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <?php if (in_array($user['role_name'], ['player', 'coach', 'statistician'])): ?>
                                                        <form class="team-form" method="POST">
                                                            <input type="hidden" name="action" value="assign_team">
                                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                                            <input type="hidden" name="role" value="<?php echo $user['role_name']; ?>">
                                                            <select name="team_id" class="form-control form-control-sm" onchange="this.form.submit()">
                                                                <option value="">-- Select Team --</option>
                                                                <?php foreach ($teams as $team): ?>
                                                                    <option value="<?php echo $team['team_id']; ?>"
                                                                            <?php echo ($team['team_id'] == $user['team_id']) ? 'selected' : ''; ?>>
                                                                        <?php echo htmlspecialchars($team['team_name']); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </form>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <form method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                            <input type="hidden" name="action" value="delete_user">
                                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                <?php include '../templates/partials/footer.php'; ?>
                <?php include '../templates/partials/js_color_profile.php'; ?>
            </div>
        </div>
    </div>
    <?php include '../templates/partials/all_accounts/js_imports.php'; ?>
</body>
</html>