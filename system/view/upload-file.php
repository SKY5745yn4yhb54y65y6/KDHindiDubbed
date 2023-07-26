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
<?php
   $token = token("refresh",$_SESSION[email]);
   $token = $token['access_token'];
   ?>
<?php if(isset($_POST['share'])):?>
<?php if($_POST[id]):?>
<div class="container-fluid">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Shared File</h1>
   </div>
   <div class="row">
      <div class="col-xl-12 col-md-12 mb-4">
         <div class="card shadow mb-4">
            <div class="card-body">
               <?php
                  $id_ = str_replace(array('[',']','"'),'',json_encode($_POST[id], JSON_NUMERIC_CHECK));
                  $cut = explode(',', $id_);
                  foreach ($cut as $id) {
                  anyone2($id,$token);
                  if($id) {
                  $files = json_decode(load("https://www.googleapis.com/drive/v3/files/$id?fields=fileExtension%2Cmd5Checksum%2CmimeType%2Cname%2Csize%2CthumbnailLink&access_token=$token"), true);
                  if(isset($_SESSION[email],$id,$files[name],$files[fileExtension],$files[size],$files[mimeType])) {
                  activity($_SESSION[email],$id,$files[name],$files[fileExtension],$files[size],$files[mimeType]);
                  echo "<br>";
                  } else {
                  echo "Error $id";
                  echo "<br>";
                  }
                  }
                  }
                  ?>
            </div>
         </div>
      </div>
   </div>
</div>
<?php endif;?>
<?php else:?>
<?php
   $list = menu_file($token,$_GET[next],urlencode($_GET[q]));
   ?>
<!-- Begin Page Content -->
<div class="container-fluid bg-gradient-dark">
   <!-- Page Heading -->
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h5 mb-0 mt-4 text-white"><i class="fas fa-cloud-upload-alt"></i> Upload From Drive</h1>
   </div>
   <!-- Page Heading -->
   <!-- Content Row -->
   <div class="row">
      <div class="col-xl-12 col-md-12 mb-4">
         <!-- Thankyou For Choosing Us -->
         <div class="card shadow mb-4">
            <div class="card-body">
               <form method="get" action="menu.php">
                  <div class="form-group" style="padding:0 0 15px">
                     <div class="input-group">
                        <input type="hidden" name="s" value="upload-file" class="form-control form-control-sm" placeholder="Search for...">
                        <input class="form-control form-control-sm" type="text" name="q" class="form-control form-control-sm" placeholder="Search for...">
                        <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" type="submit"> Go!</button>
                        </span>
                     </div>
                  </div>
               </form>
               <form method="post">
                  <div class="table-responsive">
                     <table class="table table-hover" id="myTable" width="100%" cellspacing="0">
                        <thead>
                           <tr>
                              <th><input type="checkbox" id="checkAll"></th>
                              <th>File Name <button type="button" class="btn btn-primary btn-sm" style="font-size:10px;padding:2px;border:2px" onclick="sortTable()">Sort</button></th>
                              <th>File Size</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              foreach($list[files] as $oo) {
                                  if($oo[fileExtension]) {
                                  echo"
                               <tr>
                                <th scope=\"row\" align=\"center\">
                              <input name=\"id[]\" value=\"$oo[id]\" type=\"checkbox\" id=\"checkItem\">
                                         </th>
                                <td>$oo[name]</td>
                                <td>".formatBytes($oo[size])."</td>
                               </tr>";
                                      
                                  }
                                  
                              }
                              ?>
                        </tbody>
                     </table>
                  </div>
                  <button class="btn btn-primary" type="submit" name="share">Share</button>
                  <?php
                     if($list[nextPageToken]) {
                         if($_GET[q]) {
                             $link = "menu.php?s=upload-file&q=".urlencode($_GET[q]);
                             
                         } else {
                     
                     $link = "menu.php?s=upload-file";
                     }
                     echo "<a href=\"$link&next=$list[nextPageToken]\" class=\"btn btn-info\" type=\"submit\"> Load More</a>";
                     }
                     ?>
               </form>
            </div>
         </div>
         <!-- Approach -->
      </div>
   </div>
   <!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<script type="text/javascript">
   //<![CDATA[
   	$(function(){
   			$("#checkAll").click(function () {
      				$('input:checkbox').not(this).prop('checked', this.checked);
   			});
   	});
   //]]>
</script>
<script>
   function sortTable() {
       var table, rows, switching, i, x, y, shouldSwitch;
       table = document.getElementById("myTable");
       switching = true;
       /*Make a loop that will continue until
       no switching has been done:*/
        while (switching) {
       //start by saying: no switching is done:
       switching = false;
       rows = table.rows;
       /*Loop through all table rows (except the
       first, which contains table headers):*/
       for (i = 1; i < (rows.length - 1); i++) {
       //start by saying there should be no switching:
       shouldSwitch = false;
       /*Get the two elements you want to compare,
       one from current row and one from the next:*/
       x = rows[i].getElementsByTagName("TD")[0];
       y = rows[i + 1].getElementsByTagName("TD")[0];
       //check if the two rows should switch place:
       if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
       //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
           
       }
   }
   if (shouldSwitch) {
        /*If a switch has been marked, make the switch
           and mark that a switch has been done:*/
       rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
       switching = true;
        }
   }
   }
</script>
<?php endif;?>
<?php endif;?>