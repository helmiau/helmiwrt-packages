<?php 
//
session_start();
error_reporting(0);

include_once("core/page_route.php");
include_once("core/route.php");
include_once("config/page.php");
include_once("core/jsencode.class.php");
include_once('core/routeros_api.class.php');

$r_uri = $_SERVER['REQUEST_URI'];
$uri_path =  explode("/",explode("?",explode("&",$r_uri)[0])[1]);
$n_uri_path = count($uri_path);
$max_path = 3;

$m_user =  $uri_path[0];
$page = $uri_path[1];
$act = $uri_path[2];
$_SESSION['m_user'] = $m_user;
$_SESSION["admin"] = "admin";

// route page
if (!isset($_SESSION["mikhmon"])) {
    route("admin","login",$admin_page);
}else if(empty($m_user) && empty($page) || $m_user == "admin" && empty($page)){
        header('Location: ./?admin/settings');      
}else{
    if($m_user ==  "admin"){
        route("admin",$page,$admin_page);
   
    }else{
        if(!empty($m_user) && empty($page)){
            include_once($m_user_page['dashboard']);
        }else{
            route($m_user,$page,$m_user_page);
        }
    }
}

// all session
foreach (file('./config/config.php') as $line) {
    $ses = explode("'", $line)[1];
    if($ses !== "mikhmon"){
        $_SESSION["$ses"] = $ses;
    }
}


?>
