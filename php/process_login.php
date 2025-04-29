<?php
// process_login.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve data from POST request
  $username = isset($_POST['username']) ? trim($_POST['username']) : '';
  $password = isset($_POST['password']) ? trim($_POST['password']) : '';
  $accountType = isset($_POST['account_type']) ? trim($_POST['account_type']) : '';

  // Validate inputs
  if (empty($username) || empty($password) || empty($accountType)) {
    die('All fields are required.');
  }

  // Redirect based on account type
  switch (strtolower($accountType)) {
    case 'coach':
      header('Location: /nfl/coach/');
      break;
    case 'player':
      header('Location: /nfl/player/');
      break;
    default:
      die('Invalid account type.');
  }
  exit;
} else {
  die('Invalid request method.');
}
?>