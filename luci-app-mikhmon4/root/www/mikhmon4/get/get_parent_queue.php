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

      if($force == "false" && isset($_SESSION["$m_user.'parentq'"])){
          
              echo $_SESSION["$m_user.'parentq'"];
      }else if($force == "true" || !isset($_SESSION["$m_user.'parentq'"])){
            include_once("config/connection.php");


            $get_allqueue = $API->comm("/queue/simple/print", array(
                "?dynamic" => "false",
            ));

            echo json_encode($get_allqueue);
            $_SESSION["$m_user.'parentq'"] = json_encode($get_allqueue);


        }

    	
}
 ?>