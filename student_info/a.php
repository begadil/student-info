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
    <link href="css/graph/morris.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>

</head>

<body>

	<?php 
		include("blocks/nav.php");
		
		
	?>
	
	

	<div id="admin_page">
	
		<?php 
			
			
		?>
	
		<div class="container">
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
					seka
                    <div id="morris-donut-chart"></div>
                    
				</div>
				<div class="col-lg-2"></div>
			</div>
			
			<div class="row">
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
					ss
					<div id="graph">
					
                    </div>
				</div>
				<div class="col-lg-2"></div>
			</div>
		</div>
	</div>
	
	<script src="js/jquery.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
	<script src="js/graph/morris.js"></script>
	
	<script type="text/javascript">

		var gpa = [];
		for(var i = 0; i< 5; i++){
			gpa.push({label:"b",value:"5"});
		}
			Morris.Donut({
		        element: 'morris-donut-chart',
		        data: gpa
		    });

			

			var decimal_data = [];
			for (var x = 0; x <= 360; x += 10) {
			  decimal_data.push({
			    x: x,
			    y: 1.5 + 1.5 * Math.sin(Math.PI * x / 180).toFixed(4)
			  });
			}
			Morris.Line({
			  element: 'graph',
			  data: decimal_data,
			  xkey: 'x',
			  ykeys: ['y'],
			  labels: ['sin(x)'],
			  parseTime: false,
			  hoverCallback: function (index, options, default_content, row) {
			    return default_content.replace("sin(x)", "1.5 + 1.5 sin(" + row.x + ")");
			  },
			  xLabelMargin: 10,
			  integerYLabels: true
			});

			
	
	</script>
	
</body>

</html>