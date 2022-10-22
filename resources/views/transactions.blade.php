@extends('layout')
@section('content')
    <div class="container">
        <h2>Transaction</h2>


        <table class="table portal-table section asd">
            <thead>
                <tr>
                    <th>
                        Num
                    </th>
                    <th>
                        Amount
                    </th>
                    <th>
                        Type
                    </th>
                    <th>
                        By / To
                    </th>
                    <th>
                        Status
                    </th>


                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $i => $transaction)
                    <tr>
                        <th>
                            {{ $i + 1 }} )
                        </th>
                        <th>
                            <span href="#" class="" data-pjax>₹ {{ $transaction->amount }}</span>
                        </th>

                        <th>
                            <span href="#" class=""
                                data-pjax>{{ $transaction->type == 'add' || ($transaction->type == 'send' && $transaction->to_user_id == auth()->user()->id) ? 'Desposited' : 'Withdrawn' }}</span>
                        </th>
                        <th>
                            <span href="#" class=""
                                data-pjax>{{ $transaction->to_user_id == null ? 'You' : $transaction->from->name }}</span>
                        </th>
                        <th>
                            <span href="#" class="" data-pjax>{!! $transaction->status == 1
                                ? "<span class='badge badge-primary' >success</span>"
                                : ($transaction->status == 2
                                    ? "<span class='badge badge-warning' >pending</span>"
                                    : "<span class='badge badge-danger' >failed</span>") !!}</span>
                        </th>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center p-2">{{ $transactions->links() }}</div>

    </div>
@endsection
