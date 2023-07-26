<?php 
defined("BASEPATH") or exit("No direct access allowed");
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')):?>
<?php
header("Content-type:application/json");
error_reporting(0);
session_start();
if(isset($_SESSION['email'])){
$user = json_decode(file_get_contents("base/data/user/$_SESSION[email].json"), true);
if($user['role'] == "admin"){
    $mirror = json_decode(file_get_contents("base/data/setting/mirror.json"), true);
    $mirror['mirroruser'] = $_POST['mirroruser'];
	$mirror['mirrorpass'] = $_POST['mirrorpass'];
	$mirror['viduser'] = $_POST['viduser'];
	$mirror['vidkey'] = $_POST['vidkey'];
	$mirror['aceuser'] = $_POST['aceuser'];
	$mirror['acekey'] = $_POST['acekey'];
	$mirror['mir1'] = $_POST['mir1'];
	$mirror['mir2'] = $_POST['mir2'];
	$mirror['mir3'] = $_POST['mir3'];
	$mirror['mir4'] = $_POST['mir4'];
	$mirror['mir5'] = $_POST['mir5'];
	$mirror['multiset'] = $_POST['multiset'];
	$mirror['aceset'] = $_POST['aceset'];
	$mirror['vidset'] = $_POST['vidset'];
	
	file_put_contents("base/data/setting/mirror.json", json_encode($mirror,true));
	
	$hasil = array(
             code => "200",
             file => "success"
             );
    echo json_encode($hasil);
} else {
    $hasil = array(
             code => "404",
             file => "You Have No Access"
             );
    echo json_encode($hasil);
}
}
?>
<?php endif;?>