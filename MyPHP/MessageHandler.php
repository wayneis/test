<?php
header ( "content-type:text/html;charset=gb2312" );
include 'ActionDAO.php';
if (isset ( $_REQUEST ["action"] )) {
	$ActionDAO = new ActionDAO ();
	session_start ();
	$action = $_REQUEST ["action"];
	
	if (strcmp ( $action, "send" ) == 0) {
		$talktype = $_SESSION ["talk_type"];
		if (! isset ( $_REQUEST ["message"] )) {
			echo "error_1";
			exit ();
		}
		$message = $_REQUEST ["message"];
		$fontfamily = $_REQUEST ["fontfamily"];
		$fontsize = $_REQUEST ["fontsize"];
		$fontcolor = $_REQUEST ["fontcolor"];
		$fontweight = $_REQUEST ["fontweight"];
		$message = iconv ( "utf-8", "gb2312", $message );
		$fontfamily = iconv ( "utf-8", "gb2312", $fontfamily );
		$username = $_SESSION ["username"];
		if (strcmp ( $talktype, "group" ) == 0) {
			$result = $ActionDAO->InsertGroupMessage ( $username, $message, $fontfamily, $fontcolor, $fontsize, $fontweight );
			if (! $result) {
				echo "false";
			} else {
				echo "true";
			}
		}
		if (strcmp ( $talktype, "single" ) == 0) {
			$recieveuser = $_SESSION ["recieveuser"];
			$result = $ActionDAO->InsertMessage ( $message, $username, $recieveuser, $fontfamily, $fontcolor, $fontsize, $fontweight );
			if (! $result) {
				echo "false";
			} else {
				echo "true";
			}
			// echo $result;
		}
	}
	
	if (strcmp ( $action, "recieve" ) == 0) {
		$talktype = $_SESSION ["talk_type"];
		if (strcmp ( $talktype, "group" ) == 0) {
			if (! $_SESSION ["firstRecieveGroup"]) {
				$minId = $_SESSION ["count"];
				$maxId = $ActionDAO->getTopMessageId ();
				if ($minId == $maxId) {
					exit ();
				}
				$_SESSION ["count"] = $maxId;
				$result = $ActionDAO->getGroupMessage ( $maxId, $minId );
				while ( ($arr = mysql_fetch_array ( $result )) != null ) {
					$time = $arr ["time"];
					$message = $arr ["message"];
					$senduser = $arr ["senduser"];
					$fontfamily = $arr ["fontfamily"];
					$fontsize = $arr ["fontsize"];
					$fontweight = $arr ["fontweight"];
					$fontcolor = $arr ["fontcolor"];
					echo "<span class='message' style='display:none;'><font style='font-weight:bold;font-size:14px;font-family:Arial;'>&nbsp;" . $senduser . "&nbsp;&nbsp;" . $time . "</font><br>·<font style='color:$fontcolor;font-family:$fontfamily;font-size:$fontsize;font-weight:$fontweight'>" . $message . "</font></span><br>";
				}
			} else {
				$maxId = $_SESSION ["count"];
				if ($maxId - 3 <= 0) {
					$minId = 0;
				} else {
					$minId = $maxId - 3;
				}
				$result = $ActionDAO->getGroupMessage ( $maxId, $minId );
				if (! $result) {
					echo null;
					exit ();
				}
				while ( ($arr = mysql_fetch_array ( $result )) != null ) {
					$time = $arr ["time"];
					$message = $arr ["message"];
					$senduser = $arr ["senduser"];
					$fontfamily = $arr ["fontfamily"];
					$fontsize = $arr ["fontsize"];
					$fontweight = $arr ["fontweight"];
					$fontcolor = $arr ["fontcolor"];
					echo "<span class='message' style='display:none;'><font style='font-weight:bold;font-size:14px;font-family:Arial;'>&nbsp;" . $senduser . "&nbsp;&nbsp;" . $time . "</font><br><label>·</label><font style='color:$fontcolor;font-family:$fontfamily;font-size:$fontsize;font-weight:$fontweight'>" . $message . "</font></span><br>";
				}
				$_SESSION ["firstRecieveGroup"] = false;
			}
		}
		if (strcmp ( $talktype, "single" ) == 0) {
			if ($_SESSION ["firstRecieveSingal"]) {
				if ($_SESSION ["messagelock"]) {
					echo null;
					exit ();
				}
				$_SESSION ["messagelock"] = true;
				$recieveuser = $_SESSION ["recieveuser"];
				$username = $_SESSION ["username"];
				$username = iconv ( "utf-8", "gb2312", $username );
				$result = $ActionDAO->getMessage ( $username, $recieveuser );
				$i = 0;
				while ( ($arr = mysql_fetch_array ( $result )) != null ) {
					$time = $arr ["time"];
					$message = $arr ["message"];
					$senduser = $arr ["senduser"];
					$fontfamily = $arr ["fontfamily"];
					$fontsize = $arr ["fontsize"];
					$fontweight = $arr ["fontweight"];
					$fontcolor = $arr ["fontcolor"];
					echo "<span class='message' style='display:none;'><font style='font-weight:bold;font-size:14px;font-family:Arial;'>&nbsp;" . $senduser . "&nbsp;&nbsp;" . $time . "</font><br><font style='font-family:华文细黑;font-weight:bold;font-size:20px;'>·</font><font style='color:$fontcolor;font-family:$fontfamily;font-size:$fontsize;font-weight:$fontweight'>" . $message . "</font></span><br>";
					if (strcmp ( $username, $arr ["senduser"] ) == 0) {
						$ActionDAO->setReaded ( $arr ["id"], "senduser" );
					}
					if (strcmp ( $username, $arr ["recieveuser"] ) == 0) {
						$ActionDAO->setReaded ( $arr ["id"], "recieveuser" );
					}
					$i ++;
				}
				if ($i == 0) {
					$maxId = $ActionDAO->getTopId ();
					if ($maxId - 3 <= 0) {
						$minId = 0;
					} else {
						$minId = $maxId - 3;
					}
					$result = $ActionDAO->getMessageById ( $maxId, $minId );
					if (! $result) {
						echo null;
						exit ();
					}
					while ( ($arr = mysql_fetch_array ( $result )) != null ) {
						$time = $arr ["time"];
						$message = $arr ["message"];
						$senduser = $arr ["senduser"];
						$fontfamily = $arr ["fontfamily"];
						$fontsize = $arr ["fontsize"];
						$fontweight = $arr ["fontweight"];
						$fontcolor = $arr ["fontcolor"];
						echo "<span class='message' style='display:none;'><font style='font-weight:bold;font-size:14px;font-family:Arial;'>&nbsp;" . $senduser . "&nbsp;&nbsp;" . $time . "</font><br><font style='font-family:华文细黑;font-weight:bold;font-size:20px;'>·</font><font style='color:$fontcolor;font-family:$fontfamily;font-size:$fontsize;font-weight:$fontweight'>" . $message . "</font></span><br>";
						if (strcmp ( $username, $arr ["senduser"] ) == 0) {
							$ActionDAO->setReaded ( $arr ["id"], "senduser" );
						}
						if (strcmp ( $username, $arr ["recieveuser"] ) == 0) {
							$ActionDAO->setReaded ( $arr ["id"], "recieveuser" );
						}
						$i ++;
					}
					echo "<font style='font-family:system;font-size:10px;color:gray'>-----------------------------------------------------历史消息-------------------------------------------------------</font><br>";
				}
				$_SESSION ["messagelock"] = false;
				$_SESSION ["firstRecieveSingal"] = false;
			} else {
				
				if ($_SESSION ["messagelock"]) {
					echo null;
					exit ();
				}
				$_SESSION ["messagelock"] = true;
				$recieveuser = $_SESSION ["recieveuser"];
				$username = $_SESSION ["username"];
				$username = iconv ( "utf-8", "gb2312", $username );
				$result = $ActionDAO->getMessage ( $username, $recieveuser );
				while ( ($arr = mysql_fetch_array ( $result )) != null ) {
					$time = $arr ["time"];
					$message = $arr ["message"];
					$senduser = $arr ["senduser"];
					$fontfamily = $arr ["fontfamily"];
					$fontsize = $arr ["fontsize"];
					$fontweight = $arr ["fontweight"];
					$fontcolor = $arr ["fontcolor"];
					echo "<span class='message' style='display:none;'><font style='font-weight:bold;font-size:14px;font-family:Arial;'>&nbsp;" . $senduser . "&nbsp;&nbsp;" . $time . "</font><br><font style='font-family:华文细黑;font-weight:bold;font-size:20px;'>·</font><font style='color:$fontcolor;font-family:$fontfamily;font-size:$fontsize;font-weight:$fontweight'>" . $message . "</font></span><br>";
					if (strcmp ( $username, $arr ["senduser"] ) == 0) {
						$ActionDAO->setReaded ( $arr ["id"], "senduser" );
					}
					if (strcmp ( $username, $arr ["recieveuser"] ) == 0) {
						$ActionDAO->setReaded ( $arr ["id"], "recieveuser" );
					}
				}
				$_SESSION ["messagelock"] = false;
			}
		}
	}
	
	if (strcmp ( $action, "getLoginuser" ) == 0) {
		$username = $_SESSION ["username"];
		$talktype = $_SESSION ["talk_type"];
		if (isset ( $_SESSION ["recieveuser"] )) {
			$recieveuser = $_SESSION ["recieveuser"];
		}
		if (strcmp ( $talktype, "group" ) == 0) {
			echo "<tr><td width='15%' >0</td><td width='45%' style='color:blue'>群</td><td width='40%'><input class='actionbutton' style='color:blue' value='已在群' type='button'" . "id='Intogroup'/></td></tr>";
		} else {
			echo "<tr><td width='15%' >0</td><td width='45%' style='color:green'>群</td><td width='40%'><input class='actionbutton' style='color:green' value='进入群' type='button'" . "id='Intogroup' onclick='gotoGroup()'/></td></tr>";
		}
		echo "<tr><td>1</td><td style='color:green'>" . $username . "</td><td><input value='注销' type='button' class='actionbutton' style='color:green' onclick='logout()'/></td></tr>";
		$result = $ActionDAO->getLoginuser ();
		if (! $result) {
			echo null;
		}
		$i = 2;
		while ( ($arr = mysql_fetch_array ( $result )) != null ) {
			$senduser = $arr ["username"];
			if (strcmp ( $username, $arr ["username"] ) == 0) {
				continue;
			}
			if (strcmp ( $talktype, "single" ) == 0) {
				if (strcmp ( $recieveuser, $senduser ) == 0) {
					echo "<tr><td>" . $i . "</td><td style='color:blue'>" . $arr ["username"] . "</td><td><input value='talking'class='actionbutton' style='color:blue' type='button'/></td></tr>";
				} else {
					echo "<tr><td>" . $i . "</td><td>" . $arr ["username"] . "</td><td><input value='聊天' type='button' class='actionbutton'  onclick=\"talk('$senduser')\"/></td></tr>";
				}
			} else {
				echo "<tr><td>" . $i . "</td><td>" . $arr ["username"] . "</td><td><input value='聊天' type='button' class='actionbutton'  onclick=\"talk('$senduser')\"/></td></tr>";
			}
			$i ++;
		}
	}
	
	if (strcmp ( $action, "setTalktype" ) == 0) {
		$setTalktype = $_REQUEST ["talktype"];
		if (strcmp ( $setTalktype, "single" ) == 0) {
			$recieveuser = $_REQUEST ["recieveuser"];
			$_SESSION ["recieveuser"] = $recieveuser;
			$_SESSION ["talk_type"] = "single";
			$_SESSION ["messagelock"] = false;
			$_SESSION ["firstRecieveSingal"] = true;
			echo "true";
		}
		if (strcmp ( $setTalktype, "group" ) == 0) {
			$_SESSION ["firstRecieveGroup"] = true;
			$_SESSION ["talk_type"] = "group";
			echo "true";
		}
		// echo "success";
	}
	
	if (strcmp ( $action, "getcurrentstate" ) == 0) {
		$talktype = $_SESSION ["talk_type"];
		$username = $_SESSION ["username"];
		if (strcmp ( $talktype, "group" ) == 0) {
			echo "<font color=blue>状态：</font><span id='currentstate'>你正在群中聊天</span>";
		} else {
			$recieveuser = $_SESSION ["recieveuser"];
			echo "<font color=blue>状态：</font><span id='currentstate'>你正在和<font color=blue>" . $recieveuser . "</font>聊 天</span>";
		}
	}
}

?>
