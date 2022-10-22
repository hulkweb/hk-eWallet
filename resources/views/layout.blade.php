<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">
    <meta name="server" content="app.spp.co">
    <!-- Favicon -->
    <link rel="icon" href="/favicon.png">
 <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        EWallet</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="https://use.typekit.net/qhc0gdo.css">
    <link rel="stylesheet" href="/css/19-10/spp_clients.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/51761b1c6c.js"></script>
    <script src="https://kit.fontawesome.com/51761b1c6c.js"
        integrity="sha384-TkHCDK2R4IB93mPBtcXB9TEEMBrgr+TauHljGd1FRtIUOlP3bzlwhereXI2hOKjr" crossorigin="anonymous">
    </script>

    <style type="text/css" data-css-vars>
        :root {}

        #data .card,
        #data a {
            height: 200px;
            width: 200px;
            text-align: center;
            justify-content: center;
            align-items: center;
            background: white;
        }
    </style>

</head>

<body class="">
    <div id="loading" class="ajax-loader">Loading...</div>

    <div class="container-fluid">
        <div class="row">
            <aside class="col sidebar"
                style="background: rgb(86,86,88);
            background: linear-gradient(180deg,#7c4005 -20%, #FF9933 59%,#FF9933 100%);">
                <div class="sidebar-sticky">
                    <a href="#" class="navbar-brand d-none d-sm-block" data-pjax="data-pjax">
                        <img src="logo.png" height="70" alt="" class="bg-light rounded px-1">
                    </a>

                    <ul class="nav flex-column" role="navigation">
                        <li class="nav-item title">Activity</li>
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link" title="Dashboard" data-pjax>

                                <span>
                                    <i class="fas fa-home fa-fw"></i>

                                    Home
                                </span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="/transactions" class="nav-link" title="Customer" data-pjax>

                                <span>
                                    <i class="fas fa-user fa-fw"></i>

                                    transactions
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/send_money" class="nav-link" title="Customer" data-pjax>

                                <span>
                                    <i class="fas fa-user fa-fw"></i>

                                    Send Money
                                </span>
                            </a>
                        </li>
                        <li class="nav-item title">Salaries</li>
                        <li class="nav-item">
                            <a href="/add_money" class="nav-link" title="Orders">

                                <span>
                                    <i class="fas fa-inbox fa-fw"></i>
                                    Add Money</span>
                            </a>
                        </li>


                        









                    </ul>
                </div>

                <footer></footer>
            </aside>
            <main class="col">

                <nav class="navbar navbar-light navbar-expand">

                    <button id="sidebar-collapse" class="navbar-toggler d-block d-lg-none mr-2" type="button">

                        <span class="navbar-toggler-icon"></span>
                    </button>


                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item d-flex align-items-center mr-3">
                             <i class="fas fa-wallet text-secondary   "></i>  &nbsp;&nbsp;&nbsp;&nbsp;<b> {{ number_format(auth()->user()->wallet,2) }}</b>
                        </li>





                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center"
                                data-toggle="dropdown">
                                <div class="avatar css-avatar"><span>{{ auth()->user()->name[0] }} </span></div>

                                <span class="d-none d-lg-block ml-1">{{ auth()->user()->name }}</span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                {{-- <a href="/profile" class="dropdown-item" data-pjax>Your
                                    account</a> --}}
                                <a href="/logout" class="dropdown-item">
                                    Sign out
                                </a>
                            </div>
                        </li>



                    </ul>
                </nav>
                <div class="content">

                    <div id="status"></div>

                    <div id="notification-menu-items" class="hide-js">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-bell"></i> <span
                                style="color:red;font-weight:bold;font-size:2rem;margin-left:-0.6rem;margin-top:-0.6rem;color:red;position:absolute">.</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item">Notifications</div>


                            <a href="#"
                                class="d-flex align-items-center list-group-item list-group-item-action list-group-item-light"
                                data-pjax>

                                <div class="flex-fill" style="font-size:12px">TExt</div>
                                <div class="small text-muted" style="font-size:10px;padding:0px 2px ">
                                    2 days ago </div>
                            </a>
                            <div class="dropdown-item empty disabled">You are all caught up 👏</div>



                            <div class="dropdown-item">
                                <div class="row">
                                    <a href="notification" class="col" data-pjax>See all</a>
                                    <a href="notification?clear=1" class="col text-right" data-read>Mark as read</a>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="container">




                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </div>
   
    <footer class="pt-3">&nbsp;</footer>

    <div class="modal" id="spp-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content"></div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
   
    @if ($success = Session::get('success'))
        <script>
            swal("Success", "{{ $success }}!", "success");
        </script>
    @endif

    @if ($errore = Session::get('errore'))
        <script>
            swal("Errore", "{{ $errore }}!", "error");
        </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.6/dist/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>



    <script src="js/jquery.pjax.js?v=08-10"></script>
    <script src="js/27-10/spp_clients.js"></script>






</body>

</html>
