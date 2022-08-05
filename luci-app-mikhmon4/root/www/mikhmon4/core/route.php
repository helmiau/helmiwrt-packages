<?php 
error_reporting(0);
forbPHP();

// Route
function route($m_user,$page,$s_page){

    if (!array_key_exists($page,$s_page)){
        e404();

    }else if ($GLOBALS['n_uri_path'] > $GLOBALS['max_path']){
        e404();

    }else if ($GLOBALS['n_uri_path'] == $GLOBALS['max_path'] &&  $GLOBALS['act'] !== ""){
        e404();

    }else if (array_key_exists($page,$s_page)){
    
        include_once($s_page[$page]);

    }else{
        e404();
    }

}


function isMobile() {
    return preg_match("/(android|webos|avantgo|iphone|ipad|ipod|blackberry|iemobile|bolt|boost|cricket|docomo|fone|hiptop|mini|opera mini|kitkat|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}