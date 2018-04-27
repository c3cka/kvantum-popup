<?php

include '../initialize.php';

//if (isset($_POST['popup_id'])) {
//  $result = $conn->prepare("SELECT * FROM popup WHERE id = :id");
//  $result->execute(['id' => $_POST['popup_id']]);
//  $popup = $result->fetch(PDO::FETCH_ASSOC);
//  $data = [
//    '_id' => $popup['_id'],
//    'id' => $popup['id'],
//    'title' => $popup['title'],
//    'description' => $popup['description'],
//    'image' => $popup['image'],
//    'valid_from' => date('d.m.Y H:i',$popup['valid_from']),
//    'valid_to' => date('d.m.Y H:i', $popup['valid_to']),
//  ];
//  echo json_encode($data);
//}

$today = time();
//echo $today . '<br>';
$result = $conn->prepare("SELECT * FROM popup ORDER BY DATE(valid_from) DESC , valid_from ASC");
$result->execute(['today' => $today]);
$popups = $result->fetchAll(PDO::FETCH_ASSOC);
$returnArray = [];
//print_r($popups);
foreach ($popups as $popup) {
  if ($popup['valid_from'] < $today && $popup['valid_to'] > $today) {
//    echo '<br> ValidFrom: ' . $popup['valid_from'] . '<br>' . ($popup['valid_from'] / $today) . '<br>';
    print_r(json_encode($popup));
    //echo $popup['description'];
    echo '<hr>';
    $returnArray = array_merge($returnArray, $popup);
  }
}

print_r($returnArray);
