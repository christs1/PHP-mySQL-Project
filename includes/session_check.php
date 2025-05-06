<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role_id'])) {
    header('Location: /RBAC/PHP-mySQL-Project/login.php');
    exit;
}
?>