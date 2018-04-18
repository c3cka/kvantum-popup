<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 18.4.2018.
 * Time: 9:31
 */

class UserController extends \Phalcon\Mvc\Controller {

  function indexAction () {
  }

  function loginAction () {
  }

  function registerAction () {
    $user = new User();

    $success = $user->save(
      $this->request->getPost(),
      [
        'username',
        'password',
      ]
    );

    if ($success) {
      echo 'Thanks for registering';
    } else {
      echo 'Problems: ';
      $messages = $user->getMessages();
      foreach ($messages as $message) {
        echo $message->getMessage(), "<br/>";
      }
    }
    $this->view->disable();
  }
}
