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
if(isset($_POST['domain'])){
    $setting = json_decode(file_get_contents("base/data/setting/config.json"), true);
    $setting['site.domain'] = $_POST['domain'];
	$setting['site.title'] = $_POST['title'];
	$setting['player'] = $_POST['player'];
	$setting['site.tag'] = $_POST['tag'];
	$setting['site.description'] = $_POST['description'];
	$setting['site.copyright'] = $_POST['copyright'];
	$setting['google.webmaster.id'] = $_POST['webmaster'];
	$setting['drive.client.id'] = $_POST['clientid'];
	$setting['drive.client.secret'] = $_POST['secret'];
	$setting['drive.redirect.uris'] = $_POST['redirect'];
	$setting['site.webset'] = $_POST['webset'];
	$setting['google.analytics.id'] = $_POST['analytics'];
	file_put_contents("base/data/setting/config.json", json_encode($setting,true));
	$hasil = array(
             code => "200",
             file => "success"
             );
    echo json_encode($hasil);
} else {
    $hasil = array(
             code => "404",
             file => "File Error Not Found"
             );
    echo json_encode($hasil);
}
}
}
?>
<?php endif;?>