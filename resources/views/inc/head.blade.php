<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{config('app.name','HR')}}</title>

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        <script src="{{asset('js/JQuery.js')}}"></script>
        <script src="{{asset('js/app.js')}}"></script>
        <link rel="stylesheet" href="{{asset('dist/css/bootstrap.min.css')}}" >
        {{-- <script src="{{asset('dist/js/bootstrap.min.js')}}" ></script> --}}
        <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
        
        <script src="{{asset('js/popper.js')}}"></script>


        <script src="{{asset('js/sweetalert2.min.js')}}"></script>
        <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">

        <link rel="stylesheet" type="text/css" href="{{asset('css/datatable.css')}}">
  
        <script type="text/javascript" charset="utf8" src="{{asset('js/datatable.js')}}"></script>
        <link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}">
        <!-- Latest compiled and minified JavaScript -->
        <script src="{{asset('js/bootstrap-select.min.js')}}"></script>

        <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-te-1.4.0.css')}}">
        <script src="{{asset('js/jquery-te-1.4.0.min.js')}}"></script>

        <script src="{{asset('js/jq_mark.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/jquery.formatCurrency.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/drag.js')}}"></script>