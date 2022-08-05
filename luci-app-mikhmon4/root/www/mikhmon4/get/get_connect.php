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
	include_once("config/readcfg.php");
    // routeros api
    include_once('core/routeros_api.class.php');

    $API = new RouterosAPI();
    $API->debug = true;
    $API->conn = true;
    $API->attempts = 1;
    $API->delay = 0;

    $API->connect($iphost, $userhost, dec_rypt($passwdhost));

    
 	
}
 ?>