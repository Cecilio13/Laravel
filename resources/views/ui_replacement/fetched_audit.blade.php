<div class="row" id="Audit-Equipment-Section">
    <div class="col-md-12">
        <table class="table table-hover table-sm" style="background-color:white;color:#083240;" id="AuditTable">
            <thead style="background-color:#124f62; color:white;">
            <tr style="background-color:#083240">
                <th colspan="12" style="text-align:center;">ASSET LIST</th>
            </tr>
            <tr>
                <th></th>
                <th>Asset Tag</th>
                <th>Asset</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Serial Number</th>
                <th>Department</th>
                <th>Site</th>
                <th>Location</th>
                <th>Status</th>
                <th>Employee</th>
            </tr>
            </thead>
            <tbody>
                <script>
                
                function cehckcheck(element,id){
                    var checkbox = $(element);
                    if (checkbox.is(":checked")) {
                        document.getElementById(id).style.display="none";
                        document.getElementById(id+"td").style.backgroundColor="#73d863";
                    } else {
                    // prevent from being unchecked
                        element.checked=!element.checked;
                        document.getElementById(id).style.display="none";
                        document.getElementById(id+"td").style.backgroundColor="#73d863";
                    }
                }
                </script>
            @foreach ($asset_by_location_and_site as $asset)
                <tr>
                    <td style="vertical-align: middle;" id="AUDITASSET<?php echo $asset->ASSET_ID; ?>td">
                        <label class="checkbox-inline" ><input type="checkbox" onclick="cehckcheck(this,'AUDITASSET<?php echo $asset->ASSET_ID; ?>')" id="AUDITASSET<?php echo $asset->ASSET_ID; ?>"  name="Processed" value="<?php echo $asset->ASSET_ID; ?>" style="margin-top:0px;bottom:30%;"> </label>
                        
                    </td>
                    <td style="vertical-align: middle;"><a onclick="ViewPendingAssets('<?php echo $asset->ASSET_ID; ?>')" class="btn btn-link" style="padding-left:0px;"><?php echo $asset->asset_tag; ?></a></td>
                    <?php 
                        $ViewAssetDesc="";
                    ?>
                    @foreach ($asset_description_grouped as $setup)
                        @if ($setup->asset_setup_ad==$asset->asset_description)
                        <?php 
                        $ViewAssetDesc=$setup->asset_setup_description;
                        ?>
                        @endif
                        
                    @endforeach
                    <td style="vertical-align: middle;" ><a onclick="ViewPendingAssets('<?php echo $asset->ASSET_ID; ?>')" class="btn-link" style="cursor: pointer;">{{$ViewAssetDesc}}</a></td>
                    <td style="vertical-align: middle;">{{$asset->asset_brand}}</td>
                    <td style="vertical-align: middle;">{{$asset->asset_model}}</td>
                    <td style="vertical-align: middle;">{{$asset->asset_serial_number}}</td>
                    <td style="vertical-align: middle;">{{$asset->department_name}}</td>
                    <td style="vertical-align: middle;">{{$asset->asset_site}}</td>
                    <td style="vertical-align: middle;">{{$asset->asset_location}}</td>
                    <td style="vertical-align: middle;">
                            <?php 
                            if($asset->asset_transaction_status=="1" || $asset->asset_transaction_status=="2.1" || $asset->asset_transaction_status=="2.2" ){
                                echo "Available";
                            }
                            if($asset->asset_transaction_status=="2" || $asset->asset_transaction_status=="1.1" || $asset->asset_transaction_status=="1.2"){
                                echo "Checked Out";
                            }
                            
                            if($asset->asset_transaction_status=="4.1" || $asset->asset_transaction_status=="4.2"){
                                echo "Queued for Maintenance";
                            }
                            if($asset->asset_transaction_status=="4"){
                                echo "On Maintenace";
                            }
                            ?>
                    </td>
                    <td style="vertical-align: middle;">
                        @foreach ($selected_asset_checkouts_list as $ch)
                            @if ($ch->Request_Asset_tag==$asset->ASSET_ID)
                                {{$ch->fname." ".$ch->lname}}
                                <?php
                                    break;
                                ?>
                            @endif
                        @endforeach
                    </td>
                    
                </tr>
            @endforeach
            
            </tbody>
        </table>
    </div>
    <div class="col-md-12" style="text-align:right;">
        <a class="btn btn-primary" href="#" onclick="printhtmltocanvas('AuditTable')">Print</a>
        <a class="btn btn-primary" href="GETAUDITEXCEL?name={{$AuditName}}&location={{$LocationAudit}}&site={{$SiteAudit}}">Download Excel</a>
    </div>
</div>