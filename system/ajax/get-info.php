<?php
defined("BASEPATH") or exit("No direct access allowed");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')): ?>
<?php
    header("Content-type:application/json");
    error_reporting(0);
    session_start();
    if (isset($_SESSION['email']))
    {
        if (isset($_GET['id']))
        {
            $cek = "base/data/main/share/$_GET[id].json";
            if (file_exists($cek))
            {
                $file = json_decode(file_get_contents("base/data/main/share/$_GET[id].json") , true);

if($file['file']['user_id'] == $_SESSION['email']){

                $hasil = array(
                    code => "200",
                    nama => $file['file']['title'],
                    subtitle => $file['file']['poster'],
                    fileid => $file['file']['file_id']
                );
                echo json_encode($hasil);

} else {

$hasil = array(
                    code => "403",
                    nama => "Forbidden ! You have no access to edit this file !",
                    subtitle => "Forbidden",
                    fileid => "Forbidden"
                );
                echo json_encode($hasil);
}

            }
            else
            {
                $hasil = array(
                    code => "404",
                    nama => "Not Found",
                    subtitle => "Not Found",
                    fileid => "Not Found"
                );
                echo json_encode($hasil);
            }
        }
    }
?>
<?php
endif; ?>
