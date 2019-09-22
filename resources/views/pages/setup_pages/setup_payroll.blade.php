@extends('main.main_setup')


@section('content')
<div class="container-fluid" >
    <ul class="nav nav-tabs nav-tab-custom"   role="tablist">
        <li class="nav-item" >
            <a class="nav-link {{($page=='1'? 'active' : ($page==''? 'active' : '') )}}" id="home-tab" data-toggle="tab" href="#PROFILE" role="tab" aria-controls="home" aria-selected="true">Work Policy</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link {{($page=='2'? 'active' : '' )}}" id="profile-tab" data-toggle="tab" href="#BANKS" role="tab" aria-controls="profile" aria-selected="false">Payroll Computation</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='3'? 'active' : '' )}}" id="contact-tab" data-toggle="tab" href="#COSTCENTER" role="tab" aria-controls="contact" aria-selected="false">Gov't Contribution</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='4'? 'active' : '' )}}" id="contact-tab" data-toggle="tab" href="#DEPARTMENT" role="tab" aria-controls="contact" aria-selected="false">Tax Computation</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade {{($page=='1'? 'active show' : ($page==''? 'active show' : '') )}}" id="PROFILE" role="tabpanel" aria-labelledby="home-tab">
            <h2 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">WORK POLICY</h2>
            <div class="container-fluid" >
                <script>
                    $(document).ready(function(){
                        $("#work_policy_form").submit(function(e) {
                        e.preventDefault();
                            $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'update_work_policy',                
                            data: $('#work_policy_form').serialize(),
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Updated Work Policy',
                                
                                }).then((result) => {
                                    location.href="setup_payroll?page=1";
                                })

                            }  

                            }) 
                        });
                        $('#taxcomputation').submit(function(e){
                            e.preventDefault();
                            $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'update_tax_computation',                
                            data: $('#taxcomputation').serialize(),
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Updated Tax Computation',
                                
                                }).then((result) => {
                                    location.href="setup_payroll?page=4";
                                })

                            }  

                            }) 
                        });
                        $('#govtcontributionform').submit(function(e){
                            e.preventDefault();
                            $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'update_govt_contribution',                
                            data: $('#govtcontributionform').serialize(),
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Updated Gov\'t Contribution',
                                
                                }).then((result) => {
                                    location.href="setup_payroll?page=3";
                                })

                            }  

                            }) 
                        });
                        $('#payrollcomputationform').submit(function(e){
                            e.preventDefault();
                            $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'update_payroll_computation',                
                            data: $('#payrollcomputationform').serialize(),
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Updated Payroll Computation',
                                
                                }).then((result) => {
                                    location.href="setup_payroll?page=2";
                                })

                            }  

                            }) 
                        });
                    });
                </script>
                <form id="work_policy_form">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-5 col-left">
                            <div class="form-group ">
                                <label for="DayPerYear">Work Days per Year</label>
                                <select id="DayPerYear" name="DayPerYear" class="form-control">
                                <option {{(!empty($company_work_policy)? ($company_work_policy->work_day_per_year==""? 'Selected' : '' ) : '')}}></option>
                                <option {{(!empty($company_work_policy)? ($company_work_policy->work_day_per_year=="258"? 'Selected' : '' ) : '')}}>258</option>
                                <option {{(!empty($company_work_policy)? ($company_work_policy->work_day_per_year=="261"? 'Selected' : '' ) : '')}}>261</option>
                                <option {{(!empty($company_work_policy)? ($company_work_policy->work_day_per_year=="313"? 'Selected' : '' ) : '')}}>313</option>
                                <option {{(!empty($company_work_policy)? ($company_work_policy->work_day_per_year=="314"? 'Selected' : '' ) : '')}}>314</option>
                                <option {{(!empty($company_work_policy)? ($company_work_policy->work_day_per_year=="365"? 'Selected' : '' ) : '')}}>365</option>
                                <option {{(!empty($company_work_policy)? ($company_work_policy->work_day_per_year=="393.5"? 'Selected' : '' ) : '')}}>393.5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7  col-right">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-left">
                            <div class="form-group ">
                                <label for="workhourperday">Work Hour Per Day</label>
                                <input type="number" id="workhourperday" name="workhourperday" value="{{(!empty($company_work_policy)? $company_work_policy->work_hour_per_day : '')}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-7  col-right">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-left">
                            <div class="form-group ">
                                <label for="workhourstart">Work Hour Start</label>
                                <input type="time" value="{{(!empty($company_work_policy)? $company_work_policy->workhourstart : '')}}"  id="workhourstart" name="workhourstart" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-7  col-right">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-left">
                            <div class="form-group ">
                                <label for="workhourend">Work Hour End</label>
                                <input type="time" id="workhourend" value="{{(!empty($company_work_policy)? $company_work_policy->workhourend : '')}}" name="workhourend" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-7  col-right">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-left">
                            <div class="form-group ">
                                <label for="breakhour">Break Hours</label>
                                <input type="time" id="breakhour" value="{{(!empty($company_work_policy)? $company_work_policy->breakhour : '')}}" name="breakhour" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-7  col-right">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 col-left">
                            <div class="form-group" style="text-align:right;">
                                <input type="submit" name="SaveWorkPolicy" value="Save" class="btn btn-primary">
                                <input type="Reset" value="Reset" class="btn btn-primary">
                            </div>
                        </div>
                        <div class="col-md-7">
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='2'? 'active show' : '' )}}" id="BANKS" role="tabpanel" aria-labelledby="profile-tab">
            <h2 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">PAYROLL COMPUTATION</h2>
            <div class="container-fluid" >
                <form id="payrollcomputationform">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <h4 style="padding:3px;margin-top:0px;background-color:#083240;color:white;">Periods Per Month</h4>
                        </div>
                        <div class="col-md-6  col-right">
                            <h4 style="padding:3px;margin-top:0px;background-color:#083240;color:white;">New Hire Prorated Computation</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3  col-left">
                            <div class="form-group">
                                <select name="periodspermonth" id="periodspermonth" class="form-control">
                                    <option value="1" {{(!empty($payroll_computation)? ($payroll_computation->periodpermonth=="1"? 'Selected' : '' ) : '')}}>Monthly</option>
                                    <option value="2" {{(!empty($payroll_computation)? ($payroll_computation->periodpermonth=="2"? 'Selected' : '' ) : '')}}>Semi Monthly</option>
                                    <option value="3" {{(!empty($payroll_computation)? ($payroll_computation->periodpermonth=="3"? 'Selected' : '' ) : '')}}>Bi-Weekly</option>
                                    <option value="4" {{(!empty($payroll_computation)? ($payroll_computation->periodpermonth=="4"? 'Selected' : '' ) : '')}}>Weekly</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3  col-left col-right">
                            
                        </div>
                        <div class="col-md-6  col-right">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked onclick="return false" value="1" id="BasicPayroll" name="BasicPayroll">
                                <label class="form-check-label" for="BasicPayroll">
                                    Basic Salary
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_new_hire)? ($payroll_computation_new_hire->deminimis=="1"? 'checked' : '' ) : '')}} value="1" id="DeminimisPayroll" name="DeminimisPayroll">
                                <label class="form-check-label" for="DeminimisPayroll">
                                    Deminimis
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_new_hire)? ($payroll_computation_new_hire->allowance=="1"? 'checked' : '' ) : '')}} value="1" id="AllowancePayroll" name="AllowancePayroll">
                                <label class="form-check-label" for="AllowancePayroll">
                                    Allowance
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <h4 style="padding:3px;margin-top:0px;background-color:#083240;color:white;">Statutory Period Schedule</h4>
                        </div>
                        <div class="col-md-6  col-right">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" {{(!empty($payroll_computation_new_hire)? ($payroll_computation_new_hire->reimbursable_allowance=="1"? 'checked' : '' ) : '')}} id="ReimbursablePayroll" name="ReimbursablePayroll">
                                <label class="form-check-label" for="ReimbursablePayroll">
                                    Reimbursable Allowance
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" {{(!empty($payroll_computation_new_hire)? ($payroll_computation_new_hire->ecola=="1"? 'checked' : '' ) : '')}} id="ECOLAPayroll" name="ECOLAPayroll">
                                <label class="form-check-label" for="ECOLAPayroll">
                                    ECOLA
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3  col-left">
                            <div class="form-group">
                                <select name="statutoryperiodschedule" id="statutoryperiodschedule" class="form-control">
                                    <option value="Regular" {{(!empty($payroll_computation)? ($payroll_computation->stationaryperiodschedule=="Regular"? 'Selected' : '' ) : '')}}>Regular(1-15 and 16-30)</option>
                                    <option value="Irregular" {{(!empty($payroll_computation)? ($payroll_computation->stationaryperiodschedule=="Irregular"? 'Selected' : '' ) : '')}}>Irregular(Any Other Schedule)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3  col-left col-right">
                            
                        </div>
                        <div class="col-md-6  col-right">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <h4 style="padding:3px;margin-top:0px;background-color:#083240;color:white;">Absent Deduction</h4>
                        </div>
                        <div class="col-md-6  col-right">
                            <h4 style="padding:3px;margin-top:0px;background-color:#083240;color:white;">13th Month Computation</h4>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox"  checked onclick="return false" value="1" id="BasicAbsentPayroll" name="BasicAbsentPayroll">
                                <label class="form-check-label" for="BasicAbsentPayroll">
                                    Basic Salary
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_absent)? ($payroll_computation_absent->deminimis=="1"? 'checked' : '' ) : '')}} value="1" id="DeminimisAbsentPayroll" name="DeminimisAbsentPayroll">
                                <label class="form-check-label" for="DeminimisAbsentPayroll">
                                    Deminimis
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_absent)? ($payroll_computation_absent->allowance=="1"? 'checked' : '' ) : '')}} value="1" id="AllowanceAbsentPayroll" name="AllowanceAbsentPayroll">
                                <label class="form-check-label" for="AllowanceAbsentPayroll">
                                    Allowance
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6  col-left ">
                            <div class="form-group form-inline">
                            <label for="NewHireCompType" style="margin-right:10px;">Computation Type</label>
                                <select class="form-control" name="NewHireCompType">
                                    <option value="Prorated/Advance" {{(!empty($payroll_computation)? ($payroll_computation->newhireprorated_type=="Prorated/Advance"? 'Selected' : '' ) : '')}}>Pro-rated/Advance</option>
                                    <option value="Prorated/Current/Salary" {{(!empty($payroll_computation)? ($payroll_computation->newhireprorated_type=="Prorated/Current/Salary"? 'Selected' : '' ) : '')}}>Pro-rated/Current/Full Salary</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" {{(!empty($payroll_computation_absent)? ($payroll_computation_absent->reimbursable_allowance=="1"? 'checked' : '' ) : '')}} id="ReimbursableAbsentPayroll" name="ReimbursableAbsentPayroll">
                                <label class="form-check-label" for="ReimbursableAbsentPayroll">
                                    Reimbursable Allowance
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_absent)? ($payroll_computation_absent->ecola=="1"? 'checked' : '' ) : '')}} value="1" id="ECOLAAbsentPayroll" name="ECOLAAbsentPayroll">
                                <label class="form-check-label" for="ECOLAAbsentPayroll">
                                    ECOLA
                                </label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6  col-left ">
                            <div class="form-group form-inline">
                            <label for="NEWHIREDEDUCTABSENT" style="margin-right:10px;">Deduct Absent?</label>
                                <select class="form-control" name="NEWHIREDEDUCTABSENT">
                                    <option value="0" {{(!empty($payroll_computation)? ($payroll_computation->deductabsent=="0"? 'Selected' : '' ) : '')}}>NO</option>
                                    <option value="1" {{(!empty($payroll_computation)? ($payroll_computation->deductabsent=="1"? 'Selected' : '' ) : '')}}>YES</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <h4 style="padding:3px;margin-top:0px;background-color:#083240;color:white;">Late Deduction</h4>
                        </div>
                        <div class="col-md-6 col-right">
                            <div class="form-group form-inline">
                            <label for="NEWHIREDEDUCTLATE" style="margin-right:10px;">Deduct Late/Undertime?</label>
                                <select class="form-control" name="NEWHIREDEDUCTLATE">
                                    <option value="0" {{(!empty($payroll_computation)? ($payroll_computation->deductlate=="0"? 'Selected' : '' ) : '')}}>NO</option>
                                    <option value="1" {{(!empty($payroll_computation)? ($payroll_computation->deductlate=="1"? 'Selected' : '' ) : '')}}>YES</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input"   type="checkbox" checked onclick="return false" value="1" id="BasicLatePayroll" name="BasicLatePayroll">
                                <label class="form-check-label" for="BasicLatePayroll">
                                    Basic Salary
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_late)? ($payroll_computation_late->deminimis=="1"? 'checked' : '' ) : '')}} value="1" id="DeminimisLatePayroll" name="DeminimisLatePayroll">
                                <label class="form-check-label" for="DeminimisLatePayroll">
                                    Deminimis
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($payroll_computation_late)? ($payroll_computation_late->allowance=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="AllowanceLatePayroll" name="AllowanceLatePayroll">
                                <label class="form-check-label" for="AllowanceLatePayroll">
                                    Allowance
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6  col-right ">
                            Computation Type
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"  {{(!empty($payroll_computation_late)? ($payroll_computation_late->reimbursable_allowance=="1"? 'checked' : '' ) : '')}} id="ReimbursableLatePayroll" name="ReimbursableLatePayroll">
                                <label class="form-check-label" for="ReimbursableLatePayroll">
                                    Reimbursable Allowance
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_late)? ($payroll_computation_late->ecola=="1"? 'checked' : '' ) : '')}} value="1" id="ECOLALatePayroll" name="ECOLALatePayroll">
                                <label class="form-check-label" for="ECOLALatePayroll">
                                    ECOLA
                                </label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6  col-left ">
                            <div class="row">
                                <div class="col-md-12  col-left ">
                                    <div class="col-md-3  col-left ">
                                        <div class="form-check">
                                        <input class="form-check-input" type="checkbox" checked onclick="return false" value="1" id="Basicthirteen" name="Basicthirteen">
                                        <label class="form-check-label" for="Basicthirteen">
                                            Basic Salary
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3  col-right ">
                                        <div class="form-check">
                                        <input class="form-check-input" {{(!empty($payroll_computation_thirteen)? ($payroll_computation_thirteen->deminimis=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="Deminimisthirteen" name="Deminimisthirteen">
                                        <label class="form-check-label" for="Deminimisthirteen">
                                            Deminimis
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12  col-left ">
                                    <div class="col-md-3  col-left ">
                                        <div class="form-check">
                                        <input class="form-check-input" {{(!empty($payroll_computation_thirteen)? ($payroll_computation_thirteen->bonus=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="Bonusesthirteen" name="Bonusesthirteen">
                                        <label class="form-check-label" for="Bonusesthirteen">
                                            Bonuses
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3  col-right ">
                                        <div class="form-check">
                                        <input class="form-check-input" {{(!empty($payroll_computation_thirteen)? ($payroll_computation_thirteen->overtime=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="Overtimethirteen" name="Overtimethirteen">
                                        <label class="form-check-label" for="Overtimethirteen">
                                            Overtime
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12  col-left ">
                                    <div class="col-md-3  col-left ">
                                        <div class="form-check">
                                        <input class="form-check-input" {{(!empty($payroll_computation_thirteen)? ($payroll_computation_thirteen->late_undertime=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="Absentthirteen" name="Absentthirteen">
                                        <label class="form-check-label" for="Absentthirteen">
                                            Absent/Late
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3  col-right ">
                                        <div class="form-check">
                                        <input class="form-check-input" {{(!empty($payroll_computation_thirteen)? ($payroll_computation_thirteen->basic_adjustment=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="SalaryAdjustmentthirteen" name="SalaryAdjustmentthirteen">
                                        <label class="form-check-label" for="SalaryAdjustmentthirteen">
                                            Salary Adjustment
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-left ">
                                    <div class="col-md-3  col-left ">
                                        <div class="form-check">
                                        <input class="form-check-input" {{(!empty($payroll_computation_thirteen)? ($payroll_computation_thirteen->ecola=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="ECOLAthirteen" name="ECOLAthirteen">
                                        <label class="form-check-label" for="ECOLAthirteen">
                                            ECOLA
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3  col-right ">
                                        <div class="form-check">
                                        <input class="form-check-input" {{(!empty($payroll_computation_thirteen)? ($payroll_computation_thirteen->other_taxable_income=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="Allowancethirteen" name="Allowancethirteen">
                                        <label class="form-check-label" for="Allowancethirteen">
                                            Allowance
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12  col-left ">
                                    <div class="col-md-3  col-left ">
                                        <div class="form-check">
                                        <input class="form-check-input" {{(!empty($payroll_computation_thirteen)? ($payroll_computation_thirteen->allowance_reimbursable_allowance=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="Reimbursablethirteen" name="Reimbursablethirteen">
                                        <label class="form-check-label" for="Reimbursablethirteen">
                                            Reimbursable Allowance
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3  col-right ">
                                        <div class="form-check">
                                        <input class="form-check-input" {{(!empty($payroll_computation_thirteen)? ($payroll_computation_thirteen->commission=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="Commisionthirteen" name="Commisionthirteen">
                                        <label class="form-check-label" for="Commisionthirteen">
                                            Commision
                                        </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <h4 style="padding:3px;margin-top:0px;background-color:#083240;color:white;">Overtime Computation</h4>
                        </div>
                        <div class="col-md-6  col-right">
                            <h4 style="padding:3px;margin-top:0px;background-color:#083240;color:white;">Final Computation</h4>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <div class="form-group form-inline">
                            <label for="WorkDayPerMonth" style="margin-right:10px;">Work Day Per Month</label>
                            <input type="number" class="form-control" id="WorkDayPerMonth" name="WorkDayPerMonth" value="{{(!empty($payroll_computation)? $payroll_computation->work_day_per_month : '')}}">
                            </div>
                        </div>
                        <div class="col-md-6  col-right">
                            Optional
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            Optional
                        </div>
                        <div class="col-md-6  col-right">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input"  type="checkbox" checked onclick="return false" value="1" id="BasicLatefinal" name="BasicLatefinal">
                                <label class="form-check-label" for="BasicLatefinal">
                                    Basic Salary
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_final_computation)? ($payroll_computation_final_computation->deminimis=="1"? 'checked' : '' ) : '')}} value="1" id="DeminimisLatefinal" name="DeminimisLatefinal">
                                <label class="form-check-label" for="DeminimisLatefinal">
                                    Deminimis
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_final_computation)? ($payroll_computation_final_computation->allowance=="1"? 'checked' : '' ) : '')}} value="1" id="AllowanceLatefinal" name="AllowanceLatefinal">
                                <label class="form-check-label" for="AllowanceLatefinal">
                                    Allowance
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input"  type="checkbox" checked onclick="return false" value="1" id="BasicOvertime" name="BasicOvertime">
                                <label class="form-check-label" for="BasicOvertime">
                                    Basic Salary
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($payroll_computation_ot_comp_option)? ($payroll_computation_ot_comp_option->deminimis=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="DeminimisOvertime" name="DeminimisOvertime">
                                <label class="form-check-label" for="DeminimisOvertime">
                                    Deminimis
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($payroll_computation_ot_comp_option)? ($payroll_computation_ot_comp_option->allowance=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="AllowanceOvertime" name="AllowanceOvertime">
                                <label class="form-check-label" for="AllowanceOvertime">
                                    Allowance
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6  col-right ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($payroll_computation_ot_comp_option)? ($payroll_computation_ot_comp_option->reimbursable_allowance=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="ReimbursableOvertime" name="ReimbursableOvertime">
                                <label class="form-check-label" for="ReimbursableOvertime">
                                    Reimbursable Allowance
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($payroll_computation_ot_comp_option)? ($payroll_computation_ot_comp_option->ecola=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="ECOLAOvertime" name="ECOLAOvertime">
                                <label class="form-check-label" for="ECOLAOvertime">
                                    ECOLA
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($payroll_computation_final_computation)? ($payroll_computation_final_computation->reimbursable_allowance=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="ReimbursableLatefinal" name="ReimbursableLatefinal">
                                <label class="form-check-label" for="ReimbursableLatefinal">
                                    Reimbursable Allowance
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($payroll_computation_final_computation)? ($payroll_computation_final_computation->ecola=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="ECOLALatefinal" name="ECOLALatefinal">
                                <label class="form-check-label" for="ECOLALatefinal">
                                    ECOLA
                                </label>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6  col-right ">
                            <div class="form-group form-inline">
                            <label for="NEWHIREDEDUCTABSENTfinal" style="margin-right:10px;">Deduct Absent?</label>
                                <select class="form-control" name="NEWHIREDEDUCTABSENTfinal">
                                    <option value="0" {{(!empty($payroll_computation)? ($payroll_computation->finalcomputation_deductabsent=="0"? 'Selected' : '' ) : '')}}>NO</option>
                                    <option value="1" {{(!empty($payroll_computation)? ($payroll_computation->finalcomputation_deductabsent=="1"? 'Selected' : '' ) : '')}}>YES</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            OT Rates
                        </div>
                        <div class="col-md-6  col-right">
                            <div class="form-group form-inline">
                            <label for="NEWHIREDEDUCTLATEfinal" style="margin-right:10px;">Deduct Late/Undertime?</label>
                                <select class="form-control" name="NEWHIREDEDUCTLATEfinal">
                                    <option value="0" {{(!empty($payroll_computation)? ($payroll_computation->finalcomputation_deductlate=="0"? 'Selected' : '' ) : '')}}>NO</option>
                                    <option value="1" {{(!empty($payroll_computation)? ($payroll_computation->finalcomputation_deductlate=="1"? 'Selected' : '' ) : '')}}>YES</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                
                            </div>
                            <div class="col-md-3 col-left  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="ORDOT" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->ord_ot=="1"? 'checked' : '' ) : '')}} name="ORDOT">
                                <label class="form-check-label" for="ORDOT">
                                    ORD-OT
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-left col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->ord_nd=="1"? 'checked' : '' ) : '')}} id="ORDND" name="ORDND">
                                <label class="form-check-label" for="ORDND">
                                    ORD-ND
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->ord_nd_ot=="1"? 'checked' : '' ) : '')}} id="ORDNDOT" name="ORDNDOT">
                                <label class="form-check-label" for="ORDNDOT">
                                    ORD-ND-OT
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6  col-right ">
                            <h4 style="padding:3px;margin-top:0px;background-color:#083240;color:white;">Rest Day</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->rd=="1"? 'checked' : '' ) : '')}} id="RD" name="RD">
                                <label class="form-check-label" for="RD">
                                    RD
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-left  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->rd_ot=="1"? 'checked' : '' ) : '')}} id="RDOT" name="RDOT">
                                <label class="form-check-label" for="RDOT">
                                    RD-OT
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-left col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->rd_nd=="1"? 'checked' : '' ) : '')}} value="1" id="RDND" name="RDND">
                                <label class="form-check-label" for="RDND">
                                    RD-ND
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->rd_nd_ot=="1"? 'checked' : '' ) : '')}} id="RDNDOT" name="RDNDOT">
                                <label class="form-check-label" for="RDNDOT">
                                    RD-ND-OT
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6  col-right ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox"  {{(!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->sunday=="1"? 'checked' : '' ) : '')}} value="1" id="Sunday" name="Sunday">
                                <label class="form-check-label" for="Sunday">
                                    Sunday
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-left  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->monday=="1"? 'checked' : '' ) : '')}}  value="1" id="Monday" name="Monday">
                                <label class="form-check-label" for="Monday">
                                    Monday
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-left col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->tuesday=="1"? 'checked' : '' ) : '')}}  value="1" id="Tuesday" name="Tuesday">
                                <label class="form-check-label" for="Tuesday">
                                    Tuesday
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox"{{(!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->wednesday=="1"? 'checked' : '' ) : '')}}  value="1" id="Wednesday" name="Wednesday">
                                <label class="form-check-label" for="Wednesday">
                                    Wednesday
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="SH" name="SH">
                                <label class="form-check-label" for="SH">
                                    SH
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-left  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_ot=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="SHOT" name="SHOT">
                                <label class="form-check-label" for="SHOT">
                                    SH-OT
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-left col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_nd=="1"? 'checked' : '' ) : '')}} value="1" id="SHND" name="SHND">
                                <label class="form-check-label" for="SHND">
                                    SH-ND
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_nd_ot=="1"? 'checked' : '' ) : '')}} value="1" id="SHNDOT" name="SHNDOT">
                                <label class="form-check-label" for="SHNDOT">
                                        SH-ND-OT
                                </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6  col-right ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input"  type="checkbox" value="1" {{(!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->thursday=="1"? 'checked' : '' ) : '')}}  id="Thursday" name="Thursday">
                                <label class="form-check-label" for="Thursday">
                                    Thursday
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-left  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->friday=="1"? 'checked' : '' ) : '')}}  type="checkbox" value="1" id="Friday" name="Friday">
                                <label class="form-check-label" for="Friday">
                                    Friday
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3 col-left col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_rest_day)? ($payroll_computation_rest_day->saturday=="1"? 'checked' : '' ) : '')}}  value="1" id="Saturday" name="Saturday">
                                <label class="form-check-label" for="Saturday">
                                    Saturday
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6  col-left ">
                                <div class="col-md-3  col-left ">
                                    <div class="form-check">
                                    <input class="form-check-input" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="LH" name="LH">
                                    <label class="form-check-label" for="LH">
                                        LH
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-left  col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_ot=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="LHOT" name="LHOT">
                                    <label class="form-check-label" for="LHOT">
                                        LH-OT
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-left col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_nd=="1"? 'checked' : '' ) : '')}} value="1" id="LHND" name="LHND">
                                    <label class="form-check-label" for="LHND">
                                        LH-ND
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3  col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_nd_ot=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="LHNDOT" name="LHNDOT">
                                    <label class="form-check-label" for="LHNDOT">
                                        LH-ND-OT
                                    </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6  col-left ">
                                
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6  col-left ">
                                <div class="col-md-3  col-left ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_rd=="1"? 'checked' : '' ) : '')}} id="SHRD" name="SHRD">
                                    <label class="form-check-label" for="SHRD">
                                        SH-RD
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-left  col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_rd_ot=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="SHRDOT" name="SHRDOT">
                                    <label class="form-check-label" for="SHRDOT">
                                        SH-RD-OT
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-left col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_rd_nd=="1"? 'checked' : '' ) : '')}} value="1" id="SHRDND" name="SHRDND">
                                    <label class="form-check-label" for="SHRDND">
                                        SH-RD-ND
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3  col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_rd_nd_ot=="1"? 'checked' : '' ) : '')}} value="1" id="SHRDNDOT" name="SHRDNDOT">
                                    <label class="form-check-label" for="SHRDNDOT">
                                        SH-RD-ND-OT
                                    </label>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6  col-left ">
                                <div class="col-md-3  col-left ">
                                    <div class="form-check">
                                    <input class="form-check-input" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_rd=="1"? 'checked' : '' ) : '')}} type="checkbox" value="1" id="LHRD" name="LHRD">
                                    <label class="form-check-label" for="LHRD">
                                        LH-RD
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-left  col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_rd_ot=="1"? 'checked' : '' ) : '')}} value="1" id="LHRDOT" name="LHRDOT">
                                    <label class="form-check-label" for="LHRDOT">
                                        LH-RD-OT
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-left col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_rd_nd=="1"? 'checked' : '' ) : '')}} value="1" id="LHRDND" name="LHRDND">
                                    <label class="form-check-label" for="LHRDND">
                                        LH-RD-ND
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3  col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_rd_nd_ot=="1"? 'checked' : '' ) : '')}} value="1" id="LHRDNDOT" name="LHRDNDOT">
                                    <label class="form-check-label" for="LHRDNDOT">
                                        LH-RD-ND-OT
                                    </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6  col-left ">
                                
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6  col-left ">
                                <div class="col-md-3  col-left ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh=="1"? 'checked' : '' ) : '')}} id="DH" name="DH">
                                    <label class="form-check-label" for="DH">
                                        DH
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-left  col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_ot=="1"? 'checked' : '' ) : '')}} value="1" id="DHOT" name="DHOT">
                                    <label class="form-check-label" for="DHOT">
                                        DH-OT
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-left col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_nd=="1"? 'checked' : '' ) : '')}} value="1" id="DHND" name="DHND">
                                    <label class="form-check-label" for="DHND">
                                        DH-ND
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3  col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_nd_ot=="1"? 'checked' : '' ) : '')}} value="1" id="DHNDOT" name="DHNDOT">
                                    <label class="form-check-label" for="DHNDOT">
                                        DH-ND-OT
                                    </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6  col-left ">
                                
                            </div>
                    </div>
                    <div class="row">
                            <div class="col-md-6  col-left ">
                                <div class="col-md-3  col-left ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_rd=="1"? 'checked' : '' ) : '')}} id="DHRD" name="DHRD">
                                    <label class="form-check-label" for="DHRD">
                                        DH-RD
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-left  col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_rd_ot=="1"? 'checked' : '' ) : '')}} value="1" id="DHRDOT" name="DHRDOT">
                                    <label class="form-check-label" for="DHRDOT">
                                        DH-RD-OT
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3 col-left col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_rd_nd=="1"? 'checked' : '' ) : '')}} value="1" id="DHRDND" name="DHRDND">
                                    <label class="form-check-label" for="DHRDND">
                                        DH-RD-ND
                                    </label>
                                    </div>
                                </div>
                                <div class="col-md-3  col-right ">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_rd_nd_ot=="1"? 'checked' : '' ) : '')}} value="1" id="DHRDNDOT" name="DHRDNDOT">
                                    <label class="form-check-label" for="DHRDNDOT">
                                        DH-RD-ND-OT
                                    </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6  col-left ">
                                
                            </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6 col-right">
                            <div class="form-group" style="text-align:right;">
                                <input type="submit" name="SaveWorkPolicy" value="Save" class="btn btn-primary">
                                <input type="Reset" value="Reset" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='3'? 'active show' : '' )}}" id="COSTCENTER" role="tabpanel" aria-labelledby="contact-tab">
            <h2 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">GOVERNMENT CONTRIBUTION</h2>
            <div class="container-fluid" >
                <form id="govtcontributionform">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <h4 style="padding:3px;margin-top:0px;background-color:#083240;color:white;">SSS</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="form-group form-inline">
                                <label for="deductionperiodsss" style="margin-right:10px;">Deduction Period </label>
                                <select class="form-control"  id="deductionperiodsss" name="deductionperiodsss" >
                                    <option {{(!empty($company_govt_cont_sss)? ($company_govt_cont_sss->deduction_period=="1"? 'Selected' : '') : '')}}>1</option>
                                    <option {{(!empty($company_govt_cont_sss)? ($company_govt_cont_sss->deduction_period=="2"? 'Selected' : '') : '')}}>2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox"  checked onclick="return false" value="1" id="BasicSSS" name="BasicSSS">
                                <label class="form-check-label" for="BasicSSS">
                                    Basic Salary
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($company_govt_cont_sss)? ($company_govt_cont_sss->deminimis=="1"? 'checked' : '') : '')}} value="1"  id="DeminimisSSS" name="DeminimisSSS">
                                <label class="form-check-label" for="DeminimisSSS">
                                    Deminimis
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($company_govt_cont_sss)? ($company_govt_cont_sss->bonus=="1"? 'checked' : '') : '')}} value="1" id="BonusesSSS" name="BonusesSSS">
                                <label class="form-check-label" for="BonusesSSS">
                                    Bonuses
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($company_govt_cont_sss)? ($company_govt_cont_sss->overtime=="1"? 'checked' : '') : '')}}  type="checkbox" value="1" id="OvertimeSSS" name="OvertimeSSS">
                                <label class="form-check-label" for="OvertimeSSS">
                                    Overtime
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($company_govt_cont_sss)? ($company_govt_cont_sss->absent_late=="1"? 'checked' : '') : '')}} type="checkbox" value="1" id="AbsentSSS" name="AbsentSSS">
                                <label class="form-check-label" for="AbsentSSS">
                                    Absent/Late
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input"  {{(!empty($company_govt_cont_sss)? ($company_govt_cont_sss->salary_adjustment=="1"? 'checked' : '') : '')}} type="checkbox" value="1" id="SalaryAdjustmentSSS" name="SalaryAdjustmentSSS">
                                <label class="form-check-label" for="SalaryAdjustmentSSS">
                                    Salary Adjustment
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input"  {{(!empty($company_govt_cont_sss)? ($company_govt_cont_sss->ecola=="1"? 'checked' : '') : '')}} type="checkbox" value="1" id="ECOLASSS" name="ECOLASSS">
                                <label class="form-check-label" for="ECOLASSS">
                                    ECOLA
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" {{(!empty($company_govt_cont_sss)? ($company_govt_cont_sss->allowance=="1"? 'checked' : '') : '')}}  id="AllowanceSSS" name="AllowanceSSS">
                                <label class="form-check-label" for="AllowanceSSS">
                                    Allowance
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($company_govt_cont_sss)? ($company_govt_cont_sss->reimbursable_allowance=="1"? 'checked' : '') : '')}} type="checkbox" value="1" id="ReimbursableSSS" name="ReimbursableSSS">
                                <label class="form-check-label" for="ReimbursableSSS">
                                    Reimbursable Allowance
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($company_govt_cont_sss)? ($company_govt_cont_sss->commission=="1"? 'checked' : '') : '')}} type="checkbox" value="1" id="CommisionSSS" name="CommisionSSS">
                                <label class="form-check-label" for="CommisionSSS">
                                    Commision
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <h4 style="padding:3px;margin-top:0px;background-color:#083240;color:white;">PhilHealth</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="form-group form-inline">
                                <label for="deductionperiodphilhealth" style="margin-right:10px;">Deduction Period </label>
                                <select class="form-control"  id="deductionperiodphilhealth" name="deductionperiodphilhealth" >
                                    <option {{(!empty($company_govt_cont_philhealth)? ($company_govt_cont_philhealth->deduction_period=="1"? 'Selected' : '') : '')}}>1</option>
                                    <option {{(!empty($company_govt_cont_philhealth)? ($company_govt_cont_philhealth->deduction_period=="2"? 'Selected' : '') : '')}}>2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--Philhealth-->
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" checked onclick="return false" value="1" id="BasicPhilHealth" name="BasicPhilHealth">
                                <label class="form-check-label" for="BasicPhilHealth">
                                    Basic Salary
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($company_govt_cont_philhealth)? ($company_govt_cont_philhealth->basic_salary=="1"? 'checked' : '') : '')}}  type="checkbox" value="1" id="DeminimisPhilHealth" name="DeminimisPhilHealth">
                                <label class="form-check-label" for="DeminimisPhilHealth">
                                    Deminimis
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox" {{(!empty($company_govt_cont_philhealth)? ($company_govt_cont_philhealth->bonus=="1"? 'checked' : '') : '')}} value="1" id="BonusesPhilHealth" name="BonusesPhilHealth">
                                <label class="form-check-label" for="BonusesPhilHealth">
                                    Bonuses
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($company_govt_cont_philhealth)? ($company_govt_cont_philhealth->overtime=="1"? 'checked' : '') : '')}} type="checkbox" value="1" id="OvertimePhilHealth" name="OvertimePhilHealth">
                                <label class="form-check-label" for="OvertimePhilHealth">
                                    Overtime
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($company_govt_cont_philhealth)? ($company_govt_cont_philhealth->absent_late=="1"? 'checked' : '') : '')}} type="checkbox" value="1" id="AbsentPhilHealth" name="AbsentPhilHealth">
                                <label class="form-check-label" for="AbsentPhilHealth">
                                    Absent/Late
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($company_govt_cont_philhealth)? ($company_govt_cont_philhealth->salary_adjustment=="1"? 'checked' : '') : '')}} type="checkbox" value="1" id="SalaryAdjustmentPhilHealth" name="SalaryAdjustmentPhilHealth">
                                <label class="form-check-label" for="SalaryAdjustmentPhilHealth">
                                    Salary Adjustment
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($company_govt_cont_philhealth)? ($company_govt_cont_philhealth->ecola=="1"? 'checked' : '') : '')}} type="checkbox" value="1" id="ECOLAPhilHealth" name="ECOLAPhilHealth">
                                <label class="form-check-label" for="ECOLAPhilHealth">
                                    ECOLA
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($company_govt_cont_philhealth)? ($company_govt_cont_philhealth->allowance=="1"? 'checked' : '') : '')}} type="checkbox" value="1" id="AllowancePhilHealth" name="AllowancePhilHealth">
                                <label class="form-check-label" for="AllowancePhilHealth">
                                    Allowance
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="col-md-3  col-left ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($company_govt_cont_philhealth)? ($company_govt_cont_philhealth->reimbursable_allowance=="1"? 'checked' : '') : '')}} type="checkbox" value="1" id="ReimbursablePhilHealth" name="ReimbursablePhilHealth">
                                <label class="form-check-label" for="ReimbursablePhilHealth">
                                    Reimbursable Allowance
                                </label>
                                </div>
                            </div>
                            <div class="col-md-3  col-right ">
                                <div class="form-check">
                                <input class="form-check-input" {{(!empty($company_govt_cont_philhealth)? ($company_govt_cont_philhealth->commission=="1"? 'checked' : '') : '')}} type="checkbox" value="1" id="CommisionPhilHealth" name="CommisionPhilHealth">
                                <label class="form-check-label" for="CommisionPhilHealth">
                                    Commision
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <h4 style="padding:3px;margin-top:0px;background-color:#083240;color:white;">HDMF</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="form-group form-inline">
                                <label for="deductionperiodHDMF" style="margin-right:10px;">Deduction Period </label>
                                <select class="form-control"  id="deductionperiodHDMF" name="deductionperiodHDMF" >
                                    <option {{(!empty($company_info)? ($company_info->deduction_period=="1"? 'Selected' : '') : '')}}>1</option>
                                    <option {{(!empty($company_info)? ($company_info->deduction_period=="2"? 'Selected' : '') : '')}}>2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left ">
                            <div class="form-group form-inline">
                                <label for="equivalentemployer" style="margin-right:10px;">Equivalent Employer Share? </label>
                                <select class="form-control"  id="equivalentemployer" name="equivalentemployer" >
                                    <option {{(!empty($company_info)? ($company_info->deduction_period=="0"? 'Selected' : '') : '')}} value="0">NO</option>
                                    <option {{(!empty($company_info)? ($company_info->deduction_period=="1"? 'Selected' : '') : '')}} value="1">YES</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-left">
                            <div class="form-group" style="text-align:right;">
                                <input type="submit" name="SaveWorkPolicy" value="Save" class="btn btn-primary">
                                <input type="Reset" value="Reset" class="btn btn-primary">
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='4'? 'active show' : '' )}}" id="DEPARTMENT" role="tabpanel" aria-labelledby="contact-tab">
            <h2 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">TAX COMPUTATION</h2>
            <div class="container-fluid">
                <form id="taxcomputation">
                    {{ csrf_field() }}
                    
                    <div class="row">
                        <div class="col-md-3 col-left">
                            <div class="form-group ">
                                <label for="useannualtaxtable">Use Annual Tax Table</label>
                                <select id="useannualtaxtable" name="useannualtaxtable" class="form-control">
                                    <option value="0" {{(!empty($company_tax_computation)? ($company_tax_computation->use_annual_tax_table=="0"? 'Selected' : '' ) : '')}}>NO</option>
                                    <option value="1" {{(!empty($company_tax_computation)? ($company_tax_computation->use_annual_tax_table=="1"? 'Selected' : '' ) : '')}}>YES</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-left col-right">
                            <div class="form-group ">
                                <label for="startofanualization">Start of Annualization</label>
                                <select id="startofanualization" name="startofanualization" class="form-control">
                                    <option {{(!empty($company_tax_computation)? ($company_tax_computation->start_of_annualization=="January"? 'Selected' : '' ) : '')}}>January</option>
                                    <option {{(!empty($company_tax_computation)? ($company_tax_computation->start_of_annualization=="February"? 'Selected' : '' ) : '')}}>February</option>
                                    <option {{(!empty($company_tax_computation)? ($company_tax_computation->start_of_annualization=="March"? 'Selected' : '' ) : '')}}>March</option>
                                    <option {{(!empty($company_tax_computation)? ($company_tax_computation->start_of_annualization=="April"? 'Selected' : '' ) : '')}}>April</option>
                                    <option {{(!empty($company_tax_computation)? ($company_tax_computation->start_of_annualization=="May"? 'Selected' : '' ) : '')}}>May</option>
                                    <option {{(!empty($company_tax_computation)? ($company_tax_computation->start_of_annualization=="June"? 'Selected' : '' ) : '')}}>June</option>
                                    <option {{(!empty($company_tax_computation)? ($company_tax_computation->start_of_annualization=="July"? 'Selected' : '' ) : '')}}>July</option>
                                    <option {{(!empty($company_tax_computation)? ($company_tax_computation->start_of_annualization=="August"? 'Selected' : '' ) : '')}}>August</option>
                                    <option {{(!empty($company_tax_computation)? ($company_tax_computation->start_of_annualization=="September"? 'Selected' : '' ) : '')}}>September</option>
                                    <option {{(!empty($company_tax_computation)? ($company_tax_computation->start_of_annualization=="October"? 'Selected' : '' ) : '')}}>October</option>
                                    <option {{(!empty($company_tax_computation)? ($company_tax_computation->start_of_annualization=="November"? 'Selected' : '' ) : '')}}>November</option>
                                    <option {{(!empty($company_tax_computation)? ($company_tax_computation->start_of_annualization=="December"? 'Selected' : '' ) : '')}}>December</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6  col-right">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6  col-left">
                            <div class="form-group">
                                <label for="exemptionceiling">Non-Tax Exemption Ceiling</label>
                                <input type="number" class="form-control"  id="exemptionceiling" value="{{(!empty($company_tax_computation)?  $company_tax_computation->non_tax_exemption_ceiling : '')}}" name="exemptionceiling" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-left">
                            <div class="form-group" style="text-align:right;">
                                <input type="submit" name="SaveWorkPolicy" value="Save" class="btn btn-primary">
                                <input type="Reset" value="Reset" class="btn btn-primary">
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection