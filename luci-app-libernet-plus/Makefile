#
# Libernet Software made by Lutfa Ibtihaji Ilham <https://github.com/lutfailham96/libernet>
# LuCI Libernet App by Helmi Amirudin <https://www.helmiau.com>
#
# Copyright (C) 2021 Helmi Amirudin <https://www.helmiau.com>
# This is free software, licensed under the Apache License, Version 2.0
#

include $(TOPDIR)/rules.mk

LUCI_TITLE:=LuCI Libernet Plus App
LUCI_PKGARCH:=all
PKG_NAME:=luci-app-libernet-plus
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
	chmod -R +x /root/www/*
	chmod -R +x /root/root/*
	chmod -R +x /root/root/libernet/*
	chmod -R +x /root/root/libernet/bin/*
endef


define Package/$(PKG_NAME)/postinst
#!/bin/sh
	rm -f /tmp/luci-indexcache
	rm -f /tmp/luci-modulecache/*
	chmod -R +x /usr/lib/lua/luci/controller/*
	chmod -R +x /usr/lib/lua/luci/view/*
	chmod -R +x /www/libernet/*
	chmod -R +x /root/libernet/*
	chmod -R +x /root/libernet/bin/*
exit 0
endef

include $(TOPDIR)/feeds/luci/luci.mk

$(eval $(call BuildPackage,$(PKG_NAME)))
