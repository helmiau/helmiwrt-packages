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

$force = $_GET['f'];

      if($force == "false" && isset($_SESSION["$m_user.'addr_pool'"])){
          
              echo $_SESSION["$m_user.'addr_pool'"];
      }else if($force == "true" || !isset($_SESSION["$m_user.'addr_pool'"])){
        include_once("config/connection.php");


        $get_pool = $API->comm("/ip/pool/print");

      echo json_encode($get_pool);
      $_SESSION["$m_user.'addr_pool'"] = json_encode($get_pool);
      }
    	
}
 ?>