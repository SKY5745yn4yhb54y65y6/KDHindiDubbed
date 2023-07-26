<?php
defined("BASEPATH") or exit("No direct access allowed");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')): ?>
<?php
    header("Content-type:application/json");
    error_reporting(0);
    session_start();
    if (isset($_SESSION['email']))
    {
        $user = json_decode(file_get_contents("base/data/user/$_SESSION[email].json") , true);
        if ($user['role'] == "admin")
        {
            if (isset($_GET['id']))
            {
           $cek = "base/data/user/$_GET[id].json";
           if(file_exists($cek)){
                $file = json_decode(file_get_contents("base/data/user/$_GET[id].json") , true);
                $hasil = array(
                    code => "200",
                    role => $file['role'],
                    email => $file['email'],
                    message => $file['blacklist.message']
                );
                echo json_encode($hasil);
            }
            else
            {
                $hasil = array(
                    code => "404",
                    role => "User Not Found",
                    email => "User Not Found",
                    message => "User Not Found"
                );
                echo json_encode($hasil);
            }
          }
        }
    }
?>
<?php
endif; ?>
