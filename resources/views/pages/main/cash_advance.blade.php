@extends('main.main')


@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
        <h2 style="font-weight:bold;color:#083240;margin-top:10px;margin-bottom:0px;">Cash Advance</h2>
    </div>
</div>
<table class="table table-sm" style="background-color:white;">
    <thead style="background-color:#124f62; color:white;font-size:9pt;">
        <tr>
            <th style="vertical-align:middle">Loan Type</th>
            <th style="vertical-align:middle">Employee</th>
            <th style="vertical-align:middle">Date of Request</th>
            <th style="vertical-align:middle">Start of Deduction</th>
            <th style="vertical-align:middle">End of Deduction</th>
            <th style="vertical-align:middle">Total Amount</th>
            <th style="vertical-align:middle">Pay Period</th>
            <th style="vertical-align:middle">Pay Amount/Period</th>
            <th style="vertical-align:middle">Total Amount Paid</th>
            <th style="vertical-align:middle">Balance</th>
            <th style="vertical-align:middle"><button class="btn btn-success btn-sm" data-toggle="modal" data-target="#CashAdvanceModal"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cash_advances as $item)
        <tr>
            <td style="vertical-align:middle">{{$item->loan_type}}</td>
            <td style="vertical-align:middle">{{$item->fname." ".$item->lname}}</td>
            <td style="vertical-align:middle">{{date('m-d-Y',strtotime($item->date_of_request))}}</td>
            <td style="vertical-align:middle">{{date('m-d-Y',strtotime($item->start_of_deduction))}}</td>
            <td style="vertical-align:middle">{{date('m-d-Y',strtotime($item->end_of_deduction))}}</td>
            <td style="vertical-align:middle">{{number_format($item->total_amount,2)}}</td>
            <td style="vertical-align:middle">{{$item->pay_period}}</td>
            <td style="vertical-align:middle">{{number_format($item->pay_amount_per_period,2)}}</td>
            <td style="vertical-align:middle">{{number_format($item->total_amount-$item->balance,2)}}</td>
            <td style="vertical-align:middle">{{number_format($item->balance,2)}}</td>
            <td style="vertical-align:middle">
            <button class="btn btn-warning btn-sm" style="color:white;" onclick="view_cash_advance_data('{{$item->cash_advance_id}}')"><i class="fa fa-credit-card-alt" aria-hidden="true"></i></button>          
            </td>
        </tr>
        @endforeach
        
    </tbody>
</table>
</div>
<script>
    function view_cash_advance_data(id){
        $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'get_cash_advance_data',                
        data: {id:id,_token: '{{csrf_token()}}'},
        success: function(data) {
            document.getElementById('cashadvance_emp_name').value=data['emp_id'];
            document.getElementById('PaymentAmount').value=data['balance'];
            document.getElementById('PaymentAmount').max=data['balance'];
            document.getElementById('cash_advance_loan_type').innerHTML=data['loan_type'];
            document.getElementById('cash_advance_date_of_request').innerHTML=formatDate(data['date_of_request']);
            document.getElementById('cashadvance_total_amount').innerHTML=number_format(data['total_amount']);
            document.getElementById('cash_advance_startdeduction').innerHTML=formatDate(data['start_of_deduction']);
            document.getElementById('cash_advance_enddeduction').innerHTML=formatDate(data['end_of_deduction']);
            document.getElementById('cashadvance_balance').innerHTML=number_format(data['balance']);
            document.getElementById('cashadvance_total_amount_paid').innerHTML=number_format(data['total_amount']-data['balance']);
            $('#AddPaymentModal').modal('show');
        }  
        }) 
        
    }
</script>
@endsection