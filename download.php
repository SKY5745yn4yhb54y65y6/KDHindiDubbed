<?php
error_reporting(0);
session_start();
include "system/aes.php";
if(isset($_COOKIE['crypt'])){
        $_SESSION['email'] = AES("decrypt",$_COOKIE['crypt']);
    }
$share = json_decode(file_get_contents("base/data/main/share/$_GET[id].json"), true);
$users = json_decode(file_get_contents("base/data/user/".$share[file][user_id].".json"),true);
$formatv = explode("/",$share['file']['mime']);
$formatv = $formatv['0'];
$_GET['s'] = $share['file']['title'];
if(isset($_SESSION['email'])){
$ses = json_decode(file_get_contents("base/data/user/".$_SESSION[email].".json"),true);
$ses = $ses['role'];
} else {
$ses = null;
}
include "system/function.php";
include "system/view/header.php";
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

    <div class="container-fluid bg-gradient-dark">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-9 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 bg-gradient-dark">
                        <h4 class="m-0 font-weight-bold text-primary" align="center">The file has been deleted !</h4>
                    </div>
                    <div class="card-body bg-gradient-dark">
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
                    <div class="card-body bg-gradient-dark">
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
      <div id="down-id" hidden="true"><?php echo $_GET[id]?></div>
          <!-- Content Row -->
            <div class="row justify-content-center">
              <div class="col-lg-9 col-md-9 mb-4">
              <?php echo config('banner1')?>
              <div class="card shadow bg-gradient-dark mt-4  mb-4">
              	<div class="card-header bg-gradient-dark py-3">
                  <h4 class="m-0 font-weight-bold text-primary" align="center"><?php echo $share['file']['title']?></h4>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless" id="dataTable" width="100%" cellspacing="0">
                          <tbody>
                              <tr style="border-bottom: 0.5px solid #ccc; line-height: 1.8em; font-size:0.8em;">
                                  <td class="text-white"><i class="fas fa-hdd"></i> File Size</td>
                                  <td align="right"><?php echo formatBytes($share['file']['size'])?></td>
                              </tr>
                              <tr style="border-bottom: 0.5px solid #ccc; line-height: 1.8em; font-size:0.8em;">
                                  <td class="text-white"><i class="fas fa-file"></i> File Type</td>
                                  <td align="right"><?php echo $share['file']['mime']?></td>
                              </tr>
<?php //if($ses == "admin"):?>
                              <!--<tr style="border-bottom: 0.5px solid #ccc; line-height: 1.8em;">-->
<?php// else:?>
                              <tr style="border-bottom: 0.5px solid #ccc; line-height: 1.8em; font-size:0.8em;">
<?php //endif;?>
                                  <td class="text-white"><i class="fas fa-cloud-download-alt"></i> Downloads</td>
                                  <td align="right"><?php echo $share['file']['down']?></td>
                              </tr>
<?php //if($ses == "admin"):?>
                              <tr style="border-bottom: 0.5px solid #ccc; line-height: 1.8em; font-size:0.8em;">
                                  <td class="text-white"><i class="fas fa-calendar"></i> Date</td>
                                  <td align="right"><?php echo $share['file']['date']?></td>
                              </tr>
<?php// endif; ?>
                          </tbody>
                    </table>
                    </div>
                    <br>
                    <?php if($share['file']['status'] == "realbroken"):?>
                    <div class="alert-warning" align="center"><i class="fa fa-exclamation-triangle"></i>  This file is broken ! <br> please ask owner to re-upload this file</div>
                    <?php endif;?>
                    <br>
                    <div class="text" align="center">
                        <?php if(isset($_SESSION['email'])):?>
                        <button onclick="myDl('https://<?php echo config('site.domain')?>/dld?id=<?php echo $_GET['id']?>&code=200&gd=<?php echo md5(uniqid(rand(), true)) ?>')" id="down" class="btn btn-outline-light btn-user font-weight-bold"><i class="fa fa-cloud-download-alt"></i>  Download & Play Here <?php echo formatBytes($share['file']['size'])?></button>
<script type="text/javascript">
function myDl(e) {
document.getElementById("down").innerHTML = '<i class="fa fa-spinner fa-spin"></i>  Downloading.. Please wait, it may take some time.';
document.getElementById("down").disabled = !0;
window.location.href = e;
}
</script>
                        <?php //if(config("player") == "enable" && $formatv == "video"):?>
                        <!--<a href="/stream/<?php// echo $_GET['id']?>" class="btn btn-primary btn-user"><i class="fa fa-play-circle"></i>  Streaming</a>-->
                        <?php //else:?>
                        <!--<a href="" class="btn btn-primary btn-user disabled"><i class="fa fa-play-circle"></i>  Streaming</a>-->
                        <?php //endif;?>
                        <?php else:?>
                        <form action="/login.php" method="GET">
                            <input name="r" value="https://<?php echo config('site.domain')?>/file/<?php echo $_GET['id']?>" type="hidden">
                            <button class="btn btn-outline-light btn-user font-weight-bold" type="submit"><i class="fa fa-cloud-download-alt"></i>  Download & Play Here </button>
                            <?php// if(config("player") == "enable" && $formatv == "video"):?>
                            <!--<a href="/stream/<?php echo $_GET['id']?>" class="btn btn-primary btn-user"><i class="fa fa-play-circle"></i>  Streaming</a>-->
                            <?php// else:?>
                            <!--<a href="" class="btn btn-primary btn-user disabled"><i class="fa fa-play-circle"></i>  Streaming</a>-->
                            <?php// endif;?>
                        </form>
                        <?php endif;?>
                        <br><br>
                        <?php if(isset($share['file']['mirror'])):?>
                        <button type="button" onClick="window.location.href='<?php echo $share['file']['mirror']?>'" class="btn btn-dark btn-sm"><i class="fa fa-link"></i> Multiup</button>
                        <?php endif;?>
                        <?php if(isset($share['file']['ace'])):?>
                        <button type="button" onClick="window.location.href='<?php echo $share['file']['ace']?>'" class="btn btn-dark btn-sm"><i class="fa fa-link"></i> MirrorAce</button>
                        <?php endif;?>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="text" align="left">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#link" role="tab" data-toggle="tab">Link</a>
                            </li>
                            <li class="nav-item">
                                 <a class="nav-link" href="#html" role="tab" data-toggle="tab">Html</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#embed" role="tab" data-toggle="tab">Embed</a>
                            </li>
                        </ul>
                    </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade show active" id="link">
                        <div class="card">
                            <div class="card-body">
                                    <p onclick="copy(this)">https://<?php echo config('site.domain')?>/file/<?php echo $_GET[id] ?></p>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="html">
                        <div class="card">
                            <div class="card-body">
                                    <p onclick="copy(this)">&lt;a href=&quot;https://<?php echo config('site.domain')?>/file/<?php echo $_GET[id] ?>&quot;&gt; <?php echo $share[file][title]?> - <?php echo formatBytes($share[file][size])?>&lt;/a&gt;</p>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="embed">
                        <div class="card">
                            <div class="card-body">
                                    <p onclick="copy(this)">&lt;iframe src=&quot;https://<?php echo config('site.domain')?>/stream/<?php echo $_GET[id] ?>&quot; frameborder=&quot;0&quot; width=&quot;100%&quot; height=&quot;300&quot; allowfullscreen=&quot;allowfullscreen&quot;&gt&lt;/iframe&gt;</p>
                            </div>
                        </div>
                    </div>
                </div>
                        
                    </div>
                    <br>
                </div>
              </div>
            </div>
        </div>
        <!-- /.container-fluid -->
      </div>

<?php echo config('banner2')?>

<noscript>
alert("please enable JavaScript in your browser");
</noscript>
<?php endif;?>
<?php
include "system/view/footer.php";
?>