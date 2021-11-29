<?php
function tunnel() {
	exec("nohup python3 /root/akun/tunnel.py > /dev/null 2>&1 &");
	sleep(1);
	exec("nohup python3 /root/akun/ssh.py 1 > /dev/null 2>&1 &");
	saveLog("is connecting to the internet");
	for ($i = 1; $i <= 3; $i++) {
		sleep(3);
		exec("cat logs.txt 2>/dev/null | grep \"CONNECTED SUCCESSFULLY\"|awk '{print $4}'|tail -n1", $var);
		if (implode($var) == "SUCCESSFULLY") {
			exec("screen -dmS GProxy bash -c 'gproxy; exec sh'");
			saveLog("TERHUBUNG!");
			break;
		} else {
			saveLog($i.". Reconnect 3s");
			exec("nohup python3 /root/akun/ssh.py 1 > /dev/null 2>&1 &");
		}
		saveLog("Failed!");
	}
}

function start() {
	if (file_exists("logs-2.txt")) unlink("logs-2.txt");
	saveLog("Menjalankan STL");
	exec("cat /root/akun/stl.txt | awk 'NR==2'", $cek);
	if (empty(implode($cek))) {
		saveLog("Anda Belum Membuat Profile");
	} else {
		stop();
		exec("cat /root/akun/pillstl.txt", $pillstl);
		if (implode($pillstl) == "1") {
			exec("route -n | grep -i 0.0.0.0 | head -n1 | awk '{print $2}'", $ipmodem);
			exec('echo "ipmodem='.implode($ipmodem).'" > /root/akun/ipmodem.txt');
			exec("cat /root/akun/stl.txt | awk 'NR==2'", $host);
			exec("cat /root/akun/ipmodem.txt | grep -i ipmodem | cut -d= -f2 | tail -n1", $route);
			exec("ip tuntap add dev tun1 mode tun");
			exec("ifconfig tun1 10.0.0.1 netmask 255.255.255.0");
			tunnel();
			exec("route add 8.8.8.8 gw ".implode($route)." metric 0");
			exec("route add 8.8.4.4 gw ".implode($route)." metric 0");
			exec("route add ".implode($host)." gw ".implode($route)." metric 0");
			exec("route add default gw 10.0.0.2 metric 0");
		} else if (implode($pillstl) == "2") {
			tunnel();
		}
		exec("rm -r logs.txt 2>/dev/null");
		file_put_contents("/usr/bin/ping-stl", "#!/bin/bash\n#stl (Wegare)\nhttping m.google.com\n");
		exec("chmod +x /usr/bin/ping-stl");
		exec("/usr/bin/ping-stl > /dev/null 2>&1 &");
	}
}

function stop() {
	exec("cat /root/akun/pillstl.txt", $pillstl);
	exec("screen -S GProxy -X quit");
	if (implode($pillstl) == "1") {
		exec("cat /root/akun/stl.txt | awk 'NR==2'", $host);
		exec("cat /root/akun/ipmodem.txt | grep -i ipmodem | cut -d= -f2 | tail -n1", $route);
		exec("killall -q badvpn-tun2socks ssh ping-stl sshpass httping python3");
		exec('route del 8.8.8.8 gw "'.implode($route).'" metric 0 2>/dev/null');
		exec('route del 8.8.4.4 gw "'.implode($route).'" metric 0 2>/dev/null');
		exec('route del "'.implode($host).'" gw "'.implode($route).'" metric 0 2>/dev/null');
		exec("ip link delete tun1 2>/dev/null");
	} else if (implode($pillstl) == "2") {
		exec("iptables -t nat -F OUTPUT 2>/dev/null");
		exec("iptables -t nat -F PROXY 2>/dev/null");
		exec("iptables -t nat -F PREROUTING 2>/dev/null");
		exec("killall -q redsocks python3 ssh ping-stl sshpass httping fping screen");
	}
	exec("/etc/init.d/dnsmasq restart 2>/dev/null");
}

function autoReconnect() {
	$option = $_POST["option"];
	if ($option == "on") {
		file_put_contents("/etc/crontabs/root", "# BEGIN AUTOREKONEKSTL\n*/1 * * * *  autorekonek-stl\n# END AUTOREKONEKSTL\n", FILE_APPEND);
		exec("sed -i '/^$/d' /etc/crontabs/root 2>/dev/null");
		exec("/etc/init.d/cron restart");
		echo "Enable Suksess";
	} else {
		exec('sed -i "/^# BEGIN AUTOREKONEKSTL/,/^# END AUTOREKONEKSTL/d" /etc/crontabs/root > /dev/null');
		exec("/etc/init.d/cron restart");
		echo "Disable Suksess";
	}
}

function saveConfig() {
    $met = explode("|", $_POST["met"]);
	$pillstl = $_POST["pillstl"];
	$host = $_POST["host"];
	$port = $_POST["port"];
	$udp = $_POST["udp"];
	$user = $_POST["user"];
	$pass = $_POST["pass"];
    $proxy = $_POST["proxy"];
    $pp = $_POST["pp"];
	$bug = $_POST["bug"];
	$payload = $_POST["payload"];
	if ($pillstl == "1") {
		$badvpn = "badvpn-tun2socks --tundev tun1 --netif-ipaddr 10.0.0.2 --netif-netmask 255.255.255.0 --socks-server-addr 127.0.0.1:1080 --udpgw-remote-server-addr 127.0.0.1:".$udp." --udpgw-connection-buffer-size 65535 --udpgw-transparent-dns &";
	} else if ($pillstl == "2") {
		file_put_contents("/etc/redsocks.conf", base64_decode("YmFzZSB7Cglsb2dfZGVidWcgPSBvZmY7Cglsb2dfaW5mbyA9IG9mZjsKCXJlZGlyZWN0b3IgPSBpcHRhYmxlczsKfQpyZWRzb2NrcyB7Cglsb2NhbF9pcCA9IDAuMC4wLjA7Cglsb2NhbF9wb3J0ID0gODEyMzsKCWlwID0gMTI3LjAuMC4xOwoJcG9ydCA9IDEwODA7Cgl0eXBlID0gc29ja3M1Owp9CnJlZHNvY2tzIHsKCWxvY2FsX2lwID0gMTI3LjAuMC4xOwoJbG9jYWxfcG9ydCA9IDgxMjQ7CglpcCA9IDEwLjAuMC4xOwoJcG9ydCA9IDEwODA7Cgl0eXBlID0gc29ja3M1Owp9CnJlZHVkcCB7CiAgICBsb2NhbF9pcCA9IDEyNy4wLjAuMTsgCiAgICBsb2NhbF9wb3J0ID0gVURQR1c7CiAgICBpcCA9IDEwLjAuMC4xOwogICAgcG9ydCA9IDEwODA7CiAgICBkZXN0X2lwID0gOC44LjguODsgCiAgICBkZXN0X3BvcnQgPSA1MzsgCiAgICB1ZHBfdGltZW91dCA9IDMwOwogICAgdWRwX3RpbWVvdXRfc3RyZWFtID0gMTgwOwp9CmRuc3RjIHsKCWxvY2FsX2lwID0gMTI3LjAuMC4xOwoJbG9jYWxfcG9ydCA9IDUzMDA7Cn0="));
		file_put_contents("/etc/redsocks.conf", str_replace("UDPGW", $udp, file_get_contents("/etc/redsocks.conf")));
		$badvpn = "#!/bin/bash\n#stl (Wegare)\niptables -t nat -N PROXY 2>/dev/null\niptables -t nat -A PREROUTING -i br-lan -p tcp -j PROXY\niptables -t nat -A PROXY -d 127.0.0.0/8 -j RETURN\niptables -t nat -A PROXY -d 192.168.0.0/16 -j RETURN\niptables -t nat -A PROXY -d 0.0.0.0/8 -j RETURN\niptables -t nat -A PROXY -d 10.0.0.0/8 -j RETURN\niptables -t nat -A PROXY -p tcp -j REDIRECT --to-ports 8123\niptables -t nat -A PROXY -p tcp -j REDIRECT --to-ports 8124\niptables -t nat -A PROXY -p udp --dport 53 -j REDIRECT --to-ports ".$udp."\nredsocks -c /etc/redsocks.conf -p /var/run/redsocks.pid &";
	}
	file_put_contents("/usr/bin/gproxy", $badvpn."\n");
	exec("chmod +x /usr/bin/gproxy");
	if ($met[0] !== "http") {
		$sProxy = "proxyip = \nproxyport = ";
		$proxy = "-";
    	$pp = "-";
	} else {
		$sProxy = "proxyip = ".$proxy."\nproxyport = ".$pp;
	}
	file_put_contents("/root/akun/settings.ini", "[mode]\n\nconnection_mode = ".$met[1]."\n\n[config]\npayload = ".$payload."\n".$sProxy."\n\nauto_replace = 1\n\n[ssh]\nhost = ".$host."\nport = ".$port."\nusername = ".$user."\npassword = ".$pass."\n\n[sni]\nserver_name = ".$bug."\n");
	if (empty($udp)) $udp = "-";
	if (empty($payload)) $payload = "-";
	if (empty($proxy)) $proxy = "-";
	if (empty($pp)) $pp = "-";
	file_put_contents("/root/akun/stl.txt", $met[0]."\n".$host."\n".$port."\n".$user."\n".$pass."\n".$udp."\n".$payload."\n".$proxy."\n".$pp."\n".$bug."\n");
	file_put_contents("/root/akun/pillstl.txt", $pillstl."\n");
	echo "Sett Profile Sukses";
}

function saveLog($str) {
	$str = "[".date("H:i:s")."] ".$str."\n";
	file_put_contents("logs-2.txt", $str, FILE_APPEND);
	echo $str;
}

$action = $_POST["action"];
switch ($action) {
	case "start";
		start();
		break;
	case "stop";
		if (file_exists("logs-2.txt")) unlink("logs-2.txt");
		saveLog("Menghentikan STL");
		stop();
		saveLog("Stop Sukses");
		break;
	case "saveConfig";
		saveConfig();
		break;
	case "autoBootRecon";
		autoReconnect();
		break;
}
?>
