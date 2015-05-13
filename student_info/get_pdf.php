<?php 
	
	//echo $_REQUEST['query'];
	
	//echo "  KKKKKKKKKKKKKKkk   ";
	
	//echo $_REQUEST['required_list'];

	
	if(isset($_REQUEST['query']) && isset($_REQUEST['required_list'])){
		require('fpdf/html_table.php');
		include("php/connection.php");
		
		$pdf = new PDF_HTML_TABLE();
		$pdf->AddPage('L');
		
		$req = explode("|", $_REQUEST['required_list']);
		$count = $req[0];
		$last = $req[$count];
		$pdf->SetFont("Arial", "B", 8);
		
		$html="<TABLE><TR>";
		
		if(in_array("fullname", $req)){
			$html .= "<TD>Name & Surname</TD>";
		}
		
		if(in_array("gender", $req)){
			$html .= "<TD>Gender</TD>";
		}
		
		if(in_array("birthday", $req)){
			$html .= "<TD>Birthday</TD>";
		}
		
		if(in_array("sdu_id", $req)){
			$html .= "<TD>SDU ID</TD>";
		}
		
		if(in_array("sdu_info", $req)){
			$html .= "<TD>SDU Info</TD>";
		}
		
		if(in_array("contact_info", $req)){
			$html .= "<TD>Contact Info</TD>";
		}
		
		if(in_array("home_address", $req)){
			$html .= "<TD>Home Address</TD>";
		}
		
		if(in_array("current_address", $req)){
			$html .= "<TD>Current Address</TD>";
		}
		
		if(in_array("family_info", $req)){
			$html .= "<TD>Family Info</TD>";
		}
		
		$q = mysql_query($_REQUEST['query']);
		$pdf->SetFont("Arial", "", 7);
		
		while ($a = mysql_fetch_array($q)){
			$html .= "<TR>";
			
			if(in_array("fullname", $req)){
				$html .= "<TD>$a[name_en] $a[surname_en]</TD>";
			}
			
			if(in_array("gender", $req)){
				$html .= "<TD>$a[gender]</TD>";
			}
			
			if(in_array("birthday", $req)){
				$birthday = date( "F j, Y", sTRtotime( $a['birthday']));
				$html .= "<TD>$birthday</TD>";
			}
			
			if(in_array("sdu_id", $req)){
				$qq = mysql_query("select * from sdu_info where id = '$a[sdu_info_id]'");
				$aa = mysql_fetch_array($qq);
				$html .= "<TD>$aa[sdu_id]</TD>";
			}
			
			if(in_array("sdu_info", $req)){
				$qq = mysql_query("select fac.name as 'f_name', dep.name as 'd_name', gr.name as 'g_name',
									si.grant_type as 'grant_type', si.stipend as 'stipend'
									 from sdu_info as si, faculty as fac, department as dep, `group` as gr
									  where si.id = '$a[sdu_info_id]' and fac.id = si.faculty_id
									   and dep.id = si.department_id and gr.id = si.group_id");
				$aa = mysql_fetch_array($qq);
				$html .= "<TD>$aa[f_name]\n$aa[d_name]\nGroup: $aa[g_name]\nGrant type: $aa[grant_type]\nStipend: $aa[stipend]</TD>";
			}
			
			if(in_array("contact_info", $req)){
				$html .= "<TD>$a[email]\n$a[phone_no]</TD>";
			}
			
			if(in_array("home_address", $req)){
				$qq = mysql_query("select rep.name as 'repname', c.name as 'cname', reg.name as 'regname',
									ad.addr as 'addr', ad.home_no as 'homeno'
									 from address as ad, republic as rep, city as c, region as reg
									  where ad.id = '$a[home_address_id]' and rep.id = ad.republic_id
									   and c.id = ad.city_id and reg.id = ad.region_id");
				$aa = mysql_fetch_array($qq);
				$html .= "<TD>$aa[repname]\n$aa[regname]\n$aa[cname]\n$aa[addr] $aa[homeno]</TD>";
			}
			
			if(in_array("current_address", $req)){
				$qq = mysql_query("select rep.name as 'repname', c.name as 'cname', reg.name as 'regname',
									ad.addr as 'addr', ad.home_no as 'homeno'
									 from address as ad, republic as rep, city as c, region as reg
									  where ad.id = '$a[current_address_id]' and rep.id = ad.republic_id
									   and c.id = ad.city_id and reg.id = ad.region_id");
				$aa = mysql_fetch_array($qq);
				$html .= "<TD>$aa[repname]\n$aa[regname]\n$aa[cname]\n$aa[addr] $aa[homeno]</TD>";
			}
			
			if(in_array("family_info", $req)){
				$qq = mysql_query("select * from family_member where student_id = '$a[id]'");
				$html .= "<TD>";
				$n = mysql_num_rows($qq);
				$i = 1;
				while($aa = mysql_fetch_array($qq)){
					$html .= "$aa[type_of_affinity]:\n$aa[name] $aa[surname]\n$aa[study_info]\n$aa[work_info]\n";
					if($i<$n){
						$html .= "-----------------------------\n";
					}
					$i++;
				}
				$html .= "</TD>";
			}
			$html .= "</TR>";
			
		}
		
		
		$html .= "</TR></TABLE>";
		$pdf->WriteHTML($html);
		
		$pdf->Output('search_result.pdf', 'I');
	}
	else{
		echo "<p style='text-align:center; padding:20px;'>page not found</p>";
	}
	
	
?>