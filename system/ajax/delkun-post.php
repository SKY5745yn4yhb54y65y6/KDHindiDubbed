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
            if (isset($_POST['id']))
            {
                unlink("base/data/user/$_POST[id].json");
                $hasil = array(
                    code => "200",
                    message => "user deleted"
                );
                echo json_encode($hasil);
            }
            else
            {
                $hasil = array(
                    code => "404",
                    message => "User Not Found"
                );
                echo json_encode($hasil);
            }
        }
    }
?>
<?php
endif; ?>
