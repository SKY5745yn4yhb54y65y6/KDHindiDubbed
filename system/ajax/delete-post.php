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
        if (isset($_POST['id']))
        {
          $cek = "base/data/main/share/$_POST[id].json";
          if(file_exists($cek)){
          $file = json_decode(file_get_contents($cek) , true);
          $uploader = $file['file']['user_id'];

          if($uploader == $_SESSION['email'] || $user['role'] == "admin"){
            if($file['file']['status'] == "realbroken" || $file['file']['status'] == "broken"){ unlink("base/data/main/user/$uploader/broken/$_POST[id].json");}
            $file['file']['status'] = "delete";
            file_put_contents("base/data/main/share/$_POST[id].json", json_encode($file));
            unlink("base/data/main/user/$uploader/$_POST[id].json");

            $hasil = array(
                     code => "200",
                     file => "success"
                     );
            echo json_encode($hasil);
            } else {
            $hasil = array(
                     code => "403",
                     file => "Forbidden"
                     );
            echo json_encode($hasil);

            }
        } else {
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
