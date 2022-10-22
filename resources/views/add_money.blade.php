@extends('layout')
@section('content')
    <div class="container">
        <h2>Add Money</h2>
        <br>
        <div class="row">
            <div class="col-sm-6 card p-3">
                <form action="{{ route('transactions.store') }}" method="post">
                    @csrf
                    
                    <div class="form-group">
                        <label for="">Amount</label>
                        <input type="number" name="amount" class="form-control">
                        <span id="message"></span>
                        <input type="hidden" name="type" value="add" id="">

                    </div>
                    <div class="text-center p-2">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
@endsection
