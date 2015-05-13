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
	
	<div class="container" id = "adviser_page">
		<div class="row">
			<div class="col-lg-12">
	    		<h3 class="page-header">Password</h3>
			</div>
	        <div class="col-lg-6">
	    		<form class= 'form-horizontal' role='form' id = 'pass_form'>
	    			<div class="form-group" id="error" style="display:none;">
						<div class="col-lg-12">
							<div class='alert alert-danger' role='alert'>
								<p align='center'> <strong>wrong old or new password</strong> </p>
							</div>
						</div>
					</div>
					
					<div class="form-group" id="warning" style="display:none;">
						<div class="col-lg-12">
							<div class='alert alert-warning' role='alert'>
								<p align='center'> <strong>please, fill all the fields</strong> </p>
							</div>
						</div>
					</div>
									
					<div class="form-group" id="success" style="display:none;">
						<div class="col-lg-12">
					  		<div class='alert alert-success' role='alert'>
								<p align='center'> <strong>password has been succesfully changed</strong> </p>
							</div>
						</div>
					</div>
					
	    			<div class="form-group">
						<label class="col-lg-3 control-label">login</label>
						<div class="col-lg-9">
							<input type="text" class="form-control" id="login" value="<?php echo $session_id; ?>" disabled="disabled"/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-3 control-label">old password</label>
						<div class="col-lg-9">
							<input type="password" class="form-control" id="old_password" placeholder="password" onkeyup="aaa()"/>
							<input type="text" class="form-control" id="old_password1" placeholder="password" style='display:none; onkeyup="aaa()"'/>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-3 control-label">new password</label>
						<div class="col-lg-9">
							<input type="password" class="form-control" id="new_password" placeholder="password" onkeyup="aaa()"/>
							<input type="text" class="form-control" id="new_password1" placeholder="password" style='display:none; onkeyup="aaa()"'/>
						</div>
					</div>
						
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-9">
							<div class="checkbox">
								<label id = "show_pass">
									<input type="checkbox" id = "use" onchange="show_password()"/> 
										 show password
								</label>
							</div>
						</div>
					</div>
				
					<div class="form-group">
						<div class="col-lg-3"></div>
						<div class="col-lg-9">
							<input type="button" class="btn btn-success" value="Edit password" onclick="edit_password()"/>
						</div>
					</div>
	    		
	    		</form>
	        </div>
	        <div class="col-lg-6"></div>
	    </div>
	</div>
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script>

		function show_password(){
			if(document.getElementById('use').checked){
				document.getElementById("old_password").style.display = "none";
				document.getElementById("new_password").style.display = "none";
				document.getElementById("old_password1").style.display = "block";
				document.getElementById("new_password1").style.display = "block";
				$("#old_password1").val($("#old_password").val());
				$("#new_password1").val($("#new_password").val());
			}
			else{
				document.getElementById("old_password").style.display = "block";
				document.getElementById("new_password").style.display = "block";
				document.getElementById("old_password1").style.display = "none";
				document.getElementById("new_password1").style.display = "none";
				$("#old_password").val($("#old_password1").val());
				$("#new_password").val($("#new_password1").val());
			}
		}

		function aaa(){
			document.getElementById("warning").style.display = "none";
			document.getElementById("success").style.display = "none";
			document.getElementById("error").style.display = "none";
		}

		function edit_password(){
			if(document.getElementById('use').checked){
				$old = $("#old_password1").val();
				$new = $("#new_password1").val();
			}
			else{
				$old = $("#old_password").val();
				$new = $("#new_password").val();
			}

			if($old.trim().length > 0 && $new.trim().length > 0){
				$login = $("#login").val();
				$.ajax({
					type:"POST",
					url:"php/php_functions.php?",
					data:{"function":'adviser_edit_password', 
						  "email":$login,
						  "old":$old,
						  "new":$new},
					cache:false,
					success:function(res){
						document.getElementById("warning").style.display = "none";
						if(res == "ok"){
							document.getElementById("success").style.display = "block";
							$("#old_password1").val("");
							$("#new_password1").val("");
							$("#old_password").val("");
							$("#new_password").val("");
						}
						else{
							document.getElementById("error").style.display = "block";
						}
					}
				});
			}
			else{
				document.getElementById("warning").style.display = "block";
			}
		}
		
	</script>
	
</body>
</html>