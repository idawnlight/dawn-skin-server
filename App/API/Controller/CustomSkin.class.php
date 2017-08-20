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
            if (!empty($var["username"]) && !empty(current($db->get("Users.where[id={$var["username"]}]"))["skin"])) {
                header("content-type: application/json");
                $info = array("username"=>$var["username"],
                              "player_name"=>$var["username"],
                              "last_update"=>current($db->get("Users.where[id={$var["username"]}]"))["time"],
                              "textures"=>array(current($db->get("Users.where[id={$var["username"]}]"))["type"]=>current($db->get("Users.where[id={$var["username"]}]"))["skin"]));
                //print_r($info);
                if (current($db->get("Users.where[id={$var["username"]}]"))["useCape"]) {
                    $info["textures"]["cape"] = current($db->get("Users.where[id={$var["username"]}]"))["cape"];
                    $info["cape"] = current($db->get("Users.where[id={$var["username"]}]"))["cape"];
                }
                echo json_encode($info);
            } else {
                //echo $var["username"];
                header('HTTP/1.1 404 Not Found');
                header('status: 404');
                header("content-type: application/json");
                echo json_encode(array());
            }
        }

        public function res($var){
            header("content-type: image/png");
            if (file_exists("./" . "Res/" . $var["id"] . ".png")) {
                echo file_get_contents("./" . "Res/" . $var["id"] . ".png");
            } else {
                //echo "." . $GLOBALS['_C']['RouteBase'] . "/" . "Res/" . $var["id"] . ".png";
                header('HTTP/1.1 404 Not Found');
                header('status: 404');
            }
        }

    }
