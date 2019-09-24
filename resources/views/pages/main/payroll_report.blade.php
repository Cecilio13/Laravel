@extends('main.main')


@section('content')
<div class="container-fluid" >
    <ul class="nav nav-tabs nav-tab-custom"   role="tablist">
        <li class="nav-item" >
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#PROFILE" role="tab" aria-controls="home" aria-selected="true">Payroll Summary</a>
        </li>
        <li class="nav-item" style="display:none;">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#BANKS" role="tab" aria-controls="profile" aria-selected="false">Monthly Summary</a>
        </li>
        <li class="nav-item" style="display:none;">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#COSTCENTER" role="tab" aria-controls="contact" aria-selected="false">Adjustment</a>
        </li>
        <li class="nav-item" style="display:none;">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#DEPARTMENT" role="tab" aria-controls="contact" aria-selected="false">Employer Contribution</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="PROFILE" role="tabpanel" aria-labelledby="home-tab">
            <h2 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">SUMMARY</h2>
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-md-12" style="text-align:right;">
                        <a class="btn btn-primary btn-sm" href="{{asset('extra/import_file/payroll_report.xlsx')}}" download>Download Excel</a>
                        
                    </div>
                </div>
                {!! $tablecontent !!}
            </div>
        </div>
        <div class="tab-pane fade" id="BANKS" role="tabpanel" aria-labelledby="profile-tab">
            
            <div class="container-fluid" >
            
            </div>
        </div>
        <div class="tab-pane fade" id="COSTCENTER" role="tabpanel" aria-labelledby="contact-tab">
            
            <div class="container-fluid" >
            
            </div>
        </div>
        <div class="tab-pane fade" id="DEPARTMENT" role="tabpanel" aria-labelledby="contact-tab">
            
            <div class="container-fluid" >
            
            </div>
        </div>
    </div>
</div>
@endsection