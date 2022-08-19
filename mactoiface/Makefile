#
# How to Lock Interface Devices OpenWrt eth wwan0 usb0 usbnet0 | REYRE-STB by Indonesian Tech Channel <https://www.youtube.com/watch?v=KYq6bbG-Rjc>
# AppModule by Helmi Amirudin <https://www.helmiau.com>
#
# Copyright (C) 2021 Helmi Amirudin <helmilaw@gmail.com>
# This is free software, licensed under the Apache License, Version 2.0
#

include $(TOPDIR)/rules.mk

PKG_NAME:=mactoiface
PKG_VERSION:=1.0
PKG_RELEASE:=1
PKG_MAINTAINER:=Reyre and Helmi Amirudin <helmiau.com>

include $(INCLUDE_DIR)/package.mk

define Package/$(PKG_NAME)
	TITLE:=MAC To Interface
	DEPENDS:=+bash
	SECTION:=net
	CATEGORY:=Network
	SUBMENU:=Routing and Redirection
	MAINTAINER:=Reyre and Helmi Amirudin <helmiau.com>
	PKGARCH:=all
endef

define Package/$(PKG_NAME)/description
	Lock OpenWrt mac address to preferred interface.
endef

define Build/Prepare
endef

define Build/Configure
endef

define Build/Compile
endef

define Package/$(PKG_NAME)/install
	$(INSTALL_DIR) $(1)/
	cp -pR ./root/* $(1)/
	[ -f $(1)/etc/init.d/mactoiface ] && chmod 755 $(1)/etc/init.d/mactoiface
endef

define Package/$(PKG_NAME)/postinst
#!/bin/sh
	[ -f /root/etc/init.d/mactoiface ] && chmod 755 /root/etc/init.d/mactoiface
	[ -f /etc/init.d/mactoiface ] && chmod 755 /etc/init.d/mactoiface
exit 0
endef

define Package/$(PKG_NAME)/postrm
#!/bin/sh
	[ -f /etc/config/mactoiface ] && rm -f /etc/config/mactoiface
	[ -f /etc/init.d/mactoiface ] && rm -f /etc/init.d/mactoiface
exit 0
endef

$(eval $(call BuildPackage,$(PKG_NAME)))
