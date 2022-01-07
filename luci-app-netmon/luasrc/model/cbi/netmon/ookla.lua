-- Created by Helmi Amirudin (helmiau.com)
local NXFS = require "nixio.fs"

m = Map("Network Monitor")
s = m:section(SimpleSection, "Network Monitor")
m.pageaction = false
s.anonymous = true
m.template="netmon/ookla"

return m

