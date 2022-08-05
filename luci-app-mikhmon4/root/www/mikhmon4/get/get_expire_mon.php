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

          include_once("config/connection.php");
          
          
          $get_expire_mon = $API->comm("/system/scheduler/print", array(
            "?name" => "Mikhmon-Expire-Monitor", "?disabled" => "false"
            
          ));
            if($get_expire_mon[0]['name'] == "Mikhmon-Expire-Monitor"){
              $mess = array("expire_monitor" => "ok");
              $expmon = json_encode($mess);
            }else{
              $mess = array("expire_monitor" => "not ready");
              $expmon = json_encode($mess);
            }

              echo $expmon;

 	
}
 ?>