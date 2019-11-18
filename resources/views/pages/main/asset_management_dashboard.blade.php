@extends('main.main')


@section('content')
<div class="container-fluid" style="margin-bottom:10px;">

<script>
    $(document).ready(function(){
        if(document.getElementById('checkoutasset')){
            var table = $('#checkoutasset').DataTable( {
            
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
                    <tr>
                        <td  style="text-align:center;vertical-align:middle;"></td>
                        <td style="vertical-align:middle;"></td>
                        <td style="vertical-align:middle;"></td>
                        <td style="vertical-align:middle;" ></td>
                        <td style="vertical-align:middle;" >
                        
                        </td>
                        <td style="vertical-align:middle;"></td>
                        
                        <td style="vertical-align:middle;">
                            
                        </td>
                        <td style="vertical-align:middle;"></td>
                        <td style="vertical-align:middle;"></td>
                        <td style="vertical-align:middle;text-align:center;">
                            <form action="" method="POST"onsubmit="return confirm('Are you sure you want to delete the New Fixed Asset request?');">
                                <input type="hidden" name="AssetTagHidden" value="">
                                <button type="submit" class="btn btn-danger btn-sm"   name="Asset_tag_button"><span class="fa fa-times-circle"></span></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
    </div>
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
                                <a class="btn btn-sm btn-success" id="MassApproveBtn2223" style="margin-right:10px;" onclick="MassApprove()" id="MassApproveBtn" ><span class="fa fa-check-circle"></span></a> 
                                <a class="btn btn-sm btn-danger" id="MassDenyBtn2223" onclick="MassDeny()" style=""id="MassDenyBtn"><span class="fa fa-times-circle"></span></a>
                            </div>
                        </td>
                    </tr>
                </thead>
        </table>
        <table class="table borderless table-hover table-sm" style="background-color:white;" id="checkoutasset">
            <thead style="background-color:#0e3d4c; color:white;">
                
                <tr>
                    
                    <th width="2%"></th>
                    <th style="text-align:center;" >Ticket No.</th>
                    <th>Date</th>
                    <th width="15%">Requested By</th>
                    <th>Transaction </th>
                    <th width="15%">Item</th>
                    <th>Due Date</th>
                    
                    <th width="10%">Status</th>
                    <th width="10%">Remarks</th>
                    
                    <th width="15%" style="text-align:center;">Action</th>
                    
                    
                </tr>
            </thead>
            <tbody style="color:#083240;padding:10px;" id="RequestBoyBody">
                <tr>
                    
                    <td><input onclick="toggleindi(this)" type="checkbox" name="LG" value="" title="New Asset"></td>
                    <td style="vertical-align:middle;text-align:center;"></td>
                    <td  style="vertical-align:middle;"></td>
                    <td  style="vertical-align:middle;"></td>
                    <td  style="vertical-align:middle;"></td>
                    <td  style="vertical-align:middle;">
                    
                    </td>
                    <td style="vertical-align:middle">N/A</td>
                    
                    <td style="vertical-align:middle"></td>
                    
                    <td><a style="cursor:pointer;" class="btn-link" >NOTE</a></td>
                    
                    <td width="10%" style="vertical-align:middle;text-align:center;">
                        <a class="btn btn-sm btn-success" href="#" ><span class="fa fa-check-circle"></span></a> 
                        <a class="btn btn-sm btn-danger" href="#"><span class="fa fa-times-circle"></span></a>
                    </td>
                    
                </tr>
            </tbody>
        </table>
    </div>

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
                                <a class="btn btn-sm btn-success" id="MassApproveBtn2223" style="margin-right:10px;" onclick="MassApprove()" id="MassApproveBtn" ><span class="fa fa-check-circle"></span></a> 
                                <a class="btn btn-sm btn-danger" id="MassDenyBtn2223" onclick="MassDeny()" style=""id="MassDenyBtn"><span class="fa fa-times-circle"></span></a>
                            </div>
                        </td>
                    </tr>
                </thead>
        </table>
        <table class="table borderless table-hover table-sm" style="background-color:white;" id="checkoutasset_fa">
            <thead style="background-color:#0e3d4c; color:white;">
                
                <tr>
                    
                    <th width="2%"></th>
                    <th style="text-align:center;" >Ticket No.</th>
                    <th>Date</th>
                    <th width="15%">Requested By</th>
                    <th>Transaction </th>
                    <th width="15%">Item</th>
                    <th>Due Date</th>
                    
                    <th width="10%">Status</th>
                    <th width="10%">Remarks</th>
                    
                    <th width="15%" style="text-align:center;">Action</th>
                    
                    
                </tr>
            </thead>
            <tbody style="color:#083240;padding:10px;" id="RequestBoyBody">
                <tr>
                    
                    <td><input onclick="toggleindi(this)" type="checkbox" name="LG" value="" title="New Asset"></td>
                    <td style="vertical-align:middle;text-align:center;"></td>
                    <td  style="vertical-align:middle;"></td>
                    <td  style="vertical-align:middle;"></td>
                    <td  style="vertical-align:middle;"></td>
                    <td  style="vertical-align:middle;">
                    
                    </td>
                    <td style="vertical-align:middle">N/A</td>
                    
                    <td style="vertical-align:middle"></td>
                    
                    <td><a style="cursor:pointer;" class="btn-link" >NOTE</a></td>
                    
                    <td width="10%" style="vertical-align:middle;text-align:center;">
                        <a class="btn btn-sm btn-success" href="#" ><span class="fa fa-check-circle"></span></a> 
                        <a class="btn btn-sm btn-danger" href="#"><span class="fa fa-times-circle"></span></a>
                    </td>
                    
                </tr>
            </tbody>
        </table>
    </div>
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
                            @if ($item->id=$rows->asset_tag)
                            <?php
                                $asset_desc=$item->asset_setup_description;
                                break;
                            ?>
                            @endif
                        @endforeach
                        <a onclick="ViewPendingAssets('<?php echo $rows->asset_tag; ?>')" class="btn-link" style="cursor: pointer;"><?php echo $asset_desc;?></a>
                        @else

                        <a onclick="ViewAssetSetup('<?php echo $rows->transaction_ticket_no; ?>')" class="btn-link" style="cursor: pointer;"><?php echo $rows->asset_tag; ?></a>
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
                        <td><a style="cursor:pointer;" class="btn-link" onclick="ViewNotes('<?php echo $rows->asset_transaction_log_id ?>')"><?php echo $pp; ?></a></td>
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
        {{-- <table class="table" >
            <tbody>
                @foreach ($asset_transaction_log as $logs)
                <tr>
                    <td>{{$logs->asset_transaction_log_id	}}</td>
                    <td>{{$logs->asset_tag	}}</td>
                    <td>{{$logs->log_date}}</td>
                    <td>{{$logs->log_time}}</td>
                    <td>{{$logs->audit_action_date}}</td>
                    <td>{{$logs->log_action}}</td>
                    <td>{{$logs->log_action_requestor_id}}</td>
                    <td>{{$logs->log_action_requestor}}</td>
                </tr>  
                @endforeach
            </tbody>
        </table> --}}
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

@endsection