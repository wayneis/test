<?php
header ( "content-type:text/html;chaset:gb2312" );
include 'ActionDAO.php';
session_start ();

if (Isset ( $_REQUEST ["action"] )) {
	$ActionDAO = new ActionDAO ();
	$action = $_REQUEST ["action"];
	if (strcmp ( $action, "updateInfo" ) == 0) {
		
		$oldusername = $_SESSION ["username"];
		$oldresult = $ActionDAO->getuserInfo ( $oldusername );
		$username = iconv ( "utf-8", "gb2312", $_REQUEST ["username"] );
		$birthyear = $_REQUEST ["birthyear"];
		$birthmonth = $_REQUEST ["birthmonth"];
		$birth_day = $_REQUEST ["birthday"];
		$myhobby = iconv ( "utf-8", "gb2312", $_REQUEST ["myhobby"] );
		$sex = $_REQUEST ["sex"];
		$phone = $_REQUEST ["phone"];
		$position = iconv ( "utf-8", "gb2312", $_REQUEST ["position"] );
		$hometown = iconv ( "utf-8", "gb2312", $_REQUEST ["hometown"] );
		$email = $_REQUEST ["email"];
		$result = $ActionDAO->updateInfo ( $oldusername, $username, $email, $sex, $phone, $position, $hometown, $myhobby, $birthyear, $birthmonth, $birth_day );
		
		if ($result) {
			$ActionDAO->updateLoginuser ( $oldusername, $username );
			$ActionDAO->update ( $oldusername, $username );
			$_SESSION ["username"] = $username;
			echo "true";
		} else {
			$arr = mysql_fetch_array ( $oldresult );
			$ActionDAO->updateInfo ( $oldusername, $arr ["username"], $arr ["email"], $arr ["sex"], $arr ["phone"], $arr ["position"], $arr ["hometown"], $arr ["myhobby"], $arr ["birthyear"], $arr ["birthmonth"], $arr ["birthday"] );
			
			echo "false";
		}
	}
	
	if (strcmp ( $action, "getuserinfo" ) == 0) {
		$type = $_REQUEST ["type"];
		$username = $_SESSION ["username"];
		$result = $ActionDAO->getuserInfo ( $username );
		$arr = mysql_fetch_array ( $result );
		if (strcmp ( $type, "username" ) == 0) {
			echo $arr ["username"];
		}
		if (strcmp ( $type, "email" ) == 0) {
			echo $arr ["email"];
		}
		if (strcmp ( $type, "sex" ) == 0) {
			echo $arr ["sex"];
		}
		if (strcmp ( $type, "phone" ) == 0) {
			echo $arr ["phone"];
		}
		if (strcmp ( $type, "position" ) == 0) {
			echo $arr ["position"];
		}
		if (strcmp ( $type, "hometown" ) == 0) {
			echo $arr ["hometown"];
		}
		if (strcmp ( $type, "birthday" ) == 0) {
			echo $arr ["birthday"];
		}
		if (strcmp ( $type, "birthyear" ) == 0) {
			echo $arr ["birthyear"];
		}
		if (strcmp ( $type, "birthmonth" ) == 0) {
			echo $arr ["birthmonth"];
		}
		if (strcmp ( $type, "date" ) == 0) {
			echo $arr ["birthyear"] . "." . $arr ["birthmonth"] . "." . $arr ["birthday"];
		}
		if (strcmp ( $type, "myhobby" ) == 0) {
			echo $arr ["myhobby"];
		}
	}
	
	if (strcmp ( $action, "checkmessage" ) == 0) {
		$talktype = $_SESSION ["talk_type"];
		if (strcmp ( $talktype, "single" ) == 0) {
			$recieveuser = $_SESSION ["username"];
			$senduser = $_SESSION ["recieveuser"];
			$count = $_SESSION ["count"];
			$count2 = $ActionDAO->getTopMessageId ();
			if ($count2 > $count) {
				echo "<font color='red'>群里有新消息</font><br>";
			}
			$result = $ActionDAO->checkMessage_2 ( $recieveuser, $senduser );
			while ( ($arr = mysql_fetch_array ( $result )) != NULL ) {
				echo "你有来自<font color='red'>" . $arr ["senduser"] . "</font>的新消息!<br>";
			}
		} 

		else {
			$recieveuser = $_SESSION ["username"];
			$result = $ActionDAO->checkMessage_1 ( $recieveuser );
			while ( ($arr = mysql_fetch_array ( $result )) != NULL ) {
				echo "你有来自<font color='red'>" . $arr ["senduser"] . "</font>的新消息！";
			}
		}
	}
}




