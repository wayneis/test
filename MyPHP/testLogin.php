<?php
session_start();
if (isset ( $_SESSION ["login"] )) {
	$login = $_SESSION ["login"];
	if (! $login) {
		echo "<script>alert('��δ��¼���޷����ʴ˽���');</script>";
		echo "<script>window.location.href='login.php'</script>";
		exit ();
	}
} 
else {
	echo "<script>alert('��δ��¼���޷����ʴ˽���');</script>";
	echo "<script>window.location.href='login.php'</script>";
	exit ();
}