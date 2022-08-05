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
$upid = $_GET['id'];
$upname = $_GET['name'];

include_once("config/connection.php");

if(!empty($upid)){
  
    $get_uprofile = $API->comm("/ip/hotspot/user/profile/print", array("?.id" => "$upid"));
}else if(!empty($upname)){
	$get_uprofile = $API->comm("/ip/hotspot/user/profile/print", array("?name" => "$upname"));
}
      echo json_encode($get_uprofile);
    //   $json_data = json_encode($get_users);

    //           $d = new jsEncode();

    //           $json_enc = $d->encodeString($json_data,25);
    //           echo $json_enc;
    	
}
 ?>