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

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = test_input($_POST["name"]);
                //echo $name;
                //return;
                $password = test_input($_POST["password"]);
                $id = test_input($_POST["id"]);
            } else {
                $this->Data = array(
                        "Version" => $GLOBALS["DSS"]['Version'],
                        "Page" => "Register"
                    );
                $this->View("Public/header");
                return $this->View("Home/reg");
            }

            if (empty($name) || empty($password) || empty($id)) {
                $this->Data = array(
                        "Version" => $GLOBALS["DSS"]['Version'],
                        "Page" => "Register"
                    );
                $this->View("Public/header");
                return $this->View("Home/reg");
            } else {
                //echo "test";
                $db = XDO::Database("Account"); //"Test" is the ModelName. We include a Test Model in the `Data` branch.
                //print_r($db->get("Users.where[name={$_POST["name"]}]"));  //Get the Data from Config table.
                if (empty($db->get("Users.where[name={$name}]")) && empty($db->get("Users.where[id={$id}]"))) {
                    $db->ins("Users", array("name"=>$name, "id"=>$id, "password"=>password_hash($password, PASSWORD_DEFAULT), "skin"=>"83af9d073270f3d18917ff0093d7a3161868f9c072d1e6605b3a2ca7e859b5eb", "type"=>"default"));
                    $_SESSION["login"] = true;
                    $_SESSION["name"] = $name;
                    $this->Data = array(
                            "Version" => $GLOBALS["DSS"]['Version'],
                            "msg" => "注册成功，<a href=\"../account\">管理</a>",
                            "Page" => "Register"
                        );
                    $this->View("Public/header");
                    return $this->View("Home/msg");
                } else {
                    $this->Data = array(
                            "Version" => $GLOBALS["DSS"]['Version'],
                            "msg" => "用户名已被使用，重新<a href=\"./reg\">注册</a>",
                            "Page" => "Register"
                        );
                    $this->View("Public/header");
                    return $this->View("Home/msg");
                }
                //$db->clearCache;
                //$db->ins("Users", array("name"=>$_POST["name"], "password"=>password_hash($_POST["password"], PASSWORD_DEFAULT)));
                //$db->put("Users.where[name=root]", array("name"=>"Dawn"));
                //$db->del("Users.where[name=root]");
                //print_r($db->get("Users")); //Get the Data from #1 of Config Table
                //print_r($db->get("Users.where[name=root]"));
                //header("Location: /{$GLOBALS['_C']['RouteBase']}");
            }

        }

        public function login(){

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = test_input($_POST["name"]);
                $password = test_input($_POST["password"]);
            } else {
                $this->Data = array(
                        "Version" => $GLOBALS["DSS"]['Version']
                    );
                $this->View("Public/header");
                return $this->View("Home/login");
            }

            if (empty($name) || empty($password)) {
                $this->Data = array(
                        "Version" => $GLOBALS["DSS"]['Version']
                    );
                return $this->View("Home/login");
            } else {
                //echo "test";
                $db = XDO::Database("Account"); //"Test" is the ModelName. We include a Test Model in the `Data` branch.
                //print_r($db->get("Users.where[name={$_POST["name"]}]"));  //Get the Data from Config table.
                if (!empty($db->get("Users.where[name={$name}]"))) {
                    if (password_verify($password, current($db->get("Users.where[name={$name}]"))["password"])) {
                    //if (true) {
                        //print_r($db->get("Users.where[name={$name}]"));
                        //echo "true";
                        $this->View("Public/header");
                        $this->Data = array(
                                "Version" => $GLOBALS["DSS"]['Version'],
                                "msg" => "登陆成功，<a href=\"../account\">管理</a>"
                            );
                            $_SESSION["name"] = $name;
                            $_SESSION["login"] = true;
                        return $this->View("Home/msg");
                    } else {
                        //print_r(current($db->get("Users.where[name={$name}]"))["password"]) ;
                        //echo "\n";
                        //echo password_hash($password, PASSWORD_DEFAULT);
                        //return;
                        $this->View("Public/header");
                        $this->Data = array(
                                "Version" => $GLOBALS["DSS"]['Version'],
                                "msg" => "账号或密码错误，<a href=\"./login\">重试</a>"
                            );
                        return $this->View("Home/msg");
                    }
                } else {
                    $this->View("Public/header");
                    $this->Data = array(
                            "Version" => $GLOBALS["DSS"]['Version'],
                            "msg" => "账号或密码错误，<a href=\"./login\">重试</a>"
                        );
                    return $this->View("Home/msg");
                }
                //$db->clearCache;
                //$db->ins("Users", array("name"=>$_POST["name"], "password"=>password_hash($_POST["password"], PASSWORD_DEFAULT)));
                //$db->put("Users.where[name=root]", array("name"=>"Dawn"));
                //$db->del("Users.where[name=root]");
                //print_r($db->get("Users")); //Get the Data from #1 of Config Table
                //print_r($db->get("Users.where[name=root]"));
                //header("Location: /{$GLOBALS['_C']['RouteBase']}");
            }

        }

        public function logout() {
            $_SESSION["login"] = false;
            $this->Data = array(
                    "Version" => $GLOBALS["DSS"]['Version'],
                    "msg" => "成功登出，<a href=\"../../\">返回首页</a>",
                    "Page" => "Logout"
                );
            $this->View("Public/header");
            return $this->View("Home/msg");
        }

    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
