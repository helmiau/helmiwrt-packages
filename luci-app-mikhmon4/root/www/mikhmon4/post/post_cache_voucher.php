<?php

session_start();
// hide all error
error_reporting(0);
include_once("../core/page_route.php");
include_once("../core/no_cache.php");



if(isset($_POST['qty']) && isset($_SESSION["mikhmon"])){

	$m_user = explode("?",$_POST['sessname'])[1];

		$user = ($_POST['user']);

		$gcomment = ($_POST['gcomment']);
        $gencode = ($_POST['gencode']);

		if ($gcomment == "") {
			$gcomment = "";
		} else {
			$gcomment = $gcomment;
		}

		
		$commt = $user . "-" . $gencode . "-" . date("m.d.y") . "-" . $gcomment;
		$_SESSION[$m_user.$commt."_c"] = $commt;
        
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
    
	$get_hotspotusers = $API->comm("/ip/hotspot/user/print", array("?comment"=> "$commt", "?uptime" => "0s"));  
	$_SESSION[$m_user.$commt] = $get_hotspotusers;
	$totgen = count($get_hotspotusers);
    
    if(!empty($get_hotspotusers['!trap'][0]['message'])){
		$message = $get_hotspotusers['!trap'][0]['message'];
		$mess = array(
			"message" => "error",
			"data" => array("error" => $message)
		  );
		echo json_encode($mess);
	}else{
 
		$mess = array(
			"message" => "success",
			"data" => array("count"=>"$totgen","comment"=>"$commt")
		  );
		echo json_encode($mess);
	}
	

}else{
    // protect .php
$get_self = explode("/",$_SERVER['PHP_SELF']);
$self[] = $get_self[count($get_self)-1];

if($self[0] !== "index.php"  && $self[0] !==""){
    // include_once("../core/page_route.php");
    include_once("../core/route.php");

 }
}
// }
   
?>




