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
date_default_timezone_set($_SESSION["timezone"]);
$comment = $_GET['c'];
$uid = $_GET['uid'];
$prev = $_GET['prev'];
$d = $_GET['d'];
$s = $_GET['s'];
$t = $_GET['t'];
if(isset($d)){
    $header = 'template/header.default.txt';
    $row = 'template/row.default.txt';
    $footer = 'template/footer.default.txt';
}
if(isset($s)){
    $header = 'template/header.small.txt';
    $row = 'template/row.small.txt';
    $footer = 'template/footer.small.txt';
}
if(isset($t)){
    $header = 'template/header.thermal.txt';
    $row = 'template/row.thermal.txt';
    $footer = 'template/footer.thermal.txt';
}

echo file_get_contents("$header");
echo '

<script src="assets/js/qr/qrious.min.js"></script>

';

$timestamp =  date("Y-m-d H:i:s");

$logo = "./assets/img/logo-" . $m_user . ".png";
if (file_exists($logo)) {
  $logo = "./assets/img/logo-" . $m_user . ".png?".date("YmdHis");
} else {
  $logo = "./assets/img/logo.png";
}

if(!isset($prev)){
include_once("config/connection.php");

  if(isset($uid) && $uid != "") {
    $get_users = $API->comm("/ip/hotspot/user/print", array("?.id" => "$uid"));
    $TotalReg = count($get_users);
  }else if(isset($comment)){
    if(!empty($_SESSION[$m_user.$commt]) && $_SESSION[$m_user.$comment."_c"] == $comment){
      $get_users = $_SESSION[$m_user.$comment];
    }else{
      $get_users = $API->comm('/ip/hotspot/user/print', array("?comment" => "$comment", "?uptime" => "0s"));
    }
    $TotalReg = count($get_users);  
  
  }

  $getuprofile = $get_users[0]['profile'];
 
  $getprofile = $API->comm("/ip/hotspot/user/profile/print", array("?name" => "$getuprofile"));
  $getsharedu = $getprofile[0]['shared-users'];
  $ponlogin = $getprofile[0]['on-login'];
  $validity = explode(",", $ponlogin)[3];
  $getprice = explode(",", $ponlogin)[2];
  $getsprice = explode(",", $ponlogin)[4]; 

}else if (isset($prev)){
   $get_users = array(
                    0 => array("name" => "mikhmon","password" => "1234","profile" => "1day","limit-uptime" => "1d", "limit-bytes-total" => 10737418240, "comment" => "mikhmon-preview" )
                  );
  $TotalReg = count($get_users); 
  $validity = "1d";
  $getprice = "3";
  $getsprice = "5"; 
  $hotspotname = "MIKHMON";
  $dnsname = "laksa19.github.io";
  $phone = "6281xxxxxxxxx";
  $currency = "$";

}
 

  for ($i = 0; $i < $TotalReg; $i++) {
    $regtable = $get_users[$i];
    $idqr = str_replace("=","",base64_encode(($regtable['.id']."qr")));
    $username = $regtable['name'];
    $password = $regtable['password'];
    $profile = $regtable['profile'];
    $timelimit = $regtable['limit-uptime'];
    $getdatalimit = $regtable['limit-bytes-total'];
    $comment = $regtable['comment'];
  
     
      
    if ($getdatalimit == 0) {
      $datalimit = "";
    } else {
      $datalimit = formatBytes($getdatalimit, 2);
    }
  
  
  
    $urilogin = "http://$dnsname/login?username=".urlencode($username)."&password=".urlencode($password);
    $qrcode = "
      <canvas class='qrcode' id='".$idqr."'></canvas>
      <script>
        (function() {

          var ".$idqr." = new QRious({
            element: document.getElementById('".$idqr."'),
            value: '".$urilogin."',
            size:'256',
          });
  
        })();
      </script>
      ";
      $qrcodeR = "
      <canvas class='qrcode' id='".$idqr."'></canvas>
      <script>
        (function() {

          var ".$idqr." = new QRious({
            element: document.getElementById('".$idqr."'),
            value: '".$urilogin."',
            size:'256',
            foreground: 'red',
          });
  
        })();
      </script>
      ";
      $qrcodeG = "
      <canvas class='qrcode' id='".$idqr."'></canvas>
      <script>
        (function() {

          var ".$idqr." = new QRious({
            element: document.getElementById('".$idqr."'),
            value: '".$urilogin."',
            size:'256',
            foreground: 'green',
          });
  
        })();
      </script>
      ";
      $qrcodeB = "
      <canvas class='qrcode' id='".$idqr."'></canvas>
      <script>
        (function() {

          var ".$idqr." = new QRious({
            element: document.getElementById('".$idqr."'),
            value: '".$urilogin."',
            size:'256',
            foreground: 'blue',
          });
  
        })();
      </script>
      ";
   
    $num = $i + 1;

  
      $template = file_get_contents("$row");
     echo str_replace("%username%", $username,
          str_replace("%password%", $password,
          str_replace("%profile%", $profile,
          str_replace("%limitBytesTotal%", $datalimit,
          str_replace("%limitUptime%", $timelimit,
          str_replace("%validity%", $validity,
          str_replace("%price%", $getsprice,
          str_replace("%comment%", $comment,
          str_replace("%#%", $num,
          str_replace("%dnsName%", $dnsname,
          str_replace("%hotspotName%", $hotspotname,
          str_replace("%currency%", $currency, 
          str_replace("%qrCode%", $qrcode, 
          str_replace("%qrCodeRed%", $qrcodeR, 
          str_replace("%qrCodeGreen%", $qrcodeG, 
          str_replace("%qrCodeBlue%", $qrcodeB, 
          str_replace("%phone%", $phone,
          str_replace("%logo%", $logo,
          str_replace("%timeStamp%", $timestamp,
          $template)))))))))))))))))));
     
  
    }
    echo "<script>
    document.getElementsByTagName('title')[0].innerHTML = document.getElementsByTagName('title')[0].innerHTML+'_".$comment." ".$datalimit." ".$timelimit."';";
    if(!isset($prev)){
        echo "window.onload = window.print();";
      } 

     echo   '</script>
    
<script src="assets/js/format.js"></script>
    
    ';
    echo file_get_contents("$footer");
  

}
 ?>