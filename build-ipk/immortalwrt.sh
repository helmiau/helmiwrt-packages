#!/bin/bash
#=================================================
# Description: DIY script
# Lisence: MIT
# Author: P3TERX
# Blog: https://p3terx.com
#=================================================

# Devices platforms
echo "milogx: Detected platform [$PLATFORM], using [$PLATFORM] config..."
CFGOW="$OPENWRT_ROOT_PATH/.config"
if [[ $PLATFORM == *"armvirt/32"* ]]; then
	cat << 'EOF' > "$CFGOW"

CONFIG_TARGET_armvirt=y
CONFIG_TARGET_armvirt_64=y
CONFIG_TARGET_armvirt_64_Default=y

EOF
elif [[ $PLATFORM == *"armvirt/64"* ]]; then
	cat << 'EOF' > "$CFGOW"

CONFIG_TARGET_armvirt=y
CONFIG_TARGET_armvirt_64=y
CONFIG_TARGET_armvirt_64_Default=y

EOF
elif [[ $PLATFORM == *"bcm27xx/bcm2708"* ]]; then
	cat << 'EOF' > "$CFGOW"

CONFIG_TARGET_bcm27xx=y
CONFIG_TARGET_bcm27xx_bcm2708=y
CONFIG_TARGET_bcm27xx_bcm2708_DEVICE_rpi=y

EOF
elif [[ $PLATFORM == *"bcm27xx/bcm2709"* ]]; then
	cat << 'EOF' > "$CFGOW"

CONFIG_TARGET_bcm27xx=y
CONFIG_TARGET_bcm27xx_bcm2709=y
CONFIG_TARGET_bcm27xx_bcm2709_DEVICE_rpi-2=y

EOF
elif [[ $PLATFORM == *"bcm27xx/bcm2710"* ]]; then
	cat << 'EOF' > "$CFGOW"

CONFIG_TARGET_bcm27xx=y
CONFIG_TARGET_bcm27xx_bcm2710=y
CONFIG_TARGET_bcm27xx_bcm2710_DEVICE_rpi-3=y

EOF
elif [[ $PLATFORM == *"bcm27xx/bcm2711"* ]]; then
	cat << 'EOF' > "$CFGOW"

CONFIG_TARGET_bcm27xx=y
CONFIG_TARGET_bcm27xx_bcm2711=y
CONFIG_TARGET_bcm27xx_bcm2711_DEVICE_rpi-4=y

EOF
elif [[ $PLATFORM == *"rockchip/armv8"* ]]; then
	cat << 'EOF' > "$CFGOW"

CONFIG_TARGET_rockchip=y
CONFIG_TARGET_rockchip_armv8=y
CONFIG_TARGET_MULTI_PROFILE=y
CONFIG_TARGET_DEVICE_rockchip_armv8_DEVICE_friendlyarm_nanopi-r2c=y
CONFIG_TARGET_DEVICE_rockchip_armv8_DEVICE_friendlyarm_nanopi-r2s=y
CONFIG_TARGET_DEVICE_rockchip_armv8_DEVICE_friendlyarm_nanopi-r4s=y
CONFIG_TARGET_DEVICE_rockchip_armv8_DEVICE_pine64_rockpro64=n
CONFIG_TARGET_DEVICE_rockchip_armv8_DEVICE_radxa_rock-pi-4=n
CONFIG_TARGET_DEVICE_rockchip_armv8_DEVICE_xunlong_orangepi-r1-plus=y
CONFIG_TARGET_DEVICE_rockchip_armv8_DEVICE_xunlong_orangepi-r1-plus-lts=y
CONFIG_TARGET_ALL_PROFILES=y

EOF
elif [[ $PLATFORM == *"sunxi/cortexa7"* ]]; then
	cat << 'EOF' > "$CFGOW"

CONFIG_TARGET_sunxi=y
CONFIG_TARGET_sunxi_cortexa7=y
CONFIG_TARGET_MULTI_PROFILE=y
CONFIG_TARGET_ALL_PROFILES=y
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_friendlyarm_nanopi-m1-plus=y
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_friendlyarm_nanopi-neo=y
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_friendlyarm_nanopi-neo-air=y
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_friendlyarm_nanopi-r1=y
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_friendlyarm_zeropi=y
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_xunlong_orangepi-2=y
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_xunlong_orangepi-one=y
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_xunlong_orangepi-pc=y
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_xunlong_orangepi-pc-plus=y
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_xunlong_orangepi-plus=y
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_xunlong_orangepi-r1=y
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_xunlong_orangepi-zero=y

CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_cubietech_cubieboard2=n
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_cubietech_cubietruck=n
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_lamobo_lamobo-r1=n
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_lemaker_bananapi=n
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_lemaker_bananapro=n
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_linksprite_pcduino3=n
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_linksprite_pcduino3-nano=n
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_mele_m9=n
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_olimex_a20-olinuxino-lime=n
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_olimex_a20-olinuxino-lime2=n
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_olimex_a20-olinuxino-lime2-emmc=n
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_olimex_a20-olinuxino-micro=n
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_sinovoip_bananapi-m2-ultra=n
CONFIG_TARGET_DEVICE_sunxi_cortexa7_DEVICE_sinovoip_bananapi-m2-plus=n

EOF
elif [[ $PLATFORM == *"sunxi/cortexa53"* ]]; then
	cat << 'EOF' > "$CFGOW"

CONFIG_TARGET_sunxi=y
CONFIG_TARGET_sunxi_cortexa53=y
CONFIG_TARGET_MULTI_PROFILE=y
CONFIG_TARGET_ALL_PROFILES=y
CONFIG_TARGET_DEVICE_sunxi_cortexa53_DEVICE_friendlyarm_nanopi-neo-plus2=y
CONFIG_TARGET_DEVICE_sunxi_cortexa53_DEVICE_friendlyarm_nanopi-neo2=y
CONFIG_TARGET_DEVICE_sunxi_cortexa53_DEVICE_friendlyarm_nanopi-r1s-h5=y
CONFIG_TARGET_DEVICE_sunxi_cortexa53_DEVICE_xunlong_orangepi-one-plus=y
CONFIG_TARGET_DEVICE_sunxi_cortexa53_DEVICE_xunlong_orangepi-pc2=y
CONFIG_TARGET_DEVICE_sunxi_cortexa53_DEVICE_xunlong_orangepi-zero-plus=y

CONFIG_TARGET_DEVICE_sunxi_cortexa53_DEVICE_libretech_all-h3-cc-h5=n
CONFIG_TARGET_DEVICE_sunxi_cortexa53_DEVICE_olimex_a64-olinuxino=n
CONFIG_TARGET_DEVICE_sunxi_cortexa53_DEVICE_olimex_a64-olinuxino-emmc=n
CONFIG_TARGET_DEVICE_sunxi_cortexa53_DEVICE_pine64_pine64-plus=n
CONFIG_TARGET_DEVICE_sunxi_cortexa53_DEVICE_pine64_sopine-baseboard=n

EOF
elif [[ $PLATFORM == *"x86/64"* ]]; then
	cat << 'EOF' > "$CFGOW"

CONFIG_TARGET_x86=y
CONFIG_TARGET_x86_64=y
CONFIG_TARGET_x86_64_DEVICE_generic=y

EOF
elif [[ $PLATFORM == *"x86/generic"* ]]; then
	cat << 'EOF' > "$CFGOW"

CONFIG_TARGET_x86=y
CONFIG_TARGET_x86_generic=y
CONFIG_TARGET_x86_generic_DEVICE_generic=y

EOF
fi

# Clone community packages to package/community
mkdir package/community
pushd package/community

# Add Argon theme configuration
git clone --depth=1 https://github.com/jerrykuku/luci-app-argon-config

# Add official OpenClash dev branch source
# git clone --depth=1 -b dev https://github.com/vernesong/OpenClash
svn co https://github.com/vernesong/OpenClash/branches/dev/luci-app-openclash vernesong/OpenClash

# Add modeminfo
# git clone --depth=1 https://github.com/koshev-msk/luci-app-modeminfo

# Add luci-app-smstools3
# git clone --depth=1 https://github.com/koshev-msk/luci-app-smstools3

# Add luci-app-mmconfig : configure modem cellular bands via mmcli utility
# git clone --depth=1 https://github.com/koshev-msk/luci-app-mmconfig

# Add support for Fibocom L860-GL l850/l860 ncm
# git clone --depth=1 https://github.com/koshev-msk/xmm-modem

if [[ $REPO_BRANCH == *"21.02"* ]]; then
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
	sed -i 's/luci-app-3ginfo-lite/luci-app-3ginfo/g' "$CFGOW"
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

# Rename hostname to HelmiWrt
[ -f package/base-files/files/bin/config_generate ] && sed -i 's/ImmortalWrt/HelmiWrt/g' package/base-files/files/bin/config_generate
echo "Script Executed-Done!!!!!"

#-----------------------------------------------------------------------------
#   End of @helmiau terminal scripts additionals menu
#-----------------------------------------------------------------------------
