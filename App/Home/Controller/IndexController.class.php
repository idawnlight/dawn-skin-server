<?php
    /**
     * Dawn Skin Server
     * By Dawn
     *
     */

    namespace Controller\Home;

    use X\Controller;

    class IndexController extends Controller{
        public function index(){

            if (!$_SESSION["login"]) {
                $this->Data = array(
                        "Version" => $GLOBALS["DSS"]['Version'],
                        "Page" => "Index"
                    );
                $this->View("Public/header");
                $this->View("Home/index");
            } else {
                $this->Data = array(
                        "Version" => $GLOBALS["DSS"]['Version'],
                        "Page" => "Index",
                        "msg" => "已登陆，<a href=\"account\">管理</a>，<a href=\"account/logout\">登出</a>"
                    );
                $this->View("Public/header");
                $this->View("Home/msg");
            }


        }

    }
