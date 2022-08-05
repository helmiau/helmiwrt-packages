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
$day = $_GET['day'];
$force = $_GET['f'];
$sessR = $m_user."report".$day;

$today = strtolower(date('M/d/Y'));

    if($today == $day){
        include_once("config/connection.php");
      
        
      
        $get_report = $API->comm("/system/script/print", array(
          "?source" => "$day",
        ));
        // echo json_encode($get_report);

        $json_data = json_encode($get_report);

            $d = new jsEncode();

            $json_enc = $d->encodeString($json_data,25);
            echo $json_enc;

        $_SESSION["$sessR"] = $json_enc;
      } else if($today != $day){
        if($force == "false" && isset($_SESSION["$sessR"])){
            
          echo $_SESSION["$sessR"];
          
        }else if($force == "true" || !isset($_SESSION["$sessR"]) || empty($_SESSION["$sessR"])){
        include_once("config/connection.php");
        
          $get_tot_report = $API->comm("/system/script/print", array("?source" => "$day","count-only" => ""));
       
          if($get_tot_report != $_SESSION["$sessR.'tot'"]){
        
            $get_report = $API->comm("/system/script/print", array(
              "?source" => "$day",
            ));
            // echo json_encode($get_report);

            $json_data = json_encode($get_report);

              $d = new jsEncode();

              $json_enc = $d->encodeString($json_data,25);
              echo $json_enc;
    
            $_SESSION["$sessR"] = $json_enc;
            $_SESSION["$sessR.'tot'"] = $get_tot_report;
          }else{
            echo $_SESSION["$sessR"];
          }

        }
    
}   
    
}
 ?>