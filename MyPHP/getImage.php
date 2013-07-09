<?php
header ( "content-type:text/html;charset=utf-8" );
header ( "content-type:image/jpeg" );
session_start ();
if (isset ( $_REQUEST ["action"] )) {
	$action = $_REQUEST ["action"];
}

if (isset ( $action )) {
	if (strcmp ( $action, "getcode" ) == 0) {
		$image = imagecreate ( 130, 50 );
		$num1 = mt_rand ( 0, 254 );
		$num2 = mt_rand ( 0, 254 );
		$num3 = mt_rand ( 0, 254 );
		$bgcolor = imagecolorallocate ( $image, $num1, $num2, $num3 );
		$fontcolor = imagecolorallocate ( $image, $num2, $num3, $num1 );
		$font = "fonts/STCAIYUN.TTF";
		$rand = "";
		$code = "";
		for($a = 0; $a < 4; $a ++) {
			$num = mt_rand ( 0, 15 );
			$rand .= dechex ( $num ) . " ";
			$code .= dechex ( $num );
		}
		$string = $rand;
		$_SESSION ["code"] = $code;
		imagefttext ( $image, 30, 0, 5, 40, $fontcolor, $font, $string );
		imagejpeg ( $image );
		imagedestroy ( $image );
	}
}
