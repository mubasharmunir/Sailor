@extends('layouts.app')
@section('title' , 'Edit Form')
@section('content')
    <!-- ======= Form Section ======= -->
<div class="card">
    <div class="card-title">
        {{-- <a href="{{route('form')}}" style="margin-left: 30px;" > --}}
            <h1>Edit Form</h1>
        </a>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Submit Your Form</h3>
                            <form action="{{asset('update-form/'.$model->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" type="text" value="{{$model->name}}" class="form-control" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" name="email" value="{{$model->email}}" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cars">Choose a car:</label>
                                        <select name="cars" value="{{$model->cars}}" id="cars">
                                            <option selected disabled value="">Choose:</option>
                                            <option value="volvo"{{ $model->cars == 'volvo' ? 'selected' : '' }}>Volvo</option>
                                            <option value="saab"{{ $model->cars == 'saab' ? 'selected' : '' }}>Saab</option>
                                            <option value="mercedes"{{ $model->cars == 'mercedes' ? 'selected' : '' }}>Mercedes</option>
                                            <option value="audi"{{ $model->cars == 'audi' ? 'selected' : '' }}>Audi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="birthday">Birthday</label>
                                        <input type="date" name="birthday" value="{{$model->birthday}}" class="form-control" id="birthday" aria-describedby="birthday" placeholder="Enter birthday">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="file"  name="image" placeholder="Choose image" id="image">
                                        <img src="{{asset('uploads/'.$model->image)}}" alt="{{$model->image}}" width="100" height="50"/>
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary" type="submit">
                                            Update Form
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- @section('page-scripts') --}}
{{-- <script>
    $(document).ready(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#user_form').validate({
            rules:{
                name: {
                    required:true,
                    minlength:3,
                },
                email: {
                    required:true,
                    email:true,
                 },
                birthday: {
                    required:true,
                },
                 cars: {
                    required:true,
                },
                image: {
                    required:true,
                    // max:2048,
                }
            }
        });
    });

     $('#frmSubmit').on('click', function (e){
        //e.preventDefault();
        // alert('asdsad');
        // if($('#user_form').validate()===true) {
            var formElem = $("#user_form")[0];
            var form=new FormData(formElem);
            console.log(form)
            $.ajax({
                url: "{{url('update-form/.'$list->id)}}",
                data: form,
                type: 'post',
                processData: false,
                contentType: false,
                success: function (result) {
                    console.log(result);
                    if (result.status) {
                        alert(result.message);
                    } else {
                        alert('Something went wrong.');
                    }
                },
                error: function (result) {
                    alert('Something went wrong.');
                }
           });
        //  }
    });
</script>
@endsection --}}
