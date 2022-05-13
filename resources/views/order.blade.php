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
                                                <input type="number" class="form-control" placeholder="Quantity"
                                                    name="quantity[]" id="quantity0" value="" aria-label="quantity"
                                                    aria-describedby="basic-addon1">
                                            </div>
                                            <span id="nameErr"> </span>
                                        </div>

                                        {{-- <div class="col-3 mb-1">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1"> Amount*</span>
                                                <input type="number" class="form-control amount " placeholder="Amount" name="amount[]"
                                                    id="amount0" value="" aria-label="amount"
                                                    aria-describedby="basic-addon1">
                                            </div>
                                            <span id="nameErr"> </span>
                                        </div> --}}


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
                                <input class="form-control col-2" type="submit" name="submit" id="submit" value="submit">
                                {{-- <button class="form-control col-2" >submit</button> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>





{{-- hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh --}}

    {{-- <section id="basic-horizontal-layouts">
        <div class="row match-height">

            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Order</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">



jghfh
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    </tbody>
                </table>







                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
 --}}





















@endsection


@push('JS')


    <script type="text/javascript">
        $(function() {


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
                                <input type="number" class="form-control" placeholder="Quantity" name="quantity[]" id="quantity` +
                    x +
                    `" value="" aria-label="quantity" aria-describedby="basic-addon1">
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


            //  $(document).on('change','.product_select',function(e) {
            //     e.preventDefault();
            //     var id = $(this).val();
            //     var a = $(this).data('id');
            //     alert(a);
            //     $.ajax({
            //             type: "POST",
            //             url: "{{ route('getAmount') }}",
            //             data: {id : id },
            //             success: function(data) {
            //                 console.log('Submission was successful.');
            //                 console.log(data);
            //                 $().val('data');
            //             },
            //             error: function(data) {
            //                 console.log('An error occurred.');
            //                 console.log(data);
            //             },
            //         });

            // });






        });

    </script>






@endpush
