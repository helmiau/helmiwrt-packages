#!/bin/bash
#=================================================
# Description: DIY script
# Lisence: MIT
# Author: P3TERX
# Blog: https://p3terx.com
#=================================================

# Clone community packages to package/community
mkdir package/community
pushd package/community

# Add Argon theme configuration
git clone --depth=1 https://github.com/jerrykuku/luci-app-argon-config

# Add official OpenClash dev branch source
# git clone --depth=1 -b dev https://github.com/vernesong/OpenClash
svn co https://github.com/vernesong/OpenClash/branches/dev/luci-app-openclash vernesong/OpenClash

# Add modeminfo
git clone --depth=1 https://github.com/koshev-msk/luci-app-modeminfo

# Add luci-app-smstools3
git clone --depth=1 https://github.com/koshev-msk/luci-app-smstools3

# Add luci-app-mmconfig : configure modem cellular bands via mmcli utility
git clone --depth=1 https://github.com/koshev-msk/luci-app-mmconfig

# Add support for Fibocom L860-GL l850/l860 ncm
git clone --depth=1 https://github.com/koshev-msk/xmm-modem

if [[ $SOURCE_BRANCH == *"21.02"* ]]; then
	echo "21.02 branch detected! Adding 21.02 repos..."
	# Add luci-app-modemband
	echo "Adding luci-app-modemband..."
	git clone --depth=1 https://github.com/4IceG/luci-app-modemband
	# Add 3ginfo, luci-app-3ginfo-lite
	echo "Adding luci-app-3ginfo-lite..."
	git clone --depth=1 https://github.com/4IceG/luci-app-3ginfo-lite
else
	echo "18.06 branch detected! Adding 18.06 repos..."
	# Add 3ginfo, luci-app-3ginfo
	echo "Adding luci-app-3ginfo..."
	git clone --depth=1 https://github.com/4IceG/luci-app-3ginfo
	sed -i 's/luci-app-3ginfo-lite/luci-app-3ginfo/g' $OPENWRT_ROOT_PATH/.config
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
if [[ $SOURCE_BRANCH == *"21.02"* ]]; then
	echo "OpenWrt $SOURCE_BRANCH detected! using luci-app-v2raya master branch..."
	git clone --depth=1 -b master https://github.com/zxlhhyccc/luci-app-v2raya
elif [[ $SOURCE_BRANCH == *"18.06"* ]]; then
	echo "OpenWrt $SOURCE_BRANCH detected! using luci-app-v2raya 18.06 branch..."
	git clone --depth=1 -b 18.06 https://github.com/zxlhhyccc/luci-app-v2raya
fi


# Add luci-theme-neobird theme
git clone --depth=1 https://github.com/helmiau/luci-theme-neobird

# Add Adguardhome
git clone --depth=1 https://github.com/yang229/luci-app-adguardhome

# Out to openwrt dir
popd

