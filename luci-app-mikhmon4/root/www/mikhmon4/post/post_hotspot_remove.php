<?php

session_start();
// hide all error
error_reporting(0);
include_once("../core/page_route.php");
include_once("../core/no_cache.php");


if(isset($_POST['sessname']) && isset($_SESSION["mikhmon"])){

    $m_user = explode("?",$_POST['sessname'])[1];
    $where = $_POST['where'];
    $id = $_POST['id'];

    // routeros api
    include_once('../core/routeros_api.class.php');

    include_once("../config/config.php");
    // read config

    $iphost = explode('!', $data[$m_user][1])[1];
    $userhost = explode('@|@', $data[$m_user][2])[1];
    $passwdhost = explode('#|#', $data[$m_user][3])[1];

    $API = new RouterosAPI();
    $API->debug = false;

    if($API->connect($iphost, $userhost, dec_rypt($passwdhost))){
    
    if($where == "user_"){
        $API->comm("/ip/hotspot/user/remove", array(
            ".id" => $id,));	
    }else  if($where == "profile_"){
        $API->comm("/ip/hotspot/user/profile/remove", array(
            ".id" => $id,));	
    }else  if($where == "active_"){
        $API->comm("/ip/hotspot/active/remove", array(
            ".id" => $id,));	
    }else  if($where == "host_"){
        $API->comm("/ip/hotspot/host/remove", array(
            ".id" => $id,));	
    }

    $mess = array(
        "message" => "success"
      );
        echo json_encode($mess);
    }else{
      $message = "error";

      $mess = array(
        "message"  => $message
      );
      echo json_encode($mess);
    }
	   

}else{
    // protect .php
$get_self = explode("/",$_SERVER['PHP_SELF']);
$self[] = $get_self[count($get_self)-1];

if($self[0] !== "index.php"  && $self[0] !==""){
    include_once("../core/page_route.php");
    include_once("../core/route.php");

 }
}
// }
   
?>
