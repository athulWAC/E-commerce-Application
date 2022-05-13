@extends('layout')

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            {{-- <div class="col-md-6 col-12"> --}}
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Order</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" method="post" action="{{ route('addOrder') }}"
                                id="orderForm" name="orderForm">
                                @csrf
                                <div class="form-body">

                                    <div class="col-3 mb-1">
                                        <div class="input-group mb-3">
                                            {{-- <label class="input-group-text" for="state">Customer* </label> --}}
                                                <input type="text" class="form-control" placeholder="Customer"
                                                name="customer" id="customer_0" value="" aria-label="quantity"
                                                aria-describedby="basic-addon1">
                                        </div>
                                    </div>

                                    <div class="col-3 mb-1">
                                        <div class="input-group mb-3">
                                            {{-- <label class="input-group-text" for="state">Customer* </label> --}}
                                                <input type="text" class="form-control" placeholder="Phone"
                                                name="phone" id="phone_0" value="" aria-label="quantity"
                                                aria-describedby="basic-addon1">
                                        </div>
                                    </div>




                                    <div class="row rem">


                                        <div class="col-4 mb-1">
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="state">Product* </label>
                                                <select class="form-select product_select" id="product0" data-id="amount0" name="product[]">
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

                                <div class="text-end"> Total : 8765 </div>
                                <input class="form-control col-1 btn btn-primary" type="submit" name="submit" id="submit" value="submit">
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
                        <h4 class="card-title">invoice list</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">


                            <table class="table table-striped" id="orderTable">
                                <thead>
                                  <tr>
                                    <th scope="col">id</th>
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
                                            return row.id;
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
                                        var html = `<a href="#" class="btn btn-primary">edit</a><a href="#" class="btn btn-danger">delete</a><a href="#" class="btn btn-primary">print</a>`;
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
                                <input type="number" class="form-control quantity_select" placeholder="Quantity" name="quantity[]" id="quantity` +
                    x +
                    `" value="" aria-label="quantity" aria-describedby="basic-addon1">
                                </div>
                                <span id="nameErr"> </span>
                            </div>


                            <div class="col-3 mb-1">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"> Amount*</span>
                                                <input type="number" class="form-control amount " disabled placeholder="Amount" name="amount[]"
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

            $(document).on('click','.remove',function(e) {
                e.preventDefault();
              $(this).closest('.rem').remove();
            });




            $(document).on('change','.product_select',function(e) {
                e.preventDefault();
                var net_amount = 0 ;
                var id = $(this).val();
                var a = $(this).data('id');
                var  str1 = a.replace ( /[^\d.]/g, '' );
               var quantity = $('#quantity'+str1).val();
                if ( quantity ){

                }else{
                    var quantity = 1;
                }
                alert(quantity);
                $.ajax({
                        type: "POST",
                        url: "{{ route('getAmount') }}",
                        data: {id : id },
                        success: function(data) {
                            console.log('Submission was successful.');
                            console.log(data);
                            net_amount = quantity * data ;
                            $('#amount'+str1).val(net_amount);
                        },
                        error: function(data) {
                            console.log('An error occurred.');
                            console.log(data);
                        },
                    });

            });






            $(document).on('change','.quantity_select',function(e) {
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
                        },
                        error: function(data) {
                            console.log('An error occurred.');
                            console.log(data);
                        },
                    });
            });


// total




        });

    </script>






@endpush
