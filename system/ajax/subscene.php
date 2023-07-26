<?php 
defined("BASEPATH") or exit("No direct access allowed");
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')):?>

<?php
error_reporting(0);
session_start();

include "system/simple_html_dom.php";

if(isset($_SESSION['email'])){
if(isset($_POST['url']) && $_POST['url'] != null){

$f = $_POST['url'];

$html = file_get_html($f);
$div  = $html->find('a[id=downloadButton]',0)->href;

$url = "https://subscene.com".$div."";

$id = uniqid();
$ses = $_SESSION['email'];
$final_dest = "subtitle/$ses";

if (!is_dir($final_dest)) {
    mkdir($final_dest, 0755, true);
}


$tempo = "subtitle/temp";
$destination_dir = "subtitle/temp/$id";

if (!is_dir($tempo)) {
    mkdir($tempo, 0755, true);
}

if (!is_dir($destination_dir)) {
    mkdir($destination_dir, 0755, true);
}




$local_zip_file = basename(parse_url($url, PHP_URL_PATH));


if (!copy($url, $destination_dir . $local_zip_file)) {
    die('Failed to copy Zip from ' . $url . '');
}


$zip = new ZipArchive();

$dump = array();

if ($zip->open($destination_dir . $local_zip_file)) {
    for ($i = 0; $i < $zip->numFiles; $i++) {
        if ($zip->extractTo($destination_dir, array($zip->getNameIndex($i)))) {
            $dump[] = 'File extracted to ' . $destination_dir . $zip->getNameIndex($i);
        }
    }
    $zip->close();
    unlink($destination_dir . $local_zip_file);
}

$listex = glob("subtitle/temp/$id/*");

$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

foreach($listex as $file){
$extensi = pathinfo($file, PATHINFO_EXTENSION);
if($extensi=="srt") {
$nameF = explode("$id/",$file);
$nameF = $nameF['1'];
$lastname = preg_replace("![^a-z0-9]+!i", "-", $nameF);
$lastname = substr($lastname,0,30);
$namaFile = 'neo-'.substr(str_shuffle($permitted_chars), 0, 4).'-'.$lastname.'.srt';
$idFile = str_replace(".srt","",$namaFile);

$pindah = rename($file, "{$final_dest}/{$namaFile}");

if($pindah){
echo "$idFile <hr>";
} else {
echo "failed $idFile <hr>";
}

}
}
rmdir($destination_dir);
} else {
echo "enter url";
}
}
?>

<?php endif;?>