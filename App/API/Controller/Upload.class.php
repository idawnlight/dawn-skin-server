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
        public function main(){

            if ($_SESSION["login"]) {
                if (($_FILES["file"]["type"] == "image/png") && ($_FILES["file"]["size"] < 20000)){
                    if ($_FILES["file"]["error"] > 0) {
                        echo "Error: " . $_FILES["file"]["error"] . "<br />";
                    } else {
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
                            file_put_contents("." . $GLOBALS['_C']['RouteBase'] . "/" . "Res/" . $name . ".png", $tmp);
                            //move_uploaded_file($_FILES["file"]["tmp_name"], $GLOBALS['_C']['RouteBase'] . "/" . "Res/" . $name . ".png");
                            echo "Stored in: " . "Res/" . $name . ".png";
                        }
                        $db = XDO::Database("Account");
                        $db->put("Users.where[name={$_SESSION["name"]}]", array("skin"=>$name, "type"=>$_POST["type"]));
                        header("Location: account");
                    }
                } else {
                    $this->Data = array(
                            "Version" => $GLOBALS["DSS"]['Version'],
                            "Page" => "Upload",
                            "msg" => "图片非 png 或大小超过 20KB"
                        );
                    $this->View("Public/header");
                    return $this->View("Home/msg");
                }
            } else {
                header("Location: /" . $GLOBALS['_C']['RouteBase']);
            }


        }

    }
