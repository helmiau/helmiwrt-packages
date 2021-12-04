<?php
exec("cat /root/akun/stl.txt | awk 'NR==1'", $met2);
exec("cat /root/akun/stl.txt | awk 'NR==2'", $host2);
exec("cat /root/akun/stl.txt | awk 'NR==3'", $port2);
exec("cat /root/akun/stl.txt | awk 'NR==4'", $user2);
exec("cat /root/akun/stl.txt | awk 'NR==5'", $pass2);
exec("cat /root/akun/stl.txt | awk 'NR==6'", $udp2);
exec("cat /root/akun/stl.txt | awk 'NR==7'", $payload2);
exec("cat /root/akun/stl.txt | awk 'NR==8'", $proxy2);
exec("cat /root/akun/stl.txt | awk 'NR==9'", $pp2);
exec("cat /root/akun/stl.txt | awk 'NR==10'", $bug2);
exec("cat /root/akun/pillstl.txt", $pillstl2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Wegare STL Tunnel - Config</title>
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
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item active">
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
                        <div class="form-row pb-lg-2">
                            <div class="col-md-6">
                                <label>Mode</label>
                                <select class="form-control" id="met" onchange="mode(this.value)" required>
                                    <option value="http" <?php if (implode($met2) == "http") echo "selected"; ?>>Http Proxy + Payload</option>
                                    <option value="https" <?php if (implode($met2) == "https") echo "selected"; ?>>SSL/TLS Direct</option>
                                    <option value="direct" <?php if (implode($met2) == "direct") echo "selected"; ?>>SSH Direct + Payload</option>
                                    <option value="sp" <?php if (implode($met2) == "sp") echo "selected"; ?>>SSL/TLS + Payload</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Socks Proxy</label>
                                <select class="form-control" id="pillstl" required>
                                    <option value="1" <?php if (implode($pillstl2) == "1") echo "selected"; ?>>Badvpn-Tun2socks</option>
                                    <option value="2" <?php if (implode($pillstl2) == "2") echo "selected"; ?>>Transparent Proxy</option>
                                </select>
                            </div>
                        </div>
                        <div class="pb-lg-2">
                            <div class="form-row pb-lg-2">
                                <div class="col-md-6">
                                    <label>Host/IP Address</label>
                                    <input type="text" class="form-control" placeholder="server.com" value="<?php if ($host2) echo implode($host2); ?>" id="host" required>
                                </div>
                                <div class="col-md-3">
                                    <label>Port</label>
                                    <input type="number" class="form-control" placeholder="443" value="<?php if ($port2) echo implode($port2); ?>"  id="port" required>
                                </div>
                                <div class="col-md-3">
                                    <label>UDPGW Port</label>
                                    <input type="number" class="form-control" placeholder="7300" value="<?php if ($udp2) echo implode($udp2); ?>" id="udp" required>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label>Username</label>
                                    <input type="text" class="form-control" placeholder="Username" value="<?php if ($user2) echo implode($user2); ?>" id="user" required>
                                </div>
                                <div class="col-md-4">
                                    <label>Password</label>
                                    <input type="text" class="form-control" placeholder="Password" value="<?php if ($pass2) echo implode($pass2); ?>" id="pass" required>
                                </div>
                                <div class="col-md-4" id="dBug">
                                    <label>SNI</label>
                                    <input type="text" class="form-control" placeholder="bug.com" value="<?php if ($bug2) echo implode($bug2); ?>"  id="bug">
                                </div>
                                <div class="col-md-4" id="dProxy">
                                    <label>IP Proxy</label>
                                    <input type="text" class="form-control" placeholder="127.0.0.1" value="<?php if ($proxy2) echo implode($proxy2); ?>" id="proxy">
                                </div>
                                <div class="col-md-4" id="dPP">
                                    <label>Port Proxy</label>
                                    <input type="text" class="form-control" placeholder="8080" value="<?php if ($pp2) echo implode($pp2); ?>" id="pp">
                                </div>
                            </div>
                            <div class="pb-lg-2">
                                <div class="form-group" id="dPayload">
                                    <label>Payload</label>
                                    <textarea style="text-align:left" class="form-control" rows="5" placeholder="GET http://server.com/ HTTP/1.1[crlf][crlf]CONNECT [host_port] HTTP/1.1[crlf]Connection: keep-allive[crlf][crlf]" id="payload" required><?php if ($payload2) echo implode($payload2); ?></textarea>
                                </div>
                            </div>
                            <div class="pb-lg-2 text-center">
                                <button type="submit" onclick="saveConfig();" id="saveConfig" class="btn btn-primary btn-block">Save</button>
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