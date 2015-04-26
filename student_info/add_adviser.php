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
							<div class="col-lg-5">
						  		<select id = "adviser_groups" class = "form-control">
						  			<option value = "">select</option>
						  			<?php 
						  				$q = mysql_query("select id, name from `group`");
						  				while($a = mysql_fetch_array($q)){
						  					echo "<option value = '$a[id]'>$a[name]</option>";
						  				}
						  			?>
						  		</select>
							</div>
							<div class="col-lg-5">
								<div class="well" id="selected groups">
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
					
				</div>
		  		</form>
				<div class="modal-footer">
					<input type="submit" class="btn btn-success" value="Add" onclick="add_adviser()"/>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
		  		</div>
				
			</div>
		</div>
	</div>
	
	<script src="js/jquery.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<script>

		function add_adviser_modal(){
			initialize();
			$("#add_adviser").modal('show');
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
			$("#address").val("");
			$("#phone_no").val("");
			$("#tariff_rate").val("");
		}
	
	</script>
	
</body>

</html>