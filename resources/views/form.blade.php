@extends('layouts.app')
@section('title' , 'Email Form')
@section('content')
    <!-- ======= Form Section ======= -->
<div class="card">
    <div class="card-title">
        <a href="{{route('form')}}">
            <h1>Form</h1>
        </a>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Submit Your Form</h3>
                        <form id="user_form" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input name="name" type="text" class="form-control" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="cars">Choose a car:</label>
                                        <select name="cars" id="cars">
                                            <option selected disabled value="">Choose:</option>
                                            <option value="volvo">Volvo</option>
                                            <option value="saab">Saab</option>
                                            <option value="mercedes">Mercedes</option>
                                            <option value="audi">Audi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="birthday">Birthday</label>
                                        <input type="date" name="birthday" class="form-control" id="birthday" aria-describedby="birthday" placeholder="Enter birthday">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="file"  name="image" placeholder="Choose image" id="image">
                                        <span class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-danger btn-sm" type="submit" id="frmSubmit">
                                            Submit
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
@section('page-scripts')
<script>
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
                url: "{{route('form.submit')}}",
                data: form,
                type: 'delete',
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
          }
    });
</script>
@endsection
