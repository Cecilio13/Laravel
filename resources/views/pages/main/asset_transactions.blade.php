@extends('main.main')


@section('content')
<div class="container-fluid" style="margin-bottom:10px;">
    <div class="row">
        <div class="col-md-12">
            <h2 style="font-weight:bold;color:#083240;margin-top:10px;margin-bottom:20px;">TRANSACTION</h2>
        </div>
    </div>
    <ul class="nav nav-tabs nav-tab-custom" style="display:inline-flex;width:100%;"   role="tablist">
        <li class="nav-item" >
            <a class="nav-link {{($page=='1'? 'active' : ($page==''? 'active' : '') )}}" id="viewasset-tab" data-toggle="tab" href="#TransCheckOut" role="tab" aria-controls="home" aria-selected="true">Check Out</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link {{($page=='2'? 'active' : '' )}}" id="newasset-tab" data-toggle="tab" href="#TransCheckIN" role="tab" aria-controls="profile" aria-selected="false">Check In</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='3'? 'active' : '' )}}" id="assetinfo-tab" data-toggle="tab" href="#TransMoveAssignTo" role="tab" aria-controls="contact" aria-selected="false">Move/Assign To</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='4'? 'active' : '' )}}" id="assetinfo-tab" data-toggle="tab" href="#TransDispose" role="tab" aria-controls="contact" aria-selected="false">Dispose</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='5'? 'active' : '' )}}" id="assetinfo-tab" data-toggle="tab" href="#TransRecover" role="tab" aria-controls="contact" aria-selected="false">Recover</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='6'? 'active' : '' )}}" id="assetinfo-tab" data-toggle="tab" href="#TransMaintenance" role="tab" aria-controls="contact" aria-selected="false">Maintenance</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='7'? 'active' : '' )}}" id="assetinfo-tab" data-toggle="tab" href="#TransExtendCheckOut" role="tab" aria-controls="contact" aria-selected="false">Extend Check Out</a>
        </li>
    </ul>
    <div class="tab-content" id="AssetPageTabs" style="margin-bottom:10px;">
        <div class="tab-pane fade {{($page=='1'? 'active show' : ($page==''? 'active show' : '') )}}" id="TransCheckOut" role="tabpanel" aria-labelledby="home-tab" style="background-color:transparent !important;padding-top:10px;">
            <table class="table borderless table-sm" style="background-color:white;color:#083240" id="TableAssetCheckin">
                <thead style="background-color:#124f62; color:white;">
                    <tr>
                        <th colspan="7">Asset Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;color:#083240">Scan Here</td>
                        <td style="vertical-align: middle;">
                        <script>
                            function getAssetInfoCheckOut(){
                                var value=document.getElementById('ScanBox').value;
                                document.getElementById('ScanBox').value="";
                                $('#ScanBox').selectpicker('refresh');
                                $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'get_asset_info_checkout',                
                                data:{value:value,_token: '{{csrf_token()}}'},
                                success: function(data) {
                                    if(data==""){
                                        document.getElementById('AssetTag').value="";
                                        document.getElementById('asset_description').value="";
                                        document.getElementById('AssetSite').value="";
                                        document.getElementById('AssetLocation').value="";
                                        document.getElementById('DepartmentName').value="";
                                        document.getElementById('asset_id_checkout').value="";
                                        document.getElementById('AddQueueCheckout').disabled=true;
                                    }else{
                                        document.getElementById('asset_id_checkout').value=value;
                                        document.getElementById('AssetTag').value=data[0]['asset_tag'];
                                        document.getElementById('asset_description').value=data[0]['asset_setup_description'];
                                        document.getElementById('AssetSite').value=data[0]['asset_site'];
                                        document.getElementById('AssetLocation').value=data[0]['asset_location'];
                                        document.getElementById('DepartmentName').value=data[0]['asset_department_code'];
                                        document.getElementById('AddQueueCheckout').disabled=false;
                                    }
                                    
                                }  
                                }) 
                            }
                            function ClearAll(){
                                //check outs
                                document.getElementById('AssetTag').value="";
                                document.getElementById('asset_description').value="";
                                document.getElementById('AssetSite').value="";
                                document.getElementById('AssetLocation').value="";
                                document.getElementById('DepartmentName').value="";
                                document.getElementById('CustomerID').value="";
                                document.getElementById('Due').value="";
                                document.getElementById('DueDate').value="Default";
                                document.getElementById('ScanBox').value="";
                                document.getElementById('asset_id_checkout').value="";
                                $('#ScanBox').selectpicker('refresh');
                                $('#CustomerID').selectpicker('refresh');
                                document.getElementById('AddQueueCheckout').disabled=true;

                                //check ins
                                document.getElementById('AssetTagIN').value="";
                                document.getElementById('AssetDescIN').value="";
                                document.getElementById('AssetSiteIN').value="";
                                document.getElementById('LocationIN').value="";
                                document.getElementById('DepartmentIN').value="";
                                document.getElementById('asset_id_checkin').value="";
                                document.getElementById('DueDateIN').value="";
                                document.getElementById('AssignTOIN').value="";
                                document.getElementById('HiddenTransactionIDIN').value="";
                                document.getElementById('checkin_addtoqueue_btn').disabled=true;

                                //extend due date
                                document.getElementById('AssetTagExtendDue').value="";
                                document.getElementById('AssetDescExtendDue').value="";
                                document.getElementById('SiteExtendDue').value="";
                                document.getElementById('LocationExtendDue').value="";
                                document.getElementById('DepartmentExtendDue').value="";
                                document.getElementById('asset_id_extend_checout_due_date').value="";
                                document.getElementById('OldDueExtendDue').value="";
                                document.getElementById('EmployeeNameExtendDue').value="";
                                document.getElementById('HiddenTransactionIDExtendDue').value="";
                                document.getElementById('extend_duedate_add_to_queue').disabled=true;
                                document.getElementById('DueDateExtendDue').min="";
                                document.getElementById('DueDateExtendDue').value="";
                                
                                //move/assign to
                                document.getElementById('MoveAssetTag').value="";
                                document.getElementById('MoveAssetDesc').value="";
                                document.getElementById('MoveAssetFromSite').value="";
                                document.getElementById('MoveAssetToSite').value="";
                                document.getElementById('MoveAssetFromLocation').value="";
                                document.getElementById('MoveAssetToLocation').value="";
                                document.getElementById('MoveAssetDept').value="";
                                document.getElementById('MoveAssetToDept').value="";
                                document.getElementById('asset_id_move').value="";
                                document.getElementById('ReassignTo').value="";
                                document.getElementById('addtoqueuemoveasset').disabled=true;
                                $('#MoveAssetTag').selectpicker('refresh');
                                $('#MoveAssetToDept').selectpicker('refresh');

                                //dispose
                                document.getElementById('DisposeAssetDesc').value="";
                                document.getElementById('DisposeDept').value="";
                                document.getElementById('asset_id_dispose').value="";
                                document.getElementById('DisposeAssetTag').value="";
                                $('#DisposeAssetTag').selectpicker('refresh');
                                document.getElementById('addtoqueuedisposeasset').disabled=true;

                                //maintenance
                                document.getElementById('MaintenanceAssetDesc').value="";
                                document.getElementById('MaintenanceDept').value="";
                                document.getElementById('maintenance_asset_id').value="";
                                document.getElementById('MaintenanceAssetTag').value="";
                                document.getElementById('maintenancesaveformaintenance').disabled=true;
                                $('#MaintenanceAssetTag').selectpicker('refresh');
                                
                                //recover
                                document.getElementById('DescRecover').value="";
                                document.getElementById('DeptRecover').value="";
                                document.getElementById('recover_asset_id').value="";
                                document.getElementById('AssetTagRecover').value="";
                                document.getElementById('recoverassetsavebtn').disabled=true;
                                $('#AssetTagRecover').selectpicker('refresh');
                            }
                            function AddToQueue(){
                                var AssetTag=document.getElementById('AssetTag').value;
                                var Assignto=document.getElementById('CustomerID').value;
                                var Due=document.getElementById('Due').value;
                                var DescriptionAsset=document.getElementById('asset_description').value;
                                var CustomerID=document.getElementById('CustomerID').value;
                                var DueDate=document.getElementById('DueDate').value;
                                var AssetLocation=document.getElementById('AssetLocation').value;
                                
                                var DepartmentName=document.getElementById('DepartmentName').value;
                                var HiddenType=document.getElementById('HiddenType').value;
                                if(document.getElementById("TRASSETQUEUE"+AssetTag)){
                                    alert('Asset Already in Queue...');
                                }else{
                                if(AssetTag=="" || CustomerID==""){
                                    alert('Fill up the Necessary Fields...');
                                    
                                }else{
                                var dat = new Date();
                                var FinalDate="";
                                if(Due=='Default'){
                                    dat.setDate(dat.getDate()+5);
                                    dat.setMonth(dat.getMonth());
                                    
                                    FinalDate=dat.getFullYear()+"-"+dat.getUTCMonth()+"-"+dat.getDate();
                                }
                                if(Due=='Custom'){
                                    FinalDate=DueDate;
                                }
                                console.log(dat);
                                
                                var t = document.getElementById('AssetQueueBody');
                                var tr = document.createElement("tr");
                                tr.setAttribute("id","TRASSETQUEUE"+AssetTag);
                                var td1 = document.createElement("td"); 
                                var td2 = document.createElement("td"); 
                                var td3 = document.createElement("td"); 
                                var td4 = document.createElement("td"); 
                                var td5 = document.createElement("td"); 
                                var td6 = document.createElement("td"); 
                                var td7 = document.createElement("td"); 
                                var td8 = document.createElement("td");
                                td1.setAttribute('data-asset-id',document.getElementById('asset_id_checkout').value);
                                td8.style.textAlign="center";
                                td8.style.verticalAlign ="middle";
                                
                                var x8=document.createElement("a");
                                x8.setAttribute("class", "fa fa-times btn btn-link");
                                x8.setAttribute("onclick", "RemoveQueue('TRASSETQUEUE"+AssetTag+"')");
                                x8.style.color ="#bf1616";
                                var x1=document.createTextNode(AssetTag);
                                //x1.innerHTML=AssetTag;
                                var x2=document.createTextNode(DescriptionAsset);
                                //x2.innerHTML=DescriptionAsset;
                                var x3=document.createTextNode(HiddenType);
                                //x3.innerHTML=HiddenType;
                                var x4=document.createTextNode(AssetLocation);
                                //x4.innerHTML=AssetLocation;
                                var x5=document.createTextNode(DepartmentName);
                                //x5.innerHTML=DepartmentName;
                                var x6=document.createTextNode(CustomerID);
                                //x6.innerHTML=Assignto;
                                var x7=document.createTextNode(FinalDate);
                                //x7.innerHTML=FinalDate;
                                td1.appendChild(x1);
                                td2.appendChild(x2);
                                td3.appendChild(x3);
                                td4.appendChild(x4);
                                td5.appendChild(x5);
                                td6.appendChild(x6);
                                td7.appendChild(x7);
                                td8.appendChild(x8);
                                
                                tr.appendChild(td1);
                                tr.appendChild(td2);
                                tr.appendChild(td3);
                                tr.appendChild(td4);
                                tr.appendChild(td5);
                                tr.appendChild(td6);
                                tr.appendChild(td7);
                                tr.appendChild(td8);
                                t.appendChild(tr);
                                document.getElementById('AssetTag').value="";
                                document.getElementById('AssetSite').value="";
                                
                                document.getElementById('asset_description').value="";
                                document.getElementById('CustomerID').value="";
                                document.getElementById('DueDate').value="";
                                document.getElementById('AssetLocation').value="";
                                
                                document.getElementById('DepartmentName').value="";
                                document.getElementById('HiddenType').value="";
                                
                                document.getElementById('AssetTag').style.backgroundColor="white";
                                
                                document.getElementById('asset_description').style.backgroundColor="white";
                                document.getElementById('CustomerID').style.backgroundColor="white";
                                document.getElementById('AssetLocation').style.backgroundColor="white";
                                document.getElementById('DepartmentName').style.backgroundColor="white";
                                
                                $('#CustomerID').selectpicker('refresh');
                                }
                                }
                            }
                            function RemoveQueue(e){
                                var t = document.getElementById('AssetQueueBody');
                                var tr = document.getElementById(e);
                                t.removeChild(tr);
                                
                            }
                            function SaveAssetRequest() {
                                // Declare variables 
                                var input, filter, table, tr, td, i, td2;
                                var count=0;
                                    
                                table = document.getElementById("TableQuueue");
                                tr = table.getElementsByTagName("tr");
                                // Loop through all table rows, and hide those who don't match the search query
                                for (i = 2; i < tr.length; i++) {
                                    td5 = tr[i].getElementsByTagName("td")[5];
                                    td0 = tr[i].getElementsByTagName("td")[0];
                                    td6 = tr[i].getElementsByTagName("td")[6];
                                    console.log(td0.getAttribute('data-asset-id')); 
                                    console.log(td5.innerHTML);
                                    console.log(td6.innerHTML);
                                    $.ajax({
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: 'SaveAssetCheckOut',                
                                    data:{Tag:td0.getAttribute('data-asset-id'),Assignee:td5.innerHTML,DueDate:td6.innerHTML,_token: '{{csrf_token()}}'},
                                    success: function(data) {
                                        RemoveQueue('TRASSETQUEUE'+td0.innerHTML);
                                    }  
                                    }) 
                                   
                                    
                                }
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Added Check Out Request',
                                }).then((result) => {
                                    location.href="transaction?page=1";
                                })
                                    
                            }
                        </script>
                        <select id="ScanBox" class="form-control selectpicker" data-live-search="true" onchange="getAssetInfoCheckOut()">
                            <option value="">--Select--</option>
                            @foreach ($for_checkout_asset_list as $item)
                                <option value="{{$item->id}}">{{$item->asset_tag}}</option>
                            @endforeach
                        </select>
                        </td>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;color:#083240;text-align:right;padding:0px" colspan="1" id="Title1"><h3 style="margin:0px;">Asset Details</h3></td>
                        <td style="vertical-align: middle;color:#083240;" colspan="1" id="Title2"></td>
                        <td style="vertical-align: middle;color:#083240;text-align:right;padding:0px" colspan="1" id="Title3"><h3 style="margin:0px;">Check Out To</h3></td>
                        <td style="vertical-align: middle;color:#083240;" colspan="1" id="Title4"></td>
                        <td colspan="1" style="vertical-align: middle;color:#083240;padding:0px" id="Title5"><h3 style="margin:0px;">Due Date</h3></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Asset Tag <input type="hidden" id="asset_id_checkout"></td>
                        <td style="vertical-align: middle;"><input type="text" id="AssetTag" class="form-control" onkeyup="CheckEmpID()"></td>
                        
                        <td style="vertical-align: middle;text-align:right;">Employee ID</td>
                        <td style="vertical-align: middle;">
                            <select type="text" id="CustomerID" class="form-control selectpicker"  data-live-search="true" placeholder="Scan Person Here...." >
                                <option value="">--Select Employee--</option>
                                @foreach ($employee_list as $emp)
                                    <option value="{{$emp->employee_id}}">{{$emp->fname." ".$emp->lname}}</option>
                                @endforeach
                            </select>
                        </td>	
                        <td style="vertical-align: middle;">
                           <select class="form-control" id="Due" onchange="ShowDue(this)">
                               <option>Default</option>
                               <option>Custom</option>
                           </select>
                        </td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                    </tr>
                    <script>
                        function ShowDue(e){
                            var vv=e.value;
                            if(vv=="Custom"){
                                document.getElementById('DueDate').style.display="inline";
                            }else{
                                document.getElementById('DueDate').style.display="NONE";
                            }
                        }
                    </script>
                    
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Asset </td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="asset_description"></td>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        
                        <td style="vertical-align: middle;"><input type="date" class="form-control" min="<?php echo date('Y-m-d') ?>" id="DueDate" style="display:none;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Site</td>
                        <td style="vertical-align: middle;"><input type="text" id="AssetSite" class="form-control"></td>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Location</td>
                        <td style="vertical-align: middle;"><input type="text" id="AssetLocation" class="form-control"></td>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Department Name</td>
                        <td style="vertical-align: middle;">
                            <select  id="DepartmentName" class="form-control" style="background-color:white !important;border: 1px solid #ced4da !important;" disabled>
                                <option value=""></option>
                                @foreach ($company_department_active as $dept)
                                    <option value="{{$dept->department_id}}">{{$dept->department_name}}</option>
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
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        
                        <td style="vertical-align: middle;"><input type="hidden" id="HiddenType"></td>
                        <td style="vertical-align: middle;text-align:right;" colspan="2">
                            <button class="btn btn-default" onclick="ClearAll()">Clear</button>
                            <button class="btn btn-primary" disabled="" id="AddQueueCheckout" onclick="AddToQueue()">Add to Queue</button>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <table class="table table-bordered table-sm" id="TableQuueue" style="background-color:white; color:#083240">
                <thead style="background-color:#124f62; color:white;">
                  <tr style="background-color:#083240">
                    <th colspan="11">Check Out Queue</th>
                  </tr>
                  <tr>
                    <th>Asset Tag</th>
                    <th>Asset </th>
                    <th>Asset Type</th>
                    <th>Location</th>
                    <th>Department</th>
                    <th>Assignee ID</th>
                    <th>Due Date</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="AssetQueueBody">
                
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12" style="text-align:right;">
                    <button class="btn btn-primary" onclick="SaveAssetRequest()">Check Out</button>
                </div>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='2'? 'active show' : '' )}}" id="TransCheckIN" role="tabpanel" aria-labelledby="home-tab" style="background-color:transparent !important;padding-top:10px;">
            <table class="table borderless table-sm " style="background-color:white; color:#083240" id="TableInputCheckin">
                <thead style="background-color:#124f62; color:white;">
                    <tr>
                        <th colspan="6">Asset Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;color:#083240">Scan Here</td>
                        <td style="vertical-align: middle;">
                            <select type="text" class="form-control selectpicker" data-live-search="true" id="CheckinScanBox" onchange="getAssetInfoCheckIn()">
                                <option value="">--Select--</option>
                                @foreach ($checked_out_asset_list as $co)
                                    <option value="{{$co->id}}">{{$co->asset_tag}}</option>
                                @endforeach
                            </select>
                            <script>
                            function getAssetInfoCheckIn(){
                                var value=document.getElementById('CheckinScanBox').value;
                                document.getElementById('CheckinScanBox').value="";
                                $('#CheckinScanBox').selectpicker('refresh');
                                $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'get_asset_info_checkin',
                                data:{value:value,_token: '{{csrf_token()}}'},
                                success: function(data) {
                                    if(data==""){
                                        document.getElementById('AssetTagIN').value="";
                                        document.getElementById('AssetDescIN').value="";
                                        document.getElementById('AssetSiteIN').value="";
                                        document.getElementById('LocationIN').value="";
                                        document.getElementById('DepartmentIN').value="";
                                        document.getElementById('asset_id_checkin').value="";
                                        document.getElementById('DueDateIN').value="";
                                        document.getElementById('AssignTOIN').value="";
                                        document.getElementById('HiddenTransactionIDIN').value="";
                                        document.getElementById('checkin_addtoqueue_btn').disabled=true;
                                    }else{
                                        document.getElementById('asset_id_checkin').value=data[0]['REQUEST_ID'];
                                        document.getElementById('AssetTagIN').value=data[0]['ASSET_TAG'];
                                        document.getElementById('AssetDescIN').value=data[0]['asset_setup_description'];
                                        document.getElementById('AssetSiteIN').value=data[0]['asset_site'];
                                        document.getElementById('LocationIN').value=data[0]['asset_location'];
                                        document.getElementById('DepartmentIN').value=data[0]['asset_department_code'];
                                        document.getElementById('AssignTOIN').value=data[0]['emp_id'];
                                        document.getElementById('DueDateIN').value=data[0]['asset_due_date'];
                                        document.getElementById('HiddenTransactionIDIN').value=data[0]['request_id'];
                                        document.getElementById('checkin_addtoqueue_btn').disabled=false;
                                    }
                                    
                                }  
                                }) 
                            }
                            function QueueCheckinAsset(){
                                var AssetTagIN=document.getElementById('AssetTagIN').value;
                                var AssignTOIN=document.getElementById('AssignTOIN').value;
                                var AssetDescIN=document.getElementById('AssetDescIN').value;
                                
                                var LocationIN=document.getElementById('LocationIN').value;
                                var DueDateIN=document.getElementById('DueDateIN').value;
                                var DepartmentIN=document.getElementById('DepartmentIN').value;
                                var HiddenTypeIN=document.getElementById('HiddenTypeIN').value;
                                var HiddenTransactionIDIN=document.getElementById('HiddenTransactionIDIN').value;
                                //var RemainingAmountAsset=document.getElementById('RemainingIN').value;
                                if(document.getElementById("TRASSETQUEUEIN"+AssetTagIN)){
                                    alert('Asset Already in Queue...');
                                }else{
                                var t = document.getElementById('AssetQueueBodyIN');
                                var tr = document.createElement("tr");
                                tr.setAttribute("id","TRASSETQUEUEIN"+AssetTagIN);
                                var td1 = document.createElement("td"); 
                                    td1.setAttribute('data-request-id',document.getElementById('asset_id_checkin').value);
                                var td2 = document.createElement("td"); 
                                var td3 = document.createElement("td"); 
                                var td4 = document.createElement("td"); 
                                var td5 = document.createElement("td"); 
                                var td6 = document.createElement("td"); 
                                var td7 = document.createElement("td"); 
                                var td8 = document.createElement("td");
                                var td9 = document.createElement("td");
                                //var td10 = document.createElement("td");
                                td9.style.textAlign="center";
                                td9.style.verticalAlign ="middle";
                                
                                var x9=document.createElement("a");
                                x9.setAttribute("class", "fa fa-times btn btn-link");
                                x9.setAttribute("onclick", "RemoveQueueIN('TRASSETQUEUEIN"+AssetTagIN+"')");
                                x9.style.color ="#bf1616";
                                //var x10=document.createTextNode(RemainingAmountAsset);
                                //td10.setAttribute("style", "display:none");
                                
                                var x1=document.createTextNode(AssetTagIN);
                                //x1.innerHTML=AssetTag;
                                var x2=document.createTextNode(HiddenTransactionIDIN);
                                //x2.innerHTML=DescriptionAsset;
                                var x3=document.createTextNode(AssetDescIN);
                                //x3.innerHTML=HiddenType;
                                var x4=document.createTextNode(HiddenTypeIN);
                                //x4.innerHTML=AssetLocation;
                                var x5=document.createTextNode(LocationIN);
                                //x5.innerHTML=DepartmentName;
                                var x6=document.createTextNode(DepartmentIN);
                                //x6.innerHTML=Assignto;
                                var x7=document.createTextNode(AssignTOIN);
                                var x8=document.createTextNode(DueDateIN);
                                
                                //x7.innerHTML=FinalDate;
                                td1.appendChild(x1);
                                td2.appendChild(x2);
                                td3.appendChild(x3);
                                //td4.appendChild(x4);
                                td5.appendChild(x5);
                                td6.appendChild(x6);
                                td7.appendChild(x7);
                                td8.appendChild(x8);
                                td9.appendChild(x9);
                                //td10.appendChild(x10);
                                
                                tr.appendChild(td1);
                                tr.appendChild(td2);
                                tr.appendChild(td3);
                                //tr.appendChild(td4);
                                tr.appendChild(td5);
                                tr.appendChild(td6);
                                tr.appendChild(td7);
                                tr.appendChild(td8);
                                tr.appendChild(td9);
                                //tr.appendChild(td10);
                                t.appendChild(tr);
                                document.getElementById('AssetTagIN').value="";
                                document.getElementById('AssignTOIN').value="";
                                
                                document.getElementById('AssetDescIN').value="";
                                
                                document.getElementById('LocationIN').value="";
                                document.getElementById('DueDateIN').value="";
                                document.getElementById('AssetSiteIN').value="";
                                document.getElementById('DepartmentIN').value="";
                                document.getElementById('HiddenTypeIN').value="";
                                document.getElementById('HiddenTransactionIDIN').value="";
                                
                                document.getElementById('AssetDescIN').readOnly =false;
                               
                                document.getElementById('LocationIN').readOnly =false;
                                document.getElementById('DueDateIN').readOnly =false;
                                document.getElementById('DepartmentIN').readOnly =false;
                                document.getElementById('AssetTagIN').readOnly =false;
                                document.getElementById('AssignTOIN').readOnly =false;
                                
                                }
                            }
                            function RemoveQueueIN(e){
                                var t = document.getElementById('AssetQueueBodyIN');
                                var tr = document.getElementById(e);
                                t.removeChild(tr);
                                
                            }
                            function SaveAssetRequestIN() {
                                // Declare variables 
                                var input, filter, table, tr, td, i, td2;
                                var count=0;
                                    
                                table = document.getElementById("TableQuueueIN");
                                tr = table.getElementsByTagName("tr");
                                // Loop through all table rows, and hide those who don't match the search query
                                for (i = 2; i < tr.length; i++) {
                                    td0 = tr[i].getElementsByTagName("td")[0];
                                    console.log(td0.getAttribute('data-request-id'));
                                    
                                    $.ajax({
                                    type: 'POST',
                                    url: ' SaveAssetCheckIn',                
                                    data: {request_id:td0.getAttribute('data-request-id'),_token:'{{csrf_token()}}'},
                                    success: function(data) {
                                        RemoveQueueIN('TRASSETQUEUEIN'+td0.innerHTML);
                                        
                                    } 											 
                                    })
                                    
                                }
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Added Check In Request',
                                }).then((result) => {
                                    location.href="transaction?page=2";
                                })
                            }
                            </script>
                        </td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;color:#083240;text-align:right;padding:0px" colspan="1" id="Title1"><h3 style="margin:0px;">Asset Details</h3></td>
                        <td style="vertical-align: middle;color:#083240;" colspan="1" id="Title2"></td>
                        <td style="vertical-align: middle;color:#083240;text-align:right;padding:0px" colspan="1" id="Title3"><h3 style="margin:0px;">Check In By</h3></td>
                        <td style="vertical-align: middle;color:#083240;" colspan="1" id="Title4"></td>
                        <td colspan="1" style="vertical-align: middle;color:#083240;padding:0px" id="Title5"><h3 style="margin:0px;"></h3></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Asset Tag</td>
                        <td style="vertical-align: middle;">
                            <input type="hidden" id="asset_id_checkin">
                            <input type="text" class="form-control" id="AssetTagIN" readonly style="background-color:white !important;border: 1px solid #ced4da !important;cursor:default !important;">
                        </td>
                        <td style="vertical-align: middle;text-align:right;">Employee</td>
                        <td style="vertical-align: middle;">
                            <select type="text" id="AssignTOIN" class="form-control" style="background-color:white !important;border: 1px solid #ced4da !important;cursor:default !important;" disabled  >
                                <option value=""></option>
                                @foreach ($employee_list as $emp)
                                    <option value="{{$emp->employee_id}}">{{$emp->fname." ".$emp->lname}}</option>
                                @endforeach
                            </select>
                            
                        </td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Asset </td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" style="background-color:white !important;border: 1px solid #ced4da !important;" readonly id="AssetDescIN"></td>
                        <td style="vertical-align: middle;text-align:right;">Due Date</td>
                        <td style="vertical-align: middle;"><input type="date" class="form-control" style="background-color:white !important;border: 1px solid #ced4da !important;" readonly id="DueDateIN"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Site</td>
                        <td style="vertical-align: middle;"><input type="text" id="AssetSiteIN" style="background-color:white !important;border: 1px solid #ced4da !important;" readonly class="form-control"></td>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Location</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" style="background-color:white !important;border: 1px solid #ced4da !important;" readonly id="LocationIN"></td>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Department</td>
                        <td style="vertical-align: middle;">
                            <select  id="DepartmentIN" class="form-control" style="background-color:white !important;border: 1px solid #ced4da !important;" disabled>
                                <option value=""></option>
                                @foreach ($company_department_active as $dept)
                                    <option value="{{$dept->department_id}}">{{$dept->department_name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td colspan="2"></td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"><input type="hidden" id="HiddenTransactionIDIN"></td>
                        <td style="vertical-align: middle;"><input type="hidden" id="HiddenTypeIN"></td>
                        <td colspan="2"></td>
                        <td style="vertical-align: middle;text-align:right;">
                            <button class="btn btn-default" style="margin-right:10px;" onclick="ClearAll()">Clear</button>
                            <button class="btn btn-primary" id="checkin_addtoqueue_btn" disabled="" onclick="QueueCheckinAsset()">Add to Queue</button>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <table class="table  table-bordered table-sm" id="TableQuueueIN" style="background-color:white; color:#083240">
                <thead style="background-color:#124f62; color:white;">
                  <tr style="background-color:#083240">
                    <th colspan="11">Check In Queue</th>
                  </tr>
                  <tr>
                    <th>Asset Tag</th>
                    <th>Ticket No.</th>
                    <th>Asset </th>
                    
                    <th>Location</th>
                    <th>Department</th>
                    <th>Assignee</th>
                    <th>Due Date</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="AssetQueueBodyIN">
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12" style="text-align:right;">
                    <button class="btn btn-primary" onclick="SaveAssetRequestIN()">Check In</button>
                </div>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='3'? 'active show' : '' )}}" id="TransMoveAssignTo" role="tabpanel" aria-labelledby="home-tab" style="background-color:transparent !important;padding-top:10px;">
            <table class="table borderless table-sm" style="background-color:white; color:#083240" id="TableMoveAsset">
                <thead style="background-color:#124f62; color:white;">
                    <tr>
                        <th colspan="6">Move Asset</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;color:#083240;text-align:right;padding:0px" colspan="1" id="Title1"><h3 style="margin:10px 0px 0px 0px">Asset Details</h3></td>
                        <td style="vertical-align: middle;color:#083240;" colspan="1" id="Title2"></td>
                        <td style="vertical-align: middle;color:#083240;text-align:right;padding:0px" colspan="1" id="Title3"><h3 style="margin:10px 0px 0px 0px ;">Asset Destination</h3></td>
                        <td style="vertical-align: middle;color:#083240;" colspan="1" id="Title4"></td>
                        <td colspan="1" style="vertical-align: middle;color:#083240;padding:0px" id="Title5"><h3 style="margin:0px;"></h3></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Asset Tag</td>
                        <td style="vertical-align: middle;">
                            <script>
                                function getMoveAssetInfo(){
                                    var value=document.getElementById('MoveAssetTag').value;
                                    $.ajax({
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: 'get_asset_info_checkout',                
                                    data:{value:value,_token: '{{csrf_token()}}'},
                                    success: function(data) {
                                        if(data==""){
                                            
                                            document.getElementById('MoveAssetDesc').value="";
                                            document.getElementById('MoveAssetFromSite').value="";
                                            document.getElementById('MoveAssetToSite').value="";
                                            document.getElementById('MoveAssetFromLocation').value="";
                                            document.getElementById('MoveAssetToLocation').value="";
                                            document.getElementById('MoveAssetDept').value="";
                                            document.getElementById('MoveAssetToDept').value="";
                                            document.getElementById('asset_id_move').value="";
                                            document.getElementById('ReassignTo').value="";
                                            document.getElementById('addtoqueuemoveasset').disabled=true;
                                        }else{
                                            document.getElementById('asset_id_move').value=value;
                                            
                                            document.getElementById('MoveAssetDesc').value=data[0]['asset_setup_description'];
                                            document.getElementById('MoveAssetFromSite').value=data[0]['asset_site'];
                                            document.getElementById('MoveAssetToSite').value=data[0]['asset_site'];
                                            document.getElementById('MoveAssetFromLocation').value=data[0]['asset_location'];
                                            document.getElementById('MoveAssetToLocation').value=data[0]['asset_location'];
                                            document.getElementById('ReassignTo').value=data[0]['asset_assign_to'];
                                            
                                            document.getElementById('MoveAssetToDept').value=data[0]['asset_department_code'];
                                            document.getElementById('MoveAssetDept').value=data[0]['asset_department_code'];
                                            document.getElementById('addtoqueuemoveasset').disabled=false;
                                        }
                                        $('#ReassignTo').selectpicker('refresh');
                                        $('#MoveAssetToDept').selectpicker('refresh');
                                    }  
                                    }) 
                                }
                                function QueueMoveAsset(){
                                    var MoveAssetFromSite=document.getElementById('MoveAssetToSite').value;
                                    var MoveAssetTag=$("#MoveAssetTag option:selected").text();
                                    
                                    var MoveAssetToLocation=document.getElementById('MoveAssetToLocation').value;
                                    var MoveAssetDesc=document.getElementById('MoveAssetDesc').value;
                                    var MoveAssetToDept=document.getElementById('MoveAssetToDept').value;
                                    var MoveAssetFromLocation=document.getElementById('MoveAssetFromLocation').value;
                                    var MoveAssetNote=document.getElementById('MoveAssetNote').value;
                                    var MoveAssetDept=document.getElementById('MoveAssetDept').value;
                                    var ReassignTo=document.getElementById('ReassignTo').value;
                                    
                                    if(document.getElementById("MoveAssetQueue"+MoveAssetTag)){
                                        alert('Asset Already in Queue...');
                                    }
                                    else if(MoveAssetTag=="" || MoveAssetToLocation=="" ){
                                        alert('Fill All Field');
                                    }
                                    else{
                                    var t = document.getElementById('MoveAssetQueueTable');
                                    var tr = document.createElement("tr");
                                    tr.setAttribute("id","MoveAssetQueue"+MoveAssetTag);
                                    var td1 = document.createElement("td");
                                        td1.setAttribute('data-asset-id',document.getElementById('asset_id_move').value)
                                    var td2 = document.createElement("td"); 
                                    var td3 = document.createElement("td"); 
                                    var td4 = document.createElement("td"); 
                                    var td5 = document.createElement("td"); 
                                    var td6 = document.createElement("td"); 
                                    var td67 = document.createElement("td"); 
                                    var td7 = document.createElement("td"); 
                                    
                                    var td9 = document.createElement("td");
                                    td9.style.textAlign="center";
                                    td9.style.verticalAlign ="middle";
                                    
                                    var x9=document.createElement("a");
                                    x9.setAttribute("class", "fa fa-times btn btn-link");
                                    x9.setAttribute("onclick", "RemoveQueueMove('MoveAssetQueue"+MoveAssetTag+"')");
                                    x9.style.color ="#bf1616";
                                    var x1=document.createTextNode(MoveAssetTag);
                                    //x1.innerHTML=AssetTag;
                                    var x2=document.createTextNode(MoveAssetFromLocation);
                                    //x2.innerHTML=DescriptionAsset;
                                    var x3=document.createTextNode(MoveAssetDesc);
                                    //x3.innerHTML=HiddenType;
                                    var x4=document.createTextNode(MoveAssetFromSite);
                                    //x4.innerHTML=AssetLocation;
                                    var x5=document.createTextNode(MoveAssetToLocation);
                                    //x5.innerHTML=DepartmentName;
                                    var x6=document.createTextNode(MoveAssetToDept);
                                    var x67=document.createTextNode(ReassignTo);
                                    //x6.innerHTML=Assignto;
                                    var x7=document.createTextNode(MoveAssetNote);
                                    
                                    //x7.innerHTML=FinalDate;
                                    td1.appendChild(x1);
                                    td2.appendChild(x2);
                                    td3.appendChild(x3);
                                    td4.appendChild(x4);
                                    td5.appendChild(x5);
                                    td6.appendChild(x6);
                                    td67.appendChild(x67);
                                    td7.appendChild(x7);
                                    
                                    td9.appendChild(x9);
                                    
                                    tr.appendChild(td1);
                                    tr.appendChild(td2);
                                    tr.appendChild(td3);
                                    tr.appendChild(td4);
                                    tr.appendChild(td5);
                                    tr.appendChild(td6);
                                    tr.appendChild(td67);
                                    tr.appendChild(td7);
                                    
                                    tr.appendChild(td9);
                                    t.appendChild(tr);
                                    document.getElementById('MoveAssetTag').value="";
                                    document.getElementById('MoveAssetToLocation').value="";
                                    
                                    document.getElementById('MoveAssetDesc').value="";
                                    document.getElementById('MoveAssetFromSite').value="";
                                    document.getElementById('MoveAssetToSite').value="";
                                    document.getElementById('MoveAssetToDept').value="";
                                    document.getElementById('MoveAssetFromLocation').value="";
                                    document.getElementById('MoveAssetNote').value="";
                                    document.getElementById('MoveAssetDept').value="";
                                    document.getElementById('ReassignTo').value="";
                                    
                                    document.getElementById('MoveAssetFromSite').readOnly=false;
                                    document.getElementById('MoveAssetTag').readOnly=false;
                                    document.getElementById('MoveAssetDesc').readOnly=false;
                                    document.getElementById('MoveAssetFromLocation').readOnly=false;
                                    document.getElementById('MoveAssetDept').readOnly=false;
                                    ClearAll();
                                    }
                                }
                                function RemoveQueueMove(e){
                                    var t = document.getElementById('MoveAssetQueueTable');
                                    var tr = document.getElementById(e);
                                    t.removeChild(tr);
                                    
                                }
                                function SaveAssetRequestMove() {
                                // Declare variables 
                                var input, filter, table, tr, td, i, td1,td3,td4,td5,td6,td7,td0;
                                var count=0;
                                    
                                table = document.getElementById("MoveAssetQueueTableBody");
                                tr = table.getElementsByTagName("tr");
                                    // Loop through all table rows, and hide those who don't match the search query
                                    for (i = 2; i < tr.length; i++) {
                                        td0 = tr[i].getElementsByTagName("td")[0];
                                        
                                        td3 = tr[i].getElementsByTagName("td")[3];
                                        td4 = tr[i].getElementsByTagName("td")[4];
                                        td5 = tr[i].getElementsByTagName("td")[5];
                                        td6 = tr[i].getElementsByTagName("td")[6];
                                        td7 = tr[i].getElementsByTagName("td")[7];
                                        console.log(td0.getAttribute('data-asset-id'));
                                        
                                        $.ajax({
                                        type: 'POST',
                                        url: ' SaveAssetMove',                
                                        data: {tag:td0.getAttribute('data-asset-id'),site:td3.innerHTML,location:td4.innerHTML,department:td5.innerHTML,name:td6.innerHTML,note:td7.innerHTML,_token:'{{csrf_token()}}'},
                                        success: function(data) {
                                            RemoveQueueIN('TRASSETQUEUEIN'+td0.innerHTML);
                                            
                                        } 											 
                                        })
                                        
                                    }
                                    Swal.fire({
                                    type: 'success',
                                    title: 'Success',
                                    text: 'Successfully Added Move/Assign To Request',
                                    }).then((result) => {
                                        location.href="transaction?page=3";
                                    })
                                    
                                }
                            </script>
                            <input type="hidden" id="asset_id_move">
                            <select class="form-control selectpicker" data-live-search="true" id="MoveAssetTag" onchange="getMoveAssetInfo()">
                                    <option value="">--Select--</option>
                                @foreach ($asset_list_for_move as $item)
                                    <option value="{{$item->id}}">{{$item->asset_tag}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="vertical-align: middle;text-align:right;">Move to Department</td>
                        <td style="vertical-align: middle;">
                            <select  id="MoveAssetToDept" class="form-control selectpicker" data-live-search="true" >
                                <option value="">--Select--</option>
                                @foreach ($company_department_active as $dept)
                                    <option value="{{$dept->department_id}}">{{$dept->department_name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="vertical-align: middle;"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Asset</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MoveAssetDesc" style="background-color:white !important;border: 1px solid #ced4da !important;" readonly></td>
                        <td style="vertical-align: middle;text-align:right;">Reassign/Assign To Employee </td>
                        <td style="vertical-align: middle;">
                            <input type="text" id="ReassignTo" class="form-control ">
                        </td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Move From Location</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MoveAssetFromLocation" style="background-color:white !important;border: 1px solid #ced4da !important;" readonly></td>
                        
                        <td style="vertical-align: middle;text-align:right;">Move To Location</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MoveAssetToLocation" list="LocSearchReultGeneral" onkeyup="GetExistingLocationGeneral()" onclick="GetExistingLocationGeneral()" oninput="GetExistingLocationGeneral()"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Move From Site</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MoveAssetFromSite" style="background-color:white !important;border: 1px solid #ced4da !important;" readonly></td>
                        
                        <td style="vertical-align: middle;text-align:right;">Move To Site</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MoveAssetToSite" list="siteSearchReultDivGeneral" onkeyup="GetExistingSitesGeneral()" onclick="GetExistingSitesGeneral()" oninput="GetExistingSitesGeneral()"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                    </tr>
                   
                    
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Department Name</td>
                        <td style="vertical-align: middle;">
                            
                            <select  id="MoveAssetDept" class="form-control" style="background-color:white !important;border: 1px solid #ced4da !important;cursor:pointer !important;" disabled>
                                <option value=""></option>
                                @foreach ($company_department_active as $dept)
                                    <option value="{{$dept->department_id}}">{{$dept->department_name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="vertical-align: middle;text-align:right;">Notes</td>
                        <td style="vertical-align: middle;"><textarea class="form-control" rows="3" id="MoveAssetNote"></textarea></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;text-align:right;"><button class="btn btn-default" style="margin-right:10px;" onclick="ClearAll()">Clear</button><button id="addtoqueuemoveasset" class="btn btn-primary" onclick="QueueMoveAsset()">Add to Queue</button></td>
                    </tr>
                    
                </tbody>
            </table>
            <table class="table  table-bordered table-sm" id="MoveAssetQueueTableBody" style="background-color:white; color:#083240">
                <thead style="background-color:#124f62; color:white;">
                  <tr style="background-color:#083240">
                    <th colspan="9">Select Asset to Move</th>
                  </tr>
                  <tr>
                    <th>Asset Tag</th>
                    <th>Location</th>
                    <th>Asset </th>
                    <th>Move to Site</th>
                    <th>Move to Location</th>
                    <th>Move to Department</th>
                    <th>Employee Name</th>
                    <th>Note</th>
                    
                    <th></th>
                    
                  </tr>
                </thead>
                <tbody id="MoveAssetQueueTable">
                 
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12" style="text-align:right;">
                    <button class="btn btn-primary" onclick="SaveAssetRequestMove()">Proceed</button>
                </div>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='4'? 'active show' : '' )}}" id="TransDispose" role="tabpanel" aria-labelledby="home-tab" style="background-color:transparent !important;padding-top:10px;">
            <table class="table borderless table-sm" style="background-color:white; color:#083240;">
                <thead style="background-color:#124f62; color:white;">
                    <tr>
                        <th colspan="6">Search for Asset to Dispose</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;color:#083240;text-align:left;padding:0px" colspan="2" id="Title1"><h3 style="margin:10px 0px 0px 10px">Filter Asset</h3></td>
                        
                        <td style="vertical-align: middle;color:#083240;text-align:left;padding:0px" colspan="2" id="Title3"><h3 style="margin:10px 0px 0px 0px ;">Reason for Dispose</h3></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;" width="10%">Asset Tag</td>
                        <td style="vertical-align: middle;" width="15%">
                            <script>
                                function getDisposeAssetInfo(){
                                    var value=document.getElementById('DisposeAssetTag').value;
                                    $.ajax({
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: 'get_asset_info_checkout',                
                                    data:{value:value,_token: '{{csrf_token()}}'},
                                    success: function(data) {
                                        if(data==""){
                                            document.getElementById('DisposeAssetDesc').value="";
                                            document.getElementById('DisposeDept').value="";
                                            document.getElementById('asset_id_dispose').value="";
                                            document.getElementById('DisposeAssetTag').value="";
                                            document.getElementById('addtoqueuedisposeasset').disabled=true;
                                            $('#DisposeAssetTag').selectpicker('refresh');
                                        }else{
                                            document.getElementById('asset_id_dispose').value=value;
                                            document.getElementById('DisposeAssetDesc').value=data[0]['asset_setup_description'];
                                            document.getElementById('DisposeDept').value=data[0]['asset_department_code'];
                                            document.getElementById('addtoqueuedisposeasset').disabled=false;
                                        }
                                    }  
                                    }) 
                                }
                            </script>
                            <select class="form-control selectpicker" data-live-search="true" id="DisposeAssetTag" onchange="getDisposeAssetInfo()">
                                    <option value="">--Select--</option>
                                @foreach ($asset_list_for_move as $item)
                                    <option value="{{$item->id}}">{{$item->asset_tag}}</option>
                                @endforeach
                            </select>
                        </td>
                        
                        <td style="vertical-align: middle;text-align:right; " width="10%">Dispose Reason</td>
                        <td style="vertical-align: middle;" width="40%">
                        <select id="DisposeReason" class="form-control" style="width:50%;">
                            <option></option>
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
                        <td style="vertical-align: middle;text-align:right;">Asset </td>
                        <td style="vertical-align: middle;"><input type="hidden" id="asset_id_dispose"><input type="text" class="form-control" id="DisposeAssetDesc" placeholder="">
                        
                        </td>
                        
                        <td style="vertical-align: middle;text-align:right;" rowspan="2">Note</td>
                        <td style="vertical-align: middle;" rowspan="2"><textarea style="width:50%" class="form-control" rows="3" id="DisposeNote"></textarea></td>
                        
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Department</td>
                        <td style="vertical-align: middle;">
                            <select  id="DisposeDept" class="form-control" style="background-color:white !important;border: 1px solid #ced4da !important;cursor:pointer !important;" disabled>
                                <option value=""></option>
                                @foreach ($company_department_active as $dept)
                                    <option value="{{$dept->department_id}}">{{$dept->department_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;text-align:right;"><button class="btn btn-default" style="margin-right:10px;" onclick="ClearAll()">Clear</button><button id="addtoqueuedisposeasset" class="btn btn-primary" onclick="SaveDisposeAsset()">Dispose</button></td>
                    </tr>
                    <script>
                    function SaveDisposeAsset(){
                        var AssetTag=document.getElementById('DisposeAssetTag').value;
                        var DisposeReason=document.getElementById('DisposeReason').value;
                        var DisposeNote=document.getElementById('DisposeNote').value;
                        if(AssetTag!=""){
                            $.ajax({
                            type: 'POST',
                            url: ' SaveAssetDisposal',                
                            data: {Tag:AssetTag,Reason:DisposeReason,Note:DisposeNote,_token:'{{csrf_token()}}'},
                            success: function(data) {
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Added Dispose Request',
                                }).then((result) => {
                                    location.href="transaction?page=4";
                                })
                                
                            } 											 
                            })
                            
                        }else{
                            alert('Please Enter the Asset Tag...');
                            document.getElementById('DisposeAssetTag').style.borderColor = "red";
                        }
                        
                    }
                    </script>
                    
                </tbody>
            </table>
            <table class="table  table-bordered table-sm" style="background-color:white; color:#083240" id="DisposeTableList">
                <thead style="background-color:#124f62; color:white;">
                  <tr style="background-color:#083240">
                    <th colspan="9">Disposed Asset</th>
                  </tr>
                  <tr>
                    <th>Asset Tag</th>
                    <th>Asset </th>
                   
                    <th>Reason For Disposal</th>
                    <th>Date of Disposal</th>
                    <th>Note</th>
                </tr>
                </thead>
                <tbody>
                    @if (!empty($disposed_asset_list))
                        @foreach ($disposed_asset_list as $rows)
                            <tr>
								<td style="vertical-align: middle;color:#083240;"><?php echo $rows['asset_tag']; ?></td>
								<td style="vertical-align: middle;color:#083240;"><?php echo $rows['asset_description']; ?></td>
								<td style="vertical-align: middle;color:#083240;"><?php echo $rows['asset_reasons']; ?></td>
								<td style="vertical-align: middle;color:#083240;"><?php echo date('m-d-Y',strtotime($rows['asset_purchase_order'])); ?></td>
								<td style="vertical-align: middle;color:#083240;"><?php echo $rows['asset_note']; ?></td>
							</tr>    
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" style="text-align:center;">No Asset Found</td>
                        </tr>  
                    @endif
                    
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade {{($page=='5'? 'active show' : '' )}}" id="TransRecover" role="tabpanel" aria-labelledby="home-tab" style="background-color:transparent !important;padding-top:10px;">
            <table class="table borderless table-sm" style="background-color:white; color:#083240;">
                <thead style="background-color:#124f62; color:white;">
                    <tr>
                        <th colspan="6">Search for Assets with a Dispose Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;color:#083240;text-align:left;padding:0px" colspan="2" id="Title1"><h3 style="margin:10px 0px 0px 10px">Filter Asset</h3></td>
                        
                        <td style="vertical-align: middle;color:#083240;text-align:left;padding:0px" colspan="2" id="Title3"><h3 style="margin:10px 0px 0px 0px ;">Reason for Recovery</h3></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;" width="10%">Asset Tag</td>
                        <td style="vertical-align: middle;" width="15%">
                            <script>
                                function getRecoverAssetInfo(){
                                    var value=document.getElementById('AssetTagRecover').value;
                                    $.ajax({
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: 'get_asset_info_checkout',                
                                    data:{value:value,_token: '{{csrf_token()}}'},
                                    success: function(data) {
                                        if(data==""){
                                            document.getElementById('DescRecover').value="";
                                            document.getElementById('DeptRecover').value="";
                                            document.getElementById('recover_asset_id').value="";
                                            document.getElementById('AssetTagRecover').value="";
                                            document.getElementById('recoverassetsavebtn').disabled=true;
                                            $('#AssetTagRecover').selectpicker('refresh');
                                        }else{
                                            document.getElementById('recover_asset_id').value=value;
                                            document.getElementById('DescRecover').value=data[0]['asset_setup_description'];
                                            document.getElementById('DeptRecover').value=data[0]['asset_department_code'];
                                            document.getElementById('recoverassetsavebtn').disabled=false;
                                        }
                                    }  
                                    }) 
                                }
                            </script>
                            <input type="hidden" id="recover_asset_id">
                        <select class="form-control selectpicker" data-live-search="true" id="AssetTagRecover" onchange="getRecoverAssetInfo()">
                                <option value="">--Select--</option>
                            @foreach ($recover_asset_list as $item)
                                <option value="{{$item->id}}">{{$item->asset_tag}}</option>
                            @endforeach
                        </select>
                        
                        </td>
                        
                        <td style="vertical-align: middle;text-align:right;" width="10%"> Reason for Recovery</td>
                        <td style="vertical-align: middle;" width="40%">
                        <select id="ReasonRecover" class="form-control" style="width:50%">
                            <option></option>
                            <option>Found</option>
                            <option>Other</option>
                            <option>Return</option>
                        </select>
                        </td>
                        
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Asset </td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="DescRecover" style="background-color:white !important;border: 1px solid #ced4da !important;cursor:default !important;" disabled>
                        
                        </td>
                        
                        <td style="vertical-align: middle;text-align:right;" rowspan="2">Note</td>
                        <td style="vertical-align: middle;" rowspan="2"><textarea style="width:50%" class="form-control" rows="3" id="RecoverNote"></textarea></td>
                        
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Department</td>
                        <td style="vertical-align: middle;">
                            <select  id="DeptRecover" class="form-control" style="background-color:white !important;border: 1px solid #ced4da !important;cursor:default !important;" disabled>
                                <option value=""></option>
                                @foreach ($company_department_active as $dept)
                                    <option value="{{$dept->department_id}}">{{$dept->department_name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;text-align:right;">
                            <button class="btn btn-default" style="margin-right:10px;" onclick="ClearAll()">Clear</button>
                            <button class="btn btn-primary" id="recoverassetsavebtn" onclick="RecoverAssetFromDespose()">Recover Asset</button>
                            <script>
                            function RecoverAssetFromDespose(){
                                var AssetTag=document.getElementById('AssetTagRecover').value;
                                var DisposeReason=document.getElementById('ReasonRecover').value;
                                var DisposeNote=document.getElementById('RecoverNote').value;
                                if(AssetTag!=""){
                                    if(DisposeReason!=""){
                                        $.ajax({
                                        type: 'POST',
                                        url: ' SaveAssetRecover',                
                                        data: {Tag:AssetTag,Reason:DisposeReason,Note:DisposeNote,_token:'{{csrf_token()}}'},
                                        success: function(data) {
                                            Swal.fire({
                                            type: 'success',
                                            title: 'Success',
                                            text: 'Successfully Added Recover Request',
                                            }).then((result) => {
                                                location.href="transaction?page=5";
                                            })
                                            
                                        } 											 
                                        })
                                    }else{
                                        alert('Please Enter the Reason...');
                                        document.getElementById('ReasonRecover').style.borderColor = "red";
                                    }
                                    
                                    
                                }else{
                                    alert('Please Enter the Asset Tag...');
                                    document.getElementById('AssetTagRecover').style.borderColor = "red";
                                }
                                
                            }
                            </script>
                        </td>

                    </tr>
                    
                    
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade {{($page=='6'? 'active show' : '' )}}" id="TransMaintenance" role="tabpanel" aria-labelledby="home-tab" style="background-color:transparent !important;padding-top:10px;">
            <table class="table borderless table-sm" style="background-color:white; color:#083240;">
                <thead style="background-color:#124f62; color:white;">
                    <tr>
                        <th colspan="6">Search Asset for Maintenance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;color:#083240;text-align:left;padding:0px" colspan="2" id="Title1"><h3 style="margin:10px 0px 0px 10px">Filter Asset</h3></td>
                        
                        <td style="vertical-align: middle;color:#083240;text-align:left;padding:0px" colspan="2" id="Title3"><h3 style="margin:10px 0px 0px 0px ;">Reason for Maintenance</h3></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;" width="10%">Asset Tag</td>
                        <td style="vertical-align: middle;" width="15%">
                            <script>
                                function getMaintenanceAssetInfo(){
                                    var value=document.getElementById('MaintenanceAssetTag').value;
                                    $.ajax({
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: 'get_asset_info_checkout',                
                                    data:{value:value,_token: '{{csrf_token()}}'},
                                    success: function(data) {
                                        if(data==""){
                                            document.getElementById('MaintenanceAssetDesc').value="";
                                            document.getElementById('MaintenanceDept').value="";
                                            document.getElementById('maintenance_asset_id').value="";
                                            document.getElementById('MaintenanceAssetTag').value="";
                                            document.getElementById('maintenancesaveformaintenance').disabled=true;
                                            $('#MaintenanceAssetTag').selectpicker('refresh');
                                        }else{
                                            document.getElementById('maintenance_asset_id').value=value;
                                            document.getElementById('MaintenanceAssetDesc').value=data[0]['asset_setup_description'];
                                            document.getElementById('MaintenanceDept').value=data[0]['asset_department_code'];
                                            document.getElementById('maintenancesaveformaintenance').disabled=false;
                                        }
                                    }  
                                    }) 
                                }
                            </script>
                            <input type="hidden" id="maintenance_asset_id">
                            <select class="form-control selectpicker" data-live-search="true" id="MaintenanceAssetTag" onchange="getMaintenanceAssetInfo()">
                                <option value="">--Select--</option>
                            @foreach ($asset_list_for_move as $item)
                                <option value="{{$item->id}}">{{$item->asset_tag}}</option>
                            @endforeach
                        </select>
                        </td>
                        
                        <td style="vertical-align: middle;text-align:right; " width="10%">Maintenance Reason</td>
                        <td style="vertical-align: middle;" width="40%">
                        <select id="MaintenanceReason" class="form-control" style="width:50%;">
                            <option></option>
                            <option>Regular Check up</option>
                            <option>Damaged</option>
                            
                        </select>
                        </td>
                        
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Asset </td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MaintenanceAssetDesc" style="background-color:white !important;border: 1px solid #ced4da !important;cursor:default !important;" disabled>
                        </td>
                        
                        <td style="vertical-align: middle;text-align:right;" rowspan="1">Due Date</td>
                        <td style="vertical-align: middle;" rowspan="1"><input type="date" class="form-control" style="width:50%;" min="{{date('Y-m-d')}}" id="MaintenanceDueDate"></td>
                        
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Department</td>
                        <td style="vertical-align: middle;">
                            <select  id="MaintenanceDept" class="form-control" style="background-color:white !important;border: 1px solid #ced4da !important;cursor:default !important;" disabled>
                                <option value=""></option>
                                @foreach ($company_department_active as $dept)
                                    <option value="{{$dept->department_id}}">{{$dept->department_name}}</option>
                                @endforeach
                            </select>
                        </td>
                        
                        <td style="vertical-align: middle;text-align:right;" rowspan="1">Note</td>
                        <td style="vertical-align: middle;" rowspan="1"><textarea class="form-control" style="width:50%;" id="MaintenanceNote"></textarea></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;text-align:right;"><button class="btn btn-default" style="margin-right:10px;" onclick="ClearAll()">Clear</button>
                            <button class="btn btn-primary" id="maintenancesaveformaintenance" onclick="SaveMaintenanceAsset()">Send for Maintenance</button></td>
                    </tr>
                    <script>
                    function SaveMaintenanceAsset(){
                        
                        var AssetTag=document.getElementById('MaintenanceAssetTag').value;
                        var DisposeReason=document.getElementById('MaintenanceReason').value;
                        var MaintenanceDueDate=document.getElementById('MaintenanceDueDate').value;
                        var DisposeNote=document.getElementById('MaintenanceNote').value;
                        if(AssetTag!=""){
                            if(DisposeReason!=""){
                                if(MaintenanceDueDate!=""){
                                    $.ajax({
                                    type: 'POST',
                                    url: ' SaveAssetMaintenance',                
                                    data: {Tag:AssetTag,Reason:DisposeReason,Note:DisposeNote,MaintenanceDueDate:MaintenanceDueDate,_token:'{{csrf_token()}}'},
                                    success: function(data) {
                                        Swal.fire({
                                        type: 'success',
                                        title: 'Success',
                                        text: 'Successfully Added Maintenance Request',
                                        }).then((result) => {
                                            location.href="transaction?page=6";
                                        })
                                        
                                    } 											 
                                    })
                                }else{
                                    alert('Please Enter the Due Date...');
                                    document.getElementById('MaintenanceDueDate').style.borderColor = "red";
                                }
                            }else{
                                alert('Please Enter the Reason for Maintenance...');
                                document.getElementById('MaintenanceReason').style.borderColor = "red";
                            }
                            
                            
                        }else{
                            alert('Please Enter the Asset Tag...');
                            document.getElementById('MaintenanceAssetTag').style.borderColor = "red";
                        }
                        
                    }
                    </script>
                    
                </tbody>
            </table>
            <table class="table  table-bordered table-sm" style="background-color:white; color:#083240" id="MaintenanceTableList">
                <thead style="background-color:#124f62; color:white;">
                  <tr style="background-color:#083240">
                    <th colspan="9">Asset on Maintenance</th>
                  </tr>
                  <tr>
                    <th>Asset Tag</th>
                    <th>Asset </th>
                    
                    <th>Reason For Maintenance</th>
                    <th>Date of Maintenance</th>
                    <th>Due Date for Maintenance</th>
                    <th>Note</th>
                </tr>
                </thead>
                <tbody>
                    @if (!empty($maintenance_asset_list))
                        @foreach ($maintenance_asset_list as $rows)
                            <tr>
								<td style="vertical-align: middle;color:#083240;"><?php echo $rows['asset_tag']; ?></td>
								<td style="vertical-align: middle;color:#083240;"><?php echo $rows['asset_description']; ?></td>
								<td style="vertical-align: middle;color:#083240;"><?php echo $rows['asset_reasons']; ?></td>
								<td style="vertical-align: middle;color:#083240;"><?php echo date('m-d-Y',strtotime($rows['asset_purchase_order'])); ?></td>
								<td style="vertical-align: middle;color:#083240;"><?php echo date('m-d-Y',strtotime($rows['MaintenanceDueDate'])); ?></td>
								<td style="vertical-align: middle;color:#083240;"><?php echo $rows['asset_note']; ?></td>
							</tr>    
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" style="text-align:center;">No Asset Found</td>
                        </tr>  
                    @endif
                     
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade {{($page=='7'? 'active show' : '' )}}" id="TransExtendCheckOut" role="tabpanel" aria-labelledby="home-tab" style="background-color:transparent !important;padding-top:10px;">
            <table class="table borderless table-sm" style="background-color:white; color:#083240" id="TableInputExtendDue">
                <thead style="background-color:#124f62; color:white;">
                    <tr>
                        <th colspan="6">Asset Detail</th>
                    </tr>
                </thead>
                    <script>
                        function GetAssetInfoExtendDueDate(){
                                var value=document.getElementById('ExtendDueScanBox').value;
                                document.getElementById('ExtendDueScanBox').value="";
                                $('#ExtendDueScanBox').selectpicker('refresh');
                                $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'get_asset_info_checkin',
                                data:{value:value,_token: '{{csrf_token()}}'},
                                success: function(data) {
                                    if(data==""){
                                        document.getElementById('AssetTagExtendDue').value="";
                                        document.getElementById('AssetDescExtendDue').value="";
                                        document.getElementById('SiteExtendDue').value="";
                                        document.getElementById('LocationExtendDue').value="";
                                        document.getElementById('DepartmentExtendDue').value="";
                                        document.getElementById('asset_id_extend_checout_due_date').value="";
                                        document.getElementById('OldDueExtendDue').value="";
                                        document.getElementById('EmployeeNameExtendDue').value="";
                                        document.getElementById('HiddenTransactionIDExtendDue').value="";
                                        document.getElementById('extend_duedate_add_to_queue').disabled=true;
                                        document.getElementById('DueDateExtendDue').min="";
                                        document.getElementById('DueDateExtendDue').value="";
                                    }else{
                                        document.getElementById('asset_id_extend_checout_due_date').value=data[0]['REQUEST_ID'];
                                        document.getElementById('AssetTagExtendDue').value=data[0]['ASSET_TAG'];
                                        document.getElementById('AssetDescExtendDue').value=data[0]['asset_setup_description'];
                                        document.getElementById('SiteExtendDue').value=data[0]['asset_site'];
                                        document.getElementById('LocationExtendDue').value=data[0]['asset_location'];
                                        document.getElementById('DepartmentExtendDue').value=data[0]['asset_department_code'];
                                        document.getElementById('EmployeeNameExtendDue').value=data[0]['emp_id'];
                                        document.getElementById('OldDueExtendDue').value=data[0]['asset_due_date'];
                                        document.getElementById('HiddenTransactionIDExtendDue').value=data[0]['request_id'];
                                        document.getElementById('DueDateExtendDue').value=data[0]['asset_borrow_date'];
                                        document.getElementById('DueDateExtendDue').min=data[0]['asset_borrow_date'];
                                        
                                        document.getElementById('extend_duedate_add_to_queue').disabled=false;
                                    }
                                    
                                }  
                                }) 
                        }
                        function QueueExtendDueAsset(){
                                var AssetTagIN=document.getElementById('AssetTagExtendDue').value;
                                var AssignTOIN=document.getElementById('EmployeeNameExtendDue').value;
                                var AssetDescIN=document.getElementById('AssetDescExtendDue').value;
                                var OldDueExtendDue=document.getElementById('OldDueExtendDue').value;
                                var LocationIN=document.getElementById('LocationExtendDue').value;
                                var DueDateIN=document.getElementById('DueDateExtendDue').value;
                                var DepartmentIN=document.getElementById('DepartmentExtendDue').value;
                                var HiddenTypeIN=document.getElementById('HiddenTypeExtendDue').value;
                                var HiddenTransactionIDIN=document.getElementById('HiddenTransactionIDExtendDue').value;
                                if(document.getElementById("ExtendDue"+AssetTagIN)){
                                    alert('Asset Already in Queue...');
                                }else{
                                var t = document.getElementById('AssetQueueBodyExtend');
                                var tr = document.createElement("tr");
                                tr.setAttribute("id","ExtendDue"+AssetTagIN);
                                var td1 = document.createElement("td");
                                    td1.setAttribute('data-request-id',document.getElementById('asset_id_extend_checout_due_date').value);
                                var td2 = document.createElement("td"); 
                                var td3 = document.createElement("td"); 
                                var td4 = document.createElement("td"); 
                                var td5 = document.createElement("td"); 
                                var td6 = document.createElement("td"); 
                                var td7 = document.createElement("td"); 
                                var td8 = document.createElement("td");
                                var td9 = document.createElement("td");
                                td9.style.textAlign="center";
                                td9.style.verticalAlign ="middle";
                                
                                var x9=document.createElement("a");
                                x9.setAttribute("class", "fa fa-times btn btn-link");
                                x9.setAttribute("onclick", "RemoveQueueExtend('ExtendDue"+AssetTagIN+"')");
                                x9.style.color ="#bf1616";
                                var x1=document.createTextNode(AssetTagIN);
                                //x1.innerHTML=AssetTag;
                                var x2=document.createTextNode(HiddenTransactionIDIN);
                                //x2.innerHTML=DescriptionAsset;
                                var x3=document.createTextNode(AssetDescIN);
                                //x3.innerHTML=HiddenType;
                               
                                //x4.innerHTML=AssetLocation;
                                var x5=document.createTextNode(LocationIN);
                                //x5.innerHTML=DepartmentName;
                                var x6=document.createTextNode(DepartmentIN);
                                //x6.innerHTML=Assignto;
                                var x7=document.createTextNode(AssignTOIN);
                                var x8=document.createTextNode(DueDateIN);
                                //x7.innerHTML=FinalDate;
                                td1.appendChild(x1);
                                td2.appendChild(x2);
                                td3.appendChild(x3);
                                
                                td5.appendChild(x5);
                                td6.appendChild(x6);
                                td7.appendChild(x7);
                                td8.appendChild(x8);
                                td9.appendChild(x9);
                                
                                tr.appendChild(td1);
                                tr.appendChild(td2);
                                tr.appendChild(td3);
                               
                                tr.appendChild(td5);
                                tr.appendChild(td6);
                                tr.appendChild(td7);
                                tr.appendChild(td8);
                                tr.appendChild(td9);
                                t.appendChild(tr);
                                document.getElementById('AssetTagExtendDue').value="";
                                document.getElementById('EmployeeNameExtendDue').value="";
                                
                                document.getElementById('AssetDescExtendDue').value="";
                                document.getElementById('OldDueExtendDue').value="";
                                document.getElementById('LocationExtendDue').value="";
                                document.getElementById('DueDateExtendDue').value="";
                                document.getElementById('SiteExtendDue').value="";
                                document.getElementById('DepartmentExtendDue').value="";
                                document.getElementById('HiddenTypeExtendDue').value="";
                                document.getElementById('HiddenTransactionIDExtendDue').value="";
                                
                                document.getElementById('SiteExtendDue').readOnly =false;
                                document.getElementById('AssetDescExtendDue').readOnly =false;
                                document.getElementById('EmployeeNameExtendDue').readOnly =false;
                                document.getElementById('OldDueExtendDue').readOnly =false;
                                document.getElementById('DueDateExtendDue').readOnly =false;
                                document.getElementById('DepartmentExtendDue').readOnly =false;
                                document.getElementById('LocationExtendDue').readOnly =false;
                                document.getElementById('AssetTagExtendDue').readOnly =false;
                                ClearAll();
                                }
                            
                        }
                        function RemoveQueueExtend(e){
                            var t = document.getElementById('AssetQueueBodyExtend');
                            var tr = document.getElementById(e);
                            t.removeChild(tr);
                            
                        }
                        function SaveAssetRequestExtend() {
                        // Declare variables 
                        var input, filter, table, tr, td, i, td2, td6;
                        var count=0;
                            
                        table = document.getElementById("TableQuueueExtend");
                        tr = table.getElementsByTagName("tr");
                            for (i = 2; i < tr.length; i++) {
                                td0 = tr[i].getElementsByTagName("td")[0];
                                td6 = tr[i].getElementsByTagName("td")[6];
                                console.log(td0.getAttribute('data-request-id'));
                                
                                $.ajax({
                                type: 'POST',
                                url: ' SaveAssetExtend',                
                                data: {request_id:td0.getAttribute('data-request-id'),newdue:td6.innerHTML,_token:'{{csrf_token()}}'},
                                success: function(data) {
                                    RemoveQueueIN('ExtendDue'+td0.innerHTML);
                                    
                                } 											 
                                })
                                
                            }
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Added Extend Check Out Request',
                            }).then((result) => {
                                location.href="transaction?page=7";
                            })
                        
                        }
                    </script>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;color:#083240">Scan Here</td>
                        <td style="vertical-align: middle;">
                            <input type="hidden" id="asset_id_extend_checout_due_date">
                            <select class="form-control selectpicker" data-live-search="true" id="ExtendDueScanBox" onchange="GetAssetInfoExtendDueDate()">
                                <option value="">--Select--</option>
                                @foreach ($checked_out_asset_list as $co)
                                    <option value="{{$co->id}}">{{$co->asset_tag}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;color:#083240;text-align:right;padding:0px" colspan="1" id="Title1"><h3 style="margin:0px;">Asset Details</h3></td>
                        <td style="vertical-align: middle;color:#083240;" colspan="1" id="Title2"></td>
                        <td style="vertical-align: middle;color:#083240;text-align:right;padding:0px" colspan="1" id="Title3"><h3 style="margin:0px;">Extend By</h3></td>
                        <td style="vertical-align: middle;color:#083240;" colspan="1" id="Title4"></td>
                        <td colspan="1" style="vertical-align: middle;color:#083240;padding:0px" id="Title5"><h3 style="margin:0px;"></h3></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Asset Tag</td>
                        <td style="vertical-align: middle;"><input type="text" style="background-color:white !important;border: 1px solid #ced4da !important;cursor:default !important;" class="form-control" id="AssetTagExtendDue" readonly></td>
                        <td style="vertical-align: middle;text-align:right;">Employee Name</td>
                        <td style="vertical-align: middle;">
                            <select type="text" id="EmployeeNameExtendDue" class="form-control" style="background-color:white !important;border: 1px solid #ced4da !important;cursor:default !important;" disabled  >
                                <option value=""></option>
                                @foreach ($employee_list as $emp)
                                    <option value="{{$emp->employee_id}}">{{$emp->fname." ".$emp->lname}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Asset </td>
                        <td style="vertical-align: middle;"><input type="text" style="background-color:white !important;border: 1px solid #ced4da !important;cursor:default !important;" class="form-control" rows="3 " id="AssetDescExtendDue" readonly></td>
                        <td style="vertical-align: middle;text-align:right;">Due Date</td>
                        <td style="vertical-align: middle;"><input type="date" style="background-color:white !important;border: 1px solid #ced4da !important;cursor:default !important;" class="form-control" id="OldDueExtendDue" readonly></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Site</td>
                        <td style="vertical-align: middle;"><input type="text" style="background-color:white !important;border: 1px solid #ced4da !important;cursor:default !important;" class="form-control" id="SiteExtendDue" readonly></td>
                        <td style="vertical-align: middle;text-align:right;">New Due Date</td>
                        <td style="vertical-align: middle;"><input type="date"  class="form-control" id="DueDateExtendDue" style="border: 1px solid green"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Location</td>
                        <td style="vertical-align: middle;"><input type="text" style="background-color:white !important;border: 1px solid #ced4da !important;cursor:default !important;" class="form-control" id="LocationExtendDue" readonly></td>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Department</td>
                        <td style="vertical-align: middle;">
                            <select  id="DepartmentExtendDue" class="form-control" style="background-color:white !important;border: 1px solid #ced4da !important;" disabled>
                                <option value=""></option>
                                @foreach ($company_department_active as $dept)
                                    <option value="{{$dept->department_id}}">{{$dept->department_name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td colspan="2"></td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"><input type="hidden" id="HiddenTransactionIDExtendDue"></td>
                        <td style="vertical-align: middle;"><input type="hidden" id="HiddenTypeExtendDue"></td>
                        <td colspan="2"></td>
                        <td style="vertical-align: middle;text-align:right;">
                            <button class="btn btn-default" style="margin-right:10px;" onclick="ClearAll()">Clear</button>
                            <button class="btn btn-primary" disabled="" id="extend_duedate_add_to_queue" onclick="QueueExtendDueAsset()">Add to Queue</button>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <table class="table  table-bordered table-sm" id="TableQuueueExtend" style="background-color:white; color:#083240">
                <thead style="background-color:#124f62; color:white;">
                  <tr style="background-color:#083240">
                    <th colspan="11">Extension Request Queue</th>
                  </tr>
                  <tr>
                    <th>Asset Tag</th>
                    <th>Ticket No.</th>
                    <th>Asset </th>
                    
                    <th>Location</th>
                    <th>Department</th>
                    <th>Assignee</th>
                    <th>New Due Date</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="AssetQueueBodyExtend">
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-12" style="text-align:right;">
                    <button class="btn btn-primary" onclick="SaveAssetRequestExtend()">Process Request</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection