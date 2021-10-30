module("luci.controller.tinyfm", package.seeall)
function index()
entry({"admin","nas","tinyfm"}, template("tinyfm"), _("Tiny File Manager"), 55).leaf=true
end