@extends('main.main')


@section('content')
<style>
.asset_setup_tab{
    cursor:pointer;
    color:#124f62 !important;

}
.asset_setup_tab:hover{
    color:white !important;
    background-color: #124f62 !important;
}
</style>
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12">
            <h2 style="font-weight:bold;color:#083240;margin-top:10px;margin-bottom:20px;">Assets</h2>
        </div>
    </div>
    <ul class="nav nav-tabs nav-tab-custom" style="display:inline-flex;width:100%;"   role="tablist">
        <li class="nav-item" >
            <a class="nav-link {{($page=='1'? 'active' : ($page==''? 'active' : '') )}}" id="viewasset-tab" data-toggle="tab" href="#ViewAssetTab" role="tab" aria-controls="home" aria-selected="true">View Assets</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link {{($page=='2'? 'active' : '' )}}" id="newasset-tab" data-toggle="tab" href="#NewAssetTab" role="tab" aria-controls="profile" aria-selected="false">New Asset</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='3'? 'active' : '' )}}" id="assetinfo-tab" data-toggle="tab" href="#AssetInfoTab" role="tab" aria-controls="contact" aria-selected="false">Asset Information</a>
        </li>
        <li class="nav-item" style="margin-left:auto;">
            <a class="asset_setup_tab nav-link" id="assetsetup-tab" data-toggle="modal" data-target="#AssetSetupModal">Asset Setup and Reference</a>
        </li>
    </ul>
    <div class="tab-content" id="AssetPageTabs" style="margin-bottom:10px;">
        <div class="tab-pane fade {{($page=='1'? 'active show' : ($page==''? 'active show' : '') )}}" id="ViewAssetTab" role="tabpanel" aria-labelledby="home-tab" style="background-color:transparent !important;">
            <table class="table table-sm"  style="background-color:white;margin-top:10px;">
				<thead style="background-color:#124f62; color:white;">
					<tr>
						<th>Custom Select Columns</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
						
						<button class="btn btn-success btn-sm" onclick="SetDefaultColumns()" id="h0">Default View</button>
						<button class="btn btn-success btn-sm" onclick="toggleH('h1')" id="h1">Asset Tag</button>
						<button class="btn btn-success btn-sm" onclick="toggleH('h2')" id="h2">Asset</button>
						<button class="btn btn-success btn-sm"  onclick="toggleH('h16')" style="display:none" id="h16">Current Assets</button>
						<button class="btn btn-success btn-sm" onclick="toggleH('h4')" id="h4">Category</button>
						<button class="btn btn-success btn-sm" onclick="toggleH('h5')" id="h5">Sub Category</button>
						<button class="btn btn-success btn-sm" onclick="toggleH('h6')" id="h6">Brand</button>
						<button class="btn btn-success btn-sm" onclick="toggleH('h7')" id="h7">Department</button>
						<button class="btn btn-success btn-sm" onclick="toggleH('h8')" id="h8">Availability</button>
						<button class="btn btn-success btn-sm" onclick="toggleH('h9')" id="h9">Status</button>
						<button class="btn btn-success btn-sm" onclick="toggleH('h10')" id="h10">Condition</button>
						
						
						<button class="btn btn-success btn-sm" onclick="toggleH('h14')" id="h14">Site</button>
						<button class="btn btn-success btn-sm" onclick="toggleH('h15')" id="h15">Location</button>
						
						
						</td>
					</tr>
				</tbody>
            </table>
            
            <table class="table table-bordered table-hover table-sm" id="TableAsset" style="background-color:white; margin-top:10px;">
                <thead style="background-color:#124f62; color:white;">
                    <tr>
                        <th width="15%">Asset</th>
                        <th width="15%">Category</th>
                        <th width="15%">Sub Category</th>
                        <th width="5%">Quantity</th>
                        <th width="5%">Item Out</th>
                        <th width="5%">Available</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div class="tab-pane fade {{($page=='2'? 'active show' : '' )}}" id="NewAssetTab" role="tabpanel" aria-labelledby="home-tab" style="background-color:transparent !important;">
            {{-- new asset tab --}}
            <ul class="nav nav-tabs nav-tab-custom"  role="tablist" style="background-color:white !important;">
                
                <li class="nav-item" >
                    <a class="nav-link active" id="GeneralInfoTab-tab" data-toggle="tab" href="#NewAssetGeneralInfoTab" role="tab" aria-controls="home" aria-selected="true">General</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" id="Attachment-tab" data-toggle="tab" href="#NewAssetAttachmentTab" role="tab" aria-controls="profile" aria-selected="false">Attachment</a>
                </li>
                
            </ul>
            
                <script>
                $(document).ready(function(){
                    $("#NewAssetForm").submit(function(e) {
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'add_new_asset',                
                            data: $('#NewAssetForm').serialize(),
                            success: function(data) {
                                if(data==1){
                                    Swal.fire({
                                    type: 'success',
                                    title: 'Success',
                                    text: 'Successfully Added New Asset Request',
                                    }).then((result) => {
                                        location.href="asset?page=2";
                                    })
                                }else{
                                    Swal.fire({
                                    type: 'error',
                                    title: 'Error!',
                                    text: 'Failed to Add New Asset Request',
                                    }).then((result) => {
                                        location.href="asset?page=2";
                                    })
                                }
                                
                            }
                        })
                    });
                });
                </script>
                <form id="NewAssetForm">
                <div class="tab-content" id="NewAssetTabTabs">
                <div class="tab-pane fade show active" id="NewAssetGeneralInfoTab" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table borderless table-sm" style="background-color:white;margin-top:10px;">
                        <thead style="background-color:#124f62; color:white;">
                            <tr>
                                <th colspan="5">ASSET INFORMATION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr >
                                
                                <td style="vertical-align: middle;text-align:right;color:#083240;display:none">Asset Type</td>
                                <td style="vertical-align: middle; position:relative;display:none">
                                <select class="form-control" style="width:80%;" onchange="SetUOMAmount(),getQR()" onkeypress="return alphaOnly(event)" name="AssetType" id="TYTPE"  title="Characters(A-Z) Only" required>
                                <option value="Non-Current Asset">Non-Current Asset</option>
                                
                                </select>
                                    
                                </td>
                                
                            </tr>
                            <tr>
                                <td width="15%" style="vertical-align: middle;text-align:right;color:#083240;"></td>
                                <td width="25%" style="vertical-align: middle;"></td>
                                <td width="20%" style="vertical-align: bottom;text-align:center;" rowspan="5"><img id="QRCode" src="{{asset('images/Asset_Photo/noqr.jpg')}}" style="width:70%;">
                                
                                </td>
                                <td  style="vertical-align: middle;" rowspan="9">
                                <div class="col-md-3" style="display:none;">
                                    <ul class="hide-bullets" >
                                        <div class="row">
                                        <li class="col-sm-12">
                                            <a class="thumbnail" id="carousel-selector-0"><img id="photo1thumbnail"  src="{{asset('images/Asset_Photo/noimage.png')}}"></a>
                                        </li>
                                        </div>
                                        <div class="row">
                                        <li class="col-sm-12">
                                            <a class="thumbnail" id="carousel-selector-1"><img id="photo1thumbnail2"  src="{{asset('images/Asset_Photo/noimage.png')}}"></a>
                                        </li>
                                        </div>
                                        <div class="row">
                                        <li class="col-sm-12">
                                            <a class="thumbnail" id="carousel-selector-2"><img id="photo1thumbnail3"  src="{{asset('images/Asset_Photo/noimage.png')}}"></a>
                                        </li>
                                        </div>
                                        
                                    </ul>
                                </div>
                                <div class="col-md-9" style="display:none;">
                                    <div class="carousel" id="myCarousel">
                                        <!-- Carousel items -->
                                        <div class="carousel-inner" >
                                            <div class="active item" data-slide-number="0" style="position:relative;">
                                            <img id="blah" src="{{asset('images/Asset_Photo/noimage.png')}}" >
                                            <label style="position:absolute; bottom: 0px;left: 0px;" for="image-upload" class="custom-file-upload">
                                                <i class="	glyphicon glyphicon-camera"></i> Select Photo
                                            </label>
                                            <input id="image-upload"  type="file" onchange="readURL(this);" name="AssetPhoto" accept="image/*" >
                                            
                                            </div>

                                            <div class="item" data-slide-number="1" style="position:relative;">
                                            <img id="blah2" src="{{asset('images/Asset_Photo/noimage.png')}}" >
                                            <label style="position:absolute; bottom: 0px;left: 0px;" for="image-upload2" class="custom-file-upload">
                                                <i class="	glyphicon glyphicon-camera"></i> Select Photo
                                            </label>
                                            <input id="image-upload2" type="file" onchange="readURL2(this);" name="AssetPhoto2" accept="image/*">
                                            </div>

                                            <div class="item" data-slide-number="2" style="position:relative;">
                                            <img id="blah3" src="{{asset('images/Asset_Photo/noimage.png')}}" >
                                            <label style="position:absolute; bottom: 0px;left: 0px;" for="image-upload3" class="custom-file-upload">
                                                <i class="	glyphicon glyphicon-camera"></i> Select Photo
                                            </label>
                                            <input id="image-upload3" type="file" onchange="readURL3(this);" name="AssetPhoto3" accept="image/*">
                                            </div>

                                            
                                        </div><!-- Carousel nav -->
                                                                    
                                    </div>
                                </div>
                                
                                
                                </td>
                            </tr>
                            
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;">Asset Description</td>
                                <td style="vertical-align: middle;">
                                <input type="hidden" id="HiddenDescAss" name="HiddenAssetDescription" value="">
                                <select style="width:80%;" class="form-control" onchange="SetQRTitle()" id="Descrrrr" name="AssetDescription">
                                    <option value="">--Select Description--</option>
                                    @foreach ($asset_description_grouped as $desc)
                                        <option value="{{$desc->asset_setup_ad}}">{{$desc->asset_setup_description}}</option>
                                    @endforeach
                                </select>
                                
                                <script>
                                function SetQRTitle(){
									var Desc=document.getElementById('Descrrrr').value;
									
									document.getElementById('HiddenDescAss').value=$('#Descrrrr').find(':selected').text();
									$.ajax({
                                    type: 'POST',
                                    url: 'getCategoryNewAsset',     
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },           
                                    data: {value:Desc,_token: '{{csrf_token()}}'},
                                    success: function(data) {
                                        var element='<select style="width:80%;" onchange="SetSub(),SetAssetTag()" id="CatName" class="form-control" name="CategoryName">';
                                            element=element+data;
                                            element=element+'</select>';
                                        $( "#CatName" ).replaceWith( element );
										SetSub();
                                    }  
                                    });
									
								}
                                function SetSub(){
                                    var Desc=document.getElementById('Descrrrr').value;
									var Sub=document.getElementById('CatName').value;
                                    $.ajax({
                                    type: 'POST',
                                    url: 'GetSubNewAsset',  
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },              
                                    data: {value:Desc,value2:Sub,_token: '{{csrf_token()}}'},
                                    success: function(data) {
                                        var element='<select style="width:80%;" onchange="SetAssetTag()" id="SubCatName" class="form-control" name="SubCategory">';
                                            element=element+data;
                                            element=element+'</select>';
                                        $( "#SubCatName" ).replaceWith( element );
										SetAssetTag();
                                    }  
                                    });
									
                                }
                                function SetAssetTag(){
									var Desc=document.getElementById('Descrrrr').value;
									var Cat=document.getElementById('CatName').value;
									var Sub=document.getElementById('SubCatName').value;
									$.ajax({
                                    type: 'POST',
                                    url: 'GetAssetCount', 
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },               
                                    data: {_token: '{{csrf_token()}}'},
                                    success: function(data) {
                                        var Count=data;
										var desccode="";
										var catcode="";
										var subcode="";
										if(Desc!=""){
											desccode=Desc+"-";
										}
										if(Cat!=""){
											catcode=Cat+"-";
										}
										if(Sub!=""){
											subcode=Sub+"-";
										}
										
										if(Desc=="" && Cat=="" ){
											document.getElementById('AssetTaggg').value="";
											
										}
										else{
											document.getElementById('AssetTaggg').value=desccode+catcode+subcode+Count;
										}
										getQR();
                                    }  
                                    });
									
								}
                                function getQR(){
									var SerialCode=document.getElementById('SerialCode').value;
									var SKUCODE=document.getElementById('SKUCODE').value;
									var tag=document.getElementById('AssetTaggg').value;
									var Cat=$('#CatName').find(':selected').text();
									var Sub=$('#SubCatName').find(':selected').text();
									var Descrrrr=$('#Descrrrr').find(':selected').text();
									if(SerialCode!=""){
										SerialCode="SN-"+SerialCode;
									}
									if(SKUCODE!=""){
										SKUCODE="PN-"+SKUCODE;
									}
									if(Cat!=""){
										Cat="Cat-"+Cat;
									}
									if(Sub!=""){
										Sub="SC-"+Sub;
									}
									var url="https://api.qrserver.com/v1/create-qr-code/?data="
									+tag+"%0AAsset Description - "+Descrrrr
									+"%0A"+Cat
									+"%0A"+Sub
									+"%0A"+SerialCode
									+"%0A"+SKUCODE+"&amp;size=150x150";
									
									
									
									$("#QRCode").attr("src", url);
									$("#QRCode").attr("title", tag);
									setSerial();
									
								}
                                function setSerial(){
									var Desc=document.getElementById('Descrrrr').value;
									var Cat=document.getElementById('CatName').value;
									var Sub=document.getElementById('SubCatName').value;
                                    $.ajax({
                                    type: 'POST',
                                    url: 'SetSerialAndUOM', 
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },               
                                    data: {Desc:Desc,Cat:Cat,Sub:Sub,_token: '{{csrf_token()}}'},
                                    success: function(data) {
                                        $( "#requireserial_div" ).replaceWith( data );
                                    }  
                                    });
									
								}
                                </script>
                                </td>
                                
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;">Category</td>
                                <td style="vertical-align: middle;"><input type="text" style="width:80%;" readonly id="CatName" class="form-control" name="CategoryName"></td>
                                
                                
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;">Sub Category</td>
                                <td style="vertical-align: middle;"><input type="text" style="width:80%;" readonly id="SubCatName" class="form-control" name="SubCategory"></td>
                            </tr>
                            
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;">Manufacturer</td>
                                <td style="vertical-align: middle;"><input type="text" style="width:80%;" class="form-control" name="Manufacturer" ></td>
                                
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;">Brand *</td>
                                <td style="vertical-align: middle;"><input type="text" style="width:80%;" class="form-control" name="Brand" required></td>
                                <td style="vertical-align: middle;text-align:center;color:#083240;">
                                <div style="text-align:center;">
                                <input type="text" style="width:70%;padding:6px 12px;border-radius:4px;border:1px solid #ccc;" name="AssetTag" readonly id="AssetTaggg" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"  required>
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;">Model</td>
                                <td style="vertical-align: middle;"><input type="text" style="width:80%;" class="form-control" name="Model"></td>
                                <td style="vertical-align: middle;text-align:center;color:#083240;">ASSET TAG</td>
                            </tr>
                            <tr id="SerialTableRow">
                                <script>
                                function SetUOMAmount(){
                                    var TypeValue=document.getElementById('TYTPE').value;
                                    if(TypeValue=="Current Asset"){
                                        document.getElementById('SerialTableRow').style.display="none";
                                        document.getElementById('UOMVALUETR').style.display="table-row";
                                        document.getElementById('UOMVALUE').style.display="table-row";
                                        document.getElementById("SerialCode").required = false;
                                    }else{
                                        document.getElementById('SerialTableRow').style.display="table-row";
                                        document.getElementById('UOMVALUETR').style.display="none";
                                        document.getElementById('UOMVALUE').style.display="none";
                                        document.getElementById("SerialCode").required = true;
                                    }
                                }
                                </script>
                                <?php
                                
                                ?>
                                <div id="requireserial_div"></div>
                                <td style="vertical-align: middle;text-align:right;color:#083240;" id="SerialLabel">Serial Number</td>
                                <td style="vertical-align: middle;"><input  title="Serial Number already exist" data-content="Serial Number already exist.." type="text" style="width:80%;" id="SerialCode" class="form-control" name="SerialNumber" onkeyup="CheckSerial(),getQR()"><div id="ssscrr"></div></td>
                                <script>
                                    var sStatus=0;
                                    var pStatus=0;
                                    var InStatus=0;
                                    function CheckSerial(){
                                        document.getElementById('SaveAssetBtn').disabled=false;
                                        if($(document.getElementById('SerialCode')).prop('required')){
                                            
                                            var serial=document.getElementById('SerialCode').value;
                                            if(serial=="N/A" || serial==""){
                                                
                                            }else{
                                                $.ajax({
                                                type: 'POST',
                                                url: 'checkserialunique',  
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },              
                                                data: {serial:serial,_token: '{{csrf_token()}}'},
                                                success: function(data) {
                                                    if(data==0){
                                                        sStatus=0;
                                                        // $('#SerialCode').popover('hide');
                                                        // $('#SerialCode').popover('disable');
                                                        if(InStatus==0 && sStatus==0 && pStatus==0){
                                                            document.getElementById('SaveAssetBtn').disabled=false;
                                                        }
                                                        document.getElementById("SerialCode").style.borderColor = "#d8d8d8";
                                                    }else{
                                                        //$( "#ssscrr	" ).replaceWith( data );
                                                        sStatus=1;
                                                        document.getElementById('SaveAssetBtn').disabled=true;
                                                        document.getElementById("SerialCode").style.borderColor = "#ed5a5a";
                                                        // $('#SerialCode').popover('enable');
                                                        // $('#SerialCode').popover('show');
                                                    }
                                                }  
                                                });
                                                
                                            }
                                            
                                            
                                        }
                                    }
                                </script>
                                <script>
                                    function CheckPlate(){
                                        if($(document.getElementById('SKUCODE')).prop('required')){
                                            var serial=document.getElementById('SKUCODE').value;
                                            $.ajax({
                                            type: 'POST',
                                            url: 'checkplateunique',     
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },           
                                            data: {serial:serial,_token: '{{csrf_token()}}'},
                                            success: function(data) {
                                                if(data==0){
                                                    pStatus=0;
                                                    $('#SKUCODE').popover('hide');
                                                    if(InStatus==0 && sStatus==0 && pStatus==0){
                                                        document.getElementById('SaveAssetBtn').disabled=false;
                                                    }
                                                    document.getElementById("SKUCODE").style.borderColor = "#d8d8d8";
                                                }else{
                                                    //$( "#ssscrrPlate" ).replaceWith( data );
                                                    document.getElementById('SaveAssetBtn').disabled=true;
                                                    document.getElementById("SKUCODE").style.borderColor = "#ed5a5a";
                                                    //$('#SKUCODE').popover('show');
                                                    pStatus=1;
                                                }
                                            }  
                                            });
                                            
                                        }
                                        
                                    }
                                </script>
                            </tr>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;" id="PlateLabel">Plate Number</td>
                                <td style="vertical-align: middle;"><input onkeyup="CheckPlate(),getQR()" title="Plate Number already exist" data-content="Plate Number already exist.." type="text" style="width:80%;" class="form-control"  id="SKUCODE"  name="AssetSKU" ><div id="ssscrrPlate"></div></td>
                                
                            
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;">Condition</td>
                                <td style="vertical-align: middle;"><input type="text" style="width:80%;" class="form-control" name="AssetCondition"></td>
                            
                            </tr>
                            <tr id="UOMVALUE" style="display:none;">
                                <td style="vertical-align: middle;text-align:right;color:#083240;">Unit Of Measurement</td>
                                <td style="vertical-align: middle;">
                                    <select name="AssetUOM" class="form-control" style="width:80%;">
                                    <option value="Piece">Piece</option>
                                    <option value="Set">Set</option>
                                    <option value="Unit">Unit</option>
                                    <option value="Assembly">Assembly</option>
                                    <option value="Roll">Roll</option>
                                    <option value="Can">Can</option>
                                    <option value="Bottle">Bottle</option>
                                    <option value="Bags">Bags</option>
                                    <option value="Liter">Liter</option>
                                    <option value="Gallon">Gallon</option>
                                    <option value="Barrel">Barrel</option>
                                    <option value="Feet">Feet</option>
                                    <option value="Meter">Meter</option>
                                    <option value="Yard">Yard</option>
                                    <option value="Kilogram">Kilogram</option>
                                    
                                    </select>
                                </td>
                            
                            </tr>
                            <tr id="UOMVALUETR" style="display:none;">
                                <td style="vertical-align: middle;text-align:right;color:#083240;">UOM Amount</td>
                                <td style="vertical-align: middle;"><input type="number" style="width:80%;" class="form-control" name="AssetUOMAmount"></td>
                            
                            </tr>
                            <tr>
                                <td colspan="10" style="padding:5px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table borderless table-sm" style="background-color:white;margin:bottom:0px;">				
                        <thead style="background-color:#124f62; color:white;">
                            <tr>
                                <th colspan="2">Asset Location</th>
                                <th colspan="2" style="text-align:center;"></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;">Location *</td>
                                <td style="vertical-align: middle;">
                                <input type="text" list="LocationSearchResult" class="form-control" name="AssetLocation" id="LocationSearchInput" autocomplete="off" required  onclick="GetLocation()" onkeyup="GetLocation()">
                                <datalist id="LocationSearchResult"></datalist>
                                </td>
                                <script>
                                    function GetLocation(){
                                            var x = document.getElementById("LocationSearchInput").value;
                                            $.ajax({
                                            type: 'POST',
                                            url: 'GetLocationNewAsset', 
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },               
                                            data: {value:x,_token: '{{csrf_token()}}'},
                                            success: function(data) {
                                                var element='<datalist id="LocationSearchResult">';
                                                    element=element+data;
                                                    element=element+'</datalist>';
                                                $( "#LocationSearchResult" ).replaceWith( element );
                                                
                                            }  
                                            });
                                    }
                                </script>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;" width="15%">Site *</td>
                                <td style="vertical-align: middle;" width="20%;">
                                <input type="text" class="form-control" list="SiteSearchResult" name="AssetSite" id="SiteResultInput" onclick="GetSites()" required onkeyup="GetSites()">
                                <datalist id="SiteSearchResult"></datalist>
                                </td>
                                <td style="vertical-align: middle;text-align:right;color:#083240;" width="10%"></td>
                                <td style="vertical-align: middle;color:#083240;" width="20%;">
                                    <input type="text" name="StorageAsset" id="StorageSearchInput" class="form-control" onclick="GetStorage()" onkeyup="GetStorage()" style="display:none;">
                                    <div id="StorageSearchResult" style="display:none"></div>
                                </td>
                                <td></td>
                                <script>
                                    function GetStorage(){
                                        var x = document.getElementById("StorageSearchInput").value;
                                        
                                            // $.ajax({
                                            //     type: 'POST',
                                            //     url: ' SearchResultStorage.php',                
                                            //     data: {INPUT:x},
                                            // success: function(data) {
                                            //     $( "#StorageSearchResult" ).replaceWith( data );
                                            // } 											 
                                            // })
                                            
                                    }
                                    function GetSites(){
                                            var x = document.getElementById("SiteResultInput").value;
                                            var x2 = document.getElementById("LocationSearchInput").value;
                                            $.ajax({
                                                type: 'POST',
                                                url: 'GetSiteNewAsset',    
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },            
                                                data: {value:x,value2:x2,_token: '{{csrf_token()}}'},
                                                success: function(data) {
                                                    var element='<datalist id="SiteSearchResult">';
                                                        element=element+data;
                                                        element=element+'</datalist>';
                                                    $( "#SiteSearchResult" ).replaceWith( element );
                                                    
                                                }  
                                            });
                                           
                                    }
                                </script>
                            </tr>
                            
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;">Department</td>
                                <td style="vertical-align: middle;">
                                <select class="form-control" name="DepartmentCode" id="newAssetDept">
                                    <option value=""></option>
                                    @foreach ($company_department_active as $dept)
                                        <option value="{{$dept->department_id}}">{{$dept->department_name}}</option>
                                    @endforeach
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;" >Assign To</td>
                                <td style="vertical-align: middle;"><input  class="form-control"  name="NewAssignTO" ></td>
                                <td style="vertical-align: middle;text-align:right;color:#083240;" ></td>
                                <td style="vertical-align: middle;color:#083240;">
                                    
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="10" style="padding:5px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table borderless table-sm" style="background-color:white;">					
                        <thead style="background-color:#124f62; color:white;">
                            <tr>
                                <th colspan="3">Purchase Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align: middle;text-align:right; color:#083240;" width="14%">Vendor Name *</td>
                                <td style="vertical-align: middle;" width="18%;">
                                    <input type="text" class="form-control" name="vendor_number" placeholder="Choose Vendor..."  required>
                                </td>
                                <td width="60%"></td>
                                
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right; color:#083240;" >Purchase Order </td>
                                <td style="vertical-align: middle;" >
                                    <input type="text" class="form-control" name="purchase_order" placeholder="Purchase Order..." >
                                </td>
                                <td ></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right; color:#083240;" >Invoice Number *</td>
                                <td style="vertical-align: middle;" >
                                    <input type="text" class="form-control" onkeyup="CheckInvoice()"  name="invoice_number" id="Invoice_Number"  required>
                                    <div id="ssscrrInvoice"></div>
                                </td>
                                <script>
                                    function CheckInvoice(){
                                        if($(document.getElementById('Invoice_Number')).prop('required')){
                                            var serial=document.getElementById('Invoice_Number').value;
                                            $.ajax({
                                            type: 'POST',
                                            url: 'checkinvoicenumbernewasset',   
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },             
                                            data: {serial:serial,_token: '{{csrf_token()}}'},
                                            success: function(data) {
                                                    if(data==0){
                                                        InStatus=0;
                                                        //$('#Invoice_Number').popover('hide');
                                                        if(InStatus==0 && sStatus==0 && pStatus==0){
                                                            document.getElementById('SaveAssetBtn').disabled=false;
                                                        }
                                                        
                                                        document.getElementById("Invoice_Number").style.borderColor = "#d8d8d8";
                                                    }else{
                                                        //$( "#ssscrrInvoice" ).replaceWith( data );
                                                        document.getElementById('SaveAssetBtn').disabled=true;
                                                        document.getElementById("Invoice_Number").style.borderColor = "#ed5a5a";
                                                        //$('#Invoice_Number').popover('show');
                                                        InStatus=1;
                                                    }
                                            }  
                                            });
                                            
                                        }
                                        
                                    }
                                </script>
                                <td></td>
                                
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right; color:#083240;" >Purchase Date *</td>
                                <td style="vertical-align: middle;" >
                                    <input type="date" class="form-control" name="purchase_date" onchange="setStartDateMin()"  id="PurchaseDATE" required>
                                </td>
                                <td></td>
                                
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right; color:#083240;" >Purchase Cost *</td>
                                <td style="vertical-align: middle;" >
                                    <input type="text" class="form-control currency money" id="MockupInput" placeholder="Cost..."required onkeyup='SetComma(),SetInitial(),DecpriciableCost()' >
                                    <script type="text/javascript">
                                    
                                    $('input.currency').keyup(function(event) {

                                    // skip for arrow keys
                                    if(event.which >= 37 && event.which <= 40){
                                    event.preventDefault();
                                    }

                                    $(this).val(function(index, value) {
                                        value = value.replace(/,/g,''); // remove commas from existing input
                                        
                                        document.getElementById('PurchCost').value=value;
                                        return numberWithCommas(value); // add commas back in
                                    });
                                    });
                                    
                                    function numberWithCommas(x) {
                                        var parts = x.toString().split(".");
                                        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                        return parts.join(".");
                                    }
                                    
                                    function SetComma(){
                                        
                                        console.log('Set COmma');
                                        var ddd=document.getElementById('MockupInput').value;
                                        var res = ddd.replace(/,/g, "");
                                        console.log("res="+res);
                                        document.getElementById('PurchCost').value=res;
                                        SetInitial();
                                    }
                                    $(document).ready(function()
                                    {
                                        //$('.money').mask("#,###", {reverse: true});
                                        $('.currency').blur(function()
                                        {	
                                            $('.currency').formatCurrency();
                                            $('.currency').formatCurrency({symbol: ''});
                                            var value=document.getElementById('MockupInput').value;
                                            value = value.replace(/,/g,''); // remove commas from existing input
                                            console.log("value="+value);
                                            document.getElementById('PurchCost').value=value;
                                            SetComma();
                                        });
                                    });
                                    
                                    </script>
                                    <input type="hidden" class="form-control " step=".01" placeholder="Cost..." id="PurchCost" required onkeyup='SetComma(),SetInitial(),DecpriciableCost()' name="purchase_cost" >
                                    
                                </td>
                                <td ></td>
                                
                            </tr>
                            <script>
                                function setStartDateMin(){
                                    
                                    var puchaseDate=document.getElementById('PurchaseDATE').value;
                                    
                                    document.getElementById("DepreciationDATE").min = puchaseDate;
                                    var d1 = new Date(puchaseDate);
                                    var d2 = new Date(document.getElementById("DepreciationDATE").value );
                                    if(document.getElementById("DepreciationDATE").value!=""){
                                        console.log(d1>d2);
                                        if(d1>d2){
                                            document.getElementById("DepreciationDATE").value = puchaseDate;
                                            
                                        }
                                        
                                    }
                                    
                                    
                                    document.getElementById("DepreciationDATE").readOnly=false;
                                    DisableLeavePromtSubmit();
                                }
                            </script>
                            <tr>
                                <td style="vertical-align: middle;text-align:right; color:#083240;" >Start Date</td>
                                <td style="vertical-align: middle;" >
                                    <input type="date" class="form-control" name="depreciation_date" readonly  id="DepreciationDATE" max="<?php echo date('2100-m-d') ?>" onchange="ComputeCUrrentVlue()">
                                </td>
                                <td></td>
                                
                            </tr>
                            <tr>
                                <td colspan="10" style="padding:5px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <script>
                    function DisableLeavePromtSubmit(){
                        leaveprompt=0;
                        
                    }
                    function ComputeCUrrentVlue(){
                        DisableLeavePromtSubmit();
                        var INITVALUE=document.getElementById('INITVALUE').value;
                        var LIFEAPAN=document.getElementById('LIFEAPAN').value;
                        var DEPCOST=document.getElementById('DEPCOST').value;
                        var CURVAL=document.getElementById('CURVAL').value;
                        var FREQ=document.getElementById('FREQ').value;
                        var PurchaseDATE=document.getElementById('DepreciationDATE').value;
                        var Depreciablevalue=document.getElementById('DEPVALUE').value;
                        if(INITVALUE!="" && LIFEAPAN!=""){
                            var depreciationCost=Depreciablevalue/LIFEAPAN;
                            document.getElementById('DEPCOST').value=depreciationCost;
                            document.getElementById('deptioncostformatted').value=document.getElementById('DEPCOST').value;
                            $('#deptioncostformatted').formatCurrency();
                            $('#deptioncostformatted').formatCurrency({symbol: ''});
                        }
                            var date1 = new Date(PurchaseDATE);
                            var date2 = new Date();
                            var l=date1>=date2;
                            console.log(date1+" > "+date2+" "+l);
                            if(l==false){

                                                                    
                            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                            
                            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                            //alert(date1+" "+date2+" "+diffDays);
                            var divident=0;
                            if(FREQ=="Hourly"){
                                if(diffDays>0){
                                    divident=diffDays*24;
                                }
                                
                            }
                            if(FREQ=="Monthly"){
                                if(diffDays>30){
                                    divident=Math.floor(diffDays/30);
                                }
                            }
                            if(FREQ=="Yearly"){
                                if(diffDays>365){
                                    divident=Math.floor(diffDays/365);
                                }
                            }
                            var CostValeu=DEPCOST*(divident);
                            var CurrentValue=Depreciablevalue-CostValeu;
                            console.log("Divident :"+divident);
                            if(CurrentValue<0){
                                CurrentValue=0;
                            }
                            document.getElementById('CURVAL').value=CurrentValue;
                            }else{
                                document.getElementById('CURVAL').value=Depreciablevalue;
                            }
                            document.getElementById('CurvalFormatted').value=document.getElementById('CURVAL').value;
                            $('#CurvalFormatted').formatCurrency();
                            $('#CurvalFormatted').formatCurrency({symbol: ''});
                            CheckSerial();
                    }
                    function SetInitial(){
                        document.getElementById('INITVALUE').value=document.getElementById('PurchCost').value;
                        document.getElementById('INITVALUEFormatted').value=document.getElementById('INITVALUE').value;
                        $('#INITVALUEFormatted').formatCurrency();
                        $('#INITVALUEFormatted').formatCurrency({symbol: ''});
                        ComputeCUrrentVlue();
                    }
                    function DecpriciableCost(){
                        if(document.getElementById('INITVALUE').value!=0){
                            var salvage=document.getElementById('SALVALUE').value;
                            var INITIALBALUE=document.getElementById('INITVALUE').value;
                            
                            var dep=INITIALBALUE-salvage;
                            document.getElementById('DEPVALUE').value=dep;
                            document.getElementById('deptvalue123').value=document.getElementById('DEPVALUE').value;
                            $('#deptvalue123').formatCurrency();
                            $('#deptvalue123').formatCurrency({symbol: ''});
                        }
                        ComputeCUrrentVlue();
                    }
                    function FormatSalvageCost2(){
                        
                    //document.getElementById('SALVALUE').value=document.getElementById('depccccostformated').value;	
                    FFF2();
                    }
                    function FFF2(){
                        $('#depccccostformated').formatCurrency();
                        $('#depccccostformated').formatCurrency({symbol: ''});
                            var value=document.getElementById('depccccostformated').value;
                        value = value.replace(/,/g,''); // remove commas from existing input
                        console.log("Slav "+value);
                        document.getElementById('SALVALUE').value=value;									
                        DecpriciableCost();
                    }
                    function CDCDCDCDC(event) {
                        console.log('salv onkeyup');
                        // skip for arrow keys
                        if(event.which >= 37 && event.which <= 40){
                        event.preventDefault();
                        }

                        var value=document.getElementById('depccccostformated').value;
                        value = value.replace(/,/g,''); // remove commas from existing input
                        console.log("Slav "+value);
                        document.getElementById('SALVALUE').value=value;
                        document.getElementById('depccccostformated').value= numberWithCommas(value); // add commas back in
                        DecpriciableCost();
                    }
                    </script>
                    <table class="table borderless table-sm" style="background-color:white;margin-bottom:0px;">
                        <thead style="background-color:#124f62; color:white;">
                            <tr>
                                <th colspan="7">Depeciation Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Initial Value</td>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Salvage Cost *</td>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Depreciable Cost</td>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Depreciation Frequency</td>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Useful Life Span *</td>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Depreciation Cost</td>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Current Value</td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;color:#083240;" >
                                <input type="text" id="INITVALUEFormatted" class="form-control" value="0.00" readonly>
                                <input readonly style="display:none;" onkeyup="ComputeCUrrentVlue(),DecpriciableCost()" id="INITVALUE" name="initial_value" type="number" min="0" class="form-control" value="0">
                                </td>
                                <td style="vertical-align: middle;color:#083240;" >
                                <input type="text" id="depccccostformated" class="form-control salv" onfocus="setCCCC()" onkeyup="CDCDCDCDC(event)" onblur="FormatSalvageCost2()"  required>
                                <Script>
                                    function setCCCC(){
                                        if(document.getElementById('depccccostformated').value==""){
                                            document.getElementById('depccccostformated').value="0";
                                        }
                                    }
                                </script>
                                <input onkeyup="DecpriciableCost()" style="display:none;" id="SALVALUE" name="salvage_value" type="number" class="form-control" min="0" value="0" required>
                                </td>
                                <td style="vertical-align: middle;color:#083240;" >
                                <input type="text"  id="deptvalue123" class="form-control" value="0.00" readonly>
                                <input  id="DEPVALUE" style="display:none;" name="depreciable_value" type="number" class="form-control" value="0" readonly>
                                </td>
                                <td style="vertical-align: middle;color:#083240;"  >
                                    <select class="form-control" id="FREQ" name="depreciation_frequency" onchange="ComputeCUrrentVlue()">
                                        <option>Yearly</option>
                                        <option>Monthly</option>
                                        <option>Hourly</option>
                                    </select>
                                </td>
                                <td style="vertical-align: middle;color:#083240;" >
                                <input id="LIFEAPAN" name="useful_life_span" onkeyup="DecpriciableCost(),ComputeCUrrentVlue()" min="1" type="number" class="form-control" required>
                                </td>
                                <td style="vertical-align: middle;color:#083240;" >
                                <input type="text"  id="deptioncostformatted" class="form-control" value="0.00" readonly>
                                <input id="DEPCOST" style="display:none;" name="depreciation_cost"  type="number" class="form-control" readonly>
                                </td>
                                <td style="vertical-align: middle;color:#083240;" >
                                <input type="text" id="CurvalFormatted" class="form-control" value="0.00" readonly>
                                <input id="CURVAL" style="display:none;" value="0" type="number" name="current_value" class="form-control" readonly>
                                </td>
                                
                            </tr>
                            <tr>
                                <td colspan="10" style="padding:5px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table borderless table-sm" style="background-color:white;margin-bottom:0px;margin-top:20px;display:none;">
                                            
                        <thead style="background-color:#124f62; color:white;">
                            <tr>
                                <th colspan="3">Data Entry</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="15%" style="vertical-align: middle;text-align:right;color:#083240;" >Data Entry By</td>
                                <td  style="vertical-align: middle;" width="18%">
                                    <select class="form-control" name="dataentry" >
                                        <option value="{{$user_position->id}}">{{$user_position->name}}</option>
                                    </select>
                                </td>
                                <td width="60%"></td>
                            </tr>
                            <tr>
                                <td colspan="10" style="padding:5px;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="NewAssetAttachmentTab" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table " style="margin-bottom:0px;">
                                    
                        <thead >
                            <tr>
                                <th colspan="1"><label for="file-upload-new-asset" class="custom-file-upload">
                                    <i class="fa fa-cloud-upload"></i> Select File
                                </label>
                                <input id="file-upload-new-asset" type="file" onchange="getMultiple()"  name="asset_attachment[]" multiple></th>
                                <th id="FileNameTH"></th>
                                <style>
                                #file-upload-new-asset{
                                    display: none;
                                }
                                </style>
                                <script>
                                    function getMultiple(){
                                        
                                        var files = $('#file-upload-new-asset').prop("files");
                                        var names = $.map(files, function(val) { return val.name; });
                                        var count=names.length;
                                            console.log(names);
                                            
                                        // $.ajax({
                                        // type: 'POST',
                                        // url: ' setfiles.php',                
                                        // data: {names:names},
                                        // success: function(data) {
                                            
                                        // 	$( "#filesbody" ).replaceWith( data );
                                        // } 											 
                                        // })
                                    }
                                </script>
                            </tr>
                            
                        </thead>
                        <tbody id="filesbody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row" style="padding-top:10px;text-align:right;background-color:#b9c3cc;">
                <div class="col-md-12">
                <input type="submit" name="SubmitAsset" class="btn btn-primary" id="SaveAssetBtn" value="Save">
                <input type="Reset" class="btn btn-primary" value="Cancel">
                </div>
            </div>
            </div>
            </form>
        
        <div class="tab-pane fade {{($page=='3'? 'active show' : '' )}}" id="AssetInfoTab" role="tabpanel" aria-labelledby="home-tab" style="background-color:transparent !important;">
            <ul class="nav nav-tabs nav-tab-custom"  role="tablist" style="background-color:white !important;">
                
                <li class="nav-item" >
                    <a class="nav-link active" id="GeneralInfoTab-tab" data-toggle="tab" href="#ViewAssetGeneralInfoTab" role="tab" aria-controls="home" aria-selected="true">General</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" id="Attachment-tab" data-toggle="tab" href="#ViewAssetAttachmentInfoTab" role="tab" aria-controls="profile" aria-selected="false">Attachment</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" id="Attachment-tab" data-toggle="tab" href="#ViewAssetAssetLogInfoTab" role="tab" aria-controls="profile" aria-selected="false">Asset Log</a>
                </li>
            </ul>
            <script>
            $(document).ready(function(){
                
                $("#edit_asset_information_form").submit(function(e) {
                e.preventDefault();
                    $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'update_asset_information',                
                    data: $('#edit_asset_information_form').serialize(),
                    success: function(data) {
                        console.log(data);
                        Swal.fire({
                        type: 'success',
                        title: 'Success',
                        text: 'Successfully Updated Asset Information',
                        
                        }).then((result) => {
                            location.href="asset?page=3";
                        })
                    }  
                    }) 
                });
            })
            </script>
            
            <div class="tab-content" id="ViewAssetTabTabs">
                
                <div class="tab-pane fade show active" id="ViewAssetGeneralInfoTab" role="tabpanel" aria-labelledby="home-tab" style="background-color:transparent !important;">
                    <div class="row" style="margin-bottom:10px;margin-top:10px;">
						<div class="col-md-12" style="text-align:right;">
							
							<form class="form-inline" action="asset" method="get" style="float:right;">
							  <div class="form-group">
                                  <input type="hidden" name="page" value="3">
                                <select  class="form-control selectpicker" data-live-search="true" id="SeachBoxAsset" name="AssetTagID">
                                <option value="">--Select Asset--</option>
                                @foreach ($asset_list as $list)
                                <option value="{{$list->id}}" {{$AssetTagID==$list->id? 'selected' : ''}}>{{$list->asset_tag}}</option>
                                @endforeach
                                </select>
								
							  </div>
							  
							  <input type="submit" style="margin-left:10px;" class="btn btn-primary" name="SubmitViewAsset" value="View">
							</form>
						</div>
                    </div>
                    <form id="edit_asset_information_form">
                    <input type="hidden" value="<?php echo $ViewAssetTag; ?>" name="AssetTagID" id="new_asset_tag">
                    <input type="hidden" value="<?php echo $asset_id; ?>" name="AssetID" id="asset_original_tag">
                    {{-- view/edit asset information --}}
                    <table class="table borderless table-sm" style="background-color:white;">
                            <style>
                            #file-upload{
                                display: none;
                            }
                            #image-upload,#image-upload2,#image-upload3{
                                display: none;
                            }
                            .custom-file-upload {
                                opacity:0.7;
                                background-color:white;
                                border: 1px solid #ccc;
                                display: inline-block;
                                padding: 6px 12px;
                                cursor: pointer;
                            }
                            .table.borderless td,table.borderless th{
                                 border: none !important;
                                
                            }
                            .hide-bullets {
                            list-style:none;
                            
                            margin-top:20px;
                            }
                            </style>
                        <thead style="background-color:#124f62; color:white;">
                            <tr>
                                <th colspan="3" style="vertical-align:middle;">ASSET INFORMATION</th>
                                <th colspan="3" style="text-align:right;vertical-align:middle;padding-top:10px;padding-bottom:10px;"><a onclick="EnableEditInfo()" style="display:none;" title="Edit '<?php echo $ViewAssetTag; ?>'" id="EnableEdit" class="btn btn-success"><span class="fa fa-pencil"></span></a></th>
                                <script>
                                    $Edit=0;
                                    function EnableEditInfo(){
                                        if($Edit==0){
                                            document.getElementById('FileINPUTSKIN').style.display="inline-block";
                                            leaveprompt=1;
                                            Editleave=1;
                                            document.getElementById('SaveBtnEditAsset').style.display="inline";
                                            
                                            document.getElementById('Descrrrr22').disabled=false;
                                            document.getElementById('CatName2').disabled=false;
                                            document.getElementById('SubCatName2').disabled=false;
                                            document.getElementById('ManufacturerID').readOnly=false;
                                            document.getElementById('Addiage').disabled=false;
                                            document.getElementById('salvagevalueID3').readOnly=false;
                                            document.getElementById('BrandID').readOnly=false;
                                            document.getElementById('ModelID').readOnly=false;
                                            document.getElementById('SerialID').readOnly=false;
                                            document.getElementById('AssignToView').readOnly=false;
                                            
                                            document.getElementById('SKUCODE332').readOnly=false;
                                            document.getElementById('ConID').readOnly=false;
                                            if(document.getElementById('UOMASS')){
                                                document.getElementById('UOMASS').readOnly=false;
                                                document.getElementById('AmountID').readOnly=false;
                                            }
                                            document.getElementById('Addiage').style.display='inline';
                                            document.getElementById('Addiage2').style.display='none';
                                            
                                            document.getElementById('LocationID').readOnly=false;
                                            document.getElementById('DeptCode').disabled=false;
                                            document.getElementById('invoiceNumber').readOnly=false;
                                            document.getElementById('purchaseOrder').readOnly=false;
                                            document.getElementById('Vendor_name').readOnly=false;
                                            document.getElementById('DepreciationDATE2').readOnly=false;
                                            document.getElementById('purchaseDate').readOnly=false;
                                            document.getElementById('PurchaseCostID').readOnly=false;
                                            document.getElementById('salvagevalueID').readOnly=false;
                                            document.getElementById('FrequencyIDDD').disabled=false;
                                            document.getElementById('MockupInput2').readOnly=false;
                                            document.getElementById('UsefulLifeSpanID').readOnly=false;
                                            document.getElementById('SiteID').readOnly=false;
                                            $Edit=1;
                                            setSerial2();
                                        }
                                        else if($Edit==1){
                                            document.getElementById('FileINPUTSKIN').style.display="none";
                                            leaveprompt=0;
                                            Editleave=0;
                                            document.getElementById('SaveBtnEditAsset').style.display="none";
                                            
                                            document.getElementById('Addiage').disabled=true;
                                            document.getElementById('Descrrrr22').disabled=true;
                                            document.getElementById('CatName2').disabled=true;
                                            document.getElementById('SubCatName2').disabled=true;
                                            document.getElementById('ManufacturerID').readOnly=true;
                                            document.getElementById('AssignToView').readOnly=true;
                                            document.getElementById('BrandID').readOnly=true;
                                            document.getElementById('salvagevalueID3').readOnly=true;
                                            document.getElementById('DepreciationDATE2').readOnly=true;
                                            document.getElementById('ModelID').readOnly=true;
                                            document.getElementById('Addiage2').style.display='inline';
                                            document.getElementById('Addiage').style.display='none';
                                            document.getElementById('SerialID').readOnly=true;
                                            document.getElementById('SKUCODE332').readOnly=true;
                                            document.getElementById('MockupInput2').readOnly=true;
                                            document.getElementById('ConID').readOnly=true;
                                            if(document.getElementById('UOMASS')){
                                                document.getElementById('UOMASS').readOnly=true;
                                                document.getElementById('AmountID').readOnly=true;
                                            }
                                            
                                            document.getElementById('LocationID').readOnly=true;
                                            document.getElementById('DeptCode').disabled=true;
                                            document.getElementById('invoiceNumber').readOnly=true;
                                            document.getElementById('purchaseOrder').readOnly=true;
                                            document.getElementById('Vendor_name').readOnly=true;
                                            document.getElementById('DepreciationDATE2').readOnly=true;
                                            document.getElementById('purchaseDate').readOnly=true;
                                            document.getElementById('PurchaseCostID').readOnly=true;
                                            document.getElementById('salvagevalueID').readOnly=true;
                                            document.getElementById('MockupInput2').readOnly=true;
                                            document.getElementById('FrequencyIDDD').disabled=true;
                                            document.getElementById('UsefulLifeSpanID').readOnly=true;
                                            document.getElementById('SiteID').readOnly=true;
                                            $Edit=0;
                                            setSerial2();
                                        }
                                    }
                                </script>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
								<td width="15%" style="vertical-align: middle;text-align:right;color:#083240;"></td>
								<td width="23%" style="vertical-align: middle;"></td>
								
								<?php
                                $ViewAssetSub1="";
                                $ViewAssetSerialNumber1="";
                                $sku_code1="";
								$splitted=explode('-',$ViewAssetTag);
								if(count($splitted)==5){
									$sp=$splitted[0]."-".$splitted[1]."-".$splitted[2]."-";
									$sp2=$splitted[3]."-".$splitted[4];
								}
								if(count($splitted)==4){
									$sp=$splitted[0]."-".$splitted[1]."-";
									$sp2=$splitted[2]."-".$splitted[3];
								}
								if($ViewAssetSub!=""){
									//$ViewAssetSub1="SC - ".$ViewAssetSub."%0A";
									$ViewAssetSub1="";
									
								}
								if($ViewAssetSerialNumber!=""){
									$ViewAssetSerialNumber1="SN-".$ViewAssetSerialNumber."%0A";
									
								}
								if($sku_code!=""){
									$sku_code1="PN-".$sku_code."%0A";
									
								}
								$sp="";
                                $CategoryNameFull="";
                                $sp2="";
								//$qrdata="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=".$ViewAssetTag."%0A"."Asset Description - ".$ViewAssetDesc."%0A"."Category - ".$CategoryNameFull."%0A".$ViewAssetSub1."%0A".$ViewAssetSerialNumber1."%0A".$sku_code1."%0A";
								$qrdata="https://api.qrserver.com/v1/create-qr-code/?data=".$ViewAssetTag."%0A"."AD-".$ViewAssetDesc."%0A"."Cat-".$CategoryNameFull."%0A".$ViewAssetSub1."".$ViewAssetSerialNumber1."".$sku_code1."&amp;size=150x150";
								?>
								<td width="20%" style="vertical-align: middle;text-align:center;" rowspan="11" id="QRCODEDIV">
								<div style="padding-right:10px;padding-top:20px;padding-left:10px;text-align:center;margin-top:0px;">
								<img src="images/KKCCSC.png" style="width:40%;margin-right:5px;display:none" id="logoprint"><img id="QRImage" src="<?php echo $qrdata; ?>" title="<?php echo $ViewAssetTag; ?>" style="width:70%;">
								<b id="AssetDDSS"><br><span id="EditViewAssetTagLabel"><?php echo $ViewAssetTag; ?></span></b>
								<b id="AssetChar" style="display:none;"><br><span><?php echo $sp; ?></span></b>
								<b id="AssetNum" style="display:none"><br><span ><?php echo $sp2; ?></span></b>
								<br><br><button class="btn btn-primary" style="display:none;" id="PrintButtonViewAsset" onclick="printDiv('QRCODEDIV')"><span class="glyphicon glyphicon-print"></span> Print QR</button>
								</div>
								</td>
								<td  style="vertical-align: middle;" rowspan="11">
								
								<script>
									function CHangePic(id){
										console.log(id);
										$("#myCarousel2").carousel(id);
										
									}
								</script>
								<div class="col-md-12" style="display:none;">
									<label style="position:absolute; bottom: 0px;left: 0px;display:none" for="image-upload" class="custom-file-upload">
												<i class="	glyphicon glyphicon-camera"></i> Select Photo
											</label>
									<input id="image-upload"  type="file" onchange="readURL(this);" name="AssetPhoto" accept="image/*" >
									<label style="position:absolute; bottom: 0px;left: 0px;display:none" for="image-upload2" class="custom-file-upload">
												<i class="	glyphicon glyphicon-camera"></i> Select Photo
											</label>
									<input id="image-upload2" type="file" onchange="readURL2(this);" name="AssetPhoto2" accept="image/*">
									<label style="position:absolute; bottom: 0px;left: 0px;display:none" for="image-upload3" class="custom-file-upload">
												<i class="	glyphicon glyphicon-camera"></i> Select Photo
											</label>
									<input id="image-upload3" type="file" onchange="readURL3(this);" name="AssetPhoto3" accept="image/*">
									<div class="carousel " id="myCarousel2">
										<!-- Carousel items -->
										<div class="carousel-inner" >
											
											<div data-slide-number="1" style="position:relative;text-align:center;">
											
                                            <img id="blah" src="{{asset('images/Asset_Photo/noimage.png')}}" style="max-height:250px;margin:0 auto">
											
											</div>
											
										</div><!-- Carousel nav -->
																	  
									</div>
								</div>
								<div class="col-md-12" style="text-align:center;display:none;">
									<style>
										#oooo>li{
											display:inline;
										}
									</style>
									<ul id="oooo" class="hide-bullets dragscroll" style="height:20vh;overflow: hidden;cursor: grab;">
										
										<li id="LI1">
										
											<a  title="Double Click To Delete." class="thumbnail" style="display:inline-block;cursor:pointer;width:20%;max-height:80px;margin-bottom:0px;height:80px;" onclick="CHangePic(1)" id="carousel-selector-0">
											<img id="photo1thumbnail" style="max-height:75px;"  src="{{asset('images/Asset_Photo/noimage.png')}}"></a>
										</li>
										
									</ul>
									<a  onclick="addimage('<?php echo $asset_id; ?>')" style="display:none" id="Addiage" class="btn btn-primary" style="color:white !important;">Add Image</a>
									<a disabled href="#"  style="display:none" id="Addiage2" class="btn btn-primary" style="color:white !important;">Add Image</a>
									
								</div>
								<script>
									function DeleteImage(folder,filename,count){
										
										var txt;
										var r = confirm("Are you sure you want to delete the image? \n\nClick 'OK' if Yes. Click 'Cancel' if No");
										if (r == true) {
											// $.ajax({
											// 	type: 'POST',
											// 	url: 'DeleteImage.php',                
											// 	data: {folder:folder,filename:filename},
											// success: function(data) {
											// 	alert(data);
											// 	document.getElementById(count+'LI').style.display="none";
												
											// } 											 
											// })
										}
										
										
										
									}
								</script>
								</td>
								
							</tr>
							<tr>
								<td style="vertical-align: middle;text-align:right;color:#083240;display:none">Asset Type</td>
								<td style="vertical-align: middle;display:none">
								<select class="form-control"  onchange="getQR()" onkeypress="return alphaOnly(event)" name="AssetType" id="TYTPE2"  title="Characters(A-Z) Only" disabled>
								<option value="Current Asset">Current Asset</option>
								<option value="Non-Current Asset">Non-Current Asset</option>
								</select>
								<?php echo "<script>document.getElementById('TYTPE2').value='".$ViewAssetType."'</script>"; ?>
								</td>
								<td></td>
							</tr>
							<tr>
								<td style="vertical-align: middle;text-align:right;color:#083240;">Asset</td>
								<td style="vertical-align: middle;">
								<script>
                                var cat_initial='{{$ViewAssetCategoryName}}';
                                var sub_initial='{{$ViewAssetSub}}';
                                $(document).ready(function(){
                                    if('{{$AssetTagID}}'!=''){
                                        $('#Descrrrr22').trigger('change');
                                    }
                                    
                                });
								function SetQRTitle22222(tag){
									var Desc=document.getElementById('Descrrrr22').value;
                                    document.getElementById('HiddenDescAss22222').value=$('#Descrrrr22').find(':selected').text();
                                    
									$.ajax({
                                    type: 'POST',
                                    url: 'getCategoryNewAsset',  
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },              
                                    data: {value:Desc,_token: '{{csrf_token()}}'},
                                    success: function(data) {
                                        var element="";
                                        if(cat_initial==""){
                                            element=element+'<select id="CatName2"  class="form-control" onchange="SetSub222222(\'<?php echo $ViewAssetTag; ?>\'),SetAssetTag22222()" name="CategoryName" ><option></option>';
                                        }else{
                                            element=element+'<select id="CatName2"  class="form-control" onchange="SetSub222222(\'<?php echo $ViewAssetTag; ?>\'),SetAssetTag22222()" name="CategoryName" disabled><option></option>';
                                        }
                                        
                                            element=element+data;
                                            element=element+'</select>';
                                        $( "#CatName2" ).replaceWith( element );
                                        document.getElementById('CatName2').value=cat_initial;
                                        cat_initial="";
										SetSub222222(tag);
                                    }  
                                    });
									
								}
								</script>
                                <select  class="form-control" onchange="SetQRTitle22222('<?php echo $ViewAssetTag; ?>')"  id="Descrrrr22" name="AssetDescription" disabled>
                                    <option value=""></option>
                                    @foreach ($asset_description_grouped as $data)
                                        <option value="{{$data->asset_setup_ad}}" {{$data->asset_setup_ad==$ViewAssetDesc? 'selected' : ''}}>{{$data->asset_setup_description}}</option>
                                    @endforeach
								</select>
								<input type="hidden" id="HiddenDescAss22222" name="HiddenDescAss22222" value="<?php echo $ViewAssetDesc; ?>">
								<td></td>
							</tr>
							<tr>
								<td style="vertical-align: middle;text-align:right;color:#083240;">Category</td>
								<td style="vertical-align: middle;">
								<script>
								function SetSub222222(tag){
									
									var Sub=document.getElementById('CatName2').value;
                                    var Desc=document.getElementById('Descrrrr22').value;
                                    $.ajax({
                                    type: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: 'GetSubNewAsset',                
                                    data: {value:Desc,value2:Sub,_token: '{{csrf_token()}}'},
                                    success: function(data) {
                                        var element='';
                                        if(sub_initial==""){
                                            element=element+'<select  id="SubCatName2"  class="form-control" onchange="SetAssetTag22222()" name="SubCategory" ><option></option>';
                                        }else{
                                            element=element+'<select  id="SubCatName2"  class="form-control" onchange="SetAssetTag22222()" name="SubCategory" disabled><option></option>';
                                        }
                                        
                                            element=element+data;
                                            element=element+'</select>';
                                        $( "#SubCatName2" ).replaceWith( element );
                                        document.getElementById('SubCatName2').value=sub_initial;
                                        sub_initial="";
										SetAssetTag22222();
                                    }  
                                    });
									
									
								}
								function SetAssetTag22222(){
									//document.getElementById('AssetTaggg').value=document.getElementById('asssss').value;
									var str=document.getElementById('new_asset_tag').value;
									var res =str.split("-");
									var digitcount="";
									if(res.length==5){
										digitcount=res[3]+"-"+res[4];
									}
									if(res.length==4){
										digitcount=res[2]+"-"+res[3];
									}
									if(res.length==3){
										digitcount=res[1]+"-"+res[2];
										
									}
									var Desc=document.getElementById('Descrrrr22').value;
									var Cat=document.getElementById('CatName2').value;
									var Sub=document.getElementById('SubCatName2').value;
									document.getElementById('HiddenDescAss22222').value=$('#Descrrrr22').find(':selected').text();
									//document.getElementById('HiddenDescAss').value=$('#Descrrrr22').find(':selected').text();
									if(Sub!=""){
										Sub=Sub+"-";
									}
									console.log(Desc+"-"+Cat+"-"+Sub+digitcount);
									document.getElementById('EditViewAssetTagLabel').innerHTML=Desc+"-"+Cat+"-"+Sub+digitcount;
									document.getElementById('new_asset_tag').value=Desc+"-"+Cat+"-"+Sub+digitcount;
									getQR222();

								
								}
								function getQR222(){
									var tag=document.getElementById('EditViewAssetTagLabel').innerHTML;
									var Cat=$('#CatName2').find(':selected').text();
									var Sub=$('#SubCatName2').find(':selected').text();
									var Descrrrr=$('#Descrrrr22').find(':selected').text();
									if(SerialCode!=""){
										SerialCode="SN-"+SerialCode;
									}
									if(SKUCODE!=""){
										SKUCODE="PN-"+SKUCODE;
									}
									if(Cat!=""){
										Cat="Cat-"+Cat;
									}
									if(Sub!=""){
										Sub="SC-"+Sub;
									}
									var url="https://api.qrserver.com/v1/create-qr-code/?data="
									+tag+"%0AAsset Description - "+Descrrrr
									+"%0A"+Cat
									+"%0A"+Sub
									+"%0A"+SerialCode
									+"%0A"+SKUCODE+"&amp;size=150x150";
									
									$("#QRImage").attr("src", url);
									$("#QRImage").attr("title", tag);
									
								}
								</script>
								<select   id="CatName2"  class="form-control" onchange="SetSub222222('<?php echo $ViewAssetTag; ?>'),SetAssetTag22222()" name="CategoryName" disabled>
								
								</select>
								</td>
								<td ></td>
								
							</tr>
							<tr>
								<td style="vertical-align: middle;text-align:right;color:#083240;">Sub Category</td>
								<td style="vertical-align: middle;">
								<select  id="SubCatName2"  class="form-control" onchange="SetAssetTag22222()" name="SubCategory" disabled>
								
								</select>
								<?php echo "<script>document.getElementById('SubCatName2').value='$ViewAssetSub';console.log('$ViewAssetSub');</script>"; ?>
								</td>
							</tr>
							<tr>
								<td style="vertical-align: middle;text-align:right;color:#083240;">Manufacturer</td>
								<td style="vertical-align: middle;"><input type="text" id="ManufacturerID" class="form-control"value="<?php echo $ViewAssetManufacturer; ?>" name="Manufacturer"readonly></td>
								<td></td>
							</tr>
							<tr>
								<td style="vertical-align: middle;text-align:right;color:#083240;">Brand *</td>
								<td style="vertical-align: middle;"><input type="text" id="BrandID" class="form-control"value="<?php echo $ViewAssetbrand; ?>" name="Brand"readonly></td>
								<td></td>
							</tr>
							<tr>
								<td style="vertical-align: middle;text-align:right;color:#083240;">Model</td>
								<td style="vertical-align: middle;"><input type="text" id="ModelID" class="form-control" value="<?php echo $ViewAssetModel; ?>" name="Model"readonly></td>
								<td></td>
							</tr>
							<tr id="Serial2">
								<script>
								function SetUOMAmount2(){
									var TypeValue=document.getElementById('TYTPE2').value;
									if(TypeValue=="Current Asset"){
										document.getElementById('Serial2').style.display="none";
										document.getElementById('UOMAmount2TR').style.display="table-row";
										document.getElementById('UOM2TR').style.display="table-row";
									}else{
										document.getElementById('Serial2').style.display="table-row";
										document.getElementById('UOMAmount2TR').style.display="none";
										document.getElementById('UOM2TR').style.display="none";
									}
								}
								</script>
								<?php 
									
									$Seri="";
									$Plate="";
									//echo "<script>alert('".$Seri." ".$Plate."');</script>";
								
								?>
								<td style="vertical-align: middle;text-align:right;color:#083240;" id="SerialNumber2222">Serial Number <?php echo $Seri=='1'? '*' : ''; ?></td>
								<td style="vertical-align: middle;"><input type="text" autocomplete="off" title="Serial Number Duplicate" data-content="Serial Number already exist.." onkeyup="CheckSerialEdit()" id="SerialID" class="form-control" value="<?php echo $ViewAssetSerialNumber; ?>" name="SerialNumber"readonly <?php echo $Seri=='1'? 'Required' : ''; ?>>
								<div id="CheckSerialDivReplaace"></div>
								</td>
								<td></td>
							</tr>
							<script>
									var SER=0;
									var PLA=0;
									var INVO=0;
									function CheckSerialEdit(){
										if($(document.getElementById('SerialID')).prop('required')){
											var serial=document.getElementById('SerialID').value;
											if(document.getElementById('SerialID').value=="<?php echo $ViewAssetSerialNumber; ?>" || document.getElementById('SerialID').value=="N/A"|| document.getElementById('SerialID').value==""){
												$('#SerialID').popover('hide');
												document.getElementById('SaveBtnEditAsset').disabled=false;
												document.getElementById("SerialID").style.borderColor = "#d8d8d8";
											}
											else{
                                                $.ajax({
                                                type: 'POST',
                                                url: 'checkserialunique',  
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },              
                                                data: {serial:serial,_token: '{{csrf_token()}}'},
                                                success: function(data) {
                                                    if(data==0){
														SER=0;
														
														if(INVO==0 && PLA==0 && SER==0){
															document.getElementById('SaveBtnEditAsset').disabled=false;
														}
														document.getElementById("SerialID").style.borderColor = "#d8d8d8";
													}else{
														SER=1;
														
														document.getElementById('SaveBtnEditAsset').disabled=true;
														document.getElementById("SerialID").style.borderColor = "#ed5a5a";
														
													}
                                                }  
                                                });
												
											}
										}
									}
									
								</script>
							<tr>
								<td style="vertical-align: middle;text-align:right;color:#083240;" id="Platelettes">Plate Number <?php echo $Plate=='1'? '*' : ''; ?></td>
								<td style="vertical-align: middle;"><input title="Plate Number already exist" data-content="Plate Number already exist.." type="text" class="form-control" readonly value="<?php echo $sku_code; ?>"  id="SKUCODE332"  onkeyup="CheckPlateEdit()" title="Characters(A-Z) Only" name="AssetSKU" <?php echo $Plate=='1'? 'Required' : ''; ?>>
									<div id="PlateEditDivEdit"></div>
								</td>
								<script>
									function CheckPlateEdit(){
										if($(document.getElementById('SKUCODE332')).prop('required')){
											if(document.getElementById('SKUCODE332').value=="<?php echo $sku_code; ?>"){
												$('#SKUCODE332').popover('hide');
												document.getElementById('SaveBtnEditAsset').disabled=false;
												document.getElementById("SKUCODE332").style.borderColor = "#d8d8d8";
												
											}
											else{
                                                var serial=document.getElementById('SKUCODE332').value;
                                                
                                                $.ajax({
                                                type: 'POST',
                                                url: 'checkplateunique',     
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },           
                                                data: {serial:serial,_token: '{{csrf_token()}}'},
                                                success: function(data) {
                                                    if(data==0){
														PLA=0;
														//$('#SKUCODE332').popover('hide');
														if(INVO==0 && PLA==0 && SER==0){
																document.getElementById('SaveBtnEditAsset').disabled=false;
															}
														document.getElementById("SKUCODE332").style.borderColor = "#d8d8d8";
													}else{
														PLA=1;
														//$( "#ssscrrPlate" ).replaceWith( data );
														document.getElementById('SaveBtnEditAsset').disabled=true;
														document.getElementById("SKUCODE332").style.borderColor = "#ed5a5a";
														//$('#SKUCODE332').popover('show');
													}
                                                }  
                                                });
												
											}
										}
									}
								</script>
								<td></td>
								<td style="vertical-align: middle;text-align:center;color:#083240;"></td>
							</tr>
							
							
							
							<tr>
								<td style="vertical-align: middle;text-align:right;color:#083240;">Condition</td>
								<td style="vertical-align: middle;"><input type="text"  class="form-control" id="ConID" value="<?php echo $ViewAssetCondition; ?>" name="AssetCondition" readonly></td>
								<td></td>
								<td></td>
								<script>
									function addimage(e){
										var w='800';
										var h='600';
										var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
										var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

										var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
										var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

										var left = ((width / 2) - (w / 2)) + dualScreenLeft;
										var top = ((height / 2) - (h / 2)) + dualScreenTop;
										var newWindow=window.open('extra/upload.php', '', 'width='+w+',height='+h+',left='+left+',top='+top+'');
											newWindow.my_special_setting =e;
											newWindow.OldTag = e;
									}
								</script>
								<?php 
									if($AssetTagID!=""){
										if($depreciation_date!=""){
										echo "<script>document.getElementById('PrintButtonViewAsset').style.display='inline';</script>";
										}
										echo "<script>document.getElementById('EnableEdit').style.display='inline';</script>";
										echo "<script>document.getElementById('Addiage2').style.display='inline';</script>";
										echo "<script>document.getElementById('Addiage').style.display='none';</script>";
										
									}
								?>
							</tr>
							<?php
							
							$consumable="";
							if($consumable=='1'){
							?>	
							<tr id="UOM2TR">
								<td style="vertical-align: middle;text-align:right;color:#083240;">Unit Of Measurement</td>
								<td style="vertical-align: middle;">
								<select name="AssetUOM" id="UOMASS" class="form-control" >
									<option value="<?php echo $AssetUOM; ?>"><?php echo $AssetUOM; ?></option>
								</select>
									
								</td>
							
							</tr>
							<tr id="UOMAmount2TR">
								<td style="vertical-align: middle;text-align:right;color:#083240;">UOM Amount</td>
								<td style="vertical-align: middle;"><input type="number" readonly id="AmountID" class="form-control" name="AssetUOMAmount" value="<?php echo $AssetUOMAmount; ?>"></td>
							</tr>
							<?php
							}
							?>
							<tr>
								<td colspan="10" style="padding:5px;"></td>
							</tr>
                        </tbody>
                    </table>
                    <table class="table borderless table-sm" style="background-color:white; ">					
                        <thead style="background-color:#124f62; color:white;">
                            <tr>
                                <th colspan="2">Asset Location</th>
                                <th colspan="3" style="text-align:center;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;">Location</td>
                                <td style="vertical-align: middle;"><input  type="text" id="LocationID" class="form-control" value="<?php echo $ViewAssetLocation; ?>" name="AssetLocation"readonly></td>
                                
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;" width="15%">Site</td>
                                <td style="vertical-align: middle;" width="23%;"><textarea id="SiteID" class="form-control" name="AssetSite"readonly><?php echo $ViewAssetSite; ?></textarea></td>
                                <td style="vertical-align: middle;text-align:right;color:#083240;" width="10%"></td>
                                <td style="vertical-align: middle;color:#083240;" width="20%;">
                                    <input type="text" name="StorageAsset" class="form-control" value="<?php echo $StorageAsset; ?>" readonly style="display:none">
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;">Department</td>
                                <td style="vertical-align: middle;">
                                <select class="form-control"  name="DepartmentCode" id="DeptCode" disabled>
                                    <option value=""></option>
                                    
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right;color:#083240;" >Assign To</td>
                                <td style="vertical-align: middle;" ><input id="AssignToView" class="form-control" value="<?php echo $ViewAssignTo; ?>" name="assigntoview" readonly></td>
                                <td style="vertical-align: middle;text-align:right;color:#083240;"  ></td>
                                <td style="vertical-align: middle;color:#083240;" >
                                    
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="10" style="padding:5px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table borderless" style="background-color:white;">
										
                        <thead style="background-color:#124f62; color:white;">
                            <tr>
                                <th colspan="3">Purchase Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align: middle;text-align:right; color:#083240;" >Vendor Name *</td>
                                <td style="vertical-align: middle;" >
                                    <input type="text" name="vendor_name" class="form-control" id="Vendor_name" value="<?php echo $ViewAssetVendorNumber; ?>" placeholder="Choose Vendor..."readonly required>
                                </td>
                                <td></td>
                                
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right; color:#083240;" width="15%">Purchase Order </td>
                                <td style="vertical-align: middle;" width="22%;">
                                    <input type="text" class="form-control" name="purchase_Order" id="purchaseOrder" value="<?php echo $ViewAssetPurchaseOrder; ?>" placeholder="Purchase Order..."readonly>
                                </td>
                                <td width="60%"></td>
                                
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right; color:#083240;" >Invoice Number *</td>
                                <td style="vertical-align: middle;" >
                                    <input type="text" class="form-control"  id="invoiceNumber"  name="invoice_number2" value="<?php echo $invoice_number;?>" readonly required>
                                    <div id="INVOICENUMBEREdit"></div>
                                    <script>
                                        function GetInvoiceEdit(){
                                            if($(document.getElementById('invoiceNumber')).prop('required')){
                                                if(document.getElementById('invoiceNumber').value=="<?php echo $invoice_number; ?>"){
                                                    
                                                    
                                                }
                                                else{
                                                    var serial=document.getElementById('invoiceNumber').value;
                                                    
                                                    $.ajax({
                                                    type: 'POST',
                                                    url: 'checkinvoicenumbernewasset',   
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                    },             
                                                    data: {serial:serial,_token: '{{csrf_token()}}'},
                                                    success: function(data) {
                                                            
                                                            if(data==0){
                                                                INVO=0;
                                                                
                                                                //$('#invoiceNumber').popover('hide');
                                                                if(INVO==0 && PLA==0 && SER==0){
                                                                    document.getElementById('SaveBtnEditAsset').disabled=false;
                                                                }
                                                                document.getElementById("invoiceNumber").style.borderColor = "#d8d8d8";
                                                            }else{
                                                                INVO=1;
                                                                //$( "#ssscrrInvoice" ).replaceWith( data );
                                                                document.getElementById('SaveBtnEditAsset').disabled=true;
                                                                document.getElementById("invoiceNumber").style.borderColor = "#ed5a5a";
                                                                //$('#invoiceNumber').popover('show');
                                                            }
                                                    }  
                                                    });
                                                    
                                                }
                                            }
                                            
                                        }
                                    </script>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right; color:#083240;" >Purchase Date *</td>
                                <td style="vertical-align: middle;" >
                                    <input type="date" name="purchaseDate222" class="form-control" onchange="setStartDateMin2()" id="purchaseDate" value="<?php echo $ViewAssetPurchaseDate; ?>" readonly required>
                                </td>
                                <td ></td>
                                <script>
                                function setStartDateMin2(){
                                    var puchaseDate=document.getElementById('purchaseDate').value;
                                    
                                    document.getElementById("DepreciationDATE2").min = puchaseDate;
                                    var d1 = new Date(puchaseDate);
                                    var d2 = new Date(document.getElementById("DepreciationDATE2").value );
                                    if(document.getElementById("DepreciationDATE2").value!=""){
                                        console.log(d1>d2);
                                        if(d1>d2){
                                            document.getElementById("DepreciationDATE2").value = puchaseDate;
                                            
                                        }
                                        
                                    }
                                    
                                    ComputeCUrrentVlue2();
                                }
                            </script>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right; color:#083240;" >Purchase Cost *</td>
                                <td style="vertical-align: middle;">
                                    <input type="text" class="form-control number" id="MockupInput2" placeholder="Cost..." value="<?php echo $ViewAssetPurchaseCost!=""? number_format($ViewAssetPurchaseCost,2) : ''; ?>" required onkeyup='SetComma2(),SetInitial2(),DecpriciableCost2()' readonly>
                                    <input name="Purchase_Cost222" type="hidden" step="0.1" class="form-control" onkeyup='SetComma2(),SetInitial2(),DecpriciableCost2()' placeholder="Cost..." id="PurchaseCostID" value="<?php echo $ViewAssetPurchaseCost; ?>" readonly required>
                                </td>
                                <td ></td>
                                <script type="text/javascript">
                                $('input.number').keyup(function(event) {
                                    //alert('sss');
                                      // skip for arrow keys
                                      if(event.which >= 37 && event.which <= 40){
                                       event.preventDefault();
                                      }

                                      $(this).val(function(index, value) {
                                          value = value.replace(/,/g,''); // remove commas from existing input
                                          
                                          document.getElementById('PurchaseCostID').value=value;
                                          return numberWithCommas(value); // add commas back in
                                      });
                                    });
                                    function SetComma2(){
                                        var ddd=document.getElementById('MockupInput2').value;
                                        var res = ddd.replace(/,/g, "");
                                        document.getElementById('PurchaseCostID').value=res;
                                        SetInitial2();
                                    }
                                    $(document).ready(function()
                                    {
                                        $('.number').blur(function()
                                        {
                                            
                                            $('.number').formatCurrency();
                                            $('.number').formatCurrency({symbol: ''});
                                            var ddd=document.getElementById('MockupInput2').value;
                                            var res = ddd.replace(/,/g, "");
                                            document.getElementById('PurchaseCostID').value=res;
                                            SetComma2();
                                        });
                                    });
                                </script>
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;text-align:right; color:#083240;" >Start Date</td>
                                <td style="vertical-align: middle;" >
                                    <input type="date" class="form-control" name="depreciation_date2" onchange="ComputeCUrrentVlue2()" id="DepreciationDATE2" max="<?php echo date('2100-m-d') ?>" value="<?php echo $depreciation_date;?>"  readonly>
                                </td>
                                <td></td>
                                
                            </tr>
                            <tr>
                                <td colspan="10" style="padding:5px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <script>
                        setStartDateMin2();
                        function ComputeCUrrentVlue2(){
                            var initID=document.getElementById('initID').value;
                            var UsefulLifeSpanID=document.getElementById('UsefulLifeSpanID').value;
                            var depcostid=document.getElementById('depcostid').value;
                            var curcostid=document.getElementById('curcostid').value;
                            var FREQ=document.getElementById('FrequencyIDDD').value;
                            var PurchaseDATE=document.getElementById('DepreciationDATE2').value;
                            var Depreciablevalue=document.getElementById('depvalueid').value;
                            if(initID!="" && UsefulLifeSpanID!=""){
                                var depreciationCost=Depreciablevalue/UsefulLifeSpanID;
                                document.getElementById('depcostid').value=depreciationCost;
                                document.getElementById('deptioncost').value=document.getElementById('depcostid').value;
                                $('#deptioncost').formatCurrency();
                                $('#deptioncost').formatCurrency({symbol: ''});
                                
                            }
                            var date1 = new Date(PurchaseDATE);
                                var date2 = new Date();
                                console.log(date1 > date2);
                                var l=date1>=date2;
                                if(l==false){
                                var timeDiff = Math.abs(date2.getTime() - date1.getTime());
                                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
                                console.log(diffDays);
                                var divident=0;
                                if(FREQ=="Hourly"){
                                    if(diffDays>0){
                                        divident=diffDays*24;
                                    }
                                    
                                }
                                if(FREQ=="Monthly"){
                                    if(diffDays>30){
                                        divident=Math.floor(diffDays/30);
                                    }
                                }
                                if(FREQ=="Yearly"){
                                    if(diffDays>365){
                                        divident=Math.floor(diffDays/365);
                                    }
                                }
                                var CostValeu=depcostid*(divident);
                                var CurrentValue=Depreciablevalue-CostValeu;
                                console.log(depcostid+" "+divident+" %% "+Depreciablevalue+"-"+CostValeu+"="+CurrentValue);
                                if(CurrentValue<0){
                                    CurrentValue=0;
                                }
                                    document.getElementById('curcostid').value=CurrentValue;
                                }else{
                                    document.getElementById('curcostid').value=Depreciablevalue;
                                }
                                document.getElementById('curcostidform').value=document.getElementById('curcostid').value;
                                $('#curcostidform').formatCurrency();
                                $('#curcostidform').formatCurrency({symbol: ''});
                            
                        }
                        function SetInitial2(){
                            document.getElementById('initID').value=document.getElementById('PurchaseCostID').value;
                            document.getElementById('InitValueFormated').value=document.getElementById('initID').value;
                            $('#InitValueFormated').formatCurrency();
                            $('#InitValueFormated').formatCurrency({symbol: ''});
                            ComputeCUrrentVlue2();
                        }
                        function DecpriciableCost2(){
                            if(document.getElementById('initID').value!=0){
                                var salvage=document.getElementById('salvagevalueID').value;
                                var INITIALBALUE=document.getElementById('initID').value;
                                var dep=INITIALBALUE-salvage;
                                document.getElementById('depvalueid').value=dep;
                                document.getElementById('DepCost2123').value=document.getElementById('depvalueid').value;
                                $('#DepCost2123').formatCurrency();
                                $('#DepCost2123').formatCurrency({symbol: ''});
                            }
                            ComputeCUrrentVlue2();
                        }
                        function FormatSalvageCost(){
                        document.getElementById('salvagevalueID').value=document.getElementById('salvagevalueID3').value;	
                        FFF();
                        }
                        function FFF(){
                            $('#salvagevalueID3').formatCurrency();
                        $('#salvagevalueID3').formatCurrency({symbol: ''});
                        var value=document.getElementById('salvagevalueID3').value;
                              value = value.replace(/,/g,''); // remove commas from existing input
                              console.log("Slav "+value);
                              document.getElementById('salvagevalueID').value=value;
                        DecpriciableCost2();
                        }
                        function CDCDCDCDC2(event) {
                            console.log('salv onkeyup');
                          // skip for arrow keys
                          if(event.which >= 37 && event.which <= 40){
                           event.preventDefault();
                          }

                            var value=document.getElementById('salvagevalueID3').value;
                              value = value.replace(/,/g,''); // remove commas from existing input
                              console.log("Slav "+value);
                              document.getElementById('salvagevalueID').value=value;
                              document.getElementById('salvagevalueID3').value= numberWithCommas(value); // add commas back in
                            DecpriciableCost2();
                        }
                    </script>
                    <table class="table borderless table-sm" style="background-color:white;margin-bottom:0px;">
                                    
                        <thead style="background-color:#124f62; color:white;">
                            <tr>
                                <th colspan="7">Depeciation Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Initial Value</td>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Salvage Cost *</td>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Depreciable Cost</td>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Depreciation Frequency</td>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Useful Life Span *</td>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Depreciation Cost</td>
                                <td style="vertical-align: middle;color:#083240;" width="10%">Current Value</td>
                                
                            </tr>
                            <tr>
                                <td style="vertical-align: middle;color:#083240;" >
                                <input type="text" id="InitValueFormated" class="form-control" readonly value="<?php echo $ViewAssetInitialValue!=""? number_format($ViewAssetInitialValue,2) : ''; ?>">
                                <input name="INITVALLL" style="display:none;" id="initID"  type="number" value="<?php echo $ViewAssetInitialValue; ?>" class="form-control"readonly>
                                
                                </td>
                                <td style="vertical-align: middle;color:#083240;" >
                                <input id="salvagevalueID3" type="text" class="form-control" onkeyup="CDCDCDCDC2(event)" onblur="FormatSalvageCost()"  value="<?php echo $salvage_value!=""? number_format($salvage_value,2) : ''; ?>" readonly required>
                                <input name="SalvageCVAAS" id="salvagevalueID" style="display:none;" type="number" class="form-control" onkeyup="DecpriciableCost2()" min="0" value="<?php echo $salvage_value; ?>" readonly required>
                                </td>
                                <td style="vertical-align: middle;color:#083240;" >
                                <input id="DepCost2123" type="text" class="form-control" readonly value="<?php echo $depriciable_value!=""? number_format($depriciable_value,2) : ''; ?>">
                                <input name="DEPVal222" step="0.1" id="depvalueid" type="number" class="form-control" value="<?php echo $depriciable_value; ?>" readonly style="display:none;">
                                </td>
                                <td style="vertical-align: middle;color:#083240;">
                                    <select class="form-control" onchange="ComputeCUrrentVlue2()" name="Freq" id="FrequencyIDDD" disabled>
                                        <?php
                                        if($ViewAssetDepreciationFrequency=="Yearly"){
                                        ?>
                                        <option>Yearly</option>
                                        <option>Monthly</option>
                                        <option>Hourly</option>
                                        <?php
                                        }
                                        if($ViewAssetDepreciationFrequency=="Monthly"){
                                        ?>
                                        <option>Monthly</option>
                                        <option>Yearly</option>
                                        <option>Hourly</option>
                                        <?php	
                                        }
                                        if($ViewAssetDepreciationFrequency=="Hourly"){
                                        ?>
                                        <option>Hourly</option>
                                        <option>Yearly</option>
                                        <option>Monthly</option>
                                        <?php	
                                        }
                                    ?>
                                    </select>
                                </td>
                                <td style="vertical-align: middle;color:#083240;" >
                                <input onkeyup="DecpriciableCost2(),ComputeCUrrentVlue2()" name="usefultime" id="UsefulLifeSpanID" value="<?php echo $ViewAssetUsefullifeSpan; ?>" type="number" class="form-control"readonly required></td>
                                <td style="vertical-align: middle;color:#083240;" >
                                <input type="text"  id="deptioncost" class="form-control" value="<?php echo $ViewAssetDepreciationCost!=""? number_format($ViewAssetDepreciationCost,2) : ''; ?>"  readonly>
                                <input name="depcost223123" style="display:none;" step="0.1"  id="depcostid" value="<?php echo $ViewAssetDepreciationCost; ?>" type="number" class="form-control"readonly>
                                </td>
                                <td style="vertical-align: middle;color:#083240;" >
                                <input type="text" class="form-control" id="curcostidform" readonly value="<?php echo $ViewAssetCurrentValue!=""? number_format($ViewAssetCurrentValue,2) : ''; ?>">
                                <input name="curvaluesss" style="display:none;" id="curcostid" value="<?php echo $ViewAssetCurrentValue; ?>" type="number" class="form-control"readonly></td>
                            </tr>
                            <tr>
                                <td colspan="10" style="padding:5px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table borderless" style="background-color:white;margin-bottom:0px;margin-top:20px;">
                                    
                        <thead style="background-color:#124f62; color:white;">
                            <tr>
                                <th colspan="3">Data Entry</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="display:none;">
                                <td style="vertical-align: middle;text-align:right; color:#083240;" width="20%">Set Check Out Default</td>
                                <td width="20%;" style="vertical-align: middle;" width="10%;">
                                    <select class="form-control" name="SetCheckOut">
                                        <option value="0">NO</option>
                                        <option value="1">YES</option>
                                    </select>
                                </td>
                                <td></td>
                                
                            </tr>
                            <tr >
                                <td style="vertical-align: middle;text-align:right; color:#083240;" width="15%">Data Entry By</td>
                                <td width="23%;" style="vertical-align: middle;" >
                                    <select class="form-control"  name="dataentry" value="<?php echo $Employee_Name2; ?>">
                                        <option  value="<?php echo $Employee_I; ?>"><?php echo $Employee_Name2; ?></option>
                                    </select>
                                </td>
                                <td ></td>
                                
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12" style="text-align:right;margin-top:10px;">
                            <input type="submit" id="SaveBtnEditAsset" style="display:none" class="btn btn-success" name="SaveChanges" value="Save Changes">
                        </div>
                    </div>
                    </form>
                </div>
                <div class="tab-pane fade " id="ViewAssetAttachmentInfoTab" role="tabpanel" aria-labelledby="home-tab">
                    <table class="table table-sm" style="background-color:white;margin-bottom:0px;margin-top:10px;">
							<thead >
							<?php
							if($AssetTagID!=""){
							?>
								<tr>
									<th colspan="1">
									<label id="FileINPUTSKIN" for="file-upload2" style="display:none;" class="custom-file-upload">
										<i class="fa fa-cloud-upload"></i> Select File
									</label>
									<input id="file-upload2" type="file" form="editassetform" onchange="getMultiple2()"  name="CCDCC[]" multiple></th>
									<th id="FileNameTH"></th>
									<style>
									#file-upload2{
											display: none;
										}
									
									</style>
									<script>
										function getMultiple2(){
											
											var files = $('#file-upload2').prop("files");
											var names = $.map(files, function(val) { return val.name; });
											var count=names.length;
												console.log(names);
												
											// $.ajax({
											// type: 'POST',
											// url: ' setfiles2.php',                
											// data: {names:names},
											// success: function(data) {
												
											// 	$( "#filesbody2" ).replaceWith( data );
											// }						 
											// })
										}
									</script>
								</tr>
								<tbody id="filesbody2">
								</tbody>
								<?php
							}
								?>
								<tr style="background-color:#124f62; color:white;">
									<th >File Name</th>
									
									<th ></th>
								</tr>
							</thead>
							<?php
							if($AssetTagID!=""){
							?>
							<tbody>
								
							</tbody>
							<?php
							}
							?>
					</table>
                </div>
                <div class="tab-pane fade " id="ViewAssetAssetLogInfoTab" role="tabpanel" aria-labelledby="home-tab" style="background-color:transparent !important;">
                    <?php 
                    if($AssetTagID!=""){
                    ?>
                    <h3 style="color:#124f62"><?php echo $ViewAssetTag; ?></h3>
                    <script>
                        $(document).ready(function(){
                            $.ajax({
                            type: 'POST',
                            url: 'getAssetInfoAuditLogTbody',  
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },              
                            data: {value:'<?php echo $ViewAssetTag; ?>',_token: '{{csrf_token()}}'},
                            success: function(data) {
                                var element="<tbody id='AssetInfoAuditLogTbody'>";
                                
                                    element=element+data;
                                    element=element+'</tbody>';
                                $( "#AssetInfoAuditLogTbody" ).replaceWith( element );
                               
                            }  
                            }); 
                            $.ajax({
                            type: 'POST',
                            url: 'getAssetInfoTransactionLogTbody',  
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },              
                            data: {value:'<?php echo $ViewAssetTag; ?>',_token: '{{csrf_token()}}'},
                            success: function(data) {
                                var element="<tbody id='AssetInfoTransactionLogTbody'>";
                                
                                    element=element+data;
                                    element=element+'</tbody>';
                                $( "#AssetInfoTransactionLogTbody" ).replaceWith( element );
                               
                            }  
                            });
                            //AssetInfoTransactionLogTbody
                        })
                    </script>
                    <?php
                    }
                    
                    ?>
                    <table class="table table-bordered table-sm" style="background-color:white;margin-bottom:10px;margin-top:10px;">
                        <thead >
                        <tr style="background-color:#124f62; color:white;">
                                <th colspan="9" style="text-align:center;">AUDIT</th>
                        </tr>
                        <tr style="background-color:#0e3d4c; color:white;">
                            <th width="10%">Audit Date</th>
                            <th width="10%">Audit Time</th>
                            <th width="10%">Audited By</th>
                            <th width="10%">Status</th>
                            <th width="10%">Transaction</th>
                            
                            <th width="10%">Requested By</th>
                            <th width="10%">Reconcile Action</th>
                            <th width="10%">Note</th>
                        </tr>
                        </thead>
                        <tbody id="AssetInfoAuditLogTbody">
                            <tr>
                                <td colspan="9" style="vertical-align:middle;text-align:center;"> No Log Found....</td>
                            </tr>
                        </tbody>
                        
                    </table>
                    
                    <table class="table table-bordered table-sm" style="background-color:white;margin-bottom:0px;">
                                    
                        <thead >
                            <?php 
                            if($AssetTagID!=""){
                            ?>
                            <tr style="background-color:#124f62; color:white;">
                                <th colspan="9" style="text-align:center;">
                                    @foreach ($asset_description_grouped as $data)
                                        @if ($ViewAssetDesc==$data->asset_setup_ad)
                                            {{$data->asset_setup_description}}
                                        @endif
                                    @endforeach
                                </th>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr style="background-color:#0e3d4c; color:white;">
                                <th width="15%">Ticket No</th>
                                <th width="15%">Request Date</th>
                                <th width="15%">Requested By</th>
                                <th width="15%">Transaction</th>
                                
                                <th width="10%">Status</th>
                                <th width="10%">Remarks</th>
                                <th width="10%">Date Acted</th>
                                <th width="10%">Time Acted</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tbody id="AssetInfoTransactionLogTbody">
                                <tr>
                                    <td colspan="9" style="vertical-align:middle;text-align:center;"> No Log Found....</td>
                                </tr>
                            </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
        
    </div>
</div>
@endsection
