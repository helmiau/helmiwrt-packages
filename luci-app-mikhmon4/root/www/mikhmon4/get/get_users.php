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

$uprof = $_GET['prof'];
$force = $_GET['f'];
$cache = $_GET['c'];
$x = "#";
    if($force == "false" && isset($_SESSION["$m_user.$uprof"])){
        
            
            if(isset($cache)){
                echo $_SESSION["$m_user.$uprof.$x"];
            }else{
                echo $_SESSION["$m_user.$uprof"];
            }
    }else if($force == "true" || !isset($_SESSION["$m_user.$uprof"]) || empty($_SESSION["$m_user.$uprof"])){
        include_once("config/connection.php");

            $get_users = $API->comm("/ip/hotspot/user/print", array("?profile" => "$uprof"));
            
            $json_data = json_encode($get_users);

            $d = new jsEncode();

            $json_enc = $d->encodeString($json_data,25);
            
                if(isset($cache)){
                    echo count($get_users);
                }else{
                    echo $json_enc;
                }

            $_SESSION["$m_user.$uprof"] = $json_enc;
            $_SESSION["$m_user.$uprof.$x"] = count($get_users);

    }
}
 ?>