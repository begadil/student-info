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
    <title>Student Info</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/index/index.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
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
                        	<div class="col-lg-9">
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
	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/js_functions.js"></script>
	
   	
   	<script>
   	
	    $("#menu-toggle").click(function(e) {
	        e.preventDefault();
	        $("#wrapper").toggleClass("toggled");
	    });
	    
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
						if(res=="")$("#result").html("no data found");
						else $("#result").html(res);
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
	    		show_result();
		    }
	    	
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
	    		show_result();
		    }
	    	
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
	    		show_result();
		    }
	    	
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
				show_result();
		    }
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
				show_result();
		    }
	    }
    </script>
</body>
</html>