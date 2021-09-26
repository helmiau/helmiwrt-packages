#
# v2rayA <https://github.com/v2rayA/v2rayA/>
# v2rayA Official WebGUI Repository <http://github.com/v2rayA/v2raya-web>
# LuCI v2rayA App by Helmi Amirudin <https://www.helmiau.com>
#
# Copyright (C) 2021 Helmi Amirudin <helmilaw@gmail.com>
# This is free software, licensed under the Apache License, Version 2.0
#

include $(TOPDIR)/rules.mk

LUCI_TITLE:=LuCI v2rayA App
LUCI_PKGARCH:=all
PKG_NAME:=luci-app-v2raya
PKG_VERSION:=1.2
PKG_RELEASE:=1

define Package/$(PKG_NAME)
	$(call Package/luci/webtemplate)
	TITLE:=$(LUCI_TITLE)
endef

define Package/$(PKG_NAME)/install
	$(INSTALL_DIR) $(1)/usr/lib/lua/luci
	cp -pR ./luasrc/* $(1)/usr/lib/lua/luci
	$(INSTALL_DIR) $(1)/
	cp -pR ./root/* $(1)/
	[ -f "/root/etc/init.d/v2raya" ] && chmod -R 755 /root/etc/init.d/v2raya
	[ -f "/root/usr/bin/v2raya" ] && chmod -R 755 /root/usr/bin/v2raya
	[ -f "/root/bin/v2raya" ] && chmod -R 755 /root/bin/v2raya
	[ -d "/root" ] && chmod -R 755 /root/*
	[ -d "/root/root/" ] && chmod -R 755 /root/root/*
endef

define Package/$(PKG_NAME)/postinst
#!/bin/sh
	rm -f /tmp/luci-indexcache
	rm -f /tmp/luci-modulecache/*
	[ -d "/usr/lib/lua/luci/controller" ] && chmod -R 755 /usr/lib/lua/luci/controller/*
	[ -d "/usr/lib/lua/luci/view" ] && chmod -R 755 /usr/lib/lua/luci/view/*
	[ -d "/root" ] && chmod -R 755 /root/*
	[ -f "/etc/init.d/v2raya" ] && chmod -R 755 /etc/init.d/v2raya
	[ -f "/usr/bin/v2raya" ] && chmod -R 755 /usr/bin/v2raya
	[ -f "/bin/v2raya" ] && chmod -R 755 /bin/v2raya
exit 0
endef

include $(TOPDIR)/feeds/luci/luci.mk

$(eval $(call BuildPackage,$(PKG_NAME)))
