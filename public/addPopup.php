<?php

require '../initialize.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  // IMAGE UPLOAD START
  $targetDir = "uploads/";
  $imageName = basename($_FILES["image"]["name"]);
  $targetFile = $targetDir . $imageName;
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  if (!file_exists($targetDir)) {
    @mkdir($targetDir);
  }

  if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check != false) {
      echo 'File is an image - ' . $check["mime"] . '.';
      $uploadOk = 1;
    } else {
      echo 'File not image';
      $uploadOk = 0;
    }
  }

  if (file_exists($targetFile)) {
    echo 'Sorry, file exists';
    $uploadOk = 0;
  }

  if ($_FILES["image"]["size"] > 5000000) {
    echo 'Image too large';
    $uploadOk = 0;
  }

  if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
    echo 'Invalid format. JPG, JPEG, PNG and GIF allowed';
    $uploadOk = 0;
  }

  if ($uploadOk == 0) {
    echo 'Image not uploaded';
  } else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
      echo 'Image ' . basename($_FILES["image"]["name"]) . ' has been uploaded.';
//      $imageId = uniqueId();
//      $query = $conn->prepare('INSERT INTO image (id, title) VALUES (:id, :title)');
//      $query->execute([
//        'id' => $imageId,
//        'title' => $imageHash
//      ]);
    } else {
      echo 'There was an error';
    }
  }
  // IMAGE UPLOAD FINISH
  $output = '';
  $message = '';

  $title = $_POST['title'];
  $description = $_POST['description'];

  $image = $imageName;

  $validFrom = strtotime($_POST['valid_from']);
  $validTo = strtotime($_POST['valid_to']);

  if (isset($_POST['popup_id']) && $_POST['insert'] == 'Update') {
    $id = $_POST['popup_id'];
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
    $id = uniqueId();

    $result = $conn->prepare('INSERT INTO popup (id, title, description, image, valid_from, valid_to) 
    VALUES (:id, :title, :description, :image, :valid_from, :valid_to)');
    $result->bindParam('id', $id);
    $result->bindParam('title', $title);
    $result->bindParam('image', $image);
    $result->bindParam('description', $description);
    $result->bindParam('valid_from', $validFrom);
    $result->bindParam('valid_to', $validTo);

    $message = 'Popup added!';
  }
  if ($result->execute()) {
    header("Location: administratePopup.php");
    echo '<label class="text-success">' . $message . '</label>';
  }
}
