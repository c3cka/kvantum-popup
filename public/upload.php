<?php
error_reporting(0);
require '../initialize.php';
//sleep(3);
if ($_SERVER['REQUEST_METHOD'] == 'POST' /*&& isset($_SESSION['id'])*/) {
  // IMAGE UPLOAD START
  $returnData = [];
  $targetDir = "uploads/";
  $imageName = basename($_FILES["file"]["name"]);
  //$imageName = 'test.jpg';
  $targetFile = $targetDir . time() . $imageName;
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
  //var_dump($_FILES);
  if (!file_exists($targetDir)) {
    @mkdir($targetDir);
  }

  if (file_exists($targetFile)) {
    echo 'Sorry, file exists';
    $uploadOk = 0;
  }

  if ($_FILES["file"]["size"] > 5000000) {
    $returnData = [
      'uploaded' => 0,
      'error' => [
        'message' => 'File too big',
      ],
    ];
    $uploadOk = 0;
  }

  if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
//    echo 'Invalid format. JPG, JPEG, PNG and GIF allowed Got: '.$imageFileType;
    $uploadOk = 0;
    $returnData = [
      'uploaded' => 0,
      'error' => [
        'message' => 'Wrong filetype. Must be JPG, JPEG, PNG, GIF. got '.$imageFileType,
      ],
    ];
  }

  if ($uploadOk == 0) {
   // echo 'Image not uploaded';
  } else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
      $returnData = [
        'uploaded' => 1,
        'fileName' => $imageName,
        'url' => 'http://kvantum-manual.local/'. $targetFile,
        'srcset' => 'http://kvantum-manual.local/'.$targetFile,
        //'default' => $targetFile,
      ];
    } else {
      $returnData = [
        'uploaded' => 0,
        'error' => [
          'message' => 'There was an error',
        ],
      ];
    }
  }
  // IMAGE UPLOAD FINISH

  echo json_encode($returnData);
}
