module("luci.controller.openspeedtest", package.seeall)
function index()
entry({"admin","services","openspeedtest"}, template("openspeedtest"), _("OpenSpeedtest"), 14).leaf=true
end