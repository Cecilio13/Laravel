
<div class="sidebar-nav">
				
    <ul class="nav" >
        
        <li>
        <a style="color:white;text-align:center;width:100%;background-color:rgb(8, 50, 64);border-radius:0px;" class="btn btn-link" href="#">
            <img src="{{asset('images/noimage.png')}}"  style="width:50%; border-radius: 50%;border:solid 2px white;margin-bottom:10px;">
            <br><span style="font-weight:bold;">{{$user_position->name}}</span><br><span>"{{$user_position->position!=""? $user_position->position :' '}}"</span>
        </a>
        </li>
        <li class="nav-divider"></li>
        @if ($user_position->access_bulletin=='1')
		<li id="Z"><a style="color:white;" href="bulletin"><i class="fa fa-calendar" aria-hidden="true"></i> Bulletin</a></li>
        @endif
        @if ($user_position->access_ceo=='1')
        <li id="A"><a style="color:white;" href="ceo"><i class="fa fa-bar-chart" aria-hidden="true"></i> CEO</a></li>
        @endif
        @if ($user_position->access_hr=='1')
        <li id="B" class="btn-group" >
			<a style="color:white;text-align:left;width:80%;white-space: normal;" class="btn btn-link" id="HRBTN" href="hr"  ><i class="fa fa-user" aria-hidden="true"></i> HR</a>
			<a style="color:white;border-left:1px solid #124f62;" class="btn btn-link" id="HRBTN"  onclick="Showsubmenu('HR');list()"><i class="fa fa-chevron-down" aria-hidden="true"></i></a>
		</li>
        <li  id="subHR6"><a style="color:white;padding-left:20%;" href="employee_list"><i class="fa fa-user" aria-hidden="true"></i> Employee Lists</a></li>
        <li  id="subHR2"><a style="color:white;padding-left:20%;" href="add_employee"><i class="fa fa-plus" aria-hidden="true"></i> Add Employee</a></li>
        <li  id="subHR4"><a style="color:white;padding-left:20%;" href="view_employee"><i class="fa fa-user" aria-hidden="true"></i> View Employee</a></li>
        <li  id="subHR3"><a style="color:white;padding-left:20%;" href="memo"><i class="fa fa-file-text" aria-hidden="true"></i> Memo</a></li>
        <li  id="subHR5"><a style="color:white;padding-left:20%;" href="form_generator"><i class="fa fa-folder" aria-hidden="true"></i> Form Generator</a></li>
        <li  id="subHR7"><a style="color:white;padding-left:20%;" href="cash_advance"><i class="fa fa-bolt" aria-hidden="true"></i> Cash Advance</a></li>
        @endif
        @if ($user_position->access_payroll=='1')
        {{-- <li id="C"><a style="color:white;" href="#"><span class="glyphicon glyphicon-list-alt"></span> Accounting</a></li> 
        <li id="C2"><a style="color:white;" href="purchase_order.php"><span class="glyphicon glyphicon-search"></span> Purchase Order</a></li>  --}}
        <li id="D" class="btn-group">
        <a style="color:white;text-align:left;width:80%;white-space: normal; border-radius:0px" class="btn btn-link" id="PRBTN" href="payroll" onclick="ShowPayrollSubMenu(); "><i class="fa fa-star" aria-hidden="true"></i> Payroll</a>
		<a style="color:white;border-left:1px solid #124f62;" class="btn btn-link" id="HRBTN"  onclick="Showsubmenu('PYRL');"><i class="fa fa-chevron-down" aria-hidden="true"></i></a>
			
		</li>
        <li id="subPayroll2"><a style="color:white;padding-left:20%;" href="create_payroll"><i class="fa fa-plus" aria-hidden="true"></i> Create Payroll</a></li>
        <li id="subPayroll3"><a style="color:white;padding-left:20%;" href="employee"><i class="fa fa-user" aria-hidden="true"></i> Employee</a></li>
        <li id="subPayroll4"><a style="color:white;padding-left:20%;" href="payroll_report"><i class="fa fa-folder" aria-hidden="true"></i>  Payroll Report</a></li>
        <li id="subPayroll5"><a style="color:white;padding-left:20%;" href="govt_report"><i class="fa fa-server" aria-hidden="true"></i>  Gov't Report</a></li>
        @endif
        @if ($user_position->access_asset_namagement=='1')
        <li id="E" class="btn-group">
        <a style="color:white;text-align:left;width:80%;white-space: normal;border-radius:0px" class="btn " href="asset_management" id="INVBTN"><i class="fa fa-archive" aria-hidden="true"></i> Asset Management</a>
        <a style="color:white;border-left:1px solid #124f62;" class="btn btn-link" id="HRBTN"  onclick="Showsubmenu('INV');"><i class="fa fa-chevron-down" aria-hidden="true"></i></a>
            
        </li>
        <li id="subInv2" ><a style="color:white;padding-left:20%;" href="asset"><i class="fa fa-bar-chart" aria-hidden="true"></i> Asset</a></li>
        <li id="subInv3" ><a style="color:white;padding-left:20%;" href="transaction"><i class="fa fa-road" aria-hidden="true"></i> Transaction</a></li>
        <li id="subInv4" ><a style="color:white;padding-left:20%;" href="audit"><i class="fa fa-list-alt" aria-hidden="true"></i> Audit</a></li>
        <li id="subInv5" ><a style="color:white;padding-left:20%;" href="report"><i class="fa fa-clipboard" aria-hidden="true"></i> Report</a></li>
        <li id="subInv6" ><a style="color:white;padding-left:20%;" href="print_qr"><i class="fa fa-print" aria-hidden="true"></i> Print QR</a></li>
        @endif
        @if ($user_position->access_company_setup=='1123')
        <li id="F"><a style="color:white;" href="#"><i class="fa fa-tasks" aria-hidden="true"></i> Department</a></li>
        @endif
        @if ($user_position->access_company_setup=='1123')
        <li id="G"><a style="color:white;" href="#"><i class="fa fa-briefcase" aria-hidden="true"></i> Project Management</a></li>
        @endif
        @if ($user_position->access_company_setup=='123')
        <li id="H"><a style="color:white;" id="" href="employee_dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i> Employee</a></li>
        @endif
    </ul>
    <style>
        #subHR2,#subHR3,#subHR4,#subHR5  ,#subPayroll,#subPayroll2,#subPayroll3,#subPayroll4,#subPayroll5 
        ,#subInv1,#subInv2,#subInv3,#subInv4,#subInv5,#subInv6,#subHR6,#subHR7 {
            display: none;
        }
    </style>
    <script>
    $(document).ready(function(){
        var url = document.location.href;
        //this removes the anchor at the end, if there is one
        url = url.substring(0, (url.indexOf("#") == -1) ? url.length : url.indexOf("#"));
        //this removes the query after the file name, if there is one
        url = url.substring(0, (url.indexOf("?") == -1) ? url.length : url.indexOf("?"));
        //this removes everything before the last slash in the path
        url = url.substring(url.lastIndexOf("/") + 1, url.length);
        if(url!=""){
        
        if(url=="hr" || url=="employee_list" || url=="add_employee" || url=="view_employee" || url=="memo" || url=="form_generator" || url=="cash_advance"){
            Showsubmenu('HR');
        }
        if(url=="payroll" || url=="create_payroll" || url=="employee" || url=="payroll_report" || url=="govt_report" ){
            Showsubmenu('PYRL');
        }
        if(url=="asset_management" || url=="asset_management_dispose" || url=="transaction" || url=="asset" || url=="audit" || url=="report" || url=="print_qr" || url=="audit_detail" ){
            Showsubmenu('INV');
        }

        if(url=="bulletin"){
            document.getElementById("Z").style.borderRight="5px solid white";
            document.getElementById("Z").style.backgroundColor="#083240";
        }
        if(url=="ceo"){
            document.getElementById("A").style.borderRight="5px solid white";
            document.getElementById("A").style.backgroundColor="#083240";
        }
        //HR
        if(url=="hr"){
            document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("B").style.backgroundColor="#083240";
        }
        if(url=="add_employee"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subHR2").style.borderRight="5px solid white";
            document.getElementById("subHR2").style.backgroundColor="#083240";
            document.getElementById("B").style.backgroundColor="#083240";
        }
        if(url=="memo"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subHR3").style.borderRight="5px solid white";
            document.getElementById("subHR3").style.backgroundColor="#083240";
            document.getElementById("B").style.backgroundColor="#083240";
        }
        if(url=="cash_advance"){
            document.getElementById("subHR7").style.borderRight="5px solid white";
            document.getElementById("subHR7").style.backgroundColor="#083240";
            document.getElementById("B").style.backgroundColor="#083240";
            
        }
        if(url=="view_employee"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subHR4").style.borderRight="5px solid white";
            document.getElementById("subHR4").style.backgroundColor="#083240";
            document.getElementById("B").style.backgroundColor="#083240";
        }
        if(url=="employee_list"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subHR6").style.borderRight="5px solid white";
            document.getElementById("subHR6").style.backgroundColor="#083240";
            document.getElementById("B").style.backgroundColor="#083240";
        }
        if(url=="form_generator"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subHR5").style.borderRight="5px solid white";
            document.getElementById("subHR5").style.backgroundColor="#083240";
            document.getElementById("B").style.backgroundColor="#083240";
        }
        //Accounting
        
        // if(url=="purchase_order.php"){
        //     document.getElementById("C2").style.borderRight="5px solid white";
        //     document.getElementById("C2").style.backgroundColor="#083240";
        // }
        //Payroll
        if(url=="payroll"){
            document.getElementById("D").style.borderRight="5px solid white";
            document.getElementById("D").style.backgroundColor="#083240";
        }
        if(url=="create_payroll"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subPayroll2").style.borderRight="5px solid white";
            document.getElementById("subPayroll2").style.backgroundColor="#083240";
            document.getElementById("D").style.backgroundColor="#083240";
        }
        if(url=="employee"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subPayroll3").style.borderRight="5px solid white";
            document.getElementById("subPayroll3").style.backgroundColor="#083240";
            document.getElementById("D").style.backgroundColor="#083240";
        }
        if(url=="payroll_report"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subPayroll4").style.borderRight="5px solid white";
            document.getElementById("subPayroll4").style.backgroundColor="#083240";
            document.getElementById("D").style.backgroundColor="#083240";
        }
        if(url=="govt_report"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subPayroll5").style.borderRight="5px solid white";
            document.getElementById("subPayroll5").style.backgroundColor="#083240";
            document.getElementById("D").style.backgroundColor="#083240";
        }
        //Asset
        if(url=="asset_management" || url=="asset_management_dispose"){
            document.getElementById("E").style.borderRight="5px solid white";
            document.getElementById("E").style.backgroundColor="#083240";
        }
        if(url=="asset"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subInv2").style.borderRight="5px solid white";
            document.getElementById("subInv2").style.backgroundColor="#083240";
            document.getElementById("E").style.backgroundColor="#083240";
        }
        
        if(url=="transaction"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subInv3").style.borderRight="5px solid white";
            document.getElementById("subInv3").style.backgroundColor="#083240";
            document.getElementById("E").style.backgroundColor="#083240";
        }
        if(url=="audit"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subInv4").style.borderRight="5px solid white";
            document.getElementById("subInv4").style.backgroundColor="#083240";
            document.getElementById("E").style.backgroundColor="#083240";
        }
        if(url=="audit_detail"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subInv4").style.borderRight="5px solid white";
            document.getElementById("subInv4").style.backgroundColor="#083240";
            document.getElementById("E").style.backgroundColor="#083240";
        }
        if(url=="report"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subInv5").style.borderRight="5px solid white";
            document.getElementById("subInv5").style.backgroundColor="#083240";
            document.getElementById("E").style.backgroundColor="#083240";
        }
        if(url=="print_qr"){
            //document.getElementById("B").style.borderRight="5px solid white";
            document.getElementById("subInv6").style.borderRight="5px solid white";
            document.getElementById("subInv6").style.backgroundColor="#083240";
            document.getElementById("E").style.backgroundColor="#083240";
        }
        //Department
        
        //Project 
        
        //Employee Dashboard
        if(url=="test_page" || url=="employee_dashboard"){
            document.getElementById("H").style.borderRight="5px solid white";
            document.getElementById("H").style.backgroundColor="#083240";
        }
    }

    });
    var INV=0;
    var PYRL=0;
    var HR=0;
    
    function Showsubmenu(TYPE){
        console.log(INV);
        if(TYPE=="INV"){
            if(INV==0){
                document.getElementById('subInv2').style.display="block";
                document.getElementById('subInv3').style.display="block";
                document.getElementById('subInv4').style.display="block";
                document.getElementById('subInv5').style.display="block";
                document.getElementById('subInv6').style.display="block";
                INV=1;
            }
            else{
                document.getElementById('subInv2').style.display="none";
                document.getElementById('subInv3').style.display="none";
                document.getElementById('subInv4').style.display="none";
                document.getElementById('subInv5').style.display="none";
                document.getElementById('subInv6').style.display="none";
                INV=0;
            }
        }
        if(TYPE=="PYRL"){
            if(PYRL==0){
                document.getElementById('subPayroll2').style.display="block";
                document.getElementById('subPayroll3').style.display="block";
                document.getElementById('subPayroll4').style.display="block";
                document.getElementById('subPayroll5').style.display="block";
                PYRL=1;
            }
            else{
                document.getElementById('subPayroll2').style.display="none";
                document.getElementById('subPayroll3').style.display="none";
                document.getElementById('subPayroll4').style.display="none";
                document.getElementById('subPayroll5').style.display="none";
                PYRL=0;
            }
        }
        if(TYPE=="HR"){
            if(HR==0){
                document.getElementById('subHR2').style.display="block";
                document.getElementById('subHR3').style.display="block";
                document.getElementById('subHR4').style.display="block";
                document.getElementById('subHR5').style.display="block";
                document.getElementById('subHR6').style.display="block";
		        document.getElementById('subHR7').style.display="block";
                HR=1;
            }else{
                document.getElementById('subHR2').style.display="none";
                document.getElementById('subHR3').style.display="none";
                document.getElementById('subHR4').style.display="none";
                document.getElementById('subHR5').style.display="none";
                document.getElementById('subHR6').style.display="none";
		        document.getElementById('subHR7').style.display="none";
                HR=0;
            }
        }
        
    }
    
    </script>
</div>