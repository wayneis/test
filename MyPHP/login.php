<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��½����</title>
<style type="text/css">
body
{
	background: url(images/2.png);
	font-family:����;
}
table {
	position: absolute;
	left: 50%;
	margin-top: 16%;
	margin-left: -320px;
	width: 500px;
	height: 260px;
	width: 500px;
	border-radius: 5px; 
	-moz-border-radius: 5px;
	background-color:hsla(200,55%,65%,0.2);
}

.inputtext {
	width: 98%;
	height: 30px;
	background:transparent;
	border:1.1px solid #000000;
	border-radius: 6px; 
	-moz-border-radius: 6px;
	font-size:18px;
	
	
	
}

#caption {
	position: absolute;
	left: 50%;
	margin-left: -190px;
	text-align: center;
	padding-top: 5px;
	width: 200px;
	height: 40px;
	font-size: 30px;
	font-family: ������κ;
	margin-top: 10%;
}
input
{
	border:0px;
	margin:8px;
}
#submit {
	width:137px;
	height:34px;
	font-size:20px;
	font-family:������κ;
	background:url("images/bg26.jpg") no-repeat;
	border-radius: 5px; 
	-moz-border-radius: 5px;
	
	
}


td {
	
	font-size: 20px;
	font-family: ������κ;
	text-align:center;
}

</style>
<script type="text/javascript" charset="gb2312"
	src="javascript/jquery.js"></script>
<script type="text/javascript" charset="gb2312"
	src="javascript/login.js"></script>
</head>
<Script Language="javascript">
function  result(){
 window.location.href='register.php';}
</Script>
<body>
	<div id="caption">��&nbsp;½&nbsp;ҳ&nbsp;��</div>
	<form action="LoginHandler.php?action=login" method="post" onsubmit="return checkForm()">
		<table>
			
			<tr>
				<td class="text" width="20%" >�û���</td>
				<td width="50%"><input class="inputtext" name="username" type="text" onmouseover="this.style.borderColor='red';" 
 onmouseout="this.style.borderColor='black';"
					id="username" onblur="checkloginuser()" /></td>
				<td id="checkUser" width="30%"></td>
			</tr>
			<tr>
				<td class="text" >��&nbsp;&nbsp;&nbsp;��</td>
				<td><input class="inputtext" name="passwd" id="passwd" onmouseover="this.style.borderColor='red';" 
 onmouseout="this.style.borderColor='black';"  type="password" onblur="checkpasswd()" /></td>
				<td id="checkPasswd"></td>
			</tr>
			<tr>
				<td colspan="2" id="buttonbox">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="submit" name="submit" onmouseover="this.style.backgroundPosition='left -36px'" onmouseout="this.style.backgroundPosition='left top'"
					type="submit" value="��  ¼" /> <input id="submit" name="submit" onmouseover="this.style.backgroundPosition='left -36px'" onmouseout="this.style.backgroundPosition='left top'"
					type="button" value="ע  ��" OnClick="result()"/></td>
				
			</tr>
		</table>
	</form>
</body>
</html>
