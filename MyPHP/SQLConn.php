<?php
class ConnDB {
	private $SQLurl = "localhost";
	private $SQLusername = "root";
	private $SQLpasswd = "876286443";
	private $conn;
	function connDB() {
		$this->conn = mysql_connect ( $this->SQLurl, $this->SQLusername, $this->SQLpasswd );
		if (! $this->conn) {
			die ( 'Could not connect: ' . mysql_error () );
		}
		if (! mysql_select_db ( "webproject" )) {
			die ( 'Could not select database: ' . mysql_error () );
		}
		if (! mysql_query ( "set names gb2312" )) {
			die ( 'Could not execute query: ' . mysql_error () );
		}
	}
	function ExcQuery($sql) {
		$this->connDB ();
		$result = mysql_query ( $sql );
		mysql_close ( $this->conn );
		return $result;
	}
}