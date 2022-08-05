<?php 
session_start();
// hide all error
error_reporting(0);
// protect .php
$get_self = explode("/",$_SERVER['PHP_SELF']);
$self[] = $get_self[count($get_self)-1];

if($self[0] !== "index.php"  && $self[0] !==""){
    include_once("./../../core/route.php");
}else{ 
    
    // include_once("config/readcfg.php");
    include_once('core/routeros_api.class.php');
    include_once("core/no_cache.php");
    

// upload and rename https://gist.github.com/zvineyard/3530917

if (isset($_POST['submit'])){
  $filename = $_FILES["file"]["name"];
  $file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
  $file_ext = substr($filename, strripos($filename, '.')); // get file name
  $filesize = $_FILES["file"]["size"];
  $allowed_file_types = array('.png');  
  $limit = 1 * 1024 * 1024;

  if (in_array($file_ext,$allowed_file_types) && ($filesize < $limit)){ 
    // Rename file
    $newfilename = "logo-".$_GET["r"] . $file_ext;
      move_uploaded_file($_FILES["file"]["tmp_name"], "./assets/img/" . $newfilename);
      // $upmess =  "<div>Logo uploaded successfully.</div>";   
    
  }elseif (empty($file_basename)){ 
    // file selection error
    $upmess =  "<div>Please select a file to upload.</div>";
  }elseif ($filesize > $limit){ 
    // file size error
    $upmess =  "<div>The file you are trying to upload is too large.</div>";
  }else{
    // file type error
    $upmess =  "<div>Only .png file type are allowed for upload.</div>";
    unlink($_FILES["file"]["tmp_name"]);
  }
  echo '<script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>';
}


if(!isMobile()){
    $settings_ma = "sidenav_active";
    include_once("view/header_html.php");
    include_once("view/menu.php");

?>
<div class="main unselect">
<div class="row">
  <div class="col-12">
            <div class="card card-shadow">
            <div class="card-header unselect">
              
              <span><i class="fa fa-gear"></i> <b>Settings</b>  </span>&nbsp;
              <span class="card-tab" id="btn-mm-admin"><i class="fa fa-user-circle" ></i> Admin</span>
              <span class="card-tab card-tab-active" id="btn-router-list"><i class="fa fa-th-list" ></i> Router List</span>
              <?php if(isset($_GET['r']) && !empty($_GET['r'])){ ?>
              <span class="card-tab card-tab-active" id="btn-edit-router"><i class="fa fa-tag" ></i> <?= $_GET['r'] ?></span>
              <script>$(document).ready(function() {menuNonActive('router-list');});</script>
              <?php }?>

                    
            </div>
            <div class="card-body">
            <div class="row">
              <div class="col-12 hide" id="mm-admin">
                <div class="btn-group">
                  <button class="bg-btn-group" id="btn-asave" ><i class="fa fa-save" ></i> Save</button>
                </div>
                <div class="card-fixed mr-t-5">

                  <?php
                  foreach (file('./config/config.php',FILE_SKIP_EMPTY_LINES) as $line) {
                  $s = explode("'", $line)[1];
                  $useradm = get_config($line,'mikhmon<|<', "'");
                  $passadm = get_config($line,'mikhmon>|>', "'");
                  if ($s == "mikhmon") { ?>
                  
                    <div class="row">
                      <div class="col-6">
                        <div class="card-sq">
                          <div class="card-header-sq"><i class="fa fa-user-circle"></i> <b>Admin</b> <span id="a-mess"></span></div>
                          <div class="card-body">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <td style="min-width:100px">Username</td>
                                  <td colspan="2"><input id='userAdm' class="form-control adm" type="text" value="<?= $useradm ?>" autocomplete="off"></td>
                                </tr>
                                <tr>
                                  <td>Password</td>
                                  <td style="max-width:100px">
                                    <input autocomplete="new-password" id="passAdm" class="form-control adm key" type="text" value="<?= dec_rypt($passadm) ?>" autocomplete="off">
                                  </td>
                                  <td width="5px">
                                    <div title="Show / hide password" class="mr-t-5 text-center">
                                      <input class="chkbox" onclick="shPass('passAdm')" type="checkbox">
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td id="e-mess" colspan="3">
                                  </td>
                                </tr>
                              </tbody>  
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                      
   
                      <?php
                    } }
                  ?>
                </div>
              </div>
              
                <div class="col-12" id="router-list">
                    <div class="btn-group">
                        <button class="bg-btn-group tooltip" id="btn-add-router"><i class="fa fa-plus" ></i> Add Router
                          <span class="tooltiptext-right hide" id="add-router-message"></span>
                        </button>                     
                    </div>

                    <div class="card-fixed mr-t-10">
                    <?php  ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-right">#</th>
                                <th>Session Name</th>
                                <th class="text-center">Action</th> 
                                <th>Hotspot Name</th>             
                                
                                                               
                            </tr>
                        </thead>
                        <tbody id="table-router-list">
                            <?php
                            $i = -2;
                            foreach (file('./config/config.php',FILE_SKIP_EMPTY_LINES) as $line) {
                            $s = explode("'", $line)[1];
                            $hn = get_config($line,$s.'%',"'");
                            $idleto = get_config($line,$s.'=', "'");
                                                        
                            $i++;
                            if ($s == "" || $s == "mikhmon") {

                            } else { 


                              ?>

                                <tr>
                                  <script>localStorage.setItem("?<?= $s; ?>_idleto","<?= $idleto ?>")</script>
                                  <td class="text-right" width="30px;"><?= $i ?></td>
                                  <td><i class="fa fa-tag" id="<?= $s; ?>p"></i> <?= $s; ?></td>
                                  <td width="180px" class="text-center">
                                    <!-- <span class=" tooltip"><span class="tooltiptext hide"id="<?= $s; ?>p"></span></span> -->
                                    <span title="Remove session <?= $s; ?>" class="btn" id="<?= $s; ?>r" onclick="removeRouter('<?= $s; ?>')" >
                                      <i class="fa fa-trash text-danger"></i></span>
                                    <span title="Edit session <?= $s; ?>" class="btn" onclick="editRouter('<?= $s; ?>')" ><i class="fa fa-gear"></i></span> 
                                    <span title="Connect to session <?= $s; ?>" class="btn" onclick="connect('<?= $s; ?>p','<?= $s; ?>')"  id="<?= $s; ?>">
                                      <i class="fa fa-plug"></i>
                                    </span>
                                                                   
                                  </td>
                                  <td><i class="fa fa-wifi"></i> <?= $hn ?> </td>
                                  
                                  
                                </tr>
             
                                <?php
                              }
                            }
                            ?>
                        </tbody>
                    </table>
                    
                    
                    
                  </div>
                </div>
                <?php if(isset($_GET['r']) && !empty($_GET['r'])){
                    foreach (file('./config/config.php',FILE_SKIP_EMPTY_LINES) as $line) {
                      $ss = explode("'", $line)[1];
                      if ($ss == $_GET['r']) {
                        
                          $iphost = get_config($line,$_GET['r'].'!', "'");
                          $userhost = get_config($line,$_GET['r'].'@|@', "'");
                          $passwdhost = get_config($line,$_GET['r'].'#|#', "'");
                          $hotspotname = get_config($line,$_GET['r'].'%', "'");
                          $dnsname = get_config($line,$_GET['r'].'^', "'");
                          $currency = get_config($line,$_GET['r'].'&', "'");
                          $phone = get_config($line,$_GET['r'].'*', "'");
                          $email = get_config($line,$_GET['r'].'(', "'");
                          $infolp = get_config($line,$_GET['r'].')', "'");
                          $idleto = get_config($line,$_GET['r'].'=', "'");
                          $report = get_config($line,$_GET['r'].'@!@', "'");
                          // $phone = get_config($line,$_GET['r'].'#!#', "'");
                         
                          ?>
                          <script>$(document).ready(function() {$("#edit-router").removeClass('hide')})</script>
                          <script>localStorage.setItem("?<?= $_GET["r"]; ?>_idleto","<?= $idleto ?>")</script>
                          <div class="col-12 hide" id="edit-router">
                            <div class="card-fixed">               
                            <div class="row">
                              <div class="col-12">
                                <div class="btn-group">
                                  <button class="bg-btn-group" onclick="location.replace('./?admin/settings')"><i class="fa fa-close" ></i> Close</button>
                                  <button class="bg-btn-group" onclick="removeRouter('<?= $_GET['r']; ?>')"><i class="fa fa-trash" ></i> Remove</button>
                                  <button class="bg-btn-group" id="saveR" ><i class="fa fa-save" ></i> Save</button>
                                  <button class="bg-btn-group" id="rConnect" ><i class="fa fa-plug" ></i> Connect </button>
                                </div>
                              </div>
                              <div class="col-6 mr-t-5">
                              <div class="col-12">
                                <div class="card-sq">
                                  <div id="ee-mess" class="card-header-sq"><i class="fa fa-server"></i> <b >Router</b> <span id="r-mess"></span>
                                  </div>
                                  <div class="card-body">
                                    
                                  <table class="table">
                                    <tbody>
                                      <tr>
                                        <td style="min-width:100px">Session Name</td>
                                        <td colspan="2"><input id='sessName' class="form-control" type="text" value="<?= $_GET['r'] ?>" autocomplete="off"></td>
                                      </tr>
                                      <tr>
                                        <td>IP MikroTik</td>
                                        <td colspan="2"><input id="ipHost" class="form-control asave" type="text" value="<?= $iphost ?>" autocomplete="off"></td>
                                      </tr>
                                      <tr>
                                        <td>Username</td>
                                        <td colspan="2"><input autocomplete="off" id="userHost" class="form-control asave" type="text" value="<?= $userhost ?>" autocomplete="off"></td>
                                      </tr>
                                      <tr>
                                        <td>Password</td>
                                        <td style="max-width:100px">
                                          <input autocomplete="new-password" id="passwdHost" class="form-control asave key" type="text" value="<?= dec_rypt($passwdhost) ?>" autocomplete="off">
                                        </td>
                                        <td width="5px">
                                          <div title="Show / hide password" class="mr-t-5 text-center">
                                            <input class="chkbox" onclick="shPass('passwdHost')" type="checkbox">
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>  
                                  </table>
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="card-sq">
                                  <div class="card-header-sq"><i class="fa fa-server"></i> <b>Hotspot Info</b></div>
                                  <div class="card-body">
                                  <table class="table">
                                    <tbody>
                                      <tr>
                                        <td style="min-width:100px">Hotspot Name</td>
                                        <td><input id="hotspotNane" class="form-control asave" type="text" value="<?= $hotspotname ?>" autocomplete="off"></td>
                                      </tr>
                                      <tr>
                                        <td>DNS Name</td>
                                        <td><input id="dnsName" class="form-control asave" type="text" value="<?= $dnsname ?>" autocomplete="off"></td>
                                      </tr>
                                      <tr>
                                        <td>Currency</td>
                                        <td><input id="currency" class="form-control asave" type="text" value="<?= $currency ?>" autocomplete="off"></td>
                                      </tr>
                                      <tr>
                                        <td>Session Timeout</td>
                                        <td>
                                          <select id="idleTo" class="form-control asave pointer" >
                                            <!-- <option value="<?= $idleto; ?>"><?php echo ucfirst($idleto); if($idleto != "disable"){echo " minutes";} ?> </option> -->
                                            <option value="5">5 minutes</option>
                                            <option value="10">10 minutes</option>
                                            <option value="30">30 minutes</option>
                                            <option value="60">60 minutes</option>
                                            <option value="disable">Disable</option>
                                        </select>
                                        <script>$(document).ready(function() {$("#idleTo").val("<?=$idleto;?>")})</script>
                                      </td>
                                      </tr>
                                      <tr>
                                        <td>Live Report</td>
                                        <td>
                                          <select id="report" class="form-control asave pointer" >
                                            <!-- <option value="<?= $report; ?>"><?php echo ucfirst($report);?> </option> -->
                                            <option value="enable">Enable</option>
                                            <option value="disable">Disable</option>
                                        </select>
                                        <script>$(document).ready(function() {$("#report").val("<?=$report;?>")})</script>
                                      </td>
                                      </tr>
                                      <tr>
                                        <td>Phone</td>
                                        <td><input id="phone" class="form-control asave" type="text" value="<?= $phone ?>" autocomplete="off"></td>
                                      </tr>
                                      
                                      
                                      
                                    </tbody>  
                                  </table>
                                  </div>
                                </div>
                              </div>
                              </div>
                              <div class="col-6 mr-t-5">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="card-sq">
                                      <div class="card-header-sq"><i class="fa fa-image"></i> <b>Upload Logo</b> <span id="r-mess"></span></div>
                                      <div class="card-body">
                                        <form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                     
                                          <?php 
                                            $logopng = "./assets/img/logo-" . $_GET["r"].".png";
                                            if (file_exists($logopng)){
                                              echo "<div><center><img src='".$logopng."?".date("YmdHis")."' height='70' /></center></div>";
                                            }else{
                                              echo "<div><center><img src='./assets/img/logo.png?".date("YmdHis")."' height='70' /></center></div>";
                                            }

                                          ?>
                                          <input class="hide" id="fileup" name="file" type="file" accept="image/*" onchange="fileUpChk(this)" required="1" />
                                          <div id="tempfileup">&nbsp;</div>
                                          <?= $upmess ?>
                                          <div class="btn mobile bg-btn-group" id="browsefile" ><i class="fa fa-search"></i> Browse File</div>
                                          <button class="btn bg-btn-group" name="submit" type="submit"><i class="fa fa-upload"></i> Upload</button>
                                              
                                      </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="card-sq">
                                      <div class="card-header-sq"><i class="fa fa-info-circle"></i> <b>Help</b> <span id="r-mess"></span></div>
                                      <div class="card-body">
                                        <table class="table table-bordered table-hover" style="font-size: 14px;">
                                          <tbody>
                                            <tr>
                                              <td>Session Name</td>
                                              <td>Fill with one word without any special characters.</td>
                                            </tr>
                                            <tr>
                                              <td>DNS Name</td>
                                              <td>Please check in Winbox, menu IP -> Hotspot -> Server Profile.</td>
                                            </tr>
                                            <tr>
                                              <td>Idle Timeout</td>
                                              <td>Idle timeout is a time countdown to logout.</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </div>
                          </div>
                      <?php } } } ?>
            </div>
            </div>
            <div class="card-footer"><span id="loading"></span> </div>
            </div>
        </div>
      </div>
      

    </div>
<?php
}else if(isMobile()){ 
        $settings_ma = "nav_active";
        $navicon = '<i class="fa fa-gear"></i>';
  include_once("view/header_html.php");
  include_once("view/menu.php");
  ?>
<div class="main-mobile">

<div class="row">
<div style="margin-top:50px;margin-bottom:30px;" >

<div class="group-icon-mobile" style="margin: auto; width:100%">
  <i class="fa fa-gear" style="font-size:60px" ></i>
  <h3>Settings</h3>
  </div> 

  
  </div>
  <div class="col-12" style="margin-bottom:100px;">
  
            <div class="mobile-card ">
            
                <!-- <h3><i class="fa fa-gear"></i>&nbsp; Admin Settings &nbsp; <span id="loadingHeader"></span></h3> -->
            <div class="col-12 mr-b-10"  >
            
                <div class="col-10"><h3><span  id="pload"><i class="fa fa-th-list"></i> Route List</span></h3></div>
                <div class="col-2">
                <div class="dropdown">
                      <button  class="dropbtn"><i class="fa fa-caret-down"></i></button>
                      <div id="mDropdown" class="dropdown-content">
                        <a id="btn-mm-admin"><i class="fa fa-user-circle" ></i> Admin</a>
                        <a id="btn-router-list"><i class="fa fa-th-list" ></i> Router List</a>
                        <?php if(isset($_GET['r']) && !empty($_GET['r'])){ ?>
                        <a id="btn-edit-router"><i class="fa fa-tag" ></i> <?= $_GET['r'] ?></a>
                        <script>
                        $(document).ready(function() {
                          $("#btn-edit-router").click()
                        });
                        </script>
                        <?php }?>
                      </div>
                    </div>
                </div>
             </div>  
            <div class="mr-t-10">
            <div class="row">

                <div class="col-12 hide" id="mm-admin">
                <div class="btn-group">
                  <button class="btn-mobile bg-btn-group" id="btn-asave" ><i class="fa fa-save" ></i> Save</button>
                </div>
                <div class="card-fixed mr-t-5">

                  <?php
                  foreach (file('./config/config.php',FILE_SKIP_EMPTY_LINES) as $line) {
                  $s = explode("'", $line)[1];
                  $useradm = get_config($line,'mikhmon<|<', "'");
                  $passadm = get_config($line,'mikhmon>|>', "'");
                  if ($s == "mikhmon") { ?>
                  
                    <div class="row">
                      <div class="col-12">
                        <div class="card-sq">
                          <div class="card-header-sq"><i class="fa fa-user-circle"></i> <b>Admin</b> <span id="a-mess"></span></div>
                          <div class="card-body">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <td style="min-width:100px">Username</td>
                                  <td colspan="2"><input id='userAdm' class="form-control adm" type="text" value="<?= $useradm ?>" autocomplete="off"></td>
                                </tr>
                                <tr>
                                  <td>Password</td>
                                  <td style="max-width:100px">
                                    <input autocomplete="new-password" id="passAdm" class="form-control adm key" type="text" value="<?= dec_rypt($passadm) ?>" autocomplete="off">
                                  </td>
                                  <td width="5px">
                                    <div title="Show / hide password" class="mr-t-5 text-center">
                                      <input class="chkbox" onclick="shPass('passAdm')" type="checkbox">
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td id="e-mess" colspan="3">
                                  </td>
                                </tr>
                              </tbody>  
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                      
   
                      <?php
                    } }
                  ?>
                </div>
              </div>
                <div class="col-12" id="router-list">
                    <div class="btn-group">
                        <button class="btn-mobile bg-btn-group tooltip" id="btn-add-router"><i class="fa fa-plus" ></i> Add Router
                        <span class="tooltiptext hide" id="add-router-message"></span>
                      </button>                     
                    </div>

                    <div class="card-fixed mr-t-10">
                    <hr>
                    <table class="table-p0">
                        <tbody>
                            <?php
                            $i = -2;
                            foreach (file('./config/config.php',FILE_SKIP_EMPTY_LINES) as $line) {
                            $s = explode("'", $line)[1];
                            $hn = get_config($line,$s.'%',"'");
                            $idleto = get_config($line,$s.'=', "'");
                            $i++;
                            if ($s == "" || $s == "mikhmon") {
                            } else { ?>

                                <tr>
                                  
                                <script>localStorage.setItem("?<?= $s; ?>_idleto","<?= $idleto ?>")</script>
                                  <td ><div class="box-mobile"><i class="fa fa-wifi" id="<?= $s; ?>p"></i> <b> <?= $hn; ?></b><span style="float:right;">[<?= $i ?>]</span> <br>
                                  Session Name: <?= $s; ?><br>
                                  
                                    
                                    <span class="btn" id="<?= $s; ?>r" onclick="removeRouter('<?= $s; ?>')" >
                                      <i class="fa fa-trash"></i> Remove 
                                    </span>
                                    <span class="btn" onclick="editRouter('<?= $s; ?>')" ><i class="fa fa-gear"></i> Edit</span>
                                    <span class="btn" onclick="connect('<?= $s; ?>p','<?= $s; ?>')"  id="<?= $s; ?>">
                                      <i class="fa fa-plug"></i> Connect 
                                    </span>
                            </div>
                                </td>
                                </tr>
             
                                <?php
                              }
                            }
                            ?>
                        </tbody>
                    </table>
                    
                    
                    
                  </div>
                </div>
                <?php if(isset($_GET['r']) && !empty($_GET['r'])){
                    foreach (file('./config/config.php',FILE_SKIP_EMPTY_LINES) as $line) {
                      $ss = explode("'", $line)[1];
                      if ($ss == $_GET['r']) {
                        
                          $iphost = get_config($line,$_GET['r'].'!', "'");
                          $userhost = get_config($line,$_GET['r'].'@|@', "'");
                          $passwdhost = get_config($line,$_GET['r'].'#|#', "'");
                          $hotspotname = get_config($line,$_GET['r'].'%', "'");
                          $dnsname = get_config($line,$_GET['r'].'^', "'");
                          $currency = get_config($line,$_GET['r'].'&', "'");
                          $phone = get_config($line,$_GET['r'].'*', "'");
                          $email = get_config($line,$_GET['r'].'(', "'");
                          $infolp = get_config($line,$_GET['r'].')', "'");
                          $idleto = get_config($line,$_GET['r'].'=', "'");
                          $report = get_config($line,$_GET['r'].'@!@', "'");
                         
                          ?>
                          <script>$(document).ready(function() {$("#edit-router").removeClass('hide')})</script>
                          <script>localStorage.setItem("?<?= $_GET["r"]; ?>_idleto","<?= $idleto ?>")</script>
                          <div class="col-12 hide" id="edit-router">
                            <div class="card-fixed">               
                            <div class="row">
                              <div class="col-12">
                                <div class="btn-group">
                                  <button class="btn-mobile bg-btn-group" onclick="location.replace('./?admin/settings')"><i class="fa fa-close" ></i></button>
                                  <button class="btn-mobile bg-btn-group" onclick="removeRouter('<?= $_GET['r']; ?>')"><i class="fa fa-trash" ></i> Remove</button>
                                  <button class="btn-mobile bg-btn-group" id="saveR" ><i class="fa fa-save" ></i> Save</button>
                                  <button class="btn-mobile bg-btn-group" id="rConnect" ><i class="fa fa-plug" ></i> Connect </button>
                                </div>
                              </div>
                              <div class="col-12 mr-t-5">
                              <div class="col-12">
                                <div class="card-sq">
                                  <div id="ee-mess" class="card-header-sq"><i class="fa fa-server"></i> <b >Router</b> <span id="r-mess"></span>
                                  </div>
                                  <div class="card-body">
                                    
                                  <table class="table">
                                    <tbody>
                                      <tr>
                                        <td style="min-width:100px">Session Name</td>
                                        <td colspan="2"><input id='sessName' class="form-control" type="text" value="<?= $_GET['r'] ?>" autocomplete="off"></td>
                                      </tr>
                                      <tr>
                                        <td>IP MikroTik</td>
                                        <td colspan="2"><input id="ipHost" class="form-control asave" type="text" value="<?= $iphost ?>" autocomplete="off"></td>
                                      </tr>
                                      <tr>
                                        <td>Username</td>
                                        <td colspan="2"><input autocomplete="off" id="userHost" class="form-control asave" type="text" value="<?= $userhost ?>" autocomplete="off"></td>
                                      </tr>
                                      <tr>
                                        <td>Password</td>
                                        <td style="max-width:100px">
                                          <input autocomplete="new-password" id="passwdHost" class="form-control asave key" type="text" value="<?= dec_rypt($passwdhost) ?>" autocomplete="off">
                                        </td>
                                        <td width="5px">
                                          <div title="Show / hide password" class="mr-t-5 text-center">
                                            <input class="chkbox" onclick="shPass('passwdHost')" type="checkbox">
                                          </div>
                                        </td>
                                      </tr>
                                    </tbody>  
                                  </table>
                                  </div>
                                </div>
                              </div>
                              <div class="col-12">
                                <div class="card-sq">
                                  <div class="card-header-sq"><i class="fa fa-server"></i> <b>Hotspot Info</b></div>
                                  <div class="card-body">
                                  <table class="table">
                                    <tbody>
                                      <tr>
                                        <td style="min-width:100px">Hotspot Name</td>
                                        <td><input id="hotspotNane" class="form-control asave" type="text" value="<?= $hotspotname ?>" autocomplete="off"></td>
                                      </tr>
                                      <tr>
                                        <td>DNS Name</td>
                                        <td><input id="dnsName" class="form-control asave" type="text" value="<?= $dnsname ?>" autocomplete="off"></td>
                                      </tr>
                                      <tr>
                                        <td>Currency</td>
                                        <td><input id="currency" class="form-control asave" type="text" value="<?= $currency ?>" autocomplete="off"></td>
                                      </tr>
                                      
                                      <tr>
                                        <td>Session Timeout</td>
                                        <td>
                                          <select id="idleTo" class="form-control asave pointer" >
                                            <!-- <option value="<?= $idleto; ?>"><?php echo ucfirst($idleto); if($idleto != "disable"){echo " minutes";} ?> </option> -->
                                            <option value="5">5 minutes</option>
                                            <option value="10">10 minutes</option>
                                            <option value="30">30 minutes</option>
                                            <option value="60">60 minutes</option>
                                            <option value="disable">Disable</option>
                                        </select>
                                        <script>$(document).ready(function() {$("#idleTo").val("<?=$idleto;?>")})</script>
                                      </td>
                                      </tr>
                                      <tr>
                                        <td>Live Report</td>
                                        <td>
                                          <select id="report" class="form-control asave pointer" >
                                            <!-- <option value="<?= $report; ?>"><?php echo ucfirst($report);?> </option> -->
                                            <option value="enable">Enable</option>
                                            <option value="disable">Disable</option>
                                        </select>
                                        <script>$(document).ready(function() {$("#report").val("<?=$report;?>")})</script>
                                      </td>
                                      </tr>
                                      <tr>
                                        <td>Phone</td>
                                        <td><input id="phone" class="form-control asave" type="text" value="<?= $phone ?>" autocomplete="off"></td>
                                      </tr>
                                    </tbody>  
                                  </table>
                                  </div>
                                </div>
                              </div>
                              </div>
                              <div class="col-12 mr-t-5">
                                <div class="row">
                                  <div class="col-12">
                                    <div class="card-sq">
                                      <div class="card-header-sq"><i class="fa fa-image"></i> <b>Upload Logo</b> <span id="r-mess"></span></div>
                                      <div class="card-body">
                                        <form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                     
                                          <?php 
                                            $logopng = "./assets/img/logo-" . $_GET["r"].".png";
                                            if (file_exists($logopng)){
                                              echo "<div><center><img src='".$logopng."?".date("YmdHis")."' height='70' /></center></div>";
                                            }else{
                                              echo "<div><center><img src='./assets/img/logo.png?".date("YmdHis")."' height='70' /></center></div>";
                                            }

                                          ?>
                                          <input class="hide" id="fileup" name="file" type="file" accept="image/*" onchange="fileUpChk(this)" required="1" />
                                          <div id="tempfileup">&nbsp;</div>
                                          <?= $upmess ?>
                                          <div class="btn mobile bg-btn-group" id="browsefile" ><i class="fa fa-search"></i> Browse File</div>
                                          <button class="btn bg-btn-group" name="submit" type="submit"><i class="fa fa-upload"></i> Upload</button>
                                              
                                      </form>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="card-sq">
                                      <div class="card-header-sq"><i class="fa fa-info-circle"></i> <b>Help</b> <span id="r-mess"></span></div>
                                      <div class="card-body">
                                        <table class="table table-bordered table-hover" style="font-size: 14px;">
                                          <tbody>
                                            <tr>
                                              <td>Session Name</td>
                                              <td>Fill with one word without any special characters.</td>
                                            </tr>
                                            <tr>
                                              <td>DNS Name</td>
                                              <td>Please check in Winbox, menu IP -> Hotspot -> Server Profile.</td>
                                            </tr>
                                            <tr>
                                              <td>Idle Timeout</td>
                                              <td>Idle timeout is a time countdown to logout.</td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </div>
                          </div>
                      <?php } }
                    }

                  ?>
            </div>
            </div>
            <div class="card-footer"><span id="loading"></span> </div>
            </div>

        </div>
      </div>

</div>






<?php }} ?>