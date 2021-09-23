#!/bin/bash
rm -rf luci-app-v2raya/root/etc/v2raya
git clone https://github.com/v2rayA/v2raya-web luci-app-v2raya/root/etc/v2raya/web
rm -rf luci-app-v2raya/root/etc/v2raya/web/.git

rm -rf luci-app-mikhmon/root/www
git clone https://github.com/laksa19/mikhmonv3 luci-app-mikhmon/root/www/mikhmon
rm -rf luci-app-mikhmon/root/www/mikhmon/.git