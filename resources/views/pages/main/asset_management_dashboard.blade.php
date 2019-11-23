@extends('main.main')


@section('content')
<div class="container-fluid" style="margin-bottom:10px;">

<script>
    $(document).ready(function(){
        if(document.getElementById('checkoutasset')){
            var table = $('#checkoutasset').DataTable( {
                order: [2, 'desc'],
            } );
            if(document.getElementById('checkoutasset_length')){
                document.getElementById('checkoutasset_info').style.display="none";
                document.getElementById('checkoutasset_length').style.paddingLeft ="10px";
                document.getElementById('checkoutasset_length').style.paddingTop ="10px";
                document.getElementById('checkoutasset_filter').style.paddingRight ="10px";
                document.getElementById('checkoutasset_filter').style.paddingTop ="10px";
                document.getElementById('checkoutasset_paginate').style.textAlign ="center";
                document.getElementById('checkoutasset_paginate').style.cssFloat ="none";
                
            } 
        }
        if(document.getElementById('checkoutasset_fa')){
            var table = $('#checkoutasset_fa').DataTable( {
                order: [2, 'desc'],
            } );
            if(document.getElementById('checkoutasset_fa_length')){
                document.getElementById('checkoutasset_fa_info').style.display="none";
                document.getElementById('checkoutasset_fa_length').style.paddingLeft ="10px";
                document.getElementById('checkoutasset_fa_length').style.paddingTop ="10px";
                document.getElementById('checkoutasset_fa_filter').style.paddingRight ="10px";
                document.getElementById('checkoutasset_fa_filter').style.paddingTop ="10px";
                document.getElementById('checkoutasset_fa_paginate').style.textAlign ="center";
                document.getElementById('checkoutasset_fa_paginate').style.cssFloat ="none";
                
            } 
        }
        if(document.getElementById('RequestLogTable')){
            var table = $('#RequestLogTable').DataTable( {
                'ordering':false
            } );
            if(document.getElementById('RequestLogTable_length')){
                document.getElementById('RequestLogTable_info').style.display="none";
               
                document.getElementById('RequestLogTable_paginate').style.textAlign ="center";
                document.getElementById('RequestLogTable_paginate').style.cssFloat ="none";
                
            } 
        }
        if(document.getElementById('checkoutassetstable')){
            var table = $('#checkoutassetstable').DataTable( {
            
            } );
            if(document.getElementById('checkoutassetstable_length')){
                document.getElementById('checkoutassetstable_info').style.display="none";
               
                document.getElementById('checkoutassetstable_paginate').style.textAlign ="center";
                document.getElementById('checkoutassetstable_paginate').style.cssFloat ="none";
                
            } 
        }
        if(document.getElementById('MaintenanceAssetTable')){
            var table = $('#MaintenanceAssetTable').DataTable( {
            
            } );
            if(document.getElementById('MaintenanceAssetTable_length')){
                document.getElementById('MaintenanceAssetTable_info').style.display="none";
               
                document.getElementById('MaintenanceAssetTable_paginate').style.textAlign ="center";
                document.getElementById('MaintenanceAssetTable_paginate').style.cssFloat ="none";
                
            } 
        }
        
        
    })  
</script>
<style>
.half-background {
    background: linear-gradient(180deg, white 50%, transparent 50%);
    margin-bottom:10px;
}
</style>
    <div class="row">
        <div class="col-md-12 mb-3">
            <a class="btn btn-primary" href="asset_management_dispose" ><span class="fa fa-trash"></span> View Denied Requests</a>
        </div>
    </div>
    @if (!empty($user_position))
        @if ($user_position->position=="Data Entry Officer")
            <div class="half-background">
                <table class="table table-sm" id="DeniedRequestTable" style="background-color:white;width:100%;">						
                    <thead >
                        <tr style="background-color:#083240;color:white;">
                        <th colspan="10" style="text-align:center;font-weight:bold;color:white;font-size:20px;">DENIED REQUEST</th>
                        </tr>
                        <tr style="background-color:#0e3d4c; color:white;">
                            <th width="10%" style="text-align:center;">Ticket No.</th>
                            <th width="10%">Request Date</th>
                            <th width="10%">Requested By</th>
                            <th width="10%" >Transaction</th>
                            <th width="10%" >Item</th>
                            <th width="12%" >Status</th>
                            <th width="10%" >Remarks</th>
                            <th width="10%">Date Acted</th>
                            <th width="10%">Time Acted</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody style="border-bottom:1px solid #cecece;">
                        @foreach ($pending_denied_new_assets as $rows)
                        <tr>
                            <td  style="text-align:center;vertical-align:middle;">{{$rows->asset_setcheck_defualt}}</td>
                            <td style="vertical-align:middle;">{{date("m-d-Y", strtotime($rows->audit_action_date))}}</td>
                            <td style="vertical-align:middle;">{{$rows->log_action_requestor}}</td>
                            <td style="vertical-align:middle;" >{{$rows->log_action}}</td>
                            <td style="vertical-align:middle;" >
                                    <?php
                                    $cccccc="";
                                    ?>
                                    @foreach ($asset_description_grouped as $sad)
                                        @if ($rows->asset_description==$sad->asset_setup_ad)
                                        <?php
                                            $cccccc=$sad->asset_setup_description;
                                            break;
                                        ?>
                                        @endif
                                    @endforeach
                                <a class=" btn-link" style="cursor: pointer;" onclick="EditAssetInfo('<?php echo $rows->ASSET_ID; ?>')"><?php echo $cccccc;?></a>
                                
                            </td>
                            <td style="vertical-align:middle;">{{$rows->transaction_action}}</td>
                            <?php
                            $preview=str_split($rows->deny_reason,5);
                            $pp=$preview[0];
                            if(count($preview)>1){
                                $pp=$preview[0]."..";	
                            }
                            ?>
                            <td style="vertical-align:middle;">
                                <a style="cursor:pointer;" class="btn-link" onclick="ViewNotes('<?php echo $rows->asset_transaction_log_id ?>')"><?php echo $pp; ?></a>
                                
                            </td>
                            <td style="vertical-align:middle;">{{date("m-d-Y", strtotime($rows->log_date))}}</td>
                            <td style="vertical-align:middle;">{{date("g:i a", strtotime($rows->log_time))}}</td>
                            <td style="vertical-align:middle;text-align:center;">
                                <button type="button" onclick="DeleteRequest('{{$rows->ASSET_ID}}')" class="btn btn-danger btn-sm"   name="Asset_tag_button"><span class="fa fa-times-circle"></span></button>
                            </td>
                        </tr>
                        @endforeach
                        @foreach ($pending_denied_new_asset_setup as $rows)
                        <tr>
                            <td  style="text-align:center;vertical-align:middle;">{{$rows->ticket_no}}</td>
                            <td style="vertical-align:middle;">{{date("m-d-Y", strtotime($rows->audit_action_date))}}</td>
                            <td style="vertical-align:middle;">{{$rows->log_action_requestor}}</td>
                            <td style="vertical-align:middle;" >{{$rows->log_action}}</td>
                            <td style="vertical-align:middle;" >
                                <a class=" btn-link" style="cursor: pointer;" onclick="EditAssetSetup('<?php echo $rows->ASSET_SETUP_ID; ?>')"><?php echo $rows->asset_setup_tag;?></a>
                            </td>
                            <td style="vertical-align:middle;">{{$rows->transaction_action}}</td>
                            <?php
                            $preview=str_split($rows->deny_reason,5);
                            $pp=$preview[0];
                            if(count($preview)>1){
                                $pp=$preview[0]."..";	
                            }
                            ?>
                            <td style="vertical-align:middle;">
                                <a style="cursor:pointer;" class="btn-link" onclick="ViewNotes('<?php echo $rows->asset_transaction_log_id ?>')"><?php echo $pp; ?></a>
                                
                            </td>
                            <td style="vertical-align:middle;">{{date("m-d-Y", strtotime($rows->log_date))}}</td>
                            <td style="vertical-align:middle;">{{date("g:i a", strtotime($rows->log_time))}}</td>
                            <td style="vertical-align:middle;text-align:center;">
                                <button type="button" onclick="DeleteRequestSetup('{{$rows->ASSET_SETUP_ID}}')" class="btn btn-danger btn-sm"   name="Asset_tag_button"><span class="fa fa-times-circle"></span></button>
                            </td>
                        </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div> 
        @elseif($user_position->position=="Asset Management Officer")
            <div class="half-background">
                <table class="table borderless table-hover table-sm" style="background-color:white;margin-bottom:0px;">
                        <thead style="background-color:#0e3d4c; color:white;">
                            <tr style="background-color:#083240;color:#262626;">
                                <th colspan="10" style="text-align:center;font-weight:bold;color:white;font-size:20px;">PENDING APPROVAL</th>
                            </tr>
                            <tr style="background-color:#124f62">
                                
                                <td colspan="10" style="vertical-align:middle;text-align:center;font-weight:bold;color:white;background-color:#124f62">
                                    <div style="font-weight:bold;color:white;float:left;">
                                        <input  type="checkbox" name="SelectAll" onclick="toggle(this)"> Select All
                                    </div>
                                    ASSET MANAGEMENT APPROVAL
                                    <div style="font-weight:bold;color:white;float:right;margin-right:10px;">
                                        <a class="btn btn-sm btn-success" id="MassApproveBtn2223" style="margin-right:10px;display:none;" onclick="MassApprove()" id="MassApproveBtn" ><span class="fa fa-check-circle"></span></a> 
                                        <a class="btn btn-sm btn-danger" id="MassDenyBtn2223" onclick="MassDeny()" style="display:none;"id="MassDenyBtn"><span class="fa fa-times-circle"></span></a>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                </table>
                <table class="table borderless table-hover table-sm" style="background-color:white;" id="checkoutasset">
                    <thead style="background-color:#0e3d4c; color:white;">
                        <tr>
                            <th width="2%"></th>
                            <th width="10%" style="text-align:center;" >Ticket No.</th>
                            <th width="10%">Date</th>
                            <th width="15%">Requested By</th>
                            <th width="10%">Transaction </th>
                            <th width="15%">Item</th>
                            <th width="10%">Due Date</th>
                            <th width="10%">Status</th>
                            <th width="10%">Remarks</th>
                            <th width="15%" style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody style="color:#083240;padding:10px;" id="RequestBoyBody">
                        @foreach ($pending_new_assets as $new_assets)
                            <tr>
                                <td><input onclick="toggleindi(this)" type="checkbox" name="LG" data-ticket='{{$new_assets->asset_setcheck_defualt}}' value="{{$new_assets->ASSET_ID}}" title="New Asset"></td>
                                <td style="vertical-align:middle;text-align:center;">{{$new_assets->asset_setcheck_defualt}}</td>
                                <td  style="vertical-align:middle;">{{date("m-d-Y", strtotime($new_assets->date_added))}}</td>
                                <td  style="vertical-align:middle;">{{$new_assets->name}}</td>
                                <td  style="vertical-align:middle;">{{'New Fixed Asset'}}</td>
                                <td  style="vertical-align:middle;">
                                    <?php
                                        $cccccc="";
                                    ?>
                                    @foreach ($asset_description_grouped as $sad)
                                        @if ($new_assets->asset_description==$sad->asset_setup_ad)
                                        <?php
                                            $cccccc=$sad->asset_setup_description;
                                            break;
                                        ?>
                                        @endif
                                    @endforeach
                                    @if ($user_position->position!='Fixed Asset Officer')
                                        <a class="btn btn-link"  style="cursor: pointer;" onclick="EditAssetInfo('<?php echo $new_assets->ASSET_ID; ?>')"><?php echo $cccccc;?></a>
                                    @else
                                        <a class="btn btn-link"  style="cursor: pointer;" disabled title="Access Denied!!"><?php echo $cccccc;?></a>
                                    @endif
                                </td>
                                <td style="vertical-align:middle">N/A</td>
                                @if($new_assets->transaction_action=="Denied by FA")
                                <td style="vertical-align:middle"><?php echo $new_assets->transaction_action; ?></td>
                                <?php
                                $preview=str_split($new_assets->deny_reason,5);
                                $pp=$preview[0];
                                if(count($preview)>1){
                                    $pp=$preview[0]."..";	
                                }
                                ?>
                                <td><a style="cursor:pointer;"  class="btn-link btn btn-sm" onclick="ViewNotes('<?php echo $new_assets->asset_transaction_log_id ?>')"><?php echo $pp; ?></a></td>
                                @else
                                <td style="vertical-align:middle"></td>
                                <td style="vertical-align:middle"></td>
                                @endif
                                <td width="10%" style="vertical-align:middle;text-align:center;">
                                    @if ($user_position->position!='Data Entry Officer' && $user_position->position!='Fixed Asset Officer')
                                    <a class="btn btn-sm btn btn-success"  style="margin-right:8px;color:white !important;" onclick="ApproveRequest('New Asset','<?php echo $new_assets->ASSET_ID; ?>')" ><span class="fa fa-check-circle"></span></a> 
                                    <a class="btn btn-sm btn btn-danger"  style="color:white !important;" onclick="DenyRequest('New Asset','<?php echo $new_assets->ASSET_ID; ?>','{{$new_assets->asset_setcheck_defualt}}')"><span class="fa fa-times-circle"></span></a>
                                    @else
                                    <a class="btn btn-sm btn-success"  disabled style="margin-right:8px;color:white !important;"  ><span class="fa fa-check-circle"></span></a>
                                    <a class="btn btn-sm btn-danger"  disabled  style="color:white !important;"><span class="fa fa-times-circle"></span></a>
                                    @endif
                                    
                                </td>
                                
                            </tr> 
                        @endforeach
                        @foreach ($pending_new_asset_setup as $new_assets)
                        <tr> 
                            <td><input onclick="toggleindi(this)" type="checkbox" name="LG" data-ticket='{{$new_assets->ticket_no}}'  value="{{$new_assets->ASSET_SETUP_ID}}" title="AssetSetup"></td>
                            <td style="vertical-align:middle;text-align:center;">{{$new_assets->ticket_no}}</td>
                            <td style="vertical-align:middle;">{{date("m-d-Y", strtotime($new_assets->created_at))}}</td>
                            <td style="vertical-align:middle;">{{$new_assets->name}}</td>
                            <td style="vertical-align:middle;">{{'New Asset Setup'}}</td>
                            <td  style="vertical-align:middle;">
                                <a onclick="EditAssetSetup('<?php echo $new_assets->ASSET_SETUP_ID; ?>')"  class="btn btn-link" style="cursor: pointer;"><?php echo $new_assets->asset_setup_tag; ?></a>
                            </td>
                            <td  style="vertical-align:middle;">N/A</td>
                            @if($new_assets->transaction_action=="Denied by FA")
                            <td style="vertical-align:middle"><?php echo $new_assets->transaction_action; ?></td>
                            <?php
                            $preview=str_split($new_assets->deny_reason,5);
                            $pp=$preview[0];
                            if(count($preview)>1){
                                $pp=$preview[0]."..";	
                            }
                            ?>
                            <td><a style="cursor:pointer;"  class=" btn btn-link" onclick="ViewNotes('<?php echo $new_assets->asset_transaction_log_id ?>')"><?php echo $pp; ?></a></td>
                            @else 
                            <td style="vertical-align:middle"></td>
                            <td style="vertical-align:middle"></td>
                            @endif
                            <td style="vertical-align:middle;text-align:center;">
                                <?php 
                                if($new_assets->position!="Data Entry Officer" && $new_assets->position!="Fixed Asset Officer"){
                                ?>
                                <a class="btn btn-sm btn btn-success"  style="margin-right:8px;color:white !important;" onclick="ApproveRequest('AssetSetup','<?php echo $new_assets->ASSET_SETUP_ID; ?>')" ><span class="fa fa-check-circle"></span></a> 
                                <a class="btn btn-sm btn btn-danger"   style="color:white !important;" onclick="DenyRequest('AssetSetup','<?php echo $new_assets->ASSET_SETUP_ID; ?>','{{$new_assets->ticket_no}}')"><span class="fa fa-times-circle"></span></a>
                                <?php
                                }else{
                                ?>
                                <a class="btn btn-sm btn-success"  disabled style="margin-right:8px;color:white !important;"  ><span class="fa fa-check-circle"></span></a>
                                <a class="btn btn-sm btn-danger"  disabled style="color:white !important;" ><span class="fa fa-times-circle"></span></a>
                                <?php	
                                }
                                ?>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        @elseif($user_position->position=="Fixed Asset Officer")
            <div class="half-background">
                <table class="table borderless table-hover table-sm" style="background-color:white;margin-bottom:0px;">
                        <thead style="background-color:#0e3d4c; color:white;">
                            <tr style="background-color:#083240;color:#262626;">
                                <th colspan="10" style="text-align:center;font-weight:bold;color:white;font-size:20px;">PENDING APPROVAL</th>
                            </tr>
                            <tr style="background-color:#124f62">
                                
                                <td colspan="10" style="vertical-align:middle;text-align:center;font-weight:bold;color:white;background-color:#124f62">
                                    <div style="font-weight:bold;color:white;float:left;">
                                        <input  type="checkbox" name="SelectAll" onclick="toggle(this)"> Select All
                                    </div>
                                    FIXED ASSET APPROVAL
                                    <div style="font-weight:bold;color:white;float:right;margin-right:10px;">
                                        <a class="btn btn-sm btn-success" id="MassApproveBtn2223" style="margin-right:10px;display:none;" onclick="MassApprove2()" id="MassApproveBtn" ><span class="fa fa-check-circle"></span></a> 
                                        <a class="btn btn-sm btn-danger" id="MassDenyBtn2223" onclick="MassDeny2()" style="display:none;"id="MassDenyBtn"><span class="fa fa-times-circle"></span></a>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                </table>
                <table class="table borderless table-hover table-sm" style="background-color:white;" id="checkoutasset_fa">
                    <thead style="background-color:#0e3d4c; color:white;">
                        <tr>
                            <th width="2%"></th>
                            <th width="10%" style="text-align:center;" >Ticket No.</th>
                            <th width="10%">Date</th>
                            <th width="15%">Requested By</th>
                            <th width="10%">Transaction </th>
                            <th width="15%">Item</th>
                            <th width="10%">Due Date</th>
                            <th width="10%">Status</th>
                            <th width="10%">Remarks</th>
                            <th width="15%" style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody style="color:#083240;padding:10px;" id="RequestBoyBody">
                        @foreach ($pending_confirmation_new_assets as $new_assets)
                            <tr>
                                <td><input onclick="toggleindi(this)" type="checkbox" name="LG" data-ticket='{{$new_assets->asset_setcheck_defualt}}' value="{{$new_assets->ASSET_ID}}" title="New Asset"></td>
                                <td style="vertical-align:middle;text-align:center;">{{$new_assets->asset_setcheck_defualt}}</td>
                                <td  style="vertical-align:middle;">{{date("m-d-Y", strtotime($new_assets->date_added))}}</td>
                                <td  style="vertical-align:middle;">{{$new_assets->name}}</td>
                                <td  style="vertical-align:middle;">{{'New Fixed Asset'}}</td>
                                <td  style="vertical-align:middle;">
                                    <?php
                                        $cccccc="";
                                    ?>
                                    @foreach ($asset_description_grouped as $sad)
                                        @if ($new_assets->asset_description==$sad->asset_setup_ad)
                                        <?php
                                            $cccccc=$sad->asset_setup_description;
                                            break;
                                        ?>
                                        @endif
                                    @endforeach
                                        <a class="btn btn-link"  style="cursor: pointer;" onclick="ViewPendingAssets('<?php echo $new_assets->ASSET_ID; ?>')"><?php echo $cccccc;?></a>
                                    
                                </td>
                                <td style="vertical-align:middle">N/A</td>
                                @if($new_assets->transaction_action=="Denied by FA")
                                <td style="vertical-align:middle"><?php echo $new_assets->transaction_action; ?></td>
                                <?php
                                $preview=str_split($new_assets->deny_reason,5);
                                $pp=$preview[0];
                                if(count($preview)>1){
                                    $pp=$preview[0]."..";	
                                }
                                ?>
                                <td><a style="cursor:pointer;"  class="btn-link btn btn-sm" onclick="ViewNotes('<?php echo $new_assets->asset_transaction_log_id ?>')"><?php echo $pp; ?></a></td>
                                @else
                                <td style="vertical-align:middle"></td>
                                <td style="vertical-align:middle"></td>
                                @endif
                                <td width="10%" style="vertical-align:middle;text-align:center;">
                                    @if ($user_position->position!='Data Entry Officer' && $user_position->position!='Asset Management Officer')
                                    <a class="btn btn-sm btn btn-success"  style="margin-right:8px;color:white !important;" onclick="ConfirmRequest('New Asset','<?php echo $new_assets->ASSET_ID; ?>')" ><span class="fa fa-check-circle"></span></a> 
                                    <a class="btn btn-sm btn btn-danger"  style="color:white !important;" onclick="DenyRequest('New Asset2','<?php echo $new_assets->ASSET_ID; ?>','{{$new_assets->asset_setcheck_defualt}}')"><span class="fa fa-times-circle"></span></a>
                                    @else
                                    <a class="btn btn-sm btn-success"  disabled style="margin-right:8px;color:white !important;"  ><span class="fa fa-check-circle"></span></a>
                                    <a class="btn btn-sm btn-danger"  disabled  style="color:white !important;"><span class="fa fa-times-circle"></span></a>
                                    @endif
                                    
                                </td>
                                
                            </tr> 
                        @endforeach
                        @foreach ($pending_confirmation_new_asset_setup as $new_assets)
                        <tr> 
                            <td><input onclick="toggleindi(this)" type="checkbox" name="LG" data-ticket='{{$new_assets->ticket_no}}' value="{{$new_assets->ASSET_SETUP_ID}}" title="AssetSetup"></td>
                            <td style="vertical-align:middle;text-align:center;">{{$new_assets->ticket_no}}</td>
                            <td style="vertical-align:middle;">{{date("m-d-Y", strtotime($new_assets->created_at))}}</td>
                            <td style="vertical-align:middle;">{{$new_assets->name}}</td>
                            <td style="vertical-align:middle;">{{'New Asset Setup'}}</td>
                            <td  style="vertical-align:middle;">
                                <a onclick="ViewAssetSetup('<?php echo $new_assets->ASSET_SETUP_ID; ?>')"  class="btn btn-link" style="cursor: pointer;"><?php echo $new_assets->asset_setup_tag; ?></a>
                            </td>
                            <td  style="vertical-align:middle;">N/A</td>
                            @if($new_assets->transaction_action=="Denied by FA")
                            <td style="vertical-align:middle"><?php echo $new_assets->transaction_action; ?></td>
                            <?php
                            $preview=str_split($new_assets->deny_reason,5);
                            $pp=$preview[0];
                            if(count($preview)>1){
                                $pp=$preview[0]."..";	
                            }
                            ?>
                            <td><a style="cursor:pointer;"  class=" btn btn-link" onclick="ViewNotes('<?php echo $new_assets->asset_transaction_log_id ?>')"><?php echo $pp; ?></a></td>
                            @else 
                            <td style="vertical-align:middle"></td>
                            <td style="vertical-align:middle"></td>
                            @endif
                            <td style="vertical-align:middle;text-align:center;">
                                <?php 
                                if($new_assets->position!="Data Entry Officer" && $new_assets->position!="Asset Management Officer"){
                                ?>
                                <a class="btn btn-sm btn btn-success"  style="margin-right:8px;color:white !important;" onclick="ConfirmRequest('AssetSetup','<?php echo $new_assets->ASSET_SETUP_ID; ?>')" ><span class="fa fa-check-circle"></span></a> 
                                <a class="btn btn-sm btn btn-danger"   style="color:white !important;" onclick="DenyRequest('AssetSetup2','<?php echo $new_assets->ASSET_SETUP_ID; ?>','{{$new_assets->ticket_no}}')"><span class="fa fa-times-circle"></span></a>
                                <?php
                                }else{
                                ?>
                                <a class="btn btn-sm btn-success"  disabled style="margin-right:8px;color:white !important;"  ><span class="fa fa-check-circle"></span></a>
                                <a class="btn btn-sm btn-danger"  disabled style="color:white !important;" ><span class="fa fa-times-circle"></span></a>
                                <?php	
                                }
                                ?>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif 
    @endif

    <div>
        <table class="table table-sm" id="RequestLogTable" style="margin-bottom:0px;background-color:white;width:100%;">
								
            <thead >
                <tr style="background-color:#083240;color:white;">
                <th colspan="9" style="text-align:center;font-weight:bold;color:white;font-size:20px;">REQUEST LOGS</th>
                </tr>
                <tr style="background-color:#0e3d4c; color:white;">
                    <th width="10%" style="text-align:center;">Ticket No.</th>
                    <th width="10%">Request Date</th>
                    <th width="10%">Requested By</th>
                    <th width="10%" >Transaction</th>
                    <th width="10%" >Item</th>
                    <th width="12%" >Status</th>
                    <th width="10%" >Remarks</th>
                    <th width="10%">Date Acted</th>
                    <th width="10%">Time Acted</th>
                </tr>
            </thead>
            <tbody style="border-bottom:1px solid #cecece;">
                @if (!empty($asset_transaction_log))
                    @foreach ($asset_transaction_log as $rows)
                    <tr>
                        <td style="text-align:center;"><?php echo $rows->asset_transaction_log_id; ?></td>
                        <td><?php echo date("m-d-Y", strtotime($rows->audit_action_date)); ?></td>
                        <td><?php echo $rows->log_action_requestor; ?></td>
                        <td><?php echo $rows->log_action; ?></td>
                        <td>
                        @if($rows->log_action!="Asset Setup")
                        <?php

                            $asset_desc="";
                        ?>
                        
                        @foreach ($asset_list_all as $item)
                        
                            @if ($item->ASSET_IIDS==$rows->asset_tag)
                            <?php
                                $asset_desc=$item->asset_setup_description;
                                break;
                            ?>
                            @endif
                        @endforeach
                        <a onclick="ViewPendingAssets('<?php echo $rows->asset_tag; ?>')"  class="btn btn-link" style="cursor: pointer;color:#124f62;"><?php echo $asset_desc;?></a>
                        @else

                        <a onclick="ViewAssetSetup('<?php echo $rows->transaction_ticket_no; ?>')"  class="btn btn-link" style="cursor: pointer;color:#124f62;"><?php echo $rows->asset_tag; ?></a>
                        @endif
                        
                        </td>
                        <td><?php echo $rows->transaction_action; ?></td>
                        <?php
                        $preview=str_split($rows->deny_reason,5);
                        $pp=$preview[0];
                        if(count($preview)>1){
                            $pp=$preview[0]."..";	
                        }
                        ?>
                        <td><a style="cursor:pointer;color:#124f62;"  class="btn btn-link" onclick="ViewNotes('<?php echo $rows->asset_transaction_log_id ?>')"><?php echo $pp; ?></a></td>
                        <td><?php echo date("m-d-Y", strtotime($rows->log_date)); ?></td>
                        <td><?php echo date("g:i a", strtotime($rows->log_time)); ?></td>
                        
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9"></td>
                    </tr>
                @endif
               
            </tbody>
        </table>
        <script>
			function ViewNotes(e){
                $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'getViewNotes',                
                data: {id:e,_token: '{{csrf_token()}}'},
                success: function(data) {
                    document.getElementById('ViewModalH5').innerHTML=e+" Notes";
                    $( "#ViewModalP" ).replaceWith( data );
					$( "#NoteModalRemarks" ).modal('show');
                }  
                })
				
			}
		</script>
        
    </div>
    <div>
        <table class="table borderless table-hover" style="margin-bottom:0px;background-color:white;width:100%;" id="checkoutassetstable">
			<thead style="background-color:#0e3d4c; color:white;">
				<tr style="background-color:#083240;color:#262626;">
					<th colspan="9" style="text-align:center;font-weight:bold;color:white;font-size:20px;">CHECKED OUT ASSETS</th>
				</tr>
				<tr>
					<th style="text-align:center;">Ticket No.</th>
					<th>Requested By</th>
					<th>Asset</th>
					<th>Department</th>
					<th>Quantity</th>
					<th>Date Borrowed</th>
					<th>Due Date</th>
					<th>Overdue</th>
					<th style="text-align:center;">Status</th>
				</tr>
            </thead>
            <tbody style="color:#083240;" id="checkout_tbody">
                <tr>
                    <td style="vertical-align: middle;text-align:center;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;text-align:center;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    
                    <td style="vertical-align: middle;text-align:center;"></td>
                    <td style="text-align:center;vertical-align: middle;">
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div>
        <table class="table borderless table-hover" style="background-color:white;width:100%;margin-bottom:0px;" id="MaintenanceAssetTable">
            <thead style="background-color:#0e3d4c; color:white;">
                <tr style="background-color:#083240;color:#262626;">
                    <th colspan="9" style="text-align:center;font-weight:bold;color:white;font-size:20px;">ASSETS ON MAINTENANCE</th>
                </tr>
                <tr>
                    <th style="text-align:center;">Ticket No.</th>
                    <th>Requested By</th>
                    <th>Asset</th>
                    <th>Department</th>
                    <th>Quantity</th>
                    <th>Date</th>
                    <th>Due Date</th>
                    <th>Overdue</th>
                    <th style="text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody style="color:#083240;" id="maintenance_tbody">
            
                <tr>
                    <td style="vertical-align: middle;text-align:center;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;text-align:center;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                   
                    <td style="vertical-align: middle;text-align:center;"></td>
                    <td style="text-align:center;vertical-align: middle;">
                        
                    </td>
                </tr>
            
            </tbody>
        </table>
    </div>
</div>
<div class="modal fade" id="NoteModalRemarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="ViewModalH5">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <blockquote>
                <p id="ViewModalP"></p>
                
            </blockquote>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            
        </div>
        </div>
    </div>
</div>
@endsection