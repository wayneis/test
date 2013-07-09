<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>注册页面</title>
<style type="text/css">
table {
	position: absolute;
	left: 50%;
	margin-left: -260px;
	width: 520px;
	height: 400px;
	margin-top: 12%;
}

.inputText {
	height: 30px;
	width: 100%;
}

td {
	text-align: center;
	font-family: 华文新魏;
	font-size: 20px;
}

#TaleTitle {
	position: absolute;
	width: 150px;
	height: 40px;
	left: 50%;
	margin-left: -120px;
	padding-top: 5px;
	text-align: center;
	font-size: 30px;
	font-family: 华文新魏;
	margin-top: 7%;
}

.button {
	margin-top: 20px;
	width: 80px;
	height: 40px;
	width: 80px;
}

#code {
	float: left;
	margin-top: 8px;
	height: 30px;
	width: 100px;
	height: 30px;
	height: 30px;
}

#showcode {
	float: left;
	margin-left: 18px;
}
</style>
<script type="text/javascript" charset="gb2312"
	src="javascript/jquery.js"></script>
<script type="text/javascript" charset="gb2312"
	src="javascript/register.js"></script>
</head>


<body>
	<script type="text/javascript">
		//checkUsername();
	</script>
	<div id="TaleTitle">注册页面</div>
	<form action="registerHandler.php?action=register" method="post" onsubmit="return checkForm()">
		<table border="0">
			<tr>
				<td width="18%">用户名</td>
				<td width="50%"><input class="inputText" name="username"
					id="username" type="text" onblur="checkUsername()" /></td>
				<td id="checkUser" width="32%"></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input class="inputText" name="passwd" id="passwd"
					type="password" onblur="checkPWD()" /></td>
				<td id="passwdbox"></td>
			</tr>
			<tr>
				<td>确认密码</td>
				<td><input class="inputText" name="confirmpasswd" id="confirmpasswd"
					type="password" onKeyUp="checkConfirmPasswd()"
					onblur="checkConfirmPasswd()" /></td>
				<td id="confirmpasswdbox"></td>
			</tr>
			<tr>
				<td>性别</td>
				<td align="center"><input name="sex" value="boy" type="radio"
					id="boy" checked /><label for="boy">男</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
					name="sex" value="girl" type="radio" id="girl" /><label for="girl">女</label></td>
				<td></td>
			</tr>
			<tr>
				<td>邮箱</td>
				<td><input class="inputText" name="email" id="email" type="text"
					onblur="checkemail()" onKeyUp="checkemail()"/></td>
				<td id="checkemailbox"></td>
			</tr>
			<tr>
				<td>验证码</td>
				<td><input name="code" id="code" type="text" onblur="checkcode()" onKeyUp="checkcode()"/><span
					id="showcode"><img src="getImage.php?action=getcode" id="imagecode"
						alt="验证码，看不清楚，换一张" onclick="ResetCode()" /></span></td>
				<td id="checkcodebox"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input name="submit" value="注册"
					class="button" type="submit" />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
					class="button" name="reset" value="重置" type="reset"
					onclick="ResetForm()" /></td>
				<td></td>
			</tr>
		</table>

	</form>
</body>
</html>