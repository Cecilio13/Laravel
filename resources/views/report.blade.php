<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <link rel="apple-touch-icon" href="{{asset('images/icon.png')}}">
    <link rel="shortcut icon" href="{{asset('images/icon.png')}}">
<?php    
    //auto refresh
    //echo "<meta http-equiv='refresh' content='1' >";
?>
<!--<meta http-equiv="refresh" content="10" >-->
    <head>
        @include('inc.head')
    </head>
    <body>
        <script>
            var e='{{$Kind}}';
            $(document).ready(function(){
                if(e=="LS1"){
                    document.getElementById('PrintBtnDisabledforLapsing').style.display="none";
                }
            })
            
        </script>
        <div id="right-panel" class="right-panel">
            <div class="container-fluid">
               <div class="row" style="display:none;">
                    <div class="col-md-12 mt-4">
                        <button class="btn btn-primary" onclick="DownloadExcel()">Download Excel</button>
			            <button class="btn btn-primary" id="PrintBtnDisabledforLapsing" onclick="printDiv()">Print</button>
                    </div>
               </div>
               <div class="row">
                    <div class="col-md-12 mt-4">
                        {!!$table!!}
                    </div>
                </div>
            </div>
            
            @include('inc.footer')
        </div>
    </body>
</html>
