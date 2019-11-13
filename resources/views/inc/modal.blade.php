<div class="loading" id="loading_spinner"></div>
<script>
    function dropdown_toggle_inter(e){
        e.click();
        e.click();

    }
    var notifcount=0;
    function load_unseen_notification(){
		console.log('Refreshing Notification...');
		$.ajax({
            url:"fetch_notif",
            method:"POST",
            data:{id:'<?php echo $user_position->id; ?>',_token: '{{csrf_token()}}'},
            dataType:"json",
            success:function(data){
                $('.notif-drop').html(data.notification);
            
                if(data.unseen_notification > 0){
                    $('.notif_count').html(data.unseen_notification);
                    if(notifcount!=data.unseen_notification){
                        //play();
                        notifcount=data.unseen_notification;
                    }
                }
            }
		});
		 
	}
    function clearnotif(){
		$.ajax({
			type: 'POST',
			url: ' clearnotif',                
			data: {id:'<?php echo $user_position->id; ?>',_token: '{{csrf_token()}}'},
		success: function(data) {
			$( "#notifbadge" ).replaceWith('<span class="badge count" id="notifbadge"></span>');
			load_unseen_notification();
			
		} 											 
		})

	}
    function start_spinner(){
        document.getElementById('loading_spinner').style.display="block";
    }
    function stop_spinner(){
        document.getElementById('loading_spinner').style.display="none";
    }
    $(document).ready(function(){
        load_unseen_notification();
        setInterval(function(){
		 
		 load_unseen_notification();
		 
		}, 5000);
        stop_spinner();
    });
    function formatDate (input) {
    var datePart = input.match(/\d+/g),
    year = datePart[0], // get only two digits
    month = datePart[1], day = datePart[2];

    //return day+'/'+month+'/'+year;
    return month+"-"+day+"-"+year;
    }
    function number_format(number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
</script>
<div class="modal fade" id="editbankmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background-color:#124f62;color:white;">
            <h5 class="modal-title" id="editbanktitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white;">&times;</span>
            </button>
        </div>
            <script>
            $(document).ready(function(){
                $("#editbankform").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'update_company_bank_data_edit',                
                        data: $('#editbankform').serialize(),
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Updated Bank',
                            }).then((result) => {
                                location.href="setup_company?page=2";
                            })
                        }
                    })
                });
            });
            </script>
            <form id="editbankform">
                <div class="modal-body">
                
                        <div class="form-group">
                            <label for="editbankname" class="col-form-label">Name</label>
                            <input type="hidden" id="editbankid" name="editbankid">
                            <input type="text" class="form-control" id="editbankname" name="editbankname">
                        </div>
                        <div class="form-group">
                            <label for="editbankcode" class="col-form-label">Code</label>
                            <input type="text" class="form-control"  id="editbankcode" name="editbankcode">
                        </div>
                        <div class="form-group">
                            <label for="editbankaccountnumber" class="col-form-label">Account Number</label>
                            <input type="text" class="form-control" id="editbankaccountnumber" name="editbankaccountnumber">
                        </div>
                        <div class="form-group">
                            <label for="editbankcompanycode" class="col-form-label">Company Code</label>
                            <input type="text" class="form-control" id="editbankcompanycode" name="editbankcompanycode">
                        </div>
                        <div class="form-group">
                            <label for="editbankpresentingoffice" class="col-form-label">Presenting Office</label>
                            <input type="text" class="form-control" id="editbankpresentingoffice" name="editbankpresentingoffice">
                        </div>
                        <div class="form-group">
                            <label for="editbank_remark" class="col-form-label">Remarks</label>
                            <textarea class="form-control" id="editbank_remark" name="editbank_remark"></textarea>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editcostcentermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header" style="background-color:#124f62;color:white;">
            <h5 class="modal-title" id="editcostcentertitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:white;">&times;</span>
            </button>
        </div>
            <script>
            $(document).ready(function(){
                $("#editcostcenter").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'update_company_costcenter_data_edit',                
                        data: $('#editcostcenter').serialize(),
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Updated Cost Center',
                            }).then((result) => {
                                location.href="setup_company?page=3";
                            })
                        }
                    })
                });
            });
            </script>
            <form id="editcostcenter">
                <div class="modal-body">
                
                        <div class="form-group">
                            <label for="editcostcentername" class="col-form-label">Name</label>
                            <input type="hidden" id="editcostcenterid" name="editcostcenterid">
                            <input type="text" class="form-control" id="editcostcentername" name="editcostcentername">
                        </div>
                        <div class="form-group">
                            <label for="editcostcentercode" class="col-form-label">Code</label>
                            <input type="text" class="form-control"  id="editcostcentercode" name="editcostcentercode">
                        </div>
                        <div class="form-group">
                            <label for="editcostcenter_remark" class="col-form-label">Remarks</label>
                            <textarea class="form-control" id="editcostcenter_remark" name="editcostcenter_remark"></textarea>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editdepartmentmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
         <div class="modal-header" style="background-color:#124f62;color:white;">
             <h5 class="modal-title" id="editdepartmenttitle">Modal title</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true" style="color:white;">&times;</span>
             </button>
         </div>
             <script>
             $(document).ready(function(){
                 $("#editdepartment").submit(function(e) {
                     e.preventDefault();
                     $.ajax({
                         type: 'POST',
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         },
                         url: 'update_company_department_data_edit',                
                         data: $('#editdepartment').serialize(),
                         success: function(data) {
                             console.log(data);
                             Swal.fire({
                             type: 'success',
                             title: 'Success',
                             text: 'Successfully Updated Cost Center',
                             }).then((result) => {
                                 location.href="setup_company?page=4";
                             })
                         }
                     })
                 });
             });
             </script>
             <form id="editdepartment">
                 <div class="modal-body">
                 
                         <div class="form-group">
                             <label for="editdepartmentname" class="col-form-label">Name</label>
                             <input type="hidden" id="editdepartmentid" name="editdepartmentid">
                             <input type="text" class="form-control" id="editdepartmentname" name="editdepartmentname">
                         </div>
                         <div class="form-group">
                             <label for="editdepartmentcode" class="col-form-label">Code</label>
                             <input type="text" class="form-control"  id="editdepartmentcode" name="editdepartmentcode">
                         </div>
                         <div class="form-group">
                             <label for="editdepartment_remark" class="col-form-label">Remarks</label>
                             <textarea class="form-control" id="editdepartment_remark" name="editdepartment_remark"></textarea>
                         </div>
                     
                 </div>
                 <div class="modal-footer">
                     <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Save changes</button>
                 </div>
             </form>
         </div>
     </div>
    </div>











<script>
function enable_input_form(form){
    $("#"+form+" :input").prop("disabled", false);
}
</script>

<div class="modal fade" id="company_setup_tax_table_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="tax_tax_table_modal_header"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <script type="text/javascript">
                function checkSpcialChar(event){
                   if(!((event.keyCode >= 65) && (event.keyCode <= 90) || (event.keyCode >= 97) && (event.keyCode <= 122) || (event.keyCode >= 48) && (event.keyCode <= 57) ||(event.keyCode== 32) || (event.keyCode== 95))){
                      event.returnValue = false;
                      return;
                   }
                   
                   event.returnValue = true;
                }
             </script>
            <script>
            $(document).ready(function(){
                $("#tax_tax_table_form").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'update_taxtta_table',                
                        data: $('#tax_tax_table_form').serialize(),
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Updated Tax Table',
                            }).then((result) => {
                                location.href="setup_references?page=4";
                            })
                        }
                    })
                });
            });
            </script>
            <form id="tax_tax_table_form" >
                <div class="modal-body form-inline">
                    <input type="hidden" name="tabletableid" id="tabletableid" value="">
                    <div class="form-group" style="margin-bottom:0px;">
                            <label for="ID" style="color:#124f62;padding-left:0px;padding-right:10px;padding-bottom:5px;font-weight:bold;">1</label>
                            <input type="number" value="" class="form-control" step="0.01" name="tt1" id="tt1">
                    </div>
                    <div class="form-group" style="margin-bottom:0px;">
                            <label for="ID" style="color:#124f62;padding-left:10px;padding-right:10px;padding-bottom:5px;font-weight:bold;">2</label>
                            <input type="number" value="" class="form-control" step="0.01" name="tt2" id="tt2">
                    </div>
                    <div class="form-group" style="margin-bottom:0px;">
                            <label for="ID" style="color:#124f62;padding-left:0px;padding-right:10px;padding-bottom:5px;font-weight:bold;">3</label>
                            <input type="number" value="" class="form-control" step="0.01" name="tt3" id="tt3">
                    </div>
                    <div class="form-group" style="margin-bottom:0px;">
                            <label for="ID" style="color:#124f62;padding-left:10px;padding-right:10px;padding-bottom:5px;font-weight:bold;">4</label>
                            <input type="number" value="" class="form-control" step="0.01" name="tt4" id="tt4">
                    </div>
                    <div class="form-group" style="margin-bottom:0px;">
                            <label for="ID" style="color:#124f62;padding-left:0px;padding-right:10px;padding-bottom:5px;font-weight:bold;">5</label>
                            <input type="number" value="" class="form-control" step="0.01" name="tt5" id="tt5">
                    </div>
                    <div class="form-group" style="margin-bottom:0px;">
                            <label for="ID" style="color:#124f62;padding-left:10px;padding-right:10px;padding-bottom:5px;font-weight:bold;">6</label>
                            <input type="number" value="" class="form-control" step="0.01" name="tt6" id="tt6">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="company_setup_tax_table_deduction_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="tax_tax_table_deduction_modal_header"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <script>
            $(document).ready(function(){
                $("#tax_tax_table_deduction_form").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'update_tax_table_deduction_data',                
                        data: $('#tax_tax_table_deduction_form').serialize(),
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Updated Tax Table Deduction',
                            }).then((result) => {
                                location.href="setup_references?page=4";
                            })
                        }
                    })
                });
            });
            </script>
            <form id="tax_tax_table_deduction_form" >
                <div class="modal-body form-inline">
                        <input type="hidden" name="deducid" id="deducid" value="">
                        <div class="form-group" style="margin-bottom:0px;">
                                <label for="ID" style="color:#124f62;padding-left:0px;padding-bottom:5px;padding-right:10px;font-weight:bold;">1</label>
                                <input type="number" value="" class="form-control" step="0.01"  name="one1" id="one1">
                                <label for="ID" style="color:#124f62;padding-bottom:5px;padding-right:10px;padding-left:10px;"> <b>-</b> </label>
                                <input type="text" value="" class="form-control" name="one2" id="one2" >
                        </div>
                        <div class="form-group" style="margin-bottom:0px;">
                                <label for="ID" style="color:#124f62;padding-left:0px;padding-right:10px;padding-bottom:5px;font-weight:bold;">2</label>
                                <input type="number" value="" class="form-control" step="0.01"  name="two1" id="two1">
                                <label for="ID" style="color:#124f62;padding-bottom:5px;padding-right:10px;padding-left:10px;"> <b>-</b> </label>
                                <input type="text" value="" class="form-control" name="two2" id="two2" >
                        </div>
                        <div class="form-group" style="margin-bottom:0px;">
                                <label for="ID" style="color:#124f62;padding-left:0px;padding-right:10px;padding-bottom:5px;font-weight:bold;">3</label>
                                <input type="number" value="" class="form-control" step="0.01" name="three1" id="three1">
                                <label for="ID" style="color:#124f62;padding-bottom:5px;padding-right:10px;padding-left:10px;"> <b>-</b> </label>
                                <input type="text" value="" class="form-control" name="three2" id="three2">
                        </div>
                        <div class="form-group" style="margin-bottom:0px;">
                                <label for="ID" style="color:#124f62;padding-left:0px;padding-right:10px;padding-bottom:5px;font-weight:bold;">4</label>
                                <input type="number" value="" class="form-control" step="0.01" name="four1" id="four1">
                                <label for="ID" style="color:#124f62;padding-bottom:5px;padding-right:10px;padding-left:10px;"> <b>-</b> </label>
                                <input type="text" value="" class="form-control" name="four2" id="four2">
                        </div>
                        <div class="form-group" style="margin-bottom:0px;">
                                <label for="ID" style="color:#124f62;padding-left:0px;padding-right:10px;padding-bottom:5px;font-weight:bold;">5</label>
                                <input type="number" value="" class="form-control" step="0.01" name="five1" id="five1">
                                <label for="ID" style="color:#124f62;padding-bottom:5px;padding-right:10px;padding-left:10px;"> <b>-</b> </label>
                                <input type="text" value="" class="form-control" name="five2" id="five2">
                        </div>
                        <div class="form-group" style="margin-bottom:0px;">
                                <label for="ID" style="color:#124f62;padding-left:0px;padding-right:10px;padding-bottom:5px;font-weight:bold;">6</label>
                                <input type="number" value="" class="form-control" step="0.01" name="six1" id="six1">
                                <label for="ID" style="color:#124f62;padding-bottom:5px;padding-right:10px;padding-left:10px;"> <b>-</b> </label>
                                <input type="text" value="" class="form-control" name="six2" id="six2">
                        </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="adjustment_template_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="adjustmet_tempalte_header"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <script>
            $(document).ready(function(){
                $("#adjustment_template_edit_form").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'update_adjustment_template_data',                
                        data: $('#adjustment_template_edit_form').serialize(),
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Updated Adjustment Template',
                            }).then((result) => {
                                location.href="setup_references?page=2";
                            })
                        }
                    })
                });
            });
            </script>
            <form id="adjustment_template_edit_form" >
                <div class="modal-body ">
                    <div class="row">
					    <div class="col-md-6">
							<input type="hidden" value="" name="templateid" id="templateid">
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Type:</label>
									<select class="form-control" name="AdjType2" id="AdjType2">
										
										<option>Allowance</option>
										<option>Bonus</option>
										<option>Commission</option>
										<option>Miscellaneous</option>
										<option>Reimbursable Allowance</option>
										<option>Salary Adjustment</option>
										<option>Loan</option>
										<option>SSS Loan</option>
										<option>HDMF Loan</option>
										<option>External Loan</option>
										<option>13th Month NonTaxable</option>
										<option>Monetized Leave</option>
										<option>HDMF Calamity Loan</option>
										<option>SSS Calamity Loan</option>
										<option>Basic Adjustment</option>
										<option>Overtime Adjustment</option>
										<option>Deminimis Adjustment</option>
										<option>Without Tax</option>
										<option>SSSEE</option>
										<option>SSSEC</option>
										</select>
							</div>
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Name</label>
									<input type="text" class="form-control" name="AdjName2" id="AdjName2" value="" required>
							</div>
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Code</label>
									<input type="text" class="form-control" name="AdjCode2" id="AdjCode2" value="" required>
							</div>
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Amount</label>
									<input type="number" class="form-control" name="Amount2" id="Amount2" value="" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Applied Before</label>
									<select class="form-control" name="ApplyBefore2" id="ApplyBefore2">
										
										<option value="1">YES</option>
										<option value="0">NO</option>
									</select>
							</div>
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Taxable</label>
									<select class="form-control" name="Taxable2" id="Taxable2">
										
										<option value="1">YES</option>
										<option value="0">NO</option>
									</select>
							</div>
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Max Amount</label>
									<input type="number" class="form-control" name="MaxAmount2" id="MaxAmount2" value="">
							</div>
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Divided per Period</label>
									<select class="form-control" name="Divided2" id="Divided2">
										
										<option value="1">YES</option>
										<option value="0">NO</option>
									</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Remarks</label>
									<textarea class="form-control" name="AdjtempRemarks2" id="AdjtempRemarks2" rows="5"></textarea>
							</div>
						</div>
					</div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="SelectADJModal" class="modal fade" role="dialog" style="display: none;">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Adjustment Template</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <select class="form-control" id="CompanyAdjTypeOption">
            @foreach ($adjustment_template as $item)
            <option value="{{$item->template_id}}">{{$item->template_name}}</option>
            @endforeach
        </select>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="PlaceDataCompanyTemplate()">Proceed</button>
        </div>
        </div>
        <script>
        function PlaceDataCompanyTemplate(){
            var e=document.getElementById('CompanyAdjTypeOption').value;
            
            $.ajax({
            type: 'POST',
            url: 'get_adjustment_template_data',                
            data: {id:e,_token: '{{csrf_token()}}'},
            success: function(data) {
                
                document.getElementById('AdjTypecom').value=data['template_type'];
                document.getElementById('AdjNamecom').value=data['template_name'];
                document.getElementById('AdjCodecom').value=data['template_code'];
                document.getElementById('Amountcom').value=data['template_amount'];
                document.getElementById('ApplyBeforecom').value=data['applied_before'];
                document.getElementById('Taxablecom').value=data['taxable'];
                document.getElementById('MaxAmountcom').value=data['template_max_amount'];
                document.getElementById('Dividedcom').value=data['divided_by_period'];
                document.getElementById('AdjtempRemarkscom').value=data['template_remarks'];
                
                $('#SelectADJModal').modal('hide');
            }  
            });
        }
        </script>
    </div>
</div>


<div class="modal fade" id="company_adjustment_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="adjustmet_tempalte_headercom"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <script>
            $(document).ready(function(){
                $("#company_adjustment_edit_form").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'update_company_adjustment_data',                
                        data: $('#company_adjustment_edit_form').serialize(),
                        success: function(data) {
                            
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Updated Company Adjustment',
                            }).then((result) => {
                                location.href="setup_references?page=3";
                            })
                        }
                    })
                });
            });
            </script>
            <form id="company_adjustment_edit_form" >
                <div class="modal-body ">
                    <div class="row">
					    <div class="col-md-6">
							<input type="hidden" value="" name="templateidcom" id="templateidcom">
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Type:</label>
									<select class="form-control" name="AdjType2com" id="AdjType2com">
										
										<option>Allowance</option>
										<option>Bonus</option>
										<option>Commission</option>
										<option>Miscellaneous</option>
										<option>Reimbursable Allowance</option>
										<option>Salary Adjustment</option>
										<option>Loan</option>
										<option>SSS Loan</option>
										<option>HDMF Loan</option>
										<option>External Loan</option>
										<option>13th Month NonTaxable</option>
										<option>Monetized Leave</option>
										<option>HDMF Calamity Loan</option>
										<option>SSS Calamity Loan</option>
										<option>Basic Adjustment</option>
										<option>Overtime Adjustment</option>
										<option>Deminimis Adjustment</option>
										<option>Without Tax</option>
										<option>SSSEE</option>
										<option>SSSEC</option>
										</select>
							</div>
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Name</label>
									<input type="text" class="form-control" name="AdjName2com" id="AdjName2com" value="" required>
							</div>
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Code</label>
									<input type="text" class="form-control" name="AdjCode2com" id="AdjCode2com" value="" required>
							</div>
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Amount</label>
									<input type="number" class="form-control" name="Amount2com" id="Amount2com" value="" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Applied Before</label>
									<select class="form-control" name="ApplyBefore2com" id="ApplyBefore2com">
										
										<option value="1">YES</option>
										<option value="0">NO</option>
									</select>
							</div>
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Taxable</label>
									<select class="form-control" name="Taxable2com" id="Taxable2com">
										
										<option value="1">YES</option>
										<option value="0">NO</option>
									</select>
							</div>
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Max Amount</label>
									<input type="number" class="form-control" name="MaxAmount2com" id="MaxAmount2com" value="">
							</div>
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Divided per Period</label>
									<select class="form-control" name="Divided2com" id="Divided2com">
										
										<option value="1">YES</option>
										<option value="0">NO</option>
									</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group" style="margin-bottom:0px;">
									<label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Remarks</label>
									<textarea class="form-control" name="AdjtempRemarks2com" id="AdjtempRemarks2com" rows="5"></textarea>
							</div>
						</div>
					</div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ot_rate_table_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="ot_rate_table_edit_header"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <script>
            $(document).ready(function(){
                $("#ot_rate_table_edit_form").submit(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'update_ot_rate_table_data',                
                        data: $('#ot_rate_table_edit_form').serialize(),
                        success: function(data) {
                            
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Updated Company Adjustment',
                            }).then((result) => {
                                location.href="setup_references?page=1";
                            })
                        }
                    })
                });
            });
            </script>
            <form id="ot_rate_table_edit_form" >
                <div class="modal-body ">
                    <input type="hidden" name="ot_type" id="ot_type" value="">
                    <input type="hidden" name="SelTale" id="SelTale" value="">
                    <div class="form-group" id="s1div">
                    <label for="ID" style="color:#083240;padding-left:0px;padding-top:5px;margin-bottom:0px;"></label>
                    <input type="text" class="form-control" id="s1" name="S1" value="0" step=".01">
                    </div>
                    <div class="form-group" id="s2div">
                    <label for="ID" style="color:#083240;padding-left:0px;padding-top:5px;margin-bottom:0px;">OT</label>
                    <input type="number" class="form-control" id="s2" name="S2" value="1.25" step=".01">
                    </div>
                    <div class="form-group" id="s3div">
                    <label for="ID" style="color:#083240;padding-left:0px;padding-top:5px;margin-bottom:0px;">ND</label>
                    <input type="number" class="form-control" id="s3" name="S3" value="0.10" step=".01">
                    </div>
                    <div class="form-group" id="s4div">
                    <label for="ID" style="color:#083240;padding-left:0px;padding-top:5px;margin-bottom:0px;">ND-OT</label>
                    <input type="number" class="form-control" id="s4" name="S4" value="0" step=".01">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


  
  <!-- Modal -->
<div class="modal fade" id="importEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Import Employee Data from Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align:center;">
        <style>
        #excel-upload-employee{
            display: none;
        }
        </style>
        <input id="excel-upload-employee" onchange="UploadMassEmployee()" type="file"  accept=".xlsx" >
        <label for="excel-upload-employee" style="opacity:1;cursor:pointer;border-radius:10px;" id="FIleImportExcelLabel" class="custom-excel-upload btn btn-primary">
        <span class="glyphicon glyphicon-user"></span> IMPORT FROM EXCEL</span>
        </label>
        <script>
        function UploadMassEmployee(){
            start_spinner();
            var file = $('#excel-upload-employee')[0].files[0]
            var fd = new FormData();
            fd.append('theFile', file);
            fd.append('_token','{{csrf_token()}}');
            $.ajax({
                url: 'UploadMassEmployee',
                type: 'POST',
                processData: false,
                contentType: false,
                data: fd,
                dataType:"json",
                success: function (data, status, jqxhr) {
                    var LOG="";
                    if(data.Error_Log!=""){
                    LOG=" \n\nSkip Log : \n"+data.Error_Log;
                    }
                    alert("Total number Of Data : "+data.Total+"\nData Saved : "+data.Success+" \nData Skipped : "+data.Skiped+LOG);
                    document.getElementById("excel-upload-employee").value = "";
                    console.log("asdada : "+data.Extra);
                    stop_spinner();
                    Swal.fire({
                    type: 'success',
                    title: 'Success',
                    text: 'Successfully Added Employee Data',
                    }).then((result) => {
                        location.href="employee_list";
                    })
                    
                },
                error: function (jqxhr, status, msg) {
                    alert(jqxhr.status +" message"+msg+" status:"+status);
                    alert(jqxhr.responseText);
                    stop_spinner();
                }
            });
            document.getElementById("excel-upload-employee").value = "";
        }
        </script>
      </div>
      <div class="modal-footer">
        <a class="btn btn-success" href="{{asset('extra/import_file/Employee_import.xlsx')}}" download>Download Import Template</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="EmployeeMemoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <script>
        $(document).ready(function(){
            $("#employee_memo_form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'add_emp_memo',                
                    data: $('#employee_memo_form').serialize(),
                    success: function(data) {
                        
                        Swal.fire({
                        type: 'success',
                        title: 'Success',
                        text: 'Successfully Added Employee Memo',
                        }).then((result) => {
                            location.href="memo";
                        })
                    }
                })
            });
        });
        </script>
        <form id="employee_memo_form">
        <div class="modal-header">
          <h5 class="modal-title"><input type="text"  required name="TitleMemo" class="form-control" placeholder="Memo Title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-md-8">
            
            </div>
            
            </div>
            
            <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                <input type="text" class="form-control" name="EmployeeMemo" placeholder="Employee Name" required="">
                </div>
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <input type="date" class="form-control" name="DateReievedMemo" required="">
                </div>
            </div>
            
            </div>
            
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <select class="form-control" name="OffenseLevelMemo" id="OffenseLevel" required>
                    <option value="">--Select Offense Level--</option>
                    <option>First Offense</option>
                    <option>Second Offense</option>
                    <option>Third Offense</option>
                </select>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                <select class="form-control" name="DATypeMemo" id="DAType" required>
                    <option value="">--Select DA Type--</option>
                    <option>Verbal Reprimand</option>
                    <option>Written Warning</option>
                    <option>Final Written Warning</option>
                    <option>Suspension</option>
                    <option>Termination</option>
                </select>
                </div>
            </div>
            
            </div>
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                <input type="text" class="form-control" name="ViolationMemo" placeholder="Violation Category" required="">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                <input type="text" class="form-control" name="SlideDateMemo" placeholder="Slide Date" required="">
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-11">
                <div class="form-group">
                <textarea class="form-control" name="NoteMemo" rows="3" placeholder="Note"></textarea>
                </div>
            </div>
            
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Create Memo</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="ViewEmployeeMemoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 class="modal-title" id="memo_title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
			<table class="table">
            <tbody>
                <tr>
                    <td width="30%;" style="border-color:white;"></td>
                    <td style="border-color:white;"></td>
                    <td style="border-color:white;"></td>
                    <td style="text-align:right;border-color:white;" id="memo_title_view">
                    Date Recieved :
                    2019-09-23
                    </td>
                </tr>
                <tr>
                    <td>
                    Employee Name :
                    </td>
                    <td colspan="3" id="memo_emp_name_view">
                    123123123
                    </td>
                    
                </tr>
                <tr>
                    <td>
                    Offense Level :
                    </td>
                    <td colspan="3" id="memo_offense_level_view">
                    Third Offense
                    </td>
                </tr>
                <tr>
                    <td>
                    DA Type :
                    </td>
                    <td colspan="3" id="memo_da_type_view">
                    Suspension
                    </td>
                </tr>
                <tr>
                    <td>
                    Violation Category :
                    </td>
                    <td colspan="3" id="memo_violation_category_view">
                    12312
                    </td>
                </tr>
                <tr>
                    <td>
                    Slide Date :
                    </td>
                    <td colspan="3" id="memo_slide_date_view">					
                    3123
                    </td>
                </tr>
                <tr>
                    <td>
                    Note :
                    </td>
                    <td colspan="3" id="memo_note_view">
                    123123123
                    </td>
                </tr>
            </tbody>
            </table>
                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>


<script>
$(document).ready(function(){
    $("#textareaRichEditor").jqte();
    var classname = document.getElementsByClassName("jqte_editor");
    classname[0].addEventListener('keyup', update, false);
    var employeebtn = $('<div class="jqte_tool jqte_tool_22 unselectable" role="button" data-tool="21" unselectable="on" style="user-select: none;"><a title="Insert Employee Tag" class="btn btn-default btn-sm unselectable" unselectable="on" ><img src="images/employee.png" style="height:16px;"></a></div>');
    $('.jqte_toolbar').append(employeebtn);

    employeebtn.on('click', function(){
    insertAtCaret('jqte_editor', '{EMPLOYEE}');
    });
    var companybtn = $('<div class="jqte_tool jqte_tool_23 unselectable" role="button" data-tool="22" unselectable="on" style="user-select: none;"><a title="Insert Company Tag" class="btn btn-default btn-sm unselectable" unselectable="on" ><img src="images/company.png" style="height:16px;"></a></div>');
    $('.jqte_toolbar').append(companybtn);

    companybtn.on('click', function(){
    insertAtCaret('jqte_editor', '{COMPANY}');
    });
    var departmentbtn = $('<div class="jqte_tool jqte_tool_24 unselectable" role="button" data-tool="23" unselectable="on" style="user-select: none;"><a title="Insert Department Tag" class="btn btn-default btn-sm unselectable" unselectable="on" ><img src="images/department.png" style="height:16px;"></a></div>');
    $('.jqte_toolbar').append(departmentbtn);

    departmentbtn.on('click', function(){
    insertAtCaret('jqte_editor', '{DEPARTMENT}');
    });
    var reasonbtn = $('<div class="jqte_tool jqte_tool_25unselectable" role="button" data-tool="24" unselectable="on" style="user-select: none;"><a title="Insert Reason Tag" class="btn btn-default btn-sm unselectable" unselectable="on" ><img src="images/reason.png" style="height:16px;"></a></div>');
    $('.jqte_toolbar').append(reasonbtn);

    reasonbtn.on('click', function(){
    insertAtCaret('jqte_editor', '{REASON}');
    });
})
function insertAtCaret(areaId, text) {
  var txtarea = document.getElementsByClassName(areaId);

  txtarea[0].innerHTML = txtarea[0].innerHTML + text ;
 
}
function getCaretPosition(editableDiv) {
  var caretPos = 0,
	sel, range;
  if (window.getSelection) {
	sel = window.getSelection();
	
	if (sel.rangeCount) {
	  range = sel.getRangeAt(0);
	  if (range.commonAncestorContainer.parentNode == editableDiv) {
		caretPos = range.endOffset;
	  }
	  
	}
	//alert(sel.rangeCount);
  } else if (document.selection && document.selection.createRange) {
	range = document.selection.createRange();
	if (range.parentElement() == editableDiv) {
	  var tempEl = document.createElement("span");
	  editableDiv.insertBefore(tempEl, editableDiv.firstChild);
	  var tempRange = range.duplicate();
	  tempRange.moveToElementText(tempEl);
	  tempRange.setEndPoint("EndToEnd", range);
	  caretPos = tempRange.text.length;
	}
  }
  return caretPos;
}
var update = function() {
//$('#caretposition').html(getCaretPosition(this));
//alert('asdasd');
};
</script>
<script>
    function checkTempalteName(){
        var TemplateName=document.getElementById('TemplateNNN').value;
        if(TemplateName!=""){
            $.ajax({
            type: 'POST',
            url: 'check_form_template_name',                
            data: {TemplateName:TemplateName,_token: '{{csrf_token()}}'},
            success: function(data) {
                if(data>0){
                    document.getElementById('TemplateNNN').style.borderColor="red";
                    document.getElementById('SaveTempateID').disabled=true;
                }else{
                    document.getElementById('TemplateNNN').style.borderColor="green";
                    document.getElementById('SaveTempateID').disabled=false;
                }
            } 											 
            })
            
        }else{
            document.getElementById('TemplateNNN').style.borderColor="#333";
            document.getElementById('SaveTempateID').disabled=false;
            
        }
        
    }
    $(document).ready(function(){
        
        $("#form_template_form").submit(function(e) {
        e.preventDefault();
            $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'add_form_template',                
            data: $('#form_template_form').serialize(),
            success: function(data) {
                console.log(data);
                Swal.fire({
                type: 'success',
                title: 'Success',
                text: 'Successfully Added Form Template',
                
                }).then((result) => {
                    location.href="form_generator";
                })

            }  

            }) 
        });
    })
</script>
<div class="modal fade" id="FormTemplateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <form id="form_template_form">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle"><input type="text" required id="TemplateNNN" name="TemplateFormName" placeholder="Form Template Name" class="form-control"  onkeyup="checkTempalteName()"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <textarea name="Templatetextarea" id="textareaRichEditor" class="jqte-test" required></textarea>
      </div>
      <div class="modal-footer">
        
        <button type="submit" class="btn btn-primary" id="SaveTempateID">Save changes</button>
      </div>
        </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    
    $("#cash_advance_form").submit(function(e) {
    e.preventDefault();
        $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'add_cash_advance',                
        data: $('#cash_advance_form').serialize(),
        success: function(data) {
            console.log(data);
            Swal.fire({
            type: 'success',
            title: 'Success',
            text: 'Successfully Added Cash Advance',
            
            }).then((result) => {
                location.href="cash_advance";
            })
        }  
        }) 
    });
})
</script>
<div id="CashAdvanceModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <form id="cash_advance_form">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Cash Advance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">
        <div class="row">
            
            
            <div class="col-md-4">
                <script>
                function showlender(){
                    var loan_type=document.getElementById('loan_type').value;
                    var converted=loan_type.toLowerCase()
                    .split(' ')
                    .map((s) => s.charAt(0).toUpperCase() + s.substring(1))
                    .join(' ');
                    console.log(converted);
                    document.getElementById('lenderarea').style.display="none";
                    document.getElementById('lender').required=false;
                    if(loan_type=="Colleague"){
                        document.getElementById('lenderarea').style.display="block";
                        document.getElementById('lender').required=true;
                    }else{
                        document.getElementById('lenderarea').style.display="none";
                        document.getElementById('lender').required=false;
                        
                    }
                }
                </script>
                <div class="form-group">
                  <span for="loan_type">Loan Type:</span>
                  <input type="text" list="loantypes" class="form-control" name="Loan_tpye" id="loan_type" onkeyup="showlender()" required>
                  <datalist id="loantypes" >
                    @foreach ($loan_type as $item)
                        <option>{{$item->laon_type}}</option>
                    @endforeach
                  </datalist>
                  
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                  <span for="employee">Employee:</span>
                  <select class="form-control" id="employee" name="employee_lending" required>
                    <option value="">--Select Employee--</option>
                    @foreach ($employee_list as $item)
                        <option value="{{$item->employee_id}}">{{$item->fname." ".$item->lname}}</option>
                    @endforeach
                  </select>
                  
                </div>
                <div class="form-group" style="display:none;" id="lenderarea">
                  <span for="lender">Lender:</span>
                  <select class="form-control" id="lender" name="employee_lender">
                    <option value="">--Select Lender--</option>
                    @foreach ($employee_list as $item)
                        <option value="{{$item->employee_id}}">{{$item->fname." ".$item->lname}}</option>
                    @endforeach
                  </select>
                  
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                  <span for="loan_type">Date of Request:</span>
                  <input type="date" class="form-control" name="request_date" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <span for="loan_type">Start of Deduction:</span>
                  <input type="date" class="form-control" name="start_deduc" id="deducstart" oninput="setPayPeriod()" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                  <span for="loan_type">End of Deduction:</span>
                  <input type="date" class="form-control" name="end_deduc" id="deducend" oninput="setPayPeriod()" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                  <span for="loan_type">Total Amount:</span>
                  <input type="number" required min="0" id="totalamount" name="amount_lend" step="0.01" value="0" class="form-control" oninput="setamountperperiod()">
                </div>
            </div>
            <div class="col-md-4">
                <script>
                function dateRange(startDate, endDate) {
                  var start      = startDate.split('-');
                  var end        = endDate.split('-');
                  var startYear  = parseInt(start[0]);
                  var endYear    = parseInt(end[0]);
                  var dates      = [];
                  var monthcount=0;;
                  for(var i = startYear; i <= endYear; i++) {
                    var endMonth = i != endYear ? 11 : parseInt(end[1]) - 1;
                    var startMon = i === startYear ? parseInt(start[1])-1 : 0;
                    for(var j = startMon; j <= endMonth; j = j > 12 ? j % 12 || 11 : j+1) {
                      var month = j+1;
                      var displayMonth = month < 10 ? '0'+month : month;
                      dates.push([i, displayMonth, '01'].join('-'));
                      monthcount++;
                    }
                  }
                  return monthcount;
                }
                    function setPayPeriod(){
                        
                        var deducstart=document.getElementById('deducstart').value;
                        document.getElementById('deducend').min=deducstart;
                        var deducend=document.getElementById('deducend').value;
                        if(deducstart!="" && deducend!=""){
                            document.getElementById('payperiod').value=dateRange(deducstart, deducend);
                            setamountperperiod();
                        }
                    }
                </script>
                <div class="form-group">
                  <span for="loan_type">Pay Period:</span>
                  <input type="number" min="1" required name="pay_period" id="payperiod" value="1" class="form-control" oninput="setamountperperiod()">
                </div>
            </div>
            <div class="col-md-4">
                <script>
                function setamountperperiod(){
                    var totalamount=document.getElementById('totalamount').value;
                    var payperiod=document.getElementById('payperiod').value;
                    var result=parseFloat(totalamount)/payperiod;
                    document.getElementById('payperperiod').value=result;
                    
                }
                </script>
                <div class="form-group">
                  <span for="loan_type">Pay Amount/Period:</span>
                  <input type="number" value="0" name="pay_amount_per_pperios" class="form-control" id="payperperiod" readonly>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" onclick="document.getElementById('lenderarea').style.display='none';">Reset</button>
        <input type="submit" for="cash_advance_fomr" class="btn btn-primary" name="Cash_Advance_Submit" value="Proceed">
      </div>
      
    </div>
    </form>
  </div>
</div>


<script>
$(document).ready(function(){
    
    $("#add_payment_to_cash_advance_form").submit(function(e) {
    e.preventDefault();
        $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'add_payment_to_cash_advance',                
        data: $('#add_payment_to_cash_advance_form').serialize(),
        success: function(data) {
            console.log(data);
            Swal.fire({
            type: 'success',
            title: 'Success',
            text: 'Successfully Added Payment',
            
            }).then((result) => {
                location.href="cash_advance";
            })
        }  
        }) 
    });
})
</script>
<div id="AddPaymentModal" class="modal fade in" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Payment</h5>  
        <button type="button" class="close" data-dismiss="modal">×</button>
        
      </div>
      <form id="add_payment_to_cash_advance_form">
      <input type="hidden" name="hidden_cash_advance_id" id="hidden_cash_advance_id" value="1">
      <input type="hidden" name="hidden_balance" id="hidden_balance" value="">
      <input type="hidden" name="hidden_emp_id" id="hidden_emp_id" value="">
      <input type="hidden" name="hidden_lender_id" id="hidden_lender_id" value="">
      <input type="hidden" name="hidden_cash_advance_type" id="hidden_cash_advance_type" value="">
      <div class="modal-body">
        <h3>Overview</h3>
        <table class="table" style="width:50%">
        <tbody>
            <tr>
                <td style="vertical-align:middle;font-weight:bold;">Employee Name</td>
                <td style="vertical-align:middle;" >
                    <select type="text" name="cashadvance_emp_name" style="background-color: white !important;padding-left:0px;--moz-apperance: none; -webkit-appearance: none;" id="cashadvance_emp_name" class="form-control" disabled>
                        @foreach ($employee_list as $item)
                            <option value="{{$item->employee_id}}">{{$item->fname." ".$item->lname}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td style="vertical-align:middle;font-weight:bold;">Loan Type</td>
                <td style="vertical-align:middle;" id="cash_advance_loan_type">Colleague</td>
            </tr>
            
            <tr>
                <td style="vertical-align:middle;font-weight:bold;">Date of Request</td>
                <td style="vertical-align:middle;" id="cash_advance_date_of_request">09-18-2019</td>
            </tr>
            <tr>
                <td style="vertical-align:middle;font-weight:bold;">Payroll</td>
                <td style="vertical-align:middle;">
                <select class="form-control" name="PayrollPeriod" id="PayrollPeriod">
                        @foreach ($unprocessed_payroll_list as $item)
                            <option value="{{$item->payroll_id}}">{{"Period : ".$item->period.", ".$item->payroll_year." ".$item->payroll_month." - ".$item->payroll_type." -- ".$item->employee_type}}</option>
                        @endforeach                          
                </select>
                </td>
            </tr>
        </tbody>
        </table>
        <h3>Payment</h3>
        <table class="table">
        <tbody>
        <tr>
            <td style="vertical-align:middle;font-weight:bold;">Total Amount</td>
            <td style="vertical-align:middle;" id="cashadvance_total_amount">20,000.00</td>
            <td style="vertical-align:middle;font-weight:bold;">Balance</td>
            <td style="vertical-align:middle;" id="cashadvance_balance">20,000.00</td>
        </tr>
        <tr>
            <td style="vertical-align:middle;font-weight:bold;">Start of Deduction</td>
            <td style="vertical-align:middle;" id="cash_advance_startdeduction">09-18-2019</td>
            <td style="vertical-align:middle;font-weight:bold;">End of Deduction</td>
            <td style="vertical-align:middle;" id="cash_advance_enddeduction">09-30-2019</td>
        </tr>
        <tr>
            <td style="vertical-align:middle;font-weight:bold;">Add Payment</td>
            <td style="vertical-align:middle;"><input type="number" id="PaymentAmount" name="PaymentAmount" class="form-control" min="1" value="1"></td>
            <td style="vertical-align:middle;font-weight:bold;">Total Amount Paid	</td>
            <td style="vertical-align:middle;" id="cashadvance_total_amount_paid">0.00</td>
        </tr>
        </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default">Reset</button>
        <button type="submit" class="btn btn-primary" name="AddPaymentSubmit">Apply</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div id="AdjustmentModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="ModalHeaderEmployeeName" style="color:#124f62;">Employee Name</h5>
        <button type="button" class="close" data-dismiss="modal">×</button>
        
      </div>
      <script>
        $(document).ready(function(){
            
            $("#employee_salary_adjustment_form").submit(function(e) {
            e.preventDefault();
                $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'add_employee_salary_adjustment',                
                data: $('#employee_salary_adjustment_form').serialize(),
                success: function(data) {
                    console.log(data);
                    Swal.fire({
                    type: 'success',
                    title: 'Success',
                    text: 'Successfully Added Employee Salary Adjustment',
                    
                    }).then((result) => {
                        location.href="employee?page=1";
                    })
                }  
                }) 
            });
        })
        </script>
      <form id="employee_salary_adjustment_form">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
            <button type="button" class="btn btn-link" style="float:right;" onclick="CompanyAdjustmentTemplateDiv()">Select Company Adjustment</button>
            <script>
                var hid=0; 
                function CompanyAdjustmentTemplateDiv(){
                    if(hid==0){
                        document.getElementById('CompanyAdjustmentTemplateDiv').style.display="block";
                        hid=1;
                    }else{
                        document.getElementById('CompanyAdjustmentTemplateDiv').style.display="none";
                        hid=0;
                    }
                }
                function setCompanyAdjustment(){
                    var value=document.getElementById('CompanyAdjustmentSelect').value;
                    if(value!=""){
                        $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'get_employee_adjustment',                
                            data:{id:value,_token: '{{csrf_token()}}'},
                            success: function(data) {
                                document.getElementById('adjname').value=data['company_adjustment_name'];
                                document.getElementById('adjcode').value=data['company_adjustment_code'];
                                document.getElementById('adjamount').value=data['company_adjustment_amount'];
                                document.getElementById('adjtype').value=data['company_adjustment_type'];
                                document.getElementById('adjempappliedbefore').value=data['company_adjustment_applied_before'];
                                document.getElementById('adjtaxable').value=data['company_adjustment_taxable'];
                                document.getElementById('adjremark').value=data['company_adjustment_remarks'];       
                            }
                        })
                    }
                }
            </script>
            </div>
            <div class="col-md-12" id="CompanyAdjustmentTemplateDiv" style="display:none;">
            <select class="form-control" id="CompanyAdjustmentSelect" onchange="setCompanyAdjustment()" style="float:right;width:30%;">
            <option value="">--Select Company Adjustment Template--</option>
            @foreach ($company_adjustment as $item)
            <option value="{{$item->company_adjustment_id}}">{{$item->company_adjustment_name}}</option>
            @endforeach
            </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                
                <div class="form-group" style="margin-bottom:0px;">
                        <label for="ID" style="color:#124f62;padding-left:0px;padding-bottom:5px;padding-top:0px;">Name</label>
                        <input type="hidden" id="EmpHiddenSalaryID" name="EmpAdjSalaryID">
                        <input type="text" class="form-control" id="adjname" name="EmpAdjName">
                </div>
                <div class="form-group" style="margin-bottom:0px;">
                        <label for="ID" style="color:#124f62;padding-left:0px;padding-bottom:5px;">Code</label>
                        <input type="text" class="form-control" id="adjcode" name="EmpAdjCode">
                </div>
                <div class="form-group" style="margin-bottom:0px;">
                        <label for="ID" style="color:#124f62;padding-left:0px;padding-bottom:5px;">Amount</label>
                        <input type="number" class="form-control" id="adjamount" name="EmpAdjAmount">
                </div>
                <div class="form-group" style="margin-bottom:0px;display:none;">
                    <label for="ID" style="color:#124f62;padding-left:0px;padding-top:0px;padding-bottom:5px;">Employee ID </label>
                <input type="text" class="form-control" id="SearchInputAdjustment" name="EmpAdjEmpID" readonly="">
                
                </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                        <label for="ID" style="color:#124f62;padding-left:0px;padding-top:0px;padding-bottom:5px;">Type</label>
                        <select class="form-control" id="adjtype" name="EmpAdjAdjType">
                            <option>Allowance</option>
                            <option>Bonus</option>
                            <option>Commission</option>
                            <option>Misceleneous</option>
                            <option>Reimbursable Allowance</option>
                            <option>Salary Adjustment</option>
                            <option>Loan</option>
                            <option>SSS Loan</option>
                            <option>HDMF Loan</option>
                            <option>External Loan</option>
                            <option>13th Month NonTaxable</option>
                            <option>Monetized Leave</option>
                            <option>HDMF Calamity Loan</option>
                            <option>SSS Calamity Loan</option>
                            <option>Basic Adjustment</option>
                            <option>Overtime Adjustment</option>
                            <option>Deminimis Adjustment</option>
                            <option>Without Tax</option>
                            <option>SSSEE</option>
                            <option>SSSEC</option>
                            </select>
                </div>
                <div class="form-group" style="margin-bottom:0px;">
                        <label for="ID" style="color:#124f62;padding-left:0px;padding-top:0px;padding-bottom:5px;">Applied Before</label>
                        <select class="form-control" id="adjempappliedbefore" name="EmpAdjAppliedBefore">
                            <option value="1">YES</option>
                            <option value="0">NO</option>
                        </select>
                </div>
                <div class="form-group" style="margin-bottom:0px;">
                        <label for="ID" style="color:#124f62;padding-left:0px;padding-bottom:5px;">Taxable</label>
                        <select class="form-control" id="adjtaxable" name="EmpAdjTaxable">
                            <option value="1">YES</option>
                            <option value="0">NO</option>
                        </select>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group" style="margin-bottom:0px;">
                        <label for="ID" style="color:#124f62;padding-left:0px;padding-bottom:5px;">Remarks</label>
                        <textarea class="form-control" id="adjremark" rows="5" name="EmpAdjRemarks"></textarea>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" value="Apply" class="btn btn-primary" name="SubmitEmpAdj">
        
      </div>
      </form>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
    
    $("#edit_employee_adjustment_form").submit(function(e) {
    e.preventDefault();
        $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'update_employee_salary_adjustment',                
        data: $('#edit_employee_adjustment_form').serialize(),
        success: function(data) {
            console.log(data);
            Swal.fire({
            type: 'success',
            title: 'Success',
            text: 'Successfully Updated Employee Salary Adjustment',
            
            }).then((result) => {
                location.href="employee?page=2";
            })
        }  
        }) 
    });
})
</script>
<div id="EditEmpAdjAdjustment" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="ModalHeaderEmployeeNameEdit"></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <form id="edit_employee_adjustment_form">
    <div class="modal-body">
        
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" style="margin-bottom:0px;">
                    <label for="ID" style="color:#124f62;padding-left:0px;padding-top:0px;padding-bottom:5px;">Name</label>
                    <input type="hidden" id="EmpAdjSalaryIDEdit" name="EmpAdjSalaryIDEdit" value="">
                    <input type="text" class="form-control" name="EmpAdjNameEdit" id="EmpAdjNameEdit" value="">
                </div>
                <div class="form-group" style="margin-bottom:0px;">
                    <label for="ID" style="color:#124f62;padding-left:0px;padding-bottom:5px;">Code</label>
                    <input type="text" class="form-control" name="EmpAdjCodeEdit" id="EmpAdjCodeEdit" value="">
                </div>
                <div class="form-group" style="margin-bottom:0px;">
                    <label for="ID" style="color:#124f62;padding-left:0px;padding-bottom:5px;">Amount</label>
                    <input type="number" class="form-control" name="EmpAdjAmountEdit" id="EmpAdjAmountEdit" value="">
                </div>
            </div>
            <div class="col-md-6">
            <div class="form-group" >
                <label for="ID" style="color:#124f62;padding-left:0px;padding-top:0px;padding-bottom:5px;">Type</label>
                <select class="form-control" name="EmpAdjAdjTypeEdit" id="EmpAdjAdjTypeEdit">
                <option>Allowance</option>
                <option>Bonus</option>
                <option>Commission</option>
                <option>Misceleneous</option>
                <option>Reimbursable Allowance</option>
                <option>Salary Adjustment</option>
                <option>Loan</option>
                <option>SSS Loan</option>
                <option>HDMF Loan</option>
                <option>External Loan</option>
                <option>13th Month NonTaxable</option>
                <option>Monetized Leave</option>
                <option>HDMF Calamity Loan</option>
                <option>SSS Calamity Loan</option>
                <option>Basic Adjustment</option>
                <option>Overtime Adjustment</option>
                <option>Deminimis Adjustment</option>
                <option>Without Tax</option>
                <option>SSSEE</option>
                <option>SSSEC</option>
                </select>
                </div>
                <div class="form-group" style="margin-bottom:0px;">
                <label for="ID" style="color:#124f62;padding-left:0px;padding-top:0px;padding-bottom:5px;">Applied Before</label>
                <select class="form-control" name="EmpAdjAppliedBeforeEdit" id="EmpAdjAppliedBeforeEdit">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                </select>
                </div>
                <div class="form-group" style="margin-bottom:0px;">
                <label for="ID" style="color:#124f62;padding-left:0px;padding-bottom:5px;">Taxable</label>
                <select class="form-control" name="EmpAdjTaxableEdit" id="EmpAdjTaxableEdit">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                </select>
                </div>
                
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group" style="margin-bottom:0px;">
                    <label for="ID" style="color:#124f62;padding-left:0px;padding-bottom:5px;">Remarks</label>
                    <textarea class="form-control" rows="5" name="EmpAdjRemarksEdit" id="EmpAdjRemarksEdit"></textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <input type="submit" value="Apply" class="btn btn-primary" name="SubmitEmpAdjEdit">
    </div>
    </form>
    </div>
    
  </div>
</div>

<div class="modal fade" id="importAttendanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Import Employee Data from Excel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="text-align:center;">
            <label for="excel-upload" style="opacity:1;cursor:pointer;border-radius:10px;" id="FIleImportExcelLabel" class="custom-excel-upload btn btn-primary">
                IMPORT FROM EXCEL
            </label>
            <script>
                function ImportExcelFile(){
                    start_spinner();
                    var file = $('#excel-upload')[0].files[0]
                    var fd = new FormData();
                    fd.append('theFile', file);
                    fd.append('_token','{{csrf_token()}}');
                    $.ajax({
                        url: 'extra/attendance/XLS/index.php',
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        data: fd,
                        dataType:"json",
                        success: function (data, status, jqxhr) {
                            var LOG="";
                            if(data.Error_Log!=""){
                            LOG=" \n\nSkip Log : \n"+data.Error_Log;
                            }
                            alert("Total number Of Data : "+data.Total+"\nData Saved : "+data.Success+" \nData Skipped : "+data.Skiped+LOG);
                            document.getElementById("excel-upload").value = "";
                            console.log("asdada : "+data.Extra);
                            stop_spinner();
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Added Employee Adjustments',
                            }).then((result) => {
                                location.href="employee?page=3";
                            })
                            
                        },
                        error: function (jqxhr, status, msg) {
                            alert(jqxhr.status +" message"+msg+" status:"+status);
                            alert(jqxhr.responseText);
                            stop_spinner();
                        }
                    });
                    document.getElementById("excel-upload").value = "";
                }
            </script>
            <input id="excel-upload" type="file" style="display:none;" onchange="ImportExcelFile()" name="excelimport" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
        </div>
        <div class="modal-footer">
          <a class="btn btn-success" href="{{asset('extra/import_file/employee attendance.xlsx')}}" download>Download Template Sample</a>
        </div>
      </div>
    </div>
  </div>


<div id="ViewSummaryPayrollModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal Header</h5>
        <button type="button" class="close" data-dismiss="modal">×</button>
        
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="AssetSetupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <script>
            $(document).ready(function(){
                
                $("#asset_setup_form").submit(function(e) {
                e.preventDefault();
                    var SC=document.getElementById('SC').value;
                    var SCCODE=document.getElementById('SCCODE').value;
                    var valid=0;
                    if(SC!=""){
                        if(SCCODE==""){

                        }else{
                            valid=1;
                        }
                        
                    }else{
                        valid=1;
                    }

                        if(valid==1){
                            $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'add_asset_setup_request',                
                            data: $('#asset_setup_form').serialize(),
                            success: function(data) {
                                console.log(data);
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Submitted New Asset Setup Request',
                                
                                }).then((result) => {
                                    location.href="asset";
                                })
                            }  
                            }) 
                        }else{
                            Swal.fire({
                            type: 'error',
                            title: 'Error',
                            text: 'SC Code cannot be blank..',
                            
                            }).then((result) => {
                            
                            })
                        }
                        

                        
                });
            })
            </script>
            <form id="asset_setup_form">
            <table class="table table-borderless table-sm" style="background-color:white;">
                <thead style="background-color:#124f62; color:white;">
                    <tr>
                        <th colspan="5">Asset Setup and Reference</th>
                    </tr>
                    <tr style="background-color:white; color:#124f62;">
                        <th colspan="4"></th>
                        <th colspan="1">
                        {{-- <select class="form-control selectpicker" data-live-search="true" onchange="ChangeForm(this)"> --}}
                        <select class="form-control " onchange="ChangeForm(this)" id="asset_setup_type" name="asset_setup_type">
                            <option>Asset Tag</option>
                            <option>Site & Location</option>
                        </select>
                        <script>
                            
                            function ChangeForm(e){
                                // document.getElementById('SaveBtnAssetSetup').disabled=false;
                                // $.ajax({
                                //     type: 'POST',
                                //     url: 'SetAssetSetup.php',                
                                //     data: {Set:e.value},
                                // success: function(data) {
                                //     $( "#AssetSetup_TBody" ).replaceWith( data );
                                // } 											 
                                // })
                                
                            }
                        </script>
                        </th>
                    </tr>
                </thead>
                <tbody id="AssetSetup_TBody">
                    
                    <tr>
                        <td width="15%" style="vertical-align: middle;text-align:right;color:#083240;">Asset Description</td>
                        <td width="25%" style="vertical-align: middle;"><input type="text" list="AssetDescSearchREsult" required class="form-control" id="Descrrrr2" style="text-transform: capitalize" onclick="ShowSearchAssetDesc(),CheckAssetTagaCombination()" onkeyup="CheckAssetTagaCombination(),CheckCOde()"  onkeypress="return alphaOnly(event)" title="Characters(A-Z) Only" name="AssetDescriptionSetup" >
                        <datalist id="AssetDescSearchREsult">
                            
                        </datalist>
                        <script>
                            function CheckAssetTagaCombination(){
                                
                                var desc=document.getElementById('Descrrrr2').value;
                                var CN=document.getElementById('CN').value;
                                var SC=document.getElementById('SC').value;
                                $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'check_asset_setup_asset_tag_combination',                
                                data:{desc:desc,CN:CN,SC:SC,_token: '{{csrf_token()}}'},
                                success: function(data) {
                                    if(data>0){
                                    
                                        document.getElementById('ADCODE').style.borderColor='red';
                                        document.getElementById('CNCODE').style.borderColor='red';
                                        document.getElementById('SCCODE').style.borderColor='red';
                                        document.getElementById('Descrrrr2').style.borderColor='red';
                                        document.getElementById('CN').style.borderColor='red';
                                        document.getElementById('SC').style.borderColor='red';
                                        document.getElementById('SaveBtnAssetSetup').disabled=true;
                                        
                                    }
                                    else{
                                        document.getElementById('ADCODE').style.borderColor='#ccc';
                                        document.getElementById('CNCODE').style.borderColor='#ccc';
                                        document.getElementById('SCCODE').style.borderColor='#ccc';
                                        document.getElementById('Descrrrr2').style.borderColor='#ccc';
                                        document.getElementById('CN').style.borderColor='#ccc';
                                        document.getElementById('SC').style.borderColor='#ccc';
                                        document.getElementById('SaveBtnAssetSetup').disabled=false;
                                    }
                                    
                                }  
                                })
                            }
                            function ShowSearchAssetDesc(){
                                var desc=document.getElementById('Descrrrr2').value;
                                $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'get_asset_desc',                
                                data:{value:desc,_token: '{{csrf_token()}}'},
                                success: function(data) {
                                    var element="<datalist id='AssetDescSearchREsult'>";
                                        element=element+data;
                                        element=element+"</datalist>";
                                    $( "#AssetDescSearchREsult" ).replaceWith( element );
                                    
                                }  
                                }) 
                            }
                            
                        </script>
                        </td>
                        <td width="15%"style="vertical-align: middle;text-align:right;color:#083240;" >AD CODE</td>
                        <td width="20%"style="vertical-align: middle;"><input type="text" required class="form-control" maxlength="5" id="ADCODE" style="text-transform: uppercase" onkeyup="CheckAssetTagaCombination()" list="AssetDescCOdeSearchREsult" onclick="AssetDescCOdeSearchREsult(),CheckAssetTagaCombination()"  onkeypress="return alphaOnly(event)" title="Characters(A-Z) Only" name="AD_COde" value="">
                        <datalist id="AssetDescCOdeSearchREsult"></datalist>
                        <script>
                            function AssetDescCOdeSearchREsult(){
                                var desc=document.getElementById('ADCODE').value;
                                $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'get_asset_desc_code_list',                
                                data:{value:desc,_token: '{{csrf_token()}}'},
                                success: function(data) {
                                    var element="<datalist id='AssetDescCOdeSearchREsult'>";
                                        element=element+data;
                                        element=element+"</datalist>";
                                    $( "#AssetDescCOdeSearchREsult" ).replaceWith( element );
                                    
                                }  
                                }) 
                                
                            }
                        </script>
                        </td>
                        <td width="40%"></td>
                    </tr>
                    
                    <script>
                        function CheckCOde(){
                            var desc=document.getElementById('Descrrrr2').value;
                            $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'get_asset_desc_code',             
                            data:{value:desc,_token: '{{csrf_token()}}'},
                            success: function(data) {
                                document.getElementById('ADCODE').value=data;
                                if(data==""){
                                    document.getElementById('ADCODE').readOnly=false;
                                }else{
                                    document.getElementById('ADCODE').readOnly=true;
                                }
                            }  
                            }) 
                            
                        }
                        function CheckCOdeCN(){
                            var desc=document.getElementById('CN').value;
                            $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'get_asset_cat_code',             
                            data:{value:desc,_token: '{{csrf_token()}}'},
                            success: function(data) {
                                document.getElementById('CNCODE').value=data;
                                if(data==""){
                                    document.getElementById('CNCODE').readOnly=false;
                                }else{
                                    document.getElementById('CNCODE').readOnly=true;
                                }
                            }  
                            })
                            
                        }
                        function CheckCOdeSC(){
                            var desc=document.getElementById('SC').value;
                            $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'get_asset_sub_cat_code',             
                            data:{value:desc,_token: '{{csrf_token()}}'},
                            success: function(data) {
                                document.getElementById('SCCODE').value=data;
                                if(data==""){
                                    document.getElementById('SCCODE').readOnly=false;
                                }else{
                                    document.getElementById('SCCODE').readOnly=true;
                                }
                            }  
                            })
                            
                        }
                    </script>
                    
                    <tr>
                        <td style="vertical-align: middle;text-align:right;color:#083240;">Category</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control" required onkeyup="AssetCategorySearchREsult(),CheckCOdeCN(),CheckAssetTagaCombination()" id="CN" style="text-transform: capitalize"  onclick="AssetCategorySearchREsult(),CheckAssetTagaCombination()"  name="CategoryNameSetup" list="AssetCategorySearchREsult">
                        <datalist id="AssetCategorySearchREsult"></datalist>
                        <script>
                            function blurs2(){
                                if(document.getElementById("listsearchsad")){
                                    document.getElementById("listsearchsad").style.display="none";
                                }
                                if(document.getElementById("listsearcssshsads")){
                                    document.getElementById("listsearcssshsads").style.display="none";
                                }
                                if(document.getElementById("listsearch123")){
                                    document.getElementById("listsearch123").style.display="none";
                                }
                                if(document.getElementById("listsearcssshsadsssdsds")){
                                    document.getElementById("listsearcssshsadsssdsds").style.display="none";
                                }
                                if(document.getElementById("AssetSubCategoryCodeSearchResult")){
                                    document.getElementById("AssetSubCategoryCodeSearchResult").style.display="none";
                                }
                                
                            }
                            function AssetCategorySearchREsult(){
                                var desc=document.getElementById('CN').value;
                                var desc2=document.getElementById('Descrrrr2').value;
                                
                                $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'get_asset_category',                
                                data:{value:desc2,category:desc,_token: '{{csrf_token()}}'},
                                success: function(data) {
                                    var element="<datalist id='AssetCategorySearchREsult'>";
                                        element=element+data;
                                        element=element+"</datalist>";
                                    $( "#AssetCategorySearchREsult" ).replaceWith( element );
                                    
                                }  
                                }) 
                                
                                
                            }
                            function AssetCNCodeSearchREsult(){
                                var desc=document.getElementById('CNCODE').value;
                                var desc2=document.getElementById('Descrrrr2').value;
                                $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'get_asset_category_code_list',                
                                data:{value:desc2,category:desc,_token: '{{csrf_token()}}'},
                                success: function(data) {
                                    var element="<datalist id='AssetCNCodeSearchREsult'>";
                                        element=element+data;
                                        element=element+"</datalist>";
                                    $( "#AssetCNCodeSearchREsult" ).replaceWith( element );
                                    
                                }  
                                }) 
                                
                                
                            }
                        </script>
                        </td>
                        <td  style="vertical-align: middle;text-align:right;color:#083240;" >CN CODE</td>
                        <td width="15%"style="vertical-align: middle;"><input type="text" required class="form-control" maxlength="5" style="text-transform: uppercase" onkeyup="AssetCNCodeSearchREsult(),CheckAssetTagaCombination()" onclick="AssetCNCodeSearchREsult(),CheckAssetTagaCombination()"  id="CNCODE" onkeypress="return alphaOnly(event)" list="AssetCNCodeSearchREsult" title="Characters(A-Z) Only" name="CN_COde" value="">
                        <datalist id="AssetCNCodeSearchREsult"></datalist>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td style="vertical-align: middle;text-align:right;color:#083240;">Sub Category</td>
                        <td style="vertical-align: middle;"><input type="text" class="form-control"  id="SC" onkeyup="ShowSubCat,CheckCOdeSC(),CheckAssetTagaCombination()" onclick="ShowSubCat()" style="text-transform: capitalize" name="SubCategorySetup" list="AssetSubCategorySearchResult">
                        <datalist id="AssetSubCategorySearchResult"></datalist>
                        </td>
                        <td style="vertical-align: middle;text-align:right;color:#083240;" >SC CODE</td>
                        <td width="15%"style="vertical-align: middle;"><input type="text"  class="form-control" maxlength="5" style="text-transform: uppercase" id="SCCODE" onkeypress="return alphaOnly(event)" onkeyup="ShowSubCatCode()" list="AssetSubCategoryCodeSearchResult" onclick="ShowSubCatCode()" title="Characters(A-Z) Only" name="SC_COde" value="">
                        <datalist id="AssetSubCategoryCodeSearchResult"></datalist>
                        </td>
                        <td></td>
                        <script>
                            function ShowSubCat(){
                                var CN=document.getElementById('CN').value;
                                var desc=document.getElementById('Descrrrr2').value;
                                var SC=document.getElementById('SC').value;
                                $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'get_asset_sub_cat',                
                                data:{value:desc,CN:CN,SC:SC,_token: '{{csrf_token()}}'},
                                success: function(data) {
                                    var element="<datalist id='AssetSubCategorySearchResult'>";
                                        element=element+data;
                                        element=element+"</datalist>";
                                    $( "#AssetSubCategorySearchResult" ).replaceWith( element );
                                    
                                }  
                                }) 
                                
                            }
                            function ShowSubCatCode(){
                                var CN=document.getElementById('CN').value;
                                var desc=document.getElementById('Descrrrr2').value;
                                var SC=document.getElementById('SCCODE').value;
                                $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'get_asset_sub_cat_code_list',                
                                data:{value:desc,CN:CN,SC:SC,_token: '{{csrf_token()}}'},
                                success: function(data) {
                                    var element="<datalist id='AssetSubCategoryCodeSearchResult'>";
                                        element=element+data;
                                        element=element+"</datalist>";
                                    $( "#AssetSubCategoryCodeSearchResult" ).replaceWith( element );
                                    
                                }  
                                }) 
                                
                            }
                        </script>
                    </tr>
                    <tr>
                        <td style="padding-top:11px;margin-top:10px;text-align:right;color:#083240;">Required Fields</td>
                        <td colspan="2" >
                        <div class="form-inline">
                            <div class="form-check" style="margin-bottom:0px !important;margin-top:10px;">
                            <input type="checkbox" class="form-check-input" id="SerialCheck" name="RequireSerial" value="Serial">
                            <label class="form-check-label" for="SerialCheck">Serial Number</label>
                            </div>
                            <div class="form-check" style="margin-bottom:0px !important;margin-top:10px;margin-left:10px;">
                            <input type="checkbox" class="form-check-input" id="PlateCheck" name="RequirePlateNumber" value="Plate">
                            <label class="form-check-label" for="PlateCheck">Plate Number</label>
                            </div>
                        </div>
                        
                        </td>
                        
                        <td colspan="1" style="vertical-align: middle">
                        
                        </td>
                    </tr>
                    <tr>

                    </tr>
                </tbody>
            </table>
            <table class="table table-borderless table-sm">
                <tr>
                    <td style="text-align:right;">
                        <label for="excel-upload-asset_stup" style="opacity:1;" id="FIleImportExcelLabel" class="custom-excel-upload btn btn-primary btn-sm">
							Import
                        </label>
                        <style>
                        #excel-upload-asset_stup{
							display: none;
						}
                        </style>
                        <input id="excel-upload-asset_stup" type="file" onchange="ImportExcelFile()"  name="excelimport" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        <input type="submit" class="btn btn-primary btn-sm" name="SaveSetup" id="SaveBtnAssetSetup" value="Save" >
						<input type="reset" class="btn btn-primary btn-sm" class="close" data-dismiss="modal" value="Cancel">
                    </td>
                </tr>
            </table>
            </form>
            <table class="table table-bordered table-sm" style="background-color:white;">
                <thead>
                <tr style="background-color:#124f62; color:white;">
                    <th colspan="7"><b>Asset Info Tagging Example</b></th>

                </tr>
                <tr>
                    <th>ASSET</th>
                    <th>AD CODE</th>
                    <th>CATEGORY</th>
                    <th>CN CODE</th>
                    <th>SUB-CATEGORY</th>
                    <th>SC CODE</th>
                    <th>ASSET TAG</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                    <td title="Computer">Computer</td>
                    <td title="COMP">COMP</td>
                    <td title="Desktop">Desktop</td>
                    <td title="DESK">DESK</td>
                    <td title=""></td>
                    <td title=""></td>
                    <td>COMP-DESK-000-001</td>                
                </tr>
                <tr>
                    <td title="Computer"></td>
                    <td title="COMP"></td>
                    <td title="Laptop">Laptop</td>
                    <td title="LAP">LAP</td>
                    <td title=""></td>
                    <td title=""></td>
                    <td>COMP-LAP-000-001</td>                                
                </tr>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
                <tr>
                    <td title="Furniture">Furniture</td>
                    <td title="FUR">FUR</td>
                    <td title="Chair">Chair</td>
                    <td title="CHR">CHR</td>
                    <td title="GASLIFT">GASLIFT</td>
                    <td title="GAS">GAS</td>
                    <td>FUR-CHR-GAS-000-001</td>                       
                </tr>
                <tr>
                    <td title="Furniture"></td>
                    <td title="FUR"></td>
                    <td title="Chair"></td>
                    <td title="CHR"></td>
                    <td title="MONOBLOCK">MONOBLOCK</td>
                    <td title="MON">MON</td>
                    <td>FUR-CHR-MON-000-001</td>                       
                </tr>
                <tr>
                    <td title="Furniture"></td>
                    <td title="FUR"></td>
                    <td title="Table">Table</td>
                    <td title="TBL">TBL</td>
                    <td title=""></td>
                    <td title=""></td>
                    <td>FUR-TBL-000-001</td>                    
                </tr>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
                <tr>
                    <td title="Mobile Device">Mobile Device</td>
                    <td title="MOB">MOB</td>
                    <td title="Phone">Phone</td>
                    <td title="PHON">PHON</td>
                    <td title=""></td>
                    <td title=""></td>
                    <td>MOB-PHON-000-001</td>                     
                </tr>
                <tr>
                    <td title="Mobile Device"></td>
                    <td title="MOB"></td>
                    <td title="Tablet">Tablet</td>
                    <td title="TAB">TAB</td>
                    <td title=""></td>
                    <td title=""></td>
                    <td>MOB-TAB-000-001</td>                                
                </tr>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>                            
                <td></td>
                <td></td>
                </tr>
                <tr>
                    <td title="Vehicle">Vehicle</td>
                    <td title="VEH">VEH</td>
                    <td title="Heavy Equipment">Heavy Equipment</td>
                    <td title="HEAVY">HEAVY</td>
                    <td title="BULLDOZER">BULLDOZER</td>
                    <td title="BUL">BUL</td>
                    <td>VEH-HEAVY-BUL-000-001</td>                            
                </tr>
                <tr>
                    <td title="Vehicle"></td>
                    <td title="VEH"></td>
                    <td title="Heavy Equipment"></td>
                    <td title="HEAVY"></td>
                    <td title="DUMPTRUCK">DUMPTRUCK</td>
                    <td title="DUM">DUM</td>
                    <td>VEH-HEAVY-DUM-000-001</td>
                </tr>
                <tr>
                    <td title="Vehicle"></td>
                    <td title="VEH"></td>
                    <td title="Heavy Equipment"></td>
                    <td title="HEAVY"></td>
                    <td title="GRADER">GRADER</td>
                    <td title="GRAD">GRAD</td>
                    <td>VEH-HEAVY-GRAD-000-001</td>                       
                </tr>
                <tr>
                    <td title="Vehicle"></td>
                    <td title="VEH"></td>
                    <td title="SUV">SUV</td>
                    <td title="SUV">SUV</td>
                    <td title=""></td>
                    <td title=""></td>
                    <td>VEH-SUV-000-001</td>                       
                </tr>
                <tr>
                    <td title="Vehicle"></td>
                    <td title="VEH"></td>
                    <td title="Van">Van</td>
                    <td title="VAN">VAN</td>
                    <td title=""></td>
                    <td title=""></td>
                    <td>VEH-VAN-000-001</td>                           
                </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-3">
                <table class="table table-bordered table-sm" style="background-color:white;">
                <thead>
                    <tr>
                    <th>Site</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Davao City</td>
                    </tr>
                </tbody>
                </table>
                </div>
                <div class="col-md-3">
                <table class="table table-bordered table-sm" style="background-color:white;">
                <thead>
                    <tr>
                    <th>Location</th>
                </tr>
                </thead>
                    <tbody>
                    <tr>
                        <td>Bajada</td>
                    </tr>
                    <tr>
                        <td>Buhangin</td>
                    </tr>
                    <tr>
                        <td>Cabantian</td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            {{-- table of asset setup list --}}
            <table class="table table-bordered table-sm" style="background-color:white;" tabindex="1">
                <thead>
                <tr style="background-color:#124f62; color:white;">
                    <th colspan="7"><b>Company Defined Tagging</b></th>
                    
                </tr>
                <tr>
                    <th>ASSET</th>
                    <th>AD CODE</th>
                    <th>CATEGORY</th>
                    <th>CN CODE</th>
                    <th>SUB-CATEGORY</th>
                    <th>SC CODE</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr id="XX1">
                    <td contenteditable="true" id="A1" style="text-transform: capitalize" title="CUTTING OUTFIT">CUTTING OUTFIT</td>
                    <td contenteditable="true" onkeyup="limit(this)" id="B1" style="text-transform: uppercase" title="ME">ME</td>
                    <td contenteditable="true" id="C1" style="text-transform: capitalize" title="MINOR EQUIPMENT">MINOR EQUIPMENT</td>
                    <td contenteditable="true" onkeyup="limit(this)" id="D1" style="text-transform: uppercase" title="CO">CO</td>
                    <td contenteditable="true" id="E1" style="text-transform: capitalize" title=""></td>
                    <td contenteditable="true" onkeyup="limit(this)" id="F1" style="text-transform: uppercase" title=""></td>
                    <td>
                        <select class="form-control" onchange="SelectAction('1','207')" id="SelectedAction1">
                            <option value="">--Action--</option>
                            <option value="Save">Save Changes</option>
                            <option value="Delete">Delete</option>
                        </select>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="row">
				
                <div class="col-md-10">
                <table class="table table-bordered table-sm" style="background-color:white;">
                <thead>
                <tr>
                    <th>Location</th>
                    <th>Site</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>ANTIQUE</td>
                    <td>BUGASONG</td>
                </tr>
                <tr>
                    <td></td>
                    <td>RDF S. JOSE ANTIQUE PPA ILOILO 014</td>
                </tr>
                <tr>
                    <td></td>
                    <td>PANGALCAGAN SADSADAN  ROAD DPWH ANTIQUE 013</td>
                </tr>
                </tbody>
                </table>
                </div>
            
            </div>
        </div>
        
        </div>
    </div>
</div>