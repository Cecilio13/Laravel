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
                                    dat.setMonth(dat.getMonth()+1);
                                    FinalDate=dat.getFullYear()+"-"+dat.getUTCMonth()+"-"+dat.getDate();
                                }
                                if(Due=='Custom'){
                                    FinalDate=DueDate;
                                }
                                
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
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MoveAssetTag" onclick="GetSearchMove()" onkeyup="GetSearchMove()" placeholder="Scan Here">
                        <div id="SearchResultMove"></div></td>
                        <td style="vertical-align: middle;text-align:right;">Move To Site</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MoveAssetToSite"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Asset</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MoveAssetDesc"></td>
                        <td style="vertical-align: middle;text-align:right;">Move To Location</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MoveAssetToLocation"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Move From Site</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MoveAssetFromSite"></td>
                        <td style="vertical-align: middle;text-align:right;">Move to Department</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MoveAssetToDept"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Move From Location</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MoveAssetFromLocation"></td>
                        <td style="vertical-align: middle;text-align:right;">Reassign/Assign To Employee </td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="ReassignTo"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Department Name</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MoveAssetDept"></td>
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
                        <td style="vertical-align: middle;text-align:right;"><button class="btn btn-default" style="margin-right:10px;" onclick="ClearAll()">Clear</button><button class="btn btn-primary" onclick="QueueMoveAsset()">Add to Queue</button></td>
                    </tr>
                    
                </tbody>
            </table>
            <table class="table  table-bordered tabls-m" id="MoveAssetQueueTableBody" style="background-color:white; color:#083240">
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
                        <td style="vertical-align: middle;color:#083240;text-align:left;padding:0px" colspan="4" id="Title1"><h3 style="margin:10px 0px 0px 10px">Filter Asset</h3></td>
                        
                        <td style="vertical-align: middle;color:#083240;text-align:left;padding:0px" colspan="2" id="Title3"><h3 style="margin:10px 0px 0px 0px ;">Reason for Dispose</h3></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;" width="10%">Asset Tag</td>
                        <td style="vertical-align: middle;" width="15%"><input type="text" class="form-control" id="DisposeAssetTag" placeholder="Enter Asset Tag" onclick="SearchDisposeResult()" onkeyup="SearchDisposeResult()">
                        <div id="SearchResultDisposeAssetTag"></div>
                        </td>
                        <td style="vertical-align: middle;text-align:right;" width="10%">Location</td>
                        <td style="vertical-align: middle;" width="15%">
                        <input type="text" class="form-control" id="DisposeLocation" placeholder="Filter by Asset Location" onclick="SearchDisposeResultLocation()" onkeyup="SearchDisposeResultLocation()">
                        <div id="DisposeLocationSearchBox"></div>
                        <script>
                            function SearchDisposeResultLocation(){
                                var x = document.getElementById("DisposeLocation").value;
                                $.ajax({
                                    type: 'POST',
                                    url: ' SearchDisposeResultLocation.php',                
                                    data: {INPUT:x},
                                success: function(data) {
                                    
                                    $( "#DisposeLocationSearchBox" ).replaceWith( data );
                                    
                                } 											 
                                })
                            }
                        </script>
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
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="DisposeAssetDesc" placeholder="Filter by Asset" onclick="DisposeAssetSearchBox()" onkeyup="DisposeAssetSearchBox()">
                        <div id="DisposeAssetSearchBox"></div>
                        <script>
                            function DisposeAssetSearchBox(){
                                var x = document.getElementById("DisposeAssetDesc").value;
                                $.ajax({
                                    type: 'POST',
                                    url: ' DisposeAssetSearchBox.php',                
                                    data: {INPUT:x},
                                success: function(data) {
                                    
                                    $( "#DisposeAssetSearchBox" ).replaceWith( data );
                                    
                                } 											 
                                })
                            }
                        </script>
                        </td>
                        <td style="vertical-align: middle;text-align:right;">Site</td>
                        <td style="vertical-align: middle;">
                        <input type="text" class="form-control" id="DisposeSite" placeholder="Filter by Site" onclick="DisposeSiteSearchBox()" onkeyup="DisposeSiteSearchBox()">
                        <div id="DisposeSiteSearchBox"></div>
                        <script>
                            function DisposeSiteSearchBox(){
                                var x = document.getElementById("DisposeSite").value;
                                var x2 = document.getElementById("DisposeLocation").value;
                                $.ajax({
                                    type: 'POST',
                                    url: ' DisposeSiteSearchBox.php',                
                                    data: {INPUT:x,Location:x2},
                                success: function(data) {
                                    
                                    $( "#DisposeSiteSearchBox" ).replaceWith( data );
                                    
                                } 											 
                                })
                                
                            }
                        </script>
                        </td>
                        <td style="vertical-align: middle;text-align:right;" rowspan="2">Note</td>
                        <td style="vertical-align: middle;" rowspan="2"><textarea style="width:50%" class="form-control" rows="3" id="DisposeNote"></textarea></td>
                        
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Department</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="DisposeDept" placeholder="Filter by Department" onclick="DisposeDepartmentSearchBox()" onkeyup="DisposeDepartmentSearchBox()">
                        <div id="DisposeDepartmentSearchBox" style="display: none;"></div>
                        <script>
                            function DisposeDepartmentSearchBox(){
                                var x = document.getElementById("DisposeDept").value;
                                $.ajax({
                                    type: 'POST',
                                    url: ' DisposeDepartmentSearchBox.php',                
                                    data: {INPUT:x},
                                success: function(data) {
                                    
                                    $( "#DisposeDepartmentSearchBox" ).replaceWith( data );
                                    
                                } 											 
                                })
                            }
                        </script>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;text-align:right;"><button class="btn btn-default" style="margin-right:10px;" onclick="ClearAll()">Clear</button><button class="btn btn-primary" onclick="SaveDisposeAsset()">Dispose</button></td>
                    </tr>
                    <script>
                    function SaveDisposeAsset(){
                        var RequestorID=document.getElementById('RequestorID').value;
                        var AssetTag=document.getElementById('DisposeAssetTag').value;
                        var DisposeReason=document.getElementById('DisposeReason').value;
                        var DisposeNote=document.getElementById('DisposeNote').value;
                        if(AssetTag!=""){
                            $.ajax({
                            type: 'POST',
                            url: ' SaveAssetDisposal.php',                
                            data: {Tag:AssetTag,Reason:DisposeReason,Note:DisposeNote,Requestor:RequestorID},
                            success: function(data) {
                                if(data==0){
                                    alert('Failed To Dispose Asset...Please Try Again Later...');
                                }else{
                                    alert('Successfully Disposed Asset...');
                                    document.getElementById('DisposeAssetTag').value="";
                                    
                                    document.getElementById('DisposeNote').value="";
                                    $( "#DisposeTableList" ).replaceWith( data );
                                }
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
                    <th>Asset Type</th>
                    <th>Reason For Disposal</th>
                    <th>Date of Disposal</th>
                    <th>Note</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" style="text-align:center;">No Asset Found</td>
                    </tr>
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
                        <td style="vertical-align: middle;color:#083240;text-align:left;padding:0px" colspan="4" id="Title1"><h3 style="margin:10px 0px 0px 10px">Filter Asset</h3></td>
                        
                        <td style="vertical-align: middle;color:#083240;text-align:left;padding:0px" colspan="2" id="Title3"><h3 style="margin:10px 0px 0px 0px ;">Reason for Recovery</h3></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;" width="10%">Asset Tag</td>
                        <td style="vertical-align: middle;" width="15%"><input type="text" class="form-control" placeholder="Enter Asset Tag" id="AssetTagRecover" onblur="ClearSearch()" onclick="RecoverSearch()" onkeyup="RecoverSearch()">
                        <div id="SearchResultRecover"></div>
                        </td>
                        <td style="vertical-align: middle;text-align:right;" width="10%">Location</td>
                        <td style="vertical-align: middle;" width="15%"><input type="text" placeholder="Filter by Location" class="form-control" onblur="ClearSearch()" onclick="RecoverLocationSearchBox()" id="LocationRecover" onkeyup="RecoverLocationSearchBox()">
                        <div id="RecoverLocationSearchBox"></div>
                        <script>
                            function RecoverLocationSearchBox(){
                                var x = document.getElementById("LocationRecover").value;
                                $.ajax({
                                    type: 'POST',
                                    url: ' RecoverLocationSearchBox.php',                
                                    data: {INPUT:x},
                                success: function(data) {
                                    
                                    $( "#RecoverLocationSearchBox" ).replaceWith( data );
                                    
                                } 											 
                                })
                            }
                        </script>
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
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="DescRecover" placeholder="Filter by" onblur="ClearSearch()" onclick="RecoverAssetSearchBox()" onkeyup="RecoverAssetSearchBox()">
                        <div id="RecoverAssetSearchBox"></div>
                        <script>
                            function RecoverAssetSearchBox(){
                                var x = document.getElementById("DescRecover").value;
                                
                                $.ajax({
                                    type: 'POST',
                                    url: ' RecoverAssetSearchBox.php',                
                                    data: {INPUT:x},
                                success: function(data) {
                                    
                                    $( "#RecoverAssetSearchBox" ).replaceWith( data );
                                    
                                } 											 
                                })
                            }
                        </script>
                        </td>
                        <td style="vertical-align: middle;text-align:right;">Site</td>
                        <td style="vertical-align: middle;">
                        <input type="text" class="form-control" id="RecoverSite" placeholder="Filter by Site" onclick="RecoverSiteSiteSearchBox()" onkeyup="RecoverSiteSiteSearchBox()">
                        <div id="RecoverSiteSiteSearchBox"></div>
                        <script>
                            function RecoverSiteSiteSearchBox(){
                                var x = document.getElementById("RecoverSite").value;
                                var x2 = document.getElementById("LocationRecover").value;
                                $.ajax({
                                    type: 'POST',
                                    url: ' RecoverSiteSearchBox.php',                
                                    data: {INPUT:x,Location:x2},
                                success: function(data) {
                                    
                                    $( "#RecoverSiteSiteSearchBox" ).replaceWith( data );
                                    
                                } 											 
                                })
                                
                            }
                        </script>
                        </td>
                        <td style="vertical-align: middle;text-align:right;" rowspan="2">Note</td>
                        <td style="vertical-align: middle;" rowspan="2"><textarea style="width:50%" class="form-control" rows="3" id="RecoverNote"></textarea></td>
                        
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Department</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="DeptRecover" placeholder="Filter by Department" onblur="ClearSearch()" onclick="RecoverDepartmentSearchBox()" onkeyup="RecoverDepartmentSearchBox()">
                        <div id="RecoverDepartmentSearchBox"></div>
                        <script>
                            function RecoverDepartmentSearchBox(){
                                var x = document.getElementById("DeptRecover").value;
                                $.ajax({
                                    type: 'POST',
                                    url: ' RecoverDepartmentSearchBox.php',                
                                    data: {INPUT:x},
                                success: function(data) {
                                    
                                    $( "#RecoverDepartmentSearchBox" ).replaceWith( data );
                                    
                                } 											 
                                })
                            }
                        </script>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;text-align:right;"><button class="btn btn-default" style="margin-right:10px;" onclick="ClearAll()">Clear</button><button class="btn btn-primary" onclick="RecoverAssetFromDespose()">Recover Asset</button></td>

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
                        <td style="vertical-align: middle;color:#083240;text-align:left;padding:0px" colspan="4" id="Title1"><h3 style="margin:10px 0px 0px 10px">Filter Asset</h3></td>
                        
                        <td style="vertical-align: middle;color:#083240;text-align:left;padding:0px" colspan="2" id="Title3"><h3 style="margin:10px 0px 0px 0px ;">Reason for Maintenance</h3></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;" width="10%">Asset Tag</td>
                        <td style="vertical-align: middle;" width="15%"><input type="text" class="form-control" id="MaintenanceAssetTag" placeholder="Enter Asset Tag" onclick="SearchMaintenanceResult()" onkeyup="SearchMaintenanceResult()">
                        <div id="SearchResultMaintenanceAssetTag"></div>
                        </td>
                        <td style="vertical-align: middle;text-align:right;" width="10%">Location</td>
                        <td style="vertical-align: middle;" width="15%"><input type="text" class="form-control" id="MaintenanceLocation" placeholder="Filter by Asset Location" onclick="MainLocationSearchBox()" onkeyup="MainLocationSearchBox()">
                        <div id="MainLocationSearchBox"></div>
                        <script>
                            function MainLocationSearchBox(){
                                var x = document.getElementById("MaintenanceLocation").value;
                                $.ajax({
                                    type: 'POST',
                                    url: ' MainLocationSearchBox.php',                
                                    data: {INPUT:x},
                                success: function(data) {
                                    
                                    $( "#MainLocationSearchBox" ).replaceWith( data );
                                    
                                } 											 
                                })
                            }
                        </script>
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
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MaintenanceAssetDesc" placeholder="Filter by Asset" onclick="MainAssetSearchBox()" onkeyup="MainAssetSearchBox()">
                        <div id="MainAssetSearchBox"></div>
                        <script>
                            function MainAssetSearchBox(){
                                var x = document.getElementById("MaintenanceAssetDesc").value;
                                $.ajax({
                                    type: 'POST',
                                    url: ' MainAssetSearchBox.php',                
                                    data: {INPUT:x},
                                success: function(data) {
                                    
                                    $( "#MainAssetSearchBox" ).replaceWith( data );
                                    
                                } 											 
                                })
                            }
                        </script>
                        </td>
                        <td style="vertical-align: middle;text-align:right;">Site</td>
                        <td style="vertical-align: middle;">
                        <input type="text" class="form-control" id="MainSite" placeholder="Filter by Site" onclick="MainSiteSearchBox()" onkeyup="MainSiteSearchBox()">
                        <div id="MainSiteSearchBox"></div>
                        <script>
                            function MainSiteSearchBox(){
                                var x = document.getElementById("MainSite").value;
                                var x2 = document.getElementById("MaintenanceLocation").value;
                                $.ajax({
                                    type: 'POST',
                                    url: ' MainSiteSearchBox.php',                
                                    data: {INPUT:x,Location:x2},
                                success: function(data) {
                                    
                                    $( "#MainSiteSearchBox" ).replaceWith( data );
                                    
                                } 											 
                                })
                                
                            }
                        </script>
                        </td>
                        <td style="vertical-align: middle;text-align:right;" rowspan="1">Due Date</td>
                        <td style="vertical-align: middle;" rowspan="1"><input type="date" class="form-control" style="width:50%;" min="2019-11-22" id="MaintenanceDueDate"></td>
                        
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Department</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="MaintenanceDept" placeholder="Filter by Department" onclick="MainDepartmentSearchBox()" onkeyup="MainDepartmentSearchBox()">
                        <div id="MainDepartmentSearchBox"></div>
                        <script>
                            function MainDepartmentSearchBox(){
                                var x = document.getElementById("MaintenanceDept").value;
                                $.ajax({
                                    type: 'POST',
                                    url: ' MainDepartmentSearchBox.php',                
                                    data: {INPUT:x},
                                success: function(data) {
                                    
                                    $( "#MainDepartmentSearchBox" ).replaceWith( data );
                                    
                                } 											 
                                })
                            }
                        </script>
                        </td>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;text-align:right;" rowspan="1">Note</td>
                        <td style="vertical-align: middle;" rowspan="1"><textarea class="form-control" style="width:50%;" id="MaintenanceNote"></textarea></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;text-align:right;"><button class="btn btn-default" style="margin-right:10px;" onclick="ClearAll()">Clear</button><button class="btn btn-primary" onclick="SaveMaintenanceAsset()">Send for Maintenance</button></td>
                    </tr>
                    <script>
                    function SaveMaintenanceAsset(){
                        var RequestorID=document.getElementById('RequestorID').value;
                        var AssetTag=document.getElementById('MaintenanceAssetTag').value;
                        var DisposeReason=document.getElementById('MaintenanceReason').value;
                        var MaintenanceDueDate=document.getElementById('MaintenanceDueDate').value;
                        var DisposeNote=document.getElementById('MaintenanceNote').value;
                        if(AssetTag!=""){
                            $.ajax({
                            type: 'POST',
                            url: ' SaveAssetMaintenance.php',                
                            data: {Tag:AssetTag,Reason:DisposeReason,Note:DisposeNote,Requestor:RequestorID,MaintenanceDueDate:MaintenanceDueDate},
                            success: function(data) {
                                if(data==0){
                                    alert('Failed To Mark Asset for Maintenance...Please Try Again Later...');
                                }else{
                                    alert('Successfully Mark Asset for Maintenance...');
                                    document.getElementById('MaintenanceAssetTag').value="";
                                    document.getElementById('MaintenanceDueDate').value="";
                                    
                                    document.getElementById('MaintenanceNote').value="";
                                    $( "#MaintenanceTableList" ).replaceWith( data );
                                }
                            } 											 
                            })
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
                    <th>Asset Type</th>
                    <th>Reason For Maintenance</th>
                    <th>Date of Maintenance</th>
                    <th>Due Date for Maintenance</th>
                    <th>Note</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;color:#083240;">ME-COV-000-006</td>
                        <td style="vertical-align: middle;color:#083240;">MINOR EQUIPMENT</td>
                        <td style="vertical-align: middle;color:#083240;">Non-Current Asset</td>
                        <td style="vertical-align: middle;color:#083240;">Regular Check up</td>
                        <td style="vertical-align: middle;color:#083240;">2019-09-12</td>
                        <td style="vertical-align: middle;color:#083240;">2019-09-28</td>
                        <td style="vertical-align: middle;color:#083240;"></td>
                    </tr>
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
                        <td style="vertical-align: middle;"><input type="date"  class="form-control" id="DueDateExtendDue" ></td>
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
                    <th>Asset Type</th>
                    
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