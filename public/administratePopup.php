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

$result = $conn->prepare('SELECT * FROM popup ORDER BY DATE(valid_from) DESC , valid_from ASC LIMIT 10');
$result->execute();
$popups = $result->fetchAll(PDO::FETCH_ASSOC);

?>

<div>
  <p>
    <a href="addPopup.php">Add new</a>
  </p>
</div>

<table>
  <tr>
    <td>Title</td>
    <td>Description</td>
    <td>Valid from</td>
    <td>Valid to</td>
    <td>Edit/Delete</td>
  </tr>
  <?php foreach ($popups as $popup) { ?>
    <tr>
      <td><?php echo $popup['title']; ?></td>
      <td><?php echo $popup['description']; ?></td>
      <td><?php echo date('d-m-Y h:i', $popup['valid_from']); ?></td>
      <td><?php echo date('d-m-Y h:i', $popup['valid_to']); ?></td>
      <td><a href="editPopup.php?id=<?php echo $popup['id']; ?>">Edit</a>
        <a href="administratePopup.php?id=<?php echo $popup['id']; ?>">Delete</a></td>
    </tr>
  <?php } ?>
</table>
