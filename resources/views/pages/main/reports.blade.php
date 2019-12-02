@extends('main.main')


@section('content')
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12">
            <h2 style="font-weight:bold;color:#083240;margin-bottom:0px;margin-left:10px;">REPORTS</h2>
        </div>
    </div>
    <div class="row" style="margin-left:10px;background-color:white;padding:10px;">
        <div class="col-md-5">
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" onclick="SetHeight()" class="" aria-expanded="true"> <h4 class="panel-title">
                    Asset Report
                </h4></a>
                </div>
                <div id="collapse2" class="panel-collapse collapse show" style="">
                <div class="panel-body" style="padding: 0px;">
                    <ul class="list-group" style="margin-bottom:0px;">

                        <a href="#" onclick="ShowReportDescription('A2')"><li class="list-group-item">Asset by Location And Site </li></a>
                        <a href="#" onclick="ShowReportDescription('A3')"><li class="list-group-item">Asset by Department </li></a>
                    
                    </ul>
                </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" onclick="SetHeight()" class="" aria-expanded="true"> <h4 class="panel-title">

                    Asset Depreciation
                </h4></a>
                </div>
                <div id="collapse3" class="panel-collapse collapse show" style="">
                <div class="panel-body" style="padding: 0px;">
                    <ul class="list-group" style="margin-bottom:0px;">

                        <a href="#" onclick="ShowReportDescription('B2')"><li class="list-group-item">Asset Depreciation by Location And Site</li></a>
                        <a href="#" onclick="ShowReportDescription('B3')"><li class="list-group-item">Asset Depreciation by Department </li></a>
                        <a href="#" onclick="ShowReportDescription('LS1')"><li class="list-group-item">Lapsing Schedule</li></a>
                    <script>
                        function DownloadExcel(){
                            $.ajax({
                            type: 'POST',
                            url: 'extra/download/excel.php',
                            data: {Type:'B3',value:'All',value2:""},
                            success: function(data) {
                                $( "#DownloadExcelDiv" ).replaceWith( data );
                            } 											 
                            })

                        }
                    </script>
                    <div id="DownloadExcelDiv"></div>
                    </ul>
                </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                <a data-toggle="collapse" onclick="SetHeight()" data-parent="#accordion" href="#collapse4" class="collapsed" aria-expanded="false"><h4 class="panel-title">

                    Audit Report
                </h4></a>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
                <div class="panel-body" style="padding: 0px;">
                    <ul class="list-group" style="margin-bottom:0px;">
                        <a href="#" onclick="ShowReportDescription('C1')"><li class="list-group-item">Audit Report</li></a>
                    </ul>
                </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" onclick="SetHeight()" class="collapsed" aria-expanded="false"><h4 class="panel-title">

                    Check Out Report
                </h4></a>
                </div>
                <div id="collapse5" class="panel-collapse collapse">
                <div class="panel-body" style="padding: 0px;">
                    <ul class="list-group" style="margin-bottom:0px;">

                        <a href="#" onclick="ShowReportDescription('D2')"><li class="list-group-item">Asset by Location And Site</li></a>
                        <a href="#" onclick="ShowReportDescription('D3')"><li class="list-group-item">Asset by Department </li></a>
                    
                    </ul>
                </div>
                </div>
            </div>
        </div>
        </div>
        <div class="col-md-7">
            <table class="table borderless" style="background-color:white;">
                <thead style="background-color:#124f62; color:white;">
                    <tr style="background-color:white;color:#124f62;">
                        <th colspan="5" style="padding-left:0px; " id="ReportHeader">Asset Report by Location And Site</th>
                    </tr>
                    <tr>
                        <th colspan="5">Report Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" id="ReportDescriptionBody">This Report displays asset Group by Asset Location. The report will display all assets or use the option in the Report Parameter Section to limit the report to a specific asset or assets.</td>
                    </tr>
                    <tr style="background-color:#124f62; color:white;">
                        <th colspan="5">Report Parameter</th>
                    </tr>
                    <tr id="ColumnParameter">
                    <td width="20%" style="text-align:right;vertical-align:middle;">Columns</td>
                    <td colspan="4">
                    <label for="sel2">Mutiple select list (hold shift to select more than one):</label>
                    <select multiple="" class="form-control" id="sel2">
                            <option selected="">Asset Tag</option>
                            <option selected="">Asset</option>
                            <option selected="">Category</option>
                            <option selected="">Sub Category</option>
                            <option selected="">Brand</option>
                            <option selected="">Serial Number</option>
                            <option selected="">Plate Number</option>
                            <option selected="">Department</option>
                            <option selected="">Assigned To</option>
                            <option selected="">Location</option>
                            <option selected="">Site</option>
                            
                            <option selected="">Vendor Name</option>
                            <option selected="">Purchase Order</option>
                            <option selected="">Invoice Number</option>
                            <option selected="">Purchase Cost</option>
                            <option selected="">Purchase Date</option>
                            <option selected="">Start Date</option>
                            
                            <option selected="">Initial Value</option>
                            <option selected="">Salvage Cost</option>
                            <option selected="">Depreciable Cost</option>
                            <option selected="">Depreciation Frequency</option>
                            <option selected="">Useful Life</option>
                            <option selected="">Depreciation Cost</option>
                            <option selected="">Total Accumulated Depreciation</option>
                            <option selected="">Book Value</option>
                    </select>
                    </td>
                    </tr>
                    <tr id="AuditYearTR" style="display:none;">
                        <td width="25%" style="text-align:right;vertical-align:middle;">Month/Year</td>
                        <td style="vertical-align:middle;">
                        <select onchange="ChangeAUDITValue()" class="form-control" id="AuditMonth">
                            <option value="">--Select Month--</option>
                            <option value="01">January</option>
                            <option value="02">February</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        
                        <input type="month" class="form-control" id="AuditYearMonth" style="display:none;" onchange="ChangeAUDITValue()">
                        <script>
                            function ChangeAUDITValue(){
                                var AuditMonth=document.getElementById('AuditMonth').value;
                                var AuditYear=document.getElementById('AuditYear').value;
                                var Timeline=AuditYear+"-"+AuditMonth;
                                //alert(Timeline);
                                if(AuditMonth!="" && AuditYear!=""){
                                    $.ajax({
                                        type: 'POST',
                                        url: ' ReplaceAuditParam.php',                
                                        data: {INPUT:Timeline},
                                    success: function(data) {
                                        //alert(data);
                                        $( "#Parameter" ).replaceWith( data );
                                        
                                    } 											 
                                    })
                                    document.getElementById('parameterTR').style.display="table-row";
                                }else{
                                    document.getElementById('parameterTR').style.display="none";
                                    
                                }
                            }
                        </script>
                        </td>
                        <td width="40%" style="text-align:right;vertical-align:middle;"><input type="number" onkeyup="ChangeAUDITValue()" class="form-control" id="AuditYear" value="2019"></td>
                        
                    </tr>
                    <tr id="parameterTR">
                    <td width="10%" style="text-align:right;vertical-align:middle;">Location</td>
                    <td style="vertical-align:middle;">
                    <script>
                        function ChangeSiteValues(){
                            var Loca=document.getElementById('Parameter').value;
                            
                                $.ajax({
                                    type: 'POST',
                                    url: ' ReplaceSiteParam2.php',                
                                    data: {INPUT:Loca},
                                success: function(data) {
                                    $( "#Parameter2" ).replaceWith( data );
                                    
                                } 											 
                                })
                                
                            
                        }
                    </script>
                    <select class="form-control" id="Parameter" onchange="ChangeSiteValues()">
                        <option>All</option>
                            <option>ANTIQUE</option>
                            <option>BABAK, SAMAL</option>
                            <option>CALATAGAN, BATANGAS</option>
                            <option>DAVAO CITY</option>
                            <option>DAVAO DEL SUR</option>
                            <option>DIGOS CITY</option>
                            <option>ILIGAN CITY</option>
                            <option>ILOCOS NORTE</option>
                            <option>ILOILO CITY</option>
                            <option>MANOC MANOC, BORACAY ISLAND</option>
                            <option>NORTHERN MINDANAO</option>
                            <option>OZAMIZ CITY</option>
                        </select>
                    </td>
                    <td width="10%" style="text-align:right;vertical-align:middle;">Site</td>
                    <td>
                        <select class="form-control" id="Parameter2">
                            <option></option>
                                    <option>ACCESS ROAD TO MALALAG PORT DPWH DIGOS 001</option>
                                    <option>BUGASONG</option>
                                    <option>CABANTIAN</option>
                                    <option>CALATAGAN DREDGING PPA HO 005</option>
                                    <option>CURRIMAO PORT PPA HO 004</option>
                                    <option>DIGOS APLAYA ROAD DPWH DIGOS 002</option>
                                    <option>DREDGING DAPITAN/ILIGAN/CDO PPA HO 006</option>
                                    <option>DREDGING OZAMIZ PPA HO 003</option>
                                    <option>HAMTIC &amp; BUGASONG C. PORT PPA HO 010</option>
                                    <option>ICPC SOUTHERN SEC - PPA ILOILO 016</option>
                                    <option>IGNATO VILLASIGA ROAD DPWH ANTIQUE 016</option>
                                    <option>KKCCDC- HEAD OFFICE</option>
                                    <option>MALALAG PORT PPA HO 001</option>
                                    <option>MALALAG TAGANSULE ROAD DPWH DIGOS 002</option>
                                    <option>MANOC MANOC PPA ILOILO 004</option>
                                    <option>OFFICE - ANTIQUE</option>
                                    <option>OFFICE - CURRIMAO</option>
                                    <option>OFFICE - DIGOS </option>
                                    <option>OFFICE - ILOILO</option>
                                    <option>OFFICE - MALALAG</option>
                                    <option>OPERATIONS BUILDING BABAK PPA HO 007</option>
                                    <option>PANGALCAGAN SADSADAN  ROAD DPWH ANTIQUE 013</option>
                                    <option>PORT ROAD SAN JOSE PPA ILOILO 017</option>
                                    <option>RDF RIVER WHARF PPA ILOILO 015</option>
                                    <option>RDF S. JOSE ANTIQUE PPA ILOILO 014</option>
                                    <option>SITIO NAWILI - DPWH ANTIQUE 007</option>
                                    <option>STREETLIGHT DUMANGAS PPA ILOILO 012</option>
                                    <option>STREETLIGHT PPA ILIGAN 002</option>
                                    <option>TONO AN PANGALCAGAN ROAD DPWH ANTIQUE 014</option>
                                    <option>WAREHOUSE - ANTIQUE</option>
                                    <option>WAREHOUSE - CABANTIAN</option>
                                    <option>WAREHOUSE - CURRIMAO</option>
                                    <option>WAREHOUSE - ILOILO</option>
                                </select>
                    </td>
                    <td width="25%"></td>
                    </tr>
                    <tr>
                        <td style="text-align:right;" colspan="5">
                        <input type="hidden" id="hiddenCt" value="A2">
                        
                        <button onclick="RunReport()" id="RunBtn" style="display: inline;" class="btn btn-primary">Run Report</button>
                        <script>
                            function RunReport(){
                                var values = $('#sel2').val();
                                //alert(values[0]);
                                var kind=document.getElementById('hiddenCt').value;
                                var parametervalue=document.getElementById('Parameter').value;
                                var parametervalue2=document.getElementById('Parameter2').value;
                                var w='900';
                                var h='600';
                                var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
                                var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

                                var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
                                var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

                                var left = ((width / 2) - (w / 2)) + dualScreenLeft;
                                var top = ((height / 2) - (h / 2)) + dualScreenTop;
                                var myWindow = window.open("Report.php", "", "width=900,height=600,resizable=no,left="+left+"");
                                myWindow.Kind=kind;
                                myWindow.Columns=values;
                                myWindow.value=parametervalue;
                                myWindow.value2=parametervalue2;
                            }
                        </script>
                        </td>
                    </tr>
                </tbody>
            </table> 
        </div>				
    </div>
</div>
@endsection