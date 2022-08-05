<?php 
include_once("../core/route.php");
$thisD = date("d");
$thisM = strtolower(date("M"));
$thisY = date("Y");

if (strlen($thisD) == 1) {
  $thisD = "0" . $thisD;
} else {
  $thisD = $thisD;
}

$idhr = $thisM . "/" . $thisD . "/" . $thisY;
$idbl = $thisM . $thisY;
?>

<script src="js/jquery.min.js"></script>
<script>
loadLiveReport("?<?= $_SESSION['m_user'] ?>/report")
// setInterval(function(){
// 	loadLiveReport("?<?= $_SESSION['m_user'] ?>/report")
// },90000)
	function loadLiveReport(url){
		
		$.getJSON(url, function(result) {
		   // console.log(result); // this will show the info it in firebug console
		   	var totalBl = 0;
		   	var totalHr = 0;
		   	var vcBl = result;
		   	var vcHr = "";
		   
		    $.each(result, function(i, field){
		       totalBl += parseInt(field['name'].split("-|-")[3]);
				if(field['source'] == "<?= $idhr ?>"){
					vcHr += field['source'][0]
					totalHr += parseInt(field['name'].split("-|-")[3]);
				}       
		      });


		    $("#vcTd").html(vcHr.length)
		    $("#vcTm").html(vcBl.length)
		    $("#totTd").html(totalHr)
		    $("#totTm").html(totalBl)
			}

);}

</script>

<div>Income</div>
<div>Today <span id="vcTd">-</span>vcr : Rp <span id="totTd">-</span></div>
<div>This Month <span id="vcTm">-</span>vcr : Rp <span id="totTm">-</span></div>