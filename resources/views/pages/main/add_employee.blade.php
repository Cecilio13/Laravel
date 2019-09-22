@extends('main.main')


@section('content')
<div class="container-fluid" >
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
    // $(document).ready(function(){
    //     $("#add_employee_form").submit(function(e) {
    //         e.preventDefault();
    //         $.ajax({
    //             type: 'POST',
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             url: 'add_employee_data',                
    //             data: $('#add_employee_form').serialize(),
    //             success: function(data) {
    //                 //console.log(data);
    //                 Swal.fire({
    //                 type: 'success',
    //                 title: 'Success',
    //                 text: 'Successfully Added Employee Data',
    //                 }).then((result) => {
    //                     location.href="add_employee";
    //                 })
    //             }
    //         })
    //     });
    // });
    function go_basic_info_page(){
        $('#basic-tab').click();
        start_spinner();
        setTimeout(function (){
            stop_spinner();
            $('#save_add_employee_info').click();
        }, 1000);
        

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
    <form id="add_employee_form" enctype="multipart/form-data" action="add_employee_data" method="POST">
        {{ csrf_field() }}
    <div class="tab-content" id="AddEmployeeTabContent">
        <div class="tab-pane fade show active" id="BasicInfoTab" role="tabpanel" aria-labelledby="home-tab">
            <h4 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">BASIC INFORMATION</h4>
            <div class="container-fluid" style="padding-bottom:10px;">
                <div class="row">
                    <div class="col-md-3">
                        <div style="text-align:center" class="row">
                            <div class="col-md-12">
                                <img src="images/noimage.png" id="PhotoPreview"  style="width:75%;">
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
                                    <input type="text" class="form-control" id="EmpBIOID" name="EmpBIOID">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="BiometricsID" >Biometrics ID</label>
                                    <input type="text" id="BiometricsID" class="form-control" name="BiometricsID">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" style="margin-bottom:0px;display:none;">
                                    <label for="EmpID" >System ID</label>
                                    <input type="text" class="form-control" name="EmpID" id="EmpID" readonly="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                          <div class="form-group">
                            <label for="FName" >First Name</label>
                            <input type="text" class="form-control" style="text-transform: capitalize;" name="FName" required="">
                          </div>
                            </div>
                            <div class="col-md-4">
                          <div class="form-group">
                            <label for="MName" >Middle Name</label>
                            <input type="text" class="form-control" style="text-transform: capitalize;" name="MName">
                          </div>
                            </div>
                            <div class="col-md-4">
                          <div class="form-group">
                            <label for="LName">Last Name</label>
                            <input type="text" class="form-control" style="text-transform: capitalize;" name="LName" required="">
                          </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                          <div class="form-group">
                            <label for="Gender" >Gender</label>
                            <select class="form-control" name="Gender">
                                <option>Male</option>
                                <option>Female</option>
                                
                              </select>
                          </div>
                            </div>
                            <div class="col-md-4">
                          <div class="form-group">
                            <label for="CS">Civil Status</label>
                            <select class="form-control" name="CS">
                                <option>Single</option>
                                <option>Married</option>
                                <option>Widowed</option>
                                <option>Divorced</option>
                                <option>Seperated</option>
                            </select>
                          </div>
                            </div>
                            <div class="col-md-4">
                          <div class="form-group">
                            <label for="DATE">Date of Birth</label>
                            <input type="date" class="form-control" name="DATE" required="">
                          </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                              <div class="form-group">
                                <label for="Gender" >Address</label>
                                <textarea class="form-control" name="EmpAddress"></textarea>
                              </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="DATE" style="display:none;">Username</label>
                                <input type="text" style="display:none;" class="form-control" name="EmpUsername" autocomplete="false" id="USERNAME" placeholder="Requires more than 4 characters..." onkeyup="CheckUsername()"  autocomplete="emp_username">
                                <script>
                                    function CheckUsername(){

                                    }
                                </script>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="DATE" style="display:none;">Password</label>
                                <input type="password" style="display:none;" class="form-control" min="4" name="EmpPassword" placeholder="Password" title="No Special Character. e.g. {=!#}" onkeypress="return checkSpcialChar(event)"  autocomplete="emp_password">
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
                                <td><b>Contact #1</b></td>
                                <td width="22%"><input type="text" class="form-control" name="PhoneNumber1"></td>
                                <td width="24%"><input type="text" class="form-control" name="ContactPerson1"></td>
                                <td width="22%"><input type="text" class="form-control" name="Relation1"></td>
                                <td width="22%"><input type="text" class="form-control" name="AddressContact1"></td>
                                
                                </tr>
                                <tr>
                                <td><b>Contact #2</b></td>
                                <td width="22%"><input type="text" class="form-control" name="PhoneNumber2"></td>
                                <td width="24%"><input type="text" class="form-control" name="ContactPerson2"></td>
                                <td width="22%"><input type="text" class="form-control" name="Relation2"></td>
                                <td width="22%"><input type="text" class="form-control" name="AddressContact2"></td>
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
                                <td><b>Alt Contact #1</b></td>
                                <td width="30%"><input type="text" class="form-control" name="AltTypeContact1"></td>
                                <td width="30%"><input type="text" class="form-control" name="AltPhoneContact1"></td>
                                <td width="35%"><input type="text" class="form-control" name="AltPersonContact1"></td>
                                </tr>
                                <tr>
                                <td width="15%"><b>Alt Contact #2</b></td>
                                <td width="30%"><input type="text" class="form-control" name="AltTypeContact2"></td>
                                <td width="30%"><input type="text" class="form-control" name="AltPhoneContact2"></td>
                                <td width="35%"><input type="text" class="form-control" name="AltPersonContact2"></td>
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
                                <td width="50%"><input type="text" class="form-control" name="Emailnumber1"></td>
                                <td width="20%">
                                    <select class="form-control" name="EmailType1">
                                        <option>Primary</option>
                                    </select>
                                </td>
                                <td width="20%"></td>
                                </tr>
                                <tr>
                                <td><b>Email #2</b></td>
                                <td width="50%"><input type="text" class="form-control" name="Emailnumber2"></td>
                                <td width="20%">
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
                                            
                                            x1.setAttribute("name", "EDUCType"+EducBGCount);
                                            x1.setAttribute("id", "edutype"+EducBGCount);
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
                                            x2.setAttribute("placeholder", "School...");
                                            x2.setAttribute("class", "form-control");
                                            
                                            x3.setAttribute("type", "text");
                                            
                                            x3.setAttribute("name", "FROM"+EducBGCount);
                                            x3.setAttribute("placeholder", "School Date Start...");
                                            x3.setAttribute("class", "form-control");
                                            
                                            x4.setAttribute("type", "text");
                                            
                                            x4.setAttribute("name", "TO"+EducBGCount);
                                            x4.setAttribute("placeholder", "School Date End...");
                                            x4.setAttribute("class", "form-control");
                                            
                                            x5.setAttribute("type", "text");
                                            
                                            x5.setAttribute("name", "DEGREE"+EducBGCount);
                                            x5.setAttribute("placeholder", "School Degree...");
                                            x5.setAttribute("class", "form-control");
                                            
                                            x6.setAttribute("type", "button");
                                            x6.setAttribute("class", "btn btn-danger btn-sm");
                                            x6.setAttribute("id", "DeleteBTNEDUC"+EducBGCount);
                                            x6.setAttribute("onclick", "DeleteEDUCBGG("+EducBGCount+")");
                                            x6.innerHTML="Delete";
                                            
                                            td1.appendChild(x1);
                                            td2.appendChild(x2);
                                            td3.appendChild(x3);
                                            td4.appendChild(x4);
                                            td5.appendChild(x5);
                                            td6.appendChild(x6);
                                            
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
                                            <option>Primary</option>
                                            <option>Secondary</option>
                                            <option>Tertiary</option>
                                            
                                        </select>
                                    </td>
                                    <td width="20%"><input type="text" placeholder="School..." class="form-control" name="SCHOOL1"></td>
                                    <td width="20%"><input type="text" placeholder="School Date Start..." class="form-control" name="FROM1"></td>
                                    <td width="15%"><input type="text" placeholder="School Date End..." class="form-control" name="TO1"></td>
                                    <td width="20%"><input type="text" placeholder="School Degree..." class="form-control" name="DEGREE1"></td>
                                    <td width="10%"></td>
                                  </tr>
                                 
                                </tbody>
                              </table>  
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
                                            
                                            x1.setAttribute("type", "date");
                                            x1.setAttribute("name", "TrainingDate"+TrainingBGCount);
                                            x1.setAttribute("placeholder", "Training Date...");
                                            x1.setAttribute("class", "form-control");
                                            
                                            x2.setAttribute("type", "text");
                                            x2.setAttribute("name", "TrainingName"+TrainingBGCount);
                                            x2.setAttribute("placeholder", "Training Name...");
                                            x2.setAttribute("class", "form-control");
                                            
                                            x3.setAttribute("type", "text");
                                            x3.setAttribute("name", "Instructor"+TrainingBGCount);
                                            x3.setAttribute("placeholder", "Instructor...");
                                            x3.setAttribute("class", "form-control");
                                            
                                            x4.setAttribute("type", "text");
                                            x4.setAttribute("name", "Nature"+TrainingBGCount);
                                            x4.setAttribute("placeholder", "Nature of Training...");
                                            x4.setAttribute("class", "form-control");
                                            
                                            x5.setAttribute("type", "text");
                                            x5.setAttribute("name", "TrainingCost"+TrainingBGCount);
                                            x5.setAttribute("placeholder", "Training Cost...");
                                            x5.setAttribute("class", "form-control");
                                            
                                            x6.setAttribute("type", "date");
                                            x6.setAttribute("name", "Returning"+TrainingBGCount);
                                            x6.setAttribute("placeholder", "Returning Service Period...");
                                            x6.setAttribute("class", "form-control");
                                            
                                            x7.setAttribute("type", "text");
                                            x7.setAttribute("name", "Corresponding"+TrainingBGCount);
                                            x7.setAttribute("placeholder", "Corresponding Amount...");
                                            x7.setAttribute("class", "form-control");
                                            
                                            x8.setAttribute("type", "text");
                                            x8.setAttribute("name", "Note"+TrainingBGCount);
                                            x8.setAttribute("placeholder", "Training Note...");
                                            x8.setAttribute("class", "form-control");
                                            
                                            x9.setAttribute("type", "button");
                                            x9.setAttribute("class", "btn btn-danger btn-sm");
                                            x9.setAttribute("id", "DeleteBtnTraining"+TrainingBGCount);
                                            x9.setAttribute("onclick", "DeleteTraining("+TrainingBGCount+")");
                                            x9.innerHTML="Delete";
                                            
                                            td1.appendChild(x1);
                                            td2.appendChild(x2);
                                            td3.appendChild(x3);
                                            td4.appendChild(x4);
                                            td5.appendChild(x5);
                                            td6.appendChild(x6);
                                            td7.appendChild(x7);
                                            td8.appendChild(x8);
                                            td9.appendChild(x9);
                                            
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
                                    <td width="10%"><input type="date" placeholder="Training Date..." class="form-control" name="TrainingDate1"></td>
                                    <td width="12%"><input type="text" placeholder="Training Name..." class="form-control" name="TrainingName1"></td>
                                    <td width="12%"><input type="text" placeholder="Instructor..." class="form-control" name="Instructor1"></td>
                                    <td width="12%"><input type="text" placeholder="Nature of Training..." class="form-control" name="Nature1"></td>
                                    <td width="12%"><input type="text" placeholder="Training Cost..." class="form-control" name="TrainingCost1"></td>
                                    <td width="12%"><input type="date" placeholder="Returning Service Period..." class="form-control" name="Returning1"></td>
                                    <td width="12%"><input type="text" placeholder="Corresponding Amount..." class="form-control" name="Corresponding1"></td>
                                    <td width="12%"><input type="text" placeholder="Training Note..." class="form-control" name="Note1"></td>
                                    
                                    </tr>
                                </tbody>
                              </table>
                             
                                 
                            
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
                                        
                                        x1.setAttribute("type", "date");
                                        x1.setAttribute("name", "SDate"+SeminarBGCount);
                                        x1.setAttribute("placeholder", "Seminar Date...");
                                        x1.setAttribute("class", "form-control");
                                        
                                        x2.setAttribute("type", "text");
                                        x2.setAttribute("name", "SName"+SeminarBGCount);
                                        x2.setAttribute("placeholder", "Seminar Name...");
                                        x2.setAttribute("class", "form-control");
                                        
                                        x3.setAttribute("type", "text");
                                        x3.setAttribute("name", "SIns"+SeminarBGCount);
                                        x3.setAttribute("placeholder", "Instructor...");
                                        x3.setAttribute("class", "form-control");
                                        
                                        x4.setAttribute("type", "text");
                                        x4.setAttribute("name", "SNature"+SeminarBGCount);
                                        x4.setAttribute("placeholder", "Nature of Seminar...");
                                        x4.setAttribute("class", "form-control");
                                        
                                        x5.setAttribute("type", "text");
                                        x5.setAttribute("name", "SCost"+SeminarBGCount);
                                        x5.setAttribute("placeholder", "Seminar Cost...");
                                        x5.setAttribute("class", "form-control");
                                        
                                        x6.setAttribute("type", "date");
                                        x6.setAttribute("name", "SReturning"+SeminarBGCount);
                                        x6.setAttribute("placeholder", "Returning Service Period...");
                                        x6.setAttribute("class", "form-control");
                                        
                                        x7.setAttribute("type", "text");
                                        x7.setAttribute("name", "SCorresponding"+SeminarBGCount);
                                        x7.setAttribute("placeholder", "Corresponding Amount...");
                                        x7.setAttribute("class", "form-control");
                                        
                                        x8.setAttribute("type", "text");
                                        x8.setAttribute("name", "SNote"+SeminarBGCount);
                                        x8.setAttribute("placeholder", "Seminar Note...");
                                        x8.setAttribute("class", "form-control");
                                        
                                        x9.setAttribute("type", "button");
                                        x9.setAttribute("class", "btn btn-danger btn-sm");
                                        x9.setAttribute("id", "DeleteBTNSeminar"+SeminarBGCount);
                                        x9.setAttribute("onclick", "DeleteSeminar("+SeminarBGCount+")");
                                        x9.innerHTML="Delete";
                                        
                                        td1.appendChild(x1);
                                        td2.appendChild(x2);
                                        td3.appendChild(x3);
                                        td4.appendChild(x4);
                                        td5.appendChild(x5);
                                        td6.appendChild(x6);
                                        td7.appendChild(x7);
                                        td8.appendChild(x8);
                                        td9.appendChild(x9);
                                        
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
                                <td width="10%"><input type="date" class="form-control" placeholder="Seminar Date..." name="SDate1"></td>
                                <td width="12%"><input type="text" class="form-control" placeholder="Seminar Name..." name="SName1"></td>
                                <td width="12%"><input type="text" class="form-control" placeholder="Instructor..." name="SIns1"></td>
                                <td width="12%"><input type="text" class="form-control" placeholder="Nature of Seminar..." name="SNature1"></td>
                                <td width="12%"><input type="text" class="form-control" placeholder="Seminar Cost..." name="SCost1"></td>
                                <td width="12%"><input type="date" class="form-control" placeholder="Returning Service Period..." name="SReturning1"></td>
                                <td width="12%"><input type="text" class="form-control" placeholder="Corresponding Amount..." name="SCorresponding1"></td>
                                <td width="12%"><input type="text" class="form-control" placeholder="Seminar Note..." name="SNote1"></td>
                                
                                </tr>
                            </tbody>
                          </table>
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
                                <select class="form-control" name="OTComputationTable">
                                    @foreach ($ot_rate_table as $item)
                                        <option>{{$item->dh_id}}</option>
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
                                    <option value="1">YES</option>
                                    <option value="0">NO</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="Effectivity" style="color:#083240;padding-left:0px;">De Minimis Total</label>
                                <input type="number" id="DeminTotal" class="form-control" name="Deminimistotal" value="0" readonly="">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="Pos" style="color:#083240;padding-left:0px;">Work Days Per Year</label>
                                <input type="number" class="form-control" name="WorkDaysPerYear">
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="Pos" style="color:#083240;padding-left:0px;">Basic Salary</label>
                                <input type="number" class="form-control" step="0.01" name="BasicSalary" value="0">
                              </div>
                            </div>
                            <div class="col-md-4">
                               <div class="form-group">
                                <label for="Gender" style="color:#083240;padding-left:0px;">Pag-ibig Contribution</label>
                                <select class="form-control" name="PagibigContribution">
                                    <option>Let System Decide</option>
                                    <option>0</option>
                                    <option>100</option>
                                    <option>200</option>
                                    <option>300</option>
                                    <option>400</option>
                                    <option>500</option>
                                    <option>600</option>
                                    <option>700</option>
                                    <option>800</option>
                                    <option>900</option>
                                    <option>1000</option>
                                    <option>1100</option>
                                    <option>1200</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="Gender" style="color:#083240;padding-left:0px;">SSS Contribution</label>
                                <select class="form-control" name="SSSContribution">
                                    <option>Let System Decide</option>
                                    <option>0</option>
                                    
                                    <option>36.30</option>
                                        
                                    <option>54.50</option>
                                        
                                    <option>72.70</option>
                                        
                                    <option>90.80</option>
                                        
                                    <option>109.00</option>
                                        
                                    <option>127.20</option>
                                        
                                    <option>145.30</option>
                                        
                                    <option>163.50</option>
                                        
                                    <option>181.70</option>
                                        
                                    <option>199.80</option>
                                        
                                    <option>218.00</option>
                                        
                                    <option>236.20</option>
                                        
                                    <option>254.30</option>
                                        
                                    <option>272.50</option>
                                        
                                    <option>290.70</option>
                                        
                                    <option>308.80</option>
                                        
                                    <option>327.00</option>
                                        
                                    <option>345.20</option>
                                        
                                    <option>363.30</option>
                                        
                                    <option>381.50</option>
                                        
                                    <option>399.70</option>
                                        
                                    <option>417.80</option>
                                        
                                    <option>436.00</option>
                                        
                                    <option>454.20</option>
                                        
                                    <option>472.30</option>
                                        
                                    <option>490.50</option>
                                        
                                    <option>508.70</option>
                                        
                                    <option>526.80</option>
                                        
                                    <option>545.00</option>
                                        
                                    <option>563.20</option>
                                        
                                    <option>581.30</option>
                                </select>
                              </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="Gender" style="color:#083240;padding-left:0px;">PhilHealth Contribution</label>
                                <select class="form-control" name="PhilhealthContribution">
                                    <option value="1">Let System Decide</option>
                                    <option value="0">None</option>
                                    <option>137</option>
                                    <option>151.25</option>
                                    <option>165</option>
                                    <option>178.75</option>
                                    <option>192.50</option>
                                    <option>206.25</option>
                                    <option>220</option>
                                    <option>233.75</option>
                                    <option>247.50</option>
                                    <option>261.25</option>
                                    <option>275</option>
                                    <option>288.75</option>
                                    <option>302.50</option>
                                    <option>316.25</option>
                                    <option>330</option>
                                    <option>343.75</option>
                                    <option>357.50</option>
                                    <option>371.25</option>
                                    <option>385</option>
                                    <option>398.75</option>
                                    <option>412.50</option>
                                    <option>426.25</option>
                                    <option>440</option>
                                    <option>453.75</option>
                                    <option>467.50</option>
                                    <option>481.25</option>
                                    <option>495</option>
                                    <option>508.75</option>
                                    <option>522.50</option>
                                    <option>536.25</option>
                                    <option>543.13</option>
                                    <option>550</option>
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                             <div class="form-group">
                                <label for="Gender" style="color:#083240;padding-left:0px;">Additional Pag-ibig Contribution</label>
                                <input type="number" class="form-control" name="AdditionalPagibigContribution">
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
                            <input type="number" oninput="setdeminimis()" id="cashallowance" class="form-control" name="CashAllowance" value="0">
                          </div>
                        </div>
                        <div class="col-md-4">
                        
                          <div class="form-group">
                            <label for="Gender" style="color:#083240;padding-left:0px;">Emergency Cost of Living Allowance</label>
                            <input type="text" oninput="setdeminimis()" id="ECOOLAA" class="form-control" name="ECOLAINPUT" value="0">
                          </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="Pos" style="color:#083240;padding-left:0px;">Meal Allowance</label>
                            <input type="number" oninput="setdeminimis()" id="mealallowance" class="form-control" name="MealAllowance" value="0">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="Pos" style="color:#083240;padding-left:0px;">Mobile Allowance</label>
                            <input type="number" oninput="setdeminimis()" id="mobileallawance" class="form-control" name="MobileAllowance" value="0">
                          </div>
                        </div>
                        
                        
                        <div class="col-md-4">
                            <div class="form-group">
                            <label for="Pos" style="color:#083240;padding-left:0px;">Travel Allowance</label>
                            <input type="number" oninput="setdeminimis()" id="travelallowance" class="form-control" name="TravelAllowance" value="0">
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
                                                        <option value="{{$item->company_bank_id}}">{{$item->bank_name}}</option>
                                                    @endforeach
                                                </select>
                                              </div>
                                        </div>
                                        <div class="col-md-4">
                                              <div class="form-group">
                                                <label for="Gender" style="color:#083240;padding-left:0px; ">Bank Account Type</label>
                                                <select class="form-control" name="BankType">
                                                    <option>Savings</option>
                                                    <option>Current</option>
                                                </select>
                                              </div>
                                        </div>
                                        <div class="col-md-4">
                                              <div class="form-group">
                                                <label for="Gender" style="color:#083240;padding-left:0px; ">Bank Account Number</label>
                                                <input type="text" class="form-control" name="BankAccNumber">
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
                                <input type="text" class="form-control"  name="EmpPosition" id="EmpPosition">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                <label for="DailyHour" style="color:#083240;padding-left:0px;">Daily Hour</label>
                                <input type="number" class="form-control"  name="DailyHour" id="DailyHour">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="EmployeeType" style="color:#083240;padding-left:0px;">Employee Type</label>
                                <select class="form-control"  name="EmployeeType" id="EmployeeType">
                                    <option >Rank And File</option>
                                    <option >Executive</option>
                                    <option >Supervisory</option>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="StartDate" style="color:#083240;padding-left:0px;">Start Date</label>
                                <input type="date" class="form-control"  name="StartDate" id="StartDate">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="ReportTo" style="color:#083240;padding-left:0px;">Report To</label>
                                <select class="form-control"  name="ReportTo" id="ReportTo">
                                    <option value="">--Select Officer--</option>
                                    @foreach ($HR_hr_employee_info as $item)
                                        <option value="{{$item->employee_id}}">{{$item->fname." ".$item->lname}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="JobEmploymentStatus" style="color:#083240;padding-left:0px;">Employment Status</label>
                                <select class="form-control" name="JobEmploymentStatus">
                                    <option>Active</option>
                                    <option>Inactive</option>
                                    <option>On Leave</option>
                                    <option>Resigned/Terminated</option>
                                    <option>Project-based</option>
                                    <option>Activity-based</option>
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
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="JobStatusEffectivity" style="color:#083240;padding-left:0px;">Status Effectivity Date</label>
                                <input type="date" class="form-control" name="JobStatusEffectivity">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="EmpDepartment" style="color:#083240;padding-left:0px;">Department</label>
                                <select class="form-control"  name="EmpDepartment" id="EmpDepartment">
                                    <option value="">--Select Officer--</option>
                                    @foreach ($company_department as $item)
                                        <option value="{{$item->department_id}}">{{$item->department_name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="ROHQ" style="color:#083240;padding-left:0px;">ROHQ</label>
                                <select class="form-control"  name="ROHQ" id="ROHQ">
                                    <option value="0">NO</option>
                                    <option value="1">YES</option>
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
                                        <option value="{{$item->cost_center_id}}">{{$item->cost_center_name}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="Consultant" style="color:#083240;padding-left:0px;">Consultant</label>
                                <select class="form-control"  name="Consultant" id="Consultant">
                                    <option value="0">NO</option>
                                    <option value="1">YES</option>
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
												<option>Normal Shift</option>
												<option>Flexible Schedule Per Day</option>
												<option>Flexible Schedule Per Week</option>
												<option>Exempted</option>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group" style="margin-bottom:0px;padding:0px 10px 0px 10px;">
												<label for="BIO" style="color:#083240;">No. Of Hours to Work</label>
												<input type="number" class="form-control" name="NoOfHoursWork" value="">
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
                                                    $shiftfrom=(!empty($company_work_policy)? $company_work_policy->workhourstart : '');
                                                    $shiftto=(!empty($company_work_policy)? $company_work_policy->workhourend : '');
                                                    $breakstart=(!empty($company_work_policy)? $company_work_policy->breakhour : '');
                                                    $breakend=(!empty($company_work_policy)? $company_work_policy->breakhour : '');
                                                    $breakhourend2 ="";
                                                    if($breakend!=''){
                                                        $breakhourend2 = strtotime($breakend) + 60*60;
                                                        $breakend=date('H:i', $breakhourend2);
                                                    }
                                                    
                                                ?>
												<tr>
												<td width="10%">Sunday</td>
												<td width="20%"><input type="time"  class="form-control" name="SundayShiftFrom" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->sunday=="1"? '' : $shiftfrom ) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="SundayShiftto" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->sunday=="1"? '' : $shiftto ) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="SundayBreakStart" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->sunday=="1"? '' : $breakstart ) : ''}}"></td>
                                                <td width="20%"><input type="time" class="form-control" name="SundayBreakEnd" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->sunday=="1"? '' : $breakend ) : ''}}"></td>
																									
												<td width="10%">
													<select class="form-control" name="SundayRestDay">
														<option value="0">No</option>
														<option value="1" {{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->sunday=="1"? 'Selected' :'') : ''}}>Yes</option>
													</select>
												</td>
												</tr>
												<tr>
												<td width="10%">Monday</td>
												<td width="20%"><input type="time" class="form-control" name="MondayShiftFrom" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->monday=="1"? '' : $shiftfrom ) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="MondayShiftto" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->monday=="1"? '' : $shiftto ) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="MondayBreakStart" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->monday=="1"? '' : $breakstart ) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="MondayBreakEnd" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->monday=="1"? '' : $breakend ) : ''}}"></td>
																									
												<td width="10%">
													<div class="form-group">
													    <select class="form-control" name="MondayRestDay">
														<option value="0">No</option>
														<option {{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->monday=="1"? 'Selected' :'') : ''}} value="1">Yes</option>
														</select>
													</div>
												</td>
												</tr>
												<tr>
												<td width="10%">Tuesday</td>
												<td width="20%"><input type="time" class="form-control" name="TuesdayShiftFrom" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->tuesday=="1"? '' : $shiftfrom) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="TuesdayShiftto" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->tuesday=="1"? '' : $shiftto) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="TuesdayBreakStart" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->tuesday=="1"? '' : $breakstart) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="TuesdayBreakEnd" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->tuesday=="1"? '' : $breakend) : ''}}"></td>
																									
												<td width="10%">
													<div class="form-group">
													    <select class="form-control" name="TuesdayRestDay">
														<option value="0">No</option>
														<option {{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->tuesday=="1"? 'Selected' :'') : ''}} value="1">Yes</option>
														</select>
													</div>
												</td>
												</tr>
												<tr>
												<td width="10%">Wednesday</td>
												<td width="20%"><input type="time" class="form-control" name="WednesdayShiftFrom" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->wednesday=="1"? '' : $shiftfrom) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="WednesdayShiftto" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->wednesday=="1"? '' : $shiftto) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="WednesdayBreakStart" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->wednesday=="1"? '' : $breakstart) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="WednesdayBreakEnd" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->wednesday=="1"? '' : $breakend) : ''}}"></td>
																									
												<td width="10%">
													<div class="form-group">
													    <select class="form-control" name="WednesdayRestDay">
														<option value="0">No</option>
														<option {{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->wednesday=="1"? 'Selected' :'') : ''}} value="1">Yes</option>
														</select>
													</div>
												</td>
												</tr>
												<tr>
												<td width="10%">Thursday</td>
												<td width="20%"><input type="time" class="form-control" name="ThursdayShiftFrom" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->thursday=="1"? '' : $shiftfrom) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="ThursdayShiftto" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->thursday=="1"? '' : $shiftto) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="ThursdayBreakStart" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->thursday=="1"? '' : $breakstart) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="ThursdayBreakEnd" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->thursday=="1"? '' : $breakend) : ''}}"></td>
																									
												<td width="10%">
													<div class="form-group">
													    <select class="form-control" name="ThursdayRestDay">
														<option value="0">No</option>
														<option value="1" {{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->thursday=="1"? 'Selected' :'') : ''}}>Yes</option>
														</select>
													</div>
												</td>
												</tr>
												<tr>
												<td width="10%">Friday</td>
												<td width="20%"><input type="time" class="form-control" name="FridayShiftFrom" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->friday=="1"? '' : $shiftfrom) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="FridayShiftto" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->friday=="1"? '' : $shiftto) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="FridayBreakStart" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->friday=="1"? '' : $breakstart) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="FridayBreakEnd" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->friday=="1"? '' : $breakend) : ''}}"></td>
																									
												<td width="10%">
													<div class="form-group">
													    <select class="form-control" name="FridayRestDay">
														<option value="0">No</option>
														<option value="1" {{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->friday=="1"? 'Selected' :'') : ''}}>Yes</option>
														</select>
													</div>
												</td>
												</tr>
												<tr>
												<td width="10%">Saturday</td>
												<td width="20%"><input type="time" class="form-control" name="SaturdayShiftFrom" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->saturday=="1"? '' : $shiftfrom) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="SaturdayShiftto" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->saturday=="1"? '' : $shiftto) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="SaturdayBreakStart" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->saturday=="1"? '' : $breakstart) : ''}}"></td>
												<td width="20%"><input type="time" class="form-control" name="SaturdayBreakEnd" value="{{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->saturday=="1"? '' : $breakend) : ''}}"></td>
																									
												<td width="10%">
													<div class="form-group">
													    <select class="form-control" name="SaturdayRestDay">
														<option value="0">No</option>
														<option value="1" {{!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->saturday=="1"? 'Selected' :'') : ''}}>Yes</option>
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
									<div class="row">
										<div class="col-md-3">
											<div class="form-group" style="margin-bottom:0px;padding:0px 10px 10px 10px;">
												<label for="BIO" style="color:#083240;padding-left:0px;">Maternity / Paternity Leave</label>
												<input type="number" class="form-control" name="MatPatLeave" value="10">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" style="margin-bottom:0px;padding:0px 10px 10px 10px;">
												<label for="BIO" style="color:#083240;padding-left:0px;">Sick Leave</label>
												<input type="number" class="form-control" name="SickLeave" value="10">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group" style="margin-bottom:0px;padding:0px 10px 10px 10px;">
											<label for="Gender" style="color:#083240;padding-left:0px;">Leave Credit</label>
											<input type="number" min="0" class="form-control" name="JobLeaveCredit" value="10">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group " style="margin-bottom:0px;padding:0px 10px 10px 10px;">
												<label for="Gender" style="color:#083240;padding-left:0px;">Vacation Leave</label>
												<input type="number" min="0" class="form-control" value="10" name="JobVL">
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
                                            <th >File Name</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color:white;color:#124f62" id="filesbody">
                                        <tr>
                                            <td colspan="3" style="vertical-align:middle;text-align:center;">No Document</td>
                                        </tr>
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
                        <input type="text" class="form-control" name="JobTIN">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="margin-bottom:0px;padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">PhilHealth No.</label>
                        <input type="text" class="form-control" name="HobPH">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="margin-bottom:0px;padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">SSS No.</label>
                        <input type="text" class="form-control" name="JobSSS">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group" style="margin-bottom:0px;padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">HDMF No.</label>
                        <input type="text" class="form-control" name="JobHDMF">
                      </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" style="margin-bottom:0px;padding:0px 10px 10px 10px;">
                                <label for="Gender" style="color:#083240;padding-left:0px;">PRC License No.</label>
                                <input type="text" class="form-control" name="JobPRC">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="margin-bottom:0px;padding:0px 10px 10px 10px;">
                                <label for="Gender" style="color:#083240;padding-left:0px;">Passport No.</label>
                                <input type="text" class="form-control" name="JobPassport">
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
                            <option value="A">Citizen of the Philippines</option>
                            <option value="B">Resident Alien Individuals</option>
                            <option value="C">Non-resident Alien Engaged in Business</option>
                            <option value="D">Non-resident Alien not Engaged in Business</option>
                            <option value="E">Domestic Corporation</option>
                            <option value="F">Resident Foeign Corp</option>
                            <option value="G">Non-resident Foreign Corp</option>
                            <option value="H">Others</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group" style="margin-bottom:10px; padding:0px 10px 0px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">1604CF Schedule 5 ATC</label>
                            <select class="form-control" name="ATC1604CF_5">
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
                            <option>WF330</option><option>WF360</option>
                            </select>
                        </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group" style="margin-bottom:10px; padding:0px 10px 10px 10px;">
                        <label for="Gender" style="color:#083240;padding-left:0px;">1604CF Schedule 7.5 Region</label>
                            <select class="form-control" name="Region_1604CF">
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