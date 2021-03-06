<table class="table" style="width:3000px" id="ReportTable">
    <thead>
        <tr>
            <th colspan="21" style="font-weight:bold;font-size:25px;"><?php echo $ReportKind; ?></th>
        </tr>
        <?php
        if($Type=="B2"){
            if($value!="All"){
            ?>
            <tr>
                <th colspan="21" style="font-weight:bold;font-size:25px;"><?php echo $value."-".$value2; ?></th>
            </tr>
            <?php
            }
        }
        ?>
        <?php
        if($Type=="B3"){
        ?>
        <tr>
            <th colspan="21" style="font-weight:bold;font-size:25px;"><?php echo $dept; ?></th>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="21" style="text-align:left;font-weight:bold;"><?php echo "Date : ".date("m-d-Y"); ?></td>
        </tr>
    </thead>
    <tbody>
        
        <tr>
            <?php
            foreach($Columns as $column){
                if($column=="Asset Tag"){
                ?>
                <th>Asset Tag</th>
                <?php
                }
                if($column=="Asset"){
                ?>
                <th>Asset</th>
                <?php
                }
                if($column=="Department"){
                
                ?>
                <th>Department</th>
                <?php
                
                }
                if($column=="Location"){
                
                ?>
                <th>Location</th>
                <?php
                
                }
                if($column=="Site"){
                
                ?>
                <th>Site</th>
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
                if($column=="Purchase Date"){
                ?>
                <th>Purchase Date</th>
                <?php
                }
                if($column=="Start Date"){
                ?>
                <th>Start Date</th>
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
            }
            ?>
        </tr>
        <?php 
        if($Type==$Type){
        
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
                <?php
        
                $ViewAssetDesc=$result->asset_description;
               
                ?>
                @foreach ($asset_setup_lists as $setup)
                    @if ($setup->asset_setup_ad==$ViewAssetDesc)
                    <?php 
                    $ViewAssetDesc=$setup->asset_setup_description;
                    ?>
                    @endif
                   
                @endforeach
                <td style="vertical-align:middle;"><?php echo $ViewAssetDesc; ?></td>
                <?php
                }
                if($column=="Department"){
                
                ?>
                <td><?php echo $result->department_name; ?></td>
                <?php
                
                }
                if($column=="Location"){
                
                ?>
                <td><?php echo $result->asset_location; ?></td>
                <?php
                
                }
                if($column=="Site"){
                
                ?>
                <td><?php echo $result->asset_site; ?></td>
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
            }
            ?>
        </tr>
        <?php
        }	
        }
        
        
        ?>
    </tbody>
</table>