<?php
// process_login.php

session_start();
require_once __DIR__ . '/../config/db.php';

if (!isset($pdo)) {
    die('Database connection not available.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // retrieve data from post request
  $username = isset($_POST['username']) ? trim($_POST['username']) : '';
  $password = isset($_POST['password']) ? trim($_POST['password']) : '';

  // input validation
  if (empty($username) || empty($password)) {
    die('All fields are required.');
  }

  // fetch user and role from db
  $stmt = $pdo->prepare('SELECT u.user_id, u.username, u.password_hash, u.role_id, r.role_name FROM users u JOIN roles r ON u.role_id = r.role_id WHERE u.username = ? LIMIT 1');
  if (!$stmt) {
    die('Database error: Failed to prepare statement');
  }
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if (!$user || !password_verify($password, $user['password_hash'])) {
    die('Invalid username or password.');
  }

  // session variables
  $_SESSION['user_id'] = $user['user_id'];
  $_SESSION['username'] = $user['username'];
  $_SESSION['role_id'] = $user['role_id'];
  $_SESSION['role_name'] = $user['role_name'];

  // redirect to main
  header('Location: /RBAC/PHP-mySQL-Project/main/');
  exit;
} else {
  die('Invalid request method.');
}
?>