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
                $active_page = 'account';
                include '../templates/partials/coach/left_aside.php';
            ?>
            <div class="page-content-wrapper">
                <?php
                    include '../templates/partials/header.php';
                ?>
                <main id="js-page-content" role="main" class="page-content">
                    <ol class="breadcrumb page-breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">NFL Dashboard</a></li>
                        <li class="breadcrumb-item active">Coach</li>
                        <li class="breadcrumb-item">Players</li>
                        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span
                                class="js-get-date"></span></li>
                    </ol>
                    <div class="subheader">
                        <h1 class="subheader-title">
                            <i class='subheader-icon fal fa-user'></i> Players
                            <small>
                                Manage and view player details
                            </small>
                        </h1>
                    </div>
                    <!-- Your main content goes below here: -->
                     <div class="row">
                        <div class="col-lg-6 col-xl-3 order-lg-1 order-xl-1">
                            <?php
                                include '../templates/partials/coach/account/profile_card.php';
                            ?>
                        </div>
                        <div class="col-lg-12 col-xl-6 order-lg-3 order-xl-2">
                            <?php
                                include '../templates/partials/coach/account/update_profile_form.php';
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