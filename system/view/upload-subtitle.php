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
<div class="container-fluid">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Upload Subtitle</h1>
   </div>

   <!-- Page Heading -->
   <!-- Content Row -->
   <div class="row">
      <div class="col-xl-12 col-md-12 mb-4">
         <!-- Tankyou For Choosing Us -->
         <div class="card shadow mb-4">
            <div class="card-body">
               <div class="text-center">
                  <form action="/ajax.php?ajax=subtitle" enctype="multipart/form-data" method="post" class="form-group">
                     File : <br><input id="file_input" type="file" name="file_input" > 
                     <br>
                     <br>
                     <br>                        
                     <input type="submit" name = "upload" class="btn btn-primary" value="Upload">
                  </form>
               </div>
            </div>
         </div>
         <div class="card shadow mb-4">
            <div class="card-body">
               <div id="data_subtitle" class="data">
               </div>
            </div>
         </div>
         <!-- Approach -->
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<script async="async" type="text/javascript">
   $("form").submit(function(evt){	 
      evt.preventDefault();
      var formData = new FormData($(this)[0]);
   $.ajax({
       url: $(this).attr("action"),
       type: $(this).attr("method"),
       data: formData,
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
       success: function(subtitle) {
         $("#data_subtitle").after(subtitle);
       }
   });
   return false;
   });
</script>


<?php endif;?>