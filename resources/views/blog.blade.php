@extends('layouts.app')
@section('title' , 'blog')
@section('content')
<div class="card">
    <div class="card-title">
        <a href="{{route('blog')}}" style="margin-left: 30px;" >
            <h1>Form</h1>
        </a>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <h3 class="mb-4 text-center">Submit Your Designation</h3>
                        <form id="user_form" enctype="multipart/form-data">
                            <!-- <div class="row">
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
                                </div> -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="designation">Choose Your Designation:</label>
                                        <select name="designation" id="designation">
                                            <option selected disabled value="">Choose:</option>
                                            <option value="unity">Unity</option>
                                            <option value="laravel">Laravel</option>
                                            <option value="hr">HR</option>
                                            <option value="node">Node</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="col-md -12">
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
                                </div> -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-danger btn-sm" type="submit" id="frmSubmit">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                        </form>
                    </div>
               </div>
            </div>
        </div>
@endsection
