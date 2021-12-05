module("luci.controller.tinyfm", package.seeall)
function index()
	entry({"admin", "nas"}, firstchild(), "NAS", 44).dependent=false
	entry({"admin", "nas", "tinyfm"}, template("tinyfm"), _("Tiny File Manager"), 55).dependent=true
end