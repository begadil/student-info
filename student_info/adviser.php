<?php
	session_start();
	if (!(isset($_SESSION['email']) && $_SESSION['email'] != '')) {
		header ("Location: login.php");
	}
	$session_id=$_SESSION['email'];
	include("php/connection.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Student Info | ADVISER</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/adviser/adviser.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
</head>
<body>

	<?php 
		include("blocks/nav.php");
	?>
	
	<?php
		$q = mysql_query("select id as 'ID' from adviser where email = '$session_id'");
		$a = mysql_fetch_array($q);
		
		$adviser_id = $a['ID'];
		
		$q=mysql_query("select * from adviser_group where adviser_id = '$adviser_id'");
		$n=mysql_num_rows($q);
		
	?>
	
	<div class="container" id = "adviser_page">
		<div class="row">
	        <div class="col-lg-12">
	    		<h1 class="page-header">STUDENTS</h1>
	        </div>
	    </div>
		<div class="row">
			<div class="col-lg-12">
				<div id="table">
					<?php 
							if($n > 0){
								
								$qq = mysql_query("select gr.id, gr.name from `group` as gr, adviser_group as ag where ag.adviser_id = '$adviser_id' and ag.group_id = gr.id order by gr.name");
								
								while($aa = mysql_fetch_array($qq)){
									
									$q=mysql_query("select st.* from student as st, `group` as gr, sdu_info as si where st.sdu_info_id = si.id and si.group_id = gr.id and gr.id = '$aa[id]' order by st.surname_en");
									$n=mysql_num_rows($q);
									
									if($n>0){
										echo "<p><span class='label label-primary' style='font-size:1.5em;'>$aa[name]</span></p>";
										$i = 1;
										echo "<table class='table table-hover table-condensed table-bordered'>";
										echo "<thead>
												<tr>
													<th>#</th>
													<th>Name & Surname</th>
													<th>Gender</th>
													<th>Birthday</th>
													<th>SDU ID</th>
													<th>SDU Info</th>
													<th>Contact Info</th>
													<th>Home Address</th>
													<th>Current Address</th>
												</tr>
											</thead>
											<tbody>";
										
										while($a = mysql_fetch_array($q)){
											echo "<tr>";
											echo "<td>$i</td>
											<td>$a[surname_en] $a[name_en]</td>
											<td>$a[gender]</td>";
													$birthd = date(  "F j, Y", strtotime( $a['birthday'] ) );
															echo "<td>$birthd</td>";
												
											$q1 = mysql_query("select * from sdu_info where id = '$a[sdu_info_id]'");
													$a1 = mysql_fetch_array($q1);
													echo "<td>$a1[sdu_id]</td>";
													$q2 = mysql_query("select * from faculty where id = '$a1[faculty_id]'");
													$a2 = mysql_fetch_array($q2);
													$sdu_information = "$a2[name]<br/>";
											$q2 = mysql_query("select * from department where id = '$a1[department_id]'");
											$a2 = mysql_fetch_array($q2);
													$sdu_information .= "$a2[name]<br/>";
													$q2 = mysql_query("select * from `group` where id = '$a1[group_id]'");
													$a2 = mysql_fetch_array($q2);
											$sdu_information .= "<strong>Group: </strong>$a2[name]<br/>";
											$sdu_information .= "<strong>Grant type: </strong>$a1[grant_type]<br/>";
											$sdu_information .= "<strong>Stipend: </strong>$a1[stipend]";
												
											echo "<td>$sdu_information</td>";
											echo "<td>$a[email]<br/>$a[phone_no]</td>";
												
											$q2 = mysql_query("select rep.name as 'repname', c.name as 'cname', reg.name as 'regname', ad.addr as 'addr', ad.home_no as 'homeno' from address as ad, republic as rep, city as c, region as reg where ad.id = '$a[home_address_id]' and rep.id = ad.republic_id and c.id = ad.city_id and reg.id = ad.region_id");
											$a2 = mysql_fetch_array($q2);
												
											echo "<td>$a2[repname],<br/>$a2[regname],<br/>$a2[cname],<br/>$a2[addr] $a2[homeno]</td>";
												
											$q2 = mysql_query("select rep.name as 'repname', c.name as 'cname', reg.name as 'regname', ad.addr as 'addr', ad.home_no as 'homeno' from address as ad, republic as rep, city as c, region as reg where ad.id = '$a[current_address_id]' and rep.id = ad.republic_id and c.id = ad.city_id and reg.id = ad.region_id");
											$a2 = mysql_fetch_array($q2);
										
											echo "<td>$a2[repname],<br/>$a2[regname],<br/>$a2[cname],<br/>$a2[addr] $a2[homeno]</td>";
											$i++;
										}
										echo "</table>";
										echo "<hr style='margin-top:40px; margin-bottom:40px;'/>";
									}
								}
							}
							else{
								echo "<p align='center' style='padding:10px;'><span class='label label-warning'>no students</span></p>";
							}
					?>
				</div>
			</div>
		</div>
	</div>

	
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/js_functions.js"></script>
	
</body>
</html>