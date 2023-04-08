#!/bin/bash
#=================================================
# Description: DIY script
# Lisence: MIT
# Author: P3TERX
# Blog: https://p3terx.com
#=================================================
# Clone community packages to package
[[ -d package ]] && mkdir package
pushd package

# Add Argon theme configuration
git clone --depth=1 https://github.com/jerrykuku/luci-app-argon-config

# Add official OpenClash dev branch source
# git clone --depth=1 -b dev https://github.com/vernesong/OpenClash
svn co https://github.com/vernesong/OpenClash/branches/dev/luci-app-openclash luci-app-openclash

# Add modeminfo
svn co https://github.com/koshev-msk/modemfeed/trunk/luci/applications/luci-app-modeminfo luci-app-modeminfo
svn co https://github.com/koshev-msk/modemfeed/trunk/packages/net/modeminfo modeminfo
# Remove modeminfo telegrambot plugin
[[ -f modeminfo/Makefile ]] && sed -i -e '/Package\/\$(PKG_NAME)-telegram\/install/,+4d' -e '/Package\/\$(PKG_NAME)-telegram/,+6d' -e '/\$(eval \$(call BuildPackage,\$(PKG_NAME)-telegram))/,+0d' modeminfo/Makefile
[[ -f modeminfo/root/usr/lib/telegrambot/plugins/modeminfo.sh ]] && rm -f modeminfo/root/usr/lib/telegrambot/plugins/modeminfo.sh

# Add luci-app-smstools3
svn co https://github.com/koshev-msk/modemfeed/trunk/luci/applications/luci-app-smstools3 luci-app-smstools3

# Add luci-app-mmconfig : configure modem cellular bands via mmcli utility
svn co https://github.com/koshev-msk/modemfeed/trunk/luci/applications/luci-app-mmconfig luci-app-mmconfig

# Add support for Fibocom L860-GL l850/l860 ncm
svn co https://github.com/koshev-msk/modemfeed/trunk/packages/net/xmm-modem xmm-modem

if [[ $REPO_BRANCH == *"21."* ]] || [[ $REPO_BRANCH == *"22."* ]] || [[ $REPO_BRANCH == *"23."* ]]; then
	echo "21.02 branch detected! Adding 21.02 repos..."
	# Add luci-app-modemband
	echo "Adding luci-app-modemband..."
	git clone --depth=1 https://github.com/4IceG/luci-app-modemband
	# Add 3ginfo, luci-app-3ginfo-lite
	echo "Adding luci-app-3ginfo-lite..."
	git clone --depth=1 https://github.com/4IceG/luci-app-3ginfo-lite
	# Add luci-app-argon
	echo "Adding jerrykuku/luci-app-argon for openwrt 2x.xx..."
	git clone --depth=1 -b master https://github.com/jerrykuku/luci-app-argon
else
	echo "18.06 branch detected! Adding 18.06 repos..."
	# Add 3ginfo, luci-app-3ginfo
	echo "Adding luci-app-3ginfo..."
	git clone --depth=1 https://github.com/4IceG/luci-app-3ginfo
	sed -i 's/luci-app-3ginfo-lite/luci-app-3ginfo/g' $BUILD_CONFIG
	# Add luci-app-argon
	echo "Adding jerrykuku/luci-app-argon for openwrt 2x.xx..."
	git clone --depth=1 -b 18.06 https://github.com/jerrykuku/luci-app-argon
fi

# Add luci-app-sms-tool
git clone --depth=1 https://github.com/4IceG/luci-app-sms-tool

# Add luci-app-atinout-mod
git clone --depth=1 https://github.com/4IceG/luci-app-atinout-mod

# HelmiWrt packages
git clone --depth=1 https://github.com/helmiau/helmiwrt-packages
rm -rf helmiwrt-packages/luci-app-v2raya
# telegrambot
svn co https://github.com/helmiau/helmiwrt-adds/trunk/packages/net/telegrambot helmiwrt-adds/telegrambot
svn co https://github.com/helmiau/helmiwrt-adds/trunk/luci/luci-app-telegrambot helmiwrt-adds/luci-app-telegrambot

# Add LuCI v2rayA
if [[ $REPO_BRANCH == *"21.02"* ]]; then
	echo "OpenWrt $REPO_BRANCH detected! using luci-app-v2raya master branch..."
	git clone --depth=1 -b master https://github.com/zxlhhyccc/luci-app-v2raya
elif [[ $REPO_BRANCH == *"18.06"* ]]; then
	echo "OpenWrt $REPO_BRANCH detected! using luci-app-v2raya 18.06 branch..."
	git clone --depth=1 -b 18.06 https://github.com/zxlhhyccc/luci-app-v2raya
fi

# Add luci-theme-neobird theme
git clone --depth=1 https://github.com/helmiau/luci-theme-neobird

# Add Adguardhome
git clone --depth=1 https://github.com/yang229/luci-app-adguardhome

# Out to openwrt dir
popd

#-----------------------------------------------------------------------------
#   End of @helmiau terminal scripts additionals menu
#-----------------------------------------------------------------------------
