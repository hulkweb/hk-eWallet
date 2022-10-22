@extends('layout')
@section('content')
<div class="container">
    <h1>Welcome {{auth()->user()->name}}</h1>
    <br><br>
    <h2 class="alert alert-primary text-center">
      
        <br><i class="fas fa-wallet text-primary   fa-3x"></i>  &nbsp;&nbsp;&nbsp;<b> {{ number_format(auth()->user()->wallet,2) }}</b>
    </h2>
    <div class="header-responsive">
        <a href="/add_money" class="btn btn-primary">Add Money</a>
        <a href="/send_money" class="btn btn-primary">Send Money</a>

    </div>
</div>
@endsection