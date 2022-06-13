@extends('layout')

@push('css')
@endpush

@section('content')
    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-11" style="margin-top: 4%;">
                <div class="card float-left">
                    <div class="card-header">
                        <h2>Scan Code</h2>
                    </div>
                    <div class="card-body">
                        {!! QrCode::size(50)->generate('halo world') !!}
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-header">
                        <h2>Color QR Code</h2>
                    </div>
                    <div class="card-body">
                        {!! QrCode::size(300)->backgroundColor(255, 90, 0)->generate('RemoteStack') !!}
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
@endsection

@push('JS')

@endpush
