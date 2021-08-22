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
                            <h3><i class="fa fa-info"></i> About Libernet Plus</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <p>
                                Libernet is open source web app for easy OpenWrt internet tunneling. Features :
                            </p>
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
                        </div>
                        <p class="text-center m-0">Libernet Maintainer : <a href="https://facebook.com/lutfailham"><i>Lutfa Ilham</i></a></p>
                        <p class="text-center m-0">Libernet Plus : <a href="https://www.facebook.com/groups/443024392562406/posts/1648983311966502/?__cft__[0]=AZUna3b5zVbP-VDjOLOyumEBKumJvQhUOgeXMF43MuLBGokzeHsDnycLiAzgEjcnaEWSX_4GaJsvKlzplZcQA4nJcKOGMu2I6MnX_UuWwRHph2oPdqm1m0aYiJbN_4iwNZGhPSrvF44ZtzVn5zUwZq4q&__tn__=%2CO%2CP-R"><i>Paskal Sapta Prasetio</i></a></p>
                        <p class="text-center m-0">Libernet LuCI : <a href="https://helmiau.com"><i>Helmi Amirudin</i></a></p>
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
