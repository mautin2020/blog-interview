<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        
        $request->validate([
            'username' => 'required|string',
            'password'=> 'required|string',
        ]);

        $credentials = request(['username','password']);

        if(!Auth::attempt($credentials)){
            return response()->json([
            'messages'=> 'Invalid Credentials',
            ],422);
    }

    $user = $request->user();
    $tokenResult = $user->createToken('Personal Access Token');
    $token = $tokenResult->plainTextToken;

    return response()->json([
        'accessToken' => $token,
        'token_type' => 'Bearer'
    ]);
}

public function logout(Request $request){
    $request->user()->tokens()->delete();

    return response()->json([
        'messages' => 'User Successfully logged out'
    ]);
}
}
