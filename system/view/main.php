<?php if(!empty($_SESSION['email'])):?>
<?php 
// if($_POST['trash']) { 
//     $ch = curl_init();
//     curl_setopt($ch, CURLOPT_URL, "https://www.googleapis.com/drive/v3/files/trash?key='.$token.'");
//     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//         'Content-type: application/json',
//         'Authorization: Bearer ' . $token
//     ));
//     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     $result = curl_exec($ch);
//     curl_close($ch);
    
// };

?>
  <script async="async" type="text/javascript" src="/assets/js/get-user-stats.js"></script>
<!-- Begin Page Content -->
        <div class="container-fluid bg-gradient-dark">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-light  bg-gradient-warning shadow h-100 py-2">
                <div class="card-body bg-gradient-warning">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Files</div>
                      <div class="h5 mb-0 font-weight-bold text-white" id="usershare">loading...</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-file fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-light bg-gradient-success shadow h-100 py-2">
                <div class="card-body bg-gradient-success">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Downloads</div>
                      <div class="h5 mb-0 font-weight-bold text-white" id="userdownload">loading...</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-download fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!--Total Size Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-light bg-gradient-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-white text-uppercase mb-1">Drive Used</div>
                      <div class="h5 mb-0 font-weight-bold text-white" id="sizeuser">loading...</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-folder fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Broken Link Card -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-light bg-gradient-danger shadow h-100 py-2">
                <div class="card-body bg-gradient-danger">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-light text-uppercase mb-1">Broken Links</div>
                      <div class="h5 mb-0 font-weight-bold text-white" id="userbroken">loading...</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-unlink fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
<div class="card border-left-primary shadow h-100 py-2 bg-gradient-info">
<div class="card-body">
<div class="row no-gutters align-items-center">
<div class="col mr-2">
<div class="text-xs font-weight-bold text-light text-uppercase mb-1">
<form method="post">
<button class="btn btn-dark" type="submit" name="trash">Clear Trash</button></form></div></div>
<div class="col-auto">
<i class="fas fa-trash fa-2x float-right text-light"></i><br>
<div class="font-weight-bold float-right text-light" id="">0 Bytes</div>
</div>
</div>
</div>
</div>
</div>

          <div class="col-xl-12 col-md-12 mb-4">

<div class="card shadow mb-4 bg-dark">
<div class="card-header py-3 bg-dark">
<h6 class="m-0 font-weight-bold text-light"><i class="fa fa-lightbulb-o"></i> Features of Latest <?php echo config('site.title')?>:</h6>
</div>
<div class="card-body">
<div class="text-center">
</div>
<div class="text-justify text-light">
<p>1) <img src="/assets/img/new.gif"> <b class="text-warning">Shared Drives/Team Drives Support: Now you can upload from Shared Drives/Team Drives via upload links option. And You can copy files too from Shared Drives/Team Drives to My Drive. Your File permission must be "Anyone with the link".</b></p>
<p>2) <img src="/assets/img/new.gif"> We have also made a unique technique to bypass the new <b class="text-warning">GOOGLE DRIVE RATE LIMIT</b>. If your drive files have been shared via new <?php echo config('site.title')?> only, We will stop new drive limit to Great Extent. (If you share same drive file via another sharing site, then your that drive may come into limit.)</p>
<p> 3) <img src="/assets/img/new.gif"> File Recovery: If Uploader's file gets lost, Our latest <?php echo config('site.title')?> feature will try to provide download from <b class="text-warning">ALL LAST DOWNLOADED</b> files. By this way, uploader's file will be available almost always.</p>
<p>4) Copy Folder: Now You can copy all files of a folder from other google drive to your google drive in one click. Just paste folder url and Click Copy.</p>
<p>5) Upload Folder: Now you can share all files of a folder in one click. Just paste folder url, make sure folder permission should be "Anyone with the link".</p>
<p>And Many more new features to save your time. Just use and feel it...</p>
</div>
</div>
</div>

</div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      
<?php else:?>

        <!-- Begin Page Content -->
        <div class="container-fluid bg-gradient-dark">
          <!-- Page Heading -->
          <!-- Content Row -->
          <div class="row">
              <div class="col-xl-12 col-md-12 mb-4">
              <!-- Tankyou For Choosing Us -->
              <div class="card shadow mb-4 bg-gradient-dark">
                <div class="card-header bg-gradient-dark py-3">
                  <h4 class="m-0 font-weight-bold text-primary" align="center">Welcome To <?php echo config('site.title')?></h4>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;" src="/assets/img/neo2.png" alt="">
                  </div>
                  <div class="text-center text-light">
                     <p><?php echo config('site.title')?> Provides Google Drive File Manager. Simple Plot to Manage and Share Drive with your Friends!</p>
                            <hr><p style="color:#BEBEBE;">You need to login to start sharing your GDrive</p>
                             <a href="/login"><img src="/assets/img/google.png" style="height:50px; width:auto"></a>
                     <p style="color:#BEBEBE; font-size:16px;">Don't have an account? <a class="text-success" href="/login">Sign Up !</a></p>
                    </div>
                </div>
              </div>

              <!-- Approach -->

            </div>

            <!-- Card -->
            <!--<div class="col-xl-3 col-md-6 mb-4">-->
            <!--  <div class="card border-left-primary shadow h-100 py-2">-->
            <!--    <div class="card-body">-->
            <!--      <div class="row no-gutters align-items-center">-->
            <!--        <div class="col mr-2">-->
            <!--          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Users</div>-->
            <!--          <div class="h5 mb-0 font-weight-bold text-gray-800" id="totaluser">loading...</div>-->
            <!--        </div>-->
            <!--        <div class="col-auto">-->
            <!--          <i class="fas fa-user fa-2x text-gray-300"></i>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->

            <!-- Card -->
            <!--<div class="col-xl-3 col-md-6 mb-4">-->
            <!--  <div class="card border-left-primary shadow h-100 py-2">-->
            <!--    <div class="card-body">-->
            <!--      <div class="row no-gutters align-items-center">-->
            <!--        <div class="col mr-2">-->
            <!--          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Files</div>-->
            <!--          <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalshare">loading...</div>-->
            <!--        </div>-->
            <!--        <div class="col-auto">-->
            <!--          <i class="fas fa-share fa-2x text-gray-300"></i>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->

            <!--Total Size Card -->
            <!--<div class="col-xl-3 col-md-6 mb-4">-->
            <!--  <div class="card border-left-primary shadow h-100 py-2">-->
            <!--    <div class="card-body">-->
            <!--      <div class="row no-gutters align-items-center">-->
            <!--        <div class="col mr-2">-->
            <!--          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Space Used</div>-->
            <!--          <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalsize">loading...</div>-->
            <!--        </div>-->
            <!--        <div class="col-auto">-->
            <!--          <i class="fas fa-folder fa-2x text-gray-300"></i>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->

            <!-- Broken Link Card -->
            <!--<div class="col-xl-3 col-md-6 mb-4">-->
            <!--  <div class="card border-left-primary shadow h-100 py-2">-->
            <!--    <div class="card-body">-->
            <!--      <div class="row no-gutters align-items-center">-->
            <!--        <div class="col mr-2">-->
            <!--          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Downloads</div>-->
            <!--          <div class="h5 mb-0 font-weight-bold text-gray-800" id="totaldownload">loading...</div>-->
            <!--        </div>-->
            <!--        <div class="col-auto">-->
            <!--          <i class="fas fa-download fa-2x text-gray-300"></i>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
            
<?php endif;?>
