<?php

use XDO\XDO;

$db = XDO::Database("System");

$GLOBALS["DSS"]["version"] = "Alpha 0.1.0";
$GLOBALS["DSS"]["root"] = explode("index.php",$_SERVER['PHP_SELF'])[0];
$GLOBALS["DSS"]["title"] = current($db->get("Config.where[name=title]"))["value"];
$GLOBALS["DSS"]["head"] = current($db->get("Config.where[name=head]"))["value"];
$GLOBALS["DSS"]["intro"] = current($db->get("Config.where[name=intro]"))["value"];
