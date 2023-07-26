<?php
defined("BASEPATH") or exit("No direct access allowed");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')): ?>
<?php

    /*
    @author gusmanu
    @link github.com/gusmanu
    @Vidcloud Remote Upload
    */

    header("Content-type:application/json");
    error_reporting(0);
    include "system/function.php";
    if (isset($_GET['id']))
    {
        $_GET[id] = str_replace("v", "", $_GET[id]);
        $file = json_decode(file_get_contents("base/data/main/share/$_GET[id].json"), true);
        $account = json_decode(file_get_contents("base/data/setting/mirror.json"),true);
        $fileid = $file[file][file_id];
        $url2 = "https://drive.google.com/file/d/$fileid";
        
        $cloudvid = addvid($account['viduser'],$account['vidkey'],$url2);
        if($cloudvid['status'] == "200"){
            $file['file']['vidtrack'] = $cloudvid['result']['id'];
            file_put_contents("base/data/main/share/$_GET[id].json", json_encode($file,true));
            $hasil = array(
                code => "200",
                file => $cloudvid['result']['id']
            );
            echo json_encode($hasil);
        }
        else
        {
            $hasil = array(
                code => "403",
                file => "Failed, Credential Invalid/File Invalid"
            );
            echo json_encode($hasil);
        }
    }
?>
<?php
endif; ?>
