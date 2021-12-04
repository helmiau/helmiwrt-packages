module("luci.controller.wegare", package.seeall)
function index()
entry({"admin","services","wegare"}, template("wegare"), _("Wegare STL"), 22).leaf=true
end