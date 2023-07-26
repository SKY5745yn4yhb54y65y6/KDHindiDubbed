<?php
defined("BASEPATH") or exit("No direct access allowed");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')): ?>
<?php
    header("Content-type:application/json");
    error_reporting(0);
    session_start();
    if (isset($_SESSION['email']))
    {
        if (isset($_POST['id']))
        {
            $cek = "base/data/main/share/$_POST[id].json";
            if (file_exists($cek))
            {
                $file = json_decode(file_get_contents("base/data/main/share/$_POST[id].json") , true);
                $file['file']['title'] = $_POST['nama'];
                $file['file']['poster'] = $_POST['subtitle'];
                $file['file']['file_id'] = $_POST['fileid'];
                file_put_contents("base/data/main/share/$_POST[id].json", json_encode($file));
                $hasil = array(
                    code => "200",
                    file => $_POST['nama']
                );
                echo json_encode($hasil);
            }
            else
            {
                $hasil = array(
                    code => "404",
                    file => "Not Found"
                );
                echo json_encode($hasil);
            }

        }
    }
?>
<?php
endif; ?>
