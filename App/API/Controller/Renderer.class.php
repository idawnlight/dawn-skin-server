<?php
/**
 * Dawn Skin Server
 * By Dawn
 *
 */
    namespace Controller\API;

    require_once("./Lib/MC-SkinPreviewAPI/SkinPreview.class.php");
    require_once("./Lib/SimpleImage/SimpleImage.class.php");

    use X\Controller;
    use XDO\XDO;
    use SkinRenderer;
    use claviska\SimpleImage;

    class Renderer extends Controller{
        public function face($var){
            if (!empty($var["id"])) {
                if (file_exists($GLOBALS["DSS"]["root"] . "Res/" . $var["id"] . ".png")) {
                    $skin = file_get_contents($GLOBALS["DSS"]["root"] . "Res/" . $var["id"] . ".png");

                    $im = imagecreatefromstring($skin);
                    $av = imagecreatetruecolor($size, $size);

                    $x = array('f' => 8, 'l' => 16, 'r' => 0, 'b' => 24);

                    imagecopyresized($av, $im, 0, 0, $x[$view], 8, $size, $size, 8, 8);         // Face
                    imagecolortransparent($im, imagecolorat($im, 63, 0));                       // Black Hat Issue
                    imagecopyresized($av, $im, 0, 0, $x[$view] + 32, 8, $size, $size, 8, 8);    // Accessories

                    header('Content-type: image/png');
                    imagepng($av);
                    imagedestroy($im);
                    imagedestroy($av);
                }
            } else if ($_SESSION["login"])  {
                $db = XDO::Database("Account");
                $id = current($db->get("Users.where[name={$_SESSION["name"]}]"))["skin"];
                if (file_exists("./Res/" . $id . ".png")) {
                    $skin = file_get_contents("./Res/" . $id . ".png");

                    $im = imagecreatefromstring($skin);
                    $av = imagecreatetruecolor($size, $size);

                    $x = array('f' => 8, 'l' => 16, 'r' => 0, 'b' => 24);

                    imagecopyresized($av, $im, 0, 0, $x[$view], 8, $size, $size, 8, 8);         // Face
                    imagecolortransparent($im, imagecolorat($im, 63, 0));                       // Black Hat Issue
                    imagecopyresized($av, $im, 0, 0, $x[$view] + 32, 8, $size, $size, 8, 8);    // Accessories

                    header('Content-type: image/png');
                    imagepng($av);
                    imagedestroy($im);
                    imagedestroy($av);
                }
            }
        }

        public function skin($var) {
            if (!empty($var["id"])) {
                if (file_exists("./Res/" . $var["id"] . ".png")) {
                    if (isset($_GET["get"])) {
                        $get = $_GET["get"];
                    } else {
                        $get = "front";
                    }
                    $db = XDO::Database("Res");
                    $type = current($db->get("Skins.where[id={$var["id"]}]"))["type"];

                    // Tell the browser we're sending a PNG image
                    header("Content-type: image/png");

                    // Instantiate the renderer
                    $renderer = new SkinRenderer(85);

                    // Render the skin (with its path, type and desired side)
                    $skin = $renderer->renderSkinFromPath("./Res/" . $var["id"] . ".png", $type, $get);

                    // Render as base 64 encoded data
                    // $skin = $renderer->renderSkinBase64('test/pre_1_8.png', 'steve', 'front');

                    // Display the image
                    imagepng($skin);
                }
            } else if ($_SESSION["login"])  {
                $db = XDO::Database("Account");
                $id = current($db->get("Users.where[name={$_SESSION["name"]}]"))["skin"];
                if (file_exists("./Res/" . $id . ".png")) {
                    if (isset($_GET["get"])) {
                        $get = $_GET["get"];
                    } else {
                        $get = "front";
                    }
                    $db = XDO::Database("Res");
                    $type = current($db->get("Skins.where[id={$id}]"))["type"];

                    // Tell the browser we're sending a PNG image
                    header("Content-type: image/png");
                    //echo file_get_contents("./Res/" . $var["id"] . ".png");
                    //return;

                    // Instantiate the renderer
                    $renderer = new SkinRenderer(85);

                    // Render the skin (with its path, type and desired side)
                    $skin = $renderer->renderSkinFromPath("./Res/" . $id . ".png", $type, $get);

                    // Render as base 64 encoded data
                    // $skin = $renderer->renderSkinBase64('test/pre_1_8.png', 'steve', 'front');

                    // Display the image
                    imagepng($skin);
                }
            }
        }

        public function cape($var){
            if (!empty($var["id"])) {
                if (file_exists("./Res/" . $var["id"] . ".png")) {
                    $x2 = getimagesize ("./Res/" . $var["id"] . ".png")[0]/6;
                    $y2 = getimagesize ("./Res/" . $var["id"] . ".png")[1]/2;
                    try {
                        // Create a new SimpleImage object
                        $image = new \claviska\SimpleImage();

                        // Magic! ✨
                        $image
                        ->fromFile("./Res/" . $var["id"] . ".png")                     // load image.jpg
                        ->autoOrient()                              // adjust orientation based on exif data
                        ->crop(0, 0, $x2, $y2)                          // resize to 320x200 pixels
 	                    ->resize(38, 60)
                        ->toScreen();                               // output to the screen

                          // And much more! 💪
                      } catch(Exception $err) {
                          // Handle errors
                          echo $err->getMessage();
                      }
                }
            } else if ($_SESSION["login"])  {
                $db = XDO::Database("Account");
                $id = current($db->get("Users.where[name={$_SESSION["name"]}]"))["cape"];
                if (file_exists("./Res/" . $id . ".png")) {
                    $x2 = getimagesize ("./Res/" . $id . ".png")[0]/6+1;
                    $y2 = getimagesize ("./Res/" . $id . ".png")[1]/2+1;
                    try {
                        // Create a new SimpleImage object
                        $image = new \claviska\SimpleImage();

                        // Magic! ✨
                        $image
                        ->fromFile("./Res/" . $id . ".png")                     // load image.jpg
                        ->autoOrient()                              // adjust orientation based on exif data
                        ->crop(0, 0, $x2, $y2)                          // resize to 320x200 pixels
 	                    ->resize(76, 120)
                        ->toScreen();                               // output to the screen

                          // And much more! 💪
                      } catch(Exception $err) {
                          // Handle errors
                          echo $err->getMessage();
                      }
                }
            }
        }
    }
