-- Created by Helmi Amirudin (helmiau.com)
local NXFS = require "nixio.fs"

m = Map("threatcrowd")
s = m:section(SimpleSection, "threatcrowd")
m.pageaction = false
s.anonymous = true
m.template="netmon/threatcrowd"

return m

