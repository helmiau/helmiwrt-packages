module("luci.controller.shutdown", package.seeall)
function action_poweroff()
	luci.http.redirect(luci.dispatcher.build_url('admin/status/overview'))
	luci.util.exec("/sbin/poweroff")
end
function index()  
    entry({"admin", "system", "shutdown"}, call("action_poweroff"), "Shutdown", 80).dependent=false	
end 
