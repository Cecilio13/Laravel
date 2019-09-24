@extends('main.main')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 style="font-weight:bold;color:#083240;margin-bottom:0px;">PAYROLL</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <script>
                $(document).ready(function(){
                    ChangeViewPayroll();
                })
                function includeEmp(EmpID,PayrollID){
                    Swal.fire({
                      title: 'Enter Note:',
                      input: 'text',
                      inputAttributes: {
                        autocapitalize: 'off'
                      },
                      showCancelButton: true,
                      // animation: false,
                      // customClass: {
                      //   popup: 'animated zoomInUp'
                      // },
                      confirmButtonText: 'Proceed',
                      showLoaderOnConfirm: true,
                      preConfirm: (login) => {
                        
                      },
                      allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                      console.log(result);
                      if (result.value) {
                        $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'include_emp_salary',                
                        data:{id:PayrollID,emp_id:EmpID,reason:result.value,_token: '{{csrf_token()}}'},
                        success: function(data) {
                            $("#ViewSummaryPayrollModal").modal('toggle');
                            $("#ViewSummaryPayrollModal").on('hidden.bs.modal', function(){
                                ShowPayrollSummary(PayrollID);
                            });	
                        }
                        })
                      }
                    })
                    
                }
                function ChangeViewPayroll(){
                    var x=document.getElementById('PayrollYear').value;
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'get_payroll_list_summary',                
                        data:{year:x,_token: '{{csrf_token()}}'},
                        success: function(data) {
                            $( "#PayrollTable" ).replaceWith( data );
                        }
                    })
                }
                function UnPostPayroll(e){
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'post_payroll',                
                        data:{id:e,stat:0,_token: '{{csrf_token()}}'},
                        success: function(data) {
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Unpost Payroll',
                            
                            }).then((result) => {
                                ChangeViewPayroll();
                            })
                        }
                    })
                }
                function PostPayroll(e){
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'post_payroll',                
                        data:{id:e,stat:1,_token: '{{csrf_token()}}'},
                        success: function(data) {
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Posted Payroll',
                            
                            }).then((result) => {
                                ChangeViewPayroll();
                            })
                            
                        }
                    })
                }
                function ShowPayrollSummary(e){
                    
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'view_payroll_summary_modal',                
                        data:{id:e,_token: '{{csrf_token()}}'},
                        success: function(data) {
                                $( "#ViewSummaryPayrollModal" ).replaceWith( data );
                                $("#ViewSummaryPayrollModal").modal('show');
                        }
                    })
                    
                }
            </script>
        </div>
        <div class="col-md-2">
            <select class="form-control" id="PayrollYear" onchange="ChangeViewPayroll()">
                
                @foreach ($payroll_year_list as $item)
                    <option>{{$item->payroll_year}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row" id="PayrollTable">
        <div class="col-md-12">
            <table class="table table-bordered table-sm" style="background-color:white;margin-top:10px;">
                <thead style="background-color:#124f62; color:white;">
                  <tr>
                    
                    <th width="9%" style="text-align:center;">Year</th>
                    <th width="9%" style="text-align:center;">Month</th>
                    <th width="9%" style="text-align:center;">Period</th>
                    <th width="10%" style="text-align:center;">Type</th>
                    <th width="10%" style="text-align:center;">Employee Type</th>
                    <th width="14%" style="text-align:center;">Description</th>
                    <th width="10%" style="text-align:center;">Transaction Date</th>
                    <th width="9%" style="text-align:center;">Action</th>
                    <th width="9%" style="text-align:center;">Status</th>
                    <th width="5%" style="text-align:center;"></th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="vertical-align: middle;text-align:center;">2019</td>
                    <td style="vertical-align: middle;text-align:center;">March</td>
                    <td style="vertical-align: middle;text-align:center;">1</td>
                    <td style="vertical-align: middle;">Normal Payroll</td>
                    <td style="vertical-align: middle;text-align:center;">Both</td>
                    <td style="vertical-align: middle;"></td>
                    <td style="vertical-align: middle;text-align:center;">2019-09-30</td>
                    <td style="vertical-align: middle;text-align:center;">
                    <button type="button" onclick="PostPayroll('2019March1BothNormal Payroll')" class="btn btn-link">POST</button>                    
                    </td>
                    <td style="vertical-align: middle;text-align:center;">
                    <button class="btn btn-link">Processed</button>
                    </td>
                    <td style="vertical-align: middle;text-align:center;"><button type="button" class="btn btn-link" onclick="ShowPayrollSummary('2019March1BothNormal Payroll')">SUMMARY</button></td>
                </tr>
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection