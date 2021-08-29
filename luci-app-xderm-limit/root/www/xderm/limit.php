<?php
 exec("ls login.php|awk 'NR==1'|awk -F '.' '{print $1}'",$clo);
  if ($clo[0]) {
include 'header.php';
ceklogin();
  };
 exec("cat limitdir/st",$sst);
  if (!$sst[0]) {
   exec('echo Start > limitdir/st');
  };
 exec("cat limitdir/sz",$ssz);
  if (!$ssz[0]) {
   exec('echo 3 > limitdir/sz');
  };
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width">
<link rel="shortcut icon" href="img/fav.ico">
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<meta charset="UTF-8"><title>Xderm Limitation</title>
<style>
body {
  display:flex; 
  flex-direction:column; 
  justify-content:center;
  min-height:0vh; 
  /*! color:black; */ 
  /*! background-color:#696969; */
  text-align:center;
  color: #507693;
}
		.btn {
			-moz-appearance: none;
			cursor: pointer;
			margin: 5px;
			align-items: center;
			/*! border: 2px solid #457aa4 ; */
			/*! border-radius: 3px; */
			font-weight : bold;
			background: #5fa3d7;
		}

		.btn:hover, .btn:focus {
			color: #ffffff;
			outline: 0;
		}
		
		.geser {
			border-color: #6facda;
			color: #ffffff;
			padding: 5px 20px;
			background-image: linear-gradient(45deg, #F89D5A 50%, transparent 50%);
			background-position: 100%;
			background-size: 400%;
			transition: background 300ms ease-in-out;
		}
		
		.geser:hover {
			 background-position: 0;
		}
		
.col-md-4 {
  text-align: left;
  font-family: cursive; /*! color: black; */
  font-weight: bold;
  /*! border: 8px ridge green; */
  /*! background-color: grey; */
  align-items: center;
  width: 395px;
  height: 50px;
}
		.col-butt {
			text-align: center;
			border: 5px;
			align-items: center;
		}

.inline-block {
  display: inline-block;
  text-align: left;
  margin: 5px;
  top: 0px;
}
.box_script {
	width: 450px;
	border: none;
	border-radius: 10px;
	margin: 3% auto;
	padding: 10px 10px;
	/*! background-color: black; */
	box-shadow: 0px 0px 5px 2px #519bd4;
}
		
</style>
<script type="text/javascript">
    $(document).ready(function() {
        setInterval(function() {
            $.ajax({
                url: "limitdir/log.txt",
		cache: false,
                success: function(result) {
		    $("#log").html(result);
                }
            });
        $(document).ready(function() {
                $.ajaxSetup({ cache: false });
                        });
                var textarea = document.getElementById("log");
                textarea.scrollTop = textarea.scrollHeight;
        }, 1000);
    });
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
<body class="box_script" style="text-align:center">
<center>
<?php
$filename = 'login.php';
if (file_exists($filename)) {
    echo '<a href="login.php" onClick="logout()">';
} else {
    echo '<a href="limit.php" onClick="logout()">';
}
?>
<img src="img/image.png" width: 80%></a>
</center>
       <form method="post">
<center><table align="center"><tr><td class="col-butt">
<input type="submit" name="button1" class="btn geser"  id="strp"
        value="<?php echo exec('cat limitdir/st') ?>"/>
<input type="submit" name="button2" class="btn geser" id="config"
        value="Config"/>
</td></tr></center>
</table>
</form>
<?php
  if (isset($_POST['button1'])) {
  exec('cat limitdir/st',$o);
if ( $o[0] == 'Start' ) {
 exec('killall -q limit');
 exec('chmod +x limit');
 exec('screen -d -m ./limit');
 exec('echo Stop > limitdir/st');
echo '<script>
  document.getElementById("strp").value="Stop";
</script>';
 } else {
 exec('killall -q limit');
 exec('echo "Auto Limit Client Stopped." > limitdir/log.txt');
 exec('tc qdisc del dev eth0 root handle 1: > /dev/null 2>&1');
 exec('echo Start > limitdir/st');
echo '<script>
  document.getElementById("strp").value="Start";
</script>';
}
  }
?>
<table align="center"><tr><td class="col-md-4"><div class="inline-block"><pre>
<?php
 if (isset($_POST['simpan'])) {
 $ipl=$_POST['iplist'];
 $sz=$_POST['size'];
 $use_ip=$_POST['use_ip'];
 if ($use_ip <> 'yes' ){$use_ip='no';}
 exec("echo \"$sz\" > limitdir/sz");
 exec("echo \"$ipl\" > limitdir/ip.list");
 exec('echo -e "use_ip='.$use_ip.'" > limitdir/useip');
 exec("echo 'Berhasil Setup, Silahkan Start!' > limitdir/log.txt");
 exec('sed -i \'s/\r$//g\' limitdir/ip.list');
 exec('sed -i \':a;N;$!ba;s/\n\r//g\' limitdir/ip.list');
 exec('sed -i \':a;N;$!ba;s/\n\n//g\' limitdir/ip.list');
};
if($_POST['button2']){
exec("cat limitdir/sz|sed 's/ //g'",$ada);
$ada=$ada[0];
if ($ada) {
$sz = file_get_contents("limitdir/sz");
};
exec('mkdir -p limitdir');
exec('touch limitdir/ip.list');
$data = file_get_contents("limitdir/ip.list");
echo "<h4><b>IP Pengecualian: </b></h4>";
echo "<textarea name='iplist' id='isi' placeholder='Masukkan IP Pengecualian, Contoh:\n192.168.1.1\n192.168.1.99\n192.168.1.21' rows='6' cols='50'>$data</textarea>";
echo '<div class="form-box">';
echo "<b>Max Speed per IP: <input type='text' name='size' size='1' value=\"$sz\"/> mbps</b> ";
exec("cat limitdir/useip|awk -F '=' '{print $2}'",$useip);
if ( $useip[0] == "yes"){
echo "<input type='checkbox' name='use_ip' value='yes' Checked>IP Pengecualian ";
} else {
echo "<input type='checkbox' name='use_ip' value='yes' >IP Pengecualian ";
};
echo "<div>";
echo "<center>";
echo '<input type="submit" name="batal" class="btn geser" value="Batal"/>';
echo '<input type="submit" name="simpan" class="btn geser" value="Simpan"/></form></div>';
echo "</center>";
} else {
echo '<div id="log" class="scroll"></div></pre></div>';
};
?>
</td></tr>
</table></head><center><h7><b>Auto Limit Bandwidth xderm</b></h7></center>
</html>