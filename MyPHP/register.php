<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>ע��ҳ��</title>
<style type="text/css">
body {
	background: url(images/2.png);
}

table {
	position: absolute;
	left: 50%;
	margin-left: -340px;
	width: 520px;
	height: 400px;
	margin-top: 12%;
	background-color: hsla(200, 65%, 75%, 0.5);
	border-radius: 5px;
	-moz-border-radius: 5px;
}

.inputText {
	height: 30px;
	width: 100%;
	background: transparent;
	border: 1.1px solid #000000;
	border-radius: 6px;
	-moz-border-radius: 6px;
	font-size: 18px;
}

td {
	text-align: center;
	font-family: ������κ;
	font-size: 20px;
}

#TaleTitle {
	position: absolute;
	width: 150px;
	height: 40px;
	left: 50%;
	margin-left: -200px;
	padding-top: 5px;
	text-align: center;
	font-size: 30px;
	font-family: ������κ;
	margin-top: 7%;
}

.button {
	margin-top: 20px;
	width: 137px;
	height: 34px;
	font-size: 20px;
	font-family: ������κ;
	border: 0px;
	background: url("images/bg26.jpg") no-repeat;
	border-radius: 5px;
	-moz-border-radius: 5px;
}

#code {
	float: left;
	margin-top: 8px;
	height: 30px;
	width: 100px;
	height: 30px;
	height: 30px;
	background: transparent;
	border: 1.1px solid #000000;
	border-radius: 6px;
	-moz-border-radius: 6px;
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
	<div id="TaleTitle">ע��ҳ��</div>
	<form action="registerHandler.php?action=register" method="post"
		onsubmit="return checkForm()">
		<table border="0">
			<tr>
				<td width="18%">�û���</td>
				<td width="50%"><input class="inputText" name="username"
					onmouseover="this.style.borderColor='red';"
					onmouseout="this.style.borderColor='black';" id="username"
					type="text" onblur="checkUsername()" /></td>
				<td id="checkUser" width="32%"></td>
			</tr>
			<tr>
				<td>����</td>
				<td><input class="inputText" name="passwd" id="passwd"
					onmouseover="this.style.borderColor='red';"
					onmouseout="this.style.borderColor='black';" type="password"
					onblur="checkPWD()" /></td>
				<td id="passwdbox"></td>
			</tr>
			<tr>
				<td>ȷ������</td>
				<td><input class="inputText" name="confirmpasswd"
					onmouseover="this.style.borderColor='red';"
					onmouseout="this.style.borderColor='black';" id="confirmpasswd"
					type="password" onKeyUp="checkConfirmPasswd()"
					onblur="checkConfirmPasswd()" /></td>
				<td id="confirmpasswdbox"></td>
			</tr>
			<tr>
				<td>�Ա�</td>
				<td align="center"><input name="sex" value="boy" type="radio"
					id="boy" checked /><label for="boy">��</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
					name="sex" value="girl" type="radio" id="girl" /><label for="girl">Ů</label></td>
				<td></td>
			</tr>
			<tr>
				<td>����</td>
				<td><input class="inputText" name="email" id="email" type="text"
					onmouseover="this.style.borderColor='red';"
					onmouseout="this.style.borderColor='black';" onblur="checkemail()"
					onKeyUp="checkemail()" /></td>
				<td id="checkemailbox"></td>
			</tr>
			<tr>
				<td>��֤��</td>
				<td><input name="code" id="code" type="text" onblur="checkcode()"
					onmouseover="this.style.borderColor='red';"
					onmouseout="this.style.borderColor='black';" onKeyUp="checkcode()" /><span
					id="showcode"><img src="getImage.php?action=getcode" id="imagecode"
						alt="��֤�룬�����������һ��" onclick="ResetCode()" /></span></td>
				<td id="checkcodebox"></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input name="submit"
					onmouseover="this.style.backgroundPosition='left -36px'"
					onmouseout="this.style.backgroundPosition='left top'" value="ע��"
					class="button" type="submit" />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input
					class="button" name="reset" value="����"
					onmouseover="this.style.backgroundPosition='left -36px'"
					onmouseout="this.style.backgroundPosition='left top'" type="reset"
					onclick="ResetForm()" /></td>
				<td></td>
			</tr>
		</table>

	</form>
</body>
</html>