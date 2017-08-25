<?php

    namespace Controller\Home;

    use X\Controller;
    use XDO\XDO;

    class Manage extends Controller{

        public function main() {
            if ($_SESSION["login"]) {
                $db = XDO::Database("Account");
                $this->Data = array(
                        "Page" => "Manage",
                        "name" => $_SESSION["name"],
                        "id" => current($db->get("Users.where[name={$_SESSION["name"]}]"))["id"]
                    );
                $this->View("Public/header");
                $this->View("Public/sidebar-manage");
                echo "<script>$(\"div.mdui-collapse-item:eq(0)\").addClass(\"mdui-collapse-item-open\");</script>";
                echo "<script>$(\"a.mdui-list-item:eq(0)\").addClass(\"mdui-list-item-active\");</script>";
                $this->View("Account/index");
                $this->View("Public/footer");
            } else {
                header("Location: {$GLOBALS["DSS"]["root"]}account/login");
            }
        }

        public function edit() {
            if ($_SESSION["login"]) {
                if (isset($_POST["id"])) {
                    $id = test_input($_POST["id"]);
                    if (!empty($id)) {
                        $db = XDO::Database("Account");
                        if (empty($db->get("Users.where[id={$id}]"))){
                            $db->put("Users.where[name={$_SESSION["name"]}]",array("id"=>$id));
                            header("content-type: application/json");
                            echo '{"status": "success"}';
                        } else {
                            header("content-type: application/json");
                            echo '{"status": "used"}';
                        }
                    } else {
                        header("content-type: application/json");
                        echo '{"status": "empty"}';
                    }
                } else {
                    header("content-type: application/json");
                    echo '{"status": "empty"}';
                }
            } else {
                header("Location: {$GLOBALS["DSS"]["root"]}account/login");
            }
        }

        public function skin() {
            if ($_SESSION["login"]) {
                $db = XDO::Database("Account");
                $this->Data = array(
                        "Page" => "Manage",
                        "name" => $_SESSION["name"],
                        "id" => current($db->get("Users.where[name={$_SESSION["name"]}]"))["id"],
                        "skin" => current($db->get("Users.where[name={$_SESSION["name"]}]"))["skin"]
                    );
                $this->View("Public/header");
                $this->View("Public/sidebar-manage");
                echo "<script>$(\"div.mdui-collapse-item:eq(0)\").addClass(\"mdui-collapse-item-open\");</script>";
                echo "<script>$(\"a.mdui-list-item:eq(1)\").addClass(\"mdui-list-item-active\");</script>";
                $this->View("Account/skin");
                $this->View("Public/footer");
            } else {
                header("Location: {$GLOBALS["DSS"]["root"]}account/login");
            }
        }

        public function cape() {
            if ($_SESSION["login"]) {
                $db = XDO::Database("Account");
                $this->Data = array(
                        "Page" => "Manage",
                        "name" => $_SESSION["name"],
                        "id" => current($db->get("Users.where[name={$_SESSION["name"]}]"))["id"],
                        "cape" => current($db->get("Users.where[name={$_SESSION["name"]}]"))["cape"],
                        "useCape" => current($db->get("Users.where[name={$_SESSION["name"]}]"))["useCape"]
                    );
                if (current($db->get("Users.where[name={$_SESSION["name"]}]"))["useCape"]) {
                    $this->Data["here"] = "checked";
                }
                $this->View("Public/header");
                $this->View("Public/sidebar-manage");
                echo "<script>$(\"div.mdui-collapse-item:eq(0)\").addClass(\"mdui-collapse-item-open\");</script>";
                echo "<script>$(\"a.mdui-list-item:eq(2)\").addClass(\"mdui-list-item-active\");</script>";
                $this->View("Account/cape");
                $this->View("Public/footer");
            } else {
                header("Location: {$GLOBALS["DSS"]["root"]}account/login");
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
