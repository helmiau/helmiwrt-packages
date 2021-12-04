module("luci.controller.libernet", package.seeall)
function index()
entry({"admin","services","libernet"}, template("libernet"), _("Libernet"), 11).leaf=true
end