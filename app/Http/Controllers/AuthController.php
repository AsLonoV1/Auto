<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
  
    public function login(AuthRequest $request)
    {
       
        $user = User::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->password, $user->password)) {
           return response(['The provided credentials are incorrect.']);
        }
     
        return response([

            'token' => $user->createToken($user->name)->plainTextToken
        ]);
    }

    
    public function logOut(Request $request){

        $request->user()->tokens()->delete();

        return response([
            'logged out'
        ]);
    }

    public function test(Request $request){

    
        return response([
            $request->user()->name
        ]);
    }

}



