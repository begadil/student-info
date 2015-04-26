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
		
		elseif($function == "get_department"){
				
			$faculty_id = $_REQUEST['faculty_id'];
			$q = mysql_query("select * from department where faculty_id='$faculty_id'");
			echo "<option value = '0'>department</option>";
			while($a = mysql_fetch_array($q)){
				echo "<option value = '$a[id]'>$a[name]</option>";
			}
				
		}
		
		elseif($function == "get_group"){
		
			$department_id = $_REQUEST['department_id'];
			$course = $_REQUEST['course'];
			if($course == 0){
				$q = mysql_query("select * from `group` where department_id = '$department_id'");
			}
			else{
				$q = mysql_query("select * from `group` where department_id = '$department_id' and course = '$course'");
			}
			echo "<option value = '0'>group</option>";
			while($a = mysql_fetch_array($q)){
				echo "<option value = '$a[id]'>$a[name]</option>";
			}
		
		}
		
		elseif($function == "get_region"){
			
			$republic_id = $_REQUEST['republic_id'];
			$q = mysql_query("select * from region where republic_id='$republic_id'");
			echo "<option value = '0'>region</option>";
			while($a = mysql_fetch_array($q)){
				echo "<option value = '$a[id]'>$a[name]</option>";
			}
			
		}
		
		elseif($function == "get_city"){
				
			$region_id = $_REQUEST['region_id'];
			$q = mysql_query("select * from city where region_id='$region_id'");
			echo "<option value = '0'>city</option>";
			while($a = mysql_fetch_array($q)){
				echo "<option value = '$a[id]'>$a[name]</option>";
			}
				
		}
		
		elseif ($function == "search"){
			
			$name = $_REQUEST['search_name'];
			$surname = $_REQUEST['search_surname'];
			$gender = $_REQUEST['search_gender'];
			
			$address_type = $_REQUEST['search_address_type'];
			$republic = $_REQUEST['search_republic'];
			$region = $_REQUEST['search_region'];
			$city = $_REQUEST['search_city'];
			
			$sdu_id = $_REQUEST['search_sdu_id'];
			$faculty = $_REQUEST['search_faculty'];
			$department = $_REQUEST['search_department'];
			$course = $_REQUEST['search_course'];
			$group = $_REQUEST['search_group'];
			$grant_type = $_REQUEST['search_grant_type'];
			$stipend = $_REQUEST['search_stipend'];
			$min_gpa = $_REQUEST['search_min_gpa'];
			$max_gpa = $_REQUEST['search_max_gpa'];
			
			if(
					($sdu_id == "" && 
					 $faculty == 0 && 
					 $department == 0 && 
					 $course == 0 && 
					 $group == 0 && 
					 $grant_type == "" && 
					 $stipend == "" && 
					 $min_gpa == "" &&
					 $max_gpa == "") && 
					($republic == 0 && 
					 $region == 0 && 
					 $city == 0)){
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
				
				if ($gender != ""){
					if($query != "select * from student where "){
						$query .= " and ";
					}
					$query .= " gender = '$gender' ";
				}
			}
			
			elseif($name == "" && $surname == "" && $gender == "" && $republic == 0 && $region == 0 && $city == 0){
				
				if($course == 0){
					$query = "select st.* from student as st, sdu_info as si where st.sdu_info_id = si.id and gpa between $min_gpa and $max_gpa ";
				}
				else{
					$query = "select st.* from student as st, sdu_info as si where st.sdu_info_id = si.id and course = '$course' and gpa between $min_gpa and $max_gpa ";
				}
				
				if($sdu_id != ""){
					$query .= " and si.sdu_id like '%$sdu_id%' ";
				}
				
				if($faculty != 0){
					if($query != "select st.* from student as st, sdu_info as si where st.sdu_info_id = si.id and gpa between $min_gpa and $max_gpa " || $query != "select st.* from student as st, sdu_info as si where st.sdu_info_id = si.id and course = '$course' and gpa between $min_gpa and $max_gpa "){
						$query .= " and ";
					}
					$query .= " si.faculty_id = '$faculty' ";
				}
				
				if($department != 0){
					if($query != "select st.* from student as st, sdu_info as si where st.sdu_info_id = si.id and gpa between $min_gpa and $max_gpa " || $query != "select st.* from student as st, sdu_info as si where st.sdu_info_id = si.id and course = '$course' and gpa between $min_gpa and $max_gpa "){
						$query .= " and ";
					}
					$query .= " si.department_id = '$department' ";
				}
				
				if($group != 0){
					if($query != "select st.* from student as st, sdu_info as si where st.sdu_info_id = si.id and gpa between $min_gpa and $max_gpa " || $query != "select st.* from student as st, sdu_info as si where st.sdu_info_id = si.id and course = '$course' and gpa between $min_gpa and $max_gpa "){
						$query .= " and ";
					}
					$query .= " si.group_id = '$group' ";
				}
				
				if($grant_type != ""){
					if($query != "select st.* from student as st, sdu_info as si where st.sdu_info_id = si.id and gpa between $min_gpa and $max_gpa " || $query != "select st.* from student as st, sdu_info as si where st.sdu_info_id = si.id and course = '$course' and gpa between $min_gpa and $max_gpa "){
						$query .= " and ";
					}
					$query .= " si.grant_type = '$grant_type' ";
				}
				
				if($stipend != ""){
					if($query != "select st.* from student as st, sdu_info as si where st.sdu_info_id = si.id and gpa between $min_gpa and $max_gpa " || $query != "select st.* from student as st, sdu_info as si where st.sdu_info_id = si.id and course = '$course' and gpa between $min_gpa and $max_gpa "){
						$query .= " and ";
					}
					$query .= " si.stipend = '$stipend' ";
				}

			}
			
			elseif(
					($name == "" && 
					 $surname == "" && 
					 $gender == "") && 
					($sdu_id == "" && 
					 $faculty == 0 && 
					 $department == 0 && 
					 $course == 0 && 
					 $group == 0 &&
					 $grant_type == "" && 
					 $stipend == "" && 
					 $min_gpa == "" &&
					 $max_gpa == "")){
				if($address_type == "home"){
					$query = "select st.* from student as st, address as ad where st.home_address_id = ad.id and ";
				}
				else{
					$query = "select st.* from student as st, address as ad where st.current_address_id = ad.id and ";
				}
				
				if($republic != 0){
					$query .= " ad.republic_id = '$republic' ";
				}
				
				if($region != 0){
					if($query != "select st.* from student as st, address as ad where st.home_address_id = ad.id and " || $query != "select st.* from student as st, address as ad where st.current_address_id = ad.id and "){
						$query .= " and ";
					}
					$query .= " ad.region_id = '$region' ";
				}
				
				if($city != 0){
					if($query != "select st.* from student as st, address as ad where st.home_address_id = ad.id and " || $query != "select st.* from student as st, address as ad where st.current_address_id = ad.id and "){
						$query .= " and ";
					}
					$query .= " ad.city_id = '$city' ";
				}
			}
			
			elseif(
					($sdu_id != "" || 
					 $faculty != 0 || 
					 $department != 0 || 
					 $course != 0 || 
					 $group != 0 ||
					 $grant_type != "" ||
					 $stipend != "" || 
					 $min_gpa != "" ||
					 $max_gpa != "") || 
					($name != "" || $surname != "" || $gender != "") || 
					($republic != 0 || $region != 0 || $city != 0)){
				
				if($address_type == "home"){
					$query = "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa ";
				}
				else{
					$query = "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa ";
				}
				
				if($course != 0){
					$query .= " and si.course = '$course' ";
				}
				
				if($name != ""){
					$query .= " and st.name_en like '%$name%' ";
				}
				
				if ($surname != ""){
					if($query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " || 
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' "){
						$query .= " and ";
					}
					$query .= " st.surname_en like '%$surname%' ";
				}
				
				if ($gender != ""){
					if($query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " || 
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' "){
						$query .= " and ";
					}
					$query .= " gender = '$gender' ";
				}
				
				if($sdu_id != ""){
					if($query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " || 
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and and si.gpa between $min_gpa and $max_gpa si.course = '$course' " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' "){
						$query .= " and ";
					}
					$query .= " si.sdu_id like '%$sdu_id%' ";
				}
				
				if($faculty != 0){
					if($query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " || 
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' "){
						$query .= " and ";
					}
					$query .= " si.faculty_id = '$faculty' ";
				}
				
				if($department != 0){
					if($query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " || 
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' "){
						$query .= " and ";
					}
					$query .= " si.department_id = '$department' ";
				}
				
				if($group != 0){
					if($query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " || 
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' "){
						$query .= " and ";
					}
					$query .= " si.group_id = '$group' ";
				}
				
				if($grant_type != ""){
					if($query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " || 
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' "){
						$query .= " and ";
					}
					$query .= " si.grant_type = '$grant_type' ";
				}
				
				if($stipend != ""){
					if($query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " || 
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' "){
						$query .= " and ";
					}
					$query .= " si.stipend = '$stipend' ";
				}
				
				if($republic != 0){
					if($query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " || 
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' "){
						$query .= " and ";
					}
					$query .= " ad.republic_id = '$republic' ";
				}
				
				if($region != 0){
					if($query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " || 
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' "){
						$query .= " and ";
					}
					$query .= " ad.region_id = '$region' ";
				}
				
				if($city != 0){
					if($query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " || 
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.home_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' " ||
					   $query != "select st.* from student as st, address as ad, sdu_info as si where st.current_address_id = ad.id and si.gpa between $min_gpa and $max_gpa and si.course = '$course' "){
						$query .= " and ";
					}
					$query .= " ad.city_id = '$city' ";
				}
				
			}
			$q = mysql_query($query);
			echo $query;
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