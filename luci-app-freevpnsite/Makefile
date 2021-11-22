#
# LuCI Free VPN Site Lists by Helmi Amirudin <https://www.helmiau.com>
#
# Copyright (C) 2021 Helmi Amirudin <helmilaw@gmail.com>
# This is free software, licensed under the Apache License, Version 2.0
#

include $(TOPDIR)/rules.mk

LUCI_TITLE:=LuCI Free VPN Site Lists
LUCI_PKGARCH:=all
PKG_NAME:=luci-app-freevpnsite
PKG_VERSION:=1.0
PKG_RELEASE:=1

define Package/$(PKG_NAME)
	$(call Package/luci/webtemplate)
	TITLE:=$(LUCI_TITLE)
	DEPENDS:=+php7 +php7-cgi +php7-mod-json +php7-mod-session
endef

define Package/$(PKG_NAME)/install
	$(INSTALL_DIR) $(1)/usr/lib/lua/luci
	cp -pR ./luasrc/* $(1)/usr/lib/lua/luci
	$(INSTALL_DIR) $(1)/
	cp -pR ./root/* $(1)/
	chmod -R 755 /root/www/*
	chmod -R 755 /root/www/freevpnsite/*
endef

define Package/$(PKG_NAME)/postinst
#!/bin/sh
	rm -f /tmp/luci-indexcache
	rm -f /tmp/luci-modulecache/*
	chmod -R 755 /usr/lib/lua/luci/controller/*
	chmod -R 755 /usr/lib/lua/luci/view/*
	chmod -R 755 /www/*
	chmod -R 755 /www/freevpnsite/*
	# Autofix download index.php
	if ! grep -q ".php=/usr/bin/php-cgi" /etc/config/uhttpd; then
		#patch xderm, libernet
		echo -e "  helmilog : system not using php-cgi, patching php config ..."
		logger "  helmilog : system not using php-cgi, patching php config..."
		helmiooo=$(cat /etc/config/uhttpd)
		if [[ $helmiooo == *"uhttpd 'mai"* ]]; then
			logger "  helmilog : fixing auto download php file using patch 1 ..."
			sed -i "/config uhttpd 'main'/a list interpreter '.php=/usr/bin/php-cgi'" /etc/config/uhttpd
		fi
		if [[ $helmiooo == *"uhttpd 'mai"* ]]; then
			logger "  helmilog : fixing auto download php file using patch 2 ..."
			sed -i "/config uhttpd 'main'/a option ubus_prefix '/ubus'" /etc/config/uhttpd
		fi
		if [[ $helmiooo == *"uhttpd mai"* ]]; then
			logger "  helmilog : fixing auto download php file using patch 3 ..."
			sed -i "/config uhttpd main/a list interpreter '.php=/usr/bin/php-cgi'" /etc/config/uhttpd
		fi
		if [[ $helmiooo == *"uhttpd mai"* ]]; then
			logger "  helmilog : fixing auto download php file using patch 4 ..."
			sed -i "/config uhttpd main/a option ubus_prefix '/ubus'" /etc/config/uhttpd
		fi
		echo -e "  helmilog : patching system with php configuration done ..."
		echo -e "  helmilog : restarting some apps ..."
		logger "  helmilog : patching system with php configuration done..."
		logger "  helmilog : restarting some apps..."
		#addition patch for mikhmon
		sed -i "s#list index_page.*#list index_page 'cgi-bin/luci'\n	list index_page 'index.html'\n	list index_page 'index.php'#g" /etc/config/uhttpd
		/etc/init.d/uhttpd restart
	fi
exit 0
endef

include $(TOPDIR)/feeds/luci/luci.mk

$(eval $(call BuildPackage,$(PKG_NAME)))