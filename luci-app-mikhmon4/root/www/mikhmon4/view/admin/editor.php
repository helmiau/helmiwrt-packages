<?php 
session_start();
// hide all error
error_reporting(0);
// protect .php
$get_self = explode("/",$_SERVER['PHP_SELF']);
$self[] = $get_self[count($get_self)-1];

if($self[0] !== "index.php"  && $self[0] !==""){
    include_once("./../../core/route.php");
}else{ 
    
    // include_once("config/readcfg.php");
    include_once('core/routeros_api.class.php');
    include_once("core/no_cache.php");
    

?>
<link rel="stylesheet" href="./assets/css/editor.min.css">
<script src="./assets/js/codemirror/codemirror.js"></script>
<script src="./assets/js/codemirror/closetag.js"></script>
<script src="./assets/js/codemirror/xml-fold.js"></script>
<script src="./assets/js/codemirror/xml.js"></script>
<script src="./assets/js/codemirror/javascript.js"></script>
<script src="./assets/js/codemirror/css.js"></script>
<script src="./assets/js/codemirror/htmlmixed.js"></script>
<script src="./assets/js/codemirror/closebrackets.js"></script>
<script src="./assets/js/codemirror/matchbrackets.js"></script>
<script src="./assets/js/codemirror/matchtags.js"></script>
<script src="./assets/js/codemirror/sublime.js"></script>
<script src="./assets/js/codemirror/comment.js"></script>
<script src="./assets/js/codemirror/clike.js"></script>
<script src="./assets/js/codemirror/php.js"></script>
<script src="./assets/js/codemirror/searchcursor.js"></script>
<script src="./assets/js/codemirror/search.js"></script>
<script src="./assets/js/codemirror/dialog.js"></script>
<script src="./assets/js/codemirror/annotatescrollbar.js"></script>
<script src="./assets/js/codemirror/matchesonscrollbar.js"></script>
<script src="./assets/js/codemirror/jump-to-line.js"></script>
<?php 
if(!isMobile()){ 
   $editor_ma = "sidenav_active";
    include_once("view/header_html.php");
    include_once("view/menu.php");

?>


<style>
.CodeMirror {
  border: 1px solid #2f353a;
  height: 78vh;
}
textarea{
  font-size:12px;
  border: 1px solid #2f353a;
}
</style>
<div class="main">
<div class="row">
  <div class="col-12">
            <div class="card card-shadow">
            <div class="card-header unselect" id="t_err">
              <span><i class="fa fa-edit"></i> <b>Template Editor</b></span>&nbsp;&nbsp;|&nbsp;&nbsp;
              	<span class="pointer" id="btn-tsave" title="Ctrl + s" ><i class="fa fa-save" ></i> Save</span>&nbsp;&nbsp;&nbsp;&nbsp;
              	<span class="pointer editor_help"><i class="fa fa-question "></i> Help</span>&nbsp;&nbsp;&nbsp;&nbsp;
              	<span class="card-tab card-tab-active" id="active-edit"></span>&nbsp;&nbsp;&nbsp;&nbsp;
              	<span id="loading"></span> 
            </div>
            <div class="card-body">
            <div class="row">
              <div class="col-12">
              	<div class="btn-group btn-container" >
					<button class="bg-btn-group" style="border-right: 1px solid transparent;"><i class="fa fa-ticket" ></i> Template</button>
					<select class="bg-btn-group pointer" style="border-left: 1px solid transparent;"id="select-template" value="">
						<option value="default">Default</option>
						<option value="small">Small</option>
						<option value="thermal">Thermal</option>      
					</select>
				</div>
				<div class="btn-group btn-container" >
					<button class="bg-btn-group" id="btn-header" onclick="loadTemplate('header')"><i class="fa fa-file-text" ></i> Header</button>
					<button class="bg-btn-group" id="btn-row" onclick="loadTemplate('row')"><i class="fa fa-file-text" ></i> Row</button>
					<button class="bg-btn-group" id="btn-footer" onclick="loadTemplate('footer')"><i class="fa fa-file-text" ></i> Footer</button>
                </div>
                <div class="btn-group btn-container" >
                	<button class="bg-btn-group" id="vpreview" ><i class="fa fa-eye" ></i> Preview</button>
                </div>
                <div class="card-fixed mr-t-5">
                	<textarea class="bg-dark" id="editorMikhmon" name="editor" style="width:100%"></textarea>
                </div>
              </div>


            </div>
            </div>
            <div class="card-footer"> </div>
            </div>
        </div>
      </div>
    </div>
<script>



$(document).ready(function() {	
	localStorage.setItem("?admin_curr","$");
	if(!localStorage.getItem("typeTemplate") || localStorage.getItem("typeTemplate") == ""){
        localStorage.setItem("typeTemplate","row");
        localStorage.setItem("nameTemplate","default");
   		loadTemplate("row");
    }else{
        loadTemplate(localStorage.getItem("typeTemplate"));
    }
	
	
	editor.on('keyup', delay(function (e) {
		if(e.ctrlKey && (e.which == 83)) {
		    e.preventDefault();
		    $("#btn-tsave").click();
		    return false;
		  }else{
		  	$("#btn-tsave").click();
		}
	},1000))
})

$("#vpreview").click(function(){
	var vmode = {"default":"d","small":"s","thermal":"t"}
	window.open("./"+session+"/vpreview/&"+vmode[$("#select-template").val()]+"&prev","_blank","width=310,height=390")
})

$(document).bind('keydown', function(e) {
  if(e.ctrlKey && (e.which == 83)) {
  	editor.focus();
    e.preventDefault();
    return false;
  }
});

</script>


<?php

}else if(isMobile()){ 
  $navicon = '<i class="fa fa-edit"></i>';
  $editor_ma = "nav_active";
  include_once("view/header_html.php");
  include_once("view/menu.php");

  ?>

  <style>
.CodeMirror {
  border: 1px solid #2f353a;
  height: 78vh;
}
textarea{
  font-size:12px;
  border: 1px solid #2f353a;
}
</style>
<div class="main-mobile">

<div class="row">
<div style="margin-top:50px;margin-bottom:30px;" >

<div class="group-icon-mobile" style="margin: auto; width:100%">
  <i class="fa fa-edit" style="font-size:60px" ></i>
  <h3>Template Editor</h3>
  </div> 

  
  </div>
  <div class="col-12">
            <div class="mobile-card ">
            
                <h3><i class="fa fa-edit" id="t_err"></i>&nbsp; Template Editor &nbsp; <span id="loading"></span>&nbsp;&nbsp;|&nbsp;&nbsp;<span class="pointer editor_help"><i class="fa fa-question "></i> Help</span></h3>
           
            <div class="mr-t-10" >

            <div >
        
                <div class="btn-group btn-container mr-b-5" >
                  <button class="bg-btn-group" id="btn-tsave" title="Ctrl + s" ><i class="fa fa-save" ></i> Save</button>
                  <button class="bg-btn-group" style="border-right: 1px solid transparent;"><i class="fa fa-ticket" ></i> Template</button>
                  <select class="bg-btn-group pointer" style="border-left: 1px solid transparent;"id="select-template" value="">
                    <option value="default">Default</option>
                    <option value="small">Small</option>
                    <option value="thermal">Thermal</option>      
                  </select>
                </div>
                <div class="btn-group btn-container" >
                  <button class="bg-btn-group" id="btn-header" onclick="loadTemplate('header')"><i class="fa fa-file-text" ></i> Header</button>
                  <button class="bg-btn-group" id="btn-row" onclick="loadTemplate('row')"><i class="fa fa-file-text" ></i> Row</button>
                  <button class="bg-btn-group" id="btn-footer" onclick="loadTemplate('footer')"><i class="fa fa-file-text" ></i> Footer</button>
                </div>
                <div class="btn-group btn-container" >
                  <button class="bg-btn-group" id="vpreview" ><i class="fa fa-eye" ></i> Preview</button>
                </div>
                <div class="card-fixed mr-t-5">
                  <span class="card-tab card-tab-active" id="active-edit"></span>
                  <textarea class="bg-dark" id="editorMikhmon" name="editor" style="width:100%"></textarea>
                </div>
              </div>


           
            <div class="card-footer"> </div>
            </div>
        </div>
      </div>
    </div>

</div>
<script>



$(document).ready(function() {  
  localStorage.setItem("?admin_curr","$");
  if(!localStorage.getItem("typeTemplate") || localStorage.getItem("typeTemplate") == ""){
        localStorage.setItem("typeTemplate","row");
        localStorage.setItem("nameTemplate","default");
      loadTemplate("row");
    }else{
        loadTemplate(localStorage.getItem("typeTemplate"));
    }
  
  
  editor.on('keyup', delay(function (e) {
    if(e.ctrlKey && (e.which == 83)) {
        e.preventDefault();
        $("#btn-tsave").click();
        return false;
      }else{
        $("#btn-tsave").click();
    }
  },1000))
})

$("#vpreview").click(function(){
  var vmode = {"default":"d","small":"s","thermal":"t"}
  window.open("./"+session+"/vpreview/&"+vmode[$("#select-template").val()]+"&prev","_blank","width=310,height=390")
})

$(document).bind('keydown', function(e) {
  if(e.ctrlKey && (e.which == 83)) {
    editor.focus();
    e.preventDefault();
    return false;
  }
});

</script>





<?php }} ?>