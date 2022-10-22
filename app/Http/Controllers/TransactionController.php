<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::where("from_user_id", auth()->user()->id)->orWhere("to_user_id", auth()->user()->id)->orderBy("id", "desc")->paginate(10);
        return view('transactions', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaction = new Transaction();
        $transaction->transaction_id = "TR" . uniqid();
        $transaction->type = $request->type;
        $transaction->amount = $request->amount;
        $transaction->status = 2;
        $transaction->from_user_id = auth()->user()->id;


        if ($request->type == 'add') {
            $transaction->save();
            return view('razorpayView', ['transaction' => $transaction]);
        }

        if ($request->amount > auth()->user()->wallet) {
            return redirect()->back()->with('errore', 'InSufficient Balance');
        }
        $transaction->to_user_id = User::where("mobile",$request->mobile)->first()->id ;
        $transaction->completed_at = now();
        $transaction->status = 1;
        $transaction->save();

        $from_user = User::find($transaction->from_user_id);
        $from_user->wallet -= $transaction->amount;
        $from_user->save();

        $to_user = User::find($transaction->to_user_id);
        $to_user->wallet += $transaction->amount;
        $to_user->save();

        return redirect()->back()->with('success', "₹$transaction->amount Sent To  $to_user->name");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }

    public function send_money()
    {
        return view('send_money');
    }

    public function CheckTransactionStatus()
    {  $transactions=Transaction::where("status",2)->get();
        foreach ($transactions as $key => $transaction) {
             $transaction->status=0;
             $transaction->save();

        }
       
    }
    public function add_money()
    {
        return view('add_money');
    }
}
