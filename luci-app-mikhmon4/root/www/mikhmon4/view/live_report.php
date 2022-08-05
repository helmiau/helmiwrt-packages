<?php
include_once("../core/route.php");
include_once("view/header_html.php");
include_once("view/menu.php");
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

$day = $_GET['day'];
?>
<!-- <script src="assets/js/jquery.min.js"></script> -->

<div class="main">
  <div>Income</div>
  <div>Today <span id="vcTd">-</span> vcr : Rp <span id="totTd">-</span></div>
  <div>This Month <span id="vcTm">-</span> vcr : Rp <span id="totTm">-</span></div>
</div>


<script>
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = Number(today.getMonth());
  var yyyy = today.getFullYear();
  var mmm = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"]

  localStorage.setItem('session', "?<?= $_SESSION['m_user'] ?>");
  var session = localStorage.getItem('session')

  $(document).ready(function(){ getReport()})

  if (!localStorage.getItem(session + '_day_live_report')) {
    localStorage.setItem(session + '_day_live_report', 0);
    localStorage.setItem(session + '_totalRDay', 0)
    localStorage.setItem(session + '_totalRMonth', 0)
    localStorage.setItem(session + '_vcrRDay', 0)
    localStorage.setItem(session + '_vcrRMonth', 0)
  }

  function getReport() {


    var d = localStorage.getItem(session + '_day_live_report');

    if (Number(d) != Number(dd)) {



      if (d.length == 1 && d < 9) {
        dn = "0" + (Number(d) + 1)


        localStorage.setItem(session + '_day_live_report', (Number(d) + 1));


      } else {
        dn = (Number(d) + 1)


        localStorage.setItem(session + '_day_live_report', dn);

      }
      today = mmm[mm] + '/' + dn + '/' + yyyy;


      if (Number(d) < Number(dd)) {
        loadReport(session+"/report/&day=" + today)

      }

      $("#vcTd").html("...")
      $("#totTd").html("...")
      $("#vcTm").html(Number(localStorage.getItem(session + '_vcrRMonth')) + Number(localStorage.getItem(session + '_vcrRDay')))
      $("#totTm").html(Number(localStorage.getItem(session + '_totalRMonth')) + Number(localStorage.getItem(session + '_totalRDay')))

    } else {

      localStorage.setItem(session + '_day_live_report', Number(localStorage.getItem(session + '_day_live_report')) - 1)


      $("#vcTd").html(localStorage.getItem(session + '_vcrRDay'))
      $("#totTd").html(localStorage.getItem(session + '_totalRDay'))
      $("#vcTm").html(Number(localStorage.getItem(session + '_vcrRMonth')) + Number(localStorage.getItem(session + '_vcrRDay')))
      $("#totTm").html(Number(localStorage.getItem(session + '_totalRMonth')) + Number(localStorage.getItem(session + '_totalRDay')))

    }


  }

  


  function loadReport(url) {

    var d = localStorage.getItem(session + '_day_live_report');


    totalRMonth = localStorage.getItem(session + '_totalRMonth')
    vcrRMonth = localStorage.getItem(session + '_vcrRMonth')
    vcrRDay = localStorage.getItem(session + '_vcrRDay')


    $.getJSON(url, function(result) {
        var totalDay = 0;
        var vcrMonth = 0;
        var vcrDay = "";
        var d = localStorage.getItem(session + '_day_live_report');
        $.each(result, function(i, field) {

          totalDay += parseInt(field['name'].split("-|-")[3]);

        });

        var total = Number(totalRMonth) + totalDay
        var vcr = Number(vcrRMonth) + Number(result.length)


        localStorage.setItem(session + '_totalRDay', totalDay)
        localStorage.setItem(session + '_vcrRDay', result.length)

        if (Number(d) != Number(dd)) {
          localStorage.setItem(session + '_totalRMonth', total)
          localStorage.setItem(session + '_vcrRMonth', vcr)
        }


      })


      .done(function() {


        getReport()


      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("success");
      });




  }
</script>

<?php
include_once("view/footer_html.php");
?>
