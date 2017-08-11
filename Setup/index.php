<?php
$install = "ok";
if (file_exists("../install.lock")) {
    $install = "error";
    $msg = "Dawn Skin Server 似乎已安装，如果未正确安装请尝试删除 <code>install.lock</code>";
}
if (is_writeable("../Var/Data/Database/Account/Users/Data.json") && is_writeable("../Var/Data/Database/Res/Capes/Data.json") && is_writeable("../Var/Data/Database/Res/Skins/Data.json") && is_writeable("../Var/Data/Database/System/Config/Data.json")) {
} else {
    $install = "error";
    $msg = "Dawn Skin Server 无法获得服务器的写入权限";
}

use XDO\XDO;
use XDO\Tool as XDOTool;
define("DatDir",'../Var/Data/'); //XDO Data Directory
require_once("../vendor/xtlsoft/xdo/Autoload.php");
XDO::setDir(DatDir);
XDO::$Cache = false;
$system = XDO::Database("System");
$account = XDO::Database("Account");

if (isset($_POST["username"], $_POST["password"], $_POST["passwordv"], $_POST["site"])) {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $passwordv = test_input($_POST["passwordv"]);
    $site = test_input($_POST["site"]);
    if (!empty($username) && !empty($password) && !empty($passwordv) && !empty($site)) {
        if ($password == $passwordv) {
            @$account->ins("Users", array("name"=>$username,
                                    "id"=>$username,
                                    "password"=>password_hash($password, PASSWORD_DEFAULT),
                                    "skin"=>"83af9d073270f3d18917ff0093d7a3161868f9c072d1e6605b3a2ca7e859b5eb",
                                    "type"=>"default",
                                    "cape"=>"7921a79d51b87781c94a285e1e8c32a07058960048e473f46d72b65f77f44641",
                                    "useCape"=>false,
                                    "time"=>time(),
                                    "permissions"=>"admin"));
            @$system->put("Config.where[name=title]",array("value"=>$site));
            file_put_contents("../install.lock", "install.lock");
            $install = "success";
        } else {
            $install = "error";
            $msg = "两次输入的密码不一致";
        }
    } else {
        $install = "error";
        $msg = "请勿留空";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <title>Dawn Skin Serevr 初次配置</title>
  <link href="https://cdn.bootcss.com/mdui/0.2.1/css/mdui.min.css" rel="stylesheet">
  <script src="https://cdn.bootcss.com/mdui/0.2.1/js/mdui.min.js"></script>
  <style>
  body {
      background-color: #e9ebec;
      font-family: Roboto, 'Helvetica Neue', Helvetica, 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', '微软雅黑', Arial, sans-serif;
  }
  .mdui-card {
      width: 70%;
      max-width: 800px;
      height: 70%;
      max-height: 1200px;
      min-height: 600px;
      margin: auto;
      position: absolute;
      top: 0;
      left: 0;
      bottom: 0;
      right: 0;
  }
  .mdui-textfield {
      position: relative;
      top: -27px;
      width: auto;
      min-width: 400%;
  }
  .mdui-card-media {
      position: relative;
      margin-top: 40px;
  }
  .dss-row {
      height: 40px;
  }
  </style>
</head>
<body class="mdui-theme-primary-blue-grey mdui-theme-accent-light-blue">
    <div class="mdui-card mdui-center mdui-shadow-24">
      <form method="post">
      <?php if ($install == "ok") : ?>
      <div class="mdui-card-media mdui-text-center">
        <h2 class="mdui-text-color-theme">Dawn Skin Server 初次配置</h2>
        <p class="mdui-text-color-theme-700">所有选项均能在之后被更改</p>
      </div>
      <div class="mdui-row-xs-6 dss-row"><div class="mdui-divider"></div></div>
      <div class="mdui-row-xs-7">
          <div class="mdui-col"></div>
          <div class="mdui-col"><strong>管理员账号</strong></div>
          <div class="mdui-col">
              <div class="mdui-textfield">
                  <input class="mdui-textfield-input" type="text" name="username" required/>
                  <div class="mdui-textfield-error">不能为空</div>
              </div>
          </div>
      </div>
      <div class="mdui-row-xs-7">
          <div class="mdui-col"></div>
          <div class="mdui-col"><strong>密码</strong></div>
          <div class="mdui-col">
              <div class="mdui-textfield">
                  <input class="mdui-textfield-input" type="password" name="password" required/>
                  <div class="mdui-textfield-error">不能为空</div>
              </div>
          </div>
      </div>
      <div class="mdui-row-xs-7">
          <div class="mdui-col"></div>
          <div class="mdui-col"><strong>重复密码</strong></div>
          <div class="mdui-col">
              <div class="mdui-textfield">
                  <input class="mdui-textfield-input" type="password" name="passwordv" required/>
                  <div class="mdui-textfield-error">不能为空</div>
              </div>
          </div>
      </div>
      <div class="mdui-row-xs-7">
          <div class="mdui-col"></div>
          <div class="mdui-col"><strong>站点名称</strong></div>
          <div class="mdui-col">
              <div class="mdui-textfield">
                  <input class="mdui-textfield-input" type="text" value="Dawn Skin Server" name="site" required/>
                  <div class="mdui-textfield-error">不能为空</div>
              </div>
          </div>
      </div>
      <div class="mdui-dialog-actions mdui-dialog-actions-stacked">
          <button class="mdui-btn mdui-ripple mdui-text-color-theme"><strong>确定</strong></button>
      </div>
  </form>
  <?php elseif($install == "error"): ?>
      <div class="mdui-card-media mdui-text-center">
        <h2 class="mdui-text-color-theme">错误 - Dawn Skin Server</h2>
        <p class="mdui-text-color-theme-700">安装无法被继续</p>
      </div>
      <div class="mdui-row-xs-6 dss-row"><div class="mdui-divider"></div></div>
      <p class="mdui-text-center mdui-text-color-theme"><strong><?php echo $msg; ?></strong></p>
  <?php elseif($install == "success"): ?>
      <div class="mdui-card-media mdui-text-center">
        <h2 class="mdui-text-color-theme">安装成功 - Dawn Skin Server</h2>
      </div>
      <div class="mdui-row-xs-6 dss-row"><div class="mdui-divider"></div></div>
      <p class="mdui-text-center mdui-text-color-theme"><strong>现在，您可以返回主页了</strong></p>
  <?php endif; ?>
  </div>
</body>
</html>
