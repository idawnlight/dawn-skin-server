<?php

    namespace Controller\API;

    use X\Controller;
    use XDO\XDO;

    class CustomSkin extends Controller{
        public function user($var){
            $db = XDO::Database("Account");
            if (!empty($var["username"]) && !empty(current($db->get("Users.where[id={$var["username"]}]"))["skin"])) {
                header("content-type: application/json; charset=utf-8");

                $type = current($db->get("Users.where[id={$var["username"]}]"))["type"];
                $skin = current($db->get("Users.where[id={$var["username"]}]"))["skin"];
                $cape = current($db->get("Users.where[id={$var["username"]}]"))["cape"];

                $info->username = $var["username"];
                $info->textures = array(
                                    $type  => $skin,
                                    "cape" => null
                                  );

                if (current($db->get("Users.where[id={$var["username"]}]"))["useCape"]) {
                    $info->textures["cape"] = $cape;
                }

                echo json_encode($info, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
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
