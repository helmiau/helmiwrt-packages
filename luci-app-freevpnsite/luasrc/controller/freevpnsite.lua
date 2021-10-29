module("luci.controller.freevpnsite", package.seeall)
function index()
entry({"admin","services","freevpnsite"}, template("freevpnsite"), _("VPN Site List"), 99).leaf=true
end