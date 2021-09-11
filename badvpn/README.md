#### openwrt_badvpn

<h4>support :</h4>
<pre>
<ul>
<li>NSS</li>
<li>NSPR</li>
<li>badvpn-server</li>
<li>badvpn-client</li>
<li>badvpn-tun2socks</li>
<li>badvpn-udpgw</li>
<li>badvpn-tunctl</li>
<li>badvpn-ncd</li>
<li>badvpn-ncd-request</li>
</ul>
</pre>

#### Build an IPK file

Use commands below to build badvpn ipk
```
git clone git://git.lede-project.org/source.git
cd source

./scripts/feeds update -a
./scripts/feeds install -a

git clone https://github.com/helmiau/helmiwrt-packages
cp -rf helmiau/helmiwrt-packages/badvpn package/
rm -rf helmiwrt-packages/

make defconfig
make menuconfig
```


- Set **Target System** and **Target Profile** for your target device.
- badvpn will be available at :
	- "Network" => "VPN" => "badvpn"
- Packages are selected when there is a <*> in front of the name (hit the space bar twice).
- Finally - build the image:
```
make
```

You can now flash your router using the correct image file inside ./bin/targets/. The images usually contain all build packages already.
The single *.ipk packages are located in ./bin/packages, in case you want to install them on other devices.

To install/update a package, transfer the ipk file to your target device to /tmp/ using scp.
The package can then be installed calling e.g. `opkg install badvpn_1.999.130-1_mips_24kc.ipk`.
