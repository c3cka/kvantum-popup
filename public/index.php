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

use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\Application;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/application');

$loader = new Loader();
$loader->registerDirs([
  APP_PATH . '/controller/',
  APP_PATH . '/model/',
]);
$loader->register();

$di = new FactoryDefault();

$di->set(
  'view',
  function () {
    $view = new View();
    $view->setViewsDir(APP_PATH . '/view/');
    return $view;
  }
);

$di->set(
  'url',
  function () {
    $url = new UrlProvider();
    $url->setBaseUri('/');
    return $url;
  }
);

$di->set(
  'db',
  function () {
    return new DbAdapter([
      'host' => 'localhost',
      'port' => '33060',
      'username' => 'homestead',
      'password' => 'secret',
      'dbname' => 'kvantum_manual',
    ]);
  }
);

$application = new Application($di);

try {
  $response = $application->handle();
  $response->send();
} catch (\Exception $e) {
  echo 'Exception: ' , $e->getMessage();
}
