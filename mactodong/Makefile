#
# How to Lock Interface Devices OpenWrt eth wwan0 usb0 usbnet0 | REYRE-STB by Indonesian Tech Channel <https://www.youtube.com/watch?v=KYq6bbG-Rjc>
# AppModule by Helmi Amirudin <https://www.helmiau.com>
#
# Copyright (C) 2021 Helmi Amirudin <helmilaw@gmail.com>
# This is free software, licensed under the Apache License, Version 2.0
#

include $(TOPDIR)/rules.mk

LUCI_TITLE:=MAC Todong
LUCI_PKGARCH:=all
LUCI_DEPENDS:=+bash +screen

PKG_NAME:=mactodong
PKG_VERSION:=1.0
PKG_RELEASE:=1

define Package/$(PKG_NAME)
	$(call Package/luci/webtemplate)
	TITLE:=$(LUCI_TITLE)
	DEPENDS:=$(LUCI_DEPENDS)
endef

define Package/$(PKG_NAME)/description
	Lock many OpenWrt interfaces to preferred settings.
endef

define Package/$(PKG_NAME)/install
	$(INSTALL_DIR) $(1)/
	cp -pR ./root/* $(1)/
	chmod 755 /root/etc/config/mactodong
	chmod 755 /root/etc/init.d/mactodong
endef

define Package/$(PKG_NAME)/postinst
#!/bin/sh
	chmod 755 /root/etc/config/mactodong
	chmod 755 /root/etc/init.d/mactodong
exit 0
endef

define Package/$(PKG_NAME)/postrm
#!/bin/sh
	[[ -f /root/etc/config/mactodong ]] && rm -f /root/etc/config/mactodong
	[[ -f /root/etc/init.d/mactodong ]] && rm -f /root/etc/init.d/mactodong
exit 0
endef

include $(TOPDIR)/feeds/luci/luci.mk

$(eval $(call BuildPackage,$(PKG_NAME)))
