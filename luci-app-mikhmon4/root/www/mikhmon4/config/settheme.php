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


$gettheme = $_GET['theme'];
$_SESSION['theme'] = $gettheme;
$mtheme = array(
    "dark",
    "light",
    "blue",
    "green",
    "pink",
    
);
$theme_color = array(
    "#3a4149",
    "#008BC9",
    "#008BC9",
    "#37BA68",
    "#e83e8c",
);
$themenum = array_search($gettheme, $mtheme);

$getthemecolor = $theme_color[$themenum];
$_SESSION['themecolor'] = $getthemecolor;

if (empty($gettheme)) {  

} else {
    if (in_array($gettheme, $mtheme)) {
        $gen = '<?php $theme="' . $gettheme . '"; $themecolor="'.$getthemecolor.'";?>';
        $stheme = 'config/theme.php';
        $handle = fopen($stheme, 'w') or die('Cannot open file:  ' . $stheme);
        $data = $gen;
        fwrite($handle, $data);
        
    }
}
}