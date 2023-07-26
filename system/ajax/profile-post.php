<?php 
defined("BASEPATH") or exit("No direct access allowed");
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')):?>
<?php
header("Content-type:application/json");
error_reporting(0);
session_start();
if(isset($_SESSION['email'])){
    if(isset($_POST['id'])){
    $fileu = "base/data/user/$_SESSION[email].json";
    if(file_exists($fileu)){
    $user = json_decode(file_get_contents($fileu), true);
    $user['name'] = $_POST['id'];
    
     $hasil = array(
             code => "200",
             name => $user['name'],
             );
    file_put_contents($fileu, json_encode($user));
    echo json_encode($hasil);
    } else {
        $hasil = array(
             code => "404",
             name => "User not Found",
             );
    echo json_encode($hasil);
    }
  }
}
?>
<?php endif;?>