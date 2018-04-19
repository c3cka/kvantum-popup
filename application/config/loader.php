<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 19.4.2018.
 * Time: 13:34
 */

use Phalcon\Loader;

$loader = new Loader();
$loader->registerDirs([
  $config->application->controllersDir,
  $config->application->modelsDir,
  $config->application->pluginsDir,
])->register();
