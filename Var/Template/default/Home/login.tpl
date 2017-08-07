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
            <td><h1>{{ $L['Login']['Login'] }}</h1></td>
        </tr>
        <tr valign="middle" align="center">
            <td>
                <p>{{ $msg }}</p>
                <form action="" method="post">
                    <div>
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name">
                    </div>
                    <div>
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <div>
                        <button type="submit">Login</button>
                    </div>
                </form>
            </td>
        </tr>
        <tr valign="middle" align="center">
            <td><h3>Version {{ $Version }}</h3></td>
        </tr>
    </table>

</body>
</html>
