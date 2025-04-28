<!-- BEGIN Page Header -->
<header class="page-header" role="banner">
    <!-- we need this logo when user switches to nav-function-top -->
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
            data-toggle="modal" data-target="#modal-shortcut">
            <img src="../img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
            <span class="page-logo-text mr-1">SmartAdmin WebApp</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2">SLIM
                Project</span>
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
        <!-- app shortcuts -->
        <div data-toggle="tooltip" data-placement="bottom" data-original-title="App Shortcuts" data-trigger="hover">
            <a href="#" class="header-icon" data-toggle="dropdown" title="My Apps">
                <i class="fal fa-cube"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-animated w-auto h-auto">
                <div
                    class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top">
                    <h4 class="m-0 text-center color-white">
                        Quick Shortcut
                        <small class="mb-0 opacity-80">Pages</small>
                    </h4>
                </div>
                <div class="custom-scroll h-100">
                    <ul class="app-list">
                        <li>
                            <a href="/nfl/coach/account.php" class="app-list-item hover-white">
                                <span class="icon-stack">
                                    <i class="base-2 icon-stack-3x color-primary-400"></i>
                                    <i class="base-10 text-white icon-stack-1x"></i>
                                    <i class="ni md-profile color-primary-800 icon-stack-2x"></i>
                                </span>
                                <span class="app-list-name">
                                    Account
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="/nfl/coach/schedule.php" class="app-list-item hover-white">
                                <span class="icon-stack">
                                    <i class="base-18 icon-stack-3x color-info-700"></i>
                                    <span
                                        class="position-absolute pos-top pos-left pos-right color-white fs-md mt-2 fw-400">28</span>
                                </span>
                                <span class="app-list-name">
                                    Schedule
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="app-list-item hover-white">
                                <span class="icon-stack">
                                    <i class="base-7 icon-stack-3x color-info-500"></i>
                                    <i class="base-7 icon-stack-2x color-info-700"></i>
                                    <i class="ni ni-graph icon-stack-1x text-white"></i>
                                </span>
                                <span class="app-list-name">
                                    Stats
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="app-list-item hover-white">
                                <span class="icon-stack">
                                    <i class="base-4 icon-stack-3x color-danger-500"></i>
                                    <i class="base-4 icon-stack-1x color-danger-400"></i>
                                    <i class="ni ni-envelope icon-stack-1x text-white"></i>
                                </span>
                                <span class="app-list-name">
                                    Messages
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="app-list-item hover-white">
                                <span class="icon-stack">
                                    <i class="base-4 icon-stack-3x color-fusion-400"></i>
                                    <i class="base-5 icon-stack-2x color-fusion-200"></i>
                                    <i class="base-5 icon-stack-1x color-fusion-100"></i>
                                    <i class="fal fa-keyboard icon-stack-1x color-info-50"></i>
                                </span>
                                <span class="app-list-name">
                                    Notes
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- app notification -->
        <div data-toggle="tooltip" data-placement="bottom" data-original-title="Notifications" data-trigger="hover">
            <a href="#" class="header-icon" data-toggle="dropdown" title="You got 11 notifications">
                <i class="fal fa-bell"></i>
                <span class="badge badge-icon">11</span>
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-xl">
                <div
                    class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
                    <h4 class="m-0 text-center color-white">
                        11 New
                        <small class="mb-0 opacity-80">User Messages</small>
                    </h4>
                </div>
                <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-messages"
                            data-i18n="drpdwn.messages">Messages</a>
                    </li>
                </ul>
                <div class="tab-content tab-notification">
                    <div class="tab-pane p-3 text-center">
                        <h5 class="mt-4 pt-4 fw-500">
                            <small class="mt-3 fs-b fw-400 text-muted">
                                No new messages
                            </small>
                        </h5>
                    </div>
                    <div class="tab-pane active" id="tab-messages" role="tabpanel">
                        <div class="custom-scroll h-100">
                            <ul class="notification">
                                <li class="unread">
                                    <a href="#" class="d-flex align-items-center">
                                        <span class="status mr-2">
                                            <span class="profile-image rounded-circle d-inline-block"
                                                style="background-image:url('img/demo/avatars/avatar-c.png')"></span>
                                        </span>
                                        <span class="d-flex flex-column flex-1 ml-1">
                                            <span class="name">Melissa Ayre <span
                                                    class="badge badge-primary fw-n position-absolute pos-top pos-right mt-1">INBOX</span></span>
                                            <span class="msg-a fs-sm">Re: New security codes</span>
                                            <span class="msg-b fs-xs">Hello again and thanks for being
                                                part...</span>
                                            <span class="fs-nano text-muted mt-1">56 seconds ago</span>
                                        </span>
                                    </a>
                                </li>
                                <li class="unread">
                                    <a href="#" class="d-flex align-items-center">
                                        <span class="status mr-2">
                                            <span class="profile-image rounded-circle d-inline-block"
                                                style="background-image:url('img/demo/avatars/avatar-a.png')"></span>
                                        </span>
                                        <span class="d-flex flex-column flex-1 ml-1">
                                            <span class="name">Adison Lee</span>
                                            <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                            <span class="fs-nano text-muted mt-1">2 minutes ago</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex align-items-center">
                                        <span class="status status-success mr-2">
                                            <span class="profile-image rounded-circle d-inline-block"
                                                style="background-image:url('img/demo/avatars/avatar-b.png')"></span>
                                        </span>
                                        <span class="d-flex flex-column flex-1 ml-1">
                                            <span class="name">Oliver Kopyuv</span>
                                            <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                            <span class="fs-nano text-muted mt-1">3 days ago</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex align-items-center">
                                        <span class="status status-warning mr-2">
                                            <span class="profile-image rounded-circle d-inline-block"
                                                style="background-image:url('img/demo/avatars/avatar-e.png')"></span>
                                        </span>
                                        <span class="d-flex flex-column flex-1 ml-1">
                                            <span class="name">Dr. John Cook PhD</span>
                                            <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                            <span class="fs-nano text-muted mt-1">2 weeks ago</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex align-items-center">
                                        <span class="status status-success mr-2">
                                            <!-- <img src="img/demo/avatars/avatar-m.png" data-src="img/demo/avatars/avatar-h.png" class="profile-image rounded-circle" alt="Sarah McBrook" /> -->
                                            <span class="profile-image rounded-circle d-inline-block"
                                                style="background-image:url('img/demo/avatars/avatar-h.png')"></span>
                                        </span>
                                        <span class="d-flex flex-column flex-1 ml-1">
                                            <span class="name">Sarah McBrook</span>
                                            <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                            <span class="fs-nano text-muted mt-1">3 weeks ago</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex align-items-center">
                                        <span class="status status-success mr-2">
                                            <span class="profile-image rounded-circle d-inline-block"
                                                style="background-image:url('img/demo/avatars/avatar-m.png')"></span>
                                        </span>
                                        <span class="d-flex flex-column flex-1 ml-1">
                                            <span class="name">Anothony Bezyeth</span>
                                            <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                            <span class="fs-nano text-muted mt-1">one month ago</span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="d-flex align-items-center">
                                        <span class="status status-danger mr-2">
                                            <span class="profile-image rounded-circle d-inline-block"
                                                style="background-image:url('img/demo/avatars/avatar-j.png')"></span>
                                        </span>
                                        <span class="d-flex flex-column flex-1 ml-1">
                                            <span class="name">Lisa Hatchensen</span>
                                            <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                            <span class="fs-nano text-muted mt-1">one year ago</span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div
                    class="py-2 px-3 bg-faded d-block rounded-bottom text-right border-faded border-bottom-0 border-right-0 border-left-0">
                    <a href="#" class="fs-xs fw-500 ml-auto">view all notifications</a>
                </div>
            </div>
        </div>
        <!-- app user menu -->
        <div>
            <a href="#" data-toggle="dropdown" title="drlantern@gotbootstrap.com"
                class="header-icon d-flex align-items-center justify-content-center ml-2">
                <img src="../img/profile-pics/andy_reid.jpeg" class="profile-image rounded-circle"
                    alt="Dr. Codex Lantern">
                <!-- you can also add username next to the avatar with the codes below:
									<span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
									<i class="ni ni-chevron-down hidden-xs-down"></i> -->
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                        <span class="mr-2">
                            <img src="../img/profile-pics/andy_reid.jpeg" class="rounded-circle profile-image"
                                alt="Dr. Codex Lantern">
                        </span>
                        <div class="info-card-text">
                            <div class="fs-lg text-truncate text-truncate-lg">Coach Andy Reid</div>
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