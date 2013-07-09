<?php
require_once 'testLogin.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>主页</title>
<script type="text/javascript" charset="gb2312"
	src="javascript/jquery.js"></script>
<script type="text/javascript" charset="gb2312" src="javascript/Info.js"></script>
<script type="text/javascript" charset="gb2312"
	src="javascript/Message.js"></script>
<link rel="stylesheet" href="css/main.css">
</head>
<body id="body" onload="loadfun()">

	<div id="head">
		<div id="subhead1">
			<div id="subhead3">&nbsp;AMAZING CHATTING</div>

			<div id="menu">
				<ul id="headul">
					<li class="outmenu" id="menu1">我的主页</li>
					<li class="outmenu" id="menu2">聊天室</li>
				</ul>
			</div>

		</div>
		<div id="subhead2">
			<embed height="100" width="310" src="flash/q.swf"
				type="application/x-shockwave-flash" wmode="transparent" loop="true"></embed>
		</div>
	</div>


	<div id="mainbody1">
		<div id="leftmenu">
			<div id="head_sculpture">
				<div id="picture">
					<img alt="头像" src="images/head_1.gif">
				</div>
				<div id="simpleinfo">
					<div id="currentuser"></div>
					<div id="currentsex">男</div>
					<div id="currentbirthdate">1993.08.08</div>
				</div>
			</div>
			<div id="choice">
				<ul>
					<li><a href="#" id="alluserInfo">详细资料</a></li>
					<li><a href="#" id="changeInfo">修改资料</a></li>
				</ul>
			</div>
		</div>
		<div id="content1">
			<div id="content1_title">我的资料:</div>
			<table>
				<tr>
					<td width="23%">用户名：</td>
					<td id="user_name"></td>
				</tr>
				<tr>
					<td>性别：</td>
					<td id="mysex"></td>
				</tr>
				<tr>
					<td>出生日期：</td>
					<td id="my_birthdate"></td>
				</tr>
				<tr>
					<td>我的爱好：</td>
					<td id="my_hobby"></td>
				</tr>
				<tr>
					<td>我的家乡：</td>
					<td id="my_hometown"></td>
				</tr>
				<tr>
					<td>当前居住：</td>
					<td id="current_pos"></td>
				</tr>
				<tr>
					<td>我的邮箱：</td>
					<td id="my_email"></td>
				</tr>
				<tr>
					<td>我的电话：</td>
					<td id="my_phone"></td>
				</tr>
			</table>
		</div>
		<div id="content2">
			<form action="" method="post">
				<table border="0">
					<tr>
						<td width="18%">用户名</td>
						<td width="50%"><input class="inputText" name="username"
							id="username" type="text" onblur="checkUsername()"
							onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';" /></td>
						<td id="checkUser" width="32%"></td>
					</tr>
					<tr>
						<td>出生年月</td>
						<td><select name="birthyear" id="birthyear" onclick="setyear()"
							onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';"></select><select
							id="birthmonth" onclick="setmonth()" name="birthmonth"
							onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';"></select> <select
							id="birth_day" name="birth_day"
							onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';"></select></td>
						<td></td>
					</tr>
					<tr>
						<td>我的爱好</td>
						<td><textarea id="myhobby" class="inputText"
								onmouseover="this.style.borderColor='red';"
								onmouseout="this.style.borderColor='black';"></textarea></td>
						<td id="hobby"></td>
					</tr>
					<tr>
						<td>性别</td>
						<td align="center"><input name="sex" value="boy" type="radio"
							id="boy" checked /><label for="boy">男</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
							name="sex" value="girl" type="radio" id="girl" /><label
							for="girl">女</label></td>
						<td></td>
					</tr>
					<tr>
						<td>故乡</td>
						<td><input class="inputText" name="hometown" id="hometown"
							type="text" onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';" /></td>
						<td id="checkhometownbox"></td>
					</tr>
					<tr>
						<td>所在地</td>
						<td><input class="inputText" name="position" id="position"
							type="text" onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';" /></td>
						<td id="checkcurrentpositionbox"></td>
					</tr>
					<tr>
						<td>邮箱</td>
						<td><input class="inputText" name="email" id="email" type="text"
							onblur="checkemail()" onKeyUp="checkemail()"
							onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';" /></td>
						<td id="checkemailbox"></td>
					</tr>
					<tr>
						<td>电话</td>
						<td><input class="inputText" name="phone" id="phone" type="text"
							onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';" /></td>
						<td id="checkphonebox"></td>
					</tr>
					<tr>
						<td>验证码</td>
						<td><input name="code" id="code" type="text" onblur="checkcode()"
							onKeyUp="checkcode()" onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';" /><span
							id="showcode"><img src="getImage.php?action=getcode"
								id="imagecode" alt="验证码，看不清楚，换一张" onclick="ResetCode()" /></span></td>
						<td id="checkcodebox"></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input name="submit"
							onmouseover="this.style.backgroundPosition='left -36px'"
							onmouseout="this.style.backgroundPosition='left top'" value="提交"
							class="button" type="button" onclick="checkForm()" />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input
							class="button" name="reset" value="重置"
							onmouseover="this.style.backgroundPosition='left -36px'"
							onmouseout="this.style.backgroundPosition='left top'"
							type="reset" onclick="ResetForm()" /></td>
						<td></td>
					</tr>
				</table>

			</form>


		</div>
	</div>

	<div id="mainbody2">
		<div id="messageBlock">
			<div id="head1"></div>
			<div id="messagebox"></div>
			<div id="messagemenu">
				字体&nbsp; <select id="fonts" name="fonts"
					onchange="changeFonts(this.option)"></select> &nbsp;&nbsp; <input
					type="checkbox" name="boldfont" id="boldfont"
					onclick="setBoldFont()" />&nbsp; 粗体 &nbsp;&nbsp; 大小&nbsp; <select
					id="size" name="size" onchange="changeFontSize()"></select>
				&nbsp;&nbsp; 颜色&nbsp; <select id="fontcolor" name="fontcolor"
					onchange="changeFontColor()"></select>
			</div>
			<div id="inputbox">
				<textarea id="messagetext"></textarea>
				<div id="buttonbox">
					<input id="send" value="send" name="send" type="button"
						onclick="sendmessage()" />
				</div>
			</div>
		</div>
		<div id="listBlock">
			<div id="head2">登录用户列表</div>
			<div id="listofuser">
				<table id="tablehead">
					<tr class="tabletitle">
						<td width="15%">ID</td>
						<td width="45%">用户名</td>
						<td width="40%">操作</td>
					</tr>
				</table>
				<hr>
				<table id="loginusertable">
				</table>
			</div>
		</div>
	</div>
	<div id="mainbody3"></div>


	<div id="dialog">
		<div id="dialogtitle">消息提示：</div>
		<div id="checkmessage"></div>
	</div>
</body>
</html>