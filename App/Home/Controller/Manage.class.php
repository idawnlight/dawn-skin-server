<?php
    /**
     * Dawn Skin Server
     * By Dawn
     *
     */

    namespace Controller\Home;

    use X\Controller;
    use XDO\XDO;

    class Manage extends Controller{

        public function main() {
            if ($_SESSION["login"]) {
                $db = XDO::Database("Account");
                //$db->clearCache("Users");
                $this->Data = array(
                        "Version" => $GLOBALS["DSS"]['Version'],
                        "Page" => "Manage",
                        "name" => $_SESSION["name"],
                        "id" => current($db->get("Users.where[name={$_SESSION["name"]}]"))["id"],
                        "skin" => current($db->get("Users.where[name={$_SESSION["name"]}]"))["skin"],
                        "type" => current($db->get("Users.where[name={$_SESSION["name"]}]"))["type"]
                    );
                $this->View("Public/header");
                $this->View("Home/manage");
            } else {
                $this->View("Public/header");
                $this->Data = array(
                        "Version" => $GLOBALS["DSS"]['Version'],
                        "Page" => "Manage",
                        "msg" => "未登陆，<a href=\"account/login\">登陆</a>"
                    );
                $this->View("Home/msg");
            }
        }

    }
