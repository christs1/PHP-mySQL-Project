<?php
require_once './includes/session_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Access Denied</title>
    <?php include './templates/partials/all_accounts/head_imports.php'; ?>
</head>
<body class="mod-bg-1">
    <div class="page-wrapper">
        <div class="page-inner">
            <?php include './templates/partials/role_aside.php'; ?>
            <div class="page-content-wrapper">
                <?php include './templates/partials/header.php'; ?>
                <main class="page-content">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="text-danger">Access Denied</h1>
                            <p>You don't have permission to access this page.</p>
                            <a href="/RBAC/PHP-mySQL-Project/main/dashboard.php" class="btn btn-primary">Return to Dashboard</a>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <?php include './templates/partials/all_accounts/js_imports.php'; ?>
</body>
</html>