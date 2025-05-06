<?php
if (!isset($_SESSION['role_id'])) {
    header('Location: /RBAC/PHP-mySQL-Project/login.php');
    exit;
}

// Debug line - remove after testing
error_log('Current role_id: ' . $_SESSION['role_id']);

// Select the appropriate aside based on role_id
switch ($_SESSION['role_id']) {
    case 1: // League Manager
        include __DIR__ . '/leaguemanager/left_aside.php';
        break;
    case 2:
        include __DIR__ . '/coach/left_aside.php';
        break;
    case 3:
        include __DIR__ . '/player/left_aside.php';
        break;
    case 4: // Statistician
        include __DIR__ . '/statistician/left_aside.php';
        break;
    case 5:
        include __DIR__ . '/fan/left_aside.php';
        break;
    default:
        include __DIR__ . '/default/left_aside.php';
        break;
}
?>