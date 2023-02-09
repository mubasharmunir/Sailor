@extends('layouts.app')
@section('content')
@section('title' , 'list')
<!-- ======= List Section ======= -->
@if(session('status'))
<h6 class="alert alert-success">{{session('status')}}</h6>
@endif
<div class="card">
    <div class="card-title">
            <a href="{{route('jquery')}}">
                <h1>Jquery List</h1>
            </a>
        </div>
        <div class="card-body">
        <div class="table-responsive m-b-40">
           <table class="table table-borderless table-data3">
             <thead>
                    <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Cars</th>
                    <th>Date Of Birth</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
             </thead>
                <tbody>
                    <div id="data">
                    @foreach($form as $list)
                    <tr>
                        <td>{{$list->id}}</td>
                        <td>{{$list->name}}</td>
                        <td>{{$list->email}}</td>
                        <td>{{$list->cars}}</td>
                        <td>{{$list->birthday}}</td>
                        <td>
                            <img src="{{asset('uploads/'.$list->image)}}" alt="{{$list->image}}" width="100" height="50"/>
                        </td>
                        <td>
                            <a href="{{ asset('edit-form/'.$list->id)}}">
                                <button type="button" class="btn btn-primary">Edit</button>
                            </a>
                            <a href="{{ asset('delete-form/'.$list->id)}}" class="btn btn-danger" id="deletebtn" data-id="{{$list->id}}">
                                Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <div class="d-flex justify-content-center" id="pagination">
     {!! $form->links() !!}
    </div>
@endsection
@section('page-scripts')
<script>
        $(document).ready(function(e){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#deletebtn').click(function(e){
            e.preventDefault();
            var delete_id = $(this).attr('data-id');
            // alert(delete_id);
                    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Data",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
            $.ajax({
                type: "DELETE",
                url:"{{url('delete-form/')}}".'.+delete_id,
                data:"data",
                success: function (data){
                    swal("get response from controller ", {
                    icon: "success",
                    });
                }
                .then((willDelete) => {
                    location.reload();
                })
            });
          }
        });
    });
});
</script>
@endsection
