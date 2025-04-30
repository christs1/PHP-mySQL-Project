<!-- BEGIN Left Aside -->
<aside class="page-sidebar">
    <div class="page-logo">
        <a href="/nfl/fan/" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
            data-toggle="modal" data-target="#modal-shortcut">
            <img src="../img/svg/football-white.svg" alt="SmartAdmin WebApp" aria-roledescription="logo">
            <span class="page-logo-text mr-1">NFL Dashboard</span>
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
        <ul id="js-nav-menu" class="nav-menu">
            <li class="<?php echo ($active_page == 'schedule') ? 'active' : ''; ?>">
                <a href="/nfl/fan/" title="Schedule" data-filter-tags="schedule">
                    <i class="fal fa-calendar"></i>
                    <span class="nav-link-text" data-i18n="nav.schedule">Schedule</span>
                </a>
            </li>
            <li class="<?php echo ($active_page == 'standings') ? 'active' : ''; ?>">
                <a href="/nfl/fan/standings.php" title="Standings" data-filter-tags="standings">
                    <i class="fal fa-table"></i>
                    <span class="nav-link-text" data-i18n="nav.standings">Standings</span>
                </a>
            </li>
            <li class="<?php echo ($active_page == 'player_statistics') ? 'active' : ''; ?>">
                <a href="/nfl/fan/player_statistics.php" title="Player Statistics" data-filter-tags="player statistics">
                    <i class="fal fa-chart-bar"></i>
                    <span class="nav-link-text" data-i18n="nav.player_statistics">Player Statistics</span>
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