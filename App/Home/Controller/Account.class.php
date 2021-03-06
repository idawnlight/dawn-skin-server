<?php
    /**
     * Dawn Skin Server
     * By Dawn
     *
     */

    namespace Controller\Home;

    use X\Controller;
    use XDO\XDO;

    class Account extends Controller{
        public function reg(){
            if ($_SESSION["login"]) {
                header("Location: {$GLOBALS["DSS"]["root"]}account");
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = test_input($_POST["name"]);
                $password = test_input($_POST["password"]);
                $id = test_input($_POST["id"]);
                $passwordVer = test_input($_POST["passwordVer"]);
                if (empty($name) || empty($password) || empty($id)) {
                    header("content-type: application/json");
                    echo '{"status": "empty"}';
                } else {
                    $db = XDO::Database("Account");
                    if (empty($db->get("Users.where[name={$name}]"))) {
                        if (empty($db->get("Users.where[id={$id}]"))) {
                            if ($passwordVer == $password) {
                                $db->ins("Users", array("name"=>$name, "id"=>$id,
                                                        "password"=>password_hash($password, PASSWORD_DEFAULT),
                                                        "skin"=>"83af9d073270f3d18917ff0093d7a3161868f9c072d1e6605b3a2ca7e859b5eb",
                                                        "type"=>"default",
                                                        "cape"=>"7921a79d51b87781c94a285e1e8c32a07058960048e473f46d72b65f77f44641",
                                                        "useCape"=>false,
                                                        "time"=>time(),
                                                        "permissions"=>"user"));
                                $_SESSION["login"] = true;
                                $_SESSION["name"] = $name;
                                header("content-type: application/json");
                                echo '{"status": "success"}';
                            } else {
                                header("content-type: application/json");
                                echo '{"status": "ver"}';
                            }
                        } else {
                            header("content-type: application/json");
                            echo '{"status": "id"}';
                        }
                    } else {
                        header("content-type: application/json");
                        echo '{"status": "name"}';
                    }
                }
            } else {
                $this->Data = array(
                        "Version" => $GLOBALS["DSS"]['Version'],
                        "Page" => "Register"
                    );
                $this->View("Public/header");
                $this->View("Public/sidebar");
                $this->View("Account/reg");
                echo "<script>$(\"div.mdui-collapse-item:eq(0)\").addClass(\"mdui-collapse-item-open\");</script>";
                echo "<script>$(\"a.mdui-list-item:eq(1)\").addClass(\"mdui-list-item-active\");</script>";
                $this->View("Public/footer");
            }

        }

        public function login(){
            if ($_SESSION["login"]) {
                header("Location: {$GLOBALS["DSS"]["root"]}account");
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = test_input($_POST["name"]);
                $password = test_input($_POST["password"]);
                if (empty($name) || empty($password)) {
                    header("content-type: application/json");
                    echo '{"status": "empty"}';
                } else {
                    $db = XDO::Database("Account");
                    if (!empty($db->get("Users.where[name={$name}]"))) {
                        if (password_verify($password, current($db->get("Users.where[name={$name}]"))["password"])) {
                            header("content-type: application/json");
                            echo '{"status": "success"}';
                            $_SESSION["name"] = $name;
                            $_SESSION["login"] = true;
                        } else {
                            header("content-type: application/json");
                            echo '{"status": "fail"}';
                        }
                    } else {
                        header("content-type: application/json");
                        echo '{"status": "fail"}';
                    }
                }
            } else {
                $this->Data = array(
                        "Version" => $GLOBALS["DSS"]['Version'],
                        "Page" => "Login"
                    );
                $this->View("Public/header");
                $this->View("Public/sidebar");
                $this->View("Account/login");
                echo "<script>$(\"div.mdui-collapse-item:eq(0)\").addClass(\"mdui-collapse-item-open\");</script>";
                echo "<script>$(\"a.mdui-list-item:eq(0)\").addClass(\"mdui-list-item-active\");</script>";
                $this->View("Public/footer");
            }

        }

        public function logout() {
            $_SESSION["login"] = false;
            header("Location: {$GLOBALS["DSS"]["root"]}");
        }

    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
