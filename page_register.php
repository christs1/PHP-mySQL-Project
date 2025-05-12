<?php
require_once __DIR__ . '/config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstName = trim($_POST['fname']);
    $lastName = trim($_POST['lname']);
    $username = trim($_POST['username']); // New username field
    $email = trim($_POST['emailverify']);
    $password = $_POST['userpassword'];
    
    // Hash password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    try {
        // Insert new user
        $sql = "INSERT INTO users (role_id, username, email, password_hash, first_name, last_name, is_active) 
                VALUES (5, :username, :email, :password_hash, :first_name, :last_name, 1)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':username' => $username, // Now using separate username
            ':email' => $email,
            ':password_hash' => $passwordHash,
            ':first_name' => $firstName,
            ':last_name' => $lastName
        ]);
        
        // Redirect to confirmation page
        header('Location: page_confirmation.php');
        exit;
    } catch (PDOException $e) {
        $error = "Registration failed. Please try again.";
        if ($e->getCode() == 23000) {
            // Check which unique constraint was violated
            if (strpos($e->getMessage(), 'username') !== false) {
                $error = "Username already taken.";
            } else if (strpos($e->getMessage(), 'email') !== false) {
                $error = "Email already registered.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Register | NFL Dashboard
    </title>
    <meta name="description" content="Login">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <!-- Call App Mode on ios devices -->
    <meta name="apple-mobile-web-app-title" content="Login">
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
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
    <!-- Place favicon.ico in the root directory -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
</head>
<body>
    <div class="page-wrapper auth">
        <div class="page-inner bg-brand-gradient">
            <div class="page-content-wrapper bg-transparent m-0">
                <?php
                    include_once 'templates/partials/signup_header.php';
                ?>
                <div class="flex-1"
                    style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                    <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                        <div class="row">
                            <div class="col-xl-12">
                                <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
                                    Register now
                                    <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60 hidden-sm-down">
                                        Join the NFL Dashboard today and stay updated with the latest stats, news, and game schedules.
                                        <br>Access it anytime, anywhere on your mobile, desktop, or tablet!
                                    </small>
                                </h2>
                            </div>
                            <div class="col-xl-6 ml-auto mr-auto">
                                <div class="card p-4 rounded-plus bg-faded">
                                    <?php if (isset($error)): ?>
                                        <div class="alert alert-danger">
                                            <?php echo htmlspecialchars($error); ?>
                                        </div>
                                    <?php endif; ?>
                                    <form id="js-login" novalidate="" method="POST">
                                        <div class="form-group row">
                                            <label class="col-xl-12 form-label" for="fname">Your first and last name</label>
                                            <div class="col-6 pr-1">
                                                <input type="text" id="fname" name="fname" class="form-control"
                                                    placeholder="First Name" required>
                                                <div class="invalid-feedback">Please enter your first name.</div>
                                            </div>
                                            <div class="col-6 pl-1">
                                                <input type="text" id="lname" name="lname" class="form-control"
                                                    placeholder="Last Name" required>
                                                <div class="invalid-feedback">Please enter your last name.</div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="username">Choose a username</label>
                                            <input type="text" id="username" name="username" class="form-control"
                                                placeholder="Username" required>
                                            <div class="invalid-feedback">Username must be at least 8 characters long.</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="emailverify">Email will be needed for
                                                verification and account recovery</label>
                                            <input type="email" id="emailverify" name="emailverify" class="form-control"
                                                placeholder="Email for verification" required>
                                            <div class="invalid-feedback">Please enter a valid email.</div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="userpassword">Pick a password:</label>
                                            <input type="password" id="userpassword" name="userpassword" class="form-control"
                                                placeholder="minimum 8 characters" required>
                                            <div class="invalid-feedback">Sorry, you missed this one.</div>
                                            <div class="help-block">Your password must be 8-20 characters long, contain
                                                letters and numbers.</div>
                                        </div>
                                        <div class="form-group demo">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="terms" required>
                                                <label class="custom-control-label" for="terms">I agree to terms &
                                                    conditions</label>
                                                <div class="invalid-feedback">You must agree before proceeding</div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col-md-4 ml-auto text-right">
                                                <button id="js-login-btn" type="submit"
                                                    class="btn btn-block btn-danger btn-lg mt-3">Register</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                        2025 © NFL Dashboard
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/vendors.bundle.js"></script>
    <script src="js/app.bundle.js"></script>
    <script>
        // Client-side validation
        document.getElementById('js-login').addEventListener('submit', function(e) {
            let isValid = true;
            const username = document.getElementById('username').value;
            const password = document.getElementById('userpassword').value;
            
            // Reset previous error states
            document.getElementById('username').classList.remove('is-invalid');
            document.getElementById('userpassword').classList.remove('is-invalid');
            
            // Username validation
            if (username.length < 8 || !/^[a-zA-Z0-9_]+$/.test(username)) {
                document.getElementById('username').classList.add('is-invalid');
                isValid = false;
            }
            
            // Password validation
            if (password.length < 8 || 
                !/[0-9]/.test(password) || 
                !/[!@#$%^&*()\-_=+{};:,<.>]/.test(password)) {
                document.getElementById('userpassword').classList.add('is-invalid');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    </script>
    <?php include 'templates/partials/all_accounts/js_imports.php'; ?>
</body>

</html>