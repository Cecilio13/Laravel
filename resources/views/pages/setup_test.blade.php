@extends('main.main_setup')


@section('content')
<div class="container-fluid" >
    <ul class="nav nav-tabs nav-tab-custom"   role="tablist">
        <li class="nav-item" >
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#PROFILE" role="tab" aria-controls="home" aria-selected="true">PROFILE</a>
        </li>
        <li class="nav-item" >
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#BANKS" role="tab" aria-controls="profile" aria-selected="false">BANKS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#COSTCENTER" role="tab" aria-controls="contact" aria-selected="false">COST CENTER</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#DEPARTMENT" role="tab" aria-controls="contact" aria-selected="false">DEPARTMENT</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="PROFILE" role="tabpanel" aria-labelledby="home-tab">
            <h2 style="margin-bottom:10px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">BASIC INFORMATION</h2>
            <div class="container-fluid" >
                
            </div>
        </div>
        <div class="tab-pane fade" id="BANKS" role="tabpanel" aria-labelledby="profile-tab">
            <h2 style="margin-bottom:0px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">ADD NEW BANK</h2>
            <div class="container-fluid" >
            
            </div>
        </div>
        <div class="tab-pane fade" id="COSTCENTER" role="tabpanel" aria-labelledby="contact-tab">
            <h2 style="margin-bottom:0px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">ADD NEW COST CENTER</h2>
            <div class="container-fluid" >
            
            </div>
        </div>
        <div class="tab-pane fade" id="DEPARTMENT" role="tabpanel" aria-labelledby="contact-tab">
            <h2 style="margin-bottom:0px;padding:10px;margin-top:0px;font-weight:bold;background-color:#124f62;color:white;">ADD NEW DEPARTMENT</h2>
            <div class="container-fluid" >
            
            </div>
        </div>
    </div>
</div>
@endsection