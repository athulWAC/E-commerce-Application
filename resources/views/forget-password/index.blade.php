@extends('layout')

@section('content')




    <section id="basic-horizontal-layouts">
        <div class="row match-height">
            {{-- <div class="col-md-6 col-12"> --}}
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Enter your email</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal" id="forgetpasswordForm"
                                action="{{ route('forget.password.post') }}" method="post">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>Email </label>
                                        </div>
                                        <div class="col-md-5 form-group">
                                            <input type="email" id="email" class="form-control" name="email"
                                                placeholder="a@gmail.com">
                                        </div>
                                        <div class="col-sm-7 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            {{-- <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button> --}}
                                        </div>
                                    </div>
                            </form>
                            {{-- <div class="col-md-2">
                                    <label>secret key</label>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" id="secretkey" class="form-control" name="secretkey"
                                        placeholder="Secret Key">
                                </div> --}}
                        </div>
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


            $('#forgetpasswordForm').validate({
                // Specify validation rules
                rules: {
                    email: "required",
                },
                // Specify validation error messages
                messages: {
                    email: "Please enter your email",
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form, event) {
                    var frm = $('#forgetpasswordForm');
                    event.preventDefault();
                    $.ajax({
                        type: frm.attr('method'),
                        url: frm.attr('action'),
                        data: new FormData($('#forgetpasswordForm')[0]),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log('Submission was successful.');
                            console.log(data);
                            swal("successful !", "Please check your mail", "success");
                        },
                        error: function(data) {
                            console.log('An error occurred.');
                            console.log(data);
                            swal("error!", "please check your credentials", "error");
                        },
                    });

                }
            });

        });

    </script>
@endpush
