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

//String
function az09($str)
{
  return preg_replace("/[^a-zA-Z0-9]+/", "", $str);
}
function to09($str)
{
  $r = preg_replace("/[^0-9]+/", "", $str);
  return ($r == "") ? '' : (int)preg_replace("/[^0-9]+/", "", $str);
}
function toCroAZ($e)
{
  return trim(preg_replace("/[^a-zA-Z0-9čćšđžČĆŠĐŽ \/_\-:\.\,!\?\(\)+@=&]+/u", "", $e));
}

/**
 * toSafeString()
 * SQL safe string, also used for alphanumeric titles in tax.
 * @param mixed $e
 * @return
 */
function toSafeString($e)
{
  return trim(preg_replace("/[^a-zA-Z0-9 \/_\-:\.\,!\?\(\)=]+/u", "", $e));
}
function replaceCroatian($text)
{
  $cro        = array('Č', 'č', 'Ć', 'ć', 'Ž', 'ž', 'Š', 'š', 'Đ', 'đ');
  $urlsafe    = array('C', 'c', 'C', 'c', 'Z', 'z', 'S', 's', 'D', 'd');
  $text = str_replace($cro, $urlsafe, $text);
  return $text;
  return strtolower(trim(preg_replace('/\W+/', ' ', $text), '-'));
}

function startsWith($haystack, $needle) {
  // search backwards starting from haystack length characters from the end
  return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}
function endsWith($haystack, $needle) {
  // search forward starting from end minus needle length characters
  return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}
function contains($haystack, $needle)
{
  return (strpos($haystack, $needle) !== FALSE) ? true:false;
}

/**
 * truncate()
 * Creates summary of provided text string. (tags are not proccessed)
 * @param mixed $text
 * @param integer $chars
 * @return
 */
function truncate($text, $chars = 25) {
  return substr(str_pad($text,$chars),0,$chars) . ((strlen($text) <= $chars) ? '' : '...');
}

/**
 * Limits the string based on the character count. Preserves complete words
 * so the character count may not be exactly as specified.
 *
 * @access   public
 * @param    string
 * @param    integer
 * @param    string  the end character. Usually an ellipsis
 * @return   string
 */
function textsummary($str, $n = 500, $end_char = '&#8230;')
{
  //before stripping all html tags, convert <br> to space
  $str = preg_replace("/<br\W*?\/>/", ' ', $str);
  $str = preg_replace("/<br>/", ' ', $str);
  $str = str_replace("&nbsp;", '', $str);
  //strip html tags
  $str = strip_tags($str);
  if (strlen($str) < $n)
  {
    return trim($str);
  }
  $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

  if (strlen($str) <= $n)
  {
    return trim($str);
  }

  $out = "";
  foreach (explode(' ', trim($str)) as $val)
  {
    $out .= $val.' ';

    if (strlen($out) >= $n)
    {
      $out = trim($out);
      break;

    }
  }
  //var_dump(trim($out));
  return (strlen($out) == strlen($str)) ? trim($out) : trim($out).$end_char;
}
/**
 * stripLinks()
 * Removes links from html. Mrs linkovi!
 * @param mixed $str
 * @return void
 */
function stripLinks($str)
{
  return preg_replace('/(?i)<a([^>]+)>(.+?)<\/a>/','\\2',$str);
}

//Date
function toMysqlDate($unixTimestamp) {
  return date("Y-m-d H:i:s", $unixTimestamp);
}
function toMysqlDateOnly($unixTimestamp) {
  return date("Y-m-d", $unixTimestamp);
}
function mysqlDateTimeToUnix($mysqldatetime)
{
  return strtotime($mysqldatetime);
}

/**
 * GetIP()
 * Gets IP of the current visitor. Checks for proxie.
 * @return
 */
function GetIP()
{
  foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key)
  {
    if (array_key_exists($key, $_SERVER) === true)
    {
      foreach (array_map('trim', explode(',', $_SERVER[$key])) as $ip)
      {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false)
        {
          return $ip;
        }
      }
    }
  }
}

