<?php 
	require("fpdf/fpdf.php");
	
	//echo $_REQUEST['query'];
	
	//echo "  KKKKKKKKKKKKKKkk   ";
	
	//echo $_REQUEST['required_list'];

	
	if(isset($_REQUEST['query']) && isset($_REQUEST['required_list'])){
		
		include("php/connection.php");
		$q = mysql_query($_REQUEST['query']);
		
		$req = explode("|", $_REQUEST['required_list']);
		
		if(in_array("gender", $req)){
			echo "true";
		}
		
		
		
		//$pdf = new FPDF();
		//$pdf->AddPage('L');
		//$pdf->output();
	}
	else{
		echo "<p style='text-align:center; padding:20px;'>page not found</p>";
	}
	
	
?>