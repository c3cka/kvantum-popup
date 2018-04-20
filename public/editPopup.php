<head>
  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
  <script src="js/jquery-3.3.1.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/datepicker.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/bootstrap-datetimepicker.min.js"></script>
</head>

<?php

require'../initialize.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];

  $image = uniqueId();

  $validFrom = strtotime($_POST['valid_from']);
  $validTo = strtotime($_POST['valid_to']);

  //echo $id . '<br>' . $title . '<br>' . $description . '<br>' . $image . '<br>' . $validFrom . '<br>' . $validTo;

  $result = $conn->prepare('UPDATE popup 
    SET title=:title, description=:description, image=:image, valid_from=:valid_from, valid_to=:valid_to
    WHERE id=:id');
  if ($result->execute([
    'title' => $title,
    'description' => $description,
    'image' => $image,
    'valid_from' => $validFrom,
    'valid_to' => $validTo,
    'id' => $id,
  ])) echo 'SUCCESS';
} else {
  $id = $_GET['id'];
  $result = $conn->prepare('SELECT * FROM popup WHERE id = :id');
  $result->execute(['id' => $id]);
  $edit = $result->fetch();

?>
<form id="editPopup" action="editPopup.php" method="post">
  <input type="hidden" name="id" value="<?php echo $edit['id']; ?>">
  <label for="title"><b>Title</b></label>
  <input type="text" name="title" value="<?php echo $edit['title']; ?>" required><br>
  <label for="description"><b>Description</b></label>
  <textarea name="description" rows="20" cols="100"><?php echo $edit['description']; ?></textarea><br>
  <label for="image"><b>Image</b></label>
  <input type="file" name="image" value="<?php echo $edit['image']; ?>"><br>
  <label for="datetimepickerfrom"><b>Valid from</b></label>
  <input type="text" id="datetimepickerfrom" name="valid_from"
    value="<?php echo date('d.m.Y H:i',$edit['valid_from']); ?>" required>
  <label for="datetimepickerto"><b>Valid to</b></label>
  <input type="text" id="datetimepickerto" name="valid_to"
    value="<?php echo date('d.m.Y H:i',$edit['valid_to']); ?>" required>
  <input type="submit">
</form>
<?php } ?>
