<div class="mdui-drawer" id="main-drawer">
  <div class="mdui-list" mdui-collapse="{accordion: true}" style="margin-bottom: 76px;">
    <div class="mdui-collapse-item ">
      <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
        <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">near_me</i>
        <div class="mdui-list-item-content">{{ $L['Sidebar']['Manage'] }}</div>
        <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
      </div>
      <div class="mdui-collapse-item-body mdui-list">
        <a href="{{ $GLOBALS["DSS"]["root"] }}account" class="mdui-list-item mdui-ripple ">{{ $L['Sidebar']['Info'] }}</a>
        <a href="{{ $GLOBALS["DSS"]["root"] }}account/skin" class="mdui-list-item mdui-ripple ">{{ $L['Sidebar']['Skin'] }}</a>
        <a href="{{ $GLOBALS["DSS"]["root"] }}account/cape" class="mdui-list-item mdui-ripple ">{{ $L['Manage']['Cape'] }}</a>
        <a href="{{ $GLOBALS["DSS"]["root"] }}account/logout" class="mdui-list-item mdui-ripple ">{{ $L['Sidebar']['Logout'] }}</a>
      </div>
    </div>
    <div class="mdui-collapse-item ">
      <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
        <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-light-blue">info</i>
        <div class="mdui-list-item-content">{{ $L['Sidebar']['About'] }}</div>
        <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
      </div>
      <div class="mdui-collapse-item-body mdui-list">
        <a href="https://github.com/LiMingYuGuang/dawn-skin-server" target="_blank" class="mdui-list-item mdui-ripple ">Github</a>
      </div>
    </div>
  </div>
</div>
