<?php
    /**
     * Dawn Skin Server
     * By Dawn
     *
     */

    namespace Controller\API;

    use X\Controller;
    use XDO\XDO;

    class CustomSkin extends Controller{
        public function user($var){
            $db = XDO::Database("Account");
            if (empty($var["username"]) || empty(current($db->get("Users.where[id={$var["username"]}]"))["skin"])) {
                //echo $var["username"];
                header('HTTP/1.1 404 Not Found');
                header('status: 404');
                header("content-type: application/json");
                echo json_encode(array());
            } else {
                header("content-type: application/json");
                echo json_encode(array("username"=>$var["username"], "textures"=>array(current($db->get("Users.where[id={$var["username"]}]"))["type"]=>current($db->get("Users.where[id={$var["username"]}]"))["skin"])));
            }
        }

        public function res($var){
            header("content-type: image/png");
            if (file_exists("." . $GLOBALS['_C']['RouteBase'] . "/" . "Res/" . $var["id"] . ".png")) {
                echo file_get_contents("." . $GLOBALS['_C']['RouteBase'] . "/" . "Res/" . $var["id"] . ".png");
            } else {
                //echo "." . $GLOBALS['_C']['RouteBase'] . "/" . "Res/" . $var["id"] . ".png";
                header('HTTP/1.1 404 Not Found');
                header('status: 404');
            }
        }

    }
