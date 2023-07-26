<?php 
defined("BASEPATH") or exit("No direct access allowed");
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')):?>
<?php
error_reporting(0);
session_start();
if(isset($_SESSION['email'])){
if($_FILES['file_input']) {
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$namaFile2 = $_FILES['file_input']['name'];

$lastname = preg_replace("![^a-z0-9]+!i", "-", $namaFile2);
$lastname = substr($lastname,0,25);

$namaFile = 'neo-'.substr(str_shuffle($permitted_chars), 0, 4).'-'.$lastname.'.srt';
$idFile = 'neo-'.substr(str_shuffle($permitted_chars), 0, 4).'-'.$lastname.'';
$namaFile2 = $_FILES['file_input']['name'];
$namaSementara = $_FILES['file_input']['tmp_name'];
$extensi = pathinfo($namaFile2, PATHINFO_EXTENSION);

$dirUpload = "subtitle/$_SESSION[email]/";
if(!is_dir($dirUpload))
{ mkdir($dirUpload, 0777, true); }

if ($extensi=="srt") {
$terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);
if ($terupload) {
echo "$idFile";
}
} else {
    echo"Failed not SRT file !!";
}

}
}
?>
<?php endif;?>