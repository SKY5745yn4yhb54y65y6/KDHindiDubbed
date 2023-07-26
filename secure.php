<?php
error_reporting(0);
if($_GET['id']){
$file = json_decode(file_get_contents("base/data/main/share/$_GET[id].json") , true);
$file = $file['file']['file_id'];
$source = sprintf( 'https://www.googleapis.com/drive/v3/files/%s?alt=media&key=AIzaSyD739-eb6NzS_KbVJq1K8ZAxnrMfkIqPyw', $file );

header("HTTP/1.1 301 Moved Permanently");
header("Location: $source");
exit;

 } elseif($_GET['poster']) {
$file = json_decode(file_get_contents("base/data/main/share/$_GET[poster].json") , true);
$file = $file['file']['file_id'];
$image = sprintf( 'https://drive.google.com/thumbnail?id=%s&authuser=0&sz=w640-h360-n-k-rw', $file );

header("HTTP/1.1 301 Moved Permanently");
header("Location: $image");
exit;

}
?>
