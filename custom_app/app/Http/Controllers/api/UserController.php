<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
     public function login(Request $request)
    {
        $user = User::where('email', $request->email)->where('password', $request->password)->first();
        if($user){
        	return response()->json(['status' => "User Sign In Sucesfully!", 'user' => $user], 200);
        }else
        {
        	return response()->json(['status' => "Please Check Your Credentials!"], 404);
        }

    }
}
