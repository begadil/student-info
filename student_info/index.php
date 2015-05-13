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
    <title>Student Info | ADMIN</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/index/index.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="css/graph/morris.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:400,700' rel='stylesheet' type='text/css'>
</head>
<body>

	<?php 
		include("blocks/nav.php");
	?>

	<div id="wrapper">
        
		<?php 
			include("blocks/right.php");
		?>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
						<div id="hide_show">
							<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-th-list fa-2x"></i></a>
						</div>
                        <div class="row res">
                        	<div class="col-lg-12">
                        		<div id="result_buttons">
	                        		<ul id="ul_buttons" class = "text-right" style = "display:none;">
	                        			<li><a href='javascript:show_statictics_popup()'><i class='fa fa-line-chart'> show statistics</i></a></li>
	                        			<li><a href='javascript:get_pdf_popup()'><i class='fa fa-file-pdf-o'> get pdf</i></a></li>
	                        		</ul>
	                        		<hr/>
	                        	</div>
                        		<div id="result">
                        			no data found
                        		</div>
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade bs-example-modal-sm" id="get_pdf_popup" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
		  		<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" align="center"><strong>Select columns</strong></h4>
		  		</div>
				
				<div class="modal-body">
					<form class="form-horizontal" role="form" style="padding-left:1em;">
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "chc_fullname">Name & Surname</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "chc_gender">Gender</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "chc_birthday">Birthday</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "chc_sdu_id">SDU ID</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "chc_sdu_info">SDU Info</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "chc_contact_info">Contact Info</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "chc_home_address">Home Address</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "chc_current_address">Current Address</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "chc_family_info">Family Info</label>
						</div>
						<div class='alert alert-danger' role='alert' id = "errorC" style="margin-top:5px; margin-bottom:-12px; display:none;">
							<p align='center'> <strong>please, select at least one of them</strong> </p>
						</div>
					</form>
				</div>
				
				<div class="modal-footer">
					<input type="button" class="btn btn-success" value="OK" onclick="get_pdf()"/>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
		  		</div>
				
			</div>
		</div>
	</div>
    
    
    <div class="modal fade bs-example-modal-sm" id="show_statictics_popup" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
		  		<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" align="center"><strong>Select graphs</strong></h4>
		  		</div>
				
				<div class="modal-body">
					<form class="form-horizontal" role="form" style="padding-left:1em;">
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "ch_gender">Gender</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "ch_faculty">Faculty</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "ch_gpa">GPA</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "ch_stipend">Stipend</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "ch_grant">Grant</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "ch_region">Region</label>
						</div>
						<div class="checkbox">
						  	<label><input type="checkbox" value="" id = "ch_city">City</label>
						</div>
						<div class='alert alert-danger' role='alert' id = "errorH" style="margin-top:5px; margin-bottom:-12px; display:none;">
							<p align='center'> <strong>please, select at least one of them</strong> </p>
						</div>
					</form>
				</div>
				
				<div class="modal-footer">
					<input type="button" class="btn btn-success" value="OK" onclick="show_statictics_modal()"/>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
		  		</div>
				
			</div>
		</div>
	</div>
    
	<div class="modal fade bs-example-modal-lg" id="show_statictics" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
		  		<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title" align="center"><strong>Statistics</strong></h4>
		  		</div>
		  	
				<div class="modal-body"  style = "min-height: 500px;" id="graphs">
					<div class="well" id="w_gender-chart">
						<div class="row">
							<p style = "font-size:2em; padding-left: 0.3em;" class="text-left">
								<span class='label label-warning'>Gender</span>
							</p>
							<div class="col-lg-12">
								<div id="gender-chart" style = "width: 300px; height:300px; margin:20px auto;"></div>
							</div>
						</div>
					</div>
					<hr id="h_gender-chart"/>
					
					<div class="well" id="w_faculty-chart">
						<div class="row">
							<p style = "font-size:2em; padding-left: 0.3em;" class="text-left">
								<span class='label label-warning'>Faculty</span>
							</p>
							<div class="col-lg-12">
								<div id="faculty-chart" style = "width: 500px; height:300px; margin:20px auto;"></div>
							</div>
						</div>
					</div>
					<hr id="h_faculty-chart"/>
					
					<div class="well" id="w_gpa-chart">
						<div class="row">
							<p style = "font-size:2em; padding-left: 0.3em;" class="text-left">
								<span class='label label-warning'>GPA</span>
							</p>
							<div class="col-lg-12">
								<div id="gpa-chart" style = "width: 500px; height:350px; margin:20px auto;"></div>
							</div>
						</div>
					</div>
					<hr id="h_gpa-chart"/>
					
					<div class="well" id="w_stipend-chart">
						<div class="row">
							<p style = "font-size:2em; padding-left: 0.3em;" class="text-left">
								<span class='label label-warning'>Stipend</span>
							</p>
							<div class="col-lg-12">
								<div id="stipend-chart" style = "width: 500px; height:350px; margin:20px auto;"></div>
							</div>
						</div>
					</div>
					<hr id="h_stipend-chart"/>
					
					<div class="well" id="w_grant-chart">
						<div class="row">
							<p style = "font-size:2em; padding-left: 0.3em;" class="text-left">
								<span class='label label-warning'>Grant Type</span>
							</p>
							<div class="col-lg-12">
								<div id="grant-chart" style = "width: 500px; height:300px; margin:20px auto;"></div>
							</div>
						</div>
					</div>
					<hr id="h_grant-chart"/>
					
					<div class="well" id="w_h_region-chart">
						<div class="row">
							<p style = "font-size:2em; padding-left: 0.3em;" class="text-left">
								<span class='label label-warning'>Home Region</span>
							</p>
							<div class="col-lg-12">
								<div id="h_region-chart" style = "width: 300px; height:300px; margin:20px auto;"></div>
							</div>
						</div>
					</div>
					<hr id="h_h_region-chart"/>
					
					<div class="well" id="w_h_city-chart">
						<div class="row">
							<p style = "font-size:2em; padding-left: 0.3em;" class="text-left">
								<span class='label label-warning'>Home City</span>
							</p>
							<div class="col-lg-12">
								<div id="h_city-chart" style = "width: 300px; height:300px; margin:20px auto;"></div>
							</div>
						</div>
					</div>
					<hr id="h_h_city-chart"/>
					
					<div class="well" id="w_c_region-chart">
						<div class="row">
							<p style = "font-size:2em; padding-left:0.3em;" class="text-left">
								<span class='label label-warning'>Current Region</span>
							</p>
							<div class="col-lg-12">
								<div id="c_region-chart" style = "width: 300px; height:300px; margin:20px auto;"></div>
							</div>
						</div>
					</div>
					<hr id="h_c_region-chart"/>
					
					<div class="well" id="w_c_city-chart">
						<div class="row">
							<p style = "font-size:2em; padding-left:0.3em;" class="text-left">
								<span class='label label-warning'>Current City</span>
							</p>
							<div class="col-lg-12">
								<div id="c_city-chart" style = "width: 300px; height:300px; margin:20px auto;"></div>
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
	
	
	<script src="js/jquery.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
	<script src="js/graph/morris.js"></script>
	
   	
   	<script>
   	
	    $("#menu-toggle").click(function(e) {
	        e.preventDefault();
	        $("#wrapper").toggleClass("toggled");
	    });

	    function get_pdf_popup(){
	    	$("#chc_fullname").prop("checked", false);
	    	$("#chc_gender").prop("checked", false);
	    	$("#chc_birthday").prop("checked", false);
	    	$("#chc_sdu_id").prop("checked", false);
	    	$("#chc_sdu_info").prop("checked", false);
	    	$("#chc_contact_info").prop("checked", false);
	    	$("#chc_home_address").prop("checked", false);
	    	$("#chc_current_address").prop("checked", false);
	    	$("#chc_family_info").prop("checked", false);
	    	document.getElementById("errorC").style.display = "none";
	    	$("#get_pdf_popup").modal('show');
		}

		function get_pdf(){
			var isOk = false;
			var requiredList = "";
			var count = 0;
			if($('#chc_fullname').is(':checked')) {
				isOk = true; 
				requiredList += 'fullname|';
				count++;
			}
			if($('#chc_gender').is(':checked')) {
				isOk = true;
				requiredList += 'gender|';
				count++;
			}
			if($('#chc_birthday').is(':checked')) {
				isOk = true;
				requiredList += 'birthday|';
				count++;
			}
			if($('#chc_sdu_id').is(':checked')) {
				isOk = true;
				requiredList += 'sdu_id|';
				count++;
			}
			if($('#chc_sdu_info').is(':checked')) {
				isOk = true;
				requiredList += 'sdu_info|';
				count++;
			}
			if($('#chc_contact_info').is(':checked')) {
				isOk = true;
				requiredList += 'contact_info|';
				count++;
			}
			if($('#chc_home_address').is(':checked')) {
				isOk = true;
				requiredList += 'home_address|';
				count++;
			}
			if($('#chc_current_address').is(':checked')) {
				isOk = true;
				requiredList += 'current_address|';
				count++;
			}
			if($('#chc_family_info').is(':checked')) {
				isOk = true;
				requiredList += 'family_info';
				count++;
			}
			requiredList = count + "|" + requiredList;
			if(isOk == true){
				window.open("get_pdf.php?query="+ QUERY +"&required_list="+ requiredList +"", '_blank');
			}
			else{
				document.getElementById("errorC").style.display = "block";
			}
		}

	    function show_statictics_popup(){

	    	$("#ch_gender").prop("checked", false);
	    	$("#ch_faculty").prop("checked", false);
	    	$("#ch_gpa").prop("checked", false);
	    	$("#ch_stipend").prop("checked", false);
	    	$("#ch_grant").prop("checked", false);
	    	$("#ch_region").prop("checked", false);
	    	$("#ch_city").prop("checked", false);
	    	document.getElementById("errorH").style.display = "none";
		    
	    	$("#show_statictics_popup").modal('show');
	    	document.getElementById("w_gender-chart").style.display = "none";
			document.getElementById("w_faculty-chart").style.display = "none";
			document.getElementById("w_gpa-chart").style.display = "none";
			document.getElementById("w_stipend-chart").style.display = "none";
			document.getElementById("w_grant-chart").style.display = "none";
			document.getElementById("w_h_region-chart").style.display = "none";
			document.getElementById("w_c_region-chart").style.display = "none";
			document.getElementById("w_h_city-chart").style.display = "none";
			document.getElementById("w_c_city-chart").style.display = "none";
			document.getElementById("h_gender-chart").style.display = "none";
			document.getElementById("h_faculty-chart").style.display = "none";
			document.getElementById("h_gpa-chart").style.display = "none";
			document.getElementById("h_stipend-chart").style.display = "none";
			document.getElementById("h_grant-chart").style.display = "none";
			document.getElementById("h_h_region-chart").style.display = "none";
			document.getElementById("h_c_region-chart").style.display = "none";
			document.getElementById("h_h_city-chart").style.display = "none";
	    	
		}

		function show_statictics_modal(){
			var isOk = false;
			
			if($('#ch_gender').is(':checked')){
				document.getElementById("w_gender-chart").style.display = "block";
				document.getElementById("h_gender-chart").style.display = "block";
				isOk = true;
			}
			if($('#ch_faculty').is(':checked')){
				document.getElementById("w_faculty-chart").style.display = "block";
				document.getElementById("h_faculty-chart").style.display = "block";
				isOk = true;
			}
			if($('#ch_gpa').is(':checked')){
				document.getElementById("w_gpa-chart").style.display = "block";
				document.getElementById("h_gpa-chart").style.display = "block";
				isOk = true;
			}
			if($('#ch_stipend').is(':checked')){
				document.getElementById("w_stipend-chart").style.display = "block";
				document.getElementById("h_stipend-chart").style.display = "block";
				isOk = true;
			}
			if($('#ch_grant').is(':checked')){
				document.getElementById("w_grant-chart").style.display = "block";
				document.getElementById("h_grant-chart").style.display = "block";
				isOk = true;
			}
			if($('#ch_region').is(':checked')){
				document.getElementById("w_h_region-chart").style.display = "block";
				document.getElementById("w_c_region-chart").style.display = "block";
				document.getElementById("h_h_region-chart").style.display = "block";
				document.getElementById("h_c_region-chart").style.display = "block";
				isOk = true;
			}
			if($('#ch_city').is(':checked')){
				document.getElementById("w_h_city-chart").style.display = "block";
				document.getElementById("w_c_city-chart").style.display = "block";
				document.getElementById("h_h_city-chart").style.display = "block";
				isOk = true;
			}

			if(isOk == true){
				show_statictics();
			}
			else{
				document.getElementById("errorH").style.display = "block";
			}
		}

		function show_statictics(){
			document.getElementById("errorH").style.display = "none";
			$("#gender-chart").html("");
			$("#faculty-chart").html("");
			$("#gpa-chart").html("");
			$("#stipend-chart").html("");
			$("#grant-chart").html("");
			$("#h_region-chart").html("");
			$("#h_city-chart").html("");
			$("#c_region-chart").html("");
			$("#c_city-chart").html("");
			$.ajax({
				type:"POST",
				url:"php/php_functions.php?",
				data:{"function":'get_graph_data', 
					  "query":QUERY},
				cache:false,
				success:function(res){
					var array = res.split("|");
					var male = array[0];
					var female = array[1];
					var total = parseInt(male) + parseInt(female);
					var mp = Math.round(male/total * 100);
					var fp = Math.round(female/total * 100);
					
					Morris.Donut({
				        element: 'gender-chart',
				        data: [
						{label: "Male", value: mp}, 
				        {label: "Female", value: fp}
			            ],
						labelColor: '#000',
			            colors: [
			              '#5cb85c',
			              '#d9534f'
			            ],
			            formatter: function (x) { return x + "%"}
				    });

					var eng = array[2];
					var phil = array[3];
					var law = array[4];
					var eco = array[5];
					total = parseInt(eng) + parseInt(phil) + parseInt(law) + parseInt(eco);
					var engp = Math.round(eng/total * 100);
					var philp = Math.round(phil/total * 100);
					var lawp = Math.round(law/total * 100);
					var ecop = Math.round(eco/total * 100);

					Morris.Bar({
						  element: 'faculty-chart',
						  data: [
						    {x: 'Faculty', y: engp, z: philp, a: lawp, b: ecop}
						  ],
						  xkey: 'x',
						  ykeys: ['y','z','a','b'],
						  labels: ['Engineering & Natural Sciences', 'Philology and Educational Sciences', 'Law and Social Sciences', 'Economics and Administrative Sciences']
						}).on('click', function(i, row){
						  console.log(i, row);
					});

					total = 0;
					for(var i = 0; i < 17; i++){
						total += parseInt(array[i+6]);
					}

					Morris.Donut({
				        element: 'h_region-chart',
				        data: [
						{label: "Akmola Region", value: Math.round(parseInt(array[6])/total*100)}, 
				        {label: "Aktobe Region", value: Math.round(parseInt(array[7])/total*100)},
				        {label: "Almaty", value: Math.round(parseInt(array[8])/total*100)}, 
				        {label: "Almaty Region", value: Math.round(parseInt(array[9])/total*100)},
				        {label: "Astana", value: Math.round(parseInt(array[10])/total*100)}, 
				        {label: "Atyrau Region", value: Math.round(parseInt(array[11])/total*100)},
				        {label: "Baikonur", value: Math.round(parseInt(array[12])/total*100)}, 
				        {label: "East Kazakhstan Region", value: Math.round(parseInt(array[13])/total*100)},
				        {label: "Jambyl Region", value: Math.round(parseInt(array[14])/total*100)}, 
				        {label: "Karaganda Region", value: Math.round(parseInt(array[15])/total*100)},
				        {label: "Kostanay Region", value: Math.round(parseInt(array[16])/total*100)}, 
				        {label: "Kyzylorda Region", value: Math.round(parseInt(array[17])/total*100)},
				        {label: "Mangystau Region", value: Math.round(parseInt(array[18])/total*100)}, 
				        {label: "North Kazakhstan Region", value: Math.round(parseInt(array[19])/total*100)},
				        {label: "Pavlodar Region", value: Math.round(parseInt(array[20])/total*100)}, 
				        {label: "South Kazakhstan Region", value: Math.round(parseInt(array[21])/total*100)},
				        {label: "West Kazakhstan Region", value: Math.round(parseInt(array[22])/total*100)}
			            ],
			            formatter: function (x) { return x + "%"}
				    });


					total = 0;
					for(var i = 0; i < 17; i++){
						total += parseInt(array[i+23]);
					}

					Morris.Donut({
				        element: 'c_region-chart',
				        data: [
						{label: "Akmola Region", value: Math.round(parseInt(array[23])/total*100)}, 
				        {label: "Aktobe Region", value: Math.round(parseInt(array[24])/total*100)},
				        {label: "Almaty", value: Math.round(parseInt(array[25])/total*100)}, 
				        {label: "Almaty Region", value: Math.round(parseInt(array[26])/total*100)},
				        {label: "Astana", value: Math.round(parseInt(array[27])/total*100)}, 
				        {label: "Atyrau Region", value: Math.round(parseInt(array[28])/total*100)},
				        {label: "Baikonur", value: Math.round(parseInt(array[29])/total*100)}, 
				        {label: "East Kazakhstan Region", value: Math.round(parseInt(array[30])/total*100)},
				        {label: "Jambyl Region", value: Math.round(parseInt(array[31])/total*100)}, 
				        {label: "Karaganda Region", value: Math.round(parseInt(array[32])/total*100)},
				        {label: "Kostanay Region", value: Math.round(parseInt(array[33])/total*100)}, 
				        {label: "Kyzylorda Region", value: Math.round(parseInt(array[34])/total*100)},
				        {label: "Mangystau Region", value: Math.round(parseInt(array[35])/total*100)}, 
				        {label: "North Kazakhstan Region", value: Math.round(parseInt(array[36])/total*100)},
				        {label: "Pavlodar Region", value: Math.round(parseInt(array[37])/total*100)}, 
				        {label: "South Kazakhstan Region", value: Math.round(parseInt(array[38])/total*100)},
				        {label: "West Kazakhstan Region", value: Math.round(parseInt(array[39])/total*100)}
			            ],
			            formatter: function (x) { return x + "%"}
				    });

					var count = parseInt(array[40]);
					var gpas = [];
					var last = 0;
					for(var i = 0; i < count*2; i+=2){
						gpas.push({"student":array[i+41]+"", "gpa":array[i+42]});
						last = i+42;
					}
					
					
					Morris.Line({
					  element: 'gpa-chart',
					  data: gpas,
					  xkey: 'student',
					  ykeys: ['gpa'],
					  labels: ['GPA'],
					  parseTime: false,
					  hoverCallback: function (index, options, default_content, row) {
					    return default_content.replace("gpa(x)", "" + row.y + "");
					  },
					  xLabelMargin: 10
					});

					last++;

					total = 0;
					for(var i = 0; i < 18; i++){
						total += parseInt(array[i+last]);
					}
					

					Morris.Donut({
				        element: 'h_city-chart',
				        data: [
						{label: "Kokshetau", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Aktobe", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Almaty", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Kaskelen", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Taldykorgan", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Astana", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Atyrau", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Baikonur", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Oskemen", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Taraz", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Karaganda", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Kostanay", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Kyzylorda", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Aktau", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Petropavl", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Pavlodar", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Shymkent", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Oral", value: Math.round(parseInt(array[last++])/total*100)}
			            ],
			            formatter: function (x) { return x + "%"}
				    });

					total = 0;
					for(var i = 0; i < 18; i++){
						total += parseInt(array[i+last]);
					}

					Morris.Donut({
				        element: 'c_city-chart',
				        data: [
						{label: "Kokshetau", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Aktobe", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Almaty", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Kaskelen", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Taldykorgan", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Astana", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Atyrau", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Baikonur", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Oskemen", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Taraz", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Karaganda", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Kostanay", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Kyzylorda", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Aktau", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Petropavl", value: Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "Pavlodar", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Shymkent", value: Math.round(parseInt(array[last++])/total*100)},
				        {label: "Oral", value: Math.round(parseInt(array[last++])/total*100)}
			            ],
			            formatter: function (x) { return x + "%"}
				    });

					var stipend = array[last];
					var no_stipend = array[last+1];
					total = parseInt(stipend) + parseInt(no_stipend);

					Morris.Donut({
				        element: 'stipend-chart',
				        data: [
						{label: "Stipend", value:  Math.round(parseInt(array[last++])/total*100)}, 
				        {label: "No stipend", value:  Math.round(parseInt(array[last++])/total*100)}
			            ],
						labelColor: '#000',
			            colors: [
			              '#5cb85c',
			              '#d9534f'
			            ],
			            formatter: function (x) { return x + "%"}
				    });


					var sdu_grant = array[last++];
					var state_grant = array[last++];
					var paid = array[last++];
					total = parseInt(sdu_grant) + parseInt(state_grant) + parseInt(paid);
					Morris.Bar({
						  element: 'grant-chart',
						  data: [
						    {x: 'Grant type', y: Math.round(sdu_grant/total * 100), z: Math.round(state_grant/total * 100), a: Math.round(paid/total * 100)}
						  ],
						  xkey: 'x',
						  ykeys: ['y','z','a'],
						  labels: ['SDU grant', 'State grant', 'Paid']
						}).on('click', function(i, row){
						  console.log(i, row);
					});

				    
					$("#show_statictics").modal('show');
					
				}
			});
		}

	    function reset(){
	    	$("#search_name").val("");
	    	$("#search_surname").val("");
	    	$('input[name=search_gender]').prop('checked', false);

	    	$("#republic option").filter(function() {
				return $(this).text() == "republic"; 
			}).attr('selected', true);
	    	$("#region option").filter(function() {
				return $(this).text() == "region"; 
			}).attr('selected', true);
	    	$("#city option").filter(function() {
				return $(this).text() == "city"; 
			}).attr('selected', true);

	    	$("#search_sdu_id").val("");
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
	    	$("#grant_type option").filter(function() {
				return $(this).text() == "grant_type"; 
			}).attr('selected', true);
	    	$('input[name=search_stipend]').prop('checked', false);
	    	$("#min_gpa").val("");
	    	$("#max_gpa").val("");
	    	

	    	var name = $("#search_name").val().trim();
	    	var surname = $("#search_surname").val().trim();
			var gender = "";
			if($('input[name=search_gender]:checked').val() != null){
				gender = $('input[name=search_gender]:checked').val();
			}

			var address_type = $('input[name=search_address_type]:checked').val();
			var republic = $("#republic").val();
			var region = $("#region").val();
			var city = $("#city").val();
			
	    	var sdu_id = $("#search_sdu_id").val().trim();
	    	var faculty = $("#faculty").val();
			var department = $("#department").val();
			var course = $("#course").val();
			var group = $("#group").val();
			var grant_type = $("#grant_type").val();
			var stipend = "";
			if($('input[name=search_stipend]:checked').val() != null){
				stipend = $('input[name=search_stipend]:checked').val();
			}
			var min_gpa = 0;
			if($("#min_gpa").val().trim() != ""){
				min_gpa = $("#min_gpa").val().trim();
			}
			var max_gpa = 4;
			if($("#max_gpa").val().trim() != ""){
				max_gpa = $("#max_gpa").val().trim();
			}

			var family_members_count = "";
			if($('input[name=search_family]:checked').val() != null){
				family_members_count = $('input[name=search_family]:checked').val();
			}
	    	
			$("#result").html("no data found");
			document.getElementById("clear_a").style.display = "none";
			document.getElementById("ul_buttons").style.display = "none";
    	}

	    QUERY = "";
	    
	    function show_result(){
		    
	    	var name = $("#search_name").val().trim();
	    	var surname = $("#search_surname").val().trim();
			var gender = "";
			if($('input[name=search_gender]:checked').val() != null){
				gender = $('input[name=search_gender]:checked').val();
			}

			var address_type = $('input[name=search_address_type]:checked').val();
			var republic = $("#republic").val();
			var region = $("#region").val();
			var city = $("#city").val();
			
	    	var sdu_id = $("#search_sdu_id").val().trim();
	    	var faculty = $("#faculty").val();
			var department = $("#department").val();
			var course = $("#course").val();
			var group = $("#group").val();
			var grant_type = $("#grant_type").val();
			var stipend = "";
			if($('input[name=search_stipend]:checked').val() != null){
				stipend = $('input[name=search_stipend]:checked').val();
			}
			var min_gpa = 0;
			if($("#min_gpa").val().trim() != ""){
				min_gpa = $("#min_gpa").val().trim();
			}
			var max_gpa = 4;
			if($("#max_gpa").val().trim() != ""){
				max_gpa = $("#max_gpa").val().trim();
			}

			var family_members_count = "";
			if($('input[name=search_family]:checked').val() != null){
				family_members_count = $('input[name=search_family]:checked').val();
			}
	    	
			if(name == "" && 
			   surname == "" && 
			   sdu_id == "" && 
			   gender == "" && 
			   republic == 0 && 
			   region == 0 && 
			   city == 0 && 
			   faculty == 0 && 
			   department == 0 &&
			   course == 0 &&
			   group == 0 &&
			   grant_type == "" &&
			   stipend == "" &&
			   min_gpa == "" &&
			   max_gpa == "" &&
			   family_members_count == ""){
				$("#result").html("no data found");
				document.getElementById("clear_a").style.display = "none";
				document.getElementById("ul_buttons").style.display = "none";
			}
			else{
				$.ajax({
					type:"POST",
					url:"php/php_functions.php?",
					data:{"function":'search', 
						  "search_name":name,
						  "search_surname":surname,
						  "search_gender":gender,
						  "search_sdu_id":sdu_id,
						  "search_address_type":address_type,
						  "search_republic":republic,
						  "search_region":region,
						  "search_city":city,
						  "search_faculty":faculty,
						  "search_department":department,
						  "search_course":course,
						  "search_group":group,
						  "search_grant_type":grant_type,
						  "search_stipend":stipend,
						  "search_min_gpa":min_gpa,
						  "search_max_gpa":max_gpa,
						  "search_family_member_count":family_members_count},
					cache:false,
					success:function(res){
						if(res==""){
							$("#result").html("no data found");
							document.getElementById("clear_a").style.display = "none";
							document.getElementById("ul_buttons").style.display = "none";
						}
						else {
							$("#result").html("");
							var array = res.split("|");
							QUERY = array[0];
							$("#result").html(array[1]);
							if(res == "no data found php"){
								$("#result").html("no data found");
								document.getElementById("clear_a").style.display = "none";
								document.getElementById("ul_buttons").style.display = "none";
							}
							else{
								document.getElementById("clear_a").style.display = "block";
								document.getElementById("ul_buttons").style.display = "block";
							}
						}
					}
				});
			}
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
	    	show_result();
	    }

	    function department_selected(){
	    	var department = $("#department").val();
	    	if(department > 0){
	    		$.ajax({
					type:"POST",
					url:"php/php_functions.php?",
					data:{"function":'get_group', 
						  "department_id":department,
						  "course":0},
					cache:false,
					success:function(res){
						$("#group").html(res);
					}
				});
		    }
	    	show_result();
	    }

	    function course_selected(){
	    	var department = $("#department").val();
	    	var course = $("#course").val();
	    	if(course > 0){
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
	    	show_result();
	    }

	    function republic_selected(){
	    	var republic = $("#republic").val();
	    	if(republic > 0){
	    		$.ajax({
					type:"POST",
					url:"php/php_functions.php?",
					data:{"function":'get_region', 
						  "republic_id":republic},
					cache:false,
					success:function(res){
						$("#region").html(res);
					}
				});
		    }
	    	show_result();
	    }

	    function region_selected(){
	    	var region = $("#region").val();
	    	if(region > 0){
	    		$.ajax({
					type:"POST",
					url:"php/php_functions.php?",
					data:{"function":'get_city', 
						  "region_id":region},
					cache:false,
					success:function(res){
						$("#city").html(res);
					}
				});
		    }
	    	show_result();
	    }
    </script>
</body>
</html>