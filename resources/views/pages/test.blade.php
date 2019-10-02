@extends('main.main')


@section('content')


<table class="table" >
    <tbody>
        {{-- @foreach ($asset_transaction_log as $logs)
        <tr>
            <td>{{$logs->asset_tag	}}</td>
            <td>{{$logs->log_date}}</td>
            <td>{{$logs->log_time}}</td>
            <td>{{$logs->audit_action_date}}</td>
            <td>{{$logs->log_action}}</td>
            <td>{{$logs->log_action_requestor_id}}</td>
            <td>{{$logs->log_action_requestor}}</td>
        </tr>  
        @endforeach --}}
    </tbody>
</table>
@endsection