<?php
require_once 'testLogin.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>��ҳ</title>
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
					<li class="outmenu" id="menu1">�ҵ���ҳ</li>
					<li class="outmenu" id="menu2">������</li>
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
					<img alt="ͷ��" src="images/head_1.gif">
				</div>
				<div id="simpleinfo">
					<div id="currentuser"></div>
					<div id="currentsex">��</div>
					<div id="currentbirthdate">1993.08.08</div>
				</div>
			</div>
			<div id="choice">
				<ul>
					<li><a href="#" id="alluserInfo">��ϸ����</a></li>
					<li><a href="#" id="changeInfo">�޸�����</a></li>
				</ul>
			</div>
		</div>
		<div id="content1">
			<div id="content1_title">�ҵ�����:</div>
			<table>
				<tr>
					<td width="23%">�û�����</td>
					<td id="user_name"></td>
				</tr>
				<tr>
					<td>�Ա�</td>
					<td id="mysex"></td>
				</tr>
				<tr>
					<td>�������ڣ�</td>
					<td id="my_birthdate"></td>
				</tr>
				<tr>
					<td>�ҵİ��ã�</td>
					<td id="my_hobby"></td>
				</tr>
				<tr>
					<td>�ҵļ��磺</td>
					<td id="my_hometown"></td>
				</tr>
				<tr>
					<td>��ǰ��ס��</td>
					<td id="current_pos"></td>
				</tr>
				<tr>
					<td>�ҵ����䣺</td>
					<td id="my_email"></td>
				</tr>
				<tr>
					<td>�ҵĵ绰��</td>
					<td id="my_phone"></td>
				</tr>
			</table>
		</div>
		<div id="content2">
			<form action="" method="post">
				<table border="0">
					<tr>
						<td width="18%">�û���</td>
						<td width="50%"><input class="inputText" name="username"
							id="username" type="text" onblur="checkUsername()"
							onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';" /></td>
						<td id="checkUser" width="32%"></td>
					</tr>
					<tr>
						<td>��������</td>
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
						<td>�ҵİ���</td>
						<td><textarea id="myhobby" class="inputText"
								onmouseover="this.style.borderColor='red';"
								onmouseout="this.style.borderColor='black';"></textarea></td>
						<td id="hobby"></td>
					</tr>
					<tr>
						<td>�Ա�</td>
						<td align="center"><input name="sex" value="boy" type="radio"
							id="boy" checked /><label for="boy">��</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input
							name="sex" value="girl" type="radio" id="girl" /><label
							for="girl">Ů</label></td>
						<td></td>
					</tr>
					<tr>
						<td>����</td>
						<td><input class="inputText" name="hometown" id="hometown"
							type="text" onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';" /></td>
						<td id="checkhometownbox"></td>
					</tr>
					<tr>
						<td>���ڵ�</td>
						<td><input class="inputText" name="position" id="position"
							type="text" onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';" /></td>
						<td id="checkcurrentpositionbox"></td>
					</tr>
					<tr>
						<td>����</td>
						<td><input class="inputText" name="email" id="email" type="text"
							onblur="checkemail()" onKeyUp="checkemail()"
							onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';" /></td>
						<td id="checkemailbox"></td>
					</tr>
					<tr>
						<td>�绰</td>
						<td><input class="inputText" name="phone" id="phone" type="text"
							onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';" /></td>
						<td id="checkphonebox"></td>
					</tr>
					<tr>
						<td>��֤��</td>
						<td><input name="code" id="code" type="text" onblur="checkcode()"
							onKeyUp="checkcode()" onmouseover="this.style.borderColor='red';"
							onmouseout="this.style.borderColor='black';" /><span
							id="showcode"><img src="getImage.php?action=getcode"
								id="imagecode" alt="��֤�룬�����������һ��" onclick="ResetCode()" /></span></td>
						<td id="checkcodebox"></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input name="submit"
							onmouseover="this.style.backgroundPosition='left -36px'"
							onmouseout="this.style.backgroundPosition='left top'" value="�ύ"
							class="button" type="button" onclick="checkForm()" />
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input
							class="button" name="reset" value="����"
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
				����&nbsp; <select id="fonts" name="fonts"
					onchange="changeFonts(this.option)"></select> &nbsp;&nbsp; <input
					type="checkbox" name="boldfont" id="boldfont"
					onclick="setBoldFont()" />&nbsp; ���� &nbsp;&nbsp; ��С&nbsp; <select
					id="size" name="size" onchange="changeFontSize()"></select>
				&nbsp;&nbsp; ��ɫ&nbsp; <select id="fontcolor" name="fontcolor"
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
			<div id="head2">��¼�û��б�</div>
			<div id="listofuser">
				<table id="tablehead">
					<tr class="tabletitle">
						<td width="15%">ID</td>
						<td width="45%">�û���</td>
						<td width="40%">����</td>
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
		<div id="dialogtitle">��Ϣ��ʾ��</div>
		<div id="checkmessage"></div>
	</div>
</body>
</html>