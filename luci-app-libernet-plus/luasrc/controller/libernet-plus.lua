module("luci.controller.libernet-plus", package.seeall)
function index()
entry({"admin","services","libernet-plus"}, template("libernet-plus"), _("Libernet Plus"), 11).leaf=true
end