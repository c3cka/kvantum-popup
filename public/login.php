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
<style>
  <?php include 'css/login.css'?>
</style>
<form id="login" action="login.php" method="post">

  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" required><br>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required><br>

    <button type="submit">Login</button>
  </div>

</form>
