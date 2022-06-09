-- Created by Helmi Amirudin (helmiau.com)

module("luci.controller.netmon", package.seeall)

function index()
	entry({"admin", "status", "netmon"}, alias("admin", "status", "netmon", "status"), _("Network Monitor"), 14).dependent = false

	entry({"admin", "status", "netmon", "status"}, cbi("netmon/status"), _("Status"), 1).leaf = true
	entry({"admin", "status", "netmon", "config"}, cbi("netmon/config"), _("Configuration"), 2).leaf = true
	entry({"admin", "status", "netmon", "myip"}, cbi("netmon/myip"), _("My IP Information"), 3).leaf = true
	-- entry({"admin", "status", "netmon", "ookla"}, cbi("netmon/ookla"), _("Speedtest Ookla"), 4).leaf = true
	entry({"admin", "status", "netmon", "openspeedtest"}, cbi("netmon/openspeedtest"), _("OpenSpeedTest"), 5).leaf = true
	entry({"admin", "status", "netmon", "twilio"}, cbi("netmon/twilio"), _("Twilio Test"), 6).leaf = true
	entry({"admin", "status", "netmon", "atsameip"}, cbi("netmon/atsameip"), _("AtSameIP"), 7).leaf = true
	entry({"admin", "status", "netmon", "threatcrowd"}, cbi("netmon/threatcrowd"), _("Threat Crowd"), 8).leaf = true
end
