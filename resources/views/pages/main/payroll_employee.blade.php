@extends('main.main')


@section('content')
<div class="container-fluid" >
    <ul class="nav nav-tabs nav-tab-custom"   role="tablist">
        <li class="nav-item" >
            <a class="nav-link {{($page=='1'? 'active' : ($page==''? 'active' : '') )}}" id="LIST-tab" data-toggle="tab" href="#LIST" role="tab" aria-controls="home" aria-selected="true">LIST</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link {{($page=='2'? 'active' : '' )}}" id="ADJUSTMENT-tab" data-toggle="tab" href="#ADJUSTMENT" role="tab" aria-controls="profile" aria-selected="false">ADJUSTMENT</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='3'? 'active' : '' )}}" id="ATTENDANCE-tab" data-toggle="tab" href="#ATTENDANCE" role="tab" aria-controls="contact" aria-selected="false">IMPORT ATTENDANCE</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='4'? 'active' : '' )}}" id="REVIEW-tab" data-toggle="tab" href="#REVIEW" role="tab" aria-controls="contact" aria-selected="false">REVIEW AND PROCESS</a>
        </li>
    </ul>
    <script>
        $(document).ready(function(){
            FetchPayrollEmployee();
        })
        function FetchPayrollEmployee(){
            var x=document.getElementById('SELECTPAROLL').value;
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'get_payroll_employees',                
                data:{id:x,_token: '{{csrf_token()}}'},
                success: function(data) {
                    $( "#PayrollEmployeeListDiv" ).replaceWith( data );
                }
            })
        }
        function SETAdjustmentEmployeee(salid,empid,name){
            
            document.getElementById('EmpHiddenSalaryID').value=salid;
            document.getElementById('SearchInputAdjustment').value=empid;
            document.getElementById('ModalHeaderEmployeeName').innerHTML=name;
            $("#AdjustmentModal").modal('show');
        }
    </script>
    <script>
        var Selected="";
        var Selected2="";
        
        function ClickRow(e,id){
            if(Selected!=""){
            document.getElementById('Employee'+Selected).style.backgroundColor="white";
            
            }
            document.getElementById(e).style.backgroundColor="#88a7ea";
            Selected=id;
            
            if(Selected!=""){
            document.getElementById('ForwardEmployee').disabled=false;
            }else{
                document.getElementById('ForwardEmployee').disabled=true;
            }
        }
        function ClickRow2(e,id){
            if(Selected2!=""){
            document.getElementById('Employee'+Selected2).style.backgroundColor="white";
            
            }
            document.getElementById(e).style.backgroundColor="#88a7ea";
            Selected2=id;
            if(Selected2!=""){
            document.getElementById('BackwardEmployee').disabled=false;
            }else{
                document.getElementById('BackwardEmployee').disabled=true;
            }
        }
        function ForwardEmployeeStatus(){
            
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'update_payroll_employee',                
                data:{id:Selected,status:'0',_token: '{{csrf_token()}}'},
                success: function(data) {
                    FetchPayrollEmployee();
                }
            })
            
        }
        function BackwardEmployeeStatus(){
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'update_payroll_employee',                
                data:{id:Selected2,status:'1',_token: '{{csrf_token()}}'},
                success: function(data) {
                    FetchPayrollEmployee();
                }
            })
            
        }
    </script>
    
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade {{($page=='1'? 'active show' : ($page==''? 'active show' : '') )}}" id="LIST" role="tabpanel" aria-labelledby="LIST-tab">
            <div class="container-fluid" style="padding-bottom:10px;">
                <div class="row">
                    <div class="col-md-8">
                        <h2 style="font-weight:bold;color:#083240;margin-top:10px;margin-bottom:0px;">LIST</h2>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" style="margin-top:10px;margin-bottom:0px;" id="SELECTPAROLL" onchange="FetchPayrollEmployee()">
                            @foreach ($unprocessed_payroll_list as $item)
                                <option value="{{$item->payroll_id}}">{{"Period : ".$item->period.", ".$item->payroll_year." ".$item->payroll_month." - ".$item->payroll_type." -- ".$item->employee_type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row" id="PayrollEmployeeListDiv">
                    <div class="col-md-6">
                        <table class="table table-bordered table-hover" style="background-color:white;margin-top:10px;">
                            <thead style="background-color:#124f62; color:white;">
                              <tr>
                                <th colspan="5" style="text-align:center;">Employee for this Payroll</th>
                                
                              </tr>
                              <tr>
                                <th width="9%"></th>
                                <th width="9%" style="text-align:center;">ID</th>
                                <th width="40%" style="text-align:center;">Name</th>
                                <th width="10%" style="text-align:center;">Status</th>
                              </tr>
                            </thead>
                            <tbody>
                                        </tbody>
                          </table>
                    </div>
                    <div class="col-md-1">
                        <table class="table borderless ">
                            <thead style="color:white;">
                              <tr>
                                <th></th>
                              </tr>
                              <tr>
                                <th width="5%" style="text-align:center;"></th>
                                
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td style="vertical-align: middle;text-align:center;"><button class="btn btn-outline-dark" id="ForwardEmployee" disabled="" onclick="ForwardEmployeeStatus()"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button></td>
                                
                              </tr> 
                              <tr>
                                <td style="vertical-align: middle;text-align:center;"><button class="btn btn-outline-dark" id="BackwardEmployee" disabled="" onclick="BackwardEmployeeStatus()"><i class="fa fa-angle-double-left" aria-hidden="true"></i></button></td>
                                
                              </tr>
                             
                            </tbody>
                          </table>
                    </div>
                    
                    <div class="col-md-5">
                            <table class="table table-bordered table-hover" style="background-color:white;margin-top:10px;">
                            <thead style="background-color:#124f62; color:white;">
                              <tr>
                                <th colspan="4" style="text-align:center;">Excluded Employee</th>
                              </tr>
                              <tr>
                                <th width="10" style="text-align:center;"></th>
                                <th width="30%" style="text-align:center;">ID</th>
                                <th width="50%" style="text-align:center;">Name</th>
                                <th width="10%" style="text-align:center;">Status</th>
                                
                              </tr>
                            </thead>
                            <tbody>
                            </tbody>
                          </table>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='2'? 'active show' : '' )}}" id="ADJUSTMENT" role="tabpanel" aria-labelledby="ADJUSTMENT-tab">
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="font-weight:bold;color:#083240;margin-top:10px;margin-bottom:0px;">ADJUSTMENT</h2>
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <script>
                    function FilterTable() {
                      // Declare variables 
                      var input, filter, table, tr, td, i, td2;
                      input = document.getElementById("EmployeeSearchID");
                      filter = input.value.toUpperCase();
                      input2 = document.getElementById("EmployeeSearchStatus");
                      filter1 = input2.value.toUpperCase();
                      input3 = document.getElementById("EmployeeSearchLname");
                      filter2 = input3.value.toUpperCase();
                      input4 = document.getElementById("EmployeeSearchFname");
                      filter3 = input4.value.toUpperCase();
                      table = document.getElementById("TableAdjEMp");
                      tr = table.getElementsByTagName("tr");

                      // Loop through all table rows, and hide those who don't match the search query
                      for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[1];
                        td1 = tr[i].getElementsByTagName("td")[7];
                        td2 = tr[i].getElementsByTagName("td")[2];
                        td3 = tr[i].getElementsByTagName("td")[3];
                        
                        if (td || td2 || td1 || td3) {
                            console.log(td.innerHTML.toUpperCase().indexOf(filter)+" "+td1.innerHTML.toUpperCase().indexOf(filter1)+" "+td2.innerHTML.toUpperCase().indexOf(filter2)+" "+td3.innerHTML.toUpperCase().indexOf(filter3));
                          if (td.innerHTML.toUpperCase().indexOf(filter) > -1 && td1.innerHTML.toUpperCase().indexOf(filter1) > -1 && td2.innerHTML.toUpperCase().indexOf(filter2) > -1 && td3.innerHTML.toUpperCase().indexOf(filter3) > -1) {
                            tr[i].style.display = "";
                            
                          } else {
                            tr[i].style.display = "none";
                          }
                        } 
                      }

                    }
                    function DeleteEmpAdj(e){
                        
                        $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'disable_employee_saary_adjustment',                
                        data:{id:e,_token: '{{csrf_token()}}'},
                        success: function(data) {
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Updated Employee Salary Adjustment',
                            
                            }).then((result) => {
                                location.href="employee?page=2";
                            })
                        }  
                        }) 
                    }
                    function EditEmpAdj(e,last,first,middle){
                       
                        $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'get_employee_data',                
                        data:{id:e,_token: '{{csrf_token()}}'},
                        success: function(data) {
                            document.getElementById("ModalHeaderEmployeeNameEdit").innerHTML=last+", "+first+" "+middle;
                            document.getElementById("EmpAdjSalaryIDEdit").value=e;
                            document.getElementById("EmpAdjNameEdit").value=data['employee_adjustment_name'];
                            document.getElementById("EmpAdjCodeEdit").value=data['employee_adjustment_code'];
                            document.getElementById("EmpAdjAmountEdit").value=data['employee_adjustment_amount'];
                            document.getElementById("EmpAdjAdjTypeEdit").value=data['employee_adjustment_type'];
                            document.getElementById("EmpAdjAppliedBeforeEdit").value=data['employee_adjustment_apply_before'];
                            document.getElementById("EmpAdjTaxableEdit").value=data['employee_adjustment_taxable'];
                            document.getElementById("EmpAdjRemarksEdit").value=data['employee_adjustment_remarks'];
                            $("#EditEmpAdjAdjustment").modal('show');
                        }  
                        }) 
                    }
                    </script>
                    <div class="col-md-5">
                        <table class="table borderless table-sm" style="background-color:white;border:1px solid #ccc;">
                            <thead style="background-color:#124f62; color:white;">
                              <tr>
                                <th colspan="4">Search Employee</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td style="color:#083240;">ID</td>
                                <td><input type="text" class="form-control" id="EmployeeSearchID" onkeyup="FilterTable()"></td>
                                <td style="color:#083240;">Employee Status</td>
                                <td>
                                    <select class="form-control" id="EmployeeSearchStatus" onchange="FilterTable()">
                                        <option>Active</option>
                                        <option>Inactive</option>
                                        <option>On Leave</option>
                                        <option>Resigned/Terminated</option>
                                        <option>Probationary</option>
                                        <option>Contractual</option>
                                        <option>End Of Contract</option>
                                        <option>Part Time(Hourly)</option>
                                        <option>Part Time(Daily)</option>
                                        <option>Part Time(Monthly)</option>
                                        <option>Suspension</option>
                                        <option>Maternity</option>
                                        <option>Paternity</option>
                                    </select>
                                </td>
                              </tr>
                              <tr>
                                <td style="color:#083240;">Last Name</td>
                                <td><input type="text" class="form-control" id="EmployeeSearchLname" onkeyup="FilterTable()"></td>
                                <td style="color:#083240;">First Name</td>
                                <td><input type="text" class="form-control" id="EmployeeSearchFname" onkeyup="FilterTable()"></td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
					<div id="MassAdjustmentModal" class="modal fade" role="dialog">
					  <div class="modal-dialog modal-sm">

						<!-- Modal content-->
						<div class="modal-content">
						  <div class="modal-header">
                              <h5 class="modal-title">Upload Adjustment</h5>
							<button type="button" class="close" data-dismiss="modal">×</button>
							
						  </div>
						  <div class="modal-body" style="text-align:center;">
							
							<select class="form-control" id="SELECTPAROLLIMPORT">
                                @foreach ($unprocessed_payroll_list as $item)
                                    <option value="{{$item->payroll_id}}">{{"Period : ".$item->period.", ".$item->payroll_year." ".$item->payroll_month." - ".$item->payroll_type." -- ".$item->employee_type}}</option>
                                @endforeach
							</select>
							<br>
							<input id="excel-upload-adjustment" type="file" style="display:none;" onchange="ImportAdjustment()" name="excelimportadjustment" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
							<label for="excel-upload-adjustment" style="opacity:1;cursor:pointer;width:100%;" id="FIleImportExcelLabelCCC" class="custom-excel-upload btn btn-primary">
								IMPORT ADJUSTMENT
							</label>
						  </div>
						  <div class="modal-footer">
							<a href="downloadexceltemplate_adjustment"  class="btn btn-outline-dark" onclick="DownloadTemplateAdjustment()">Download Template</a>
							
							<script>
                                function ImportAdjustment(){
                                
                                    start_spinner();
                                    var file = $('#excel-upload-adjustment')[0].files[0]
                                    var fd = new FormData();
                                    fd.append('theFile', file);
                                    fd.append('payroll_id', document.getElementById('SELECTPAROLLIMPORT').value);
                                    fd.append('_token','{{csrf_token()}}');
                                    $.ajax({
                                        url: 'UploadMassAdjustment',
                                        type: 'POST',
                                        processData: false,
                                        contentType: false,
                                        data: fd,
                                        dataType:"json",
                                        success: function (data, status, jqxhr) {
                                            var LOG="";
                                            if(data.Error_Log!=""){
                                            LOG=" \n\nSkip Log : \n"+data.Error_Log;
                                            }
                                            alert("Total number Of Data : "+data.Total+"\nData Saved : "+data.Success+" \nData Skipped : "+data.Skiped+LOG);
                                            document.getElementById("excel-upload-adjustment").value = "";
                                            console.log("asdada : "+data.Extra);
                                            stop_spinner();
                                            Swal.fire({
                                            type: 'success',
                                            title: 'Success',
                                            text: 'Successfully Added Employee Adjustments',
                                            }).then((result) => {
                                                location.href="employee?page=2";
                                            })
                                            
                                        },
                                        error: function (jqxhr, status, msg) {
                                            alert(jqxhr.status +" message"+msg+" status:"+status);
                                            alert(jqxhr.responseText);
                                            stop_spinner();
                                        }
                                    });
                                    document.getElementById("excel-upload-adjustment").value = "";
                                }
                                function DownloadTemplateAdjustment(){
                                    
                                }
							</script>
						  </div>
						</div>
					  </div>
					</div>
						<div class="col-md-12">
							<table class="table table-bordered table-sm" id="TableAdjEMp" style="background-color:white;">
								<thead style="background-color:#124f62; color:white;">
								  <tr>
									<th colspan="9">
									<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#MassAdjustmentModal">Upload Adjustment</button>
									</th>
								  </tr>
								  <tr>
									<th></th>
									
									<th>ID</th>
									<th>Last Name</th>
									<th>First Name</th>
									<th>Adjustment Name</th>
									<th>Amount</th>
									<th>Date of Transaction</th>
									<th>Employment Status</th>
									
									<th></th>
								  </tr>
								</thead>
								<tbody>
                                    @if (empty($employee_adjustment_list))  
                                        <tr>
                                            <td colspan="10" style="vertical-align:middle;text-align:center;"></td>
                                        </tr>
                                    @else
                                        @foreach ($employee_adjustment_list as $item)
                                        <tr>
                                        <td><button type="button" onclick="EditEmpAdj('{{$item->employee_adjustment_id}}','{{ucwords(strtolower($item->lname))}}','{{ucwords(strtolower($item->fname))}}','{{ucwords(strtolower($item->mname))}}')" class="btn btn-link">Edit</button></td>
                                        
                                        <td >{{$item->employee_adjustment_emp_id}}</td>
                                        <td >{{ucwords(strtolower($item->lname))}}</td>
                                        <td >{{ucwords(strtolower($item->fname))}}</td>
                                        <td >{{$item->employee_adjustment_name}}</td>
                                        <td >{{number_format($item->employee_adjustment_amount,2)}}</td>
                                        <td >
                                            <?php $datetrans=""; ?>
                                            @foreach ($employee_salary_list as $payroll)
                                                @if ($payroll->salary_id==$item->employee_adjustment_payroll_id)
                                                <?php $datetrans=$payroll->transaction_date; ?>
                                                @endif
                                            @endforeach
                                            {{date('m-d-Y',strtotime($datetrans))}}</td>
                                        <td >{{$item->employment_status}}</td>
                                        <td><button type="button" onclick="DeleteEmpAdj('{{$item->employee_adjustment_id}}')" class="btn btn-link">Delete</button></td>
                                        </tr>   
                                        @endforeach
                                    @endif
                                    
								</tbody>
							</table>
						</div>
					</div>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='3'? 'active show' : '' )}}" id="ATTENDANCE" role="tabpanel" aria-labelledby="ATTENDANCE-tab">
            <div class="container-fluid" style="padding-bottom:10px;">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="font-weight:bold;color:#083240;margin-top:10px;margin-bottom:0px;">IMPORT ATTENDANCE</h2>
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    
                    <div class="col-md-12">
                        <script>
                        function Import_From_Device(){
                            start_spinner();
                            $.ajax({
                                type: 'POST',
                                url: 'extra/attendance/zklib/index.php',                
                                data: {Selected:"",_token: '{{csrf_token()}}'},
                             success: function(data) {
                                
                                if (data.indexOf('Not Connected') > -1) {
                                alert('No Device Connected');
                                stop_spinner();
                                } else {
                                    stop_spinner();
                                    console.log('Reloading');
                                    location.href = "employee?page=3";
                                }
                             }  
                            })
                        }
                        </script>
                        <button class="btn btn-primary" style="border-radius:10px;" onclick="Import_From_Device()"><i class="fa fa-tasks" aria-hidden="true"></i> IMPORT FROM DEVICE</button>
                        <button class="btn btn-primary" style="border-radius:10px;" data-toggle="modal" data-target="#importAttendanceModal"><i class="fa fa-file-excel-o" aria-hidden="true"></i> IMPORT FROM EXCEL</button>
                        
                    </div>
                </div>
                <div class="row" style="margin-top:10px;">
                    <div class="col-md-12">
                        <table class="table table-bordered table-sm" style="background-color:white;">
                            <thead style="background-color:#124f62; color:white;">
                              <tr>
                                <th>Biometrics ID</th>
                                <th>Company ID</th>
                                <th>Name</th>
                                <th>Total Attendance</th>
                                <th>Total Absent</th>
                                <th>Total Overtime</th>
                                <th>Total Undertime</th>
                              </tr>
                            </thead>
                            <tbody>
                            @foreach ($attendance_computed_list as $data)
                                <tr>
                                    <td style="vertical-align:middle;">{{$data[0]}}</td>
                                    <td style="vertical-align:middle;">{{$data[1]}}</td>
                                    <td style="vertical-align:middle;">{{$data[2]}}</td>
                                    <td style="vertical-align:middle;">{{$data[3]}}</td>
                                    <td style="vertical-align:middle;">{{$data[4]}}</td>
                                    <td style="vertical-align:middle;">{{$data[5]}}</td>
                                    <td style="vertical-align:middle;">{{$data[6]}}</td>
                                </tr>  
                            @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='4'? 'active show' : '' )}}" id="REVIEW" role="tabpanel" aria-labelledby="REVIEW-tab">
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="font-weight:bold;color:#083240;margin-top:10px;margin-bottom:0px;">REVIEW AND PROCESS</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection