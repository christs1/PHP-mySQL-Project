<!-- BEGIN Left Aside -->
<aside class="page-sidebar">
    <div class="page-logo">
        <a href="/RBAC/PHP-mySQL-Project/main/dashboard.php" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
            <img src="../img/svg/football-white.svg" alt="NFL Dashboard" aria-roledescription="logo">
            <span class="page-logo-text mr-1">NFL Dashboard</span>
        </a>
    </div>
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            <img src="../img/profile-pics/default_profile.jpg" class="profile-image rounded-circle" alt="Profile">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">
                    <?php echo htmlspecialchars($_SESSION['role_name']); ?>
                </span>
            </div>
            <img src="../img/card-backgrounds/field.png" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>
        <ul id="js-nav-menu" class="nav-menu">
            <li class="<?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>">
                <a href="/RBAC/PHP-mySQL-Project/main/dashboard.php" title="Dashboard">
                    <i class="fal fa-tachometer"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="<?php echo ($active_page == 'games') ? 'active' : ''; ?>">
                <a href="/RBAC/PHP-mySQL-Project/main/games.php" title="Games">
                    <i class="fal fa-calendar-alt"></i>
                    <span class="nav-link-text">Games</span>
                </a>
            </li>
            <li class="<?php echo ($active_page == 'players') ? 'active' : ''; ?>">
                <a href="/RBAC/PHP-mySQL-Project/main/players.php" title="Players">
                    <i class="fal fa-user"></i>
                    <span class="nav-link-text">Players</span>
                </a>
            </li>
            <li class="<?php echo ($active_page == 'teams') ? 'active' : ''; ?>">
                <a href="/RBAC/PHP-mySQL-Project/main/teams.php" title="Teams">
                    <i class="fal fa-users"></i>
                    <span class="nav-link-text">Teams</span>
                </a>
            </li>
            <li class="<?php echo ($active_page == 'player_statistics') ? 'active' : ''; ?>">
                <a href="/RBAC/PHP-mySQL-Project/main/player_statistics.php" title="Player Statistics">
                    <i class="fal fa-chart-bar"></i>
                    <span class="nav-link-text">Player Statistics</span>
                </a>
            </li>
            <li class="<?php echo ($active_page == 'account') ? 'active' : ''; ?>">
                <a href="/RBAC/PHP-mySQL-Project/main/account.php" title="Account Settings">
                    <i class="fal fa-cog"></i>
                    <span class="nav-link-text">Account</span>
                </a>
            </li>
        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify" class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
    </div>
</aside>
<!-- END Left Aside -->