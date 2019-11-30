@extends('main.main')


@section('content')
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12">
            <h2 style="font-weight:bold;color:#083240;margin-top:0px;">AUDIT</h2>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            
            $("#audit_form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'get_assets_audit',                
                    data: $('#audit_form').serialize(),
                    success: function(data) {
                        $( "#Audit-Equipment-Section" ).replaceWith( data.html );
                    }
                })
            });
        });
        function FetchExistingAudit(){
            var AuditName=document.getElementById('AuditName').value;
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'CountExistingAudit',                
                data: {AuditName:AuditName,_token: '{{csrf_token()}}'},
            success: function(data) {
                if(data>0){
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'FetchExistingAudit',                
                        data: {AuditName:AuditName,_token: '{{csrf_token()}}'},
                        success: function(data) {
                            if(data.result=="1"){
                                alert('Audit Named '+AuditName+' not Found!!');
                            }else{
                                $( "#Audit-Equipment-Section" ).replaceWith( data.html );
                            }
                            
                           
                        } 											 
                    })
                }else{
                    document.getElementById('AuditDate').disabled=false;
                    document.getElementById('AuditDate').value="{{date('Y-m-d')}}";
                    document.getElementById('LocationAudit').disabled=false;
                    if(document.getElementById('SiteAudit').value!=""){
                        document.getElementById('SiteAudit').disabled=false;
                    }
                    document.getElementById('AuditNote').value="";
                    document.getElementById('AuditNote').disabled=false;
                    document.getElementById('FetchBtn').disabled=false;
                    clear_div_below()
                }
            } 											 
            })
        }
    </script>
    <form id="audit_form">
        <table class="table borderless table-sm" style="background-color:white;color:#083240;">
            <thead style="background-color:#124f62; color:white;">
                <tr>
                    <th colspan="5">Filter asset to Audit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="vertical-align: middle;color:#083240;" colspan="2"><legend>Audit Detail</legend></td>
                    <td style="vertical-align: middle;color:#083240;" colspan="2"></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="vertical-align: middle;text-align:right;color:#083240;">Audit Window Name</td>
                    <td style="vertical-align: middle;">
                        <div class="input-group">
                         
                        <input type="text" {{-- onkeyup="FetchExistingAudit()" --}} placeholder=" e.g. Audit-Department_Name..." class="form-control" id="AuditName" name="AuditName">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-secondary" type="button" onclick="FetchExistingAudit()" title="Fetch/Reset Data"><i class="fa fa-dot-circle-o" aria-hidden="true"></i></button>
                        </div>
                        </div>
                    </td>
                    <td style="vertical-align: middle;text-align:right;color:#083240;">Start Date</td>
                    <td style="vertical-align: middle;"><input type="date" id="AuditDate" name="AuditDate"  class="form-control" value="{{date('Y-m-d')}}"></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="vertical-align: middle;text-align:right;color:#083240;">Location</td>
                    <td style="vertical-align: middle;">
                    <select class="form-control" id="LocationAudit" name="LocationAudit" required onchange="clear_div_below(),FetchSites('')">
                        <option value="">--Select Location--</option>
                        @foreach ($location_list_active as $loc)
                            <option >{{$loc->asset_setup_location}}</option>
                        @endforeach                                     
                    </select>
                    <script>
                        function clear_div_below(){
                            $( "#Audit-Equipment-Section" ).replaceWith('<div class="row" id="Audit-Equipment-Section"><div class="col-md-12"></div></div>');
                        }
                        function FetchSites(selected){
                            var Site=document.getElementById('SiteAudit').value;
                            var Location=document.getElementById('LocationAudit').value;
                            $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'get_asset_setup_siteaudit',                
                            data:{value:Location,Site:"",_token: '{{csrf_token()}}'},
                            success: function(data) {
                                var element="<select class='form-control' id='SiteAudit' name='SiteAudit' required onchange='clear_div_below()'><option value=''>--Select Site--</option>";
                                    element=element+data;
                                    element=element+"</select>";
                                $( "#SiteAudit" ).replaceWith( element );
                                document.getElementById('SiteAudit').value=selected;
                                if(selected!=''){
                                    document.getElementById('SiteAudit').disabled=true;
                                }
                            }  
                            }) 
                            
                        }
                        
                    </script>
                    </td>
                    
                    <td style="vertical-align: middle;text-align:right;color:#083240;" rowspan="2">Note</td>
                    <td style="vertical-align: middle;" rowspan="2"><textarea class="form-control"  rows="3" id="AuditNote" name="AuditNote"></textarea></td>
                    <td>
                    
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: middle;text-align:right;color:#083240;">Site</td>
                    <td style="vertical-align: middle;">
                        <select class="form-control" id="SiteAudit" name="SiteAudit" required disabled>
                        <option value="">--Select Site--</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: middle;text-align:right;color:#083240;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td></td>

                </tr>
                <tr>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;text-align:right;"><button type="submit" class="btn btn-light"  id="FetchBtn" >Fetch Asset</button></td>
                </tr>
            </tbody>
        </table>
    </form>
    <div class="row" id="Audit-Equipment-Section">
        <div class="col-md-12">
    {{-- <table class="table table-hover table-sm" style="background-color:white;color:#083240;" id="AuditTable">
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
        
        
        </tbody>
    </table> --}}
        </div>
    </div>
    
</div>
@endsection