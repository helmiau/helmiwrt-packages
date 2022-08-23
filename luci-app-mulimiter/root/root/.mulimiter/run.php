<?php
$dir = "/root/.mulimiter";

$saved_rules    = str_replace("\r\n", "\n", shell_exec("cat $dir/save"));
$saved_rules    = trim($saved_rules, "\n");
$saved_rules    = explode("\n", $saved_rules);

foreach ($saved_rules as $sv) {
    $rule = str_replace("-A ", "-I ", $sv);
    shell_exec("iptables $rule");
}
