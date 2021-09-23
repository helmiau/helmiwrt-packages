module("luci.controller.v2raya", package.seeall)
function index()
entry({"admin","services","v2raya"}, template("v2raya"), _("v2rayA"), 1).leaf=true
end