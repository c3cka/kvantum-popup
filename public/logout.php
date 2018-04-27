<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 27.4.2018.
 * Time: 10:35
 */
session_start();

if (isset($_SESSION['market_id'])) {
  $_SESSION = [];
  session_destroy();
}
header('Location: index.php');
