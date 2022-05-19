<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Invoice System </title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.css') }}">


    <!-- Include Choices CSS -->
    <link rel="stylesheet" href="{{ asset('public/assets/vendors/choices.js/choices.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/assets/vendors/sweetalert2/sweetalert2.min.css  ') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <link rel="stylesheet" href="{{ asset('public/assets/vendors/fontawesome/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendors/perfect-scrollbar/perfect-scrollbar.css ') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendors/bootstrap-icons/bootstrap-icons.css ') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/app.css  ') }}">
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.svg') }}" type="image/x-icon">


    {{-- <script src=https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js></script> --}}

    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">





    <style>
        table.dataTable td {
            padding: 15px 8px;
        }

        .fontawesome-icons .the-icon svg {
            font-size: 24px;
        }

    </style>



</head>

<body>

    {{-- @include('sweetalert::alert') --}}
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        {{-- logo --}}
                        <div class="logo">
                            <a href="">Admin</a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  ">
                            <a href="" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>





                        <li class="sidebar-title"> basic controls</li>

                        <li class="sidebar-item  ">
                            <a href="{{ route('product') }}" class='sidebar-link'>
                                <i class="bi bi-box-seam"></i>
                                <span>Product</span>
                            </a>
                        </li>


                        <li class="sidebar-item  ">
                            <a href="{{ route('order') }}" class='sidebar-link'>
                                <i class="bi bi-box-seam"></i>
                                <span>Order</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{ route('rayzorpay') }}" class='sidebar-link'>
                                <i class="bi bi-box-seam"></i>
                                <span>rayzorpay</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{ route('razorpayOrder') }}" class='sidebar-link'>
                                <i class="bi bi-box-seam"></i>
                                <span>rayzorpay 2.0</span>
                            </a>
                        </li>

                        <li class="sidebar-title"> Controls</li>

                        <li class="sidebar-item  ">
                            <a href="{{ route('logout') }}" class='sidebar-link'>
                                <i class="bi bi-box-arrow-right"></i>
                                <span>logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>


        <div id="main" style="background-color: #e3e3e3;">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>


            @yield('content')



            <footer>
                {{-- <div class="footer clearfix mb-0 text-muted" style="margin-top : 300px;">
                    <div class="float-start">
                        <p>2022 &copy; Athul</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">Athul</a></p>
                    </div>
                </div> --}}
            </footer>
        </div>

    </div>



    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> --}}



    <!--  jquery   -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>


    <script src="{{ asset('public/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js ') }}">
    </script>
    <script src="{{ asset('public/assets/js/pages/dashboard.js') }}"></script>
    <!-- Include Choices JavaScript -->
    <script src="{{ asset('public/assets/js/pages/form-element-select.js ') }}">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    {{-- <script src="sweetalert2.all.min.js"></script> --}}
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js ') }}">
    </script>
    <script src="{{ asset('public/assets/js/mazer.js') }}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>


    <script type="text/javascript">
        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>

    @stack('JS')

</body>

</html>
