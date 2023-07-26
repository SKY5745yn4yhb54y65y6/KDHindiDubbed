<?php
/*
@author gusmanu
@link github.com/gusmanu
@Multi Server Player
*/


error_reporting(0);
session_start();
include "system/function.php";
if($_GET['id']) {

	$share = json_decode(file_get_contents("base/data/main/share/$_GET[id].json"), true);
	$name = $share['file']['title'];
	$setting = json_decode(file_get_contents("base/data/setting/config.json"),true);
	$account = json_decode(file_get_contents("base/data/setting/mirror.json"),true);
    $site = config('site.domain');
    $gd = "https://$site/play.php?id=$_GET[id]";
    $idsub = $share['file']['poster'];
    $subtitle = "https://$site/subtitle/$idsub";
    $csf = $share['file']['vidtrack'];
    if($csf == null ) {
	$cs1 = null; } else {
	$cs = checkvid($account['viduser'],$account['vidkey'],$csf);
	$cs1 = $cs['result']['0']['url']; }
    
    if($cs1 != null){
	$cs2 = explode("/",$cs1);
	$cs3 = "https://vcstream.to/embed/$cs2[4]";} else { $cs3 = null; }
	$openplayer = null;
	
	
}

?>

<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style type="text/css">
    	
    	.tombol {
    		border:1px solid #1a7bff;
    		width: 100%;
    	}
    	.tombol2 {
    		border:1px solid #1a7bff;
    		width: 100%;margin-top: 4px;
    		margin-bottom: 4px;
    	}
    	.header-video {
    		padding-top: 8px;
            padding-bottom: 8px;
    	}

        body {
            overflow:hidden;
        }
        #sticky-footer2 {
                width:120px;
        flex-shrink: none;
        position:fixed;
        top:0;
        right:0;
        text-align:left;
        margin-right: -105px;
        margin-top: 0px;
    }

    </style>

    <title><?php echo "$name"; ?></title>
  </head>
  <body style="background-color:black" onload="playVideo()">

	<div id="iframe">
	</div>

	<div id="sticky-footer2" onmouseover="tampilButton(this)" onmouseout="normalButton(this)">
		<div class="header-video text-light bg-dark"><span onclick="buka()">  SERVER </span><span style="margin-top:-4px" onclick="tutup()" class="btn btn-sm btn-secondary"><i class="fa fa-times" aria-hidden="true"></i></span></div>
		<div style="background-color: white;padding: 4px" onclick="buka()">
			<button onclick="gantiSource(video1)" class="btn btn-sm btn-outline-primary tombol">Drive</button>
			<button onclick="gantiSource(video2)" class="btn btn-sm btn-outline-primary tombol" style="margin-bottom: 4px">Vidcloud</button>
			<button onclick="gantiSource(video3)" class="btn btn-sm btn-outline-primary tombol" style="margin-bottom: 4px">Server 3</button>
		</div>
        
	</div>

	<script type="text/javascript">
		
		var video1 = '<?php echo $gd ?>';
    	var video2 = '<?php echo $cs3 ?>';
    	var video3 = '<?php echo $openplayer ?>';
    	
    	function playVideo() {
    		document.getElementById("iframe").innerHTML='<iframe id="full-screen-me" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%" frameborder="0" wmode="transparent" src="' + video1 + '" allowfullscreen></iframe>';
            window.onresize = autoResizeDiv;
            autoResizeDiv();
    	}

		function gantiSource(server) {
			if(server === undefined || server == null || server.length <= 0 || server <= false) {
				alert("Sorry, Server not available!");
			}
			else {
				document.getElementById("full-screen-me").src=server;
			}
		}

		function tampilButton(x) {
            x.style.right = '105px';
            
        }

        function normalButton(x) {
            x.style.right = '0px';
            
        }

        function tutup() {
            document.getElementById("sticky-footer2").style.right='0px';
            
        }
        
        function buka() {
            document.getElementById("sticky-footer2").style.right='105px';
            
        }

        function autoResizeDiv()
        {
            document.getElementById('full-screen-me').style.height = window.innerHeight +'px';
        }
        window.onresize = autoResizeDiv;
        autoResizeDiv();

	</script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
