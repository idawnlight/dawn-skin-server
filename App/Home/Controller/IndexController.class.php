<?php
    /**
     * Dawn Skin Server
     * By Dawn
     *
     */

    namespace Controller\Home;

    use X\Controller;
    use XDO\XDO;
    use X\Error;

    class IndexController extends Controller{
        public function index(){
            $db = XDO::Database("System");
            if (!$_SESSION["login"]) {
                $this->Data = array(
                        "Page" => "Index",
                        "Intro" => current($db->get("Config.where[name=intro]"))["value"]
                    );
                $this->View("Public/header");
                $this->View("Public/sidebar");
                $this->View("Home/index");
                $this->View("Public/footer");
            } else {
                header("Location: {$GLOBALS["DSS"]["root"]}account");
            }
        }

    }
