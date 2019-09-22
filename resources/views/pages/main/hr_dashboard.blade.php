@extends('main.main')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card attendance-today-card">
                <div class="card-header text-center">
                    ATTENDANCE TODAY
                </div>
                <div class="card-body">
                    <div class="row">
                            <div class="col-md-8" style="text-align:right;">
                            <script>
                                function ChangeTodayAttendance(){
                                var x=document.getElementById('SearchDepartmenToday').value;
                                $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'get_attendance_today_by_department',                
                                data: {id:x,_token: '{{csrf_token()}}'},
                                success: function(data) {
                                    $( "#attendance_today_tbody" ).replaceWith( data );
                                }  
                                }) 
                            }
                            $(document).ready(function(){
                                ChangeTodayAttendance();
                            })
                        </script>
                        </div>
                        <div class="col-md-4">
                        <label for="SearchDepartmenToday" style="padding-bottom:4px;padding-left:0px;padding-top:3px;">Search Department:</label>
                            <select class="form-control" id="SearchDepartmenToday" onchange="ChangeTodayAttendance()">
                                @foreach ($company_department as $item)
                                    <option value="{{$item->department_id}}">{{$item->department_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table class="table table-sm table-bordered" id="AttendanceTableList" style="margin-top:10px;">
                        <thead style="color:white;background-color:#d74c45;font-weight:bold;text-align:center;">
                            <tr role="row">
                                <th width="20%" >Present</th>
                                <th width="20%">Absent</th>
                                <th width="20%">Leave</th>
                                <th width="20%">Official Business</th>
                                <th width="20%">Overtime</th>
                            </tr>
                        </thead>
                        <tbody id="attendance_today_tbody">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card resolution-center-card">
                <div class="card-header text-center">
                    RESOLUTION CENTER
                </div>
                <div class="card-body">
                    <table class="table">
						<tbody id="ResolutionCenterBody">
						<tr>												
							<td colspan="2" style="text-align:center;">No Request Found....</td>
						</tr>									
						</tbody>
					</table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card salary-card">
                <div class="card-header text-center">
                    EXCLUDED FROM SALARY PERIOD
                </div>
                <div class="card-body">
                    <table class="table" id="">
                        <thead>
                        <tr>
                            <th colspan="19">
                            <select class="form-control" id="SELECTPAROLL" style="width:40%;float:right;" onchange="FetchPayrollEmployee()">
                            </select>
                            </th>
                        </tr>
                        <tr style="">
                            <th></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody id="PayrollEmployeeListDiv">
                        </tbody>
                    </table> 
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card pending-approval-card">
                <div class="card-header text-center">
                    PENDING APPROVAL
                </div>
                <div class="card-body">
                    <table class="table">		
                        <tbody>
                            <tr>												
                                <td colspan="2" style="text-align:center;">No Request Found....</td>
                            </tr>                         
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card salary-card">
                <div class="card-header text-center">
                    INCLUDED FROM SALARY PERIOD WITH LIABILITY
                </div>
                <div class="card-body">
                    <table class="table" id="">
						<thead>
							<tr>
							<th colspan="19">
							<select class="form-control" id="SELECTPAROLL22" style="width:40%;float:right;" onchange="FetchPayrollEmployee2()">
							</select>
							</th>
							</tr>
							<tr style="">
							<th></th>
							<th>ID</th>
							<th>Name</th>
							<th>Status</th>
							</tr>
						</thead>
						<tbody id="PayrollEmployeeListDiv">
						
							
                        </tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection