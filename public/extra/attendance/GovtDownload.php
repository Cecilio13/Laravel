<?php
include 'config.php';

?>
<?php

if(isset($_POST['Form1600hiddenIndicator'])){
	
	$Month=$_POST['Month'];
	$Year=$_POST['Year'];
	$L_Name=$_POST['L_Name'];
	$F_Name=$_POST['F_Name'];
	$M_Name=$_POST['M_Name'];
	$TINNO=$_POST['TINNO'];
	$TINNO2=$_POST['TINNO2'];
	$RDO=$_POST['RDO'];
	$tablerowcount=$_POST['tablerowcount'];
	//echo $tablerowcount;
	$myfile = fopen("Files/DAT/1600.dat", "w") or die("Unable to open file!");
	$file="Files/DAT/1600.dat";
	$txt = "HMAP,H1600,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,$Month/$Year,$RDO\n";
	fwrite($myfile, $txt);
	$TotalAmount=0;
	$TotalTax=0;
	for($c=$tablerowcount;$c>0;$c--){
		if(isset($_POST['ATC'.$c])){
			$names=$_POST['RName'.$c];
			$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$names'");
			$rr=mysqli_fetch_array($getEmp);
			$f_name=$rr['fname'];
			$m_name=$rr['mname'];
			$l_name=$rr['lname'];
			$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$names'");
			$rr2=mysqli_fetch_array($getEmp2);
			$TIN=$rr2['tin_number'];
			$ATC=$_POST['ATC'.$c];
			$Amount=$_POST['Amount'.$c];
			$TotalAmount+=$Amount;
			$Rate=$_POST['Rate'.$c];
			$Total=$_POST['Total'.$c];
			$TotalTax+=$Total;
			$txt = "DMAP,D1600,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
			fwrite($myfile, $txt);
		}
	}
	$txt = "CMAP,C1600,$TINNO,$TINNO2,$Month/$Year,$TotalAmount,$TotalTax\n";
	fwrite($myfile, $txt);
	
	/* $txt = "Jane Doe\n";
	fwrite($myfile, $txt); */
	fclose($myfile);
	?>
	<script>
	
	
	$(document).ready(function(){
		
		location.href='extra/attendance/download2.php?file=<?php echo $file; ?>';
	});
	
	</script>
	<?php
}

?>
<?php
if(isset($_POST['Form1601EhiddenIndicator'])){
	$Month=$_POST['Month'];
	$Year=$_POST['Year'];
	$L_Name=$_POST['L_Name'];
	$F_Name=$_POST['F_Name'];
	$M_Name=$_POST['M_Name'];
	$TINNO=$_POST['TINNO'];
	$TINNO2=$_POST['TINNO2'];
	$Quarter=$_POST['Quarter'];
	$RDO=$_POST['RDO'];
	$tablerowcount=$_POST['tablerowcount'];
	//echo $tablerowcount;
	if($Quarter=="Q1"){
		$myfile = fopen("Files/DAT/1601E-1.dat", "w") or die("Unable to open file!");
		$myfile2 = fopen("Files/DAT/1601E-2.dat", "w") or die("Unable to open file!");
		$myfile3 = fopen("Files/DAT/1601E-3.dat", "w") or die("Unable to open file!");
		$file="Files/DAT/1601E-1.dat";
		$file2="Files/DAT/1601E-2.dat";
		$file3="Files/DAT/1601E-3.dat";
		$txt = "HMAP,H1601E,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,01/$Year,$RDO\n";
		$txt2 = "HMAP,H1601E,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,02/$Year,$RDO\n";
		$txt3 = "HMAP,H1601E,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,03/$Year,$RDO\n";
		fwrite($myfile, $txt);
		fwrite($myfile2, $txt2);
		fwrite($myfile3, $txt3);
		$TotalAmount=0;
		$TotalAmount2=0;
		$TotalAmount3=0;
		$TotalTax=0;
		$TotalTax2=0;
		$TotalTax3=0;
		$En=0;
		$En2=0;
		$En3=0;
		for($c=$tablerowcount;$c>0;$c--){
			if(isset($_POST['ATC'.$c])){
				$names=$_POST['RName'.$c];
				$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$names'");
				$rr=mysqli_fetch_array($getEmp);
				$f_name=$rr['fname'];
				$m_name=$rr['mname'];
				$l_name=$rr['lname'];
				$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$names'");
				$rr2=mysqli_fetch_array($getEmp2);
				$TIN=$rr2['tin_number'];
				$ATC=$_POST['ATC'.$c];
				$Month_Tran=$_POST['Month_Tran'.$c];
				$Year_Tran=$_POST['Year_Tran'.$c];
				$Amount=$_POST['Amount'.$c];
				$Rate=$_POST['Rate'.$c];
				$Total=$_POST['Total'.$c];
				
				if($Month_Tran=="01"){
					$TotalAmount+=$Amount;
					$TotalTax+=$Total;
					$txt = "DMAP,D1601E,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile, $txt);
					$En=1;
				}
				else if($Month_Tran=="02"){
					$TotalAmount2+=$Amount;
					$TotalTax2+=$Total;
					$txt2 = "DMAP,D1601E,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile2, $txt2);
					$En2=1;
				}
				else if($Month_Tran=="03"){
					$TotalAmount3+=$Amount;
					$TotalTax3+=$Total;
					$txt3 = "DMAP,D1601E,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile3, $txt3);
					$En3=1;
				}
				
			}
		}
		if($En==1){
			$txt = "CMAP,C1601E,$TINNO,$TINNO2,01/$Year,$TotalAmount,$TotalTax\n";
			fwrite($myfile, $txt);
		}
		if($En2==1){
			$txt2 = "CMAP,C1601E,$TINNO,$TINNO2,02/$Year,$TotalAmount2,$TotalTax2\n";
			fwrite($myfile2, $txt2);
		}
		if($En3==1){
			$txt3 = "CMAP,C1601E,$TINNO,$TINNO2,03/$Year,$TotalAmount3,$TotalTax3\n";
			fwrite($myfile3, $txt3);
		}
		
		
		/* $txt = "Jane Doe\n";
		fwrite($myfile, $txt); */
		fclose($myfile);
		fclose($myfile2);
		fclose($myfile3);
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file2.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file3.'"></iframe>';
		?>
		<script>
		//location.href='extra/attendance/download2.php?file=<?php echo $file; ?>';
		
		$(document).ready(function(){
			
		});
		
		</script>
		<?php
	}
	else if($Quarter=="Q2"){
		$myfile = fopen("Files/DAT/1601E-4.dat", "w") or die("Unable to open file!");
		$myfile2 = fopen("Files/DAT/1601E-5.dat", "w") or die("Unable to open file!");
		$myfile3 = fopen("Files/DAT/1601E-6.dat", "w") or die("Unable to open file!");
		$file="Files/DAT/1601E-4.dat";
		$file2="Files/DAT/1601E-5.dat";
		$file3="Files/DAT/1601E-6.dat";
		$txt = "HMAP,H1601E,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,04/$Year,$RDO\n";
		$txt2 = "HMAP,H1601E,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,05/$Year,$RDO\n";
		$txt3 = "HMAP,H1601E,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,06/$Year,$RDO\n";
		fwrite($myfile, $txt);
		fwrite($myfile2, $txt2);
		fwrite($myfile3, $txt3);
		$TotalAmount=0;
		$TotalAmount2=0;
		$TotalAmount3=0;
		$TotalTax=0;
		$TotalTax2=0;
		$TotalTax3=0;
		$En=0;
		$En2=0;
		$En3=0;
		for($c=$tablerowcount;$c>0;$c--){
			if(isset($_POST['ATC'.$c])){
				$names=$_POST['RName'.$c];
				$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$names'");
				$rr=mysqli_fetch_array($getEmp);
				$f_name=$rr['fname'];
				$m_name=$rr['mname'];
				$l_name=$rr['lname'];
				$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$names'");
				$rr2=mysqli_fetch_array($getEmp2);
				$TIN=$rr2['tin_number'];
				$ATC=$_POST['ATC'.$c];
				$Month_Tran=$_POST['Month_Tran'.$c];
				$Year_Tran=$_POST['Year_Tran'.$c];
				$Amount=$_POST['Amount'.$c];
				$Rate=$_POST['Rate'.$c];
				$Total=$_POST['Total'.$c];
				
				if($Month_Tran=="04"){
					$TotalAmount+=$Amount;
					$TotalTax+=$Total;
					$txt = "DMAP,D1601E,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile, $txt);
					$En=1;
				}
				else if($Month_Tran=="05"){
					$TotalAmount2+=$Amount;
					$TotalTax2+=$Total;
					$txt2 = "DMAP,D1601E,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile2, $txt2);
					$En2=1;
				}
				else if($Month_Tran=="06"){
					$TotalAmount3+=$Amount;
					$TotalTax3+=$Total;
					$txt3 = "DMAP,D1601E,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile3, $txt3);
					$En3=1;
				}
				
			}
		}
		if($En==1){
			$txt = "CMAP,C1601E,$TINNO,$TINNO2,04/$Year,$TotalAmount,$TotalTax\n";
			fwrite($myfile, $txt);
		}
		if($En2==1){
			$txt2 = "CMAP,C1601E,$TINNO,$TINNO2,05/$Year,$TotalAmount2,$TotalTax2\n";
			fwrite($myfile2, $txt2);
		}
		if($En3==1){
			$txt3 = "CMAP,C1601E,$TINNO,$TINNO2,06/$Year,$TotalAmount3,$TotalTax3\n";
			fwrite($myfile3, $txt3);
		}
		
		
		/* $txt = "Jane Doe\n";
		fwrite($myfile, $txt); */
		fclose($myfile);
		fclose($myfile2);
		fclose($myfile3);
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file2.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file3.'"></iframe>';
		?>
		<script>
		//location.href='extra/attendance/download2.php?file=<?php echo $file; ?>';
		
		$(document).ready(function(){
			
		});
		
		</script>
		<?php
	}
	else if($Quarter=="Q3"){
		$myfile = fopen("Files/DAT/1601E-7.dat", "w") or die("Unable to open file!");
		$myfile2 = fopen("Files/DAT/1601E-8.dat", "w") or die("Unable to open file!");
		$myfile3 = fopen("Files/DAT/1601E-9.dat", "w") or die("Unable to open file!");
		$file="Files/DAT/1601E-7.dat";
		$file2="Files/DAT/1601E-8.dat";
		$file3="Files/DAT/1601E-9.dat";
		$txt = "HMAP,H1601E,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,07/$Year,$RDO\n";
		$txt2 = "HMAP,H1601E,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,08/$Year,$RDO\n";
		$txt3 = "HMAP,H1601E,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,09/$Year,$RDO\n";
		fwrite($myfile, $txt);
		fwrite($myfile2, $txt2);
		fwrite($myfile3, $txt3);
		$TotalAmount=0;
		$TotalAmount2=0;
		$TotalAmount3=0;
		$TotalTax=0;
		$TotalTax2=0;
		$TotalTax3=0;
		$En=0;
		$En2=0;
		$En3=0;
		for($c=$tablerowcount;$c>0;$c--){
			if(isset($_POST['ATC'.$c])){
				$names=$_POST['RName'.$c];
				$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$names'");
				$rr=mysqli_fetch_array($getEmp);
				$f_name=$rr['fname'];
				$m_name=$rr['mname'];
				$l_name=$rr['lname'];
				$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$names'");
				$rr2=mysqli_fetch_array($getEmp2);
				$TIN=$rr2['tin_number'];
				$ATC=$_POST['ATC'.$c];
				$Month_Tran=$_POST['Month_Tran'.$c];
				$Year_Tran=$_POST['Year_Tran'.$c];
				$Amount=$_POST['Amount'.$c];
				$Rate=$_POST['Rate'.$c];
				$Total=$_POST['Total'.$c];
				
				if($Month_Tran=="07"){
					$TotalAmount+=$Amount;
					$TotalTax+=$Total;
					$txt = "DMAP,D1601E,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile, $txt);
					$En=1;
				}
				else if($Month_Tran=="08"){
					$TotalAmount2+=$Amount;
					$TotalTax2+=$Total;
					$txt2 = "DMAP,D1601E,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile2, $txt2);
					$En2=1;
				}
				else if($Month_Tran=="09"){
					$TotalAmount3+=$Amount;
					$TotalTax3+=$Total;
					$txt3 = "DMAP,D1601E,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile3, $txt3);
					$En3=1;
				}
				
			}
		}
		if($En==1){
			$txt = "CMAP,C1601E,$TINNO,$TINNO2,07/$Year,$TotalAmount,$TotalTax\n";
			fwrite($myfile, $txt);
		}
		if($En2==1){
			$txt2 = "CMAP,C1601E,$TINNO,$TINNO2,08/$Year,$TotalAmount2,$TotalTax2\n";
			fwrite($myfile2, $txt2);
		}
		if($En3==1){
			$txt3 = "CMAP,C1601E,$TINNO,$TINNO2,09/$Year,$TotalAmount3,$TotalTax3\n";
			fwrite($myfile3, $txt3);
		}
		
		
		/* $txt = "Jane Doe\n";
		fwrite($myfile, $txt); */
		fclose($myfile);
		fclose($myfile2);
		fclose($myfile3);
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file2.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file3.'"></iframe>';
		?>
		<script>
		
		$(document).ready(function(){
			
		});
		
		</script>
		<?php
	}
	else if($Quarter=="Q4"){
		$myfile = fopen("Files/DAT/1601E-10.dat", "w") or die("Unable to open file!");
		$myfile2 = fopen("Files/DAT/1601E-11.dat", "w") or die("Unable to open file!");
		$myfile3 = fopen("Files/DAT/1601E-12.dat", "w") or die("Unable to open file!");
		$file="Files/DAT/1601E-10.dat";
		$file2="Files/DAT/1601E-11.dat";
		$file3="Files/DAT/1601E-12.dat";
		$txt = "HMAP,H1601E,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,10/$Year,$RDO\n";
		$txt2 = "HMAP,H1601E,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,11/$Year,$RDO\n";
		$txt3 = "HMAP,H1601E,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,12/$Year,$RDO\n";
		fwrite($myfile, $txt);
		fwrite($myfile2, $txt2);
		fwrite($myfile3, $txt3);
		$TotalAmount=0;
		$TotalAmount2=0;
		$TotalAmount3=0;
		$TotalTax=0;
		$TotalTax2=0;
		$TotalTax3=0;
		$En=0;
		$En2=0;
		$En3=0;
		for($c=$tablerowcount;$c>0;$c--){
			if(isset($_POST['ATC'.$c])){
				$names=$_POST['RName'.$c];
				$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$names'");
				$rr=mysqli_fetch_array($getEmp);
				$f_name=$rr['fname'];
				$m_name=$rr['mname'];
				$l_name=$rr['lname'];
				$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$names'");
				$rr2=mysqli_fetch_array($getEmp2);
				$TIN=$rr2['tin_number'];
				$ATC=$_POST['ATC'.$c];
				$Month_Tran=$_POST['Month_Tran'.$c];
				$Year_Tran=$_POST['Year_Tran'.$c];
				$Amount=$_POST['Amount'.$c];
				$Rate=$_POST['Rate'.$c];
				$Total=$_POST['Total'.$c];
				
				if($Month_Tran=="10"){
					$TotalAmount+=$Amount;
					$TotalTax+=$Total;
					$txt = "DMAP,D1601E,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile, $txt);
					$En=1;
				}
				else if($Month_Tran=="11"){
					$TotalAmount2+=$Amount;
					$TotalTax2+=$Total;
					$txt2 = "DMAP,D1601E,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile2, $txt2);
					$En2=1;
				}
				else if($Month_Tran=="12"){
					$TotalAmount3+=$Amount;
					$TotalTax3+=$Total;
					$txt3 = "DMAP,D1601E,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile3, $txt3);
					$En3=1;
				}
				
			}
		}
		if($En==1){
			$txt = "CMAP,C1601E,$TINNO,$TINNO2,10/$Year,$TotalAmount,$TotalTax\n";
			fwrite($myfile, $txt);
		}
		if($En2==1){
			$txt2 = "CMAP,C1601E,$TINNO,$TINNO2,11/$Year,$TotalAmount2,$TotalTax2\n";
			fwrite($myfile2, $txt2);
		}
		if($En3==1){
			$txt3 = "CMAP,C1601E,$TINNO,$TINNO2,12/$Year,$TotalAmount3,$TotalTax3\n";
			fwrite($myfile3, $txt3);
		}
		
		
		/* $txt = "Jane Doe\n";
		fwrite($myfile, $txt); */
		fclose($myfile);
		fclose($myfile2);
		fclose($myfile3);
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file2.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file3.'"></iframe>';
		?>
		<script>
		
		$(document).ready(function(){
			
		});
		
		</script>
		<?php
	}
	
}

?>
<?php
if(isset($_POST['Form1601FhiddenIndicator'])){
	$Month=$_POST['Month'];
	$Year=$_POST['Year'];
	$L_Name=$_POST['L_Name'];
	$F_Name=$_POST['F_Name'];
	$M_Name=$_POST['M_Name'];
	$TINNO=$_POST['TINNO'];
	$TINNO2=$_POST['TINNO2'];
	$Quarter=$_POST['Quarter'];
	$RDO=$_POST['RDO'];
	$tablerowcount=$_POST['tablerowcount'];
	//echo $tablerowcount;
	if($Quarter=="Q1"){
		$myfile = fopen("Files/DAT/1601F-1.dat", "w") or die("Unable to open file!");
		$myfile2 = fopen("Files/DAT/1601F-2.dat", "w") or die("Unable to open file!");
		$myfile3 = fopen("Files/DAT/1601F-3.dat", "w") or die("Unable to open file!");
		$file="Files/DAT/1601F-1.dat";
		$file2="Files/DAT/1601F-2.dat";
		$file3="Files/DAT/1601F-3.dat";
		$txt = "HMAP,H1601F,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,01/$Year,$RDO\n";
		$txt2 = "HMAP,H1601F,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,02/$Year,$RDO\n";
		$txt3 = "HMAP,H1601F,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,03/$Year,$RDO\n";
		fwrite($myfile, $txt);
		fwrite($myfile2, $txt2);
		fwrite($myfile3, $txt3);
		$TotalAmount=0;
		$TotalAmount2=0;
		$TotalAmount3=0;
		$TotalTax=0;
		$TotalTax2=0;
		$TotalTax3=0;
		$En=0;
		$En2=0;
		$En3=0;
		for($c=$tablerowcount;$c>0;$c--){
			if(isset($_POST['ATC'.$c])){
				$names=$_POST['RName'.$c];
				$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$names'");
				$rr=mysqli_fetch_array($getEmp);
				$f_name=$rr['fname'];
				$m_name=$rr['mname'];
				$l_name=$rr['lname'];
				$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$names'");
				$rr2=mysqli_fetch_array($getEmp2);
				$TIN=$rr2['tin_number'];
				$ATC=$_POST['ATC'.$c];
				$Month_Tran=$_POST['Month_Tran'.$c];
				$Year_Tran=$_POST['Year_Tran'.$c];
				$Amount=$_POST['Amount'.$c];
				$Rate=$_POST['Rate'.$c];
				$Total=$_POST['Total'.$c];
				
				if($Month_Tran=="01"){
					$TotalAmount+=$Amount;
					$TotalTax+=$Total;
					$txt = "DMAP,D1601F,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile, $txt);
					$En=1;
				}
				else if($Month_Tran=="02"){
					$TotalAmount2+=$Amount;
					$TotalTax2+=$Total;
					$txt2 = "DMAP,D1601F,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile2, $txt2);
					$En2=1;
				}
				else if($Month_Tran=="03"){
					$TotalAmount3+=$Amount;
					$TotalTax3+=$Total;
					$txt3 = "DMAP,D1601F,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile3, $txt3);
					$En3=1;
				}
				
			}
		}
		if($En==1){
			$txt = "CMAP,C1601F,$TINNO,$TINNO2,01/$Year,$TotalAmount,$TotalTax\n";
			fwrite($myfile, $txt);
		}
		if($En2==1){
			$txt2 = "CMAP,C1601F,$TINNO,$TINNO2,02/$Year,$TotalAmount2,$TotalTax2\n";
			fwrite($myfile2, $txt2);
		}
		if($En3==1){
			$txt3 = "CMAP,C1601F,$TINNO,$TINNO2,03/$Year,$TotalAmount3,$TotalTax3\n";
			fwrite($myfile3, $txt3);
		}
		
		
		/* $txt = "Jane Doe\n";
		fwrite($myfile, $txt); */
		fclose($myfile);
		fclose($myfile2);
		fclose($myfile3);
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file2.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file3.'"></iframe>';
		?>
		<script>
		
		$(document).ready(function(){
			
		});
		
		</script>
		<?php
	}
	else if($Quarter=="Q2"){
		$myfile = fopen("Files/DAT/1601F-4.dat", "w") or die("Unable to open file!");
		$myfile2 = fopen("Files/DAT/1601F-5.dat", "w") or die("Unable to open file!");
		$myfile3 = fopen("Files/DAT/1601F-6.dat", "w") or die("Unable to open file!");
		$file="Files/DAT/1601F-4.dat";
		$file2="Files/DAT/1601F-5.dat";
		$file3="Files/DAT/1601F-6.dat";
		$txt = "HMAP,H1601F,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,04/$Year,$RDO\n";
		$txt2 = "HMAP,H1601F,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,05/$Year,$RDO\n";
		$txt3 = "HMAP,H1601F,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,06/$Year,$RDO\n";
		fwrite($myfile, $txt);
		fwrite($myfile2, $txt2);
		fwrite($myfile3, $txt3);
		$TotalAmount=0;
		$TotalAmount2=0;
		$TotalAmount3=0;
		$TotalTax=0;
		$TotalTax2=0;
		$TotalTax3=0;
		$En=0;
		$En2=0;
		$En3=0;
		for($c=$tablerowcount;$c>0;$c--){
			if(isset($_POST['ATC'.$c])){
				$names=$_POST['RName'.$c];
				$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$names'");
				$rr=mysqli_fetch_array($getEmp);
				$f_name=$rr['fname'];
				$m_name=$rr['mname'];
				$l_name=$rr['lname'];
				$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$names'");
				$rr2=mysqli_fetch_array($getEmp2);
				$TIN=$rr2['tin_number'];
				$ATC=$_POST['ATC'.$c];
				$Month_Tran=$_POST['Month_Tran'.$c];
				$Year_Tran=$_POST['Year_Tran'.$c];
				$Amount=$_POST['Amount'.$c];
				$Rate=$_POST['Rate'.$c];
				$Total=$_POST['Total'.$c];
				
				if($Month_Tran=="04"){
					$TotalAmount+=$Amount;
					$TotalTax+=$Total;
					$txt = "DMAP,D1601F,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile, $txt);
					$En=1;
				}
				else if($Month_Tran=="05"){
					$TotalAmount2+=$Amount;
					$TotalTax2+=$Total;
					$txt2 = "DMAP,D1601F,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile2, $txt2);
					$En2=1;
				}
				else if($Month_Tran=="06"){
					$TotalAmount3+=$Amount;
					$TotalTax3+=$Total;
					$txt3 = "DMAP,D1601F,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile3, $txt3);
					$En3=1;
				}
				
			}
		}
		if($En==1){
			$txt = "CMAP,C1601F,$TINNO,$TINNO2,04/$Year,$TotalAmount,$TotalTax\n";
			fwrite($myfile, $txt);
		}
		if($En2==1){
			$txt2 = "CMAP,C1601F,$TINNO,$TINNO2,05/$Year,$TotalAmount2,$TotalTax2\n";
			fwrite($myfile2, $txt2);
		}
		if($En3==1){
			$txt3 = "CMAP,C1601F,$TINNO,$TINNO2,06/$Year,$TotalAmount3,$TotalTax3\n";
			fwrite($myfile3, $txt3);
		}
		
		
		/* $txt = "Jane Doe\n";
		fwrite($myfile, $txt); */
		fclose($myfile);
		fclose($myfile2);
		fclose($myfile3);
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file2.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file3.'"></iframe>';
		?>
		<script>
		
		$(document).ready(function(){
			
		});
		
		</script>
		<?php
	}
	else if($Quarter=="Q3"){
		$myfile = fopen("Files/DAT/1601F-7.dat", "w") or die("Unable to open file!");
		$myfile2 = fopen("Files/DAT/1601F-8.dat", "w") or die("Unable to open file!");
		$myfile3 = fopen("Files/DAT/1601F-9.dat", "w") or die("Unable to open file!");
		$file="Files/DAT/1601F-7.dat";
		$file2="Files/DAT/1601F-8.dat";
		$file3="Files/DAT/1601F-9.dat";
		$txt = "HMAP,H1601F,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,07/$Year,$RDO\n";
		$txt2 = "HMAP,H1601F,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,08/$Year,$RDO\n";
		$txt3 = "HMAP,H1601F,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,09/$Year,$RDO\n";
		fwrite($myfile, $txt);
		fwrite($myfile2, $txt2);
		fwrite($myfile3, $txt3);
		$TotalAmount=0;
		$TotalAmount2=0;
		$TotalAmount3=0;
		$TotalTax=0;
		$TotalTax2=0;
		$TotalTax3=0;
		$En=0;
		$En2=0;
		$En3=0;
		for($c=$tablerowcount;$c>0;$c--){
			if(isset($_POST['ATC'.$c])){
				$names=$_POST['RName'.$c];
				$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$names'");
				$rr=mysqli_fetch_array($getEmp);
				$f_name=$rr['fname'];
				$m_name=$rr['mname'];
				$l_name=$rr['lname'];
				$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$names'");
				$rr2=mysqli_fetch_array($getEmp2);
				$TIN=$rr2['tin_number'];
				$ATC=$_POST['ATC'.$c];
				$Month_Tran=$_POST['Month_Tran'.$c];
				$Year_Tran=$_POST['Year_Tran'.$c];
				$Amount=$_POST['Amount'.$c];
				$Rate=$_POST['Rate'.$c];
				$Total=$_POST['Total'.$c];
				
				if($Month_Tran=="07"){
					$TotalAmount+=$Amount;
					$TotalTax+=$Total;
					$txt = "DMAP,D1601F,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile, $txt);
					$En=1;
				}
				else if($Month_Tran=="08"){
					$TotalAmount2+=$Amount;
					$TotalTax2+=$Total;
					$txt2 = "DMAP,D1601F,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile2, $txt2);
					$En2=1;
				}
				else if($Month_Tran=="09"){
					$TotalAmount3+=$Amount;
					$TotalTax3+=$Total;
					$txt3 = "DMAP,D1601F,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile3, $txt3);
					$En3=1;
				}
				
			}
		}
		if($En==1){
			$txt = "CMAP,C1601F,$TINNO,$TINNO2,07/$Year,$TotalAmount,$TotalTax\n";
			fwrite($myfile, $txt);
		}
		if($En2==1){
			$txt2 = "CMAP,C1601F,$TINNO,$TINNO2,08/$Year,$TotalAmount2,$TotalTax2\n";
			fwrite($myfile2, $txt2);
		}
		if($En3==1){
			$txt3 = "CMAP,C1601F,$TINNO,$TINNO2,09/$Year,$TotalAmount3,$TotalTax3\n";
			fwrite($myfile3, $txt3);
		}
		
		
		/* $txt = "Jane Doe\n";
		fwrite($myfile, $txt); */
		fclose($myfile);
		fclose($myfile2);
		fclose($myfile3);
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file2.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file3.'"></iframe>';
		?>
		<script>
		
		$(document).ready(function(){
			
		});
		
		</script>
		<?php
	}
	else if($Quarter=="Q4"){
		$myfile = fopen("Files/DAT/1601F-10.dat", "w") or die("Unable to open file!");
		$myfile2 = fopen("Files/DAT/1601F-11.dat", "w") or die("Unable to open file!");
		$myfile3 = fopen("Files/DAT/1601F-12.dat", "w") or die("Unable to open file!");
		$file="Files/DAT/1601F-10.dat";
		$file2="Files/DAT/1601F-11.dat";
		$file3="Files/DAT/1601F-12.dat";
		$txt = "HMAP,H1601F,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,10/$Year,$RDO\n";
		$txt2 = "HMAP,H1601F,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,11/$Year,$RDO\n";
		$txt3 = "HMAP,H1601F,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,12/$Year,$RDO\n";
		fwrite($myfile, $txt);
		fwrite($myfile2, $txt2);
		fwrite($myfile3, $txt3);
		$TotalAmount=0;
		$TotalAmount2=0;
		$TotalAmount3=0;
		$TotalTax=0;
		$TotalTax2=0;
		$TotalTax3=0;
		$En=0;
		$En2=0;
		$En3=0;
		for($c=$tablerowcount;$c>0;$c--){
			if(isset($_POST['ATC'.$c])){
				$names=$_POST['RName'.$c];
				$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$names'");
				$rr=mysqli_fetch_array($getEmp);
				$f_name=$rr['fname'];
				$m_name=$rr['mname'];
				$l_name=$rr['lname'];
				$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$names'");
				$rr2=mysqli_fetch_array($getEmp2);
				$TIN=$rr2['tin_number'];
				$ATC=$_POST['ATC'.$c];
				$Month_Tran=$_POST['Month_Tran'.$c];
				$Year_Tran=$_POST['Year_Tran'.$c];
				$Amount=$_POST['Amount'.$c];
				$Rate=$_POST['Rate'.$c];
				$Total=$_POST['Total'.$c];
				
				if($Month_Tran=="10"){
					$TotalAmount+=$Amount;
					$TotalTax+=$Total;
					$txt = "DMAP,D1601F,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile, $txt);
					$En=1;
				}
				else if($Month_Tran=="11"){
					$TotalAmount2+=$Amount;
					$TotalTax2+=$Total;
					$txt2 = "DMAP,D1601F,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile2, $txt2);
					$En2=1;
				}
				else if($Month_Tran=="12"){
					$TotalAmount3+=$Amount;
					$TotalTax3+=$Total;
					$txt3 = "DMAP,D1601F,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
					fwrite($myfile3, $txt3);
					$En3=1;
				}
				
			}
		}
		if($En==1){
			$txt = "CMAP,C1601F,$TINNO,$TINNO2,10/$Year,$TotalAmount,$TotalTax\n";
			fwrite($myfile, $txt);
		}
		if($En2==1){
			$txt2 = "CMAP,C1601F,$TINNO,$TINNO2,11/$Year,$TotalAmount2,$TotalTax2\n";
			fwrite($myfile2, $txt2);
		}
		if($En3==1){
			$txt3 = "CMAP,C1601F,$TINNO,$TINNO2,12/$Year,$TotalAmount3,$TotalTax3\n";
			fwrite($myfile3, $txt3);
		}
		
		
		/* $txt = "Jane Doe\n";
		fwrite($myfile, $txt); */
		fclose($myfile);
		fclose($myfile2);
		fclose($myfile3);
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file2.'"></iframe>';
		 echo '<iframe style="display:none;" src="extra/attendance/download2.php?file='.$file3.'"></iframe>';
		?>
		<script>
		
		$(document).ready(function(){
			
		});
		
		</script>
		<?php
	}
	
}

?>
<?php
if(isset($_POST['FormSWATFhiddenIndicator'])){
	$Month=$_POST['Month'];
	$Year=$_POST['Year'];
	$L_Name=$_POST['L_Name'];
	$F_Name=$_POST['F_Name'];
	$M_Name=$_POST['M_Name'];
	$TINNO=$_POST['TINNO'];
	$TINNO2=$_POST['TINNO2'];
	$RDO=$_POST['RDO'];
	$tablerowcount=$_POST['tablerowcount'];
	//echo $tablerowcount;
	$myfile = fopen("Files/DAT/2553.dat", "w") or die("Unable to open file!");
	$file="Files/DAT/2553.dat";
	$txt = "HMAP,H2553,$TINNO,$TINNO2,$F_Name $M_Name $L_Name,$Month/$Year,$RDO\n";
	fwrite($myfile, $txt);
	$TotalAmount=0;
	$TotalTax=0;
	for($c=$tablerowcount;$c>0;$c--){
		if(isset($_POST['ATC'.$c])){
			$names=$_POST['RName'.$c];
			$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$names'");
			$rr=mysqli_fetch_array($getEmp);
			$f_name=$rr['fname'];
			$m_name=$rr['mname'];
			$l_name=$rr['lname'];
			$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$names'");
			$rr2=mysqli_fetch_array($getEmp2);
			$TIN=$rr2['tin_number'];
			$ATC=$_POST['ATC'.$c];
			$Amount=$_POST['Amount'.$c];
			$TotalAmount+=$Amount;
			$Rate=$_POST['Rate'.$c];
			$Total=$_POST['Total'.$c];
			$TotalTax+=$Total;
			$txt = "DMAP,D2553,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$Month/$Year,$ATC,,$Rate,$Amount,$Total\n";
			fwrite($myfile, $txt);
		}
	}
	$txt = "CMAP,C2553,$TINNO,$TINNO2,$Month/$Year,$TotalAmount,$TotalTax\n";
	fwrite($myfile, $txt);
	
	/* $txt = "Jane Doe\n";
	fwrite($myfile, $txt); */
	fclose($myfile);
	?>
	<script>
	location.href='extra/attendance/download2.php?file=<?php echo $file; ?>';
	
	</script>
	<?php
}

?>
<?php
if(isset($_POST['Form1604EFhiddenIndicator'])){
	$Month=$_POST['Month'];
	$Year=$_POST['Year'];
	$L_Name=$_POST['L_Name'];
	$F_Name=$_POST['F_Name'];
	$M_Name=$_POST['M_Name'];
	$TINNO=$_POST['TINNO'];
	$AnendedReturn=$_POST['AnendedReturn'];
	$SheetAttached=$_POST['SheetAttached'];
	$TINNO2=$_POST['TINNO2'];
	$RDO=$_POST['RDO'];
	$tablerowcount=$_POST['tablerowcount'];
	$tablerowcount_3=$_POST['tablerowcount_3'];
	//echo $tablerowcount;
	$myfile = fopen("Files/DAT/1604E.dat", "w") or die("Unable to open file!");
	$file="Files/DAT/1604E.dat";
	$txt = "H1604E,$TINNO,$TINNO2,12/31/$Year,$AnendedReturn,$SheetAttached,$RDO\n";
	fwrite($myfile, $txt);
	$TotalAmount=0;
	$TotalAmountss=0;
	$TotalTax=0;
	for($c=$tablerowcount_3;$c>0;$c--){
		if(isset($_POST['ATC'.$c])){
			$names=$_POST['RName'.$c];
			$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$names'");
			$rr=mysqli_fetch_array($getEmp);
			$f_name=$rr['fname'];
			$m_name=$rr['mname'];
			$l_name=$rr['lname'];
			$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$names'");
			$rr2=mysqli_fetch_array($getEmp2);
			$TIN=$rr2['tin_number'];
			$ATC=$_POST['ATC'.$c];
			$Amount=$_POST['Amount'.$c];
			$TotalAmountss+=$Amount;
			$txt = "D3,1604E,$TINNO,$TINNO2,12/31/$Year,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$ATC,$Amount\n";
			fwrite($myfile, $txt);
		}
		
	}
	$txt = "C3,1604E,$TINNO,$TINNO2,12/31/$Year,$TotalAmountss\n";
	fwrite($myfile, $txt);
	for($c=$tablerowcount;$c>0;$c--){
		if(isset($_POST['ATC_3'.$c])){
			$names=$_POST['RName_3'.$c];
			$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$names'");
			$rr=mysqli_fetch_array($getEmp);
			$f_name=$rr['fname'];
			$m_name=$rr['mname'];
			$l_name=$rr['lname'];
			$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$names'");
			$rr2=mysqli_fetch_array($getEmp2);
			$TIN=$rr2['tin_number'];
			$ATC=$_POST['ATC_3'.$c];
			$Amount=$_POST['Amount_3'.$c];
			$TotalAmount+=$Amount;
			$Rate=$_POST['Rate_3'.$c];
			$Total=$_POST['Total_3'.$c];
			$TotalTax+=$Total;
			$txt = "D4,1604E,$TINNO,$TINNO2,12/31/$Year,$c,$TIN,0000,$f_name $m_name $l_name,$l_name,$f_name,$m_name,$ATC,,$Rate,$Amount,$Total\n";
			fwrite($myfile, $txt);
		}
	}
	$txt = "C4,1604E,$TINNO,$TINNO2,12/31/$Year,$TotalAmount,$TotalTax\n";
	fwrite($myfile, $txt);
	
	/* $txt = "Jane Doe\n";
	fwrite($myfile, $txt); */
	fclose($myfile);
	?>
	<script>
	
		
	$(document).ready(function(){
		
		location.href='extra/attendance/download2.php?file=<?php echo $file; ?>';
	});
	
	</script>
	<?php
}

?>
<?php
if(isset($_POST['Form1604CFhiddenIndicator'])){
	$Month=$_POST['Month'];
	$Year=$_POST['Year'];
	$L_Name=$_POST['L_Name'];
	$F_Name=$_POST['F_Name'];
	$M_Name=$_POST['M_Name'];
	$TINNO=$_POST['TINNO'];
	$TINNO2=$_POST['TINNO2'];
	$Quarter=$_POST['Quarter'];
	$AmendedReturn=$_POST['AmendedReturn'];
	$SheetAttached=$_POST['SheetAttached'];
	$RDO=$_POST['RDO'];
	$tablerowcount=$_POST['tablerowcount'];
	$tablerowcount_6=$_POST['tablerowcount_6'];
	$tablerowcount_7=$_POST['tablerowcount_7'];
	$tablerowcount_7_3=$_POST['tablerowcount_7_3'];
	$tablerowcount_7_4=$_POST['tablerowcount_7_4'];
	
	//echo $tablerowcount;
	$myfile = fopen("Files/DAT/1604CF.dat", "w") or die("Unable to open file!");
	$file="Files/DAT/1604CF.dat";
	$txt = "H1604CF,$TINNO,$TINNO2,12/31/$Year,$AmendedReturn,$SheetAttached,$RDO\n";
	fwrite($myfile, $txt);
	$TotalAmount=0;
	$TotalTax=0;
	$C5=0;
	for($c=$tablerowcount;$c>0;$c--){
		if($_POST['RName'.$c]){
			
			$RName=$_POST['RName'.$c];
			$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$RName'");
			$rr=mysqli_fetch_array($getEmp);
			$f_name=$rr['fname'];
			$m_name=$rr['mname'];
			$l_name=$rr['lname'];
			$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$RName'");
			$rr2=mysqli_fetch_array($getEmp2);
			$TIN=$rr2['tin_number'];
			$StatusCode=$_POST['StatusCode'.$c];
			$ATC=$_POST['ATC'.$c];
			$Amount=$_POST['Amount'.$c];
			$Rate=$_POST['Rate'.$c];
			$Total=$_POST['Total'.$c];
			$TotalAmount+=$Amount;
			$TotalTax+=$Total;
			$txt = "D5,1604CF,$TINNO,$TINNO2,12/31/$Year,$c,$TIN,0000,$f_name $m_name $l_name,$f_name,$m_name,$l_name,$StatusCode,$ATC,$Amount,$Rate,$Total\n";
			if(fwrite($myfile, $txt)){
				$C5=1;
			}
		}
	}
	if($C5==1){
		$txt = "C5,1604CF,$TINNO,$TINNO2,12/31/$Year,$TotalAmount,$TotalTax\n";
		fwrite($myfile, $txt);
	}
	
	$TotalAmount_6=0;
	$TotalRate_6=0;
	$TotalTax_6=0;
	$C6=0;
	for($c=$tablerowcount_6;$c>0;$c--){
		if($_POST['RName_6'.$c]){
		$RName=$_POST['RName_6'.$c];
		
		$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$RName'");
		$rr=mysqli_fetch_array($getEmp);
		$f_name=$rr['fname'];
		$m_name=$rr['mname'];
		$l_name=$rr['lname'];
		$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$RName'");
		$rr2=mysqli_fetch_array($getEmp2);
		$TIN=$rr2['tin_number'];
		$ATC_6=$_POST['ATC_6'.$c];
		$Amount_6=$_POST['Amount_6'.$c];
		$Rate_6=$_POST['Rate_6'.$c];
		$Total_6=$_POST['Total_6'.$c];
		$TotalAmount_6+=$Amount_6;
		$TotalRate_6+=$Rate_6;
		$TotalTax_6+=$Total_6;
		$txt = "D6,1604CF,$TINNO,$TINNO2,12/31/$Year,$c,$TIN,0000,$l_name,$f_name,$m_name,$ATC_6,$Amount_6,$Rate_6,$Total_6\n";
		if(fwrite($myfile, $txt)){
			$C6=1;
		}
		}
	}
	if($C6==1){
		
		$txt = "C6,1604CF,$TINNO,$TINNO2,12/31/$Year,$TotalAmount_6,$TotalRate_6,$TotalTax_6\n";
		fwrite($myfile, $txt);
	}
	$Total__GrossCompIncome_7=0;
	$Total__OneThreePay_7=0;
	$Total__DeminimisBenefit_7=0;
	$Total__UnionDues_7=0;
	$Total__Salaries_OtherComp_7=0;
	$Total__Total_Comp_Income_NonTax_7=0;
	$Total__Tax_Basic_Salary_7=0;
	$Total__OneThreePayTax_7=0;
	$Total__Salaries_OtherComp_Tax_7=0;
	$Total__Total_Comp_Income_Tax_7=0;
	$Total__Net_Comp_Income_Tax_7=0;
	$Total__TaxDue_7=0;
	$Total__Tax_Withheld_7=0;
	$Total__PaidforinDecemberTax_7=0;
	$Total__Overwithheld_Tax_refund_7=0;
	$Total__tax_withheld_as_adjusted_7=0;
	$C7_1=0;
	for($c=$tablerowcount_7;$c>0;$c--){
		if($_POST['RName_7'.$c]){
			$RName=$_POST['RName_7'.$c];
		
		
		$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$RName'");
		$rr=mysqli_fetch_array($getEmp);
		$f_name=$rr['fname'];
		$m_name=$rr['mname'];
		$l_name=$rr['lname'];
		$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$RName'");
		$rr2=mysqli_fetch_array($getEmp2);
		$TIN=$rr2['tin_number'];
		$GrossCompIncome_7=$_POST['GrossCompIncome_7'.$c];
		$OneThreePay_7=$_POST['OneThreePay_7'.$c];
		$DeminimisBenefit_7=$_POST['DeminimisBenefit_7'.$c];
		$UnionDues_7=$_POST['UnionDues_7'.$c];
		$Salaries_OtherComp_7=$_POST['Salaries_OtherComp_7'.$c];
		$Total_Comp_Income_NonTax_7=$_POST['Total_Comp_Income_NonTax_7'.$c];
		
		$EmploymentTo=$_POST['EmploymentTo'.$c];
		$EmploymentFrom=$_POST['EmploymentFrom'.$c];
		
		$Tax_Basic_Salary_7=$_POST['Tax_Basic_Salary_7'.$c];
		$OneThreePayTax_7=$_POST['OneThreePayTax_7'.$c];
		$Salaries_OtherComp_Tax_7=$_POST['Salaries_OtherComp_Tax_7'.$c];
		$Total_Comp_Income_Tax_7=$_POST['Total_Comp_Income_Tax_7'.$c];
		$Net_Comp_Income_Tax_7=$_POST['Net_Comp_Income_Tax_7'.$c];
		
		$TaxDue_7=$_POST['TaxDue_7'.$c];
		$Tax_Withheld_7=$_POST['Tax_Withheld_7'.$c];
		$PaidforinDecemberTax_7=$_POST['PaidforinDecemberTax_7'.$c];
		$Overwithheld_Tax_refund_7=$_POST['Overwithheld_Tax_refund_7'.$c];
		$Substitute_Filling_7=$_POST['Substitute_Filling_7'.$c];
		$tax_withheld_as_adjusted_7=$_POST['tax_withheld_as_adjusted_7'.$c];
		$Total__GrossCompIncome_7+=$GrossCompIncome_7;
		$Total__OneThreePay_7+=$OneThreePay_7;
		$Total__DeminimisBenefit_7+=$DeminimisBenefit_7;
		$Total__UnionDues_7+=$UnionDues_7;
		$Total__Salaries_OtherComp_7+=$Salaries_OtherComp_7;
		$Total__Total_Comp_Income_NonTax_7+=$Total_Comp_Income_NonTax_7;
		$Total__Tax_Basic_Salary_7+=$Tax_Basic_Salary_7;
		$Total__OneThreePayTax_7+=$OneThreePayTax_7;
		$Total__Salaries_OtherComp_Tax_7+=$Salaries_OtherComp_Tax_7;
		$Total__Total_Comp_Income_Tax_7+=$Total_Comp_Income_Tax_7;
		$Total__Net_Comp_Income_Tax_7+=$Net_Comp_Income_Tax_7;
		$Total__TaxDue_7+=$TaxDue_7;
		$Total__Tax_Withheld_7+=$Tax_Withheld_7;
		$Total__PaidforinDecemberTax_7+=$PaidforinDecemberTax_7;
		$Total__Overwithheld_Tax_refund_7+=$Overwithheld_Tax_refund_7;
		$Total__tax_withheld_as_adjusted_7+=$tax_withheld_as_adjusted_7;
		
		$txt = "D7.1,1604CF,$TINNO,$TINNO2,12/31/$Year,$c,$TIN,0000,$l_name,$f_name,$m_name,$EmploymentFrom,$EmploymentTo,$GrossCompIncome_7,$OneThreePay_7,$DeminimisBenefit_7,$UnionDues_7,$Salaries_OtherComp_7,$Total_Comp_Income_NonTax_7,$Tax_Basic_Salary_7,$OneThreePayTax_7,$Salaries_OtherComp_Tax_7,$Total_Comp_Income_Tax_7,,0.00,0.00,$Net_Comp_Income_Tax_7,$TaxDue_7,$Tax_Withheld_7,$PaidforinDecemberTax_7,$Overwithheld_Tax_refund_7,$tax_withheld_as_adjusted_7,$Substitute_Filling_7\n";
		if(fwrite($myfile, $txt)){
			$C7_1=1;
		}
		}
		
	}
	if($C7_1==1){
		$txt = "C7.1,1604CF,$TINNO,$TINNO2,12/31/$Year,$Total__GrossCompIncome_7,$Total__OneThreePay_7,$Total__DeminimisBenefit_7,$Total__UnionDues_7,$Total__Salaries_OtherComp_7,$Total__Total_Comp_Income_NonTax_7,$Total__Tax_Basic_Salary_7,$Total__OneThreePayTax_7,$Total__Salaries_OtherComp_Tax_7,$Total__Total_Comp_Income_Tax_7,0.00,0.00,$Total__Net_Comp_Income_Tax_7,$Total__TaxDue_7,$Total__Tax_Withheld_7,$Total__PaidforinDecemberTax_7,$Total__Overwithheld_Tax_refund_7,$Total__tax_withheld_as_adjusted_7\n";
		fwrite($myfile, $txt);
	}
	
		
	$Total__GrossCompIncome_7_3=0;
	$Total__OneThreePay_7_3=0;
	$Total__DeminimisBenefit_7_3=0;
	$Total__UnionDues_7_3=0;
	$Total__Salaries_OtherComp_7_3=0;
	$Total__Total_Comp_Income_NonTax_7_3=0;
	$Total__Tax_Basic_Salary_7_3=0;
	$Total__OneThreePayTax_7_3=0;
	$Total__Salaries_OtherComp_Tax_7_3=0;
	$Total__Total_Comp_Income_Tax_7_3=0;
	$Total__Net_Comp_Income_Tax_7_3=0;
	$Total__TaxDue_7_3=0;
	$Total__Tax_Withheld_7_3=0;
	$Total__PaidforinDecemberTax_7_3=0;
	$Total__Overwithheld_Tax_refund_7_3=0;
	$Total__tax_withheld_as_adjusted_7_3=0;
	$C7_3=0;
	for($c=$tablerowcount_7_3;$c>0;$c--){
		if($_POST['RName_7_3'.$c]){
			
		$RName=$_POST['RName_7_3'.$c];
		
		
		$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$RName'");
		$rr=mysqli_fetch_array($getEmp);
		$f_name=$rr['fname'];
		$m_name=$rr['mname'];
		$l_name=$rr['lname'];
		$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$RName'");
		$rr2=mysqli_fetch_array($getEmp2);
		$TIN=$rr2['tin_number'];
		$GrossCompIncome_7=$_POST['GrossCompIncome_7_3'.$c];
		$OneThreePay_7=$_POST['OneThreePay_7_3'.$c];
		$DeminimisBenefit_7=$_POST['DeminimisBenefit_7_3'.$c];
		$UnionDues_7=$_POST['UnionDues_7_3'.$c];
		$Salaries_OtherComp_7=$_POST['Salaries_OtherComp_7_3'.$c];
		$Total_Comp_Income_NonTax_7=$_POST['Total_Comp_Income_NonTax_7_3'.$c];
		
		$Tax_Basic_Salary_7=$_POST['Tax_Basic_Salary_7_3'.$c];
		$OneThreePayTax_7=$_POST['OneThreePayTax_7_3'.$c];
		$Salaries_OtherComp_Tax_7=$_POST['Salaries_OtherComp_Tax_7_3'.$c];
		$Total_Comp_Income_Tax_7=$_POST['Total_Comp_Income_Tax_7_3'.$c];
		$Net_Comp_Income_Tax_7=$_POST['Net_Comp_Income_Tax_7_3'.$c];
		
		$TaxDue_7=$_POST['TaxDue_7_3'.$c];
		$Tax_Withheld_7=$_POST['Tax_Withheld_7_3'.$c];
		$PaidforinDecemberTax_7=$_POST['PaidforinDecemberTax_7_3'.$c];
		$Overwithheld_Tax_refund_7=$_POST['Overwithheld_Tax_refund_7_3'.$c];
		$Substitute_Filling_7=$_POST['Substitute_Filling_7_3'.$c];
		$tax_withheld_as_adjusted_7=$_POST['tax_withheld_as_adjusted_7_3'.$c];
		$Total__GrossCompIncome_7_3+=$GrossCompIncome_7;
		$Total__OneThreePay_7_3+=$OneThreePay_7;
		$Total__DeminimisBenefit_7_3+=$DeminimisBenefit_7;
		$Total__UnionDues_7_3+=$UnionDues_7;
		$Total__Salaries_OtherComp_7_3+=$Salaries_OtherComp_7;
		$Total__Total_Comp_Income_NonTax_7_3+=$Total_Comp_Income_NonTax_7;
		$Total__Tax_Basic_Salary_7_3+=$Tax_Basic_Salary_7;
		$Total__OneThreePayTax_7_3+=$OneThreePayTax_7;
		$Total__Salaries_OtherComp_Tax_7_3+=$Salaries_OtherComp_Tax_7;
		$Total__Total_Comp_Income_Tax_7_3+=$Total_Comp_Income_Tax_7;
		$Total__Net_Comp_Income_Tax_7_3+=$Net_Comp_Income_Tax_7;
		$Total__TaxDue_7_3+=$TaxDue_7;
		$Total__Tax_Withheld_7_3+=$Tax_Withheld_7;
		$Total__PaidforinDecemberTax_7_3+=$PaidforinDecemberTax_7;
		$Total__Overwithheld_Tax_refund_7_3+=$Overwithheld_Tax_refund_7;
		$Total__tax_withheld_as_adjusted_7_3+=$tax_withheld_as_adjusted_7;
		
		$txt = "D7.3,1604CF,$TINNO,$TINNO2,12/31/$Year,$c,$TIN,0000,$l_name,$f_name,$m_name,$EmploymentFrom,$EmploymentTo,$GrossCompIncome_7,$OneThreePay_7,$DeminimisBenefit_7,$UnionDues_7,$Salaries_OtherComp_7,$Total_Comp_Income_NonTax_7,$Tax_Basic_Salary_7,$OneThreePayTax_7,$Salaries_OtherComp_Tax_7,$Total_Comp_Income_Tax_7,,0.00,0.00,$Net_Comp_Income_Tax_7,$TaxDue_7,$Tax_Withheld_7,$PaidforinDecemberTax_7,$Overwithheld_Tax_refund_7,$tax_withheld_as_adjusted_7,$Substitute_Filling_7\n";
		if(fwrite($myfile, $txt)){
			$C7_3=1;
		}
		}
	}
	if($C7_3==1){
	$txt = "C7.3,1604CF,$TINNO,$TINNO2,12/31/$Year,$Total__GrossCompIncome_7_3,$Total__OneThreePay_7_3,$Total__DeminimisBenefit_7_3,$Total__UnionDues_7_3,$Total__Salaries_OtherComp_7_3,$Total__Total_Comp_Income_NonTax_7_3,$Total__Tax_Basic_Salary_7_3,$Total__OneThreePayTax_7_3,$Total__Salaries_OtherComp_Tax_7_3,$Total__Total_Comp_Income_Tax_7_3,0.00,0.00,$Total__Net_Comp_Income_Tax_7_3,$Total__TaxDue_7_3,$Total__Tax_Withheld_7_3,$Total__PaidforinDecemberTax_7_3,$Total__Overwithheld_Tax_refund_7_3,$Total__tax_withheld_as_adjusted_7_3\n";
	fwrite($myfile, $txt);
	}
	
	$Total__GrossCompIncomePrevAndPresentOther_7_4=0;
	$Total__OneThreeOtherBenefits_Previous_7_4=0;
	$Total__DeminimisBenefit_Previous_7_4=0;
	$Total__Union_Dues_Previous_7_4=0;
	$Total__Salaries_OtherComp_Previous_7_4=0;
	$Total__Total_Comp_Income_NonTax_Previous_7_4=0;
	$Total__OneThreeOtherBenefits_Present_7_4=0;
	$Total__DeminimisBenefit_Present_7_4=0;
	$Total__Union_Dues_Present_7_4=0;
	$Total__Salaries_OtherComp_Present_7_4=0;
	$Total__Total_Comp_Income_NonTax_Present_7_4=0;
	$Total__TaxableBasicSalary_Previous_7_4=0;
	$Total__TaxableOneThreeOtherBenefits_Previous_7_4=0;
	$Total__TaxableSalaries_OtherComp_Previous_7_4=0;
	$Total__Total_Tax_Previous_7_4=0;
	$Total__TaxableBasicSalary_Present_7_4=0;
	$Total__TaxableOneThreeOtherBenefits_Present_7_4=0;
	$Total__TaxableSalaries_OtherComp_Present_7_4=0;
	$Total__Total_Tax_Present_7_4=0;
	$Total__Total_Tax_Previous_And_Present_7_4=0;
	$Total__NetTaxableCompIncomeOther_7_4=0;
	$Total__TaxDueOther_7_4=0;
	$Total__TaxwithheldfrompreviousOther_7_4=0;
	$Total__TaxwithheldfrompresentOther_7_4=0;
	$Total__AmountwithheldforindecOther_7_4=0;
	$Total__OverwithheldtaxrefundedOther_7_4=0;
	$Total__AmountofTaxWithheldasAdjOther_7_4=0;
	$Total__GrossCompIncomePrevAndPresentOther_7_4=0;
	$C7_4=0;
	for($c=$tablerowcount_7_4;$c>0;$c--){
		if($_POST['RName_7_4'.$c]){
			$RName=$_POST['RName_7_4'.$c];
		$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$RName'");
		$rr=mysqli_fetch_array($getEmp);
		$f_name=$rr['fname'];
		$m_name=$rr['mname'];
		$l_name=$rr['lname'];
		$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$RName'");
		$rr2=mysqli_fetch_array($getEmp2);
		$TIN=$rr2['tin_number'];
		
		$OneThreeOtherBenefits_Previous_7_4=$_POST['OneThreeOtherBenefits_Previous_7_4'.$c];
		$DeminimisBenefit_Previous_7_4=$_POST['DeminimisBenefit_Previous_7_4'.$c];
		$Union_Dues_Previous_7_4=$_POST['Union_Dues_Previous_7_4'.$c];
		$Salaries_OtherComp_Previous_7_4=$_POST['Salaries_OtherComp_Previous_7_4'.$c];
		$Total_Comp_Income_NonTax_Previous_7_4=$_POST['Total_Comp_Income_NonTax_Previous_7_4'.$c];
		
		$OneThreeOtherBenefits_Present_7_4=$_POST['OneThreeOtherBenefits_Present_7_4'.$c];
		$DeminimisBenefit_Present_7_4=$_POST['DeminimisBenefit_Present_7_4'.$c];
		$Union_Dues_Present_7_4=$_POST['Union_Dues_Present_7_4'.$c];
		$Salaries_OtherComp_Present_7_4=$_POST['Salaries_OtherComp_Present_7_4'.$c];
		$Total_Comp_Income_NonTax_Present_7_4=$_POST['Total_Comp_Income_NonTax_Present_7_4'.$c];
		
		$TaxableBasicSalary_Previous_7_4=$_POST['TaxableBasicSalary_Previous_7_4'.$c];
		$TaxableOneThreeOtherBenefits_Previous_7_4=$_POST['TaxableOneThreeOtherBenefits_Previous_7_4'.$c];
		$TaxableSalaries_OtherComp_Previous_7_4=$_POST['TaxableSalaries_OtherComp_Previous_7_4'.$c];
		$Total_Tax_Previous_7_4=$_POST['Total_Tax_Previous_7_4'.$c];
		
		$TaxableBasicSalary_Present_7_4=$_POST['TaxableBasicSalary_Present_7_4'.$c];
		$TaxableOneThreeOtherBenefits_Present_7_4=$_POST['TaxableOneThreeOtherBenefits_Present_7_4'.$c];
		$TaxableSalaries_OtherComp_Present_7_4=$_POST['TaxableSalaries_OtherComp_Present_7_4'.$c];
		$Total_Tax_Present_7_4=$_POST['Total_Tax_Present_7_4'.$c];
		
		$Total_Tax_Previous_And_Present_7_4=$_POST['Total_Tax_Previous_And_Present_7_4'.$c];
		
		$NetTaxableCompIncomeOther_7_4=$_POST['NetTaxableCompIncomeOther_7_4'.$c];
		$TaxDueOther_7_4=$_POST['TaxDueOther_7_4'.$c];
		$TaxwithheldfrompreviousOther_7_4=$_POST['TaxwithheldfrompreviousOther_7_4'.$c];
		$TaxwithheldfrompresentOther_7_4=$_POST['TaxwithheldfrompresentOther_7_4'.$c];
		$AmountwithheldforindecOther_7_4=$_POST['AmountwithheldforindecOther_7_4'.$c];
		$OverwithheldtaxrefundedOther_7_4=$_POST['OverwithheldtaxrefundedOther_7_4'.$c];
		$AmountofTaxWithheldasAdjOther_7_4=$_POST['AmountofTaxWithheldasAdjOther_7_4'.$c];
		$GrossCompIncomePrevAndPresentOther_7_4=$_POST['GrossCompIncomePrevAndPresentOther_7_4'.$c];
		
		$Total__GrossCompIncomePrevAndPresentOther_7_4+=$GrossCompIncomePrevAndPresentOther_7_4;
		$Total__OneThreeOtherBenefits_Previous_7_4+=$OneThreeOtherBenefits_Previous_7_4;
		$Total__DeminimisBenefit_Previous_7_4+=$DeminimisBenefit_Previous_7_4;
		$Total__Union_Dues_Previous_7_4+=$Union_Dues_Previous_7_4;
		$Total__Salaries_OtherComp_Previous_7_4+=$Salaries_OtherComp_Previous_7_4;
		$Total__Total_Comp_Income_NonTax_Previous_7_4+=$Total_Comp_Income_NonTax_Previous_7_4;
		$Total__OneThreeOtherBenefits_Present_7_4+=$OneThreeOtherBenefits_Present_7_4;
		$Total__DeminimisBenefit_Present_7_4+=$DeminimisBenefit_Present_7_4;
		$Total__Union_Dues_Present_7_4+=$Union_Dues_Present_7_4;
		$Total__Salaries_OtherComp_Present_7_4+=$Salaries_OtherComp_Present_7_4;
		$Total__Total_Comp_Income_NonTax_Present_7_4+=$Total_Comp_Income_NonTax_Present_7_4;
		$Total__TaxableBasicSalary_Previous_7_4+=$TaxableBasicSalary_Previous_7_4;
		$Total__TaxableOneThreeOtherBenefits_Previous_7_4+=$TaxableOneThreeOtherBenefits_Previous_7_4;
		$Total__TaxableSalaries_OtherComp_Previous_7_4+=$TaxableSalaries_OtherComp_Previous_7_4;
		$Total__Total_Tax_Previous_7_4+=$Total_Tax_Previous_7_4;
		$Total__TaxableBasicSalary_Present_7_4+=$TaxableBasicSalary_Present_7_4;
		$Total__TaxableOneThreeOtherBenefits_Present_7_4+=$TaxableOneThreeOtherBenefits_Present_7_4;
		$Total__TaxableSalaries_OtherComp_Present_7_4+=$TaxableSalaries_OtherComp_Present_7_4;
		$Total__Total_Tax_Present_7_4+=$Total_Tax_Present_7_4;
		$Total__Total_Tax_Previous_And_Present_7_4+=$Total_Tax_Previous_And_Present_7_4;
		$Total__NetTaxableCompIncomeOther_7_4+=$NetTaxableCompIncomeOther_7_4;
		$Total__TaxDueOther_7_4+=$TaxDueOther_7_4;
		$Total__TaxwithheldfrompreviousOther_7_4+=$TaxwithheldfrompreviousOther_7_4;
		$Total__TaxwithheldfrompresentOther_7_4+=$TaxwithheldfrompresentOther_7_4;
		$Total__AmountwithheldforindecOther_7_4+=$AmountwithheldforindecOther_7_4;
		$Total__OverwithheldtaxrefundedOther_7_4+=$OverwithheldtaxrefundedOther_7_4;
		$Total__AmountofTaxWithheldasAdjOther_7_4+=$AmountofTaxWithheldasAdjOther_7_4;
		$Total__GrossCompIncomePrevAndPresentOther_7_4+=$GrossCompIncomePrevAndPresentOther_7_4;
		
		$txt = "D7.4,1604CF,$TINNO,$TINNO2,12/31/$Year,$c,$TIN,0000,$l_name,$f_name,$m_name,$GrossCompIncomePrevAndPresentOther_7_4,$OneThreeOtherBenefits_Previous_7_4,$DeminimisBenefit_Previous_7_4,$Union_Dues_Previous_7_4,$Salaries_OtherComp_Previous_7_4,$Total_Comp_Income_NonTax_Previous_7_4,$TaxableBasicSalary_Previous_7_4,$TaxableOneThreeOtherBenefits_Previous_7_4,$TaxableSalaries_OtherComp_Previous_7_4,$Total_Tax_Previous_7_4,$OneThreeOtherBenefits_Present_7_4,$DeminimisBenefit_Present_7_4,$Union_Dues_Present_7_4,$Salaries_OtherComp_Present_7_4,$Total_Comp_Income_NonTax_Present_7_4,$TaxableBasicSalary_Present_7_4,$TaxableOneThreeOtherBenefits_Present_7_4,$TaxableSalaries_OtherComp_Present_7_4,$Total_Tax_Present_7_4,$Total_Tax_Previous_And_Present_7_4,,0.00,0.00,$NetTaxableCompIncomeOther_7_4,$TaxDueOther_7_4,$TaxwithheldfrompreviousOther_7_4,$TaxwithheldfrompresentOther_7_4,$AmountwithheldforindecOther_7_4,$OverwithheldtaxrefundedOther_7_4,$AmountofTaxWithheldasAdjOther_7_4\n";
		if(fwrite($myfile, $txt)){
			$C7_4=1;
		}
		}
		
		
	}
	if($C7_4==1){
		$txt = "C7.4,1604CF,$TINNO,$TINNO2,12/31/$Year,$Total__GrossCompIncomePrevAndPresentOther_7_4,$Total__OneThreeOtherBenefits_Previous_7_4,$Total__DeminimisBenefit_Previous_7_4,$Total__Union_Dues_Previous_7_4,$Total__Salaries_OtherComp_Previous_7_4,$Total__Total_Comp_Income_NonTax_Previous_7_4,$Total__TaxableBasicSalary_Previous_7_4,$Total__TaxableOneThreeOtherBenefits_Previous_7_4,$Total__TaxableSalaries_OtherComp_Previous_7_4,$Total__Total_Tax_Previous_7_4,$Total__OneThreeOtherBenefits_Present_7_4,$Total__DeminimisBenefit_Present_7_4,$Total__Union_Dues_Present_7_4,$Total__Salaries_OtherComp_Present_7_4,$Total__Total_Comp_Income_NonTax_Present_7_4,$Total__TaxableBasicSalary_Present_7_4,$Total__TaxableOneThreeOtherBenefits_Present_7_4,$Total__TaxableSalaries_OtherComp_Present_7_4,$Total__Total_Tax_Present_7_4,$Total__Total_Tax_Previous_And_Present_7_4,0.00,0.00,$Total__NetTaxableCompIncomeOther_7_4,$Total__TaxDueOther_7_4,$Total__TaxwithheldfrompreviousOther_7_4,$Total__TaxwithheldfrompresentOther_7_4,$Total__AmountwithheldforindecOther_7_4,$Total__OverwithheldtaxrefundedOther_7_4,$Total__AmountofTaxWithheldasAdjOther_7_4\n";
		fwrite($myfile, $txt);
	}
	$C7_5=0;
	$Total__Gross_7_5=0;
	$Total__BasicStat_7_5=0;
	$Total__Holiday_7_5=0;
	$Total__Overtime_7_5=0;
	$Total__Night_7_5=0;
	$Total__Hazard_7_5=0;
	$Total__OneThree_7_5=0;
	$Total__Deminimis_7_5=0;
	$Total__SSS_7_5=0;
	$Total__Sal_7_5=0;
	$Total__TotNonTaxPrevious_7_5=0;
	$Total__GrossPresent_7_5=0;
	$Total__BasicStatDayPresent_7_5=0;
	$Total__BasicStatWeekPresent_7_5=0;
	$Total__BasicStatYearPresent_7_5=0;
	$Total__BasicStatPresent_7_5=0;
	$Total__HolidayPresent_7_5=0;
	$Total__OvertimePresent_7_5=0;
	$Total__NightPresent_7_5=0;
	$Total__HazardPresent_7_5=0;
	$Total__OneThreePresent_7_5=0;
	$Total__DeminimisPresent_7_5=0;
	$Total__SSSPresent_7_5=0;
	$Total__SalPresent_7_5=0;
	$Total__TotNonTaxPreviousPresent_7_5=0;
	$Total__OneThreePreviousTaxable_7_5=0;
	$Total__SalOtherCompPreviousTaxable_7_5=0;
	$Total__Total_Taxable_PreviousTaxable_7_5=0;
	$Total__BasicSalaryPresentTaxable_7_5=0;
	$Total__OneThreePresentTaxable_7_5=0;
	$Total__SalOtherCompPresentTaxable_7_5=0;
	$Total__Total_Taxable_PresentTaxable_7_5=0;
	$Total__Total_Taxable_PreviousPresentTaxable_7_5=0;
	$Total__NetTaxableCompIncomeOther_7_5=0;
	$Total__TaxDueOther_7_5=0;
	$Total__TaxwithheldfrompreviousOther_7_5=0;
	$Total__TaxwithheldfrompresentOther_7_5=0;
	$Total__AmountwithheldforindecOther_7_5=0;
	$Total__OverwithheldtaxrefundedOther_7_5=0;
	$Total__AmountofTaxWithheldasAdjOther_7_5=0;
	for($c=$tablerowcount_7_5;$c>0;$c--){
		if($_POST['RName_7_5'.$c]){
			$RName=$_POST['RName_7_5'.$c];
			$getEmp=mysqli_query($conn,"SELECT * FROM hr_employee_info  WHERE employee_id='$RName'");
			$rr=mysqli_fetch_array($getEmp);
			$f_name=$rr['fname'];
			$m_name=$rr['mname'];
			$l_name=$rr['lname'];
			$getEmp2=mysqli_query($conn,"SELECT * FROM hr_employee_job_detail  WHERE emp_id='$RName'");
			$rr2=mysqli_fetch_array($getEmp2);
			$TIN=$rr2['tin_number'];
			$Region_7_5=$_POST['Region_7_5'.$c];
			$Factor_7_5=$_POST['Factor_7_5'.$c];
			$From_7_5=$_POST['From_7_5'.$c];
			$To_7_5=$_POST['To_7_5'.$c];
			
			$Gross_7_5=$_POST['Gross_7_5'.$c];
			$BasicStat_7_5=$_POST['BasicStat_7_5'.$c];
			$Holiday_7_5=$_POST['Holiday_7_5'.$c];
			$Overtime_7_5=$_POST['Overtime_7_5'.$c];
			$Night_7_5=$_POST['Night_7_5'.$c];
			$Hazard_7_5=$_POST['Hazard_7_5'.$c];
			$OneThree_7_5=$_POST['OneThree_7_5'.$c];
			$Deminimis_7_5=$_POST['Deminimis_7_5'.$c];
			$SSS_7_5=$_POST['SSS_7_5'.$c];
			$Sal_7_5=$_POST['Sal_7_5'.$c];
			$TotNonTaxPrevious_7_5=$_POST['TotNonTaxPrevious_7_5'.$c];
			
			$GrossPresent_7_5=$_POST['GrossPresent_7_5'.$c];
			$BasicStatDayPresent_7_5=$_POST['BasicStatDayPresent_7_5'.$c];
			$BasicStatWeekPresent_7_5=$_POST['BasicStatWeekPresent_7_5'.$c];
			$BasicStatYearPresent_7_5=$_POST['BasicStatYearPresent_7_5'.$c];
			$BasicStatPresent_7_5=$_POST['BasicStatPresent_7_5'.$c];
			$HolidayPresent_7_5=$_POST['HolidayPresent_7_5'.$c];
			$OvertimePresent_7_5=$_POST['OvertimePresent_7_5'.$c];
			$NightPresent_7_5=$_POST['NightPresent_7_5'.$c];
			$HazardPresent_7_5=$_POST['HazardPresent_7_5'.$c];
			$OneThreePresent_7_5=$_POST['OneThreePresent_7_5'.$c];
			$DeminimisPresent_7_5=$_POST['DeminimisPresent_7_5'.$c];
			$SSSPresent_7_5=$_POST['SSSPresent_7_5'.$c];
			$SalPresent_7_5=$_POST['SalPresent_7_5'.$c];
			$TotNonTaxPreviousPresent_7_5=$_POST['TotNonTaxPreviousPresent_7_5'.$c];
			
			$OneThreePreviousTaxable_7_5=$_POST['OneThreePreviousTaxable_7_5'.$c];
			$SalOtherCompPreviousTaxable_7_5=$_POST['SalOtherCompPreviousTaxable_7_5'.$c];
			$Total_Taxable_PreviousTaxable_7_5=$_POST['Total_Taxable_PreviousTaxable_7_5'.$c];
			$BasicSalaryPresentTaxable_7_5=$_POST['BasicSalaryPresentTaxable_7_5'.$c];
			
			$OneThreePresentTaxable_7_5=$_POST['OneThreePresentTaxable_7_5'.$c];
			$SalOtherCompPresentTaxable_7_5=$_POST['SalOtherCompPresentTaxable_7_5'.$c];
			$Total_Taxable_PresentTaxable_7_5=$_POST['Total_Taxable_PresentTaxable_7_5'.$c];
			$Total_Taxable_PreviousPresentTaxable_7_5=$_POST['Total_Taxable_PreviousPresentTaxable_7_5'.$c];
			
			$NetTaxableCompIncomeOther_7_5=$_POST['NetTaxableCompIncomeOther_7_5'.$c];
			$TaxDueOther_7_5=$_POST['TaxDueOther_7_5'.$c];
			$TaxwithheldfrompreviousOther_7_5=$_POST['TaxwithheldfrompreviousOther_7_5'.$c];
			$TaxwithheldfrompresentOther_7_5=$_POST['TaxwithheldfrompresentOther_7_5'.$c];
			$AmountwithheldforindecOther_7_5=$_POST['AmountwithheldforindecOther_7_5'.$c];
			$OverwithheldtaxrefundedOther_7_5=$_POST['OverwithheldtaxrefundedOther_7_5'.$c];
			$AmountofTaxWithheldasAdjOther_7_5=$_POST['AmountofTaxWithheldasAdjOther_7_5'.$c];
			
			$Total__Gross_7_5+=$Gross_7_5;
			$Total__BasicStat_7_5+=$BasicStat_7_5;
			$Total__Holiday_7_5+=$Holiday_7_5;
			$Total__Overtime_7_5+=$Overtime_7_5;
			$Total__Night_7_5+=$Night_7_5;
			$Total__Hazard_7_5+=$Hazard_7_5;
			$Total__OneThree_7_5+=$OneThree_7_5;
			$Total__Deminimis_7_5+=$Deminimis_7_5;
			$Total__SSS_7_5+=$SSS_7_5;
			$Total__Sal_7_5+=$Sal_7_5;
			$Total__TotNonTaxPrevious_7_5+=$TotNonTaxPrevious_7_5;
			$Total__GrossPresent_7_5+=$GrossPresent_7_5;
			$Total__BasicStatDayPresent_7_5+=$BasicStatDayPresent_7_5;
			$Total__BasicStatWeekPresent_7_5+=$BasicStatWeekPresent_7_5;
			$Total__BasicStatYearPresent_7_5+=$BasicStatYearPresent_7_5;
			$Total__BasicStatPresent_7_5+=$BasicStatPresent_7_5;
			$Total__HolidayPresent_7_5+=$HolidayPresent_7_5;
			$Total__OvertimePresent_7_5+=$OvertimePresent_7_5;
			$Total__NightPresent_7_5+=$NightPresent_7_5;
			$Total__HazardPresent_7_5+=$HazardPresent_7_5;
			$Total__OneThreePresent_7_5+=$OneThreePresent_7_5;
			$Total__DeminimisPresent_7_5+=$DeminimisPresent_7_5;
			$Total__SSSPresent_7_5+=$SSSPresent_7_5;
			$Total__SalPresent_7_5+=$SalPresent_7_5;
			$Total__TotNonTaxPreviousPresent_7_5+=$TotNonTaxPreviousPresent_7_5;
			$Total__OneThreePreviousTaxable_7_5+=$OneThreePreviousTaxable_7_5;
			$Total__SalOtherCompPreviousTaxable_7_5+=$SalOtherCompPreviousTaxable_7_5;
			$Total__Total_Taxable_PreviousTaxable_7_5+=$Total_Taxable_PreviousTaxable_7_5;
			$Total__BasicSalaryPresentTaxable_7_5+=$BasicSalaryPresentTaxable_7_5;
			$Total__OneThreePresentTaxable_7_5+=$OneThreePresentTaxable_7_5;
			$Total__SalOtherCompPresentTaxable_7_5+=$SalOtherCompPresentTaxable_7_5;
			$Total__Total_Taxable_PresentTaxable_7_5+=$Total_Taxable_PresentTaxable_7_5;
			$Total__Total_Taxable_PreviousPresentTaxable_7_5+=$Total_Taxable_PreviousPresentTaxable_7_5;
			$Total__NetTaxableCompIncomeOther_7_5+=$NetTaxableCompIncomeOther_7_5;
			$Total__TaxDueOther_7_5+=$TaxDueOther_7_5;
			$Total__TaxwithheldfrompreviousOther_7_5+=$TaxwithheldfrompreviousOther_7_5;
			$Total__TaxwithheldfrompresentOther_7_5+=$TaxwithheldfrompresentOther_7_5;
			$Total__AmountwithheldforindecOther_7_5+=$AmountwithheldforindecOther_7_5;
			$Total__OverwithheldtaxrefundedOther_7_5+=$OverwithheldtaxrefundedOther_7_5;
			$Total__AmountofTaxWithheldasAdjOther_7_5+=$AmountofTaxWithheldasAdjOther_7_5;
			$txt = "D7.5,1604CF,$TINNO,$TINNO2,12/31/$Year,";
			$txt.="$c,$TIN,0000,$l_name,$f_name,$m_name,$Region,";
			$txt.="$Gross_7_5,$BasicStat_7_5,$Holiday_7_5,$Overtime_7_5,$Night_7_5,$Hazard_7_5,$OneThree_7_5,";
			$txt.="$Deminimis_7_5,$SSS_7_5,$Sal_7_5,$TotNonTaxPrevious_7_5,";
			$txt.="$OneThreePreviousTaxable_7_5,$SalOtherCompPreviousTaxable_7_5,$Total_Taxable_PreviousTaxable_7_5,";
			$txt.="$From_7_5,$To_7_5,";
			$txt.="$GrossPresent_7_5,$BasicStatDayPresent_7_5,$BasicStatWeekPresent_7_5,$BasicStatYearPresent_7_5,$Factor_7_5,";
			$txt.="$HolidayPresent_7_5,$OvertimePresent_7_5,$NightPresent_7_5,$HazardPresent_7_5,$OneThreePresent_7_5,$DeminimisPresent_7_5,";
			$txt.="$SSS_7_5,$TotNonTaxPreviousPresent_7_5,";
			$txt.="$OneThreePresentTaxable_7_5,$SalOtherCompPresentTaxable_7_5,$Total_Taxable_PresentTaxable_7_5,$Total_Taxable_PreviousPresentTaxable_7_5,";
			$txt.=",0.00,0.00,";
			$txt.="$NetTaxableCompIncomeOther_7_5,$TaxDueOther_7_5,$TaxwithheldfrompreviousOther_7_5,$TaxwithheldfrompresentOther_7_5,$AmountwithheldforindecOther_7_5,";
			$txt.="$OverwithheldtaxrefundedOther_7_5,$AmountofTaxWithheldasAdjOther_7_5\n";
			//WORKINGONIT
			if(fwrite($myfile, $txt)){
				$C7_5=1;
			}
			
		}
	}
	if($C7_5==1){
		$txt = "C7.5,1604CF,$TINNO,$TINNO2,12/31/$Year,";
		$txt.="$Total__Gross_7_5,$Total__BasicStat_7_5,$Total__Holiday_7_5,$Total__Overtime_7_5,$Total__Night_7_5,$Total__Hazard_7_5,$Total__OneThree_7_5,";
		$txt.="$Total__Deminimis_7_5,$Total__SSS_7_5,$Total__Sal_7_5,$Total__TotNonTaxPrevious_7_5,";
		$txt.="$Total__OneThreePreviousTaxable_7_5,$Total__SalOtherCompPreviousTaxable_7_5,$Total__Total_Taxable_PreviousTaxable_7_5,";
		$txt.="$Total__GrossPresent_7_5,$Total__BasicStatDayPresent_7_5,$Total__BasicStatWeekPresent_7_5,$Total__BasicStatYearPresent_7_5,";
		$txt.="$Total__HolidayPresent_7_5,$Total__OvertimePresent_7_5,$Total__NightPresent_7_5,$Total__HazardPresent_7_5,$Total__OneThreePresent_7_5,$Total__DeminimisPresent_7_5,";
		$txt.="$Total__SSS_7_5,$Total__TotNonTaxPreviousPresent_7_5,";
		$txt.="$Total__OneThreePresentTaxable_7_5,$Total__SalOtherCompPresentTaxable_7_5,$Total__Total_Taxable_PresentTaxable_7_5,$Total__Total_Taxable_PreviousPresentTaxable_7_5,";
		$txt.="0.00,0.00,";
		$txt.="$Total__NetTaxableCompIncomeOther_7_5,$Total__TaxDueOther_7_5,$Total__TaxwithheldfrompreviousOther_7_5,$Total__TaxwithheldfrompresentOther_7_5,$Total__AmountwithheldforindecOther_7_5,";
		$txt.="$Total__OverwithheldtaxrefundedOther_7_5,$Total__AmountofTaxWithheldasAdjOther_7_5\n";
		fwrite($myfile, $txt);
	}
	
	?>
	<script>
	
		
	$(document).ready(function(){
		
		location.href='extra/attendance/download2.php?file=<?php echo $file; ?>';
	});
	
	</script>
	<?php							
}

?>						
						
						
						
						
						
						
