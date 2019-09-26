@extends('main.main')


@section('content')
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12 form-inline" >
            <div style="text-align:right;width:100%;">
                <form action="" method="get">
                    <select class="form-control selectpicker" id="employee_search_input" name="id" data-live-search="true">
                            <option value="">--Select Employee--</option>
                        @foreach ($HR_hr_employee_info as $item)
                            <option value="{{$item->employee_id}}" {{$id!=''? ($id==$item->employee_id? 'Selected' : '') : ''}}>{{$item->fname." ".$item->lname}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
                
            </div>
        </div>
    </div>
    <br>
    <ul class="nav nav-tabs nav-tab-custom"   role="tablist">
        <li class="nav-item" >
            <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#BasicInfoTab" role="tab" aria-controls="home" aria-selected="true">Basic Information</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#ContactInfoTab" role="tab" aria-controls="profile" aria-selected="false">Contact Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="education-tab" data-toggle="tab" href="#EducationTab" role="tab" aria-controls="contact" aria-selected="false">Education</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="salary-tab" data-toggle="tab" href="#SalaryandAdvanceTab" role="tab" aria-controls="contact" aria-selected="false">Salary And Advance</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link" id="work-tab" data-toggle="tab" href="#WorkTab" role="tab" aria-controls="home" aria-selected="true">Work</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link" id="documents-tab" data-toggle="tab" href="#DocumentsTab" role="tab" aria-controls="profile" aria-selected="false">Documents</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="govt-tab" data-toggle="tab" href="#GovtInfoTab" role="tab" aria-controls="contact" aria-selected="false">Gov't Information</a>
        </li>
        <li class="nav-item" style="display:none;">
            <a class="nav-link" id="access-tab" data-toggle="tab" href="#AccessLevelTab" role="tab" aria-controls="contact" aria-selected="false">Access Level</a>
        </li>
        
    </ul>
    <script>
    $(document).ready(function(){
        $("#update_employee_form :input").prop("disabled", true);
    });
    function go_basic_info_page(){
        $('#basic-tab').click();
        start_spinner();
        setTimeout(function (){
            stop_spinner();
            $('#save_add_employee_info').click();
        }, 1000);
        

    }
    function enableformedit(){
        $("#update_employee_form :input").prop("disabled", false);
    }
    </script>
    @if (Session::get('result_data'))
        <script>
            Swal.fire({
            type: 'success',
            title: 'Success',
            text: 'Successfully Added Employee Data',
            })
        </script>
    @endif
    <form id="update_employee_form" enctype="multipart/form-data" action="update_employee_data" method="POST" autocomplete="off">
        {{ csrf_field() }}
    <div class="tab-content" id="AddEmployeeTabContent">
        <div class="tab-pane fade show active" id="BasicInfoTab" role="tabpanel" aria-labelledby="home-tab">
        <h4 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">BASIC INFORMATION <a class="btn btn-success btn-sm" onclick="enableformedit()" style="float:right;{{$id!=''? '' : 'display:none;'}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></h4>
            <div class="container-fluid" style="padding-bottom:10px;">
                <div class="row">
                    <div class="col-md-3">
                        <div style="text-align:center" class="row">
                            <div class="col-md-12">
                                <img src="{{!empty($emp_info)? ($emp_info->photofilename!=""? asset('storage/employee_photo/'.$emp_info->photofilename) : 'images/noimage.png') : 'images/noimage.png'}}" id="PhotoPreview"  style="width:75%;">
                            </div>
                        </div>
                        <div style="text-align:center" class="row">
                            <div class="col-md-12">
                                <style>
                                
								#ImgUpp{
									display: none;
								}
								
                                </style>
                                <label for="ImgUpp" class="custom-file-upload" style="margin-top:10px;">
                                    <i class="fa fa-cloud-upload"></i> Select Image
                                </label>
                                <input type="file" name="ImgUpp" id="ImgUpp">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="EmpBIOID" >Company ID</label>
                                    <input type="text" class="form-control" id="EmpBIOID" name="EmpBIOID" value="{{!empty($emp_info)?$emp_info->company_id : ''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="BiometricsID" >Biometrics ID</label>
                                    <input type="text" id="BiometricsID" class="form-control" name="BiometricsID" value="{{!empty($emp_info)?$emp_info->biometrics_id : ''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="margin-bottom:0px;display:none;">
                                    <label for="EmpID" >System ID</label>
                                    <input type="text" class="form-control" name="EmpID" id="EmpID" readonly="" value="{{!empty($emp_info)?$emp_info->employee_id : ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                          <div class="form-group">
                            <label for="FName" >First Name</label>
                            <input type="text" class="form-control" style="text-transform: capitalize;" name="FName" required="" value="{{!empty($emp_info)?$emp_info->fname : ''}}">
                          </div>
                            </div>
                            <div class="col-md-4">
                          <div class="form-group">
                            <label for="MName" >Middle Name</label>
                            <input type="text" class="form-control" style="text-transform: capitalize;" name="MName" value="{{!empty($emp_info)?$emp_info->mname : ''}}">
                          </div>
                            </div>
                            <div class="col-md-4">
                          <div class="form-group">
                            <label for="LName">Last Name</label>
                            <input type="text" class="form-control" style="text-transform: capitalize;" name="LName" required="" value="{{!empty($emp_info)?$emp_info->lname : ''}}">
                          </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                          <div class="form-group">
                            <label for="Gender" >Gender</label>
                            <select class="form-control" name="Gender">
                                <option {{!empty($emp_info)? ($emp_info->gender=="Male"? 'Selected' : '' ) : ''}}>Male</option>
                                <option {{!empty($emp_info)? ($emp_info->gender=="Female"? 'Selected' : '' ) : ''}}>Female</option>
                                
                              </select>
                          </div>
                            </div>
                            <div class="col-md-4">
                          <div class="form-group">
                            <label for="CS">Civil Status</label>
                            <select class="form-control" name="CS">
                                <option {{!empty($emp_info)? ($emp_info->civil_status=="Single"? 'Selected' : '' ) : ''}}>Single</option>
                                <option {{!empty($emp_info)? ($emp_info->civil_status=="Married"? 'Selected' : '' ) : ''}}>Married</option>
                                <option {{!empty($emp_info)? ($emp_info->civil_status=="Widowed"? 'Selected' : '' ) : ''}}>Widowed</option>
                                <option {{!empty($emp_info)? ($emp_info->civil_status=="Divorced"? 'Selected' : '' ) : ''}}>Divorced</option>
                                <option {{!empty($emp_info)? ($emp_info->civil_status=="Seperated"? 'Selected' : '' ) : ''}}>Seperated</option>
                            </select>
                          </div>
                            </div>
                            <div class="col-md-4">
                          <div class="form-group">
                            <label for="DATE">Date of Birth</label>
                            <input type="date" class="form-control" name="DATE" required="" value="{{!empty($emp_info)?$emp_info->date_of_birth : ''}}">
                          </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="Gender" >Address</label>
                                <textarea class="form-control" name="EmpAddress">{{!empty($emp_info)?$emp_info->address : ''}}</textarea>
                              </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="DATE" style="display:none;">Username</label>
                                <input type="text" style="display:none;" class="form-control" name="EmpUsername" autocomplete="false" id="USERNAME" placeholder="Requires more than 4 characters..." onkeyup="CheckUsername()"  value="{{!empty($emp_info)?$emp_info->username : ''}}" autocomplete="emp_username">
                                <script>
                                    function CheckUsername(){

                                    }
                                </script>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="DATE" style="display:none;">New Password</label>
                                <input type="password" class="form-control" min="4" name="EmpPassword" placeholder="Password" title="No Special Character. e.g. {=!#}" onkeypress="return checkSpcialChar(event)" style="display:none;"  value="" autocomplete="emp_password">
                              </div>
                              
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="DATE" style="display:none;">Confirm Password</label>
                                <input type="password" class="form-control" min="4" name="EmpPasswordConfirm" placeholder="Enter Old Password to change Password" title="No Special Character. e.g. {=!#}" style="display:none;" onkeypress="return checkSpcialChar(event)"  value="" autocomplete="emp_confirm_password">
                              </div>
                              
                            </div>
                            <div class="col-md-4" style="display:none">
                              <div class="form-group">
                                <label for="DATE" >Lock User</label>
                                <select class="form-control" name="EmpLockUser">
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                                </select>
                              </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="ContactInfoTab" role="tabpanel" aria-labelledby="profile-tab">
            <h4 style="color:white;background-color:#124f62;padding:10px;margin-top:0px;">Emergency Contact Number</h4>
            
            <table class="table" style="margin-bottom:0px;">
            <thead style="color:#124f62;">
                <tr>
                <th></th>
                <th>Phone Number</th>
                <th>Contact Person</th>
                <th>Relationship</th>
                <th>Address</th>
                    
                </tr>
            </thead>
                <tbody>
                    <tr>
                    <td><b>Contact #1</b><input type="hidden" name="emergency_contact_id1" value="{{count($emp_emergency_contact)!=0?$emp_emergency_contact[0]->emergency_contact_id : ''}}"></td>
                    <td width="22%"><input type="text" class="form-control" name="PhoneNumber1" value="{{count($emp_emergency_contact)!=0?$emp_emergency_contact[0]->phone_number : ''}}"></td>
                    <td width="24%"><input type="text" class="form-control" name="ContactPerson1" value="{{count($emp_emergency_contact)!=0?$emp_emergency_contact[0]->contact_person : ''}}"></td>
                    <td width="22%"><input type="text" class="form-control" name="Relation1" value="{{count($emp_emergency_contact)!=0?$emp_emergency_contact[0]->relationship : ''}}"></td>
                    <td width="22%"><input type="text" class="form-control" name="AddressContact1" value="{{count($emp_emergency_contact)!=0?$emp_emergency_contact[0]->address : ''}}"></td>
                    </tr>
                    <tr>
                    <td><b>Contact #2</b><input type="hidden" name="emergency_contact_id2" value="{{count($emp_emergency_contact)!=0?$emp_emergency_contact[1]->emergency_contact_id : ''}}"></td>
                    <td width="22%"><input type="text" class="form-control" name="PhoneNumber2" value="{{count($emp_emergency_contact)!=0?$emp_emergency_contact[1]->phone_number : ''}}"></td>
                    <td width="24%"><input type="text" class="form-control" name="ContactPerson2" value="{{count($emp_emergency_contact)!=0?$emp_emergency_contact[1]->contact_person : ''}}"></td>
                    <td width="22%"><input type="text" class="form-control" name="Relation2" value="{{count($emp_emergency_contact)!=0?$emp_emergency_contact[1]->relationship : ''}}"></td>
                    <td width="22%"><input type="text" class="form-control" name="AddressContact2" value="{{count($emp_emergency_contact)!=0?$emp_emergency_contact[1]->address : ''}}"></td>
                    </tr>
                </tbody>
            </table>
             
             <h4 style="color:white;background-color:#124f62;padding:10px;">Alternate Contact Number</h4>
            
            <table class="table" style="margin-bottom:0px;">
                <thead style="color:#124f62;">
                    <tr>
                    <th></th>
                    <th>Type</th>
                    <th>Phone Number</th>
                    <th>Contact Person</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td><b>Alt Contact #1</b><input type="hidden" name="alt_contact_id1" value="{{count($emp_alt_contact)!=0?$emp_alt_contact[0]->alternate_contact_id : ''}}"></td>
                    <td width="30%"><input type="text" class="form-control" name="AltTypeContact1" value="{{count($emp_alt_contact)!=0?$emp_alt_contact[0]->type : ''}}"></td>
                    <td width="30%"><input type="text" class="form-control" name="AltPhoneContact1" value="{{count($emp_alt_contact)!=0?$emp_alt_contact[0]->phone_number : ''}}"></td>
                    <td width="35%"><input type="text" class="form-control" name="AltPersonContact1" value="{{count($emp_alt_contact)!=0?$emp_alt_contact[0]->contact_person : ''}}"></td>
                    </tr>
                    <tr>
                    <td width="15%"><b>Alt Contact #2</b><input type="hidden" name="alt_contact_id2" value="{{count($emp_alt_contact)!=0?$emp_alt_contact[1]->alternate_contact_id : ''}}"></td>
                    <td width="30%"><input type="text" class="form-control" name="AltTypeContact2" value="{{count($emp_alt_contact)!=0?$emp_alt_contact[1]->type : ''}}"></td>
                    <td width="30%"><input type="text" class="form-control" name="AltPhoneContact2" value="{{count($emp_alt_contact)!=0?$emp_alt_contact[1]->phone_number : ''}}"></td>
                    <td width="35%"><input type="text" class="form-control" name="AltPersonContact2" value="{{count($emp_alt_contact)!=0?$emp_alt_contact[1]->contact_person : ''}}"></td>
                    </tr>
                </tbody>
            </table>
            <h4 style="color:white;background-color:#124f62;padding:10px;">Email Address</h4>
            
            <table class="table" style="margin-bottom:0px;">
                <thead style="color:#124f62;">
                    <tr>
                    <th></th>
                    <th>Email</th>
                    <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td><b>Email #1</b></td>
                    <td width="50%"><input type="text" class="form-control" name="Emailnumber1" value="{{count($emp_email_address)!=0? ($emp_email_address[0]->type=="Primary"? $emp_email_address[0]->email  : '') : ''}}"></td>
                    <td width="20%">
                        <input type="hidden" name="EmailID1" value="{{count($emp_email_address)!=0? ($emp_email_address[0]->type=="Primary"? $emp_email_address[0]->email_address_id  : '') : ''}}">
                        <select class="form-control" name="EmailType1">
                            <option>Primary</option>
                        </select>
                    </td>
                    <td width="20%"></td>
                    </tr>
                    <tr>
                    <td><b>Email #2</b></td>
                    <td width="50%"><input type="text" class="form-control" name="Emailnumber2" value="{{count($emp_email_address)!=0? ($emp_email_address[1]->type=="Secondary"? $emp_email_address[1]->email  : '') : ''}}"></td>
                    <td width="20%">
                        <input type="hidden" name="EmailID2" value="{{count($emp_email_address)!=0? ($emp_email_address[1]->type=="Secondary"? $emp_email_address[1]->email_address_id  : '') : ''}}">
                        <select class="form-control" name="EmailType2">
                            <option>Secondary</option>
                        </select>
                    </td>
                    <td width="20%"></td>
                    </tr>
                </tbody>
            </table>  
        </div>
        <div class="tab-pane fade" id="EducationTab" role="tabpanel" aria-labelledby="contact-tab">
            <h4 style="margin-bottom:0px;padding:10px;margin-top:0px;margin-bottom:10px;font-weight:bold;background-color:#124f62;color:white;">Education</h4>
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <button type="button" class="btn btn-success btn-sm" onclick="AddEDUCBG()">Add Educational Background</button>
                            <br>
                            <table class="table" style="background-color:white;margin-bottom:10px;margin-top:5px;">
                                <thead style="background-color:#124f62;color:white">
                                  <tr>
                                    
                                    <th>Educational Type</th>
                                    <th>School</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Degree</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody id="EDUCTableBody">
                                    <script>
                                        var EducBGCount=1;
                                        function AddEDUCBG(){
                                            EducBGCount++;
                                            document.getElementById('SchoolFieldCountid').value=EducBGCount;
                                            var t = document.getElementById('EDUCTableBody');
                                            var tr = document.createElement("tr");
                                            tr.setAttribute("id", "EducationTableRow"+EducBGCount);
                                            var td1 = document.createElement("td"); 
                                            var td2 = document.createElement("td"); 
                                            var td3 = document.createElement("td"); 
                                            var td4 = document.createElement("td"); 
                                            var td5 = document.createElement("td"); 
                                            var td6 = document.createElement("td"); 
                                            
                                            var x1 = document.createElement("SELECT");
                                            var x2 = document.createElement("INPUT");
                                            var x3 = document.createElement("INPUT");
                                            var x4 = document.createElement("INPUT");
                                            var x5 = document.createElement("INPUT");
                                            var x6 = document.createElement("button");
                                            var x7 = document.createElement("INPUT");
                                            
                                            x1.setAttribute("name", "EDUCType"+EducBGCount);
                                            x1.setAttribute("id", "EDUCType"+EducBGCount);
                                            x1.setAttribute("class", "form-control");
                                            
                                            var z = document.createElement("option");
                                            z.innerHTML="Primary";
                                            x1.appendChild(z);
                                            var z2 = document.createElement("option");
                                            z2.innerHTML="Secondary";
                                            x1.appendChild(z2);
                                            var z3 = document.createElement("option");
                                            z3.innerHTML="Tertiary";
                                            x1.appendChild(z3);
                                            
                                            
                                            x2.setAttribute("type", "text");
                                            
                                            x2.setAttribute("name", "SCHOOL"+EducBGCount);
                                            x2.setAttribute("id", "SCHOOL"+EducBGCount);
                                            x2.setAttribute("placeholder", "School...");
                                            x2.setAttribute("class", "form-control");
                                            
                                            x3.setAttribute("type", "text");
                                            
                                            x3.setAttribute("name", "FROM"+EducBGCount);
                                            x3.setAttribute("id", "FROM"+EducBGCount);
                                            x3.setAttribute("placeholder", "School Date Start...");
                                            x3.setAttribute("class", "form-control");
                                            
                                            x4.setAttribute("type", "text");
                                            
                                            x4.setAttribute("name", "TO"+EducBGCount);
                                            x4.setAttribute("id", "TO"+EducBGCount);
                                            x4.setAttribute("placeholder", "School Date End...");
                                            x4.setAttribute("class", "form-control");
                                            
                                            x5.setAttribute("type", "text");
                                            
                                            x5.setAttribute("name", "DEGREE"+EducBGCount);
                                            x5.setAttribute("id", "DEGREE"+EducBGCount);
                                            x5.setAttribute("placeholder", "School Degree...");
                                            x5.setAttribute("class", "form-control");
                                            
                                            x6.setAttribute("type", "button");
                                            x6.setAttribute("class", "btn btn-danger btn-sm");
                                            x6.setAttribute("id", "DeleteBTNEDUC"+EducBGCount);
                                            x6.setAttribute("onclick", "DeleteEDUCBGG("+EducBGCount+")");
                                            x6.innerHTML="Delete";

                                            x7.setAttribute("type", "hidden");
                                            x7.setAttribute("name", "EDUCHIDDEN"+EducBGCount);
                                            x7.setAttribute("id", "EDUCHIDDEN"+EducBGCount);
                                            
                                            td1.appendChild(x1);
                                            td2.appendChild(x2);
                                            td3.appendChild(x3);
                                            td4.appendChild(x4);
                                            td5.appendChild(x5);
                                            td6.appendChild(x6);
                                            td6.appendChild(x7);
                                            
                                            tr.appendChild(td1);
                                            tr.appendChild(td2);
                                            tr.appendChild(td3);
                                            tr.appendChild(td4);
                                            tr.appendChild(td5);
                                            tr.appendChild(td6);
                                            t.appendChild(tr);
                                            var deduc=EducBGCount-1;
                                            if(deduc!='1'){
                                                document.getElementById('DeleteBTNEDUC'+deduc).style.display="none";
                                            }
                                            
                                            
                                        }
                                        function DeleteEDUCBGG(e){
                                            var t = document.getElementById('EDUCTableBody');
                                            var tr = document.getElementById("EducationTableRow"+e);
                                            t.removeChild(tr);
                                            EducBGCount--;
                                            document.getElementById('SchoolFieldCountid').value=EducBGCount;
                                            if(EducBGCount!='1'){
                                                document.getElementById('DeleteBTNEDUC'+EducBGCount).style.display="inline";
                                            }
                                            
                                            
                                        }
                                    </script>
                                  <tr>
                                    <input type="hidden" id="SchoolFieldCountid" name="SchoolFieldCount" value="1">
                                    <td width="15%">
                                        <select class="form-control" name="EDUCType1">
                                            <option {{(count($emp_educ)!=0? ($emp_educ[0]->type=="Primary"? 'Selected' : '')  : '' )}}>Primary</option>
                                            <option {{(count($emp_educ)!=0? ($emp_educ[0]->type=="Secondary"? 'Selected' : '')  : '' )}}>Secondary</option>
                                            <option {{(count($emp_educ)!=0? ($emp_educ[0]->type=="Tertiary"? 'Selected' : '')  : '' )}}>Tertiary</option>
                                            
                                        </select>
                                    </td>
                                    <td width="20%"><input value="{{count($emp_educ)!=0? $emp_educ[0]->school_name : '' }}" type="text" placeholder="School..." class="form-control" name="SCHOOL1"></td>
                                    <td width="20%"><input value="{{count($emp_educ)!=0? $emp_educ[0]->study_from : '' }}" type="text" placeholder="School Date Start..." class="form-control" name="FROM1"></td>
                                    <td width="15%"><input value="{{count($emp_educ)!=0? $emp_educ[0]->study_to : '' }}" type="text" placeholder="School Date End..." class="form-control" name="TO1"></td>
                                    <td width="20%"><input value="{{count($emp_educ)!=0? $emp_educ[0]->degree : '' }}" type="text" placeholder="School Degree..." class="form-control" name="DEGREE1"></td>
                                    <td width="10%"><input type="hidden" name="EDUCHIDDEN1" value="{{count($emp_educ)!=0? $emp_educ[0]->educ_bg_id : '' }}"></td>
                                  </tr>
                                  
                                 
                                </tbody>
                              </table>  
                                @for ($i = 1; $i < count($emp_educ); $i++)
                                    <script>
                                        AddEDUCBG()
                                        $(document).ready(function(){
                                            document.getElementById('EDUCType{{$i+1}}').value="{{$emp_educ[$i]->type}}";
                                            document.getElementById('SCHOOL{{$i+1}}').value="{{$emp_educ[$i]->school_name}}";
                                            document.getElementById('FROM{{$i+1}}').value="{{$emp_educ[$i]->study_from}}";
                                            document.getElementById('TO{{$i+1}}').value="{{$emp_educ[$i]->study_to}}";
                                            document.getElementById('DEGREE{{$i+1}}').value="{{$emp_educ[$i]->degree}}";
                                            document.getElementById('EDUCHIDDEN{{$i+1}}').value="{{$emp_educ[$i]->educ_bg_id}}";
                                            
                                        });
                                        
                                    </script>

                                @endfor
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <button type="button" class="btn btn-success btn-sm" onclick="AddTraining()">Add Training</button>
                            <br>
                            <table class="table" style="margin-bottom:10px;margin-top:5px;background-color:white;">
                                <thead style="background-color:#124f62;color:white">
                                  <tr>
                                    
                                    <th>Training Date</th>
                                    <th>Training Name</th>
                                    <th>Instructor/Institution</th>
                                    <th>Nature of Training</th>
                                    <th>Training Cost</th>
                                    <th>Returning Service Period</th>
                                    <th>Corresponding Amount</th>
                                    <th>Training Note</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody id="TrainingTableBody">
                                <script>
                                        var TrainingBGCount=1;
                                        function AddTraining(){
                                            TrainingBGCount++;
                                            document.getElementById('TrainingFieldCountid').value=TrainingBGCount;
                                            var t = document.getElementById('TrainingTableBody');
                                            var tr = document.createElement("tr");
                                            tr.setAttribute("id", "TrainingTableRow"+TrainingBGCount);
                                            var td1 = document.createElement("td"); 
                                            var td2 = document.createElement("td"); 
                                            var td3 = document.createElement("td"); 
                                            var td4 = document.createElement("td"); 
                                            var td5 = document.createElement("td"); 
                                            var td6 = document.createElement("td"); 
                                            var td7 = document.createElement("td"); 
                                            var td8 = document.createElement("td"); 
                                            var td9 = document.createElement("td"); 
                                            
                                            var x1 = document.createElement("INPUT");
                                            var x2 = document.createElement("INPUT");
                                            var x3 = document.createElement("INPUT");
                                            var x4 = document.createElement("INPUT");
                                            var x5 = document.createElement("INPUT");
                                            var x6 = document.createElement("INPUT");
                                            var x7 = document.createElement("INPUT");
                                            var x8 = document.createElement("INPUT");
                                            var x9 = document.createElement("button");
                                            var x10 = document.createElement("INPUT");
                                            
                                            x1.setAttribute("type", "date");
                                            x1.setAttribute("name", "TrainingDate"+TrainingBGCount);
                                            x1.setAttribute("id", "TrainingDate"+TrainingBGCount);
                                            x1.setAttribute("placeholder", "Training Date...");
                                            x1.setAttribute("class", "form-control");
                                            
                                            x2.setAttribute("type", "text");
                                            x2.setAttribute("name", "TrainingName"+TrainingBGCount);
                                            x2.setAttribute("id", "TrainingName"+TrainingBGCount);
                                            x2.setAttribute("placeholder", "Training Name...");
                                            x2.setAttribute("class", "form-control");
                                            
                                            x3.setAttribute("type", "text");
                                            x3.setAttribute("name", "Instructor"+TrainingBGCount);
                                            x3.setAttribute("id", "Instructor"+TrainingBGCount);
                                            x3.setAttribute("placeholder", "Instructor...");
                                            x3.setAttribute("class", "form-control");
                                            
                                            x4.setAttribute("type", "text");
                                            x4.setAttribute("name", "Nature"+TrainingBGCount);
                                            x4.setAttribute("id", "Nature"+TrainingBGCount);
                                            x4.setAttribute("placeholder", "Nature of Training...");
                                            x4.setAttribute("class", "form-control");
                                            
                                            x5.setAttribute("type", "text");
                                            x5.setAttribute("name", "TrainingCost"+TrainingBGCount);
                                            x5.setAttribute("id", "TrainingCost"+TrainingBGCount);
                                            x5.setAttribute("placeholder", "Training Cost...");
                                            x5.setAttribute("class", "form-control");
                                            
                                            x6.setAttribute("type", "date");
                                            x6.setAttribute("name", "Returning"+TrainingBGCount);
                                            x6.setAttribute("id", "Returning"+TrainingBGCount);
                                            x6.setAttribute("placeholder", "Returning Service Period...");
                                            x6.setAttribute("class", "form-control");
                                            
                                            x7.setAttribute("type", "text");
                                            x7.setAttribute("name", "Corresponding"+TrainingBGCount);
                                            x7.setAttribute("id", "Corresponding"+TrainingBGCount);
                                            x7.setAttribute("placeholder", "Corresponding Amount...");
                                            x7.setAttribute("class", "form-control");
                                            
                                            x8.setAttribute("type", "text");
                                            x8.setAttribute("name", "Note"+TrainingBGCount);
                                            x8.setAttribute("id", "Note"+TrainingBGCount);
                                            x8.setAttribute("placeholder", "Training Note...");
                                            x8.setAttribute("class", "form-control");
                                            
                                            x9.setAttribute("type", "button");
                                            x9.setAttribute("class", "btn btn-danger btn-sm");
                                            x9.setAttribute("id", "DeleteBtnTraining"+TrainingBGCount);
                                            x9.setAttribute("onclick", "DeleteTraining("+TrainingBGCount+")");
                                            x9.innerHTML="Delete";
                                            
                                            x10.setAttribute("type", "hidden");
                                            x10.setAttribute("name", "TrainingHidden"+TrainingBGCount);
                                            x10.setAttribute("id", "TrainingHidden"+TrainingBGCount);

                                            td1.appendChild(x1);
                                            td2.appendChild(x2);
                                            td3.appendChild(x3);
                                            td4.appendChild(x4);
                                            td5.appendChild(x5);
                                            td6.appendChild(x6);
                                            td7.appendChild(x7);
                                            td8.appendChild(x8);
                                            td9.appendChild(x9);
                                            td9.appendChild(x10);
                                            
                                            tr.appendChild(td1);
                                            tr.appendChild(td2);
                                            tr.appendChild(td3);
                                            tr.appendChild(td4);
                                            tr.appendChild(td5);
                                            tr.appendChild(td6);
                                            tr.appendChild(td7);
                                            tr.appendChild(td8);
                                            tr.appendChild(td9);
                                            t.appendChild(tr);
                                            var deduc2=TrainingBGCount-1;
                                            if(deduc2!='1'){
                                                document.getElementById('DeleteBtnTraining'+deduc2).style.display="none";
                                            }
                                            
                                            
                                        }
                                        function DeleteTraining(e){
                                            var t = document.getElementById('TrainingTableBody');
                                            var tr = document.getElementById("TrainingTableRow"+e);
                                            t.removeChild(tr);
                                            TrainingBGCount--;
                                            document.getElementById('TrainingFieldCountid').value=TrainingBGCount;
                                            if(TrainingBGCount!='1'){
                                                document.getElementById('DeleteBtnTraining'+TrainingBGCount).style.display="inline";
                                            }
                                            
                                            
                                        }
                                    </script>
                                    <input type="hidden" id="TrainingFieldCountid" name="TrainingFieldCount" value="1">
                                    <tr>
                                    <td width="10%"><input value="{{count($emp_trainer)!=0? $emp_trainer[0]->training_date  : '' }}" type="date" placeholder="Training Date..." class="form-control" name="TrainingDate1"></td>
                                    <td width="12%"><input value="{{count($emp_trainer)!=0? $emp_trainer[0]->training_name  : '123123' }}" type="text" placeholder="Training Name..." class="form-control" name="TrainingName1"></td>
                                    <td width="12%"><input value="{{count($emp_trainer)!=0? $emp_trainer[0]->instructor  : '' }}" type="text" placeholder="Instructor..." class="form-control" name="Instructor1"></td>
                                    <td width="12%"><input value="{{count($emp_trainer)!=0? $emp_trainer[0]->training_nature  : '' }}" type="text" placeholder="Nature of Training..." class="form-control" name="Nature1"></td>
                                    <td width="12%"><input value="{{count($emp_trainer)!=0? $emp_trainer[0]->training_cost  : '' }}" type="text" placeholder="Training Cost..." class="form-control" name="TrainingCost1"></td>
                                    <td width="12%"><input value="{{count($emp_trainer)!=0? $emp_trainer[0]->training_returningserviceperiod  : '' }}" type="date" placeholder="Returning Service Period..." class="form-control" name="Returning1"></td>
                                    <td width="12%"><input value="{{count($emp_trainer)!=0? $emp_trainer[0]->correspondingamount  : '' }}" type="text" placeholder="Corresponding Amount..." class="form-control" name="Corresponding1"></td>
                                    <td width="12%"><input value="{{count($emp_trainer)!=0? $emp_trainer[0]->training_note  : '' }}" type="text" placeholder="Training Note..." class="form-control" name="Note1"></td>
                                    <td><input type="hidden" name="TrainingHidden1" value="{{count($emp_trainer)!=0? $emp_trainer[0]->training_id  : '' }}"></td>
                                    </tr>
                                </tbody>
                              </table>
                                @for ($i = 1; $i < count($emp_trainer); $i++)
                                    <script>
                                        AddTraining()
                                        $(document).ready(function(){
                                            document.getElementById('TrainingDate{{$i+1}}').value="{{$emp_trainer[$i]->training_date}}";
                                            document.getElementById('TrainingName{{$i+1}}').value="{{$emp_trainer[$i]->training_name}}";
                                            document.getElementById('Instructor{{$i+1}}').value="{{$emp_trainer[$i]->instructor}}";
                                            document.getElementById('Nature{{$i+1}}').value="{{$emp_trainer[$i]->training_nature}}";
                                            document.getElementById('TrainingCost{{$i+1}}').value="{{$emp_trainer[$i]->training_cost}}";
                                            document.getElementById('Returning{{$i+1}}').value="{{$emp_trainer[$i]->training_returningserviceperiod}}";
                                            document.getElementById('Corresponding{{$i+1}}').value="{{$emp_trainer[$i]->correspondingamount}}";
                                            document.getElementById('Note{{$i+1}}').value="{{$emp_trainer[$i]->training_note}}";
                                            document.getElementById('TrainingHidden{{$i+1}}').value="{{$emp_trainer[$i]->training_id}}";
                                        });
                                        
                                    </script>

                                @endfor
                                 
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                     <button type="button" class="btn btn-success btn-sm" type="button" onclick="AddSeminar()">Add Seminar</button>
                     <br>
                    <table class="table" style="margin-bottom:10px;margin-top:5px;background-color:white;">
                            <thead style="background-color:#124f62;color:white">
                              <tr>
                                
                                <th>Seminar Date</th>
                                <th>Seminar Name</th>
                                <th>Instructor/Institution</th>
                                <th>Nature of Seminar</th>
                                <th>Seminar Cost</th>
                                <th>Returning Service Period</th>
                                <th>Corresponding Amount</th>
                                <th>Seminar Note</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="SeminarTableBody">
                            <script>
                                    var SeminarBGCount=1;
                                    function AddSeminar(){
                                        SeminarBGCount++;
                                        document.getElementById('SeminarFieldCountid').value=SeminarBGCount;
                                        var t = document.getElementById('SeminarTableBody');
                                        var tr = document.createElement("tr");
                                        tr.setAttribute("id", "SemtableRow"+SeminarBGCount);
                                        var td1 = document.createElement("td"); 
                                        var td2 = document.createElement("td"); 
                                        var td3 = document.createElement("td"); 
                                        var td4 = document.createElement("td"); 
                                        var td5 = document.createElement("td"); 
                                        var td6 = document.createElement("td"); 
                                        var td7 = document.createElement("td"); 
                                        var td8 = document.createElement("td"); 
                                        var td9 = document.createElement("td"); 
                                        
                                        var x1 = document.createElement("INPUT");
                                        var x2 = document.createElement("INPUT");
                                        var x3 = document.createElement("INPUT");
                                        var x4 = document.createElement("INPUT");
                                        var x5 = document.createElement("INPUT");
                                        var x6 = document.createElement("INPUT");
                                        var x7 = document.createElement("INPUT");
                                        var x8 = document.createElement("INPUT");
                                        var x9 = document.createElement("button");
                                        var x10 = document.createElement("INPUT");
                                        
                                        x1.setAttribute("type", "date");
                                        x1.setAttribute("name", "SDate"+SeminarBGCount);
                                        x1.setAttribute("id", "SDate"+SeminarBGCount);
                                        x1.setAttribute("placeholder", "Seminar Date...");
                                        x1.setAttribute("class", "form-control");
                                        
                                        x2.setAttribute("type", "text");
                                        x2.setAttribute("name", "SName"+SeminarBGCount);
                                        x2.setAttribute("id", "SName"+SeminarBGCount);
                                        x2.setAttribute("placeholder", "Seminar Name...");
                                        x2.setAttribute("class", "form-control");
                                        
                                        x3.setAttribute("type", "text");
                                        x3.setAttribute("name", "SIns"+SeminarBGCount);
                                        x3.setAttribute("id", "SIns"+SeminarBGCount);
                                        x3.setAttribute("placeholder", "Instructor...");
                                        x3.setAttribute("class", "form-control");
                                        
                                        x4.setAttribute("type", "text");
                                        x4.setAttribute("name", "SNature"+SeminarBGCount);
                                        x4.setAttribute("id", "SNature"+SeminarBGCount);
                                        x4.setAttribute("placeholder", "Nature of Seminar...");
                                        x4.setAttribute("class", "form-control");
                                        
                                        x5.setAttribute("type", "text");
                                        x5.setAttribute("name", "SCost"+SeminarBGCount);
                                        x5.setAttribute("id", "SCost"+SeminarBGCount);
                                        x5.setAttribute("placeholder", "Seminar Cost...");
                                        x5.setAttribute("class", "form-control");
                                        
                                        x6.setAttribute("type", "date");
                                        x6.setAttribute("name", "SReturning"+SeminarBGCount);
                                        x6.setAttribute("id", "SReturning"+SeminarBGCount);
                                        x6.setAttribute("placeholder", "Returning Service Period...");
                                        x6.setAttribute("class", "form-control");
                                        
                                        x7.setAttribute("type", "text");
                                        x7.setAttribute("name", "SCorresponding"+SeminarBGCount);
                                        x7.setAttribute("id", "SCorresponding"+SeminarBGCount);
                                        x7.setAttribute("placeholder", "Corresponding Amount...");
                                        x7.setAttribute("class", "form-control");
                                        
                                        x8.setAttribute("type", "text");
                                        x8.setAttribute("name", "SNote"+SeminarBGCount);
                                        x8.setAttribute("id", "SNote"+SeminarBGCount);
                                        x8.setAttribute("placeholder", "Seminar Note...");
                                        x8.setAttribute("class", "form-control");
                                        
                                        x9.setAttribute("type", "button");
                                        x9.setAttribute("class", "btn btn-danger btn-sm");
                                        x9.setAttribute("id", "DeleteBTNSeminar"+SeminarBGCount);
                                        x9.setAttribute("onclick", "DeleteSeminar("+SeminarBGCount+")");
                                        x9.innerHTML="Delete";
                                        

                                        x10.setAttribute("type", "hidden");
                                        x10.setAttribute("name", "SEMINARHIDDEN"+SeminarBGCount);
                                        x10.setAttribute("id", "SEMINARHIDDEN"+SeminarBGCount);

                                        td1.appendChild(x1);
                                        td2.appendChild(x2);
                                        td3.appendChild(x3);
                                        td4.appendChild(x4);
                                        td5.appendChild(x5);
                                        td6.appendChild(x6);
                                        td7.appendChild(x7);
                                        td8.appendChild(x8);
                                        td9.appendChild(x9);
                                        td9.appendChild(x10);
                                        
                                        tr.appendChild(td1);
                                        tr.appendChild(td2);
                                        tr.appendChild(td3);
                                        tr.appendChild(td4);
                                        tr.appendChild(td5);
                                        tr.appendChild(td6);
                                        tr.appendChild(td7);
                                        tr.appendChild(td8);
                                        tr.appendChild(td9);
                                        t.appendChild(tr);
                                        var deduc3=SeminarBGCount-1;
                                        console.log('DeleteBTNSeminar'+deduc3);
                                        if(deduc3!='1'){
                                            document.getElementById('DeleteBTNSeminar'+deduc3).style.display="none";
                                        }
                                        
                                        
                                    }
                                    function DeleteSeminar(e){
                                        var t = document.getElementById('SeminarTableBody');
                                        var tr = document.getElementById("SemtableRow"+e);
                                        t.removeChild(tr);
                                        SeminarBGCount--;
                                        document.getElementById('SeminarFieldCountid').value=SeminarBGCount;
                                        if(SeminarBGCount!='1'){
                                            document.getElementById('DeleteBTNSeminar'+SeminarBGCount).style.display="inline";
                                        }
                                        
                                        
                                    }
                                </script>
                                <input type="hidden" id="SeminarFieldCountid" name="SeminarFieldCount" value="1">
                                <tr>
                                <td width="10%"><input value="{{count($emp_seminar)!=0? $emp_seminar[0]->seminar_date  : '' }}" type="date" class="form-control" placeholder="Seminar Date..." name="SDate1"></td>
                                <td width="12%"><input value="{{count($emp_seminar)!=0? $emp_seminar[0]->seminar_name  : '' }}" type="text" class="form-control" placeholder="Seminar Name..." name="SName1"></td>
                                <td width="12%"><input value="{{count($emp_seminar)!=0? $emp_seminar[0]->instructor  : '' }}" type="text" class="form-control" placeholder="Instructor..." name="SIns1"></td>
                                <td width="12%"><input value="{{count($emp_seminar)!=0? $emp_seminar[0]->seminar_nature  : '' }}" type="text" class="form-control" placeholder="Nature of Seminar..." name="SNature1"></td>
                                <td width="12%"><input value="{{count($emp_seminar)!=0? $emp_seminar[0]->seminar_cost  : '' }}" type="text" class="form-control" placeholder="Seminar Cost..." name="SCost1"></td>
                                <td width="12%"><input value="{{count($emp_seminar)!=0? $emp_seminar[0]->seminar_returningserviceperiod  : '' }}" type="date" class="form-control" placeholder="Returning Service Period..." name="SReturning1"></td>
                                <td width="12%"><input value="{{count($emp_seminar)!=0? $emp_seminar[0]->correspondingamount  : '' }}" type="text" class="form-control" placeholder="Corresponding Amount..." name="SCorresponding1"></td>
                                <td width="12%"><input value="{{count($emp_seminar)!=0? $emp_seminar[0]->seminar_note  : '' }}" type="text" class="form-control" placeholder="Seminar Note..." name="SNote1"></td>
                                <td><input type="hidden" name="SEMINARHIDDEN1" id="SEMINARHIDDEN1" value="{{count($emp_seminar)!=0? $emp_seminar[0]->seminar_id  : '' }}"></td>
                                </tr>
                            </tbody>
                          </table>
                                @for ($i = 1; $i < count($emp_seminar); $i++)
                                    <script>
                                        AddSeminar()
                                        $(document).ready(function(){
                                            document.getElementById('SDate{{$i+1}}').value="{{$emp_seminar[$i]->seminar_date}}";
                                            document.getElementById('SName{{$i+1}}').value="{{$emp_seminar[$i]->seminar_name}}";
                                            document.getElementById('SIns{{$i+1}}').value="{{$emp_seminar[$i]->instructor}}";
                                            document.getElementById('SNature{{$i+1}}').value="{{$emp_seminar[$i]->seminar_nature}}";
                                            document.getElementById('SCost{{$i+1}}').value="{{$emp_seminar[$i]->seminar_cost}}";
                                            document.getElementById('SReturning{{$i+1}}').value="{{$emp_seminar[$i]->seminar_returningserviceperiod}}";
                                            document.getElementById('SCorresponding{{$i+1}}').value="{{$emp_seminar[$i]->correspondingamount}}";
                                            document.getElementById('SNote{{$i+1}}').value="{{$emp_seminar[$i]->seminar_note}}";
                                            document.getElementById('SEMINARHIDDEN{{$i+1}}').value="{{$emp_seminar[$i]->seminar_id}}";
                                        });
                                        
                                    </script>

                                @endfor
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="SalaryandAdvanceTab" role="tabpanel" aria-labelledby="contact-tab">
            {{-- <h4 style="margin-bottom:0px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">ADD NEW DEPARTMENT</h4> --}}
            <div class="row">
                <div class="col-md-12">
                    <div style="background-color:white;">
                    <h3 style="color:white;background-color:#124f62;padding:5px;margin-top:0px;">Salary Details</h3>
                        <div class="row" style="padding:10px;padding-top:0px">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="Pos" style="color:#083240;padding-left:0px;">OT Computation Table</label>
                                <input type="hidden" name="SalaryIDHidden" value="{{!empty($emp_salary_detail)? $emp_salary_detail->salary_detail_id : ''}}">
                                <select class="form-control" name="OTComputationTable">
                                    @foreach ($ot_rate_table as $item)
                                        <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->ot_com_table==$item->dh_id? 'Selected' : '') : ''}}>{{$item->dh_id}}</option>
                                    @endforeach
                                </select>
                            </div>
                              
                            </div>
                            <script>
                                function DisableECOLA(){
                                    var value=document.getElementById('minwageinput').value;
                                    
                                    if(value==1){
                                        document.getElementById('ECOOLAA').readOnly=false;
                                    }else{
                                        document.getElementById('ECOOLAA').readOnly=true;
                                    }
                                }
                            </script>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="Gender" style="color:#083240;padding-left:0px;">Minimum Wage</label>
                                <select name="MinimumWage" class="form-control" onchange="DisableECOLA()" id="minwageinput">
                                    <option value="1" {{!empty($emp_salary_detail)?  ($emp_salary_detail->minwage=="1"? 'Selected' : '') : ''}}>YES</option>
                                    <option value="0" {{!empty($emp_salary_detail)?  ($emp_salary_detail->minwage=="0"? 'Selected' : '') : ''}}>NO</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="Effectivity" style="color:#083240;padding-left:0px;">De Minimis Total</label>
                                <input type="number" id="DeminTotal" class="form-control" name="Deminimistotal" value="{{!empty($emp_salary_detail)?  $emp_salary_detail->deminimis_total : '0'}}" readonly="">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="Pos" style="color:#083240;padding-left:0px;">Work Days Per Year</label>
                                <input type="number" class="form-control" name="WorkDaysPerYear"  value="{{!empty($emp_salary_detail)?  $emp_salary_detail->workdayperyear : ''}}">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="Pos" style="color:#083240;padding-left:0px;">Basic Salary</label>
                                <input type="number" class="form-control" step="0.01" name="BasicSalary" value="{{!empty($emp_salary_detail)?  $emp_salary_detail->basic_salary : '0'}}">
                              </div>
                            </div>
                            <div class="col-md-4">
                               <div class="form-group">
                                <label for="Gender" style="color:#083240;padding-left:0px;">Pag-ibig Contribution</label>
                                <select class="form-control" name="PagibigContribution">
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="Let System Decide"? 'Selected' : '') : ''}} >Let System Decide</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="0"? 'Selected' : '') : ''}} >0</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="100"? 'Selected' : '') : ''}} >100</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="200"? 'Selected' : '') : ''}} >200</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="300"? 'Selected' : '') : ''}} >300</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="400"? 'Selected' : '') : ''}} >400</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="500"? 'Selected' : '') : ''}} >500</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="600"? 'Selected' : '') : ''}} >600</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="700"? 'Selected' : '') : ''}} >700</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="800"? 'Selected' : '') : ''}} >800</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="900"? 'Selected' : '') : ''}} >900</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="1000"? 'Selected' : '') : ''}} >1000</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="1100"? 'Selected' : '') : ''}} >1100</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->pagibigcont=="1200"? 'Selected' : '') : ''}} >1200</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="Gender" style="color:#083240;padding-left:0px;">SSS Contribution</label>
                                <select class="form-control" name="SSSContribution">
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="Let System Decide"? 'Selected' : '') : ''}}>Let System Decide</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="0"? 'Selected' : '') : ''}}>0</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="36.30"? 'Selected' : '') : ''}}>36.30</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="54.50"? 'Selected' : '') : ''}}>54.50</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="72.70"? 'Selected' : '') : ''}}>72.70</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="90.80"? 'Selected' : '') : ''}}>90.80</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="109.00"? 'Selected' : '') : ''}}>109.00</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="127.20"? 'Selected' : '') : ''}}>127.20</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="145.30"? 'Selected' : '') : ''}}>145.30</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="163.50"? 'Selected' : '') : ''}}>163.50</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="181.70"? 'Selected' : '') : ''}}>181.70</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="199.80"? 'Selected' : '') : ''}}>199.80</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="218.00"? 'Selected' : '') : ''}}>218.00</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="236.20"? 'Selected' : '') : ''}}>236.20</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="254.30"? 'Selected' : '') : ''}}>254.30</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="272.50"? 'Selected' : '') : ''}}>272.50</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="290.70"? 'Selected' : '') : ''}}>290.70</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="308.80"? 'Selected' : '') : ''}}>308.80</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="327.00"? 'Selected' : '') : ''}}>327.00</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="345.20"? 'Selected' : '') : ''}}>345.20</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="363.30"? 'Selected' : '') : ''}}>363.30</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="381.50"? 'Selected' : '') : ''}}>381.50</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="399.70"? 'Selected' : '') : ''}}>399.70</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="417.80"? 'Selected' : '') : ''}}>417.80</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="436.00"? 'Selected' : '') : ''}}>436.00</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="454.20"? 'Selected' : '') : ''}}>454.20</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="472.30"? 'Selected' : '') : ''}}>472.30</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="490.50"? 'Selected' : '') : ''}}>490.50</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="508.70"? 'Selected' : '') : ''}}>508.70</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="526.80"? 'Selected' : '') : ''}}>526.80</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="545.00"? 'Selected' : '') : ''}}>545.00</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="563.20"? 'Selected' : '') : ''}}>563.20</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->sss_contribution=="581.30"? 'Selected' : '') : ''}}>581.30</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="Gender" style="color:#083240;padding-left:0px;">PhilHealth Contribution</label>
                                <select class="form-control" name="PhilhealthContribution">
                                    <option value="1" {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="1"? 'Selected' : '') : ''}}>Let System Decide</option>
                                    <option value="0" {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="0"? 'Selected' : '') : ''}}>None</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="137"? 'Selected' : '') : ''}}>137</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="151.25"? 'Selected' : '') : ''}}>151.25</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="165"? 'Selected' : '') : ''}}>165</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="178.75"? 'Selected' : '') : ''}}>178.75</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="192.50"? 'Selected' : '') : ''}}>192.50</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="206.25"? 'Selected' : '') : ''}}>206.25</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="220"? 'Selected' : '') : ''}}>220</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="233.75"? 'Selected' : '') : ''}}>233.75</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="247.50"? 'Selected' : '') : ''}}>247.50</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="261.25"? 'Selected' : '') : ''}}>261.25</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="275"? 'Selected' : '') : ''}}>275</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="288.75"? 'Selected' : '') : ''}}>288.75</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="302.50"? 'Selected' : '') : ''}}>302.50</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="316.25"? 'Selected' : '') : ''}}>316.25</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="330"? 'Selected' : '') : ''}}>330</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="343.75"? 'Selected' : '') : ''}}>343.75</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="357.50"? 'Selected' : '') : ''}}>357.50</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="371.25"? 'Selected' : '') : ''}}>371.25</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="385"? 'Selected' : '') : ''}}>385</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="398.75"? 'Selected' : '') : ''}}>398.75</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="412.50"? 'Selected' : '') : ''}}>412.50</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="426.25"? 'Selected' : '') : ''}}>426.25</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="440"? 'Selected' : '') : ''}}>440</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="453.75"? 'Selected' : '') : ''}}>453.75</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="467.50"? 'Selected' : '') : ''}}>467.50</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="481.25"? 'Selected' : '') : ''}}>481.25</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="495"? 'Selected' : '') : ''}}>495</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="508.75"? 'Selected' : '') : ''}}>508.75</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="522.50"? 'Selected' : '') : ''}}>522.50</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="536.25"? 'Selected' : '') : ''}}>536.25</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="543.13"? 'Selected' : '') : ''}}>543.13</option>
                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->philhealth_contribution=="550"? 'Selected' : '') : ''}}>550</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                             <div class="form-group">
                                <label for="Gender" style="color:#083240;padding-left:0px;">Additional Pag-ibig Contribution</label>
                                <input type="number" class="form-control" name="AdditionalPagibigContribution" value="{{!empty($emp_salary_detail)?  $emp_salary_detail->add_pagibig_cont : ''}}">
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div style="background-color:white;">
                    <h3 style="color:white;background-color:#124f62;padding:5px;margin-top:0px;">De Minimis Details</h3>
                    <div class="row" style="padding:10px;padding-top:0px">
                    <script>
                        function setdeminimis(){
                            var E1=document.getElementById('ECOOLAA').value;
                            var E2=document.getElementById('mobileallawance').value;
                            var E3=document.getElementById('mealallowance').value;
                            var E4=document.getElementById('cashallowance').value;
                            var E5=document.getElementById('travelallowance').value;
                            var DemiTotal=parseFloat(E1)+parseFloat(E2)+parseFloat(E3)+parseFloat(E4)+parseFloat(E5);
                            document.getElementById('DeminTotal').value=DemiTotal;
                        }
                    </script>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="Pos" style="color:#083240;padding-left:0px;">Cash Allowance</label>
                            <input type="number" oninput="setdeminimis()" id="cashallowance" class="form-control" name="CashAllowance" value="{{!empty($emp_salary_detail)?  $emp_salary_detail->cash_allowance : '0'}}">
                          </div>
                        </div>
                        <div class="col-md-4">
                        
                          <div class="form-group">
                            <label for="Gender" style="color:#083240;padding-left:0px;">Emergency Cost of Living Allowance</label>
                            <input type="text" oninput="setdeminimis()" id="ECOOLAA" class="form-control" name="ECOLAINPUT" value="{{!empty($emp_salary_detail)?  $emp_salary_detail->ecola : '0'}}">
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="Pos" style="color:#083240;padding-left:0px;">Meal Allowance</label>
                            <input type="number" oninput="setdeminimis()" id="mealallowance" class="form-control" name="MealAllowance" value="{{!empty($emp_salary_detail)?  $emp_salary_detail->meal_allowance : '0'}}">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="Pos" style="color:#083240;padding-left:0px;">Mobile Allowance</label>
                            <input type="number" oninput="setdeminimis()" id="mobileallawance" class="form-control" name="MobileAllowance" value="{{!empty($emp_salary_detail)?  $emp_salary_detail->mobile_allowance : '0'}}">
                          </div>
                        </div>
                        
                        
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="Pos" style="color:#083240;padding-left:0px;">Travel Allowance</label>
                            <input type="number" oninput="setdeminimis()" id="travelallowance" class="form-control" name="TravelAllowance" value="{{!empty($emp_salary_detail)?  $emp_salary_detail->travel_allowance : '0'}}">
                          </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div style="background-color:white;">
                    <h3 style="color:white;background-color:#124f62;padding:5px;margin-top:0px;">Bank Details</h3>
                            
                            <div class="row" style="padding: 0px 10px 10px 10px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                              <div class="form-group">
                                                <label for="Gender" style="color:#083240;padding-left:0px; ">Bank</label>
                                                <select class="form-control" name="BankName">
                                                    <option value="">--Select Bank</option>
                                                    @foreach ($company_bank as $item)
                                                        <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->bank==$item->company_bank_id? 'Selected' : '') : ''}} value="{{$item->company_bank_id}}">{{$item->bank_name}}</option>
                                                    @endforeach
                                                </select>
                                              </div>
                                        </div>
                                        <div class="col-md-4">
                                              <div class="form-group">
                                                <label for="Gender" style="color:#083240;padding-left:0px; ">Bank Account Type</label>
                                                <select class="form-control" name="BankType">
                                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->bank_type=="Savings"? 'Selected' : '') : ''}}>Savings</option>
                                                    <option {{!empty($emp_salary_detail)?  ($emp_salary_detail->bank_type=="Current"? 'Selected' : '') : ''}}>Current</option>
                                                </select>
                                              </div>
                                        </div>
                                        <div class="col-md-4">
                                              <div class="form-group">
                                                <label for="Gender" style="color:#083240;padding-left:0px; ">Bank Account Number</label>
                                                <input type="text" class="form-control" name="BankAccNumber" value="{{!empty($emp_salary_detail)?  $emp_salary_detail->bank_acc_number : ''}}">
                                              </div>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="WorkTab" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-12">
                    <div style="background-color:white;">
                    <h3 style="color:white;background-color:#124f62;padding:5px;margin-top:0px;">Job Details</h3>
                        <div class="row" style="padding:10px;padding-top:0px">
                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="EmpPosition" style="color:#083240;padding-left:0px;">Position</label>
                                <input type="text" class="form-control"  name="EmpPosition" id="EmpPosition" value="{{!empty($emp_job_detail)?  $emp_job_detail->position : ''}}">
                                <input type="hidden" class="form-control"  name="JobDetailHidden"  value="{{!empty($emp_job_detail)?  $emp_job_detail->job_detail_id : ''}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="DailyHour" style="color:#083240;padding-left:0px;">Daily Hour</label>
                                <input type="number" class="form-control"  name="DailyHour" id="DailyHour" value="{{!empty($emp_job_detail)?  $emp_job_detail->daily_hour : ''}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="EmployeeType" style="color:#083240;padding-left:0px;">Employee Type</label>
                                <select class="form-control"  name="EmployeeType" id="EmployeeType">
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employee_type=="Rank And File"? 'Selected' : '') : ''}} >Rank And File</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employee_type=="Executive"? 'Selected' : '') : ''}} >Executive</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employee_type=="Supervisory"? 'Selected' : '') : ''}} >Supervisory</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="StartDate" style="color:#083240;padding-left:0px;">Start Date</label>
                                <input type="date" class="form-control"  name="StartDate" id="StartDate" value="{{!empty($emp_job_detail)?  $emp_job_detail->start_date : ''}}">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="ReportTo" style="color:#083240;padding-left:0px;">Report To</label>
                                <select class="form-control"  name="ReportTo" id="ReportTo">
                                    <option value="">--Select Officer--</option>
                                    @foreach ($HR_hr_employee_info as $item)
                                        <option {{!empty($emp_job_detail)?  ($emp_job_detail->report_to==$item->employee_id? 'Selected' : '') : ''}} value="{{$item->employee_id}}">{{$item->fname." ".$item->lname}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="JobEmploymentStatus" style="color:#083240;padding-left:0px;">Employment Status</label>
                                <select class="form-control" name="JobEmploymentStatus">
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employee_type=="Active"? 'Selected' : '') : ''}}>Active</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="Inactive"? 'Selected' : '') : ''}}>Inactive</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="On Leave"? 'Selected' : '') : ''}}>On Leave</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="Resigned/Terminated"? 'Selected' : '') : ''}}>Resigned/Terminated</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="Project-based"? 'Selected' : '') : ''}}>Project-based</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="Activity-based"? 'Selected' : '') : ''}}>Activity-based</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="Probationary"? 'Selected' : '') : ''}}>Probationary</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="Contractual"? 'Selected' : '') : ''}}>Contractual</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="End Of Contract"? 'Selected' : '') : ''}}>End Of Contract</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="Part Time(Hourly)"? 'Selected' : '') : ''}}>Part Time(Hourly)</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="Part Time(Daily)"? 'Selected' : '') : ''}}>Part Time(Daily)</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="Part Time(Monthly)"? 'Selected' : '') : ''}}>Part Time(Monthly)</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="Suspension"? 'Selected' : '') : ''}}>Suspension</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="Maternity"? 'Selected' : '') : ''}}>Maternity</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->employment_status=="Paternity"? 'Selected' : '') : ''}}>Paternity</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="JobStatusEffectivity" style="color:#083240;padding-left:0px;">Status Effectivity Date</label>
                                <input type="date" class="form-control" name="JobStatusEffectivity" value="{{!empty($emp_job_detail)?  $emp_job_detail->status_effectve_date : ''}}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="EmpDepartment" style="color:#083240;padding-left:0px;">Department</label>
                                <select class="form-control"  name="EmpDepartment" id="EmpDepartment">
                                    <option value="">--Select Officer--</option>
                                    @foreach ($company_department as $item)
                                        <option {{!empty($emp_job_detail)?  ($emp_job_detail->department==$item->department_id? 'Selected' : '') : ''}} value="{{$item->department_id}}">{{$item->department_name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="ROHQ" style="color:#083240;padding-left:0px;">ROHQ</label>
                                <select class="form-control"  name="ROHQ" id="ROHQ">
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->rohq=="0"? 'Selected' : '') : ''}} value="0">NO</option>
                                    <option {{!empty($emp_job_detail)?  ($emp_job_detail->rohq=="1"? 'Selected' : '') : ''}} value="1">YES</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="EmpCostCenter" style="color:#083240;padding-left:0px;">Cost Center</label>
                                <select class="form-control"  name="EmpCostCenter" id="EmpCostCenter">
                                    <option value="">--Select Officer--</option>
                                    @foreach ($company_cost_center as $item)
                                        <option {{!empty($emp_job_detail)?  ($emp_job_detail->cost_center==$item->cost_center_id? 'Selected' : '') : ''}} value="{{$item->cost_center_id}}">{{$item->cost_center_name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="Consultant" style="color:#083240;padding-left:0px;">Consultant</label>
                                <select class="form-control"  name="Consultant" id="Consultant">
                                        <option {{!empty($emp_job_detail)?  ($emp_job_detail->consultant=="0"? 'Selected' : '') : ''}} value="0">NO</option>
                                        <option {{!empty($emp_job_detail)?  ($emp_job_detail->consultant=="1"? 'Selected' : '') : ''}} value="1">YES</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                
                            </div>
                        </div>
                        <div class="row">
							<div class="col-md-12">
								<div style="background-color:white;">
								<h3 style="color:white;background-color:#124f62;padding:5px;margin-top:0px;margin-bottom:10px;">Schedule Details</h3>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group" style="margin-bottom:0px;padding:0px 10px 0px 10px;">
												<label for="BIO" style="color:#083240;">Schedule Type</label>
												<select class="form-control" name="ScheduleType">
												<option {{!empty($emp_job_detail)?  ($emp_job_detail->consultant=="Normal Shift"? 'Selected' : '') : ''}}>Normal Shift</option>
												<option {{!empty($emp_job_detail)?  ($emp_job_detail->consultant=="Flexible Schedule Per Day"? 'Selected' : '') : ''}}>Flexible Schedule Per Day</option>
												<option {{!empty($emp_job_detail)?  ($emp_job_detail->consultant=="Flexible Schedule Per Week"? 'Selected' : '') : ''}}>Flexible Schedule Per Week</option>
												<option {{!empty($emp_job_detail)?  ($emp_job_detail->consultant=="Exempted"? 'Selected' : '') : ''}}>Exempted</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" style="margin-bottom:0px;padding:0px 10px 0px 10px;">
												<label for="BIO" style="color:#083240;">No. Of Hours to Work</label>
												<input type="number" class="form-control" name="NoOfHoursWork" value="{{!empty($emp_job_detail)?  $emp_job_detail->no_of_hours_to_work : ''}}">
											</div>
										</div>
									</div>
									<div class="row" style="margin-top:10px;">
										<div class="col-md-12">
										
										<table class="table table-condensed" style="margin-bottom:0px;">
											<thead style="background-color:#124f62;color:white">
											  <tr>
												
												<th>Day</th>
												<th>Shift/Core From</th>
												<th>Shift/Core To</th>
												<th>Break Start</th>
												<th>Break End</th>
												<th>is Rest Day</th>
											  </tr>
											</thead>
                                            <tbody style="color:#083240;">
                                                <?php
                                                $sched_id="";
                                                $day_id="";
                                                $shiftfrom="";
                                                $shiftto="";
                                                $breakstart="";
                                                $breakend="";
                                                $isrestday="";
                                                ?>
                                                @foreach ($emp_sched as $item)
                                                @if ($item->day_id=="1")
                                                <?php
                                                    $sched_id=$item->id;
                                                    $day_id=$item->day_id;
                                                    $shiftfrom=$item->core_from;
                                                    $shiftto=$item->core_to;
                                                    $breakstart=$item->break_start;
                                                    $breakend=$item->break_end;
                                                    $isrestday=$item->is_rest_day;
                                                ?>   
                                                @endif
                                                @endforeach
                                                <input type="hidden" name="SundayScheduleIDHidden" value="{{$sched_id}}">
												<tr>
												<td width="10%">Sunday</td>
                                                <td width="20%"><input type="time"  class="form-control" name="SundayShiftFrom" value="{{$shiftfrom}}"></td>
												<td width="20%"><input type="time" class="form-control" name="SundayShiftto" value="{{$shiftto}}"></td>
												<td width="20%"><input type="time" class="form-control" name="SundayBreakStart" value="{{$breakstart}}"></td>
                                                <td width="20%"><input type="time" class="form-control" name="SundayBreakEnd" value="{{$breakend}}"></td>
																									
												<td width="10%">
													<select class="form-control" name="SundayRestDay">
														<option {{$isrestday=="0"? 'Selected' : ''}} value="0">No</option>
														<option {{$isrestday=="1"? 'Selected' : ''}} value="1">Yes</option>
													</select>
												</td>
                                                </tr>
                                                <?php
                                                $sched_id="";
                                                $day_id="";
                                                $shiftfrom="";
                                                $shiftto="";
                                                $breakstart="";
                                                $breakend="";
                                                $isrestday="";
                                                ?>
                                                @foreach ($emp_sched as $item)
                                                @if ($item->day_id=="2")
                                                <?php
                                                    $sched_id=$item->id;
                                                    $day_id=$item->day_id;
                                                    $shiftfrom=$item->core_from;
                                                    $shiftto=$item->core_to;
                                                    $breakstart=$item->break_start;
                                                    $breakend=$item->break_end;
                                                    $isrestday=$item->is_rest_day;
                                                ?>   
                                                @endif
                                                @endforeach
                                                <input type="hidden" name="MondayScheduleIDHidden" value="{{$sched_id}}">
												<tr>
												<td width="10%">Monday</td>
												<td width="20%"><input type="time" class="form-control" name="MondayShiftFrom" value="{{$shiftfrom}}"></td>
												<td width="20%"><input type="time" class="form-control" name="MondayShiftto" value="{{$shiftto}}"></td>
												<td width="20%"><input type="time" class="form-control" name="MondayBreakStart" value="{{$breakstart}}"></td>
												<td width="20%"><input type="time" class="form-control" name="MondayBreakEnd" value="{{$breakend}}"></td>
																									
												<td width="10%">
													<div class="form-group">
													    <select class="form-control" name="MondayRestDay">
														<option {{$isrestday=="0"? 'Selected' : ''}} value="0">No</option>
														<option {{$isrestday=="1"? 'Selected' : ''}} value="1">Yes</option>
														</select>
													</div>
												</td>
                                                </tr>
                                                <?php
                                                $sched_id="";
                                                $day_id="";
                                                $shiftfrom="";
                                                $shiftto="";
                                                $breakstart="";
                                                $breakend="";
                                                $isrestday="";
                                                ?>
                                                @foreach ($emp_sched as $item)
                                                @if ($item->day_id=="3")
                                                <?php
                                                    $sched_id=$item->id;
                                                    $day_id=$item->day_id;
                                                    $shiftfrom=$item->core_from;
                                                    $shiftto=$item->core_to;
                                                    $breakstart=$item->break_start;
                                                    $breakend=$item->break_end;
                                                    $isrestday=$item->is_rest_day;
                                                ?>   
                                                @endif
                                                @endforeach
                                                <input type="hidden" name="TuesdayScheduleIDHidden" value="{{$sched_id}}">
												<tr>
												<td width="10%">Tuesday</td>
												<td width="20%"><input type="time" class="form-control" name="TuesdayShiftFrom" value="{{$shiftfrom}}"></td>
												<td width="20%"><input type="time" class="form-control" name="TuesdayShiftto" value="{{$shiftto}}"></td>
												<td width="20%"><input type="time" class="form-control" name="TuesdayBreakStart" value="{{$breakstart}}"></td>
												<td width="20%"><input type="time" class="form-control" name="TuesdayBreakEnd" value="{{$breakend}}"></td>
																									
												<td width="10%">
													<div class="form-group">
													    <select class="form-control" name="TuesdayRestDay">
														<option {{$isrestday=="0"? 'Selected' : ''}} value="0">No</option>
														<option {{$isrestday=="1"? 'Selected' : ''}} value="1">Yes</option>
														</select>
													</div>
												</td>
                                                </tr>
                                                <?php
                                                $sched_id="";
                                                $day_id="";
                                                $shiftfrom="";
                                                $shiftto="";
                                                $breakstart="";
                                                $breakend="";
                                                $isrestday="";
                                                ?>
                                                @foreach ($emp_sched as $item)
                                                @if ($item->day_id=="4")
                                                <?php
                                                    $sched_id=$item->id;
                                                    $day_id=$item->day_id;
                                                    $shiftfrom=$item->core_from;
                                                    $shiftto=$item->core_to;
                                                    $breakstart=$item->break_start;
                                                    $breakend=$item->break_end;
                                                    $isrestday=$item->is_rest_day;
                                                ?>   
                                                @endif
                                                @endforeach
                                                <input type="hidden" name="WednesdayScheduleIDHidden" value="{{$sched_id}}">
												<tr>
												<td width="10%">Wednesday</td>
												<td width="20%"><input type="time" class="form-control" name="WednesdayShiftFrom" value="{{$shiftfrom}}"></td>
												<td width="20%"><input type="time" class="form-control" name="WednesdayShiftto" value="{{$shiftto}}"></td>
												<td width="20%"><input type="time" class="form-control" name="WednesdayBreakStart"value="{{$breakstart}}"></td>
												<td width="20%"><input type="time" class="form-control" name="WednesdayBreakEnd"value="{{$breakend}}"></td>
																									
												<td width="10%">
													<div class="form-group">
													    <select class="form-control" name="WednesdayRestDay">
														<option {{$isrestday=="0"? 'Selected' : ''}} value="0">No</option>
														<option {{$isrestday=="1"? 'Selected' : ''}} value="1">Yes</option>
														</select>
													</div>
												</td>
                                                </tr>
                                                <?php
                                                $sched_id="";
                                                $day_id="";
                                                $shiftfrom="";
                                                $shiftto="";
                                                $breakstart="";
                                                $breakend="";
                                                $isrestday="";
                                                ?>
                                                @foreach ($emp_sched as $item)
                                                @if ($item->day_id=="5")
                                                <?php
                                                    $sched_id=$item->id;
                                                    $day_id=$item->day_id;
                                                    $shiftfrom=$item->core_from;
                                                    $shiftto=$item->core_to;
                                                    $breakstart=$item->break_start;
                                                    $breakend=$item->break_end;
                                                    $isrestday=$item->is_rest_day;
                                                ?>   
                                                @endif
                                                @endforeach
                                                <input type="hidden" name="ThrusdayScheduleIDHidden" value="{{$sched_id}}">
												<tr>
												<td width="10%">Thursday</td>
												<td width="20%"><input type="time" class="form-control" name="ThursdayShiftFrom" value="{{$shiftfrom}}"></td>
												<td width="20%"><input type="time" class="form-control" name="ThursdayShiftto" value="{{$shiftto}}"></td>
												<td width="20%"><input type="time" class="form-control" name="ThursdayBreakStart" value="{{$breakstart}}"></td>
												<td width="20%"><input type="time" class="form-control" name="ThursdayBreakEnd" value="{{$breakend}}"></td>
																									
												<td width="10%">
													<div class="form-group">
													    <select class="form-control" name="ThursdayRestDay">
														<option {{$isrestday=="0"? 'Selected' : ''}} value="0">No</option>
														<option {{$isrestday=="1"? 'Selected' : ''}} value="1">Yes</option>
														</select>
													</div>
												</td>
                                                </tr>
                                                <?php
                                                $sched_id="";
                                                $day_id="";
                                                $shiftfrom="";
                                                $shiftto="";
                                                $breakstart="";
                                                $breakend="";
                                                $isrestday="";
                                                ?>
                                                @foreach ($emp_sched as $item)
                                                @if ($item->day_id=="6")
                                                <?php
                                                    $sched_id=$item->id;
                                                    $day_id=$item->day_id;
                                                    $shiftfrom=$item->core_from;
                                                    $shiftto=$item->core_to;
                                                    $breakstart=$item->break_start;
                                                    $breakend=$item->break_end;
                                                    $isrestday=$item->is_rest_day;
                                                ?>   
                                                @endif
                                                @endforeach
                                                <input type="hidden" name="FridayScheduleIDHidden" value="{{$sched_id}}">
												<tr>
												<td width="10%">Friday</td>
												<td width="20%"><input type="time" class="form-control" name="FridayShiftFrom" value="{{$shiftfrom}}"></td>
												<td width="20%"><input type="time" class="form-control" name="FridayShiftto" value="{{$shiftto}}"></td>
												<td width="20%"><input type="time" class="form-control" name="FridayBreakStart"value="{{$breakstart}}"></td>
												<td width="20%"><input type="time" class="form-control" name="FridayBreakEnd" value="{{$breakend}}"></td>
																									
												<td width="10%">
													<div class="form-group">
													    <select class="form-control" name="FridayRestDay">
														<option {{$isrestday=="0"? 'Selected' : ''}} value="0">No</option>
														<option {{$isrestday=="1"? 'Selected' : ''}} value="1">Yes</option>
														</select>
													</div>
												</td>
                                                </tr>
                                                <?php
                                                $sched_id="";
                                                $day_id="";
                                                $shiftfrom="";
                                                $shiftto="";
                                                $breakstart="";
                                                $breakend="";
                                                $isrestday="";
                                                ?>
                                                @foreach ($emp_sched as $item)
                                                @if ($item->day_id=="7")
                                                <?php
                                                    $sched_id=$item->id;
                                                    $day_id=$item->day_id;
                                                    $shiftfrom=$item->core_from;
                                                    $shiftto=$item->core_to;
                                                    $breakstart=$item->break_start;
                                                    $breakend=$item->break_end;
                                                    $isrestday=$item->is_rest_day;
                                                ?>   
                                                @endif
                                                @endforeach
                                                <input type="hidden" name="SaturdayScheduleIDHidden" value="{{$sched_id}}">
												<tr>
												<td width="10%">Saturday</td>
												<td width="20%"><input type="time" class="form-control" name="SaturdayShiftFrom" value="{{$shiftfrom}}"></td>
												<td width="20%"><input type="time" class="form-control" name="SaturdayShiftto" value="{{$shiftto}}"></td>
												<td width="20%"><input type="time" class="form-control" name="SaturdayBreakStart" value="{{$breakstart}}"></td>
												<td width="20%"><input type="time" class="form-control" name="SaturdayBreakEnd" value="{{$breakend}}"></td>
																									
												<td width="10%">
													<div class="form-group">
													    <select class="form-control" name="SaturdayRestDay">
														<option {{$isrestday=="0"? 'Selected' : ''}} value="0">No</option>
														<option {{$isrestday=="1"? 'Selected' : ''}} value="1">Yes</option>
														</select>
													</div>
												</td>
												</tr>
											</tbody>
										  </table>
										</div>
									</div>
								</div>
							</div>
                        </div>
                        <div class="row" style="margin-top:10px;">
							<div class="col-md-12">
								<div style="background-color:white;">
                                <h3 style="color:white;background-color:#124f62;padding:5px;margin-top:0px;margin-bottom:10px;">Leave Management</h3>
                                    <input type="hidden" name="LeaveManagementIDHidden" value="{{!empty($emp_leave)?  $emp_leave->employee_leavemanagement_id : ''}}">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group" style="margin-bottom:0px;padding:0px 10px 10px 10px;">
												<label for="BIO" style="color:#083240;padding-left:0px;">Maternity / Paternity Leave</label>
												<input type="number" class="form-control" name="MatPatLeave" value="{{!empty($emp_leave)?  $emp_leave->pat_mat_rem : ''}}">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" style="margin-bottom:0px;padding:0px 10px 10px 10px;">
												<label for="BIO" style="color:#083240;padding-left:0px;">Sick Leave</label>
												<input type="number" class="form-control" name="SickLeave" value="{{!empty($emp_leave)?  $emp_leave->sick_credit_rem : ''}}">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" style="margin-bottom:0px;padding:0px 10px 10px 10px;">
											<label for="Gender" style="color:#083240;padding-left:0px;">Leave Credit</label>
											<input type="number" min="0" class="form-control" name="JobLeaveCredit" value="{{!empty($emp_leave)?  $emp_leave->leave_credit_rem : ''}}">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group " style="margin-bottom:0px;padding:0px 10px 10px 10px;">
												<label for="Gender" style="color:#083240;padding-left:0px;">Vacation Leave</label>
												<input type="number" min="0" class="form-control" value="{{!empty($emp_leave)?  $emp_leave->vacation_credit_rem : ''}}" name="JobVL">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="DocumentsTab" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row">
                <div class="col-md-12">
                    <div style="background-color:white;">
                        <h3 style="color:white;background-color:#124f62;padding:5px;margin-top:0px;margin-bottom:0px;">Documents</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <script>
                                    function getMultiple(){
                                        
                                        var files = $('#file-upload-document').prop("files");
                                        var names = $.map(files, function(val) { return val.name; });
                                        var count=names.length;
                                        console.log(names);
                                        var lenth=names.length;
                                        var data='<tbody style="background-color:white;color:#124f62" id="filesbody">';
                                        for(var o=0;o<lenth;o++){
                                            data=data+'<tr>';
                                            data=data+'<td><a href="#" class="btn btn-link">'+names[o]+'</a></td>';
                                            data=data+'</tbody>';
                                        }
                                        data=data+'</tbody>';
                                        $( "#filesbody" ).replaceWith( data );
                                        // $.ajax({
                                        // type: 'POST',
                                        // url: ' setfiles.php',                
                                        // data: {names:names},
                                        // success: function(data) {
                                            
                                        //     $( "#filesbody" ).replaceWith( data );
                                        // } 											 
                                        // })
                                    }
                                </script>
                                <table class="table " style="margin-bottom:0px;">
                                    <thead>
                                        <tr>
                                            <th colspan="3"><label for="file-upload-document" class="custom-file-upload">
                                                <i class="fa fa-cloud-upload"></i> Select File
                                            </label>
                                            <input id="file-upload-document" onchange="getMultiple()" type="file" name="asset_attachment[]" multiple=""></th>
                                        </tr>
                                        <tr style="color:white;background-color:#124f62;">
                                            <th >New File to Upload</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color:white;color:#124f62" id="filesbody">
                                            <tr>
                                                <td colspan="3" style="vertical-align:middle;text-align:center;">No New Document</td>
                                            </tr>
                                    </tbody>
                                    <thead>
                                        <tr style="color:white;background-color:#124f62;">
                                            <th >File Name</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color:white;color:#124f62">
                                        @if (empty($emp_files))
                                            <tr>
                                                <td colspan="3" style="vertical-align:middle;text-align:center;">No Document</td>
                                            </tr>
                                        @else
                                            @foreach ($emp_files as $item)
                                                <tr>
                                                    <td colspan="3" style="vertical-align:middle;"><a href="{{asset('storage/employee_file/'.$id.'/'.str_replace('public/employee_file/'.$id.'/','',$item))}}" download>{{str_replace("public/employee_file/".$id."/","",$item)}}</a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        
                                    </tbody>
                                    
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="tab-pane fade" id="GovtInfoTab" role="tabpanel" aria-labelledby="contact-tab">
            <div class="row">
                <div class="col-md-12">
                <div style="background-color:white;">
                    <h3 style="color:white;background-color:#124f62;padding:5px;margin-top:0px;margin-bottom:10px;">GOVERNMENT INFORMATION</h3>
                    <div class="row">
                    <div class="col-md-3">
                      <div class="form-group" style="margin-bottom:0px; padding:0px 10px 0px 10px;">
                        <label for="Pos" style="color:#083240;padding-left:0px;">TIN No.</label>
                        <input type="text" class="form-control" name="JobTIN" value="{{!empty($emp_job_detail)?  $emp_job_detail->tin_number : ''}}">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="margin-bottom:0px;padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">PhilHealth No.</label>
                        <input type="text" class="form-control" name="HobPH" value="{{!empty($emp_job_detail)?  $emp_job_detail->philhealth_number : ''}}">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="margin-bottom:0px;padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">SSS No.</label>
                        <input type="text" class="form-control" name="JobSSS" value="{{!empty($emp_job_detail)?  $emp_job_detail->sss_number : ''}}">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="margin-bottom:0px;padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">HDMF No.</label>
                        <input type="text" class="form-control" name="JobHDMF" value="{{!empty($emp_job_detail)?  $emp_job_detail->hdmf_number : ''}}">
                      </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" style="margin-bottom:0px;padding:0px 10px 10px 10px;">
                                <label for="Gender" style="color:#083240;padding-left:0px;">PRC License No.</label>
                                <input type="text" class="form-control" name="JobPRC" value="{{!empty($emp_job_detail)?  $emp_job_detail->prc_license : ''}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="margin-bottom:0px;padding:0px 10px 10px 10px;">
                                <label for="Gender" style="color:#083240;padding-left:0px;">Passport No.</label>
                                <input type="text" class="form-control" name="JobPassport" value="{{!empty($emp_job_detail)?  $emp_job_detail->passport : ''}}">
                            </div>
                        </div>
                        <div class="col-md-3" style="display:none;">
                        <div class="form-group" style="margin-bottom:0px;">
                            <label for="Pos" style="color:#083240;padding-left:0px;padding-top:10px;">Tax Status</label>
                            <select class="form-control" name="TaxStatus">
                            <option>Z</option>
                            <option>S</option>
                            <option>S1</option>
                            <option>S2</option>
                            <option>S3</option>
                            <option>S4</option>
                            <option>ME</option>
                            <option>ME1</option>
                            <option>ME2</option>
                            <option>ME3</option>
                            <option>ME4</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-3">
                        
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                <div style="background-color:white;">
                        <h3 style="color:white;background-color:#124f62;padding:5px;margin-top:0px;margin-bottom:10px;">BIR INFORMATION</h3>
                        <div class="row">
                        <div class="col-md-4">
                        <div class="form-group" style="margin-bottom:10px; padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">1600 ATC</label>
                            <select class="form-control" name="ATC1600">
                            {{!empty($emp_job_detail)?  '<option>'.$emp_job_detail->atc_s.'</option>' : ''}}
                            <option>WB030</option><option>WB040</option><option>WB050</option><option>WB070</option>
                            <option>WB080</option><option>WB082</option><option>WB090</option><option>WB102</option>
                            <option>WB103</option><option>WB104</option><option>WB108</option><option>WB109</option>
                            <option>WB110</option><option>WB121</option><option>WB130</option>
                            <option>WB140</option><option>WB150</option><option>WB160</option><option>WB170</option>
                            <option>WB180</option><option>WB191</option><option>WB192</option><option>WB193</option>
                            <option>WB194</option><option>WB200</option><option>WB201</option><option>WB202</option>
                            <option>WB203</option><option>WB301</option><option>WB303</option><option>WV010</option>
                            <option>WV012</option><option>WV014</option><option>WV020</option><option>WV022</option>
                            <option>WV024</option><option>WV030</option><option>WV040</option><option>WV050</option>
                            <option>WV060</option><option>WV070</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group" style="margin-bottom:10px; padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">1601E ATC</label>
                            <select class="form-control" name="ATC1601E">
                            {{!empty($emp_job_detail)?  '<option>'.$emp_job_detail->atc_se.'</option>' : ''}}
                            <option>WC010</option><option>WC011</option><option>WC020</option><option>WC021</option>
                            <option>WC030</option><option>WC031</option><option>WC040</option>
                            <option>WC041</option><option>WC050</option><option>WC051</option><option>WC060</option>
                            <option>WC061</option><option>WC070</option><option>WC071</option><option>WC080</option>
                            <option>WC081</option><option>WC100</option><option>WC110</option><option>WC120</option>
                            <option>WC139</option><option>WC140</option><option>WC150</option><option>WC151</option>
                            <option>WC156</option><option>WC157</option><option>WC158</option><option>WC160</option>
                            <option>WC161</option><option>WC162</option><option>WC163</option><option>WC170</option>
                            <option>WC390</option><option>WC440</option><option>WC515</option><option>WC516</option>
                            <option>WC535</option><option>WC540</option><option>WC555</option><option>WC556</option>
                            <option>WC557</option><option>WC558</option><option>WC610</option><option>WC630</option>
                            <option>WC632</option><option>WC640</option><option>WC650</option><option>WC651</option>
                            <option>WC660</option><option>WC661</option><option>WC662</option><option>WC663</option>
                            <option>WC670</option><option>WC672</option><option>WC680</option><option>WC690</option>
                            <option>WC710</option><option>WC720</option><option>WI010</option><option>WI011</option>
                            <option>WI020</option><option>WI021</option><option>WI030</option><option>WI031</option>
                            <option>WI040</option><option>WI041</option><option>WI050</option><option>WI051</option>
                            <option>WI060</option><option>WI061</option><option>WI070</option><option>WI071</option>
                            <option>WI080</option><option>WI081</option><option>WI090</option><option>WI091</option>
                            <option>WI100</option><option>WI110</option><option>WI120</option><option>WI130</option>
                            <option>WI139</option><option>WI140</option><option>WI141</option><option>WI142</option>
                            <option>WI150</option><option>WI151</option><option>WI152</option><option>WI153</option>
                            <option>WI156</option><option>WI157</option><option>WI158</option><option>WI159</option>
                            <option>WI160</option><option>WI161</option><option>WI162</option><option>WI163</option>
                            <option>WI170</option><option>WI440</option><option>WI441</option><option>WI442</option>
                            <option>WI515</option><option>WI516</option><option>WI530</option><option>WI535</option>
                            <option>WI540</option><option>WI555</option><option>WI556</option><option>WI557</option>
                            <option>WI558</option><option>WI610</option><option>WI630</option><option>WI632</option>
                            <option>WI640</option><option>WI650</option><option>WI651</option><option>WI660</option>
                            <option>WI661</option><option>WI662</option><option>WI663</option><option>WI670</option>
                            <option>WI670</option><option>WI672</option><option>WI680</option><option>WI710</option>
                            <option>WI720</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group" style="margin-bottom:10px; padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">1601F ATC</label>
                            <select class="form-control" name="ARC1601F">
                            {{!empty($emp_job_detail)?  '<option>'.$emp_job_detail->atc_sf.'</option>' : ''}}
                            <option>WC180</option><option>WC190</option><option>WC191</option>
                            <option>WC212</option><option>WC213</option><option>WC222</option>
                            <option>WC223</option><option>WC230</option><option>WC250</option>
                            <option>WC280</option><option>WC290</option><option>WC300</option>
                            <option>WC310</option><option>WC340</option><option>WC410</option>
                            <option>WC700</option><option>WI202</option><option>WI224</option>
                            <option>WI225</option><option>WI226</option><option>WI240</option>
                            <option>WI250</option><option>WI260</option><option>WI310</option>
                            <option>WI330</option><option>WI340</option><option>WI341</option>
                            <option>WI350</option><option>WI380</option><option>WI410</option>
                            <option>WI700</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group" style="margin-bottom:10px; padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">SWAT ATC</label>
                            <select class="form-control" name="ATCSWAT">
                            {{!empty($emp_job_detail)?  '<option>'.$emp_job_detail->atc_swat.'</option>' : ''}}
                            <option>WB030</option><option>WB040</option><option>WB050</option><option>WB070</option>
                            <option>WB080</option><option>WB082</option><option>WB090</option><option>WB102</option>
                            <option>WB103</option><option>WB104</option><option>WB108</option><option>WB109</option>
                            <option>WB110</option><option>WB121</option><option>WB130</option>
                            <option>WB140</option><option>WB150</option><option>WB160</option><option>WB170</option>
                            <option>WB180</option><option>WB191</option><option>WB192</option><option>WB193</option>
                            <option>WB194</option><option>WB200</option><option>WB201</option><option>WB202</option>
                            <option>WB203</option><option>WB301</option><option>WB303</option><option>WV010</option>
                            <option>WV012</option><option>WV014</option><option>WV020</option><option>WV022</option>
                            <option>WV024</option><option>WV030</option><option>WV040</option><option>WV050</option>
                            <option>WV060</option><option>WV070</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group" style="margin-bottom:10px; padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">1604E Schedule 3 ATC</label>
                            <select class="form-control" name="ATC1604E_3">
                            {{!empty($emp_job_detail)?  '<option>'.$emp_job_detail->atc_s_se.'</option>' : ''}}
                            <option>DI900</option><option>EI900</option><option>FP010</option><option>IC010</option>
                            <option>IC011</option><option>IC020</option><option>IC021</option><option>IC030</option>
                            <option>IC031</option><option>IC040</option><option>IC041</option><option>IC050</option>
                            <option>IC055</option><option>IC060</option><option>IC070</option><option>IC080</option>
                            <option>IC090</option><option>IC100</option><option>IC101</option><option>IC120</option>
                            <option>IC130</option><option>IC140</option><option>IC150</option><option>IC160</option>
                            <option>IC170</option><option>IC190</option><option>IC191</option><option>IC370</option>
                            <option>II010</option><option>II011</option><option>II012</option><option>II013</option>
                            <option>II020</option><option>II050</option><option>II060</option>
                            <option>II070</option><option>II080</option><option>II090</option><option>II110</option>
                            <option>II120</option><option>II130</option><option>II420</option><option>MC010</option>
                            <option>MC011</option><option>MC020</option><option>MC021</option><option>MC030</option>
                            <option>MC040</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group" style="margin-bottom:10px; padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">1604E Schedule 4 ATC</label>
                            <select class="form-control" name="ATC1604E_4">
                                {{!empty($emp_job_detail)?  '<option>'.$emp_job_detail->atc_s_ss.'</option>' : ''}}
                            <option>WC010</option><option>WC011</option><option>WC020</option><option>WC021</option>
                            <option>WC030</option><option>WC031</option><option>WC040</option>
                            <option>WC041</option><option>WC050</option><option>WC051</option><option>WC060</option>
                            <option>WC061</option><option>WC070</option><option>WC071</option><option>WC080</option>
                            <option>WC081</option><option>WC100</option><option>WC110</option><option>WC120</option>
                            <option>WC139</option><option>WC140</option><option>WC150</option><option>WC151</option>
                            <option>WC156</option><option>WC157</option><option>WC158</option><option>WC160</option>
                            <option>WC161</option><option>WC162</option><option>WC163</option><option>WC170</option>
                            <option>WC390</option><option>WC440</option><option>WC515</option><option>WC516</option>
                            <option>WC535</option><option>WC540</option><option>WC555</option><option>WC556</option>
                            <option>WC557</option><option>WC558</option><option>WC610</option><option>WC630</option>
                            <option>WC632</option><option>WC640</option><option>WC650</option><option>WC651</option>
                            <option>WC660</option><option>WC661</option><option>WC662</option><option>WC663</option>
                            <option>WC670</option><option>WC672</option><option>WC680</option><option>WC690</option>
                            <option>WC710</option><option>WC720</option><option>WI010</option><option>WI011</option>
                            <option>WI020</option><option>WI021</option><option>WI030</option><option>WI031</option>
                            <option>WI040</option><option>WI041</option><option>WI050</option><option>WI051</option>
                            <option>WI060</option><option>WI061</option><option>WI070</option><option>WI071</option>
                            <option>WI080</option><option>WI081</option><option>WI090</option><option>WI091</option>
                            <option>WI100</option><option>WI110</option><option>WI120</option><option>WI130</option>
                            <option>WI139</option><option>WI140</option><option>WI141</option><option>WI142</option>
                            <option>WI150</option><option>WI151</option><option>WI152</option><option>WI153</option>
                            <option>WI156</option><option>WI157</option><option>WI158</option><option>WI159</option>
                            <option>WI160</option><option>WI161</option><option>WI162</option><option>WI163</option>
                            <option>WI170</option><option>WI440</option><option>WI441</option><option>WI442</option>
                            <option>WI515</option><option>WI516</option><option>WI530</option><option>WI535</option>
                            <option>WI540</option><option>WI555</option><option>WI556</option><option>WI557</option>
                            <option>WI558</option><option>WI610</option><option>WI630</option><option>WI632</option>
                            <option>WI640</option><option>WI650</option><option>WI651</option><option>WI660</option>
                            <option>WI661</option><option>WI662</option><option>WI663</option><option>WI670</option>
                            <option>WI670</option><option>WI672</option><option>WI680</option><option>WI710</option>
                            <option>WI720</option>
                            </select>
                        </div>
                        </div>
                        
                        <div class="col-md-4">
                        <div class="form-group" style="margin-bottom:10px; padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">1604CF Schedule 5 Status Code</label>
                            <select class="form-control" name="Status_Code_1604CF">
                            <option {{!empty($emp_job_detail)? ($emp_job_detail->atc_s_cf_status_code=="A"? 'Selected' :'') : ''}} value="A">Citizen of the Philippines</option>
                            <option {{!empty($emp_job_detail)? ($emp_job_detail->atc_s_cf_status_code=="B"? 'Selected' :'') : ''}} value="B">Resident Alien Individuals</option>
                            <option {{!empty($emp_job_detail)? ($emp_job_detail->atc_s_cf_status_code=="C"? 'Selected' :'') : ''}} value="C">Non-resident Alien Engaged in Business</option>
                            <option {{!empty($emp_job_detail)? ($emp_job_detail->atc_s_cf_status_code=="D"? 'Selected' :'') : ''}} value="D">Non-resident Alien not Engaged in Business</option>
                            <option {{!empty($emp_job_detail)? ($emp_job_detail->atc_s_cf_status_code=="E"? 'Selected' :'') : ''}} value="E">Domestic Corporation</option>
                            <option {{!empty($emp_job_detail)? ($emp_job_detail->atc_s_cf_status_code=="F"? 'Selected' :'') : ''}} value="F">Resident Foeign Corp</option>
                            <option {{!empty($emp_job_detail)? ($emp_job_detail->atc_s_cf_status_code=="G"? 'Selected' :'') : ''}} value="G">Non-resident Foreign Corp</option>
                            <option {{!empty($emp_job_detail)? ($emp_job_detail->atc_s_cf_status_code=="H"? 'Selected' :'') : ''}} value="H">Others</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group" style="margin-bottom:10px; padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">1604CF Schedule 5 ATC</label>
                            <select class="form-control" name="ATC1604CF_5">
                                {{!empty($emp_job_detail)?  '<option>'.$emp_job_detail->atc_s_cf_V.'</option>' : ''}}
                            <option>WC180</option><option>WC190</option><option>WC191</option>
                            <option>WC212</option><option>WC213</option><option>WC222</option>
                            <option>WC223</option><option>WC230</option><option>WC250</option>
                            <option>WC280</option><option>WC290</option><option>WC300</option>
                            <option>WC310</option><option>WC340</option><option>WC410</option>
                            <option>WC700</option><option>WI202</option><option>WI224</option>
                            <option>WI225</option><option>WI226</option><option>WI240</option>
                            <option>WI250</option><option>WI260</option><option>WI310</option>
                            <option>WI330</option><option>WI340</option><option>WI341</option>
                            <option>WI350</option><option>WI380</option><option>WI410</option>
                            <option>WI700</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group" style="margin-bottom:10px; padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">1604CF Schedule 6 ATC</label>
                            <select class="form-control" name="ATC1604CF_6">
                                 {{!empty($emp_job_detail)?  '<option>'.$emp_job_detail->atc_s_cf_VI.'</option>' : ''}}
                            <option>WF330</option><option>WF360</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group" style="margin-bottom:10px; padding:0px 10px 10px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">1604CF Schedule 7.5 Region</label>
                            <select class="form-control" name="Region_1604CF">
                                {{!empty($emp_job_detail)?  '<option>'.$emp_job_detail->region.'</option>' : ''}}
                            <option>I</option>
                            <option>II</option>
                            <option>III</option>
                            <option>IV-A</option>
                            <option>IV-B</option>
                            <option>V</option>
                            <option>VI</option>
                            <option>VII</option>
                            <option>VIII</option>
                            <option>IX</option>
                            <option>X</option>
                            <option>XI</option>
                            <option>XII</option>
                            <option>ARMM</option>
                            <option>CAR</option>
                            <option>NCR</option>
                            </select>
                        </div>
                        </div>
                        </div>
                </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="AccessLevelTab" role="tabpanel" aria-labelledby="contact-tab">
            <h4 style="margin-bottom:0px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">ADD NEW DEPARTMENT</h4>
            <div class="container-fluid" >
            
            </div>
        </div>
    </div>
    <div class="row" style="margin-top:10px;">
        <div class="col-md-12" style="text-align:right;">
            <button type="button" class="btn btn-primary" onclick="go_basic_info_page()">Save</button>
            <button type="submit" style="display:none;" class="btn btn-primary" id="save_add_employee_info">Save</button>
            <button type="Reset" class="btn btn-primary">Reset</button>
        </div>
    </div>
    </form>
</div>
@endsection