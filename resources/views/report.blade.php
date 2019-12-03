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
                GetReportAsExcel();
            })
            function GetReportAsExcel(){
                var table=document.getElementById('TableisInside').innerHTML;
                
                document.getElementById('table_container').value=table;
                
            }
        </script>
        <div id="right-panel" class="right-panel">
            <div class="container-fluid">
               <div class="row" >
                    <div class="col-md-12 mt-4">
                        <form action="GetReportAsExcel" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="table" id="table_container">
                            <button class="btn btn-primary" type="submit">Download Excel</button>
                            <button class="btn btn-primary" type="button" id="PrintBtnDisabledforLapsing" onclick="printhtmltocanvas('ReportTable')">Print</button>
                        </form>
			           
                    </div>
               </div>
               <div class="row">
                    <div class="col-md-12 mt-4" id="TableisInside">
                        {!!$table!!}
                    </div>
                </div>
            </div>
            
            @include('inc.footer')
        </div>
    </body>
</html>
