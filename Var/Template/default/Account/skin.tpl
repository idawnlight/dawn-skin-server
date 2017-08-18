<div class="mdui-container dss-container dss-no-cover">
    <h1 class="dss-title">{{ $L['Manage']['Skin'] }}</h1>
    <div class="mdui-row-xs-2">
        <div class="mdui-col">
            <div class="mdui-card">
                <div class="dss-skin">
                    <h4 class="dss-skin-title">Now</h4>
                    <img src="{{ $GLOBALS["DSS"]["root"] }}renderer/skin" />
                </div>
            </div>
        </div>
        <div class="mdui-col">
            <div class="mdui-card">
                <div class="dss-skin">
                    <h4 class="dss-skin-title">New</h4>
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
                        <button class="mdui-btn mdui-btn-raised mdui-ripple">上传</button>
                    </form>                
                </div>
            </div>
        </div>
    </div>
</div>