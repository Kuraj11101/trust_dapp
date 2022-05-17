<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use view;

class UseCreditController extends Controller
{
    //
    public function index()
	{
		 $users = User::count();

		 $widget = [
			'users' => $users,
		 ];

		 return view('usecredit', compact('widget'));
	}
}
