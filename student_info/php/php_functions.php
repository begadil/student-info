<?php

	include("connection_to_db.php");

	if(isset($_REQUEST['function'])){
		$function = $_REQUEST['function'];
		
		/******************************* LOGIN.HTML *******************************/
		
		if($function == "email_password_check"){
			$email = $_REQUEST['email'];
			$password = md5($_REQUEST['password']);
			
			$q = mysql_query("select * from user where email='$email' and password='$password'");
			$q_n = mysql_num_rows($q);
			if($q_n > 0) {
				echo "ok";
			}
			else {
				echo "not ok";
			}
		}
		
		/************************************************************************/
			
	}

?>