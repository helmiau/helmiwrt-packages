<?php

session_start();
// hide all error
error_reporting(0);
include_once("../core/page_route.php");
include_once("../core/no_cache.php");
include_once("../core/routeros_api.class.php");



if(isset($_POST['router_']) && isset($_SESSION["mikhmon"])){
   $do = $_POST['do'];    
    if($do == "saveTemplate"){
  		$template = $_POST['_template'];
		$t_file = "../template/".$_POST['file_'];
		if (is_file($t_file) && !is_writable($t_file)) {
			    $mess->message = "Error, cannot write config file, please check folder or file permissions.";
	    		echo json_encode($mess);
    	}else{

	        $handle = fopen($t_file, 'w') or die('Cannot open file:  ' . $t_file);
	        fwrite($handle, $template);
	      
			$mess = array(
				"message" => "Saved"
			  );
	    		echo json_encode($mess);
	    } 
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
