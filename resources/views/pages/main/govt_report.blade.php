@extends('main.main')


@section('content')
<style>
table td{
  vertical-align: top !important;
}
</style>
<div class="container-fluid" >
    <ul class="nav nav-tabs nav-tab-custom govt_report_tabs"   role="tablist">
        <li class="nav-item" >
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#SSS" role="tab" aria-controls="home" aria-selected="true">SSS</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#PhilHealth" role="tab" aria-controls="profile" aria-selected="false">PhilHealth</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#PAGIBIG" role="tab" aria-controls="contact" aria-selected="false">PAG-IBIG</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#BIR" role="tab" aria-controls="contact" aria-selected="false">BIR</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#CONTRIBUTION" role="tab" aria-controls="contact" aria-selected="false">CERTIFICATE OF CONTRIBUTION</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#LOAN" role="tab" aria-controls="contact" aria-selected="false">CERTIFICATE OF LOAN</a>
        </li>
    </ul>
    <div class="tab-content" id="govtreporttabpane">
        <div class="tab-pane fade show active" id="SSS" role="tabpanel" aria-labelledby="home-tab">
            <ul class="nav nav-tabs nav-tab-custom govt_report_tabs "   role="tablist">
                <li class="nav-item" >
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#R3" role="tab" aria-controls="home" aria-selected="true">R-3</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#R5" role="tab" aria-controls="profile" aria-selected="false">R-5</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#SSSLMS" role="tab" aria-controls="contact" aria-selected="false">SSS-LMS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#ML1" role="tab" aria-controls="contact" aria-selected="false">ML-1</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#R1A" role="tab" aria-controls="contact" aria-selected="false">R1-A</a>
                </li>
            </ul>
        </div>
        <div class="tab-pane fade" id="PhilHealth" role="tabpanel" aria-labelledby="profile-tab">
            <ul class="nav nav-tabs nav-tab-custom govt_report_tabs"   role="tablist">
                <li class="nav-item" >
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#ER2" role="tab" aria-controls="home" aria-selected="true">ER-2</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#RF1Data" role="tab" aria-controls="profile" aria-selected="false">RF-1 Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#RFPDF" role="tab" aria-controls="contact" aria-selected="false">RF-PDF</a>
                </li>
            </ul>
        </div>
        <div class="tab-pane fade" id="PAGIBIG" role="tabpanel" aria-labelledby="contact-tab">
            <ul class="nav nav-tabs nav-tab-custom govt_report_tabs"   role="tablist">
                <li class="nav-item" >
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#MCRF" role="tab" aria-controls="home" aria-selected="true">M1-1 (MCRF)</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#M11EXCEL" role="tab" aria-controls="profile" aria-selected="false">M1-1 Excel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#STLRF" role="tab" aria-controls="contact" aria-selected="false">STLRF</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#STLRFEXCEL" role="tab" aria-controls="contact" aria-selected="false">STLRF EXCEL</a>
                </li>
            </ul>
        </div>
        <div class="tab-pane fade" id="BIR" role="tabpanel" aria-labelledby="contact-tab">
            <ul class="nav nav-tabs nav-tab-custom govt_report_tabs"   role="tablist">
                <li class="nav-item" >
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#ALLBIR" role="tab" aria-controls="home" aria-selected="true">ALL</a>
                </li>
                <li class="nav-item" >
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#BIR1600" role="tab" aria-controls="profile" aria-selected="false">1600</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#BIR1601C" role="tab" aria-controls="contact" aria-selected="false">1601C</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#BIR1601E" role="tab" aria-controls="contact" aria-selected="false">1601E</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#BIR1601F" role="tab" aria-controls="contact" aria-selected="false">1601F</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#BIRSWAT" role="tab" aria-controls="contact" aria-selected="false">SWAT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#BIR1604E" role="tab" aria-controls="contact" aria-selected="false">1604E</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#BIR1604CF" role="tab" aria-controls="contact" aria-selected="false">1604CF</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContentBIR">
                <div class="tab-pane fade show active" id="ALLBIR" role="tabpanel" aria-labelledby="home-tab">
                    <div class="container-fluid" style="padding-top:10px;padding-bottom:10px;">
                        <div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
							<div class="form-inline">
							<div class="form-custom-govt">
								<span>Month / Year :</span>
								<select class="form-control" id="MonthAll" onchange="FillMonth()" name="Month">
								<option value="01">January</option>
								<option value="02">February</option>
								<option value="03">March</option>
								<option value="04">April</option>
								<option value="05">May</option>
								<option value="06">June</option>
								<option value="07">July</option>
								<option value="08">August</option>
								<option value="09">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
								</select>
								<script>
									function FillMonth(){
										var Month=document.getElementById('MonthAll').value;
										document.getElementById('month').value=Month;
										document.getElementById('month_1e').value=Month;
										document.getElementById('month_1f').value=Month;
										document.getElementById('month_3T').value=Month;
										document.getElementById('month_4E').value=Month;
									    document.getElementById('month_1cf').value=Month;
									    document.getElementById('month_1601C').value=Month;
									}
								</script>
								<script>
								document.getElementById('MonthAll').value='09';
								</script>
							</div>
							<div class="form-custom-govt">
								<span>/</span>
								<input type="number" id="YearAll" min="2018" name="Year" value="2019" class="form-control" onkeyup="FillYear()" oninput="FillYear()">
								<script>
								function FillYear(){
									var Year=document.getElementById('YearAll').value;
									document.getElementById('Year1600').value=Year;
									document.getElementById('Year1601E').value=Year;
									document.getElementById('Year1601F').value=Year;
									document.getElementById('YearSWAT').value=Year;
									document.getElementById('Year1604E').value=Year;
									document.getElementById('Year1604CF').value=Year;
									document.getElementById('Year1601C').value=Year;
								}
								</script>
							</div>
							</div>
							<br>
							<div class="form-inline">
								<div class="form-custom-govt">
									<span>Name :</span>
									<input type="text" id="LastNameAll" onkeyup="FillLastname()" oninput="FillLastname()" class="form-control" name="L_Name" placeholder="Last Name">
									<script>
									function FillLastname(){
										var Last=document.getElementById('LastNameAll').value;
										document.getElementById('LastName1600').value=Last;
										document.getElementById('LastName1601E').value=Last;
										document.getElementById('LastName1601F').value=Last;
										document.getElementById('LastNameSWAT').value=Last;
										document.getElementById('LastName1604E').value=Last;
										document.getElementById('LastName1604CF').value=Last;
										document.getElementById('LastName1601C').value=Last;
									}
									</script>
								</div>
								<div class="form-custom-govt">
									<span>,</span>
									<input type="text" id="FirstNameAll" onkeyup="FillFirstname()" oninput="FillFirstname()" class="form-control" name="F_Name" placeholder="First Name">
									<script>
									function FillFirstname(){
										var Last=document.getElementById('FirstNameAll').value;
										document.getElementById('FirstName1600').value=Last;
										document.getElementById('FirstName1601E').value=Last;
										document.getElementById('FirstName1601F').value=Last;
										document.getElementById('FirstNameSWAT').value=Last;
										document.getElementById('FirstName1604E').value=Last;
										document.getElementById('FirstName1604CF').value=Last;
										document.getElementById('FirstName1601C').value=Last;
									}
									</script>
								</div>
								<div class="form-custom-govt">
									<span></span>
									<input type="text" id="MiddleNameAll" onkeyup="FillMiddlename()" oninput="FillMiddlename()" class="form-control" name="M_Name" placeholder="Middle Name">
									<script>
									function FillMiddlename(){
										var Last=document.getElementById('MiddleNameAll').value;
										document.getElementById('MiddleName1600').value=Last;
										document.getElementById('MiddleName1601E').value=Last;
										document.getElementById('MiddleName1601F').value=Last;
										document.getElementById('MiddleNameSWAT').value=Last;
										document.getElementById('MiddleName1604E').value=Last;
										document.getElementById('MiddleName1604CF').value=Last;
										document.getElementById('MiddleName1601C').value=Last;
									}
									</script>
								</div>
							</div>
							<br>
							<div class="form-inline">
								<div class="form-custom-govt">
									<span>1601E Quarter :</span>
									<select class="form-control" onchange="ChangeQuarter1604E(this)">
									<option>Q1</option>
									<option>Q2</option>
									<option>Q3</option>
									<option>Q4</option>
									</select>
									<script>
										function ChangeQuarter1604E(e){
											document.getElementById('Quarter1604E').value=e.value;
										}
									</script>
								</div>
								
							</div>
							<br>
							<div class="form-inline">
								<div class="form-custom-govt">
									<span>1601F Quarter :</span>
									<select class="form-control" onchange="ChangeQuarter1604F(this)">
									<option>Q1</option>
									<option>Q2</option>
									<option>Q3</option>
									<option>Q4</option>
									</select>
									<script>
										function ChangeQuarter1604F(e){
											document.getElementById('Quarter1604F').value=e.value;
										}
									</script>
								</div>
								
							</div>
							<br>
							<div class="form-inline">
								<div class="form-custom-govt">
									<span>1604E Amended Return :</span>
									<select class="form-control" onchange="ChangeAmended1604E(this)">
									<option>N</option>
									<option>Y</option>
									</select>
									<script>
										function ChangeAmended1604E(e){
											document.getElementById('AmendedReturn1604E').value=e.value;
										}
									</script>
								</div>
								
								<div class="form-custom-govt">
									<span>1604E No  of Sheet Attached</span>
									<input type="number" class="form-control" onkeyup="FillSheet1604E(this)" oninput="FillSheet1604E(this)" value="0">
									<script>
										function FillSheet1604E(e){
											document.getElementById('SheetNo1604E').value=e.value;
										}
									</script>
								</div>
								
							</div>
							<br>
							<div class="form-inline">
								<div class="form-custom-govt">
									<span>1604CF Amended Return :</span>
									<select class="form-control" onchange="ChangeAmended1604CF(this)">
									<option>N</option>
									<option>Y</option>
									</select>
									<script>
										function ChangeAmended1604E(e){
											document.getElementById('AmendedReturn1604CF').value=e.value;
											document.getElementById('AmendedReturn1601C').value=e.value;
										}
									</script>
								</div>
								
								<div class="form-custom-govt">
									<span>1604CF No  of Sheet Attached</span>
									<input type="number" class="form-control" onkeyup="FillSheet1604CF(this)" oninput="FillSheet1604CF(this)" value="0">
									<script>
										function FillSheet1604CF(e){
											document.getElementById('SheetNo1604CF').value=e.value;
											document.getElementById('SheetNo1601C').value=e.value;
										}
									</script>
								</div>
								
							</div>
							<br>
							<div class="form-custom-govt">
                            <input type="button" class="btn btn-primary" value="Generate All BIR Forms" onclick="submit()">
                            <script>
                            function submit(){
                            var Middle=document.getElementById('MiddleNameAll').value;
                            var Last=document.getElementById('LastNameAll').value;
                            var First=document.getElementById('FirstNameAll').value;
                            if(First=="" && Last==""){
                                alert('Please Enter Name.');
                            }else{
                                document.getElementById('submitbir1600form').click();
                                setTimeout(function()
                                {
                                document.getElementById('submitbir1601eform').click();
                                }, 2000);
                                setTimeout(function()
                                {
                                document.getElementById('submitbir1601fform').click();
                                }, 12000);
                                setTimeout(function()
                                {
                                document.getElementById('submitbir2553form').click();
                                }, 6000);
                                setTimeout(function()
                                {
                                document.getElementById('submitbir1604eform').click();
                                }, 8000);
                                setTimeout(function()
                                {
                                document.getElementById('submitbir1604cfform').click();
                                }, 10000);
                            }
                            }
                            $(document).ready(function () {
                                $('#FORM1600').on('submit', function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        //url : $(this).attr('action') || window.location.pathname,
                                        url : "extra/attendance/GovtDownload.php",
                                        type: "POST",
                                        data: $(this).serialize(),
                                        success: function (data) {
                                            console.log(data);
                                            $("#form_output").html(data);
                                        },
                                        error: function (jXHR, textStatus, errorThrown) {
                                            alert(errorThrown);
                                        }
                                    });
                                });
                                $('#FORM1601E').on('submit', function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        //url : $(this).attr('action') || window.location.pathname,
                                        url : "extra/attendance/GovtDownload.php",
                                        type: "POST",
                                        data: $(this).serialize(),
                                        success: function (data) {
                                            console.log(data);
                                            $("#form_output").html(data);
                                        },
                                        error: function (jXHR, textStatus, errorThrown) {
                                            alert(errorThrown);
                                        }
                                    });
                                });
                                $('#FORM1601F').on('submit', function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        //url : $(this).attr('action') || window.location.pathname,
                                        url : "extra/attendance/GovtDownload.php",
                                        type: "POST",
                                        data: $(this).serialize(),
                                        success: function (data) {
                                            console.log(data);
                                            $("#form_output").html(data);
                                        },
                                        error: function (jXHR, textStatus, errorThrown) {
                                            alert(errorThrown);
                                        }
                                    });
                                });
                                $('#FORMSWAT').on('submit', function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        //url : $(this).attr('action') || window.location.pathname,
                                        url : "extra/attendance/GovtDownload.php",
                                        type: "POST",
                                        data: $(this).serialize(),
                                        success: function (data) {
                                            console.log(data);
                                            $("#form_output").html(data);
                                        },
                                        error: function (jXHR, textStatus, errorThrown) {
                                            alert(errorThrown);
                                        }
                                    });
                                });
                                $('#FORM1604E').on('submit', function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        //url : $(this).attr('action') || window.location.pathname,
                                        url : "extra/attendance/GovtDownload.php",
                                        type: "POST",
                                        data: $(this).serialize(),
                                        success: function (data) {
                                            console.log(data);
                                            $("#form_output").html(data);
                                        },
                                        error: function (jXHR, textStatus, errorThrown) {
                                            alert(errorThrown);
                                        }
                                    });
                                });
                                $('#FORM1604CF').on('submit', function(e) {
                                    e.preventDefault();
                                    $.ajax({
                                        //url : $(this).attr('action') || window.location.pathname,
                                        url : "extra/attendance/GovtDownload.php",
                                        type: "POST",
                                        data: $(this).serialize(),
                                        success: function (data) {
                                            console.log(data);
                                            $("#form_output").html(data);
                                        },
                                        error: function (jXHR, textStatus, errorThrown) {
                                            alert(errorThrown);
                                        }
                                    });
                                });
                                
                            });
                            </script>
                                <div id="form_output" style="display:none;">
                            

                                </div>
							</div>
							</div>
							</div>
						</div>
                    </div>
                </div>
                <div class="tab-pane fade" id="BIR1600" role="tabpanel" aria-labelledby="profile-tab">
                    
                    <div class="container-fluid" style="padding-top:10px;padding-bottom:10px;">
                        <form action="#"  id="FORM1600" method="POST">
						<div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
								<div class="form-inline">
								<div class="form-custom-govt">
									<input type="hidden" name="Form1600hiddenIndicator" value="">
									<span >Month / Year :</span>
									<select class="form-control" id="month" name="Month" required>
									<option value="01">January</option>
									<option value="02">February</option>
									<option value="03">March</option>
									<option value="04">April</option>
									<option value="05">May</option>
									<option value="06">June</option>
									<option value="07">July</option>
									<option value="08">August</option>
									<option value="09">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
									</select>
									<script>
									document.getElementById('month').value='<?php echo date('m') ?>';
									</script>
								</div>
								<div class="form-custom-govt">
									<span >/</span>
									<input type="number" min="2018" id="Year1600" name="Year" value="<?php echo date('Y'); ?>" class="form-control" required>
								</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >Name :</span>
										<input type="text" required id="LastName1600" class="form-control" name="L_Name" placeholder="Last Name">
									</div>
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" id="FirstName1600" required class="form-control" name="F_Name" placeholder="First Name">
									</div>
									<div class="form-custom-govt">
										<span ></span>
										<input type="text" id="MiddleName1600"  class="form-control" name="M_Name" placeholder="Middle Name">
									</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >TIN No./RDO :</span>
										<input type="text"  class="form-control" size="9" name="TINNO" placeholder="XXXXXXXXX" value="<?php echo $company_info->tin_number; ?>">
									</div>
									
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" class="form-control" name="TINNO2" placeholder="0000" value="0000" size="4">
									</div>
									<div class="form-custom-govt">
										<span >/</span>
										<input type="text"  class="form-control" name="RDO" placeholder="RDO" value="<?php echo $company_info->rdo; ?>">
										<input type="hidden" value="1" name="tablerowcount" id="tablecount">
									</div>
								</div>
                                <br>
                                
								<script>
									var RowCount=0;
									$(document).ready(function(){
										AddRow();
									});
									function AddRow(){
										@foreach ($employee_list as $rows)
                                            RowCount++;
                                            document.getElementById('tablecount').value=RowCount;
                                            //var trid='transactiontr'+columncount;
                                            var markup = '<tr id="BIRTR'+RowCount+'">';
                                                markup=markup+'<td style="vertical-align:middle;">';
                                                markup=markup+'<select class="form-control" id="rname'+RowCount+'" name="RName'+RowCount+'">';
                                                markup=markup+'<option value="{{$rows->employee_id}}">{{ucwords(strtolower($rows->fname." ".$rows->mname." ".$rows->lname))}}</option>';
                                                markup=markup+'</select>';
                                                markup=markup+'</td>';
                                                markup=markup+'<td style="vertical-align:middle;">';
                                                markup=markup+'<select class="form-control" id="atc'+RowCount+'" name="ATC'+RowCount+'" onchange="setTaxRate('+RowCount+')">';
                                                markup=markup+'<option>WB030</option><option>WB040</option><option>WB050</option><option>WB070</option>';
                                                markup=markup+'<option>WB080</option><option>WB082</option><option>WB090</option>';
                                                markup=markup+'<option>WB102</option><option>WB103</option><option>WB104</option><option>WB108</option>';
                                                markup=markup+'<option>WB109</option><option>WB110</option><option>WB121</option><option>WB130</option>';
                                                markup=markup+'<option>WB140</option><option>WB150</option><option>WB160</option><option>WB170</option>';
                                                markup=markup+'<option>WB180</option><option>WB191</option><option>WB192</option><option>WB193</option>';
                                                markup=markup+'<option>WB194</option><option>WB200</option><option>WB201</option><option>WB202</option>';
                                                markup=markup+'<option>WB203</option><option>WB301</option><option>WB303</option><option>WV010</option>';
                                                markup=markup+'<option>WV012</option><option>WV014</option><option>WV020</option><option>WV022</option>';
                                                markup=markup+'<option>WV024</option><option>WV030</option><option>WV040</option><option>WV050</option>';
                                                markup=markup+'<option>WV060</option><option>WV070</option>';
                                                markup=markup+'</select>';
                                                markup=markup+'</td>';
                                                markup=markup+'<td style="vertical-align:middle;"><input required oninput="setTaxRate('+RowCount+')" id="amount'+RowCount+'" name="Amount'+RowCount+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                                markup=markup+'<td style="vertical-align:middle;"><input required oninput="computetotal('+RowCount+')" id="rate'+RowCount+'" name="Rate'+RowCount+'" type="number" step="0.01" class="form-control" value="3.00" style="width:90%;display:inline"> %</td>';
                                                markup=markup+'<td style="vertical-align:middle;"><input required readonly id="total'+RowCount+'" name="Total'+RowCount+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                                
                                                markup=markup+'</tr>';
                                            $("#tbodyBIR").append(markup);
                                                if('{{$rows->atc_s}}'!=''){
                                                    document.getElementById('atc'+RowCount).value='{{$rows->atc_s}}';
                                                setTaxRate(RowCount);
                                                }
                                                
                                        @endforeach
										
											
										
									}
									function removeRow(rowid){
										document.getElementById('tbodyBIR').deleteRow(rowid-1);
										
									}
									function setTaxRate(no){
										var ATC=document.getElementById('atc'+no).value;
										var payment=document.getElementById('amount'+no).value;
										var rate="0.00";
										if(ATC=="WB030" || ATC=="WB050" || ATC=="WB080" || ATC=="WB082" || ATC=="WB084" || ATC=="WB130"){
											rate="3.00";
										}
										else if(ATC=="WB040" || ATC=="WB070" || ATC=="WB202"){
											rate="2.00";
										}
										else if(ATC=="WB090" || ATC=="WB110" || ATC=="WB120" || ATC=="WB160" || ATC=="WB192" || ATC=="WB194"){
											rate="10.00";
										}
										else if(ATC=="WB102"){
											rate="0.00";
										}
										else if(ATC=="WB103" || ATC=="WB104"){
											rate="7.00";
										}
										else if(ATC=="WB108" || ATC=="WB121" || ATC=="WB301" || ATC=="WV010" || ATC=="WV020" || ATC=="WV030"){
											rate="5.00";
										}
										else if(ATC=="WB109" || ATC=="WB203" || ATC=="WB303"){
											rate="1.00";
										}
										else if(ATC=="WB140" || ATC=="WB150"){
											rate="18.00";
										}
										else if(ATC=="WB170"){
											rate="15.00";
										}
										else if(ATC=="WB180"){
											rate="30.00";
										}
										else if(ATC=="WB191" || ATC=="WB193" || ATC=="WB201"){
											rate="4.00";
										}
										else if(ATC=="WB200"){
											rate="0.50";
										}
										else if(ATC=="WV012" || ATC=="WV014" || ATC=="WV022" || ATC=="WV024" || ATC=="WV040" || ATC=="WV050" || ATC=="WV060" || ATC=="WV070"){
											rate="12.00";
										}
										document.getElementById('rate'+no).value=rate;
										
										computetotal(no);
									}
									function computetotal(no){
										var payment=document.getElementById('amount'+no).value;
										var total=parseFloat(payment)*(parseFloat(document.getElementById('rate'+no).value)/100);
										document.getElementById('total'+no).value=total;
									}
								</script>
								<table class="table" style="background-color:white;color:#083240;">
								<thead style="background-color:#124f62; color:white;">
									<tr>
									<th style="vertical-align:middle;">Registered Name</th>
									<th style="vertical-align:middle;">ATC</th>
									<th style="vertical-align:middle;">Income Payment</th>
									<th style="vertical-align:middle;">Tax Rate</th>
									<th style="vertical-align:middle;">Tax Withheld</th>
									<th style="vertical-align:middle;"></th>
									</tr>
								</thead>
								<tbody id="tbodyBIR">
									
								</tbody>
								</table>
								
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
								<input type="button"  class="btn btn-success"  onclick="GenerateExcelFile('1600')" value="Generate 1600 Excel File">
								<input type="submit" style="float:right;" class="btn btn-primary"  id="submitbir1600form" name="SubmitBIR1600Form" value="Generate 1600 DAT File">
							</div>
							</div>
						</div>
						<br>
						</form>
                    </div>
                </div>
                <div class="tab-pane fade" id="BIR1601C" role="tabpanel" aria-labelledby="contact-tab">
                    
                    <div class="container-fluid" style="padding-top:10px;padding-bottom:10px;">
                        <div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
							<div class="form-inline">
								<div class="form-custom-govt">
									<span >Month / Year :</span>
									<select class="form-control" id="month_1601C" name="Month" required>
									<option value="01">January</option>
									<option value="02">February</option>
									<option value="03">March</option>
									<option value="04">April</option>
									<option value="05">May</option>
									<option value="06">June</option>
									<option value="07">July</option>
									<option value="08">August</option>
									<option value="09">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
									</select>
									<script>
									document.getElementById('month_1601C').value='<?php echo date('m') ?>';
									</script>
								</div>
								<div class="form-custom-govt">
									<span >/</span>
									<input type="number" min="2018" id="Year1601C" name="Year" value="<?php echo date('Y'); ?>" class="form-control" required>
								</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >Name :</span>
										<input type="text" required ID="LastName1601C" class="form-control" name="L_Name" placeholder="Last Name">
									</div>
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" id="FirstName1601C" required class="form-control" name="F_Name" placeholder="First Name">
									</div>
									<div class="form-custom-govt">
										<span ></span>
										<input type="text" id="MiddleName1601C"  class="form-control" name="M_Name" placeholder="Middle Name">
									</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >TIN No./RDO :</span>
										<input type="text"  class="form-control" size="9" name="TINNO" placeholder="XXXXXXXXX" value="<?php echo $company_info->tin_number; ?>">
									</div>
									
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" class="form-control" name="TINNO2" placeholder="0000" value="0000" size="4">
									</div>
									<div class="form-custom-govt">
										<span >/</span>
										<input type="text"  class="form-control" name="RDO" placeholder="RDO" value="<?php echo $company_info->rdo; ?>">
										<input type="hidden" value="1" name="tablerowcount" id="tablecount_1601C">
									</div>
								</div>
								<br>
								<div class="form-inline">
								<div class="form-custom-govt">
									<span >Amended Return :</span>
									<select class="form-control" id="AmendedReturn1601C" name="AmendedReturn">
									<option>N</option>
									<option>Y</option>
									</select>
								</div>
								<div class="form-custom-govt">
									<span>No of Sheet Attached</span>
									<input type="number" id="SheetNo1601C" class="form-control" name="SheetAttached" value="0">
								</div>
								</div>
								<br>
								<script>
								var RowCount1601C=0;
								$(document).ready(function(){
									AddRow1601C();
								});
								function AddRow1601C(){
                                    @foreach ($employee_list as $rows)
										RowCount1601C++;
										document.getElementById('tablecount_1601C').value=RowCount1601C;
										//var trid='transactiontr'+columncount;
										var markup = '<tr id="BIRTR'+RowCount1601C+'">';
                                            markup=markup+'<td style="vertical-align:top;">';
                                            markup=markup+'<select class="form-control" id="rname1601C'+RowCount1601C+'" name="RName'+RowCount1601C+'">';
											markup=markup+'<option value="<?php echo $rows->employee_id; ?>"><?php echo ucwords(strtolower($rows->fname." ".$rows->mname." ".$rows->lname)); ?></option>';
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            
                                            markup=markup+'<td style="vertical-align:top;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Amount of Compensation</span>';
											markup=markup+'<input type="number" id="totalamountofcompensation1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="TotalAmountOfCompensation1601C'+RowCount1601C+'" required >';
											markup=markup+'</div><br>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Less: Non Taxable Compensation</span>';
											markup=markup+'<input type="number" id="lessnontaxablecompensation1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="LessNonTaxableCompensation1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Statutory Minimum Wage (MWEs)</span>';
											markup=markup+'<input type="number" id="statutoryminimumwage1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="StatutoryMinimumWage1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Holiday Pay, Overtime Pay, Night Shift Differential Pay, Hazard Pay (Minimum Wage Earner)</span>';
											markup=markup+'<input type="number" id="holidaypayovertimepaynightshiftdifferentialpayhazardpay1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="HolidayPayOvertimePayNightShiftDifferentialPayHazardPay1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Other Non-Taxable Compensation</span>';
											markup=markup+'<input type="number" id="othernontaxablecompensation1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="OtherNonTaxableCompensation1601c'+RowCount1601C+'" required >';
											
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Taxable Compensation</span>';
											markup=markup+'<input type="number" id="taxablecompensation1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="TaxableCompensation1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Required to be Withheld</span>';
											markup=markup+'<input type="number" id="taxrequiredtobewithheld1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="TaxRequiredtobeWithheld1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'</td>';
											markup=markup+'<td style="vertical-align:top;">';
											
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Add/Less: Adjustment</span>';
											markup=markup+'<input type="number" id="addlessadjustment1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="AddLessAdjustment1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Required to be Withheld for Remittance</span>';
											markup=markup+'<input type="number" id="taxrequiredtobewithheldforremittance1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="TaxRequiredtobeWithheldforRemittance1601c'+RowCount1601C+'" required >';
											markup=markup+'</div><br>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Less: Tax Remitted In Return Previously Filed, if this is an amended return</span>';
											markup=markup+'<input type="number" id="lesstaxremittedinreturnreviouslifthisisanamendedreturn1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="LessTaxRemittedInReturnreviouslifthisisanamendedreturn1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span> Other Payments Made</span>';
											markup=markup+'<input type="number" id="otherpaymentsmade1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="OtherPaymentsMade1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Tax Payments Made</span>';
											markup=markup+'<input type="number" id="totaltaaymentsmade1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="TotalTaaymentsMade1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Still Due/(Overremittance)</span>';
											markup=markup+'<input type="number" id="taxstilldueoverremittance1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="TaxStillDueOverremittance1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'</td>';
											markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Surcharge</span>';
											markup=markup+'<input type="number" id="surcharge1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="Surcharge1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Interest</span>';
											markup=markup+'<input type="number" id="interest1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="Interest1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Compromise</span>';
											markup=markup+'<input type="number" id="compromise1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="Compromise1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Add: Penalties</span>';
											markup=markup+'<input type="number" id="addpenalties1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="AddPenalties1601c'+RowCount1601C+'" required >';
											markup=markup+'</div><br>';
											
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Amount Still Due/(Overremittance)</span>';
											markup=markup+'<input type="number" id="taxamountstilldue1601c'+RowCount1601C+'" value="0.00" step="0.01" class="form-control" name="TaxAmountStillDue1601c'+RowCount1601C+'" required >';
											markup=markup+'</div>';
											markup=markup+'</td>';
                                            
                                            markup=markup+'</tr>';
                                        $("#tbodyBIR1601C").append(markup);
										//SetHeight();
											
											
										
										@endforeach
										
									}
								</script>
								<table class="table" style="background-color:white;color:#083240;">
								<thead style="background-color:#124f62; color:white;">
									<tr>
									<th style="vertical-align:middle;">Registed Name</th>
									<th style="vertical-align:middle;"></th>
									<th style="vertical-align:middle;"></th>
									<th style="vertical-align:middle;"></th>
									</tr>
								</thead>
								<tbody id="tbodyBIR1601C">
									
								</tbody>
								</table>
							</div>
							</div>
                        </div>
                        <div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
								<input type="button"  class="btn btn-success"  onclick="GenerateExcelFile('1601C')" value="Generate 1601C Excel File">
								
							</div>
							</div>
						</div>
                    </div>
                </div>
                <div class="tab-pane fade" id="BIR1601E" role="tabpanel" aria-labelledby="contact-tab">
                    
                    <div class="container-fluid" style="padding-top:10px;padding-bottom:10px;">
                    <form action=""  id="FORM1601E" method="POST">
						<div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
								<div class="form-inline">
								<div class="form-custom-govt">
									<input type="hidden" name="Form1601EhiddenIndicator"  value="">
									<span >Month / Year :</span>
									<select class="form-control" id="month_1e" name="Month" required>
									<option value="01">January</option>
									<option value="02">February</option>
									<option value="03">March</option>
									<option value="04">April</option>
									<option value="05">May</option>
									<option value="06">June</option>
									<option value="07">July</option>
									<option value="08">August</option>
									<option value="09">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
									</select>
									<script>
									document.getElementById('month_1e').value='<?php echo date('m') ?>';
									</script>
								</div>
								<div class="form-custom-govt">
									<span >/</span>
									<input type="number" min="2018" id="Year1601E" name="Year" value="<?php echo date('Y'); ?>" class="form-control" required>
								</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >Name :</span>
										<input type="text" required id="LastName1601E"  class="form-control" name="L_Name" placeholder="Last Name">
									</div>
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" id="FirstName1601E" required class="form-control" name="F_Name" placeholder="First Name">
									</div>
									<div class="form-custom-govt">
										<span ></span>
										<input type="text" id="MiddleName1601E"  class="form-control" name="M_Name" placeholder="Middle Name">
									</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >TIN No./RDO :</span>
										<input type="text"  class="form-control" size="9" name="TINNO" placeholder="XXXXXXXXX" value="<?php echo $company_info->tin_number; ?>">
									</div>
									
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" class="form-control" name="TINNO2" placeholder="0000" value="0000" size="4">
									</div>
									<div class="form-custom-govt">
										<span >/</span>
										<input type="text"  class="form-control" name="RDO" placeholder="RDO" value="<?php echo $company_info->rdo; ?>">
										<input type="hidden" value="1" name="tablerowcount" id="tablecount_1e">
									</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >Quarter :</span>
										<select class="form-control" id="Quarter1604E" name="Quarter" required>
										<option>Q1</option>
										<option>Q2</option>
										<option>Q3</option>
										<option>Q4</option>
										</select>
									</div>
								</div>
								<br>
								<script>
									var RowCount=0;
									$(document).ready(function(){
										AddRow_1e();
									});
									function AddRow_1e(){
                                        @foreach($employee_list as $rows)
										    for(var c=1;c<=12;c++){
												var cc=c;
												if(c<10){
													cc="0"+c;
												}
                                                console.log(cc);
										RowCount++;
										document.getElementById('tablecount_1e').value=RowCount;
										//var trid='transactiontr'+columncount;
										var markup = '<tr id="BIRTR_1e'+RowCount+'">';
											markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<select class="form-control" name="Month_Tran'+RowCount+'" id="month_tran'+RowCount+'" required>';
											markup=markup+'<option value="01">January</option>';
											markup=markup+'<option value="02">February</option>';
											markup=markup+'<option value="03">March</option>';
											markup=markup+'<option value="04">April</option>';
											markup=markup+'<option value="05">May</option>';
											markup=markup+'<option value="06">June</option>';
											markup=markup+'<option value="07">July</option>';
											markup=markup+'<option value="08">August</option>';
											markup=markup+'<option value="09">September</option>';
											markup=markup+'<option value="10">October</option>';
											markup=markup+'<option value="11">November</option>';
											markup=markup+'<option value="12">December</option>';
											markup=markup+'</select>';
											markup=markup+'</td>';
											markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<input type="number" min="2018" id="year_tran'+RowCount+'" name="Year_Tran'+RowCount+'" value="<?php echo date('Y'); ?>" class="form-control" required>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;">';
                                            markup=markup+'<select class="form-control" id="rname_1e'+RowCount+'" name="RName'+RowCount+'">';
											
											markup=markup+'<option value="<?php echo $rows->employee_id; ?>"><?php echo ucwords(strtolower($rows->fname." ".$rows->mname." ".$rows->lname)); ?></option>';
											
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<select class="form-control" id="atc_1e'+RowCount+'" name="ATC'+RowCount+'" onchange="setTaxRate_1e('+RowCount+')">';
											markup=markup+'<option>WC010</option><option>WC011</option><option>WC020</option><option>WC021</option>';
											markup=markup+'<option>WC030</option><option>WC031</option><option>WC040</option>';
											markup=markup+'<option>WC041</option><option>WC050</option><option>WC051</option><option>WC060</option>';
											markup=markup+'<option>WC061</option><option>WC070</option><option>WC071</option><option>WC080</option>';
											markup=markup+'<option>WC081</option><option>WC100</option><option>WC110</option><option>WC120</option>';
											markup=markup+'<option>WC139</option><option>WC140</option><option>WC150</option><option>WC151</option>';
											markup=markup+'<option>WC156</option><option>WC157</option><option>WC158</option><option>WC160</option>';
											markup=markup+'<option>WC161</option><option>WC162</option><option>WC163</option><option>WC170</option>';
											markup=markup+'<option>WC390</option><option>WC440</option><option>WC515</option><option>WC516</option>';
											markup=markup+'<option>WC535</option><option>WC540</option><option>WC555</option><option>WC556</option>';
											markup=markup+'<option>WC557</option><option>WC558</option><option>WC610</option><option>WC630</option>';
											markup=markup+'<option>WC632</option><option>WC640</option><option>WC650</option><option>WC651</option>';
											markup=markup+'<option>WC660</option><option>WC661</option><option>WC662</option><option>WC663</option>';
											markup=markup+'<option>WC670</option><option>WC672</option><option>WC680</option><option>WC690</option>';
											markup=markup+'<option>WC710</option><option>WC720</option><option>WI010</option><option>WI011</option>';
											markup=markup+'<option>WI020</option><option>WI021</option><option>WI030</option><option>WI031</option>';
											markup=markup+'<option>WI040</option><option>WI041</option><option>WI050</option><option>WI051</option>';
											markup=markup+'<option>WI060</option><option>WI061</option><option>WI070</option><option>WI071</option>';
											markup=markup+'<option>WI080</option><option>WI081</option><option>WI090</option><option>WI091</option>';
											markup=markup+'<option>WI100</option><option>WI110</option><option>WI120</option><option>WI130</option>';
											markup=markup+'<option>WI139</option><option>WI140</option><option>WI141</option><option>WI142</option>';
											markup=markup+'<option>WI150</option><option>WI151</option><option>WI152</option><option>WI153</option>';
											markup=markup+'<option>WI156</option><option>WI157</option><option>WI158</option><option>WI159</option>';
											markup=markup+'<option>WI160</option><option>WI161</option><option>WI162</option><option>WI163</option>';
											markup=markup+'<option>WI170</option><option>WI440</option><option>WI441</option><option>WI442</option>';
											markup=markup+'<option>WI515</option><option>WI516</option><option>WI530</option><option>WI535</option>';
											markup=markup+'<option>WI540</option><option>WI555</option><option>WI556</option><option>WI557</option>';
											markup=markup+'<option>WI558</option><option>WI610</option><option>WI630</option><option>WI632</option>';
											markup=markup+'<option>WI640</option><option>WI650</option><option>WI651</option><option>WI660</option>';
											markup=markup+'<option>WI661</option><option>WI662</option><option>WI663</option><option>WI670</option>';
											markup=markup+'<option>WI670</option><option>WI672</option><option>WI680</option><option>WI710</option>';
											markup=markup+'<option>WI720</option>';
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required oninput="setTaxRate_1e('+RowCount+')" id="amount_1e'+RowCount+'" name="Amount'+RowCount+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required oninput="computetotal_1e('+RowCount+')" id="rate_1e'+RowCount+'" name="Rate'+RowCount+'" type="number" step="0.01" class="form-control" value="10.00" style="width:80%;display:inline"> %</td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required readonly id="total_1e'+RowCount+'" name="Total'+RowCount+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            
                                            markup=markup+'</tr>';
                                            $("#tbodyBIR_1e").append(markup);
                                            if('{{$rows->atc_se}}'!=''){
                                                document.getElementById('atc_1e'+RowCount).value='<?php echo $rows->atc_se; ?>';	
											    setTaxRate_1e(RowCount);
                                            }
                                            document.getElementById('month_tran'+RowCount).value=cc;
                                            }
                                        @endforeach
									}
									function removeRow_1e(rowid){
										document.getElementById('tbodyBIR_1e').deleteRow(rowid-1);
										
									}
									function setTaxRate_1e(no){
										var ATC=document.getElementById('atc_1e'+no).value;
										var payment=document.getElementById('amount_1e'+no).value;
										var rate="0.00";
										if(ATC=="WC010" || ATC=="WC020" || ATC=="WC030" || ATC=="WC040" || ATC=="WC050" || ATC=="WC070" || ATC=="WC080"|| ATC=="WC139" || ATC=="WC151"
											|| ATC=="WC515" || ATC=="WC660" || ATC=="WC661" || ATC=="WC662" || ATC=="WI011" || ATC=="WI021" || ATC=="WI031" || ATC=="WI041" || ATC=="WI051"
											|| ATC=="WI061" || ATC=="WI071" || ATC=="WI081" || ATC=="WI091"|| ATC=="WI140" || ATC=="WI141" || ATC=="WI150" || ATC=="WI152" || ATC=="WI516"
											|| ATC=="WI660" || ATC=="WI661" || ATC=="WI662"){
											rate="10.00";
										}
										else if(ATC=="WC011" || ATC=="WC021" || ATC=="WC031" || ATC=="WC041" || ATC=="WC051" || ATC=="WC060" || ATC=="WC061" || ATC=="WC071" || ATC=="WC081"
											|| ATC=="WC140" || ATC=="WC150" || ATC=="WC516" || ATC=="WI130" || ATC=="WI142" || ATC=="WI153" || ATC=="WI159"){
											rate="15.00";
										}
										else if(ATC=="WC100" || ATC=="WC110" || ATC=="WC390" || ATC=="WC540" || ATC=="WC557" || ATC=="WC630" || ATC=="WC680" || ATC=="WI010" || ATC=="WI020" 
											|| ATC=="WI030" || ATC=="WI040" || ATC=="WI050" || ATC=="WI060" || ATC=="WI070" || ATC=="WI080" || ATC=="WI090" || ATC=="WI100" || ATC=="WI110"
											|| ATC=="WI139" || ATC=="WI151" || ATC=="WI442" || ATC=="WI515" || ATC=="WI540" || ATC=="WI557" || ATC=="WI630" || ATC=="WI680"){
											rate="5.00";
										}
										else if(ATC=="WC120" || ATC=="WC157" || ATC=="WC160" || ATC=="WC672" || ATC=="WI120" || ATC=="WI157" || ATC=="WI160" || ATC=="WI672"){
											rate="2.00";
											
										}
										else if(ATC=="WC156" || ATC=="WI156"){
											rate="0.50";
											
										}
										else if(ATC=="WC158" || ATC=="WC535" || ATC=="WC610" || ATC=="WC632" || ATC=="WC640" || ATC=="WC670" || ATC=="WC690" || ATC=="WC720" || ATC=="WI158"
											|| ATC=="WI530" || ATC=="WI535" || ATC=="WI610" || ATC=="WI632" || ATC=="WI640" || ATC=="WI670" || ATC=="WI720"){
											rate="1.00";
											
										}
										else if(ATC=="WC161" || ATC=="WC162" || ATC=="WC163" || ATC=="WC440" || ATC=="WC663" || ATC=="WC710" || ATC=="WI161" || ATC=="WI162" || ATC=="WI163" 
											|| ATC=="WI440" || ATC=="WI663" || ATC=="WI710"){
											rate="20.00";
											
										}
										else if(ATC=="WC170"){
											rate="7.50";
											
										}
										else if(ATC=="WC555" || ATC=="WI555"){
											rate="1.50";
										}
										else if(ATC=="WC556" || ATC=="WI556"){
											rate="3.00";
										}
										else if(ATC=="WC558" || ATC=="WI558"){
											rate="6.00";
										}
										else if(ATC=="WC650" || ATC=="WI650"){
											rate="25.00"
										}
										else if(ATC=="WC651" || ATC=="WI651"){
											rate="32.00";
										}
										else if(ATC=="WI170"){
											rate="7.50";
										}
										else if(ATC=="WI441"){
											rate="12.00";
										}
										document.getElementById('rate_1e'+no).value=rate;
										
										computetotal_1e(no);
									}
									function computetotal_1e(no){
										var payment=document.getElementById('amount_1e'+no).value;
										var total=parseFloat(payment)*(parseFloat(document.getElementById('rate_1e'+no).value)/100);
										document.getElementById('total_1e'+no).value=total;
									}
								</script>
								<table class="table" style="background-color:white;color:#083240;">
								<thead style="background-color:#124f62; color:white;">
									<tr>
									<th style="vertical-align:middle;">Month</th>
									<th style="vertical-align:middle;">Year</th>
									<th style="vertical-align:middle;">Registered Name</th>
									<th style="vertical-align:middle;">ATC</th>
									<th style="vertical-align:middle;">Income Payment</th>
									<th style="vertical-align:middle;">Tax Rate</th>
									<th style="vertical-align:middle;">Tax Withheld</th>
									
									</tr>
								</thead>
								<tbody id="tbodyBIR_1e">
									
								</tbody>
								</table>
								
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
								<input type="button" class="btn btn-success"  onclick="GenerateExcelFile('1601E')" value="Generate 1601E Excel File">
								<input type="submit" style="float:right;" class="btn btn-primary" id="submitbir1601eform" name="SubmitBIR1601EForm" value="Generate 1601E DAT File">
							</div>
							</div>
						</div>
						<br>
						</form>
                    </div>
                </div>
                <div class="tab-pane fade" id="BIR1601F" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="container-fluid" style="padding-top:10px;padding-bottom:10px;">
                        <form action=""  id="FORM1601F" method="POST">
						<div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
								<div class="form-inline">
								<div class="form-custom-govt">
									<span >Month / Year :</span>
									<input type="hidden" name="Form1601FhiddenIndicator"  value="">
									<select class="form-control" id="month_1f" name="Month" required>
									<option value="01">January</option>
									<option value="02">February</option>
									<option value="03">March</option>
									<option value="04">April</option>
									<option value="05">May</option>
									<option value="06">June</option>
									<option value="07">July</option>
									<option value="08">August</option>
									<option value="09">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
									</select>
									<script>
									document.getElementById('month_1f').value='<?php echo date('m') ?>';
									</script>
								</div>
								<div class="form-custom-govt">
									<span >/</span>
									<input type="number" min="2018" id="Year1601F" name="Year" value="<?php echo date('Y'); ?>" class="form-control" required>
								</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >Name :</span>
										<input type="text" required id="LastName1601F" class="form-control" name="L_Name" placeholder="Last Name">
									</div>
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" id="FirstName1601F" required  class="form-control" name="F_Name" placeholder="First Name">
									</div>
									<div class="form-custom-govt">
										<span ></span>
										<input type="text" id="MiddleName1601F"  class="form-control" name="M_Name" placeholder="Middle Name">
									</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >TIN No./RDO :</span>
										<input type="text"  class="form-control" size="9" name="TINNO" placeholder="XXXXXXXXX" value="<?php echo $company_info->tin_number; ?>">
									</div>
									
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" class="form-control" name="TINNO2" placeholder="0000" value="0000" size="4">
									</div>
									<div class="form-custom-govt">
										<span >/</span>
										<input type="text"  class="form-control" name="RDO" placeholder="RDO" value="<?php echo $company_info->rdo; ?>">
										<input type="hidden" value="1" name="tablerowcount" id="tablecount_1f">
									</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >Quarter :</span>
										<select class="form-control" id="Quarter1601F" name="Quarter" required>
										<option>Q1</option>
										<option>Q2</option>
										<option>Q3</option>
										<option>Q4</option>
										</select>
									</div>
								</div>
								<br>
								<script>
									var RowCount=0;
									$(document).ready(function(){
										AddRow_1f();
									});
									function AddRow_1f(){
                                        @foreach($employee_list as $rows)


										for(var c=1;c<=12;c++){
											var cc=c;
											if(c<10){
												cc="0"+c;
											}
										
										RowCount++;
										document.getElementById('tablecount_1f').value=RowCount;
										//var trid='transactiontr'+columncount;
										var markup = '<tr id="BIRTR_1f'+RowCount+'">';
											markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<select class="form-control" name="Month_Tran'+RowCount+'" id="month_1'+RowCount+'" required>';
											markup=markup+'<option value="01">January</option>';
											markup=markup+'<option value="02">February</option>';
											markup=markup+'<option value="03">March</option>';
											markup=markup+'<option value="04">April</option>';
											markup=markup+'<option value="05">May</option>';
											markup=markup+'<option value="06">June</option>';
											markup=markup+'<option value="07">July</option>';
											markup=markup+'<option value="08">August</option>';
											markup=markup+'<option value="09">September</option>';
											markup=markup+'<option value="10">October</option>';
											markup=markup+'<option value="11">November</option>';
											markup=markup+'<option value="12">December</option>';
											markup=markup+'</select>';
											markup=markup+'</td>';
											markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<input type="number" min="2018" id="year_1601F'+RowCount+'" name="Year_Tran'+RowCount+'" value="<?php echo date('Y'); ?>" class="form-control" required>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;">';
                                            markup=markup+'<select class="form-control" id="rname_1f'+RowCount+'" name="RName'+RowCount+'">';
											
											markup=markup+'<option value="<?php echo $rows->employee_id; ?>"><?php echo ucwords(strtolower($rows->fname." ".$rows->mname." ".$rows->lname)); ?></option>';
											
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<select class="form-control" id="atc_1f'+RowCount+'" name="ATC'+RowCount+'" onchange="setTaxRate_1f('+RowCount+')">';
											markup=markup+'<option>WC180</option><option>WC190</option><option>WC191</option>';
											markup=markup+'<option>WC212</option><option>WC213</option><option>WC222</option>';
											markup=markup+'<option>WC223</option><option>WC230</option><option>WC250</option>';
											markup=markup+'<option>WC280</option><option>WC290</option><option>WC300</option>';
											markup=markup+'<option>WC310</option><option>WC340</option><option>WC410</option>';
											markup=markup+'<option>WC700</option><option>WI202</option><option>WI224</option>';
											markup=markup+'<option>WI225</option><option>WI226</option><option>WI240</option>';
											markup=markup+'<option>WI250</option><option>WI260</option><option>WI310</option>';
											markup=markup+'<option>WI330</option><option>WI340</option><option>WI341</option>';
											markup=markup+'<option>WI350</option><option>WI380</option><option>WI410</option>';
											markup=markup+'<option>WI700</option>';
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required oninput="setTaxRate_1f('+RowCount+')" id="amount_1f'+RowCount+'" name="Amount'+RowCount+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required oninput="computetotal_1f('+RowCount+')" id="rate_1f'+RowCount+'" name="Rate'+RowCount+'" type="number" step="0.01" class="form-control" value="10.00" style="width:80%;display:inline"> %</td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required readonly id="total_1f'+RowCount+'" name="Total'+RowCount+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            
                                            markup=markup+'</tr>';
                                        $("#tbodyBIR_1f").append(markup);
										
										@if('{{$rows->atc_sf}}'!='')
										
										document.getElementById('atc_1f'+RowCount).value='<?php echo $rows->atc_sf; ?>';
										setTaxRate_1f(RowCount);
										@endif
										document.getElementById('month_1'+RowCount).value=cc;
										
										}
										
                                        @endforeach
									}
									function removeRow_1f(rowid){
										document.getElementById('tbodyBIR_1f').deleteRow(rowid-1);
										
									}
									function setTaxRate_1f(no){
										var ATC=document.getElementById('atc_1f'+no).value;
										var payment=document.getElementById('amount_1f'+no).value;
										var rate="0.00";
										if(ATC=="WC190" || ATC=="WC191" || ATC=="WC410" || ATC=="WC700" || ATC=="WI202" || ATC=="WI203" || ATC=="WI240" || ATC=="WI380" || ATC=="WI410" || ATC=="WI700"){
											rate="10.00";
										}
										else if(ATC=="WC212" || ATC=="WC213" || ATC=="WC230" || ATC=="WI350"){
											rate="30.00";
										}
										else if(ATC=="WC222" || ATC=="WC223" || ATC=="WC280"){
											rate="15.00";
										}
										else if(ATC=="WC250" || ATC=="WI224" || ATC=="WI225" || ATC=="WI226" || ATC=="WI250" || ATC=="WI260"){
											rate="20.00";
										}
										else if(ATC=="WC290"){
											rate="4.50";
										}
										else if(ATC=="WC300"){
											rate="7.50";
										}
										else if(ATC=="WC310" || ATC=="WI310"){
											rate="8.00";
										}
										else if(ATC=="WC340" || ATC=="WI330" || ATC=="WI340" || ATC=="WI341" ){
											rate="25.00";
										}
										document.getElementById('rate_1f'+no).value=rate;
										
										computetotal_1f(no);
									}
									function computetotal_1f(no){
										var payment=document.getElementById('amount_1f'+no).value;
										var total=parseFloat(payment)*(parseFloat(document.getElementById('rate_1f'+no).value)/100);
										document.getElementById('total_1f'+no).value=total;
									}
								</script>
								<table class="table" style="background-color:white;color:#083240;">
								<thead style="background-color:#124f62; color:white;">
									<tr>
									<th style="vertical-align:middle;">Month</th>
									<th style="vertical-align:middle;">Year</th>
									<th style="vertical-align:middle;">Registered Name</th>
									<th style="vertical-align:middle;">ATC</th>
									<th style="vertical-align:middle;">Income Payment</th>
									<th style="vertical-align:middle;">Tax Rate</th>
									<th style="vertical-align:middle;">Tax Withheld</th>
									
									</tr>
								</thead>
								<tbody id="tbodyBIR_1f">
									
								</tbody>
								</table>
								
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
								<input type="button" class="btn btn-success"  onclick="GenerateExcelFile('1601E')" value="Generate 1601F Excel File">
								<input type="submit" style="float:right;" class="btn btn-primary" id="submitbir1601fform" name="SubmitBIR1601FForm" value="Generate 1601F DAT File">
							</div>
							</div>
						</div>
						<br>
						</form>
                    </div>
                </div>
                <div class="tab-pane fade" id="BIRSWAT" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="container-fluid" style="padding-top:10px;padding-bottom:10px;">
                        <form action=""  id="FORMSWAT" method="POST">
						<div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
								<div class="form-inline">
								<div class="form-custom-govt">
									<span >Month / Year :</span>
									<input type="hidden" name="FormSWATFhiddenIndicator"  value="">
									<select class="form-control" id="month_3T" name="Month" required>
									<option value="01">January</option>
									<option value="02">February</option>
									<option value="03">March</option>
									<option value="04">April</option>
									<option value="05">May</option>
									<option value="06">June</option>
									<option value="07">July</option>
									<option value="08">August</option>
									<option value="09">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
									</select>
									<script>
									document.getElementById('month_3T').value='<?php echo date('m') ?>';
									</script>
								</div>
								<div class="form-custom-govt">
									<span >/</span>
									<input type="number" min="2018" id="YearSWAT" name="Year" value="<?php echo date('Y'); ?>" class="form-control" required>
								</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >Name :</span>
										<input type="text" required ID="LastNameSWAT" class="form-control" name="L_Name" placeholder="Last Name">
									</div>
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" id="FirstNameSWAT" required class="form-control" name="F_Name" placeholder="First Name">
									</div>
									<div class="form-custom-govt">
										<span ></span>
										<input type="text" id="MiddleNameSWAT"  class="form-control" name="M_Name" placeholder="Middle Name">
									</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >TIN No./RDO :</span>
										<input type="text"  class="form-control" size="9" name="TINNO" placeholder="XXXXXXXXX" value="<?php echo $company_info->tin_number; ?>">
									</div>
									
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" class="form-control" name="TINNO2" placeholder="0000" value="0000" size="4">
									</div>
									<div class="form-custom-govt">
										<span >/</span>
										<input type="text"  class="form-control" name="RDO" placeholder="RDO" value="<?php echo $company_info->rdo; ?>">
										<input type="hidden" value="1" name="tablerowcount" id="tablecount_3T">
									</div>
								</div>
								<br>
								<script>
									var RowCount=0;
									$(document).ready(function(){
										AddRow_3T();
									});
									function AddRow_3T(){
										@foreach($employee_list as $rows)
										RowCount++;
										document.getElementById('tablecount_3T').value=RowCount;
										//var trid='transactiontr'+columncount;
										var markup = '<tr id="BIRTR_3T'+RowCount+'">';
                                            markup=markup+'<td style="vertical-align:middle;">';
                                            markup=markup+'<select class="form-control" id="rname_3T'+RowCount+'" name="RName'+RowCount+'">';
											
											markup=markup+'<option value="<?php echo $rows->employee_id; ?>"><?php echo ucwords(strtolower($rows->fname." ".$rows->mname." ".$rows->lname)); ?></option>';
											
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<select class="form-control" id="atc_3T'+RowCount+'" name="ATC'+RowCount+'" onchange="setTaxRate_3T('+RowCount+')">';
											markup=markup+'<option>WB030</option><option>WB040</option><option>WB050</option><option>WB070</option>';
											markup=markup+'<option>WB080</option><option>WB082</option><option>WB090</option>';
											markup=markup+'<option>WB102</option><option>WB103</option><option>WB104</option><option>WB108</option>';
											markup=markup+'<option>WB109</option><option>WB110</option><option>WB121</option><option>WB130</option>';
											markup=markup+'<option>WB140</option><option>WB150</option><option>WB160</option><option>WB170</option>';
											markup=markup+'<option>WB180</option><option>WB191</option><option>WB192</option><option>WB193</option>';
											markup=markup+'<option>WB194</option><option>WB200</option><option>WB201</option><option>WB202</option>';
											markup=markup+'<option>WB203</option><option>WB301</option><option>WB303</option><option>WV010</option>';
											markup=markup+'<option>WV012</option><option>WV014</option><option>WV020</option><option>WV022</option>';
											markup=markup+'<option>WV024</option><option>WV030</option><option>WV040</option><option>WV050</option>';
											markup=markup+'<option>WV060</option><option>WV070</option>';
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required oninput="setTaxRate_3T('+RowCount+')" id="amount_3T'+RowCount+'" name="Amount'+RowCount+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required oninput="computetotal_3T('+RowCount+')" id="rate_3T'+RowCount+'" name="Rate'+RowCount+'" type="number" step="0.01" class="form-control" value="3.00" style="width:90%;display:inline"> %</td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required readonly id="total_3T'+RowCount+'" name="Total'+RowCount+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            markup=markup+'</tr>';
                                        $("#tbodyBIR_3T").append(markup);
										
										
										if('{{$rows->atc_swat}}'!=""){
										
										document.getElementById('atc_3T'+RowCount).value='<?php echo $rows->atc_swat; ?>';
										setTaxRate_3T(RowCount);
										}
										
										@endforeach
									}
									function removeRow_3T(rowid){
										document.getElementById('tbodyBIR_3T').deleteRow(rowid-1);
										
									}
									function setTaxRate_3T(no){
										var ATC=document.getElementById('atc_3T'+no).value;
										var payment=document.getElementById('amount_3T'+no).value;
										var rate="0.00";
										if(ATC=="WB030" || ATC=="WB050" || ATC=="WB080" || ATC=="WB082" || ATC=="WB084" || ATC=="WB130"){
											rate="3.00";
										}
										else if(ATC=="WB040" || ATC=="WB070" || ATC=="WB202"){
											rate="2.00";
										}
										else if(ATC=="WB090" || ATC=="WB110" || ATC=="WB120" || ATC=="WB160" || ATC=="WB192" || ATC=="WB194"){
											rate="10.00";
										}
										else if(ATC=="WB102"){
											rate="0.00";
										}
										else if(ATC=="WB103" || ATC=="WB104"){
											rate="7.00";
										}
										else if(ATC=="WB108" || ATC=="WB121" || ATC=="WB301" || ATC=="WV010" || ATC=="WV020" || ATC=="WV030"){
											rate="5.00";
										}
										else if(ATC=="WB109" || ATC=="WB203" || ATC=="WB303"){
											rate="1.00";
										}
										else if(ATC=="WB140" || ATC=="WB150"){
											rate="18.00";
										}
										else if(ATC=="WB170"){
											rate="15.00";
										}
										else if(ATC=="WB180"){
											rate="30.00";
										}
										else if(ATC=="WB191" || ATC=="WB193" || ATC=="WB201"){
											rate="4.00";
										}
										else if(ATC=="WB200"){
											rate="0.50";
										}
										else if(ATC=="WV012" || ATC=="WV014" || ATC=="WV022" || ATC=="WV024" || ATC=="WV040" || ATC=="WV050" || ATC=="WV060" || ATC=="WV070"){
											rate="12.00";
										}
										document.getElementById('rate_3T'+no).value=rate;
										
										computetotal_3T(no);
									}
									function computetotal_3T(no){
										var payment=document.getElementById('amount_3T'+no).value;
										var total=parseFloat(payment)*(parseFloat(document.getElementById('rate_3T'+no).value)/100);
										document.getElementById('total_3T'+no).value=total;
									}
								</script>
								<table class="table" style="background-color:white;color:#083240;">
								<thead style="background-color:#124f62; color:white;">
									<tr>
									<th style="vertical-align:middle;">Registered Name</th>
									<th style="vertical-align:middle;">ATC</th>
									<th style="vertical-align:middle;">Income Payment</th>
									<th style="vertical-align:middle;">Tax Rate</th>
									<th style="vertical-align:middle;">Tax Withheld</th>
									</tr>
								</thead>
								<tbody id="tbodyBIR_3T">
									
								</tbody>
								</table>
								
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
								<input type="button" class="btn btn-success"  onclick="GenerateExcelFile('2553')" value="Generate 2553 Excel File">
								<input type="submit" style="float:right;" class="btn btn-primary" id="submitbir2553form" name="SubmitBIR2553Form" value="Generate 2553 DAT File">
							</div>
							</div>
						</div>
						<br>
						</form>
                    </div>
                </div>
                <div class="tab-pane fade" id="BIR1604E" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="container-fluid" style="padding-top:10px;padding-bottom:10px;">
                        <form action=""  id="FORM1604E" method="POST">
						<div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
								<div class="form-inline">
								<div class="form-custom-govt">
									<span >Month / Year :</span>
									<input type="hidden" name="Form1604EFhiddenIndicator"  value="">
									<select class="form-control" id="month_4E" name="Month" required>
									<option value="01">January</option>
									<option value="02">February</option>
									<option value="03">March</option>
									<option value="04">April</option>
									<option value="05">May</option>
									<option value="06">June</option>
									<option value="07">July</option>
									<option value="08">August</option>
									<option value="09">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
									</select>
									<script>
									document.getElementById('month_4E').value='<?php echo date('m') ?>';
									</script>
								</div>
								<div class="form-custom-govt">
									<span >/</span>
									<input type="number" min="2018" id="Year1604E" name="Year" value="<?php echo date('Y'); ?>" class="form-control" required>
								</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >Name :</span>
										<input type="text" required id="LastName1604E" class="form-control" name="L_Name" placeholder="Last Name">
									</div>
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" id="FirstName1604E" required class="form-control" name="F_Name" placeholder="First Name">
									</div>
									<div class="form-custom-govt">
										<span ></span>
										<input type="text" id="MiddleName1604E"  class="form-control" name="M_Name" placeholder="Middle Name">
									</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >TIN No./RDO :</span>
										<input type="text"  class="form-control" size="9" name="TINNO" placeholder="XXXXXXXXX" value="<?php echo $company_info->tin_number; ?>">
									</div>
									
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" class="form-control" name="TINNO2" placeholder="0000" value="0000" size="4">
									</div>
									<div class="form-custom-govt" >
										<span >/</span>
										<input type="text"  class="form-control" name="RDO" placeholder="RDO" value="<?php echo $company_info->rdo; ?>">
										<input type="hidden" value="1" name="tablerowcount" id="tablecount_4E">
										<input type="hidden" value="1" name="tablerowcount_3" id="tablecount_3_4E">
									</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >Amended Return :</span>
										<select class="form-control" id="AmendedReturn1604E" name="AnendedReturn">
										<option>N</option>
										<option>Y</option>
										</select>
									</div>
									
									<div class="form-custom-govt">
										<span >No  of Sheet Attached</span>
										<input type="number" class="form-control" id="SheetNo1604E" name="SheetAttached" value="0">
									</div>
									
								</div>
								<br>
								<script>
									var RowCount=0;
									var RowCount_3=0;
									$(document).ready(function(){
										AddRow_4E();
										AddRow_3_4E();
									});
									function AddRow_3_4E(){
										@foreach($employee_list as $rows)
										RowCount_3++;
										document.getElementById('tablecount_3_4E').value=RowCount_3;
										//var trid='transactiontr'+columncount;
										var markup = '<tr id="BIRTR_3_4E'+RowCount_3+'">';
                                            markup=markup+'<td style="vertical-align:middle;">';
                                            markup=markup+'<select class="form-control" id="rname_3_4E'+RowCount_3+'" name="RName'+RowCount_3+'">';
											
											markup=markup+'<option value="<?php echo $rows->employee_id; ?>"><?php echo ucwords(strtolower($rows->fname." ".$rows->mname." ".$rows->lname)); ?></option>';
											
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<select class="form-control" id="atc_3_4E'+RowCount_3+'" name="ATC'+RowCount_3+'" >';
											markup=markup+'<option>DI900</option><option>EI900</option><option>FP010</option><option>IC010</option>';
											markup=markup+'<option>IC011</option><option>IC020</option><option>IC021</option><option>IC030</option>';
											markup=markup+'<option>IC031</option><option>IC040</option><option>IC041</option><option>IC050</option>';
											markup=markup+'<option>IC055</option><option>IC060</option><option>IC070</option><option>IC080</option>';
											markup=markup+'<option>IC090</option><option>IC100</option><option>IC101</option><option>IC120</option>';
											markup=markup+'<option>IC130</option><option>IC140</option><option>IC150</option><option>IC160</option>';
											markup=markup+'<option>IC170</option><option>IC190</option><option>IC191</option><option>IC370</option>';
											markup=markup+'<option>II010</option><option>II011</option><option>II012</option><option>II013</option>';
											markup=markup+'<option>II020</option><option>II050</option><option>II060</option>';
											markup=markup+'<option>II070</option><option>II080</option><option>II090</option><option>II110</option>';
											markup=markup+'<option>II120</option><option>II130</option><option>II420</option><option>MC010</option>';
											markup=markup+'<option>MC011</option><option>MC020</option><option>MC021</option><option>MC030</option>';
											markup=markup+'<option>MC040</option>';
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required  id="amount_3_4E'+RowCount_3+'" name="Amount'+RowCount_3+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            markup=markup+'</tr>';
                                        $("#tbodyBIR_3_4E").append(markup);
										
										if('{{$rows->atc_s_se}}'!=""){
										
										document.getElementById('atc_3_4E'+RowCount_3).value='<?php echo $rows->atc_s_se; ?>';
											
										}
										@endforeach
									}
									function removeRow_3_4E(rowid){
										document.getElementById('tbodyBIR_3_4E').deleteRow(rowid-2);
										
									}
									function AddRow_4E(){
										@foreach($employee_list as $rows)
										RowCount++;
										document.getElementById('tablecount_4E').value=RowCount;
										//var trid='transactiontr'+columncount;
										var markup = '<tr id="BIRTR_4E'+RowCount+'">';
                                            markup=markup+'<td style="vertical-align:middle;">';
                                            markup=markup+'<select class="form-control" id="rname_4E'+RowCount+'" name="RName_3'+RowCount+'">';
											
											markup=markup+'<option value="<?php echo $rows->employee_id; ?>"><?php echo ucwords(strtolower($rows->fname." ".$rows->mname." ".$rows->lname)); ?></option>';
											
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<select class="form-control" id="atc_4E'+RowCount+'" name="ATC_3'+RowCount+'" onchange="setTaxRate_4E('+RowCount+')">';
											markup=markup+'<option>WC010</option><option>WC011</option><option>WC020</option><option>WC021</option>';
											markup=markup+'<option>WC030</option><option>WC031</option><option>WC040</option>';
											markup=markup+'<option>WC041</option><option>WC050</option><option>WC051</option><option>WC060</option>';
											markup=markup+'<option>WC061</option><option>WC070</option><option>WC071</option><option>WC080</option>';
											markup=markup+'<option>WC081</option><option>WC100</option><option>WC110</option><option>WC120</option>';
											markup=markup+'<option>WC139</option><option>WC140</option><option>WC150</option><option>WC151</option>';
											markup=markup+'<option>WC156</option><option>WC157</option><option>WC158</option><option>WC160</option>';
											markup=markup+'<option>WC161</option><option>WC162</option><option>WC163</option><option>WC170</option>';
											markup=markup+'<option>WC390</option><option>WC440</option><option>WC515</option><option>WC516</option>';
											markup=markup+'<option>WC535</option><option>WC540</option><option>WC555</option><option>WC556</option>';
											markup=markup+'<option>WC557</option><option>WC558</option><option>WC610</option><option>WC630</option>';
											markup=markup+'<option>WC632</option><option>WC640</option><option>WC650</option><option>WC651</option>';
											markup=markup+'<option>WC660</option><option>WC661</option><option>WC662</option><option>WC663</option>';
											markup=markup+'<option>WC670</option><option>WC672</option><option>WC680</option><option>WC690</option>';
											markup=markup+'<option>WC710</option><option>WC720</option><option>WI010</option><option>WI011</option>';
											markup=markup+'<option>WI020</option><option>WI021</option><option>WI030</option><option>WI031</option>';
											markup=markup+'<option>WI040</option><option>WI041</option><option>WI050</option><option>WI051</option>';
											markup=markup+'<option>WI060</option><option>WI061</option><option>WI070</option><option>WI071</option>';
											markup=markup+'<option>WI080</option><option>WI081</option><option>WI090</option><option>WI091</option>';
											markup=markup+'<option>WI100</option><option>WI110</option><option>WI120</option><option>WI130</option>';
											markup=markup+'<option>WI139</option><option>WI140</option><option>WI141</option><option>WI142</option>';
											markup=markup+'<option>WI150</option><option>WI151</option><option>WI152</option><option>WI153</option>';
											markup=markup+'<option>WI156</option><option>WI157</option><option>WI158</option><option>WI159</option>';
											markup=markup+'<option>WI160</option><option>WI161</option><option>WI162</option><option>WI163</option>';
											markup=markup+'<option>WI170</option><option>WI440</option><option>WI441</option><option>WI442</option>';
											markup=markup+'<option>WI515</option><option>WI516</option><option>WI530</option><option>WI535</option>';
											markup=markup+'<option>WI540</option><option>WI555</option><option>WI556</option><option>WI557</option>';
											markup=markup+'<option>WI558</option><option>WI610</option><option>WI630</option><option>WI632</option>';
											markup=markup+'<option>WI640</option><option>WI650</option><option>WI651</option><option>WI660</option>';
											markup=markup+'<option>WI661</option><option>WI662</option><option>WI663</option><option>WI670</option>';
											markup=markup+'<option>WI670</option><option>WI672</option><option>WI680</option><option>WI710</option>';
											markup=markup+'<option>WI720</option>';
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required oninput="setTaxRate_4E('+RowCount+')" id="amount_4E'+RowCount+'" name="Amount_3'+RowCount+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required oninput="computetotal_4E('+RowCount+')" id="rate_4E'+RowCount+'" name="Rate_3'+RowCount+'" type="number" step="0.01" class="form-control" value="3.00" style="width:90%;display:inline"> %</td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required readonly id="total_4E'+RowCount+'" name="Total_3'+RowCount+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            markup=markup+'</tr>';
                                        $("#tbodyBIR_4E").append(markup);

										if('{{$rows->atc_s_ss}}'!=""){
										document.getElementById('atc_4E'+RowCount).value='<?php echo $rows->atc_s_ss; ?>';
										setTaxRate_4E(RowCount);	
										}
										@endforeach
									}
									function removeRow_4E(rowid){
										document.getElementById('tbodyBIR_4E').deleteRow(rowid-2);
										
									}
									function setTaxRate_4E(no){
										var ATC=document.getElementById('atc_4E'+no).value;
										var payment=document.getElementById('amount_4E'+no).value;
										var rate="0.00";
										if(ATC=="WC010" || ATC=="WC020" || ATC=="WC030" || ATC=="WC040" || ATC=="WC050" || ATC=="WC070" || ATC=="WC080"|| ATC=="WC139" || ATC=="WC151"
											|| ATC=="WC515" || ATC=="WC660" || ATC=="WC661" || ATC=="WC662" || ATC=="WI011" || ATC=="WI021" || ATC=="WI031" || ATC=="WI041" || ATC=="WI051"
											|| ATC=="WI061" || ATC=="WI071" || ATC=="WI081" || ATC=="WI091"|| ATC=="WI140" || ATC=="WI141" || ATC=="WI150" || ATC=="WI152" || ATC=="WI516"
											|| ATC=="WI660" || ATC=="WI661" || ATC=="WI662"){
											rate="10.00";
										}
										else if(ATC=="WC011" || ATC=="WC021" || ATC=="WC031" || ATC=="WC041" || ATC=="WC051" || ATC=="WC060" || ATC=="WC061" || ATC=="WC071" || ATC=="WC081"
											|| ATC=="WC140" || ATC=="WC150" || ATC=="WC516" || ATC=="WI130" || ATC=="WI142" || ATC=="WI153" || ATC=="WI159"){
											rate="15.00";
										}
										else if(ATC=="WC100" || ATC=="WC110" || ATC=="WC390" || ATC=="WC540" || ATC=="WC557" || ATC=="WC630" || ATC=="WC680" || ATC=="WI010" || ATC=="WI020" 
											|| ATC=="WI030" || ATC=="WI040" || ATC=="WI050" || ATC=="WI060" || ATC=="WI070" || ATC=="WI080" || ATC=="WI090" || ATC=="WI100" || ATC=="WI110"
											|| ATC=="WI139" || ATC=="WI151" || ATC=="WI442" || ATC=="WI515" || ATC=="WI540" || ATC=="WI557" || ATC=="WI630" || ATC=="WI680"){
											rate="5.00";
										}
										else if(ATC=="WC120" || ATC=="WC157" || ATC=="WC160" || ATC=="WC672" || ATC=="WI120" || ATC=="WI157" || ATC=="WI160" || ATC=="WI672"){
											rate="2.00";
											
										}
										else if(ATC=="WC156" || ATC=="WI156"){
											rate="0.50";
											
										}
										else if(ATC=="WC158" || ATC=="WC535" || ATC=="WC610" || ATC=="WC632" || ATC=="WC640" || ATC=="WC670" || ATC=="WC690" || ATC=="WC720" || ATC=="WI158"
											|| ATC=="WI530" || ATC=="WI535" || ATC=="WI610" || ATC=="WI632" || ATC=="WI640" || ATC=="WI670" || ATC=="WI720"){
											rate="1.00";
											
										}
										else if(ATC=="WC161" || ATC=="WC162" || ATC=="WC163" || ATC=="WC440" || ATC=="WC663" || ATC=="WC710" || ATC=="WI161" || ATC=="WI162" || ATC=="WI163" 
											|| ATC=="WI440" || ATC=="WI663" || ATC=="WI710"){
											rate="20.00";
											
										}
										else if(ATC=="WC170"){
											rate="7.50";
											
										}
										else if(ATC=="WC555" || ATC=="WI555"){
											rate="1.50";
										}
										else if(ATC=="WC556" || ATC=="WI556"){
											rate="3.00";
										}
										else if(ATC=="WC558" || ATC=="WI558"){
											rate="6.00";
										}
										else if(ATC=="WC650" || ATC=="WI650"){
											rate="25.00"
										}
										else if(ATC=="WC651" || ATC=="WI651"){
											rate="32.00";
										}
										else if(ATC=="WI170"){
											rate="7.50";
										}
										else if(ATC=="WI441"){
											rate="12.00";
										}
										document.getElementById('rate_4E'+no).value=rate;
										
										computetotal_4E(no);
									}
									function computetotal_4E(no){
										var payment=document.getElementById('amount_4E'+no).value;
										var total=parseFloat(payment)*(parseFloat(document.getElementById('rate_4E'+no).value)/100);
										document.getElementById('total_4E'+no).value=total;
									}
								</script>
								<table class="table" style="background-color:white;color:#083240;">
								<thead style="background-color:#124f62; color:white;">
									<tr>
										<th style="vertical-align:middle;" colspan="9">Schedule 3</th>
									</tr>
									<tr>
									<th style="vertical-align:middle;">Registered Name</th>
									<th style="vertical-align:middle;">ATC</th>
									<th style="vertical-align:middle;">Income Payment</th>
									</tr>
								</thead>
								<tbody id="tbodyBIR_3_4E">
									
								</tbody>
								</table>
								<br>
								<table class="table" style="background-color:white;color:#083240;">
								<thead style="background-color:#124f62; color:white;">
									<tr>
										<th style="vertical-align:middle;" colspan="9">Schedule 4</th>
									</tr>
									<tr>
									<th style="vertical-align:middle;">Registered Name</th>
									<th style="vertical-align:middle;">ATC</th>
									<th style="vertical-align:middle;">Income Payment</th>
									<th style="vertical-align:middle;">Tax Rate</th>
									<th style="vertical-align:middle;">Tax Withheld</th>
									</tr>
								</thead>
								<tbody id="tbodyBIR_4E">
									
								</tbody>
								</table>
								
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
								<input type="button" class="btn btn-success"  onclick="GenerateExcelFile('1604E')" value="Generate 1604E Excel File">
								<input type="submit" style="float:right;" class="btn btn-primary" id="submitbir1604eform" name="SubmitBIR1604EForm" value="Generate 1604E DAT File">
							</div>
							</div>
						</div>
						<br>
						</form>
                    </div>
                </div>
                <div class="tab-pane fade" id="BIR1604CF" role="tabpanel" aria-labelledby="contact-tab">
                    <div class="container-fluid" style="padding-top:10px;padding-bottom:10px;">
                    <form action=""  id="FORM1604CF" method="POST">
						<div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
								<div class="form-inline">
								<div class="form-custom-govt">
									<span >Month / Year :</span>
									<input type="hidden" name="Form1604CFhiddenIndicator"  value="">
									<select class="form-control" id="month_1cf" name="Month" required>
									<option value="01">January</option>
									<option value="02">February</option>
									<option value="03">March</option>
									<option value="04">April</option>
									<option value="05">May</option>
									<option value="06">June</option>
									<option value="07">July</option>
									<option value="08">August</option>
									<option value="09">September</option>
									<option value="10">October</option>
									<option value="11">November</option>
									<option value="12">December</option>
									</select>
									<script>
									document.getElementById('month_1cf').value='<?php echo date('m') ?>';
									</script>
								</div>
								<div class="form-custom-govt">
									<span >/</span>
									<input type="number" min="2018" id="Year1604CF" name="Year" value="<?php echo date('Y'); ?>" class="form-control" required>
								</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >Name :</span>
										<input type="text" required id="LastName1604CF" class="form-control" name="L_Name" placeholder="Last Name">
									</div>
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" id="FirstName1604CF" required class="form-control" name="F_Name" placeholder="First Name">
									</div>
									<div class="form-custom-govt">
										<span ></span>
										<input type="text" id="MiddleName1604CF"  class="form-control" name="M_Name" placeholder="Middle Name">
									</div>
								</div>
								<br>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >TIN No./RDO :</span>
										<input type="text"  class="form-control" size="9" name="TINNO" placeholder="XXXXXXXXX" value="<?php echo $company_info->tin_number; ?>">
									</div>
									
									<div class="form-custom-govt">
										<span >,</span>
										<input type="text" class="form-control" name="TINNO2" placeholder="0000" value="0000" size="4">
									</div>
									<div class="form-custom-govt">
										<span >/</span>
										<input type="text"  class="form-control" name="RDO" placeholder="RDO" value="<?php echo $company_info->rdo; ?>">
										<input type="hidden" value="1" name="tablerowcount" id="tablecount_1cf">
										<input type="hidden" value="1" name="tablerowcount_6" id="tablecount_6_1cf">
										<input type="hidden" value="1" name="tablerowcount_7" id="tablecount_7_1cf">
										<input type="hidden" value="1" name="tablerowcount_7_3" id="tablecount_7_3_1cf">
										<input type="hidden" value="1" name="tablerowcount_7_4" id="tablecount_7_4_1cf">
										<input type="hidden" value="1" name="tablerowcount_7_5" id="tablecount_7_5_1cf">
									</div>
								</div>
								<br>
								<div class="form-inline" style="display:none;">
									<div class="form-custom-govt">
										<span >Quarter :</span>
										<select class="form-control" name="Quarter" required>
										<option>Q1</option>
										<option>Q2</option>
										<option>Q3</option>
										<option>Q4</option>
										</select>
									</div>
								</div>
								<div class="form-inline">
									<div class="form-custom-govt">
										<span >Amended Return :</span>
										<select class="form-control" id="AmendedReturn1604CF" name="AmendedReturn">
										<option>N</option>
										<option>Y</option>
										</select>
									</div>
									<div class="form-custom-govt">
										<span>No of Sheet Attached</span>
										<input type="number" id="SheetNo1604CF" class="form-control" name="SheetAttached" value="0">
									</div>
								</div>
								<br>
								<script>
									var RowCount=0;
									var RowCount_6=0;
									var RowCount_7=0;
									var RowCount_7_3=0;
									var RowCount_7_4=0;
									var RowCount_7_5=0;
									$(document).ready(function(){
										AddRow_1cf();
										AddRow_6_1cf();
										AddRow_7_1cf();
										AddRow_7_3_1cf();
										AddRow_7_4_1cf();
										AddRow_7_5_1cf();
									});
									function AddRow_1cf(){
										@foreach($employee_list as $rows)
										RowCount++;
										document.getElementById('tablecount_1cf').value=RowCount;
										//var trid='transactiontr'+columncount;
										var markup = '<tr id="BIRTR_1cf'+RowCount+'">';
											
                                            markup=markup+'<td style="vertical-align:middle;">';
                                            markup=markup+'<select class="form-control" id="rname_1cf'+RowCount+'" name="RName'+RowCount+'">';
											
											markup=markup+'<option value="<?php echo $rows->employee_id; ?>"><?php echo ucwords(strtolower($rows->fname." ".$rows->mname." ".$rows->lname)); ?></option>';
											
											markup=markup+'</select>';
											markup=markup+'</td>';
											markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<select class="form-control" id="statuscode_1cf'+RowCount+'" name="StatusCode'+RowCount+'" >';
											markup=markup+'<option value="A">Citizen of the Philippines</option>';
											markup=markup+'<option value="B">Resident Alien Individuals</option>';
											markup=markup+'<option value="C">Non-resident Alien Engaged in Business</option>';
											markup=markup+'<option value="D">Non-resident Alien not Engaged in Business</option>';
											markup=markup+'<option value="E">Domestic Corporation</option>';
											markup=markup+'<option value="F">Resident Foeign Corp</option>';
											markup=markup+'<option value="G">Non-resident Foreign Corp</option>';
											markup=markup+'<option value="H">Others</option>';
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<select class="form-control" id="atc_1cf'+RowCount+'" name="ATC'+RowCount+'" onchange="setTaxRate_1cf('+RowCount+')">';
											markup=markup+'<option>WC180</option><option>WC190</option><option>WC191</option>';
											markup=markup+'<option>WC212</option><option>WC213</option><option>WC222</option>';
											markup=markup+'<option>WC223</option><option>WC230</option><option>WC250</option>';
											markup=markup+'<option>WC280</option><option>WC290</option><option>WC300</option>';
											markup=markup+'<option>WC310</option><option>WC340</option><option>WC410</option>';
											markup=markup+'<option>WC700</option><option>WI202</option><option>WI224</option>';
											markup=markup+'<option>WI225</option><option>WI226</option><option>WI240</option>';
											markup=markup+'<option>WI250</option><option>WI260</option><option>WI310</option>';
											markup=markup+'<option>WI330</option><option>WI340</option><option>WI341</option>';
											markup=markup+'<option>WI350</option><option>WI380</option><option>WI410</option>';
											markup=markup+'<option>WI700</option>';
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required oninput="setTaxRate_1cf('+RowCount+')" id="amount_1cf'+RowCount+'" name="Amount'+RowCount+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required oninput="computetotal_1cf('+RowCount+')" id="rate_1cf'+RowCount+'" name="Rate'+RowCount+'" type="number" step="0.01" class="form-control" value="20.00" style="width:80%;display:inline"> %</td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required readonly id="total_1cf'+RowCount+'" name="Total'+RowCount+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            markup=markup+'</tr>';
                                        $("#tbodyBIR_1cf").append(markup);

										if('{{$rows->atc_s_cf_status_code}}'!=""){
										document.getElementById('statuscode_1cf'+RowCount).value='<?php echo $rows->atc_s_cf_status_code; ?>';
										document.getElementById('atc_1cf'+RowCount).value='<?php echo $rows->atc_s_cf_V; ?>';
										setTaxRate_1cf(RowCount);
										}
										@endforeach
									}
									function removeRow_1cf(rowid){
										document.getElementById('tbodyBIR_1cf').deleteRow(rowid-2);
										
									}
									function AddRow_6_1cf(){
										@foreach($employee_list as $rows)
										RowCount_6++;
										document.getElementById('tablecount_6_1cf').value=RowCount_6;
										//var trid='transactiontr'+columncount;
										var markup = '<tr id="BIRTR_6_1cf'+RowCount_6+'">';
											
                                            markup=markup+'<td style="vertical-align:middle;">';
                                            markup=markup+'<select class="form-control" id="rname_6_1cf'+RowCount_6+'" name="RName_6'+RowCount_6+'">';
											
											markup=markup+'<option value="<?php echo $rows->employee_id; ?>"><?php echo ucwords(strtolower($rows->fname." ".$rows->mname." ".$rows->lname)); ?></option>';
											
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<select class="form-control" id="atc_6_1cf'+RowCount_6+'" name="ATC_6'+RowCount_6+'" >';
											markup=markup+'<option>WF330</option><option>WF360</option>';
											markup=markup+'</select>';
											markup=markup+'</td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required id="amount_6_1cf'+RowCount_6+'" name="Amount_6'+RowCount_6+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required id="rate_6_1cf'+RowCount_6+'" name="Rate_6'+RowCount_6+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            markup=markup+'<td style="vertical-align:middle;"><input required  id="total_6_1cf'+RowCount_6+'" name="Total_6'+RowCount_6+'" type="number" step="0.01" class="form-control" value="0.00"></td>';
                                            markup=markup+'</tr>';
                                        $("#tbodyBIR_6_1cf").append(markup);
										
										if('{{$rows->atc_s_cf_VI}}'!=""){
										
										document.getElementById('atc_6_1cf'+RowCount_6).value="<?php echo $rows->atc_s_cf_VI; ?>";
										
										}
										@endforeach
									}
									function removeRow_6_1cf(rowid){
										document.getElementById('tbodyBIR_6_1cf').deleteRow(rowid-2);
										
									}
									function AddRow_7_1cf(){
                                        @foreach($employee_list as $rows)
										RowCount_7++;
										document.getElementById('tablecount_7_1cf').value=RowCount_7;
										//var trid='transactiontr'+columncount;
										var markup = '<tr id="BIRTR_7_1cf'+RowCount_7+'">';
											
                                            markup=markup+'<td style="vertical-align:top;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Registered Name</span>';
                                            markup=markup+'<select class="form-control" id="rname_7_1cf'+RowCount_7+'" name="RName_7'+RowCount_7+'">';
											
											markup=markup+'<option value="<?php echo $rows->employee_id; ?>"><?php echo ucwords(strtolower($rows->fname." ".$rows->mname." ".$rows->lname)); ?></option>';
											
											markup=markup+'</select>';
											markup=markup+'</div>';
											markup=markup+'</td>';
											
                                            markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Employment From</span>';
											markup=markup+'<input type="date" class="form-control" id="FROMEmployee_7'+RowCount_7+'" name="EmploymentFrom'+RowCount_7+'" value="<?php echo $rows->start_date; ?>">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Gross Comp. Income</span>';
											markup=markup+'<input type="number" value="0.00" id="NonGross_7'+RowCount_7+'" step="0.01" class="form-control" name="GrossCompIncome_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>13th Mo. Pay & Other benefits(non-taxable)</span>';
											markup=markup+'<input type="number" value="0.00" id="NonThreeOne_7'+RowCount_7+'" step="0.01" class="form-control" name="OneThreePay_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>De Minimis Benefit(non-taxable)</span>';
											markup=markup+'<input type="number" id="NonDeminimis_7'+RowCount_7+'" value="<?php echo $rows->deminimis_total!=""? $rows->deminimis_total : "0.00" ; ?>" step="0.01" class="form-control" name="DeminimisBenefit_7'+RowCount_7+'" required>';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>SSS, GSIS, PHIC, Pag-Ibig & Union Dues</span>';
                                            var PhilhealthCal=0;
                                            if('{{$rows->philhealth_contribution}}'==0){

                                            }else{
                                                if('{{$rows->philhealth_contribution}}'==1){
                                                    if('{{$rows->basic_salary}}'<=10000.00){
														
														PhilhealthCal=137.50;
													}
													if('{{$rows->basic_salary}}'>=10000.01 && '{{$rows->basic_salary}}'<=39999.99){
														PhilhealthCal=(2.75/100)*'{{$rows->basic_salary}}';
													}
													if('{{$rows->basic_salary}}'>=40000.00){
														PhilhealthCal=550.00;
													}
                                                }
                                            }
											
											var SSSCal=0;
											SSSCal='{{$rows->sss_contribution}}';
											var Basic='{{$rows->basic_salary}}';
											if(SSSCal=="Let System Decide" || SSSCal==""){
												@foreach($reference_sss_all as $dat)
                                                    var min='{{$dat->min_range}}';
                                                    var max='{{$dat->max_range}}';
                                                    if(Basic>=min && Basic<=max){		
                                                        SSSCal='{{$dat->ss_ee}}';
                                                    }
                                                @endforeach
                                                if(SSSCal=="Let System Decide" || SSSCal==""){
                                                    SSSCal=0;
                                                }
											}

											var PagibigCal=0;
											PagibigCal='{{$rows->pagibigcont}}';
											if(PagibigCal=="Let System Decide" || PagibigCal==""){
												if(Basic>5000 ){
													PagibigCal=100;
												}
												if(Basic>1500 && Basic<=5000){
													PagibigCal=Basic*0.02;
												}
												if(Basic<=1500){
													PagibigCal=Basic*0.01;
												}
											}
											var UnionD=parseInt(PhilhealthCal)+parseInt(PagibigCal)+parseInt(SSSCal);
                                            
											markup=markup+'<input type="number" id="NonUnion_7'+RowCount_7+'" value="'+UnionD+'" step="0.01" class="form-control" name="UnionDues_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Salaries & Other Comp.(non-taxable)</span>';
											markup=markup+'<input type="number" id="NoSalOtherComp_7'+RowCount_7+'" value="0.00" step="0.01" class="form-control" name="Salaries_OtherComp_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Comp. Income(non-taxable)</span>';
											markup=markup+'<input type="number" id="NoTotalComp_7'+RowCount_7+'" value="0.00" step="0.01" class="form-control" name="Total_Comp_Income_NonTax_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											
											
											markup=markup+'</td>';
											
											markup=markup+'<td style="vertical-align:top;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Employment To</span>';
											markup=markup+'<input type="date" class="form-control" id="TOEmployee_7'+RowCount_7+'" name="EmploymentTo'+RowCount_7+'" value="<?php echo date('Y-m-d'); ?>">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Taxable Basic Salary</span>';
											markup=markup+'<input type="number" id="TaxBasicSal_7'+RowCount_7+'" value="0.00" step="0.01" class="form-control" name="Tax_Basic_Salary_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>13th Mo. Pay & Other benefit(taxable)</span>';
											markup=markup+'<input type="number" id="TaxOnThree_7'+RowCount_7+'" value="0.00" step="0.01" class="form-control" name="OneThreePayTax_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Salaries & Other Comp. (taxable)</span>';
											markup=markup+'<input type="number" id="TaxSalOtherTax_7'+RowCount_7+'" value="0.00" step="0.01" class="form-control" name="Salaries_OtherComp_Tax_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Comp. Income(taxable)</span>';
											markup=markup+'<input type="number"  id="TaxTotalCompIncome_7'+RowCount_7+'" value="0.00" step="0.01" class="form-control" name="Total_Comp_Income_Tax_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Net Comp. Income(taxable)</span>';
											markup=markup+'<input type="number" id="TaxNetCompIncome_7'+RowCount_7+'" value="0.00" step="0.01" class="form-control" name="Net_Comp_Income_Tax_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											
											markup=markup+'</td>';
											
                                            markup=markup+'<td style="vertical-align:top;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Due (Jan. to Dec.)</span>';
											markup=markup+'<input type="number" id="TaxDueJanDec_7'+RowCount_7+'" value="0.00" step="0.01" class="form-control" name="TaxDue_7'+RowCount_7+'" >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Withheld (Jan. to Dec.)</span>';
											markup=markup+'<input type="number" id="TaxWithheldJanDec_7'+RowCount_7+'" value="0.00" step="0.01" class="form-control" name="Tax_Withheld_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Amount withheld & paid for in December</span>';
											markup=markup+'<input type="number" id="AmountWithheldPaidDec_7'+RowCount_7+'" value="0.00" step="0.01" class="form-control" name="PaidforinDecemberTax_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Over withheld tax refunded to employees</span>';
											markup=markup+'<input type="number" id="Overwithheldrefunded_7'+RowCount_7+'" value="0.00" step="0.01" class="form-control" name="Overwithheld_Tax_refund_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Substitute Filling</span>';
											markup=markup+'<select class="form-control" id="SubFilling_7'+RowCount_7+'" name="Substitute_Filling_7'+RowCount_7+'" required >';
											markup=markup+'<option>N</option>';
											markup=markup+'<option>Y</option>';
											markup=markup+'</select>';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Amt. of tax withheld as adjusted</span>';
											markup=markup+'<input type="number" id="AmtTaxWithheldAdj_7'+RowCount_7+'" value="0.00" step="0.01" class="form-control" name="tax_withheld_as_adjusted_7'+RowCount_7+'" required >';
											markup=markup+'</div>';
											markup=markup+'</td>';
											markup=markup+'</tr>';
                                        $("#tbodyBIR_7_1cf").append(markup);
										@endforeach
									}
									function removeRow_7_1cf(rowid){
										document.getElementById('tbodyBIR_7_1cf').deleteRow(rowid-2);
										
									}
									function AddRow_7_3_1cf(){
										@foreach($employee_list as $rows)
										RowCount_7_3++;
										document.getElementById('tablecount_7_3_1cf').value=RowCount_7_3;
										//var trid='transactiontr'+columncount;
										var markup = '<tr id="BIRTR_7_3_1cf'+RowCount_7_3+'">';
											
                                            markup=markup+'<td style="vertical-align:top;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Registered Name</span>';
                                            markup=markup+'<select class="form-control" id="rname_7_3_1cf'+RowCount_7_3+'" name="RName_7_3'+RowCount_7_3+'">';
											
											markup=markup+'<option value="<?php echo $rows->employee_id; ?>"><?php echo ucwords(strtolower($rows->fname." ".$rows->mname." ".$rows->lname)); ?></option>';
											
											markup=markup+'</select>';
											markup=markup+'</div>';
											markup=markup+'</td>';
											
                                            markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Gross Comp. Income</span>';
											markup=markup+'<input type="number" id="NonGross_7_3'+RowCount_7_3+'" value="0.00" step="0.01" class="form-control" name="GrossCompIncome_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>13th Mo. Pay & Other benefits(non-taxable)</span>';
											markup=markup+'<input type="number" id="NonThreeOne_7_3'+RowCount_7_3+'" value="0.00" step="0.01" class="form-control" name="OneThreePay_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>De Minimis Benefit(non-taxable)</span>';
											markup=markup+'<input type="number" id="NonDeminimis_7_3'+RowCount_7_3+'" value="<?php echo $rows->deminimis_total!=""? $rows->deminimis_total : "0.00" ; ?>" step="0.01" class="form-control" name="DeminimisBenefit_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>SSS, GSIS, PHIC, Pag-Ibig & Union Dues</span>';
											var PhilhealthCal=0;
                                            if('{{$rows->philhealth_contribution}}'==0){

                                            }else{
                                                if('{{$rows->philhealth_contribution}}'==1){
                                                    if('{{$rows->basic_salary}}'<=10000.00){
                                                        
                                                        PhilhealthCal=137.50;
                                                    }
                                                    if('{{$rows->basic_salary}}'>=10000.01 && '{{$rows->basic_salary}}'<=39999.99){
                                                        PhilhealthCal=(2.75/100)*'{{$rows->basic_salary}}';
                                                    }
                                                    if('{{$rows->basic_salary}}'>=40000.00){
                                                        PhilhealthCal=550.00;
                                                    }
                                                }
                                            }

                                            var SSSCal=0;
											SSSCal='{{$rows->sss_contribution}}';
											var Basic='{{$rows->basic_salary}}';
											if(SSSCal=="Let System Decide" || SSSCal==""){
												@foreach($reference_sss_all as $dat)
                                                    var min='{{$dat->min_range}}';
                                                    var max='{{$dat->max_range}}';
                                                    if(Basic>=min && Basic<=max){		
                                                        SSSCal='{{$dat->ss_ee}}';
                                                    }
                                                @endforeach
                                                if(SSSCal=="Let System Decide" || SSSCal==""){
                                                    SSSCal=0;
                                                }
											}

											var PagibigCal=0;
											PagibigCal='{{$rows->pagibigcont}}';
											if(PagibigCal=="Let System Decide" || PagibigCal==""){
												if(Basic>5000 ){
													PagibigCal=100;
												}
												if(Basic>1500 && Basic<=5000){
													PagibigCal=Basic*0.02;
												}
												if(Basic<=1500){
													PagibigCal=Basic*0.01;
												}
											}
											var UnionD=parseInt(PhilhealthCal)+parseInt(PagibigCal)+parseInt(SSSCal);
											markup=markup+'<input type="number" id="NonUnion_7_3'+RowCount_7_3+'" value="'+UnionD+'" step="0.01" class="form-control" name="UnionDues_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Salaries & Other Comp.(non-taxable)</span>';
											markup=markup+'<input id="NoSalOtherComp_7_3'+RowCount_7_3+'" type="number" value="0.00" step="0.01" class="form-control" name="Salaries_OtherComp_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Comp. Income(non-taxable)</span>';
											markup=markup+'<input id="NoTotalComp_7_3'+RowCount_7_3+'" type="number" value="0.00" step="0.01" class="form-control" name="Total_Comp_Income_NonTax_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											
											
											markup=markup+'</td>';
											
											markup=markup+'<td style="vertical-align:top;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Taxable Basic Salary</span>';
											markup=markup+'<input id="TaxBasicSal_7_3'+RowCount_7_3+'" type="number" value="0.00" step="0.01" class="form-control" name="Tax_Basic_Salary_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>13th Mo. Pay & Other benefit(taxable)</span>';
											markup=markup+'<input id="TaxOnThree_7_3'+RowCount_7_3+'" type="number" value="0.00" step="0.01" class="form-control" name="OneThreePayTax_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Salaries & Other Comp. (taxable)</span>';
											markup=markup+'<input id="TaxSalOtherTax_7_3'+RowCount_7_3+'" type="number" value="0.00" step="0.01" class="form-control" name="Salaries_OtherComp_Tax_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Comp. Income(taxable)</span>';
											markup=markup+'<input id="TaxTotalCompIncome_7_3'+RowCount_7_3+'" type="number" value="0.00" step="0.01" class="form-control" name="Total_Comp_Income_Tax_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Net Comp. Income(taxable)</span>';
											markup=markup+'<input id="TaxNetCompIncome_7_3'+RowCount_7_3+'" type="number" value="0.00" step="0.01" class="form-control" name="Net_Comp_Income_Tax_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											
											markup=markup+'</td>';
											
                                            markup=markup+'<td style="vertical-align:top;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Due (Jan. to Dec.)</span>';
											markup=markup+'<input id="TaxDueJanDec_7_3'+RowCount_7_3+'" type="number" value="0.00" step="0.01" class="form-control" name="TaxDue_7_3'+RowCount_7_3+'" >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Withheld (Jan. to Dec.)</span>';
											markup=markup+'<input id="TaxWithheldJanDec_7_3'+RowCount_7_3+'" type="number" value="0.00" step="0.01" class="form-control" name="Tax_Withheld_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Amount withheld & paid for in December</span>';
											markup=markup+'<input id="AmountWithheldPaidDec_7_3'+RowCount_7_3+'" type="number" value="0.00" step="0.01" class="form-control" name="PaidforinDecemberTax_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Over withheld tax refunded to employees</span>';
											markup=markup+'<input id="Overwithheldrefunded_7_3'+RowCount_7_3+'" type="number" value="0.00" step="0.01" class="form-control" name="Overwithheld_Tax_refund_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Substitute Filling</span>';
											markup=markup+'<select id="SubFilling_7_3'+RowCount_7_3+'" class="form-control" name="Substitute_Filling_7_3'+RowCount_7_3+'" required >';
											markup=markup+'<option>N</option>';
											markup=markup+'<option>Y</option>';
											markup=markup+'</select>';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Amt. of tax withheld as adjusted</span>';
											markup=markup+'<input id="AmtTaxWithheldAdj_7_3'+RowCount_7_3+'" type="number" value="0.00" step="0.01" class="form-control" name="AmtTaxWithheldAdj_7_3'+RowCount_7_3+'" required >';
											markup=markup+'</div>';
											markup=markup+'</td>';
											markup=markup+'</tr>';
                                        $("#tbodyBIR_7_3_1cf").append(markup);
										@endforeach
									}
									function removeRow_7_3_1cf(rowid){
										document.getElementById('tbodyBIR_7_3_1cf').deleteRow(rowid-2);
										
									}
									function AddRow_7_4_1cf(){
										@foreach($employee_list as $rows)
										RowCount_7_4++;
										document.getElementById('tablecount_7_4_1cf').value=RowCount_7_4;
										//var trid='transactiontr'+columncount;
										var markup = '<tr id="BIRTR_7_4_1cf'+RowCount_7_4+'">';
											
                                            markup=markup+'<td style="vertical-align:top;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Registered Name</span>';
                                            markup=markup+'<select class="form-control" id="rname_7_4_1cf'+RowCount_7_4+'" name="RName_7_4'+RowCount_7_4+'">';
											
											markup=markup+'<option value="<?php echo $rows->employee_id; ?>"><?php echo ucwords(strtolower($rows->fname." ".$rows->mname." ".$rows->lname)); ?></option>';
											
											markup=markup+'</select>';
											markup=markup+'</div>';
											markup=markup+'</td>';
											
                                            markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>13th Month & Other Benefits from Previous Employer</span>';
											markup=markup+'<input id="PreviousNonThreeOne_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="OneThreeOtherBenefits_Previous_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>De Minimis Benefits from Previous Employer</span>';
											markup=markup+'<input id="PreviousNonDeminimis_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="DeminimisBenefit_Previous_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>SSS, GSIS, PAG-IBIG & Union Dues from Previous Employer</span>';
											markup=markup+'<input id="PreviousNonUnion_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="Union_Dues_Previous_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Salaries & Other form of Comp.from Previous Employer</span>';
											markup=markup+'<input id="PreviousNoSalOtherComp_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="Salaries_OtherComp_Previous_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Nontaxable Comp. Income from Previous Employer</span>';
											markup=markup+'<input id="PreviousNoTotalComp_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="Total_Comp_Income_NonTax_Previous_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div><br>';
											
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>13th Month & Other Benefits from Present Employer</span>';
											markup=markup+'<input id="PresentNonThreeOne_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="OneThreeOtherBenefits_Present_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
                                                    var PhilhealthCal=0;
                                            if('{{$rows->philhealth_contribution}}'==0){

                                            }else{
                                                if('{{$rows->philhealth_contribution}}'==1){
                                                    if('{{$rows->basic_salary}}'<=10000.00){
                                                        
                                                        PhilhealthCal=137.50;
                                                    }
                                                    if('{{$rows->basic_salary}}'>=10000.01 && '{{$rows->basic_salary}}'<=39999.99){
                                                        PhilhealthCal=(2.75/100)*'{{$rows->basic_salary}}';
                                                    }
                                                    if('{{$rows->basic_salary}}'>=40000.00){
                                                        PhilhealthCal=550.00;
                                                    }
                                                }
                                            }

                                            var SSSCal=0;
											SSSCal='{{$rows->sss_contribution}}';
											var Basic='{{$rows->basic_salary}}';
											if(SSSCal=="Let System Decide" || SSSCal==""){
												@foreach($reference_sss_all as $dat)
                                                    var min='{{$dat->min_range}}';
                                                    var max='{{$dat->max_range}}';
                                                    if(Basic>=min && Basic<=max){		
                                                        SSSCal='{{$dat->ss_ee}}';
                                                    }
                                                @endforeach
                                                if(SSSCal=="Let System Decide" || SSSCal==""){
                                                    SSSCal=0;
                                                }
											}

											var PagibigCal=0;
											PagibigCal='{{$rows->pagibigcont}}';
											if(PagibigCal=="Let System Decide" || PagibigCal==""){
												if(Basic>5000 ){
													PagibigCal=100;
												}
												if(Basic>1500 && Basic<=5000){
													PagibigCal=Basic*0.02;
												}
												if(Basic<=1500){
													PagibigCal=Basic*0.01;
												}
											}
											var UnionD=parseInt(PhilhealthCal)+parseInt(PagibigCal)+parseInt(SSSCal);
											markup=markup+'<span>De Minimis Benefits from Present Employer</span>';
											markup=markup+'<input id="PresentNonDeminimis_7_4'+RowCount_7_4+'" type="number" value="<?php echo $rows->deminimis_total!=""? $rows->deminimis_total : "0.00" ; ?>"  step="0.01" class="form-control" name="DeminimisBenefit_Present_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>SSS, GSIS, PAG-IBIG & Union Dues from Present Employer</span>';
											markup=markup+'<input id="PresentNonUnion_7_4'+RowCount_7_4+'" type="number" value="'+UnionD+'" step="0.01" class="form-control" name="Union_Dues_Present_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Salaries & Other form of Comp.from Present Employer</span>';
											markup=markup+'<input id="PresentNoSalOtherComp_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="Salaries_OtherComp_Present_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Nontaxable Comp. Income from Present Employer</span>';
											markup=markup+'<input  id="PresentNoTotalComp_7_4'+RowCount_7_4+'"type="number" value="0.00" step="0.01" class="form-control" name="Total_Comp_Income_NonTax_Present_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											
											markup=markup+'</td>';
											
											markup=markup+'<td style="vertical-align:top;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Taxable Basic Salary from Previous Employer</span>';
											markup=markup+'<input id="PreviousTaxBasicSal_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="TaxableBasicSalary_Previous_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>13th Month & Other Benefits from Previous Employer</span>';
											markup=markup+'<input id="PreviousTaxOnThree_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="TaxableOneThreeOtherBenefits_Previous_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Salaries & Other form of Comp.from Previous Employer</span>';
											markup=markup+'<input id="PreviousTaxSalOtherTax_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="TaxableSalaries_OtherComp_Previous_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Taxable from Previous Employer</span>';
											markup=markup+'<input id="PreviousTaxTotalCompIncome_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="Total_Tax_Previous_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div><br>';
											
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Taxable Basic Salary from Present Employer</span>';
											markup=markup+'<input id="PresentTaxBasicSal_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="TaxableBasicSalary_Present_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>13th Month & Other Benefits from Present Employer</span>';
											markup=markup+'<input id="PresentTaxOnThree_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="TaxableOneThreeOtherBenefits_Present_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Salaries & Other form of Comp.from Present Employer</span>';
											markup=markup+'<input id="PresentTaxSalOtherTax_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="TaxableSalaries_OtherComp_Present_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Taxable from Present Employer</span>';
											markup=markup+'<input id="PresentTaxTotalCompIncome_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="Total_Tax_Present_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div><br>';
											
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Taxable from Previous & Present Employer</span>';
											markup=markup+'<input id="PreviousPresentTaxTotalCompIncome_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="Total_Tax_Previous_And_Present_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div><br>';
											
											markup=markup+'</td>';
											
                                            markup=markup+'<td style="vertical-align:top;">';
											
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Net Taxable Comp. Income</span>';
											markup=markup+'<input id="NetTaxableCompIncome_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="NetTaxableCompIncomeOther_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Due (Jan. to Dec.)</span>';
											markup=markup+'<input id="TaxDueJanDec_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="TaxDueOther_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Withheld From Previous Employer(Jan. to Nov.)</span>';
											markup=markup+'<input  id="PreviousTaxWithheldJanDec_7_4'+RowCount_7_4+'"type="number" value="0.00" step="0.01" class="form-control" name="TaxwithheldfrompreviousOther_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Withheld From Present Employer(Jan. to Nov.)</span>';
											markup=markup+'<input id="PresentTaxWithheldJanDec_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="TaxwithheldfrompresentOther_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Amount Withheld and Paid for in Dec.</span>';
											markup=markup+'<input id="AmountWithheldPaidDec_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="AmountwithheldforindecOther_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Overwithheld Tax Refunded</span>';
											markup=markup+'<input id="Overwithheldrefunded_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="OverwithheldtaxrefundedOther_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Amount of Tax Withheld as Adjustment</span>';
											markup=markup+'<input  id="AmtTaxWithheldAdj_7_4'+RowCount_7_4+'"type="number" value="0.00" step="0.01" class="form-control" name="AmountofTaxWithheldasAdjOther_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Gross Compensation Income (Previous & Present)</span>';
											markup=markup+'<input id="GrossCompensationPrevPresent_7_4'+RowCount_7_4+'" type="number" value="0.00" step="0.01" class="form-control" name="GrossCompIncomePrevAndPresentOther_7_4'+RowCount_7_4+'" required >';
											markup=markup+'</div>';
											markup=markup+'</td>';
											markup=markup+'</tr>';
											
                                        $("#tbodyBIR_7_4_1cf").append(markup);
										@endforeach
									}
									function removeRow_7_4_1cf(rowid){
										document.getElementById('tbodyBIR_7_4_1cf').deleteRow(rowid-2);
										
									}
									function AddRow_7_5_1cf(){
										@foreach($employee_list as $rows)
										RowCount_7_5++;
										document.getElementById('tablecount_7_5_1cf').value=RowCount_7_5;
										//var trid='transactiontr'+columncount;
										var markup = '<tr id="BIRTR_7_5_1cf'+RowCount_7_5+'">';
											
                                            markup=markup+'<td style="vertical-align:top;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Registered Name</span>';
                                            markup=markup+'<select class="form-control" id="rname_7_5_1cf'+RowCount_7_5+'" name="RName_7_5'+RowCount_7_5+'">';
											
											markup=markup+'<option value="<?php echo $rows->employee_id; ?>"><?php echo ucwords(strtolower($rows->fname." ".$rows->mname." ".$rows->lname)); ?></option>';
											
											markup=markup+'</select>';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Region</span>';
                                            markup=markup+'<select class="form-control" id="region_7_5_1cf'+RowCount_7_5+'" name="Region_7_5'+RowCount_7_5+'">';
											
											markup=markup+'<option>I</option>';
											markup=markup+'<option>II</option>';
											markup=markup+'<option>III</option>';
											markup=markup+'<option>IV-A</option>';
											markup=markup+'<option>IV-B</option>';
											markup=markup+'<option>V</option>';
											markup=markup+'<option>VI</option>';
											markup=markup+'<option>VII</option>';
											markup=markup+'<option>VIII</option>';
											markup=markup+'<option>IX</option>';
											markup=markup+'<option>X</option>';
											markup=markup+'<option>XI</option>';
											markup=markup+'<option>XII</option>';
											markup=markup+'<option>ARMM</option>';
											markup=markup+'<option>CAR</option>';
											markup=markup+'<option>NCR</option>';
											
											markup=markup+'</select>';
											markup=markup+'</div>';
											
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Factor Used(No. of Days/Year)</span>';
                                            markup=markup+'<input type="number" class="form-control" value="261" id="factor_7_5_1cf'+RowCount_7_5+'" name="Factor_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Employement From</span>';
                                            markup=markup+'<input type="date" class="form-control" value="261" id="from_7_5_1cf'+RowCount_7_5+'" name="From_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Employement To</span>';
                                            markup=markup+'<input type="date" class="form-control" value="261" id="to_7_5_1cf'+RowCount_7_5+'" name="To_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											
											markup=markup+'</td>';
											
                                            markup=markup+'<td style="vertical-align:middle;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Gross Comp. Income From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="gross_7_5_1cf'+RowCount_7_5+'" name="Gross_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Basic Statutory Min. Wage From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="basicstat_7_5_1cf'+RowCount_7_5+'" name="BasicStat_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Holiday Pay From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="holiday_7_5_1cf'+RowCount_7_5+'" name="Holiday_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Overtime Pay From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="overtime_7_5_1cf'+RowCount_7_5+'" name="Overtime_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Night Shift Differential From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="night_7_5_1cf'+RowCount_7_5+'" name="Night_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Hazard Pay From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="hazard_7_5_1cf'+RowCount_7_5+'" name="Hazard_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>13th Month & Other Benefits From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="onethree_7_5_1cf'+RowCount_7_5+'" name="OneThree_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>De Minimis Benefits From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="deminimis_7_5_1cf'+RowCount_7_5+'" name="Deminimis_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>SSS,GSIS, PAG_IBIG & Union Dues From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="sss_7_5_1cf'+RowCount_7_5+'" name="SSS_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Salaries & Other Forms of Comp. From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="sal_7_5_1cf'+RowCount_7_5+'" name="Sal_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Non-Taxable/Exempt Comp. Income From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="totnontaxprevious_7_5_1cf'+RowCount_7_5+'" name="TotNonTaxPrevious_7_5'+RowCount_7_5+'">';
											markup=markup+'</div><br>';
											
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Gross Comp. Income From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="grossPresent_7_5_1cf'+RowCount_7_5+'" name="GrossPresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Basic Statutory Min. Wage/Day From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="<?php echo $rows->basic_salary/26; ?>" id="basicstatDayPresent_7_5_1cf'+RowCount_7_5+'" name="BasicStatDayPresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Basic Statutory Min. Wage/Month From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="<?php echo $rows->basic_salary; ?>" id="basicstatWeekPresent_7_5_1cf'+RowCount_7_5+'" name="BasicStatWeekPresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Basic Statutory Min. Wage/Year From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="<?php echo $rows->basic_salary*12; ?>" id="basicstatYearPresent_7_5_1cf'+RowCount_7_5+'" name="BasicStatYearPresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Basic Statutory Min. Wage From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="basicstatPresent_7_5_1cf'+RowCount_7_5+'" name="BasicStatPresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span >Holiday Pay From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="holidayPresent_7_5_1cf'+RowCount_7_5+'" name="HolidayPresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Overtime Pay From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="overtimePresent_7_5_1cf'+RowCount_7_5+'" name="OvertimePresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Night Shift Differential From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="nightPresent_7_5_1cf'+RowCount_7_5+'" name="NightPresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Hazard Pay From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="hazard_Present7_5_1cf'+RowCount_7_5+'" name="HazardPresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>13th Month & Other Benefits From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="onethreePresent_7_5_1cf'+RowCount_7_5+'" name="OneThreePresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
                                                    var PhilhealthCal=0;
                                            if('{{$rows->philhealth_contribution}}'==0){

                                            }else{
                                                if('{{$rows->philhealth_contribution}}'==1){
                                                    if('{{$rows->basic_salary}}'<=10000.00){
                                                        
                                                        PhilhealthCal=137.50;
                                                    }
                                                    if('{{$rows->basic_salary}}'>=10000.01 && '{{$rows->basic_salary}}'<=39999.99){
                                                        PhilhealthCal=(2.75/100)*'{{$rows->basic_salary}}';
                                                    }
                                                    if('{{$rows->basic_salary}}'>=40000.00){
                                                        PhilhealthCal=550.00;
                                                    }
                                                }
                                            }

                                            var SSSCal=0;
											SSSCal='{{$rows->sss_contribution}}';
											var Basic='{{$rows->basic_salary}}';
											if(SSSCal=="Let System Decide" || SSSCal==""){
												@foreach($reference_sss_all as $dat)
                                                    var min='{{$dat->min_range}}';
                                                    var max='{{$dat->max_range}}';
                                                    if(Basic>=min && Basic<=max){		
                                                        SSSCal='{{$dat->ss_ee}}';
                                                    }
                                                @endforeach
                                                if(SSSCal=="Let System Decide" || SSSCal==""){
                                                    SSSCal=0;
                                                }
											}

											var PagibigCal=0;
											PagibigCal='{{$rows->pagibigcont}}';
											if(PagibigCal=="Let System Decide" || PagibigCal==""){
												if(Basic>5000 ){
													PagibigCal=100;
												}
												if(Basic>1500 && Basic<=5000){
													PagibigCal=Basic*0.02;
												}
												if(Basic<=1500){
													PagibigCal=Basic*0.01;
												}
											}
											var UnionD=parseInt(PhilhealthCal)+parseInt(PagibigCal)+parseInt(SSSCal);
											markup=markup+'<span>De Minimis Benefits From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="<?php echo $rows->deminimis_total!=""? $rows->deminimis_total : "0.00" ; ?>" id="deminimisPresent_7_5_1cf'+RowCount_7_5+'" name="DeminimisPresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>SSS,GSIS, PAG_IBIG & Union Dues From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control"  value="'+UnionD+'" id="sssPresent_7_5_1cf'+RowCount_7_5+'" name="SSSPresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Salaries & Other Forms of Comp. From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="salPresent_7_5_1cf'+RowCount_7_5+'" name="SalPresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Non-Taxable/Exempt Comp. Income From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="totnontaxpreviousPresent_7_5_1cf'+RowCount_7_5+'" name="TotNonTaxPreviousPresent_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											
											markup=markup+'</td>';
											
											markup=markup+'<td style="vertical-align:top;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>13th Month & Other Comp. From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="onethreeprevioustaxable_7_5_1cf'+RowCount_7_5+'" name="OneThreePreviousTaxable_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Salaries & Other Comp. From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="sal_other_compprevioustaxable_7_5_1cf'+RowCount_7_5+'" name="SalOtherCompPreviousTaxable_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Taxable From Previous Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="total_taxableprevioustaxable_7_5_1cf'+RowCount_7_5+'" name="Total_Taxable_PreviousTaxable_7_5'+RowCount_7_5+'">';
											markup=markup+'</div><br>';
											
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Taxable Basic Salary From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="basicsalarypresenttaxable_7_5_1cf'+RowCount_7_5+'" name="BasicSalaryPresentTaxable_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>13th Month & Other Comp. From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="onethreepresenttaxable_7_5_1cf'+RowCount_7_5+'" name="OneThreePresentTaxable_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Salaries & Other Comp. From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="sal_other_compPresenttaxable_7_5_1cf'+RowCount_7_5+'" name="SalOtherCompPresentTaxable_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Taxable From Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="total_taxablePresenttaxable_7_5_1cf'+RowCount_7_5+'" name="Total_Taxable_PresentTaxable_7_5'+RowCount_7_5+'">';
											markup=markup+'</div><br>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Total Taxable From Previous & Present Employer</span>';
                                            markup=markup+'<input type="number" class="form-control" value="0.00" id="total_taxablePreviousPresenttaxable_7_5_1cf'+RowCount_7_5+'" name="Total_Taxable_PreviousPresentTaxable_7_5'+RowCount_7_5+'">';
											markup=markup+'</div>';
											markup=markup+'</td>';
											
                                            markup=markup+'<td style="vertical-align:top;">';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Net Taxable Comp. Income</span>';
											markup=markup+'<input type="number" id="nettaxablecompincomeother_7_5'+RowCount_7_5+'" value="0.00" step="0.01" class="form-control" name="NetTaxableCompIncomeOther_7_5'+RowCount_7_5+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Due (Jan. to Dec.)</span>';
											markup=markup+'<input type="number" id="TaxDueOther_7_5'+RowCount_7_5+'" value="0.00" step="0.01" class="form-control" name="TaxDueOther_7_5'+RowCount_7_5+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Withheld From Previous Employer(Jan. to Nov.)</span>';
											markup=markup+'<input type="number" id="taxwithheldfrompreviousother_7_5'+RowCount_7_5+'" value="0.00" step="0.01" class="form-control" name="TaxwithheldfrompreviousOther_7_5'+RowCount_7_5+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Tax Withheld From Present Employer(Jan. to Nov.)</span>';
											markup=markup+'<input type="number" id="taxwithheldfrompresentother_7_5'+RowCount_7_5+'" value="0.00" step="0.01" class="form-control" name="TaxwithheldfrompresentOther_7_5'+RowCount_7_5+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Amount Withheld and Paid for in Dec.</span>';
											markup=markup+'<input type="number" id="amountwithheldforindecother_7_5'+RowCount_7_5+'" value="0.00" step="0.01" class="form-control" name="AmountwithheldforindecOther_7_5'+RowCount_7_5+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Overwithheld Tax Refunded</span>';
											markup=markup+'<input type="number" id="overwithheldtaxrefundedother_7_5'+RowCount_7_5+'" value="0.00" step="0.01" class="form-control" name="OverwithheldtaxrefundedOther_7_5'+RowCount_7_5+'" required >';
											markup=markup+'</div>';
											markup=markup+'<div class="form-custom-govt">';
											markup=markup+'<span>Amount of Tax Withheld as Adjustment</span>';
											markup=markup+'<input type="number" id="amountoftaxwithheldasadjother_7_5'+RowCount_7_5+'" value="0.00" step="0.01" class="form-control" name="AmountofTaxWithheldasAdjOther_7_5'+RowCount_7_5+'" required >';
											markup=markup+'</div>';
											markup=markup+'</td>';
											markup=markup+'</tr>';
											
                                        $("#tbodyBIR_7_5_1cf").append(markup);

										document.getElementById('region_7_5_1cf'+RowCount_7_5).value="<?php echo $rows->region; ?>";
                                        @endforeach
									}
									function removeRow_7_5_1cf(rowid){
										document.getElementById('tbodyBIR_7_5_1cf').deleteRow(rowid-2);
										
									}
									function setTaxRate_1cf(no){
										var ATC=document.getElementById('atc_1cf'+no).value;
										var payment=document.getElementById('amount_1cf'+no).value;
										var rate="0.00";
										if(ATC=="WC190" || ATC=="WC191" || ATC=="WC410" || ATC=="WC700" || ATC=="WI202" || ATC=="WI203" || ATC=="WI240" || ATC=="WI380" || ATC=="WI410" || ATC=="WI700"){
											rate="10.00";
										}
										else if(ATC=="WC212" || ATC=="WC213" || ATC=="WC230" || ATC=="WI350"){
											rate="30.00";
										}
										else if(ATC=="WC222" || ATC=="WC223" || ATC=="WC280"){
											rate="15.00";
										}
										else if( ATC=="WC180" ||ATC=="WC250" || ATC=="WI224" || ATC=="WI225" || ATC=="WI226" || ATC=="WI250" || ATC=="WI260"){
											rate="20.00";
										}
										else if(ATC=="WC290"){
											rate="4.50";
										}
										else if(ATC=="WC300"){
											rate="7.50";
										}
										else if(ATC=="WC310" || ATC=="WI310"){
											rate="8.00";
										}
										else if(ATC=="WC340" || ATC=="WI330" || ATC=="WI340" || ATC=="WI341" ){
											rate="25.00";
										}
										document.getElementById('rate_1cf'+no).value=rate;
										
										computetotal_1cf(no);
									}
									function computetotal_1cf(no){
										var payment=document.getElementById('amount_1cf'+no).value;
										var total=parseFloat(payment)*(parseFloat(document.getElementById('rate_1cf'+no).value)/100);
										document.getElementById('total_1cf'+no).value=total;
									}
								</script>
								<table class="table" style="background-color:white;color:#083240;">
								<thead style="background-color:#124f62; color:white;">
									<tr>
										<th style="vertical-align:middle;" colspan="9">Schedule 5</th>
									</tr>
									<tr>
									<th style="vertical-align:middle;">Registered Name</th>
									<th style="vertical-align:middle;">Status Code</th>
									<th style="vertical-align:middle;">ATC</th>
									<th style="vertical-align:middle;">Income Payment</th>
									<th style="vertical-align:middle;">Tax Rate</th>
									<th style="vertical-align:middle;">Tax Withheld</th>
									</tr>
								</thead>
								<tbody id="tbodyBIR_1cf">
									
								</tbody>
								</table>
								<br>
								<table class="table" style="background-color:white;color:#083240;">
								<thead style="background-color:#124f62; color:white;">
									<tr>
										<th style="vertical-align:middle;" colspan="9">Schedule 6</th>
									</tr>
									<tr>
									<th style="vertical-align:middle;">Registered Name</th>
									<th style="vertical-align:middle;">ATC</th>
									<th style="vertical-align:middle;">Fringe Benefit</th>
									<th style="vertical-align:middle;">Monetary Value</th>
									<th style="vertical-align:middle;">Amount Withheld</th>
									</tr>
								</thead>
								<tbody id="tbodyBIR_6_1cf">
									
								</tbody>
								</table>
								<br>
								<table class="table" style="background-color:white;color:#083240;">
								<thead style="background-color:#124f62; color:white;">
									<tr>
										<th style="vertical-align:middle;" colspan="9">Schedule 7.1</th>
									</tr>
									<tr>
									<th style="vertical-align:middle;" width="15%"></th>
									<th style="vertical-align:middle;"></th>
									<th style="vertical-align:middle;"></th>
									<th style="vertical-align:middle;"></th>
									</tr>
								</thead>
								<tbody id="tbodyBIR_7_1cf">
									
								</tbody>
								</table>
								<br>
								<table class="table" style="background-color:white;color:#083240;">
								<thead style="background-color:#124f62; color:white;">
									<tr>
										<th style="vertical-align:middle;" colspan="9">Schedule 7.3</th>
									</tr>
									<tr>
									<th style="vertical-align:middle;" width="15%"></th>
									<th style="vertical-align:middle;"></th>
									<th style="vertical-align:middle;"></th>
									<th style="vertical-align:middle;"></th>
									</tr>
								</thead>
								<tbody id="tbodyBIR_7_3_1cf">
									
								</tbody>
								</table>
								<br>
								<table class="table" style="background-color:white;color:#083240;">
								<thead style="background-color:#124f62; color:white;">
									<tr>
										<th style="vertical-align:middle;" colspan="9">Schedule 7.4</th>
									</tr>
									<tr>
									<th style="vertical-align:middle;" width="15%"></th>
									<th style="vertical-align:middle;text-align:center;">Non-Taxable</th>
									<th style="vertical-align:middle;text-align:center;">Taxable</th>
									<th style="vertical-align:middle;text-align:center;">Other Items</th>
									</tr>
								</thead>
								<tbody id="tbodyBIR_7_4_1cf">
									
								</tbody>
								</table>
								<br>
								<table class="table" style="background-color:white;color:#083240;">
								<thead style="background-color:#124f62; color:white;">
									<tr>
										<th style="vertical-align:middle;" colspan="9">Schedule 7.5</th>
									</tr>
									<tr>
									<th style="vertical-align:middle;" width="15%"></th>
									<th style="vertical-align:middle;text-align:center;">Non-Taxable</th>
									<th style="vertical-align:middle;text-align:center;">Taxable</th>
									<th style="vertical-align:middle;text-align:center;">Other Items</th>
									</tr>
								</thead>
								<tbody id="tbodyBIR_7_5_1cf">
									
								</tbody>
								</table>
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
							<div class="container-fluid">
								<input type="button" class="btn btn-success"  onclick="GenerateExcelFile('1604CF')" value="Generate 1604CF Excel File">
								<input type="submit" style="float:right;" class="btn btn-primary" id="submitbir1604cfform" name="SubmitBIR1604CFForm" value="Generate 1604CF DAT File">
							</div>
							</div>
						</div>
						<br>
						</form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="CONTRIBUTION" role="tabpanel" aria-labelledby="contact-tab">
            
        </div>
        <div class="tab-pane fade" id="LOAN" role="tabpanel" aria-labelledby="contact-tab">
            
        </div>
    </div>
</div>
<script>
function GenerateExcelFile(form){
    
    if(form=="1600"){
        var AllDat= [];
        var tablecount=document.getElementById('tablecount').value;
        for(var c=tablecount;c>0;c--){
            if(document.getElementById('rname'+c)){
            var name=document.getElementById('rname'+c).value;
            var atc=document.getElementById('atc'+c).value;
            var amount=document.getElementById('amount'+c).value;
            var rate=document.getElementById('rate'+c).value;
            var total=document.getElementById('total'+c).value;
            var dat = [name, atc,amount,rate,total];
            AllDat.push(dat);
            }
            
        }
        //ajax
        $.ajax({
        type: 'POST',
        url: 'extra/attendance/download/excelBIRForm.php',
        data: {AllDat:AllDat,Form:form,_token: '{{csrf_token()}}'},
        success: function(data) {
            $( "#DownloadExcelDiv" ).replaceWith( data );
        } 											 
        })
    }
    else if(form=="1601E"){
        var Quarter=document.getElementById('Quarter1604E').value;
        var tablecount_1e=document.getElementById('tablecount_1e').value;
        var AllDat= [];
        for(var c=tablecount_1e;c>0;c--){
            if(document.getElementById('rname_1e'+c)){
            var month_tran=document.getElementById('month_tran'+c).value;
            var year_tran=document.getElementById('year_tran'+c).value;
            var rname_1e=document.getElementById('rname_1e'+c).value;
            var atc_1e=document.getElementById('atc_1e'+c).value;
            var amount_1e=document.getElementById('amount_1e'+c).value;
            var rate_1e=document.getElementById('rate_1e'+c).value;
            var total_1e=document.getElementById('total_1e'+c).value;
            var dat = [month_tran, year_tran,rname_1e,atc_1e,amount_1e,rate_1e,total_1e];
            AllDat.push(dat);
            }
            
        }
        $.ajax({
        type: 'POST',
        url: 'extra/attendance/download/excelBIRForm.php',
        data: {AllDat:AllDat,Form:form,Quarter:Quarter,_token: '{{csrf_token()}}'},
        success: function(data) {
            $( "#DownloadExcelDiv" ).replaceWith( data );
        } 											 
        })
    }
    else if(form=="1601F"){
        
        var Quarter=document.getElementById('Quarter1601F').value;
        var tablecount_1f=document.getElementById('tablecount_1f').value;
        var AllDat= [];
        for(var c=tablecount_1f;c>0;c--){
            if(document.getElementById('rname_1f'+c)){
            var month_1=document.getElementById('month_1'+c).value;
            var year_1601F=document.getElementById('year_1601F'+c).value;
            var rname_1f=document.getElementById('rname_1f'+c).value;
            var atc_1f=document.getElementById('atc_1f'+c).value;
            var amount_1f=document.getElementById('amount_1f'+c).value;
            var rate_1f=document.getElementById('rate_1f'+c).value;
            var total_1f=document.getElementById('total_1f'+c).value;
            var dat = [month_1, year_1601F,rname_1f,atc_1f,amount_1f,rate_1f,total_1f];
            AllDat.push(dat);
            }
            
        }
        $.ajax({
        type: 'POST',
        url: 'extra/attendance/download/excelBIRForm.php',
        data: {AllDat:AllDat,Form:form,Quarter:Quarter,_token: '{{csrf_token()}}'},
        success: function(data) {
            $( "#DownloadExcelDiv" ).replaceWith( data );
        } 											 
        })
        
    }
    else if(form=="2553"){
        var AllDat= [];
        var tablecount=document.getElementById('tablecount_3T').value;
        for(var c=tablecount;c>0;c--){
            if(document.getElementById('rname_3T'+c)){
            var name=document.getElementById('rname_3T'+c).value;
            var atc=document.getElementById('atc_3T'+c).value;
            var amount=document.getElementById('amount_3T'+c).value;
            var rate=document.getElementById('rate_3T'+c).value;
            var total=document.getElementById('total_3T'+c).value;
            var dat = [name, atc,amount,rate,total];
            AllDat.push(dat);
            }
            
        }
        //ajax
        $.ajax({
        type: 'POST',
        url: 'extra/attendance/download/excelBIRForm.php',
        data: {AllDat:AllDat,Form:form,_token: '{{csrf_token()}}'},
        success: function(data) {
            $( "#DownloadExcelDiv" ).replaceWith( data );
        } 											 
        })
    }
    else if(form=="1604E"){
        var AllDat= [];
        var AllDat2= [];
        var tablecount_4E=document.getElementById('tablecount_4E').value;
        var tablecount_3_4E=document.getElementById('tablecount_3_4E').value;
        for(var c=tablecount_3_4E;c>0;c--){
            if(document.getElementById('rname_3_4E'+c)){
                var name=document.getElementById('rname_3_4E'+c).value;
                var atc_3_4E=document.getElementById('atc_3_4E'+c).value;
                var amount_3_4E=document.getElementById('amount_3_4E'+c).value;
                var dat = [name, atc_3_4E,amount_3_4E];
                AllDat.push(dat);
            }
        }
        for(var c=tablecount_4E;c>0;c--){
            if(document.getElementById('rname_4E'+c)){
            var name=document.getElementById('rname_4E'+c).value;
            var atc=document.getElementById('atc_4E'+c).value;
            var amount=document.getElementById('amount_4E'+c).value;
            var rate=document.getElementById('rate_4E'+c).value;
            var total=document.getElementById('total_4E'+c).value;
            var dat = [name, atc,amount,rate,total];
            AllDat2.push(dat);
            }
            
        }
        $.ajax({
        type: 'POST',
        url: 'extra/attendance/download/excelBIRForm.php',
        data: {AllDat:AllDat,AllDat2:AllDat2,Form:form,_token: '{{csrf_token()}}'},
        success: function(data) {
            $( "#DownloadExcelDiv" ).replaceWith( data );
        } 											 
        })
    }
    else if(form=="1604CF"){
        var AllDat= [];
        var AllDat2= [];
        var AllDat3= [];
        var AllDat4= [];
        var AllDat5= [];
        var AllDat6= [];
        var sched5=document.getElementById('tablecount_1cf').value;
        var sched6=document.getElementById('tablecount_6_1cf').value;
        var sched7=document.getElementById('tablecount_7_1cf').value;
        var sched8=document.getElementById('tablecount_7_3_1cf').value;
        var sched9=document.getElementById('tablecount_7_4_1cf').value;
        var sched10=document.getElementById('tablecount_7_5_1cf').value;
        for(var c=sched5;c>0;c--){
            if(document.getElementById('rname_1cf'+c)){
            var name=document.getElementById('rname_1cf'+c).value;
            var statuscode_1cf=document.getElementById('statuscode_1cf'+c).value;
            var atc_1cf=document.getElementById('atc_1cf'+c).value;
            var amount=document.getElementById('amount_1cf'+c).value;
            var rate=document.getElementById('rate_1cf'+c).value;
            var total=document.getElementById('total_1cf'+c).value;
            var dat = [name,statuscode_1cf, atc_1cf,amount,rate,total];
            AllDat.push(dat);
            }
        }
        for(var c=sched6;c>0;c--){
            if(document.getElementById('rname_6_1cf'+c)){
            var name=document.getElementById('rname_6_1cf'+c).value;
            var atc=document.getElementById('atc_6_1cf'+c).value;
            var amount=document.getElementById('amount_6_1cf'+c).value;
            var rate=document.getElementById('rate_6_1cf'+c).value;
            var total=document.getElementById('total_6_1cf'+c).value;
            var dat = [name, atc,amount,rate,total];
            AllDat2.push(dat);
            }
            
        }
        for(var c=sched7;c>0;c--){
            if(document.getElementById('rname_7_1cf'+c)){
            var name=document.getElementById('rname_7_1cf'+c).value;
            var FROMEmployee_7=document.getElementById('FROMEmployee_7'+c).value;
            var TOEmployee_7=document.getElementById('TOEmployee_7'+c).value;
            var NonGross_7=document.getElementById('NonGross_7'+c).value;
            var NonThreeOne_7=document.getElementById('NonThreeOne_7'+c).value;
            var NonDeminimis_7=document.getElementById('NonDeminimis_7'+c).value;
            var NonUnion_7=document.getElementById('NonUnion_7'+c).value;
            var NoSalOtherComp_7=document.getElementById('NoSalOtherComp_7'+c).value;
            var NoTotalComp_7=document.getElementById('NoTotalComp_7'+c).value;
            
            var TaxBasicSal_7=document.getElementById('TaxBasicSal_7'+c).value;
            var TaxOnThree_7=document.getElementById('TaxOnThree_7'+c).value;
            var TaxSalOtherTax_7=document.getElementById('TaxSalOtherTax_7'+c).value;
            var TaxTotalCompIncome_7=document.getElementById('TaxTotalCompIncome_7'+c).value;
            var TaxNetCompIncome_7=document.getElementById('TaxNetCompIncome_7'+c).value;
            
            var TaxDueJanDec_7=document.getElementById('TaxDueJanDec_7'+c).value;
            var TaxWithheldJanDec_7=document.getElementById('TaxWithheldJanDec_7'+c).value;
            var AmountWithheldPaidDec_7=document.getElementById('AmountWithheldPaidDec_7'+c).value;
            var Overwithheldrefunded_7=document.getElementById('Overwithheldrefunded_7'+c).value;
            var SubFilling_7=document.getElementById('SubFilling_7'+c).value;
            var AmtTaxWithheldAdj_7=document.getElementById('AmtTaxWithheldAdj_7'+c).value;
            
            
            var dat = [name, FROMEmployee_7,TOEmployee_7,NonGross_7,NonThreeOne_7,NonDeminimis_7,NonUnion_7,NoSalOtherComp_7,NoTotalComp_7,TaxBasicSal_7,TaxOnThree_7,TaxSalOtherTax_7,TaxTotalCompIncome_7,TaxNetCompIncome_7,TaxDueJanDec_7,TaxWithheldJanDec_7,AmountWithheldPaidDec_7,Overwithheldrefunded_7,SubFilling_7,AmtTaxWithheldAdj_7];
            AllDat3.push(dat);
            }
            
        }
        for(var c=sched8;c>0;c--){
            if(document.getElementById('rname_7_3_1cf'+c)){
            var name=document.getElementById('rname_7_3_1cf'+c).value;
            
            var NonGross_7=document.getElementById('NonGross_7_3'+c).value;
            var NonThreeOne_7=document.getElementById('NonThreeOne_7_3'+c).value;
            var NonDeminimis_7=document.getElementById('NonDeminimis_7_3'+c).value;
            var NonUnion_7=document.getElementById('NonUnion_7_3'+c).value;
            var NoSalOtherComp_7=document.getElementById('NoSalOtherComp_7_3'+c).value;
            var NoTotalComp_7=document.getElementById('NoTotalComp_7_3'+c).value;
            
            var TaxBasicSal_7=document.getElementById('TaxBasicSal_7_3'+c).value;
            var TaxOnThree_7=document.getElementById('TaxOnThree_7_3'+c).value;
            var TaxSalOtherTax_7=document.getElementById('TaxSalOtherTax_7_3'+c).value;
            var TaxTotalCompIncome_7=document.getElementById('TaxTotalCompIncome_7_3'+c).value;
            var TaxNetCompIncome_7=document.getElementById('TaxNetCompIncome_7_3'+c).value;
            
            var TaxDueJanDec_7=document.getElementById('TaxDueJanDec_7_3'+c).value;
            var TaxWithheldJanDec_7=document.getElementById('TaxWithheldJanDec_7_3'+c).value;
            var AmountWithheldPaidDec_7=document.getElementById('AmountWithheldPaidDec_7_3'+c).value;
            var Overwithheldrefunded_7=document.getElementById('Overwithheldrefunded_7_3'+c).value;
            var SubFilling_7=document.getElementById('SubFilling_7_3'+c).value;
            var AmtTaxWithheldAdj_7=document.getElementById('AmtTaxWithheldAdj_7_3'+c).value;
            
            
            var dat = [name,NonGross_7,NonThreeOne_7,NonDeminimis_7,NonUnion_7,NoSalOtherComp_7,NoTotalComp_7,TaxBasicSal_7,TaxOnThree_7,TaxSalOtherTax_7,TaxTotalCompIncome_7,TaxNetCompIncome_7,TaxDueJanDec_7,TaxWithheldJanDec_7,AmountWithheldPaidDec_7,Overwithheldrefunded_7,SubFilling_7,AmtTaxWithheldAdj_7];
            AllDat4.push(dat);
            }
            
        }
        for(var c=sched9;c>0;c--){
            if(document.getElementById('rname_7_4_1cf'+c)){
                var name=document.getElementById('rname_7_3_1cf'+c).value;
                
                var PreviousNonThreeOne_7_4=document.getElementById('PreviousNonThreeOne_7_4'+c).value;
                var PreviousNonDeminimis_7_4=document.getElementById('PreviousNonDeminimis_7_4'+c).value;
                var PreviousNonUnion_7_4=document.getElementById('PreviousNonUnion_7_4'+c).value;
                var PreviousNoSalOtherComp_7_4=document.getElementById('PreviousNoSalOtherComp_7_4'+c).value;
                var PreviousNoTotalComp_7_4=document.getElementById('PreviousNoTotalComp_7_4'+c).value;
                
                var PresentNonThreeOne_7_4=document.getElementById('PresentNonThreeOne_7_4'+c).value;
                var PresentNonDeminimis_7_4=document.getElementById('PresentNonDeminimis_7_4'+c).value;
                var PresentNonUnion_7_4=document.getElementById('PresentNonUnion_7_4'+c).value;
                var PresentNoSalOtherComp_7_4=document.getElementById('PresentNoSalOtherComp_7_4'+c).value;
                var PresentNoTotalComp_7_4=document.getElementById('PresentNoTotalComp_7_4'+c).value;
                
                var PreviousTaxBasicSal_7_4=document.getElementById('PreviousTaxBasicSal_7_4'+c).value;
                var PreviousTaxOnThree_7_4=document.getElementById('PreviousTaxOnThree_7_4'+c).value;
                var PreviousTaxSalOtherTax_7_4=document.getElementById('PreviousTaxSalOtherTax_7_4'+c).value;
                var PreviousTaxTotalCompIncome_7_4=document.getElementById('PreviousTaxTotalCompIncome_7_4'+c).value;
                
                var PresentTaxBasicSal_7_4=document.getElementById('PresentTaxBasicSal_7_4'+c).value;
                var PresentTaxOnThree_7_4=document.getElementById('PresentTaxOnThree_7_4'+c).value;
                var PresentTaxSalOtherTax_7_4=document.getElementById('PresentTaxSalOtherTax_7_4'+c).value;
                var PresentTaxTotalCompIncome_7_4=document.getElementById('PresentTaxTotalCompIncome_7_4'+c).value;
                
                var PreviousPresentTaxTotalCompIncome_7_4=document.getElementById('PreviousPresentTaxTotalCompIncome_7_4'+c).value;
                
                var NetTaxableCompIncome_7_4=document.getElementById('NetTaxableCompIncome_7_4'+c).value;
                var TaxDueJanDec_7_4=document.getElementById('TaxDueJanDec_7_4'+c).value;
                var PreviousTaxWithheldJanDec_7_4=document.getElementById('PreviousTaxWithheldJanDec_7_4'+c).value;
                var PresentTaxWithheldJanDec_7_4=document.getElementById('PresentTaxWithheldJanDec_7_4'+c).value;
                var AmountWithheldPaidDec_7_4=document.getElementById('AmountWithheldPaidDec_7_4'+c).value;
                var Overwithheldrefunded_7_4=document.getElementById('Overwithheldrefunded_7_4'+c).value;
                var AmtTaxWithheldAdj_7_4=document.getElementById('AmtTaxWithheldAdj_7_4'+c).value;
                var GrossCompensationPrevPresent_7_4=document.getElementById('GrossCompensationPrevPresent_7_4'+c).value;
                
                
                var dat = [name,PreviousNonThreeOne_7_4,PreviousNonDeminimis_7_4,PreviousNonUnion_7_4,PreviousNoSalOtherComp_7_4,PreviousNoTotalComp_7_4,PresentNonThreeOne_7_4,PresentNonDeminimis_7_4,PresentNonUnion_7_4,PresentNoSalOtherComp_7_4,PresentNoTotalComp_7_4,PreviousTaxBasicSal_7_4,PreviousTaxOnThree_7_4,PreviousTaxSalOtherTax_7_4,PreviousTaxTotalCompIncome_7_4,PresentTaxBasicSal_7_4,PresentTaxOnThree_7_4,PresentTaxSalOtherTax_7_4,PresentTaxTotalCompIncome_7_4,PreviousPresentTaxTotalCompIncome_7_4,NetTaxableCompIncome_7_4,TaxDueJanDec_7_4,PreviousTaxWithheldJanDec_7_4,PresentTaxWithheldJanDec_7_4,AmountWithheldPaidDec_7_4,Overwithheldrefunded_7_4,AmtTaxWithheldAdj_7_4,GrossCompensationPrevPresent_7_4];
                AllDat5.push(dat);
            }
            
        }
        for(var c=sched10;c>0;c--){
            if(document.getElementById('rname_7_5_1cf'+c)){
                var name=document.getElementById('rname_7_5_1cf'+c).value;
                
                var region_7_5_1cf=document.getElementById('region_7_5_1cf'+c).value;
                var factor_7_5_1cf=document.getElementById('factor_7_5_1cf'+c).value;
                var from_7_5_1cf=document.getElementById('from_7_5_1cf'+c).value;
                var to_7_5_1cf=document.getElementById('to_7_5_1cf'+c).value;
                var gross_7_5_1cf=document.getElementById('gross_7_5_1cf'+c).value;
                var basicstat_7_5_1cf=document.getElementById('basicstat_7_5_1cf'+c).value;
                var holiday_7_5_1cf=document.getElementById('holiday_7_5_1cf'+c).value;
                var overtime_7_5_1cf=document.getElementById('overtime_7_5_1cf'+c).value;
                var night_7_5_1cf=document.getElementById('night_7_5_1cf'+c).value;
                var hazard_7_5_1cf=document.getElementById('hazard_7_5_1cf'+c).value;
                var onethree_7_5_1cf=document.getElementById('onethree_7_5_1cf'+c).value;
                var deminimis_7_5_1cf=document.getElementById('deminimis_7_5_1cf'+c).value;
                var sss_7_5_1cf=document.getElementById('sss_7_5_1cf'+c).value;
                var sal_7_5_1cf=document.getElementById('sal_7_5_1cf'+c).value;
                var totnontaxprevious_7_5_1cf=document.getElementById('totnontaxprevious_7_5_1cf'+c).value;
                var grossPresent_7_5_1cf=document.getElementById('grossPresent_7_5_1cf'+c).value;
                var basicstatDayPresent_7_5_1cf=document.getElementById('basicstatDayPresent_7_5_1cf'+c).value;
                var basicstatWeekPresent_7_5_1cf=document.getElementById('basicstatWeekPresent_7_5_1cf'+c).value;
                var basicstatYearPresent_7_5_1cf=document.getElementById('basicstatYearPresent_7_5_1cf'+c).value;
                var basicstatPresent_7_5_1cf=document.getElementById('basicstatPresent_7_5_1cf'+c).value;
                var holidayPresent_7_5_1cf=document.getElementById('holidayPresent_7_5_1cf'+c).value;
                var overtimePresent_7_5_1cf=document.getElementById('overtimePresent_7_5_1cf'+c).value;
                var nightPresent_7_5_1cf=document.getElementById('nightPresent_7_5_1cf'+c).value;
                var hazard_Present7_5_1cf=document.getElementById('hazard_Present7_5_1cf'+c).value;
                var onethreePresent_7_5_1cf=document.getElementById('onethreePresent_7_5_1cf'+c).value;
                var deminimisPresent_7_5_1cf=document.getElementById('deminimisPresent_7_5_1cf'+c).value;
                var sssPresent_7_5_1cf=document.getElementById('sssPresent_7_5_1cf'+c).value;
                var salPresent_7_5_1cf=document.getElementById('salPresent_7_5_1cf'+c).value;
                var totnontaxpreviousPresent_7_5_1cf=document.getElementById('totnontaxpreviousPresent_7_5_1cf'+c).value;
                var onethreeprevioustaxable_7_5_1cf=document.getElementById('onethreeprevioustaxable_7_5_1cf'+c).value;
                var sal_other_compprevioustaxable_7_5_1cf=document.getElementById('sal_other_compprevioustaxable_7_5_1cf'+c).value;
                var total_taxableprevioustaxable_7_5_1cf=document.getElementById('total_taxableprevioustaxable_7_5_1cf'+c).value;
                var basicsalarypresenttaxable_7_5_1cf=document.getElementById('basicsalarypresenttaxable_7_5_1cf'+c).value;
                var onethreepresenttaxable_7_5_1cf=document.getElementById('onethreepresenttaxable_7_5_1cf'+c).value;
                var sal_other_compPresenttaxable_7_5_1cf=document.getElementById('sal_other_compPresenttaxable_7_5_1cf'+c).value;
                var total_taxablePresenttaxable_7_5_1cf=document.getElementById('total_taxablePresenttaxable_7_5_1cf'+c).value;
                var total_taxablePreviousPresenttaxable_7_5_1cf=document.getElementById('total_taxablePreviousPresenttaxable_7_5_1cf'+c).value;
                var nettaxablecompincomeother_7_5=document.getElementById('nettaxablecompincomeother_7_5'+c).value;
                var TaxDueOther_7_5=document.getElementById('TaxDueOther_7_5'+c).value;
                var taxwithheldfrompreviousother_7_5=document.getElementById('taxwithheldfrompreviousother_7_5'+c).value;
                var taxwithheldfrompresentother_7_5=document.getElementById('taxwithheldfrompresentother_7_5'+c).value;
                var amountwithheldforindecother_7_5=document.getElementById('amountwithheldforindecother_7_5'+c).value;
                var overwithheldtaxrefundedother_7_5=document.getElementById('overwithheldtaxrefundedother_7_5'+c).value;
                var amountoftaxwithheldasadjother_7_5=document.getElementById('amountoftaxwithheldasadjother_7_5'+c).value;
                
                var dat = [name,region_7_5_1cf,factor_7_5_1cf,from_7_5_1cf,to_7_5_1cf,gross_7_5_1cf,basicstat_7_5_1cf,holiday_7_5_1cf,overtime_7_5_1cf,night_7_5_1cf,hazard_7_5_1cf,onethree_7_5_1cf,deminimis_7_5_1cf,sss_7_5_1cf,sal_7_5_1cf,totnontaxprevious_7_5_1cf,grossPresent_7_5_1cf,basicstatDayPresent_7_5_1cf,basicstatWeekPresent_7_5_1cf,basicstatYearPresent_7_5_1cf,basicstatPresent_7_5_1cf,holidayPresent_7_5_1cf,overtimePresent_7_5_1cf,nightPresent_7_5_1cf,hazard_Present7_5_1cf,onethreePresent_7_5_1cf,deminimisPresent_7_5_1cf,sssPresent_7_5_1cf,salPresent_7_5_1cf,totnontaxpreviousPresent_7_5_1cf,onethreeprevioustaxable_7_5_1cf,sal_other_compprevioustaxable_7_5_1cf,total_taxableprevioustaxable_7_5_1cf,basicsalarypresenttaxable_7_5_1cf,onethreepresenttaxable_7_5_1cf,sal_other_compPresenttaxable_7_5_1cf,total_taxablePresenttaxable_7_5_1cf,total_taxablePreviousPresenttaxable_7_5_1cf,nettaxablecompincomeother_7_5,TaxDueOther_7_5,taxwithheldfrompreviousother_7_5,taxwithheldfrompresentother_7_5,amountwithheldforindecother_7_5,overwithheldtaxrefundedother_7_5,amountoftaxwithheldasadjother_7_5];
                AllDat6.push(dat);
            }
            
            
        }
        $.ajax({
        type: 'POST',
        url: 'extra/attendance/download/excelBIRForm.php',
        data: {AllDat:AllDat,AllDat2:AllDat2,AllDat3:AllDat3,AllDat4:AllDat4,AllDat5:AllDat5,AllDat6:AllDat6,Form:form,_token: '{{csrf_token()}}'},
        success: function(data) {
            $( "#DownloadExcelDiv" ).replaceWith( data );
        } 											 
        })
    }
    else if(form=="1601C"){
        var AllDat= [];
        var tablecount=document.getElementById('tablecount_1601C').value;
        for(var c=tablecount;c>0;c--){
            if(document.getElementById('rname1601C'+c)){
            var name=document.getElementById('rname1601C'+c).value;
            var totalamountofcompensation1601c=document.getElementById('totalamountofcompensation1601c'+c).value;
            var lessnontaxablecompensation1601c=document.getElementById('lessnontaxablecompensation1601c'+c).value;
            var statutoryminimumwage1601c=document.getElementById('statutoryminimumwage1601c'+c).value;
            var holidaypayovertimepaynightshiftdifferentialpayhazardpay1601c=document.getElementById('holidaypayovertimepaynightshiftdifferentialpayhazardpay1601c'+c).value;
            var othernontaxablecompensation1601c=document.getElementById('othernontaxablecompensation1601c'+c).value;
            var taxablecompensation1601c=document.getElementById('taxablecompensation1601c'+c).value;
            var taxrequiredtobewithheld1601c=document.getElementById('taxrequiredtobewithheld1601c'+c).value;
            var addlessadjustment1601c=document.getElementById('addlessadjustment1601c'+c).value;
            var taxrequiredtobewithheldforremittance1601c=document.getElementById('taxrequiredtobewithheldforremittance1601c'+c).value;
            var lesstaxremittedinreturnreviouslifthisisanamendedreturn1601c=document.getElementById('lesstaxremittedinreturnreviouslifthisisanamendedreturn1601c'+c).value;
            var otherpaymentsmade1601c=document.getElementById('otherpaymentsmade1601c'+c).value;
            var totaltaaymentsmade1601c=document.getElementById('totaltaaymentsmade1601c'+c).value;
            var taxstilldueoverremittance1601c=document.getElementById('taxstilldueoverremittance1601c'+c).value;
            var surcharge1601c=document.getElementById('surcharge1601c'+c).value;
            var interest1601c=document.getElementById('interest1601c'+c).value;
            var compromise1601c=document.getElementById('compromise1601c'+c).value;
            var addpenalties1601c=document.getElementById('addpenalties1601c'+c).value;
            var taxamountstilldue1601c=document.getElementById('taxamountstilldue1601c'+c).value;
            var dat = [name,totalamountofcompensation1601c,lessnontaxablecompensation1601c,statutoryminimumwage1601c,holidaypayovertimepaynightshiftdifferentialpayhazardpay1601c,othernontaxablecompensation1601c,taxablecompensation1601c,taxrequiredtobewithheld1601c,addlessadjustment1601c,taxrequiredtobewithheldforremittance1601c,lesstaxremittedinreturnreviouslifthisisanamendedreturn1601c,otherpaymentsmade1601c,totaltaaymentsmade1601c,taxstilldueoverremittance1601c,surcharge1601c,interest1601c,compromise1601c,addpenalties1601c,taxamountstilldue1601c];
            AllDat.push(dat);
            }
            
        }
        //ajax
        $.ajax({
        type: 'POST',
        url: 'extra/attendance/download/excelBIRForm.php',
        data: {AllDat:AllDat,Form:form,_token: '{{csrf_token()}}'},
        success: function(data) {
            $( "#DownloadExcelDiv" ).replaceWith( data );
        } 											 
        })
    }
}
</script>
<div id="DownloadExcelDiv">
</div>
@endsection