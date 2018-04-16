<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 16.4.2018.
 * Time: 10:19
 */

class User extends Phalcon\Mvc\Model {

  protected $id = '';
  protected $username = '';
  protected $password = '';

  function onConstruct () {
    $this->id = uniqueId();
  }

  static function isActive () {
    return isset($_SESSION['id']);
  }

}
