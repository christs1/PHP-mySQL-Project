<?php
session_start();
require_once __DIR__ . '/../config/db.php';
require_once '../includes/session_check.php';

// Redirect guest accounts to registration
if (isset($_SESSION['username']) && $_SESSION['username'] === 'guest') {
    header('Location: /RBAC/PHP-mySQL-Project/page_register.php');
    exit;
}

// Get user information
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT u.*, t.team_name 
                       FROM users u 
                       LEFT JOIN teams t ON u.team_id = t.team_id 
                       WHERE u.user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    
    $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ? WHERE user_id = ?");
    $stmt->execute([$first_name, $last_name, $user_id]);
    
    $_SESSION['success_message'] = "Profile updated successfully.";
    header('Location: account.php');
    exit;
}

// Handle password reset
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Verify current password
    $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $stored_hash = $stmt->fetchColumn();
    
    if (password_verify($current_password, $stored_hash)) {
        if ($new_password === $confirm_password) {
            $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE user_id = ?");
            $stmt->execute([$new_hash, $user_id]);
            $_SESSION['success_message'] = "Password updated successfully.";
        } else {
            $_SESSION['error_message'] = "New passwords do not match.";
        }
    } else {
        $_SESSION['error_message'] = "Current password is incorrect.";
    }
    
    header('Location: account.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        NFL Account
    </title>
    <meta name="description" content="NFL Account">
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
                $active_page = 'account';
                include '../templates/partials/role_aside.php';
            ?>
            <div class="page-content-wrapper">
                <?php
                    include '../templates/partials/header.php';
                ?>
                <main id="js-page-content" role="main" class="page-content">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">NFL Dashboard</a></li>
                        <li class="breadcrumb-item active">Account</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span
                                class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-user-circle'></i> Account
                            <small>
                                Manage and view your account details
                            </small>
                        </h1>
                    </div>
                    <!-- Your main content goes below here: -->
                     <div class="row">
                        <div class="col-lg-6 col-xl-3 order-lg-1 order-xl-1">
                            <?php
                                include '../templates/partials/all_accounts/account/profile_card.php';
                            ?>
                        </div>
                        <div class="col-lg-12 col-xl-6 order-lg-3 order-xl-2">
                            <?php
                                include '../templates/partials/all_accounts/account/update_profile_form.php';
                            ?>
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
</body>
</html>