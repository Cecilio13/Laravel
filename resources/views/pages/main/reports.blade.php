@extends('main.main')


@section('content')
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12">
            <h2 style="font-weight:bold;color:#083240;margin-bottom:0px;margin-left:10px;">REPORTS</h2>
        </div>
    </div>
    <script>
    function ShowReportDescription(e){
		
		document.getElementById('RunBtn').style.display="inline";
		document.getElementById('hiddenCt').value=e;
		// $.ajax({
		// 	type: 'POST',
		// 	url: 'ReportAsset_type.php',
		// 	data: {Type:e},
		// success: function(data) {
		// 	$( "#parameterTR" ).replaceWith( data );
		// 	//printDiv('tableitems');
		// } 											 
		// })
		$.ajax({
        type: 'POST',
        url: ' ReportAsset_type',                
        data: {Type:e,_token:'{{csrf_token()}}'},
        success: function(data) {
            $( "#parameterTR" ).replaceWith( data.html );
            
        } 											 
        })
		document.getElementById('AuditYearTR').style.display="none";
		document.getElementById('ColumnParameter').style.display="table-row";
		if(e=="LS1"){
			document.getElementById('ReportDescriptionBody').innerHTML="This Report displays Lapsing Schedule of Assets. The report will display all assets or use the option in the Report Parameter Section to limit the report to a specific asset or assets.";
			document.getElementById('ReportHeader').innerHTML="Lapsing Schedule Report";
            var data='<tr id="ColumnParameter" ><td width="20%" style="text-align:right;vertical-align:middle;">Columns</td><td colspan="4"><label for="sel2">Mutiple select list (hold shift to select more than one):</label><select multiple class="form-control" id="sel2"><option selected>Asset Tag</option><option selected>Asset</option><option selected>Serial Number</option><option selected>Plate Number</option><option selected>Vendor Name</option><option selected>Purchase Order</option><option selected>Invoice Number</option><option selected>Purchase Cost</option><option selected>Purchase Date</option><option selected>Start Date</option><option selected>Initial Value</option><option selected>Salvage Cost</option><option selected>Depreciable Cost</option><option selected>Depreciation Frequency</option><option selected>Useful Life</option><option selected>Depreciation Cost</option></select></td></tr>';
            $( "#ColumnParameter" ).replaceWith( data );
		}
		if(e=="A1" || e=="B1" || e=="C1" || e=="D1"){
			document.getElementById('ReportDescriptionBody').innerHTML="This Report displays asset Group by Asset Type. The report will display all assets or use the option in the Report Parameter Section to limit the report to a specific asset or assets.";
			
			if(e=="A1"){
				document.getElementById('ReportHeader').innerHTML="Asset Report by Asset Type";
			}
			if(e=="B1"){
				document.getElementById('ReportHeader').innerHTML="Asset Depreciation Report Asset Type";
			}
			if(e=="C1"){
				document.getElementById('ReportHeader').innerHTML="Audit Report";
				document.getElementById('AuditYearTR').style.display="table-row";
			}
			if(e=="D1"){
				document.getElementById('ReportHeader').innerHTML="Check Out Report by Asset Type";
			}
            
		}
		if(e=="A2" || e=="B2" || e=="C2" || e=="D2"){
			document.getElementById('ReportDescriptionBody').innerHTML="This Report displays asset Group by Asset Location. The report will display all assets or use the option in the Report Parameter Section to limit the report to a specific asset or assets.";
			
			if(e=="A2"){
				document.getElementById('ReportHeader').innerHTML="Asset Report by Location And Site";
			}
			if(e=="B2"){
				document.getElementById('ReportHeader').innerHTML="Asset Depreciation Report by Location And Site";
			}
			if(e=="C2"){
				document.getElementById('ReportHeader').innerHTML="Audit Report by Location And Site";
			}
			if(e=="D2"){
				document.getElementById('ReportHeader').innerHTML="Check Out Report by Location And Site";
			}
		}
		if(e=="A3" || e=="B3" || e=="C3" || e=="D3"){
			document.getElementById('ReportDescriptionBody').innerHTML="This Report displays asset Group by Asset Department. The report will display all assets or use the option in the Report Parameter Section to limit the report to a specific asset or assets.";
			
			if(e=="A3"){
				document.getElementById('ReportHeader').innerHTML="Asset Report by Department";
			}
			if(e=="B3"){
				document.getElementById('ReportHeader').innerHTML="Asset Depreciation Report by Department";
			}
			if(e=="C3"){
				document.getElementById('ReportHeader').innerHTML="Audit Report by Department";
			}
			if(e=="D3"){
				document.getElementById('ReportHeader').innerHTML="Check Out Report by Department";
			}
		}

        if(e=="A1" || e=="A2" || e=="A3" || e=="A4"){
            var data='<tr id="ColumnParameter" ><td width="20%" style="text-align:right;vertical-align:middle;">Columns</td><td colspan="4"><label for="sel2">Mutiple select list (hold shift to select more than one):</label><select multiple class="form-control" id="sel2"><option selected>Asset Tag</option><option selected>Asset</option><option selected>Category</option><option selected>Sub Category</option><option selected>Brand</option><option selected>Serial Number</option><option selected>Plate Number</option><option selected>Department</option><option selected>Assigned To</option><option selected>Location</option><option selected>Site</option><option selected>Vendor Name</option><option selected>Purchase Order</option><option selected>Invoice Number</option><option selected>Purchase Cost</option><option selected>Purchase Date</option><option selected>Start Date</option><option selected>Initial Value</option><option selected>Salvage Cost</option><option selected>Depreciable Cost</option><option selected>Depreciation Frequency</option><option selected>Useful Life</option><option selected>Depreciation Cost</option><option selected>Total Accumulated Depreciation</option><option selected>Book Value</option></select></td></tr>';
            $( "#ColumnParameter" ).replaceWith( data ); 
        }
        if(e=="B1" || e=="B2" || e=="B3" || e=="B4"){
            var data='<tr id="ColumnParameter" ><td width="20%" style="text-align:right;vertical-align:middle;">Columns</td><td colspan="4"><label for="sel2">Mutiple select list (hold shift to select more than one):</label><select multiple class="form-control" id="sel2"><option selected>Asset Tag</option><option selected>Asset</option><option selected>Department</option><option selected>Location</option><option selected>Site</option><option selected>Serial Number</option><option selected>Plate Number</option><option selected>Vendor Name</option><option selected>Purchase Order</option><option selected>Invoice Number</option><option selected>Purchase Cost</option><option selected>Purchase Date</option><option selected>Start Date</option><option selected>Initial Value</option><option selected>Salvage Cost</option><option selected>Depreciable Cost</option><option selected>Depreciation Frequency</option><option selected>Useful Life</option><option selected>Depreciation Cost</option><option selected>Total Accumulated Depreciation</option><option selected>Book Value</option></select></td></tr>';
            $( "#ColumnParameter" ).replaceWith( data ); 
        }
        if(e=="C1"){
            var data='<tr id="ColumnParameter" ><td width="20%" style="text-align:right;vertical-align:middle;">Columns</td><td colspan="4"><label for="sel2">Mutiple select list (hold shift to select more than one):</label><select multiple class="form-control" id="sel2"><option selected>Asset Tag</option><option selected>Description</option><option selected>Category</option><option selected>Sub Category</option><option selected>Serial Number</option><option selected>Plate Number</option><option selected>Assigned To</option><option selected>Vendor Name</option><option selected>Purchase Order</option><option selected>Invoice Number</option><option selected>Purchase Cost</option><option selected>Start Date</option><option selected>Purchase Date</option><option selected>Initial Value</option><option selected>Salvage Cost</option><option selected>Depreciable Cost</option><option selected>Depreciation Frequency</option><option selected>Useful Life</option><option selected>Depreciation Cost</option><option selected>Total Accumulated Depreciation</option><option selected>Book Value</option><option selected>Transaction</option><option selected>Requested By</option><option selected>Status</option><option selected>Action</option><option selected>Note</option></select></td></tr>';
            $( "#ColumnParameter" ).replaceWith( data ); 
        }
        if(e=='D1' || e=='D2' || e=='D3' || e=='D4'){
            var data='<tr id="ColumnParameter" ><td width="20%" style="text-align:right;vertical-align:middle;">Columns</td><td colspan="4"><label for="sel2">Mutiple select list (hold shift to select more than one):</label><select multiple class="form-control" id="sel2"><option selected>Ticket No.</option><option selected>Asset Tag</option><option selected>Asset</option><option selected>Serial Number</option><option selected>Plate Number</option><option selected>Vendor Name</option><option selected>Purchase Order</option><option selected>Invoice Number</option><option selected>Purchase Cost</option><option selected>Purchase Date</option><option selected>Start Date</option><option selected>Initial Value</option><option selected>Salvage Cost</option><option selected>Depreciable Cost</option><option selected>Depreciation Frequency</option><option selected>Useful Life</option><option selected>Depreciation Cost</option><option selected>Total Accumulated Depreciation</option><option selected>Book Value</option><option selected>Requested By</option><option selected>Borrow Date</option><option selected>Due Date</option><option selected>Status</option></select></td></tr>';
            $( "#ColumnParameter" ).replaceWith( data ); 

        }
	}
    </script>
    <style>
        .card {
            margin-bottom:0px !important;
        }
    </style>
    <div class="row" style="margin-left:10px;background-color:white;padding:10px;">
        <div class="col-md-5">
            <div class="card">
            <div class="card-header">
                Asset Report
            </div>
            <ul class="list-group list-group-flush">
                <a href="#" onclick="ShowReportDescription('A2')"><li class="list-group-item">Asset by Location And Site </li></a>
                <a href="#" onclick="ShowReportDescription('A3')"><li class="list-group-item">Asset by Department </li></a>
            </ul>
            </div>
            <div class="card">
            <div class="card-header">
                    Asset Depreciation
            </div>
            <ul class="list-group list-group-flush">
                <a href="#" onclick="ShowReportDescription('B2')"><li class="list-group-item">Asset Depreciation by Location And Site</li></a>
                <a href="#" onclick="ShowReportDescription('B3')"><li class="list-group-item">Asset Depreciation by Department </li></a>
                <a href="#" onclick="ShowReportDescription('LS1')"><li class="list-group-item">Lapsing Schedule</li></a>
            </ul>
            </div>
            <div class="card">
            <div class="card-header">
                    Audit Report
            </div>
            <ul class="list-group list-group-flush">
                <a href="#" onclick="ShowReportDescription('C1')"><li class="list-group-item">Audit Report</li></a>
            </ul>
            </div>
            <div class="card">
            <div class="card-header">
                    Check Out Report
            </div>
            <ul class="list-group list-group-flush">
                <a href="#" onclick="ShowReportDescription('D2')"><li class="list-group-item">Asset by Location And Site</li></a>
                <a href="#" onclick="ShowReportDescription('D3')"><li class="list-group-item">Asset by Department </li></a>
            </ul>
            </div>
        </div>
        <div class="col-md-7">
            <table class="table borderless table-sm" style="background-color:white;">
                <thead style="background-color:#124f62; color:white;">
                    <tr style="background-color:white;color:#124f62;">
                        <th colspan="5" style="padding-left:0px; " id="ReportHeader"></th>
                    </tr>
                    <tr>
                        <th colspan="5">Report Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" id="ReportDescriptionBody"></td>
                    </tr>
                    <tr style="background-color:#124f62; color:white;">
                        <th colspan="5">Report Parameter</th>
                    </tr>
                    <tr id="ColumnParameter">
                    <td width="20%" style="text-align:right;vertical-align:middle;"></td>
                    <td colspan="4">
                    
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
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    url: 'ReplaceAuditParam',
                                    data:{AuditMonth:AuditMonth,AuditYear:AuditYear,_token: '{{csrf_token()}}'},
                                    success: function(data) {
                                        var element='<select class="form-control" id="Parameter" >'+data+'</select>';
                                        $( "#Parameter" ).replaceWith( element );
                                        
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
                    <td width="10%" style="text-align:right;vertical-align:middle;"></td>
                    <td style="vertical-align:middle;">
                    
                    </td>
                    <td width="10%" style="text-align:right;vertical-align:middle;"></td>
                    <td>
                        
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
                                var go=1;
                                if(kind=="C1"){
                                    if(document.getElementById('AuditMonth').value=="" || document.getElementById('AuditYear').value==""){
                                        go=0;
                                    }
                                }
                                if(go==0){
                                    alert('Please Select Month and Year to select Audit Name');
                                }else{
                                    var w='900';
                                    var h='600';
                                    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
                                    var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

                                    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
                                    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

                                    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
                                    var top = ((height / 2) - (h / 2)) + dualScreenTop;
                                    var myWindow = window.open("Report?Columns="+values+"&Kind="+kind+"&value="+parametervalue+"&value2="+parametervalue2, "", "width=900,height=600,resizable=no,left="+left+"");
                                    myWindow.Kind=kind;
                                    myWindow.Columns=values;
                                    myWindow.value=parametervalue;
                                    myWindow.value2=parametervalue2;
                                }
                                
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