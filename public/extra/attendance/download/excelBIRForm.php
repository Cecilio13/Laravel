<div id="DownloadExcelDiv">
<script type="text/javascript" src="extra/attendance/download/jszip.js"></script>
<script type="text/javascript" src="extra/attendance/download/FileSaver.js"></script>
<script type="text/javascript" src="extra/attendance/download/myexcel.js"></script>
<script>

<?php
include '../config.php';
$Type="";
$Form=$_POST['Form'];
if($Form=="1600"){
	?>
	var excel = $JExcel.new("Calibri light 10 #333333");
	excel.set( {sheet:0,value:"Report" } );
	var formatHeader=excel.addStyle ( { 												
	border: "none,none,none,thin #333333", 												
	font: "Calibri 12 #40404f B",format: "# ?/?"});
	excel.set(0,0,0,'Name',formatHeader);
	excel.set(0,1,0,'ATC',formatHeader);
	excel.set(0,2,0,'Income Payment',formatHeader);
	excel.set(0,3,0,'Tax Rate',formatHeader);
	excel.set(0,4,0,'Tax Withheld',formatHeader);
	excel.set(0,0,undefined,30);
	excel.set(0,1,undefined,30);
	excel.set(0,2,undefined,30);
	excel.set(0,3,undefined,30);
	excel.set(0,4,undefined,30);
	<?php
	$AllDat=$_POST['AllDat'];
	$a=1;
	foreach($AllDat as $data){
		
		$getEmployeeName=mysqli_query($conn,"SELECT * FROM hr_employee_info WHERE employee_id='$data[0]'");
		$n=mysqli_fetch_array($getEmployeeName);
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $data[2]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		<?php
		$a++;
		
	}
	?>
	excel.generate("BIR 1600 Form.xlsx");
	<?php
}
else if($Form=="1601C"){
	$AllDat=$_POST['AllDat'];
	?>
	var excel = $JExcel.new("Calibri light 10 #333333");
	excel.set( {sheet:0,value:"Report" } );
	var formatHeader=excel.addStyle ( { 												
	border: "none,none,none,thin #333333", 												
	font: "Calibri 12 #40404f B",format: "# ?/?"});
	excel.set(0,0,0,'Total Amount of Compensation',formatHeader);
	excel.set(0,1,0,'Less: Non Taxable Compensation',formatHeader);
	excel.set(0,2,0,'Income Payment',formatHeader);
	excel.set(0,3,0,'Statutory Minimum Wage (MWEs)',formatHeader);
	excel.set(0,4,0,'Holiday Pay, Overtime Pay, Night Shift Differential Pay, Hazard Pay (Minimum Wage Earner)',formatHeader);
	excel.set(0,5,0,'Other Non-Taxable Compensation',formatHeader);
	excel.set(0,6,0,'Taxable Compensation',formatHeader);
	excel.set(0,7,0,'Tax Required to be Withheld',formatHeader);
	excel.set(0,8,0,'Add/Less: Adjustment',formatHeader);
	excel.set(0,9,0,'Tax Required to be Withheld for Remittance',formatHeader);
	excel.set(0,10,0,'Less: Tax Remitted In Return Previously Filed, if this is an amended return',formatHeader);
	excel.set(0,11,0,'Other Payments Made',formatHeader);
	excel.set(0,12,0,'Total Tax Payments Made',formatHeader);
	excel.set(0,13,0,'Tax Still Due/(Overremittance)',formatHeader);
	excel.set(0,14,0,'Surcharge',formatHeader);
	excel.set(0,15,0,'Interest',formatHeader);
	excel.set(0,16,0,'Compromise',formatHeader);
	excel.set(0,17,0,'Add: Penalties',formatHeader);
	excel.set(0,18,0,'Tax Amount Still Due/(Overremittance)',formatHeader);
	excel.set(0,0,undefined,30);
	excel.set(0,1,undefined,30);
	excel.set(0,2,undefined,30);
	excel.set(0,3,undefined,30);
	excel.set(0,4,undefined,30);
	excel.set(0,5,undefined,30);
	excel.set(0,6,undefined,30);
	excel.set(0,7,undefined,30);
	excel.set(0,8,undefined,30);
	excel.set(0,9,undefined,30);
	excel.set(0,10,undefined,30);
	excel.set(0,11,undefined,30);
	excel.set(0,12,undefined,30);
	excel.set(0,13,undefined,30);
	excel.set(0,14,undefined,30);
	excel.set(0,15,undefined,30);
	excel.set(0,16,undefined,30);
	excel.set(0,17,undefined,30);
	excel.set(0,18,undefined,30);
	<?php
	$AllDat=$_POST['AllDat'];
	$a=1;
	foreach($AllDat as $data){
		
		$getEmployeeName=mysqli_query($conn,"SELECT * FROM hr_employee_info WHERE employee_id='$data[0]'");
		$n=mysqli_fetch_array($getEmployeeName);
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $data[2]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,6,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,7,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,8,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,9,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,10,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,11,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,12,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,13,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,14,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,15,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,16,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,17,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,18,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		<?php
		$a++;
		
	}
	?>
	excel.generate("BIR 1601C Form.xlsx");
	<?php
}
else if($Form=="1604CF"){
	$AllDat=$_POST['AllDat'];
	$AllDat2=$_POST['AllDat2'];
	$AllDat3=$_POST['AllDat3'];
	$AllDat4=$_POST['AllDat4'];
	$AllDat5=$_POST['AllDat5'];
	$AllDat6=$_POST['AllDat6'];
	?>
	var excel = $JExcel.new("Calibri light 10 #333333");
	excel.set( {sheet:0,value:"Report" } );
	var formatHeader=excel.addStyle ( { 												
	border: "none,none,none,thin #333333", 												
	font: "Calibri 12 #40404f B",format: "# ?/?"});
	excel.set(0,0,0,'Schedule 5',excel.addStyle( {align:"L"}));
	excel.set(0,0,1,'Name',formatHeader);
	excel.set(0,1,1,'Status Code',formatHeader);
	excel.set(0,2,1,'ATC',formatHeader);
	excel.set(0,3,1,'Income Payment',formatHeader);
	excel.set(0,4,1,'Tax Rate',formatHeader);
	excel.set(0,5,1,'Tax Withheld',formatHeader);
	excel.set(0,0,undefined,30);
	excel.set(0,1,undefined,30);
	excel.set(0,2,undefined,30);
	excel.set(0,3,undefined,30);
	excel.set(0,4,undefined,30);
	excel.set(0,5,undefined,30);
	<?php
	$a=2;
	foreach($AllDat as $data){
		$getEmployeeName=mysqli_query($conn,"SELECT * FROM hr_employee_info WHERE employee_id='$data[0]'");
		$n=mysqli_fetch_array($getEmployeeName);
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $data[2]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[5]; ?>',excel.addStyle( {align:"R"}));
		<?php
		$a++;
	}
	$a++;
	?>
	excel.set(0,0,<?php echo $a; ?>,'Schedule 6',excel.addStyle( {align:"L"}));
	<?php
	$a++;
	?>
	excel.set(0,0,<?php echo $a; ?>,'Name',formatHeader);
	excel.set(0,1,<?php echo $a; ?>,'ATC',formatHeader);
	excel.set(0,2,<?php echo $a; ?>,'Fringe Benefit',formatHeader);
	excel.set(0,3,<?php echo $a; ?>,'Monetary Value',formatHeader);
	excel.set(0,4,<?php echo $a; ?>,'Amount Withheld',formatHeader);
	<?php
	$a++;
	foreach($AllDat2 as $data){
		
		$getEmployeeName=mysqli_query($conn,"SELECT * FROM hr_employee_info WHERE employee_id='$data[0]'");
		$n=mysqli_fetch_array($getEmployeeName);
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $data[2]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		<?php
		$a++;
	}
	$a++;
	?>
	excel.set(0,0,<?php echo $a; ?>,'Schedule 7.1',excel.addStyle( {align:"L"}));
	<?php
	$a++;
	?>
	excel.set(0,0,<?php echo $a; ?>,'Name',formatHeader);
	excel.set(0,1,<?php echo $a; ?>,'Employment From',formatHeader);
	excel.set(0,2,<?php echo $a; ?>,'Employment To',formatHeader);
	excel.set(0,3,<?php echo $a; ?>,'Gross Comp. Income',formatHeader);
	excel.set(0,4,<?php echo $a; ?>,'13th Mo. Pay & Other benefits(non-taxable)',formatHeader);
	excel.set(0,5,<?php echo $a; ?>,'De Minimis Benefit(non-taxable)',formatHeader);
	excel.set(0,6,<?php echo $a; ?>,'SSS, GSIS, PHIC, Pag-Ibig & Union Dues',formatHeader);
	excel.set(0,7,<?php echo $a; ?>,'Salaries & Other Comp.(non-taxable)',formatHeader);
	excel.set(0,8,<?php echo $a; ?>,'Total Comp. Income(non-taxable)',formatHeader);
	excel.set(0,9,<?php echo $a; ?>,'Taxable Basic Salary',formatHeader);
	excel.set(0,10,<?php echo $a; ?>,'13th Mo. Pay & Other benefit(taxable)',formatHeader);
	excel.set(0,11,<?php echo $a; ?>,'Salaries & Other Comp. (taxable)',formatHeader);
	excel.set(0,12,<?php echo $a; ?>,'Total Comp. Income(taxable)',formatHeader);
	excel.set(0,13,<?php echo $a; ?>,'Net Comp. Income(taxable)',formatHeader);
	excel.set(0,14,<?php echo $a; ?>,'Tax Due (Jan. to Dec.)',formatHeader);
	excel.set(0,15,<?php echo $a; ?>,'Tax Withheld (Jan. to Dec.)',formatHeader);
	excel.set(0,16,<?php echo $a; ?>,'Amount withheld & paid for in December',formatHeader);
	excel.set(0,17,<?php echo $a; ?>,'Over withheld tax refunded to employees',formatHeader);
	excel.set(0,18,<?php echo $a; ?>,'Substitute Filling',formatHeader);
	excel.set(0,19,<?php echo $a; ?>,'Amt. of tax withheld as adjusted',formatHeader);
	<?php
	$a++;
	foreach($AllDat3 as $data){
		
		$getEmployeeName=mysqli_query($conn,"SELECT * FROM hr_employee_info WHERE employee_id='$data[0]'");
		$n=mysqli_fetch_array($getEmployeeName);
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $data[2]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[5]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,6,<?php echo $a; ?>,'<?php echo $data[6]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,7,<?php echo $a; ?>,'<?php echo $data[7]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,8,<?php echo $a; ?>,'<?php echo $data[8]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,9,<?php echo $a; ?>,'<?php echo $data[9]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,10,<?php echo $a; ?>,'<?php echo $data[10]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,11,<?php echo $a; ?>,'<?php echo $data[11]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,12,<?php echo $a; ?>,'<?php echo $data[12]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,13,<?php echo $a; ?>,'<?php echo $data[13]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,14,<?php echo $a; ?>,'<?php echo $data[14]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,15,<?php echo $a; ?>,'<?php echo $data[15]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,16,<?php echo $a; ?>,'<?php echo $data[16]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,17,<?php echo $a; ?>,'<?php echo $data[17]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,18,<?php echo $a; ?>,'<?php echo $data[18]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,19,<?php echo $a; ?>,'<?php echo $data[19]; ?>',excel.addStyle( {align:"R"}));
		<?php
		$a++;
		
	}
	$a++;
	?>
	excel.set(0,0,<?php echo $a; ?>,'Schedule 7.3',excel.addStyle( {align:"L"}));
	<?php
	$a++;
	?>
	excel.set(0,0,<?php echo $a; ?>,'Name',formatHeader);
	excel.set(0,1,<?php echo $a; ?>,'Gross Comp. Income',formatHeader);
	excel.set(0,2,<?php echo $a; ?>,'13th Mo. Pay & Other benefits(non-taxable)',formatHeader);
	excel.set(0,3,<?php echo $a; ?>,'De Minimis Benefit(non-taxable)',formatHeader);
	excel.set(0,4,<?php echo $a; ?>,'SSS, GSIS, PHIC, Pag-Ibig & Union Dues',formatHeader);
	excel.set(0,5,<?php echo $a; ?>,'Salaries & Other Comp.(non-taxable)',formatHeader);
	excel.set(0,6,<?php echo $a; ?>,'Total Comp. Income(non-taxable)',formatHeader);
	excel.set(0,7,<?php echo $a; ?>,'Taxable Basic Salary',formatHeader);
	excel.set(0,8,<?php echo $a; ?>,'13th Mo. Pay & Other benefit(taxable)',formatHeader);
	excel.set(0,9,<?php echo $a; ?>,'Salaries & Other Comp. (taxable)',formatHeader);
	excel.set(0,10,<?php echo $a; ?>,'Total Comp. Income(taxable)',formatHeader);
	excel.set(0,11,<?php echo $a; ?>,'Net Comp. Income(taxable)',formatHeader);
	excel.set(0,12,<?php echo $a; ?>,'Tax Due (Jan. to Dec.)',formatHeader);
	excel.set(0,13,<?php echo $a; ?>,'Tax Withheld (Jan. to Dec.)',formatHeader);
	excel.set(0,14,<?php echo $a; ?>,'Amount withheld & paid for in December',formatHeader);
	excel.set(0,15,<?php echo $a; ?>,'Over withheld tax refunded to employees',formatHeader);
	excel.set(0,16,<?php echo $a; ?>,'Substitute Filling',formatHeader);
	excel.set(0,17,<?php echo $a; ?>,'Amt. of tax withheld as adjusted',formatHeader);
	<?php
	$a++;
	foreach($AllDat4 as $data){
		
		$getEmployeeName=mysqli_query($conn,"SELECT * FROM hr_employee_info WHERE employee_id='$data[0]'");
		$n=mysqli_fetch_array($getEmployeeName);
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $data[2]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[5]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,6,<?php echo $a; ?>,'<?php echo $data[6]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,7,<?php echo $a; ?>,'<?php echo $data[7]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,8,<?php echo $a; ?>,'<?php echo $data[8]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,9,<?php echo $a; ?>,'<?php echo $data[9]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,10,<?php echo $a; ?>,'<?php echo $data[10]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,11,<?php echo $a; ?>,'<?php echo $data[11]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,12,<?php echo $a; ?>,'<?php echo $data[12]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,13,<?php echo $a; ?>,'<?php echo $data[13]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,14,<?php echo $a; ?>,'<?php echo $data[14]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,15,<?php echo $a; ?>,'<?php echo $data[15]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,16,<?php echo $a; ?>,'<?php echo $data[16]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,17,<?php echo $a; ?>,'<?php echo $data[17]; ?>',excel.addStyle( {align:"R"}));
		<?php
		$a++;
		
	}
	$a++;
	?>
	excel.set(0,0,<?php echo $a; ?>,'Schedule 7.4',excel.addStyle( {align:"L"}));
	<?php
	$a++;
	?>
	excel.set(0,0,<?php echo $a; ?>,'Name',formatHeader);
	excel.set(0,1,<?php echo $a; ?>,'13th Month & Other Benefits from Previous Employer',formatHeader);
	excel.set(0,2,<?php echo $a; ?>,'De Minimis Benefits from Previous Employer',formatHeader);
	excel.set(0,3,<?php echo $a; ?>,'SSS, GSIS, PAG-IBIG & Union Dues from Previous Employer',formatHeader);
	excel.set(0,4,<?php echo $a; ?>,'Salaries & Other form of Comp.from Previous Employer',formatHeader);
	excel.set(0,5,<?php echo $a; ?>,'Total Nontaxable Comp. Income from Previous Employer',formatHeader);
	excel.set(0,6,<?php echo $a; ?>,'13th Month & Other Benefits from Present Employer',formatHeader);
	excel.set(0,7,<?php echo $a; ?>,'De Minimis Benefits from Present Employer',formatHeader);
	excel.set(0,8,<?php echo $a; ?>,'SSS, GSIS, PAG-IBIG & Union Dues from Present Employer',formatHeader);
	excel.set(0,9,<?php echo $a; ?>,'Salaries & Other form of Comp.from Present Employer',formatHeader);
	excel.set(0,10,<?php echo $a; ?>,'Total Nontaxable Comp. Income from Present Employer',formatHeader);
	excel.set(0,11,<?php echo $a; ?>,'Taxable Basic Salary from Previous Employer',formatHeader);
	excel.set(0,12,<?php echo $a; ?>,'13th Month & Other Benefits from Previous Employer',formatHeader);
	excel.set(0,13,<?php echo $a; ?>,'Salaries & Other form of Comp.from Previous Employer',formatHeader);
	excel.set(0,14,<?php echo $a; ?>,'Total Taxable from Previous Employer',formatHeader);
	excel.set(0,15,<?php echo $a; ?>,'Taxable Basic Salary from Present Employer',formatHeader);
	excel.set(0,16,<?php echo $a; ?>,'13th Month & Other Benefits from Present Employer',formatHeader);
	excel.set(0,17,<?php echo $a; ?>,'Salaries & Other form of Comp.from Present Employer',formatHeader);
	excel.set(0,18,<?php echo $a; ?>,'Total Taxable from Previous & Present Employer',formatHeader);
	excel.set(0,19,<?php echo $a; ?>,'Net Taxable Comp. Income',formatHeader);
	excel.set(0,20,<?php echo $a; ?>,'Tax Due (Jan. to Dec.)',formatHeader);
	excel.set(0,21,<?php echo $a; ?>,'Tax Withheld From Previous Employer(Jan. to Nov.)',formatHeader);
	excel.set(0,22,<?php echo $a; ?>,'Tax Withheld From Present Employer(Jan. to Nov.)',formatHeader);
	excel.set(0,23,<?php echo $a; ?>,'Amount Withheld and Paid for in Dec.',formatHeader);
	excel.set(0,24,<?php echo $a; ?>,'Overwithheld Tax Refunded',formatHeader);
	excel.set(0,25,<?php echo $a; ?>,'Amount of Tax Withheld as Adjustment',formatHeader);
	excel.set(0,26,<?php echo $a; ?>,'Gross Compensation Income (Previous & Present)',formatHeader);
	<?php
	$a++;
	foreach($AllDat5 as $data){
		
		$getEmployeeName=mysqli_query($conn,"SELECT * FROM hr_employee_info WHERE employee_id='$data[0]'");
		$n=mysqli_fetch_array($getEmployeeName);
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $data[2]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[5]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,6,<?php echo $a; ?>,'<?php echo $data[6]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,7,<?php echo $a; ?>,'<?php echo $data[7]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,8,<?php echo $a; ?>,'<?php echo $data[8]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,9,<?php echo $a; ?>,'<?php echo $data[9]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,10,<?php echo $a; ?>,'<?php echo $data[10]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,11,<?php echo $a; ?>,'<?php echo $data[11]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,12,<?php echo $a; ?>,'<?php echo $data[12]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,13,<?php echo $a; ?>,'<?php echo $data[13]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,14,<?php echo $a; ?>,'<?php echo $data[14]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,15,<?php echo $a; ?>,'<?php echo $data[15]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,16,<?php echo $a; ?>,'<?php echo $data[16]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,17,<?php echo $a; ?>,'<?php echo $data[17]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,18,<?php echo $a; ?>,'<?php echo $data[18]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,19,<?php echo $a; ?>,'<?php echo $data[19]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,20,<?php echo $a; ?>,'<?php echo $data[20]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,21,<?php echo $a; ?>,'<?php echo $data[21]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,22,<?php echo $a; ?>,'<?php echo $data[22]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,23,<?php echo $a; ?>,'<?php echo $data[23]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,24,<?php echo $a; ?>,'<?php echo $data[24]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,25,<?php echo $a; ?>,'<?php echo $data[25]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,26,<?php echo $a; ?>,'<?php echo $data[26]; ?>',excel.addStyle( {align:"R"}));
		<?php
		$a++;
		
	}
	$a++;
	?>
	excel.set(0,0,<?php echo $a; ?>,'Schedule 7.5',excel.addStyle( {align:"L"}));
	<?php
	$a++;
	?>
	excel.set(0,0,<?php echo $a; ?>,'Name',formatHeader);
	excel.set(0,1,<?php echo $a; ?>,'Region',formatHeader);
	excel.set(0,2,<?php echo $a; ?>,'Factor Used(No. of Days/Year)',formatHeader);
	excel.set(0,3,<?php echo $a; ?>,'Employement From',formatHeader);
	excel.set(0,4,<?php echo $a; ?>,'Employement To',formatHeader);
	excel.set(0,5,<?php echo $a; ?>,'Gross Comp. Income From Previous Employer',formatHeader);
	excel.set(0,6,<?php echo $a; ?>,'Basic Statutory Min. Wage From Previous Employer',formatHeader);
	excel.set(0,7,<?php echo $a; ?>,'Holiday Pay From Previous Employer',formatHeader);
	excel.set(0,8,<?php echo $a; ?>,'Overtime Pay From Previous Employer',formatHeader);
	excel.set(0,9,<?php echo $a; ?>,'Night Shift Differential From Previous Employer',formatHeader);
	excel.set(0,10,<?php echo $a; ?>,'Hazard Pay From Previous Employer',formatHeader);
	excel.set(0,11,<?php echo $a; ?>,'13th Month & Other Benefits From Previous Employer',formatHeader);
	excel.set(0,12,<?php echo $a; ?>,'De Minimis Benefits From Previous Employer',formatHeader);
	excel.set(0,13,<?php echo $a; ?>,'SSS,GSIS, PAG_IBIG & Union Dues From Previous Employer',formatHeader);
	excel.set(0,14,<?php echo $a; ?>,'Salaries & Other Forms of Comp. From Previous Employer',formatHeader);
	excel.set(0,15,<?php echo $a; ?>,'Total Non-Taxable/Exempt Comp. Income From Previous Employer',formatHeader);
	excel.set(0,16,<?php echo $a; ?>,'Gross Comp. Income From Present Employer',formatHeader);
	excel.set(0,17,<?php echo $a; ?>,'Basic Statutory Min. Wage/Day From Present Employer',formatHeader);
	excel.set(0,18,<?php echo $a; ?>,'Basic Statutory Min. Wage/Month From Present Employer',formatHeader);
	excel.set(0,19,<?php echo $a; ?>,'Basic Statutory Min. Wage/Year From Present Employer',formatHeader);
	excel.set(0,20,<?php echo $a; ?>,'Basic Statutory Min. Wage From Present Employer',formatHeader);
	excel.set(0,21,<?php echo $a; ?>,'Holiday Pay From Present Employer',formatHeader);
	excel.set(0,22,<?php echo $a; ?>,'Overtime Pay From Present Employer',formatHeader);
	excel.set(0,23,<?php echo $a; ?>,'Night Shift Differential From Present Employer',formatHeader);
	excel.set(0,24,<?php echo $a; ?>,'Hazard Pay From Present Employer',formatHeader);
	excel.set(0,25,<?php echo $a; ?>,'13th Month & Other Benefits From Present Employer',formatHeader);
	excel.set(0,26,<?php echo $a; ?>,'De Minimis Benefits From Present Employer',formatHeader);
	excel.set(0,27,<?php echo $a; ?>,'SSS,GSIS, PAG_IBIG & Union Dues From Present Employer',formatHeader);
	excel.set(0,28,<?php echo $a; ?>,'Salaries & Other Forms of Comp. From Present Employer',formatHeader);
	excel.set(0,29,<?php echo $a; ?>,'Total Non-Taxable/Exempt Comp. Income From Present Employer',formatHeader);
	excel.set(0,30,<?php echo $a; ?>,'13th Month & Other Comp. From Previous Employer',formatHeader);
	excel.set(0,31,<?php echo $a; ?>,'Salaries & Other Comp. From Previous Employer',formatHeader);
	excel.set(0,32,<?php echo $a; ?>,'Total Taxable From Previous Employer',formatHeader);
	excel.set(0,33,<?php echo $a; ?>,'Taxable Basic Salary From Present Employer',formatHeader);
	excel.set(0,34,<?php echo $a; ?>,'13th Month & Other Comp. From Present Employer',formatHeader);
	excel.set(0,35,<?php echo $a; ?>,'Salaries & Other Comp. From Present Employer',formatHeader);
	excel.set(0,36,<?php echo $a; ?>,'Total Taxable From Present Employer',formatHeader);
	excel.set(0,37,<?php echo $a; ?>,'Total Taxable From Previous & Present Employer',formatHeader);
	excel.set(0,38,<?php echo $a; ?>,'Net Taxable Comp. Income',formatHeader);
	excel.set(0,39,<?php echo $a; ?>,'Tax Due (Jan. to Dec.)',formatHeader);
	excel.set(0,40,<?php echo $a; ?>,'Tax Withheld From Previous Employer(Jan. to Nov.)',formatHeader);
	excel.set(0,41,<?php echo $a; ?>,'Tax Withheld From Present Employer(Jan. to Nov.)',formatHeader);
	excel.set(0,42,<?php echo $a; ?>,'Amount Withheld and Paid for in Dec.',formatHeader);
	excel.set(0,43,<?php echo $a; ?>,'Overwithheld Tax Refunded',formatHeader);
	excel.set(0,44,<?php echo $a; ?>,'Amount of Tax Withheld as Adjustment',formatHeader);
	<?php
	$a++;
	foreach($AllDat6 as $data){
		
		$getEmployeeName=mysqli_query($conn,"SELECT * FROM hr_employee_info WHERE employee_id='$data[0]'");
		$n=mysqli_fetch_array($getEmployeeName);
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $data[2]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[5]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,6,<?php echo $a; ?>,'<?php echo $data[6]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,7,<?php echo $a; ?>,'<?php echo $data[7]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,8,<?php echo $a; ?>,'<?php echo $data[8]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,9,<?php echo $a; ?>,'<?php echo $data[9]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,10,<?php echo $a; ?>,'<?php echo $data[10]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,11,<?php echo $a; ?>,'<?php echo $data[11]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,12,<?php echo $a; ?>,'<?php echo $data[12]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,13,<?php echo $a; ?>,'<?php echo $data[13]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,14,<?php echo $a; ?>,'<?php echo $data[14]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,15,<?php echo $a; ?>,'<?php echo $data[15]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,16,<?php echo $a; ?>,'<?php echo $data[16]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,17,<?php echo $a; ?>,'<?php echo $data[17]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,18,<?php echo $a; ?>,'<?php echo $data[18]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,19,<?php echo $a; ?>,'<?php echo $data[19]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,20,<?php echo $a; ?>,'<?php echo $data[20]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,21,<?php echo $a; ?>,'<?php echo $data[21]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,22,<?php echo $a; ?>,'<?php echo $data[22]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,23,<?php echo $a; ?>,'<?php echo $data[23]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,24,<?php echo $a; ?>,'<?php echo $data[24]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,25,<?php echo $a; ?>,'<?php echo $data[25]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,26,<?php echo $a; ?>,'<?php echo $data[26]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,27,<?php echo $a; ?>,'<?php echo $data[27]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,28,<?php echo $a; ?>,'<?php echo $data[28]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,29,<?php echo $a; ?>,'<?php echo $data[29]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,30,<?php echo $a; ?>,'<?php echo $data[30]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,31,<?php echo $a; ?>,'<?php echo $data[31]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,32,<?php echo $a; ?>,'<?php echo $data[32]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,33,<?php echo $a; ?>,'<?php echo $data[33]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,34,<?php echo $a; ?>,'<?php echo $data[34]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,35,<?php echo $a; ?>,'<?php echo $data[35]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,36,<?php echo $a; ?>,'<?php echo $data[36]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,37,<?php echo $a; ?>,'<?php echo $data[37]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,38,<?php echo $a; ?>,'<?php echo $data[38]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,39,<?php echo $a; ?>,'<?php echo $data[39]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,40,<?php echo $a; ?>,'<?php echo $data[40]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,41,<?php echo $a; ?>,'<?php echo $data[41]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,42,<?php echo $a; ?>,'<?php echo $data[42]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,43,<?php echo $a; ?>,'<?php echo $data[43]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,44,<?php echo $a; ?>,'<?php echo $data[44]; ?>',excel.addStyle( {align:"R"}));
		<?php
		$a++;
		
	}
	
	?>
	//generate Excel
	excel.generate("BIR 1604CF Form.xlsx");
	<?php
}
else if($Form=="1604E"){
	?>
	var excel = $JExcel.new("Calibri light 10 #333333");
	excel.set( {sheet:0,value:"Report" } );
	var formatHeader=excel.addStyle ( { 												
	border: "none,none,none,thin #333333", 												
	font: "Calibri 12 #40404f B",format: "# ?/?"});
	excel.set(0,0,0,'Schedule 3',excel.addStyle( {align:"L"}));
	excel.set(0,0,1,'Name',formatHeader);
	excel.set(0,1,1,'ATC',formatHeader);
	excel.set(0,2,1,'Income Payment',formatHeader);
	excel.set(0,0,undefined,30);
	excel.set(0,1,undefined,30);
	excel.set(0,2,undefined,30);
	<?php
	$AllDat=$_POST['AllDat'];
	$AllDat2=$_POST['AllDat2'];
	$a=2;
	foreach($AllDat as $data){
		
		$getEmployeeName=mysqli_query($conn,"SELECT * FROM hr_employee_info WHERE employee_id='$data[0]'");
		$n=mysqli_fetch_array($getEmployeeName);
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $data[2]; ?>',excel.addStyle( {align:"R"}));
		<?php
		$a++;
		
	}
	$a++;
	?>
	
	excel.set(0,0,<?php echo $a; ?>,'Schedule 4',excel.addStyle( {align:"L"}));
	<?php
	$a++;
	?>
	
	excel.set(0,0,<?php echo $a; ?>,'Name',formatHeader);
	excel.set(0,1,<?php echo $a; ?>,'ATC',formatHeader);
	excel.set(0,2,<?php echo $a; ?>,'Income Payment',formatHeader);
	excel.set(0,3,<?php echo $a; ?>,'Tax Rate',formatHeader);
	excel.set(0,4,<?php echo $a; ?>,'Tax Withheld',formatHeader);
	excel.set(0,0,undefined,30);
	excel.set(0,1,undefined,30);
	excel.set(0,2,undefined,30);
	excel.set(0,3,undefined,30);
	excel.set(0,4,undefined,30);
	<?php
	$a++;
	foreach($AllDat2 as $data){
		
		$getEmployeeName=mysqli_query($conn,"SELECT * FROM hr_employee_info WHERE employee_id='$data[0]'");
		$n=mysqli_fetch_array($getEmployeeName);
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $data[2]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		<?php
		$a++;
		
	}
	?>
	excel.generate("BIR 1604E Form.xlsx");
	<?php
}
else if($Form=="2553"){
	?>
	var excel = $JExcel.new("Calibri light 10 #333333");
	excel.set( {sheet:0,value:"Report" } );
	var formatHeader=excel.addStyle ( { 												
	border: "none,none,none,thin #333333", 												
	font: "Calibri 12 #40404f B",format: "# ?/?"});
	excel.set(0,0,0,'Name',formatHeader);
	excel.set(0,1,0,'ATC',formatHeader);
	excel.set(0,2,0,'Income Payment',formatHeader);
	excel.set(0,3,0,'Tax Rate',formatHeader);
	excel.set(0,4,0,'Tax Withheld',formatHeader);
	excel.set(0,0,undefined,30);
	excel.set(0,1,undefined,30);
	excel.set(0,2,undefined,30);
	excel.set(0,3,undefined,30);
	excel.set(0,4,undefined,30);
	<?php
	$AllDat=$_POST['AllDat'];
	$a=1;
	foreach($AllDat as $data){
		
		$getEmployeeName=mysqli_query($conn,"SELECT * FROM hr_employee_info WHERE employee_id='$data[0]'");
		$n=mysqli_fetch_array($getEmployeeName);
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $data[2]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"R"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"R"}));
		<?php
		$a++;
		
	}
	?>
	excel.generate("BIR 2553 Form.xlsx");
	<?php
}
else if($Form=="1601E"){
	$Quarter=$_POST['Quarter'];
	$AllDat=$_POST['AllDat'];
	?>
	var excel = $JExcel.new("Calibri light 10 #333333");
	excel.set( {sheet:0,value:"Report" } );
	var formatHeader=excel.addStyle ( { 												
	border: "none,none,none,thin #333333", 												
	font: "Calibri 12 #40404f B",format: "# ?/?"});
	excel.set(0,0,0,'Month',formatHeader);
	excel.set(0,1,0,'Year',formatHeader);
	excel.set(0,2,0,'Name',formatHeader);
	excel.set(0,3,0,'ATC',formatHeader);
	excel.set(0,4,0,'Income Payment',formatHeader);
	excel.set(0,5,0,'Tax Rate',formatHeader);
	excel.set(0,6,0,'Tax Withheld',formatHeader);
	excel.set(0,0,undefined,30);
	excel.set(0,1,undefined,30);
	excel.set(0,2,undefined,30);
	excel.set(0,3,undefined,30);
	excel.set(0,4,undefined,30);
	excel.set(0,4,undefined,30);
	excel.set(0,4,undefined,30);
	<?php
	$a=1;
	foreach($AllDat as $data){
	$getEmployeeName=mysqli_query($conn,"SELECT * FROM hr_employee_info WHERE employee_id='$data[2]'");
	$n=mysqli_fetch_array($getEmployeeName);
	$MM="January";
	
	
	
	
	if($Quarter=="Q1"){
		if($data[0]=="01" || $data[0]=="02" || $data[0]=="03"){
		if($data[0]=="01"){
		$MM="January";
		}
		else if($data[0]=="02"){
			$MM="February";
		}
		else if($data[0]=="03"){
			$MM="March";
		}
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $MM; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[5]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,6,<?php echo $a; ?>,'<?php echo $data[6]; ?>',excel.addStyle( {align:"L"}));
		<?php
		$a++;
		}
	}
	else if($Quarter=="Q2"){
		if($data[0]=="04" || $data[0]=="05" || $data[0]=="06"){
		if($data[0]=="04"){
		$MM="April";
		}
		else if($data[0]=="05"){
			$MM="May";
		}
		else if($data[0]=="06"){
			$MM="June";
		}
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $MM; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[5]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,6,<?php echo $a; ?>,'<?php echo $data[6]; ?>',excel.addStyle( {align:"L"}));
		<?php
		$a++;
		}
	}
	else if($Quarter=="Q3"){
		if($data[0]=="07" || $data[0]=="08" || $data[0]=="09"){
		if($data[0]=="07"){
		$MM="July";
		}
		else if($data[0]=="08"){
			$MM="August";
		}
		else if($data[0]=="09"){
			$MM="September";
		}
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $MM; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[5]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,6,<?php echo $a; ?>,'<?php echo $data[6]; ?>',excel.addStyle( {align:"L"}));
		<?php
		$a++;
		}
	}
	else if($Quarter=="Q4"){
		if($data[0]=="10" || $data[0]=="11" || $data[0]=="12"){
			
		
		if($data[0]=="10"){
		$MM="October";
		}
		else if($data[0]=="11"){
			$MM="November";
		}
		else if($data[0]=="12"){
			$MM="December";
		}
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $MM; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[5]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,6,<?php echo $a; ?>,'<?php echo $data[6]; ?>',excel.addStyle( {align:"L"}));
		<?php
		$a++;
		}
	}
		
		
		
	}
	?>
	excel.generate("BIR 1601E Form - <?php echo $Quarter; ?>.xlsx");
	<?php
}
else if($Form=="1601F"){
	$Quarter=$_POST['Quarter'];
	$AllDat=$_POST['AllDat'];
	?>
	var excel = $JExcel.new("Calibri light 10 #333333");
	excel.set( {sheet:0,value:"Report" } );
	var formatHeader=excel.addStyle ( { 												
	border: "none,none,none,thin #333333", 												
	font: "Calibri 12 #40404f B",format: "# ?/?"});
	excel.set(0,0,0,'Month',formatHeader);
	excel.set(0,1,0,'Year',formatHeader);
	excel.set(0,2,0,'Name',formatHeader);
	excel.set(0,3,0,'ATC',formatHeader);
	excel.set(0,4,0,'Income Payment',formatHeader);
	excel.set(0,5,0,'Tax Rate',formatHeader);
	excel.set(0,6,0,'Tax Withheld',formatHeader);
	excel.set(0,0,undefined,30);
	excel.set(0,1,undefined,30);
	excel.set(0,2,undefined,30);
	excel.set(0,3,undefined,30);
	excel.set(0,4,undefined,30);
	excel.set(0,4,undefined,30);
	excel.set(0,4,undefined,30);
	<?php
	$a=1;
	foreach($AllDat as $data){
	$getEmployeeName=mysqli_query($conn,"SELECT * FROM hr_employee_info WHERE employee_id='$data[2]'");
	$n=mysqli_fetch_array($getEmployeeName);
	$MM="January";
	
	
	
	
	if($Quarter=="Q1"){
		if($data[0]=="01" || $data[0]=="02" || $data[0]=="03"){
		if($data[0]=="01"){
		$MM="January";
		}
		else if($data[0]=="02"){
			$MM="February";
		}
		else if($data[0]=="03"){
			$MM="March";
		}
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $MM; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[5]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,6,<?php echo $a; ?>,'<?php echo $data[6]; ?>',excel.addStyle( {align:"L"}));
		<?php
		$a++;
		}
	}
	else if($Quarter=="Q2"){
		if($data[0]=="04" || $data[0]=="05" || $data[0]=="06"){
		if($data[0]=="04"){
		$MM="April";
		}
		else if($data[0]=="05"){
			$MM="May";
		}
		else if($data[0]=="06"){
			$MM="June";
		}
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $MM; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[5]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,6,<?php echo $a; ?>,'<?php echo $data[6]; ?>',excel.addStyle( {align:"L"}));
		<?php
		$a++;
		}
	}
	else if($Quarter=="Q3"){
		if($data[0]=="07" || $data[0]=="08" || $data[0]=="09"){
		if($data[0]=="07"){
		$MM="July";
		}
		else if($data[0]=="08"){
			$MM="August";
		}
		else if($data[0]=="09"){
			$MM="September";
		}
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $MM; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[5]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,6,<?php echo $a; ?>,'<?php echo $data[6]; ?>',excel.addStyle( {align:"L"}));
		<?php
		$a++;
		}
	}
	else if($Quarter=="Q4"){
		if($data[0]=="10" || $data[0]=="11" || $data[0]=="12"){
			
		
		if($data[0]=="10"){
		$MM="October";
		}
		else if($data[0]=="11"){
			$MM="November";
		}
		else if($data[0]=="12"){
			$MM="December";
		}
		?>
		excel.set(0,0,<?php echo $a; ?>,'<?php echo $MM; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,1,<?php echo $a; ?>,'<?php echo $data[1]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,2,<?php echo $a; ?>,'<?php echo $n['fname']." ".$n['lname']; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,3,<?php echo $a; ?>,'<?php echo $data[3]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,4,<?php echo $a; ?>,'<?php echo $data[4]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,5,<?php echo $a; ?>,'<?php echo $data[5]; ?>',excel.addStyle( {align:"L"}));
		excel.set(0,6,<?php echo $a; ?>,'<?php echo $data[6]; ?>',excel.addStyle( {align:"L"}));
		<?php
		$a++;
		}
	}
		
		
		
	}
	?>
	excel.generate("BIR 1601F Form - <?php echo $Quarter; ?>.xlsx");
	<?php
}



?>
</script>
	<script>
		function randomDate(start, end) {
			var d= new Date(start.getTime() + Math.random() * (end.getTime() - start.getTime()));
			return d;
		}
		
		function go(){
			
		    var excel = $JExcel.new("Calibri light 10 #333333");			// Default font
			
			// excel.set is the main function to generate content:
			// 		We can use parameter notation excel.set(sheetValue,columnValue,rowValue,cellValue,styleValue) 
			// 		Or object notation excel.set({sheet:sheetValue,column:columnValue,row:rowValue,value:cellValue,style:styleValue })
			// 		null or 0 are used as default values for undefined entries		
			
			excel.set( {sheet:0,value:"This is Sheet 1" } );
		    
			excel.set(0,8,1,15);		
			excel.set(0,8,2,13);		
			excel.set(0,7,3,"15+13");		
			excel.set(0,8,3,"=I2+I3");		

				
			var evenRow=excel.addStyle ( { 																	// Style for even ROWS
				border: "none,none,none,thin #333333"});													// Borders are LEFT,RIGHT,TOP,BOTTOM. Check $JExcel.borderStyles for a list of valid border styles

			var oddRow=excel.addStyle ( { 																	// Style for odd ROWS
				fill: "#ECECEC" , 																			// Background color, plain #RRGGBB, there is a helper $JExcel.rgbToHex(r,g,b)
				border: "none,none,none,thin #333333"}); 
			
			
			for (var i=1;i<50;i++) excel.set({row:i,style: i%2==0 ? evenRow: oddRow  });					// Set style for the first 50 rows
			excel.set({row:3,value: 30  });																	// We want ROW 3 to be EXTRA TALL
 
			var headers=["Header 0","Header 1","Header 2","Header 3","Header 4"];							// This array holds the HEADERS text
			var formatHeader=excel.addStyle ( { 															// Format for headers
					border: "none,none,none,thin #333333", 													// 		Border for header
					font: "Calibri 12 #0000AA B"}); 														// 		Font for headers

			for (var i=0;i<headers.length;i++){																// Loop all the haders
				excel.set(0,i,0,headers[i],formatHeader);													// Set CELL with header text, using header format
				excel.set(0,i,undefined,"auto");															// Set COLUMN width to auto (according to the standard this is only valid for numeric columns)
			}
			
			
			// Now let's write some data
			var initDate = new Date(2000, 0, 1);
			var endDate = new Date(2016, 0, 1);
			var dateStyle = excel.addStyle ( { 																// Format for date cells
					align: "R",																				// 		aligned to the RIGHT
					format: "yyyy.mm.dd hh:mm:ss", 															// 		using DATE mask, Check $JExcel.formats for built-in formats or provide your own 
					font: "#00AA00"}); 																		// 		in color green
			
			for (var i=1;i<50;i++){																			// we will fill the 50 rows
				excel.set(0,0,i,"This is line "+i);															// This column is a TEXT
				var d=randomDate(initDate,endDate);															// Get a random date
				excel.set(0,1,i,d.toLocaleString());														// Store the random date as STRING
				excel.set(0,2,i,$JExcel.toExcelLocalTime(d));												// Store the previous random date as a NUMERIC (there is also $JExcel.toExcelUTCTime)
				excel.set(0,3,i,$JExcel.toExcelLocalTime(d),dateStyle);										// Store the previous random date as a NUMERIC,  display using dateStyle format
				excel.set(0,4,i,"Some other text");															// Some other text
				}

			excel.set(0,1,undefined,30);																	// Set COLUMN 1 to 30 chars width
			excel.set(0,3,undefined,30);																	// Set COLUMN 3 to 20 chars width
			excel.set(0,4,undefined,20, excel.addStyle( {align:"R"}));										// Align column 4 to the right
			excel.set(0,1,3,undefined,excel.addStyle( {align:"L T"}));										// Align cell 1-3  to LEFT-TOP
			excel.set(0,2,3,undefined,excel.addStyle( {align:"C C"}));										// Align cell 2-3  to CENTER-CENTER
			excel.set(0,3,3,undefined,excel.addStyle( {align:"R B"}));										// Align cell 3-3  to RIGHT-BOTTOM
			
			
			
		    excel.generate("SampleData.xlsx");
			
		}
	</script>

</div>
