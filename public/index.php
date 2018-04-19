<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 13.4.2018.
 * Time: 9:55
 */

//phpinfo();
//$baseUrl = 'kvantum-manual.local/';

//require '../initialize.php';

// CONNECTION TEST
//$stmt = $conn->query('SELECT * FROM users');
//while ($row = $stmt->fetch()) {
//  echo $row['username'] . "\n";
//}

// FUNCTIONS TEST
//echo generateStrongPassword();

// Simple redirect
//header('Location: http://' . $baseUrl . 'login.php');

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;
use Phalcon\Debug as Debug;

error_reporting(E_ALL);

$debug = new Debug();
$debug->listen();

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/application');

$di = new FactoryDefault();
include APP_PATH . '/config/router.php';
include APP_PATH . '/config/services.php';
$config = $di->getConfig();
include APP_PATH . '/config/loader.php';
include BASE_PATH . '/vendor/autoload.php';

$application = new Application($di);

try {
  $response = $application->handle();
  $response->send();
} catch (\Exception $e) {
  echo 'Exception: ' , $e->getMessage();
}
