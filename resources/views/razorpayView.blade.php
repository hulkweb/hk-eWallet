<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Payment Page </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="favicon.png" rel="icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .razorpay-payment-button {
            position: absolute;
            opacity: 0.1;
        }
    </style>
</head>

<body style="background: #E5EFF1">
    <div id="app">
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-3 col-md-offset-6">

                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Error!</strong> {{ $message }}
                            </div>
                        @endif

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}"
                                role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Success!</strong> {{ $message }}
                                <br>

                            </div>
                            <br>
                            <a href="https://wa.me/918962904724" class="btn btn-primary shadow">Get Your Demo</a>
                        @else
                            <div class="d-flex flex-column justify-content-center">
                                <div class="text-center">
                                    <img src="https://media.giphy.com/media/xTk9ZvMnbIiIew7IpW/giphy.gif" height="200"
                                        alt="">
                                </div>
                                <p class="text-center">Processing Payment... Please wait </p>
                            </div>
                        @endif


                        <div class="d-flex">

                            @if (isset($transaction))
                                <div class="card-body text-center">
                                    <form action="{{ route('razorpay.store') }}" method="POST">
                                        @csrf
                                        <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="{{ env('RAZORPAY_KEY') }}"
                                            data-amount="{{ $transaction['amount'] }}" data-buttontext="Pay" data-name="Add Amount "
                                            data-description="Best on Chaavinirman" data-image="https://www.chhavinirman.com/logo.png"
                                            data-prefill.name="{{ $transaction->from['name'] }}" data-prefill.email="{{ $transaction->from['email'] }}"
                                            data-prefill.contact="{{ $transaction->from['mobile'] }}" data-theme.color="#ff7529"></script>
                                        <input type="hidden" name="transaction_id"
                                            value="{{ $transaction['transaction_id'] }}">
                                    </form>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        $(".razorpay-payment-button").click();
    </script>
</body>

</html>
