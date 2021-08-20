<?php
    include('config.inc.php');
    include('auth.php');
    $loginError = false;
    if ((isset($_SESSION['username'])) && (isset($_SESSION['password']))) {
        header("Location: index.php");
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $system_config = file_get_contents($libernet_dir.'/system/config.json');
        $system_config = json_decode($system_config);
        if (($system_config->system->username === $username) && ($system_config->system->password === $password)) {
            set_session($username, $password);
        } else {
            $loginError = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Libernet | Login</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/icon1.png">
    </head>
    <body>
        <!-- Top content -->
        <div class="top-content">       	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">                       		
                        		<div class="form-top-right">                        			
                        		</div>
                            </div>
							
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
								<p><strong>Login </strong></p>
                                <?php

                                if ($loginError) {
                                    echo '<div class="alert alert-danger" role="alert">Username dan Password Salah,Periksa Kembali..!!</div>';
                                }
                            ?>
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-control" > Username </label>
			                        	<input  type="text" name="username" placeholder="Username" class="form-username form-control" id="form-username" >                                       
                                    </div>
			                        <div class="form-group" >
			                        	<label class="sr-only" for="form-control">Password</label>
			                        	<input type="password" name="password"  placeholder="Password" class="form-password form-control" id="form-password">
			                        </div> 
			                        <button type="submit" class="btn btn-primary"> <i class="fa fa-sign-in"></i> Masuk</button>
			                    </form>
		                    </div>
                        </div>
                    </div>                    
                </div>
            </div>        
        </div>
        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>      
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->    
		<?php include('footer.php'); ?>
    </body>
    
</html>