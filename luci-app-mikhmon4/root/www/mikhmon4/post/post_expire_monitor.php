<?php

session_start();
// hide all error
error_reporting(0);
include_once("../core/page_route.php");
include_once("../core/no_cache.php");


if(isset($_POST['sessname']) && isset($_SESSION["mikhmon"])){

	$m_user = explode("?",$_POST['sessname'])[1];

	$expire_monitor_src = $_POST['expmon'];

    // routeros api
    include_once('../core/routeros_api.class.php');

    include_once("../config/config.php");
    // read config

    $iphost = explode('!', $data[$m_user][1])[1];
    $userhost = explode('@|@', $data[$m_user][2])[1];
    $passwdhost = explode('#|#', $data[$m_user][3])[1];

    $API = new RouterosAPI();
    $API->debug = false;

    $API->connect($iphost, $userhost, dec_rypt($passwdhost));

  	$get_expire_mon = $API->comm("/system/scheduler/print", array(
            "?name" => "Mikhmon-Expire-Monitor",));

    if($get_expire_mon[0]['name'] !== "Mikhmon-Expire-Monitor"){
      $expmon = $API->comm("/system/scheduler/add", array(
        "name" => "Mikhmon-Expire-Monitor",
        "start-time" => "00:00:00",
        "interval" => "00:01:00",
        "on-event" => "$expire_monitor_src",
        "disabled" => "no",
        "comment" => "Mikhmon Expire Monitor",
        ));
      if(substr($expmon, 0,1) == "*"){
        $mess = array(
          "message" => "success"
        );
        echo json_encode($mess);
      }
    }else if($get_expire_mon[0]['disabled'] == "true"){
      $id = $get_expire_mon[0]['.id'];
      $expmon = $API->comm("/system/scheduler/set", array(
        ".id" => "$id",
        "interval" => "00:01:00",
        "on-event" => "$expire_monitor_src",
        "disabled" => "no",
        ));
      
        $mess = array(
          "message" => "success"
        );
        
        echo json_encode($mess);
      
    }else{
      $message = $get_expire_mon[0]['name'];
     
      $mess = array(
        "message" => $message
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
