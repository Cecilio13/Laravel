@extends('main.main')


@section('content')
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12">
            <h2 style="font-weight:bold;color:#083240;margin-top:0px;">AUDIT NAME : {{$AuditWindowName}}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h5 style="font-weight:bold;color:#083240;margin-top:0px;">LOCATION : Location Placeholder</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h5 style="font-weight:bold;color:#083240;margin-top:0px;">SITE : Site Placeholder</h5>
        </div>
    </div>
    <table class="table table-sm" style="background-color:white;color:#083240;" tabindex="-1">
        <thead style="background-color:#124f62; color:white;">
          <tr style="background-color:#083240">
            <th colspan="12" style="text-align:center;">FOUND</th>
          </tr>
          <tr>
            
            <th>Asset Tag</th>
            <th>Asset</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Brand</th>
            <th>Serial Number</th>
            <th>Plate Number</th>
            <th>Department</th>
            <th>Initial Value</th>
            <th>Depreciated Value</th>
            <th>Status</th>
            
          </tr>
        </thead>
        <tbody>
            @foreach ($audit_asset_found as $rows)
                <tr>
                    <td>{{$rows->asset_tag}}</td>
                    <?php
                        $ViewAssetDesc="";
                        $CategoryNameFull="";
                        $ViewAssetSub="";
                    ?>
                    @foreach ($asset_setup_lists as $setup)
                        @if ($setup->asset_setup_ad==$rows->asset_description)
                        <?php 
                        $ViewAssetDesc=$setup->asset_setup_description;
                        ?>
                        @endif
                        @if ($setup->asset_setup_ac==$rows->asset_category_name)
                        <?php 
                        $CategoryNameFull=$setup->asset_setup_category;
                        ?> 
                        @endif
                        @if ($setup->asset_setup_sc==$rows->asset_sub_category)
                        <?php 
                        $ViewAssetSub=$setup->asset_setup_sub_cat;
                        ?> 
                        @endif
                    @endforeach
                    <td>{{$ViewAssetDesc}}</td>
                    <td>{{$CategoryNameFull}}</td>
                    <td>{{$ViewAssetSub}}</td>
                    <td>{{$rows->asset_brand}}</td>
                    <td>{{$rows->asset_serial_number}}</td>
                    <td>{{$rows->sku_code}}</td>
                    <td>{{$rows->department_name}}</td>
                    <td>{{number_format($rows->initial_value,2)}}</td>
                    <td>{{number_format($rows->current_cost,2)}}</td>
                    <td>
                        <?php 
                        if($rows->asset_transaction_status=="1" || $rows->asset_transaction_status=="2.1" || $rows->asset_transaction_status=="2.2" ){
                            echo "Available";
                        }
                        if($rows->asset_transaction_status=="2" || $rows->asset_transaction_status=="1.1" || $rows->asset_transaction_status=="1.2"){
                            echo "Checked Out";
                        }
                        
                        if($rows->asset_transaction_status=="4.1" || $rows->asset_transaction_status=="4.2"){
                            echo "Queued for Maintenance";
                        }
                        if($rows->asset_transaction_status=="4"){
                            echo "On Maintenace";
                        }
                        if($rows->asset_transaction_status=="3.1" || $rows->asset_transaction_status=="3.2"){
                            echo "Queued for Disposal";
                        }
                        ?>
                    </td>
                </tr>  
            @endforeach
        </tbody>
    </table>
    <table class="table table-hover table-sm" style="background-color:white;color:#083240;" id="NotFoundTable" tabindex="-1">
        <thead style="background-color:#124f62; color:white;">
          <tr style="background-color:#083240">
            <th colspan="12" style="text-align:center;">NOT FOUND</th>
          </tr>
          <tr>
            <th>Asset Tag</th>
            <th>Asset</th>
            <th>Category</th>
            <th>Sub Category</th>
            <th>Brand</th>
            <th>Serial Number</th>
            <th>Plate Number</th>
            <th>Department</th>
            <th>Initial Value</th>
            <th>Depreciated Value</th>
            <th>Status</th>
            <th>Reconcile Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($audit_asset_not_found as $rows)
                <tr <?php echo $rows->audit_status=='1'? 'class="table-success"':'' ?> style="cursor: pointer;">
                    <td data-audit-status="{{$rows->audit_status}}" data-asset-id="{{$rows->ASSET_ID}}" >{{$rows->asset_tag}}</td>
                    <?php
                        $ViewAssetDesc="";
                        $CategoryNameFull="";
                        $ViewAssetSub="";
                    ?>
                    @foreach ($asset_setup_lists as $setup)
                        @if ($setup->asset_setup_ad==$rows->asset_description)
                        <?php 
                        $ViewAssetDesc=$setup->asset_setup_description;
                        ?>
                        @endif
                        @if ($setup->asset_setup_ac==$rows->asset_category_name)
                        <?php 
                        $CategoryNameFull=$setup->asset_setup_category;
                        ?> 
                        @endif
                        @if ($setup->asset_setup_sc==$rows->asset_sub_category)
                        <?php 
                        $ViewAssetSub=$setup->asset_setup_sub_cat;
                        ?> 
                        @endif
                    @endforeach
                    <td >{{$ViewAssetDesc}}</td>
                    <td>{{$CategoryNameFull}}</td>
                    <td>{{$ViewAssetSub}}</td>
                    <td>{{$rows->asset_brand}}</td>
                    <td>{{$rows->asset_serial_number}}</td>
                    <td>{{$rows->sku_code}}</td>
                    <td>{{$rows->department_name}}</td>
                    <td>{{number_format($rows->initial_value,2)}}</td>
                    <td>{{number_format($rows->current_cost,2)}}</td>
                    <td>
                        <?php 
                        if($rows->asset_transaction_status=="1" || $rows->asset_transaction_status=="2.1" || $rows->asset_transaction_status=="2.2" ){
                            echo "Available";
                        }
                        if($rows->asset_transaction_status=="2" || $rows->asset_transaction_status=="1.1" || $rows->asset_transaction_status=="1.2"){
                            echo "Checked Out";
                        }
                        
                        if($rows->asset_transaction_status=="4.1" || $rows->asset_transaction_status=="4.2"){
                            echo "Queued for Maintenance";
                        }
                        if($rows->asset_transaction_status=="4"){
                            echo "On Maintenace";
                        }
                        if($rows->asset_transaction_status=="3.1" || $rows->asset_transaction_status=="3.2"){
                            echo "Queued for Disposal";
                        }
                        ?>
                    </td>
                    <td>{{$rows->audit_action}}</td>
                </tr>  
            @endforeach                           
            
        </tbody>
    </table>
    <script>
    var table = document.getElementById('NotFoundTable');
	for(var i = 2; i < table.rows.length; i++)
	{
		table.rows[i].onclick = function()
		{
			var rIndex = this.rowIndex;
            console.log(this.cells[0].getAttribute('data-audit-status'));
            if(this.cells[0].getAttribute('data-audit-status')==0){
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'GetNotFoundReconcileModal',                
                    data:{id:this.cells[0].getAttribute('data-asset-id'),Selected:this.cells[0].innerHTML,Description:this.cells[1].innerHTML,AuditName:'<?php echo $AuditWindowName; ?>',_token: '{{csrf_token()}}'},
                    success: function(data) {
                        $( "#NotFoundReconcileModal" ).replaceWith( data.html );
                        $('#NotFoundReconcileModal').modal('show');
                    }
                })
            }else{

            }
            
		};
    }
    function ReconcileAssetEdit(){
		
		var r = confirm("Are you sure you want to proceed with the reconcile information?");
		if (r == true) {
			
		
		leaveprompt=0;
		var AuditName="<?php echo $AuditWindowName; ?>";
		var radios = document.getElementsByName('optradio');
		var Sel="Maintenance";
		for (var i = 0, length = radios.length; i < length; i++)
		{
            if (radios[i].checked)
            {
            // do whatever you want with the checked radio
            Sel = radios[i].value;
            // only one radio can be logically checked, don't check the rest
            break;
            }
		}
		if(Sel=="Move"){
			var MoveLocation_Reason=document.getElementById('MoveAssetToLocation').value;
			var MoveDept=document.getElementById('MoveAssetToDept').value;
			var MoveEmployee=document.getElementById('ReassignTo').value;
			var NoteDivLabel=document.getElementById('MoveAssetNote').value;
			var AssetTag=document.getElementById('AssetID').value;
            var MoveAssetToSite=document.getElementById('MoveAssetToSite').value;
            console.log(Sel+" MoveLocation_Reason: "+MoveLocation_Reason+", MoveDept:"+MoveDept+", MoveEmployee:"+MoveEmployee+", NoteDivLabel:"+NoteDivLabel+", AssetTag:"+AssetTag);
            $.ajax({
            type: 'POST',
            url: ' SaveAssetMoveAudit',                
            data: {AuditName:AuditName,tag:AssetTag,site:MoveAssetToSite,location:MoveLocation_Reason,department:MoveDept,name:MoveEmployee,note:NoteDivLabel,_token:'{{csrf_token()}}'},
            success: function(data) {
                
            } 											 
            })
			
		}
		if(Sel=="Dispose"){
			var MoveLocation_Reason=document.getElementById('DisposeReason').value;
			var MoveDept="";
			var MoveEmployee="";
			var NoteDivLabel=document.getElementById('DisposeNote').value;
            var AssetTag=document.getElementById('AssetID').value;
            console.log(Sel+" MoveLocation_Reason: "+MoveLocation_Reason+", MoveDept:"+MoveDept+", MoveEmployee:"+MoveEmployee+", NoteDivLabel:"+NoteDivLabel+", AssetTag:"+AssetTag);
            $.ajax({
            type: 'POST',
            url: 'SaveAssetDisposalAudit',                
            data: {AuditName:AuditName,tag:AssetTag,location:MoveLocation_Reason,note:NoteDivLabel,_token:'{{csrf_token()}}'},
            success: function(data) {
                
            } 											 
            })
			
		}
		if(Sel=="Maintenance"){
			var MoveLocation_Reason=document.getElementById('MaintenanceReason').value;
			var MoveDept="";
			var MoveEmployee="";
			var NoteDivLabel=document.getElementById('MaintenanceNote').value;
			var DueDaate=document.getElementById('MaintenanceDueDate').value;
            var AssetTag=document.getElementById('AssetID').value;
            console.log(Sel+" MoveLocation_Reason: "+MoveLocation_Reason+", MoveDept:"+MoveDept+", MoveEmployee:"+MoveEmployee+", NoteDivLabel:"+NoteDivLabel+", AssetTag:"+AssetTag);
            $.ajax({
            type: 'POST',
            url: 'SaveAssetMaintenanceAudit',                
            data: {AuditName:AuditName,tag:AssetTag,location:MoveLocation_Reason,note:NoteDivLabel,DueDate:DueDaate,_token:'{{csrf_token()}}'},
            success: function(data) {
                
            } 											 
            })
			
		}
		if(Sel=="Other"){
			var MoveLocation_Reason="";
			var MoveDept="";
			var MoveEmployee="";
			var NoteDivLabel=document.getElementById('AssetAuditNote').value;
            var AssetTag=document.getElementById('AssetID').value;
            console.log(Sel+" MoveLocation_Reason: "+MoveLocation_Reason+", MoveDept:"+MoveDept+", MoveEmployee:"+MoveEmployee+", NoteDivLabel:"+NoteDivLabel+", AssetTag:"+AssetTag);
            $.ajax({
            type: 'POST',
            url: 'SaveAssetOtherAudit',                
            data: {AuditName:AuditName,tag:AssetTag,note:NoteDivLabel,_token:'{{csrf_token()}}'},
            success: function(data) {
                
            } 											 
            })
			// $.ajax({
			// type: 'POST',
			// url: ' SaveAssetNoneReconcileEdit.php',                
			// data: {AuditName:AuditName,Tag:AssetTag,Reason:MoveLocation_Reason,Note:NoteDivLabel,c:i},
			// success: function(data) {
				
			// } 											 
			// })
		}
        alert('Reconcile Asset for this item is now recorded on this audit. <?php echo date('m-d-Y'); ?>');	
        post('audit_detail', {name: 'PhaseTwoAuditSubmit'},'POST',AuditName);
		//post('Main_Audit_Phase_Two.php', {name: 'PhaseTwoAuditSubmit'},'POST',AuditName);
		}
	
		
		
    }
    function post(path, params, method,AuditName) {
		method = method || "post"; // Set method to post by default if not specified.

		// The rest of this code assumes you are not using a library.
		// It can be made less wordy if you use one.
		var form = document.createElement("form");
		form.setAttribute("method", method);
		form.setAttribute("action", path);

		for(var key in params) {
			if(params.hasOwnProperty(key)) {
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				hiddenField.setAttribute("id", "hiddenPostSubmit");
				hiddenField.setAttribute("name", params[key]);
				hiddenField.setAttribute("value", AuditName);

				form.appendChild(hiddenField);
				
				var hiddenField = document.createElement("input");
				hiddenField.setAttribute("type", "hidden");
				
				hiddenField.setAttribute("name", 'AuditWindowName');
				hiddenField.setAttribute("value", AuditName);

				form.appendChild(hiddenField);
			}
		}
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            
            hiddenField.setAttribute("name", '_token');
            hiddenField.setAttribute("value", '{{csrf_token()}}');

            form.appendChild(hiddenField);
		document.body.appendChild(form);
		form.submit();
    }
    function FinishAudit(){
        var AuditName="<?php echo $AuditWindowName; ?>";
        $.ajax({
            type: 'POST',
            url: 'FinishAudit',                
            data: {AuditName:AuditName,_token:'{{csrf_token()}}'},
            success: function(data) {
                location.href="audit";
            } 											 
        })
    }
    </script>
    <div id="NotFoundReconcileModal"></div>
    <table class="table table-hover table-sm" style="background-color:white;color:#083240;" id="" tabindex="-1">
        <thead style="background-color:#124f62; color:white;">
            <tr style="background-color:#083240">
                <th colspan="12" style="text-align:center;">ASSET UNASSIGNED TO THIS LOCATION</th>
            </tr>
            <tr>
                <th>Asset Tag</th>
                <th>Asset</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Brand</th>
                <th>Serial Number</th>
                <th>Plate Number</th>
                <th>Department</th>
                <th>Initial Value</th>
                <th>Depreciated Value</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody id="ANOTHERLOC">
            @foreach ($audit_asset_from_other_location as $rows)
                <tr>
                    <td data-audit-status="{{$rows->audit_status}}">{{$rows->asset_tag}}</td>
                    <?php
                        $ViewAssetDesc="";
                        $CategoryNameFull="";
                        $ViewAssetSub="";
                    ?>
                    @foreach ($asset_setup_lists as $setup)
                        @if ($setup->asset_setup_ad==$rows->asset_description)
                        <?php 
                        $ViewAssetDesc=$setup->asset_setup_description;
                        ?>
                        @endif
                        @if ($setup->asset_setup_ac==$rows->asset_category_name)
                        <?php 
                        $CategoryNameFull=$setup->asset_setup_category;
                        ?> 
                        @endif
                        @if ($setup->asset_setup_sc==$rows->asset_sub_category)
                        <?php 
                        $ViewAssetSub=$setup->asset_setup_sub_cat;
                        ?> 
                        @endif
                    @endforeach
                    <td >{{$ViewAssetDesc}}</td>
                    <td>{{$CategoryNameFull}}</td>
                    <td>{{$ViewAssetSub}}</td>
                    <td>{{$rows->asset_brand}}</td>
                    <td>{{$rows->asset_serial_number}}</td>
                    <td>{{$rows->sku_code}}</td>
                    <td>{{$rows->department_name}}</td>
                    <td>{{number_format($rows->initial_value,2)}}</td>
                    <td>{{number_format($rows->current_cost,2)}}</td>
                    <td>
                        <?php 
                        if($rows->asset_transaction_status=="1" || $rows->asset_transaction_status=="2.1" || $rows->asset_transaction_status=="2.2" ){
                            echo "Available";
                        }
                        if($rows->asset_transaction_status=="2" || $rows->asset_transaction_status=="1.1" || $rows->asset_transaction_status=="1.2"){
                            echo "Checked Out";
                        }
                        
                        if($rows->asset_transaction_status=="4.1" || $rows->asset_transaction_status=="4.2"){
                            echo "Queued for Maintenance";
                        }
                        if($rows->asset_transaction_status=="4"){
                            echo "On Maintenace";
                        }
                        if($rows->asset_transaction_status=="3.1" || $rows->asset_transaction_status=="3.2"){
                            echo "Queued for Disposal";
                        }
                        ?>
                    </td>
                </tr>  
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12" style="text-align:right;">
            <a class="btn btn-default" href="audit" id="ReconcileAuditBTN2" href="audit">Cancel</a>
            <button class="btn btn-primary" id="ReconcileAuditBTN" onclick="FinishAudit()">Finish Audit</button>
        </div>
    </div>
</div>
@endsection