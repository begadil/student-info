
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Login</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/login/login.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-4"></div>
			<div class="col-lg-4">
				<div id="login_form">
					<div id="colors_bar"></div>
					<div class="col-lg-1"></div>
					<form class="col-lg-10 form-horizontal" role="form">
						
						<div class="form-group">
							<input type="text" class="form-control input-lg" placeholder="Email" id="email">
						</div>
						<div class="form-group">
							<input type="password" class="form-control input-lg" placeholder="Password" id="password">
						</div>
						<div class="form-group">
							<a class="btn btn-success btn-lg col-lg-12" onclick="email_password_check()">
								SIGN IN
							</a>
						</div>
						<div class='form-group' id = "err_mess">
							<div class='alert alert-danger' role='alert'>
								<p align='center'> <strong>wrong login or password</strong> </p>
							</div>
						</div>
					
					</form>
					<div class="col-lg-1"></div>
				</div>
			</div>
			<div class="col-lg-4"></div>
		</div>
	</div>

	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/js_functions.js"></script>
</body>
</html>
