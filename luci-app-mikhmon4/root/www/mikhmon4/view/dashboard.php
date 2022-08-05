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
  echo "<script>localStorage.setItem('?".$m_user."-report','".$_SESSION[$m_user."-report"]."')</script>";
  if(file_exists('assets/img/logo-'.$m_user.'.png')){
    $logo = 'assets/img/logo-'.$m_user.'.png';
  }else{
    $logo = 'assets/img/favicon.png';
  }  

if(!isMobile()){ 

$dash_ma = "sidenav_active";

include_once("view/header_html.php");
include_once("view/menu.php");


?>

<div class="main unselect" >
  
  <div class="row">
    <div class="col-12">
      <div class="box box-bordered">
        <div class="row">
          <div class="text-left col-5" id="statconn">
            <i class="fa fa-tag"></i>&nbsp;
            <span id="sessionLoad"></span>
            <!-- <div>
            <select id="lsession" style="border: none; border-radius: 3px; padding: 0 0 0 3px; font-weight: bold;" onchange="connect('statconn',this.value)">
                <option id="load-session" value="0"></option>
                <?php 
                $i = -2;
                foreach (file('./config/config.php',FILE_SKIP_EMPTY_LINES) as $line) {
                $s = explode("'", $line)[1];                      
                $i++;
                if ($s == "" || $s == "mikhmon") {
                } else { 
                ?>
                <option value="<?= $s; ?>"><?= strtoupper($s); ?></option>
                <?php }}?>
            </select>
            &nbsp;
          </div> -->
          </div>
          <div class="text-right col-7 "  style="font-size: 14px; font-weight:bold;">
            <span id="time-zone">-</span> | 
            <span id="time">-</span> | 
            <span id="date">-</span>
            
          </div>
        </div>
      
      </div>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-4">
          <div class="box bmh-80 box-red">
            <div class="box-group">
              
                <div class="box-group-area">
              
                  <span class="box-group-text" id="hotspot-active">-</span><br>
                  
                </div>
                <div class="box-group-icon" style="height: 90px;"><i class="fa fa-wifi"></i><div>Active</div></div>
            </div>
            
          </div>
        </div>
          <div class="col-4">
            <div class="box bmh-80 box-yellow">
              <div class="box-group">
                  <div class="box-group-area">
                 
                    <span class="box-group-text" id="hotspot-users">-</span>
                  </div>
                  <div class="box-group-icon" style="height: 90px;"><i class="fa fa-users"></i><div>Users</div></div>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="box bmh-80 box-green">
              <div class="box-group">
                  <div class="box-group-area text-left">
                    <span style="font-size:10px;margin-bottom:2px;">This month: </span><br><span style="font-size:20px;" class="box-group-text" id="live-report-month">-</span><br>
                    <span style="font-size:10px;margin-bottom:2px;">Today: </span><br><span style="font-size:15px;" class="box-group-text" id="live-report-day">-</span>
                  </div>
                  <div class="box-group-icon" ><i class="fa fa-money"></i><div>Income</div></div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <div class="col-8">
      <div class="row">
        <div class="col-6">
          <div class="card card-shadow">
            <div class="card-header">
              <h3><i class="fa fa-tasks"></i> Resource <span id="identity"></span></h3>
            </div>
            <div class="card-body card-body-rb">
              
                <table class="table table-hover text-nowrap unselect" style="font-size: 13px;">
                  <tr>
                    <td>CPU Load</td>
                    <td colspan="2">
                      <div class="bg-grey">
                        <div class="prog-active" id="prog-cpu"><span class="mr-l-5" id="cpu-load">-</span></div>
                      </div>
                      
                    </td>
                  </tr>
                  <tr>
                    <td>Memory</td>
                    <td colspan="2">
                      <div class="bg-grey">
                        <div class="prog-active"  id="prog-memory"><span class="mr-l-5" id="memory">-</span></div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>HDD</td>
                    <td colspan="2">
                      <div class="bg-grey">
                        <div class="prog-active"  id="prog-hdd"><span class="mr-l-5" id="hdd">-</span></div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Health</td>
                    <td title="Voltage" ><i class="fa fa-bolt"></i> <span id="voltage">-</span></td>
                    <td title="Temperature" ><i class="fa fa-thermometer-empty"></i> <span id="temperature">-</span></td>
                  </tr>
                </table>
              </div>
          </div>
        </div>
          
          <div class="col-6">
            <div class="card card-shadow">
              <div class="card-header">
                <h3><i class="fa fa-info-circle"></i> System Info</h3>
              </div>
              <div class="card-body card-body-rb">
                <table class="table table-hover text-nowrap unselect" style="font-size: 13px;">
                  <tr>
                    <td>Uptime</td>
                    <td><span id="uptime">-</span></td>
                  </tr>
                  <tr>
                    <td>Board Name</td>
                    <td><span id="board-name">-</span></td>
                  </tr>
                  <tr>
                    <td>Model</td>
                    <td><span id="model">-</span></td>
                  </tr>
                  <tr>
                    <td>Router OS</td>
                    <td><span id="version">-</span></td>
                  </tr>
                </table>
                  
            </div>
          </div>
      </div>
        <div class="col-12">
          <div class="card card-shadow">
            <div class="card-header">
              <h3><span ><i class="fa fa-area-chart"></i> Traffic Monitor </span>
                
              </h3>
            </div>
            <div class="card-body card-body-rb">
              <div class="row">
                <div class="col-12">
                  <select id="iface-name" title="Select Interface"></select>
                </div>
                <div class="col-12">
                  <div class="pd-t-10 pd-r-10;" id="trafficMonitor"></div>
                </div>
            </div>
          </div>
          </div>
        
        </div>
    </div>
    </div>
    <div class="col-4">
      <div class="row">
          <div class="col-12">
            <div class="card card-shadow">
              <div class="card-header">
                <h3><i class="fa fa-file-text"></i> App Log</h3>
              </div>
              <div class="card-body card-body-rb">
                <div style="height: 107px ;" class="overflow" id="applogd">
                  <table class="table table-bordered table-hover unselect" style="font-size: 12px;">
                    <tbody  id="applog">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
          </div>
          <div class="col-12">
            <div class="card card-shadow">
              <div class="card-header">
                <h3><i class="fa fa-file-text"></i> Hotspot Log</h3>
              </div>
              <div class="card-body card-body-rb">
                <div style="height: 320px ;" class="mr-t-10 overflow">
                  <table class="table table-bordered table-hover unselect" style="font-size: 12px;">
                    <thead>
                      <tr>
                        <th>Time</th>
                        <th>User (IP)</th>
                        <th>Messages</th>
                      </tr>
                    </thead>
                    <tbody  id="log">
                      <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                      <tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            
          </div>
      </div>
    </div>

  </div>

</div>

<?php 

}else if(isMobile()){ 
  $dash_ma = "nav_active";
  $navicon = '<i class="fa fa-th-large"></i>';
  include_once("view/header_html.php");
  include_once("view/menu.php");

  ?>

  <div class="main-mobile"  >
    <div class="row" >

      <div class="mobile-dashboard-top">
        <div class="image-circle-box">
          <div class="image-circle-mobile" style="background-image: url('<?= $logo ?>')"></div>
        </div>
        <div class="pd-r-5">
            <div class="text-right unselect pd-5">
              <span id="time-zone">-</span> | 
              <span id="time">-</span> | 
              <span id="date">-</span>
            </div>
        </div>
    </div>
    <div class="text-left pd-l-5 hide" id="load-session"></div>
  </div>
  
  <div class="mobile-body" >
      <div class="row">
        <div class="col-6">
          <div class="box bmh-60 box-red">
            <div class="box-group">
                <div class="box-group-area">
                  <span class="box-group-text" id="hotspot-active">-</span><br>
                </div>
                <div class="box-group-icon" style="height: 60px;"><i class="fa fa-wifi"></i><div>Active</div></div>
            </div>
          </div>
        </div>
          <div class="col-6">
            <div class="box bmh-60 box-yellow">
              <div class="box-group">
                  <div class="box-group-area">
                    <span class="box-group-text" id="hotspot-users">-</span>
                  </div>
                  <div class="box-group-icon" style="height: 60px;"><i class="fa fa-users"></i><div>Users</div></div>
              </div>
            </div>
          </div>
          <div class="col-12">
          <div class="box bmh-60 box-green">
            <div class="box-group">
              <div class="box-group-area text-left">
                <span style="font-size:10px;margin-bottom:2px;">This month: </span><br><span style="font-size:20px;" class="box-group-text" id="live-report-month">-</span><br>
                <span style="font-size:10px;margin-bottom:2px;">Today: </span><br><span style="font-size:15px;" class="box-group-text" id="live-report-day">-</span>
              </div>
              <div class="box-group-icon"><i class="fa fa-money"></i><div>Income</div></div>
            </div>
          </div>
        </div>
      </div>
  </div>
    <div class="w-12" style="padding-bottom:100px;">

         
            <div class="mobile-card">
              <h3><i class="fa fa-server"></i> System Resource</h3>
            
                <table class="table table-hover text-nowrap unselect" style="font-size: 13px;">
                  <tr>
                    <td>CPU Load</td>
                    <td colspan="2">
                      <div class="bg-grey">
                        <div class="prog-active" id="prog-cpu"><span class="mr-l-5" id="cpu-load">-</span></div>
                      </div>
                      
                    </td>
                  </tr>
                  <tr>
                    <td>Memory</td>
                    <td colspan="2">
                      <div class="bg-grey">
                        <div class="prog-active"  id="prog-memory"><span class="mr-l-5" id="memory">-</span></div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>HDD</td>
                    <td colspan="2">
                      <div class="bg-grey">
                        <div class="prog-active"  id="prog-hdd"><span class="mr-l-5" id="hdd">-</span></div>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Health</td>
                    <td><i class="fa fa-bolt"></i> <span id="voltage">-</span></td>
                    <td><i class="fa fa-thermometer-empty"></i> <span id="temperature">-</span></td>
                  </tr>
                  <tr>
                    <td>Uptime</td>
                    <td colspan="2"><span id="uptime">-</span></td>
                  </tr>
                  <tr>
                    <td>Board Name</td>
                    <td colspan="2"><span id="board-name">-</span></td>
                  </tr>
                  <tr>
                    <td>Model</td>
                    <td colspan="2"><span id="model">-</span></td>
                  </tr>
                  <tr>
                    <td>Router OS</td>
                    <td colspan="2"><span id="version">-</span></td>
                  </tr>
                  <tr>
                    <td>Identity</td>
                    <td colspan="2"><span id="identity">-</span></td>
                  </tr>
                </table>
              </div>
  

            <div class="mobile-card">
              <h3><span><i class="fa fa-area-chart"></i> Traffic Monitor </span></h3>
            
              <div class="row">
                <div class="col-12">
                  <select id="iface-name"  title="Select Interface"></select>
                </div>
                <div class="col-12">
                  <div class="pd-t-10 pd-r-10;" id="trafficMonitor"></div>
                </div>
            </div>
            </div>
          

              
              <div class="mobile-card">
                <h3><i class="fa fa-file-text"></i> App Log</h3>

                <div style="height: 200px ;" class="mr-t-10  overflow" id="applogd">
                  <table class="table table-bordered table-hover unselect" style="font-size: 12px;">
                    <tbody  id="applog">
                    </tbody>
                  </table>
                </div>
              </div>

            
              <div class="mobile-card" >
                <h3><i class="fa fa-file-text"></i> Hotspot Log</h3>
              
                <div style="height: 400px ;" class="mr-t-10 overflow">
                  <table class="table table-bordered table-hover unselect" style="font-size: 12px;">
                    <thead>
                      <tr>
                        <td>Time</td>
                        <td>User (IP)</td>
                        <td>Messages</td>
                      </tr>
                    </thead>
                    <tbody  id="log">
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tbody>
                  </table>
                </div>
              </div>
           
            
          </div>
      </div>


 



<?php } ?>
<script src="assets/js/highcharts/highcharts.js"></script>
<script src="assets/js/highcharts/highcharts.theme.js"></script>
<script>

$(document).ready(function() {
dashboard()
loadInterface()
trafficMonitor(theme)
$("#loadse")
})


</script>



<?php

include_once("view/footer_html.php");
}
?>
