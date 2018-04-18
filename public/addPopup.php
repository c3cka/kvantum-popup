<head>
  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <link rel="stylesheet" href="js/datetimepicker-master/jquery.datetimepicker.css"/>
  <script src="js/jquery-3.3.1.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/datepicker.js"></script>
  <script src="js/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
<!--  <script src="js/datetimepicker-master/jquery.js"></script>-->
</head>

<?php

require'../initialize.php';

if (isset($_GET['id'])) { ?>

<?php }
else {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = uniqueId();
    $title = $_POST['title'];
    $description = $_POST['description'];

    $validFrom = strtotime($_POST['valid_from']);
    $validTo = strtotime($_POST['valid_to']);

    echo $title . '<br>' . $description . '<br>' . $validFrom . '<br>' . $validTo;

    $result = $conn->prepare('INSERT INTO users (id, title, description, valid_from, valid_to) VALUES (:id, :title, :description, :valid_from, 
:valid_to)');
    $result->execute([
      'id' => $id,
      'title' => $title,
      'description' => $description,
      'valid_from' => $validFrom,
      'valid_to' => $validTo,
    ]);

  }
?>
  <form id="addPopup" action="addPopup.php" method="post">
    <label for="title"><b>Title</b></label>
    <input type="text" name="title" required><br>
    <label for="description"><b>Description</b></label>
    <textarea name="description" rows="20" cols="100"></textarea><br>
    <label for="image"><b>Image</b></label>
    <input type="file" name="image"><br>
    <label for="datetimepickerfrom"><b>Valid from</b></label>
    <input type="text" id="datetimepickerfrom" name="valid_from">
    <label for="datetimepickerto"><b>Valid to</b></label>
    <input type="text" id="datetimepickerto" name="valid_to">
    <input type="submit">
  </form>
<?php } ?>
