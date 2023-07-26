<?php if(config('site.webset') == "private" && $user[role] == "member"):?>
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
         },
         complete:function() {
           $("textarea").attr("disabled",false);							
         },
         success:function(subscene) {
           var txt = $("textarea");
           if(txt.val().trim().length < 1) {
            swal ( "Ops" ,  "URL is empty !" ,  "error" )
           }else{
             document.getElementById("card-subscene").hidden = false;
             $("#data_subscene").after(subscene);
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
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Subscene <small class="badge badge-primary align-top">beta</small>  <a href="#" data-toggle="tooltip" data-placement="bottom" title="Example url : &#13;&#10; https://subscene.com/subtitles/the-good-doctor-us-third-season/indonesian/2152414"><i class="fa fa-info-circle fa-sm"></i></a></h1>
   </div>
   <!-- Page Heading -->
   <!-- Content Row -->
   <div class="row">
      <div class="col-xl-12 col-md-12 mb-4">
         <!-- Tankyou For Choosing Us -->
         <div class="card shadow mb-4">
            <div class="card-body">
               <div class="text-center">
                  <form method="post" action="ajax.php?ajax=subscene">
                     <div class="form-group">
                        <textarea class="form-control" rows="10" cols="5" name="url" placeholder="Max 1 URL per submit &#13;&#10; &#13;&#10;Example url : https://subscene.com/subtitles/the-good-doctor-us-third-season/indonesian/2152414"></textarea>
                     </div>
                     <br>
                     <button class="btn btn-primary" type="submit">Submit</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="card shadow mb-4" id="card-subscene" hidden="true">
            <div class="card-body">
               <div id="data_subscene" class="data">
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