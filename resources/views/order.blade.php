@extends('layout')

@section('content')

    <section id="basic-horizontal-layouts">
    {{-- <section id="basic-input-groups" class="basic-choices"> --}}
        <div class="row match-height">
            {{-- <div class="col-md-6 col-12"> --}}
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Order</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal " method="post" action="{{ route('addOrder') }}"
                                id="orderForm" name="orderForm">
                                @csrf
                                <div class="form-body">

                                    <div class="row">

                                        <div class="col-3 mb-1">
                                            {{-- <div class="input-group mb-3"> --}}
                                                {{-- <label class="input-group-text" for="state">Customer* </label> --}}
                                                    <input type="text" class="form-control" placeholder="Customer"
                                                    name="customer" id="customer" value="" aria-label="customer"
                                                    aria-describedby="basic-addon1"><br>
                                            {{-- </div> --}}
                                        </div>

                                        <div class="col-3 mb-1">
                                            {{-- <div class="input-group mb-3"> --}}
                                                {{-- <label class="input-group-text" for="state">Customer* </label> --}}
                                                    <input type="text" class="form-control" placeholder="Phone"
                                                    name="phone" id="phone" value="" aria-label="phone"
                                                    aria-describedby="basic-addon1"><br>
                                            {{-- </div> --}}
                                        </div>

                                    </div><br>





                                    <div class="row rem">


                                        <div class="col-4 mb-1">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="state">Product* </label>
                                                <select class="form-select product_select" id="product0" data-id="amount0" name="product[]" >
                                                    <option value=" ">Select a Product</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3 mb-1">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"> Quantity*</span>
                                                <input type="number" class="form-control quantity_select" placeholder="Quantity"
                                                    name="quantity[]" id="quantity0" value="" aria-label="quantity"
                                                    aria-describedby="basic-addon1">
                                            </div>
                                            <span id="nameErr"> </span>
                                        </div>

                                        <div class="col-3 mb-1">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"> Amount*</span>
                                                <input type="number" class="form-control amount " placeholder="Amount" name="amount[]"
                                                    id="amount0" value="" aria-label="amount" disabled
                                                    aria-describedby="basic-addon1">
                                            </div>
                                            <span id="nameErr"> </span>
                                        </div>


                                        <div class="col-2 mb-1">
                                            <div class="input-group mb-3">
                                                <a href="" id="add" name="add" class="btn add ">+</a>
                                            </div>
                                            <span id="nameErr"> </span>
                                        </div>
                                    </div>


                                    <div id="appendHtml"></div>

                                </div>

                                <div class="text-end"> Total : <span id="total">0000</span> </div>
                                <input class="form-control col-1 btn btn-primary" type="submit" name="submit" id="submit" value="submit">

                                {{-- <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ env('RAZORPAY_KEY') }}" data-amount="100"
                                data-buttontext="Pay 1 INR" data-name="check rayzorpay"
                                data-description="Rozerpay" data-image=" halo" data-prefill.name="name"
                                data-prefill.email="email" data-theme.color="#808000">
                                </script> --}}

                                {{-- <button class="form-control col-2" >submit</button> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>





{{-- hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh --}}

    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Orders list</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body" style="overflow-x: scroll;margin: 20px;padding: 0;">


                            <table class="table table-bordered text-center" id="orderTable">
                                <thead>
                                  <tr>
                                    <th scope="col"> id</th>
                                    {{-- <th scope="col">orderid</th> --}}
                                    <th scope="col">customer_name</th>
                                    <th scope="col">phone_number</th>
                                    <th scope="col">net_amount</th>
                                    <th scope="col">order_date</th>
                                    <th scope="col">actions</th>

                                  </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection


@push('JS')

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script type="text/javascript">
        $(function() {


            var table = $('#orderTable').DataTable({
                            "dom": 'T<"clear">lfrtip'
                            , "bAutoWidth": true
                            , "processing": true
                            , "serverSide": true
                            , "pageLength": 10
                            , "lengthMenu": [
                                [10, 15, 25, 35, 50, 100, -1]
                                , [10, 15, 25, 35, 50, 100, "All"]
                            ]
                            , searching: false
                            , "bLengthChange": false

                            , bInfo: false
                            , "ajax": {
                                "url": "{{ route('orderDatatable') }}"
                                , "dataType": "json"
                                , "type": "GET"
                                , "data": function(d) {
                                    d._token = "{{csrf_token()}}";
                                    d.search = $('#js-search-input').val();
                                    d.status = $('#requests-status').val();
                                }
                            }
                            , "columns": [

                                {
                                        data: null
                                        , render: function(row) {
                                            return row.order_id;
                                        }
                                    },

                                    {
                                        data: null
                                        , render: function(row) {
                                            return row.customer_name;
                                        }
                                },

                                {
                                    data: null
                                    , render: function(row) {
                                        return row.phone;
                                    }
                                }, {
                                    data: null
                                    , render: function(row) {
                                        return row.total;
                                    }
                                }, {
                                    data: null
                                    , render: function(row) {
                                        return row.created_at;
                                    }
                                }, {
                                    data: null
                                    , render: function(row) {
                                        var html = `<a href="#" data-id="${row.order_id}" class="sidebar-link editOrder" data-bs-toggle="modal"><i class="bi bi-pencil"></i> </a>
                                        <button type="button" data-id="${row.order_id}" class=" deleteOrder sidebar-link btn col-1 "><i class="bi bi-trash"></i>
                                        </button><button type="button" data-id="${row.order_id}" class=" printOrder sidebar-link btn col-1"><i class="bi bi-printer"></i>
                                        </button> <a href="{{url('invoice')}}/${row.invoice_id}" type="button" data-id="${row.order_id}" class=" viewInvoice sidebar-link btn col-1" id="print"><i class="bi bi-receipt"></i></i></button>`;
                                        return html;
                                    }
                                }

                            ]
                            , 'columnDefs': [{
                                'targets': [1]
                                , 'orderable': false
                            }]
                            , "drawCallback": function() {
                                $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                                $(window).scrollTop(0);
                            }
                            , "pagingType": "full_numbers"
                            , "language": {

                            }
                        });




            // add row

            var new_index =  1;
            var x = 0;
            $('#add').on('click', function(e) {



                // var a = $('.product_select').last().data('id');
                var a = $('.product_select').data('id');
                var  count = a.replace ( /[^\d.]/g, '' );
               var temp = 0;
                while(temp>count){
                  x =  temp++;
                }
                // alert(x);



                e.preventDefault();
                x++;
                var html =
                    // @formatter:off
                    `<div class="row rem">
                                <div class="col-4 mb-1">
                                    <div class="input-group mb-3">
                                    <label class="input-group-text" for="state">Product* </label>
                                    <select class="form-select product_select" id="product` + x +`" data-id="amount` + x +`" name="product[]">
                                    <option value=" ">Select a Product</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="col-3 mb-1">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"> Quantity*</span>
                                <input type="number" class="form-control quantity_select" value="1" placeholder="Quantity" name="quantity[]" id="quantity` +
                    x +
                    `" value="" aria-label="quantity" aria-describedby="basic-addon1">
                                </div>
                                <span id="nameErr"> </span>
                            </div>


                            <div class="col-3 mb-1">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"> Amount*</span>
                                                <input type="number" class="form-control amount " value="0" disabled placeholder="Amount" name="amount[]"
                                                    id="amount` +
                    x +
                    `" value="" aria-label="amount"
                                                    aria-describedby="basic-addon1">
                                            </div>
                                            <span id="nameErr"> </span>
                                        </div>



                        <div class="col-2 mb-1">
                            <div class="input-group mb-3">
                                <a href="" id="remove_`+x+`" class="remove"  name="remove"> - </a>
                            </div>
                            <span id="nameErr"> </span>
                        </div>
                    </div> `;
                $("#appendHtml").append(html);
            });




            // add total amount
            function total_amt(){
                var total=0;
                var  new_amount = 0;
                $( ".amount" ).each(function( i ) {
                    var new_amount =  $(this).val();
                    total += parseInt(new_amount);
                });
                    return(total);
            }

        // remove new added field
        $(document).on('click','.remove',function(e) {
                        e.preventDefault();
                    $(this).closest('.rem').remove();
                    var tot =  total_amt();
                    $("#total").html(tot);
                    });




        // getting amount after selecting product
            $(document).on('change','.product_select',function(e) {
                e.preventDefault();
                var net_amount = 0 ;
                var total=0;
                var id = $(this).val();
                var a = $(this).data('id');
                var  id_int_value = a.replace ( /[^\d.]/g, '' );
                // alert(str1);
               var quantity = $('#quantity'+id_int_value).val();
                if ( quantity ){

                }else{
                    var quantity = 1;
                }

                $.ajax({
                        type: "POST",
                        url: "{{ route('getAmount') }}",
                        data: {id : id },
                        success: function(data) {
                            console.log('Submission was successful.');
                            console.log(data);
                            net_amount = quantity * data ;
                            $('#amount'+id_int_value).val(net_amount);
                        var tot =  total_amt();
                        $("#total").html(tot);
                        // alert(tot);
                        },
                        error: function(data) {
                            console.log('An error occurred.');
                            console.log(data);
                        },
                    });

            });





// getting new amount after changing quantity
            $(document).on('keyup change','.quantity_select',function(e) {
                e.preventDefault();
                var net_amount = 0 ;
                var new_quantity = $(this).val();
                var id_name = $(this).attr('id')
                var id_int_value = id_name.replace ( /[^\d.]/g, '' );
                var product_id = $('#product'+id_int_value).val();
                var quantity = $('#quantity'+id_int_value).val();
                    if ( quantity ){

                    }else{
                        var quantity = 1;
                    }
                    // var amount = $('#amount'+id_int_value).val();

                    $.ajax({
                        type: "POST",
                        url: "{{ route('getAmount') }}",
                        data: {id : product_id },
                        success: function(data) {
                            console.log('Submission was successful.');
                            console.log(data);
                            net_amount = quantity * data ;
                            $('#amount'+id_int_value).val(net_amount);
                            var tot =  total_amt();
                            $("#total").html(tot);

                        },
                        error: function(data) {
                            console.log('An error occurred.');
                            console.log(data);
                        },
                    });
            });





            $('#orderForm').validate({
                // Specify validation rules
                rules: {
                    customer: "required",
                    phone: "required",
                },
                // Specify validation error messages
                messages: {
                    customer: "Please enter Customer Name",
                    phone: "Please enter Phone Number"
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid

                // order form ajax request commented for payment gateway integration

                submitHandler: function(form, event) {
                    var frm = $('#orderForm');
                    event.preventDefault();
                    $.ajax({
                        type: frm.attr('method'),
                        url: frm.attr('action'),
                        data: new FormData($('#orderForm')[0]),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log('Submission was successful.');
                            console.log(data);
                            swal("successful !", "Order successfully added", "success");
                        },
                        error: function(data) {
                            console.log('An error occurred.');
                            console.log(data);
                            swal("error!", "Something went wrong", "error");
                        },
                    });
                }

            });


// getting amount after selecting product
            $(document).on('click','.deleteOrder',function(e) {
                e.preventDefault();
               var id =  $(this).data('id');
                $.ajax({
                        type: "POST",
                        url: "{{ route('deleteOrder') }}",
                        data: {id : id },
                        success: function(data) {
                            console.log('Submission was successful.');
                            console.log(data);
                            swal("successful !", "Order is deleted", "success");
                        },
                        error: function(data) {
                            console.log('An error occurred.');
                            console.log(data);
                            swal("error!", "Something went wrong", "error");

                        },
                    });

            });

        });

    </script>
@endpush

