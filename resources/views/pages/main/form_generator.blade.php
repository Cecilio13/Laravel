@extends('main.main')


@section('content')
<div class="container-fluid" >
<div class="col-md-8" style="background-color:white;padding-top:10px;padding-bottom:10px;">
    <div class="row">
        <div class="col-md-12" style="margin-bottom:10px;text-align:right;">
            <button class="btn btn-warning" style="color:white;" data-toggle="modal" data-target="#FormTemplateModal">Create Template</button>
        </div>
    </div>

    <div id="requiresformscript"></div>
    <form action="extra/ExportDocx/docx.php" method="POST" onsubmit="return CheckFormType()">
    <div class="row">
        <div class="col-md-12">
        <table class="table table-sm borderless" style="margin-bottom:0px;">
            <thead>
            <tr style="background-color:#124f62;color:white">
                <th colspan="2">Form Generator</th>
                
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="vertical-align:middle;">Form Type *</td>
                    <td style="vertical-align:middle;" id="CompanyTitle">Company</td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;">
                    <script>
                        function requiredFields(){
                            var FormType=document.getElementById('FormType').value;
							if(FormType!=""){
								$.ajax({
								type: 'POST',
								url: 'get_required_field_form_generator',                
								data: {id:FormType,_token: '{{csrf_token()}}'},
								success: function(data) {
									if(data[0]=='1'){
                                        document.getElementById('CompanyNameIn').required = true;
								        document.getElementById('CompanyTitle').innerHTML="Company *";
                                    }else{
                                        document.getElementById('CompanyNameIn').required = false;
								        document.getElementById('CompanyTitle').innerHTML="Company";
                                    }
                                    if(data[1]=='1'){
                                        document.getElementById('DepartmentIN').required = true;
								        document.getElementById('DepartmentTitle').innerHTML="Department *";
                                    }else{
                                        document.getElementById('DepartmentIN').required = false;
								        document.getElementById('DepartmentTitle').innerHTML="Department";
                                    }
                                    if(data[2]=='1'){
                                        document.getElementById('EmployeeIN').required = true;
								        document.getElementById('EmployeeTitle').innerHTML="Employee *";
                                    }else{
                                        document.getElementById('EmployeeIN').required = false;
								        document.getElementById('EmployeeTitle').innerHTML="Employee";
                                    }
                                    if(data[3]=='1'){
                                        document.getElementById('ReasonIN').required = true;
								        document.getElementById('ReasonTitle').innerHTML="Reason *";
                                    }else{
                                        document.getElementById('ReasonIN').required = false;
								        document.getElementById('ReasonTitle').innerHTML="Reason";
                                    }
                                    document.getElementById('FormContent').value=data[4];
								} 											 
								})
							}
                        }    
                    </script>
                    <select class="form-control" name="DocxFormType" id="FormType" onchange="requiredFields()" required="">
                        <option value="">--Select Form Type--</option>
                        @foreach ($form_templates as $item)
                            <option value="{{$item->form_template_id}}">{{$item->form_template_name}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="FormContent" id="FormContent" value="">
                    </td>
                    <td style="vertical-align:middle;">
                    <input list="company" name="companyname" id="CompanyNameIn" class="form-control" placeholder="Select Company Name">
                    <datalist id="company">
                        <option value="">
                    </option></datalist>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;" id="DepartmentTitle">Department</td>
                    <td style="vertical-align:middle;" id="EmployeeTitle">Employee</td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;">
                    <input list="department" name="departmentname" class="form-control" placeholder="Select Department" id="DepartmentIN">
                    <datalist id="department" name="DocxDepartment">
                        @foreach ($company_department as $item)
                            <option>{{$item->department_name}}</option>
                        @endforeach
                    </datalist>
                    </td>
                    <td style="vertical-align:middle;">
                    <select class="form-control" name="DocxEmployee" id="EmployeeIN">
                        <option value="">--Select Employee--</option>
                        @foreach ($employee_list as $item)
                            <option >{{$item->fname." ".$item->lname}}</option>
                        @endforeach
                    </select>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;" colspan="2" id="ReasonTitle">Reason</td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;" colspan="2"><textarea name="DocxReason" class="form-control" id="ReasonIN"></textarea></td>
                </tr>
                <tr>
                    <td style="vertical-align:middle;" colspan="2"><input type="submit" name="DownloadDocx" class="btn btn-success" value="Generate">
                    </td>
                    
                </tr>
                
            </tbody>
        </table>
        </div>
    </div>	
    </form>
</div>

</div>

@endsection