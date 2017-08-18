<div class="mdui-container dss-container dss-no-cover">
  <div class="mdui-row-xs-2">
    <div class="mdui-col">
      <div class="mdui-card mdui-hoverable dss-auth">

      <!-- 卡片的标题和副标题 -->
      <div class="mdui-card-primary">
        <div class="mdui-card-primary-title">{{ $L['Login']['Login'] }}</div>
      </div>

      <!-- 卡片的内容 -->
      <div class="mdui-card-content">
        <form method="post" action="">
        <div class="mdui-textfield mdui-textfield-floating-label">
          <label class="mdui-textfield-label">{{ $L['Login']['Username'] }}</label>
          <input class="mdui-textfield-input" type="text" name="name" onkeypress="$.getKey();" required/>
          <div class="mdui-textfield-error">{{ $L['Login']['UsernameWarn'] }}</div>
        </div>

        <div class="mdui-textfield mdui-textfield-floating-label">
          <label class="mdui-textfield-label">{{ $L['Login']['Password'] }}</label>
          <input class="mdui-textfield-input" type="password" name="password" onkeypress="$.getKey();" required/>
          <div class="mdui-textfield-error">{{ $L['Login']['PasswordWarn'] }}</div>
        </div>
        </form>
      </div>

      <!-- 卡片的按钮 -->
      <div class="mdui-card-actions">
        <button class="mdui-btn mdui-ripple reg">{{ $L['Reg']['Submit'] }}</button>
      </div>
      </div>
    </div>
	<div class="mdui-col">
      <div class="mdui-card">
        <div class="mdui-card-media">
          <img src="https://i.loli.net/2017/08/18/5996975de583f.png"/>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="mdui-dialog" id="success">
  <div class="mdui-dialog-title">{{ $L['Login']['Success'] }}</div>
  <div class="mdui-dialog-content">{{ $L['Login']['SuccessMsg'] }}</div>
  <div class="mdui-dialog-actions">
    <button class="mdui-btn mdui-ripple manage" mdui-dialog-close>{{ $L['Reg']['Login'] }}</button>
  </div>
</div>
<div class="mdui-dialog" id="fail">
  <div class="mdui-dialog-title">{{ $L['Login']['Fail'] }}</div>
  <div class="mdui-dialog-content">{{ $L['Login']['FailMsg'] }}</div>
  <div class="mdui-dialog-actions">
    <button class="mdui-btn mdui-ripple" mdui-dialog-confirm>{{ $L['Reg']['Retry'] }}</button>
  </div>
</div>
<div class="mdui-dialog" id="empty">
  <div class="mdui-dialog-title">{{ $L['Login']['Fail'] }}</div>
  <div class="mdui-dialog-content">{{ $L['Reg']['EmptyMsg'] }}</div>
  <div class="mdui-dialog-actions">
    <button class="mdui-btn mdui-ripple" mdui-dialog-confirm>{{ $L['Reg']['Retry'] }}</button>
  </div>
</div>
<script type="text/javascript">
function Async() {
 //定义一个全局变量来接受$post的返回值
 var result;
 //用ajax的“同步方式”调用一般处理程序
    $.ajax({
        url: "{{ $GLOBALS["DSS"]["root"] }}account/login",
        async: false,//改为同步方式
        type: "POST",
        data: $("form").serialize(),
        success: function (courseDT4) {
            result = courseDT4;
 }
 });
 return result;
}
$.extend({
getKey: function() {
 if(event.keyCode==13){
     var res = Async();
     //console.log(res);
     var obj = res;
     if (obj.status == "success") {
         var inst = new mdui.Dialog('#success');
     } else if (obj.status == "fail") {
         var inst = new mdui.Dialog('#fail');
     } else if (obj.status == "empty") {
         var inst = new mdui.Dialog('#empty');
     }
     inst.open();
     if (obj.status == "success") {
         setTimeout('jump()',1500);
     }
  }
},
})
$(document).ready(function(){
  $("button.reg").click(function(){
      var res = Async();
      //console.log(res);
      //var obj = jQuery.parseJSON(res);
      var obj = res;
      if (obj.status == "success") {
          var inst = new mdui.Dialog('#success');
      } else if (obj.status == "fail") {
          var inst = new mdui.Dialog('#fail');
      } else if (obj.status == "empty") {
          var inst = new mdui.Dialog('#empty');
      }
      inst.open();
      if (obj.status == "success") {
          setTimeout('jump()',1500);
      }
      //});
  });
});
function jump() {
    window.location='{{ $GLOBALS["DSS"]["root"] }}account';
}

</script>
