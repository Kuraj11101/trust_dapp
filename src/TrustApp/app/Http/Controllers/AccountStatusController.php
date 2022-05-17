<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use view;

class AccountStatusController extends Controller
{
    //
    public function index()
	 {
		 $users = User::count();

		 $widget = [
			'users' => $users,
		 ];

		 return view('accountstatus', compact('widget'));
	 }
}
