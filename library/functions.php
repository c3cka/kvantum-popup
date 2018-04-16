<?php
/**
 * Created by PhpStorm.
 * User: ikos
 * Date: 13.4.2018.
 * Time: 11:14
 */

function generateStrongPassword ($length = 20, $add_dashes = false, $available_sets = 'luds') {
  $sets = [];
  if (strpos($available_sets, 'l') !== false) {
    $sets[] = 'abcdefghjkmnpqrstuvwxyz';
  }
  if (strpos($available_sets, 'u') !== false) {
    $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
  }
  if (strpos($available_sets, 'd') !== false) {
    $sets[] = '23456789';
  }
  if (strpos($available_sets, 's') !== false) {
    $sets[] = '!@#$%&*?';
  }
  $all = '';
  $password = '';
  foreach ($sets as $set) {
    $password .= $set[array_rand(str_split($set))];
    $all .= $set;
  }
  $all = str_split($all);
  for ($i = 0; $i < $length - count($sets); $i++)
    $password .= $all[array_rand($all)];
  $password = str_shuffle($password);
  if (!$add_dashes) {
    return $password;
  }
  $dash_len = floor(sqrt($length));
  $dash_str = '';
  while (strlen($password) > $dash_len) {
    $dash_str .= substr($password, 0, $dash_len) . '-';
    $password = substr($password, $dash_len);
  }
  $dash_str .= $password;
  return $dash_str;
}

function randomKey ($length) {
  $random = '';
  // 48 - 57, 65 - 90, 97 - 122
  for ($i = 0; $i < $length; $i++) {
    $n = mt_rand(0, 10 + 26 + 26 - 1);
    $random .= chr($n < 10 ? 48 + $n : ($n - 10 < 26 ? 65 + ($n - 10) : 97 + ($n - 10 - 26)));
  }
  return $random;
}

function uniqueId () {
  return randomKey(24);
}
