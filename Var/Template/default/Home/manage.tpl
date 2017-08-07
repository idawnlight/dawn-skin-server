<body>

    <style>
        body{
            margin:0;
            padding:30px;
            font:12px/1.5 "Microsoft Yahei UI",Helvetica,Arial,Verdana,sans-serif;
        }
        h1{
            margin:0;
            font-size:48px;
            font-weight:normal;
            line-height:48px;
        }
        h1{
            margin:0;
            font-size:38px;
            font-weight:normal;
            line-height:48px;
        }
        strong{
            display:inline-block;
            width:65px;
        }
    </style>

    <table border="0" width="100%" height="100%">
        <tr valign="middle" align="center">
            <td><h1>{{ $L['Manage']['Manage'] }}</h1></td>
        </tr>
        <tr valign="middle" align="center">
            <td>
                <p>{{ $msg }}</p>
                <p>用户名：{{ $name }}</p>
                <p>游戏ID：{{ $id }}</p>
                <p>当前皮肤：<img src="Res/{{ $skin }}.png" /></p>
                <p>当前皮肤类型：{{ $type }}</p>
                <form action="upload" method="post" enctype="multipart/form-data">
                    <label for="file">上传新皮肤：</label>
                    <input type="file" name="file" id="file" /><br /><br />
                    <p>皮肤类型：
                    <select name="type">
                        <option value="default">default</option>
                        <option value="slim">slim</option>
                    </select>
                    </p>
                    <input type="submit" name="submit" value="Submit" />
                </form>
            </td>
        </tr>
        <tr valign="middle" align="center">
            <td><h3>Version {{ $Version }}</h3></td>
        </tr>
    </table>

</body>
</html>
