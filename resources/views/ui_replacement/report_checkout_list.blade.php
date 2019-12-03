<table class="table" style="width:3000px" id="ReportTable">
    <thead>
        <tr>
            <th colspan="30" style="font-weight:bold;font-size:25px;"><?php echo $ReportKind; ?></th>
        </tr>
        <?php
        if($Type=="D2"){
            if($value!="All"){
        ?>
        <tr>
            <th colspan="20" style="font-weight:bold;font-size:25px;"><?php echo $value."-".$value2; ?></th>
        </tr>
        <?php
            }
        }
        ?>
        <?php
        if($Type=="D3"){
        ?>
        <tr>
            <th colspan="20" style="font-weight:bold;font-size:25px;"><?php echo $dept; ?></th>
        </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="20" style="text-align:left;font-weight:bold;"><?php echo "Date : ".date("m-d-Y"); ?></td>
        </tr>
    </thead>
    <tbody>
        
        <tr>
            <?php
            foreach($Columns as $column){
                if($column=="Ticket No."){
                ?>
                <th>Ticket No.</th>
                <?php
                }
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
                if($column=="Requested By"){
                ?>
                <th>Requested By</th>
                <?php
                }
                if($column=="Borrow Date"){
                ?>
                <th>Borrow Date</th>
                <?php
                }
                if($column=="Due Date"){
                ?>
                <th>Due Date</th>
                <?php
                }
                if($column=="Status"){
                ?>
                <th>Status</th>
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
                if($column=="Ticket No."){
                ?>
                <td style="vertical-align: middle;"><?php echo $result->request_id; ?></td>
                <?php
                }
                if($column=="Asset Tag"){
                ?>
                <td style="vertical-align: middle;"><?php echo $result->ASSET_TAG; ?></td>
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
                <td style="vertical-align: middle;"><?php echo $ViewAssetDesc; ?></td>
                <?php
                }
                if($column=="Serial Number"){
                ?>
                <td style="vertical-align: middle;"><?php echo $result->asset_serial_number; ?></td>
                <?php
                }
                if($column=="Plate Number"){
                ?>
                <td style="vertical-align: middle;"><?php echo $result->sku_code; ?></td>
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
                if($column=="Start Date"){
                ?>
                <td style="vertical-align:middle;"><?php echo $result->depreciation_date!=""? date("m-d-Y", strtotime($result->depreciation_date)) : ''; ?></td>
                <?php
                }
                
                if($column=="Requested By"){
                ?>
                <td style="vertical-align: middle;"><?php echo $result->fname." ".$result->mname." ".$result->lname; ?></td>
                <?php
                }
                if($column=="Borrow Date"){
                ?>
                <td style="vertical-align: middle;"><?php echo date("m-d-Y", strtotime($result->asset_borrow_date)); ?></td>
                <?php
                }
                if($column=="Due Date"){
                ?>
                <td style="vertical-align: middle;"><?php echo date("m-d-Y", strtotime($result->asset_due_date)); ?></td>
                <?php
                }
                if($column=="Status"){
                ?>
                <td style="text-align:center;vertical-align: middle;">
                <?php
                    $date1=date_create($result->asset_due_date);
                    $date2=date_create(date("Y-m-d"));
                    $diff=date_diff($date1,$date2);
                    $row=$diff->format("%R");
                    if($result->request_status=="2" || $result->request_status=="1.1"){
                    if($row=="-"){
                    ?>
                    <button class="btn  btn-warning" style="color: #fff;background-color: #f0ad4e;border-color: #eea236;"><span class="fa fa-flag"></span></button>
                    <?php
                    }else{
                    ?>	
                    <button class="btn  btn-danger" style="color: #fff;background-color: #d9534f;border-color: #d43f3a;"><span class="fa fa-flag"></span></button>
                    <?php
                    }
                    }else{
                    ?>	
                    <button class="btn  btn-success" style="color: #fff;background-color: #5cb85c;border-color: #4cae4c;"><span class="fa fa-flag"></span></button>
                    <?php
                    }
                ?>
                
            </td>
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