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
    $m_user_page = array(
    
    // get get
    "get_report" => "get/get_report.php",
    "profile" => "get/get_profile.php",
    "profiles" => "get/get_profiles.php",
    "user" => "get/get_user.php",
    "users" => "get/get_users.php",
    "get_sys_resource" => "get/get_dashboard.php",
    "get_hotspotinfo" => "get/get_dashboard.php",
    "get_log" => "get/get_dashboard.php",
    "get_livereport" => "get/get_dashboard.php",
    "get_livereport_disable" => "get/get_dashboard.php",
    "get_traffic" => "get/get_dashboard.php",
    "get_hotspot_server" => "get/get_hotspot_server.php",
    "get_hotspot_active" => "get/get_hotspot_active.php",
    "get_hosts" => "get/get_hosts.php",
    "get_expire_mon" => "get/get_expire_mon.php",
    "get_tot_users" => "get/get_tot_users.php",
    "get_interface" => "get/get_interface.php",
    "get_addr_pool" => "get/get_addr_pool.php",
    "get_parent_queue" => "get/get_parent_queue.php",

    "get_nat" => "get/get_nat.php",
    "connect" => "get/get_connect.php",
  

    
    

    //view
    "dashboard" => "view/dashboard.php",
    "about" => "view/about.php",
    "hotspot_active" => "view/hotspot_active.php",
    "s_report_per_day" => "view/report_per_day.php",
    "s_report" => "view/report_all.php",
    "live_report" => "view/live_report.php",
    "hotspot" => "view/hotspot.php",
    "log" => "view/log.php",
    "report" => "view/report.php",
    "print" => "view/print_voucher.php",
    "set_theme" => "config/settheme.php",
    
);

    $admin_page = array(
    "about" => "view/about.php",    
    "settings" => "view/admin.php",
    "template_editor" => "view/admin.php",
    "vpreview" => "view/print_voucher.php",
    "login" => "view/login.php",
    "set_theme" => "config/settheme.php",
    "ping" => "get/get_ping.php",
    
   

);

    $err_page = array(
    "404" => "view/404.php",
);


}
?>