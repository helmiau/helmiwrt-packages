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
    $hotspot_ma = "sidenav_active";
    
    include_once("view/header_html.php");
    include_once("view/menu.php");
?>
<div class="main">
    <div class="row">
        <div class="col-12">
            <div class="card card-shadow">
            <div class="card-header unselect">
                <span><i class="fa fa-wifi"></i>&nbsp; <b>Hotspot</b> &nbsp; </span>
                    <span class="card-tab" id="btn-hotspot-users"><i class="fa fa-users" ></i> Users</span>
                    <span class="card-tab" onclick="loadUserProfiles()" id="btn-user-profiles"><i class="fa fa-pie-chart" ></i> User Profile</span>
                    <span class="card-tab" onclick="loadHotspotActive()" id="btn-hotspot-active"><i class="fa fa-wifi" ></i> Active</span>
                    <span class="card-tab" onclick="loadHotspotHosts()" id="btn-hotspot-hosts"><i class="fa fa-laptop" ></i> Hosts</span>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-12 hide" id="user-profiles">
                    <div id="menuUserProfile">
                    <div class="btn-group btn-container">
                    <button class="bg-btn-group table-total" id="total-profiles" >&nbsp;</button>
                                            
                        <button class="bg-btn-group" onclick="loadUserProfiles('true')"><i class="fa fa-refresh" title="Force reload" id="fr-profiles"></i></button>
                        <input type="text" autocomplete = "off" id="filter-profiles" onkeyup="filterTable('profiles','searchProfiles',this.value)" placeholder="Filter" />
                        <button class="bg-btn-group" onclick="filterTable('profiles','filter-profiles','')" title="Clear filter"><i class="fa fa-filter" ></i></button>

                    </div>
                    <div class="btn-group btn-container">
                        <button class="bg-btn-group btn-add-user-profiles" ><i class="fa fa-plus" ></i>  Add</button>
                    </div>
                    
                    <div class="btn-group btn-container" >
                        <button class="bg-btn-group btn-add-hotspot-users" id=""><i class="fa fa-user-plus" ></i> Add User</button>
                        <button class="bg-btn-group btn-gen-hotspot-users" id=""><i class="fa fa-ticket" ></i> Generate</button>
                    </div>
                    <div id="btn-exp-mon" class="btn-group btn-container"> </div>
                    </div>
                    <div class="card-fixed mr-t-10">
                    
                    <table class="table table-bordered table-hover user-profiles">
                        <thead>
                            <tr>
                                <th><center><span id="exp_mon"></span></center></th>
                                <th>Name</th>
                                <th>Shared Users</th>
                                <th>Rate Linit</th>
                                <th>Expire Mode</th>
                                <th>Validity</th>
                                <th>Price</th>
                                <th>Selling Price</th>
                                <th>User Lock</th>
                                <th>Server Lock</th>
                            </tr>
                        </thead>
                        <tbody id="profiles">
                            <tr>
                                <td></td>
                                <td></td>
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
                <div class="col-12 hide" id="hotspot-users">
                    <div class=""id="btn-group-users">
                    <div class="btn-group btn-container" >
                        <button class="bg-btn-group table-total" id="total-users" >&nbsp;</button>
                        
                        <button class="bg-btn-group" onclick="loadUsersPPF('true');" title="Force reload"><i class="fa fa-refresh" id="fr-users"></i></button>
                        <input type="text" autocomplete = "off" id="filter-users" onkeyup="filterTable('users','searchUsers',this.value);printVcr('');" placeholder="Filter" />
                        <button class="bg-btn-group" onclick="filterTable('users','filter-users','');selectFirst('select-profile,select-comment');" title="Clear filter"><i class="fa fa-filter" ></i></button>
                        
                        
                       
                    </div>
                    <div class="btn-group btn-container" >
                        <button class="bg-btn-group btn-add-hotspot-users" onclick="" ><i class="fa fa-user-plus" ></i> Add</button>
                        <button class="bg-btn-group btn-gen-hotspot-users" onclick="" ><i class="fa fa-ticket" ></i> Generate</button>
                    </div>

                    <div class="btn-group btn-container" >
                        <select class="bg-btn-group pointer" id="select-profile" value="" onchange="filterTable('users','searchUsers',this.value);this.title=this.value;">
                            <option value="">Profile</option>
                        </select>
                        <select class="bg-btn-group pointer" id="select-comment" value="" onchange="filterTable('users','searchUsers',this.value);printVcr(this.value);this.title=this.value;">
                            
                        </select>
                        <button id='printVcrS' title='Print with small template' class='bg-btn-group pointer hide'><i class="fa fa-print"></i> Small</button>
                        <button id='printVcr' title='Print with default template' class='bg-btn-group pointer hide'><i class="fa fa-print"></i> Default</button>
                        
                    </div>
                    
                    </div>
                    <div class="card-fixed mr-t-10">
                    
                    <table class="table table-bordered table-hover hotspot-users">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Server</th>
                                <th>Name</th>
                                <th>Profile</th>
                                <th>MAC Address</th>
                                <th class="text-right">Uptime</th>
                                <th class="text-right">Bites In</th>
                                <th class="text-right">Bytes Out</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody id="users">
                            <tr>
                                <td></td>
                                <td></td>
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
                    <div>
                        
                    </div>
                </div>
                <div class="col-12 hide" id="hotspot-active">
                    <div class="">
                        <div class="btn-group btn-container">
                            <button class="bg-btn-group table-total" id="total-active" >&nbsp;</button>
                            <button class="bg-btn-group" onclick="loadHotspotActive()" title="Force reload"><i class="fa fa-refresh" id="fr-active"></i></button>
                            <input type="text" autocomplete = "off" id="filter-hotspot-active" onkeyup="filterTable('active','searchActive',this.value)" placeholder="Filter" />
                            <button class="bg-btn-group" onclick="filterTable('active','filter-hotspot-active','');selectFirst('select-server');" title="Clear filter"><i class="fa fa-filter" ></i></button>
                            
                        </div>
                        <div class="btn-group btn-container">
                            <select class="bg-btn-group pointer" id="select-server" value="" onchange="filterTable('active','searchActive',this.value)">
                                <option value="">Server</option>
                            </select>
                        </div>
                    
                    </div>
                    <div class="card-fixed mr-t-10">
                    
                    <table class="table table-bordered table-hover hotspot-active">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Server</th>
                                <th>User</th>
                                <th>Address</th>
                                <th>MAC Address</th>
                                <th class="text-right">Uptime</th>
                                <th class="text-right">Bites In</th>
                                <th class="text-right">Bytes Out</th>
                                <th>Time Left</th>
                                <th>Login By</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody id="active">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
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
                <div class="col-12 hide" id="hotspot-hosts">
                    <div class="">
                        <div class="btn-group btn-container">
                            <button class="bg-btn-group table-total" id="total-hosts" >&nbsp;</button>
                            <button class="bg-btn-group" onclick="loadHotspotHosts()" title="Force reload"><i class="fa fa-refresh" id="fr-hosts"></i></button>
                            <input type="text" autocomplete = "off" id="filter-hosts" onkeyup="filterTable('hosts','searchHosts',this.value)" placeholder="Filter" />
                            <button class="bg-btn-group" onclick="filterTable('hosts','filter-hosts','')" title="Clear filter"><i class="fa fa-filter" ></i></button>
                            
                       
                        </div>
                        <div class="btn-group btn-container">
                            <button class="bg-btn-group" onclick="filterTable('hosts','searchHosts','bypassed')" title="Filter bypassed">P</button>
                            <button class="bg-btn-group" onclick="filterTable('hosts','searchHosts','authorized')" title="Filter authorized">A</button>

                        </div>
                    
                    </div>
                    <div class="card-fixed mr-t-10">
                    
                    <table class="table table-bordered table-hover hotspot-hosts">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Mac Address</th>
                                <th>Address</th>
                                <th>To Address</th>
                                <th>Server</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody id="hosts" class="text-nowrap">
                            <tr>
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
            </div>
            </div>
            <div class="card-footer"><span id="loading"></span> </div>
            </div>
        </div>
    </div>

    
</div>

<script type="text/javascript">


</script>
<?php

}else if(isMobile()){ 
  $hotspot_ma = "nav_active";
  $navicon = '<i class="fa fa-wifi"></i>';
  include_once("view/header_html.php");
  include_once("view/menu.php");

  $modal_mobile = "-mobile";

  ?>

<div class="main-mobile">
    <div class="row">
    <div style="margin-top:50px;margin-bottom:30px;" >

<div class="group-icon-mobile" style="margin: auto; width:100%">
  <i class="fa fa-wifi" style="font-size:60px" ></i>
  <h3>Hotspot</h3>
  </div> 

  
  </div>
        <div class="col-12" style="margin-bottom:100px;">
        <div class="mobile-card ">
            <div class="col-12 mr-b-10">
                <div class="col-10"><h3><span  id="pload"></span></span></h3></div>
                <div class="col-2">
                <div class="dropdown">
                      <button class="dropbtn"><i class="fa fa-caret-down"></i></button>
                      <div id="mDropdown" class="dropdown-content">
                        <a id="btn-hotspot-users"><i class="fa fa-users" ></i> Users</a>
                        <a id="btn-user-profiles"><i class="fa fa-pie-chart" ></i> User Profile</a>
                        <a id="btn-hotspot-active"><i class="fa fa-wifi" ></i> Active</a>
                        <a id="btn-hotspot-hosts"><i class="fa fa-laptop" ></i> Hosts</a>
                      </div>
                    </div>
                </div>
             </div>
            <div class="mr-t-10" >
            <div class="row">
                <div class="col-12 hide" id="user-profiles">
                    <div id="menuUserProfile">
                    <div class="btn-group btn-container">
                    <button class="btn-mobile bg-btn-group table-total" id="total-profiles" >&nbsp;</button>
                        <button class="btn-mobile bg-btn-group" onclick="loadUserProfiles('true')"><i class="fa fa-refresh" title="Force reload" id="fr-profiles"></i></button>
                        <input type="text" autocomplete = "off" id="filter-profiles" onkeyup="filterTable('profiles','searchProfiles',this.value)" placeholder="Filter" />
                        <button class="btn-mobile bg-btn-group" onclick="filterTable('profiles','filter-profiles','')" title="Clear filter"><i class="fa fa-filter" ></i></button>
                    </div>

                    <div class="btn-group btn-container">
                    <button class="btn-mobile bg-btn-group btn-add-user-profiles" ><i class="fa fa-plus" ></i>  Add</button>
                    </div>
                    
                    <div class="btn-group btn-container" >
                        <button class="btn-mobile bg-btn-group btn-add-hotspot-users" id=""><i class="fa fa-user-plus" ></i> Add User</button>
                        <button class="btn-mobile bg-btn-group btn-gen-hotspot-users" id=""><i class="fa fa-ticket" ></i> Generate</button>
                    </div>
                    <div id="btn-exp-mon" class="btn-group btn-container"> </div>
                    </div>
                    <div class="card-fixed mr-t-10">
                    <hr>
                    <table class="table-p0 user-profiles">
                        <!-- <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead> -->
                        <tbody id="profiles">
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="col-12 hide " id="hotspot-users">
                    <div class="">
                    <div class="btn-group" id="btn-group-users">
                        <button class="btn-mobile bg-btn-group table-total" id="total-users" >&nbsp;</button>
                        <button class="btn-mobile bg-btn-group" onclick="loadUsersPPF('true');" title="Force reload"><i class="fa fa-refresh" id="fr-users"></i></button>
                        <input type="text" autocomplete="off" id="filter-users" onkeyup="filterTable('users','searchUsers',this.value);printVcr('');" placeholder="Filter" />
                        <button class="btn-mobile bg-btn-group" onclick="filterTable('users','filter-users','');selectFirst('select-profile,select-comment');" title="Clear filter"><i class="fa fa-filter" ></i></button>
                        
                        <select class="btn-mobile bg-btn-group pointer" id="select-profile" value="" onchange="filterTable('users','searchUsers',this.value);this.title=this.value;">
                            <option value="">Profile</option>
                        </select>
                        <select class="btn-mobile bg-btn-group pointer" id="select-comment" value="" onchange="filterTable('users','searchUsers',this.value);printVcr(this.value);this.title=this.value;">
                            
                        </select>
                        <button id='printVcrS' title='Print with small template' class='btn-mobile bg-btn-group pointer '><i class="fa fa-print"></i> Small</button>
                        <button id='printVcr' title='Print with default template' class='btn-mobile bg-btn-group pointer hide'><i class="fa fa-print"></i> Default</button>
                        
                       
                    </div>
                    <div class="btn-group btn-container" >
                        <button class="btn-mobile bg-btn-group btn-add-hotspot-users" onclick="" ><i class="fa fa-user-plus" ></i> Add</button>
                        <button class="btn-mobile bg-btn-group btn-gen-hotspot-users" onclick="" ><i class="fa fa-ticket" ></i> Generate</button>
                    </div>
                    
                    </div>
                    <div class="card-fixed mr-t-10">
                    
                    <table class="table-p0  hotspot-users">
                        <!-- <thead>
                            <tr>
                                <th></th>

                            </tr>
                        </thead> -->
                        <tbody id="users">
                            <tr>
                                <td></td>

                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="col-12 hide" id="hotspot-active">
                    <div class="">
                        <div class="btn-group">
                            <button class="btn-mobile bg-btn-group table-total" id="total-active" >&nbsp;</button>
                            <button class="btn-mobile bg-btn-group" onclick="loadHotspotActive()" title="Force reload"><i class="fa fa-refresh" id="fr-active"></i></button>
                            <input type="text" autocomplete = "off" id="filter-hotspot-active" onkeyup="filterTable('active','searchActive',this.value)" placeholder="Filter" />
                            <button class="btn-mobile bg-btn-group" onclick="filterTable('active','filter-hotspot-active','');selectFirst('select-server');" title="Clear filter"><i class="fa fa-filter" ></i></button>
                            <select class="btn-mobile bg-btn-group pointer" id="select-server" value="" onchange="filterTable('active','searchActive',this.value)">
                            <option value="">Server</option>
                        </select>
                        </div>
                    
                    </div>
                    <div class="card-fixed mr-t-10">
                    <hr>
                    <table class="table-p0  hotspot-active">
                        <!-- <thead>
                            <tr>
                                <th></th>
                            </tr>
                        </thead> -->
                        <tbody id="active">
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="col-12 hide" id="hotspot-hosts">
                    <div class="">
                        <div class="btn-group">
                            <button class="btn-mobile bg-btn-group table-total" id="total-hosts" >&nbsp;</button>
                            <button class="btn-mobile bg-btn-group" onclick="loadHotspotHosts()" title="Force reload"><i class="fa fa-refresh" id="fr-hosts"></i></button>
                            <input type="text" autocomplete = "off" id="filter-hosts" onkeyup="filterTable('hosts','searchHosts',this.value)" placeholder="Filter" />
                            <button class="btn-mobile bg-btn-group" onclick="filterTable('hosts','filter-hosts','')" title="Clear filter"><i class="fa fa-filter" ></i></button>
                            <button class="btn-mobile bg-btn-group" onclick="filterTable('hosts','searchHosts','bypassed')" title="Filter bypassed">P</button>
                            <button class="btn-mobile bg-btn-group" onclick="filterTable('hosts','searchHosts','authorized')" title="Filter authorized">A</button>
                        </div>
                    
                    </div>
                    <div class="card-fixed mr-t-10">
                    <hr>
                    <table class="table-p0  hotspot-hosts">
                        <tbody id="hosts" class="text-nowrap">
                            <tr>
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


<?php }?>
<div id="addh_userprofile" class="modal unselect">
  <div class="modal-content<?=$modal_mobile;?>">
    <span id="hupClose" class="close"><i class="fa fa-times"></i></span>
    <div class="modal-header<?=$modal_mobile;?>">

        <span id="usrproftt"><i class="fa fa-pie-chart"></i>&nbsp; <b>Add Profile</b> &nbsp; </span>
        <span class="card-tab card-tab-active" id="btn-upgeneral">General</span>
        <span class="card-tab" onclick="" id="btn-updetails">Details</span>

    </div>
    <div class="modal-body<?=$modal_mobile;?>">
        <div id="upgeneral">
            <table class="table">
              <tr><td>Name</td><td><input id="add_usrprofid" autocomplete="off" class="form-control" type="hidden" value="0" /><input id="add_usrprofname" autocomplete="new-password" class="form-control" type="text" /></td></tr>
              <tr><td>Address Pool</td><td>
                  <select class="form-control" id="add_addrpool">
                  <option value="none">none</option>
                  </select>
              </td></tr>
              <tr><td>Shared users</td><td><input id="add_sharedusr"  autocomplete="new-password" class="form-control" type="number" value="1"  min="0" max="999"/></td></tr>
              <tr id="trratelimit"><td>Rate Limit <span id="hRateLimit" title="help" class="mr-t-5 text-center pointer"><i class="fa fa-question-circle"></i></span</td><td><input id="add_ratelimit" autocomplete="off" class="form-control" type="text" /></td></tr>
              <tr><td>Parent Queue</td><td>
                  <select class="form-control" id="add_parentq">
                  <option value="none">none</option>
                  </select>
              </td></tr>
            
          </table>
        </div>
     
        <div id='updetails' class="hide">
            <table class="table">
        <tr id="trexpmode"><td >Expired Mode <span id="hExpMode" title="help" class="mr-t-5 text-center pointer"><i class="fa fa-question-circle"></i></span</td><td>
                  <select class="form-control" id="add_expmode">
                    <option value="0">None</option>
                    <option value="rem">Remove</option>
                    <option value="ntf">Notice</option>
                    <option value="remc">Remove & Record</option>
                    <option value="ntfc">Notice & Record</option>
                  </select>
              </td></tr>
              <tr id="trvalidity" class="hide"><td>Validity <span id="hValidity" title="help" class="mr-t-5 text-center pointer"><i class="fa fa-question-circle"></i></span</td><td><input id="add_validity" autocomplete="off" class="form-control" type="text" onkeyup="this.value = this.value.toLowerCase();" /></td></tr>
              <tr><td>Price</td><td><input id="add_price" autocomplete="off" class="form-control" type="number" /></td></tr>
              <tr><td>Selling Price</td><td><input id="add_sellingprice" autocomplete="off" class="form-control" type="number" /></td></tr>
              <tr id="trlockuser"><td >Lock User <span id="hLockUser" title="help" class="mr-t-5 text-center pointer"><i class="fa fa-question-circle"></i></span</td><td>
                  <select class="form-control" id="add_lockuser">
                    <option value="Disable">Disable</option>
                    <option value="Enable">Enable</option>
                  </select>
              </td></tr>
              <tr id="trlockserver"><td >Lock Sever <span id="hLockServer" title="help" class="mr-t-5 text-center pointer"><i class="fa fa-question-circle"></i></span</td><td>
                  <select class="form-control" id="add_lockserver">
                    <option value="Disable">Disable</option>
                    <option value="Enable">Enable</option>
                  </select>
              </td></tr>
            </table>

        </div>

        <div>
            <table class="table">
                <tr>
                    <td>
                        <button class="btn bg-primary" style="float: right;" onclick="addUserProfile()"><i class="fa fa-save"></i> Save</button>
                        <span id="usrprofact-btn" style="display: none">
                            
                            <button class="btn bg-danger" style="float: right;" onclick=" remProf()"><i class="fa fa-minus-square"></i> Remove</button>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="modal-footer<?=$modal_mobile;?>">
        <span id="add_usrprofilemsg">&nbsp;</span>
    </div>
  </div>

</div>

<div id="addh_user" class="modal unselect">
  <div class="modal-content<?=$modal_mobile;?>">
    <span id="huClose" class="close"><i class="fa fa-times"></i></span>
    <div class="modal-header<?=$modal_mobile;?>">
      
      <!-- <h3 ><i class="fa fa-user-plus"></i> Add User</h3> -->

        <span id="usrtt"><i class="fa fa-user-plus"></i>&nbsp; <b>Add User</b> &nbsp; </span>
        <span class="card-tab card-tab-active" id="btn-general">General</span>
        <span class="card-tab" onclick="" id="btn-details">Details</span>
    </div>
    <div class="modal-body<?=$modal_mobile;?>">
        <div id="ugeneral">
            <table class="table">
              <tr><td>Server</td><td>
                  <select class="form-control" id="add_hserver">
                    <option value="all">all</option>
                  </select>
              </td></tr>
              <tr><td>Name</td><td><input id="add_usrid" autocomplete="off" class="form-control" type="hidden" value="0" /><input id="add_usrname" autocomplete="new-password" class="form-control" type="text" /></td></tr>
              <tr><td>Password <span title="Show / hide password" class="mr-t-5 text-center"><input class="chkbox" onclick="shPass('add_usrpass')" type="checkbox"></span></td><td><input id="add_usrpass" autocomplete="off" style="position: relative;" class="form-control key" type="text"/></td></tr>
              <tr><td>MAC Address</td><td><input id="add_usrmac"  autocomplete="new-password" class="form-control" type="text" /></td></tr>
              <tr><td>Profile</td><td>
                  <select class="form-control" id="add_usrprofile">
                  </select>
              </td></tr>
              <tr><td>Time Limit <span id="hTimeLimit" title="help" class="mr-t-5 text-center pointer"><i class="fa fa-question-circle"></i></span></td><td><input id="add_tlimit" autocomplete="off" class="form-control" type="text" onkeyup="this.value = this.value.toLowerCase();" /></td></tr>
              <tr><td>Data Limit <span id="hDataLimit" title="help" class="mr-t-5 text-center pointer"><i class="fa fa-question-circle"></td><td><input id="add_dlimit" autocomplete="off" class="form-control" type="text"  onkeyup="this.value = this.value.toUpperCase();" /></td></tr>
              <tr><td>Comment</td><td><input id="add_usrcomm" autocomplete="off" class="form-control" type="text" /></td></tr>
              
          </table>
        </div>
        <div id='udetails' class="hide">
            <table class="table">
              <tr><td>Uptime</td><td><input class="form-control" readonly type="text" id="uuptime" /></td></tr>
              <tr><td>Bytes In</td><td><input class="form-control" readonly type="text" id="ubytesin" /></td></tr>
              <tr><td>Bytes Out</td><td><input class="form-control" readonly type="text" id="ubytesout" /></td></tr>
              <tr><td>Limit Uptime</td><td><input class="form-control" readonly type="text" id="ulimituptime" /></td></tr>
              <tr><td>Limit Bytes Total</td><td><input class="form-control" readonly type="text" id="ulimitbytestotal" /></td></tr>
              <tr><td>User Code</td><td><input class="form-control" readonly type="text" id="ucode" /></td></tr>
              <tr><td>Expire Date</td><td><input id="usrexp" autocomplete="off" class="form-control" type="text" readonly /></td></tr>
          </table>
        </div>
        <div>
            <table class="table">
                <tr>
                    <td>
                        <button class="btn bg-primary" style="float: right;" onclick="addUser()"><i class="fa fa-save"></i> Save</button>
                        <span id="usract-btn" style="display: none">
                            <button class="btn bg-warning" style="float: right;" onclick="resetUser()"><i class="fa fa-history"></i> Reset</button>
                            <button class="btn bg-danger" style="float: right;" onclick="remUser()"><i class="fa fa-minus-square"></i> Remove</button>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="modal-footer<?=$modal_mobile;?>">
        <span id="add_usrmsg">&nbsp;</span>
    </div>
  </div>

</div>

<div id="gen_user" class="modal unselect">
  <div class="modal-content<?=$modal_mobile;?>">
    <span id="genClose" class="close"><i class="fa fa-times"></i></span>
    <div class="modal-header<?=$modal_mobile;?>">
      
      <!-- <h3 ><i class="fa fa-user-plus"></i> Add User</h3> -->

        <span id="gentt"><i class="fa fa-ticket"></i>&nbsp; <b>Generate</b> &nbsp; </span>
        <span class="card-tab card-tab-active" id="btn-gengeneral">General</span>
        <span class="card-tab" onclick="" id="btn-gendetails">Limit</span>

    </div>
    <div class="modal-body<?=$modal_mobile;?>">
        <div id="gengeneral">
            <table class="table">
            <tr><td>Qty</td><td><input id="gen_usrqty" autocomplete="off" class="form-control" type="number" value="1" min="1" max="500" /></td></tr>
              <tr><td>Server</td><td>
                  <select class="form-control" id="gen_hserver">
                    <option value="all">all</option>
                  </select>
              </td></tr>
              <tr><td>User Mode</td><td>
                  <select class="form-control" id="gen_usrmode">
                    <option value="up">Username & Password</option>
				    <option value="vc">Username = Password</option>
                  </select>
              </td></tr>
              <tr><td>Name Length</td><td>
                  <select class="form-control" id="gen_namelength">
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                  </select>
              </td></tr>
              <tr><td>Prefix</td><td><input id="gen_usrprefix" autocomplete="off" class="form-control" type="text" /></td></tr>
              <tr><td>Characters</td><td>
                  <select class="form-control" id="gen_char">
                    <option id="lower"  value="lower">abcd</option>
                    <option id="upper"  value="upper">ABCD</option>
                    <option id="upplow"  value="upplow">aBcD</option>
                    <option id="lower1" class="hide" value="lower1">abcd2345</option>
                    <option id="upper1" class="hide"  value="upper1">ABCD2345</option>
                    <option id="upplow1" class="hide"  value="upplow1">aBcD2345</option>
                    <option id="mix"  value="mix">5ab2c34d</option>
                    <option id="mix1"  value="mix1">5AB2C34D</option>
                    <option id="mix2"  value="mix2">5aB2c34D</option>
                    <option id="num" class="hide" value="num">1234</option>
                </select>
                  </select>
              </td></tr>
              <tr><td>Profile</td><td>
                  <select class="form-control" id="gen_usrprofile">
                  </select>
              </td></tr> 
              <tr><td>Comment</td><td><input id="gen_usrcomm" autocomplete="off" class="form-control" type="text" /></td></tr>
                </table>
        </div>
            <div id='gendetails' class="hide">
            <table class="table">            
              <tr><td>Time Limit <span id="ghTimeLimit" title="help" class="mr-t-5 text-center pointer"><i class="fa fa-question-circle"></i></span></td><td><input id="gen_tlimit" autocomplete="off" class="form-control" type="text" onkeyup="this.value = this.value.toLowerCase();" /></td></tr>
              <tr><td>Data Limit <span id="ghDataLimit" title="help" class="mr-t-5 text-center pointer"><i class="fa fa-question-circle"></td><td><input id="gen_dlimit" autocomplete="off" class="form-control" type="text"  onkeyup="this.value = this.value.toUpperCase();" /></td></tr>
            </table>
            </div>
            <div>
            <table class="table">
                <tr>
                    <td>
                    <span id="genact-btn" class="hide">
                    <button class="btn bg-primary print_v" style="float: right;"><i class="fa fa-print"></i> Default</button>
                    <button class="btn bg-primary print_vs" style="float: right;"><i class="fa fa-print"></i> Small</button>
                    <button class="btn bg-primary gen_clear" style="float: right;"><i class="fa fa-trash"></i> Clear</button>
                    </span>
                    <button id="btn-genV" class="btn bg-primary gen_v" onclick="generateV()" style="float: right;" ><i class="fa fa-ticket"></i> Generate</button>
                    
                    </td>
                </tr>
            </table>
        </div>
        </div>
        
    <div class="modal-footer<?=$modal_mobile;?>">
        <span id="gen_usrmsg"><span class="picon"></span> <span class="pgen"></span> <span class="pprocess"></span>&nbsp;</span>
    </div>
  </div>
  </div>

<script>
    
$(document).ready(function() {
// $("#user-profiles").removeClass('hide').addClass('block');
setTimeout(function(){
        setTimeout(function(){
            loadUserProfiles()
            // loadUsersPPF()
            // loadHotspotActive()
        },100)
    // $("#profiles").html("")
},1)



    $(".user-profiles").fancyTable({
    inputId: "searchProfiles",
    sortColumn:1,
    pagination: true,
    perPage:15,
    globalSearch:true,
    });

    $(".hotspot-users").fancyTable({
    inputId: "searchUsers",
    sortColumn:2,
    pagination: true,
    perPage:15,
    globalSearch:true,
    });

    $(".hotspot-active").fancyTable({
    inputId: "searchActive",
    sortColumn:1,
    pagination: true,
    perPage:15,
    globalSearch:true,
    });
    
    $(".hotspot-hosts").fancyTable({
    inputId: "searchHosts",
    sortColumn:2,
    pagination: true,
    perPage:15,
    globalSearch:true,
    });


})


</script>

<?php
include_once("view/footer_html.php");
}
?>
