
/***************************
 * ��ҳ�������������ע��ҳ���������֤ *
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
        alert("�û�������Ϊ��");
        return false;
    }
    var passwd = $("#passwd").val();
    if (IsEmpty(passwd)) {
        alert("���벻��Ϊ��");
        return false;
    }
    if (passwd.length < 6) {
        alert("���벻��������λ");
        return false;
    }
    var confirmpasswd = $("#confirmpasswd").val();
    if (IsEmpty(confirmpasswd)) {
        alert("ȷ�����벻��Ϊ��");
        return false;
    }
    if (passwd != confirmpasswd) {
        alert("�����������벻һ��");
        return false;
    }
    var email = $("#email").val();
    if (IsEmpty(email)) {
        alert("���䲻��Ϊ��");
        return false;
    }
    var pattern = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if (!pattern.test(email)) {
        alert("���䲻�Ϸ�");
        return false;
    }
    var code = $("#code").val();
    if (IsEmpty(code)) {
        alert("��֤�벻��Ϊ��");
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
        alert("�û�������");
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
        alert("��֤�����");
        return false;
    }
    return true;
}


function checkUsername(){
    var username = $("#username").val();
    if (IsEmpty(username)) {
        $("#checkUser").html("<font style='color:red'>�û�������Ϊ��</font>");
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
                $("#checkUser").html("<font style='color:red'>�������</font>");
            }
            if (result == "error_2") {
                $("#checkUser").html("<font style='color:red'>�û����Ѵ���</font>");
            }
            if (result == "pass") {
                $("#checkUser").html("<font style='color:gray'>�û�����ȷ</font>");
            }
        }
    });
}

function checkPWD(){
    var passwd = $("#passwd").val();
    if (IsEmpty(passwd)) {
        $("#passwdbox").html("<font style='color:red'>���벻��Ϊ��</font>");
        return;
    }
    if (passwd.length < 6) {
        $("#passwdbox").html("<font style='color:red'>���벻��������λ</font>");
        return;
    }
    if (passwd.length >= 6 && passwd.length <= 10) {
        $("#passwdbox").html("<font style='color:gray'>����ǿ�ȣ���</font>");
        return;
    }
    if (passwd.length > 10 && passwd.length <= 16) {
        $("#passwdbox").html("<font style='color:gray'>����ǿ�ȣ���</font>");
        return;
    }
    if (passwd.length > 16 && passwd.length <= 22) {
        $("#passwdbox").html("<font style='color:gray'>����ǿ�ȣ�ǿ</font>");
        return;
    }
}

function checkConfirmPasswd(){
    var confirmpasswd = $("#confirmpasswd").val();
    if (IsEmpty(confirmpasswd)) {
        $("#confirmpasswdbox").html("<font style='color:red'>ȷ�����벻��Ϊ��</font>");
        return;
    }
    var passwd = $("#passwd").val();
    if (IsEmpty(passwd)) {
        $("#passwdbox").html("<font style='color:red'>���벻��Ϊ��</font>");
        return;
    }
    if (confirmpasswd == passwd) {
        $("#confirmpasswdbox").html("<font style='color:gray'>����һ��</font>");
        return;
    }
    else {
        $("#confirmpasswdbox").html("<font style='color:red'>���벻һ��</font>");
        return;
    }
}

function checkemail(){
    var email = $("#email").val();
    if (IsEmpty(email)) {
        $("#checkemailbox").html("<font style='color:red'>���䲻��Ϊ��</font>");
        return;
    }
    var pattern = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if (!pattern.test(email)) {
        $("#checkemailbox").html("<font style='color:red'>���䲻�Ϸ�</font>");
    }
    else {
        $("#checkemailbox").html("<font style='color:gray'>������ȷ</font>");
    }
}

function checkcode(){
    var code = $("#code").val();
    if (IsEmpty(code)) {
        $("#checkcodebox").html("<font style='color:red'>��֤�벻��Ϊ��</font>");
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
                $("#checkcodebox").html("<font style='color:red'>�������</font>");
            }
            if (result == "error_2") {
                $("#checkcodebox").html("<font style='color:red'>�������˴���</font>");
            }
            if (result == "error_3") {
                $("#checkcodebox").html("<font style='color:red'>��֤�����</font>");
            }
            if (result == "pass") {
                $("#checkcodebox").html("<font style='color:gray'>��֤����ȷ</font>");
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





















