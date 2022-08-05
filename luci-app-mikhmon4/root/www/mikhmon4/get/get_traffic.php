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
$iface = $_GET['iface'];

include_once("config/connection.php");
  
  $get_interfacetraffic = $API->comm("/interface/monitor-traffic", array(
        "interface" => "$iface",
        "once" => "",
        ));
  
      $rows = array(); $rows2 = array();
  
      $ftx = $get_interfacetraffic[0]['tx-bits-per-second'];
      $frx = $get_interfacetraffic[0]['rx-bits-per-second'];
  
        $rows['name'] = 'Tx';
        $rows['data'][] = $ftx;
        $rows2['name'] = 'Rx';
        $rows2['data'][] = $frx;
        

    $result = array();
  
      array_push($result,$rows);
      array_push($result,$rows2);
      echo json_encode($result);
    

}
 ?>