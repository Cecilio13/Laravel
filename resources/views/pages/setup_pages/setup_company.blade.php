@extends('main.main_setup')


@section('content')
<div class="container-fluid" >
    <ul class="nav nav-tabs nav-tab-custom"   role="tablist">
        <li class="nav-item" >
            <a class="nav-link {{($page=='1'? 'active' : ($page==''? 'active' : '') )}}" id="home-tab" data-toggle="tab" href="#PROFILE" role="tab" aria-controls="home" aria-selected="true">Profile</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link {{($page=='2'? 'active' : '' )}}" id="profile-tab" data-toggle="tab" href="#BANKS" role="tab" aria-controls="profile" aria-selected="false">Banks</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='3'? 'active' : '' )}}" id="contact-tab" data-toggle="tab" href="#COSTCENTER" role="tab" aria-controls="contact" aria-selected="false">Cost Center</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='4'? 'active' : '' )}}" id="contact-tab" data-toggle="tab" href="#DEPARTMENT" role="tab" aria-controls="contact" aria-selected="false">Department</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent" style="margin-bottom:10px;">
        <div class="tab-pane fade  {{($page=='1'? 'active show' : ($page==''? 'active show' : '') )}}" id="PROFILE" role="tabpanel" aria-labelledby="home-tab">
            <h2 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">BASIC INFORMATION</h2>
            <!-- Basic Info-->
            <script>
                $(document).ready(function(){
                    // $("#Company_Setup_Form").submit(function(e) {
                    //     e.preventDefault();
                    //     $.ajax({
                    //     type: 'POST',
                    //     headers: {
                    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    //     },
                    //     url: 'update_company_setup_data',                
                    //     data: $('#Company_Setup_Form').serialize(),
                    //     success: function(data) {
                    //         console.log(data);
                    //     }  

                    //     })
                    // });
                    $("#Company_Bank_Form").submit(function(e) {
                        e.preventDefault();
                        $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'update_company_bank_data',                
                        data: $('#Company_Bank_Form').serialize(),
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Added Bank',
                            
                            }).then((result) => {
                                location.href="setup_company?page=2";
                            })

                        }  

                        })
                    });
                    $("#New_Cost_Center_Form").submit(function(e) {
                        e.preventDefault();
                        $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'update_company_cost_center_data',                
                        data: $('#New_Cost_Center_Form').serialize(),
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Added Cost Center',
                            
                            }).then((result) => {
                                location.href="setup_company?page=3";
                            })

                        }  

                        })
                    });
                    $("#Department_New_Form").submit(function(e) {
                        e.preventDefault();
                        $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'update_company_department_data',                
                        data: $('#Department_New_Form').serialize(),
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Added Department',
                            
                            }).then((result) => {
                                location.href="setup_company?page=4";
                            })

                        }  

                        })
                    });
                    
                });
                function deletebank(id){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.value) {
                            $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'delete_bank_data',                
                            data: {id:id,_token: '{{csrf_token()}}'},
                                                    
                            success: function(data) {
                                
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Deleted Bank',
                                
                                }).then((result) => {
                                    location.href="setup_company?page=2";
                                })
                            }  
                            })
                            
                        }
                    })
                }
                function deletecostcenter(id){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.value) {
                            $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'delete_cost_center_data',                
                            data: {id:id,_token: '{{csrf_token()}}'},
                                                    
                            success: function(data) {
                                
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Deleted Cost Center',
                                
                                }).then((result) => {
                                    location.href="setup_company?page=3";
                                })
                            }  
                            })
                            
                        }
                    })
                }
                function deletedepartment(id){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.value) {
                            $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'delete_department_data',                
                            data: {id:id,_token: '{{csrf_token()}}'},
                                                    
                            success: function(data) {
                                
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Deleted Department',
                                
                                }).then((result) => {
                                    location.href="setup_company?page=4";
                                })
                            }  
                            })
                            
                        }
                    })
                }
                function edit_bank(id){
                    $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'get_bank_data',                
                    data: {id:id,_token: '{{csrf_token()}}'},
                                            
                    success: function(data) {
                        document.getElementById('editbanktitle').innerHTML=data['bank_name'];
                        document.getElementById('editbankid').value=data['company_bank_id'];
                        document.getElementById('editbankname').value=data['bank_name'];
                        document.getElementById('editbankcode').value=data['bank_code'];
                        document.getElementById('editbankaccountnumber').value=data['account_number'];
                        document.getElementById('editbankcompanycode').value=data['company_code'];
                        document.getElementById('editbankpresentingoffice').value=data['presenting_office'];
                        document.getElementById('editbank_remark').value=data['bank_remarks'];
                        $('#editbankmodal').modal('show');
                    }  
                    })
                }
                function edit_costcenter(id){
                    $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'get_costcenter_data',                
                    data: {id:id,_token: '{{csrf_token()}}'},
                                            
                    success: function(data) {
                        document.getElementById('editcostcentertitle').innerHTML=data['cost_center_name'];
                        document.getElementById('editcostcenterid').value=data['cost_center_id'];
                        document.getElementById('editcostcentername').value=data['cost_center_name'];
                        document.getElementById('editcostcentercode').value=data['cost_center_code'];
                        document.getElementById('editcostcenter_remark').value=data['cost_center_remarks'];
                        $('#editcostcentermodal').modal('show');
                    }  
                    })
                }
                function edit_department(id){
                    $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'get_department_data',                
                    data: {id:id,_token: '{{csrf_token()}}'},
                                            
                    success: function(data) {
                        document.getElementById('editdepartmenttitle').innerHTML=data['department_name'];
                        document.getElementById('editdepartmentid').value=data['department_id'];
                        document.getElementById('editdepartmentname').value=data['department_name'];
                        document.getElementById('editdepartmentcode').value=data['department_code'];
                        document.getElementById('editdepartment_remark').value=data['department_remarks'];
                        $('#editdepartmentmodal').modal('show');
                    }  
                    })
                }
            </script>
            <form autocomplete="off" id="Company_Setup_Form" enctype="multipart/form-data" action="update_company_setup_data" method="POST">
                {{ csrf_field() }}
                <div class="container-fluid" >
                    <div class="row">
                        <div class="col-md-6 col-left">
                            <div class="form-group">
                                <label for="company_logo">Company Logo</label>
                                <input type="file" class="form-control-file" id="company_logo" name="company_logo">
                            </div>
                        </div>
                        <div class="col-md-6  col-right">
                            <div class="form-group">
                                <label for="FAX">Fax</label>
                                <input type="text" class="form-control" id="FAX" name="FAX" aria-describedby="emailHelp" value="{{!empty($company_info)? $company_info->fax : ''}}" placeholder="Enter FAX">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-left">
                            <div class="form-group">
                                <label for="Company_Name">Company Name</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)? $company_info->companyname : ''}}" id="Company_Name"  name="Company_Name" aria-describedby="emailHelp" placeholder="Enter Company Name">
                            </div>
                        </div>
                        <div class="col-md-6  col-right">
                            <div class="form-group">
                                <label for="TIN">TIN</label>
                                <input type="text" class="form-control" value="{{ !empty($company_info)? $company_info->tin_number : ''}}" id="TIN" name="TIN" aria-describedby="emailHelp" placeholder="Enter TIN">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <div class="form-group">
                                <label for="NatureOfBusiness">Nature of Business</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)? $company_info->natureofbusiness :'' }}" id="NatureOfBusiness" name="NatureOfBusiness" aria-describedby="emailHelp" placeholder="Enter Nature of Business">
                            </div>
                        </div>
                        <div class="col-md-6  col-right">
                            <div class="form-group">
                                <label for="SSS">SSS</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)? $company_info->sss_number : ''}}" id="SSS" name="SSS" aria-describedby="emailHelp" placeholder="Enter SSS">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <div class="form-group">
                                <label for="Address1">Address 1</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)? $company_info->address1 :''}}" id="Address1" name="Address1" aria-describedby="emailHelp" placeholder="Enter Address 1">
                            </div>
                        </div>
                        <div class="col-md-6  col-right">
                            <div class="form-group">
                                <label for="PhilHealth">PhilHealth</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)? $company_info->philhealth_number : ''}}" id="PhilHealth" name="PhilHealth" aria-describedby="emailHelp" placeholder="Enter PhilHealth">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <div class="form-group">
                                <label for="Address2">Address 2</label>
                                <input type="text" class="form-control" value="{{ !empty($company_info)? $company_info->address2 : ''}}" id="Address2" name="Address2" aria-describedby="emailHelp" placeholder="Enter Address 2">
                            </div>
                        </div>
                        <div class="col-md-6  col-right">
                            <div class="form-group">
                                <label for="HDMF">HDMF</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)? $company_info->hdmf :''}}" id="HDMF" name="HDMF" aria-describedby="emailHelp" placeholder="Enter HDMF">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <div class="form-group">
                                <label for="ZIP">ZIP Code</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)?$company_info->zipcode:''}}" id="ZIP" name="ZIP" aria-describedby="emailHelp" placeholder="Enter Zip Code">
                            </div>
                        </div>
                        <div class="col-md-3 col-right col-left">
                            <div class="form-group">
                                <label for="AdminSignatory">Admin Signatory</label>
                                <input type="text" class="form-control" id="AdminSignatory" value="{{!empty($company_info)?$company_info->admin_signatory_name : ''}}" name="AdminSignatory" aria-describedby="emailHelp" placeholder="Enter Admin Signatory">
                            </div>
                        </div>
                        <div class="col-md-3  col-right">
                            <div class="form-group" style="">
                                <label for="AdminPosition" style="color:#fff">.</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)? $company_info->admin_signatory_position : ''}}" id="AdminPosition" name="AdminPosition" aria-describedby="emailHelp" placeholder="Enter Position">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <div class="form-group">
                                <label for="RDO">RDO</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)? $company_info->rdo : ''}}" id="RDO" name="RDO" aria-describedby="emailHelp" placeholder="Enter RDO">
                            </div>
                        </div>
                        <div class="col-md-3  col-left col-right">
                            <div class="form-group">
                                <label for="HRSignatory">HR Signatory</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)? $company_info->hr_signatory_name : ''}}" id="HRSignatory" name="HRSignatory" aria-describedby="emailHelp" placeholder="Enter HR Signatory">
                            </div>
                        </div>
                        <div class="col-md-3  col-right">
                            <div class="form-group" style="">
                                <label for="HRPosition" style="color:#fff">.</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)? $company_info->hr_signatory_position : ''}}" id="HRPosition" name="HRPosition" aria-describedby="emailHelp" placeholder="Enter Position">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <div class="form-group">
                                <label for="Email">Email</label>
                                <input type="email" class="form-control" value="{{!empty($company_info)? $company_info->email : ''}}" id="Email" name="Email" aria-describedby="emailHelp" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="col-md-3  col-right col-left">
                            <div class="form-group">
                                <label for="FinanceSignatory">Finance Signatory</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)? $company_info->finance_signatory_name: ''}}" id="FinanceSignatory" name="FinanceSignatory" aria-describedby="emailHelp" placeholder="Enter Finance Signatory">
                            </div>
                        </div>
                        <div class="col-md-3  col-right">
                            <div class="form-group" style="">
                                <label for="FinancePosition" style="color:#fff">.</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)? $company_info->finance_signatory_position : ''}}" id="FinancePosition" name="FinancePosition" aria-describedby="emailHelp" placeholder="Enter Position">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-left">
                            <div class="form-group ">
                                <label for="Phone">Phone</label>
                                <input type="text" class="form-control" value="{{!empty($company_info)? $company_info->phone : ''}}" id="Phone" name="Phone" aria-describedby="emailHelp" placeholder="Enter Phone">
                            </div>
                        </div>
                        <div class="col-md-6  col-right">
                            <div class="form-group">
                                <label for="ESIG">E-Signatory</label>
                                <input type="file" class="form-control-file" id="ESIG" name="ESIG">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="text-align:right;">
                                <input type="submit" value="Save" name="Submit_Company_basic" class="btn btn-primary">
                                <input type="Reset" value="Reset" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
            <!-- Basic Info End-->
            
        </div>
        <div class="tab-pane fade {{($page=='2'? 'active show' : '' )}}" id="BANKS" role="tabpanel" aria-labelledby="profile-tab">
            <h2 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">ADD NEW BANK</h2>
            <div class="container-fluid" >
            <form id="Company_Bank_Form">
                    {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 col-left">
                        <div class="form-group ">
                            <label for="BankName">Name</label>
                            <input type="text" class="form-control" name="BankBankName" required aria-describedby="emailHelp" placeholder="Enter Bank Name">
                        </div>
                    </div>
                    <div class="col-md-6  col-right">
                        <div class="form-group ">
                            <label for="CompanyCode">Company Code</label>
                            <input type="text" class="form-control" name="BankCompanyCode" required aria-describedby="emailHelp" placeholder="Enter Company Code">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-left">
                        <div class="form-group ">
                            <label for="BankCode">Code</label>
                            <input type="text" class="form-control" required name="BankBankCode" aria-describedby="emailHelp" placeholder="Enter Bank Code">
                        </div>
                    </div>
                    <div class="col-md-6  col-right">
                        <div class="form-group ">
                            <label for="PresentingOffice">Presenting Office</label>
                            <input type="text" class="form-control" required name="BankPresentingOffice" aria-describedby="emailHelp" placeholder="Enter Presenting Office">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-left">
                        <div class="form-group ">
                            <label for="AccountNumber">Account Number</label>
                            <input type="text" class="form-control" required name="BankAccountNumber" aria-describedby="emailHelp" placeholder="Enter Bank Code">
                        </div>
                    </div>
                    <div class="col-md-6  col-right">
                        <div class="form-group ">
                            <label for="Remarks">Remarks</label>
                            <textarea class="form-control"  name="BankRemarks" aria-describedby="emailHelp" rows="3" placeholder="Enter Remarks"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="text-align:right;">
                            <input type="submit" name="SaveBank" value="Save" class="btn btn-primary">
                            <input type="Reset" value="Reset" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="container-fluid" style="padding-bottom:10px;">
                <h2 style="margin-top:10px;font-weight:bold;">BANKS</h2>
                <table class="table table-bordered table-setup">
                    <thead>
                    <tr>
                        <th width="10%"></th>
                        <th width="30%">Name</th>
                        <th width="15%">Code</th>
                        <th width="30%">Remarks</th>
                        <th width="15%"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($company_bank))
                        <tr>
                            <td colspan="5" style="text-align:center;">No Bank Added</td>
                        </tr>
                    @else
                        @if (1==2)
                            <tr>
                                <td colspan="5" style="text-align:center;">No Bank Added</td>
                            </tr>
                        @else
                            @foreach ($company_bank as $bank)
                                @if ($bank->data_status=="1")
                                <tr>
                                    <td style="text-align:center;"><button class="btn btn-success"  onclick="edit_bank('{{$bank->company_bank_id}}')"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button></td>
                                    <td>{{$bank->bank_name}}</td>
                                    <td>{{$bank->bank_code}}</td>
                                    <td>{{$bank->bank_remarks}}</td>
                                    <td style="text-align:center;"><button class="btn btn-danger" onclick="deletebank('{{$bank->company_bank_id}}')"><i class="fa fa-times" aria-hidden="true"></i> Delete</button></td>
                                </tr>   
                                @endif
                                
                            @endforeach 
                        @endif
                        
                    @endif
                    
                </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='3'? 'active show' : '' )}}" id="COSTCENTER" role="tabpanel" aria-labelledby="contact-tab">
            <h2 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">ADD NEW COST CENTER</h2>
            <div class="container-fluid" >
            <form id="New_Cost_Center_Form">
                 {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 col-left">
                        
                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <div class="form-group " >
                                <label for="CostCenterName">Name</label>
                                <input type="text" class="form-control" name="CostCenterName" aria-describedby="emailHelp" placeholder="Enter Cost Center Name">
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <div class="form-group " style="margin-top:10px;">
                                <label for="CostCenterCode">Code</label>
                                <input type="text" class="form-control" name="CostCenterCode" aria-describedby="emailHelp" placeholder="Enter Cost Center Code">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6  col-right">
                        <div class="form-group ">
                            <label for="CostCenterRemarks">Remarks</label>
                            <textarea class="form-control" name="CostCenterRemarks" aria-describedby="emailHelp" rows="5" placeholder="Enter Remarks"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="text-align:right;">
                            <input type="submit" value="Save" name="CostCenterSave" class="btn btn-primary">
                            <input type="Reset" value="Reset" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="container-fluid" style="padding-bottom:10px;">
                <h2 style="margin-top:10px;font-weight:bold;">COST CENTERS</h2>
                <table class="table table-bordered table-setup">
                    <thead>
                    <tr>
                        <th width="10%"></th>
                        <th width="30%">Name</th>
                        <th width="15%">Code</th>
                        <th width="30%">Remarks</th>
                        <th width="15%"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($company_cost_center))
                        <tr>
                            <td colspan="5" style="text-align:center;">No Cost Center Added</td>
                        </tr>
                    @else
                        @if (1==2)
                            <tr>
                                <td colspan="5" style="text-align:center;">No Cost Center Added</td>
                            </tr>
                        @else
                            @foreach ($company_cost_center as $bank)
                                @if ($bank->data_status=="1")
                                <tr>
                                    <td style="text-align:center;"><button class="btn btn-success" onclick="edit_costcenter('{{$bank->cost_center_id}}')"><i class="fa fa-pencil" aria-hidden="true" ></i> Edit</button></td>
                                    <td>{{$bank->cost_center_name}}</td>
                                    <td>{{$bank->cost_center_code}}</td>
                                    <td>{{$bank->cost_center_remarks}}</td>
                                    <td style="text-align:center;"><button class="btn btn-danger" onclick="deletecostcenter('{{$bank->cost_center_id}}')"><i class="fa fa-times" aria-hidden="true"></i> Delete</button></td>
                                </tr>
                                @endif
                            @endforeach
                        @endif
                    @endif
                </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='4'? 'active show' : '' )}}" id="DEPARTMENT" role="tabpanel" aria-labelledby="contact-tab">
            <h2 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">ADD NEW DEPARTMENT</h2>
            <div class="container-fluid" >
            <form id="Department_New_Form">
                    {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 col-left">
                        
                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <div class="form-group " >
                                <label for="DepartmentName">Name</label>
                                <input type="text" class="form-control" name="DepartmentName" aria-describedby="emailHelp" placeholder="Enter Department Name">
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-left:0px;padding-right:0px;">
                            <div class="form-group " style="margin-top:10px;">
                                <label for="DepartmentCode">Code</label>
                                <input type="text" class="form-control" name="DepartmentCode" aria-describedby="emailHelp" placeholder="Enter Department Code">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6  col-right">
                        <div class="form-group ">
                            <label for="DepartmentRemarks">Remarks</label>
                            <textarea class="form-control" name="DepartmentRemarks" aria-describedby="emailHelp" rows="5" placeholder="Enter Remarks"></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" style="text-align:right;">
                            <input type="submit" value="Save" class="btn btn-primary">
                            <input type="Reset" value="Reset" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
            </div>
            <div class="container-fluid" style="padding-bottom:10px;">
                <h2 style="margin-top:10px;font-weight:bold;">DEPARTMENTS</h2>
                <table class="table table-bordered table-setup">
                    <thead>
                    <tr>
                        <th width="10%"></th>
                        <th width="30%">Name</th>
                        <th width="15%">Code</th>
                        <th width="30%">Remarks</th>
                        <th width="15%"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (empty($company_department))
                        <tr>
                            <td colspan="5" style="text-align:center;">No Department Added</td>
                        </tr>
                    @else
                        @if (1==2)
                            <tr>
                                <td colspan="5" style="text-align:center;">No Department Added</td>
                            </tr>
                        @else
                            @foreach ($company_department as $bank)
                                @if ($bank->data_status=="1")
                                <tr>
                                    <td style="text-align:center;"><button class="btn btn-success" onclick="edit_department('{{$bank->department_id}}')"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button></td>
                                    <td>{{$bank->department_name}}</td>
                                    <td>{{$bank->department_code}}</td>
                                    <td>{{$bank->department_remarks}}</td>
                                    <td style="text-align:center;"><button class="btn btn-danger" onclick="deletedepartment('{{$bank->department_id}}')"><i class="fa fa-times" aria-hidden="true"></i> Delete</button></td>
                                </tr>
                                @endif
                            @endforeach
                        @endif
                    @endif
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection