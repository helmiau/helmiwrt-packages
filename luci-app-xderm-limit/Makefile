#
# Xderm Limit GUI Software by Ryan Fauzi <https://github.com/ryanfauzi1/xderm-mini_GUI>
# LuCI Xderm Mini GUI App by Helmi Amirudin <https://www.helmiau.com>
#
# Copyright (C) 2021 Helmi Amirudin <helmilaw@gmail.com>
# This is free software, licensed under the Apache License, Version 2.0
#

include $(TOPDIR)/rules.mk

LUCI_TITLE:=LuCI Xderm Mini App
LUCI_PKGARCH:=all
PKG_NAME:=luci-app-xderm-limit
PKG_VERSION:=1.0
PKG_RELEASE:=1

define Package/luci-app-xderm-limit/install
	$(INSTALL_DIR) $(1)/usr/lib/lua/luci
	cp -pR ./luasrc/* $(1)/usr/lib/lua/luci
	$(INSTALL_DIR) $(1)/
	cp -pR ./root/* $(1)/
endef


define Package/luci-app-xderm-limit/postinst
#!/bin/sh
	rm -f /tmp/luci-indexcache
	rm -f /tmp/luci-modulecache/*
	chmod -R +x /usr/lib/lua/luci/controller/*
	chmod -R +x /usr/lib/lua/luci/view/*
	chmod -R +x /www/xderm/*
exit 0
endef

include $(TOPDIR)/feeds/luci/luci.mk

# call BuildPackage - OpenWrt buildroot signature
