<?php
header ( "content-type:text/html;charset=gb2312" );
include ("ActionDAO.php");
if (isset ( $_REQUEST ["action"] )) {
	$action = $_REQUEST ["action"];
}

if (isset ( $action )) {
	$ActionDAO = new ActionDAO ();
	if (strcmp ( $action, "login" ) == 0) {
		if (! isset ( $_REQUEST ["username"] )) {
			echo "no username";
			exit ();
		}
		if (! isset ( $_REQUEST ["passwd"] )) {
			echo "no passwd";
			exit ();
		}
		$username = $_REQUEST ["username"];
		$username = iconv ( "utf-8", "gb2312", $username );
		$passwd = $_REQUEST ["passwd"];
		$result = $ActionDAO->CheckUser ( $username, $passwd );
		if (! $result) {
			echo "sql error";
			exit ();
		}
		$arr = mysql_fetch_array ( $result );
		if ($arr == null) {
			echo "<script>alert('��¼ʧ��,�û�������');</script>";
			exit ();
		} else {
			session_start ();
			if (! isset ( $_SESSION ["login"] )) {
				$isLogined = $ActionDAO->IsLogined ( $username );
				if (strcmp ( $isLogined, "error_1" ) == 0) {
					echo "<script>alert('�������˴���');</script>";
					echo "<script>window.location.href='login.php'</script>";
					exit ();
				}
				if (strcmp ( $isLogined, "error_2" ) == 0) {
					echo "<script>alert('�����ڱ𴦵�¼');</script>";
					echo "<script>window.location.href='login.php'</script>";
					exit ();
				}
				$_SESSION ["username"] = $username;
				$_SESSION ["login"] = true;
				$_SESSION ["talk_type"] = "group";
				$_SESSION ["count"] = $ActionDAO->getTopMessageId ();
				$_SESSION ["messagelock"] = false;
				$_SESSION ["firstRecieveGroup"] = true;
				$_SESSION ["firstRecieveSingal"] = true;
				$result = $ActionDAO->InsertLoginUser ( $username );
				if (! $result) {
					echo "<script>alert('��¼ʧ��');</script>";
					echo "<script>window.location.href='login.php'</script>";
					exit ();
				}
				echo "<script>alert('��¼�ɹ�');</script>";
				echo "<script>window.location.href='main.php'</script>";
			} else {
				$login = $_SESSION ["login"];
				if ($login) {
					echo "<script>alert('��¼�ɹ�');</script>";
					echo "<script>window.location.href='main.php'</script>";
				}
			}
		}
	}
	
	if (strcmp ( $action, "checkuser" ) == 0) {
		if (! isset ( $_REQUEST ["username"] )) {
			echo "no username";
			exit ();
		}
		$username = $_REQUEST ["username"];
		$username = iconv ( "utf-8", "gb2312", $username );
		$result = $ActionDAO->findByUsername ( $username );
		if ($result == null) {
			echo "sql error";
			exit ();
		}
		$arr = mysql_fetch_array ( $result );
		if ($arr == null) {
			echo "<font style='color:red'>�û���������</font>";
		} else {
			echo "<font style='color:gray'>�û�����ȷ</font>";
		}
	}
}