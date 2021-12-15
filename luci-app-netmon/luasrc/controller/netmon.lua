-- Created by Helmi Amirudin (helmiau.com)

module("luci.controller.netmon", package.seeall)

function index()
	local page = entry({"admin", "status", "netmon"}, alias("admin", "status", "netmon", "status"), _("Network Monitor"), 14)
	page.dependent = true
	page.acl_depends = { "luci-app-netmon" }

	entry({"admin", "status", "netmon", "status"}, cbi("netmon/status"), _("Status"), 1).leaf = true
	entry({"admin", "status", "netmon", "config"}, cbi("netmon/config"), _("Configuration"), 2).leaf = true
end
