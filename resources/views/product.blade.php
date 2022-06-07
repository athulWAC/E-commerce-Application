@extends('layout')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/assets/css/glyphicon.css') }}">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.css">
    {{-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css"> --}}

    <style>
        .toggle {
            --inactive-bg: #cfd8dc;
            --active-bg: #435ebe;
            --size: 2rem;
            appearance: none;
            width: calc(var(--size) * 2.2);
            height: var(--size);
            display: inline-block;
            border-radius: calc(var(--size) / 2);
            cursor: pointer;
            background-color: var(--inactive-bg);
            background-image: radial-gradient(circle calc(var(--size) / 2.1),
                    #fff 100%,
                    #0000 0),
                radial-gradient(circle calc(var(--size) / 1.5), #0003 0%, #0000 100%);
            background-repeat: no-repeat;
            background-position: calc(var(--size) / -1.75) 0;
            transition: background 0.2s ease-out;
        }

        .toggle:checked {
            background-color: var(--active-bg);
            background-position: calc(var(--size) / 1.75) 0;
        }

    </style>
@endpush

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            {{-- <div class="col-md-6 col-12"> --}}
            <div class="col-11">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="form-body">
                                <form class=" form form-horizontal " id="productForm" name="productForm"
                                    action="{{ route('createProduct') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Product Name</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="name" class="form-control" name="name"
                                                placeholder="Product Name">
                                        </div>

                                        <div class="col-md-4">
                                            <label>image</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="file" id="prod_image" class="form-control" name="image"
                                                placeholder="Email">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Category</label>
                                        </div>
                                        <div class="col-md-8 form-group ">
                                            {{-- <label class="input-group-text" for="state">Category* </label> --}}
                                            <select class="form-select" id="category_id" name="category_id">
                                                <option value="">Select a Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Size</label>
                                        </div>
                                        <div class="col-md-8 form-group ">

                                            <input type="hidden" name="size" id="size" value="1">
                                            {{-- <select class="form-select" id="size" name="size">
                                                <option value="">Select a size</option>
                                                <option value="1">SM</option>
                                            </select> --}}

                                        </div>
                                        {{-- <button id="bt">tt</button> --}}
                                        <div class="col-md-4">
                                            <label>Price</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="price" class="form-control" name="price"
                                                placeholder="price">
                                        </div>

                                        {{-- <div class="col-12 col-md-8 offset-md-4 form-group">
                                            <div class="form-check">
                                                <div class="checkbox">
                                                    <input type="checkbox" id="checkbox1" class="form-check-input"
                                                        checked="">
                                                    <label for="checkbox1">Remember Me</label>
                                                </div>
                                            </div>
                                        </div> --}}

                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            {{-- <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button> --}}
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-11" style="margin-top: 4%;">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product list</h4>
                        <p class="text-end">
                            <i class="bi bi-gear-fill btn toogle-on" data-toggle="tooltip" data-placement="top"
                                title="settings" id="tool"></i>
                        </p>

                    </div>


                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class=" col-2">
                                    <div class='input-group date' id='datetimepicker2'>
                                        From <input type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon bi bi-calendar2-minus"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class='input-group date' id='datetimepicker3'>
                                        To <input type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon bi bi-calendar2-minus-fill"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div style="overflow-x: scroll;margin: 20px;padding: 0;">
                                {!! $dtable = $dataTable->table() !!}
                            </div>
                        </div>
                    </div>

                    {{-- <div class="dropdown">
                        <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown trigger
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dLabel">
                            yuigksjuyAC#GLJIKFCbhlkjhBFJHVSJHGFVjhg
                        </div>
                    </div> --}}


                </div>
            </div>
        </div>
    </section>




@endsection

@push('JS')
    {!! $dataTable->scripts() !!}


    <script type="text/javascript">
        $(function() {



            $('#datetimepicker2').datetimepicker();
            $('#datetimepicker3').datetimepicker({
                useCurrent: false //Important! See issue #1075
            });
            $("#datetimepicker2").on("dp.change", function(e) {
                $('#datetimepicker3').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker3").on("dp.change", function(e) {
                $('#datetimepicker2').data("DateTimePicker").maxDate(e.date);
            });
        });

        $(function() {

            $('#productForm').validate({
                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    name: "required",
                    prod_image: "required",
                    category_id: "required",

                    price: {
                        required: true,
                        minlength: 1
                    }
                },
                // Specify validation error messages
                messages: {
                    name: "Please enter your name",
                    prod_image: "Please enter your prod_image",
                    category_id: "Please enter your category_id",
                    price: {
                        required: "Please provide an amount",
                        minlength: "Your amount must be at least 1 characters long"
                    },
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form, event) {
                    var frm = $('#productForm');
                    event.preventDefault();
                    $.ajax({
                        type: frm.attr('method'),
                        url: frm.attr('action'),
                        data: new FormData($('#productForm')[0]),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log('Submission was successful.');
                            console.log(data);
                            swal("successful !", "Product added successfully", "success");
                            var Otable = $('#product-table').DataTable();
                            Otable.draw();
                        },
                        error: function(data) {
                            console.log('An error occurred.');
                            console.log(data);
                            swal("error!", "something went wrong", "error");

                        },
                    });

                }
            });



            $(document).on('click', '.deleteProduct', function(e) {
                e.preventDefault();
                // alert('del');

                var id = $(this).data('id');
                var arr = $.makeArray(id);
                // alert(id);
                $.ajax({
                    type: "POST",
                    url: "{{ route('deleteProduct') }}",
                    data: {
                        id: arr
                    },
                    success: function(data) {
                        console.log('Submission was successful.');
                        console.log(data);
                        swal("successful !", "Product deleted successfully", "success");
                        var Otable = $('#product-table').DataTable();
                        Otable.draw();

                        $('.dt_parent_select').prop('checked', false);
                    },
                    error: function(data) {
                        console.log('An error occurred.');
                        console.log(data);
                        swal("error!", "something went wrong", "error");
                    },
                });
            });




            $(document).on('click', '.dt_parent_select', function() {
                // var parent_checked = $('.dt_parent_select').attr('checked', true);

                if ($('.dt_parent_select').prop('checked')) {
                    $('.dt_child_select').prop('checked', true);
                    // $(".buttons-delete").attr('style', 'background-color:#435ebe');

                    // alert('hey');
                } else {
                    $('.dt_child_select').prop('checked', false);
                    // alert('hi');
                }
            });

            $(document).on('click', '.buttons-delete', function() {


                var check_id = $(".dt_child_select:checked").map(function() {
                    return $(this).data('id');
                }).get();

                if (check_id.length === 0) {
                    swal("No Selections!", "Select anything to delete ", "error");

                } else {
                    console.log(check_id);
                    $.ajax({
                        type: "POST",
                        url: "{{ route('deleteProduct') }}",
                        data: {
                            id: check_id
                        },
                        success: function(data) {
                            console.log('Submission was successful.');
                            console.log(data);
                            swal("successful !", "Product deleted successfully",
                                "success");
                            // product-table
                            var Otable = $('#product-table').DataTable();
                            Otable.draw();
                        },
                        error: function(data) {
                            console.log('An error occurred.');
                            console.log(data);
                            swal("error!", "something went wrong", "error");
                        },
                    });

                }

            });

        });

    </script>






@endpush
