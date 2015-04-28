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
    <link href="css/admin/admin.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
</head>

<body>

	<?php 
		include("blocks/admin/add_adviser_nav.php");
	?>

	<div id="admin_page">
		<div class="container">
			<div class="row">
	            <div class="col-lg-12">
	                <h1 class="page-header">ADVISERS</h1>
	            </div>
	        </div>
	        
	        <div class="row">
	        	<div class="col-lg-12">
	        		<?php
						$q=mysql_query("select * from adviser");
						$n=mysql_num_rows($q);
					?>
					
					<div id="table">
						<?php 
							if($n > 0){
								echo "<p class='text-right'>
									<a href='javascript:edit_on_off()'><i class='fa fa-check'> enable edit command</i></a>
								</p>";
								echo "<table class='table table-hover table-condensed table-bordered'>";
								echo "<thead>
										<tr>
											<th>#</th>
											<th>Name & Surname</th>
											<th>SDU ID</th>
											<th>Email</th>
											<th>Phone no</th>
											<th>Group(s)</th>
										</tr>
									</thead>
									<tbody>";
								$i = 1;
								while($a = mysql_fetch_array($q)){
									echo "<tr onclick='edit_adviser_modal($a[id])'>";
									echo "<td>$i</td>
											<td>$a[name] $a[surname]</td>
											<td>$a[sdu_id]</td>
											<td>$a[email]</td>
											<td>$a[phone_no]</td>";
									$q1 = mysql_query("select gr.* from adviser_group as ag, `group` as gr where ag.adviser_id = '$a[id]' and ag.group_id = gr.id");
									$str = "";
									while($a1 = mysql_fetch_array($q1)){
										$str .= "<p>$a1[name]</p>";
									}
									echo "<td>$str</td>";
									echo "</tr>";
									$i++;
								}
								echo "</table>";
								echo "<p align='center'>
									      <button class='btn btn-info' onclick='add_adviser_modal()'>
										      <i class='fa fa-plus'></i> add adviser
										  </button>
									  </p>";
							}
							else{
								if($n==0){
									echo "<p align='center' style='padding:10px;'><span class='label label-warning'>no advisers</span></p>";
								}
								echo "<p align='center'>
									      <button class='btn btn-info' onclick='add_adviser_modal()'>
										      <i class='fa fa-plus'></i> add adviser
										  </button>
									  </p>";
							}
						?>
					</div>
	        	</div>
	        </div>
		</div>
	</div>
	
	<div class="modal fade" id="add_adviser" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
		  		<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" align="center"><strong>Add Adviser</strong></h4>
		  		</div>
		  	
				<div class="modal-body">
					<form class="form-horizontal" role="form">
					  	<div class="form-group">
							<label class="col-lg-2 control-label">Name</label>
							<div class="col-lg-10">
						  		<input type="text" class="form-control" id="adviser_name" placeholder="Name"/>
							</div>
					  	</div>
					  	
						<div class="form-group">
							<label class="col-lg-2 control-label">Surname</label>
							<div class="col-lg-10">
						  		<input type="text" class="form-control" id="adviser_surname" placeholder="Surname"/>
							</div>
					  	</div>
					  	
					  	<div class="form-group">
							<label class="col-lg-2 control-label">SDU ID</label>
							<div class="col-lg-10">
						  		<input type="text" class="form-control" id="adviser_sdu_id" placeholder="sdu id" />
							</div>
					  	</div>
					  	
					  	<div class="form-group">
							<label class="col-lg-2 control-label">E-mail</label>
							<div class="col-lg-10">
						  		<input type="text" class="form-control" id="adviser_email" placeholder="ex: abc@example.com"/>
							</div>
					  	</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Phone no</label>
							<div class="col-lg-10">
						  		<input type="text" class="form-control" id="adviser_phone_no" placeholder="ex: 87078373694"/>
							</div>
					  	</div>
						
						<div class="form-group">
							<label class="col-lg-2 control-label">Group(s)</label>
							<div class="col-lg-6">
						  		<select id = "adviser_groups" class = "form-control" onchange = "adviser_add_groups()">
						  			<option value = "">select</option>
						  			<?php 
						  				$q = mysql_query("select id, name from `group`");
						  				while($a = mysql_fetch_array($q)){
						  					echo "<option value = '$a[id]'>$a[name]</option>";
						  				}
						  			?>
						  		</select>
							</div>
							<div class="col-lg-4">
								<div class="well" id="adviser_selected_groups">
									no groups yet
								</div>
							</div>
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
									<p align='center'> <strong>employee has been succesfully added</strong> </p>
								</div>
							</div>
					  	</div>
					</form>
				</div>
		  		
				<div class="modal-footer">
					<input type="submit" class="btn btn-success" value="Add" onclick="add_adviser()"/>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
		  		</div>
				
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="edit_adviser" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
		  		<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" align="center"><strong>Edit Adviser</strong></h4>
		  		</div>
		  	
				<div class="modal-body">
					<form class="form-horizontal" role="form">
					  	<div class="form-group">
							<label class="col-lg-2 control-label">Name</label>
							<div class="col-lg-10">
						  		<input type="text" class="form-control" id="adviser_nameE" placeholder="Name"/>
							</div>
					  	</div>
					  	
						<div class="form-group">
							<label class="col-lg-2 control-label">Surname</label>
							<div class="col-lg-10">
						  		<input type="text" class="form-control" id="adviser_surnameE" placeholder="Surname"/>
							</div>
					  	</div>
					  	
					  	<div class="form-group">
							<label class="col-lg-2 control-label">SDU ID</label>
							<div class="col-lg-10">
						  		<input type="text" class="form-control" id="adviser_sdu_idE" placeholder="sdu id" />
							</div>
					  	</div>
					  	
					  	<div class="form-group">
							<label class="col-lg-2 control-label">E-mail</label>
							<div class="col-lg-10">
						  		<input type="text" class="form-control" id="adviser_emailE" placeholder="ex: abc@example.com"/>
							</div>
					  	</div>

						<div class="form-group">
							<label class="col-lg-2 control-label">Phone no</label>
							<div class="col-lg-10">
						  		<input type="text" class="form-control" id="adviser_phone_noE" placeholder="ex: 87078373694"/>
							</div>
					  	</div>
						
						<div class="form-group">
							<label class="col-lg-2 control-label">Group(s)</label>
							<div class="col-lg-6">
						  		<select id = "adviser_groups" class = "form-control" onchange = "adviser_add_groups()">
						  			<option value = "">select</option>
						  			<?php 
						  				$q = mysql_query("select id, name from `group`");
						  				while($a = mysql_fetch_array($q)){
						  					echo "<option value = '$a[id]'>$a[name]</option>";
						  				}
						  			?>
						  		</select>
							</div>
							<div class="col-lg-4">
								<div class="well" id="adviser_selected_groupsE">
									no groups yet
								</div>
							</div>
					  	</div>
						
						<div class="form-group" id="errorE">
							<div class="col-lg-12">
						  		<div class='alert alert-danger' role='alert'>
									<p align='center'> <strong>please, fill all the fields</strong> </p>
								</div>
							</div>
					  	</div>
						
						<div class="form-group" id="successE">
							<div class="col-lg-12">
						  		<div class='alert alert-success' role='alert'>
									<p align='center'> <strong>employee has been succesfully added</strong> </p>
								</div>
							</div>
					  	</div>
					</form>
				</div>
		  		
				<div class="modal-footer">
					<input type="submit" class="btn btn-success" value="Save" onclick="edit_adviser()"/>
					<input type="submit" class="btn btn-danger" value="Remove" onclick="remove_adviser()"/>
		  		</div>
				
			</div>
		</div>
	</div>
	
	<script src="js/jquery.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script>

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

		function add_adviser_modal(){
			initialize();
			$("#add_adviser").modal('show');
		}

		function edit_adviser_modal(ID){
			if(isEditable){
				id = ID;
				$.ajax({
					type:"POST",
					url:"php/php_functions.php?",
					data:{"function":'get_adviser',
						  'adviser_id':id},
					cache:false,
					success:function(res){
						var array = res.split("|");
						$("#adviser_nameE").val(array[0]);
						$("#adviser_surnameE").val(array[1]);
						$("#adviser_groupsE option").filter(function() {
							return $(this).text() == "select"; 
						}).attr('selected', true);
						$("#adviser_sdu_idE").val(array[2]);
						$("#adviser_phone_noE").val(array[3]);
						$("#adviser_emailE").val(array[4]);
						$("#adviser_selected_groups").html("");
						adviser_groups_array = {};
						
					}
				});
				$("#edit_adviser").modal('show');
			}
		}

		function initialize(){
			document.getElementById("error").style.display="none";
			document.getElementById("success").style.display="none";
			$("#adviser_name").val("");
			$("#adviser_surname").val("");
			$("#adviser_groups option").filter(function() {
				return $(this).text() == "select"; 
			}).attr('selected', true);
			$("#adviser_sdu_id").val("");
			$("#adviser_phone_no").val("");
			$("#adviser_email").val("");
			adviser_groups_array = {};
			$("#adviser_selected_groups").html("");
			$("#adviser_selected_groups").append("no groups yet");
		}

		function add_adviser(){
			var name = $("#adviser_name").val();
			var surname = $("#adviser_surname").val();
			var adviser_sdu_id = $("#adviser_sdu_id").val();
			var phone_no = $("#adviser_phone_no").val();
			var email = $("#adviser_email").val();

			
			if(name.length > 0 && 
			   surname.length > 0 && 
			   adviser_sdu_id.length > 0 && 
			   phone_no.length > 0 && 
			   email.length > 0 &&
			   Object.keys(adviser_groups_array).length > 0){

				var arr = "";
				for (var i in adviser_groups_array) {
					arr += i + "|";
				}
				arr = arr.substring(0, arr.length-1);

				   
				$.ajax({
					type:"POST",
					url:"php/php_functions.php?",
					data:{"function":'add_adviser', 
						  "name":name, 
						  "surname":surname, 
						  "adviser_sdu_id":adviser_sdu_id, 
						  "phone_no":phone_no, 
						  "email":email, 
						  "groups":arr},
					cache:false,
					success:function(res){
						if(res=="ok"){
							initialize();
							document.getElementById("success").style.display="block";
							$.ajax({
								type:"POST",
								url:"php/php_functions.php?",
								data:{"function":'print_adviser'},
								cache:false,
								success:function(res){
									$("#table").html("");
									$("#table").html(res);
								}
							});
						}
					}
				});
			}
			else{
				document.getElementById("error").style.display="block";
			}
		}
		
		var adviser_groups_array = {};
		function adviser_add_groups(){
			var key = $("#adviser_groups option:selected").val();
			var val = $("#adviser_groups option:selected").text();
			adviser_groups_array[key] = val;
			print_groups_to_div();
		}

		function print_groups_to_div(){
			$("#adviser_selected_groups").html("");
			$c = 0;
			for (var i in adviser_groups_array) {
				$("#adviser_selected_groups").append("<p><a href = 'javascript:remove_groups(" + i + ")'> " + adviser_groups_array[i] +" <i class='fa fa-close'></i></a> </p>");
				$c = 1;
			}
			if($c == 0){
				$("#adviser_selected_groups").append("no groups yet");
			}
		}

		function remove_groups(key){
			delete adviser_groups_array[key];
			print_groups_to_div();
		}
	
	</script>
	
</body>

</html>