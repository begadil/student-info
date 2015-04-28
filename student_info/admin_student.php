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
    <title>ADMIN | Student Info</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/jquery.datetimepicker.css" rel="stylesheet">
    <link href="css/admin/admin.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
</head>

<body>

	<?php 
		include("blocks/admin/admin_student_nav.php");
	?>

	<div id="admin_page">
		<div class="container">
			<div class="row">
	            <div class="col-lg-12">
	                <h1 class="page-header">STUDENTS</h1>
	            </div>
	        </div>
	        
	        <div class="row">
	        	<div class="col-lg-12">
	        		<?php
						$q=mysql_query("select * from student");
						$n=mysql_num_rows($q);
					?>
					
					<div id="table">
						<?php 
							if($n > 0){
								echo "<p class='text-right'>
									<a href='javascript:edit_on_off()'><i class='fa fa-check'> enable edit command</i></a>
								</p>";
								echo "<p align='center'>
									      <button class='btn btn-info' onclick='add_student_modal()'>
										      <i class='fa fa-plus'></i> add student
										  </button>
									  </p>";
								
								$qq = mysql_query("select id,name from `group` order by name");
								while($aa = mysql_fetch_array($qq)){
									
									$q=mysql_query("select st.* from student as st, `group` as gr, sdu_info as si where st.sdu_info_id = si.id and si.group_id = gr.id and gr.id = '$aa[id]' order by st.surname_en");
									$n=mysql_num_rows($q);
									if($n>0){
										$aaa = mysql_query("select ad.name as 'adname', ad.surname as 'adsurname' from adviser as ad, adviser_group as ag where ag.group_id = '$aa[id]' and ag.adviser_id = ad.id");
										$qqq = mysql_fetch_array($aaa);
										echo "<p><span class='label label-warning' style='font-size:1.2em;'>$aa[name] - $qqq[adname] $qqq[adsurname]</span></p>";
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
											echo "<tr onclick='edit_adviser_modal($a[id])'>";
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
										
									}
									echo "</table>";
								}
							}
							else{
								if($n==0){
									echo "<p align='center' style='padding:10px;'><span class='label label-warning'>no advisers</span></p>";
								}
								echo "<p align='center'>
									      <button class='btn btn-info' onclick='add_student_modal()'>
										      <i class='fa fa-plus'></i> add student
										  </button>
									  </p>";
							}
						?>
					</div>
	        	</div>
	        </div>
		</div>
	</div>
	
	<div class="modal fade bs-example-modal-lg" id="add_student" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
		  		<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" align="center"><strong>Add Student</strong></h4>
		  		</div>
		  	
				<div class="modal-body">
					<form class="form-horizontal" role="form">
						<div class="row">
							<div class="col-lg-1"></div>
							<div class="well col-lg-10">
								<p style = "font-size: 18px; font-weight:bold; margin-top:-10px; margin-bottom:20px; color:#990000;">Student Info</p>
								<div class="form-group">
									<label class="col-lg-3 control-label">Name(KZ)</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="name_kz" placeholder="Name (KZ)"/>
									</div>
							  	</div>
							  	
								<div class="form-group">
									<label class="col-lg-3 control-label">Surname(KZ)</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="surname_kz" placeholder="Surname (KZ)"/>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Father Name(KZ)</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="fathername_kz" placeholder="Father Name (KZ)"/>
									</div>
							  	</div>
							
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Name</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="name_en" placeholder="Name"/>
									</div>
							  	</div>
							  	
								<div class="form-group">
									<label class="col-lg-3 control-label">Surname</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="surname_en" placeholder="Surname"/>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Gender</label>
									<div class="col-lg-9">
								  		<label class = "radio-inline"><input type="radio" name="gender" value = 'male'>male</label>
										<label class = "radio-inline"><input type="radio" name="gender" value = 'female'>female</label>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Birthday</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="birthday" placeholder="Birthday"/>
									</div>
							  	</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Email</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="email" placeholder="ex: aaa@bbb.cc"/>
									</div>
							  	</div>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Phone no</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="phone_no" placeholder="ex: 87078373694"/>
									</div>
							  	</div>
								
							</div>
							<div class="col-lg-1"></div>
						</div>
						
						<div class="row">
							<div class="col-lg-1"></div>
							<div class="well col-lg-10">
								<p style = "font-size: 18px; font-weight:bold; margin-top:-10px; margin-bottom:20px; color:#990000;">
									Home Address Info
								</p>
								
								<div class="form-group">
									<label class="col-lg-3 control-label">Republic(Home)</label>
									<div class="col-lg-9">
								  		<select id = "home_republic" class="form-control" onchange="republic_selected(1)">
											<option value = "0">republic</option>
											<?php 
												$q = mysql_query("select id, name from republic");
												while($a = mysql_fetch_array($q)){
													echo "<option value = '$a[id]'>$a[name]</option>";
												}
											?>
										</select>
									</div>
							  	</div>
							  	
								<div class="form-group">
									<label class="col-lg-3 control-label">Region(Home)</label>
									<div class="col-lg-9">
								  		<select id = "home_region" class="form-control" onchange="region_selected(1)">
											<option value = "0">region</option>
										</select>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">City(Home)</label>
									<div class="col-lg-9">
								  		<select id = "home_city" class="form-control">
											<option value = "0">region</option>
										</select>
									</div>
							  	</div>
							
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Address(Home)</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="home_address" placeholder="Street"/>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Home No(Home)</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="home_home_no" placeholder="Home no"/>
									</div>
							  	</div>
							  	
							  	<hr/>
							  	
							  	<p style = "font-size: 18px; font-weight:bold; margin-top:-10px; margin-bottom:20px; color:#990000;">
									Current Address Info
								</p>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Republic(Current)</label>
									<div class="col-lg-9">
								  		<select id = "current_republic" class="form-control" onchange="republic_selected(2)">
											<option value = "0">republic</option>
											<?php 
												$q = mysql_query("select id, name from republic");
												while($a = mysql_fetch_array($q)){
													echo "<option value = '$a[id]'>$a[name]</option>";
												}
											?>
										</select>
									</div>
							  	</div>
							  	
								<div class="form-group">
									<label class="col-lg-3 control-label">Region(Current)</label>
									<div class="col-lg-9">
								  		<select id = "current_region" class="form-control" onchange="region_selected(2)">
											<option value = "0">region</option>
										</select>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">City(Current)</label>
									<div class="col-lg-9">
								  		<select id = "current_city" class="form-control">
											<option value = "0">region</option>
										</select>
									</div>
							  	</div>
							
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Address(Current)</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="current_address" placeholder="Street"/>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Home No(Current)</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="current_home_no" placeholder="Home no"/>
									</div>
							  	</div>
							  	
							</div>
							<div class="col-lg-1"></div>
						</div>
						
						<div class="row">
							<div class="col-lg-1"></div>
							<div class="well col-lg-10">
								<p style = "font-size: 18px; font-weight:bold; margin-top:-10px; margin-bottom:20px; color:#990000;">Family Info</p>
								<input type="hidden" value="1" id="fm_count"/>
								<div class="form-group">
									<label class="col-lg-3 control-label">Type of affinity</label>
									<div class="col-lg-9">
								  		<select id = "fm_type_of_affinity" class="form-control">
								  			<option value = "">select</option>
								  			<option value = "Father">Father</option>
								  			<option value = "Mother">Mother</option>
								  			<option value = "Brother">Brother</option>
								  			<option value = "Sister">Sister</option>
								  		</select>
									</div>
							  	</div>
							  	
								<div class="form-group">
									<label class="col-lg-3 control-label">Name</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="fm_name" placeholder="Name"/>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Surname</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="fm_surname" placeholder="Surname"/>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Study Info</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="fm_study_info" placeholder="Study Info if studies"/>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Work Info</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="fm_work_info" placeholder="Work Info if works"/>
									</div>
							  	</div>
							  	
							  	<p style="text-align:center" id = "add_fm1">
									<a href='javascript:add_fm(1)'> <i class='fa fa-plus'> add family member</i></a>
								</p>
							  	
							  	<div id = "fm1" style='display: none;'>
							  		<hr/>
									<div class="form-group">
										<label class="col-lg-3 control-label">Type of affinity</label>
										<div class="col-lg-9">
									  		<select id = "fm_type_of_affinity1" class="form-control">
									  			<option value = "">select</option>
									  			<option value = "Father">Father</option>
									  			<option value = "Mother">Mother</option>
									  			<option value = "Brother">Brother</option>
									  			<option value = "Sister">Sister</option>
									  		</select>
										</div>
								  	</div>
								  	
									<div class="form-group">
										<label class="col-lg-3 control-label">Name</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_name1" placeholder="Name"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Surname</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_surname1" placeholder="Surname"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Study Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_study_info1" placeholder="Study Info if studies"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Work Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_work_info1" placeholder="Work Info if works"/>
										</div>
								  	</div>
								  	
								  	<p style="text-align:center" id = "add_fm2">
										<a href='javascript:add_fm(2)'> <i class='fa fa-plus'> add family member</i></a>
									</p>
								</div>
								
								<div id = "fm2" style='display: none;'>
									<hr/>
									<div class="form-group">
										<label class="col-lg-3 control-label">Type of affinity</label>
										<div class="col-lg-9">
									  		<select id = "fm_type_of_affinity2" class="form-control">
									  			<option value = "">select</option>
									  			<option value = "Father">Father</option>
									  			<option value = "Mother">Mother</option>
									  			<option value = "Brother">Brother</option>
									  			<option value = "Sister">Sister</option>
									  		</select>
										</div>
								  	</div>
								  	
									<div class="form-group">
										<label class="col-lg-3 control-label">Name</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_name2" placeholder="Name"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Surname</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_surname2" placeholder="Surname"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Study Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_study_info2" placeholder="Study Info if studies"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Work Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_work_info2" placeholder="Work Info if works"/>
										</div>
								  	</div>
								  	
								  	<p style="text-align:center" id = "add_fm3">
										<a href='javascript:add_fm(3)'> <i class='fa fa-plus'> add family member</i></a>
									</p>
								  	
								</div>
								
								<div id = "fm3" style='display: none;'>
									<hr/>
									<div class="form-group">
										<label class="col-lg-3 control-label">Type of affinity</label>
										<div class="col-lg-9">
									  		<select id = "fm_type_of_affinity3" class="form-control">
									  			<option value = "">select</option>
									  			<option value = "Father">Father</option>
									  			<option value = "Mother">Mother</option>
									  			<option value = "Brother">Brother</option>
									  			<option value = "Sister">Sister</option>
									  		</select>
										</div>
								  	</div>
								  	
									<div class="form-group">
										<label class="col-lg-3 control-label">Name</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_name3" placeholder="Name"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Surname</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_surname3" placeholder="Surname"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Study Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_study_info3" placeholder="Study Info if studies"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Work Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_work_info3" placeholder="Work Info if works"/>
										</div>
								  	</div>
								  	
								  	<p style="text-align:center" id = "add_fm4">
										<a href='javascript:add_fm(4)'> <i class='fa fa-plus'> add family member</i></a>
									</p>
								  	
								</div>
								
								<div id = "fm4" style='display: none;'>
									<hr/>
									<div class="form-group">
										<label class="col-lg-3 control-label">Type of affinity</label>
										<div class="col-lg-9">
									  		<select id = "fm_type_of_affinity4" class="form-control">
									  			<option value = "">select</option>
									  			<option value = "Father">Father</option>
									  			<option value = "Mother">Mother</option>
									  			<option value = "Brother">Brother</option>
									  			<option value = "Sister">Sister</option>
									  		</select>
										</div>
								  	</div>
								  	
									<div class="form-group">
										<label class="col-lg-3 control-label">Name</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_name4" placeholder="Name"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Surname</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_surname4" placeholder="Surname"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Study Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_study_info4" placeholder="Study Info if studies"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Work Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_work_info4" placeholder="Work Info if works"/>
										</div>
								  	</div>
								  	
								  	<p style="text-align:center" id = "add_fm5">
										<a href='javascript:add_fm(5)'> <i class='fa fa-plus'> add family member</i></a>
									</p>
								  	
								</div>
								
								<div id = "fm5" style='display: none;'>
									<hr/>
									<div class="form-group">
										<label class="col-lg-3 control-label">Type of affinity</label>
										<div class="col-lg-9">
									  		<select id = "fm_type_of_affinity5" class="form-control">
									  			<option value = "">select</option>
									  			<option value = "Father">Father</option>
									  			<option value = "Mother">Mother</option>
									  			<option value = "Brother">Brother</option>
									  			<option value = "Sister">Sister</option>
									  		</select>
										</div>
								  	</div>
								  	
									<div class="form-group">
										<label class="col-lg-3 control-label">Name</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_name5" placeholder="Name"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Surname</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_surname5" placeholder="Surname"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Study Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_study_info5" placeholder="Study Info if studies"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Work Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_work_info5" placeholder="Work Info if works"/>
										</div>
								  	</div>
								  	
								  	<p style="text-align:center" id = "add_fm6">
										<a href='javascript:add_fm(6)'> <i class='fa fa-plus'> add family member</i></a>
									</p>
								  	
								</div>
								
								<div id = "fm6" style='display: none;'>
									<hr/>
									<div class="form-group">
										<label class="col-lg-3 control-label">Type of affinity</label>
										<div class="col-lg-9">
									  		<select id = "fm_type_of_affinity6" class="form-control">
									  			<option value = "">select</option>
									  			<option value = "Father">Father</option>
									  			<option value = "Mother">Mother</option>
									  			<option value = "Brother">Brother</option>
									  			<option value = "Sister">Sister</option>
									  		</select>
										</div>
								  	</div>
								  	
									<div class="form-group">
										<label class="col-lg-3 control-label">Name</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_name6" placeholder="Name"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Surname</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_surname6" placeholder="Surname"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Study Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_study_info6" placeholder="Study Info if studies"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Work Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_work_info6" placeholder="Work Info if works"/>
										</div>
								  	</div>
								  	
								  	<p style="text-align:center" id = "add_fm7">
										<a href='javascript:add_fm(7)'> <i class='fa fa-plus'> add family member</i></a>
									</p>
								  	
								</div>
								
								<div id = "fm7" style='display: none;'>
									<hr/>
									<div class="form-group">
										<label class="col-lg-3 control-label">Type of affinity</label>
										<div class="col-lg-9">
									  		<select id = "fm_type_of_affinity7" class="form-control">
									  			<option value = "">select</option>
									  			<option value = "Father">Father</option>
									  			<option value = "Mother">Mother</option>
									  			<option value = "Brother">Brother</option>
									  			<option value = "Sister">Sister</option>
									  		</select>
										</div>
								  	</div>
								  	
									<div class="form-group">
										<label class="col-lg-3 control-label">Name</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_name7" placeholder="Name"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Surname</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_surname7" placeholder="Surname"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Study Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_study_info7" placeholder="Study Info if studies"/>
										</div>
								  	</div>
								  	
								  	<div class="form-group">
										<label class="col-lg-3 control-label">Work Info</label>
										<div class="col-lg-9">
									  		<input type="text" class="form-control" id="fm_work_info7" placeholder="Work Info if works"/>
										</div>
								  	</div>
								  	
								</div>
							  	
							</div>
							<div class="col-lg-1"></div>
						</div>
						
						<div class="row">
							<div class="col-lg-1"></div>
							<div class="well col-lg-10">
								<p style = "font-size: 18px; font-weight:bold; margin-top:-10px; margin-bottom:20px; color:#990000;">SDU Info</p>
								<div class="form-group">
									<label class="col-lg-3 control-label">SDU ID</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="sdu_id" placeholder="ex: 12338"/>
									</div>
							  	</div>
							  	
								<div class="form-group">
									<label class="col-lg-3 control-label">Faculty</label>
									<div class="col-lg-9">
								  		<select id = "faculty" class="form-control" onchange="faculty_selected()">
											<option value = "0">faculty</option>
											<?php 
												$q = mysql_query("select id, name from faculty");
												while($a = mysql_fetch_array($q)){
													echo "<option value = '$a[id]'>$a[name]</option>";
												}
											?>
										</select>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Department</label>
									<div class="col-lg-9">
								  		<select id = "department" class="form-control" onchange="department_selected()">
											<option value = "0">department</option>
										</select>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Course</label>
									<div class="col-lg-9">
								  		<select id = "course" class="form-control" onchange="course_selected()">
											<option value = "0">course</option>
											<option value = "1">I</option>
											<option value = "2">II</option>
											<option value = "3">III</option>
											<option value = "4">IV</option>
										</select>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Group</label>
									<div class="col-lg-9">
								  		<select id = "group" class="form-control">
											<option value = "0">group</option>
										</select>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">GPA</label>
									<div class="col-lg-9">
								  		<input type="text" class="form-control" id="gpa" placeholder="ex: 3.5"/>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Grant Type</label>
									<div class="col-lg-9">
								  		<select id = "grant_type" class="form-control">
											<option value = "">grant type</option>
											<option value = "SDU grant">SDU grant</option>
											<option value = "State grant">State grant</option>
											<option value = "Paid">Paid</option>
										</select>
									</div>
							  	</div>
							  	
							  	<div class="form-group">
									<label class="col-lg-3 control-label">Stipend</label>
									<div class="col-lg-9">
								  		<label class = "radio-inline"><input type="radio" name="stipend" value = 'yes'>yes</label>
										<label class = "radio-inline"><input type="radio" name="stipend" value = 'no'>no</label>
									</div>
							  	</div>
							  	
							</div>
							<div class="col-lg-1"></div>
						</div>
						
						<div class="form-group" id="error">
							<div class="col-lg-12">
								<div class='alert alert-danger' role='alert'>
									<p align='center'> <strong>please, fill all the fields</strong> </p>
								</div>
							</div>
						</div>
								
						<div class="form-group" id="success">
							<div class="col-lg-12">
						  		<div class='alert alert-success' role='alert'>
									<p align='center'> <strong>student has been succesfully added</strong> </p>
								</div>
							</div>
						</div>
						
					</form>
				</div>
				
				<div class="modal-footer">
					<input type="submit" class="btn btn-success" value="Add" onclick="add_student()"/>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
		  		</div>
				
			</div>
		</div>
	</div>
	
	
	<script src="js/jquery.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/jquery.datetimepicker.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script>

		function add_fm(n){
			var t = 'add_fm';
			t += n;
			document.getElementById(t).style.display = "none";
			
			t = 'fm';
			t += (n);
			document.getElementById(t).style.display = "block";
			document.getElementById('fm_count').value = (n+1);
		}

		function faculty_selected(){
	    	var faculty = $("#faculty").val();
	    	if(faculty > 0){
	    		$.ajax({
					type:"POST",
					url:"php/php_functions.php?",
					data:{"function":'get_department', 
						  "faculty_id":faculty},
					cache:false,
					success:function(res){
						$("#department").html(res);
					}
				});
		    }
	    }

		function department_selected(){
	    	var department = $("#department").val();
	    	var course = $("#course").val();
	    	if(department > 0){
	    		$.ajax({
					type:"POST",
					url:"php/php_functions.php?",
					data:{"function":'get_group', 
						  "department_id":department,
						  "course":course},
					cache:false,
					success:function(res){
						$("#group").html(res);
					}
				});
		    }
	    }

		function course_selected(){
	    	var department = $("#department").val();
	    	var course = $("#course").val();
	    	if(course > 0){
	    		$.ajax({
					type:"POST",
					url:"php/php_functions.php?",
					data:{"function":'get_group1', 
						  "department_id":department,
						  "course":course},
					cache:false,
					success:function(res){
						$("#group").html(res);
					}
				});
		    }
	    }

		isEditable = false;
		id = "";
		
		function edit_on_off(){
			if(!isEditable){
				isEditable = true;
				$('a[href="javascript:edit_on_off()"]').html("<i class='fa fa-close'> disable edit command</i>");
			}
			else {
				isEditable = false;
				$('a[href="javascript:edit_on_off()"]').html("<i class='fa fa-check'> enable edit command</i>");
			}
		}

		function add_student_modal(){
			initialize();
			$("#add_student").modal('show');
		}

		function get_radio_value(name){
			var rates = document.getElementsByName(name);
			var rate_value;
			for(var i = 0; i < rates.length; i++){
			    if(rates[i].checked){
			        rate_value = rates[i].value;
			    }
			}
			return rate_value;
		}

		function initialize(){
			$("#name_kz").val("");
			$("#surname_kz").val("");
			$("#fathername_kz").val("");
			$("#name_en").val("");
			$("#surname_en").val("");
			$("input:radio[name='gender']").removeAttr("checked");
			$("#birthday").val("");
			$("#email").val("");
			$("#phone_no").val("");

			$("#home_republic option").filter(function() {
				return $(this).text() == "republic"; 
			}).attr('selected', true);
			$("#home_region option").filter(function() {
				return $(this).text() == "region"; 
			}).attr('selected', true);
			$("#home_city option").filter(function() {
				return $(this).text() == "city"; 
			}).attr('selected', true);
			$("#home_address").val("");
			$("#home_home_no").val("");

			$("#current_republic option").filter(function() {
				return $(this).text() == "republic"; 
			}).attr('selected', true);
			$("#current_region option").filter(function() {
				return $(this).text() == "region"; 
			}).attr('selected', true);
			$("#current_city option").filter(function() {
				return $(this).text() == "city"; 
			}).attr('selected', true);
			$("#current_address").val("");
			$("#current_home_no").val("");

			

			$("#fm_type_of_affinity option").filter(function() {
				return $(this).text() == "select"; 
			}).attr('selected', true);
			$("#fm_name").val("");
			$("#fm_surname").val("");
			$("#fm_study_info").val("");
			$("#fm_work_info").val("");
			$("#fm_count").val("1");
			for(var i = 1 ; i <= 7; i++){
				var t = 'add_fm';
				t += i;
				document.getElementById(t).style.display = "block";

				t = 'fm';
				t += (i);
				document.getElementById(t).style.display = "none";

				$("#fm_type_of_affinity" + i + " option").filter(function() {
					return $(this).text() == "select"; 
				}).attr('selected', true);
				$("#fm_name" + i).val("");
				$("#fm_surname" + i).val("");
				$("#fm_study_info" + i).val("");
				$("#fm_work_info" + i).val("");
			}


			

			$("#sdu_id").val("");
			$("#faculty option").filter(function() {
				return $(this).text() == "faculty"; 
			}).attr('selected', true);
			$("#department option").filter(function() {
				return $(this).text() == "department"; 
			}).attr('selected', true);
			$("#course option").filter(function() {
				return $(this).text() == "course"; 
			}).attr('selected', true);
			$("#group option").filter(function() {
				return $(this).text() == "group"; 
			}).attr('selected', true);
			$("#gpa").val("");
			$("#grant_type option").filter(function() {
				return $(this).text() == "grant_type"; 
			}).attr('selected', true);
			$("input:radio[name='stipend']").removeAttr("checked");
		}

		function add_student(){
			var name_kz = $("#name_kz").val();
			var surname_kz = $("#surname_kz").val();
			var fathername_kz = $("#fathername_kz").val();
			var name_en = $("#name_en").val();
			var surname_en = $("#surname_en").val();
			var gender = "";
			if($('input[name=gender]:checked').val() != null){
				gender = $('input[name=gender]:checked').val();
			}
			var birthday = $("#birthday").val();
			var email = $("#email").val();
			var phone_no = $("#phone_no").val();

			/*window.alert(name_kz + "|" + surname_kz + "|" + fathername_kz + "|" + name_en + 
					"|" + surname_en + "|" + gender + "|" + birthday + "|" + email + "|" + phone_no);*/


			var home_republic_id = $("#home_republic").val();
			var home_region_id = $("#home_region").val();
			var home_city_id = $("#home_city").val();
			var home_address = $("#home_address").val();
			var home_home_no = $("#home_home_no").val();

			var current_republic_id = $("#current_republic").val();
			var current_region_id = $("#current_region").val();
			var current_city_id = $("#current_city").val();
			var current_address = $("#current_address").val();
			var current_home_no = $("#current_home_no").val();

			/*window.alert(home_republic_id + " | " + home_region_id + " | " + home_city_id + " | " + 
					home_address + " | " + home_home_no + " <br/> " + 
					current_republic_id + " | " + current_region_id + " | " + current_city_id + " | " + 
					current_address + " | " + current_home_no);*/


			var fm_count = $("#fm_count").val();
			var fm_info = "";
			for(var i = 0 ; i < fm_count; i++){
				if(i == 0){
					fm_info += $("#fm_type_of_affinity").val() + "|";
					fm_info += $("#fm_name").val() + "|";
					fm_info += $("#fm_surname").val() + "|";
					fm_info += $("#fm_study_info").val() + "|";
					fm_info += $("#fm_work_info").val() + "|";
				}
				else{
					fm_info += $("#fm_type_of_affinity" + i).val() + "|";
					fm_info += $("#fm_name" + i).val() + "|";
					fm_info += $("#fm_surname" + i).val() + "|";
					fm_info += $("#fm_study_info" + i).val() + "|";
					fm_info += $("#fm_work_info" + i).val() + "|";
				}
			}


			var sdu_id = $("#sdu_id").val();
			var faculty_id = $("#faculty").val();
			var department_id = $("#department").val();
			var course = $("#course").val();
			var group_id = $("#group").val();
			var gpa = $("#gpa").val();
			var grant_type = $("#grant_type").val();
			var stipend = "";
			if($('input[name=stipend]:checked').val() != null){
				stipend = $('input[name=stipend]:checked').val();
			}

			
			if((name_kz.length > 0 &&
				surname_kz.length > 0 &&
				fathername_kz.length > 0 &&
				name_en.length > 0 &&
				surname_en.length > 0 &&
				gender.length > 0 &&
				birthday.length > 0 &&
				email.length > 0 &&
				phone_no.length > 0) &&
				(home_republic_id.length > 0 &&
				home_region_id.length > 0 &&
				home_city_id.length > 0 &&
				home_address.length > 0 &&
				home_home_no.length > 0 &&
				current_republic_id.length > 0 &&
				current_region_id.length > 0 &&
				current_city_id.length > 0 &&
				current_address.length > 0 &&
				current_home_no.length > 0) &&
				(fm_count.length > 0 &&
				fm_info.length > 0) &&
				(sdu_id.length > 0 &&
				faculty_id.length > 0 &&
				department_id.length > 0 &&
				course.length > 0 &&
				group_id.length > 0 &&
				gpa.length > 0 &&
				grant_type.length > 0 &&
				stipend.length > 0)){
				$.ajax({
					type:"POST",
					url:"php/php_functions.php?",
					data:{"function":'add_student', 
						  "name_kz":name_kz, 
						  "surname_kz":surname_kz, 
						  "fathername_kz":fathername_kz, 
						  "name_en":name_en, 
						  "surname_en":surname_en, 
						  "gender":gender,
						  "birthday":birthday,
						  "email":email,
						  "phone_no":phone_no,
						  "home_republic_id":home_republic_id,
						  "home_region_id":home_region_id,
						  "home_city_id":home_city_id,
						  "home_address":home_address,
						  "home_home_no":home_home_no,
						  "current_republic_id":current_republic_id,
						  "current_region_id":current_region_id,
						  "current_city_id":current_city_id,
						  "current_address":current_address,
						  "current_home_no":current_home_no,
						  "fm_count":fm_count,
						  "fm_info":fm_info,
						  "sdu_id":sdu_id,
						  "faculty_id":faculty_id,
						  "department_id":department_id,
						  "course":course,
						  "group_id":group_id,
						  "gpa":gpa,
						  "grant_type":grant_type,
						  "stipend":stipend},
					cache:false,
					success:function(res){
						if(res=="ok"){
							initialize();
							document.getElementById("success").style.display="block";
							$.ajax({
								type:"POST",
								url:"php/php_functions.php?",
								data:{"function":'print_student'},
								cache:false,
								success:function(res){
									$("#table").html("");
									$("#table").html(res);
									isEditable = false;
								}
							});
						}
					}
				});
			}
		}

		function republic_selected(n){
			if( n == 1 ){
				var republic = $("#home_republic").val();
		    	if(republic > 0){
		    		$.ajax({
						type:"POST",
						url:"php/php_functions.php?",
						data:{"function":'get_region', 
							  "republic_id":republic},
						cache:false,
						success:function(res){
							$("#home_region").html(res);
						}
					});
			    }
			}

			else{
				var republic = $("#current_republic").val();
		    	if(republic > 0){
		    		$.ajax({
						type:"POST",
						url:"php/php_functions.php?",
						data:{"function":'get_region', 
							  "republic_id":republic},
						cache:false,
						success:function(res){
							$("#current_region").html(res);
						}
					});
			    }
			}	
	    }

		function region_selected(n){
			if( n == 1 ){
		    	var region = $("#home_region").val();
		    	if(region > 0){
		    		$.ajax({
						type:"POST",
						url:"php/php_functions.php?",
						data:{"function":'get_city', 
							  "region_id":region},
						cache:false,
						success:function(res){
							$("#home_city").html(res);
						}
					});
			    }
		    }
			else{
				var region = $("#current_region").val();
		    	if(region > 0){
		    		$.ajax({
						type:"POST",
						url:"php/php_functions.php?",
						data:{"function":'get_city', 
							  "region_id":region},
						cache:false,
						success:function(res){
							$("#current_city").html(res);
						}
					});
			    }
			}
		}

	</script>
	
	<script type="text/javascript">
		$('#birthday').datetimepicker({
			lang:'en',
			defaultDate:'10/10/2014',
			timepicker:false,
			format:'d-m-Y',
			formatDate:'Y-m-d'
		});
	</script>
	
</body>

</html>