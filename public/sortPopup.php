<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 23.4.2018.
 * Time: 8:35
 */

include '../initialize.php';

$columnName = $_POST['columnName'];
$sort = $_POST['sort'];

$result = $conn->prepare("SELECT * FROM popup order by :columnName :sort");
$result->execute([
  'columnName' => $columnName,
  'sort' => $sort
]);
$popup = $result->fetchAll(PDO::FETCH_ASSOC);

$html = '';
foreach ($popup as $row){
  $html .=
  "<tr>
    <td>" . $row['title'] . "</td>
    <td>" . $row['description'] . "</td>
    <td>" . date('d-m-Y h:i', $row['valid_from']) . "</td>
    <td>" . date('d-m-Y h:i', $row['valid_to']) . "</td>
    <td>
      <a class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Edit'
          href='editPopup.php?id=" . $row['id'] . "'>
        <span class=\"fa fa-edit\"></span>
      </a>
      <a class='btn btn-danger' data-toggle='tooltip' data-placement='top' title='Delete'
          href='administratePopup.php?id=" . $row['id'] . "'>
        <span class=\"fa fa-trash-alt\"></span>
      </a>
      <a class=\"btn btn-success\" data-toggle=\"modal\" data-target=\"#previewModal\" title=\"Preview\">
        <span class=\"fa fa-eye\"></span>
      </a>
    </td>
  </tr>";
}

echo $html;
