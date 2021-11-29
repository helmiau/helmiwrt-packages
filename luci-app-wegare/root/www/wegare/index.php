<?php
if (preg_match('/BEGIN AUTOREKONEKSTL/', file_get_contents("/etc/crontabs/root"))) $checked = true;
if (!file_exists("logs-2.txt")) touch("logs-2.txt");
$log = file_get_contents("logs-2.txt");
if (preg_match('/TERHUBUNG/', $log)) $terhubung = true;
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Wegare STL Tunnel - Home</title>
	<meta name="description" content="Portal Free VPN Sites Provider oleh Helmi Amirudin.">
	<link rel="icon" type="image/png" sizes="16x16" href="assets/img/og-16.png">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/img/og-32.png">
	<link rel="icon" type="image/png" sizes="180x180" href="assets/img/og-180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="assets/img/og-192.png">
	<link rel="icon" type="image/png" sizes="512x512" href="assets/img/og-512.png">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="row py-2">
            <div class="col-lg-6 col-md-12 mx-auto mt-3">
                <div class="card bg-info bg-transparent box-shadow">
                	<div class="col-lg-12">
                        <h4 class="text-center my-4">STL by Wegare</h4>
                    </div>
                    <nav class="navbar navbar-expand-sm navbar-light bg-transparent">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarsExample08" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-md-center" id="navbar">
                            <strong>
                            <ul class="navbar-nav">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="config.php">Config</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="tentang.php">About</a>
                                </li>
                            </ul>
                            </strong>
                        </div>
                    </nav>
                    <div class="card-body">
                        <div class="form-group col text-center mx-auto">
                            <div class="col form-row py-1">
                                <div class="col">
                                    <button type="submit" onclick="start();" id="start" class="btn btn-primary" <?php if ($terhubung) echo "disabled"; ?>>Start</button>
                                    <button type="submit" onclick="stop();" id="stop" class="btn btn-danger">Stop</button>
                                </div>
                            </div>
                        </div>
                        <div class="col text-center mx-auto">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="autoBootRecon" oninput="autoBootRecon(this.checked);" <?php if ($checked) echo "checked"; ?>>
                                        <label class="form-check-label" for="autoBootRecon">
                                            Auto Booting & Auto Reconnect
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-11 mx-auto pt-2">
                                    <textarea id="log" class="form-control text-left" style="height: 15rem; background-color: #e9ecef83" disabled><?= $log; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/main.js?<?= time(); ?>"></script>
</body>
</html>