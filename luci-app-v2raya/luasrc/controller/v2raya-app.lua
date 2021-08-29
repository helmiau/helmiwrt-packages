module("luci.controller.v2raya-app", package.seeall)
function index()
entry({"admin","services","v2raya-app"}, template("v2raya-app"), _("v2rayA"), 1).leaf=true
end