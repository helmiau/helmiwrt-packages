<?php

session_start();
// hide all error
error_reporting(0);
include_once("../core/page_route.php");
include_once("../core/no_cache.php");

if(isset($_POST['logout']) && isset($_SESSION["mikhmon"])){
    session_destroy();
    echo $_POST['logout'];


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
