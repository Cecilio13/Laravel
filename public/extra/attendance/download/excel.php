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
include '../../update_Current_Cost.php';
$Type=$_POST['Type'];
$Value=$_POST['value'];
$Value2=$_POST['value2'];
$Columns=$_POST['Columns'];
if($Type=="LS1"){
?>
var excel = $JExcel.new("Calibri light 10 #333333");
excel.set( {sheet:0,value:"Report" } );
var cur_year=new Date().getFullYear();
var formatHeader=excel.addStyle ( { 												
border: "none,none,none,thin #333333", 												
font: "Calibri 12 #0000AA B",format: "# ?/?"});
<?php
$re=0;
foreach($Columns as $column){
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Asset Tag',formatHeader);
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Asset',formatHeader);
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Serial Number',formatHeader);
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Plate Number',formatHeader);
	<?php
	$re++;
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Vendor Name',formatHeader);
	<?php
	$re++;	
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Purchase Order',formatHeader);
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Invoice Number',formatHeader);
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Purchase Cost',formatHeader);
	<?php
	$re++;	
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Purchase Date',formatHeader);
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Start Date',formatHeader);
	<?php
	$re++;
	}
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Depreciable Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Useful Life',formatHeader);
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Depreciation Frequency',formatHeader);
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Initial Value',formatHeader);
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Salvage Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Depreciation Cost',formatHeader);
	<?php
	$re++;
	}
}
?>
excel.set(0,<?php echo $re; ?>,0,'Jan. '+cur_year,formatHeader);
excel.set(0,<?php echo $re+1; ?>,0,'Feb. '+cur_year,formatHeader);
excel.set(0,<?php echo $re+2; ?>,0,'March '+cur_year,formatHeader);
excel.set(0,<?php echo $re+3; ?>,0,'April '+cur_year,formatHeader);
excel.set(0,<?php echo $re+4; ?>,0,'May '+cur_year,formatHeader);
excel.set(0,<?php echo $re+5; ?>,0,'June '+cur_year,formatHeader);
excel.set(0,<?php echo $re+6; ?>,0,'July '+cur_year,formatHeader);
excel.set(0,<?php echo $re+7; ?>,0,'Aug. '+cur_year,formatHeader);
excel.set(0,<?php echo $re+8; ?>,0,'Sep. '+cur_year,formatHeader);
excel.set(0,<?php echo $re+9; ?>,0,'Oct. '+cur_year,formatHeader);
excel.set(0,<?php echo $re+10; ?>,0,'Nov. '+cur_year,formatHeader);
excel.set(0,<?php echo $re+11; ?>,0,'Dec. '+cur_year,formatHeader);
excel.set(0,<?php echo $re+12; ?>,0,'<?php echo "Total Accumulated Depreciation (".date('Y').")";?>',formatHeader);
excel.set(0,<?php echo $re+13; ?>,0,'Total Accumulated Depreciation',formatHeader);
excel.set(0,<?php echo $re+14; ?>,0,'Book Value',formatHeader);



excel.set(0,0,undefined,30);
excel.set(0,1,undefined,20);
excel.set(0,2,undefined,30);
excel.set(0,3,undefined,20);
excel.set(0,4,undefined,20);
excel.set(0,5,undefined,20);
excel.set(0,6,undefined,20);
excel.set(0,7,undefined,20);
excel.set(0,8,undefined,20);
excel.set(0,9,undefined,20);
excel.set(0,10,undefined,20);
excel.set(0,11,undefined,20);
excel.set(0,12,undefined,20);
excel.set(0,13,undefined,20);
excel.set(0,14,undefined,20);
excel.set(0,15,undefined,20);
excel.set(0,16,undefined,20);
excel.set(0,17,undefined,20);
excel.set(0,18,undefined,20);
excel.set(0,19,undefined,20);
excel.set(0,20,undefined,20);
excel.set(0,21,undefined,30);
excel.set(0,22,undefined,30);
excel.set(0,23,undefined,30);
excel.set(0,24,undefined,30);
excel.set(0,25,undefined,30);
excel.set(0,26,undefined,30);
excel.set(0,27,undefined,20);
excel.set(0,28,undefined,30);
excel.set(0,29,undefined,30);
excel.set(0,30,undefined,30);
excel.set(0,31,undefined,30);
excel.set(0,32,undefined,30);
excel.set(0,33,undefined,30);	
<?php

$getassetByType= mysqli_query($conn,"SELECT * FROM assets WHERE asset_approval='1' ORDER BY asset_description ASC");
$i=0;
while($result = mysqli_fetch_array($getassetByType)){
	$i++;
	$dpcode=$result['asset_department_code'];
	$getDept= mysqli_query($conn,"SELECT * FROM company_department WHERE department_code='$dpcode' ");
	$dd = mysqli_fetch_array($getDept);
	
	?>
	<?php
$re=0;
foreach($Columns as $column){
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_tag']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_description']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_serial_number']." "; ?>',excel.addStyle( {align:"L",format: "# ?/?"}));
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['sku_code']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['vendor_number']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['purhase_order']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['invoice_number']; ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['purchase_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['purchase_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_date']!=""? date("m-d-Y", strtotime($result['depreciation_date'])) : ''; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['useful_life_span']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_frequency']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['initial_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['salvage_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depreciation_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
}
?>

	<?php
	$depriciable_value= $result['depriciable_value'];
	$depreciation_cost=$result['depreciation_cost'];
	if($result['depreciation_date']!=""){
		$date1=date_create($result['depreciation_date']." 8:00 ");
		$freq=$result['depreciation_frequency'];
		$useful_life_span=$result['useful_life_span'];
		$Now2=date('m');
		$csc=0;
		$final=$re+12;
		$totalaccumulateddepreciation=0;
		for($c=1;$c<=$Now2-1;$c++){
			$ce=$c-1;
			$dayy=$date1->format('d');
			$Now=date('Y-'.$c.'-'.$dayy.' 8:00');
			$date2=date_create($Now);
			$c222=$c;
			$Now22=date('Y-'.$c222.'-'.$dayy.' 8:00');
			$date22=date_create($Now22);
			$diff=date_diff($date1,$date2);
			$mo=$diff->format('%R');
			$mor=$diff->format('%m');
			
			if($mo=="+"){
				if($freq=="Yearly"){
		
					$divident=$diff->format('%y');
					$current=$depriciable_value-($depreciation_cost*$divident);
					$totalaccumulateddepreciation=$totalaccumulateddepreciation+$depreciation_cost;
					//echo $date2->format('Y-m-d')." = ".$current." ".$divident." ".$diff->format('%R')."<br>";
					?>
					excel.set(0,<?php echo $re+$ce; ?>,<?php echo $i; ?>,'<?php echo number_format($depreciation_cost,2); ?>',excel.addStyle( {align:"L"}));
					
					<?php
				}
				if($freq=="Monthly"){
					$divident=$diff->format('%m');
					$divident=$divident+($diff->format('%y')*12);
					$current=$depriciable_value-($depreciation_cost*($divident+1));
					if($divident>$useful_life_span){
						for($c2=$c-1;$c2<=12;$c2++){
							?>
							excel.set(0,<?php echo $re+$ce; ?>,<?php echo $i; ?>,'',excel.addStyle( {align:"L"}));
							
							<?php
							$csc=1;
						}
						$current=0;
						break;
					}
					if($current<0){
					?>
					excel.set(0,<?php echo $re+$ce; ?>,<?php echo $i; ?>,'',excel.addStyle( {align:"L"}));
					<?php
					}else{
					    
					    if($dayy>15){
					        
					        if($date1->format('Y-m')==$date22->format('Y-m')){
					            
					            
					        }else{
					          	$totalaccumulateddepreciation=$totalaccumulateddepreciation+$depreciation_cost;   
                              ?>
        					excel.set(0,<?php echo $re+$ce; ?>,<?php echo $i; ?>,'<?php echo  number_format($depreciation_cost,2); ?>',excel.addStyle( {align:"L"}));
        					<?php    
					            
					        }
					        
						    ?>
                        
                         <?php
                            
                        }else{
                         	$totalaccumulateddepreciation=$totalaccumulateddepreciation+$depreciation_cost;   
                          ?>
    					excel.set(0,<?php echo $re+$ce; ?>,<?php echo $i; ?>,'<?php echo number_format($depreciation_cost,2); ?>',excel.addStyle( {align:"L"}));
    					<?php  
                            
                        }
					    
					
					
					}
					//echo $date2->format('Y-m-d')." = ".$current." ".$divident." ".$diff->format('%R')."<br>";
					?>
					
					
					<?php
					
				}
				if($depreciation_frequency=="Hourly"){
		
					$divident=$diff->format('%h');
					$current=$depriciable_value-($depreciation_cost*$divident);
					$totalaccumulateddepreciation=$totalaccumulateddepreciation+$depreciation_cost;
					//echo $date2->format('Y-m-d')." = ".$current." ".$divident." ".$diff->format('%R')."<br>";
					?>
					excel.set(0,<?php echo $re+$ce; ?>,<?php echo $i; ?>,'<?php echo number_format($depreciation_cost,2); ?>',excel.addStyle( {align:"L"}));
					
					<?php
				}
			}else{
				/* if($mor=="0"){
					
					?>
					excel.set(0,<?php echo $re+$ce; ?>,<?php echo $i; ?>,'<?php echo number_format($depriciable_value-($depreciation_cost),2); ?>',excel.addStyle( {align:"L"}));
					
					<?php
					
				} */
				
			}
		
		}
		
		$accumulated=$depriciable_value-$result['current_cost'];
		if($accumulated<0){
			$accumulated=0;
			
		}
		?>
		excel.set(0,<?php echo $final; ?>,<?php echo $i; ?>,'<?php echo number_format($totalaccumulateddepreciation,2); ?>',excel.addStyle( {align:"L"}));
		excel.set(0,<?php echo $final+1; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value']-$result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
		excel.set(0,<?php echo $final+2; ?>,<?php echo $i; ?>,'<?php echo number_format($result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
		<?php
	}
}
?>
excel.generate("Lapsing Schedule - "+today+".xlsx");
<?php	
}
if($Type=='A1' || $Type=='A2' || $Type=='A3' || $Type=='A4'){
?>

var excel = $JExcel.new("Calibri light 10 #333333");
excel.set( {sheet:0,value:"Report "} );

var formatHeader=excel.addStyle ( { 									

border: "none,none,none,thin #333333", 												
font: "Calibri 12 #0000AA B"});
<?php
$re=0;
foreach($Columns as $column){
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Asset Tag',formatHeader);
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Asset',formatHeader);
	<?php
	$re++;
	}
	if($column=="Category"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Category',formatHeader);
	<?php
	$re++;
	}
	if($column=="Sub Category"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Sub Category',formatHeader);
	<?php
	$re++;
	}
	if($column=="Brand"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Brand',formatHeader);
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Serial Number',formatHeader);
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Plate Number',formatHeader);
	<?php
	$re++;
	}
	
	if($column=="Department"){
	
	?>
	excel.set(0,<?php echo $re; ?>,0,'Department',formatHeader);
	<?php
	$re++;
	
	}
	if($column=="Assigned To"){
	
	?>
	excel.set(0,<?php echo $re; ?>,0,'Assigned To',formatHeader);
	<?php
	$re++;
	
	}
	if($column=="Location"){
	
	?>
	excel.set(0,<?php echo $re; ?>,0,'Location',formatHeader);
	<?php
	$re++;
	
	}
	if($column=="Site"){
	
	?>
	excel.set(0,<?php echo $re; ?>,0,'Site',formatHeader);
	<?php
	$re++;
	
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Vendor Name',formatHeader);
	<?php
	$re++;
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Purchase Order',formatHeader);
	<?php
	$re++;
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Invoice Number',formatHeader);
	<?php
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Purchase Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Purchase Date',formatHeader);
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Start Date',formatHeader);
	<?php
	$re++;
	}
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Depreciable Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Useful Life',formatHeader);
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Depreciation Frequency',formatHeader);
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Initial Value',formatHeader);
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Salvage Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Depreciation Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Total Accumulated Depreciation',formatHeader);
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Book Value',formatHeader);
	<?php
	$re++;
	}
}
?>
excel.set(0,0,undefined,30);
excel.set(0,1,undefined,20);
excel.set(0,2,undefined,20);
excel.set(0,3,undefined,20);
excel.set(0,4,undefined,20);
excel.set(0,5,undefined,30);
excel.set(0,6,undefined,20);
excel.set(0,7,undefined,20);
excel.set(0,8,undefined,20);
excel.set(0,9,undefined,20);
excel.set(0,10,undefined,20);
excel.set(0,11,undefined,20);
excel.set(0,12,undefined,20);
excel.set(0,13,undefined,20);
excel.set(0,14,undefined,20);
excel.set(0,15,undefined,20);
excel.set(0,16,undefined,20);
excel.set(0,17,undefined,20);
excel.set(0,18,undefined,20);
excel.set(0,19,undefined,20);
excel.set(0,20,undefined,20);
excel.set(0,21,undefined,20);
excel.set(0,22,undefined,20);
excel.set(0,23,undefined,20);
excel.set(0,24,undefined,20);
excel.set(0,25,undefined,20);
excel.set(0,26,undefined,20);
excel.set(0,27,undefined,20);
excel.set(0,28,undefined,20);
excel.set(0,29,undefined,20);
excel.set(0,30,undefined,20);
<?php
if($Type=="A1"){
$WHERE="WHERE asset_type='$Value'  AND asset_approval='1' AND (asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5') ORDER BY asset_description ASC";
	if($Value=="All"){
		$WHERE="WHERE (asset_transaction_status!='3' AND asset_approval='1' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5') ORDER BY asset_description ASC";
	}
$getassetByType= mysqli_query($conn,"SELECT * FROM assets ".$WHERE);
$i=0;
while($result = mysqli_fetch_array($getassetByType)){
$i++;
$dpcode=$result['asset_department_code'];
$getDept= mysqli_query($conn,"SELECT * FROM company_department WHERE department_code='$dpcode' ");
$dd = mysqli_fetch_array($getDept);
$Desc222=$result['asset_description'];
$Cat222=$result['asset_category_name'];
$Sub222=$result['asset_sub_category'];
$sssswe= mysqli_query($conn,"SELECT * FROM asset_setup WHERE asset_setup_description='$Desc222' AND asset_setup_ac='$Cat222' AND asset_setup_sc='$Sub222'");
$ssss = mysqli_fetch_array($sssswe);
?>
<?php
$re=0;
foreach($Columns as $column){
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_tag']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_description']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Category"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $ssss['asset_setup_category']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Sub Category"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $ssss['asset_setup_sub_cat']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Brand"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_brand']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_serial_number']; ?>',excel.addStyle( {align:"L",format: "# ?/?"}));
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['sku_code']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Department"){
	
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $dd['department_name']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	
	}
	if($column=="Assigned To"){
	
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['assigned_to_temp']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	
	}
	if($column=="Location"){
	
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_location']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	
	}
	if($column=="Site"){
	
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_site']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['vendor_number']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['purhase_order']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['invoice_number']; ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['purchase_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['purchase_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_date']!=""? date("m-d-Y", strtotime($result['depreciation_date'])) : ''; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['useful_life_span']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_frequency']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['initial_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['salvage_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depreciation_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value']-$result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
}
?>

<?php
}
?>
excel.generate("Asset Report By Asset Type "+today+".xlsx");
<?php
}
if($Type=="A2"){
$WHERE="WHERE asset_location='$Value' AND asset_site='$Value2' AND asset_approval='1' AND asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' ORDER BY asset_description ASC";
	if($Value=="All"){
		$WHERE="WHERE asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' AND asset_approval='1' ORDER BY asset_description ASC";
	}
$getassetByType= mysqli_query($conn,"SELECT * FROM assets ".$WHERE);

$i=0;
while($result = mysqli_fetch_array($getassetByType)){
$i++;
	$dpcode=$result['asset_department_code'];
	$getDept= mysqli_query($conn,"SELECT * FROM company_department WHERE department_code='$dpcode' ");
	$dd = mysqli_fetch_array($getDept);
	$Desc222=$result['asset_description'];
	$Cat222=$result['asset_category_name'];
	$Sub222=$result['asset_sub_category'];
	$sssswe= mysqli_query($conn,"SELECT * FROM asset_setup WHERE asset_setup_description='$Desc222' AND asset_setup_ac='$Cat222' AND asset_setup_sc='$Sub222'");
	$ssss = mysqli_fetch_array($sssswe);
?>
<?php
$re=0;
foreach($Columns as $column){
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_tag']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_description']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Category"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $ssss['asset_setup_category']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Sub Category"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $ssss['asset_setup_sub_cat']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Brand"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_brand']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_serial_number']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['sku_code']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Department"){
	
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $dd['department_name']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	
	}
	if($column=="Assigned To"){
	
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['assigned_to_temp']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	
	}
	if($column=="Location"){
	
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_location']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	
	}
	if($column=="Site"){
	
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_site']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['vendor_number']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['purhase_order']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['invoice_number']; ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['purchase_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['purchase_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_date']!=""? date("m-d-Y", strtotime($result['depreciation_date'])) : ''; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['useful_life_span']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_frequency']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['initial_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['salvage_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depreciation_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value']-$result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
}
?>
<?php
}			
?>
excel.generate("Asset Report By Location "+today+".xlsx");
<?php	
}
if($Type=="A3"){
$WHERE="WHERE asset_department_code='$Value' AND asset_approval='1' AND asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' ORDER BY asset_description ASC";
if($Value=="All"){
	$WHERE="WHERE asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' AND asset_approval='1' ORDER BY asset_description ASC";
}
$getassetByType= mysqli_query($conn,"SELECT * FROM assets ".$WHERE);
$i=0;
while($result = mysqli_fetch_array($getassetByType)){
$i++;
	$dpcode=$result['asset_department_code'];
	$getDept= mysqli_query($conn,"SELECT * FROM company_department WHERE department_code='$dpcode' ");
	$dd = mysqli_fetch_array($getDept);
	$Desc222=$result['asset_description'];
	$Cat222=$result['asset_category_name'];
	$Sub222=$result['asset_sub_category'];
	$sssswe= mysqli_query($conn,"SELECT * FROM asset_setup WHERE asset_setup_description='$Desc222' AND asset_setup_ac='$Cat222' AND asset_setup_sc='$Sub222'");
	$ssss = mysqli_fetch_array($sssswe);
	?>
<?php
$re=0;
foreach($Columns as $column){
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_tag']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_description']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Category"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $ssss['asset_setup_category']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Sub Category"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $ssss['asset_setup_sub_cat']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Brand"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_brand']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_serial_number']; ?>',excel.addStyle( {align:"L",format: "# ?/?"}));
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['sku_code']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Department"){
	
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $dd['department_name']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	
	}
	if($column=="Assigned To"){
	
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['assigned_to_temp']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	
	}
	if($column=="Location"){
	
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_location']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	
	}
	if($column=="Site"){
	
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_site']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['vendor_number']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['purhase_order']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['invoice_number']; ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['purchase_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['purchase_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_date']!=""? date("m-d-Y", strtotime($result['depreciation_date'])) : ''; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['useful_life_span']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_frequency']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['initial_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['salvage_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depreciation_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value']-$result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
}
?>
<?php
}			
?>
excel.generate("Asset Report By Department "+today+".xlsx");
<?php

				
	
}
?>




<?php
}
if($Type=='B1' || $Type=='B2' || $Type=='B3' || $Type=='B4'){
?>
var excel = $JExcel.new("Calibri light 10 #333333");
excel.set( {sheet:0,value:"Report" } );
var cur_year=new Date().getFullYear();
var formatHeader=excel.addStyle ( { 												
border: "none,none,none,thin #333333", 												
font: "Calibri 12 #0000AA B"});
<?php
$re=0;
foreach($Columns as $column){
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Asset Tag',formatHeader);
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Asset',formatHeader);
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Serial Number',formatHeader);
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Plate Number',formatHeader);
	<?php
	$re++;
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Vendor Name',formatHeader);
	<?php
	$re++;	
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Purchase Order',formatHeader);
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Invoice Number',formatHeader);
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Purchase Cost',formatHeader);
	<?php
	$re++;	
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Purchase Date',formatHeader);
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Start Date',formatHeader);
	<?php
	$re++;
	}
	
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Depreciable Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Useful Life',formatHeader);
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Depreciation Frequency',formatHeader);
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Initial Value',formatHeader);
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Salvage Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Depreciation Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Total Accumulated Depreciation',formatHeader);
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Book Value',formatHeader);
	<?php
	$re++;
	}
}
?>

excel.set(0,0,undefined,30);
excel.set(0,1,undefined,20);
excel.set(0,2,undefined,30);
excel.set(0,3,undefined,20);
excel.set(0,4,undefined,20);
excel.set(0,5,undefined,20);
excel.set(0,6,undefined,20);
excel.set(0,7,undefined,20);
excel.set(0,8,undefined,20);
excel.set(0,9,undefined,20);
excel.set(0,10,undefined,20);
excel.set(0,11,undefined,20);
excel.set(0,12,undefined,20);
excel.set(0,13,undefined,20);
excel.set(0,14,undefined,20);
excel.set(0,15,undefined,20);
excel.set(0,16,undefined,20);
excel.set(0,17,undefined,20);
excel.set(0,18,undefined,20);
excel.set(0,19,undefined,20);

<?php
if($Type=="B1"){
	$WHERE="WHERE asset_type='$Value' AND asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' AND asset_approval='1' ORDER BY asset_description ASC";
	if($Value=="All"){
		$WHERE="WHERE asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' AND asset_approval='1' ORDER BY asset_description ASC";
	}
$getassetByType= mysqli_query($conn,"SELECT * FROM assets ".$WHERE);
$i=0;
while($result = mysqli_fetch_array($getassetByType)){
	$i++;
	$dpcode=$result['asset_department_code'];
	$getDept= mysqli_query($conn,"SELECT * FROM company_department WHERE department_code='$dpcode' ");
	$dd = mysqli_fetch_array($getDept);
	
	?>
<?php
$re=0;
foreach($Columns as $column){
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_tag']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_description']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_serial_number']; ?>',excel.addStyle( {align:"L",format: "# ?/?"}));
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['sku_code']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['vendor_number']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['purhase_order']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['invoice_number']; ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['purchase_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['purchase_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_date']!=""? date("m-d-Y", strtotime($result['depreciation_date'])) : ''; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['useful_life_span']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_frequency']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['initial_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['salvage_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depreciation_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value']-$result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
}
?>

	<?php
	/* $depriciable_value= $result['depriciable_value'];
	$depreciation_cost=$result['depreciation_cost'];
	if($result['depreciation_date']!=""){
		$date1=date_create($result['depreciation_date']." 8:00 ");
		$freq=$result['depreciation_frequency'];
		$useful_life_span=$result['useful_life_span'];
		for($c=1;$c<=12;$c++){
			$dayy=$date1->format('d');
			$Now=date('Y-'.$c.'-'.$dayy.' H:i:s');
			$date2=date_create($Now);
			$diff=date_diff($date1,$date2);
			$mo=$diff->format('%R');
			
			if($mo=="+"){
				if($freq=="Yearly"){
		
					$divident=$diff->format('%y');
					$current=$depriciable_value-($depreciation_cost*$divident);
					//echo $date2->format('Y-m-d')." = ".$current." ".$divident." ".$diff->format('%R')."<br>";
					?>
					excel.set(0,<?php echo $c+10; ?>,<?php echo $i; ?>,'<?php echo number_format($current); ?>',excel.addStyle( {align:"L"}));
					
					<?php
				}
				if($freq=="Monthly"){
					$divident=$diff->format('%m');
					$current=$depriciable_value-($depreciation_cost*$divident);
					if($divident>$useful_life_span){
						$current=0;
						break;
					}
					//echo $date2->format('Y-m-d')." = ".$current." ".$divident." ".$diff->format('%R')."<br>";
					?>
					excel.set(0,<?php echo $c+10; ?>,<?php echo $i; ?>,'<?php echo number_format($current); ?>',excel.addStyle( {align:"L"}));
					
					<?php
					
				}
				if($depreciation_frequency=="Hourly"){
		
					$divident=$diff->format('%h');
					$current=$depriciable_value-($depreciation_cost*$divident);
					//echo $date2->format('Y-m-d')." = ".$current." ".$divident." ".$diff->format('%R')."<br>";
					?>
					excel.set(0,<?php echo $c+10; ?>,<?php echo $i; ?>,'<?php echo number_format($current); ?>',excel.addStyle( {align:"L"}));
					
					<?php
				}
			}
		
		}
	} */
}
?>
excel.generate("Asset Depreciation Report By Asset Type "+today+".xlsx");
<?php
}
if($Type=="B2"){
	$WHERE="WHERE asset_location='$Value' AND asset_site='$Value2' AND asset_approval='1' AND asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' ORDER BY asset_description ASC";
	if($Value=="All"){
		$WHERE="WHERE asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' AND asset_approval='1' ORDER BY asset_description ASC";
	}
$getassetByType= mysqli_query($conn,"SELECT * FROM assets ".$WHERE);
$i=0;
while($result = mysqli_fetch_array($getassetByType)){
	$i++;
	$dpcode=$result['asset_department_code'];
	$getDept= mysqli_query($conn,"SELECT * FROM company_department WHERE department_code='$dpcode' ");
	$dd = mysqli_fetch_array($getDept);
	?>
<?php
$re=0;
foreach($Columns as $column){
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_tag']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_description']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_serial_number']; ?>',excel.addStyle( {align:"L",format: "# ?/?"}));
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['sku_code']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['vendor_number']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['purhase_order']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['invoice_number']; ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['purchase_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['purchase_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_date']!=""? date("m-d-Y", strtotime($result['depreciation_date'])) : ''; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['useful_life_span']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_frequency']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['initial_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['salvage_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depreciation_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value']-$result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
}
?>
	<?php
	/* $depriciable_value= $result['depriciable_value'];
	$depreciation_cost=$result['depreciation_cost'];
	if($result['depreciation_date']!=""){
		$date1=date_create($result['depreciation_date']." 8:00 ");
		$freq=$result['depreciation_frequency'];
		$useful_life_span=$result['useful_life_span'];
		for($c=1;$c<=12;$c++){
			$dayy=$date1->format('d');
			$Now=date('Y-'.$c.'-'.$dayy.' H:i:s');
			$date2=date_create($Now);
			$diff=date_diff($date1,$date2);
			$mo=$diff->format('%R');
			
			if($mo=="+"){
				if($freq=="Yearly"){
		
					$divident=$diff->format('%y');
					$current=$depriciable_value-($depreciation_cost*$divident);
					//echo $date2->format('Y-m-d')." = ".$current." ".$divident." ".$diff->format('%R')."<br>";
					?>
					excel.set(0,<?php echo $c+9; ?>,<?php echo $i; ?>,'<?php echo number_format($current); ?>',excel.addStyle( {align:"L"}));
					
					<?php
				}
				if($freq=="Monthly"){
					$divident=$diff->format('%m');
					$current=$depriciable_value-($depreciation_cost*$divident);
					if($divident>$useful_life_span){
						$current=0;
						break;
					}
					//echo $date2->format('Y-m-d')." = ".$current." ".$divident." ".$diff->format('%R')."<br>";
					?>
					console.log('<?php echo $c+9; ?> <?php echo number_format($current); ?>');
					excel.set(0,<?php echo $c+9; ?>,<?php echo $i; ?>,'<?php echo number_format($current); ?>',excel.addStyle( {align:"L"}));
					
					<?php
					
				}
				if($depreciation_frequency=="Hourly"){
		
					$divident=$diff->format('%h');
					$current=$depriciable_value-($depreciation_cost*$divident);
					//echo $date2->format('Y-m-d')." = ".$current." ".$divident." ".$diff->format('%R')."<br>";
					?>
					excel.set(0,<?php echo $c+9; ?>,<?php echo $i; ?>,'<?php echo number_format($current); ?>',excel.addStyle( {align:"L"}));
					
					<?php
				}
			}
		
		}
	} */
}
?>
excel.generate("Asset Depreciation Report By Location "+today+".xlsx");
<?php	
}
if($Type=="B3"){
	$WHERE="WHERE asset_department_code='$Value' AND asset_approval='1' AND asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' ORDER BY asset_description ASC";
if($Value=="All"){
	$WHERE="WHERE asset_transaction_status!='3' AND asset_transaction_status!='-1' AND asset_transaction_status!='-1.5' AND asset_approval='1' ORDER BY asset_description ASC";
}
$getassetByType= mysqli_query($conn,"SELECT * FROM assets ".$WHERE);
$i=0;
while($result = mysqli_fetch_array($getassetByType)){
	$i++;
	$dpcode=$result['asset_department_code'];
	$getDept= mysqli_query($conn,"SELECT * FROM company_department WHERE department_code='$dpcode' ");
	$dd = mysqli_fetch_array($getDept);
	?>
<?php
$re=0;
foreach($Columns as $column){
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_tag']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_description']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_serial_number']; ?>',excel.addStyle( {align:"L",format: "# ?/?"}));
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['sku_code']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['vendor_number']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['purhase_order']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['invoice_number']; ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['purchase_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['purchase_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_date']!=""? date("m-d-Y", strtotime($result['depreciation_date'])) : ''; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['useful_life_span']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_frequency']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['initial_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['salvage_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depreciation_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value']-$result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
}
?>
	<?php
	/* $depriciable_value= $result['depriciable_value'];
	$depreciation_cost=$result['depreciation_cost'];
	if($result['depreciation_date']!=""){
		$date1=date_create($result['depreciation_date']." 8:00 ");
		$freq=$result['depreciation_frequency'];
		$useful_life_span=$result['useful_life_span'];
		for($c=1;$c<=12;$c++){
			$dayy=$date1->format('d');
			$Now=date('Y-'.$c.'-'.$dayy.' H:i:s');
			$date2=date_create($Now);
			$diff=date_diff($date1,$date2);
			$mo=$diff->format('%R');
			
			if($mo=="+"){
				if($freq=="Yearly"){
		
					$divident=$diff->format('%y');
					$current=$depriciable_value-($depreciation_cost*$divident);
					//echo $date2->format('Y-m-d')." = ".$current." ".$divident." ".$diff->format('%R')."<br>";
					?>
					excel.set(0,<?php echo $c+9; ?>,<?php echo $i; ?>,'<?php echo number_format($current); ?>',excel.addStyle( {align:"L"}));
					
					<?php
				}
				if($freq=="Monthly"){
					$divident=$diff->format('%m');
					$current=$depriciable_value-($depreciation_cost*$divident);
					if($divident>$useful_life_span){
						$current=0;
						break;
					}
					//echo $date2->format('Y-m-d')." = ".$current." ".$divident." ".$diff->format('%R')."<br>";
					?>
					excel.set(0,<?php echo $c+9; ?>,<?php echo $i; ?>,'<?php echo number_format($current); ?>',excel.addStyle( {align:"L"}));
					
					<?php
					
				}
				if($depreciation_frequency=="Hourly"){
		
					$divident=$diff->format('%h');
					$current=$depriciable_value-($depreciation_cost*$divident);
					//echo $date2->format('Y-m-d')." = ".$current." ".$divident." ".$diff->format('%R')."<br>";
					?>
					excel.set(0,<?php echo $c+9; ?>,<?php echo $i; ?>,'<?php echo number_format($current); ?>',excel.addStyle( {align:"L"}));
					
					<?php
				}
			}
		
		}
	} */
}
?>
excel.generate("Asset Depreciation Report By Department "+today+".xlsx");
<?php	
}

	
}
if($Type=='C1'){
?>
var excel = $JExcel.new("Calibri light 10 #333333");
excel.set( {sheet:0,value:"<?php echo $Value; ?>" } );

var formatHeader=excel.addStyle ( { 												
border: "none,none,none,thin #333333", 												
font: "Calibri 12 #0000AA B"});
<?php
	$getauditdate= mysqli_query($conn,"SELECT * FROM audit WHERE audit_window_name='$Value' ");
	$q = mysqli_fetch_array($getauditdate);
?>
excel.set(0,0,0,'<?php echo "Audit Name : ".$Value; ?>');
<?php
$Auditor=$q['auditor'];
$getAuditorName= mysqli_query($conn,"SELECT * FROM employee_info WHERE employee_id='$Auditor' ");
$Adut= mysqli_fetch_array($getAuditorName);
?>
excel.set(0,0,1,'<?php echo "Audit Date : ".date("m-d-Y", strtotime($q['audit_date'])); ?>');	
excel.set(0,0,2,'<?php echo "Auditor : ".$Adut['fname']." ".$Adut['mname']." ".$Adut['lname']; ?>');	
excel.set(0,1,0,'<?php echo "Location : ".$q['audit_location']; ?>');	
excel.set(0,1,1,'<?php echo "Site : ".$q['audit_site']; ?>');	
excel.set(0,1,2,'<?php echo "Note : ".$q['audit_note']; ?>');
excel.set(0,0,undefined,30);
excel.set(0,1,undefined,20);
excel.set(0,2,undefined,20);
excel.set(0,3,undefined,20);
excel.set(0,4,undefined,30);
excel.set(0,5,undefined,20);
excel.set(0,6,undefined,20);
excel.set(0,7,undefined,20);
excel.set(0,8,undefined,20);
excel.set(0,9,undefined,20);
excel.set(0,10,undefined,20);
excel.set(0,11,undefined,20);
excel.set(0,12,undefined,20);
excel.set(0,13,undefined,20);
excel.set(0,14,undefined,20);
excel.set(0,15,undefined,20);
excel.set(0,16,undefined,20);
excel.set(0,17,undefined,20);
excel.set(0,18,undefined,20);
excel.set(0,19,undefined,20);
excel.set(0,20,undefined,20);
excel.set(0,21,undefined,20);
<?php
$re=0;
foreach($Columns as $column){
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Asset Tag',formatHeader);
	<?php
	$re++;
	}
	if($column=="Description"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Description',formatHeader);
	<?php
	$re++;
	}
	if($column=="Category"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Category',formatHeader);
	<?php
	$re++;
	}
	if($column=="Sub Category"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Sub Category',formatHeader);
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Serial Number',formatHeader);	
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Plate Number',formatHeader);
	<?php
	$re++;
	}
	if($column=="Assigned To"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Assigned To',formatHeader);
	<?php
	$re++;
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Vendor Name',formatHeader);
	<?php
	$re++;	
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Purchase Order',formatHeader);
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Invoice Number',formatHeader);
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Purchase Cost',formatHeader);
	<?php
	$re++;	
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Start Date',formatHeader);
	<?php
	$re++;
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Purchase Date',formatHeader);
	<?php
	$re++;
	}
	

	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Depreciable Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Useful Life',formatHeader);
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Depreciation Frequency',formatHeader);
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Initial Value',formatHeader);
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Salvage Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Depreciation Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Total Accumulated Depreciation',formatHeader);
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Book Value',formatHeader);
	<?php
	$re++;
	}
	if($column=="Transaction"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Transaction',formatHeader);
	<?php
	$re++;
	}
	if($column=="Requested By"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Requested By',formatHeader);	
	<?php
	$re++;
	}
	if($column=="Status"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Status',formatHeader);
	<?php
	$re++;
	}
	if($column=="Action"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Action',formatHeader);			
	<?php
	$re++;
	}
	if($column=="Note"){
	?>
	excel.set(0,<?php echo $re; ?>,4,'Note',formatHeader);
	<?php
	$re++;
	}
}
?>
<?php
$WHERE="WHERE audit_window_name='$Value' AND audit_status='1' ORDER BY asset_description ASC";
	
$getassetByType= mysqli_query($conn,"SELECT * FROM audit JOIN assets ON audit.audit_asset_tag=assets.asset_tag ".$WHERE);
$i=4;
while($result = mysqli_fetch_array($getassetByType)){
$i++;
$Desc222=$result['asset_description'];
$Cat222=$result['asset_category_name'];
$Sub222=$result['asset_sub_category'];
$sssswe= mysqli_query($conn,"SELECT * FROM asset_setup WHERE asset_setup_description='$Desc222' AND asset_setup_ac='$Cat222' AND asset_setup_sc='$Sub222'");
$ssss = mysqli_fetch_array($sssswe);
?>
<?php
$re=0;
foreach($Columns as $column){
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['audit_asset_tag']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Description"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_description']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Category"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $ssss['asset_setup_category'];  ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Sub Category"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $ssss['asset_setup_sub_cat'];  ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_serial_number']; ?>',excel.addStyle( {align:"L",format: "# ?/?"}));
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['sku_code']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Assigned To"){
	
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['assigned_to_temp']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['vendor_number']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['purhase_order']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['invoice_number']; ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['purchase_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_date']!=""? date("m-d-Y", strtotime($result['depreciation_date'])) : ''; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['purchase_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['useful_life_span']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_frequency']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['initial_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['salvage_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depreciation_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value']-$result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Transaction"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['transaction']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Requested By"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['requestor']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Status"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php 
					if($result['audit_check']=="1"){
						echo "FOUND";
					}
					if($result['audit_check']=="2"){
						echo "ASSET UNASSIGNED TO THESE LOCATION";
					}
					if($result['audit_check']=="0"){
						echo "NOT FOUND";
					}
					
					?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Action"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['audit_action']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Note"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['audit_action_note']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
}
?>
<?php
}

?>
excel.generate("Audit Report<?php echo "(".$Value.")"; ?> "+today+".xlsx");
<?php	
}
if($Type=='D1' || $Type=='D2' || $Type=='D3' || $Type=='D4'){
?>
var excel = $JExcel.new("Calibri light 10 #333333");
excel.set( {sheet:0,value:"Report" } );

var formatHeader=excel.addStyle ( { 												
border: "none,none,none,thin #333333", 												
font: "Calibri 12 #0000AA B"});
<?php
$re=0;
foreach($Columns as $column){
	if($column=="Ticket No."){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Ticket No.',formatHeader);
	<?php
	$re++;
	}
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Asset Tag',formatHeader);
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Asset',formatHeader);
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Serial Number',formatHeader);
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Plate Number',formatHeader);
	<?php
	$re++;
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Vendor Name',formatHeader);
	<?php
	$re++;
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Purchase Order',formatHeader);
	<?php
	$re++;
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Invoice Number',formatHeader);
	<?php
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Purchase Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Purchase Date',formatHeader);
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Start Date',formatHeader);
	<?php
	$re++;
	}
	
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Depreciable Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Useful Life',formatHeader);
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Depreciation Frequency',formatHeader);
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Initial Value',formatHeader);
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Salvage Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Depreciation Cost',formatHeader);
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Total Accumulated Depreciation',formatHeader);
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Book Value',formatHeader);
	<?php
	$re++;
	}
	if($column=="Requested By"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Requested By',formatHeader);
	<?php
	$re++;
	}
	if($column=="Borrow Date"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Borrow Date',formatHeader);
	<?php
	$re++;
	}
	if($column=="Due Date"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Due Date',formatHeader);
	<?php
	$re++;
	}
	if($column=="Status"){
	?>
	excel.set(0,<?php echo $re; ?>,0,'Status',formatHeader);
	<?php
	$re++;
	}
}
?>








excel.set(0,0,undefined,30);
excel.set(0,1,undefined,20);
excel.set(0,2,undefined,20);
excel.set(0,3,undefined,30);
excel.set(0,4,undefined,20);
excel.set(0,5,undefined,30);
excel.set(0,6,undefined,20);
excel.set(0,7,undefined,20);
excel.set(0,8,undefined,20);
excel.set(0,9,undefined,20);
excel.set(0,10,undefined,20);
excel.set(0,11,undefined,20);
excel.set(0,12,undefined,20);
excel.set(0,13,undefined,20);
excel.set(0,14,undefined,20);
excel.set(0,15,undefined,20);
excel.set(0,16,undefined,20);
excel.set(0,17,undefined,20);
excel.set(0,18,undefined,20);
excel.set(0,19,undefined,20);

var Red=excel.addStyle ( { 																	
	fill: "#d9534f" , 																
	border: "thin #333333,thin #333333,thin #333333,thin #333333"});
var Yellow=excel.addStyle ( { 																	
	fill: "#f0ad4e" , 																
	border: "thin #333333,thin #333333,thin #333333,thin #333333"});
var Green=excel.addStyle ( { 																	
	fill: "#5cb85c" , 																
	border: "thin #333333,thin #333333,thin #333333,thin #333333"});
<?php
if($Type=="D1"){
$WHERE="WHERE asset_type='$Value' AND asset_approval='1' AND (asset_transaction_status='2' OR asset_transaction_status='1.1' OR asset_transaction_status='1.2') AND (request_status='2' OR request_status='1.1')";
	if($Value=="All"){
		$WHERE="WHERE (asset_transaction_status='2' OR asset_transaction_status='1.1' OR asset_transaction_status='1.2') AND asset_approval='1' AND (request_status='2' OR request_status='1.1')";
	}
$getassetByType= mysqli_query($conn,"SELECT * FROM assets JOIN asset_request ON assets.asset_tag=asset_request.asset_tag ".$WHERE);
$i=0;
while($result = mysqli_fetch_array($getassetByType)){
	$i++;
	$dpcode=$result['emp_id'];
	$getDept= mysqli_query($conn,"SELECT * FROM employee_info WHERE employee_id='$dpcode' ");
	$dd = mysqli_fetch_array($getDept);
	$date1=date_create($result['asset_due_date']);
	$date2=date_create(date("Y-m-d"));
	$diff=date_diff($date1,$date2);
	$row=$diff->format("%R");
	?>
<?php
$re=0;
foreach($Columns as $column){
	if($column=="Ticket No."){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['request_id']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_tag']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_description']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_serial_number']; ?>',excel.addStyle( {align:"L",format: "# ?/?"}));
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['sku_code']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['vendor_number']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['purhase_order']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['invoice_number']; ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['purchase_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['purchase_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_date']!=""? date("m-d-Y", strtotime($result['depreciation_date'])) : ''; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['useful_life_span']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_frequency']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['initial_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['salvage_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depreciation_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value']-$result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Requested By"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $dd['fname']." ".$dd['mname']." ".$dd['lname']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Borrow Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['asset_borrow_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Due Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['asset_due_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Status"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'',<?php if($result['request_status']=="2" || $result['request_status']=="1.1"){if($row=="-"){echo 'Yellow';}else{echo 'Red';}}else{echo 'Green';}?>,excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
}
?>
<?php
}
?>
excel.generate("Check Out Report By Asset Type "+today+".xlsx");
<?php		
}
if($Type=="D2"){
	$WHERE="WHERE asset_location='$Value' AND asset_site='$Value2' AND (asset_transaction_status='2' OR asset_transaction_status='1.1' OR asset_transaction_status='1.2') AND asset_approval='1' AND (request_status='2' OR request_status='1.1')";
			if($Value=="All"){
				$WHERE="WHERE (asset_transaction_status='2' OR asset_transaction_status='1.1' OR asset_transaction_status='1.2') AND asset_approval='1' AND (request_status='2' OR request_status='1.1')";
			}
		$getassetByType= mysqli_query($conn,"SELECT * FROM assets JOIN asset_request ON assets.asset_tag=asset_request.asset_tag ".$WHERE);
		$i=0;
		while($result = mysqli_fetch_array($getassetByType)){
		$i++;
			$dpcode=$result['emp_id'];
			$getDept= mysqli_query($conn,"SELECT * FROM employee_info WHERE employee_id='$dpcode' ");
			$dd = mysqli_fetch_array($getDept);
			$date1=date_create($result['asset_due_date']);
			$date2=date_create(date("Y-m-d"));
			$diff=date_diff($date1,$date2);
			$row=$diff->format("%R");
		?>
		<?php
$re=0;
foreach($Columns as $column){
	if($column=="Ticket No."){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['request_id']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_tag']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_description']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_serial_number']; ?>',excel.addStyle( {align:"L",format: "# ?/?"}));
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['sku_code']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['vendor_number']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['purhase_order']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['invoice_number']; ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['purchase_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['purchase_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_date']!=""? date("m-d-Y", strtotime($result['depreciation_date'])) : ''; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['useful_life_span']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_frequency']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['initial_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['salvage_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depreciation_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value']-$result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Requested By"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $dd['fname']." ".$dd['mname']." ".$dd['lname']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Borrow Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['asset_borrow_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Due Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['asset_due_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Status"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'',<?php if($result['request_status']=="2" || $result['request_status']=="1.1"){if($row=="-"){echo 'Yellow';}else{echo 'Red';}}else{echo 'Green';}?>,excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
}
?>
		<?php
		}
	?>
	excel.generate("Check Out Report By Location "+today+".xlsx");
	<?php
}
if($Type=="D3"){
	$WHERE="WHERE asset_department_code='$Value' AND (asset_transaction_status='2' OR asset_transaction_status='1.1' OR asset_transaction_status='1.2') AND asset_approval='1' AND (request_status='2' OR request_status='1.1')";
	if($Value=="All"){
		$WHERE="WHERE (asset_transaction_status='2' OR asset_transaction_status='1.1' OR asset_transaction_status='1.2') AND asset_approval='1'  AND (request_status='2' OR request_status='1.1')";
	}
$getassetByType= mysqli_query($conn,"SELECT * FROM assets JOIN asset_request ON assets.asset_tag=asset_request.asset_tag ".$WHERE);
$i=0;
while($result = mysqli_fetch_array($getassetByType)){
	$i++;
			$dpcode=$result['emp_id'];
			$getDept= mysqli_query($conn,"SELECT * FROM employee_info WHERE employee_id='$dpcode' ");
			$dd = mysqli_fetch_array($getDept);
			$date1=date_create($result['asset_due_date']);
			$date2=date_create(date("Y-m-d"));
			$diff=date_diff($date1,$date2);
			$row=$diff->format("%R");
		?>
		<?php
$re=0;
foreach($Columns as $column){
	if($column=="Ticket No."){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['request_id']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Asset Tag"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_tag']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Asset"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_description']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Serial Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['asset_serial_number']; ?>',excel.addStyle( {align:"L",format: "# ?/?"}));
	<?php
	$re++;
	}
	if($column=="Plate Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['sku_code']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Vendor Name"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['vendor_number']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Purchase Order"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['purhase_order']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;	
	}
	if($column=="Invoice Number"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['invoice_number']; ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['purchase_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php	
	$re++;
	}
	if($column=="Purchase Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['purchase_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Start Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_date']!=""? date("m-d-Y", strtotime($result['depreciation_date'])) : ''; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciable Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Useful Life"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['useful_life_span']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Frequency"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $result['depreciation_frequency']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Initial Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['initial_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Salvage Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['salvage_value'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Depreciation Cost"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depreciation_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Total Accumulated Depreciation"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['depriciable_value']-$result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Book Value"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo number_format($result['current_cost'],2); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Requested By"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo $dd['fname']." ".$dd['mname']." ".$dd['lname']; ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Borrow Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['asset_borrow_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Due Date"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'<?php echo date("m-d-Y", strtotime($result['asset_due_date'])); ?>',excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
	if($column=="Status"){
	?>
	excel.set(0,<?php echo $re; ?>,<?php echo $i; ?>,'',<?php if($result['request_status']=="2" || $result['request_status']=="1.1"){if($row=="-"){echo 'Yellow';}else{echo 'Red';}}else{echo 'Green';}?>,excel.addStyle( {align:"L"}));
	<?php
	$re++;
	}
}
?>
		<?php
}
?>
excel.generate("Check Out Report By Department "+today+".xlsx");
<?php
}

	
	
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
