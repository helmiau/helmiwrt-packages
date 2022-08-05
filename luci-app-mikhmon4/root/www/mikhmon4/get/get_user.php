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
include_once("../core/func.php");
$uid = $_GET['id'];
$uname = $_GET['name'];

include_once("config/connection.php");

if(!empty($uid)){
  
    $get_users = $API->comm("/ip/hotspot/user/print", array("?.id" => "$uid"));
}else if(!empty($uname)){
	$get_users = $API->comm("/ip/hotspot/user/print", array("?name" => "$uname"));
}
      // echo json_encode($get_users);
      $json_data = json_encode($get_users);

              $d = new jsEncode();

              $json_enc = $d->encodeString($json_data,25);
              echo $json_enc;
    	
}
 ?>