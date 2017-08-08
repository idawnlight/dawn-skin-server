<?php

use XDO\XDO;

$db = XDO::Database("System");

$GLOBALS["DSS"]["version"] = "Alpha 0.1.0";
if ($GLOBALS['_C']['RouteBase']=="") {
	$GLOBALS["DSS"]["root"] = "/";
} else {
	$GLOBALS["DSS"]["root"] = $GLOBALS['_C']['RouteBase']."/";
}
$GLOBALS["DSS"]["title"] = current($db->get("Config.where[name=title]"))["value"];
$GLOBALS["DSS"]["head"] = current($db->get("Config.where[name=head]"))["value"];
$GLOBALS["DSS"]["intro"] = current($db->get("Config.where[name=intro]"))["value"];
