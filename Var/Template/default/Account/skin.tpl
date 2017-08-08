<div class="mdui-container dss-container dss-no-cover">
    <h1 class="dss-title">{{ $L['Manage']['Skin'] }}</h1>
    <p>{{ $L['Manage']['SkinNow'] }}&nbsp;:&nbsp;&nbsp;</p>
    <img src="{{ $GLOBALS["DSS"]["root"] }}renderer/skin?get=front" />&nbsp;&nbsp;&nbsp;<img src="{{ $GLOBALS["DSS"]["root"] }}renderer/skin?get=back" />
    <form action="{{ $GLOBALS["DSS"]["root"] }}account/upload/skin" method="post" enctype="multipart/form-data">
        <br />
        <label for="file">上传新皮肤&nbsp;:&nbsp;&nbsp;</label>
        <input type="file" name="file" id="file" /><br /><br />
        <p>启用 Slim 模型 ( Alex ) &nbsp;:&nbsp;&nbsp;
            <label class="mdui-switch">
                <input name="alex" type="checkbox"/>
                <i class="mdui-switch-icon"></i>
            </label>
        </p>
        <p class="mdui-text-color-blue-accent">请务必使用双层皮肤，否则会导致渲染出错</p>
        <button class="mdui-btn mdui-btn-raised mdui-ripple">上传</button>
    </form>
</div>
