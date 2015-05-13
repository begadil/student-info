// 		$pdf->Cell(7,10,"#",1,0);
// 		if(in_array("fullname", $req)){
// 			$nl = 0;
// 			if($last == "fullname") $nl = 1;
// 			$pdf->Cell(270/$count,10,"Name & Surname",1,$nl);
// 		}
// 		if(in_array("gender", $req)){
// 			$nl = 0;
// 			if($last == "gender") $nl = 1;
// 			$pdf->Cell(270/$count,10,"Gender",1,$nl);
// 		}
// 		if(in_array("birthday", $req)){
// 			$nl = 0;
// 			if($last == "birthday") $nl = 1;
// 			$pdf->Cell(270/$count,10,"Birthday",1,$nl);
// 		}
// 		if(in_array("sdu_id", $req)){
// 			$nl = 0;
// 			if($last == "sdu_id") $nl = 1;
// 			$pdf->Cell(270/$count,10,"SDU ID",1,$nl);
// 		}
// 		if(in_array("sdu_info", $req)){
// 			$nl = 0;
// 			if($last == "sdu_info") $nl = 1;
// 			$pdf->Cell(270/$count,10,"SDU Info",1,$nl);
// 		}
// 		if(in_array("contact_info", $req)){
// 			$nl = 0;
// 			if($last == "contact_info") $nl = 1;
// 			$pdf->Cell(270/$count,10,"Contact Info",1,$nl);
// 		}
// 		if(in_array("home_address", $req)){
// 			$nl = 0;
// 			if($last == "home_address") $nl = 1;
// 			$pdf->Cell(270/$count,10,"Home Address",1,$nl);
// 		}
// 		if(in_array("current_address", $req)){
// 			$nl = 0;
// 			if($last == "current_address") $nl = 1;
// 			$pdf->Cell(270/$count,10,"Current Address",1,$nl);
// 		}
// 		if(in_array("family_info", $req)){
// 			$nl = 0;
// 			if($last == "family_info") $nl = 1;
// 			$pdf->Cell(270/$count,10,"Family Info",1,$nl);
// 		}
		
		
// 		$q = mysql_query($_REQUEST['query']);
// 		$i = 1;
// 		$pdf->SetFont("times", "", 7);
// 		while ($a = mysql_fetch_array($q)){
// 			$pdf->Cell(7,30,"$i",1,0);
// 			if(in_array("fullname", $req)){
// 				$nl = 0;
// 				if($last == "fullname") $nl = 1;
// 				$pdf->Cell(270/$count,30,"$a[name_en] $a[surname_en]",1,$nl);
// 			}
// 			if(in_array("gender", $req)){
// 				$nl = 0;
// 				if($last == "gender") $nl = 1;
// 				$pdf->Cell(270/$count,30,"$a[gender]",1,$nl);
// 			}
// 			if(in_array("birthday", $req)){
// 				$nl = 0;
// 				if($last == "birthday") $nl = 1;
// 				$birthday = date( "F j, Y", strtotime( $a['birthday']));
// 				$pdf->Cell(270/$count,30,"$birthday",1,$nl);
// 			}
// 			if(in_array("sdu_id", $req)){
// 				$nl = 0;
// 				if($last == "sdu_id") $nl = 1;
// 				$qq = mysql_query("select * from sdu_info where id = '$a[sdu_info_id]'");
// 				$aa = mysql_fetch_array($qq);
// 				$pdf->Cell(270/$count,30,"$aa[sdu_id]",1,$nl);
// 			}
// 			if(in_array("sdu_info", $req)){
// 				$nl = 0;
// 				if($last == "sdu_info") $nl = 1;
				
// 				$qq = mysql_query("select fac.name as 'f_name', dep.name as 'd_name', gr.name as 'g_name',
// 									si.grant_type as 'grant_type', si.stipend as 'stipend'
// 									 from sdu_info as si, faculty as fac, department as dep, `group` as gr
// 									  where si.id = '$a[sdu_info_id]' and fac.id = si.faculty_id
// 										and dep.id = si.department_id and gr.id = si.group_id");
// 				$aa = mysql_fetch_array($qq);
				
// 				$pdf->MultiCell(270/$count,30,"$aa[f_name]\n$aa[d_name]\nGroup: $aa[g_name]\nGrant type: $aa[grant_type]\nStipend: $aa[stipend]",1,'L',$nl);
// 				$pdf->Ln(0,true);
				
// 			}
// 			if(in_array("contact_info", $req)){
// 				$nl = 0;
// 				if($last == "contact_info") $nl = 1;
// 				$pdf->MultiCell(270/$count,30,"$a[email]\n$a[phone_no]",1,'L',$nl);
// 			}
// 			if(in_array("home_address", $req)){
// 				$nl = 0;
// 				if($last == "home_address") $nl = 1;
// 				$qq = mysql_query("select rep.name as 'repname', c.name as 'cname', reg.name as 'regname', 
// 									ad.addr as 'addr', ad.home_no as 'homeno' 
// 									 from address as ad, republic as rep, city as c, region as reg 
// 									  where ad.id = '$a[home_address_id]' and rep.id = ad.republic_id 
// 									   and c.id = ad.city_id and reg.id = ad.region_id");
// 				$aa = mysql_fetch_array($qq);
// 				$pdf->MultiCell(270/$count,6,"$aa[repname]\n$aa[regname]\n$aa[cname]\n$aa[addr] $aa[homeno]",1,'J',$nl);
// 			}
			
// 			$i++;
// 		}