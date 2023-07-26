<?php 
defined("BASEPATH") or exit("No direct access allowed");
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')):?>
<?php
error_reporting(0);
session_start();
include "system/function.php";

if(!empty($_SESSION['email'])) {
    $user = json_decode(file_get_contents("base/data/user/$_SESSION[email].json"), true);
    $token = token("refresh",$_SESSION['email']);
    $token = $token['access_token'];
    $totalshareuser = totalshareuser($_SESSION['email']);
    $broken = totalbroken($_SESSION['email']);
    $download = totaldownloaduser($_SESSION['email']);

     $cek = check_quota($token);
     $usage = formatBytes($cek['storageQuota']['usageInDrive']);
      if($cek['storageQuota']['limit'] != null){
     $limit = formatBytes($cek['storageQuota']['limit']);
     } else { $limit = "∞"; }
     $drive = "$usage / $limit";


$hasil = array(
             share => $totalshareuser,
             broken => $broken,
             size => $drive,
             download => $download
             );
    echo json_encode($hasil);

    }


?>
<?php endif;?>