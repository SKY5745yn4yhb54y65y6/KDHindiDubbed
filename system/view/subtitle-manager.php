<?php if(config('site.webset') == "private" && $user['role'] == "member"):?>
<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-9 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary" align="center">Permission Denied !</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fa fa-exclamation-triangle fa-xl"></i>
                            <br>
                            website for private use only
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif($user['role'] == "blacklist"):?>
<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-md-9 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary" align="center">Permission Denied !</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <i class="fa fa-exclamation-triangle fa-xl"></i>
                            <br>
                            Sorry, you have been blocked from using this feature, contact admin for more info !
                            <br>
                            <br>
                            <?php if($user['blacklist.message'] != null):?>
                            Reason : <?php echo $user['blacklist.message']?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else:?>
<!-- Begin Page Content -->
<script async="async" type="text/javascript" src="/assets/js/get-subtitle.js"></script>
<div class="container-fluid">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Subtitle Manager</h1>
   </div>
   <!-- Content Row -->
   <div class="row">
      <div class="col-xl-12 col-md-12 mb-4">
         <div class="card shadow mb-4">
            <div class="card-body">
               <div class="form-group" style="padding:0 0 15px">
                  <div class="input-group">
                     <input class="form-control form-control-sm" type="text" id="gosub" class="form-control form-control-sm" placeholder="Go to page...">
                     <span class="input-group-btn">
                     <button class="btn btn-primary btn-sm halamans" > Go!</button>
                     </span>
                  </div>
               </div>
               <div id="data-subtitle"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php endif;?>