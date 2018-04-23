<?php

require '../initialize.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $output = '';
  $message = '';

  $id = uniqueId();
  $title = $_POST['title'];
  $description = $_POST['description'];

  // TODO Change when image upload implemented
  $image = uniqueId();

  $validFrom = strtotime($_POST['valid_from']);
  $validTo = strtotime($_POST['valid_to']);

  if ($_POST['popup_id'] != '') {
    $result = $conn->prepare('UPDATE popup 
    SET title=:title, description=:description, image=:image, valid_from=:valid_from, valid_to=:valid_to
    WHERE id=:id');
    $result->bindParam('title', $title);
    $result->bindParam('description', $description);
    $result->bindParam('image', $image);
    $result->bindParam('valid_from', $validFrom);
    $result->bindParam('valid_to', $validTo);
    $result->bindParam('id', $id);

    $message = 'Popup updated!';
  } else {
    $result = $conn->prepare('INSERT INTO popup (id, title, description, image, valid_from, valid_to) 
    VALUES (:id, :title, :description, :image, :valid_from, :valid_to)');
    $result->bindParam(':id', $id);
    $result->bindParam(':title', $title);
    $result->bindParam('image', $image);
    $result->bindParam(':description', $description);
    $result->bindParam(':valid_from', $validFrom);
    $result->bindParam(':valid_to', $validTo);

    $message = 'Popup added!';
  }
  if ($result->execute()) {
    header("Location: administratePopup.php");
    echo '<label class="text-success">' . $message . '</label>';
  }
}
