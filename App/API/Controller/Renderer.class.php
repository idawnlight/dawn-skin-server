<?php
/**
 * Dawn Skin Server
 * By Dawn
 *
 */
    namespace Controller\API;

    use X\Controller;
    use XDO\XDO;
    use MinecraftSkins\MinecraftSkins;
    use claviska\SimpleImage;

    class Renderer extends Controller{
        public function face($var){
            if (!empty($var["id"])) {
                $id = $var["id"];
            } else if ($_SESSION["login"]) {
                $db = XDO::Database("Account");
                $id = current($db->get("Users.where[name={$_SESSION["name"]}]"))["skin"];
            }
            if (file_exists(ResDir . $id . ".png")) {
                $skin = file_get_contents(ResDir . $id . ".png");
                header('Content-type: image/png');
                $skinImage = imagecreatefromstring($skin);
                $renderedSkin = MinecraftSkins::head($skinImage, 8);
                imagepng($renderedSkin);
            }
        }

        public function skin($var) {
            if (!empty($var["id"])) {
                $id = $var["id"];
            } else if ($_SESSION["login"]) {
                $db = XDO::Database("Account");
                $id = current($db->get("Users.where[name={$_SESSION["name"]}]"))["skin"];
            }
            if (file_exists(ResDir . $id . ".png")) {
                $skin = file_get_contents(ResDir . $id . ".png");
                header('Content-type: image/png');
                $skinImage = imagecreatefromstring($skin);
                $renderedSkin = MinecraftSkins::skin($skinImage, 5);
                imagepng($renderedSkin);
            }
        }

        public function cape($var){
            if (!empty($var["id"])) {
                $id = $var["id"];
            } else if ($_SESSION["login"]) {
                $db = XDO::Database("Account");
                $id = current($db->get("Users.where[name={$_SESSION["name"]}]"))["cape"];
            }
            if (file_exists(ResDir . $id . ".png")) {
                $x2 = getimagesize (ResDir . $id . ".png")[0]/6;
                $y2 = getimagesize (ResDir . $id . ".png")[1]/2;
                try {
                    // Create a new SimpleImage object
                    $image = new \claviska\SimpleImage();

                    // Magic! ✨
                    $image
                    ->fromFile(ResDir . $id . ".png")
                    ->autoOrient()
                    ->crop(0, 0, $x2, $y2)
                    ->resize(38, 60)
                    ->toScreen();

                      // And much more! 💪
                  } catch(Exception $err) {
                      // Handle errors
                      echo $err->getMessage();
                  }
            }
        }
    }
