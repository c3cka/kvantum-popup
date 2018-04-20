<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 16.4.2018.
 * Time: 15:21
 */

require '../initialize.php';

if (isset($_GET['id'])) {
  $delete = $conn->prepare('DELETE FROM popup WHERE id = :id');
  $delete->execute(['id' => $_GET['id']]);
  echo 'Popup with id ' . $_GET['id'] . ' deleted!';
}

$result = $conn->prepare('SELECT * FROM popup ORDER BY DATE(valid_from) DESC , valid_from ASC');
$result->execute();
$popups = $result->fetchAll(PDO::FETCH_ASSOC);

?>
<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/fontawesome-all.css">
  <script src="js/jquery-3.3.1.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<div>
  <p>
    <a class="btn btn-primary" href="addPopup.php" role="button">Add new</a>
  </p>
</div>

<div class="table-responsive-sm">
  <table class="table table-hover table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Title</th>
        <th scope="col">Description</th>
        <th scope="col">Valid from</th>
        <th scope="col">Valid to</th>
        <th scope="col">Options</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($popups as $popup) { ?>
        <tr>
          <td><?php echo $popup['title']; ?></td>
          <td><?php echo $popup['description']; ?></td>
          <td><?php echo date('d-m-Y h:i', $popup['valid_from']); ?></td>
          <td><?php echo date('d-m-Y h:i', $popup['valid_to']); ?></td>
          <td>
            <a class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="editPopup
            .php?id=<?php echo $popup['id']; ?>"><span class="fa fa-edit"></span></a>
            <a class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" href="administratePopup
            .php?id=<?php echo $popup['id']; ?>"><span class="fa
            fa-trash-alt"></span></a>
            <a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Preview" href="?id=<?php echo
            $popup['id']; ?>"><span class="fa
            fa-eye"></span></a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
