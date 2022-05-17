<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    /**
     *  login api
     *  @returnn \Illuminate\Http\Response
     */

    public function login() {

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('Digits')->accessToken;
            return response()->json(['success' => $success], $this-> successStatus);
        } else {
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
     *  Register api
     *
     *  @return \Illuminate\Http\Response
     */

         public function register(Request $request)
         {
             $validator = Validator::make($request->all(), [

                 'first_name' => 'required',
                 'last_name' => 'required',
                 'username' => 'required',
                 'email' => 'required|email',
                 'confirm_password' => 'required|same:password',
            ]);

            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()], 401);
            }
            $input = $request->all();
            $input['password'] = brcrypt($input['password']);
            $user = User::create($input);
            $success['token'] = $user->createToken('Digits')->accessToken;
            $success['first_name'] =$user->first_name;
            return response()->json(['success'=>$success], $this -> successStatus);
         }
        /**
         *  details api
         *  @return \Illuminate\Http\Response
         */

        public function details()
        {
            $user = Auth::user();
            return response()->json(['success' => $user], $this-> successStatus);
        }
}