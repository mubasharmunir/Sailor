@extends('layouts.app')
@section('title' , 'Edit Form')
@section('content')

    <div class="card">
        <div class="card-title">
            <h2>Add City</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addCityModel" id="addnewcity">
                Add New City
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive m-b-40">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Add City Form --}}

    <div class="modal fade" id="addCityModel" tabindex="-1" role="dialog" aria-labelledby="addCityModel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="cityform" name="cityform" class="form-horizontal">
                        <input type="hidden" name="country_id" id="country_id">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city" placeholder="Enter city">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label mb-1">Country</label>
                                <div class="form-group">
                                    <select id="select-country" name="country">
                                        <option selected value="">Select Country:</option>
{{--                                        @foreach($countries as $country)--}}
{{--                                            <option selected value="{{$country->id}}">{{$country->country}}</option>--}}
{{--                                        @endforeach--}}
                                    </select>
                                </div>
                            </div>
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
                               {{--End Add City Modal--}}

                                 {{-- Edit City Form --}}

    <div class="modal fade" id="editCityModel" tabindex="-1" role="dialog" aria-labelledby="editCityModel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editcityform"  class="form-horizontal">
                        @csrf
                        <input type="hidden" name="city_id" id="city_id">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="city">City</label>
                                      <input type="text" class="form-control" name="city_edit" id="city_edit" placeholder="Enter city">
                                    <small id="city_edit_error" class="text-danger"></small>
                                </div>
                            </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="country">Choose a Country:</label>
                                    <select id="select-country" name="select-country">
                                        <option selected value="">Select Country:</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->country}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" >Update Changes</button>
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
                ajax: "{{route('city')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'city', name: 'city'},
                    {data: 'country_id', name: 'country_id'},
                    {data: 'action', name: 'action'},
                ]
            });
            $("#SaveBtn").click(function (e) {
                e.preventDefault();
                $(".error").remove();
                $.ajax({
                    data: $("#cityform").serialize(),
                    url: "{{route('city.store')}}",
                    type: "POST",
                    success: function (data) {
                        $("#cityform").trigger("reset");
                        $('#addCityModel').modal('hide');
                        table.draw();
                    },
                    error:function (response){
                        $.each(response.responseJSON.errors,function(field_name,error){
                            $(document).find('[name='+field_name+']').after('<span class="text-strong error">' +error+ '</span>')
                        })
                    }
                });
            });
            $(document).on('click', '.editCity', function (e) {
                e.preventDefault();
                var city_id = $(this).data("id");
                var city = $(this).data('city');
                var country = $(this).data('country');
                $('#city_id').val(city_id);
                $('#city_edit').val(city);
                $('#select-country').trigger('change').val(country);
            });
                $("#editcityform").submit(function (e) {
                    e.preventDefault();
                    var form = $('#editcityform')[0];
                    console.log(form)
                    var formData = new FormData(form);
                    $.ajax({
                        data: formData,
                        url: "{{ url('city_update') }}",
                        type: "post",
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $('#editCityModel').modal('hide');
                            table.ajax.reload();
                        },
                        error: function (reject) {
                            if(reject.status == 422){
                                $('#city_edit').removeClass('is-invalid');
                                $('#city_edit_error').text('');
                                $('#select-country').removeClass('is-invalid');
                                $('#select-country-error').text('');

                                var errors = $.parseJSON(reject.responseText);
                                $.each(errors.errors, function (key, value) {
                                    $('#' + key).addClass('is-invalid');
                                    $('#' + key + '_error').text(value[0]);
                                })

                            }
                        }
                    });
                });
            // $('#editCityModel').on('hidden.bs.modal', function () {
            //     $('#city_edit').removeClass('is-invalid');
            //     $('#country_edit').removeClass('is-invalid');
            //     $('#city_edit_error').text('');
            //     $('#country_edit_error').text('');
            // })
            $('body').on('click', '.deleteCity', function (e) {
                e.preventDefault();
                var city_id = $(this).data("id");
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
                        url: "{{route('city.store') }}"+'/'+city_id,
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
        $.ajax({
            url: "{{route('getAllCountries')}}",
            type: "Get",
            success: function (data) {
                $.each(data, function (i, item) {
                    console.log(item.country);
                    $('#select-country').append($('<option>', {
                        value: item.id,
                        text:item.country,
                    }));
                });
            },
            error:function (response){
                swal('Something went wrong.');
            }
        });
    });
</script>
@endsection
