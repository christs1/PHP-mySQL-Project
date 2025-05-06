<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Allow guest access - set guest session if not logged in
if (!isset($_SESSION['role_id'])) {
    if (strpos($_SERVER['REQUEST_URI'], '/main/') !== false) {
        // Set guest session for fan view
        $_SESSION['role_id'] = 5; // Fan role ID
        $_SESSION['username'] = 'guest';
        $_SESSION['is_guest'] = true;
    } else {
        header('Location: /RBAC/PHP-mySQL-Project/login.php');
        exit;
    }
}
?>