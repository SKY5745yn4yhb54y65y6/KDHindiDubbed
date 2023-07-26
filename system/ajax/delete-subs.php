<?php
defined("BASEPATH") or exit("No direct access allowed");
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')): ?>

<?php

header("Content-type:application/json");
session_start();
error_reporting(0);
if(isset($_SESSION['email'])){
if(isset($_POST['id'])){
$file = "subtitle/$_SESSION[email]/$_POST[id].srt";
if(file_exists($file)){
unlink($file);
$result = array(
'code' => "200",
'message' => "subtitle deleted"
);
echo json_encode($result);
} else {
$result = array(
'code' => "404",
'message' => "subtitle not found"
);
echo json_encode($result);
}
}
}
?>

<?php endif; ?>