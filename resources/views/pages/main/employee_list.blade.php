@extends('main.main')


@section('content')
<div class="col-md-12 col-xs-12">

    <script>
    $(document).ready(function() {
        var table = $('#employee_list_table').DataTable( {
            
        } );
        for(var c=8;c<=26;c++){
			var column = table.column( c );
			column.visible( ! column.visible() );
		}
        document.getElementById('employee_list_table').style.width="100%";
        $('button.toggle-vis').on( 'click', function (e) {
            e.preventDefault();
    
            // Get the column API object
            var column = table.column( $(this).attr('data-column') );
			if(column.visible()){
			$(this).css('background-color', '#007bff');		
			$(this).css('border-color', '#007bff');		
				
			}else{
			$(this).css('background-color', '#28a745');	
			$(this).css('border-color', '#28a745');	
			}
            // Toggle the visibility
            column.visible( ! column.visible() );
            document.getElementById('employee_list_table').style.width="100%";
        } );
    } );
    
    </script>
    
    <h2 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;">EMPLOYEE LIST 
        <button style="float:right;" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#importEmployeeModal">
        Import Employee From Excel
        </button>
    </h2>
    
    
    <table class="table " style="background-color:white;">
			<thead style="background-color:#124f62; color:white;">
				<tr>
					<th>Custom Select Columns</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
					<div style="margin-bottom:10px;">
					<button type="button" class="toggle-vis btn btn-success btn-sm" data-column="0" style="display:none;">System ID</button>
					<button type="button" class="toggle-vis btn btn-success btn-sm" data-column="1">Company ID</button>
					<button type="button" class="toggle-vis btn btn-success btn-sm" data-column="2">First Name</button>
					<button type="button" class="toggle-vis btn btn-success btn-sm" data-column="3">Last Name</button>
					<button type="button" class="toggle-vis btn btn-success btn-sm" data-column="4">Birth Date</button>
					<button type="button" class="toggle-vis btn btn-success btn-sm" data-column="5">Position</button>
					<button type="button" class="toggle-vis btn btn-success btn-sm" data-column="6">Department</button>
					<button type="button" class="toggle-vis btn btn-success btn-sm" data-column="7">Email</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="8" >Civil Status</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="9">Gender</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="10">Address</button>
					<button type="button" style="display:none;" class="toggle-vis btn btn-primary btn-sm" data-column="11">Username</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="12">Basic Salary</button>
					
					</div>
					<div style="margin-bottom:10px;">
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="13">ECOLA</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="14">Deminimis</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="15">Cash</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="16">Meal</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="17">Mobile</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="18">Employee Type</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="19">Status</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="20">TIN</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="21">SSS</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="22">PhilHealth</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="23">HDMF</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="24">PRC</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="25">Passport</button>
					<button type="button" class="toggle-vis btn btn-primary btn-sm" data-column="26">Biometrics ID</button>
					</div>
					</td>
				</tr>
			</tbody>
		</table>
    <table class="table table-bordered table-sm" style="background-color:white;" id="employee_list_table">
        <thead style="background-color:#124f62; color:white;">
		<tr>
            
            <th style="display:none;"></th>
            <th>Company ID</th>
            <th >First Name</th>
            <th>Last Name</th>
            <th>Birth Date</th>
            <th>Position</th>
            <th>Department</th>
            <th>Email</th>
            <th>Civil Status</th>
            <th>Gender</th>
            <th>Address</th>
            <th>Username</th>
            <th>Basic Salary</th>
            <th>ECOLA</th>
            <th>Deminimis</th>
            <th>Cash</th>
            <th>Meal</th>
            <th>Mobile</th>
            <th>Employee Type</th>
            <th>Status</th>
            <th>TIN</th>
            <th>SSS</th>
            <th>PhilHealth</th>
            <th>HDMF</th>
            <th>PRC</th>
            <th>Passport</th>
            <th>Biometrics ID</th>
        </tr>
		</thead>
        <tbody>
            @foreach ($employee_list as $emp)
               <tr>
                    <td style="display:none;">{{$emp->employee_id}}</td>
                    <td><a href="view_employee?id={{$emp->employee_id}}">{{$emp->company_id}}</a></td>
                    <td>{{$emp->fname}}</td>
                    <td>{{$emp->lname}}</td>
                    <td>{{date('m-d-Y',strtotime($emp->date_of_birth))}}</td>
                    <td>{{$emp->position}}</td>
                    <td>{{$emp->department_name}}</td>
                    <td>
                        @foreach ($employee_email_list as $em)
                            @if ($emp->employee_id==$em->emp_id)
                                @if ($em->type=="Primary")
                                    {{$em->email}}
                                    <?php break;?> 
                                @else
                                    {{$em->email}}
                                    <?php break;?> 
                                @endif
                                
                            @endif
                        @endforeach
                        
                    </td>
                    <td>{{$emp->civil_status}}</td>
                    <td>{{$emp->gender}}</td>
                    <td>{{$emp->address}}</td>
                    <td>{{$emp->username}}</td>
                    <td>{{$emp->basic_salary!=''? number_format($emp->basic_salary,2) : ''}}</td>
                    <td>{{$emp->ecola}}</td>
                    <td>{{$emp->deminimis_total}}</td>
                    <td>{{$emp->cash_allowance!=''? number_format($emp->cash_allowance,2) : ''}}</td>
                    <td>{{$emp->meal_allowance!=''? number_format($emp->meal_allowance,2) : ''}}</td>
                    <td>{{$emp->mobile_allowance!=''? number_format($emp->mobile_allowance,2) : ''}}</td>
                    <td>{{$emp->employee_type}}</td>
                    <td>{{$emp->employment_status}}</td>
                    <td>{{$emp->tin_number}}</td>
                    <td>{{$emp->sss_number}}</td>
                    <td>{{$emp->philhealth_number}}</td>
                    <td>{{$emp->hdmf_number}}</td>
                    <td>{{$emp->prc_license}}</td>
                    <td>{{$emp->passport}}</td>
                    <td>{{$emp->biometrics_id}}</td>
                </tr> 
            @endforeach
            
        </tbody>
    </table>

</div>
@endsection