<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        NFL Dashboard
    </title>
    <meta name="description" content="Page Title">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-title" content="Page Title">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <!-- Mobile proof your site -->
    <link rel="manifest" href="media/data/manifest.json">
    <!-- Remove phone, date, address and email as default links -->
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="date=no">
    <meta name="format-detection" content="address=no">
    <meta name="format-detection" content="email=no">
    <meta name="theme-color" content="#37393e">
    <!-- iDevice splash screens -->
    <link href="img/splashscreens/iphone6_splash.png"
        media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)"
        rel="apple-touch-startup-image">
    <link href="img/splashscreens/iphoneplus_splash.png"
        media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)"
        rel="apple-touch-startup-image">
    <link href="img/splashscreens/iphonex_splash.png"
        media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)"
        rel="apple-touch-startup-image">
    <link href="img/splashscreens/iphonexr_splash.png"
        media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)"
        rel="apple-touch-startup-image">
    <link href="img/splashscreens/iphonexsmax_splash.png"
        media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)"
        rel="apple-touch-startup-image">
    <link href="img/splashscreens/ipad_splash.png"
        media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)"
        rel="apple-touch-startup-image">
    <link href="img/splashscreens/ipadpro1_splash.png"
        media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)"
        rel="apple-touch-startup-image">
    <link href="img/splashscreens/ipadpro3_splash.png"
        media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)"
        rel="apple-touch-startup-image">
    <link href="img/splashscreens/ipadpro2_splash.png"
        media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)"
        rel="apple-touch-startup-image">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no">
    <!-- base css -->
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="../css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="../css/app.bundle.css">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
    <link id="myskin" rel="stylesheet" media="screen, print" href="../css/skins/skin-master.css">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="../img/favicon/safari-pinned-tab.svg" color="#5bbad5">
</head>

<body class="mod-bg-1 ">
    <!-- DOC: script to save and load page settings -->
    <script>
        'use strict';

        var htmlRoot = document.getElementsByTagName('HTML')[0],
            classHolder = document.getElementsByTagName('BODY')[0],
            head = document.getElementsByTagName('HEAD')[0],
            themeID = document.getElementById('mytheme'),
            filterClass = function (t, e) {
                return String(t).split(/[^\w-]+/).filter(function (t) {
                    return e.test(t)
                }).join(' ')
            },
            /** 
             * Load theme options
             **/
            loadSettings = function () {
                var t = localStorage.getItem('themeSettings') || '',
                    e = t ? JSON.parse(t) :
                        {};
                return Object.assign(
                    {
                        htmlRoot: '',
                        classHolder: '',
                        themeURL: ''
                    }, e)
            },
            /** 
             * Save to localstorage 
             **/
            saveSettings = function () {
                themeSettings.htmlRoot = filterClass(htmlRoot.className, /^(root)-/i),
                    themeSettings.classHolder = filterClass(classHolder.className, /^(nav|header|footer|mod|display)-/i),
                    themeSettings.themeURL = themeID.getAttribute("href") ? themeID.getAttribute("href") : "",
                    localStorage.setItem("themeSettings", JSON.stringify(themeSettings))
            },
            /** 
             * Reset settings
             **/
            resetSettings = function () {
                localStorage.setItem("themeSettings", "")
            },
            themeSettings = loadSettings();

        themeID || ((themeID = document.createElement('link')).id = 'mytheme',
            themeID.rel = 'stylesheet',
            themeID.href = '',
            head.appendChild(themeID),
            themeID = document.getElementById('mytheme')),
            themeSettings.htmlRoot && (htmlRoot.className = themeSettings.htmlRoot),
            themeSettings.classHolder && (classHolder.className = themeSettings.classHolder),
            themeSettings.themeURL && themeID.setAttribute("href", themeSettings.themeURL);

    </script>
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- BEGIN Left Aside -->
            <aside class="page-sidebar">
                <div class="page-logo">
                    <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
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
                    <div class="info-card">
                        <img src="../img/profile-pics/andy_reid.jpeg" class="profile-image rounded-circle"
                            alt="Dr. Codex Lantern">
                        <div class="info-card-text">
                            <a href="#" class="d-flex align-items-center text-white">
                                <span class="text-truncate text-truncate-sm d-inline-block">
                                    Andy Reid
                                </span>
                            </a>
                            <span class="d-inline-block text-truncate text-truncate-sm">Coach</span>
                        </div>
                        <img src="../img/card-backgrounds/cover-2-lg.png" class="cover" alt="cover">
                        <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle"
                            data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                            <i class="fal fa-angle-down"></i>
                        </a>
                    </div>
                    <ul id="js-nav-menu" class="nav-menu">
                        <li class="">
                            <a href="home.php" title="Home" data-filter-tags="home">
                                <i class="fal fa-globe"></i>
                                <span class="nav-link-text" data-i18n="nav.home">Home</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="players.php" title="Players" data-filter-tags="players">
                                <i class="fal fa-globe"></i>
                                <span class="nav-link-text" data-i18n="nav.players">Players</span>
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
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <header class="page-header" role="banner">
                    <!-- we need this logo when user switches to nav-function-top -->
                    <div class="page-logo">
                        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
                            data-toggle="modal" data-target="#modal-shortcut">
                            <img src="../img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">SmartAdmin WebApp</span>
                            <span
                                class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2">SLIM
                                Project</span>
                        </a>
                    </div>
                    <!-- DOC: mobile button appears during mobile width -->
                    <div class="hidden-lg-up">
                        <a href="#" class="header-btn btn press-scale-down" data-action="toggle"
                            data-class="mobile-nav-on">
                            <i class="ni ni-menu"></i>
                        </a>
                    </div>
                    <div class="search">
                        <form class="app-forms hidden-xs-down" role="search" action="page_search.html"
                            autocomplete="off">
                            <input type="text" id="search-field" placeholder="Search for anything" class="form-control"
                                tabindex="1">
                            <a href="#" onclick="return false;" class="btn-danger btn-search-close js-waves-off d-none"
                                data-action="toggle" data-class="mobile-search-on">
                                <i class="fal fa-times"></i>
                            </a>
                        </form>
                    </div>
                    <div class="ml-auto d-flex">
                        <!-- activate app search icon (mobile) -->
                        <div class="hidden-sm-up">
                            <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on"
                                data-focus="search-field" title="Search">
                                <i class="fal fa-search"></i>
                            </a>
                        </div>
                        <!-- app darkmode -->
                        <div class="hidden-md-down" id="mode-d" data-toggle="tooltip" data-placement="bottom"
                            data-original-title="Switch to DarkMode" data-trigger="hover">
                            <a href="#" class="header-icon" onClick="layouts.mode('dark');">
                                <svg style="font-size:17px" data-fa-symbol="delete" class="fa-adjust fa-w-16 fa-fw"
                                    aria-hidden="true" data-prefix="fal" data-icon="adjust" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""
                                    id="delete">
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
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""
                                    id="delete">
                                    <path fill="currentColor"
                                        d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                        <div class="hidden-md-down" id="mode-n" data-toggle="tooltip" data-placement="bottom"
                            data-original-title="Switch to Default" data-trigger="hover">
                            <a href="#" class="header-icon" onClick="layouts.mode('default');">
                                <svg style="font-size:17px" data-fa-symbol="normal-mode" class="fa-circle fa-w-16 fa-fw"
                                    aria-hidden="true" data-prefix="fal" data-icon="circle" role="img"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg=""
                                    id="delete">
                                    <path fill="currentColor"
                                        d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm216 248c0 118.7-96.1 216-216 216-118.7 0-216-96.1-216-216 0-118.7 96.1-216 216-216 118.7 0 216 96.1 216 216z">
                                    </path>
                                </svg>
                            </a>
                        </div>
                        <!-- app shortcuts -->
                        <div data-toggle="tooltip" data-placement="bottom" data-original-title="App Shortcuts"
                            data-trigger="hover">
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
                                            <a href="#" class="app-list-item hover-white">
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
                                            <a href="#" class="app-list-item hover-white">
                                                <span class="icon-stack">
                                                    <i class="base-18 icon-stack-3x color-info-700"></i>
                                                    <span
                                                        class="position-absolute pos-top pos-left pos-right color-white fs-md mt-2 fw-400">28</span>
                                                </span>
                                                <span class="app-list-name">
                                                    Calendar
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
                        <div data-toggle="tooltip" data-placement="bottom" data-original-title="Notifications"
                            data-trigger="hover">
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
                                        <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab"
                                            href="#tab-messages" data-i18n="drpdwn.messages">Messages</a>
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
                                            <img src="../img/profile-pics/andy_reid.jpeg"
                                                class="rounded-circle profile-image" alt="Dr. Codex Lantern">
                                        </span>
                                        <div class="info-card-text">
                                            <div class="fs-lg text-truncate text-truncate-lg">Coach Andy Reid</div>
                                            <span
                                                class="text-truncate text-truncate-md opacity-80">andy@kansascity.com</span>
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
                <!-- END Page Header -->
                <!-- BEGIN Page Content -->
                <!-- the #js-page-content id is needed for some plugins to initialize -->
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
                            <i class='subheader-icon fal fa-plus-circle'></i> Players
                            <small>
                                Manage and view player details
                            </small>
                        </h1>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="border-faded bg-faded p-3 mb-g d-flex">
                                <input type="text" id="js-filter-contacts" name="filter-contacts"
                                    class="form-control shadow-inset-2 form-control-lg" placeholder="Filter players ">
                                <div class="btn-group btn-group-lg btn-group-toggle hidden-lg-down ml-3"
                                    data-toggle="buttons">
                                    <label class="btn btn-default active">
                                        <input type="radio" name="contactview" id="grid" checked="" value="grid"><i
                                            class="fas fa-table"></i>
                                    </label>
                                    <label class="btn btn-default">
                                        <input type="radio" name="contactview" id="table" value="table"><i
                                            class="fas fa-th-list"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="js-contacts">
                        <?php
                        for ($i = 1; $i <= 10; $i++) {
                            ?>
                            <div class="col-xl-4">
                                <div id="c_<?php echo $i; ?>" class="card border shadow-0 mb-g shadow-sm-hover"
                                    data-filter-tags="player_<?php echo $i; ?>">
                                    <div
                                        class="card-body border-faded border-top-0 border-left-0 border-right-0 rounded-top">
                                        <div class="d-flex flex-row align-items-center">
                                            <span class="status status-success mr-3">
                                                <span class="rounded-circle profile-image d-block "
                                                    style="background-image:url('../img/demo/avatars/avatar-b.png'); background-size: cover;"></span>
                                            </span>
                                            <div class="info-card-text flex-1">
                                                <a href="javascript:void(0);"
                                                    class="fs-xl text-truncate text-truncate-lg text-info"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    Player <?php echo $i; ?>
                                                    <i class="fal fa-angle-down d-inline-block ml-1 fs-md"></i>
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Send Email</a>
                                                    <a class="dropdown-item" href="#">Add to next game</a>
                                                    <a class="dropdown-item" href="#">Drop player</a>
                                                </div>
                                                <span class="text-truncate text-truncate-xl">Position <?php echo $i; ?></span>
                                            </div>
                                            <button class="js-expand-btn btn btn-sm btn-default d-none"
                                                data-toggle="collapse" data-target="#c_<?php echo $i; ?> > .card-body + .card-body"
                                                aria-expanded="false">
                                                <span class="collapsed-hidden">+</span>
                                                <span class="collapsed-reveal">-</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body p-0 collapse show">
                                        <div class="p-3">
                                            <a href="tel:+13174562564" class="mt-1 d-block fs-sm fw-400 text-dark">
                                                <i class="fas fa-mobile-alt text-muted mr-2"></i> +1 317-456-2564</a>
                                            <a href="mailto:player<?php echo $i; ?>@nfldashboard.com"
                                                class="mt-1 d-block fs-sm fw-400 text-dark">
                                                <i class="fas fa-mouse-pointer text-muted mr-2"></i>
                                                player<?php echo $i; ?>@nfldashboard.com</a>
                                            <address class="fs-sm fw-400 mt-4 text-muted">
                                                <i class="fas fa-map-pin mr-2"></i> Address <?php echo $i; ?>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                <footer class="page-footer" role="contentinfo">
                    <div class="d-flex align-items-center flex-1 text-muted">
                        <span class="hidden-md-down fw-700">2025 © NFL Dashboard</span>
                    </div>
                    <div>
                        <ul class="list-table m-0">
                        </ul>
                    </div>
                </footer>
                <!-- END Page Footer -->
                <!-- BEGIN Color profile -->
                <!-- this area is hidden and will not be seen on screens or screen readers -->
                <!-- we use this only for CSS color refernce for JS stuff -->
                <p id="js-color-profile" class="d-none">
                    <span class="color-primary-50"></span>
                    <span class="color-primary-100"></span>
                    <span class="color-primary-200"></span>
                    <span class="color-primary-300"></span>
                    <span class="color-primary-400"></span>
                    <span class="color-primary-500"></span>
                    <span class="color-primary-600"></span>
                    <span class="color-primary-700"></span>
                    <span class="color-primary-800"></span>
                    <span class="color-primary-900"></span>
                    <span class="color-info-50"></span>
                    <span class="color-info-100"></span>
                    <span class="color-info-200"></span>
                    <span class="color-info-300"></span>
                    <span class="color-info-400"></span>
                    <span class="color-info-500"></span>
                    <span class="color-info-600"></span>
                    <span class="color-info-700"></span>
                    <span class="color-info-800"></span>
                    <span class="color-info-900"></span>
                    <span class="color-danger-50"></span>
                    <span class="color-danger-100"></span>
                    <span class="color-danger-200"></span>
                    <span class="color-danger-300"></span>
                    <span class="color-danger-400"></span>
                    <span class="color-danger-500"></span>
                    <span class="color-danger-600"></span>
                    <span class="color-danger-700"></span>
                    <span class="color-danger-800"></span>
                    <span class="color-danger-900"></span>
                    <span class="color-warning-50"></span>
                    <span class="color-warning-100"></span>
                    <span class="color-warning-200"></span>
                    <span class="color-warning-300"></span>
                    <span class="color-warning-400"></span>
                    <span class="color-warning-500"></span>
                    <span class="color-warning-600"></span>
                    <span class="color-warning-700"></span>
                    <span class="color-warning-800"></span>
                    <span class="color-warning-900"></span>
                    <span class="color-success-50"></span>
                    <span class="color-success-100"></span>
                    <span class="color-success-200"></span>
                    <span class="color-success-300"></span>
                    <span class="color-success-400"></span>
                    <span class="color-success-500"></span>
                    <span class="color-success-600"></span>
                    <span class="color-success-700"></span>
                    <span class="color-success-800"></span>
                    <span class="color-success-900"></span>
                    <span class="color-fusion-50"></span>
                    <span class="color-fusion-100"></span>
                    <span class="color-fusion-200"></span>
                    <span class="color-fusion-300"></span>
                    <span class="color-fusion-400"></span>
                    <span class="color-fusion-500"></span>
                    <span class="color-fusion-600"></span>
                    <span class="color-fusion-700"></span>
                    <span class="color-fusion-800"></span>
                    <span class="color-fusion-900"></span>
                </p>
                <!-- END Color profile -->
            </div>
        </div>
    </div>
    <!-- END Page Wrapper -->
    <!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
    <script src="../js/vendors.bundle.js"></script>
    <script src="../js/app.bundle.js"></script>
    <!--This page contains the basic JS and CSS files to get started on your project. If you need aditional addon's or plugins please see scripts located at the bottom of each page in order to find out which JS/CSS files to add.-->
</body>
<!-- END Body -->

</html>