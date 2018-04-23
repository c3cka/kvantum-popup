<?php

include '../initialize.php';

if (isset($_POST['popup_id'])) {
  $result = $conn->prepare("SELECT * FROM popup WHERE id = :id");
  $result->execute('id', $_POST['popup_id']);
  $popup = $result->fetch(PDO::FETCH_ASSOC);
  echo json_encode($popup);
}
