<?php if(config('site.webset') == "private" && $user['role'] == "member"):?>
<div class="container-fluid bg-gradient-dark">
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
<script async="async" type="text/javascript" src="/assets/js/get-file2.5.js"></script>
<div class="container-fluid bg-gradient-dark">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h5 mb-0 text-white"><i class="fas fa-share-alt"></i> Shared File</h1>
   </div>
   <!-- Content Row -->
   <div class="row">
      <div class="col-xl-12 col-md-12 mb-4">
         <div class="card shadow mb-4">
            <div class="card-body bg-gradient-dark">
               <div class="form-group" style="padding:0 0 15px">
                  <div class="input-group">
                     <input class="form-control form-control-sm" type="text" id="gopage" class="form-control form-control-sm" placeholder="jump to page...">
                     <span class="input-group-btn">
                     <button class="btn btn-primary btn-sm halamanw" > Jump!</button>
                     </span>
                     <input class="form-control form-control-sm" type="text" id="search" class="form-control form-control-sm" placeholder="find file...">
                     <span class="input-group-btn">
                     <button class="btn btn-primary btn-sm search" > Find!</button>
                     </span>
                  </div>
               </div>
               <div id="data"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalForm" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Body -->
         <div class="modal-body">
            <p class="statusMsg"></p>
            <form role="form">
               <div class="form-group">
                  <label for="masukkanNama">Name</label>
                  <input type="text" class="form-control" id="masukkanId" value="" hidden="true"/>
                  <input type="text" class="form-control" id="masukkanNama" value=""/>
                  <label for="masukkanFileid">File ID</label>
                  <input type="text" class="form-control" id="masukkanFileid"/>
                  <label for="masukkanSubtitle">Subtitle ID</label>
                  <input type="text" class="form-control" id="masukkanSubtitle"/>

               </div>
            </form>
         </div>
         <!-- Modal Footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-primary kirimBtn" data-dismiss="modal">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="delete_info_jump()">Delete</button>
            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
<?php endif;?>