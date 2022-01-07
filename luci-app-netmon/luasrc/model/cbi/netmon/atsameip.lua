-- Created by Helmi Amirudin (helmiau.com)
local NXFS = require "nixio.fs"

m = Map("AtSameIP")
s = m:section(SimpleSection, "AtSameIP")
m.pageaction = false
s.anonymous = true
m.template="netmon/atsameip"

return m

