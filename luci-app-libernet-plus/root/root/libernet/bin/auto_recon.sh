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
#INTERVAL="1"
#HOST="bing.com"

function loop() {
n=0
while [ 1 ]; do
  #ping with timeout 10 seconds
  #ping -c 1 -W 10 -w 10 8.8.8.8
  
  wan=$(curl --connect-timeout 10 'https://api.ipify.org/?format=json' | jq '.ip' | sed ' s/"//g')
  ip=$(jq .server '/root/libernet/system/config.json' | sed ' s/"//g')
  #ret=$?
echo $wan $ip
  #echo ping result $ret
  if  [ $wan = $ip ]; then
    echo ping ok
    sleep 30
	n=0
	#ipCheck
  else 
    echo ping fail
    n=$((n+1))
    # when wan-dhcp fail, 
    # net is unreachable and ping return without any delay
    # using sleep 1 avoid fail count overflow too fast
    sleep 1
  fi

  echo fail counter $n
  if [ $n -gt 5 ]; then
    # in case of wan-dhcp fail total time to reboot is 1 min (60 seconds)
    # in case of ping-timeout total time to reboot is 11 min (660 seconds)
    n=0
        recon
  fi
done
}

#stop libernet
recon(){
    curl -d '{"action":"restart_libernet"}' -H "Content-Type: application/json" -X POST http://192.168.1.1/libernet/api.php
}

function run() {
  # write to service log
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
