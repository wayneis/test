<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��½����</title>
<style type="text/css">
table {
	position: absolute;
	left: 50%;
	margin-top: 16%;
	margin-left: -220px;
	width: 500px;
	height: 260px;
	width: 500px;
}

.inputtext {
	width: 100%;
	height: 30px;
}

#caption {
	position: absolute;
	left: 50%;
	margin-left: -120px;
	text-align: center;
	padding-top: 5px;
	width: 200px;
	height: 40px;
	font-size: 30px;
	font-family: ������κ;
	margin-top: 10%;
}

#submit {
	width: 80px;
	height: 40px;
}


#submit {
	margin-right: 2cm;
}

td {
	text-align: center;
	font-size: 20px;
	font-family: ������κ;
}

#buttonbox {
	padding-top: 20px;
	
}
</style>
<script type="text/javascript" charset="gb2312"
	src="javascript/jquery.js"></script>
<script type="text/javascript" charset="gb2312"
	src="javascript/login.js"></script>
</head>
<body>
	<div id="caption">��½ҳ��</div>
	<form action="LoginHandler.php?action=login" method="post" onsubmit="return checkForm()">
		<table>
			<tr>
				<td class="text" width="20%">�û���</td>
				<td width="50%"><input class="inputtext" name="username" type="text"
					id="username" onblur="checkloginuser()" /></td>
				<td id="checkUser" width="30%"></td>
			</tr>
			<tr>
				<td class="text">����</td>
				<td><input class="inputtext" name="passwd" id="passwd"
					type="password" onblur="checkpasswd()" /></td>
				<td id="checkPasswd"></td>
			</tr>
			<tr>
				<td colspan="2" id="buttonbox"><input id="submit" name="submit"
					type="submit" value="��½" /> <a href="register.html">ע��&#62;&#62;</a></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>
