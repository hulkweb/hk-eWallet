@extends('layout')
@section('content')
    <div class="container">
        <h2>Send Money</h2>
        <br>
        <div class="row">
            <div class="col-sm-6 card p-3">
                <form action="{{ route('transactions.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Mobile</label>
                        <input type="number" name="mobile" class="form-control" onkeyup="CheckNumber(this.value)">
                        <span id="message"></span>
                        <input type="hidden" name="type" value="send" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Amount</label>
                        <input type="number" name="amount" class="form-control">
                        <span id="message"></span>
                    </div>
                    <div class="text-center p-2">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <i class="fa fa-times-circle-o" aria-hidden="true"></i>
    <script>
        function CheckNumber(mobile) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/check-number',
                data: {
                    'mobile': mobile,
                },
                type: 'post',
                success:   function(data, status) {
                    if (data.success) {
                        $("#message").html(
                            `<span class="text-primary"><i class="fa fa-check-circle-o text-primary" aria-hidden="true"></i> ${data.name} </span>`)
                    } else {
                        console.log(data);
                        $("#message").html(
                            ` <span class='text-danger'><i class="fa fa-times-circle-o text-danger" aria-hidden="true"></i> No User Found</span>`)

                    }
                },
                error: function(x, xs, xt) {
                    alert(x);

                }
            });

            
        }
    </script>
@endsection
