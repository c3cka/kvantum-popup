<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 16.4.2018.
 * Time: 15:21
 */

require '../initialize.php';

$result = $conn->prepare('SELECT * FROM popup ORDER BY DATE(valid_from) DESC , valid_from ASC');
$result->execute();
$popups = $result->fetchAll(PDO::FETCH_ASSOC);

?>

<table>
  <tr>
    <td>Title</td>
    <td>Description</td>
    <td>Valid from-to</td>
    <td>Edit/Delete</td>
  </tr>
  <?php foreach ($popups as $popup) { ?>
    <tr>
      <td><?php echo $popup['title']; ?></td>
      <td><?php echo $popup['description']; ?></td>
      <td><?php echo $popup['valid_from'] . '/' . $popup['valid_to']; ?></td>
      <td><a href="#">Edit</a>  <a href="#">Delete</a></td>
    </tr>
  <?php } ?>
</table>
