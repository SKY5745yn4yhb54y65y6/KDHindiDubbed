<?php
defined("BASEPATH") or exit("No direct access allowed");
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')): ?>
<?php
    error_reporting(0);
    session_start();
    include "system/function.php";
    if (isset($_SESSION['email']))
    {
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
                $files = json_decode(load("https://www.googleapis.com/drive/v3/files/$id?supportsAllDrives=true&supportsTeamDrives=true&fields=fileExtension%2Cmd5Checksum%2CmimeType%2Cname%2Csize%2CthumbnailLink&access_token=$token[access_token]") , true);
                if (isset($_SESSION['email'], $id, $files['name'], $files['fileExtension'], $files['size'], $files['mimeType']))
                {
                    echo "\t";
                    activity($_SESSION['email'], $id, $files['name'], $files['fileExtension'], $files['size'], $files['mimeType']);
                    echo "<hr>";
                }
                else
                {
                    echo "\t";
                    echo "FAILED [File URL is invalid]<hr>";
                }
            }

        }
        else
        {
            echo "gak onok iki";
        }
    }
?>
<?php
endif; ?>
