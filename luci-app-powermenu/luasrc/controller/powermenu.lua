module("luci.controller.powermenu",package.seeall)
function index()
	entry({"admin", "system", "powermenu"}, cbi("powermenu"), _("Power Menu"),99)
end