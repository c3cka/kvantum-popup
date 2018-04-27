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
  echo '<div class="alert alert-success" role="alert">Popup deleted!</div>';
}

$result = $conn->prepare('SELECT * FROM popup ');
$result->execute();
$popups = $result->fetchAll(PDO::FETCH_ASSOC);

?>
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
</head>

<body>
  <h1 align="center">Administrate popups</h1>
  <div class="table-responsive-sm">
    <br />
    <div align="right">
      <a type="button" id="addPopup" href="addPopup.php" class="btn btn-info"><span class="fa fa-plus"></span> Add
        new</a>
      <a type="button" id="logout" href="logout.php" class="btn btn-warning"><span class="fa fa-sign-out-alt"></span>
        Logout</a>
    </div>
    <br /><br />
    <table class="table table-hover table-striped display nowrap" id="popup" width="100%">
      <thead class="thead-dark">
        <tr>
          <th width="2%">No.</th>
          <th width="10%">Title</th>
          <th width="50%">Description</th>
          <th width="10%">Valid from</th>
          <th width="10%">Valid to</th>
          <th width="8%">Options</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($popups as $popup) { ?>
        <tr>
          <td><?php echo $popup['_id']; ?></td>
          <td><?php echo $popup['title']; ?></td>
          <td><?php echo textsummary($popup['description'], 50); ?></td>
          <td><?php echo date('d.m.Y H:i', $popup['valid_from']); ?></td>
          <td><?php echo date('d.m.Y H:i', $popup['valid_to']); ?></td>
          <td>
            <a class="btn btn-primary" name="edit" href="editPopup.php?id=<?php echo $popup['id']; ?>" title="Edit">
              <span class="fa fa-edit"></span>
            </a>
            <a class="btn btn-danger deleteButton" data-toggle="modal" data-target="#deleteModal" name="delete"
              title="Delete" data-id="<?php echo $popup['id']; ?>">
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

</body>
