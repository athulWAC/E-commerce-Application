@extends('layout')

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            {{-- <div class="col-md-6 col-12"> --}}
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class=" form form-horizontal " id="updateproductForm" name="updateproductForm"
                                action="{{ route('updateProduct') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-body">


                                    <div class="row">

                                        <input type="hidden" id="product_id" class="form-control" name="product_id"
                                            value="{{ $products->id }}">
                                        <div class="col-md-4">
                                            <label>Product Name</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="name" class="form-control" name="name"
                                                value="{{ $products->name }}" placeholder="Product Name">
                                        </div>

                                        <div class="col-md-4">
                                            <label>image</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="file" id="prod_image" class="form-control" name="image"
                                                placeholder="image">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Category</label>
                                        </div>
                                        <div class="col-md-8 form-group input-group">
                                            <label class="input-group-text" for="state">Category* </label>
                                            <select class="form-select" id="category_id" name="category_id">
                                                <option value="">Select a Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == $products->category_id ? 'selected' : ' ' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- <button id="bt">tt</button> --}}
                                        <div class="col-md-4">
                                            <label>Price</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="price" class="form-control" name="price"
                                                value="{{ $products->price }}" placeholder="price">
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

                                    {{-- <div class="row fluid">
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-header">
                                                </div>
                                                <div class="card-content">
                                                    <div class="card-body">
                                                        <div style="overflow-x: scroll;margin: 20px;padding: 0;">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}


                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('JS')
    {{-- {!! $dataTable->scripts() !!} --}}

    <script type="text/javascript">
        $(function() {

            // var frm = $('#updateproductForm');
            // frm.submit(function(e) {
            //     e.preventDefault();
            //     $.ajax({
            //         type: frm.attr('method'),
            //         url: frm.attr('action'),
            //         data: new FormData($('#updateproductForm')[0]),
            //         contentType: false,
            //         processData: false,
            //         success: function(data) {
            //             console.log('Submission was successful.');
            //             console.log(data);
            //         },
            //         error: function(data) {
            //             console.log('An error occurred.');
            //             console.log(data);
            //         },
            //     });
            // });


            $('#updateproductForm').validate({
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
                    var frm = $('#updateproductForm');
                    event.preventDefault();
                    $.ajax({
                        type: frm.attr('method'),
                        url: frm.attr('action'),
                        data: new FormData($('#updateproductForm')[0]),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log('Submission was successful.');
                            console.log(data);
                            // swal("successful !", "product is successfully updates",
                            //     "success");
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
