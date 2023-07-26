<?php
error_reporting(0);
include "system/function.php";

function check_exp($stamp){
$now = strtotime("now");
if($stamp == null){
$stamp = 1;
}
if($now > $stamp){
$res = true;
} else {
$res = false;
}
return $res;
}

$ses = strtotime("+4 hours");

$ses = $ses + 989806;

if($_GET['id']) {

$multi_resolution = "enable";

$share = json_decode(file_get_contents("base/data/main/share/$_GET[id].json"),true);
$setting = json_decode(file_get_contents("base/data/setting/config.json"),true);

$u1 = $share['file']['user_id'];

$u2 = json_decode(file_get_contents("base/data/user/$u1.json"),true);
$iklan = $setting['jw'];

if($u2['role'] == "blacklist"){
$setting['player'] = "disable";
}


if($setting['player'] == "enable"){


$judul = $share['file']['title'];
$usr = base64_encode($share['file']['user_id']);
$sub = $share['file']['poster'];

if($sub != null){
$sub1 = "subs.php?id=".$sub."&u=".$usr."";
} else {
$sub1 = null;
}

$source = secure_link($_GET['id']);
$file = "base/data/main/player/data/$_GET[id].json";
$urll = "https://".config('site.domain')."/drive-stream-data.php?id=".$_GET[id]."";
if (!file_exists($file)){
load($urll);
}

$ck = json_decode(file_get_contents("base/data/main/player/data/$_GET[id].json"),true);
$stamp = $ck['valid'];
$valid = check_exp($stamp);

if($valid == true || $ck['video']['0']['file'] == false){
$ck = null;
$ff = "base/data/main/player/data/$_GET[id].json";
$cf = "base/data/main/player/cookie/$_GET[id].txt";
unlink($ff);
unlink($cf);
load($urll);
}

$ck = json_decode(file_get_contents("base/data/main/player/data/$_GET[id].json"),true);

if($ck['video']['0']['file'] != false && $multi_resolution == "enable"){

$sour = array();
$i = -1;
foreach($ck[video] as $v){
$i = $i+1;
$url = "https://".config('site.domain')."/drive-stream.php?download=".$_GET[id]."&label=".$i."&idplay=".$ses."";
$sour[] = array('file' => $url,'label' => $v[label],'type' => "mp4");
}

} else {
$sour = array('file' => $source['link'],'label' => "original",'type' => "mp4");
}


}
}
?>
<!doctype html>
<head>
<meta charset="utf-8" />
<script type="text/javascript" src="https://ssl.p.jwpcdn.com/player/v/8.3.3/jwplayer.js"></script>
<style type="text/css">*{margin:0;padding:0}#myplayer{position:absolute;width:100%!important;height:100%!important}</style>
</head>

<body>
    <div id="myplayer"></div>
    <script type="text/JavaScript">jwplayer.key="XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo";
      jwplayer("myplayer").setup({"image" : "<?php echo $source['poster'] ?>","title" : "<?php echo $judul ?>","height": 360,"width": 640,"autostart": false,"playbackRateControls": true,"nextupoffset": "-10","hlsjsdefault" : true,"stretching" : "uniform","renderCaptionsNatively" : false,"sources" : <?php echo json_encode($sour, JSON_UNESCAPED_SLASHES) ?>,"captions" : { "fontSize" : 15,"backgroundOpacity" : 35,"fontFamily": "Arial"},"tracks" : [{ "file" : "<?php echo $sub1 ?>", "label" : "default","default": true }],advertising: { client: "vast",schedule: { "myAds": { "offset":"pre", "tag": "<?php echo $iklan?>" }}},});
    </script>
</body>
</html>
