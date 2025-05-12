<!-- BEGIN Page Header -->
<header class="page-header" role="banner">
    <!-- we need this logo when user switches to nav-function-top -->
    <div class="page-logo">
        <a href="/RBAC/PHP-mySQL-Project/" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
            <img src="../img/svg/football-white.svg" alt="NFL Dashboard" aria-roledescription="logo">
            <span class="page-logo-text mr-1">NFL Dashboard</span>
        </a>
    </div>
    <!-- DOC: mobile button appears during mobile width -->
    <div class="hidden-lg-up">
        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
            <i class="ni ni-menu"></i>
        </a>
    </div>
    <!-- <div class="search">
        <form class="app-forms hidden-xs-down" role="search" action="page_search.html" autocomplete="off">
            <input type="text" id="search-field" placeholder="Search for anything" class="form-control" tabindex="1">
            <a href="#" onclick="return false;" class="btn-danger btn-search-close js-waves-off d-none"
                data-action="toggle" data-class="mobile-search-on">
                <i class="fal fa-times"></i>
            </a>
        </form>
    </div> -->
    <div class="ml-auto d-flex">
        <!-- activate app search icon (mobile) -->
        <div class="hidden-sm-up">
            <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on" data-focus="search-field"
                title="Search">
                <i class="fal fa-search"></i>
            </a>
        </div>
        <!-- app darkmode -->
        <div class="hidden-md-down" id="mode-d" data-toggle="tooltip" data-placement="bottom"
            data-original-title="Switch to DarkMode" data-trigger="hover">
            <a href="#" class="header-icon" onClick="layouts.mode('dark');">
                <svg style="font-size:17px" data-fa-symbol="delete" class="fa-adjust fa-w-16 fa-fw" aria-hidden="true"
                    data-prefix="fal" data-icon="adjust" role="img" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512 512" data-fa-i2svg="" id="delete">
                    <path fill="currentColor"
                        d="M256 40c119.945 0 216 97.337 216 216 0 119.945-97.337 216-216 216-119.945 0-216-97.337-216-216 0-119.945 97.337-216 216-216m0-32C119.033 8 8 119.033 8 256s111.033 248 248 248 248-111.033 248-248S392.967 8 256 8zm-32 124.01v247.98c-53.855-13.8-96-63.001-96-123.99 0-60.99 42.145-110.19 96-123.99M256 96c-88.366 0-160 71.634-160 160s71.634 160 160 160V96z">
                    </path>
                </svg>
            </a>
        </div>
        <div class="hidden-md-down" id="mode-l" data-toggle="tooltip" data-placement="bottom"
            data-original-title="Switch to LightMode" data-trigger="hover">
            <a href="#" class="header-icon" onClick="layouts.mode('light');">
                <svg style="font-size:17px" data-fa-symbol="light-mode" class="fa-circle fa-w-16 fa-fw"
                    aria-hidden="true" data-prefix="fas" data-icon="circle" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" id="delete">
                    <path fill="currentColor" d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                    </path>
                </svg>
            </a>
        </div>
        <div class="hidden-md-down" id="mode-n" data-toggle="tooltip" data-placement="bottom"
            data-original-title="Switch to Default" data-trigger="hover">
            <a href="#" class="header-icon" onClick="layouts.mode('default');">
                <svg style="font-size:17px" data-fa-symbol="normal-mode" class="fa-circle fa-w-16 fa-fw"
                    aria-hidden="true" data-prefix="fal" data-icon="circle" role="img"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="" id="delete">
                    <path fill="currentColor"
                        d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm216 248c0 118.7-96.1 216-216 216-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216z">
                    </path>
                </svg>
            </a>
        </div>

        <!-- app user menu -->
        <div>
            <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com"
                class="header-icon d-flex align-items-center justify-content-center ml-2">
                <img src="../img/profile-pics/default_profile.jpg" class="profile-image rounded-circle"
                    alt="Dr. Codex Lantern">
                <!-- you can also add username next to the avatar with the codes below:
									<span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
									<i class="ni ni-chevron-down hidden-xs-down"></i> -->
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                        <span class="mr-2">
                            <img src="../img/profile-pics/default_profile.jpg" class="rounded-circle profile-image"
                                alt="Dr. Codex Lantern">
                        </span>
                        <div class="info-card-text">
                            <div class="fs-lg text-truncate text-truncate-lg">Coach Name</div>
                            <span class="text-truncate text-truncate-md opacity-80">andy@kansascity.com</span>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider m-0"></div>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
                    <span data-i18n="drpdwn.settings">Settings</span>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a href="#" class="dropdown-item" data-action="app-fullscreen">
                    <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                    <i class="float-right text-muted fw-n">F11</i>
                </a>
                <a href="#" class="dropdown-item" data-action="app-print">
                    <span data-i18n="drpdwn.print">Print</span>
                    <i class="float-right text-muted fw-n">Ctrl + P</i>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a class="dropdown-item fw-500 pt-3 pb-3" href="../">
                    <span data-i18n="drpdwn.page-logout">Logout</span>
                </a>
            </div>
        </div>
    </div>
</header>