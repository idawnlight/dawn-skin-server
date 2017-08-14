<?php

use XDO\XDO;
use X\Error;


$db = XDO::Database("System");

$GLOBALS["DSS"]["version"] = "Alpha 0.1.1";
if ($GLOBALS['_C']['RouteBase']=="") {
	$GLOBALS["DSS"]["root"] = "/";
} else {
	$GLOBALS["DSS"]["root"] = $GLOBALS['_C']['RouteBase']."/";
}
$GLOBALS["DSS"]["title"] = current($db->get("Config.where[name=title]"))["value"];
$GLOBALS["DSS"]["head"] = current($db->get("Config.where[name=head]"))["value"];
if (!is_writeable(DatDir . "Models.json")) {
    Error::HTTP_E(503, "没有写入权限");
}
