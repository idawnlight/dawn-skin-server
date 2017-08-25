<?php

    namespace Controller\API;

    use X\Controller;
    use XDO\XDO;

    class UniSkin extends Controller{
        public function user($var){
            $db = XDO::Database("Account");
            if (!empty($var["username"]) && !empty(current($db->get("Users.where[id={$var["username"]}]"))["skin"])) {
                header("content-type: application/json; charset=utf-8");

                $type = current($db->get("Users.where[id={$var["username"]}]"))["type"];
                $skin = current($db->get("Users.where[id={$var["username"]}]"))["skin"];
                $cape = current($db->get("Users.where[id={$var["username"]}]"))["cape"];

                $info->player_name       = $var["username"];
                $info->last_update       = current($db->get("Users.where[id={$var["username"]}]"))["time"];
                $info->model_preference  = array($type, "cape");
                $info->skins             = array(
                                             $type  => $skin,
                                             "cape" => null
                                           );
                $info->cape              = null;
                
                if (current($db->get("Users.where[id={$var["username"]}]"))["useCape"]) {
                    $info->skins["cape"] = $cape;
                    $info->cape          = $cape;
                }

                echo json_encode($info, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            } else {
                header('HTTP/1.1 404 Not Found');
                header('status: 404');
                header("content-type: application/json");
                echo json_encode(array());
            }
        }
    }
