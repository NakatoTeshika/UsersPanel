<?php
	 $db_host = 'localhost';
	 $db_user = 'root';
	 $db_password = '';
	 $db_base = 'test_php';
	 $db_table = 'users';
	 mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	 $mysqli = new mysqli($db_host,$db_user,$db_password, $db_base);

	 if($mysqli->connect_error){
	 	die(' Ошибка: (' . $mysqli->maxdb_connect_errno . ')'. $mysqli_connect_error);
	 	mysqli_query($mysqli,' set names cp1251');
	 }
?>