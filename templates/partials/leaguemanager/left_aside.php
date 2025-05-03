<!-- BEGIN Left Aside -->
<aside class="page-sidebar">
    <div class="page-logo">
        <a href="/RBAC/PHP-mySQL-Project/leaguemanager/dashboard.php" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
            data-toggle="modal" data-target="#modal-shortcut">
            <img src="../img/svg/football-white.svg" alt="League Manager" aria-roledescription="logo">
            <span class="page-logo-text mr-1">League Manager</span>
        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control"
                    tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off"
                    data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        <div class="info-card">
            <img src="../img/profile-pics/default_profile.jpg" class="profile-image rounded-circle"
                alt="League Manager">
            <div class="info-card-text">
                <a href="#" class="d-flex align-items-center text-white">
                    <span class="text-truncate text-truncate-sm d-inline-block">
                        League Manager
                    </span>
                </a>
                <span class="d-inline-block text-truncate text-truncate-sm">Administrator</span>
            </div>
            <img src="../img/card-backgrounds/field.png" class="cover" alt="cover">
            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle"
                data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                <i class="fal fa-angle-down"></i>
            </a>
        </div>
        <ul id="js-nav-menu" class="nav-menu">
            <li class="<?php echo ($active_page == 'dashboard') ? 'active' : ''; ?>">
                <a href="dashboard.php" title="Dashboard" data-filter-tags="dashboard">
                    <i class="fal fa-tachometer"></i>
                    <span class="nav-link-text" data-i18n="nav.dashboard">Dashboard</span>
                </a>
            </li>
            <li class="<?php echo ($active_page == 'games') ? 'active' : ''; ?>">
                <a href="games.php" title="Games" data-filter-tags="games schedule">
                    <i class="fal fa-calendar"></i>
                    <span class="nav-link-text" data-i18n="nav.games">Games</span>
                </a>
            </li>
            <li class="<?php echo ($active_page == 'players') ? 'active' : ''; ?>">
                <a href="players.php" title="Players" data-filter-tags="players roster">
                    <i class="fal fa-user"></i>
                    <span class="nav-link-text" data-i18n="nav.players">Players</span>
                </a>
                <ul>
                    <li class="<?php echo ($active_page == 'player_statistics') ? 'active' : ''; ?>">
                        <a href="player_statistics.php" title="Player Statistics" data-filter-tags="player statistics">
                            <span class="nav-link-text">Player Statistics</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="<?php echo ($active_page == 'teams') ? 'active' : ''; ?>">
                <a href="teams.php" title="Teams" data-filter-tags="teams">
                    <i class="fal fa-users"></i>
                    <span class="nav-link-text" data-i18n="nav.teams">Teams</span>
                </a>
            </li>
            <li class="<?php echo ($active_page == 'account') ? 'active' : ''; ?>">
                <a href="account.php" title="Account" data-filter-tags="account">
                    <i class="fal fa-user-circle"></i>
                    <span class="nav-link-text" data-i18n="nav.account">Account</span>
                </a>
            </li>
        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->
    <!-- NAV FOOTER -->
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify"
            class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
    </div> <!-- END NAV FOOTER -->
</aside>
<!-- END Left Aside -->