<?php
include 'ActionDAO.php';
session_start ();
$ActionDAO = new ActionDAO ();
$username = $_SESSION ["username"];
$result = $ActionDAO->deleteLoginuser ( $username );
if(!$result)
{
	echo "false";
}
else {
	session_unset();
	session_destroy();
	echo "true";
}
