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
                        <td style="vertical-align: middle;"><input id="ScanBox" type="text" class="form-control" onclick="GetInput()" onkeyup="GetInput()" placeholder="Scan Here">
                        <div id="SearchResult"></div></td>
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
                        <td style="vertical-align: middle;text-align:right;">Asset Tag</td>
                        <td style="vertical-align: middle;"><input type="text" id="AssetTag" class="form-control" onkeyup="CheckEmpID()"></td>
                        
                        <td style="vertical-align: middle;text-align:right;">Employee ID</td>
                        <td style="vertical-align: middle;"><input type="text" id="CustomerID" class="form-control" placeholder="Scan Person Here...." onclick="GetCustomer()" onkeyup="GetCustomer()">
                        <div id="SearchResult2"></div></td>	
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
                        <td style="vertical-align: middle;text-align:right;">Employee Name</td>
                        <td style="vertical-align: middle;"><input type="text" id="Assignto" class="form-control" readonly=""></td>
                        
                        <td style="vertical-align: middle;"><input type="date" class="form-control" min="2019-11-22" id="DueDate" style="display:none;"></td>
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
                        <td style="vertical-align: middle;"><input type="text" id="DepartmentName" class="form-control"></td>
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
                        
                        <td style="vertical-align: middle;"><input type="hidden" id="HiddenType"></td>
                        <td style="vertical-align: middle;text-align:right;" colspan="3"><button class="btn btn-default" onclick="ClearAll()">Clear</button><button class="btn btn-primary" disabled="" id="AddQueueCheckout" onclick="AddToQueue()">Add to Queue</button></td>
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
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="CheckinScanBox" onclick="GetSearchCheckIn()" onkeyup="GetSearchCheckIn()" placeholder="Scan here">
                        <div id="SearchResultCheckin"></div></td>
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
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="AssetTagIN"></td>
                        <td style="vertical-align: middle;text-align:right;">Employee ID</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="AssignTOIN"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Asset </td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="AssetDescIN"></td>
                        <td style="vertical-align: middle;text-align:right;">Employee Name</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="CustomerNumberIN"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Site</td>
                        <td style="vertical-align: middle;"><input type="text" id="AssetSiteIN" class="form-control"></td>
                        <td style="vertical-align: middle;text-align:right;">Due Date</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="DueDateIN"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Location</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="LocationIN"></td>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Department</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="DepartmentIN"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td colspan="2"></td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"><input type="hidden" id="HiddenTransactionIDIN"></td>
                        <td style="vertical-align: middle;"><input type="hidden" id="HiddenTypeIN"></td>
                        <td colspan="2"></td>
                        <td style="vertical-align: middle;text-align:right;"><button class="btn btn-default" style="margin-right:10px;" onclick="ClearAll()">Clear</button><button class="btn btn-primary" disabled="" onclick="QueueCheckinAsset()">Add to Queue</button></td>
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
                    <th>Asset Type</th>
                    
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
                        function SearchExtendDueDate(){
                            var x = document.getElementById("ExtendDueScanBox").value;
                
                            $.ajax({
                                type: 'POST',
                                url: ' SearchResultExtendDue.php',                
                                data: {INPUT:x},
                            success: function(data) {
                                $( "#SearchResultExtendDue" ).replaceWith( data );
                                
                            } 											 
                            })
                        }
                        
                    </script>
                <tbody>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;color:#083240">Scan Here</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="ExtendDueScanBox" onclick="SearchExtendDueDate()" onkeyup="SearchExtendDueDate()" placeholder="Scan here">
                        <div id="SearchResultExtendDue"></div></td>
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
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="AssetTagExtendDue"></td>
                        <td style="vertical-align: middle;text-align:right;">Employee Name</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="EmployeeNameExtendDue"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Asset </td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" rows="3 " id="AssetDescExtendDue"></td>
                        <td style="vertical-align: middle;text-align:right;">Due Date</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="OldDueExtendDue"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Site</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="SiteExtendDue"></td>
                        <td style="vertical-align: middle;text-align:right;">New Due Date</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="DueDateExtendDue"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Location</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="LocationExtendDue"></td>
                        <td style="vertical-align: middle;text-align:right;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;">Department</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" id="DepartmentExtendDue"></td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td colspan="2"></td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"><input type="hidden" id="HiddenTransactionIDExtendDue"></td>
                        <td style="vertical-align: middle;"><input type="hidden" id="HiddenTypeExtendDue"></td>
                        <td colspan="2"></td>
                        <td style="vertical-align: middle;text-align:right;"><button class="btn btn-default" style="margin-right:10px;" onclick="ClearAll()">Clear</button><button class="btn btn-primary" disabled="" onclick="QueueExtendDueAsset()">Add to Queue</button></td>
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