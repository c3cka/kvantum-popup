<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 13.4.2018.
 * Time: 11:06
 */

require '../initialize.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!isset($_POST['username'])) {
    echo 'Username must be entered';
    return false;
  }
  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = $conn->prepare('SELECT * FROM users WHERE username = :username');
  $result->execute(['username' => $username]);
  $user = $result->fetch(PDO::FETCH_ASSOC);

  if ($username != $user['username'] || 'sha1:' . sha1($password . '--' . $user['id']) != $user['password']) {
    echo 'Invalid username or password';
    exit;
  }
  else {
    echo 'Successfully logged in';
    $_SESSION['id'] = $user['id'];
    exit;
  }

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>

  <body class="text-center">
    <form class="form-signin" id="login" action="login.php" method="post">
        <label class="sr-only" for="username">Username</label>
        <input id="username" type="text" class="form-control" placeholder="Enter Username" required autofocus>
        <label class="sr-only" for="password">Password</label>
        <input id="password" class="form-control" type="password" placeholder="Enter Password" required>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
    </form>
  </body>
</html>
