
<?php
session_start();
require_once __DIR__ . '/../config/db.php';

//this file is just for those who havent created an account yet to view the web page

session_unset();
session_destroy();
session_start();

$stmt = $pdo->prepare('SELECT u.user_id, u.username, u.role_id, r.role_name 
                       FROM users u 
                       JOIN roles r ON u.role_id = r.role_id 
                       WHERE u.user_id = ? AND u.role_id = 5 
                       LIMIT 1');
$stmt->execute([12]);
$user = $stmt->fetch();

if ($user) {
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role_id'] = $user['role_id'];
    $_SESSION['role_name'] = $user['role_name'];
}

// Redirect to dashboard
header('Location: /RBAC/PHP-mySQL-Project/main/dashboard.php');
exit;
?>