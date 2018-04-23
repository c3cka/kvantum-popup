<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 16.4.2018.
 * Time: 15:21
 */

require '../initialize.php';
?>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="css/custom_datepicker.css">
  <link rel="stylesheet" href="css/fontawesome-all.css">
  <script src="js/popper.js"></script>
  <script src="js/jquery-3.3.1.js"></script>
  <script src="js/datepicker.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/moment-with-locales.js"></script>
  <script src="js/bootstrap-datetimepicker.min.js"></script>
  <script src="js/custom.js"></script>
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
<?php if (isset($_GET['id'])) {
  $delete = $conn->prepare('DELETE FROM popup WHERE id = :id');
  $delete->execute(['id' => $_GET['id']]);
  echo 'Popup with id ' . $_GET['id'] . ' deleted!';
}

$result = $conn->prepare('SELECT * FROM popup ORDER BY DATE(valid_from) DESC , valid_from ASC');
$result->execute();
$popups = $result->fetchAll(PDO::FETCH_ASSOC);

try {
  $total = count($popups);
  $limit = 10;
  $pages = ceil($total / $limit);

  $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, [
    'options' => [
      'default' => 1,
      'min_range' => 1,
    ],
  ]));
  $offset = ($page - 1) * $limit;
  $start = $offset + 1;
  $end = min(($offset + $limit), $total);
  $prevlink = ($pages > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) .
    '" title="Previous page">&lsaquo;</a>' :
    '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
  $nextlink = ($page < $pages) ?
    '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages .
    '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
  echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

  $stmt = $conn->prepare('
        SELECT
            *
        FROM
            popup
        ORDER BY
            title
        LIMIT
            :limit
        OFFSET
            :offset
    ');

// Bind the query params
  $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
  $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $iterator = new IteratorIterator($stmt);
  ?>
    <table class="table table-hover table-striped" id="popup">
      <thead class="thead-dark">
        <tr>
          <th scope="col" onclick="sortTable(0)">Title</th>
          <th scope="col" onclick="sortTable(1)">Description</th>
          <th scope="col" onclick="sortTable(2)">Valid from</th>
          <th scope="col" onclick="sortTable(3)">Valid to</th>
          <th scope="col" width="10%">Options</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($iterator as $popup) { ?>
        <tr>
          <td><?php echo $popup['title']; ?></td>
          <td><?php echo $popup['description']; ?></td>
          <td><?php echo date('d-m-Y h:i', $popup['valid_from']); ?></td>
          <td><?php echo date('d-m-Y h:i', $popup['valid_to']); ?></td>
          <td>
            <input type="button" class="btn btn-primary edit_data" name="edit" value="Edit"
              id="<?php echo $popup['id']; ?>">
            <span class="fa fa-edit"></span>
            <!--</input>-->
            <a class="btn btn-danger" data-toggle="tooltip" data-placement="top" name="delete"
              id="<?php echo $popup['id']; ?>">
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
    <ul class="pagination">
      <li><a href="?page=1">First</a></li>
      <li class="<?php ($page <= 1) ? 'page-item disabled' : 'page-item'; ?>">
        <a href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>">Prev</a>
      </li>
      <li class="<?php if($page >= $total){ echo 'disabled'; } ?>">
        <a href="<?php if($page >= $total){ echo '#'; } else { echo "?page=".($page + 1); } ?>">Next</a>
      </li>
      <li><a href="?page=<?php echo $total; ?>">Last</a></li>
    </ul>
<?php
    echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';
  } else {
    echo '<p>No results could be displayed.</p>';
  } ?>

  </div>

  <!-- START EDIT POPUP MODAL -->
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
                <input id="image" class="form-control" type="file" name="image">
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
            <button type="submit" class="btn btn-success" name="insert" id="insert" value="Insert">Save</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END EDIT POPUP MODAL -->

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


<?php } catch (Exception $e) {
  echo '<p>', $e->getMessage(), '</p>';
}
?>

