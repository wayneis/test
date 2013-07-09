<?php
header ( "content-type:text/html;charset=gb2312" );
include ("ActionDAO.php");
session_start ();
if (isset ( $_REQUEST ["action"] )) {
	$action = $_REQUEST ["action"];
}

if (isset ( $action )) {
	$ActionDAO = new ActionDAO ();
	if (strcmp ( $action, "register" ) == 0) {
		if (! isset ( $_REQUEST ["username"] )) {
			echo "false";
		}
		if (! isset ( $_REQUEST ["passwd"] )) {
			echo "false";
		}
		if (! isset ( $_REQUEST ["sex"] )) {
			echo "false";
		}
		if (! isset ( $_REQUEST ["email"] )) {
			echo "false";
		}
		$username = $_REQUEST ["username"];
		$username = iconv ( "utf-8", "gb2312", $username );
		$passwd = $_REQUEST ["passwd"];
		$sex = $_REQUEST ["sex"];
		$email = $_REQUEST ["email"];
		$result = $ActionDAO->InsertUser ( $username, $passwd, $email, $sex );
		if (! $result) {
			echo "<script>×¢²áÊ§°Ü</script>";
			echo "<script>window.location.href='register.php'</script>";
		} else {
			echo "<script>alert('×¢²á³É¹¦');</script>";
			echo "<script>window.location.href='login.php';</script>";
		}
	}
	
	if (strcmp ( $action, "checkuser" ) == 0) {
		if (! isset ( $_REQUEST ["username"] )) {
			echo "error_1";
			exit ();
		}
		$username = $_REQUEST ["username"];
		$username = iconv ( "utf-8", "gb2312", $username );
		$result = $ActionDAO->findByUsername ( $username );
		$arr = mysql_fetch_array ( $result );
		if ($arr == null) {
			echo "pass";
		} else {
			echo "error_2";
		}
	}
	
	if (strcmp ( $action, "checkcode" ) == 0) {
		if (! isset ( $_REQUEST ["code"] )) {
			echo "error_1";
			exit ();
		}
		$code = $_REQUEST ["code"];
		if (! isset ( $_SESSION ["code"] )) {
			echo "error_2";
			exit ();
		}
		if (strcmp ( $code, $_SESSION ["code"] ) == 0) {
			echo "pass";
		} else {
			echo "error_3";
			// echo $_SESSION["code"];
		}
	}
}
















