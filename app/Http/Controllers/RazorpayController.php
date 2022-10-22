<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function index()
    {

        return view('razorpayView');
    }
    public function store(Request $request)
    {

        $timezone = "Asia/Kolkata";
        date_default_timezone_set($timezone);

        $input = $request->all();

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
            } catch (Exception $e) {
                return  $e->getMessage();

                return redirect()->back()->with('errore', $e->getMessage());
            }
        }


        $transaction = Transaction::find(request('transaction_id'));
        $transaction->status = 1;
        $transaction->completed_at = now();
        $transaction->save();
   
        if($transaction->type=='add'){
             $user=User::find($transaction->to_user_id);
             $user->wallet+=$transaction->amount;
             $user->save();
        }else{
            $from_user=User::find($transaction->from_user_id);
            $from_user->wallet-=$transaction->amount;
            $from_user->save();
            
            $to_user=User::find($transaction->to_user_id);
            $to_user->wallet-=$transaction->amount;
            $to_user->save();

        }

        return redirect()->back()->with('success', 'Payment successful');
    }
}
