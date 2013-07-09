<?php
session_start();
if (isset ( $_SESSION ["login"] )) {
	$login = $_SESSION ["login"];
	if (! $login) {
		echo "<script>alert('你未登录，无法访问此界面');</script>";
		echo "<script>window.location.href='login.php'</script>";
		exit ();
	}
} 
else {
	echo "<script>alert('你未登录，无法访问此界面');</script>";
	echo "<script>window.location.href='login.php'</script>";
	exit ();
}