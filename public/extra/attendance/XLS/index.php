<?php
include '../config.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
date_default_timezone_set('UTC');
$FilePath=$_FILES["theFile"]["tmp_name"];
$fileanem=$_FILES["theFile"]["name"];
$inputFileName =$FilePath;
//$inputFileName ='test.dat';
//$fileanem="test.dat";
$ext = end((explode(".", $fileanem)));
$row=0;
$error_count=0;
$saved_count=0;
$countloop=0;
$Log="";

if($ext=="dat"){
	$fh = fopen($inputFileName,'r');
	while ($line = fgets($fh)) {
	  // <... Do your work with the line ...>
	  //echo($line)."<br>";
	  
	  $data=explode("\t",$line);
	  $emp=$data[0];
	  $datt=date( "Y-m-d", strtotime($data[1]) );
	 
	}
	fclose($fh);
}
else if($ext=="xls" || $ext=="xlsx"){
	$spreadsheet = IOFactory::load($inputFileName);
	$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
	array_shift($sheetData);
	foreach($sheetData as $data){
		$row++;
		if($data['A']!=""){
			if($data['B']!=""){
				if($data['I']!=""){
					if($data['I']=="Check-In"){
						$datt=date( "Y-m-d", strtotime( $data['A']  ) );
						$validate_date= mysqli_query($conn,"SELECT * FROM hr_employee_attendance WHERE emp_id='".$data['B']."' AND attendance_date='$datt' AND attendance_time_out IS NULL");
						$rrr=mysqli_num_rows($validate_date);
						if($rrr<1){
							$Datte=date( "Y-m-d", strtotime( $data['A']  ) );
							$time=date( "H:i:s", strtotime( $data['A']  ) );
							$emp=$data['B'];
							$datenow=date('Y-m-d');
							$t=time();
							$primary=$t.$datenow.$Datte;
							$Updatetemplate="INSERT INTO hr_employee_attendance (emp_id,attendance_date,attendance_time_in,attendance_type,attendance_status)
							VALUES ('$emp','$Datte','$time','Time In','1')";
							mysqli_query($conn,$Updatetemplate);
							
							$saved_count++;
						}else{
							$er=mysqli_fetch_array($validate_date);
							$att_id=$er['employee_attendance_id'];
							$emp_id=$er['emp_id'];
							$att_time_in=$er['attendance_time_in'];
							$Datte=date( "Y-m-d", strtotime( $data['A']  ) );
							$time=date( "H:i:s", strtotime( $data['A']  ) );
							$emp=$data['B'];
							if($Datte==$er['attendance_date'] && $time==$er['attendance_time_in'] && $emp_id==$emp){
								$error_count++;
								$Log.="Duplicate Data on row $row from file.\n";	
							}else{
								/* $Updatetemplate="UPDATE hr_employee_attendance SET attendance_time_out='$att_time_in' WHERE employee_attendance_id='$att_id'";
								mysqli_query($conn,$Updatetemplate); */
								$datenow=date('Y-m-d');
								$t=time();
								$primary=$t.$datenow.$Datte;
								$Updatetemplate="INSERT INTO hr_employee_attendance (emp_id,attendance_date,attendance_time_in,attendance_type,attendance_status)
								VALUES ('$emp','$Datte','$time','Time In','1')";
								mysqli_query($conn,$Updatetemplate);
								$saved_count++;
							}
							
						}
						
					}
					else if($data['I']=="Check-Out"){
						$getattendance= mysqli_query($conn,"SELECT * FROM hr_employee_attendance WHERE emp_id='".$data['B']."' AND attendance_date='$datt' AND attendance_time_out IS NULL AND attendance_time_in IS NOT NULL ORDER BY attendance_time_in DESC");
						$att= mysqli_fetch_array($getattendance);
						$att_id=$att['employee_attendance_id'];
						$Updatetemplate="UPDATE hr_employee_attendance SET attendance_time_out='1' WHERE employee_attendance_id='$att_id'";
						mysqli_query($conn,$Updatetemplate);
						$saved_count++;
					}
					else{
						$error_count++;
						$Log.="Skipped row $row from file.\n";	
					}
				}else{
					
				$error_count++;
				$Log.="No In/Out Status on row $row from file.\n";	
				}
			}else{
				$error_count++;
				$Log.="No Biometrics ID on row $row from file.\n";
			}
		}
		$countloop++;
	}
}



$data = array(
   'Success' => $saved_count,
   'Total' => $countloop,
   'Skiped'  => $error_count,
   'Error_Log' =>$Log
);
echo json_encode($data);
