<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 23.4.2018.
 * Time: 9:49
 */

if (!empty($_POST)) {
$output = '';
$message = '';

$id = uniqueId();
$title = $_POST['title'];
$description = $_POST['description'];

// TODO Change when image upload added
$image = uniqueId();

$validFrom = strtotime($_POST['valid_from']);
$validTo = strtotime($_POST['valid_to']);

if ($_POST['popup_id'] != '') {
$query = "UPDATE popup SET title ";
}

}
