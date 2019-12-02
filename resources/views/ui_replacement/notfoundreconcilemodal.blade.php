<div class="modal fade" id="NotFoundReconcileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:70% !important;min-width:70% !important;">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table borderless" style="background-color:white;color:#083240" id="TableAssetCheckin">
                            <thead style="background-color:#124f62; color:white;">
                                <tr>
                                    <th colspan="7">Asset Detail</th>
                                </tr>
                            </thead>
                            <tbody >
                                
                                <tr>
                                    <td style="vertical-align: middle;color:#083240" colspan="2" ><legend>Asset Details</legend></td>
                                    <td style="vertical-align: middle;color:#083240" colspan="2" ><legend>Last Held By</legend></td>
                                    
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;text-align:right;font-weight:bold;" >Asset Tag *</td>
                                    <td style="vertical-align: middle;">
                                        <input type="hidden"   id="AssetID" class="form-control" value="<?php echo $id; ?>" readonly>
                                        <input type="text"   id="AssetTag" class="form-control" value="<?php echo $Selected; ?>" readonly>
                                    </td>
                                    
                                    <td style="vertical-align: middle;text-align:right;font-weight:bold;">Employee ID </td>
                                    <td style="vertical-align: middle;"><input type="text" style="width:60%;" id="CustomerID" value="<?php echo $LastHeldBy; ?>" class="form-control" readonly>
                                    <div id="SearchResult2"></div></td>	
                                    
                                    
                                </tr>
                                
                                <tr>
                                    <td style="vertical-align: middle;text-align:right;font-weight:bold;" >Asset</td>
                                    <td style="vertical-align: middle;"><input type="text" readonly class="form-control" id="asset_description" rows="1" value='<?php echo $Description; ?>'></td>
                                    <td style="vertical-align: middle;text-align:right;font-weight:bold;">Employee Name</td>
                                    <td style="vertical-align: middle;"><input type="text" style="width:60%;"  id="EmployeeName" class="form-control" value="<?php echo $NameEMp; ?>" readonly></td>
                                    
                                    <td style="vertical-align: middle;"><input type="date"  class="form-control" id="DueDate" style="display:none;"></td>
                                    <td style="vertical-align: middle;"></td>
                                    <td style="vertical-align: middle;"></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;text-align:right;font-weight:bold;" >Location</td>
                                    <td style="vertical-align: middle;"><input type="text" id="AssetLocation" value="<?php echo $Locations; ?>" readonly class="form-control"></td>
                                    <td style="vertical-align: middle;text-align:right;font-weight:bold;"></td>
                                    <td style="vertical-align: middle;"></td>
                                    
                                </tr>
                                
                                <tr>
                                    <td style="vertical-align: middle;text-align:right;font-weight:bold;" >Department Name</td>
                                    <td style="vertical-align: middle;">
                                        <select  id="DepartmentName" class="form-control" style="background-color:white !important;border: 1px solid #ced4da !important;" disabled>
                                            <option value=""></option>
                                            @foreach ($company_department_active as $dept)
                                                <option value="{{$dept->department_id}}" {{$dept->department_id==$asset_department_code? 'Selected' : ''}}>{{$dept->department_name}}</option>
                                            @endforeach
                                        </select>
                                       </td>
                                    <td style="vertical-align: middle;"></td>
                                    <td style="vertical-align: middle;"></td>
                                    <td style="vertical-align: middle;"></td>
                                    <td style="vertical-align: middle;"></td>
                                    <td style="vertical-align: middle;"></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;" ></td>
                                    <td style="vertical-align: middle;"></td>
                                    <td style="vertical-align: middle;"></td>
                                    <td style="vertical-align: middle;"></td>
                                    <td style="vertical-align: middle;"></td>
                                    <td style="vertical-align: middle;"><input type="hidden" id="HiddenType"></td>
                                    <td style="vertical-align: middle;"></td>
                                </tr>
                                
                            </tbody>
                    </table>
                </div>
            </div>
            <script>
            getRadioValue();
            function getRadioValue(){
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
                    document.getElementById('MoveAssetToLocation').disabled=false;
                    document.getElementById('MoveAssetToDept').disabled=false;
                    document.getElementById('MoveAssetToSite').disabled=false;
                    
                    document.getElementById('ReassignTo').disabled=false;
                    document.getElementById('MoveAssetNote').disabled=false;
                    
                    document.getElementById('DisposeReason').disabled=true;
                    document.getElementById('DisposeNote').disabled=true;
                    document.getElementById('DisposeReason').value="Damaged";
                    document.getElementById('DisposeNote').value="";
                    
                    document.getElementById('MaintenanceReason').disabled=true;
                    document.getElementById('MaintenanceNote').disabled=true;
                    document.getElementById('MaintenanceDueDate').disabled=true;
                    document.getElementById('MaintenanceReason').value="Regular Check up";
                    document.getElementById('MaintenanceNote').value="";
                    document.getElementById('MaintenanceDueDate').value="";
                    
                    document.getElementById('AssetAuditNote').disabled=true;
                    document.getElementById('AssetAuditNote').value="";
                }
                if(Sel=="Dispose"){
                    document.getElementById('DisposeReason').disabled=false;
                    document.getElementById('DisposeNote').disabled=false;
                    
                    document.getElementById('MoveAssetToLocation').disabled=true;
                    document.getElementById('MoveAssetToDept').disabled=true;
                    document.getElementById('MoveAssetToSite').disabled=true;
                    document.getElementById('ReassignTo').disabled=true;
                    document.getElementById('MoveAssetNote').disabled=true;
                    document.getElementById('MoveAssetToLocation').value="{{$Locations}}";
                    document.getElementById('MoveAssetNote').value="";
                    
                    document.getElementById('MaintenanceReason').disabled=true;
                    document.getElementById('MaintenanceNote').disabled=true;
                    document.getElementById('MaintenanceDueDate').disabled=true;
                    document.getElementById('MaintenanceReason').value="Regular Check up";
                    document.getElementById('MaintenanceNote').value="";
                    document.getElementById('MaintenanceDueDate').value="";
                    
                    document.getElementById('AssetAuditNote').disabled=true;
                    document.getElementById('AssetAuditNote').value="";
                }
                if(Sel=="Maintenance"){
                    document.getElementById('MaintenanceReason').disabled=false;
                    document.getElementById('MaintenanceNote').disabled=false;
                    document.getElementById('MaintenanceDueDate').disabled=false;
                    
                    document.getElementById('MoveAssetToLocation').disabled=true;
                    document.getElementById('MoveAssetToDept').disabled=true;
                    document.getElementById('MoveAssetToSite').disabled=true;
                    document.getElementById('ReassignTo').disabled=true;
                    document.getElementById('MoveAssetNote').disabled=true;
                    document.getElementById('MoveAssetToLocation').value="{{$Locations}}";
                    document.getElementById('MoveAssetNote').value="";
                    
                    document.getElementById('DisposeReason').disabled=true;
                    document.getElementById('DisposeNote').disabled=true;
                    document.getElementById('DisposeReason').value="Damaged";
                    document.getElementById('DisposeNote').value="";
                    
                    document.getElementById('AssetAuditNote').disabled=true;
                    document.getElementById('AssetAuditNote').value="";
                }
                if(Sel=="Other"){
                    document.getElementById('AssetAuditNote').disabled=false;
                    
                    document.getElementById('MaintenanceReason').disabled=true;
                    document.getElementById('MaintenanceNote').disabled=true;
                    document.getElementById('MaintenanceDueDate').disabled=true;
                    document.getElementById('MaintenanceReason').value="Regular Check up";
                    document.getElementById('MaintenanceNote').value="";
                    document.getElementById('MaintenanceDueDate').value="";
                    
                    document.getElementById('MoveAssetToLocation').disabled=true;
                    document.getElementById('MoveAssetToDept').disabled=true;
                    document.getElementById('MoveAssetToSite').disabled=true;
                    document.getElementById('ReassignTo').disabled=true;
                    document.getElementById('MoveAssetNote').disabled=true;
                    document.getElementById('MoveAssetToLocation').value="{{$Locations}}";
                    document.getElementById('MoveAssetNote').value="";
                    
                    document.getElementById('DisposeReason').disabled=true;
                    document.getElementById('DisposeNote').disabled=true;
                    document.getElementById('DisposeReason').value="Damaged";
                    document.getElementById('DisposeNote').value="";
                }
            }
            </script>
            <?php
            if($audit_action=="Other"){
            ?>
            <script>
            $('input:radio[name="optradio"]').filter('[value="Other"]').prop('checked', true);
            document.getElementById('AssetAuditNote').value="<?php echo $audit_action_note; ?>";
            </script>
            <?php
            }
            if($audit_action=="Maintenance"){
            ?>
            <script>
            $('input:radio[name="optradio"]').filter('[value="Maintenance"]').prop('checked', true);
            document.getElementById('MaintenanceNote').value="<?php echo $audit_action_note; ?>";
            document.getElementById('MaintenanceReason').value="<?php echo $audit_action_reason; ?>";
            document.getElementById('MaintenanceDueDate').value="<?php echo $maintenanceduedate; ?>";
            </script>
            <?php	
            }
            if($audit_action=="Dispose"){
            ?>
            <script>
            $('input:radio[name="optradio"]').filter('[value="Dispose"]').prop('checked', true);
            document.getElementById('DisposeNote').value="<?php echo $audit_action_note; ?>";
            document.getElementById('DisposeReason').value="<?php echo $audit_action_reason; ?>";
            </script>
            <?php	
            }
            if($audit_action=="Move/Assign To"){
            ?>
            <script>
            $('input:radio[name="optradio"]').filter('[value="Move"]').prop('checked', true);
            document.getElementById('MoveAssetNote').value="<?php echo $audit_action_note; ?>";
            document.getElementById('MoveAssetToLocation').value="<?php echo $audit_action_reason; ?>";
            document.getElementById('MoveAssetToDept').value="<?php echo $audit_move_department; ?>";
            document.getElementById('ReassignTo').value="<?php echo $audit_move_employee; ?>";
            document.getElementById('MoveAssetToSite').value="<?php echo $maintenanceduedate; ?>";
            </script>
            <?php	
            }
            ?>
            <div class="row">
                <div class="col-md-12">
                    <table class="table borderless" style="background-color:white; color:#083240" id="TableMoveAsset">
                            <thead style="background-color:#124f62; color:white;">
                                <tr>
                                    <th colspan="4">Reconcile Option</th>
                                </tr>
                            </thead>
                            <tbody >
                                <tr>
                                    <td width="50%" style="vertical-align: middle;color:#083240;" colspan="2" >
                                    
                                    <legend><input type="radio" name="optradio" onclick="getRadioValue()" value="Move" checked> Move/Assign To</legend></td>
                                    <td width="50%" style="vertical-align: middle;color:#083240;" colspan="2" ><legend><input type="radio" value="Dispose" onclick="getRadioValue()" name="optradio" > Dispose</legend></td>
                                    
                                </tr>
                                <tr>
                                    
                                    <td style="vertical-align: middle;text-align:right;">Move To Location</td>
                                    <td style="vertical-align: middle;"><input type="text"list="LocSearchReultGeneral" onkeyup="GetExistingLocationGeneral()" onclick="GetExistingLocationGeneral()" oninput="GetExistingLocationGeneral()" style="width:70%;" value="{{$Locations}}" class="form-control" id="MoveAssetToLocation">
                                    <div id="MoveToLocationSearchDiv"></div>
                                    
                                    </td>
                                    <td style="vertical-align: middle;text-align:right; " width="10%">Dispose Reason</td>
                                    <td style="vertical-align: middle;" width="40%">
                                    <select id="DisposeReason" class="form-control" style="width:70%;">
                                        <option>Damaged</option>
                                        <option>Retire</option>
                                        <option>Lost</option>
                                        <option>Sold</option>
                                        <option>Stolen</option>
                                        <option>Trade In</option>
                                    </select>
                                    </td>
                                </tr>
                                <tr>
                                    
                                    <td style="vertical-align: middle;text-align:right;">Move to Site</td>
                                    <td style="vertical-align: middle;">
                                    <input type="text" style="width:70%;" list="siteSearchReultDivGeneral" value="{{$Site}}" onkeyup="GetExistingSitesGeneral()" onclick="GetExistingSitesGeneral()" oninput="GetExistingSitesGeneral()"  class="form-control" id="MoveAssetToSite">
                                    
                                    </td>
                                    <td style="vertical-align: middle;text-align:right;" rowspan="2">Note</td>
                                    <td style="vertical-align: middle;" rowspan="2"><textarea class="form-control" style="width:70%;" rows="2" id="DisposeNote"></textarea></td>
                                </tr>
                                <tr>
                                    
                                    <td style="vertical-align: middle;text-align:right;">Move to Department</td>
                                    <td style="vertical-align: middle;">
                                        <select  id="MoveAssetToDept" class="form-control" style="width:70%;background-color:white !important;border: 1px solid #ced4da !important;" disabled>
                                            <option value=""></option>
                                            @foreach ($company_department_active as $dept)
                                                <option value="{{$dept->department_id}}" {{$dept->department_id==$asset_department_code? 'Selected' : ''}}>{{$dept->department_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    
                                    <td style="vertical-align: middle;text-align:right;">Reassign/Assign To Employee </td>
                                    <td style="vertical-align: middle;">
                                        <select type="text" id="ReassignTo" class="form-control"  style="width:70%;" placeholder="Scan Person Here...." >
                                            <option value="">--Select Employee--</option>
                                            @foreach ($employee_list as $emp)
                                                <option value="{{$emp->employee_id}}" {{$AssignTo==$emp->employee_id}}>{{$emp->fname." ".$emp->lname}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    
                                    <td style="vertical-align: middle;text-align:right;">Notes</td>
                                    <td style="vertical-align: middle;"><textarea class="form-control" style="width:70%;" rows="2"id="MoveAssetNote"></textarea></td>
                                    
                                </tr>
                                <tr style="height:50px;">
                                    <td></td>
                                </tr>
                                <tr>
                                    <td width="50%" style="vertical-align: middle;color:#083240;" colspan="2" ><legend><input type="radio" value="Maintenance" name="optradio" onclick="getRadioValue()" > Maintenance</legend></td>
                                    <td style="vertical-align: middle;color:#083240;" colspan="2" ><legend><input type="radio" value="Other" name="optradio" onclick="getRadioValue()" > Other</legend></td>
                                    
                                </tr>
                                <tr>
                                    
                                    <td style="vertical-align: middle;text-align:right; " width="10%">Maintenance Reason</td>
                                    <td style="vertical-align: middle;" width="40%">
                                    <select id="MaintenanceReason" class="form-control" style="width:70%;">
                                        <option>Regular Check up</option>
                                        <option>Damaged</option>
                                        
                                    </select>
                                    </td>
                                    <td style="vertical-align: middle;text-align:right; ">Note</td>
                                    <td style="vertical-align: middle;"><textarea style="width:60%;"  id="AssetAuditNote" class="form-control" ></textarea></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;text-align:right;" rowspan="1">Due Date</td>
                                    <td style="vertical-align: middle;" rowspan="1"><input type="date" class="form-control"  style="width:70%;" id="MaintenanceDueDate"></td>
                                    
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: middle;text-align:right;" rowspan="1">Note</td>
                                    <td style="vertical-align: middle;" rowspan="1"><textarea class="form-control" rows="3" style="width:70%;" id="MaintenanceNote"></textarea></td>
                                </tr>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" onclick="ReconcileAssetEdit()">Reconcile Asset</button>

        </div>
        </div>
    </div>
</div>