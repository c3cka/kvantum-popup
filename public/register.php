<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 13.4.2018.
 * Time: 11:06
 */

require '../initialize.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//    if (!isset($_POST['username'])) {
//        echo 'Username must be entered';
//        return false;
//    }
    $id = uniqueId();
    $username = $_POST['username'];
    $password = 'sha1:' . sha1($_POST['password'] . '--' . $id);

    $result = $conn->prepare('INSERT INTO users (id, username, password) VALUES (:id, :username, :password)');
    if ($result->execute([
        'id' => $id,
        'username' => $username,
        'password' => $password,
    ])) echo 'SUCCESS!';
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
        <form class="form-signin" id="register" action="register.php" method="post">
            <label class="sr-only" for="username">Username</label>
            <input id="username" name="username" type="text" class="form-control" placeholder="Enter Username" required autofocus>
            <label class="sr-only" for="password">Password</label>
            <input id="password" name="password" class="form-control" type="password" placeholder="Enter Password" required>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
        </form>
    </body>
</html>
