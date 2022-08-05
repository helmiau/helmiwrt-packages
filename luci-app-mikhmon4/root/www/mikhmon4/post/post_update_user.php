<?php

session_start();
// hide all error
error_reporting(0);
include_once("../core/page_route.php");
include_once("../core/no_cache.php");



if(isset($_POST['name']) && isset($_SESSION["mikhmon"])){

	$m_user = explode("?",$_POST['sessname'])[1];
	$reset = $_POST['reset'];
	$uid = $_POST['uid'];
	$server = $_POST['server'];
	$name = $_POST['name'];
	$password = $_POST['password'];
	$profile = $_POST['profile'];
	$mac_addr = $_POST['macaddr'];
	$timelimit = $_POST['timelimit'];
	$datalimit = $_POST['datalimit'];
	$comment = $_POST['comment'];
	$expdate = $_POST['expdate'];
	$ucode = $_POST['ucode'];

	if($expdate == "" && $ucode == ""){
		$comment = $comment;
	}else if($expdate == "" && $ucode !== ""){
		if((substr($ucode,0,3) == "up-") || (substr($ucode,0,3) == "vc-")){
			if($name == $password){
				$comment = "vc-".substr($ucode,3,strlen($ucode)).$comment;
			}else{
				$comment = "up-".substr($ucode,3,strlen($ucode)).$comment;
			}
		}else{
			$comment = $ucode.substr($ucode,3,strlen($ucode)).$comment;
		}
	}else if($expdate !== "" && $ucode == ""){
		$comment = $expdate. " " .$comment;
	}

	
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

    if($reset == "yes"){
    	$API->comm("/ip/hotspot/user/reset-counters", array(
			".id" => "$uid",
		));
    }
    
	$add = $API->comm("/ip/hotspot/user/set", array(
	  ".id" => "$uid",		
	  "server" => "$server",
      "name" => "$name",
      "password" => "$password",
      "profile" => "$profile",
      "mac-address" => "$mac_addr",
      "disabled" => "no",
      "limit-uptime" => "$timelimit",
      "limit-bytes-total" => "$datalimit",
      "comment" => "$comment",
    ));


    if(!empty($add['!trap'][0]['message'])){
		$message = $add['!trap'][0]['message'];
		$mess = array(
			"message" => "error",
			"data" => array("error" => $message)
		  );
		echo json_encode($mess);
	}else{
    	$getuser = $API->comm("/ip/hotspot/user/print", array(
	      "?.id" => "$uid",
	    ));

		$mess = array(
			"message" => "success",
			"data" => $getuser[0]
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
