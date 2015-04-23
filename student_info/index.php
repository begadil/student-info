<?php
	session_start();
	if (!(isset($_SESSION['email']) && $_SESSION['email'] != '')) {
		header ("Location: login.php");
	}
	$session_id=$_SESSION['email'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Student Info</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/index/index.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
</head>
<body>
	<div id="wrapper">
        
		<?php
			include("blocks/nav.php");
		?>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<div id="hide_show">
							<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-th-list fa-2x"></i></a>
						</div>
                        <h1>Hello Admin</h1>
                        <p>
							Here you can edit information about club members and add, remove or edit news & events and you can select news or events which will be shown on main page's carousel
						</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/js_functions.js"></script>
   	
   	<script>
	    $("#menu-toggle").click(function(e) {
	        e.preventDefault();
	        $("#wrapper").toggleClass("toggled");
	    });
    </script>
</body>
</html>