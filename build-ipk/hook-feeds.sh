#!/bin/bash
#=================================================
# File name: hook-feeds.sh
# Author: Helmi Amirudin
# Blog: https://helmiau.com
#=================================================
#--------------------------------------------------------
#   If you use some codes frome here, please give credit to www.helmiau.com
#--------------------------------------------------------

# Clone Lean's feeds
mkdir customfeeds
git clone --depth=1 https://github.com/coolsnowwolf/packages customfeeds/packages
git clone --depth=1 https://github.com/coolsnowwolf/luci customfeeds/luci

# Clone ImmortalWrt's feeds
pushd customfeeds
mkdir temp
git clone --depth=1 https://github.com/immortalwrt/packages -b openwrt-18.06 temp/packages
git clone --depth=1 https://github.com/immortalwrt/luci -b openwrt-18.06-k5.4 temp/luci

# Remove lede argon theme
rm -rf luci/themes/luci-theme-argon

# Fix stubby: add libunbound to stubby package
sed -i 's#+ca-certs#+ca-certs +libunbound#g' packages/net/stubby/Makefile

# Clearing temp directory
rm -rf temp
popd

# Set to local feeds
pushd customfeeds/packages
export packages_feed="$(pwd)"
popd
pushd customfeeds/luci
export luci_feed="$(pwd)"
popd
sed -i '/src-git packages/d' feeds.conf.default
echo "src-link packages $packages_feed" >> feeds.conf.default
sed -i '/src-git luci/d' feeds.conf.default
echo "src-link luci $luci_feed" >> feeds.conf.default

# Update feeds
./scripts/feeds update -a
./scripts/feeds install -a
