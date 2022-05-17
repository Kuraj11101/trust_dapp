<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use view;

class RequestPaymentController extends Controller
{
    //
    public function index()
	 {
		 $users = User::count();

		 $widget = [
			'users' => $users,
		 ];

		 return view('requestpayment', compact('widget'));
	 }
}
