@extends('main.main_setup')


@section('content')
<div class="container-fluid" >
    <ul class="nav nav-tabs nav-tab-custom"   role="tablist">
        <li class="nav-item" >
            <a class="nav-link {{($page=='1'? 'active' : ($page==''? 'active' : '') )}}" id="home-tab" data-toggle="tab" href="#OVERTIMERATE" role="tab" aria-controls="home" aria-selected="true">Overtime Rates</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link {{($page=='2'? 'active' : '' )}}" id="profile-tab" data-toggle="tab" href="#ADJUSTMENTTEMPLATE" role="tab" aria-controls="profile" aria-selected="false">Adjustment Templates</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='3'? 'active' : '' )}}" id="contact-tab" data-toggle="tab" href="#COMPANYADJUSTMENT" role="tab" aria-controls="contact" aria-selected="false">Company Adjustments</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='4'? 'active' : '' )}}" id="contact-tab" data-toggle="tab" href="#TAXTABLE" role="tab" aria-controls="contact" aria-selected="false">Tax Table</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link {{($page=='5'? 'active' : '' )}}" id="home-tab" data-toggle="tab" href="#TAXTABLEANNUAL" role="tab" aria-controls="home" aria-selected="true">Tax Table Annual</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link {{($page=='6'? 'active' : '' )}}" id="profile-tab" data-toggle="tab" href="#PHILHEALTH" role="tab" aria-controls="profile" aria-selected="false">PhilHealth</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='7'? 'active' : '' )}}" id="contact-tab" data-toggle="tab" href="#SSS" role="tab" aria-controls="contact" aria-selected="false">SSS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{($page=='8'? 'active' : '' )}}" id="contact-tab" data-toggle="tab" href="#GOVTORRECORD" role="tab" aria-controls="contact" aria-selected="false">Government OR Record</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade {{($page=='1'? 'active show' : ($page==''? 'active show' : '') )}}" id="OVERTIMERATE" role="tabpanel" aria-labelledby="home-tab">
            {{-- <h2 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">OVERTIME RATE</h2> --}}
            <div class="container-fluid" style="padding-top:10px;padding-bottom:10px;">
                <div class="row">
                    <div class="col-md-4 col-left">
                      
                    </div>
                    <div class="col-md-1 col-left col-right" >
                        <button class="btn btn-primary" {!!empty($payroll_computation_ot_rate)? 'disabled title="add a OT rate first in Payroll Computation under the Payroll Tab" ' : ''!!} onclick="ADDOTTABLE()">ADD</button>
                    </div>
                    <div class="col-md-1 col-left col-right" >
                        <button class="btn btn-danger" {!!empty($payroll_computation_ot_rate)? 'disabled title="add a OT rate first in Payroll Computation under the Payroll Tab" ' : 'title="Please Select a OT Table in drop down option" disabled'!!} id="DeleteButtonOTTable" onclick="DELETEOTTABLE()">DELETE</button>  
                    </div>
                    <script>
                      function ADDOTTABLE(){
                        Swal.fire({
                          title: 'Enter OT Table Name',
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
                            // Swal.fire({
                            //   title: `${result.value} entries`
                            // })
                            $.ajax({
                            type: 'POST',
                            url: 'add_ot_rate_table_name',                
                            data: {id:result.value,_token: '{{csrf_token()}}'},
                            success: function(data) {
                              if(data==0){
                                Swal.fire({
                                type: 'error',
                                title: 'Oopss....',
                                text: 'OT Table Name already exist.\nPlease Select another Name.',
                                }).then((result) => {
                                  ADDOTTABLE();
                                })
                              }else{
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Added OT Table',
                                }).then((result) => {
                                    location.href="setup_references?page=1";
                                })
                              }
                            }  
                            });
                          }
                        })
                      }
                      function DELETEOTTABLE(){
                        
                        var header=document.getElementById('OT_TABLE_SELECT').value;
                        
                        $.ajax({
                        type: 'POST',
                        url: 'delete_ot_rate_table_data',                
                        data: {id:header,_token: '{{csrf_token()}}'},
                        success: function(data) {
                          Swal.fire({
                          type: 'success',
                          title: 'Success',
                          text: 'Successfully Updated Company Adjustment',
                          }).then((result) => {
                              location.href="setup_references?page=1";
                          })
                        }  
                        });
                        
                      }
                    </script>
                    <div class="col-md-2 col-left col-right" >
                         
                    </div>
                    <div class="col-md-4  col-right">
                        <select name="OT_TABLE_SELECT" onchange="getSelectedSelect()" class="form-control" id="OT_TABLE_SELECT">
                            <option value="All">All</option>
                            @foreach ($ot_rate_table as $item)
                              <option>{{$item->dh_id}}</option>
                            @endforeach
                        </select>
                        <script>
                          function getSelectedSelect(){
                            var Value=document.getElementById('OT_TABLE_SELECT').value;
                            var x = document.getElementsByClassName("deselect_ot_table");
                            if(Value=="All"){
                              document.getElementById('DeleteButtonOTTable').disabled=true;
                              for(var s=0;s<x.length;s++){
                                  x[s].style.display="flex";
                              }
                            }else{
                              document.getElementById('DeleteButtonOTTable').disabled=false;
                              for(var s=0;s<x.length;s++){
                                  x[s].style.display="none";
                                  if(x[s].id==(Value.replace(/\s/g, ""))+"_row"){
                                    x[s].style.display="flex";
                                  }
                              }
                            }

                          }
                          function EditOTTable(id,type,type_name,q,w,e,r){
                            $.ajax({
                            type: 'POST',
                            url: 'get_ot_rate_table_data',                
                            data: {id:id,_token: '{{csrf_token()}}'},
                            success: function(data) {
                              document.getElementById('ot_type').value=type;
                              document.getElementById('SelTale').value=data['dh_id'];
                              if(type=="ord"){
                                document.getElementById('s1').readOnly=true;
                              }else{
                                document.getElementById('s1').readOnly=false;
                              }
                              if(q=='1'){
                                document.getElementById('s1div').style.display="block";
                              }else{
                                document.getElementById('s1div').style.display="none";
                              }
                              if(w=='1'){
                                document.getElementById('s2div').style.display="block";
                              }else{
                                document.getElementById('s2div').style.display="none";
                              }
                              if(e=='1'){
                                document.getElementById('s3div').style.display="block";
                              }else{
                                document.getElementById('s3div').style.display="none";
                              }
                              if(r=='1'){
                                document.getElementById('s4div').style.display="block";
                              }else{
                                document.getElementById('s4div').style.display="none";
                              }

                              document.getElementById('s1').value=data[type];
                              document.getElementById('s2').value=data[type+'_ot'];
                              document.getElementById('s3').value=data[type+'_nd'];
                              document.getElementById('s4').value=data[type+'_nd_ot'];
                              document.getElementById('ot_rate_table_edit_header').innerHTML=id+" - "+type_name;
                              $('#ot_rate_table_edit_modal').modal('show');
                            }  
                            });
                          }
                        </script>
                    </div>
                </div>
                @foreach ($ot_rate_table as $item)
                <div class="row deselect_ot_table" id="{{preg_replace('/\s+/', '',$item->dh_id)}}_row">
                    <div class="col-md-12">
                    <h4 style="color:#083240;font-weight:bold" id="{{preg_replace('/\s+/', '',$item->dh_id)}}header">{{$item->dh_id}}</h4>
                        <div class="table-responsive">
                        <table class="table table-bordered table-sm " style="background-color:white;overflow-x: auto;">
                          <thead style="background-color:#124f62;color:white;">
                            <tr>
                            <th width="10%"></th>
                            <th width="25%"></th>
                            <th></th>
                            <th>OT</th>
                            <th>ND</th>
                            <th>NDOT</th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td><button {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->ord_ot!="1"? ($payroll_computation_ot_rate->ord_nd!="1"? ($payroll_computation_ot_rate->ord_nd_ot!="1"? 'disabled' : '') : '') : '') : 'disabled')}}  class="btn btn-success" onclick="EditOTTable('{{$item->dh_id}}','ord','Ordinary','1','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->ord_ot : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->ord_nd : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->ord_nd_ot : ''}}')">Edit</button></td>
                            <td>Ordinary</td>
                            <td>{{$item->ord}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->ord_ot=="1"? $item->ord_ot : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->ord_nd=="1"? $item->ord_nd : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->ord_nd_ot=="1"? $item->ord_nd_ot : 'N/A') : 'N/A')}}</td>
                            
                            </tr>
                            <tr>
                            <td><button {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->rd!="1"? ($payroll_computation_ot_rate->rd_ot!="1"? ($payroll_computation_ot_rate->rd_nd!="1"? ($payroll_computation_ot_rate->rd_nd_ot!="1"? 'disabled' : '') : '') : '') : '') : 'disabled')}}  class="btn btn-success" onclick="EditOTTable('{{$item->dh_id}}','rd','Rest Day','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->rd : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->rd_ot : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->rd_nd : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->rd_nd_ot : ''}}')">Edit</button></td>
                            <td>Rest Day</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->rd=="1"? $item->rd : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->rd_ot=="1"? $item->rd_ot : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->rd_nd=="1"? $item->rd_nd : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->rd_nd_ot=="1"? $item->rd_nd_ot : 'N/A') : 'N/A')}}</td>
                            
                            </tr>
                            <tr>
                            <td><button {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh!="1"? ($payroll_computation_ot_rate->sh_ot!="1"? ($payroll_computation_ot_rate->sh_nd!="1"? ($payroll_computation_ot_rate->sh_nd_ot!="1"? 'disabled' : '') : '') : '') : '') : 'disabled')}}  class="btn btn-success" onclick="EditOTTable('{{$item->dh_id}}','sh','Special Holiday','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->sh : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->sh_ot : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->sh_nd : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->sh_nd_ot : ''}}')">Edit</button></td>
                            <td>Special Holiday</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh=="1"? $item->sh : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_ot=="1"? $item->sh_ot : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_nd=="1"? $item->sh_nd : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_nd_ot=="1"? $item->sh_nd_ot : 'N/A') : 'N/A')}}</td>
                            
                            </tr>
                            <tr>
                            <td><button {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh!="1"? ($payroll_computation_ot_rate->lh_ot!="1"? ($payroll_computation_ot_rate->lh_nd!="1"? ($payroll_computation_ot_rate->lh_nd_ot!="1"? 'disabled' : '') : '') : '') : '') : 'disabled')}} class="btn btn-success" onclick="EditOTTable('{{$item->dh_id}}','lh','Legal Holiday','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->lh : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->lh_ot : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->lh_nd : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->lh_nd_ot : ''}}')">Edit</button></td>
                            <td>Legal Holiday</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh=="1"? $item->lh : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_ot=="1"? $item->lh_ot : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_nd=="1"? $item->lh_nd : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_nd_ot=="1"? $item->lh_nd_ot : 'N/A') : 'N/A')}}</td>
                            
                            </tr>
                            <tr>
                            <td><button {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_rd!="1"? ($payroll_computation_ot_rate->sh_rd_ot!="1"? ($payroll_computation_ot_rate->sh_rd_nd!="1"? ($payroll_computation_ot_rate->sh_rd_nd_ot!="1"? 'disabled' : '') : '') : '') : '') : 'disabled')}} class="btn btn-success" onclick="EditOTTable('{{$item->dh_id}}','sh_rd','Special Holiday Rest Day','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->sh_rd : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->sh_rd_ot : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->sh_rd_nd : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->sh_rd_nd_ot : ''}}')">Edit</button></td>
                            <td>Special Holiday Rest Day</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_rd=="1"? $item->sh_rd : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_rd_ot=="1"? $item->sh_rd_ot : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_rd_nd=="1"? $item->sh_rd_nd : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->sh_rd_nd_ot=="1"? $item->sh_rd_nd_ot : 'N/A') : 'N/A')}}</td>
                            
                            </tr>
                            <tr>
                            <td><button {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_rd!="1"? ($payroll_computation_ot_rate->lh_rd_ot!="1"? ($payroll_computation_ot_rate->lh_rd_nd!="1"? ($payroll_computation_ot_rate->lh_rd_nd_ot!="1"? 'disabled' : '') : '') : '') : '') : 'disabled')}}  class="btn btn-success" onclick="EditOTTable('{{$item->dh_id}}','lh_rd','Legal Holiday Rest Day','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->lh_rd : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->lh_rd_ot : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->lh_rd_nd : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->lh_rd_nd_ot : ''}}')">Edit</button></td>
                            <td>Legal Holiday Rest Day</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_rd=="1"? $item->lh_rd : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_rd_ot=="1"? $item->lh_rd_ot : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_rd_nd=="1"? $item->lh_rd_nd : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->lh_rd_nd_ot=="1"? $item->lh_rd_nd_ot : 'N/A') : 'N/A')}}</td>
                            
                            </tr>
                            <tr>
                            <td><button {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh!="1"? ($payroll_computation_ot_rate->dh_ot!="1"? ($payroll_computation_ot_rate->dh_nd!="1"? ($payroll_computation_ot_rate->dh_nd_ot!="1"? 'disabled' : '') : '') : '') : '') : 'disabled')}}  class="btn btn-success" onclick="EditOTTable('{{$item->dh_id}}','dh','Double Holiday','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->dh : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->dh_ot : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->dh_nd : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->dh_nd_ot : ''}}')">Edit</button></td>
                            <td>Double Holiday</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh=="1"? $item->dh : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_ot=="1"? $item->dh_ot : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_nd=="1"? $item->dh_nd : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_nd_ot=="1"? $item->dh_nd_ot : 'N/A') : 'N/A')}}</td>
                            
                            </tr>
                            <tr>
                            <td><button {{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_rd!="1"? ($payroll_computation_ot_rate->dh_rd_ot!="1"? ($payroll_computation_ot_rate->dh_rd_nd!="1"? ($payroll_computation_ot_rate->dh_rd_nd_ot!="1"? 'disabled' : '') : '') : '') : '') : 'disabled')}} class="btn btn-success" onclick="EditOTTable('{{$item->dh_id}}','dh_rd','Double Holiday Rest Day','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->dh_rd : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->dh_rd_ot : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->dh_rd_nd : ''}}','{{!empty($payroll_computation_ot_rate)? $payroll_computation_ot_rate->dh_rd_nd_ot : ''}}')">Edit</button></td>
                            <td>Double Holiday Rest Day</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_rd=="1"? $item->dh_rd : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_rd_ot=="1"? $item->dh_rd_ot : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_rd_nd=="1"? $item->dh_rd_nd : 'N/A') : 'N/A')}}</td>
                            <td>{{(!empty($payroll_computation_ot_rate)? ($payroll_computation_ot_rate->dh_rd_nd_ot=="1"? $item->dh_rd_nd_ot : 'N/A') : 'N/A')}}</td>
                            
                            </tr>
                            </tbody>
                          </table>
                        </div>
                                          
                    </div>
                  </div>
                @endforeach
                
            </div>
        </div>
        <div class="tab-pane fade {{($page=='2'? 'active show' : '' )}}" id="ADJUSTMENTTEMPLATE" role="tabpanel" aria-labelledby="profile-tab">
            <h2 style="margin-bottom:0px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">ADD NEW ADJUSTMENT</h2>
            <div class="container-fluid" style="padding-bottom:10px;padding-top:10px;">
              <div class="row">
                <div class="col-md-6">
                    <script>
                    $(document).ready(function(){
                        $("#new_adjustment_form").submit(function(e) {
                            e.preventDefault();
                            $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'add_new_adjsutment_template',                
                                data: $('#new_adjustment_form').serialize(),
                                success: function(data) {
                                    console.log(data);
                                    Swal.fire({
                                    type: 'success',
                                    title: 'Success',
                                    text: 'Successfully Added Adjustment Template',
                                    }).then((result) => {
                                        location.href="setup_references?page=2";
                                    })
                                }
                            })
                        });
                    });
                    </script>
                    <form id="new_adjustment_form">
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Type:</label>
                              <select class="form-control" name="AdjType">
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
                              <input type="text" class="form-control" name="AdjName" required>
                          </div>
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Code</label>
                              <input type="text" class="form-control" name="AdjCode" required>
                          </div>
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Amount</label>
                              <input type="number" class="form-control" name="Amount" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Applied Before</label>
                              <select class="form-control" name="ApplyBefore">
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                              </select>
                          </div>
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Taxable</label>
                              <select class="form-control" name="Taxable">
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                              </select>
                          </div>
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Max Amount</label>
                              <input type="number" class="form-control" name="MaxAmount" value="0">
                          </div>
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Divided per Period</label>
                              <select class="form-control" name="Divided">
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
                              <textarea class="form-control" name="AdjtempRemarks" rows="5"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin-top:5px;">
                        <div class="col-md-12" style="text-align:right;">
                          <input type="submit" class="btn btn-primary" style="margin-right:10px;" value="Save" name="submitadjtemp">
                          <input type="reset" class="btn btn-primary" value="Cancel">
                        </div>
                      </div>
                      </form>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <h2 style="margin-top:0px;font-weight:bold;">ADJUSTMENT</h2>
                  </div>
                  <div class="col-md-12">
                    
                    
                    <div class="row" style="color:#124f62;">
                      <div class="col-md-12">
                      
                      <table class="table table-bordered table-condensed" style="background-color:white;margin-bottom:10px;">
                      <thead style="background-color:#124f62;color:white;">
                        <tr>
                        <th width="10%"></th>
                        <th width="10%">Type</th>
                        <th width="10%">Name</th>
                        <th width="10%">Code</th>
                        <th width="10%">Amount</th>
                        <th width="20%">Remarks</th>
                        <th width="10%">Before Tax</th>
                        <th width="10%">Taxable</th>
                        <th width="10%">Max Accumulated</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (count($adjustment_template)==0)
                          <tr>
                            <td colspan="9" style="text-align:center;">No Adjustment Template Found...</td>
                          </tr>
                        @else
                            @foreach ($adjustment_template as $item)
                                <tr>
                                  <td><button class="btn btn-success" onclick="edit_adjustment_template('{{$item->template_id}}')"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button></td>
                                  <td>{{$item->template_type}}</td>
                                  <td>{{$item->template_name}}</td>
                                  <td>{{$item->template_code}}</td>
                                  <td>{{number_format($item->template_amount,2)}}</td>
                                  <td>{{$item->template_remarks}}</td>
                                  <td>{{$item->applied_before=="1"? 'True': 'False'}}</td>
                                  <td>{{$item->taxable=="1"? 'True': 'False'}}</td>
                                  <td>{{number_format($item->template_max_amount,2)}}</td>
                                </tr>
                            @endforeach
                        @endif
                        
                      </tbody>
                      </table>
                      <script>
                        function edit_adjustment_template(id){
                          $.ajax({
                            type: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: 'get_adjustment_template_data',                
                            data: {id:id,_token: '{{csrf_token()}}'},
                            success: function(data) {
                              document.getElementById('AdjType2').value=data['template_type'];
                              document.getElementById('AdjName2').value=data['template_name'];
                              document.getElementById('AdjCode2').value=data['template_code'];
                              document.getElementById('Amount2').value=data['template_amount'];
                              document.getElementById('ApplyBefore2').value=data['applied_before'];
                              document.getElementById('Taxable2').value=data['taxable'];
                              document.getElementById('MaxAmount2').value=data['template_max_amount'];
                              document.getElementById('Divided2').value=data['divided_by_period'];
                              document.getElementById('AdjtempRemarks2').value=data['template_remarks'];
                              document.getElementById('templateid').value=data['template_id'];
                              document.getElementById('adjustmet_tempalte_header').innerHTML=data['template_name'];
                              
                              $('#adjustment_template_edit_modal').modal('show');
                            }
                        })
                        }
                      </script>
                      </div>
                      
                    </div>
                  
                  </div>
                </div>
            </div>
            
        </div>
        <div class="tab-pane fade {{($page=='3'? 'active show' : '' )}}" id="COMPANYADJUSTMENT" role="tabpanel" aria-labelledby="contact-tab">
            <h2 style="margin-bottom:0px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">ADD NEW COMPANY ADJUSTMENT</h2>
            <div class="container-fluid" style="padding-top:10px;padding-bottom:10px;">
            <div class="row">
                <div class="col-md-6">
                    <script>
                    $(document).ready(function(){
                        $("#company_adjustment_form").submit(function(e) {
                            e.preventDefault();
                            $.ajax({
                                type: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: 'add_company_adjustment_data',                
                                data: $('#company_adjustment_form').serialize(),
                                success: function(data) {
                                    console.log(data);
                                    Swal.fire({
                                    type: 'success',
                                    title: 'Success',
                                    text: 'Successfully Added Company Adjustment',
                                    }).then((result) => {
                                        location.href="setup_references?page=3";  
                                    })
                                }
                            })
                        });
                    });
                    </script>
                    <form id="company_adjustment_form">
                    <div class="row">
                      <div class="col-md-12" style="text-align:right;">
                        <button class="btn btn-link btn-sm" type="button" data-toggle="modal" data-target="#SelectADJModal">Select Adjustment template</button>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Type:</label>
                              <select class="form-control" name="AdjTypecom" id="AdjTypecom">
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
                              <input type="text" class="form-control" name="AdjNamecom" id="AdjNamecom" required>
                          </div>
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Code</label>
                              <input type="text" class="form-control" name="AdjCodecom" id="AdjCodecom" required>
                          </div>
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Amount</label>
                              <input type="number" class="form-control" name="Amountcom" id="Amountcom" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Applied Before</label>
                              <select class="form-control" name="ApplyBeforecom" id="ApplyBeforecom">
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                              </select>
                          </div>
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Taxable</label>
                              <select class="form-control" name="Taxablecom" id="Taxablecom">
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                              </select>
                          </div>
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Max Amount</label>
                              <input type="number" class="form-control" name="MaxAmountcom" id="MaxAmountcom" value="0">
                          </div>
                          <div class="form-group" style="margin-bottom:0px;">
                              <label for="ID" style="color:#083240;padding-left:0px;padding-bottom:5px;">Divided per Period</label>
                              <select class="form-control" name="Dividedcom" id="Dividedcom">
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
                              <textarea class="form-control" name="AdjtempRemarkscom" id="AdjtempRemarkscom" rows="5"></textarea>
                          </div>
                        </div>
                      </div>
                      <div class="row" style="margin-top:5px;">
                        <div class="col-md-12" style="text-align:right;">
                          <input type="submit" class="btn btn-primary" style="margin-right:10px;" value="Save" name="submitadjtemp">
                          <input type="reset" class="btn btn-primary" value="Cancel">
                        </div>
                      </div>
                      </form>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                    <h2 style="margin-top:0px;font-weight:bold;">COMPANY ADJUSTMENT</h2>
                  </div>
                  <div class="col-md-12">
                    
                    
                    <div class="row" style="color:#124f62;">
                      <div class="col-md-12">
                      
                      <table class="table table-bordered table-condensed" style="background-color:white;margin-bottom:10px;">
                      <thead style="background-color:#124f62;color:white;">
                        <tr>
                        <th width="10%"></th>
                        <th width="10%">Type</th>
                        <th width="10%">Name</th>
                        <th width="10%">Code</th>
                        <th width="10%">Amount</th>
                        <th width="20%">Remarks</th>
                        <th width="10%">Before Tax</th>
                        <th width="10%">Taxable</th>
                        <th width="10%">Max Accumulated</th>
                        <th width="10%"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (count($company_adjustment)==0)
                          <tr>
                            <td colspan="9" style="text-align:center;">No Adjustment Template Found...</td>
                          </tr>
                        @else
                        
                            @foreach ($company_adjustment as $item)
                                <tr>
                                  <td><button class="btn btn-success" onclick="edit_company_adjustment('{{$item->company_adjustment_id}}')"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button></td>
                                  <td>{{$item->company_adjustment_type}}</td>
                                  <td>{{$item->company_adjustment_name}}</td>
                                  <td>{{$item->company_adjustment_code}}</td>
                                  <td>{{number_format($item->company_adjustment_amount,2)}}</td>
                                  <td>{{$item->company_adjustment_remarks}}</td>
                                  <td>{{$item->company_adjustment_applied_before=="1"? 'True': 'False'}}</td>
                                  <td>{{$item->company_adjustment_taxable=="1"? 'True': 'False'}}</td>
                                  <td>{{number_format($item->company_adjustment_max_amount,2)}}</td>
                                  <td><button class="btn btn-danger" onclick="delete_company_adjustment('{{$item->company_adjustment_id}}')"><i class="fa fa-times" aria-hidden="true"></i> Delete</button></td>
                                </tr>
                            @endforeach
                        @endif
                        
                      </tbody>
                      </table>
                      <script>
                        function delete_company_adjustment(id){
                          $.ajax({
                              type: 'POST',
                              headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              },
                              url: 'delete_company_adjustment_data',                
                              data: {id:id,_token: '{{csrf_token()}}'},
                              success: function(data) {
                                Swal.fire({
                                type: 'success',
                                title: 'Success',
                                text: 'Successfully Deleted Company Adjustment',
                                }).then((result) => {
                                    location.href="setup_references?page=3";
                                })
                              }
                          })
                        }
                        function edit_company_adjustment(id){
                          $.ajax({
                              type: 'POST',
                              headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                              },
                              url: 'get_company_adjustment_data',                
                              data: {id:id,_token: '{{csrf_token()}}'},
                              success: function(data) {
                                document.getElementById('AdjType2com').value=data['company_adjustment_type'];
                                document.getElementById('AdjName2com').value=data['company_adjustment_name'];
                                document.getElementById('AdjCode2com').value=data['company_adjustment_code'];
                                document.getElementById('Amount2com').value=data['company_adjustment_amount'];
                                document.getElementById('ApplyBefore2com').value=data['company_adjustment_applied_before'];
                                document.getElementById('Taxable2com').value=data['company_adjustment_taxable'];
                                document.getElementById('MaxAmount2com').value=data['company_adjustment_max_amount'];
                                document.getElementById('Divided2com').value=data['divided_by_period'];
                                document.getElementById('AdjtempRemarks2com').value=data['company_adjustment_remarks'];
                                document.getElementById('templateidcom').value=data['company_adjustment_id'];
                                document.getElementById('adjustmet_tempalte_headercom').innerHTML=data['company_adjustment_name'];
                                
                                $('#company_adjustment_edit_modal').modal('show');
                              }
                          })
                        }
                      </script>
                      </div>
                      
                    </div>
                  
                  </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='4'? 'active show' : '' )}}" id="TAXTABLE" role="tabpanel" aria-labelledby="contact-tab">
            <h2 style="margin-bottom:0px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">TAX TABLE</h2>
            <div class="container-fluid" >
              <div class="row" style="color:#083240;">
                <script>
                  function EditTaxTableTable(id,table){
                   
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'get_tax_tax_table_data',                
                        data: {id:id,table:table,_token: '{{csrf_token()}}'},
                        success: function(data) {
                            document.getElementById('tt1').value=data['one'];
                            document.getElementById('tt2').value=data['two'];
                            document.getElementById('tt3').value=data['three'];
                            document.getElementById('tt4').value=data['four'];
                            document.getElementById('tt5').value=data['five'];
                            document.getElementById('tt6').value=data['six'];
                            document.getElementById('tabletableid').value=data['tax_table_table_id'];
                            document.getElementById('tax_tax_table_modal_header').innerHTML=table+" - Tax Table";
                            
                            $('#company_setup_tax_table_modal').modal('show');
                        }
                    })
                    
                  }  
                  function EditTaxTableDeduction(id,table){
                   
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'get_tax_table_deduction_data',                
                        data: {id:id,table:table,_token: '{{csrf_token()}}'},
                        success: function(data) {
                            var res = data['one'].split("<br>");
                            document.getElementById('one1').value=res[0];
                            document.getElementById('one2').value=res[1];
                            var res = data['two'].split("<br>");
                            document.getElementById('two1').value=res[0];
                            document.getElementById('two2').value=res[1];
                            var res = data['three'].split("<br>");
                            document.getElementById('three1').value=res[0];
                            document.getElementById('three2').value=res[1];
                            var res = data['four'].split("<br>");
                            document.getElementById('four1').value=res[0];
                            document.getElementById('four2').value=res[1];
                            var res = data['five'].split("<br>");
                            document.getElementById('five1').value=res[0];
                            document.getElementById('five2').value=res[1];
                            var res = data['six'].split("<br>");
                            document.getElementById('six1').value=res[0];
                            document.getElementById('six2').value=res[1];
                            document.getElementById('deducid').value=data['tax_table_deduction_id'];
                            document.getElementById('tax_tax_table_deduction_modal_header').innerHTML=table+" - Deduction";
                            
                            $('#company_setup_tax_table_deduction_modal').modal('show');
                        }
                    })
                    
                  }
                </script>
                <div class="col-md-12">
                <legend style="margin-top:0px;font-weight:bold;color:#083240;">DAILY</legend>
                  <div class="" style="background-color:white; color:#262626;">
                  
                  <table class="table table-bordered" style="margin-top:10px;">
                    <thead style="background-color:#124f62;color:white">
                    <tr><th colspan="6" style="vertical-align:middle;">Deduction <button class="btn btn-success btn-sm" onclick="EditTaxTableDeduction('1','DAILY')"><i class="fa fa-pencil" aria-hidden="true"></i></button></th>
                    
                    </tr>
                      <tr>
                      <th width="16%">1</th>
                      <th width="16%">2</th>
                      <th width="16%">3</th>
                      <th width="16%">4</th>
                      <th width="16%">5</th>
                      <th width="16%">6</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <td>{!!(!empty($HR_Company_reference_tax_table_deduction1)? $HR_Company_reference_tax_table_deduction1->one : '' )!!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction1)? $HR_Company_reference_tax_table_deduction1->two : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction1)? $HR_Company_reference_tax_table_deduction1->three : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction1)? $HR_Company_reference_tax_table_deduction1->four : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction1)? $HR_Company_reference_tax_table_deduction1->five : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction1)? $HR_Company_reference_tax_table_deduction1->six : '' !!}</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-bordered" style="margin-top:10px;">
                    <thead style="background-color:#124f62;color:white">
                    <tr><th colspan="10">Tax Table <button class="btn btn-success btn-sm" onclick="EditTaxTableTable('1','DAILY')"><i class="fa fa-pencil" aria-hidden="true"></i></button></th></tr>
                      <tr>
                      <th width="16%">1</th>
                      <th width="16%">2</th>
                      <th width="16%">3</th>
                      <th width="16%">4</th>
                      <th width="16%">5</th>
                      <th width="16%">6</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <td>{{!empty($HR_Company_reference_tax_tax_table1)? $HR_Company_reference_tax_tax_table1->one : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table1)? $HR_Company_reference_tax_tax_table1->two : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table1)? $HR_Company_reference_tax_tax_table1->three : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table1)? $HR_Company_reference_tax_tax_table1->four : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table1)? $HR_Company_reference_tax_tax_table1->five : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table1)? $HR_Company_reference_tax_tax_table1->six : '' }}</td>
                      </tr>
                    </tbody>
                  </table>
                  
                  </div>
                </div>
                
                <div class="col-md-12" style="margin-top:10px;">
                <legend style="margin-top:0px;font-weight:bold;color:#083240;">WEEKLY </legend>
                  <div class="" style="background-color:white; color:#262626;">
                  
                  <table class="table table-bordered" style="margin-top:10px;">
                    <thead style="background-color:#124f62;color:white">
                    <tr><th colspan="10">Deduction <button class="btn btn-success btn-sm" onclick="EditTaxTableDeduction('2','WEEKLY')"><i class="fa fa-pencil" aria-hidden="true"></i></button></th></tr>
                      <tr>
                      <th width="16%">1</th>
                      <th width="16%">2</th>
                      <th width="16%">3</th>
                      <th width="16%">4</th>
                      <th width="16%">5</th>
                      <th width="16%">6</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <td>{!!(!empty($HR_Company_reference_tax_table_deduction2)? $HR_Company_reference_tax_table_deduction2->one : '' )!!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction2)? $HR_Company_reference_tax_table_deduction2->two : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction2)? $HR_Company_reference_tax_table_deduction2->three : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction2)? $HR_Company_reference_tax_table_deduction2->four : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction2)? $HR_Company_reference_tax_table_deduction2->five : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction2)? $HR_Company_reference_tax_table_deduction2->six : '' !!}</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-bordered" style="margin-top:10px;">
                    <thead style="background-color:#124f62;color:white">
                    <tr><th colspan="10">Tax Table <button class="btn btn-success btn-sm" onclick="EditTaxTableTable('2','WEEKLY')"><i class="fa fa-pencil" aria-hidden="true"></i></button></th></tr>
                      <tr>
                      <th width="16%">1</th>
                      <th width="16%">2</th>
                      <th width="16%">3</th>
                      <th width="16%">4</th>
                      <th width="16%">5</th>
                      <th width="16%">6</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <td>{{!empty($HR_Company_reference_tax_tax_table2)? $HR_Company_reference_tax_tax_table2->one : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table2)? $HR_Company_reference_tax_tax_table2->two : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table2)? $HR_Company_reference_tax_tax_table2->three : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table2)? $HR_Company_reference_tax_tax_table2->four : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table2)? $HR_Company_reference_tax_tax_table2->five : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table2)? $HR_Company_reference_tax_tax_table2->six : '' }}</td>
                      </tr>
                    </tbody>
                  </table>
                  
                  </div>
                </div>
                
                <div class="col-md-12" style="margin-top:10px;">
                <legend style="margin-top:0px;font-weight:bold;color:#083240;">SEMI-MONTHLY</legend>
                  <div class="" style="background-color:white; color:#262626;">
                  
                  <table class="table table-bordered" style="margin-top:10px;">
                    <thead style="background-color:#124f62;color:white">
                    <tr><th colspan="10">Deduction <button  class="btn btn-success btn-sm" onclick="EditTaxTableDeduction('3','SEMI-MONTHLY')"><i class="fa fa-pencil" aria-hidden="true"></i></button></th></tr>
                      <tr>
                      <th width="16%">1</th>
                      <th width="16%">2</th>
                      <th width="16%">3</th>
                      <th width="16%">4</th>
                      <th width="16%">5</th>
                      <th width="16%">6</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <td>{!!(!empty($HR_Company_reference_tax_table_deduction3)? $HR_Company_reference_tax_table_deduction3->one : '' )!!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction3)? $HR_Company_reference_tax_table_deduction3->two : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction3)? $HR_Company_reference_tax_table_deduction3->three : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction3)? $HR_Company_reference_tax_table_deduction3->four : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction3)? $HR_Company_reference_tax_table_deduction3->five : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction3)? $HR_Company_reference_tax_table_deduction3->six : '' !!}</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-bordered" style="margin-top:10px;">
                    <thead style="background-color:#124f62;color:white">
                    <tr><th colspan="10">Tax Table <button  class="btn btn-success btn-sm" onclick="EditTaxTableTable('3','SEMI-MONTHLY')"><i class="fa fa-pencil" aria-hidden="true"></i></button></th></tr>
                      <tr>
                      <th width="16%">1</th>
                      <th width="16%">2</th>
                      <th width="16%">3</th>
                      <th width="16%">4</th>
                      <th width="16%">5</th>
                      <th width="16%">6</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <td>{{!empty($HR_Company_reference_tax_tax_table3)? $HR_Company_reference_tax_tax_table3->one : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table3)? $HR_Company_reference_tax_tax_table3->two : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table3)? $HR_Company_reference_tax_tax_table3->three : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table3)? $HR_Company_reference_tax_tax_table3->four : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table3)? $HR_Company_reference_tax_tax_table3->five : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table3)? $HR_Company_reference_tax_tax_table3->six : '' }}</td>
                      </tr>
                    </tbody>
                  </table>
                  
                  </div>
                </div>
                
                <div class="col-md-12" style="margin-top:10px;">
                <legend style="margin-top:0px;font-weight:bold;color:#083240;">MONTHLY</legend>
                  <div class="" style="background-color:white; color:#262626;">
                  
                  <table class="table table-bordered" style="margin-top:10px;">
                    <thead style="background-color:#124f62;color:white">
                    <tr><th colspan="10">Deduction <button  class="btn btn-success btn-sm" onclick="EditTaxTableDeduction('4','MONTHLY')"><i class="fa fa-pencil" aria-hidden="true"></i></button></th></tr>
                      <tr>
                      <th width="16%">1</th>
                      <th width="16%">2</th>
                      <th width="16%">3</th>
                      <th width="16%">4</th>
                      <th width="16%">5</th>
                      <th width="16%">6</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <td>{!!(!empty($HR_Company_reference_tax_table_deduction4)? $HR_Company_reference_tax_table_deduction4->one : '' )!!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction4)? $HR_Company_reference_tax_table_deduction4->two : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction4)? $HR_Company_reference_tax_table_deduction4->three : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction4)? $HR_Company_reference_tax_table_deduction4->four : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction4)? $HR_Company_reference_tax_table_deduction4->five : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction4)? $HR_Company_reference_tax_table_deduction4->six : '' !!}</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-bordered" style="margin-top:10px;">
                    <thead style="background-color:#124f62;color:white">
                    <tr><th colspan="10">Tax Table <button  class="btn btn-success btn-sm" onclick="EditTaxTableTable('4','MONTHLY')"><i class="fa fa-pencil" aria-hidden="true"></i></button></th></tr>
                      <tr>
                      <th width="16%">1</th>
                      <th width="16%">2</th>
                      <th width="16%">3</th>
                      <th width="16%">4</th>
                      <th width="16%">5</th>
                      <th width="16%">6</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <td>{{!empty($HR_Company_reference_tax_tax_table4)? $HR_Company_reference_tax_tax_table4->one : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table4)? $HR_Company_reference_tax_tax_table4->two : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table4)? $HR_Company_reference_tax_tax_table4->three : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table4)? $HR_Company_reference_tax_tax_table4->four : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table4)? $HR_Company_reference_tax_tax_table4->five : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table4)? $HR_Company_reference_tax_tax_table4->six : '' }}</td>
                      </tr>
                    </tbody>
                  </table>
                  
                  </div>
                </div>
                
                <div class="col-md-12" style="margin-top:10px;">
                <legend style="margin-top:0px;font-weight:bold;color:#083240;">BI-WEEKLY</legend>
                  <div class="" style="background-color:white; color:#262626;">
                  
                  <table class="table table-bordered" style="margin-top:10px;">
                    <thead style="background-color:#124f62;color:white">
                    <tr><th colspan="10">Deduction <button class="btn btn-success btn-sm" onclick="EditTaxTableDeduction('5','BI-WEEKLY')"><i class="fa fa-pencil" aria-hidden="true"></i></button></th></tr>
                      <tr>
                      <th width="16%">1</th>
                      <th width="16%">2</th>
                      <th width="16%">3</th>
                      <th width="16%">4</th>
                      <th width="16%">5</th>
                      <th width="16%">6</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <td>{!!(!empty($HR_Company_reference_tax_table_deduction5)? $HR_Company_reference_tax_table_deduction5->one : '' )!!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction5)? $HR_Company_reference_tax_table_deduction5->two : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction5)? $HR_Company_reference_tax_table_deduction5->three : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction5)? $HR_Company_reference_tax_table_deduction5->four : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction5)? $HR_Company_reference_tax_table_deduction5->five : '' !!}</td>
                      <td>{!! !empty($HR_Company_reference_tax_table_deduction5)? $HR_Company_reference_tax_table_deduction5->six : '' !!}</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-bordered" style="margin-top:10px;">
                    <thead style="background-color:#124f62;color:white">
                    <tr><th colspan="10">Tax Table <button  class="btn btn-success btn-sm" onclick="EditTaxTableTable('5','BI-WEEKLY')"><i class="fa fa-pencil" aria-hidden="true"></i></button></th></tr>
                      <tr>
                      <th width="16%">1</th>
                      <th width="16%">2</th>
                      <th width="16%">3</th>
                      <th width="16%">4</th>
                      <th width="16%">5</th>
                      <th width="16%">6</th>
                      
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <td>{{!empty($HR_Company_reference_tax_tax_table5)? $HR_Company_reference_tax_tax_table5->one : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table5)? $HR_Company_reference_tax_tax_table5->two : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table5)? $HR_Company_reference_tax_tax_table5->three : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table5)? $HR_Company_reference_tax_tax_table5->four : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table5)? $HR_Company_reference_tax_tax_table5->five : '' }}</td>
                      <td>{{!empty($HR_Company_reference_tax_tax_table5)? $HR_Company_reference_tax_tax_table5->six : '' }}</td>
                      </tr>
                    </tbody>
                  </table>
                  
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='5'? 'active show' : '' )}}" id="TAXTABLEANNUAL" role="tabpanel" aria-labelledby="home-tab">
            <h2 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">TAX TABLE ANNUAL</h2>
            <div class="container-fluid" style="padding-bottom:10px;" >
                <table class="table table-bordered" >
                    <thead style="background-color:#124f62;color:white">
                    <tr><th colspan="10">Deduction</th></tr>
                      <tr>
                        <th width="25%">From</th>
                        <th width="25%">To</th>
                        <th width="25%">Fix</th>
                        <th width="25%">Rate</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>₱ 0.00</td>
                        <td>₱ 250,000.00</td>
                        <td>₱ 0.00</td>
                        <td>0%</td>
                      </tr>
                      <tr>
                        <td>₱ 250,000.01</td>
                        <td>₱ 400,000.00</td>
                        <td>₱ 0.00</td>
                        <td>20%</td>
                      </tr>
                      <tr>
                        <td>₱400,000.01</td>
                        <td>₱ 800,000.00</td>
                        <td>₱ 30,000.00</td>
                        <td>25%</td>
                      </tr>
                       <tr>
                        <td>₱800,000.01</td>
                        <td>₱ 2,000,000.00</td>
                        <td>₱ 130,000.00</td>
                        <td>30%</td>
                      </tr>
                       <tr>
                        <td>₱2,000,000.01</td>
                        <td>₱ 8,000,000.00</td>
                        <td>₱ 490,000.00</td>
                        <td>32%</td>
                      </tr>
                       <tr>
                        <td>₱8,000,000.01</td>
                        <td>₱ 1,000,000,000.00</td>
                        <td>₱ 2,410,000.00</td>
                        <td>35%</td>
                      </tr>
                      
                      
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='6'? 'active show' : '' )}}" id="PHILHEALTH" role="tabpanel" aria-labelledby="profile-tab">
            <h2 style="margin-bottom:0px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">PHILHEALTH</h2>
            <div class="container-fluid" style="padding-bottom:10px;">
                <table class="table table-bordered" style="margin-top:10px;">
                    <thead style="background-color:#124f62;color:white">
                    
                      <tr>
                        <th width="25%">Monthly Basic Salary x 2.75%</th>
                        <th width="25%">Monthly Premium</th>
                        <th width="25%">Personal Share</th>
                        <th width="25%">Employee Share</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>₱ 10,000.00 and below</td>
                        <td>₱ 275.00</td>
                        <td>₱ 137.50</td>
                        <td>₱ 137.50</td>
                      </tr>
                      <tr>
                        <td>₱ 10,000.01 to ₱ 39.999.99</td>
                        <td>₱ 275.02 to ₱ 1,099.99</td>
                        <td>₱ 137.51 to ₱ 549.99</td>
                        <td>₱ 137.51 to ₱ 549.99</td>
                      </tr>
                      <tr>
                        <td>₱ 40,000.00 and above</td>
                        <td>₱ 1,100.00</td>
                        <td>₱ 550.00</td>
                        <td>₱ 550.00</td>
                      </tr>
                      
                      
                      
                      
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='7'? 'active show' : '' )}}" id="SSS" role="tabpanel" aria-labelledby="contact-tab">
            <h2 style="margin-bottom:0px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">SSS</h2>
            <div class="container-fluid" style="padding-top:10px;padding-bottom:10px;">
            <script>
                $(document).ready(function(){
                    $("#sss_reference_form :input").prop("disabled", true);
                    $("#sss_reference_form").submit(function(e) {
                    e.preventDefault();
                        $.ajax({
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'update_sss_table',                
                        data: $('#sss_reference_form').serialize(),
                        success: function(data) {
                            console.log(data);
                            Swal.fire({
                            type: 'success',
                            title: 'Success',
                            text: 'Successfully Updated SSS Table',
                            
                            }).then((result) => {
                                location.href="setup_references?page=7";
                            })

                        }  

                        })
                    });
                });
            </script>
            <div class="row">
                <div class="col-md-12" style="text-align:right;">
                    <button class="btn btn-success" onclick="enable_input_form('sss_reference_form')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Data</button>
                </div>
            </div>
            <form id="sss_reference_form">
            <table class="table table-bordered" style="margin-top:10px;">
                <thead style="background-color:#124f62;color:white">
                
                  <tr>
                    <th width="11%">Min. Range</th>
                    <th width="11%">Max Range</th>
                    <th width="11%">Monthly Salary Credit</th>
                    <th width="11%">SS-ER</th>
                    <th width="11%">SS-EE</th>
                    <th width="11%">SS-Total</th>
                    <th width="11%">EC-ER</th>
                    <th width="11%">Total Contribution</th>
                    <th width="11%">SE/VM/OFW Total Contribution</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                  <td style="padding:0px;"><input id="aaa1" name="AAA1" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table1)? $reference_sss_table1->min_range : '1000.00')}}"></td>
                  <td style="padding:0px;"><input id="sss1" name="SSS1" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table1)? $reference_sss_table1->max_range : '1249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd1" name="DDD1" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table1)? $reference_sss_table1->monthly_salary_credit : '1000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff1" name="FFF1" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table1)? $reference_sss_table1->ss_er : '73.70')}}"></td>
                  <td style="padding:0px;"><input id="ggg1" name="GGG1" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table1)? $reference_sss_table1->ss_ee : '36.30')}}"></td>
                  <td style="padding:0px;"><input id="hhh1" name="HHH1" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table1)? $reference_sss_table1->ss_total : '110.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj1" name="JJJ1" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table1) ?$reference_sss_table1->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk1" name="KKK1" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table1) ?$reference_sss_table1->total_contribution : '120.00')}}"></td>
                  <td style="padding:0px;"><input id="lll1" name="LLL1" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table1)? $reference_sss_table1->seumofw_total_contribution : '110.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa2" name="AAA2" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table2) ?$reference_sss_table2->min_range : '1250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss2" name="SSS2" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table2)? $reference_sss_table2->max_range : '1749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd2" name="DDD2" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table2)? $reference_sss_table2->monthly_salary_credit : '1500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff2" name="FFF2" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table2)? $reference_sss_table2->ss_er : '110.50')}}"></td>
                  <td style="padding:0px;"><input id="ggg2" name="GGG2" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table2)? $reference_sss_table2->ss_ee : '54.50')}}"></td>
                  <td style="padding:0px;"><input id="hhh2" name="HHH2" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table2)? $reference_sss_table2->ss_total : '165.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj2" name="JJJ2" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table2) ?$reference_sss_table2->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk2" name="KKK2" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table2)? $reference_sss_table2->total_contribution : '175.00')}}"></td>
                  <td style="padding:0px;"><input id="lll2" name="LLL2" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table2) ?$reference_sss_table2->seumofw_total_contribution : '165.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa3" name="AAA3" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table3)? $reference_sss_table3->min_range : '1750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss3" name="SSS3" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table3)? $reference_sss_table3->max_range : '2249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd3" name="DDD3" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table3)? $reference_sss_table3->monthly_salary_credit : '2000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff3" name="FFF3" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table3)? $reference_sss_table3->ss_er : '147.30')}}"></td>
                  <td style="padding:0px;"><input id="ggg3" name="GGG3" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table3)? $reference_sss_table3->ss_ee : '72.70')}}"></td>
                  <td style="padding:0px;"><input id="hhh3" name="HHH3" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table3)? $reference_sss_table3->ss_total : '220.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj3" name="JJJ3" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table3)? $reference_sss_table3->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk3" name="KKK3" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table3)? $reference_sss_table3->total_contribution : '230.00')}}"></td>
                  <td style="padding:0px;"><input id="lll3" name="LLL3" step="0.01" style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table3)? $reference_sss_table3->seumofw_total_contribution : '220.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa4" name="AAA4" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table4)? $reference_sss_table4->min_range : '2250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss4" name="SSS4" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table4) ?$reference_sss_table4->max_range : '2749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd4" name="DDD4" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table4) ?$reference_sss_table4->monthly_salary_credit : '2500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff4" name="FFF4" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table4) ?$reference_sss_table4->ss_er : '184.20')}}"></td>
                  <td style="padding:0px;"><input id="ggg4" name="GGG4" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table4) ?$reference_sss_table4->ss_ee : '90.80')}}"></td>
                  <td style="padding:0px;"><input id="hhh4" name="HHH4" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table4) ?$reference_sss_table4->ss_total : '275.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj4" name="JJJ4" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table4) ?$reference_sss_table4->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk4" name="KKK4" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table4) ?$reference_sss_table4->total_contribution : '285.00')}}"></td>
                  <td style="padding:0px;"><input id="lll4" name="LLL4" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table4) ?$reference_sss_table4->seumofw_total_contribution : '275.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa5" name="AAA5" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table5)? $reference_sss_table5->min_range : '2750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss5" name="SSS5" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table5)? $reference_sss_table5->max_range : '3249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd5" name="DDD5" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table5)? $reference_sss_table5->monthly_salary_credit : '3000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff5" name="FFF5" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table5)? $reference_sss_table5->ss_er : '221.00')}}"></td>
                  <td style="padding:0px;"><input id="ggg5" name="GGG5" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table5)? $reference_sss_table5->ss_ee : '109.00')}}"></td>
                  <td style="padding:0px;"><input id="hhh5" name="HHH5" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table5)? $reference_sss_table5->ss_total : '330.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj5" name="JJJ5" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table5)? $reference_sss_table5->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk5" name="KKK5" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table5)? $reference_sss_table5->total_contribution : '340.00')}}"></td>
                  <td style="padding:0px;"><input id="lll5" name="LLL5" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table5)? $reference_sss_table5->seumofw_total_contribution : '330.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa6" name="AAA6" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table6)? $reference_sss_table6->min_range : '3250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss6" name="SSS6" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table6)? $reference_sss_table6->max_range : '3749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd6" name="DDD6" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table6)? $reference_sss_table6->monthly_salary_credit : '3500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff6" name="FFF6" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table6)? $reference_sss_table6->ss_er : '257.80')}}"></td>
                  <td style="padding:0px;"><input id="ggg6" name="GGG6" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table6)? $reference_sss_table6->ss_ee : '127.20')}}"></td>
                  <td style="padding:0px;"><input id="hhh6" name="HHH6" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table6)? $reference_sss_table6->ss_total : '385.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj6" name="JJJ6" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table6)? $reference_sss_table6->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk6" name="KKK6" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table6)? $reference_sss_table6->total_contribution : '395.00')}}"></td>
                  <td style="padding:0px;"><input id="lll6" name="LLL6" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table6)? $reference_sss_table6->seumofw_total_contribution : '385.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa7" name="AAA7" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table7)? $reference_sss_table7->min_range : '3750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss7" name="SSS7" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table7)? $reference_sss_table7->max_range : '4249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd7" name="DDD7" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table7)? $reference_sss_table7->monthly_salary_credit : '4000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff7" name="FFF7" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table7)? $reference_sss_table7->ss_er : '294.70')}}"></td>
                  <td style="padding:0px;"><input id="ggg7" name="GGG7" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table7)? $reference_sss_table7->ss_ee : '145.30')}}"></td>
                  <td style="padding:0px;"><input id="hhh7" name="HHH7" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table7)? $reference_sss_table7->ss_total : '440.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj7" name="JJJ7" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table7)? $reference_sss_table7->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk7" name="KKK7" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table7)? $reference_sss_table7->total_contribution : '450.00')}}"></td>
                  <td style="padding:0px;"><input id="lll7" name="LLL7" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table7)? $reference_sss_table7->seumofw_total_contribution : '440.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa8" name="AAA8" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table8)? $reference_sss_table8->min_range : '4250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss8" name="SSS8" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table8)? $reference_sss_table8->max_range : '4749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd8" name="DDD8" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table8)? $reference_sss_table8->monthly_salary_credit : '4500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff8" name="FFF8" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table8)? $reference_sss_table8->ss_er : '331.50')}}"></td>
                  <td style="padding:0px;"><input id="ggg8" name="GGG8" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table8)? $reference_sss_table8->ss_ee : '495.00')}}"></td>
                  <td style="padding:0px;"><input id="hhh8" name="HHH8" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table8)? $reference_sss_table8->ss_total : '495.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj8" name="JJJ8" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table8)? $reference_sss_table8->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk8" name="KKK8" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table8)? $reference_sss_table8->total_contribution : '505.00')}}"></td>
                  <td style="padding:0px;"><input id="lll8" name="LLL8" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table8)? $reference_sss_table8->seumofw_total_contribution : '495.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa9" name="AAA9" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table9)? $reference_sss_table9->min_range : '4750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss9" name="SSS9" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table9)? $reference_sss_table9->max_range : '5249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd9" name="DDD9" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table9)? $reference_sss_table9->monthly_salary_credit : '5000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff9" name="FFF9" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table9)? $reference_sss_table9->ss_er : '368.30')}}"></td>
                  <td style="padding:0px;"><input id="ggg9" name="GGG9" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table9)? $reference_sss_table9->ss_ee : '181.70')}}"></td>
                  <td style="padding:0px;"><input id="hhh9" name="HHH9" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table9)? $reference_sss_table9->ss_total : '550.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj9" name="JJJ9" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table9)? $reference_sss_table9->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk9" name="KKK9" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table9)? $reference_sss_table9->total_contribution : '550.00')}}"></td>
                  <td style="padding:0px;"><input id="lll9" name="LLL9" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table9)? $reference_sss_table9->seumofw_total_contribution : '550.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa10" name="AAA10" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table10)? $reference_sss_table10->min_range : '5250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss10" name="SSS10" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table10)? $reference_sss_table10->max_range : '5749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd10" name="DDD10" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table10)? $reference_sss_table10->monthly_salary_credit : '5500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff10" name="FFF10" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table10)? $reference_sss_table10->ss_er : '405.20')}}"></td>
                  <td style="padding:0px;"><input id="ggg10" name="GGG10" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table10)? $reference_sss_table10->ss_ee : '199.80')}}"></td>
                  <td style="padding:0px;"><input id="hhh10" name="HHH10" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table10)? $reference_sss_table10->ss_total : '605.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj10" name="JJJ10" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table10)? $reference_sss_table10->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk10" name="KKK10" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table10)? $reference_sss_table10->total_contribution : '615.00')}}"></td>
                  <td style="padding:0px;"><input id="lll10" name="LLL10" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table10)? $reference_sss_table10->seumofw_total_contribution : '605.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa11" name="AAA11" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table11)? $reference_sss_table11->min_range : '5750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss11" name="SSS11" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table11)? $reference_sss_table11->max_range : '6249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd11" name="DDD11" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table11)? $reference_sss_table11->monthly_salary_credit : '6000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff11" name="FFF11" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table11)? $reference_sss_table11->ss_er : '442.00')}}"></td>
                  <td style="padding:0px;"><input id="ggg11" name="GGG11" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table11)? $reference_sss_table11->ss_ee : '218.00')}}"></td>
                  <td style="padding:0px;"><input id="hhh11" name="HHH11" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table11)? $reference_sss_table11->ss_total : '660.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj11" name="JJJ11" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table11)? $reference_sss_table11->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk11" name="KKK11" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table11)? $reference_sss_table11->total_contribution : '670.00')}}"></td>
                  <td style="padding:0px;"><input id="lll11" name="LLL11" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table11)? $reference_sss_table11->seumofw_total_contribution : '660.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa12" name="AAA12" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table12)? $reference_sss_table12->min_range : '6250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss12" name="SSS12" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table12)? $reference_sss_table12->max_range : '6749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd12" name="DDD12" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table12)? $reference_sss_table12->monthly_salary_credit : '6500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff12" name="FFF12" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table12)? $reference_sss_table12->ss_er : '478.80')}}"></td>
                  <td style="padding:0px;"><input id="ggg12" name="GGG12" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table12)? $reference_sss_table12->ss_ee : '236.20')}}"></td>
                  <td style="padding:0px;"><input id="hhh12" name="HHH12" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table12)? $reference_sss_table12->ss_total : '715.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj12" name="JJJ12" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table12)? $reference_sss_table12->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk12" name="KKK12" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table12)? $reference_sss_table12->total_contribution : '725.00')}}"></td>
                  <td style="padding:0px;"><input id="lll12" name="LLL12" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table12)? $reference_sss_table12->seumofw_total_contribution : '715.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa13" name="AAA13" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table13)? $reference_sss_table13->min_range : '6250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss13" name="SSS13" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table13)? $reference_sss_table13->max_range : '7249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd13" name="DDD13" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table13)? $reference_sss_table13->monthly_salary_credit : '7000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff13" name="FFF13" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table13)? $reference_sss_table13->ss_er : '515.70')}}"></td>
                  <td style="padding:0px;"><input id="ggg13" name="GGG13" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table13)? $reference_sss_table13->ss_ee : '254.30')}}"></td>
                  <td style="padding:0px;"><input id="hhh13" name="HHH13" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table13)? $reference_sss_table13->ss_total : '770.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj13" name="JJJ13" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table13)? $reference_sss_table13->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk13" name="KKK13" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table13)? $reference_sss_table13->total_contribution : '780.00')}}"></td>
                  <td style="padding:0px;"><input id="lll13" name="LLL13" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table13)? $reference_sss_table13->seumofw_total_contribution : '770.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa14" name="AAA14" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table14)? $reference_sss_table14->min_range : '7250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss14" name="SSS14" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table14)? $reference_sss_table14->max_range : '7749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd14" name="DDD14" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table14)? $reference_sss_table14->monthly_salary_credit : '7500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff14" name="FFF14" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table14)? $reference_sss_table14->ss_er : '552.50')}}"></td>
                  <td style="padding:0px;"><input id="ggg14" name="GGG14" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table14)? $reference_sss_table14->ss_ee : '272.50')}}"></td>
                  <td style="padding:0px;"><input id="hhh14" name="HHH14" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table14)? $reference_sss_table14->ss_total : '825.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj14" name="JJJ14" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table14)? $reference_sss_table14->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk14" name="KKK14" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table14)? $reference_sss_table14->total_contribution : '835.00')}}"></td>
                  <td style="padding:0px;"><input id="lll14" name="LLL14" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table14)? $reference_sss_table14->seumofw_total_contribution : '825.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa15" name="AAA15" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table15)? $reference_sss_table15->min_range : '7750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss15" name="SSS15" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table15)? $reference_sss_table15->max_range : '8249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd15" name="DDD15" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table15)? $reference_sss_table15->monthly_salary_credit : '8000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff15" name="FFF15" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table15)? $reference_sss_table15->ss_er : '290.70')}}290.70"></td>
                  <td style="padding:0px;"><input id="ggg15" name="GGG15" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table15)? $reference_sss_table15->ss_ee : '290.70')}}"></td>
                  <td style="padding:0px;"><input id="hhh15" name="HHH15" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table15)? $reference_sss_table15->ss_total : '880.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj15" name="JJJ15" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table15)? $reference_sss_table15->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk15" name="KKK15" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table15)? $reference_sss_table15->total_contribution : '890.00')}}"></td>
                  <td style="padding:0px;"><input id="lll15" name="LLL15" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table15)? $reference_sss_table15->seumofw_total_contribution : '880.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa16" name="AAA16" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table16)? $reference_sss_table16->min_range : '8250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss16" name="SSS16" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table16)? $reference_sss_table16->max_range : '8749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd16" name="DDD16" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table16)? $reference_sss_table16->monthly_salary_credit : '8500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff16" name="FFF16" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table16)? $reference_sss_table16->ss_er : '626.20')}}"></td>
                  <td style="padding:0px;"><input id="ggg16" name="GGG16" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table16)? $reference_sss_table16->ss_ee : '308.80')}}"></td>
                  <td style="padding:0px;"><input id="hhh16" name="HHH16" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table16)? $reference_sss_table16->ss_total : '935.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj16" name="JJJ16" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table16)? $reference_sss_table16->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk16" name="KKK16" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table16)? $reference_sss_table16->total_contribution : '945.00')}}"></td>
                  <td style="padding:0px;"><input id="lll16" name="LLL16" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table16)? $reference_sss_table16->seumofw_total_contribution : '935.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa17" name="AAA17" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table17)? $reference_sss_table17->min_range : '8750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss17" name="SSS17" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table17)? $reference_sss_table17->max_range : '9249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd17" name="DDD17" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table17)? $reference_sss_table17->monthly_salary_credit : '9000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff17" name="FFF17" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table17)? $reference_sss_table17->ss_er : '663.30')}}"></td>
                  <td style="padding:0px;"><input id="ggg17" name="GGG17" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table17)? $reference_sss_table17->ss_ee : '327.00')}}"></td>
                  <td style="padding:0px;"><input id="hhh17" name="HHH17" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table17)? $reference_sss_table17->ss_total : '990.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj17" name="JJJ17" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table17)? $reference_sss_table17->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk17" name="KKK17" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table17)? $reference_sss_table17->total_contribution : '1000.00')}}"></td>
                  <td style="padding:0px;"><input id="lll17" name="LLL17" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table17)? $reference_sss_table17->seumofw_total_contribution : '990.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa18" name="AAA18" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table18)? $reference_sss_table18->min_range : '9250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss18" name="SSS18" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table18)? $reference_sss_table18->max_range : '9749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd18" name="DDD18" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table18)? $reference_sss_table18->monthly_salary_credit : '9500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff18" name="FFF18" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table18)? $reference_sss_table18->ss_er : '699.80')}}"></td>
                  <td style="padding:0px;"><input id="ggg18" name="GGG18" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table18)? $reference_sss_table18->ss_ee : '345.20')}}"></td>
                  <td style="padding:0px;"><input id="hhh18" name="HHH18" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table18)? $reference_sss_table18->ss_total : '1045.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj18" name="JJJ18" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table18)? $reference_sss_table18->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk18" name="KKK18" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table18)? $reference_sss_table18->total_contribution : '1055.00')}}"></td>
                  <td style="padding:0px;"><input id="lll18" name="LLL18" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table18)? $reference_sss_table18->seumofw_total_contribution : '1045.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa19" name="AAA19" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table19)? $reference_sss_table19->min_range : '9750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss19" name="SSS19" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table19)? $reference_sss_table19->max_range : '10249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd19" name="DDD19" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table19)? $reference_sss_table19->monthly_salary_credit : '10000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff19" name="FFF19" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table19)? $reference_sss_table19->ss_er : '736.70')}}"></td>
                  <td style="padding:0px;"><input id="ggg19" name="GGG19" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table19)? $reference_sss_table19->ss_ee : '363.30')}}"></td>
                  <td style="padding:0px;"><input id="hhh19" name="HHH19" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table19)? $reference_sss_table19->ss_total : '1100.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj19" name="JJJ19" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table19)? $reference_sss_table19->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk19" name="KKK19" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table19)? $reference_sss_table19->total_contribution : '1110.00')}}"></td>
                  <td style="padding:0px;"><input id="lll19" name="LLL19" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table19)? $reference_sss_table19->seumofw_total_contribution : '1000.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa20" name="AAA20" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table20)? $reference_sss_table20->min_range : '10250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss20" name="SSS20" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table20)? $reference_sss_table20->max_range : '10749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd20" name="DDD20" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table20)? $reference_sss_table20->monthly_salary_credit : '10500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff20" name="FFF20" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table20)? $reference_sss_table20->ss_er : '773.50')}}"></td>
                  <td style="padding:0px;"><input id="ggg20" name="GGG20" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table20)? $reference_sss_table20->ss_ee : '381.50')}}"></td>
                  <td style="padding:0px;"><input id="hhh20" name="HHH20" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table20)? $reference_sss_table20->ss_total : '1155.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj20" name="JJJ20" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table20)? $reference_sss_table20->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk20" name="KKK20" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table20)? $reference_sss_table20->total_contribution : '1165.00')}}"></td>
                  <td style="padding:0px;"><input id="lll20" name="LLL20" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table20)? $reference_sss_table20->seumofw_total_contribution : '1155.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa21" name="AAA21" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table21)? $reference_sss_table21->min_range : '10750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss21" name="SSS21" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table21)? $reference_sss_table21->max_range : '11249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd21" name="DDD21" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table21)? $reference_sss_table21->monthly_salary_credit : '11000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff21" name="FFF21" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table21)? $reference_sss_table21->ss_er : '810.30')}}"></td>
                  <td style="padding:0px;"><input id="ggg21" name="GGG21" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table21)? $reference_sss_table21->ss_ee : '399.70')}}"></td>
                  <td style="padding:0px;"><input id="hhh21" name="HHH21" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table21)? $reference_sss_table21->ss_total : '1210.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj21" name="JJJ21" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table21)? $reference_sss_table21->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk21" name="KKK21" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table21)? $reference_sss_table21->total_contribution : '1220.00')}}"></td>
                  <td style="padding:0px;"><input id="lll21" name="LLL21" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table21)? $reference_sss_table21->seumofw_total_contribution : '1210.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa22" name="AAA22" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table22)? $reference_sss_table22->min_range : '11250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss22" name="SSS22" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table22)? $reference_sss_table22->max_range : '11749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd22" name="DDD22" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table22)? $reference_sss_table22->monthly_salary_credit : '11500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff22" name="FFF22" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table22)? $reference_sss_table22->ss_er : '847.20')}}"></td>
                  <td style="padding:0px;"><input id="ggg22" name="GGG22" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table22)? $reference_sss_table22->ss_ee : '417.80')}}"></td>
                  <td style="padding:0px;"><input id="hhh22" name="HHH22" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table22)? $reference_sss_table22->ss_total : '1265.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj22" name="JJJ22" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table22)? $reference_sss_table22->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk22" name="KKK22" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table22)? $reference_sss_table22->total_contribution : '1275.00')}}"></td>
                  <td style="padding:0px;"><input id="lll22" name="LLL22" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table22)? $reference_sss_table22->seumofw_total_contribution : '1265.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa23" name="AAA23" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table23)? $reference_sss_table23->min_range : '11750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss23" name="SSS23" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table23)? $reference_sss_table23->max_range : '12249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd23" name="DDD23" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table23)? $reference_sss_table23->monthly_salary_credit : '12000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff23" name="FFF23" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table23)? $reference_sss_table23->ss_er : '884.00')}}"></td>
                  <td style="padding:0px;"><input id="ggg23" name="GGG23" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table23)? $reference_sss_table23->ss_ee : '436.00')}}"></td>
                  <td style="padding:0px;"><input id="hhh23" name="HHH23" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table23)? $reference_sss_table23->ss_total : '1320.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj23" name="JJJ23" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table23)? $reference_sss_table23->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk23" name="KKK23" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table23)? $reference_sss_table23->total_contribution : '1330.00')}}"></td>
                  <td style="padding:0px;"><input id="lll23" name="LLL23" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table23)? $reference_sss_table23->seumofw_total_contribution : '1320.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa24" name="AAA24" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table24)? $reference_sss_table24->min_range : '12250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss24" name="SSS24" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table24)? $reference_sss_table24->max_range : '12749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd24" name="DDD24" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table24)? $reference_sss_table24->monthly_salary_credit : '12500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff24" name="FFF24" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table24)? $reference_sss_table24->ss_er : '920.80')}}"></td>
                  <td style="padding:0px;"><input id="ggg24" name="GGG24" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table24)? $reference_sss_table24->ss_ee : '454.20')}}"></td>
                  <td style="padding:0px;"><input id="hhh24" name="HHH24" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table24)? $reference_sss_table24->ss_total : '1375.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj24" name="JJJ24" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table24)? $reference_sss_table24->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk24" name="KKK24" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table24)? $reference_sss_table24->total_contribution : '1385.00')}}"></td>
                  <td style="padding:0px;"><input id="lll24" name="LLL24" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table24)? $reference_sss_table24->seumofw_total_contribution : '1375.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa25" name="AAA25" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table25)? $reference_sss_table25->min_range : '12750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss25" name="SSS25" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table25)? $reference_sss_table25->max_range : '13249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd25" name="DDD25" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table25)? $reference_sss_table25->monthly_salary_credit : '13000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff25" name="FFF25" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table25)? $reference_sss_table25->ss_er : '957.70')}}"></td>
                  <td style="padding:0px;"><input id="ggg25" name="GGG25" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table25)? $reference_sss_table25->ss_ee : '472.30')}}"></td>
                  <td style="padding:0px;"><input id="hhh25" name="HHH25" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table25)? $reference_sss_table25->ss_total : '1430.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj25" name="JJJ25" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table25)? $reference_sss_table25->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk25" name="KKK25" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table25)? $reference_sss_table25->total_contribution : '1440.00')}}"></td>
                  <td style="padding:0px;"><input id="lll25" name="LLL25" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table25)? $reference_sss_table25->seumofw_total_contribution : '1430.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa26" name="AAA26" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table26)? $reference_sss_table26->min_range : '13250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss26" name="SSS26" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table26)? $reference_sss_table26->max_range : '13749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd26" name="DDD26" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table26)? $reference_sss_table26->monthly_salary_credit : '13500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff26" name="FFF26" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table26)? $reference_sss_table26->ss_er : '490.50')}}"></td>
                  <td style="padding:0px;"><input id="ggg26" name="GGG26" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table26)? $reference_sss_table26->ss_ee : '490.50')}}"></td>
                  <td style="padding:0px;"><input id="hhh26" name="HHH26" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table26)? $reference_sss_table26->ss_total : '1485.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj26" name="JJJ26" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table26)? $reference_sss_table26->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk26" name="KKK26" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table26)? $reference_sss_table26->total_contribution : '1495.00')}}"></td>
                  <td style="padding:0px;"><input id="lll26" name="LLL26" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table26)? $reference_sss_table26->seumofw_total_contribution : '1485.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa27" name="AAA27" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table27)? $reference_sss_table27->min_range : '13750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss27" name="SSS27" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table27)? $reference_sss_table27->max_range : '14249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd27" name="DDD27" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table27)? $reference_sss_table27->monthly_salary_credit : '1031.30')}}"></td>
                  <td style="padding:0px;"><input id="fff27" name="FFF27" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table27)? $reference_sss_table27->ss_er : '1031.30')}}"></td>
                  <td style="padding:0px;"><input id="ggg27" name="GGG27" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table27)? $reference_sss_table27->ss_ee : '508.70')}}"></td>
                  <td style="padding:0px;"><input id="hhh27" name="HHH27" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table27)? $reference_sss_table27->ss_total : '1540.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj27" name="JJJ27" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table27)? $reference_sss_table27->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk27" name="KKK27" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table27)? $reference_sss_table27->total_contribution : '1550.00')}}"></td>
                  <td style="padding:0px;"><input id="lll27" name="LLL27" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table27)? $reference_sss_table27->seumofw_total_contribution : '1540.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa28" name="AAA28" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table28)? $reference_sss_table28->min_range : '14250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss28" name="SSS28" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table28)? $reference_sss_table28->max_range : '14749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd28" name="DDD28" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table28)? $reference_sss_table28->monthly_salary_credit : '14500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff28" name="FFF28" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table28)? $reference_sss_table28->ss_er : '1068.20')}}"></td>
                  <td style="padding:0px;"><input id="ggg28" name="GGG28" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table28)? $reference_sss_table28->ss_ee : '526.80')}}"></td>
                  <td style="padding:0px;"><input id="hhh28" name="HHH28" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table28)? $reference_sss_table28->ss_total : '1595.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj28" name="JJJ28" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table28)? $reference_sss_table28->ec_er : '10.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk28" name="KKK28" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table28)? $reference_sss_table28->total_contribution : '1605.00')}}"></td>
                  <td style="padding:0px;"><input id="lll28" name="LLL28" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table28)? $reference_sss_table28->seumofw_total_contribution : '1595.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa29" name="AAA29" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table29)? $reference_sss_table29->min_range : '14750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss29" name="SSS29" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table29)? $reference_sss_table29->max_range : '15249.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd29" name="DDD29" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table29)? $reference_sss_table29->monthly_salary_credit : '15000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff29" name="FFF29" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table29)? $reference_sss_table29->ss_er : '1105.00')}}"></td>
                  <td style="padding:0px;"><input id="ggg29" name="GGG29" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table29)? $reference_sss_table29->ss_ee : '545.00')}}"></td>
                  <td style="padding:0px;"><input id="hhh29" name="HHH29" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table29)? $reference_sss_table29->ss_total : '1650.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj29" name="JJJ29" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table29)? $reference_sss_table29->ec_er : '30.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk29" name="KKK29" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table29)? $reference_sss_table29->total_contribution : '1680.00')}}"></td>
                  <td style="padding:0px;"><input id="lll29" name="LLL29" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table29)? $reference_sss_table29->seumofw_total_contribution : '1650.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa30" name="AAA30" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table30)? $reference_sss_table30->min_range : '15250.00')}}"></td>
                  <td style="padding:0px;"><input id="sss30" name="SSS30" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table30)? $reference_sss_table30->max_range : '15749.99')}}"></td>
                  <td style="padding:0px;"><input id="ddd30" name="DDD30" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table30)? $reference_sss_table30->monthly_salary_credit : '15500.00')}}"></td>
                  <td style="padding:0px;"><input id="fff30" name="FFF30" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table30)? $reference_sss_table30->ss_er : '1141.80')}}"></td>
                  <td style="padding:0px;"><input id="ggg30" name="GGG30" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table30)? $reference_sss_table30->ss_ee : '563.20')}}"></td>
                  <td style="padding:0px;"><input id="hhh30" name="HHH30" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table30)? $reference_sss_table30->ss_total : '1705.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj30" name="JJJ30" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table30)? $reference_sss_table30->ec_er : '30.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk30" name="KKK30" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table30)? $reference_sss_table30->total_contribution : '1735.00')}}"></td>
                  <td style="padding:0px;"><input id="lll30" name="LLL30" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table30)? $reference_sss_table30->seumofw_total_contribution : '1705.00')}}"></td>
                </tr>
                <tr>
                  <td style="padding:0px;"><input id="aaa31" name="AAA31" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table31)? $reference_sss_table31->min_range : '15750.00')}}"></td>
                  <td style="padding:0px;"><input id="sss31" name="SSS31" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table31)? $reference_sss_table31->max_range : '00.00')}}"></td>
                  <td style="padding:0px;"><input id="ddd31" name="DDD31" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table31)? $reference_sss_table31->monthly_salary_credit : '16000.00')}}"></td>
                  <td style="padding:0px;"><input id="fff31" name="FFF31" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table31)? $reference_sss_table31->ss_er : '1178.70')}}"></td>
                  <td style="padding:0px;"><input id="ggg31" name="GGG31" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table31)? $reference_sss_table31->ss_ee : '581.30')}}"></td>
                  <td style="padding:0px;"><input id="hhh31" name="HHH31" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table31)? $reference_sss_table31->ss_total : '1760.00')}}"></td>
                  <td style="padding:0px;"><input id="jjj31" name="JJJ31" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table31)? $reference_sss_table31->ec_er : '30.00')}}"></td>
                  <td style="padding:0px;"><input id="kkk31" name="KKK31" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table31)? $reference_sss_table31->total_contribution : '1790.00')}}"></td>
                  <td style="padding:0px;"><input id="lll31" name="LLL31" step="0.01"  style="border:0;box-shadow: inset 0px 0px 0px 0px red;" type="number" class="form-control" value="{{(!empty($reference_sss_table31)? $reference_sss_table31->seumofw_total_contribution : '1760.00')}}"></td>
                </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-6  col-left">
                    
                </div>
                <div class="col-md-6  col-right">
                    <div class="form-group" style="text-align:right;">
                        <input type="submit" name="SaveWorkPolicy" value="Save" class="btn btn-primary">
                        <input type="Reset" value="Reset" class="btn btn-default">
                    </div>
                </div>
                
            </div>
            </form>
            </div>
        </div>
        <div class="tab-pane fade {{($page=='8'? 'active show' : '' )}}" id="GOVTORRECORD" role="tabpanel" aria-labelledby="contact-tab">
            <h2 style="margin-bottom:0px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">GOVERNMENT OR RECORD</h2>
            <div class="container-fluid" >
              <form autocomplete="off" id="govt_or_record_form" enctype="multipart/form-data" action="add_govt_or_record_data" method="POST">
                {{ csrf_field() }}
              <div class="row">
                <div class="col-md-6">
                <table class="table borderless" style="margin-top:10px; ">
                    <style>
                    
                    </style>
                    <tbody>
                      <tr>
                      <td>Select Date Coverage : </td>
                      <td>
                          <select class="form-control" name="ORMonth">
                          <option>January</option>
                          <option>February</option>
                          <option>March</option>
                          <option>April</option>
                          <option>May</option>
                          <option>June</option>
                          <option>July</option>
                          <option>August</option>
                          <option>September</option>
                          <option>October</option>
                          <option>November</option>
                          <option>December</option>
                          </select>
                      </td>
                      <td>
                          <select class="form-control" name="ORYear">
                            @for ($i = date('Y'); $i >= 2000; $i--)
                          <option>{{$i}}</option>
                            @endfor
                          
                          </select>
                      </td>
                      <style>
                      
                      </style>
                      </tr>
                      <tr>
                      <td></td>
                      <td style="text-align:center;font-weight:bold;">SBR/OR Number</td>
                      <td style="text-align:center;font-weight:bold;">Date Paid</td>
                      <td style="text-align:center;font-weight:bold;"></td>
                      </tr>
                      <tr>
                      <td>SSS</td>
                      <td><input type="text" class="form-control" name="ORSSS1" ></td>
                      <td><input type="date" class="form-control" name="ORSSS2"></td>
                      <td>
                      <label for="excel-upload" style="opacity:1;cursor:pointer;" id="FIleImportExcelLabel" class="custom-excel-upload btn btn-default">
                        <i class="fa fa-file" aria-hidden="true"></i> Upload File
                      </label>
                      <input id="excel-upload" type="file" name="ORSSS3">
                      </td>
                      
                      </tr>
                      <tr>
                      <td>SSS Loan</td>
                      <td><input type="text" class="form-control" name="ORSSSLoan1" ></td>
                      <td><input type="date" class="form-control" name="ORSSSLoan2"></td>
                      <td>
                      <label for="excel-uploadSSS" style="opacity:1;cursor:pointer;" id="FIleImportExcelLabel" class="custom-excel-upload btn btn-default">
                        <i class="fa fa-file" aria-hidden="true"></i> Upload File
                      </label>
                      <input id="excel-uploadSSS" type="file" name="ORSSSLoan3">
                      </td>
                      </tr>
                      <tr>
                      <td>SSS Calamity Loan</td>
                      <td><input type="text" class="form-control" name="ORSSSCalamityLoan1"></td>
                      <td><input type="date" class="form-control" name="ORSSSCalamityLoan2"></td>
                      <td>
                      <label for="excel-uploadSSSCal" style="opacity:1;cursor:pointer;" id="FIleImportExcelLabel" class="custom-excel-upload btn btn-default">
                        <i class="fa fa-file" aria-hidden="true"></i> Upload File
                      </label>
                      <input id="excel-uploadSSSCal" type="file" name="ORSSSCalamityLoan3">
                      </td>
                      </tr>
                      <tr>
                      <td>PhilHealth</td>
                      <td><input type="text" class="form-control" name="ORPhilHealth1"></td>
                      <td><input type="date" class="form-control" name="ORPhilHealth2"></td>
                      <td>
                      <label for="excel-uploadPhilHealth" style="opacity:1;cursor:pointer;" id="FIleImportExcelLabel" class="custom-excel-upload btn btn-default">
                        <i class="fa fa-file" aria-hidden="true"></i> Upload File
                      </label>
                      <input id="excel-uploadPhilHealth" type="file" name="ORPhilHealth3">
                      </td>
                      </tr>
                      <tr>
                      <td>HDMF</td>
                      <td><input type="text" class="form-control" name="ORHDMF1"></td>
                      <td><input type="date" class="form-control" name="ORHDMF2"></td>
                      <td>
                      <label for="excel-uploadHDMF" style="opacity:1;cursor:pointer;" id="FIleImportExcelLabel" class="custom-excel-upload btn btn-default">
                        <i class="fa fa-file" aria-hidden="true"></i> Upload File
                      </label>
                      <input id="excel-uploadHDMF" type="file" name="ORHDMF3">
                      </td>
                      </tr>
                      <tr>
                      <td>HDMF Loan</td>
                      <td><input type="text" class="form-control" name="ORHDMFLoan1"></td>
                      <td><input type="date" class="form-control" name="ORHDMFLoan2"></td>
                      <td>
                      <label for="excel-uploadHDMFLoan" style="opacity:1;cursor:pointer;" id="FIleImportExcelLabel" class="custom-excel-upload btn btn-default">
                        <i class="fa fa-file" aria-hidden="true"></i> Upload File
                      </label>
                      <input id="excel-uploadHDMFLoan" type="file" name="ORHDMFLoan3">
                      </td>
                      </tr>
                      <tr>
                      <td>HDMF Calamity Loan</td>
                      <td><input type="text" class="form-control" name="ORHDMFCalamityLoan1"></td>
                      <td><input type="date" class="form-control" name="ORHDMFCalamityLoan2"></td>
                      <td>
                      <label for="excel-uploadHDMFCal" style="opacity:1;cursor:pointer;" id="FIleImportExcelLabel" class="custom-excel-upload btn btn-default">
                        <i class="fa fa-file" aria-hidden="true"></i> Upload File
                      </label>
                      <input id="excel-uploadHDMFCal" type="file" name="ORHDMFCalamityLoan3">
                      </td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <div class="row">
                  <div class="col-md-6" style="text-align:right;margin-bottom:10px;">
										<input type="submit" class="btn btn-primary" value="Save"  name="SaveORGovt">
										<input type="reset" class="btn btn-danger" value="Cancel">
									</div>
              </div>
              </form>
              <div class="row">
                <div class="col-md-12" >
                  <h4 style="margin-bottom:0px;margin-top:20px;font-weight:bold;background-color:#124f62;color:white;padding:10px;">GOVERNMENT OR RECORD LIST</h4>
                </div>
                <div class="col-md-12" >
                  <div style="background-color:white;padding:10px; color:#083240">
                  <table class="table " style="background-color:white;">
                  <thead>
                  <tr>
                    <th colspan="100">
                    <select class="form-control" style="float:right;width:20%;" onchange="GetGovtOR()" id="GovtORListTableSelect">
                    <option>SSS</option>
                    <option>SSS Loan</option>
                    <option>SSS Calamity Loan</option>
                    <option>PhilHealth</option>
                    <option>HDMF</option>
                    <option>HDMF Loan</option>
                    <option>HDMF Calamity Loan</option>
                    </select>
                    <script>
                    function GetGovtOR(){
                      var value=document.getElementById('GovtORListTableSelect').value;
                      $.ajax({
                      type: 'POST',
                      url: 'GetGovtOR',                
                      data: {value:value,_token: '{{csrf_token()}}'},
                      success: function(data) {
                        $( "#ORGovtTBody" ).replaceWith( data );
                      }  
                      });
                    }
                    $(document).ready(function(){
                      GetGovtOR();
                    });
                    </script>
                    </th>
                  </tr>
                  <tr style="background-color:#124f62; color:white;">
                  <th>SBR/OR Number</th>
                  <th>Date Paid</th>
                  <th>File Attached</th>
                  </tr>
                  </thead>
                  <tbody id="ORGovtTBody">
                  
                  </tbody>
                  </table>
                  </div>
                </div>
              
              </div>
            </div>
        </div>
    </div>
</div>
@endsection