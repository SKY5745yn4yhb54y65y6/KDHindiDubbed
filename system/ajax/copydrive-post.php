<?php
defined("BASEPATH") or exit("No direct access allowed");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')): ?>
<?php
    error_reporting(0);
    session_start();
    include "system/function.php";
    if (isset($_SESSION['email']))
    {
        $user = json_decode(file_get_contents("base/data/user/$_SESSION[email].json") , true);
        if ($_POST['url'])
        {
            $filed = explode("\n", $_POST['url']);
            $token = token("refresh", $_SESSION['email']);
            foreach ($filed as $file_url)
            {

                $exp = explode("/", $file_url);
                $jum = count($exp);
                if (preg_match("/open/", $file_url))
                {
                    $id = str_replace(array(
                        "open?id=",
                        "\n\r",
                        "\n",
                        "\r"
                    ) , "", $exp['3']);
                }
                else if ($jum == "9")
                {
                    $id = $exp['7'];
                    $id = str_replace(array(
                        "\n\r",
                        "\n",
                        "\r"
                    ) , "", $id);
                }
                else
                {
                    $id = $exp['5'];
                    $id = str_replace(array(
                        "\n\r",
                        "\n",
                        "\r"
                    ) , "", $id);
                }
                $copy = copyfile2($id, $token['access_token'], $user['root']);
                if ($copy['id'])
                {

                    move($copy['id'], $user['folder'], $user['root'], $token['access_token']);
                    echo "<font color=\"green\">Success</font> <a href=\"https://drive.google.com/file/d/$copy[id]\">https://drive.google.com/file/d/$copy[id]</a><br>";
                }
                else
                {
                    echo "<font color=\"red\">Failed</font> $file_url <br>";
                }
            }

        }
        else
        {
            echo "This is not good";
        }
    }

?>
<?php
endif; ?>
