<a id="anchor-top"></a>
<div class="mdui-container dss-container dss-no-cover">
  <h1 class="dss-title">{{ $L['Manage']['Welcome'] }}{{ $name }}</h1>
  <div class="dss-chapter">
    <div class="mdui-typo">
      <p>{{ $L['Manage']['Intro'] }}</p>
    </div>
    <div class="mdui-list dss-manage-main">
        <a onclick="$.edit();" class="mdui-list-item mdui-ripple mdui-text-color-light-blue">{{ $L['Manage']['PlayerID'] }}&nbsp;:&nbsp;<strong><span id="playerid">{{ $id }}</span></strong></a>
        <a href="{{ $GLOBALS["DSS"]["root"] }}account/skin" class="mdui-list-item mdui-ripple mdui-text-color-light-blue">{{ $L['Manage']['Skin'] }}</a>
        <a href="{{ $GLOBALS["DSS"]["root"] }}account/cape" class="mdui-list-item mdui-ripple mdui-text-color-light-blue">{{ $L['Manage']['Cape'] }}</a>
    </div>
  </div>
</div>
<script>
var nowid = "{{ $id }}";

$('#chgID').submit(function() {
  return false;
});

function Async() {
 //定义一个全局变量来接受$post的返回值
 var result;
 //用ajax的“同步方式”调用一般处理程序
    $.ajax({
        url: "{{ $GLOBALS["DSS"]["root"] }}account/edit",
        async: false,//改为同步方式
        type: "POST",
        data: "id=" + $("input#newid").val(),
        success: function (courseDT4) {
            result = courseDT4;
 }
 });
 return result;
}
$.extend({
edit: function() {
     var edit = new mdui.Dialog('#edit');
     edit.open();
     var dialog = document.getElementById('edit');
     dialog.addEventListener('confirm.mdui.dialog', function send() {
         if ($("input#newid").val() !== nowid && $("input#newid").val() !== "") {
             var res = Async();
             //console.log(res);
             if (res.status == "used") {
                 mdui.snackbar({
                     message: '{{ $L['Manage']['Used'] }}'
                 });
             } else if (res.status == "success") {
                 mdui.snackbar({
                     message: '{{ $L['Manage']['Success'] }}'
                 });
                 $('span#playerid').html($("input#newid").val());
                 nowid = $("input#newid").val();
             } else if (res.status == "empty") {
                 mdui.snackbar({
                     message: '{{ $L['Manage']['Empty'] }}'
                 });
             }
         }
     });
},
})
$.extend({
getKey: function() {
 if(event.keyCode==13){
     if ($("input#newid").val() !== nowid && $("input#newid").val() !== "") {
         var res = Async();
         //console.log(res);
         if (res.status == "used") {
             mdui.snackbar({
                 message: '{{ $L['Manage']['Used'] }}'
             });
         } else if (res.status == "success") {
             mdui.snackbar({
                 message: '{{ $L['Manage']['Success'] }}'
             });
             $('span#playerid').html($("input#newid").val());
             nowid = $("input#newid").val();
         } else if (res.status == "empty") {
             mdui.snackbar({
                 message: '{{ $L['Manage']['Empty'] }}'
             });
         }
         edit.close();
     }
  }
},
})
</script>
<div class="mdui-dialog" id="edit">
  <div class="mdui-dialog-title">{{ $L['Manage']['EditPlayerID'] }}</div>
  <div class="mdui-dialog-content">
      <div class="mdui-textfield">
          <input class="mdui-textfield-input" type="text" id="newid" placeholder="{{ $L['Manage']['PlayerID'] }}" value="{{ $id }}" name="id" onkeypress="$.getKey();" />
      </div>
  </div>
  <div class="mdui-dialog-actions">
    <button class="mdui-btn mdui-ripple" mdui-dialog-cancel>{{ $L['Manage']['Cancel'] }}</button>
    <button class="mdui-btn mdui-ripple" mdui-dialog-confirm>{{ $L['Manage']['Confirm'] }}</button>
  </div>
</div>
