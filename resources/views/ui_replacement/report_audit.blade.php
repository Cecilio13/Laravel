<table class="table" style="width:3000px" id="ReportTable" >
    <thead>
        <tr>
            <th colspan="30" style="font-weight:bold;font-size:25px;"><?php echo $ReportKind; ?></th>
        </tr>
    </thead>
    <tbody>
       
        <tr >
            <td colspan="2" style="border:0px solid black;"><?php echo "<b>Audit Name :</b> ".$value; ?></td>
            <td colspan="5" style="border:0px solid black;"><?php echo "<b>Location :</b> ".!empty($audit_info)? $audit_info[0]->audit_location : ''; ?></td>
        </tr>
        <tr >
            <td colspan="2" style="border:0px solid black;"><?php echo "<b>Audit Date :</b> ".!empty($audit_info)? date("m-d-Y", strtotime($audit_info[0]->audit_date)) : ''; ?></td>
            <td colspan="5" style="border:0px solid black;"><?php echo "<b>Site :</b> ".!empty($audit_info)? $audit_info[0]->audit_site : ''; ?></td>
        </tr>
        <tr >
            <td colspan="2"style="border:0px solid black;" ><?php echo "<b>Auditor : </b>".!empty($audit_info)? ($audit_info[0]->name) : ''; ?></td>
            <td colspan="5"style="border:0px solid black;" ><?php echo "<b>Note : </b>".!empty($audit_info)? $audit_info[0]->audit_note : ''; ?></td>
        </tr>
        
        <tr>
            <?php
            foreach($Columns as $column){
                if($column=="Asset Tag"){
                ?>
                <th>Asset Tag</th>
                <?php
                }
                if($column=="Description"){
                ?>
                <th>Description</th>
                <?php
                }
                if($column=="Category"){
                ?>
                <th>Category</th>
                <?php
                }
                if($column=="Sub Category"){
                ?>
                <th>Sub Category</th>
                <?php
                }
                if($column=="Serial Number"){
                ?>
                <th>Serial Number</th>
                <?php
                }
                if($column=="Plate Number"){
                ?>
                <th>Plate Number</th>
                <?php
                }
                if($column=="Assigned To"){
                ?>
                <th>Assigned To</th>
                <?php
                }
                if($column=="Vendor Name"){
                ?>
                <th>Vendor Name</th>
                <?php	
                }
                if($column=="Purchase Order"){
                ?>
                <th>Purchase Order</th>
                <?php	
                }
                if($column=="Invoice Number"){
                ?>
                <th>Invoice Number</th>
                <?php	
                }
                if($column=="Purchase Cost"){
                ?>
                <th>Purchase Cost</th>
                <?php	
                }
                if($column=="Start Date"){
                ?>
                <th>Start Date</th>
                <?php
                }
                if($column=="Purchase Date"){
                ?>
                <th>Purchase Date</th>
                <?php
                }
                if($column=="Depreciation Frequency"){
                ?>
                <th >Depreciation Frequency</th>
                <?php
                }
                if($column=="Useful Life"){
                ?>
                <th >Useful Life</th>
                <?php
                }
                
                if($column=="Initial Value"){
                ?>
                <th >Initial Value</th>
                <?php
                }
                if($column=="Salvage Cost"){
                ?>
                <th >Salvage Cost</th>
                <?php
                }
                if($column=="Depreciable Cost"){
                ?>
                <th >Depreciable Cost</th>
                <?php
                }
                if($column=="Depreciation Cost"){
                ?>
                <th >Depreciation Cost</th>
                <?php
                }
                if($column=="Total Accumulated Depreciation"){
                ?>
                <th >Total Accumulated Depreciation</th>
                <?php
                }
                if($column=="Book Value"){
                ?>
                <th>Book Value</th>
                <?php
                }
                if($column=="Transaction"){
                ?>
                <th>Transaction</th>
                <?php
                }
                if($column=="Requested By"){
                ?>
                <th>Requested By</th>
                <?php
                }
                if($column=="Status"){
                ?>
                <th>Status</th>
                <?php
                }
                if($column=="Action"){
                ?>
                <th>Action</th>
                <?php
                }
                if($column=="Note"){
                ?>
                <th>Note</th>
                <?php
                }
            }
            ?>
        </tr>
        <?php 
		if($Type=="C1"){
		
		foreach($getassetByType as $result){
			
        ?>
        <?php
        
        $ViewAssetDesc=$result->asset_description;
        $ViewAssetCategoryName=$result->asset_category_name;
        $CategoryNameFull=$ViewAssetCategoryName;
        $ViewAssetSub=$result->asset_sub_category;
        ?>
        @foreach ($asset_setup_lists as $setup)
            @if ($setup->asset_setup_ad==$ViewAssetDesc)
            <?php 
            $ViewAssetDesc=$setup->asset_setup_description;
            ?>
            @endif
            @if ($setup->asset_setup_ac==$ViewAssetCategoryName)
            <?php 
            $CategoryNameFull=$setup->asset_setup_category;
            ?> 
            @endif
            @if ($setup->asset_setup_sc==$ViewAssetSub)
            <?php 
            $ViewAssetSub=$setup->asset_setup_sub_cat;
            ?> 
            @endif
        @endforeach
		<tr>
			<?php
			foreach($Columns as $column){
				if($column=="Asset Tag"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->audit_asset_tag; ?></td>
				<?php
				}
				if($column=="Description"){
				?>
				<td style="vertical-align:middle;"><?php echo $ViewAssetDesc; ?></td>
				<?php
				}
				if($column=="Category"){
				?>
				<td style="vertical-align:middle;"><?php echo $CategoryNameFull; ?></td>
				<?php
				}
				if($column=="Sub Category"){
				?>
				<td style="vertical-align:middle;"><?php echo $ViewAssetSub; ?></td>
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
				if($column=="Assigned To"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->assigned_to_temp; ?></td>
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
				if($column=="Start Date"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->depreciation_date!=""? date("m-d-Y", strtotime($result->depreciation_date)) : ''; ?></td>
				<?php
				}
				if($column=="Purchase Date"){
				?>
				<td style="vertical-align:middle;"><?php echo date("m-d-Y", strtotime($result->purchase_date)); ?></td>
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
				if($column=="Total Accumulated Depreciation"){
    				?>
    				<td style="vertical-align:middle;"><?php echo number_format($result->depriciable_value-$result->current_cost,2); ?></td>
    				<?php
    				}
        			if($column=="Book Value"){
    				?>
    				<td style="vertical-align:middle;"><?php echo number_format($result->current_cost,2); ?></td>
    				<?php
    				}
				if($column=="Transaction"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->transaction; ?></td>
				<?php
				}
				if($column=="Requested By"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->requestor; ?></td>
				<?php
				}
				if($column=="Status"){
				?>
				<td style="vertical-align:middle;"><?php 
				if($result->audit_check=="1"){
					echo "FOUND";
				}
				if($result->audit_check=="2"){
					echo "ASSET UNASSIGNED TO THIS LOCATION";
				}
				if($result->audit_check=="0"){
					echo "NOT FOUND";
				}
				
				?></td>
				<?php
				}
				if($column=="Action"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->audit_action; ?></td>
				<?php
				}
				if($column=="Note"){
				?>
				<td style="vertical-align:middle;"><?php echo $result->audit_action_note; ?></td>
				<?php
				}
			}
			?>
		</tr>
		<?php
		}
		}
		?>
    </tbody>
</table>