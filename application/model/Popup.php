<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 18.4.2018.
 * Time: 9:08
 */

class Popup extends \Phalcon\Mvc\Model {

  protected $id = '';
  protected $title = '';
  protected $description = '';
  protected $image = '';
  protected $validFrom = '';
  protected $validTo = '';

  function onConstruct () {
    $this->id = uniqueId();
  }



}
