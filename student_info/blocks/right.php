		<div id="sidebar-wrapper">
			
			<h3>Search by: </h3>
			
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-info">
			    	<div class="panel-heading" role="tab" id="headingOne">
			      		<h4 class="panel-title">
			        		<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			          			name or id
			        		</a>
			      		</h4>
			    	</div>
			    	
			    	<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
			      		<div class="panel-body">
			      			<div class="row">
			      				<div class="col-lg-1"></div>
			      				<form class="col-lg-9 form-horizontal" role="form">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="enter name" id="search_name" onKeyUp="show_result()"/>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" placeholder="enter surname" id="search_surname" onKeyUp="show_result()"/>
									</div>
									<div class="form-group">
										<label class="control-label">Gender: </label>
										<div class="col-lg-12">
											<label class = "radio-inline"><input type="radio" name="search_gender" value = 'male' onClick="show_result()">male</label>
											<label class = "radio-inline"><input type="radio" name="search_gender" value = 'female' onClick="show_result()">female</label>
										</div>
									</div>
								</form>
			      				<div class="col-lg-2"></div>
			      			</div>
			      		</div>
			    	</div>
			  	</div>
			  	
			  	<div class="panel panel-info">
			    	<div class="panel-heading" role="tab" id="headingTwo">
			      		<h4 class="panel-title">
			        		<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			          			address
			        		</a>
			      		</h4>
			    	</div>
			    	<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
			      		<div class="row">
			      			<div class="col-lg-1"></div>
			      			<form class="col-lg-9 form-horizontal" role="form">
								<div class="form-group">
									<label class="control-label">Address type: </label>
									<div class="col-lg-12">
										<label class="radio-inline"><input type="radio" name="search_address_type" value = 'home' onClick="show_result()" checked="checked">home</label>
										<label class="radio-inline"><input type="radio" name="search_address_type" value = 'current' onClick="show_result()">current</label>
									</div>
								</div>
								<div class="form-group">
									<select id = "republic" class="form-control" onchange="republic_selected()">
										<option value = "0">republic</option>
										<?php 
											$q = mysql_query("select id, name from republic");
											while($a = mysql_fetch_array($q)){
												echo "<option value = '$a[id]'>$a[name]</option>";
											}
										?>
									</select>
								</div>
								
								<div class="form-group">
									<select id = "region" class="form-control" onchange="region_selected()">
										<option value = "0">region</option>
									</select>
								</div>
								
								<div class="form-group">
									<select id = "city" class="form-control" onchange="show_result()">
										<option value = "0">city</option>
									</select>
								</div>
							</form>
			      			<div class="col-lg-2"></div>
			      		</div>
			    	</div>
			  	</div>
			  	
			  	<div class="panel panel-info">
			    	<div class="panel-heading" role="tab" id="headingThree">
			      		<h4 class="panel-title">
			        		<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			          			sdu info
			        		</a>
			      		</h4>
			    	</div>
			    	<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
			      		<div class="row">
			      			<div class="col-lg-1"></div>
			      			<form class="col-lg-9 form-horizontal" role="form">
			      			
								<div class="form-group">
									<input type="text" class="form-control" placeholder="enter sdu_id" id="search_sdu_id" onKeyUp="show_result()"/>
								</div>
								
								<div class="form-group">
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
								
								<div class="form-group">
									<select id = "department" class="form-control" onchange="department_selected()">
										<option value = "0">department</option>
									</select>
								</div>
								
								<div class="form-group">
									<select id = "course" class="form-control" onchange="course_selected()">
										<option value = "0">course</option>
										<option value = "1">I</option>
										<option value = "2">II</option>
										<option value = "3">III</option>
										<option value = "4">IV</option>
									</select>
								</div>
								
								<div class="form-group">
									<select id = "group" class="form-control" onchange="show_result()">
										<option value = "0">group</option>
									</select>
								</div>
								
								<div class="form-group">
									<select id = "grant_type" class="form-control" onchange="show_result()">
										<option value = "">grant_type</option>
										<option value = "SDU grant">SDU grant</option>
										<option value = "State grant">State grant</option>
										<option value = "Paid">Paid</option>
									</select>
								</div>
								
								<div class="form-group">
									<label class="control-label">Stipend: </label>
									<div class="col-lg-12">
						  				<label class="radio-inline"><input type="radio" name="search_stipend" value = 'yes' onClick="show_result()">yes</label>
										<label class="radio-inline"><input type="radio" name="search_stipend" value = 'no' onClick="show_result()">no</label>
									</div>
								</div>
								
								<div class="form-group">
									<label class="control-label">GPA: </label>
									<div class="form-group row">
										<div class="col-lg-6">
											<input type="text" class="form-control" placeholder="min gpa" id="min_gpa" onKeyUp="show_result()"/>
										</div>
									 	<div class="col-lg-6">
									 		<input type="text" class="form-control" placeholder="max gpa" id="max_gpa" onKeyUp="show_result()"/>
									 	</div>
										
									</div>
								</div>
								
							</form>
			      			<div class="col-lg-2"></div>
			      		</div>
			    	</div>
			  	</div>
			  	
			  	<div class="panel panel-info">
			    	<div class="panel-heading" role="tab" id="headingFour">
			      		<h4 class="panel-title">
			        		<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
			          			family
			        		</a>
			      		</h4>
			    	</div>
			    	<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
			      		<div class="panel-body">
			      			<div class="row">
			      				<div class="col-lg-1"></div>
			      				<form class="col-lg-9 form-horizontal" role="form">
									<div class="form-group">
										<label class="control-label">Family members count: </label>
										<div class="col-lg-12">
							  				<label class="radio-inline"><input type="radio" name="search_family" value = 'let3' onClick="show_result()"> ≤3 </label>
											<label class="radio-inline"><input type="radio" name="search_family" value = 'bt3' onClick="show_result()"> >3 </label>
										</div>
									</div>
								</form>
			      				<div class="col-lg-2"></div>
			      			</div>
			      		</div>
			    	</div>
			  	</div>
			  	
			</div>
		</div>