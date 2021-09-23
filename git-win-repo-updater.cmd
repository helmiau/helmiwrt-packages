if exist luci-app-v2raya\root\etc\v2raya\web ( rmdir /s /q luci-app-v2raya\root\etc\v2raya\web )
git clone http://github.com/v2rayA/v2raya-web luci-app-v2raya\root\etc\v2raya\web
rmdir /s /q luci-app-v2raya\root\etc\v2raya\web\.git

if exist luci-app-mikhmon\root\www\mikhmon ( rmdir /s /q luci-app-mikhmon\root\www\mikhmon )
git clone http://github.com/laksa19/mikhmonv3 luci-app-mikhmon\root\www\mikhmon
rmdir /s /q luci-app-mikhmon\root\www\mikhmon\.git

pause