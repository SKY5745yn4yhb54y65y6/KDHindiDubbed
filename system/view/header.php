<?php
   error_reporting(0);
   if(isset($_GET['s'])){
       $judul = $_GET['s'];
   } else {
       $judul = config('site.description');
   }
   $user = json_decode(file_get_contents("base/data/user/$_SESSION[email].json"), true);
   $domain = config('site.domain');
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <?php echo head_content()?>

      <title><?php echo config('site.title')?> | <?php echo $judul?></title>
      <!-- Custom fonts for this template-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script async="async" type="text/javascript" src="/assets/js/codedrivev2.5.min.js"></script>
      <script async="async" type="text/javascript" src="/assets/js/get-stats2.5.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
      <link href="/assets/css/sb-admin-2.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
      <link rel="shortcut icon" href="/assets/img/favicon.ico">
   </head>
   <body id="page-top">
      <!-- Page Wrapper -->
      <div id="wrapper">
          <?php if(!empty($_SESSION['email'])):?>
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion toggled" id="accordionSidebar">
         <!-- Sidebar - Brand -->
         <a class="sidebar-brand d-flex align-items-center justify-content-center" href="https://<?php echo $domain?>">
            <div class="sidebar-brand-icon rotate-n-15">
               <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3"><?php echo config('site.title')?></div>
         </a>
         <!-- Divider -->
         <hr class="sidebar-divider my-0">
         <!-- Nav Item - Dashboard -->
         <?php if($user['role'] == "admin"):?>
         <li class="nav-item active">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-user-circle"></i>
            <span>Admin</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
               <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Admin Menu:</h6>
                  <a class="collapse-item" href="https://<?php echo $domain?>">Dashboard</a>
                  <a class="collapse-item" href="/setting">Web Setting</a>
                  <a class="collapse-item" href="/file-manager">File Manager</a>
                  <a class="collapse-item" href="/user-manager">User Manager</a>
               </div>
            </div>
         </li>
         <?php else:?>
         <li class="nav-item active">
            <a class="nav-link" href="https://<?php echo $domain?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
         </li>
         <?php endif;?>
         <!-- Divider -->
         <hr class="sidebar-divider">
         <!-- Heading -->
         <div class="sidebar-heading">
            File
         </div>
          <li class="nav-item active">
            <a class="nav-link" href="/copy-drive">
            <i class="fas fa-fw fa-copy"></i>
            <span>Copy File</span></a>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="/upload-folder">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Copy Folder</span></a>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="/upload-link">
            <i class="fas fa-fw fa-link"></i>
            <span>Upload Link</span></a>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="/shared-file">
            <i class="fas fa-fw fa-share"></i>
            <span>Shared Files</span></a>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="/upload-file">
           <i class="fas fa-cloud-upload-alt"></i>
            <span>Upload Drive</span></a>
         </li>
         <li class="nav-item active">
            <a class="nav-link" href="/broken">
            <i class="fas fa-fw fa-unlink"></i>
            <span>Broken File</span></a>
         </li>
         <!-- Divider -->
         <!--<hr class="sidebar-divider">-->
         <!-- Heading -->
         <!--<div class="sidebar-heading">-->
         <!--   Tools-->
         <!--</div>-->
         <!--  <li class="nav-item active">-->
         <!--   <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSubs" aria-expanded="true" aria-controls="collapseTwo">-->
         <!--   <i class="fas fa-fw fa-closed-captioning"></i>-->
         <!--   <span>Subtitle</span>-->
         <!--   </a>-->
         <!--   <div id="collapseSubs" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">-->
         <!--      <div class="bg-white py-2 collapse-inner rounded">-->
         <!--         <h6 class="collapse-header">Subtitle Menu:</h6>-->
         <!--         <a class="collapse-item" href="/upload-subtitle">Upload Subtitle</a>-->
         <!--         <a class="collapse-item" href="/subscene">Upload from Subscene</a>-->
         <!--         <a class="collapse-item" href="/subtitle-manager">Subtitle Manager</a>-->
         <!--      </div>-->
         <!--   </div>-->
         <!--</li>-->
         <hr class="sidebar-divider d-none d-md-block">
           <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
         </div>
         <?php else:?>
         <!-- Nav Item - Dashboard -->
         <!--<li class="nav-item active">-->
         <!--   <a class="nav-link" href="/login">-->
         <!--   <i class="fas fa-fw fa-sign-in-alt"></i>-->
         <!--   <span>Login</span></a>-->
         <!--</li>-->
         <!--<li class="nav-item active">-->
         <!--   <a class="nav-link" href="/page/privacy-policy">-->
         <!--   <i class="fas fa-fw fa-user-secret"></i>-->
         <!--   <span>Privacy Policy</span></a>-->
         <!--</li>-->
         <!--<li class="nav-item active">-->
         <!--   <a class="nav-link" href="/page/terms-conditions">-->
         <!--   <i class="fas fa-fw fa-align-justify"></i>-->
         <!--   <span>Terms & Conditions</span></a>-->
         <!--</li>-->
         <!--<li class="nav-item active">-->
         <!--   <a class="nav-link" href="/page/copyright-policy">-->
         <!--   <i class="fas fa-fw fa-copyright"></i>-->
         <!--   <span>Copyright Policy</span></a>-->
         <!--</li>-->
         <?php endif;?>
         <!-- Divider -->
         
         <!-- Sidebar Toggler (Sidebar) -->
      </ul>
      <!-- End of Sidebar -->
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content bg-gradient-dark">
      <!-- Topbar -->
  
      <nav class="navbar navbar-expand bg-gradient-dark topbar  static-top dark">
         <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
         <i class="fa fa-bars"></i>
         </button>
         <ul class="navbar-nav ml-auto">
             <li><a class="nav-link" href="/"><img class="img-profile" src="/assets/img/neool.png"></a></li>
            <?php if(!empty($_SESSION['email'])):?>
<!--<li class="nav-item dropdown no-arrow mx-1">-->
<!--<a class="nav-link" href="/"><img class="img-profile" src="/assets/img/yourlogo.png"><img class="img-profile" src="/assets/img/neool.png"></a>-->
<!--         <div class="topbar-divider d-none d-sm-block"></div>-->
<!--              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                <i class="fas fa-bell fa-fw"></i>-->
                <!-- Counter - Alerts -->
<!--                <span class="badge badge-danger badge-counter">3+</span>-->
<!--              </a>-->
              <!-- Dropdown - Alerts -->
<!--              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">-->
<!--                <h6 class="dropdown-header bg-gradient-dark">-->
<!--                  Updates Info-->
<!--                </h6>-->
<!--<a class="dropdown-item d-flex align-items-center" href="#">-->
<!--                  <div class="mr-3">-->
<!--                    <div class="icon-circle bg-dark">-->
<!--                      <i class="fa fa-check text-white"></i>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <div>-->
<!--                    <div class="small text-gray-500">February 26, 2020</div>-->
<!--                    New Feature : Multi-Resolution Player <br> -->
<!--                  </div>-->
<!--                </a>-->
<!--                <a class="dropdown-item d-flex align-items-center" href="#">-->
<!--                  <div class="mr-3">-->
<!--                    <div class="icon-circle bg-dark">-->
<!--                      <i class="fa fa-check text-white"></i>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <div>-->
<!--                    <div class="small text-gray-500">January 5, 2020</div>-->
<!--                    New Feature : Prevent-Broken <br> Automatically re-generate link when your original file is broken. (file at least downloaded once)-->
<!--                  </div>-->
<!--                </a>-->
<!--                <a class="dropdown-item d-flex align-items-center" href="#">-->
<!--                  <div class="mr-3">-->
<!--                    <div class="icon-circle bg-dark">-->
<!--                      <i class="fa fa-exclamation text-white"></i>-->
<!--                    </div>-->
<!--                  </div>-->
<!--                  <div>-->
<!--                    <div class="small text-gray-500">January 12, 2020</div>-->
<!--                    Mirrorace feature temporarily disabled by Admin-->
<!--                  </div>-->
<!--                </a>-->
<!--                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>-->
<!--              </div>-->
<!--            </li>-->

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
<style>
.Blink {animation: blinker 0.3s cubic-bezier(.5, 0, 1, 1) infinite alternate;  
}@keyframes blinker { from { opacity: 1; }to { opacity: 0; }}
</style>

            <li class="nav-item dropdown no-arrow">
               <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <span class="mr-2 d-none d-lg-inline text-gray-600 small"><i class="fas fa-robot fa-2x Blink text-gradient-success"></i> <?php echo $user[name]?></span>
               <img class="img-profile rounded-circle" src="<?php echo $user['picture']?>">
               </a>
               <!-- Dropdown - User Information -->
               <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in bg-gradient-secondary" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="/profile">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-white"></i>
                  Profile
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/login.php?action=logout" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-white"></i>
                  Logout
                  </a>
               </div>
            </li>
         </ul>
         <?php else:?>
         <!--<img class="img-profile" src="/assets/img/neool.png">-->
         <!--<div class="topbar-divider d-none d-sm-block"></div>-->
         <a class="btn btn-md btn-outline-light" href="/login">Login | Register</a>
         <?php endif;?>
       </ul>
      </nav>
