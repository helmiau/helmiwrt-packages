<!doctype html>
<html lang="en">
<head>
    <?php
        $title = "About";
        include("head.php");
    ?>
</head>
<body>
<div id="app">
    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 mx-auto mt-4 mb-2">
                <div class="card">
                    <div class="card-header">
                        <div class="text-center">
                            <h3><i class="fa fa-info"></i> About Libernet</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <p>
                                Libernet is open source web app for tunneling internet on OpenWRT with ease.
                            </p>
                            <span>Working features:</span>
                            <ul class="m-2">
                                <li>SSH with proxy</li>
                                <li>SSH-SSL</li>
                                <li>V2Ray VMess</li>
                                <li>V2Ray VLESS</li>
                                <li>V2Ray Trojan</li>
                                <li>Trojan</li>
                                <li>Shadowsocks</li>
                                <li>OpenVPN</li>
                            </ul>
                            <p>
                                Some features still under development!
                            </p>
                        </div>
			<p class="text-center m-0"><a href="https://facebook.com/lutfailham">Report bug</a></p>
                        <p class="text-center m-0">Author: <a href="https://facebook.com/lutfailham"><i>Lutfa Ilham</i></a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php'); ?>
    </div>
</div>
<?php include("javascript.php"); ?>
<script src="js/about.js"></script>
</body>
</html>
