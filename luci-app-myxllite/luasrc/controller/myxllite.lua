module("luci.controller.myxllite", package.seeall)
function index()
entry({"admin","status","myxllite"}, template("myxllite"), _("myXL Lite"), 13).leaf=true
end
