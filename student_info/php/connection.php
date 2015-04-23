<?php
	$con = mysql_connect("localhost", "root", "");
	if(!$con){
    	exit("Conection refused " . mysql_error());
	}
	mysql_select_db("student_info");
?>
