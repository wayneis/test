/*
 *
 *
 * 验证用户的详细资料
 *
 *
 */
function IsEmpty(str){
    if (str == null || str.length == 0) {
        return true;
    }
    return false;
}

function ResetForm(){
    $("#checkUser").html("");
    $("#checkemailbox").html("");
    $("#checkcodebox").html("");
}

function setbirthdate(){

    var i = 2013;
    var j = 0;
    var year, month, day;
    for (j; j < 100; j++) {
        var option = document.createElement("option");
        year = i + "年";
        $("#birthyear").append(new Option(year, i));
        i--;
    }
    i = 1;
    j = 0;
    for (j; j < 12; j++) {
        month = i + " 月";
        $("#birthmonth").append(new Option(month, i));
        i++;
    }
    i = 1;
    j = 0;
    for (j; j < 31; j++) {
        day = i + " 日";
        $("#birth_day").append(new Option(day, i));
        i++;
    }
}

function setyear(){
    var i = 0;
    var j = 0;
    var year = $("select[name=birthyear]").find("option:selected").attr("value");
    var month = $("select[name=birthmonth]").find("option:selected").attr("value");
    if ((year % 4 == 0 && !(year % 100 == 0)) || year % 400 == 0) {
        if (month == 2) {
            $("#birth_day").empty();
            i = 1;
            for (j; j < 29; j++) {
                day = i + " 日";
                $("#birth_day").append(new Option(day, i));
                i++;
            }
        }
        
    }
    else {
        if (month == 2) {
            $("#birth_day").empty();
            i = 1;
            j = 0;
            for (j; j < 28; j++) {
                day = i + " 日";
                $("#birth_day").append(new Option(day, i));
                i++;
            }
        }
    }
}

function setmonth(){
    var i = 0;
    var j = 0;
    var year = $("select[name=birthyear]").find("option:selected").attr("value");
    var month = $("select[name=birthmonth]").find("option:selected").attr("value");
    if ((year % 4 == 0 && !(year % 100 == 0)) || year % 400 == 0) {
        if (month == 2) {
            $("#birth_day").empty();
            i = 1;
            for (j; j < 29; j++) {
                day = i + " 日";
                $("#birth_day").append(new Option(day, i));
                i++;
            }
        }
    }
    else {
        if (month == 2) {
            $("#birth_day").empty();
            i = 1;
            j = 0;
            for (j; j < 28; j++) {
                day = i + " 日";
                $("#birth_day").append(new Option(day, i));
                i++;
            }
        }
    }
    
    
    if (month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12) {
        $("#birth_day").empty();
        i = 1;
        j = 0;
        for (j; j < 31; j++) {
            day = i + " 日";
            $("#birth_day").append(new Option(day, i));
            i++;
        }
    }
    
    if (month == 4 || month == 6 || month == 9 || month == 11) {
        $("#birth_day").empty();
        i = 1;
        j = 0;
        for (j; j < 30; j++) {
            day = i + " 日";
            $("#birth_day").append(new Option(day, i));
            i++;
        }
    }
    
    
}

function checkForm(){
    var username = $("#username").val();
    if (IsEmpty(username)) {
        alert("用户名不能为空");
		ResetCode();
        return;
    }
    var email = $("#email").val();
    if (IsEmpty(email)) {
        alert("邮箱不能为空");
		ResetCode();
        return;
    }
    var pattern = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if (!pattern.test(email)) {
        alert("邮箱不合法");
		ResetCode();
        return;
    }
    var code = $("#code").val();
    if (IsEmpty(code)) {
        alert("验证码不能为空");
		ResetCode();
        return;
    }
    
    var birthyear = $("select[name=birthyear]").find("option:selected").val();
    //alert(birthyear);
    var birthmonth = $("select[name=birthmonth]").find("option:selected").val();
    //alert(birthmonth);
    var birth_day = $("select[name=birth_day]").find("option:selected").val();
    // alert(birth_day);
    var myhobby = $("#myhobby").val();
    // alert(myhobby);
    var hometown = $("#hometown").val();
    //alert(hometown);
    var position = $("#position").val();
    //alert(position);
    var phone = $("#phone").val();
    //alert(phone);
    var sex = $('input[name="sex"]:checked').val();
    ///alert(sex);
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
		ResetCode();
        return;
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
		ResetCode();
        return;
    }
    
    //alert("success");
    $.ajax({
        type: "post",
        url: "UserInfo.php",
        data: "action=updateInfo&username=" + username + "&birthyear=" + birthyear +
        "&birthmonth=" +
        birthmonth +
        "&birthday=" +
        birth_day +
        "&myhobby=" +
        myhobby +
        "&hometown=" +
        hometown +
        "&email=" +
        email +
        "&position=" +
        position +
        "&phone=" +
        phone +
        "&sex=" +
        sex,
        async: false,
        global: false,
        success: function(responseText){
            if (responseText) {
                alert("修改成功");
				ResetCode();
				getUserInfo();
            }
            else {
                alert("修改失败");
				ResetCode();
            }
            
        }
    });
    
    
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


function getUserInfo(){
    $.ajax({
        type: "post",
        url: "UserInfo.php",
        data: "action=getuserinfo&type=username",
        global: false,
        success: function(responseText){
            result = responseText;
            //alert(result);
            $("#username").val(responseText);
			$("#currentuser").html(responseText);
			$("#user_name").html(responseText);
        }
    });
    $.ajax({
        type: "post",
        url: "UserInfo.php",
        data: "action=getuserinfo&type=email",
        global: false,
        success: function(responseText){
            result = responseText;
            // alert(result);
            $("#email").val(responseText);
			$("#my_email").html(responseText);
        }
    });
    $.ajax({
        type: "post",
        url: "UserInfo.php",
        data: "action=getuserinfo&type=sex",
        global: false,
        success: function(responseText){
            result = responseText;
            // alert(result);
            $('input[name="sex"]:checked').val(responseText);
            if (responseText == "boy") {
                $("#currentsex").html("男");
				$("#mysex").html("男");
            }
            else {
                $("#mysex").html("女");
				$("#currentsex").html("女");
            }
            
        }
    });
    $.ajax({
        type: "post",
        url: "UserInfo.php",
        data: "action=getuserinfo&type=phone",
        global: false,
        success: function(responseText){
            result = responseText;
            // alert(result);
            $("#phone").val(responseText);
			$("#my_phone").html(responseText);
        }
    });
    $.ajax({
        type: "post",
        url: "UserInfo.php",
        data: "action=getuserinfo&type=position",
        global: false,
        success: function(responseText){
            result = responseText;
            //alert(result);
            $("#position").val(responseText);
			$("#current_pos").html(responseText);
        }
    });
    $.ajax({
        type: "post",
        url: "UserInfo.php",
        data: "action=getuserinfo&type=hometown",
        global: false,
        success: function(responseText){
            result = responseText;
            //alert(result);
            $("#hometown").val(responseText);
			$("#my_hometown").html(responseText);
        }
    });
    $.ajax({
        type: "post",
        url: "UserInfo.php",
        data: "action=getuserinfo&type=birthyear",
        global: false,
        success: function(responseText){
            result = responseText;
            //alert(result);
            $("#birthyear").val(responseText);
        }
    });
    $.ajax({
        type: "post",
        url: "UserInfo.php",
        data: "action=getuserinfo&type=birthday",
        global: false,
        success: function(responseText){
            result = responseText;
            //alert(result);
            $("#birthday").val(responseText);
        }
    });
    $.ajax({
        type: "post",
        url: "UserInfo.php",
        data: "action=getuserinfo&type=birthmonth",
        global: false,
        success: function(responseText){
            result = responseText;
            // alert(result);
            $("#birthmonth").val(responseText);
        }
    });
    $.ajax({
        type: "post",
        url: "UserInfo.php",
        data: "action=getuserinfo&type=myhobby",
        global: false,
        success: function(responseText){
            result = responseText;
            // alert(result);
            $("#myhobby").val(responseText);
			$("#my_hobby").html(responseText);
        }
    });
    $.ajax({
        type: "post",
        url: "UserInfo.php",
        data: "action=getuserinfo&type=date",
        global: false,
        success: function(responseText){
            result = responseText;
            // alert(result);
            $("#currentbirthdate").html(responseText);
			$("#my_birthdate").html(responseText);
        }
    });
    
}
