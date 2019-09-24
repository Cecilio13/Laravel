<div id="DownloadExcelDiv">
<script type="text/javascript" src="extra/download/jszip.js"></script>
<script type="text/javascript" src="extra/download/FileSaver.js"></script>
<script type="text/javascript" src="extra/download/myexcel.js"></script>
<script>
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd = '0'+dd
} 

if(mm<10) {
    mm = '0'+mm
} 

today = mm + '/' + dd + '/' + yyyy;
<?php
include '../../config.php';
$Location=$_POST['value'];
$Site=$_POST['value2'];

?>
var excel = $JExcel.new("Calibri light 10 #333333");
excel.set( {sheet:0,value:"Asset List" } );
var cur_year=new Date().getFullYear();
var formatHeader=excel.addStyle ( { 												
border: "none,none,none,thin #333333", 												
font: "Calibri 12 #0000AA B"});

excel.set(0,0,1,'Asset Tag',formatHeader);
excel.set(0,1,1,'Asset',formatHeader);
excel.set(0,2,1,'Brand',formatHeader);
excel.set(0,3,1,'Model',formatHeader);
excel.set(0,4,1,'Serial Number',formatHeader);
excel.set(0,5,1,'Department',formatHeader);
excel.set(0,6,1,'Site',formatHeader);
excel.set(0,7,1,'Location',formatHeader);
excel.set(0,8,1,'Status',formatHeader);
excel.set(0,9,1,'Employee',formatHeader);





excel.set(0,0,undefined,30);
excel.set(0,1,undefined,20);
excel.set(0,2,undefined,20);
excel.set(0,3,undefined,20);
excel.set(0,4,undefined,20);
excel.set(0,5,undefined,20);
excel.set(0,6,undefined,20);
excel.set(0,7,undefined,20);
excel.set(0,8,undefined,20);
excel.set(0,9,undefined,20);

	
<?php

$getAssetByLocation= mysqli_query($conn,"SELECT * FROM assets WHERE asset_location='$Location' AND asset_site='$Site' AND asset_approval='1' AND asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5'");
$i=1;
while($Loc = mysqli_fetch_array($getAssetByLocation)){
	$i++;
	$dpcode=$result['asset_department_code'];
	$getDept= mysqli_query($conn,"SELECT * FROM company_department WHERE department_code='$dpcode' ");
	$dd = mysqli_fetch_array($getDept);
	
	?>
	excel.set(0,0,<?php echo $i; ?>,'<?php echo $Loc['asset_tag']; ?>');
	excel.set(0,1,<?php echo $i; ?>,'<?php echo $Loc['asset_description']; ?>');
	excel.set(0,2,<?php echo $i; ?>,'<?php echo $Loc['asset_brand']; ?>');
	excel.set(0,3,<?php echo $i; ?>,'<?php echo $Loc['sku_model']; ?>');
	excel.set(0,4,<?php echo $i; ?>,'<?php echo $Loc['asset_serial_number']; ?>');
	excel.set(0,5,<?php echo $i; ?>,'<?php echo $dd['department_name']; ?>');
	excel.set(0,6,<?php echo $i; ?>,'<?php echo $Loc['asset_site']; ?>');
	excel.set(0,7,<?php echo $i; ?>,'<?php echo $Loc['asset_location']; ?>');
	<?php
		$Status="";
	if($Loc['asset_transaction_status']=="1" || $Loc['asset_transaction_status']=="2.1" || $Loc['asset_transaction_status']=="2.2" ){
		$Status="Available";
	}
	if($Loc['asset_transaction_status']=="2" || $Loc['asset_transaction_status']=="1.1" || $Loc['asset_transaction_status']=="1.2"){
		$Status="Checked Out";
	}
	
	if($Loc['asset_transaction_status']=="4.1" || $Loc['asset_transaction_status']=="4.2"){
		$Status="Queued for Maintenance";
	}
	if($Loc['asset_transaction_status']=="4"){
		$Status="On Maintenace";
	}
	?>
	excel.set(0,8,<?php echo $i; ?>,'<?php echo $Status; ?>');
	<?php
	$at=$Loc['asset_tag'];
	$getTao= mysqli_query($conn,"SELECT * FROM asset_request JOIN employee_info ON employee_info.employee_id=asset_request.emp_id WHERE asset_tag='$at' AND (request_status='2' OR request_status='1.1' OR request_status='1.2')");
	$EEMMP = mysqli_fetch_array($getTao);
	$Employee_NAME=$EEMMP['fname']." ".$EEMMP['mname']." ".$EEMMP['lname'];
	?>
	excel.set(0,9,<?php echo $i; ?>,'<?php echo $Employee_NAME; ?>');

	
	
<?php
}
?>	
excel.generate("Lapsing Schedule - "+today+".xlsx");

	</script>

</div>
