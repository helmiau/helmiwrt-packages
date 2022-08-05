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

	
	if($GLOBALS['page'] == "settings"){
		
		include_once("view/admin/settings.php");
	}else if($GLOBALS['page'] == "template_editor"){
		
		include_once("view/admin/editor.php");
	}
		include_once("view/footer_html.php");
}
?>