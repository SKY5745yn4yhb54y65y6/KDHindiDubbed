<?php if($user['role'] == "admin"):?>
<!-- Begin Page Content -->
<script async="async" type="text/javascript" src="/assets/js/table-usr.js"></script>
<div class="container-fluid">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">User Manager</h1>
   </div>
   <div class="row">
      <div class="col-xl-12 col-md-12 mb-4">
         <div class="card shadow mb-4">
            <div class="card-body">
               <div class="form-group" style="padding:0 0 15px">
                  <div class="input-group">
                     <input class="form-control form-control-sm" type="text" id="gopage" class="form-control form-control-sm" placeholder="Go to page...">
                     <span class="input-group-btn">
                     <button class="btn btn-primary btn-sm halamanw" > Go!</button>
                     </span>
                     <input class="form-control form-control-sm" type="text" id="gouser" class="form-control form-control-sm" placeholder="Go to user email...">
                     <span class="input-group-btn">
                     <button class="btn btn-primary btn-sm" onclick="cobaDapet_jump()"> Go!</button>
                     </span>
                  </div>
               </div>
               <div id="data-user"></div>
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
                  <label for="masukkanEm">Email</label>
                  <input type="text" class="form-control" id="masukkanEm" value="" disabled/>
                  <label for="masukkanRole">Role (admin/member/blacklist)</label>
                  <input type="text" class="form-control" id="masukkanRole" value=""/>
                  <label for="masukkanMess">Blacklist Reason</label>
                  <input type="text" class="form-control" id="masukkanMess" value=""/>
               </div>
            </form>
         </div>
         <!-- Modal Footer -->
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary submitBtn" onclick="kirimRoleForm()">Save</button>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript"></script>
<?php endif;?>