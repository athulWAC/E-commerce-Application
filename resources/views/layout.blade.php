<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="#">
    <title>Invoice System </title>
    {{-- <link rel="stylesheet" href="{{ asset('public/assets/vendors/choices.js/choices.min.css') }}" /> --}}
    {{-- <link rel="stylesheet" href="{{ asset('public/assets/vendors/iconly/bold.css') }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('public/assets/vendors/perfect-scrollbar/perfect-scrollbar.css ') }}"> --}}

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Include Choices CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/app.css  ') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendors/bootstrap-icons/bootstrap-icons.css ') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.15.1/sweetalert2.min.css">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-toggle/3.6.1/bootstrap4-toggle.min.css"
        integrity="sha512-EzrsULyNzUc4xnMaqTrB4EpGvudqpetxG/WNjCpG6ZyyAGxeB6OBF9o246+mwx3l/9Cn838iLIcrxpPHTiygAA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <link href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.42/css/bootstrap-datetimepicker.css"
        integrity="sha512-5UZhIPmPGksf4ihhsCbDbHiplNQXiUQ1o4lQR22KQtqlTUYZN0civrpBL9eJuLgnP2IYBdn5XuVEhe4gz8tt3A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link
        href="https://developer.snapappointments.com/bootstrap-select/A.ajax,,_libs,,_highlight.js,,_9.15.6,,_css,,_github.min.css+css,,_base.css+css,,_custom.css+dist,,_css,,_bootstrap-select.min.css,Mcc.Sm_E229yq5.css.pagespeed.cf.6VwF0Af9hv.css"
        rel="stylesheet">


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

                        <li class="sidebar-item  {{ Request::is('product') ? 'active' : null }} ">
                            {{-- Request::routeIs('welcome'); --}}
                            <a href="{{ route('product') }}" class='sidebar-link'>
                                <i class="bi bi-box-seam"></i>
                                <span>Product</span>
                            </a>
                        </li>


                        <li class="sidebar-item  {{ Request::is('order') ? 'active' : null }}">
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

                        <li class="sidebar-item ">
                            <a href="{{ route('razorpayOrder') }}" class='sidebar-link'>
                                <i class="bi bi-box-seam"></i>
                                <span>rayzorpay 2.0</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{ route('vonage') }}" class='sidebar-link'>
                                <i class="bi bi-box-seam"></i>
                                <span>send sms with vonage</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{ route('twilio') }}" class='sidebar-link'>
                                <i class="bi bi-box-seam"></i>
                                <span>send sms with twilio</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{ route('notification') }}" class='sidebar-link'>
                                <i class="bi bi-bell-fill"></i>
                                <span>notification</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{ route('notification') }}" class='sidebar-link'>
                                {{-- <i class="bi bi-bell-fill"></i> --}}
                                <i class="bi bi-gear-fill"></i>
                                <span>settings</span>
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
                {{-- foote here --}}
            </footer>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js ') }}">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"
        integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
    <script src="{{ asset('public/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js ') }}">
    </script>
    <script src="{{ asset('public/assets/js/pages/form-element-select.js ') }}">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap4-toggle/3.6.1/bootstrap4-toggle.min.js"
        integrity="sha512-bAjB1exAvX02w2izu+Oy4J96kEr1WOkG6nRRlCtOSQ0XujDtmAstq5ytbeIxZKuT9G+KzBmNq5d23D6bkGo8Kg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- sweet alert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.15.1/sweetalert2.min.js"></script>

    <script src="{{ asset('public/assets/js/mazer.js') }}"></script>

    {{-- datatable --}}

    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('public/vendor/datatables/buttons.server-side.js') }}"></script>
    <script src="{{ asset('public/assets/js/datatable.buttons.js') }}"></script>

    {{-- datetime picker --}}


    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


    <script type="text/javascript">
        window.order = "{{ route('order') }}";
        window.product = "{{ route('product') }}";

    </script>

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
