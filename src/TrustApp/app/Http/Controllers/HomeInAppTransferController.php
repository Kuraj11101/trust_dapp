<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use view;


class HomeInAppTransferController extends Controller
{
    //

    /**
     * Show the application In App Transfer Results.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
	 public function update_index()
	 {
		 $users = User::count();

         $user = User::first();
         // $last = User::orderBy('id', 'desc')->first(); //last user
         // $first->getKey() !== $last->getKey(); //true
           $user->balanceInt; //0

          //$firstWallet = $first->createWallet(['username' => 'First User Wallet']);
          //$lastWallet = $last->createWallet(['username' => 'Second User Wallet']);

        //   $username = $request->username;
        //   $cash = $request->cash;
        //   $message = $request->message;

          $user->deposit(0);
          $user->balance; //cash
          $user->balanceInt; //cash

		 $widget = [
			'users' => $users,
		 ];

		 return view('homeinapptransfer', compact('widget'));
	 }

    public function HomeInAppTransfer(Request $request)
   {


      $user = User::first();
     // $last = User::orderBy('id', 'desc')->first(); //last user
     // $first->getKey() !== $last->getKey(); //true
      $user->balanceInt; //0

      //$firstWallet = $first->createWallet(['username' => 'First User Wallet']);
      //$lastWallet = $last->createWallet(['username' => 'Second User Wallet']);

      $user->username = $request->input('username');
      $user->cash = $request->input('cash');
      $user->message = $message->input('message');

      $user->deposit('cash');
      $user->balance; //cash
      $user->balanceInt; //cash

   }
}
