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
				session_start();
				$_SESSION['mail'] = $email;
				echo "ok";
			}
			else {
				echo "not ok";
			}
		}
		/************************************************************************/
		
		/******************************* INDEX.HTML *******************************/
		elseif ($function == "sign_out"){
			
			session_start();
			if(session_destroy()){
				echo "ok";
			}
		}
		
		elseif ($function == "check_session"){
			session_start();
			
			if(!(isset($_SESSION['mail']) && $_SESSION['mail'] != '')){
				echo "not ok";
			}
			else {
				echo "ok";
			}
		}
		
		elseif ($function == "search"){
			$type = $_REQUEST['type'];
			
			if($type == "text"){
				$text = $_REQUEST[$type];
				$q = mysql_query("select * from student where name_kz like '%$text%' or 
															  surname_kz like '%$text%' or 
															  fathername_kz like '%$text%' or 
															  name_en like '%$text%' or
															  surname_en like '%$text%'");
				$q_n = mysql_num_rows($q);
				if($q_n > 0){
					while($a = mysql_fetch_array($q)){
						echo $a['name_en']." ".$a['surname_en'];
					}
				}
				else{
					$q = mysql_query("select * from sdu_info where sdu_id like '%$text%'");
					$q_n = mysql_num_rows($q);
					if($q_n > 0){
						while($a = mysql_fetch_array($q)){
							$q1 = mysql_query("select * from student where sdu_info_id = '$a[id]'");
							$a1 = mysql_fetch_array($q1);
							echo $a1['name_en']." ".$a1['surname_en']." ".$a['sdu_id'];
						}
					}
					else{
						echo "there is no such student";
					}
				}
			}
			
			else if($type == "radio-gender"){
				$gender = $_REQUEST[$type];
				$q = mysql_query("select * from student where gender = '$gender'");
				$q_n = mysql_num_rows($q);
				if($q_n > 0){
					while($a = mysql_fetch_array($q)){
						echo $a['name_en']." ".$a['surname_en'];
					}
				}
				else{
					echo "there is no such student";
				}
			}
			
		}
		/************************************************************************/
			
	}

?>