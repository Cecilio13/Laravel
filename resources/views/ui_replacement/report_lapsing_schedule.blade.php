<table class="table table-bordered" style="width:5000px" id="ReportTable">
	<thead >
		<tr >
			<th colspan="31" style="font-weight:bold;font-size:25px;border-bottom: 1px solid white;"><?php echo $ReportKind; ?></th>
		</tr>
		<tr >
			<td colspan="31" style="text-align:left;font-weight:bold;"><?php echo "Date : ".date("m-d-Y"); ?></td>
		</tr>
	</thead>
	<tbody>
		
		<tr>
			<?php
			foreach($Columns as $column){
				if($column=="Asset Tag"){
				?>
				<th width="15">Asset Tag</th>
				<?php
				}
				if($column=="Asset"){
				?>
				<th width="15">Asset</th>
				<?php
				}
				if($column=="Serial Number"){
				?>
				<th width="15">Serial Number</th>
				<?php
				}
				if($column=="Plate Number"){
				?>
				<th width="15">Plate Number</th>
				<?php
				}
				if($column=="Vendor Name"){
				?>
				<th width="15">Vendor Name</th>
				<?php	
				}
				if($column=="Purchase Order"){
				?>
				<th width="15">Purchase Order</th>
				<?php	
				}
				if($column=="Invoice Number"){
				?>
				<th width="15">Invoice Number</th>
				<?php	
				}
				if($column=="Purchase Cost"){
				?>
				<th width="15">Purchase Cost</th>
				<?php	
				}
				if($column=="Purchase Date"){
				?>
				<th width="15">Purchase Date</th>
				<?php
				}
				if($column=="Start Date"){
				?>
				<th width="15">Start Date</th>
				<?php
				}
				
				if($column=="Depreciation Frequency"){
				?>
				<th width="15">Depreciation Frequency</th>
				<?php
				}
				if($column=="Useful Life"){
				?>
				<th width="15">Useful Life</th>
				<?php
				}
				
				if($column=="Initial Value"){
				?>
				<th width="15">Initial Value</th>
				<?php
				}
				if($column=="Salvage Cost"){
				?>
				<th width="15">Salvage Cost</th>
				<?php
				}
				if($column=="Depreciable Cost"){
				?>
				<th width="15">Depreciable Cost</th>
				<?php
				}
				if($column=="Depreciation Cost"){
				?>
				<th width="15">Depreciation Cost</th>
				<?php
				}
			}
			?>
			
			<th width="15"><?php echo "Jan. ".date('Y'); ?></th>
			<th width="15"><?php echo "Feb. ".date('Y'); ?></th>
			<th width="15"><?php echo "March ".date('Y'); ?></th>
			<th width="15"><?php echo "April ".date('Y'); ?></th>
			<th width="15"><?php echo "May ".date('Y'); ?></th>
			<th width="15"><?php echo "June ".date('Y'); ?></th>
			<th width="15"><?php echo "July ".date('Y'); ?></th>
			<th width="15"><?php echo "August ".date('Y'); ?></th>
			<th width="15"><?php echo "Sept. ".date('Y'); ?></th>
			<th width="15"><?php echo "Oct. ".date('Y'); ?></th>
			<th width="15"><?php echo "Nov. ".date('Y'); ?></th>
			<th width="15"><?php echo "Dec. ".date('Y'); ?></th>
			<th width="15"><?php echo "Total Accumulated Depreciation (".date('Y').")"; ?></th>
			<th width="15">Total Accumulated Depreciation</th>
			<th width="15">Book Value</th>
		</tr>
		<?php 
		
		foreach($asset_list as $result){
			
		?>
		<tr>
			<?php
			foreach($Columns as $column){
				if($column=="Asset Tag"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->asset_tag; ?></td>
				<?php
				}
				if($column=="Asset"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->asset_description; ?></td>
				<?php
				}
				if($column=="Serial Number"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->asset_serial_number; ?></td>
				<?php
				}
				if($column=="Plate Number"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->sku_code; ?></td>
				<?php
				}
				if($column=="Vendor Name"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->vendor_number; ?></td>
				<?php	
				}
				if($column=="Purchase Order"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->PO; ?></td>
				<?php	
				}
				if($column=="Invoice Number"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->invoice_number; ?></td>
				<?php	
				}
				if($column=="Purchase Cost"){
				?>
				<td style="vertical-align:middle;"><?php echo number_format($result->purchase_cost,2); ?></td>
				<?php	
				}
				if($column=="Purchase Date"){
				?>
				<td style="vertical-align:middle;"><?php echo date("m-d-Y", strtotime($result->purchase_date)); ?></td>
				<?php
				}
				if($column=="Start Date"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->depreciation_date!=""? date("m-d-Y", strtotime($result->depreciation_date)) : ''; ?></td>
				<?php
				}
				
				if($column=="Depreciation Frequency"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->depreciation_frequency; ?></td>
				<?php
				}
				if($column=="Useful Life"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->useful_life_span; ?></td>
				<?php
				}
				
				if($column=="Initial Value"){
				?>
				<td style="vertical-align:middle;"><?php echo number_format($result->initial_value,2); ?></td>
				<?php
				}
				if($column=="Salvage Cost"){
				?>
				<td style="vertical-align:middle;"><?php echo number_format($result->salvage_value,2); ?></td>
				<?php
				}
				if($column=="Depreciable Cost"){
				?>
				<td style="vertical-align:middle;"><?php echo number_format($result->depriciable_value,2); ?></td>
				<?php
				}
				if($column=="Depreciation Cost"){
				?>
				<td style="vertical-align:middle;"><?php echo number_format($result->depreciation_cost,2); ?></td>
				<?php
				}
			}
			?>
			<?php
			$depriciable_value= $result->depriciable_value;
			$depreciation_cost=$result->depreciation_cost;
			if($result->depreciation_date!=""){
				$date1=date_create($result->depreciation_date." 8:00 ");
				$freq=$result->depreciation_frequency;
				$useful_life_span=$result->useful_life_span;
				$Now2=date('m');
				$csc=0;
				$totalaccumulateddepreciation=0;
				for($c=1;$c<=$Now2-1;$c++){
					
					$dayy=$date1->format('d');
					$Now=date('Y-'.$c.'-d 8:00');//note to self end of month
					$date2=date_create($Now);
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
							<td style="vertical-align:middle;"><?php echo number_format($depreciation_cost,2); ?></td>
							
							<?php
						}
						if($freq=="Monthly"){
							$divident=$diff->format('%m');
							//echo $result->asset_tag'].$date2->format('%m')." <br>";
							$divident=$divident+($diff->format('%y')*12);
							
							$current=$depriciable_value-($depreciation_cost*($divident+1));
							
							if($divident>$useful_life_span){
								for($c2=$c;$c2<=12;$c2++){
									echo "<td></td>";
									$csc=1;
								}
								$current=0;
								break;
							}
							if($current<0){
							?>
							<td style="vertical-align:middle;"></td>
							<?php
							
							}else{
							    if($dayy>15){
							       
							        if($date1->format('Y-m')==$date2->format('Y-m')){
							          ?>
                                	  <td style="vertical-align:middle;"></td> 
                                	 <?php   
							            
							        }else{
							            $totalaccumulateddepreciation=$totalaccumulateddepreciation+$depreciation_cost;
							            ?>
            							<td style="vertical-align:middle;"><?php echo number_format($depreciation_cost,2); ?></td>
            							<?php
							        }
							       
                            	    
                            	}else{
    								$totalaccumulateddepreciation=$totalaccumulateddepreciation+$depreciation_cost;
    								
    							?>
    							<td style="vertical-align:middle;"><?php echo number_format($depreciation_cost,2); ?></td>
    							<?php
                            	}
							}
							//echo $current."=".$depriciable_value."-(".$depreciation_cost."*(".$divident."+1))"."<br>";
							?>
							
							<td style="vertical-align:middle;display:none"><?php echo $current." DIV".$divident." Cost: ".$depreciation_cost." Vlaue : ".$depriciable_value; ?></td>
							
							<?php
							
						}
						if($depreciation_frequency=="Hourly"){
				
							$divident=$diff->format('%h');
							$current=$depriciable_value-($depreciation_cost*$divident);
							$totalaccumulateddepreciation=$totalaccumulateddepreciation+$depreciation_cost;
							//echo $date2->format('Y-m-d')." = ".$current." ".$divident." ".$diff->format('%R')."<br>";
							?>
							<td style="vertical-align:middle;"><?php echo number_format($depreciation_cost,2); ?></td>
							
							<?php
						}
					}else{
						 if($mor=="0"){
							
							 $totalaccumulateddepreciation=$totalaccumulateddepreciation+$depreciation_cost;
							            ?>
            							<td style="vertical-align:middle;"><?php echo number_format($depreciation_cost,2); ?></td>
            							<?php
						}else{
						echo "<td></td>";
						}
					}
				
				}
				if($csc!=1){
					
					
				for($s=$Now2-1;$s<12;$s++){
					echo "<td></td>";
					
				}
				}
				$accumulated=$depriciable_value-$result->current_cost;
				if($accumulated<0){
					$accumulated=0;
					
				}
				?>
				<td style="vertical-align:middle;" ><?php echo number_format($totalaccumulateddepreciation,2); ?></td>
				<td style="vertical-align:middle;" ><?php echo number_format($result->depriciable_value-$result->current_cost,2); ?></td>
				<td style="vertical-align:middle;" ><?php echo number_format($result->current_cost,2); ?></td>
				
				<?php
			}else{
				for($c=1;$c<=12;$c++){
					echo "<td></td>";	
					
				}
				echo "<td></td>";
			}
			?>
			
			
		</tr>
		<?php
		}
		
		?>
	</tbody>
</table>