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
    include_once("config/readcfg.php");
   
    $randTime = str_replace(" ","_",date("Y-m-d H:i:s"));
    
    // check session is exist
    if(!isset($_SESSION["$m_user"])){
        echo "<script>alert('Session Name [".$m_user."] not found.');window.location.href = './?admin/settings';</script>";
    }
?>

<script>
    localStorage.setItem("?<?= $_SESSION['m_user'] ?>_curr","<?= $currency ?>");
    localStorage.setItem("?<?= $_SESSION['m_user'] ?>_theme","<?= $theme ?>");
</script>

<script src="assets/js/mikhmon.js?t=<?= $randTime ?>"></script>
<script src="assets/js/format.js?t=<?= $randTime ?>"></script>
<script src="assets/js/func.js?t=<?= $randTime ?>"></script>
<script src="assets/js/fancyTable.js"></script>


</body>
</html>

<?php } ?>