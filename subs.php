<?php
error_reporting(0);
if(isset($_GET['id']) && isset($_GET['u'])){

$u = base64_decode($_GET['u']);

$file = "subtitle/$u/$_GET[id].srt";
if(file_exists($file)){
echo file_get_contents($file);
}
}

?>