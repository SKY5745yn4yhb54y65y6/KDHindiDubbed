<?php if($user['role'] == "admin"):?>
<!-- Begin Page Content -->
<script async="async" type="text/javascript" src="/assets/js/get-admin-file.js"></script>
<div class="container-fluid">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">File Manager</h1>
   </div>
   <div class="row">
      <div class="col-xl-12 col-md-12 mb-4">
         <div class="card shadow mb-4">
            <div class="card-body">
               <div class="form-group" style="padding:0 0 15px">
                  <div class="input-group">
                     <input class="form-control form-control-sm" type="text" id="gopage" class="form-control form-control-sm" placeholder="Go to page...">
                     <span class="input-group-btn">
                     <button class="btn btn-primary btn-sm halamanmgr" > Go!</button>
                     </span>
                     <input class="form-control form-control-sm" type="text" id="gofilemgr" class="form-control form-control-sm" placeholder="Go to file id...">
                     <span class="input-group-btn">
                     <button class="btn btn-primary btn-sm" onclick="get_jump_info_adm()"> Go!</button>
                     </span>
                  </div>
               </div>
               <div id="data-file-mgr"></div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalFormmgr" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <!-- Modal Body -->
         <div class="modal-body">
            <p class="statusMsg"></p>
            <form role="form">
               <div class="form-group">
                  <label for="masukkanNama">Name</label>
                  <input type="text" class="form-control" id="masukkanId" value="" hidden="true"/>
                  <input type="text" class="form-control" id="masukkanNama" value="" disabled/>
                  <label for="masukkanFileid">File ID</label>
                  <input type="text" class="form-control" id="masukkanFileid" disabled/>
               </div>
            </form>
         </div>
         <!-- Modal Footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="delete_info_jump()">Delete</button>
            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>


<?php endif;?>