<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signup(Request $request){
        // return $request->all();
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return "User successfully registered.";
    }

    public function login(Request $request){
        $user_credentials = $request->only('email', 'password');

        if(Auth::attempt($user_credentials)){
            $token = $request->user()->createToken('token')->plainTextToken;
            return response()->json(['msg' => "Login successful.", 'token' => $token], 200);
        }else{
            return response()->json(['msg' => "Invalid credentials"], 401);
        }
    }
}
