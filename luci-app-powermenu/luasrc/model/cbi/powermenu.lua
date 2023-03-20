require("luci.sys")

m = SimpleForm("powermenu", translate("Power Menu"),
	translate("Shutdown/restart your device"))

s = m:section(SimpleSection)

button_shutdown = s:option (Button, "button_shutdown", translate("Shutdown"), translatef("Please wait for the device to shut down"))
button_shutdown.inputtitle = translate ("Shutdown")
button_shutdown.write = function()
	luci.sys.call("sync && poweroff > /dev/null")
end

button_reboot = s:option (Button, "button_reboot", translate("Reboot"), translatef("Please wait a minutes until the device restart"))
button_reboot.inputtitle = translate ("Reboot")
button_reboot.write = function()
	luci.sys.call("sync && reboot > /dev/null")
end

m.reset  = false
m.submit  = false

return m