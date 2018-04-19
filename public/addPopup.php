<head>
  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <link rel="stylesheet" href="css/bootstrap.css" />
  <script src="js/jquery-3.3.1.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/datepicker.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/bootstrap-datetimepicker.min.js"></script>
  <script src="css/bootstrap-datetimepicker.css"></script>
  <!--  <script src="js/datetimepicker-master/jquery.js"></script>-->
</head>

<?php

require '../initialize.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = uniqueId();
  $title = $_POST['title'];
  $description = $_POST['description'];

  $image = uniqueId();

  $validFrom = strtotime($_POST['valid_from']);
  $validTo = strtotime($_POST['valid_to']);

  //echo $title . '<br>' . $description . '<br>' . $validFrom . '<br>' . $validTo;

  $result = $conn->prepare('INSERT INTO popup (id, title, description, image, valid_from, valid_to) VALUES (:id, :title, :description, 
:image, :valid_from, :valid_to)');
  if ($result->execute([
    'id' => $id,
    'title' => $title,
    'description' => $description,
    'image' => $image,
    'valid_from' => $validFrom,
    'valid_to' => $validTo,
  ])) {
    echo 'SUCCESS!';
  }
}
echo date('d.m.Y H:i');
?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <form id="addPopup" action="addPopup.php" method="post">
          <label for="title"><b>Title</b></label>
          <input type="text" name="title" required><br>
          <label for="description"><b>Description</b></label>
          <textarea name="description" rows="20" cols="100"></textarea><br>
          <label for="image"><b>Image</b></label>
          <input type="file" name="image"><br>
          <div class="row">
            <label for="datetimepickerfrom"><b>Valid from</b></label>
            <input type="text" id="datetimepickerfrom" name="valid_from" required class="form-control">
            <span class="fa fa-calendar"></span>
            <label for="datetimepickerto"><b>Valid to</b></label>
            <input type="text" id="datetimepickerto" name="valid_to" required>
          </div>
          <input type="submit">
        </form>

      </div>
    </div>
  </div>
</body>
