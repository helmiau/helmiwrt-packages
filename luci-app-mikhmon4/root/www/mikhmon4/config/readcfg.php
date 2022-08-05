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
    include_once("route.php");
    // include_once("config/config.php");
    // read config
    foreach (file('./config/config.php',FILE_SKIP_EMPTY_LINES) as $line) {
      $ss = explode("'", $line)[1];
      clearstatcache();
      if ($ss == $m_user) {
            
          $iphost = get_config($line,$m_user.'!', "'");
          $userhost = get_config($line,$m_user.'@|@', "'");
          $passwdhost = get_config($line,$m_user.'#|#', "'");
          $hotspotname = get_config($line,$m_user.'%', "'");
          $dnsname = get_config($line,$m_user.'^', "'");
          $currency = get_config($line,$m_user.'&', "'");
          $phone = get_config($line,$m_user.'*', "'");
          $email = get_config($line,$m_user.'(', "'");
          $infolp = get_config($line,$m_user.')', "'");
          $idleto = get_config($line,$m_user.'=', "'");
          $sesname = get_config($line,$m_user.'+', "'");
          $report = get_config($line,$m_user.'@!@', "'");
          $token = get_config($line,$m_user.'#!#', "'");
          $_SESSION[$m_user.'-report'] = $report;

          $useradm = get_config($line,'mikhmon<|<', "'");
          $passadm = get_config($line,'mikhmon>|>', "'");
      }
    }

    
}