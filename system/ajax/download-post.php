<?php
defined("BASEPATH") or exit("No direct access allowed");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')): ?>
<?php
    header("Content-type:application/json");
    error_reporting(0);
    session_start();
    include "system/function.php";
    if (isset($_SESSION['email']))
    {
        $user = json_decode(file_get_contents("base/data/user/$_SESSION[email].json") , true);
        if (isset($_POST['id']))
        {
            $file = json_decode(file_get_contents("base/data/main/share/$_POST[id].json") , true);

            $token = token("refresh", $_SESSION['email']);
            $token = $token['access_token'];
            $copy = copyfile2($file['file']['file_id'], $token, $user['root']);
            if ($copy['id'])
            {
                $move = json_decode(move($copy['id'], $user['folder'], $user['root'], $token) , true);
                $folu = $user['folder'];
                $err = "File not found: $folu.";
                if ($move['error']['message'] == $err)
                {
                    $folder = create_folder($token);
                    $folid = $folder['id'];
                    anyonefolder($folid, $token);
                    $user['folder'] = $folid;
                    file_put_contents("base/data/user/$_SESSION[email].json", json_encode($user, true));

                    move($copy['id'], $folid, $user['root'], $token);
                }

                $direct = directdl2($copy['id']);
                if($direct == null) { $direct = "https://drive.google.com/open?id=".$copy['id'].""; }
                $own = $file['file']['user_id'];
                $file['file']['cache'] = $copy['id'];
                file_put_contents("base/data/main/share/$_POST[id].json", json_encode($file));
                $folder = "base/data/main/user/$own/cache";
                $fileu = "base/data/main/user/$own/cache/down.json";
                if (!is_dir($folder))
                {
                    mkdir($folder, 0777, true);
                }
                if (!file_exists($file))
                {
                    file_put_contents($file, null);
                }
                $getdown1 = json_decode(file_get_contents($fileu) , true);
                $getdown1['download'] = $getdown1['download'] + 1;
                file_put_contents($fileu, json_encode($getdown1, true));
                $getdown2 = json_decode(file_get_contents("base/data/setting/down.json") , true);
                $getdown2['download'] = $getdown2['download'] + 1;
                file_put_contents("base/data/setting/down.json", json_encode($getdown2, true));
                $hasil = array(
                    code => "200",
                    file => $direct
                );
                echo json_encode($hasil);
            }
            else
            {
                if($copy['error']['code'] == '404' && $file['file']['cache'] != null){
                $copy2 = copyfile2($file['file']['cache'], $token, $user['root']);
                } else { $copy2 = null; }
                if ($copy2['id'] != null)
                {

                    $move = json_decode(move($copy2['id'], $user['folder'], $user['root'], $token) , true);
                    $file['file']['file_id'] = $copy2['id'];
                    file_put_contents("base/data/main/share/$_POST[id].json", json_encode($file));
                    $folu = $user['folder'];
                    $err = "File not found: $folu.";
                    if ($move['error']['message'] == $err)
                    {
                        $folder = create_folder($token);
                        $folid = $folder['id'];
                        anyonefolder($folid, $token);
                        $user['folder'] = $folid;
                        file_put_contents("base/data/user/$_SESSION[email].json", json_encode($user, true));
                        move($copy['id'], $folid, $user['root'], $token);
                    }

                    $direct = directdl2($copy2['id']);
                    if($direct == null){ $direct = "https://drive.google.com/open?id=".$copy2['id'].""; }
                    $hasil = array(
                        code => "200",
                        file => $direct
                    );
                    echo json_encode($hasil);

                }
                else
                {
                    $fid = $file['file']['file_id'];
                    $brok = "File not found: $fid";
                    $mErr = ErrMessage($copy['error']['code']);
                    if ($copy['error']['message'] == $brok)
                    {

                        $file['file']['status'] = "realbroken";
                        $own = $file['file']['user_id'];
                        file_put_contents("base/data/main/share/$_POST[id].json", json_encode($file));

                        $folder = "base/data/main/user/$own/broken";

                        if (!is_dir($folder))
                        {
                            mkdir($folder, 0777, true);
                        }
                        file_put_contents("base/data/main/user/$own/broken/$_POST[id].json", null);
                    }
                    $hasil = array(
                        code => $copy['error']['code'],
                        file => $mErr
                    );
                    echo json_encode($hasil);
                }
            }
        }
    }
?>
<?php
endif; ?>
