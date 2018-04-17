<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 13.4.2018.
 * Time: 9:41
 */

// My local database connection
//  $host = "localhost";
//  $port = '3306';
//  $database = "kvantum_popup";
//  $username = "root";
//  $password = "";

// My VM database connection
$host = "localhost";
$port = '33060';
$database = "kvantum_manual";
$username = "homestead";
$password = "secret";

// kvantum_popup@172.20.20.6 database connection
//$host = "172.20.20.6";
//$port = '';
//$database = "kvantum_popup";
//$username = "pblu";
//$password = "pbl1234";

try {
  $conn = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo 'Connected successfully!';
  return $conn;
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}
