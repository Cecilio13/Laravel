
<div class="sidebar-nav">
				
    <ul class="nav" >
        
        <li>
        <a style="color:white;text-align:center;width:100%;background-color:rgb(8, 50, 64);" class="btn btn-link" href="#">
            <img src="{{asset('images/noimage.png')}}"  style="width:50%; border-radius: 50%;border:solid 2px white;margin-bottom:10px;">
            <br><span style="font-weight:bold;">{{$user_position->name}}</span><br><span>"{{$user_position->position!=""? $user_position->position :' '}}"</span>
        </a>
        </li>
        <li class="nav-divider"></li>

		<li id="setup_companyli"><a style="color:white;" href="setup_company"><i class="fa fa-building" aria-hidden="true"></i> Company</a></li>
        
        
        <li id="setup_payrollli"><a style="color:white;" href="setup_payroll"><i class="fa fa-money" aria-hidden="true"></i> Payroll</a></li>
        <li id="setup_referencesli"><a style="color:white;" href="setup_references"><i class="fa fa-cogs" aria-hidden="true"></i> References</a></li>
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
                if(url=="setup_company"){
                    document.getElementById("setup_companyli").style.borderRight="5px solid white";
                    document.getElementById("setup_companyli").style.backgroundColor="#083240";
                }
                if(url=="setup_payroll"){
                    document.getElementById("setup_payrollli").style.borderRight="5px solid white";
                    document.getElementById("setup_payrollli").style.backgroundColor="#083240";
                }
                //HR
                if(url=="setup_references"){
                    document.getElementById("setup_referencesli").style.borderRight="5px solid white";
                    document.getElementById("setup_referencesli").style.backgroundColor="#083240";
                }
            
            }
        
        });
        </script>
</div>