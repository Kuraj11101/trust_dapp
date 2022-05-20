<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaktion;
use Auth;
use App\Models\Account;
use App\Models\User;

class TransaktionController extends Controller
{
    //
    public function getcarddeposit()
    {
        return view('clients/carddeposit');
    }
    public function getTransaktions()
    {
        $user = Auth::user();
        $transaktions=Transaktion::where('user_id',$user->id)->paginate(2);

        return view('clients.transaktion',compact('transaktions'));
    }
    public function getSend()
    {
        return view('clients.send');
    }
    public function postSend(Request $request)
    {
        $user = Auth::user();
        $sender_account=Account::where('user_id',$user->id)->first();
        $balance=$sender_account->balance;
        $balance=(float)$balance;

        $amount=$request->input('amount');
        $amount=(float)$amount;
        $remaining_balance=$balance-$amount;
        if($remaining_balance > 0){
            // dd($remaining_balance);
            $receiver_email=$request->input('email');
            $receiver=User::where('email',$receiver_email)->first();
            $receiver_account=Account::where('user_id',$receiver->id)->first();
            $receiver_current_bal=$receiver_account->balance;
            $receiver_account->balance=$receiver_current_bal+$amount;
            $receiver_account->save();

            $transaktion=new Transaktion();
            $transaktion->type='send';
            $transaktion->trans_id=str_random(15);
            $transaktion->amount=$amount;
            $transaktion->currency='usd';
            $transaktion->description=$request->input('description');
            $transaktion->fee='0';
            $transaktion->user_id=$id =Auth::user()->id;
            $transaktion->sender=Auth::user()->email;
            $transaktion->status='completed';
            $transaktion->receiver=$receiver->email;

            $transaktion->save();


            $sender_account=Account::where('user_id',$user->id)->first();
            $sender_account->balance=$remaining_balance;
            $sender_account->save();

            \Session::put('success','Funds sent successfully');
            return redirect()->route('home');
        }else
        {
            \Session::put('error','Insufficient funds');
            return redirect()->route('send');
        }


    }
    public function cardDeposit(Request $request)
    {
        $stripe = new \Stripe\StripeClient("sk_test_51GrrIyKCyJL0SnmtUPl67iH7JqMOs7oHHlINOMYSE1ItdYJ7Z58t9phRwNVNo23Z1SSQiD1XI3B4IZBE1RXi8gI700XAgwNU2S");
        // \Stripe\Stripe::setApiKey("sk_test_51GrrIyKCyJL0SnmtUPl67iH7JqMOs7oHHlINOMYSE1ItdYJ7Z58t9phRwNVNo23Z1SSQiD1XI3B4IZBE1RXi8gI700XAgwNU2S");

        try{

           $payment= \Stripe\Charge::create(array(
                "amount" => $request->input('card-amount'),
                "currency" => "usd",
                "source" => $request->input('stripeToken'), // obtained with Stripe.js
                "description" => "Card Deposit to My-Wallet"
           ));
        $transaktion=new Transaktion();
        $transaktion->type='card';
        $transaktion->trans_id=$payment->id;
        $transaktion->amount=$payment->amount;
        $transaktion->currency=$payment->currency;
        $transaktion->description=$payment->description;
        $transaktion->fee='0';
        $transaktion->user_id=$id =Auth::user()->id;
        $transaktion->sender=Auth::user();
        $transaktion->status='completed';
        $transaktion->receiver=Auth::user();

        $transaktion->save();
        }
        catch(\Exception $ex){
            return redirect('/carddeposit')->with('error',$ex->getMessage());
        }
        return redirect()->back();

    }

}
