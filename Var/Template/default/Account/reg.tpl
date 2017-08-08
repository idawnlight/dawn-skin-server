<div class="mdui-container dss-container dss-no-cover">
<div class="mdui-card mdui-hoverable">

  <!-- 卡片的标题和副标题 -->
  <div class="mdui-card-primary">
    <div class="mdui-card-primary-title">{{ $L['Reg']['Reg'] }}</div>
  </div>

  <!-- 卡片的内容 -->
  <div class="mdui-card-content">
  <form class="regForm">
      <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">{{ $L['Login']['Username'] }}</label>
        <input class="mdui-textfield-input" type="text" name="name" required onkeypress="$.getKey();" />
        <div class="mdui-textfield-error">{{ $L['Login']['UsernameWarn'] }}</div>
      </div>

      <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">{{ $L['Login']['Password'] }}</label>
        <input class="mdui-textfield-input" type="password" name="password" id="Password" required onkeypress="$.getKey();" />
        <div class="mdui-textfield-error">{{ $L['Login']['PasswordWarn'] }}</div>
      </div>

      <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">{{ $L['Reg']['PasswordVer'] }}</label>
        <input class="mdui-textfield-input" type="password" name="passwordVer" id="PasswordVer" required onkeypress="$.getKey();" />
        <div class="mdui-textfield-error">{{ $L['Login']['PasswordWarn'] }}</div>
      </div>

      <div class="mdui-textfield mdui-textfield-floating-label">
        <label class="mdui-textfield-label">{{ $L['Reg']['PlayerID'] }}</label>
        <input class="mdui-textfield-input" type="text" name="id" required onkeypress="$.getKey();" />
        <div class="mdui-textfield-error">{{ $L['Reg']['PlayerIDWarn'] }}</div>
      </div>
    </form>
    </div>

<!-- 卡片的按钮 -->
<div class="mdui-card-actions">
  <button class="mdui-btn mdui-ripple reg">{{ $L['Reg']['Reg'] }}</button>
</div>

</div>
</div>

<div class="mdui-dialog" id="success">
  <div class="mdui-dialog-title">{{ $L['Reg']['Success'] }}</div>
  <div class="mdui-dialog-content">{{ $L['Reg']['SuccessMsg'] }}</div>
  <div class="mdui-dialog-actions">
    <button class="mdui-btn mdui-ripple manage" mdui-dialog-close>{{ $L['Reg']['Login'] }}</button>
  </div>
</div>
<div class="mdui-dialog" id="name">
  <div class="mdui-dialog-title">{{ $L['Reg']['Fail'] }}</div>
  <div class="mdui-dialog-content">{{ $L['Reg']['NameMsg'] }}</div>
  <div class="mdui-dialog-actions">
    <button class="mdui-btn mdui-ripple" mdui-dialog-confirm>{{ $L['Reg']['Retry'] }}</button>
  </div>
</div>
<div class="mdui-dialog" id="id">
  <div class="mdui-dialog-title">{{ $L['Reg']['Fail'] }}</div>
  <div class="mdui-dialog-content">{{ $L['Reg']['IDMsg'] }}</div>
  <div class="mdui-dialog-actions">
    <button class="mdui-btn mdui-ripple" mdui-dialog-confirm>{{ $L['Reg']['Retry'] }}</button>
  </div>
</div>
<div class="mdui-dialog" id="empty">
  <div class="mdui-dialog-title">{{ $L['Reg']['Fail'] }}</div>
  <div class="mdui-dialog-content">{{ $L['Reg']['EmptyMsg'] }}</div>
  <div class="mdui-dialog-actions">
    <button class="mdui-btn mdui-ripple" mdui-dialog-confirm>{{ $L['Reg']['Retry'] }}</button>
  </div>
</div>
<div class="mdui-dialog" id="ver">
  <div class="mdui-dialog-title">{{ $L['Reg']['Fail'] }}</div>
  <div class="mdui-dialog-content">{{ $L['Reg']['VerMsg'] }}</div>
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
        url: "{{ $GLOBALS["DSS"]["root"] }}account/reg",
        async: false,//改为同步方式
        type: "POST",
        data: $("form.regForm").serialize(),
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
     } else if (obj.status == "name") {
         var inst = new mdui.Dialog('#name');
     } else if (obj.status == "id") {
         var inst = new mdui.Dialog('#id');
     } else if (obj.status == "empty") {
         var inst = new mdui.Dialog('#empty');
     } else if (obj.status == "ver") {
         var inst = new mdui.Dialog('#ver');
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
          var dialog = document.getElementById('success');
      } else if (obj.status == "name") {
          var inst = new mdui.Dialog('#name');
          var dialog = document.getElementById('name');
      } else if (obj.status == "id") {
          var inst = new mdui.Dialog('#id');
          var dialog = document.getElementById('id');
      } else if (obj.status == "empty") {
          var inst = new mdui.Dialog('#empty');
      } else if (obj.status == "ver") {
          var inst = new mdui.Dialog('#ver');
      }
      inst.open();
      //dialog.addEventListener('close.mdui.dialog', function () {
        //window.location='{{ $GLOBALS["DSS"]["root"] }}account';
        //$("head").append('<meta http-equiv="refresh" content="0;URL={{ $GLOBALS["DSS"]["root"] }}account">');
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
