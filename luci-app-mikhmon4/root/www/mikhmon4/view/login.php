<?php 
session_start();
// hide all error
error_reporting(0);
// protect .php
$get_self = explode("/",$_SERVER['PHP_SELF']);
$self[] = $get_self[count($get_self)-1];

if($self[0] !== "index.php"  && $self[0] !==""){
    include_once("../core/route.php");
}else{
    
    // include_once('config/config.php');
    // include_once('config/readcfg.php');
    include_once('core/routeros_api.class.php');
    foreach (file('./config/config.php',FILE_SKIP_EMPTY_LINES) as $line) {
      $ss = explode("'", $line)[1];
      clearstatcache();
      if ($ss === 'mikhmon') {

          $useradm = get_config($line,'mikhmon<|<', "'");
          $passadm = get_config($line,'mikhmon>|>', "'");
      
        if (!isset($is_mobile)) {
          $col = "col-5";
          $marginTop = "20%";
          $urlLogin = "<script>window.location='./?admin/settings'</script>";
        }else if(isset($is_mobile)){
          $col = "col-12";
          $marginTop = "60px";
          $urlLogin = "<script>window.location='./?admin/settings/&mobile'</script>";
        }
        include_once("view/header_html.php");

        if (isset($_POST['login'])) {
            $user = ($_POST['user']);
            $pass = ($_POST['pass']);
            if ($user === $useradm && $pass === dec_rypt($passadm)) {
                $_SESSION["mikhmon"] = $user;
                echo $urlLogin;
            } else {
             
                // $error = '
                // <div class="login-container bg-danger mr-b-10 pd-10 err" style="border:solid 1px #AA0715"><i class="fa fa-info-circle"></i> Invalid username or password. <span style="float:right;cursor:pointer; font-weight:bold;color:#AA0715" id="close">X</span></div>
                // <script>$("#close").click(function(){$(".err").fadeOut(200)})</script>';
              $error = '
                <script>$.notify("Invalid username or password.","error")</script>';
            }
        } 
      }
    }
    ?>
<div class="row">
<div class="col-12">
 
<div class="login unselect">
<div  class="mr-b-10">
<center>
  <div class="logo-login"></div>
  <span class="login-title">Login to MIKHMON</span>
</center> 
</div>
    <?= $error; ?>
    <div class="login-container">
      <form autocomplete="off" action="" method="post">
            <label for="_username">Username</label>
            <input class="form-control" type="text" name="user" id="_username" required="1" autofocus>
            <label for="_passw">Password</label>
            <input class="form-control" type="password" name="pass" id="_passw" required="1">
            <div id="webview"></div>
            <button id="btn-login" class="bg-primary" type="submit" name="login" >Login</button>
            <!-- <?= $error; ?> -->
      </form>
    </div>
    <div class="mr-t-10 login-container pd-10 text-center text-dp">
      <span style="font-size:15px;font-weight:  bold; font-variant: small-caps;">MikroTik Hotspot Monitor</span>
    </div>
  </div>
  </div>
  </div>
<script>
$("body").addClass("bg-textures")
$(document).ready(function() {  
  $("#_username").focus();
})
$("#btn-login").click(function(){
  if($("#_username").html() != "" && $("#_passw").html() != ""){
    $("#btn-login").html('&nbsp;<i class="fa fa-circle-o-notch fa-spin"></i>&nbsp;');
  }
})
</script>
<?php
        
    // }else if (isset($is_mobile)) {
    //     include_once('view/header_html.php');

    // }
    include_once('view/footer_html.php');
    
}

?>