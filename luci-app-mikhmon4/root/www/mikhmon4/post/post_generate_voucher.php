<?php

session_start();
// hide all error
error_reporting(0);
include_once("../core/page_route.php");
include_once("../core/no_cache.php");



if(isset($_POST['qty']) && isset($_SESSION["mikhmon"])){

	$m_user = explode("?",$_POST['sessname'])[1];

        $qty = ($_POST['qty']);
		$server = ($_POST['server']);
		$user = ($_POST['user']);
		$userl = ($_POST['userl']);
		$prefix = ($_POST['prefix']);
		$char = ($_POST['char']);
		$profile = ($_POST['profile']);
		$timelimit = ($_POST['timelimit']);
		$datalimit = ($_POST['datalimit']);
		$gcomment = ($_POST['gcomment']);
        $gencode = ($_POST['gencode']);
		$dlimit = substr($datalimit,0,(strlen($datalimit) -1));
		$limitbyte = substr($datalimit,-1,1);
		if ($limitbyte == "m" || $limitbyte == "M"){
			$mbgb = 1048576;
		}else if ($limitbyte == "g" || $limitbyte == "G"){
			$mbgb = 1073741824;
		}
		if ($timelimit == "") {
			$timelimit = "0";
		} else {
			$timelimit = $timelimit;
		}
		if ($datalimit == "") {
			$datalimit = "0";
		} else {
			$datalimit = $dlimit * $mbgb;
		}
		if ($gcomment == "") {
			$gcomment = "";
		} else {
			$gcomment = $gcomment;
		}

		
		$commt = $user . "-" . $gencode . "-" . date("m.d.y") . "-" . $gcomment;
        
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
    $a = array("1" => "", "", 1, 2, 2, 3, 3, 4);
		if ($user == "up") {
			for ($i = 1; $i <= $qty; $i++) {
				if ($char == "lower") {
					$u[$i] = randLC($userl);
				} elseif ($char == "upper") {
					$u[$i] = randUC($userl);
				} elseif ($char == "upplow") {
					$u[$i] = randULC($userl);
				} elseif ($char == "mix") {
					$u[$i] = randNLC($userl);
				} elseif ($char == "mix1") {
					$u[$i] = randNUC($userl);
				} elseif ($char == "mix2") {
					$u[$i] = randNULC($userl);
				}
				if ($userl == 4) {
					$p[$i] = randN(4);
				} elseif ($userl == 5) {
					$p[$i] = randN(5);
				} elseif ($userl == 6) {
					$p[$i] = randN(6);
				} elseif ($userl == 7) {
					$p[$i] = randN(7);
				} elseif ($userl == 8) {
					$p[$i] = randN(8);
				}

				$u[$i] = "$prefix$u[$i]";
			}

			for ($i = 1; $i <= $qty; $i++) {
				$API->comm("/ip/hotspot/user/add", array(
					"server" => "$server",
					"name" => "$u[$i]",
					"password" => "$p[$i]",
					"profile" => "$profile",
					"limit-uptime" => "$timelimit",
					"limit-bytes-total" => "$datalimit",
					"comment" => "$commt",
				));
			}
		}

		if ($user == "vc") {
			$shuf = ($userl - $a[$userl]);
			for ($i = 1; $i <= $qty; $i++) {
				if ($char == "lower1") {
					$u[$i] = randLC($shuf);
				} elseif ($char == "upper1") {
					$u[$i] = randUC($shuf);
				} elseif ($char == "upplow1") {
					$u[$i] = randULC($shuf);
				}
				if ($userl == 4 || $userl == 5) {
					$p[$i] = randN(2);
				} elseif ($userl == 6 || $userl == 7) {
					$p[$i] = randN(3);
				} elseif ($userl == 8) {
					$p[$i] = randN(4);
				}

				$u[$i] = "$prefix$u[$i]$p[$i]";

				if ($char == "num") {
					if ($userl == 3) {
						$p[$i] = randN(3);
					} elseif ($userl == 4) {
						$p[$i] = randN(4);
					} elseif ($userl == 5) {
						$p[$i] = randN(5);
					} elseif ($userl == 6) {
						$p[$i] = randN(6);
					} elseif ($userl == 7) {
						$p[$i] = randN(7);
					} elseif ($userl == 8) {
						$p[$i] = randN(8);
					}

					$u[$i] = "$prefix$p[$i]";
				}
				if ($char == "mix") {
					$p[$i] = randNLC($userl);


					$u[$i] = "$prefix$p[$i]";
				}
				if ($char == "mix1") {
					$p[$i] = randNUC($userl);


					$u[$i] = "$prefix$p[$i]";
				}
				if ($char == "mix2") {
					$p[$i] = randNULC($userl);


					$u[$i] = "$prefix$p[$i]";
				}

			}
			for ($i = 1; $i <= $qty; $i++) {
				$API->comm("/ip/hotspot/user/add", array(
					"server" => "$server",
					"name" => "$u[$i]",
					"password" => "$u[$i]",
					"profile" => "$profile",
					"limit-uptime" => "$timelimit",
					"limit-bytes-total" => "$datalimit",
					"comment" => "$commt",
				));
			}
        }

        $get_hotspotusers = $API->comm("/ip/hotspot/user/print", array("count-only" => "","?comment"=> "$commt"));
        $_SESSION[$m_user.$commt] = $API->comm("/ip/hotspot/user/print", array("?comment"=> "$commt"));  

	
    
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
			"data" => array("count"=>"$get_hotspotusers","comment"=>"$commt","profile"=>"$profile")
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




