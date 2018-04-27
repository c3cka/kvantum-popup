<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="css/custom_datepicker.css">
    <link rel="stylesheet" href="css/fontawesome-all.css">
    <link rel="stylesheet" href="DataTables/datatables.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <script src="js/popper.js"></script>
    <script src="js/jquery-3.3.1.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/moment.js"></script>
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.min.js"></script>
    <script src="DataTables/datatables.min.js"></script>
    <script src="js/ellipsis.js"></script>
    <script src="js/bootbox.min.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="js/custom.js"></script>

    <title>Add popup</title>

  </head>

<?php

require '../initialize.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $image = '';
  // IMAGE UPLOAD START
  if (!empty($_FILES["image"]["name"])) {
    $uploadOk = 1;
    $targetDir = "uploads/";
    $imageName = basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
    $imageNameSanitized = az09(replaceCroatian(preg_replace('/\\.[^.\\s]{3,4}$/', '', $imageName)));
    $targetFile = $targetDir . time() . $imageNameSanitized . '.' . $imageFileType;

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
        $image = $targetFile;
      } else {
        echo 'There was an error';
      }
    }
    // IMAGE UPLOAD FINISH
  }

  $title = $_POST['title'];
  $description = $_POST['description'];
  //$image = $targetFile;
  $validFrom = strtotime($_POST['valid_from']);
  $validTo = strtotime($_POST['valid_to']);
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

  if ($result->execute()) {
    header("Location: administratePopup.php");
    echo '<div class="alert alert-success" role="alert">Popup added!</div>';
  }
} else { ?>
  <body>
    <div class="container">
      <h1>Add popup</h1>
      <form id="addPopup" action="addPopup.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label class="col-sm-2 control-label" for="description"><b>Description</b></label>
          <div class="col-sm-10">
            <textarea id="description" class="form-control" name="description" rows="10"
              cols="100"></textarea>
            <script>
              CKEDITOR.replace('description');
            </script>
          </div>
        </div>
        <div class="form-group ">
          <label class="col-sm-2 control-label" for="title"><b>Title</b></label>
          <div class="col-sm-10">
            <input id="title" class="form-control" type="text" name="title" required>
          </div>
          </div>
        <div class="form-group ">
          <label class="col-sm-2 control-label" for="image"><b>Image</b></label>
          <div class="col-sm-10">
            <input id="image" class="form-control" type="file" name="image" accept="image/*"
              onchange="preview_image(event)"><img id="output_image"/>
          </div>
        </div>
        <div class="form-group ">
          <label class="col-sm-2 control-label" for="datetimepickerfrom"><b>Valid from</b></label>
          <div class="col-sm-10 input-group date" id="datetimepickerfrom">
            <input id="valid_from" class="form-control" type="text" name="valid_from" required>
            <div class="input-group-append input-group-addon">
                  <span class="input-group-text">
                    <span class="fa fa-calendar-alt"></span>
                  </span>
            </div>
          </div>
        </div>
        <div class="form-group ">
          <label class="col-sm-2 control-label" for="datetimepickerto"><b>Valid to</b></label>
          <div class="col-sm-10 input-group date" id="datetimepickerto">
            <input id="valid_to" class="form-control" type="text" name="valid_to" required>
            <div class="input-group-append input-group-addon">
                  <span class="input-group-text">
                    <span class="fa fa-calendar-alt"></span>
                  </span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Save</button>
          <button type="reset" class="btn btn-danger">Reset</button>
          <a class="btn btn-primary" name="back" href="administratePopup.php">Back</a>
        </div>
      </form>
    </div>
  </body>
<?php } ?>
</html>
