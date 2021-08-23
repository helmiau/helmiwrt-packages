#
# Tiny File Manager by prasathmani <https://github.com/prasathmani/tinyfilemanager>
# LuCI Tiny File Manager App by Helmi Amirudin <https://www.helmiau.com>
#
# Copyright (C) 2021 Helmi Amirudin <https://www.helmiau.com>
# This is free software, licensed under the Apache License, Version 2.0
#

include $(TOPDIR)/rules.mk

LUCI_TITLE:=LuCI Tiny File Manager App
LUCI_PKGARCH:=all
PKG_NAME:=luci-app-tinyfilemanager
PKG_VERSION:=1.1
PKG_RELEASE:=1

define Package/luci-app-tinyfilemanager/install
	$(INSTALL_DIR) $(1)/usr/lib/lua/luci
	cp -pR ./luasrc/* $(1)/usr/lib/lua/luci
	$(INSTALL_DIR) $(1)/
	cp -pR ./root/* $(1)/
endef


define Package/luci-app-tinyfilemanager/postinst
#!/bin/sh
	rm -f /tmp/luci-indexcache
	rm -f /tmp/luci-modulecache/*
	chmod -R +x /usr/lib/lua/luci/controller/*
	chmod -R +x /usr/lib/lua/luci/view/*
	chmod -R +x /www/*
exit 0
endef

include $(TOPDIR)/feeds/luci/luci.mk

# call BuildPackage - OpenWrt buildroot signature
