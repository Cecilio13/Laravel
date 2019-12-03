<?php
if($Type=="LS1"){
?>
<tr id="parameterTR">
	<td width="25%" style="text-align:right;vertical-align:middle;"></td>
	<td style="vertical-align:middle;">
	<input type="hidden" id="Parameter2" value="">
	<input type="hidden" id="Parameter" value="">
	</td>
	<td width="40%"></td>
</tr>
<?php	
}
if($Type=="A1" || $Type=="B1" || $Type=="D1"){
?>
<tr id="parameterTR">
	<td width="25%" style="text-align:right;vertical-align:middle;">Asset Type</td>
	<td style="vertical-align:middle;">
	<input type="hidden" id="Parameter2" value="">
	<select class="form-control" id="Parameter">
		<option>All</option>
		<option>Current Asset</option>
		<option>Non-Current Asset</option>
	</select>
	</td>
	<td width="40%"></td>
</tr>
<?php	
}
if($Type=="C1"){
?>
<tr id="parameterTR" style="display:none;">
	<td width="25%" style="text-align:right;vertical-align:middle;">Audit Name</td>
	<td style="vertical-align:middle;">
	<input type="hidden" id="Parameter2" value="">
	<select class="form-control" id="Parameter" >
	
			<option></option>
		
	</select>
	</td>
	<td width="40%"></td>
	
</tr>
<?php	
	
}
if($Type=="A2" || $Type=="B2" || $Type=="C2" || $Type=="D2"){
?>
<tr id="parameterTR">
	<td width="10%" style="text-align:right;vertical-align:middle;">Location</td>
	<td style="vertical-align:middle;">
	
	<select class="form-control" id="Parameter" onchange="ChangeSiteValues()">
		<option>All</option>
        @foreach ($location_list_active as $loc)
            <option>{{$loc->asset_setup_location}}</option>
        @endforeach
	</select>
	</td>
	<td width="10%" style="text-align:right;vertical-align:middle;">Site</td>
	<td >
		<select class="form-control" id="Parameter2">
			<option></option>
		
		</select>
	</td>
	<td width="25%"></td>
</tr>
<?php
}
if($Type=="A3" || $Type=="B3" || $Type=="C3" || $Type=="D3"){
?>
<tr id="parameterTR">
	<td width="25%" style="text-align:right;vertical-align:middle;">Department</td>
	<td style="vertical-align:middle;">
	<input type="hidden" id="Parameter2" value="">
	
    <select  id="Parameter" class="form-control">
        <option value="">--Select--</option>
        @foreach ($company_department_active as $dept)
            <option value="{{$dept->department_id}}">{{$dept->department_name}}</option>
        @endforeach
    </select>
	</td>
	<td width="40%"></td>
</tr>
<?php
}
?>
