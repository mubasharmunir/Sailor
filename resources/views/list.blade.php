@extends('layouts.app')
@section('content')
@section('title' , 'list')
<body>
<!-- ======= List Section ======= -->

<li><a href="{{route('list')}}"><h1>Contact list</h1></a></li>
<div class="table-responsive m-b-40">
    <table class="table table-borderless table-data3">
       <thead>
          <tr>
             <th>Id</th>
             <th>Name</th>
             <th>Email</th>
             <th>Phone Number</th>
             <th>Subject</th>
             <th>Message</th>
             <th>Action</th>
          </tr>
       </thead>
       <tbody>
           <div id="data">
          @foreach($contact as $list)
           <tr>
               <td>{{$list->id}}</td>
               <td>{{$list->name}}</td>
               <td>{{$list->email}}</td>
               <td>{{$list->phone}}</td>
               <td>{{$list->subject}}</td>
               <td>{{$list->message}}</td>
               <td>
                  <a href="manage_list/{{$list->contact}}" ><button type="button" class="btn btn-primary">Edit</button>
                  </a>
                  <a href="list/delete{{$list->contact}}"><button type="submit" class="btn btn-danger">Delete</button>
                </td>
            </a>
          </tr>
          @endforeach
           </div>
       </tbody>
    </table>
    <div class="d-flex justify-content-center" id="pagination"
    >
        {!! $contact->links() !!}
    </div>

   </body>

@endsection

@section('page-scripts')
<script>
    $(document).ready(function()
    {


    });
</script>
@endsection


