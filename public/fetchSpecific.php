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
$result = $conn->prepare("SELECT * FROM popup ORDER BY _id DESC");
$result->execute(['today' => $today]);
$popups = $result->fetch(PDO::FETCH_ASSOC);
//// TODO For more than one active popup
////$returnArray = [];
////foreach ($popups as $popup) {
////  if ($popup['valid_from'] < $today && $popup['valid_to'] > $today) {
////    $returnArray[] = $popup;
////  }
////}
////print_r($returnArray);
////if (count($returnArray) > 0) {
////  $selected = array_rand($returnArray);
////  echo $returnArray[$selected]['description'];
////  echo "<div id='popup_id' style='display: none' data-id='" . $returnArray[$selected]['id'] . "'></div>";
////}
//
//foreach ($popups as $popup) {
//  if ($popup['valid_from'] < $today && $popup['valid_to'] > $today) {
//    echo $popup['description'];
//    echo "<div id='popup_id' style='display: none' data-id='" . $popup['id'] . "'></div>";
//  }
//}

print_r($popups);
