module("luci.controller.tinyfilemanager", package.seeall)
function index()
entry({"admin","nas","tinyfilemanager"}, template("tinyfilemanager"), _("Tiny File Manager"), 55).leaf=true
end