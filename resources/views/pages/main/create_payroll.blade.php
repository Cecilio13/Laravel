@extends('main.main')


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2 style="font-weight:bold;color:#083240;margin-top:10px;margin-bottom:0px;">CREATE PAYROLL</h2>
        </div>
    </div>
    <script>
        function SetFROMTO(){
            var monthname=document.getElementById('paymonth').value;
            var period=document.getElementById('payid').value;
            var today = new Date();
            var yyyy = today.getFullYear();
            var month="01";
            var endday=31;
            var paytrolltype=document.getElementById('paytrolltype').value;
            if(paytrolltype=="13th Month"){
                changeTypePayroll();
            }
            else if(paytrolltype=="Normal Payroll"){
            if(period=="1"){
                if('{{!empty($company_govt_cont_philhealth)? $company_govt_cont_philhealth->deduction_period : ''}}'==1){
                    document.getElementById('comp_phic').value="2";
                }else{
                    document.getElementById('comp_phic').value="0";
                }
                if('{{!empty($company_govt_cont_sss)? $company_govt_cont_sss->deduction_period : ''}}'==1){
                    document.getElementById('comp_sss').value="2";
                }else{
                    document.getElementById('comp_sss').value="0";
                }
                if('{{!empty($company_info)? $company_info->deduction_period : '' }}'==1){
                    document.getElementById('comp_pagibig').value="2";
                }else{
                    document.getElementById('comp_pagibig').value="0";
                }
                
            }else{
                if('{{!empty($company_govt_cont_philhealth)? $company_govt_cont_philhealth->deduction_period : ''}}'==2){
                    document.getElementById('comp_phic').value="2";
                }else{
                    document.getElementById('comp_phic').value="0";
                }
                if('{{!empty($company_govt_cont_sss)? $company_govt_cont_sss->deduction_period : ''}}'==2){
                    document.getElementById('comp_sss').value="2";
                }else{
                    document.getElementById('comp_sss').value="0";
                }
                if('{{!empty($company_info)? $company_info->deduction_period : '' }}'==2){
                    document.getElementById('comp_pagibig').value="2";
                }else{
                    document.getElementById('comp_pagibig').value="0";
                }                      
            }


            if(monthname=="January"){
                month="01";
                endday=31;
            }
            if(monthname=="February"){
                month="02";
                endday=28;
            }
            if(monthname=="March"){
                month="03";
                endday=31;
            }
            if(monthname=="April"){
                month="04";
                endday=30;
            }
            if(monthname=="May"){
                month="05";
                endday=31;
            }
            if(monthname=="June"){
                month="06";
                endday=30;
            }
            if(monthname=="July"){
                month="07";
                endday=31;
            }
            if(monthname=="August"){
                month="08";
                endday=31;
            }
            if(monthname=="September"){
                month="09";
                endday=30;
            }
            if(monthname=="October"){
                month="10";
                endday=31;
            }
            if(monthname=="November"){
                month="11";
                endday=30;
            }
            if(monthname=="December"){
                month="12";
                endday=31;
            }
            if(period==1){
                document.getElementById('FROM').value=yyyy+"-"+month+"-"+"01";
                document.getElementById('TO').value=yyyy+"-"+month+"-"+"15";
            }
            if(period==2){
                document.getElementById('FROM').value=yyyy+"-"+month+"-"+"15";
                document.getElementById('TO').value=yyyy+"-"+month+"-"+endday;
            }
            }
            
        }
    </script>
    <script>
    $(document).ready(function(){
        changeTypePayroll();
        $("#create_payroll_form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'add_new_payroll',                
                data: $('#create_payroll_form').serialize(),
                success: function(data) {
                    if(data==0){
                        Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'This Payroll Already Existed',
                        }).then((result) => {
                            // location.href="setup_references?page=4";
                        })
                    }
                    if(data==1){
                        Swal.fire({
                        type: 'success',
                        title: 'Success',
                        text: 'Successfuly Added Payroll',
                        }).then((result) => {
                            location.href="create_payroll";
                        })
                    }
                    
                }
            })
        });
    });
    </script>
    <form id="create_payroll_form">
    <div class="row">
        <div class="col-md-10">
            <table class="table borderless table-sm" style=" background-color:white;">
                                   
                <thead style="background-color:#124f62; color:white;">
                  <tr>
                    <th colspan="4">Payroll Period</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="color:#083240;">Year</td>
                    <td><input type="number" min="2018" step="1" value="2019" class="form-control" name="PayrollYear"></td>
                    <td style="color:#083240;">Payroll Type</td>
                    <td>
                        <script>
                        function changeTypePayroll(){
                            document.getElementById('out').value="";
                            document.getElementById('comp_pagibig').value="0";
                            document.getElementById('comp_phic').value="0";
                            document.getElementById('comp_sss').value="0";
                            var paytrolltype=document.getElementById('paytrolltype').value;
                            if(paytrolltype=="13th Month"){
                                var today = new Date();
                                var yyyy = today.getFullYear();
                                var period=document.getElementById('payid').value;
                                if(period==1){
                                    document.getElementById('FROM').value=yyyy+"-01-"+"01";
                                    document.getElementById('TO').value=yyyy+"-06-"+"30";
                                }
                                if(period==2){
                                    document.getElementById('FROM').value=yyyy+"-07-"+"01";
                                    document.getElementById('TO').value=yyyy+"-12-31";
                                }
                            }
                            else if(paytrolltype=="Normal Payroll"){
                                SetFROMTO();
                            }
                            
                        }
                        </script>
                        <select class="form-control" id="paytrolltype" name="PayrollType" onchange="changeTypePayroll()">
                            <option>Normal Payroll</option>
                            <option>13th Month</option>
                            <option>Final Pay</option>
                        </select>
                    </td>
                    
                    
                  </tr>
                  <tr>
                    <td style="color:#083240;">Month</td>
                    <td>
                        <select class="form-control" name="PayrollMonth" id="paymonth" onchange="SetFROMTO()">
                            <option {{date('F')=="January"? 'selected' : ''}}>January</option>
                            <option {{date('F')=="February"? 'selected' : ''}}>February</option>
                            <option {{date('F')=="March"? 'selected' : ''}}>March</option>
                            <option {{date('F')=="April"? 'selected' : ''}}>April</option>
                            <option {{date('F')=="May"? 'selected' : ''}}>May</option>
                            <option {{date('F')=="June"? 'selected' : ''}}>June</option>
                            <option {{date('F')=="July"? 'selected' : ''}}>July</option>
                            <option {{date('F')=="August"? 'selected' : ''}}>August</option>
                            <option {{date('F')=="September"? 'selected' : ''}}>September</option>
                            <option {{date('F')=="October"? 'selected' : ''}}>October</option>
                            <option {{date('F')=="November"? 'selected' : ''}}>November</option>
                            <option {{date('F')=="December"? 'selected' : ''}}>December</option>
                        </select>
                    </td>
                    <td style="color:#083240;">Transaction Date</td>
                    <td>
                        <input type="date" class="form-control" name="PayrollTransactionDate" required="">
                    </td>
                  </tr>
                  <tr>
                    <td style="color:#083240;">Employee Type </td>
                    <td>
                        <select class="form-control" name="EmployeeType">
                            <option>Both</option>
                            <option>Rank And File</option>
                            <option>Executive</option>
                            <option>Supervisory</option>
                        </select>
                    </td>
                    <td style="color:#083240;">From</td>
                    <td>
                        <input type="date" class="form-control" id="FROM" name="PayrollFrom" required="">
                    </td>
                  </tr>
                  <tr>
                    <td style="color:#083240;">Period</td>
                    <td>
                        <select class="form-control" name="PayrollPeriod" id="payid" onchange="SetFROMTO()">
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </td>
                    <td style="color:#083240;">To</td>
                    <td>
                        <input type="date" class="form-control" id="TO" name="PayrollTo" required="">
                    </td>
                  </tr>
                  <tr>
                    <td style="color:#083240;">Description</td>
                    <td colspan="3">
                        <textarea class="form-control" rows="3" id="out" name="PayrollDescription"></textarea>
                    </td>
                    
                  </tr>
                 
                </tbody>
              </table>
              <script>
                var typingTimer;                //timer identifier
                var doneTypingInterval = 500;  //time in ms, .5 second for example

                //on keyup, start the countdown
                $('#FROM').on("input",function(){
                    clearTimeout(typingTimer);
                    if ($('#FROM').val) {
                        typingTimer = setTimeout(function(){
                            //do stuff here e.g ajax call etc....
                             var v = $("#FROM").val();
                             var T = $("#TO").val();
                             
                             if(v!="" && T!=""){
                                 $("#out").val("Payroll Period for "+v+" To "+T); 
                             }
                            
                        }, doneTypingInterval);
                    }
                });
                $('#TO').on("input",function(){
                    clearTimeout(typingTimer);
                    if ($('#TO').val) {
                        typingTimer = setTimeout(function(){
                            //do stuff here e.g ajax call etc....
                             var v = $("#FROM").val();
                             var T = $("#TO").val();
                            
                             if(v!="" && T!=""){
                                 $("#out").val("Payroll Period for "+v+" To "+T); 
                             }
                            
                        }, doneTypingInterval);
                    }
                });
              </script>
              <table class="table borderless table-sm" style=" background-color:white;margin-bottom:10px;">
            
                <thead style="background-color:#124f62; color:white;">
                  <tr>
                    <th colspan="4">Payroll Option</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="color:#083240;">Compute PHIC</td>
                    <td>
                        <select class="form-control" name="ComputePHIC" id="comp_phic">
                            <option value="0">NO</option>
                            <option value="1">YES</option>
                            <option value="2" {{!empty($company_govt_cont_philhealth)? ($company_govt_cont_philhealth->deduction_period=="1"? 'selected' : '') : '' }}>YES - FULL</option>

                                                                
                        </select>
                    </td>
                    
                    <td style="color:#083240;">Compute Tax</td>
                    <td>
                        <select class="form-control" name="ComputeTax" id="tax" onchange="DisableForce()">
                            <option value="1">YES</option>
                            <option value="0">NO</option>
                            
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td style="color:#083240;">Compute SSS</td>
                    <td><select class="form-control" name="ComputeSSS" id="comp_sss">
                                <option value="0">NO</option>
                                <option value="2" {{!empty($company_govt_cont_sss)? ($company_govt_cont_sss->deduction_period=="1"? 'selected' : '') : '' }}>YES - FULL</option>
                                <option value="1" >YES</option>
                                
                                                                    
                        </select>
                    </td>
                    
                    <td style="color:#083240;">Force End of Month</td>
                    <td>
                        <select class="form-control" id="Force" name="ForceEnd" disabled="">
                            <option value="0">NO</option>
                            <option value="1">YES</option>
                        </select>
                    </td>
                  </tr>
                  <tr>
                    <td style="color:#083240;">Compute Pag-Ibig</td>
                    <td>
                        <select class="form-control" name="ComputePagibig" id="comp_pagibig">
                            <option value="0" >NO</option> 
                            <option value="2" {{!empty($company_info)? ($company_info->deduction_period=="1"? 'selected' : '') : '' }}>YES - FULL</option>
                            <option value="1" >YES</option>
                                   
                        </select>
                    </td>
                    
                    <td style="color:#083240;">Use Annual Calculation</td>
                    <td>
                        <select class="form-control" name="UseAnnualCal">
                            <option value="0">NO</option>
                            <option value="1">YES</option>
                        </select>
                    </td>
                  </tr>
                </tbody>
              </table>
              <script>
                function DisableForce(){
                    var e = document.getElementById('tax').value;
                    if(e==1){
                        document.getElementById('Force').value=0;
                        document.getElementById('Force').disabled=true;
                    }
                    if(e==0){
                        document.getElementById('Force').disabled=false;
                    }
                }
              </script>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10" style="text-align:right;">
            <input type="submit" class="btn btn-primary" value="SAVE" onclick="DDDD()" name="SubmitSalary">
            <input type="reset" class="btn btn-primary" value="CLEAR">
        </div>
        <script>
            function DDDD(){
                document.getElementById('Force').disabled=false;
            }
        </script>
    </div>
    </form>
</div>
@endsection