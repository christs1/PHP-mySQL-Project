<?php
$host = 'localhost';
$db   = 'nfl_management';
$charset = 'utf8mb4';

// Development mode - set to false in production
$dev_mode = true;

// Start with root connection for development
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    
    // If user is logged in, get their role-based permissions
    if (isset($_SESSION['user_id']) && isset($_SESSION['role_id'])) {
        $stmt = $pdo->prepare('
            SELECT u.username, u.password_hash 
            FROM users u 
            WHERE u.user_id = ? AND u.role_id = ?
        ');
        $stmt->execute([$_SESSION['user_id'], $_SESSION['role_id']]);
        $user_creds = $stmt->fetch();
        
        if ($user_creds) {
            // Store credentials for future connections
            $_SESSION['db_user'] = $user_creds['username'];
            $_SESSION['db_pass'] = $user_creds['password_hash'];
        }
    }
} catch (PDOException $e) {
    if ($dev_mode) {
        die('Database connection failed: ' . $e->getMessage());
    } else {
        error_log('Database connection failed: ' . $e->getMessage());
        die('Database connection failed. Please try again later.');
    }
}
?>
