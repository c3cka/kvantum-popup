<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 13.4.2018.
 * Time: 9:30
 */

return new Phalcon\Config ([
  'database' => [
    'adapter' => 'Mysql',
    'host' => 'localhost',
    'username' => 'homestead',
    'password' => 'secret',
    'name' => 'kvantum_popup',
  ],
  'application' => [
    'controllersDir' => __DIR__ . '/../../application/controller/',
  ],
]);
