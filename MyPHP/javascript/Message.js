/*************************
 *                       *
 * 发送消息，接收消息处理        *
 * 字体设置，颜色，大小，        *
 *                       *
 *************************/
$(document).ready(function(){
    var global = $("#mainbody2");
    
    $(".outmenu").mouseover(function(){
        $(this).css("background", "hsla(100, 55%, 65%, 0.5)");
    });
    
    $(".outmenu").mouseout(function(){
        $(this).css("background", "hsla(50, 55%, 65%, 0.5)");
    });
    
    $("#menu1").click(function(){
        if (global.attr("id") == "mainbody1") {
            return;
        }
        
        global.fadeOut("slow");
        $("#mainbody1").fadeIn("slow");
        global = $("#mainbody1");
        
    });
    $("#menu2").click(function(){
        if (global.attr("id") == "mainbody2") {
            return;
        }
        global.fadeOut("slow");
        $("#mainbody2").fadeIn("slow");
        global = $("#mainbody2");
    });
    $("#alluserInfo").click(function(){
        $(this).css("color", "green");
        $("#changeInfo").css("color", "blue");
        $("#content2").fadeOut("slow");
        $("#content1").fadeIn("slow");
    });
    
    $("#changeInfo").click(function(){
        $(this).css("color", "green");
        $("#alluserInfo").css("color", "blue");
        $("#content1").fadeOut("slow");
        $("#content2").fadeIn("slow");
    });
    
    $("#messagetext").keyup(function(e){
        if (e.ctrlKey && e.which == 13) 
            sendmessage();
    })
});

function loadfun(){
    getLoginuser();
    setbirthdate();
    getUserInfo();
    getCurrentState();
    setInterval(getCurrentState, "1500");
    setInterval(recievemessage, "100");
    setInterval(getLoginuser, "1000");
    setInterval(Str_Message, "1000");
    setFonts();
    setFontColor();
    setFontSize();
}

function IsEmpty(String){
    if (String == null || String.length == 0) {
        return true;
    }
    return false;
}

function setFonts(){
    $("#fonts").append(new Option("system", "1"));
    $("#fonts").append(new Option("华文新魏", "2"));
    $("#fonts").append(new Option("华文细黑", "3"));
    $("#fonts").append(new Option("宋体", "4"));
    $("#fonts").append(new Option("楷体", "5"));
}

function changeFonts(){
    var item = $("select[name=fonts]").find("option:selected").text();
    $("#messagetext").css("font-family", item);
}

function setFontSize(){
    for (i = 1; i < 50; i++) {
        $("#size").append(new Option(i, i));
    }
    $("#size").val("20");
    $("#messagetext").css("font-size", "20px");
}

function changeFontSize(){
    var item = $("select[name=size]").find("option:selected").text() + "px";
    $("#messagetext").css("font-size", item);
}

function setFontColor(){
    var colorArray = ["#0000ff", "#008080", "#000000", "#ffffff", "#008000", "#800000", "#808000", "#000080", "#800080", "#808080", "#ffff00", "#00ff00", "#00ffff", "#ff00ff", "#ff0000"];
    for (i = 0; i < 15; i++) {
        var option = document.createElement("option");
        option.value = colorArray[i];
        option.className = "coloroption";
        $("#fontcolor").append(option);
        option.style.background = colorArray[i];
    }
    $("#fontcolor").val("#000000");
    $("#fontcolor").css("background", "#000000");
    
}

function changeFontColor(){
    var item = $("select[name=fontcolor]").find("option:selected").val();
    $("#fontcolor").css("background", item);
    $("#messagetext").css("color", item);
    $("#messagetext").focus();
    
}


function setBoldFont(){
    var checked = $("#boldfont").is(':checked');
    if (checked) {
        $("#messagetext").css("font-weight", "bold");
    }
    else {
        $("#messagetext").css("font-weight", "normal");
    }
}

function sendmessage(){
    var message = $("#messagetext").val();
    var font_family = $("select[name=fonts]").find("option:selected").text();
    var font_size = $("select[name=size]").find("option:selected").text() + "px";
    var font_color = $("select[name=fontcolor]").find("option:selected").val();
    var font_weight;
    var checked = $("#boldfont").is(':checked');
    if (checked) {
        font_weight = "bold";
    }
    else {
        font_weight = "normal";
    }
    //alert(font_family+" "+font_size+" "+font_color+" "+font_weight);
    $("#messagetext").val("");
    if (IsEmpty(message)) {
        alert("没有要发送的消息");
        return;
    }
    $.ajax({
        type: "post",
        url: "MessageHandler.php",
        data: "action=send&message=" + message + "&fontfamily=" + font_family + "&fontcolor=" + font_color + "&fontsize=" + font_size + "&fontweight=" + font_weight,
        global: false,
        success: function(responseText){
            // alert(responseText);
        }
    });
}

function recievemessage(){
    $.ajax({
        type: "post",
        url: "MessageHandler.php",
        data: "action=recieve",
        global: false,
        success: function(responseText){
            if (responseText == null || responseText == "") {
                return;
            }
            else {
                $("#messagebox").append(responseText);
                $(".message").show("slow");
                $("#messagebox").scrollTop($("#messagebox")[0].scrollHeight);
                $("#messagebox").scrollIntoView();
            }
            
        }
    });
}

function getLoginuser(){
    $.ajax({
        type: "post",
        url: "MessageHandler.php",
        data: "action=getLoginuser",
        global: false,
        success: function(responseText){
            $("#loginusertable").html(responseText);
            //$("#loginusertable").show("slow");
        }
    });
}

function gotoGroup(){
    $.ajax({
        type: "post",
        url: "MessageHandler.php",
        data: "action=setTalktype&talktype=group",
        global: false,
        success: function(responseText){
            $("#messagebox").html(null);
            getCurrentState();
        }
    });
}

function logout(){
    alert("注销");
    $.ajax({
        type: "post",
        url: "logout.php",
        global: false,
        async: false,
        success: function(responseText){
            if (responseText) {
                alert("注销成功");
                window.open("", "_self")
                window.close();
            }
            else {
                alert("注销失败");
            }
            
            
        }
    });
    
}

function talk(username){
    $.ajax({
        type: "post",
        url: "MessageHandler.php",
        data: "action=setTalktype&talktype=single&recieveuser=" + username,
        global: false,
        success: function(responseText){
            if (responseText) {
                $("#messagebox").html(null);
                getCurrentState();
            }
            
        }
    });
}

function getCurrentState(){
    $.ajax({
        type: "post",
        url: "MessageHandler.php",
        data: "action=getcurrentstate",
        global: false,
        success: function(responseText){
            if (responseText) {
                $("#head1").html(responseText);
            }
            
        }
    });
}

function Str_Message(){
    $.ajax({
        type: "post",
        url: "UserInfo.php",
        data: "action=checkmessage",
        global: false,
        success: function(responseText){
            if (IsEmpty(responseText)) {
                $("#checkmessage").html(responseText);
                $("#dialog").hide("slow");
            }
            else {
            
                $("#checkmessage").html(responseText);
                $("#dialog").show("slow");
            }
        }
    });
}







