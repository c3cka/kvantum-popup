<head>
  <link rel="stylesheet" href="css/jquery-ui.min.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="css/custom_datepicker.css">
  <link rel="stylesheet" href="css/fontawesome-all.css">
  <script src="js/jquery-3.3.1.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/datepicker.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/moment-with-locales.js"></script>
  <script src="js/bootstrap-datetimepicker.min.js"></script>
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
?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <form id="addPopup" action="addPopup.php" method="post">
          <div class="form-group row">
            <label class="col-sm-3 control-label" for="title"><b>Title</b></label>
            <div class="col-sm-9">
              <input class="form-control" type="text" name="title" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 control-label" for="description"><b>Description</b></label>
            <div class="col-sm-9">
              <textarea class="form-control" name="description" rows="20" cols="100"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 control-label" for="image"><b>Image</b></label>
            <div class="col-sm-9">
              <input class="form-control" type="file" name="image">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 control-label" for="datetimepickerfrom"><b>Valid from</b></label>
            <div class="col-sm-9 input-group date" id="datetimepickerfrom">
              <input class="form-control" type="text" name="valid_from" required>
              <div class="input-group-append input-group-addon">
                <span class="input-group-text">
                  <span class="fa fa-calendar-alt"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 control-label" for="datetimepickerto"><b>Valid to</b></label>
            <div class="col-sm-9 input-group date" id="datetimepickerto">
              <input class="form-control" type="text" name="valid_to" required>
              <div class="input-group-append input-group-addon">
                <span class="input-group-text">
                  <span class="fa fa-calendar-alt"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 text-right">
              <button type="submit" class="btn btn-success">Save</button>
              <button type="reset" class="btn btn-danger">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
