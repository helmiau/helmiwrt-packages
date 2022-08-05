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

if(!isMobile()){ 
 
    $report_ma = "sidenav_active";
    
    include_once("view/header_html.php");
    include_once("view/menu.php");

?>
<div class="main">
    <div class="row">
        <div class="col-12">
            <div class="card card-shadow">
            <div class="card-header">
                <span><i class="fa fa-money"></i>&nbsp; <b>Sales Report</b> &nbsp; <span id="spin"></span></span>
            </div>
            <div class="card-body">
            <div class="row">
                <!-- <div class="col-12 mr-b-10">
                    <div class="btn-group">
                        <button class="bg-btn-group" onclick="loadSReport()" id="btn-selling-report"><i class="fa fa-list" ></i> Report</button> 
                        <button class="bg-btn-group" onclick="loadReportResume()" id="btn-report-resume"><i class="fa fa-chars" ></i> Resume</button>
                        
                    </div>
                    
                </div> -->
                
                <div class="col-12 hide" id="selling-report">
                    <div >
                    <div class="btn-group btn-container">
                        <button class="bg-btn-group table-total" id="total-report" >&nbsp;</button>
                                           
                        <button class="bg-btn-group" onclick="loadSReport(thisMonth,'true')" title="Force reload"><i class="fa fa-refresh" ></i></button>
                        <input type="text" autocomplete = "off" id="filter-report" onkeyup="filterTableReport('report','searchReport',this.value,'count-report')" placeholder="Filter" />
                        <button class="bg-btn-group" onclick="filterTableReport('report','filter-report','','count-report');selectFO('day')" title="Clear filter"><i class="fa fa-filter" ></i></button>

                    </div>
                    <div class="btn-group btn-container">
                        <select class="bg-btn-group pointer" id="day" onchange="filterDay(this.value,'month','year')"></select>
                        <select class="bg-btn-group pointer" id="month"></select>
                        <select class="bg-btn-group pointer" id="year"></select>
                        <button class="bg-btn-group" id="btnFilter" onclick="filterMonth('day','month','year')"><i class="fa fa-search"></i></button>
                        <button class="bg-btn-group" onclick="exportToCSV(rFileName('.csv'),'dataReport')" title="Download sales report CSV"><i class="fa fa-download"></i> CSV</button>
                        <button class="bg-btn-group" onclick="exportToExcel('dataReport',rFileName('.xls'))"  title="Download sales report EXCEL"><i class="fa fa-download"></i> XLS</button>
                    </div>
                    
                    </div>
                    <div class="card-fixed mr-t-10">
                    <div style="max-width: 500px; margin-bottom: 10px;">
                    <table  class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Filtered By</th>             
                                <th class="text-center">Qty</th>
                                <th class="text-right">Total</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="ld-report">
                                <td><span id="filterby-t"></span></td>
                                <td class="text-center"><span id="count-vcr-t">-</span></td>
                                <td class="text-right"><span id="count-report-t">-</span></td>                                
                            </tr>
                            <tr>
                                <td><span id="filterby"></span></td>
                                <td class="text-center"><span id="count-vcr">-</span></td>
                                <td class="text-right"><span id="count-report">-</span></td>                                
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <table id="dataReport" class="table table-bordered table-hover sreport">
                        
                        <thead>
                            <tr class="yes"> 				
                                <th>Date</th>
                                <th>Time</th>
                                <th>Username</th>
                                <th>IP Address</th>
                                <th>MAC Address</th>
                                <th>Profile</th>
                                <th>Comment</th>
                                <th class="text-right">Price</th>
                                
                            </tr>
                        </thead>
                        <tbody id="report">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>

                <div class="col-12 hide" id="report-resume">
                    <div class="row">
                    <div class="col-4">
                        <div class="box">
                            
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="box">
                            
                        </div>
                    </div>    
                    <div class="col-12" id="container"></div>
                    </div>
                    
            </div>
            </div>
            </div>
            <div class="card-footer"><span id="loading"></span> </div>
            </div>
        </div>
    </div>
</div>
<?php 

}else if(isMobile()){ 

  $report_ma = "nav_active";
  $navicon ='<i class="fa fa-money"></i>';
    
    include_once("view/header_html.php");
    include_once("view/menu.php");

  ?>

<div class="main-mobile">
    <div class="row" style="padding-top:15px; padding-bottom:100px">
        <div class="col-12">
            <div class="mobile-card ">
            
                <h3><i class="fa fa-money"></i>&nbsp; Sales Report &nbsp; <span id="spin"></span> </h3>
                <small id="loadingHeader"></small>
            
            <div class="mr-t-10">
            <div class="row">
                <!-- <div class="col-12 mr-b-10">
                    <div class="btn-group">
                        <button class="bg-btn-group" onclick="loadSReport()" id="btn-selling-report"><i class="fa fa-list" ></i> Report</button> 
                        <button class="bg-btn-group" onclick="loadReoprResume()" id="btn-report-resume"><i class="fa fa-chars" ></i> Resume</button>
                        
                    </div>
                    
                </div> -->
                
                <div class="col-12 hide" id="selling-report">
                    <div class="">
                    <div class="btn-group">
                        <div class="btn-group btn-container">
                        <button class="bg-btn-group table-total" id="total-report" >&nbsp;</button>
                                           
                        <button class="bg-btn-group" onclick="loadSReport(thisMonth,'true')" title="Force reload"><i class="fa fa-refresh" ></i></button>
                        <input type="text" autocomplete = "off" id="filter-report" onkeyup="filterTableReport('report','searchReport',this.value,'count-report')" placeholder="Filter" />
                        <button class="bg-btn-group" onclick="filterTableReport('report','filter-report','','count-report')" title="Clear filter"><i class="fa fa-filter" ></i></button>

                    </div>
                    <div class="btn-group btn-container">
                        <select id="day" onchange="filterDay(this.value,'month','year')"></select>
                        <select id="month"></select>
                        <select id="year"></select>
                        <button class="bg-btn-group" onclick="filterMonth('day','month','year')"><i class="fa fa-search"></i></button>
                        <button class="bg-btn-group" onclick="exportTableToCSV(reportFN(),'dataReport')" title="Download sales report"><i class="fa fa-download"></i></button>
                    </div>

                    </div>
                    
                    </div>
                    <div class="card-fixed mr-t-10">
                    <div style="max-width: 500px; margin-bottom: 10px;">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Filtered By</th>             
                                <th class="text-center">Qty</th>
                                <th class="text-right">Total</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="ld-report">
                                <td><span id="filterby-t"></span></td>
                                <td class="text-center"><span id="count-vcr-t">-</span></td>
                                <td class="text-right"><span id="count-report-t">-</span></td>                                
                            </tr>
                            <tr>
                                <td><span id="filterby"></span></td>
                                <td class="text-center"><span id="count-vcr">-</span></td>
                                <td class="text-right"><span id="count-report">-</span></td>                                
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <table id="dataReport" class="table table-bordered table-hover sreport">
                        
                        <thead>
                            <tr class="yes hide">                
                                <th>Date</th>
                                <th>Time</th>
                                <th>Username</th>
                                <th>IP Address</th>
                                <th>MAC Address</th>
                                <th>Profile</th>
                                <th>Comment</th>
                                <th class="text-right">Price</th>
                                
                            </tr>
                            <tr>                
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody id="report">
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            </div>
            <div class="card-footer"><span id="loading"></span> </div>
            </div>
        </div>
    </div>
</div>


<?php } ?>
<script>
    
$(document).ready(function() {
// $("#user-profiles").removeClass('hide').addClass('block');
// loadSReport(thisMonth)
setTimeout(function(){
        setTimeout(function(){
            loadSReport(thisMonth)
        },100)
    // $("#report").html("")
},1)




    $(".sreport").fancyTable({
    inputId: "searchReport",          
    sortColumn:0,
    pagination: true,
    perPage:10,
    globalSearch:true,
    paginationClass: "btn btn-bordered",
    paginationClassActive:"bg-primary",

    });  

   

  setYear('year')
  setMonth('month')
  setDay('day')
})

</script>


<?php
include_once("view/footer_html.php");
}
?>
