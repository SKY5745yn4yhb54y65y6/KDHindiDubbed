<?php 
defined("BASEPATH") or exit("No direct access allowed");
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')):?>
<?php
error_reporting(0);
session_start();
include "system/function.php";
if(isset($_SESSION['email'])){
if($_POST['url']) {
    $idf = explode("/",$_POST['url']);
    $idf = $idf['3'];
    $idf = str_replace(array("folderview?id=","\n\r","\n","\r"),"",$idf);
    $token = token("refresh",$_SESSION['email']);
    
    $idtemp = checkfolder($idf);
    
        foreach($idtemp['items'] as $val) {
        $id = $val['id'];
		$files = json_decode(load("https://www.googleapis.com/drive/v3/files/$id?fields=fileExtension%2Cmd5Checksum%2CmimeType%2Cname%2Csize%2CthumbnailLink&access_token=$token[access_token]"), true);
        if(isset($_SESSION['email'],$id,$files['name'],$files['fileExtension'],$files['size'],$files['mimeType'])) {
        echo "\t";
        activity($_SESSION['email'],$id,$files['name'],$files['fileExtension'],$files['size'],$files['mimeType']);
        echo "<hr>";
	    } else {
	    echo "\t";
        echo "FAILED [ID $id is a folder]<hr>";
        }
        }
        
} else { echo "gak onok iki";}
}
?>
<?php endif;?>