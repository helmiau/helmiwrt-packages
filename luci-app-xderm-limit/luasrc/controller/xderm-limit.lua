module("luci.controller.xderm-limit", package.seeall)
function index()
entry({"admin","services","xderm-limit"}, template("xderm-limit"), _("Xderm Limiter"), 1).leaf=true
end