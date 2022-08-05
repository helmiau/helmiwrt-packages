module("luci.controller.mikhmon4", package.seeall)
function index()
entry({"admin","services","mikhmon4"}, template("mikhmon4"), _("Mikrotik Monitor V4"), 12).leaf=true
end