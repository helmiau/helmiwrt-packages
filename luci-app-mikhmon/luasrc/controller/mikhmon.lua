module("luci.controller.mikhmon", package.seeall)
function index()
entry({"admin","services","mikhmon"}, template("mikhmon"), _("Mikrotik Monitor"), 1).leaf=true
end