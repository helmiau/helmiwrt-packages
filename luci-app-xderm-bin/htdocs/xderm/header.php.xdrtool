<?php
function ceklogin(){
    session_start();
    if (($_SESSION['loggedin'] != 1) || isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 9500)) {
    session_unset();
    session_destroy();
    header("Location: login.php");
}
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
}
