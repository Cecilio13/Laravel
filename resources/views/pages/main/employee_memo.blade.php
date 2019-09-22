@extends('main.main')


@section('content')
@if (Session::get('result_data'))
    <script>
        Swal.fire({
        type: 'success',
        title: 'Success',
        text: 'Successfully Employee Memo File',
        })
    </script>
@endif
<div class="container-fluid" >
<div class="col-md-10" style="background-color:white;">
    <table class="table table-sm ">
        <thead>
          <tr>
          <th colspan="7" style="padding-left:0px;padding-right:0px;padding-top:10px;">
          <button class="btn btn-success" data-toggle="modal" data-target="#EmployeeMemoModal">Add Memo</button> 
            <style>
                #memofile{
                    display: none;
                }
                .custom-file-upload {
                    float:right;
                    color:#124f62;
                    background-color:white;
                    border: 1px solid #ccc;
                    display: inline-block;
                    padding: 6px 12px;
                    cursor: pointer;
                }
                .modal-body .form-group{
                    margin-bottom:10px;
                }
            </style>
            <label for="memofile" class="custom-file-upload">
                <i class="fa fa-cloud-upload"></i> Upload Memo
            </label>
            <form action="upload_emp_memo" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="file" id="memofile" onchange="this.form.submit()" name="MemoFile" accept="image/*,.docx,.pdf">
            </form>
          </th>
          </tr>
          <tr style="background-color:#124f62;color:white">
            <th width="50%;">Memo</th>
            <th width="30%;">Type</th>
            <th width="20%;">Action</th>
          </tr>
          
        </thead>
        <tbody>
            @foreach ($emp_memo as $item)
                @if ($item->memo_offense_level=="Uploaded Memo File")
                    <tr>
                        <td>
                            <a style="" href="{{asset('storage/emp_memo/'.$item->memo_violation_category)}}" download class="btn btn-link memo_link">{{$item->memo_violation_category}}</a>
                            <br>
                            <span>{{"uploaded on ".date('m-d-Y',strtotime($item->memo_created_at))}}</span>
                        </td>
                        <td>File</td>
                        <td><button onclick="DeleteMemo('{{$item->memo_id}}')" type="button" class="btn btn-danger btn-sm" name="DeleteMemoSubmit" >Delete Memo</button></td>
                    </tr>
                @else
                    <tr>
                        <td>
                            <button onclick="ViewMemoDetail('{{$item->memo_id}}')" class="btn btn-link memo_link">{{$item->memo_title}}</button>
                            <br>
                            <span>{{"created on ".date('m-d-Y',strtotime($item->memo_created_at))}}</span>
                        </td>
                        <td>Memo</td>
                        <td><button onclick="DeleteMemo('{{$item->memo_id}}')" type="button" class="btn btn-danger btn-sm" name="DeleteMemoSubmit" >Delete Memo</button></td>
                    </tr>
                @endif 
            @endforeach
        </tbody>
    </table>
</div>
</div>
<script>
    function ViewMemoDetail(memo_id){
        $.ajax({
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'get_emp_memo_data',                
        data: {id:memo_id,_token: '{{csrf_token()}}'},
            success: function(data) {
                document.getElementById('memo_title').innerHTML=data['memo_title'];
                document.getElementById('memo_emp_name_view').innerHTML=data['memo_employee'];
                document.getElementById('memo_offense_level_view').innerHTML=data['memo_offense_level'];
                document.getElementById('memo_da_type_view').innerHTML=data['memo_da_type'];
                document.getElementById('memo_violation_category_view').innerHTML=data['memo_violation_category'];
                document.getElementById('memo_slide_date_view').innerHTML=data['memo_slide_date'];
                document.getElementById('memo_note_view').innerHTML=data['memo_note'];
                document.getElementById('memo_title_view').innerHTML="Date Recieved : "+formatDate (data['memo_date_recieved']);;
                
                $('#ViewEmployeeMemoModal').modal('show'); 
            }
        })
    }
    function DeleteMemo(title){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.value) {
            $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'update_emp_memo',                
            data: {id:title,_token: '{{csrf_token()}}'},
                success: function(data) {
                    console.log(data);
                    Swal.fire({
                    type: 'success',
                    title: 'Success',
                    text: 'Successfully Deleted Memo',
                    
                    }).then((result) => {
                        location.href="memo";
                    })
                }
            })
        }
        })
    }
</script>
@endsection