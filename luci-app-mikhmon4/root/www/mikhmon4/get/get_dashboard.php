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

if($page == "get_sys_resource"){
    // get MikroTik system clock
    $get_systime = $API->comm("/system/clock/print")[0];
    $timezone = $get_systime['time-zone-name'];
    $_SESSION["timezone"] = $timezone;
    date_default_timezone_set($timezone);

    // get system resource MikroTik
    $get_resource = $API->comm("/system/resource/print")[0];
    // get routeboard info
    $get_routerboard = $API->comm("/system/routerboard/print")[0];
    // get sys identity
    $get_sysidentity = $API->comm("/system/identity/print")[0];
    // get sys health info
    $get_syshealth = $API->comm("/system/health/print")[0];

    // $resource->systime = $get_systime;
    // $resource->resource = $get_resource;
    // $resource->syshealth = $get_syshealth;
    // $resource->model = $get_routerboard['model'];
    // $resource->identity = $get_sysidentity['name'];

    $resource = array(
        "systime" => $get_systime,
        "resource" => $get_resource,
        "syshealth" => $get_syshealth,
        "model" => $get_routerboard['model'],
        "identity" => $get_sysidentity['name']
    );

    // echo json_encode($resource); 

    $json_data = json_encode($resource);

        $d = new jsEncode();

        $json_enc = $d->encodeString($json_data,25);
        echo $json_enc;


}else if($page == "get_hotspotinfo"){
    // get & counting hotspot users
    $get_hotspotusers = $API->comm("/ip/hotspot/user/print", array("count-only" => ""));

    // get & counting hotspot active
    $get_hotspotactive = $API->comm("/ip/hotspot/active/print", array("count-only" => ""));

    // $dash_json->hotspot_users = $get_hotspotusers -1;
    // $dash_json->hotspot_active = $get_hotspotactive;

    $dash_json = array(
       "hotspot_users" => ($get_hotspotusers -1),
       "hotspot_active" => $get_hotspotactive
    );
    // echo json_encode($dash_json);  

    $json_data = json_encode($dash_json);

        $d = new jsEncode();

        $json_enc = $d->encodeString($json_data,25);
        echo $json_enc;

}else if($page == "get_traffic"){
    $iface = $_GET['iface'];
    $get_interfacetraffic = $API->comm("/interface/monitor-traffic", array(
        "interface" => "$iface",
        "once" => "",
        ));
  
     
  
      $tx = $get_interfacetraffic[0]['tx-bits-per-second'];
      $rx = $get_interfacetraffic[0]['rx-bits-per-second'];
  
        
        // $dash_json->tx = $tx;
        // $dash_json->rx = $rx;

        $dash_json = array(
            "tx" => $tx,
            "rx" => $rx
        );
        
      echo json_encode($dash_json);

}else if($page == "get_log"){
    $force = $_GET['f'];

    if($force == "false" && isset($_SESSION["$m_user.$page"])){
        
        echo $_SESSION["$m_user.$page"];

    }else if($force == "true" || !isset($_SESSION["$m_user.$page"]) || empty($_SESSION["$m_user.$page"])){
        
        
        
        $getlogging = $API->comm("/system/logging/print", array("?prefix" => "->", ));
        $logging = $getlogging[0];
        if ($logging['prefix'] == "->") {
        } else {
            $API->comm("/system/logging/add", array("action" => "disk", "prefix" => "->", "topics" => "hotspot,info,debug", ));
        }

        
        //get hotspot log
        $get_log = $API->comm("/log/print", array("?topics" => "hotspot, info, debug"));
        $log = array_reverse($get_log);

        
            // echo json_encode($log);

            $json_data = json_encode($log);

            $d = new jsEncode();

            $json_enc = $d->encodeString($json_data,25);
            echo $json_enc;

            $_SESSION["$m_user.$page"] = $json_enc;
            

    }
    
     

}else if($page == "get_livereport"){
    $day = $_GET['day'];
    $month = $_GET['month'];
    $force = $_GET['f'];
    //get live report

    if($force == "false" && isset($_SESSION["$m_user.$month"])){
        
        echo $_SESSION["$m_user.$month"];

    }else if($force == "true" || !isset($_SESSION["$m_user.$month"]) || empty($_SESSION["$m_user.$month"])){
        
        
        // $get_tot_report = $API->comm("/system/script/print", array("?source" => "$day","count-only" => ""));
        $get_tot_report = $API->comm("/system/script/print", array("?owner" => "$month","count-only" => ""));
    
        if($get_tot_report !== $_SESSION["$m_user.'tot'.$month"]){

        $get_report = $API->comm("/system/script/print", array(
            "?owner" => "$month",
        ));
        
        
            // echo json_encode($get_report);

            $json_data = json_encode($get_report);

            $d = new jsEncode();

            $json_enc =  $d->encodeString($json_data,25);
            echo $json_enc;

            $_SESSION["$m_user.$month"] = $json_enc;
            $_SESSION["$m_user.'tot'.$month"] = $get_tot_report;
        }else{
            echo $_SESSION["$m_user.$month"];
        }
    }
    
  
}else if($page == "get_livereport_disable"){
    // $day = $_GET['day'];
    // $month = $_GET['month'];
    // $force = $_GET['f'];
    // //get live report

    // if($force == "false" && isset($_SESSION["$m_user.$month"])){
        
    //     echo $_SESSION["$m_user.$month"];

    // }else if($force == "true" || !isset($_SESSION["$m_user.$month"]) || empty($_SESSION["$m_user.$month"])){
        
        
    //     // $get_tot_report = $API->comm("/system/script/print", array("?source" => "$day","count-only" => ""));
    //     $get_tot_report = $API->comm("/system/script/print", array("?owner" => "$month","count-only" => ""));
    
    //     if($get_tot_report !== $_SESSION["$m_user.'tot'.$month"]){

    //     $get_report = $API->comm("/system/script/print", array(
    //         "?owner" => "$month",
    //     ));
        
        
    //         // echo json_encode($get_report);

    //         $json_data = json_encode($get_report);

    //         $d = new jsEncode();

    //         $json_enc = json_encode($get_report); // $d->encodeString($json_data,25);
    //         echo $json_enc;

    //         $_SESSION["$m_user.$month"] = $json_enc;
    //         $_SESSION["$m_user.'tot'.$month"] = $get_tot_report;
    //     }else{
    //         echo $_SESSION["$m_user.$month"];
    //     }
    // }
    
  
}
}
 ?>