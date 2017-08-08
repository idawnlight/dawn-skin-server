<!DOCTYPE html>
<html lang="{{ $GLOBALS['_C']['Language'] }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  <title>{{ $Page }} - {{ $GLOBALS["DSS"]["title"] }}</title>
  <link rel="stylesheet" href="{{ $GLOBALS["DSS"]["root"] }}Res/assets/css/mdui.min.css"/>
  <link rel="stylesheet" href="{{ $GLOBALS["DSS"]["root"] }}Res/assets/css/style.css"/>
  <script src="{{ $GLOBALS["DSS"]["root"] }}Res/assets/js/jquery.min.js"></script>
  {{ $GLOBALS["DSS"]["head"] }}
</head>
<body class="mdui-drawer-body-left mdui-appbar-with-toolbar  mdui-theme-primary-light-blue mdui-theme-accent-light-blue">
<header class="mdui-appbar mdui-appbar-fixed">
  <div class="mdui-toolbar dss-header">
    <span class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#main-drawer'}"><i class="mdui-icon material-icons">menu</i></span>
    <a href="#" class="mdui-typo-headline mdui-hidden-xs dss-main-title">{{ $GLOBALS["DSS"]["title"] }}</a>
        <div class="mdui-toolbar-spacer"></div>
  </div>
</header>
