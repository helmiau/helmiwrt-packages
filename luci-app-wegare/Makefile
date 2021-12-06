#
# VPN Software Codes by Wega Regianto <https://github.com/wegare123>
# LuCI App by Helmi Amirudin <https://www.helmiau.com>
# WebGUI by Helmi Amirudin <https://www.helmiau.com>
#
# Copyright (C) 2021 Helmi Amirudin <helmilaw@gmail.com>
# This is free software, licensed under the Apache License, Version 2.0
#

include $(TOPDIR)/rules.mk

LUCI_TITLE:=LuCI Wegare Tool App
LUCI_PKGARCH:=all
LUCI_DEPENDS:=+php7 +php7-cgi +php7-mod-session +zoneinfo-core +zoneinfo-asia +sshpass +openvpn-openssl +ip-full +openssh-client +httping +screen +python3 +coreutils-nohup +libevent2 +redsocks

PKG_NAME:=luci-app-wegare
PKG_VERSION:=1.3
PKG_RELEASE:=1

define Package/$(PKG_NAME)
	$(call Package/luci/webtemplate)
	TITLE:=$(LUCI_TITLE)
	DEPENDS:=$(LUCI_DEPENDS)
endef

define Package/$(PKG_NAME)/install
	$(INSTALL_DIR) $(1)/usr/lib/lua/luci
	cp -pR ./luasrc/* $(1)/usr/lib/lua/luci
	chmod -R 755 /root/www/*
	chmod -R 755 /root/www/wegare/*
	chmod -R 755 /root/root/*
endef

define Package/$(PKG_NAME)/postinst
#!/bin/sh
	rm -f /tmp/luci-indexcache
	rm -f /tmp/luci-modulecache/*
	chmod -R 755 /usr/lib/lua/luci/controller/*
	chmod -R 755 /usr/lib/lua/luci/view/*
	chmod -R 755 /www/*
	chmod -R 755 /www/wegare/*
	chmod -R 755 /root/*
	# Autofix download index.php, index.html
	if ! grep -q ".php=/usr/bin/php-cgi" /etc/config/uhttpd; then
		echo -e "  helmilog : system not using php-cgi, patching php config ..."
		logger "  helmilog : system not using php-cgi, patching php config..."
		uci set uhttpd.main.ubus_prefix='/ubus'
		uci set uhttpd.main.interpreter='.php=/usr/bin/php-cgi'
		uci set uhttpd.main.index_page='cgi-bin/luci'
		uci add_list uhttpd.main.index_page='index.html'
		uci add_list uhttpd.main.index_page='index.php'
		uci commit uhttpd
		echo -e "  helmilog : patching system with php configuration done ..."
		echo -e "  helmilog : restarting some apps ..."
		logger "  helmilog : patching system with php configuration done..."
		logger "  helmilog : restarting some apps..."
		/etc/init.d/uhttpd restart
	fi
	/usr/sbin/openvpn --mktun --dev tun0
exit 0
endef

define Package/$(PKG_NAME)/postrm
#!/bin/sh
	export NAMAPAKET="wegare"
	if [ -d /www/$NAMAPAKET ] ; then
		rm -rf /www/$NAMAPAKET
	fi
	unset NAMAPAKET
exit 0
endef

include $(TOPDIR)/feeds/luci/luci.mk

$(eval $(call BuildPackage,$(PKG_NAME)))
