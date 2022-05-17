@extends('layout')

@section('content')



    {{-- hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh --}}
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
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Net Amount</th>
                                        {{-- <th scope="col">Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        {{-- @foreach ($invoices as $invoice) --}}
                                        <td scope="row">{{ $invoice->order_id }}</td>
                                        <td scope="row">{{ $invoice->order->customer_name }}</td>
                                        <td scope="row">{{ $invoice->order->phone }}</td>
                                        <td scope="row">{{ date('d-m-Y', strtotime($invoice->order->created_at)) }}
                                        </td>
                                        <td scope="row">Rs.{{ $invoice->total }}</td>
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
