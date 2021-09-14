#
# OpenSpeedtest Software made by Lutfa Ibtihaji <http://openspeedtest.com/>
# LuCI OpenSpeedtest App by Helmi Amirudin <https://www.helmiau.com>
#
# Copyright (C) 2021 Helmi Amirudin <https://www.helmiau.com>
# This is free software, licensed under the Apache License, Version 2.0
#

include $(TOPDIR)/rules.mk

LUCI_TITLE:=LuCI OpenSpeedtest App
LUCI_PKGARCH:=all
PKG_NAME:=luci-app-openspeedtest
PKG_VERSION:=1.2
PKG_RELEASE:=1

define Package/$(PKG_NAME)
	$(call Package/luci/webtemplate)
	TITLE:=$(LUCI_TITLE)
endef

define Package/$(PKG_NAME)/install
	$(INSTALL_DIR) $(1)/usr/lib/lua/luci
	cp -pR ./luasrc/* $(1)/usr/lib/lua/luci
endef

define Package/$(PKG_NAME)/postinst
#!/bin/sh
	rm -f /tmp/luci-indexcache
	rm -f /tmp/luci-modulecache/*
	chmod -R 755 /usr/lib/lua/luci/controller/*
	chmod -R 755 /usr/lib/lua/luci/view/*
exit 0
endef

include $(TOPDIR)/feeds/luci/luci.mk

$(eval $(call BuildPackage,$(PKG_NAME)))
