<?php

include '../initialize.php';

if (isset($_POST['popup_id'])) {
  $result = $conn->prepare("SELECT * FROM popup WHERE id = :id");
  $result->execute(['id' => $_POST['popup_id']]);
  $popup = $result->fetch(PDO::FETCH_ASSOC);
  $data = [
    '_id' => $popup['_id'],
    'id' => $popup['id'],
    'title' => $popup['title'],
    'description' => $popup['description'],
    'image' => $popup['image'],
    'valid_from' => date('d.m.Y H:i',$popup['valid_from']),
    'valid_to' => date('d.m.Y H:i', $popup['valid_to']),
  ];
  echo json_encode($data);
}
