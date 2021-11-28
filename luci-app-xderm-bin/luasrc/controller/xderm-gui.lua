module("luci.controller.xderm-gui", package.seeall)
function index()
entry({"admin","services","xderm-gui"}, template("xderm-gui"), _("Xderm Mini"), 23).leaf=true
end