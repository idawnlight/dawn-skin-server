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
                $this->View("Public/sidebar");
                $this->View("Home/index");
                $this->View("Public/footer");
            } else {
                header("Location: {$GLOBALS["DSS"]["root"]}account");
            }


        }

    }
