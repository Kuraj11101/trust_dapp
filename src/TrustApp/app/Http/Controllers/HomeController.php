<?php

namespace App\Http\Controllers;

use App\Models\User;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Traits\HasWallet;
use Illuminate\Http\Request;
use AshAllenDesign\LaravelExchangeRates\Classes\ExchangeRate;
//use ExchangeRate;
use Auth;
use DB;
//use Transaction;
use View;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
       // $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	 public function index(Request $request)
	 {
     //$input = User::with(input)('username', 'cash', 'message');
		 $user = User::count();

     $first = User::first();
     $last = User::orderBy('id', 'desc')->first();
     $first->getKey() !== $last->getKey();

     $first->balance;
     $last->balance;

     $first->transfer($last, 0);
     $first->balance;
     $last->balance;


		 $user = Auth::user(); // Authenticate user
		 $user->balance; // Check user balance

    //  $user = $request->username;
    //  $user = $request->cash;
    //  $user = $request->message;

    //  $cash = $user->cash;
    //  $cash->balance;

     $user->deposit(0);
     $user->balance; //cash
     $user->balanceInt; //cash

     // Get Wallet Balance
     $user->username; // int(5)
     $user->balance; // int(27)

     //$user->balance; // int(27)
     $user->wallet->refreshBalance();
     $user->balance; //int(42)

     $wallet = $user->wallet;
     $wallet->balance; // int(10)

		 $widget = [
			'user' => $user,
		 ];

		 return view('home', compact('widget'));
	 }

  //  public function inAppTransfer(Request $request)
  //  {


  //     $user = User::first();
  //     //$last = User::orderBy('id', 'desc')->first(); //last user
  //     //$first->getKey() !== $last->getKey(); //true
  //     $user->balanceInt; //0

  //     //$firstWallet = $first->createWallet(['username' => 'First User Wallet']);
  //     //$lastWallet = $last->createWallet(['username' => 'Second User Wallet']);

  //     //$user->username = $request->input::get('username');
  //     //$user->cash = $request->input::get('cash');
  //     //$user->message = $message->input::get('message');

  //     $user->deposit(10);
  //     $user->balance; //cash
  //     $user->balanceInt; //cash

  //  }

}
