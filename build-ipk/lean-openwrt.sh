#!/bin/bash
#=================================================
# Description: DIY script
# Lisence: MIT
# Author: P3TERX
# Blog: https://p3terx.com
#=================================================

HWOSDIR="package/base-files/files"

# Modify default IP
#sed -i 's/192.168.1.1/192.168.50.5/g' $HWOSDIR/bin/config_generate

# Switch dir to package/lean
pushd package/lean

# Remove luci-app-uugamebooster and luci-app-xlnetacc
rm -rf luci-app-uugamebooster
rm -rf luci-app-xlnetacc

# Exit from package/lean dir
popd

# Clone community packages to package/community
mkdir package/community
pushd package/community

# Add OpenClash
git clone --depth=1 -b dev https://github.com/vernesong/OpenClash

# Add Clash
git clone --depth=1 https://github.com/hubbylei/luci-app-clash

# HelmiWrt packages
git clone --depth=1 https://github.com/helmiau/helmiwrt-packages

# Add luci-theme-argon
git clone --depth=1 -b 18.06 https://github.com/jerrykuku/luci-theme-argon
git clone --depth=1 https://github.com/jerrykuku/luci-app-argon-config

# Add themes from kenzok8 openwrt-packages
svn co https://github.com/kenzok8/openwrt-packages/trunk/luci-theme-atmaterial_new kenzok8/luci-theme-atmaterial_new
svn co https://github.com/kenzok8/openwrt-packages/trunk/luci-theme-edge kenzok8/luci-theme-edge
svn co https://github.com/kenzok8/openwrt-packages/trunk/luci-theme-ifit kenzok8/luci-theme-ifit
svn co https://github.com/kenzok8/openwrt-packages/trunk/luci-theme-mcat kenzok8/luci-theme-mcat
svn co https://github.com/kenzok8/openwrt-packages/trunk/luci-theme-tomato kenzok8/luci-theme-tomato

# Add luci-theme-tano theme
git clone --depth=1 https://github.com/lynxnexy/lynx
rm -rf lynx/luci-theme-netgear

# Add luci-theme-rosy theme
git clone --depth=1 https://github.com/rosywrt/luci-theme-rosy

# Add luci-theme-neobird theme
git clone --depth=1 https://github.com/thinktip/luci-theme-neobird

# Add luci-app-amlogic
git clone --depth=1 https://github.com/ophub/luci-app-amlogic

popd

# Mod zzz-default-settings for HelmiWrt
pushd package/lean/default-settings/files
sed -i '/http/d' zzz-default-settings
sed -i '/18.06/d' zzz-default-settings
export orig_version=$(cat "zzz-default-settings" | grep DISTRIB_REVISION= | awk -F "'" '{print $2}')
export date_version=$(date -d "$(rdate -n -4 -p pool.ntp.org)" +'%Y-%m-%d')
sed -i "s/${orig_version}/${orig_version} ${date_version}/g" zzz-default-settings
sed -i "s/zh_cn/auto/g" zzz-default-settings
sed -i "s/uci set system.@system[0].timezone=CST-8/uci set system.@system[0].hostname=HelmiWrt\nuci set system.@system[0].timezone=WIB-7/g" zzz-default-settings
sed -i "s/Shanghai/Jakarta/g" zzz-default-settings
popd

# Fix mt76 wireless driver
pushd package/kernel/mt76
sed -i '/mt7662u_rom_patch.bin/a\\techo mt76-usb disable_usb_sg=1 > $\(1\)\/etc\/modules.d\/mt76-usb' Makefile
popd

# Change default shell to zsh
sed -i 's/\/bin\/ash/\/usr\/bin\/zsh/g' $HWOSDIR/etc/passwd
