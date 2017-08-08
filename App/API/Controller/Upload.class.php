<?php
    /**
     * Dawn Skin Server
     * By Dawn
     *
     */

    namespace Controller\API;

    use X\Controller;
    use XDO\XDO;

    class Upload extends Controller{
        public function skin(){

            if ($_SESSION["login"]) {
                if (($_FILES["file"]["type"] == "image/png") && ($_FILES["file"]["size"] < 200000)){
                    if ($_FILES["file"]["error"] > 0) {
                        echo "Error: " . $_FILES["file"]["error"] . "<br />";
                    } else {
                        if (isset($_POST["alex"]) && $_POST["alex"] == "on") {
                            $type = "slim";
                        } else {
                            $type = "default";
                        }
                        $name = hash("sha256", file_get_contents($_FILES["file"]["tmp_name"]));
                        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                        echo "Type: " . $_FILES["file"]["type"] . "<br />";
                        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                        echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br />";
                        echo "SHA256: " . $name . "<br />";
                        if (file_exists("." . $GLOBALS['_C']['RouteBase'] . "/" . "Res/" . $name . ".png")) {
                            echo $name . " already exists. ";
                        } else {
                            //header("content-type: image/png");
                            $tmp = file_get_contents($_FILES["file"]["tmp_name"]);
                            //echo $tmp;
                            file_put_contents("./" . "Res/" . $name . ".png", $tmp);
                            //move_uploaded_file($_FILES["file"]["tmp_name"], $GLOBALS['_C']['RouteBase'] . "/" . "Res/" . $name . ".png");
                            echo "Stored in: " . "Res/" . $name . ".png";
                            $db = XDO::Database("Res");
                            if ($type == "default") {
                                $db->ins("Skins", array("id"=>$name, "type"=>"steve"));
                            } else {
                                $db->ins("Skins", array("id"=>$name, "type"=>"alex"));
                            }
                        }
                        $db = XDO::Database("Account");
                        $db->put("Users.where[name={$_SESSION["name"]}]", array("skin"=>$name, "type"=>$type, "time"=>time()));
                        header("Location: {$GLOBALS["DSS"]["root"]}account/skin");
                    }
                } else {
                    $this->Data = array(
                            "Version" => $GLOBALS["DSS"]['Version'],
                            "Page" => "Upload",
                            "msg" => "图片非 png 或大小超过 200KB"
                        );
                    $this->View("Public/header");
                    return $this->View("Home/msg");
                }
            } else {
                header("Location: {$GLOBALS["DSS"]["root"]}account/login");
            }
        }

        public function cape(){

            if ($_SESSION["login"]) {
                if (($_FILES["file"]["type"] == "image/png") && ($_FILES["file"]["size"] < 200000)){
                    if ($_FILES["file"]["error"] > 0) {
                        echo "Error: " . $_FILES["file"]["error"] . "<br />";
                    } else {
                        if (isset($_POST["useCape"]) && $_POST["useCape"] == "on") {
                            $useCape = true;
                        } else {
                            $useCape = false;
                        }
                        $name = hash("sha256", file_get_contents($_FILES["file"]["tmp_name"]));
                        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                        echo "Type: " . $_FILES["file"]["type"] . "<br />";
                        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                        echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br />";
                        echo "SHA256: " . $name . "<br />";
                        if (file_exists("." . $GLOBALS['_C']['RouteBase'] . "/" . "Res/" . $name . ".png")) {
                            echo $name . " already exists. ";
                        } else {
                            //header("content-type: image/png");
                            $tmp = file_get_contents($_FILES["file"]["tmp_name"]);
                            //echo $tmp;
                            file_put_contents("./" . "Res/" . $name . ".png", $tmp);
                            //move_uploaded_file($_FILES["file"]["tmp_name"], $GLOBALS['_C']['RouteBase'] . "/" . "Res/" . $name . ".png");
                            echo "Stored in: " . "Res/" . $name . ".png";
                            $db = XDO::Database("Res");
                            $db->ins("Capes", array("id"=>$name));
                        }
                        $db = XDO::Database("Account");
                        $db->put("Users.where[name={$_SESSION["name"]}]", array("cape"=>$name, "useCape"=>$useCape, "time"=>time()));
                        header("Location: {$GLOBALS["DSS"]["root"]}account/cape");
                    }
                } else {
                    if (isset($_POST["useCape"]) && $_POST["useCape"] == "on") {
                        $db = XDO::Database("Account");
                        $db->put("Users.where[name={$_SESSION["name"]}]", array("useCape"=>true));
                        header("Location: {$GLOBALS["DSS"]["root"]}account/cape");
                        return;
                    }
                    if (isset($_FILES) && !isset($_POST["useCape"])) {
                        $db = XDO::Database("Account");
                        $db->put("Users.where[name={$_SESSION["name"]}]", array("useCape"=>false));
                        header("Location: {$GLOBALS["DSS"]["root"]}account/cape");
                        return;
                    }
                    $this->Data = array(
                            "Version" => $GLOBALS["DSS"]['Version'],
                            "Page" => "Upload",
                            "msg" => "图片非 png 或大小超过 200KB"
                        );
                    $this->View("Public/header");
                    $this->View("Public/sidebar");
                    $this->View("Home/msg");
                    $this->View("Public/footer");
                }
            } else {
                header("Location: {$GLOBALS["DSS"]["root"]}account/login");
            }
        }
    }
