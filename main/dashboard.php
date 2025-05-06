<?php
require_once '../includes/session_check.php';
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
                $active_page = 'dashboard';
                include '../templates/partials/role_aside.php';
            ?>
            <div class="page-content-wrapper">
                <?php
                    include '../templates/partials/header.php';
                ?>
                <main id="js-page-content" role="main" class="page-content">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">NFL Dashboard</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span
                                class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-tachometer'></i> Dashboard
                            <small>
                                Overview of football league management system.
                            </small>
                        </h1>
                    </div>
                    <!-- Your main content goes below here: -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-g">
                                <div class="card-body">
                                    <h2 class="fw-700 m-0">Welcome to NFL League Manager</h2>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mt-4">
                                            <div class="mr-3">
                                                <span class="fa-stack fa-lg">
                                                    <i class="fal fa-circle fa-stack-2x text-primary"></i>
                                                    <i class="fa fa-calendar fa-stack-1x text-white"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <div class="fw-700 fs-xl"><a href="games.php" class="text-primary">Upcoming Games</a></div>
                                                <div class="text-muted">View and manage upcoming game schedule</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mt-4">
                                            <div class="mr-3">
                                                <span class="fa-stack fa-lg">
                                                    <i class="fal fa-circle fa-stack-2x text-info"></i>
                                                    <i class="fa fa-user fa-stack-1x text-white"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <div class="fw-700 fs-xl"><a href="players.php" class="text-info">Players</a></div>
                                                <div class="text-muted">Manage players and their information</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mt-4">
                                            <div class="mr-3">
                                                <span class="fa-stack fa-lg">
                                                    <i class="fal fa-circle fa-stack-2x text-success"></i>
                                                    <i class="fa fa-users fa-stack-1x text-white"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <div class="fw-700 fs-xl"><a href="teams.php" class="text-success">Teams</a></div>
                                                <div class="text-muted">View and manage team information</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mt-4">
                                            <div class="mr-3">
                                                <span class="fa-stack fa-lg">
                                                    <i class="fal fa-circle fa-stack-2x text-warning"></i>
                                                    <i class="fa fa-chart-bar fa-stack-1x text-white"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <div class="fw-700 fs-xl"><a href="player_statistics.php" class="text-warning">Player Statistics</a></div>
                                                <div class="text-muted">View and edit player statistics for the season</div>
                                            </div>
                                        </div>
                                    </div>
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
</body>
</html>