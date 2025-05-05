<?php
// process_login.php

session_start();
require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve data from POST request
  $username = isset($_POST['username']) ? trim($_POST['username']) : '';
  $password = isset($_POST['password']) ? trim($_POST['password']) : '';

  // Validate inputs
  if (empty($username) || empty($password)) {
    die('All fields are required.');
  }

  // Fetch user and role from DB
  $stmt = $pdo->prepare('SELECT u.user_id, u.username, u.password_hash, u.role_id, r.role_name FROM users u JOIN roles r ON u.role_id = r.role_id WHERE u.username = ? LIMIT 1');
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if (!$user || !password_verify($password, $user['password_hash'])) {
    die('Invalid username or password.');
  }

  // Set session variables
  $_SESSION['user_id'] = $user['user_id'];
  $_SESSION['username'] = $user['username'];
  $_SESSION['role_id'] = $user['role_id'];
  $_SESSION['role_name'] = $user['role_name'];

  // Redirect based on role_id
  switch ((int)$user['role_id']) {
    case 1: // League Manager
      header('Location: /RBAC/PHP-mySQL-Project/leaguemanager/');
      break;
    case 2: // Coach
      header('Location: /nfl/coach/');
      break;
    case 3: // Player
      header('Location: /nfl/player/');
      break;
    case 4: // Statistician
      header('Location: /RBAC/PHP-mySQL-Project/statistician/');
      break;
    case 5: // Fan
      header('Location: /nfl/fan/');
      break;
    default:
      die('Invalid account type.');
  }
  exit;
} else {
  die('Invalid request method.');
}
?>