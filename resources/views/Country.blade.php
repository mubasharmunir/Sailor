@extends('layouts.app')
@section('title' , 'country')
@section('content')
    <div class="card">
        <div class="card-title">
            <h2>Add Country</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addCountryModel" id="addnewcountry">
                Add New Country
            </button>
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
                    <tbody></tbody>
                </table>
            </div>
        </div>
   </div>

    {{-- Add Country Form --}}

    <div class="modal fade" id="addCountryModel" tabindex="-1" role="dialog" aria-labelledby="addCountryModel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="countryform" name="countryform" class="form-horizontal">
                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" name="country" placeholder="Enter Country">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="SaveBtn">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--Edit Country Form--}}

        <div class="modal fade" id="editnewcountry" class="editnewcountry" tabindex="-1" role="dialog" aria-labelledby="editnewcountry" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editcountryform"  class="form-horizontal">
                            @csrf
                            <input type="hidden" name="country_id" id="country_id">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country_edit" name="country_edit"  placeholder="Enter Country">
                                <small id="country_edit_error" class="text-danger"></small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
@section('page-scripts')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $(".data-table").DataTable({
                serverSide: true,
                processing: true,
                ajax: "{{route('country')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'country', name: 'country'},
                    {data: 'action', name: 'action'},
                ]
            });
                $("#SaveBtn").click(function (e) {
                    e.preventDefault();
                    $(".error").remove();
                    $.ajax({
                        data: $("#countryform").serialize(),
                        url: "{{route('country.store')}}",
                        type: "POST",
                        success: function (data) {
                            $("#countryform").trigger("reset");
                            $('#addCountryModel').modal('hide');
                            table.draw();
                        },
                        error:function (response){
                        $.each(response.responseJSON.errors,function(field_name,error){
                            $(document).find('[name='+field_name+']').after('<span class="text-strong error">' +error+ '</span>')
                        })
                    }
                });
            });
                $(document).on('click', '.editCountry', function (e) {
                    e.preventDefault();
                    var country_id = $(this).data('id');
                    var country = $(this).data('country');
                    console.log(country_id);
                    $('#country_id').val(country_id);
                    $('#country_edit').val(country);
                });
                $("#editcountryform").submit(function (e) {
                // alert('okk123')
                e.preventDefault();
                var form = $('#editcountryform')[0];
                console.log(form)
                var formData = new FormData(form);
                    $.ajax({
                        data: formData,
                        url: "{{ url('country_update') }}",
                        type: "post",
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            // alert('success');
                            $('#editnewcountry').modal('hide');
                            table.ajax.reload();
                        },
                    error: function (reject) {
                        if(reject.status == 422){
                            $('#country_edit').removeClass('is-invalid');
                            $('#country_edit_error').text('');

                            var errors = $.parseJSON(reject.responseText);
                            $.each(errors.errors, function (key, value) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key + '_error').text(value[0]);
                            })

                        }
                    }
                });
            });
            $('#editnewcountry').on('hidden.bs.modal', function () {
            $('#country_edit').removeClass('is-invalid');
            $('#country_edit_error').text('');
            })
            $('body').on('click', '.deleteCountry', function (e) {
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
                        url: "{{route('country.store') }}" + '/' + country_id,
                        success: function (data) {
                            table.draw();
                            swal("get response from controller ", {
                                icon: "success",
                            })
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
