#!/bin/bash

# PING Loop Wrapper
# by Lutfa Ilham
# v1.0

if [ "$(id -u)" != "0" ]; then
  echo "This script must be run as root" 1>&2
  exit 1
fi

SERVICE_NAME="Auto Reconnect"
SYSTEM_CONFIG="${LIBERNET_DIR}/system/config.json"
TUNNEL_MODE="$(grep 'mode":' ${SYSTEM_CONFIG} | awk '{print $2}' | sed 's/,//g; s/"//g')"

function loop() {
n=0
while [ 1 ]; do
  wan=$(curl --connect-timeout 10 'https://api.ipify.org/?format=json' | jq '.ip' | sed ' s/"//g')
  ip=$(jq .server '/root/libernet/system/config.json' | sed ' s/"//g')
echo $wan $ip
  if  [ $wan = $ip ]; then
  "${LIBERNET_DIR}/bin/log.sh" -w "<span style=\"color: Green\">Checking Connection... </span>"
  sleep 1
  "${LIBERNET_DIR}/bin/log.sh" -w "<span style=\"color: Green\">HTTP/1.1 200 OK [IP: ${ip}]</span>"
    echo wan ok
    sleep 3
	n=0
  else
    echo ping fail
    n=$((n+1))
	"${LIBERNET_DIR}/bin/log.sh" -w "<span style=\"color: Green\">Checking Connection... </span>"
  sleep 1
  "${LIBERNET_DIR}/bin/log.sh" -w "<span style=\"color: red\">Failed ${n}</span>"
    sleep 3
  fi
  echo fail counter $n
  if [ $n -gt 4 ]; then
	"${LIBERNET_DIR}/bin/log.sh" -w "<span style=\"color: green\">Auto Reconnecting</span>"
    n=0
    recon
  fi
done
}

#stop libernet
recon(){
    stop_services
	sleep 2
	start_services
}

function start_services() {
  # write to service log
  case "${TUNNEL_MODE}" in
    "0")
	  "${LIBERNET_DIR}/bin/log.sh" -w "Auto Reconnect Restart SSH"
      "${LIBERNET_DIR}/bin/ssh.sh" -r
      ;;
    "1")
	  "${LIBERNET_DIR}/bin/log.sh" -w "Auto Reconnect Restart v2ray"
      "${LIBERNET_DIR}/bin/v2ray.sh" -r
      ;;
    "2")
	  "${LIBERNET_DIR}/bin/log.sh" -w "Auto Reconnect Restart SSH-SSL"
      "${LIBERNET_DIR}/bin/ssh-ssl.sh" -r
      ;;
    "3")
	  "${LIBERNET_DIR}/bin/log.sh" -w "Auto Reconnect Restart Trojan"
      "${LIBERNET_DIR}/bin/trojan.sh" -r
      ;;
    "4")
	  "${LIBERNET_DIR}/bin/log.sh" -w "Auto Reconnect Restart shadowsocks"
      "${LIBERNET_DIR}/bin/shadowsocks.sh" -r
      ;;
	"5")
	  "${LIBERNET_DIR}/bin/log.sh" -w "Auto Reconnect Restart openvpn"
      "${LIBERNET_DIR}/bin/openvpn.sh" -r
      ;;
	"6")
	  "${LIBERNET_DIR}/bin/log.sh" -w "Auto Reconnect Restart ssh-ws-cdn"
      "${LIBERNET_DIR}/bin/ssh-ws-cdn.sh" -r
      ;;
  esac
  "${LIBERNET_DIR}/bin/log.sh" -w "Auto Reconnect Restart Tun2Socks"
  "${LIBERNET_DIR}/bin/tun2socks.sh" -v
  sleep 5
  "${LIBERNET_DIR}/bin/log.sh" -w "<span style=\"color: blue\">Auto Reconnect Checking...</span>"
}

function stop_services() {
  "${LIBERNET_DIR}/bin/log.sh" -w "Auto Stopping Tunnel"
  case "${TUNNEL_MODE}" in
    "0")
      "${LIBERNET_DIR}/bin/ssh.sh" -s
      ;;
    "1")
      "${LIBERNET_DIR}/bin/v2ray.sh" -s
      ;;
    "2")
      "${LIBERNET_DIR}/bin/ssh-ssl.sh" -s
      ;;
    "3")
      "${LIBERNET_DIR}/bin/trojan.sh" -s
      ;;
    "4")
      "${LIBERNET_DIR}/bin/shadowsocks.sh" -s
      ;;
    "5")
      "${LIBERNET_DIR}/bin/openvpn.sh" -s
      ;;
	"6")
      "${LIBERNET_DIR}/bin/ssh-ws-cdn.sh" -s
      ;;
  esac
  "${LIBERNET_DIR}/bin/log.sh" -w "Auto Stopping Tun2Socks"
  "${LIBERNET_DIR}/bin/tun2socks.sh" -w
}

function run() {
  "${LIBERNET_DIR}/bin/log.sh" -w "Starting ${SERVICE_NAME} service"
  echo -e "Starting ${SERVICE_NAME} service ..."
  screen -AmdS auto-recon "${LIBERNET_DIR}/bin/auto_recon.sh" -l \
    && echo -e "${SERVICE_NAME} service started!"
}

function stop() {
  # write to service log
  "${LIBERNET_DIR}/bin/log.sh" -w "Stopping ${SERVICE_NAME} service"
  echo -e "Stopping ${SERVICE_NAME} service ..."
  kill $(screen -list | grep auto-recon | awk -F '[.]' {'print $1'}) > /dev/null 2>&1
  echo -e "${SERVICE_NAME} service stopped!"
}

function usage() {
  cat <<EOF
Usage:
  -r  Run ${SERVICE_NAME} service
  -s  Stop ${SERVICE_NAME} service
EOF
}

case "${1}" in
  -r)
    run
    ;;
  -s)
    stop
    ;;
  -l)
    loop
    ;;
  *)
    usage
    ;;
esac
