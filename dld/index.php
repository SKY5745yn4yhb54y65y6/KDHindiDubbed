<?php
session_start();
error_reporting(0);
include "../system/aes.php";
if(isset($_COOKIE['crypt'])){
        $_SESSION['email'] = AES("decrypt",$_COOKIE['crypt']);
    }
$share = json_decode(file_get_contents("../base/data/main/share/$_GET[id].json"), true);
$users = json_decode(file_get_contents("../base/data/user/".$share[file][user_id].".json"),true);
$formatv = explode("/",$share['file']['mime']);
$formatv = $formatv['0'];
$_GET['s'] = $share['file']['title'];
if(isset($_SESSION['email'])){
$ses = json_decode(file_get_contents("../base/data/user/".$_SESSION[email].".json"),true);
$ses = $ses['role'];
} else {
$ses = null;
}
include "../system/function.php";
include "../system/view/header.php";
$id= $_GET['id'];
?>
 <?php if($users['role'] == "blacklist"):?>
    <div class="container-fluid bg-gradient-dark">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-9 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary" align="center">FILE BLOCKED !</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fa fa-exclamation-triangle fa-xl"></i>
                            <br>
                            The file you are trying to access is blocked due to violates our website policy
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif($share['file']['status'] == "delete"):?>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-9 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary" align="center">The file has been deleted !</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fa fa-exclamation-triangle fa-xl"></i>
                            <br>
                            The file you are trying to access is no longer available
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif($share['file']['title'] == null):?>
    <div class="container-fluid bg-gradient-dark">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-9 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary" align="center">File not found !</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fa fa-exclamation-triangle fa-xl"></i>
                            <br>
                            The file you are trying to access cannot be found on this server
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else:?>
<div class="container-fluid bg-gradient-dark">
<div id="down-id" hidden="true"><?php echo $id ?></div>
<div class="row justify-content-center">
<div class="col-lg-9 col-md-9 mb-4">
<div class="card shadow mb-4 mt-4 bg-dark text-light">
<div class="card-header py-3 bg-gradient-dark">
<h5 class="m-0 font-weight-bold text-light" align="center"><i class="fa fa-cog fa-spin fa-fw"></i>Download Link Generated !!</h5>
</div>
<div align="center" class="card-body">
<h6 class="m-0 font-weight-bold text-light" align="center"><?php echo $share['file']['title']?></h6><br>
<button onclick="myDownload();" id="down" class="btn btn-outline-light btn-user font-weight-bold" target="_blank"><i class="fas fa-cloud-download-alt"></i> Download Here <?php echo formatBytes($share['file']['size'])?></button>
<br>
<?php if(config("player") == "enable" && $formatv == "video"):?>
<br><hr>
<?php else:?>
<br><a class="btn btn-outline-light btn-user font-weight-bold" href="/stream/<?php echo $_GET['id']?>" target="_blank"><i class="fas fa-video"></i> Play/Stream Video</a>
<?php endif;?>

</div>
<br>
<br>
<br>
<div class="card">
</div>
</div>
</div>
</div>
</div>
</div>
 <br>
<br>                    
<br>                
<br> 
<script>
    function myDownload() {
    var e = document.getElementById("down-id").innerHTML;
    document.getElementById("down").innerHTML = '<i class="fa fa-spinner"></i>  Downloading', document.getElementById("down").disabled = !0;
    var a = window.setTimeout(function() {
        document.getElementById("down").innerHTML = '<i class="fa fa-spinner"></i> Still loading..'
    }, 6e3);
    $.ajax({
        url: "../ajax.php?ajax=download",
        type: "POST",
        dataType: "json",
        data: "id=" + e,
        success: function(e) {
            "200" == e.code ? (window.clearTimeout(a), window.location.href = e.file) : swal("Code : " + e.code, "Message : " + e.file, "error")
        },
        error: function(e, a, t) {
            alert("Status: " + a + "\n" + t)
        }
    })
}
</script>
<?php echo config('banner2')?>
<noscript>
alert("please enable JavaScript in your browser");
</noscript>
<?php endif;?>
<?php
include "../system/view/footer.php";
?>
<?php if(!isset($_SESSION['email']))
{
    echo 'You Must Login';
    exit;
}
?>