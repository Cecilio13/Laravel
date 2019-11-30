<div class="row" id="Audit-Equipment-Section">
    <div class="col-md-12">
        <table class="table table-hover table-sm" style="background-color:white;color:#083240;" id="AuditTable">
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
                <script>
                document.getElementById('AuditDate').value="{{$AuditDate}}";
                document.getElementById('LocationAudit').value="{{$LocationAudit}}";
                FetchSites('{{$SiteAudit}}');
                //document.getElementById('SiteAudit').value="{{$SiteAudit}}";
                document.getElementById('AuditNote').value="{{$AuditNote}}";
                document.getElementById('AuditDate').disabled=true;
                document.getElementById('LocationAudit').disabled=true;
                document.getElementById('SiteAudit').disabled=true;
                document.getElementById('AuditNote').disabled=true;
                document.getElementById('FetchBtn').disabled=true;
                
                function cehckcheck(element,id){
                    var checkbox = $(element);
                    if (checkbox.is(":checked")) {
                        document.getElementById(id).style.display="none";
                        document.getElementById(id+"td").style.backgroundColor="#73d863";
                    } else {
                    // prevent from being unchecked
                        element.checked=!element.checked;
                        document.getElementById(id).style.display="none";
                        document.getElementById(id+"td").style.backgroundColor="#73d863";
                    }
                }
                </script>
            @foreach ($asset_by_location_and_site as $asset)
                <tr>
                    <td style="vertical-align: middle;" id="AUDITASSET<?php echo $asset->ASSET_ID; ?>td">
                        <label class="checkbox-inline" ><input type="checkbox" onclick="cehckcheck(this,'AUDITASSET<?php echo $asset->ASSET_ID; ?>')" id="AUDITASSET<?php echo $asset->ASSET_ID; ?>"  name="Processed" value="<?php echo $asset->ASSET_ID; ?>" style="margin-top:0px;bottom:30%;"> </label>
                        @if ($asset->audit_check=="1")
                            <script>
                                document.getElementById('AUDITASSET<?php echo $asset->ASSET_ID; ?>').click();
                            </script>
                        @endif
                    </td>
                    <td style="vertical-align: middle;"><a onclick="ViewPendingAssets('<?php echo $asset->ASSET_ID; ?>')" class="btn btn-link" style="padding-left:0px;"><?php echo $asset->asset_tag; ?></a></td>
                    <?php 
                        $ViewAssetDesc="";
                    ?>
                    @foreach ($asset_description_grouped as $setup)
                        @if ($setup->asset_setup_ad==$asset->asset_description)
                        <?php 
                        $ViewAssetDesc=$setup->asset_setup_description;
                        ?>
                        @endif
                        
                    @endforeach
                    <td style="vertical-align: middle;" ><a onclick="ViewPendingAssets('<?php echo $asset->ASSET_ID; ?>')" class="btn-link" style="cursor: pointer;">{{$ViewAssetDesc}}</a></td>
                    <td style="vertical-align: middle;">{{$asset->asset_brand}}</td>
                    <td style="vertical-align: middle;">{{$asset->asset_model}}</td>
                    <td style="vertical-align: middle;">{{$asset->asset_serial_number}}</td>
                    <td style="vertical-align: middle;">{{$asset->department_name}}</td>
                    <td style="vertical-align: middle;">{{$asset->asset_site}}</td>
                    <td style="vertical-align: middle;">{{$asset->asset_location}}</td>
                    <td style="vertical-align: middle;">
                            <?php 
                            if($asset->asset_transaction_status=="1" || $asset->asset_transaction_status=="2.1" || $asset->asset_transaction_status=="2.2" ){
                                echo "Available";
                            }
                            if($asset->asset_transaction_status=="2" || $asset->asset_transaction_status=="1.1" || $asset->asset_transaction_status=="1.2"){
                                echo "Checked Out";
                            }
                            
                            if($asset->asset_transaction_status=="4.1" || $asset->asset_transaction_status=="4.2"){
                                echo "Queued for Maintenance";
                            }
                            if($asset->asset_transaction_status=="4"){
                                echo "On Maintenace";
                            }
                            ?>
                    </td>
                    <td style="vertical-align: middle;">
                        @foreach ($selected_asset_checkouts_list as $ch)
                            @if ($ch->Request_Asset_tag==$asset->ASSET_ID)
                                {{$ch->fname." ".$ch->lname}}
                                <?php
                                    break;
                                ?>
                            @endif
                        @endforeach
                    </td>
                    
                </tr>
            @endforeach
            
            </tbody>
        </table>
    </div>
    <div class="col-md-12" style="text-align:right;">
        <a class="btn btn-primary" href="#" onclick="printhtmltocanvas('AuditTable')">Print</a>
        <a class="btn btn-primary" href="GETAUDITEXCEL?name={{$AuditName}}&location={{$LocationAudit}}&site={{$SiteAudit}}">Download Excel</a>
    </div>
    <div class="col-md-12 mt-4">
        <table class="table borderless table-sm" style="background-color:white;color:#083240;" id="" tabindex="-1">
            <thead style="background-color:#124f62; color:white;">
                <tr style="background-color:#083240">
                    <th colspan="12" style="text-align:center;">ASSET UNASSIGNED TO THIS SITE/LOCATION</th>
                </tr>
                <tr>
                    <th></th>
                    <th>Asset Tag</th>
                    <th>Asset</th>
                    <th style="display:none;">Asset Type</th>
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
            <tbody id="ANOTHERLOC">
                
            </tbody>
        </table>
    </div>
    <div class="col-md-12" style="text-align:right;">
        <button class="btn btn-light btn-sm" onclick="CancelAudit()" id="ClearAuditBTN">Cancel</button>
        <button class="btn btn-primary btn-sm" onclick="ProcessAudit('0')" id="ProcessBTN">Save Audit</button>
        <button class="btn btn-primary btn-sm" id="Save_ProcessBtn" onclick="ProcessAudit('1')">Process Audit</button>
        <script>
            function CancelAudit(){
               location.reload();
            }
            function ProcessAudit(action_proceed){
                
                var AuditWindowName=document.getElementById('AuditName').value;
                var AuditDate=document.getElementById('AuditDate').value;
                var AuditNote=document.getElementById('AuditNote').value;
                var Location=document.getElementById('LocationAudit').value;
                var SiteAudit=document.getElementById('SiteAudit').value;
                if(AuditWindowName=="" || AuditDate=="" || Location=="" || SiteAudit==""){
                    alert('Please Fill All Field Higlighted....');
                    document.getElementById('AuditDate').style.borderColor = "#e23d3d";
                    document.getElementById('AuditName').style.borderColor = "#e23d3d";
                    document.getElementById('LocationAudit').style.borderColor = "#e23d3d";
                    document.getElementById('SiteAudit').style.borderColor = "#e23d3d";
                }else{
                    var input, filter, table, tr, td, i, td2;
                      var count=0;
                        var difflocation = new Array();
                      table = document.getElementById("ANOTHERLOC");
                      tr = table.getElementsByTagName("tr");
                      
                      // Loop through all table rows, and hide those who don't match the search query
                      for (i = 0; i < tr.length; i++) {
                        
                        td1 = tr[i].getElementsByTagName("td")[1];
                        
                        difflocation.push(td1.innerHTML); 
                        
                        
                        
                      }
                    
                    var checked = new Array();
                    $("input:checkbox[name=Processed]:checked").each(function() {
                           checked.push($(this).val());
                      });
                    if (checked && checked.length) {   
                       // not empty 
                    } else {
                       checked.push("");
                    }
                    var unchecked = new Array();
                    $("input:checkbox[name=Processed]:not(:checked)").each(function() {
                           unchecked.push($(this).val());
                      });
                    if (unchecked && unchecked.length) {   
                       // not empty 
                    } else {
                       unchecked.push("");
                    }
                    console.log(checked);
                    console.log(unchecked);
                    $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'SaveFirstAudit',                
                    data:{SiteAudit:SiteAudit,difflocation:difflocation,checked:checked,unchecked:unchecked,AuditWindowName:AuditWindowName,AuditDate:AuditDate,AuditNote:AuditNote,Location:Location,_token: '{{csrf_token()}}'},
                    success: function(data) {
                        if(action_proceed=='1'){
                            post('audit_detail', {name: 'PhaseTwoAuditSubmit'},'POST',AuditWindowName);
                        }else{
                            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                            var today  = new Date();
                            alert('Audit Saved.\nLocation and Site : '+Location+' - '+SiteAudit+'\nDate :'+today.toLocaleDateString("en-US"));
                        }
                        
                    }  
                    }) 
                    
                    
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
        </script>
    </div>
</div>