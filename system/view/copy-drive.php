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
<script type="text/javascript">
   $(function(){
       $("form").submit(function(e){
         e.preventDefault();
         $.ajax({
           url:$(this).attr("action"),
           data:$(this).serialize(),
           type:$(this).attr("method"),
           dataType: 'html',
           beforeSend: function() {
             $("textarea").attr("disabled",true);
             $("button").attr("disabled",true);
           },
           complete:function() {
             $("textarea").attr("disabled",false);
             $("button").attr("disabled",false);								
           },
           success:function(copy) {
             var txt = $("textarea");
             if(txt.val().trim().length < 1) {
              swal ( "Oops" ,  "URL is empty ! " ,  "error" )
             }else{
               document.getElementById("card-copy").hidden = false;
               $("#data_copy").after(copy);
               $("form")[0].reset();
             }
           }
         })
         return false;
       });
     });

$(document).ready(function(){
   $('[data-toggle="tooltip"]').tooltip();   
   });
</script>
<!-- Begin Page Content -->
<div class="container-fluid bg-gradient-dark">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h5 mb-0 mt-4 text-white"><i class="fas fa-fw fa-copy"></i> Copy File <a href="#" data-toggle="tooltip" data-placement="bottom" title="Valid url : &#13;&#10; https://drive.google.com/file/d/fileid &#13;&#10; https://drive.google.com/open?id=file"><i class="fa fa-info-circle fa-sm"></i></a></h1>
   </div>
   <!-- Page Heading -->
   <!-- Content Row -->
   <div class="row">
      <div class="col-xl-12 col-md-12 mb-4">
         <!-- Tankyou For Choosing Us -->
         <div class="card shadow mb-4">
            <div class="card-body">
               <div class="text-center">
                  <form method="post" action="ajax.php?ajax=copy-drive">
                     <div class="form-group">
                        <textarea class="form-control" rows="10" cols="5" name="url" placeholder="https://drive.google.com/open?id=1Io5M4gLiVE50bMcCbxwjLk_FrtshghLG"></textarea>
                     </div>
                     <br>
                     <button class="btn btn-primary" type="submit">Submit</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="card shadow mb-4" id="card-copy" hidden="true">
            <div class="card-body">
               <div id="data_copy" class="data">
               </div>
            </div>
         </div>
         <!-- Approach -->
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<?php endif;?>