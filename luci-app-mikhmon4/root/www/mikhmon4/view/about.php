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
    $is_mobile = $_GET['mobile'];
$detail = '
<div class="pd-10">
    <?= $sasa ?>
    <h2>MIKHMON</h2>
    <p>
      <ul>
        <li>App Name : MIKHMON | MikroTik Hotspot Monitor</li>
        <li>Author : <a style="text-decoration: underline;" href="https://fb.com/laksamadi" target="_blank">Laksamadi Guko</a></li>
        <li>Licence : <a href="#">MIT</a></li>
        <li>Website : <a style="text-decoration: underline;" href="https://laksa19.github.io" target="_blank">https://laksa19.github.io</a></li>
      </ul>
    </p>
    <p><h3>lib :</h3>
      <ul>
        <li>MikroTik API Class : <a style="text-decoration: underline;" href="https://github.com/BenMenking/routeros-api" target="_blank">routeros-api</a></li>
        <li>Fancy Table : <a style="text-decoration: underline;" href="https://github.com/myspace-nu/jquery.fancyTable" target="_blank">jquery.fancyTable</a></li>
        <li>Codemirror Editor : <a style="text-decoration: underline;" href="https://codemirror.net" target="_blank">codemirror</a></li>
        <li>Highcharts : <a style="text-decoration: underline;" href="https://www.highcharts.com/" target="_blank">highcharts.com</a></li>
        <li>Notify.js : <a style="text-decoration: underline;" href="https://notifyjs.jpillora.com/" target="_blank">notifyjs.jpillora.com</a></li>
        <li>Pace : <a style="text-decoration: underline;" href="https://github.hubspot.com/pace/docs/welcome/" target="_blank">pace</a></li>
      </ul>
    </p>
    <p>
      Aplikasi ini dipersembahkan untuk pengusaha hotspot di manapun Anda berada.
      Semoga makin sukses.
    </p>
    <p>
      Terima kasih untuk semua yang telah mendukung pengembangan MIKHMON.
    </p>
    <div>
        <i>Copyright &copy; 2017 -'.date("Y").' Laksamadi Guko</i>
    </div>
</div>    
    ';

if(!isMobile()){

    $about_ma = "sidenav_active";
   
    include_once("view/header_html.php");
    include_once("view/menu.php");
?>
<div class="main unselect">
    <div class="row">
        <div class="col-12">
            <div class="card card-shadow">
            <div class="card-header">
                <span><i class="fa fa-info-circle"></i> <b>About</b></span>
            </div>
            <div class="card-body">
            <?= $detail ?>
            </div>
            <div class="card-footer"><span id="loading"></span> </div>
            </div>
        </div>
    </div>
</div>
<?php 

}else if(isMobile()){ 

  $about_ma = "nav_active";
  $navicon = '<i class="fa fa-info-circle"></i>' ;
    include_once("view/header_html.php");
    include_once("view/menu.php");

  ?>

<div class="main-mobile">
  
    <div class="row">
    <div style="margin-top:50px;margin-bottom:30px;" >

<div class="group-icon-mobile" style="margin: auto; width:100%">
  <i class="fa fa-info-circle" style="font-size:60px" ></i>
  <h3>About</h3>
  </div> 

  
  </div>
        <div class="col-12">
            <div class="mobile-card ">
                <h3><i class="fa fa-info-circle"></i> About</h3>
            <div class="card-body">
            <?= $detail ?>
            </div>
            <div class="card-footer"><span id="loading"></span> </div>
            </div>
        </div>
    </div>
</div>


<?php } 
include_once("view/footer_html.php");
}
?>
