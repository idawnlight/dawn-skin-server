<div class="mdui-container dss-container dss-no-cover">
    <h1 class="dss-title">{{ $L['Manage']['Cape'] }}</h1>
    <p>{{ $L['Manage']['CapeNow'] }}&nbsp;:&nbsp;&nbsp;</p>
    <img src="{{ $GLOBALS["DSS"]["root"] }}renderer/cape" />
    <form action="{{ $GLOBALS["DSS"]["root"] }}account/upload/cape" method="post" enctype="multipart/form-data">
        <br />
        <label for="file">上传新披风&nbsp;:&nbsp;&nbsp;</label>
        <input type="file" name="file" id="file" /><br /><br />
        <p>启用披风 &nbsp;:&nbsp;&nbsp;
            <label class="mdui-switch">
                <input name="useCape" type="checkbox" {{ $here }}/>
                <i class="mdui-switch-icon"></i>
            </label>
        </p>
        <button class="mdui-btn mdui-btn-raised mdui-ripple">上传</button>
    </form>
</div>
