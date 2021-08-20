#
# Copyright (C) 2021 Helmi Amirudin <helmilaw@gmail.com>
# This is free software, licensed under the Apache License, Version 2.0
#

include $(TOPDIR)/rules.mk

LUCI_TITLE:=LuCI Shutdown Your Router in One-Click
LUCI_PKGARCH:=all
PKG_NAME:=luci-app-shutdown
PKG_VERSION:=1.0
PKG_RELEASE:=1

define Package/luci-app-shutdown/install
	$(INSTALL_DIR) $(1)/usr/lib/lua/luci
	cp -pR ./luasrc/* $(1)/usr/lib/lua/luci
endef


define Package/luci-app-shutdown/postinst
#!/bin/sh
	rm -f /tmp/luci-indexcache
	rm -f /tmp/luci-modulecache/*
	chmod -R +x /usr/lib/lua/luci/controller/*
	chmod -R +x /usr/lib/lua/luci/view/*
exit 0
endef

include $(TOPDIR)/feeds/luci/luci.mk

# call BuildPackage - OpenWrt buildroot signature
