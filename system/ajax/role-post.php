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
if(isset($_POST['id'])){
    $file = json_decode(file_get_contents("base/data/user/$_POST[id].json"), true);
$file['role'] = $_POST['role'];
$file['blacklist.message'] = $_POST['bm'];
file_put_contents("base/data/user/$_POST[id].json", json_encode($file,true));
    $hasil = array(
             code => "200",
             role => $file['role']
             );
    echo json_encode($hasil);
    } else {
        $hasil = array(
             code => "404",
             role => "User Not Found"
             );
    echo json_encode($hasil);
    }

}
}
?>
<?php endif;?>