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
    $setting = json_decode(file_get_contents("base/data/setting/config.json"), true);
    $setting['banner1'] = $_POST['banner1'];
	$setting['banner2'] = $_POST['banner2'];
	$setting['jw'] = $_POST['jw'];
	file_put_contents("base/data/setting/config.json", json_encode($setting,true));
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