<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 13.4.2018.
 * Time: 9:55
 */

//phpinfo();
//$baseUrl = 'kvantum-manual.local/';
define('APP_PATH', '../');

require APP_PATH.'application/config/db.php';
require APP_PATH.'library/functions.php';

// CONNECTION TEST
//$stmt = $conn->query('SELECT * FROM users');
//while ($row = $stmt->fetch()) {
//  echo $row['username'] . "\n";
//}

// FUNCTIONS TEST
//echo generateStrongPassword();

// Simple redirect
//header('Location: http://' . $baseUrl . 'login.php');
