<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 16.4.2018.
 * Time: 15:21
 */

require '../initialize.php';

if (isset($_POST['popup_id'])) {
  $delete = $conn->prepare('DELETE FROM popup WHERE id = :id');
  $delete->execute(['id' => $_POST['popup_id']]);
  echo 'Popup with id ' . $_POST['popup_id'] . ' deleted!';
}

$result = $conn->prepare('SELECT * FROM popup');
$result->execute();
$popups = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="css/custom_datepicker.css">
  <link rel="stylesheet" href="css/fontawesome-all.css">
  <link rel="stylesheet" href="DataTables/datatables.min.css">
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
  <script src="js/custom.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>

</head>

<body>
  <h1 align="center">Administrate popups</h1>
  <div class="table-responsive-sm">
    <br />
    <div align="right">
      <button type="button" id="addPopup" data-toggle="modal" data-target="#addPopupModal"
        class="btn btn-info btn-lg">Add new</button>
    </div>
    <br /><br />
    <table class="table table-hover table-striped display nowrap" id="popup" width="100%">
      <thead class="thead-dark">
        <tr>
          <th>Title</th>
          <th>Description</th>
          <th>Valid from</th>
          <th>Valid to</th>
          <th>Options</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($popups as $popup) { ?>
        <tr>
          <td><?php echo $popup['title']; ?></td>
          <td><?php echo $popup['description']; ?></td>
          <td><?php echo date('d.m.Y H:i', $popup['valid_from']); ?></td>
          <td><?php echo date('d.m.Y H:i', $popup['valid_to']); ?></td>
          <td>
            <a class="btn btn-primary editButton" data-toggle="modal" data-target="#addPopupModal" name="edit"
                data-id="<?php echo $popup['id']; ?>">
              <span class="fa fa-edit"></span>
            </a>
            <a class="btn btn-danger deleteButton" data-toggle="modal" data-target="#deleteModal" name="delete"
              data-id="<?php echo $popup['id']; ?>">
              <span class="fa fa-trash-alt"></span>
            </a>
            <a class="btn btn-success" data-toggle="modal" data-target="#previewModal" title="Preview">
              <span class="fa fa-eye"></span>
            </a>
          </td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>

  <!-- START ADD POPUP MODAL -->
  <div id="addPopupModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="addPopup" action="addPopup.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Add Popup</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-3 control-label" for="title"><b>Title</b></label>
              <div class="col-sm-9">
                <input id="title" class="form-control" type="text" name="title" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label" for="description"><b>Description</b></label>
              <div class="col-sm-9">
                <textarea id="description" class="form-control" name="description" rows="10" cols="100"></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label" for="image"><b>Image</b></label>
              <div class="col-sm-9">
                <input id="image" class="form-control" type="text" name="image">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 control-label" for="datetimepickerfrom"><b>Valid from</b></label>
              <div class="col-sm-9 input-group date" id="datetimepickerfrom">
                <input id="valid_from" class="form-control" type="text" name="valid_from" required>
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
                <input id="valid_to" class="form-control" type="text" name="valid_to" required>
                <div class="input-group-append input-group-addon">
                <span class="input-group-text">
                  <span class="fa fa-calendar-alt"></span>
                </span>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="popup_id" id="popup_id">
            <input type="submit" class="btn btn-success" name="insert" id="insert" value="Save">
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END ADD POPUP MODAL -->

  <!-- START DELETE POPUP MODAL -->
  <div id="deleteModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="deletePopup" action="administratePopup.php" method="post">
          <div class="modal-header">
            <h4 class="modal-title">Delete Popup</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="alert alert-danger" role="alert">
              You're about to delete popup. Are you sure?
            </div>
          <div class="modal-footer">
              <input type="hidden" name="popup_id" id="popup_id">
              <input type="submit" class="btn btn-danger" name="delete" id="delete" value="Delete">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END DELETE POPUP MODAL -->

  <!-- START PREVIEW MODAL -->
  <div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Popup preview</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- POPUP PREVIEW -->

          <!-- POPUP PREVIEW -->
        </div>
        <!--        <div class="modal-footer">-->
        <!--          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
        <!--          <button type="button" class="btn btn-primary">Save changes</button>-->
        <!--        </div>-->
      </div>
    </div>
  </div>
  <!-- END MODAL -->
</body>
