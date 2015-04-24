<?php

	include("connection.php");

	if(isset($_REQUEST['function'])){
		$function = $_REQUEST['function'];
		
		/******************************* LOGIN PAGE *******************************/
		if($function == "email_password_check"){
			$email = $_REQUEST['email'];
			$password = md5($_REQUEST['password']);
			
			$q = mysql_query("select * from user where email='$email' and password='$password'");
			$q_n = mysql_num_rows($q);
			if($q_n > 0) {
				session_start();
				$_SESSION['email'] = $email;
				echo "ok";
			}
			else {
				echo "not ok";
			}
		}
		/************************************************************************/
		
		/******************************* INDEX PAGE *******************************/
		elseif ($function == "search"){
			
			$name = $_REQUEST['search_name'];
			$surname = $_REQUEST['search_surname'];
			$sdu_id = $_REQUEST['search_sdu_id'];
			
			$query = "select * from student where ";
			
			if($name != ""){
				$query .= " name_en like '%$name%' ";
			}
			if ($surname != ""){
				if($query != "select * from student where "){
					$query .= " and ";
				}
				$query .= " surname_en like '%$surname%' ";
			}
			$q = mysql_query($query);
			$q_n = mysql_num_rows($q);
			if($q_n > 0){
				while($a = mysql_fetch_array($q)){
					echo $a['name_en']." ".$a['surname_en'];
				}
			}
			else{
				echo "no data found | php";
			}
		}
		/************************************************************************/
	}

?>