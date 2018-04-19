<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 13.4.2018.
 * Time: 9:30
 */

defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/application');

return new Phalcon\Config ([
  'database' => [
    'adapter' => 'Mysql',
    'host' => 'localhost',
    'port' => 33060,
    'username' => 'homestead',
    'password' => 'secret',
    'name' => 'kvantum_popup',
  ],
  'application' => [
    'appDir' => APP_PATH . '/',
    'controllersDir' => APP_PATH . '/controller/',
    'modelsDir' => APP_PATH . '/model/',
    'migrationsDir' => APP_PATH . '/migrations/',
    'viewsDir' => APP_PATH . '/view/',
    'pluginsDir' => BASE_PATH . '/plugins/',
    'libraryDir' => BASE_PATH . '/library/',
    'cacheDir' => BASE_PATH . '/cache/',

    'baseUri' => preg_replace('/public([\/\\\\])index.php$/', '', $_SERVER['PHP_SELF']),
  ],
]);
