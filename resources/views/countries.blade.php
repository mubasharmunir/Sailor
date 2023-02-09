@extends('layouts.app')
@section('title' , 'country')
@section('content')
    <div class="card">
      <div class="card-title">
            <a href="{{route('country.index')}}" style="margin-left: 30px;" >
                <h1>Add Country</h1>
            </a>
        </div>
            <div class="card-header">
                <div class="col-md-12">
                    <div class="text-right m-b-15">
                    <!-- Button trigger modal -->
                        <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#addnewcountry">
                            Add New Country
                        </button>
                    </div>
                </div>
            </div>
        <div class="card-body">
            <div class="table-responsive m-b-40">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  <!-- Add Country Modal -->

<div class="modal fade" id="addnewcountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form id="countryform" name="countryform" class="form-horizontal">
            <input type="hidden" name="country_id" id="country_id">
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" class="form-control" id="country" placeholder="Enter Country">
                <small id="countryhelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add Country</button>
            </div>
       </form>
      </div>
    </div>
 </div>
</div>
{{-- End Add Model --}}

{{-- Edit Model --}}

<div class="modal fade" id="editnewcountry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Add New Country</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form>
                <form id="countryform" name="countryform" class="form-horizontal">
                    <input type="hidden" name="country_id" id="country_id">
                <div class="form-group">
                    <label for="countryname">Country Name</label>
                    <input type="text" class="form-control" name="country" id="editcountry" placeholder="Enter Country Name">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="SaveBtn" name="SaveBtn" class="btn btn-primary">Add Country</button>
        </div>
      </div>
    </div>
  </div>

{{-- End Edit Model --}}

@endsection

@section('page-scripts')
<script type="text/javascript">
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    var table=$(".data-table").DataTable({
        serverSide:true,
        processing:true,
        ajax:"{{route('country')}}",
        columns:[
            {data: 'DT_RowIndex' , name: 'DT_RowIndex'},
            {data: 'country' , name:'country'},
            {data: 'action' , name:'action'},
        ]
    });

        $("#addnewcountry").click(function(e){
        e.preventDefault();
        $(this).html('Saving...');
        $.ajax({
            data:$("#countryform").serialize(),
            url:"{{route('country.store')}}",
            type:"POST",
            dataType:'json',
            success:function(data){
                $("#countryform").trigger("reset");
                $('#addnewcountry').modal('hide');
                table.draw();
            },
            error:function(data){
                console.log('error',data);
                $("#SaveBtn").html('Save Changes');
            }
        });
    });
        $('document').on('click', '.deleteCountry', function (e){
            e.preventDefault();
            var country_id = $(this).data("id");
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
                        url: "{{route('country.store') }}"+'/'+country_id,
                        success: function (data){
                            table.draw();
                            swal("get response from controller ", {
                            icon: "success",
                            })
                            .then((willDelete) => {
                            location.reload();
                        });
                    }
                });
            }
        });
    });

    $("#editnewcountry").click(function(){
      $("#country_id").val('');
      $("#countryform").trigger("reset");
      $('#EditModalLongTitle').html("Edit Country");
      $('#editajaxmodal').modal('show');
    });
        $("#saveBtn").click(function(e){
        e.preventDefault();
        $(this).html('save');

        $.ajax({
            data:$("#countryform").serialize(),
            url:"{{route('country.store')}}",
            type:"POST",
            dataType:'json',
            success:function(data){
                $("countryform").trigger("reset");
                $('#ajaxmodal').modal('hide');
                table.draw();
            },
            error:function(data){
                console.log('error',data);
                $("#saveBtn").html('Update');
            }
        });
    });

    // $('#editnewcountry').on('click','.editCountry',function(e){
    //     e.preventDefault();
    //     var country_id=$(this).data('id');
    //     $('#ModalLongTitle').html("Edit Country");
    //     $('#country_id').val('country_id');
    //     // $('#country').val('country');
    // });
});
</script>
@endsection
