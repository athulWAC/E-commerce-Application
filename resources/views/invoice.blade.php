@extends('layout')

@section('content')



    {{-- hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh --}}
    {{-- @dd($invoices) --}}
    {{-- @foreach ($invoices as $invoice)

    @endforeach --}}
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            {{-- <div class="col-md-6 col-12"> --}}
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Invoice</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">




                            <table class="table">
                                <thead>
                                    <tr>
                                        {{-- <th scope="col">id</th> --}}
                                        <th scope="col">orderid</th>
                                        <th scope="col">customer Name</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Net Amount</th>
                                        <th scope="col">Order Date</th>
                                        {{-- <th scope="col">Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        {{-- @foreach ($invoices as $invoice) --}}
                                        <td scope="row">{{ $invoices['orderid'] }}</td>
                                        <td scope="row">{{ $invoices['Customer_name'] }}</td>
                                        <td scope="row">{{ $invoices['Phone_number'] }}</td>
                                        <td scope="row">{{ $invoices['order_date'] }}</td>
                                        <td scope="row">{{ $invoices['total_amount'] }}</td>
                                        {{-- @endforeach --}}
                                    </tr>
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





@endpush
