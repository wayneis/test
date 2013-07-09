<?php
header ( "content-type:text/html;charset=gb2312" );
include ("SQLConn.php");
class ActionDAO {
	private $ConnDB;
	function ActionDAO() {
		$this->ConnDB = new ConnDB ();
	}
	function CheckUser($username, $passwd) {
		$sql = "select * from userinfo where username = '$username' and passwd = '$passwd'";
		$result = $this->ConnDB->ExcQuery ( $sql );
		return $result;
	}
	function InsertUser($username, $passwd, $email, $sex) {
		$sql = "insert into userinfo (username,passwd,sex,email) values ('$username','$passwd','$sex','$email')";
		$result = $this->ConnDB->ExcQuery ( $sql );
		return $result;
	}
	function findByUsername($username) {
		$sql = "select username from userinfo where username = '$username' ";
		$result = $this->ConnDB->ExcQuery ( $sql );
		if (! $result) {
			echo null;
		}
		return $result;
	}
	function InsertLoginUser($username) {
		$sql = "insert into loginuser (username) values ('$username')";
		$result = $this->ConnDB->ExcQuery ( $sql );
		return $result;
	}
	function getTopMessageId() {
		$sql = "select max(id) as maxid from groupmessage";
		$result = $this->ConnDB->ExcQuery ( $sql );
		if (! $result) {
			return - 1;
		}
		$arr = mysql_fetch_array ( $result );
		return $arr ["maxid"];
	}
	function IsLogined($username) {
		$sql = "select * from loginuser where username = '$username'";
		$result = $this->ConnDB->ExcQuery ( $sql );
		if (! $result) {
			return "error_1";
		}
		$arr = mysql_fetch_array ( $result );
		if ($arr == null) {
			return "pass";
		} else {
			return "error_2";
		}
	}
	function InsertGroupMessage($username, $message, $fontfamily, $fontcolor, $fontsize, $fontweight) {
		date_default_timezone_set ( "Asia/Shanghai" );
		$date = date ( "Y-m-d" );
		$time = date ( "H:i:s" );
		$sql = "insert into groupmessage (senduser,message,date,time,fontfamily,fontsize,fontcolor,fontweight) " . "values ('$username','$message','$date','$time','$fontfamily','$fontsize','$fontcolor','$fontweight')";
		$result = $this->ConnDB->ExcQuery ( $sql );
		if (! $result)
			return false;
		return true;
	}
	function getGroupMessage($maxId, $minId) {
		$sql = "select * from groupmessage where id > '$minId' and id <= '$maxId'";
		$result = $this->ConnDB->ExcQuery ( $sql );
		return $result;
	}
	function getLoginuser() {
		$sql = "select * from loginuser";
		$result = $this->ConnDB->ExcQuery ( $sql );
		return $result;
	}
	function getMessage($username, $recieveuser) {
		$sql = "select * from message where (senduser = '$username' and recieveuser='$recieveuser' and senduserreaded = 0 ) or " . "(recieveuser = '$username' and senduser='$recieveuser' and recieveuserreaded = 0)";
		$result = $this->ConnDB->ExcQuery ( $sql );
		return $result;
	}
	function getMessageById($maxid, $minid) {
		$sql = "select * from message where id > '$minid' and id <= '$maxid'";
		$result = $this->ConnDB->ExcQuery ( $sql );
		return $result;
	}
	function InsertMessage($message, $senduser, $recieveuser, $fontfamily, $fontcolor, $fontsize, $fontweight) {
		date_default_timezone_set ( "Asia/Shanghai" );
		$date = date ( "Y-m-d" );
		$time = date ( "H:i:s" );
		$sql = "insert into message (senduser,recieveuser,message,date,time,senduserreaded,recieveuserreaded,fontfamily,fontsize,fontcolor,fontweight) values " . "('$senduser','$recieveuser','$message','$date','$time','0','0','$fontfamily','$fontsize','$fontcolor','$fontweight')";
		$result = $this->ConnDB->ExcQuery ( $sql );
		return $result;
	}
	function setReaded($id, $type) {
		if (strcmp ( $type, "senduser" ) == 0) {
			$sql = "update message set senduserreaded = 1 where id = '$id'";
			$result = $this->ConnDB->ExcQuery ( $sql );
			return $result;
		}
		if (strcmp ( $type, "recieveuser" ) == 0) {
			$sql = "update message set recieveuserreaded = 1 where id = '$id'";
			$result = $this->ConnDB->ExcQuery ( $sql );
			return $result;
		}
	}
	function deleteLoginuser($username) {
		$sql = "delete from loginuser where username = '$username'";
		$result = $this->ConnDB->ExcQuery ( $sql );
		return $result;
	}
	function getTopId() {
		$sql = "select max(id) as maxid from message";
		$result = $this->ConnDB->ExcQuery ( $sql );
		$result = $this->ConnDB->ExcQuery ( $sql );
		if (! $result) {
			return - 1;
		}
		$arr = mysql_fetch_array ( $result );
		return $arr ["maxid"];
	}
	function updateInfo($oldusername, $username, $email, $sex, $phone, $position, $hometown, $myhobby, $birthyear, $birthmonth, $birthday) {
		$sql = "update userinfo set username= '$username' , email= '$email' , sex = '$sex' , phone = '$phone'" . ", position = '$position' , hometown = '$hometown' , myhobby = '$myhobby' , birthyear = '$birthyear' " . ", birthmonth = '$birthmonth' , birthday = '$birthday' where username = '$oldusername'";
		$result = $this->ConnDB->ExcQuery ( $sql );
		if (! $result) {
			return false;
		} else {
			return true;
		}
	}
	function updateLoginuser($oldusername, $username) {
		$sql = "update loginuser set username = '$username' where username = '$oldusername'";
		$result = $this->ConnDB->ExcQuery ( $sql );
		if ($result)
			return true;
		else
			return false;
	}
	function getuserInfo($username) {
		$sql = "select * from userinfo where username = '$username'";
		$result = $this->ConnDB->ExcQuery ( $sql );
		return $result;
	}
	function checkMessage_1($recieveuser) {
		$sql = "SELECT distinct senduser FROM message where recieveuser='$recieveuser' and recieveuserreaded = '0' ";
		$result = $this->ConnDB->ExcQuery ( $sql );
		return $result;
	}
	function checkMessage_2($recieveuser, $senduser) {
		$sql="SELECT distinct senduser FROM message where recieveuser='$recieveuser' and senduser != '$senduser' and recieveuserreaded = '0' ";
		$result=$this->ConnDB->ExcQuery($sql);
		return $result;
	}
	
	function update($oldname,$newname)
	{
		$sql="update message set senduser = '$newname' where senduser = '$oldname'";
		$this->ConnDB->ExcQuery($sql);
		$sql="update message set recieveuser = '$newname' where recieveuser = '$oldname'";
		$this->ConnDB->ExcQuery($sql);
		$sql="update groupmessage set recieveuser = '$newname' where recieveuser = '$oldname'";
		$this->ConnDB->ExcQuery($sql);
		$sql="update groupmessage set senduser = '$newname' where senduser = '$oldname'";
		$this->ConnDB->ExcQuery($sql);
	}
}

















