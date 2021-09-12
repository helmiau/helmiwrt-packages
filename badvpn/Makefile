# Copyright (C) 2009 Ambroz Bizjak
#
# This is free software, licensed under the GNU General Public License v2.
# Updated & patched for OpenWrt by Helmi Amirudin <www.helmiau.com>
#

include $(TOPDIR)/rules.mk

PKG_NAME:=badvpn
PKG_VERSION:=1.999.130
PKG_RELEASE:=1
PKG_MAINTAINER:=helmiau

PKG_SOURCE:=$(PKG_VERSION).tar.gz
PKG_SOURCE_URL:=https://github.com/ambrop72/badvpn/archive/
PKG_MD5SUM:=e65d8d298fc82eb9a6c12a9425a97e6d

include $(INCLUDE_DIR)/package.mk

define Package/$(PKG_NAME)
	SECTION:=net
	CATEGORY:=Network
	DEPENDS:=+librt +libpthread +libudev +libudev-zero +libnss +libopenssl +coreutils +coreutils-stdbuf +openssl-util
	TITLE:=BadVPN
	SUBMENU:=VPN
endef

define Build/Configure
	echo -e \
	"SET(CMAKE_SYSTEM_NAME Linux)\n" \
	"SET(CMAKE_C_COMPILER $(TARGET_CC))\n" \
	"SET(CMAKE_CXX_COMPILER $(TARGET_CXX))\n" \
	"SET(REG_STARTEND REG_EPAREN)\n" \
	"SET(CMAKE_FIND_ROOT_PATH $(STAGING_DIR) $(STAGING_DIR_HOST))\n" \
	> "$(PKG_BUILD_DIR)/toolchain.cmake"
	(cd $(PKG_BUILD_DIR); \
		CFLAGS="$(TARGET_CFLAGS)" \
		LDFLAGS="$(TARGET_LDFLAGS)" \
		cmake . \
		-DCMAKE_TOOLCHAIN_FILE=$(PKG_BUILD_DIR)/toolchain.cmake \
		-DBUILD_NOTHING_BY_DEFAULT=1 \
		-DBUILD_TUN2SOCKS=1 \
		-DBUILD_UDPGW=1 \
	);
endef

define Build/Compile
	$(MAKE) -C $(PKG_BUILD_DIR)
endef

define Package/$(PKG_NAME)/install
	$(INSTALL_DIR) $(1)/usr/bin
	$(INSTALL_BIN) $(PKG_BUILD_DIR)/tun2socks/badvpn-tun2socks $(1)/usr/bin/badvpn-tun2socks
	$(INSTALL_BIN) $(PKG_BUILD_DIR)/udpgw/badvpn-udpgw $(1)/usr/bin/badvpn-udpgw
endef

$(eval $(call BuildPackage,$(PKG_NAME)))
