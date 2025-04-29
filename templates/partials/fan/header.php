<!-- BEGIN Page Header -->
<header class="page-header" role="banner">
    <!-- we need this logo when user switches to nav-function-top -->
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
            data-toggle="modal" data-target="#modal-shortcut">
            <img src="../img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
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
        <!-- Login Button -->
        <div class="" id="login-top" data-toggle="login" data-placement="bottom"
            data-original-title="Login" data-trigger="hover">
            <a href="/nfl" class="header-icon">LOGIN</a>
        </div>
    </div>
</header>