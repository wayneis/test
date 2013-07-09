
/***************************
 * 本页面用来处理关于注册页面的内容验证 *
 /***************************/


function IsEmpty(str){
    if (str == null || str.length == 0) {
        return true;
    }
    return false;
}

function ResetForm(){
    $("#checkUser").html("");
    $("#passwdbox").html("");
    $("#confirmpasswdbox").html("");
    $("#checkemailbox").html("");
    $("#checkcodebox").html("");
}

function checkForm(){
    var username = $("#username").val();
    if (IsEmpty(username)) {
        alert("用户名不能为空");
        return false;
    }
    var passwd = $("#passwd").val();
    if (IsEmpty(passwd)) {
        alert("密码不能为空");
        return false;
    }
    if (passwd.length < 6) {
        alert("密码不能少于六位");
        return false;
    }
    var confirmpasswd = $("#confirmpasswd").val();
    if (IsEmpty(confirmpasswd)) {
        alert("确认密码不能为空");
        return false;
    }
    if (passwd != confirmpasswd) {
        alert("两次输入密码不一致");
        return false;
    }
    var email = $("#email").val();
    if (IsEmpty(email)) {
        alert("邮箱不能为空");
        return false;
    }
    var pattern = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if (!pattern.test(email)) {
        alert("邮箱不合法");
        return false;
    }
    var code = $("#code").val();
    if (IsEmpty(code)) {
        alert("验证码不能为空");
        return false;
    }
    var result;
    $.ajax({
        type: "post",
        url: "registerHandler.php",
        data: "action=checkuser&username=" + username,
        async: false,
        global: false,
        success: function(responseText){
            result = responseText;
        }
    });
    if (result != "pass") {
        alert("用户名错误");
        return false;
    }
    $.ajax({
        type: "post",
        url: "registerHandler.php",
        data: "action=checkcode&code=" + code,
        global: false,
        async: false,
        success: function(responseText){
            result = responseText;
        }
    });
    if (result != "pass") {
        alert("验证码错误");
        return false;
    }
    return true;
}


function checkUsername(){
    var username = $("#username").val();
    if (IsEmpty(username)) {
        $("#checkUser").html("<font style='color:red'>用户名不能为空</font>");
        return;
    }
    $.ajax({
        type: "post",
        url: "registerHandler.php",
        data: "action=checkuser&username=" + username,
        global: false,
        success: function(responseText){
            var result = responseText;
            if (result == "error_1") {
                $("#checkUser").html("<font style='color:red'>传输错误</font>");
            }
            if (result == "error_2") {
                $("#checkUser").html("<font style='color:red'>用户名已存在</font>");
            }
            if (result == "pass") {
                $("#checkUser").html("<font style='color:gray'>用户名正确</font>");
            }
        }
    });
}

function checkPWD(){
    var passwd = $("#passwd").val();
    if (IsEmpty(passwd)) {
        $("#passwdbox").html("<font style='color:red'>密码不能为空</font>");
        return;
    }
    if (passwd.length < 6) {
        $("#passwdbox").html("<font style='color:red'>密码不能少于六位</font>");
        return;
    }
    if (passwd.length >= 6 && passwd.length <= 10) {
        $("#passwdbox").html("<font style='color:gray'>密码强度：弱</font>");
        return;
    }
    if (passwd.length > 10 && passwd.length <= 16) {
        $("#passwdbox").html("<font style='color:gray'>密码强度：中</font>");
        return;
    }
    if (passwd.length > 16 && passwd.length <= 22) {
        $("#passwdbox").html("<font style='color:gray'>密码强度：强</font>");
        return;
    }
}

function checkConfirmPasswd(){
    var confirmpasswd = $("#confirmpasswd").val();
    if (IsEmpty(confirmpasswd)) {
        $("#confirmpasswdbox").html("<font style='color:red'>确认密码不能为空</font>");
        return;
    }
    var passwd = $("#passwd").val();
    if (IsEmpty(passwd)) {
        $("#passwdbox").html("<font style='color:red'>密码不能为空</font>");
        return;
    }
    if (confirmpasswd == passwd) {
        $("#confirmpasswdbox").html("<font style='color:gray'>密码一致</font>");
        return;
    }
    else {
        $("#confirmpasswdbox").html("<font style='color:red'>密码不一致</font>");
        return;
    }
}

function checkemail(){
    var email = $("#email").val();
    if (IsEmpty(email)) {
        $("#checkemailbox").html("<font style='color:red'>邮箱不能为空</font>");
        return;
    }
    var pattern = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if (!pattern.test(email)) {
        $("#checkemailbox").html("<font style='color:red'>邮箱不合法</font>");
    }
    else {
        $("#checkemailbox").html("<font style='color:gray'>邮箱正确</font>");
    }
}

function checkcode(){
    var code = $("#code").val();
    if (IsEmpty(code)) {
        $("#checkcodebox").html("<font style='color:red'>验证码不能为空</font>");
        return;
    }
    $.ajax({
        type: "post",
        url: "registerHandler.php",
        data: "action=checkcode&code=" + code,
        global: false,
        success: function(responseText){
            var result = responseText;
            if (result == "error_1") {
                $("#checkcodebox").html("<font style='color:red'>传输错误</font>");
            }
            if (result == "error_2") {
                $("#checkcodebox").html("<font style='color:red'>服务器端错误</font>");
            }
            if (result == "error_3") {
                $("#checkcodebox").html("<font style='color:red'>验证码错误</font>");
            }
            if (result == "pass") {
                $("#checkcodebox").html("<font style='color:gray'>验证码正确</font>");
            }
        }
    });
}

function ResetCode(){
    $("#imagecode").attr("src", getSrc());
}

function getSrc(){
    src = "getImage.php?action=getcode&rand=" + Math.floor(Math.random() * 100);
    return src;
}





















