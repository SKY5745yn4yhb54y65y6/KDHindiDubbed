<?php if($user[role] == "admin"):?>
   <?php
   $setting = json_decode(file_get_contents("base/data/setting/config.json"), true);
   $mirror = json_decode(file_get_contents("base/data/setting/mirror.json"), true);
   if($setting['site.webset'] == null){ $setting['site.webset'] = "public"; }
   if($mirror['multiset'] == null){ $mirror['multiset'] = "public"; }
   if($mirror['aceset'] == null){ $mirror['aceset'] = "public"; }
   if($mirror['vidset'] == null){ $mirror['vidset'] = "public"; }
   ?>
<div class="container-fluid">
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
   </div>
   <div class="row justify-content-center">
      <div class="col-lg-9 col-md-9 mb-4">
       <h1 class="h3 mb-0 text-gray-800">Settings</h1>
         <div class="card shadow mb-4">
            <div class="card-body">
               <div class="text" align="left">
                  <ul class="nav nav-tabs" role="tablist">
                     <li class="nav-item">
                        <a class="nav-link active" href="#web" role="tab" data-toggle="tab"><i class="fa fa-cogs fa-sm"></i>  Web</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#ads" role="tab" data-toggle="tab"><i class="fa fa-code fa-sm"></i>  Ads</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#mirror" role="tab" data-toggle="tab"><i class="fa fa-link fa-sm"></i>  Mirror</a>
                     </li>
                  </ul>
               </div>
               <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade show active" id="web">
                     <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                              Web setting (public/private) :
                              <input class="form-control" id="webset" type="text" value="<?php echo $setting['site.webset']?>">
                           </div>
                           <div class="form-group">
                              Domain :
                              <input class="form-control" id="domain" type="text" value="<?php echo $setting['site.domain']?>">
                           </div>
                           <div class="form-group">
                              Title :
                              <input class="form-control" id="title" type="text" value="<?php echo $setting['site.title']?>">
                           </div>
                           <div class="form-group">
                              Player :
                              <input class="form-control" id="player" type="text" value="<?php echo $setting['player']?>">
                           </div>
                           <div class="form-group">
                              Site Tag :
                              <input class="form-control" id="tag" type="text" value="<?php echo $setting['site.tag']?>">
                           </div>
                           <div class="form-group">
                              Site Description :
                              <input class="form-control" id="description" type="text" value="<?php echo $setting['site.description']?>">
                           </div>
                           <div class="form-group">
                              Copyright :
                              <input class="form-control" id="copyright" type="text" value="<?php echo $setting['site.copyright']?>">
                           </div>
                           <div class="form-group">
                              Google Webmaster :
                              <input class="form-control" id="webmaster" type="text" value="<?php echo $setting['google.webmaster.id']?>">
                           </div>
                           <div class="form-group">
                              Google Analytics ID :
                              <input class="form-control" id="analytics" type="text" value="<?php echo $setting['google.analytics.id']?>">
                           </div>
                           <div class="form-group">
                              Google Client ID :
                              <input class="form-control" id="clientid" type="text" value="<?php echo $setting['drive.client.id']?>">
                           </div>
                           <div class="form-group">
                              Google Client Secret :
                              <input class="form-control" id="secret" type="text" value="<?php echo $setting['drive.client.secret']?>">
                           </div>
                           <div class="form-group">
                              Redirect URL :
                              <input class="form-control" id="redirect" type="text" value="<?php echo $setting['drive.redirect.uris']?>">
                           </div>
                           <button class="btn btn-primary" onClick="kirimSettingForm()" name="site">Update</button>
                        </div>
                     </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="ads">
                     <div class="card">
                        <div class="card-body">
                           <div class="form-group">
                              JW Player Ads :
                              <textarea class="form-control" row="3" id="jw" type="text" value="<?php echo $setting['jw']?>"><?php echo $setting['jw']?></textarea>
                           </div>
                           <div class="form-group">
                              Banner Up :
                              <textarea class="form-control" row="3" id="banner1" type="text" value="<?php echo $setting['banner1']?>"><?php echo $setting['banner1']?></textarea>
                           </div>
                           <div class="form-group">
                              Banner Down :
                              <textarea class="form-control" row="3" id="banner2" type="text" value="<?php echo $setting['banner2']?>"><?php echo $setting['banner2']?></textarea>
                           </div>
                           <button class="btn btn-primary" onClick="kirimAdsForm()" name="ads">Update</button>
                        </div>
                     </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="mirror">
                     <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                              Multiup Setting (public/private) :
                              <input class="form-control" id="multiset" type="text" value="<?php echo $mirror['multiset']?>">
                            </div>
                            <div class="form-group">
                              Mirrorace Setting (public/private) :
                              <input class="form-control" id="aceset" type="text" value="<?php echo $mirror['aceset']?>">
                            </div>
                            <div class="form-group">
                              Vidcloud Setting (public/private) :
                              <input class="form-control" id="vidset" type="text" value="<?php echo $mirror['vidset']?>">
                            </div>
                           <div class="form-group">
                              Multiup Username :
                              <input class="form-control" id="multiu" type="text" value="<?php echo $mirror['mirroruser']?>">
                           </div>
                           <div class="form-group">
                              Multiup Password :
                              <input class="form-control" id="multik" type="text" value="<?php echo $mirror['mirrorpass']?>">
                           </div>
                           <div class="form-group">
                              Vidcloud User :
                              <input class="form-control" id="vidu" type="text" value="<?php echo $mirror['viduser']?>">
                           </div>
                           <div class="form-group">
                              Vidcloud Key :
                              <input class="form-control" id="vidk" type="text" value="<?php echo $mirror['vidkey']?>">
                           </div>
                           <div class="form-group">
                              MirrorAce Api :
                              <input class="form-control" id="aceu" type="text" value="<?php echo $mirror['aceuser']?>">
                           </div>
                           <div class="form-group">
                              MirrorAce Key :
                              <input class="form-control" id="acek" type="text" value="<?php echo $mirror['acekey']?>">
                           </div>
                           <div class="form-group">
                              MirrorAce Server ID 1 :
                              <input class="form-control" id="mir1" type="text" value="<?php echo $mirror['mir1']?>">
                           </div>
                           <div class="form-group">
                              MirrorAce Server ID 2 :
                              <input class="form-control" id="mir2" type="text" value="<?php echo $mirror['mir2']?>">
                           </div>
                           <div class="form-group">
                              MirrorAce Server ID 3 :
                              <input class="form-control" id="mir3" type="text" value="<?php echo $mirror['mir3']?>">
                           </div>
                           <div class="form-group">
                              MirrorAce Server ID 4 :
                              <input class="form-control" id="mir4" type="text" value="<?php echo $mirror['mir4']?>">
                           </div>
                           <div class="form-group">
                              MirrorAce Server ID 1 :
                              <input class="form-control" id="mir5" type="text" value="<?php echo $mirror['mir5']?>">
                           </div>
                           <button class="btn btn-primary" onClick="kirimMirrorForm()" name="mirror">Update</button>
                           <button class="btn btn-info" onClick="window.location.href='https://mirrorace.com/mirrors'">Server ID List</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php else:?>
<div class="container-fluid">
   <div class="row justify-content-center">
      <div class="col-lg-9 col-md-9 mb-4">
         <div class="card shadow mb-4">
            <div class="card-body">
               <div class="text-center">
                  <i class="fa fa-exclamation-triangle fa-xl"></i>
                  <br>
                  Permission Denied
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php endif;?>