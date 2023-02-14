<?php

namespace App\Http\Controllers;

use App\Models\Sold;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Exception;
use GuzzleHttp\Client;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:4'
        ]);
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth()->attempt($credentials, false)) {
            $client = new Client(['verify' => false]);
            try {
                $response = $client->post("http://auto.loc/oauth/token", [
                    'form_params' => [
                        'grant_type' => 'password',
                        'client_id' => 2,
                        'client_secret' => "0ostWlSYCeP7V5QQxLdPHHPA2pnRAB3Kb2HWH8MH",
                        'username' => $request->email,
                        'password' => $request->password,
                        'scope' => '*'
                    ]
                ]);
                return json_decode($response->getBody());
            } catch (Exception $e) {
                return response()->json([
                    'message' => $e->getMessage()
                ]);
            }
        } else {
            return response()->json(['errors' => 'password or login xato'], 401);
        }
    }


    public function refreshToken(Request $request)
    {
        $validator = $request->validate( [
            'refresh_token' => 'required|string'
        ]);
        $client = new Client();
        try {
            $response = $client->post("http://auto.loc/oauth/token", [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $request->refresh_token,
                    'client_id' => config('services.passport.id'),
                    'client_secret' => config('services.passport.secret'),
                    'scope' => '',
                ]
            ]);
            return $response->getBody();
        } catch (Exception $e) {
            return response()->json(['message'=>$e->getMessage()]);
        }
    }
    
  
    public function logOut(Request $request){

        $solds=Sold::all();
        $products=Product::all();
        
        
        foreach($products as $product){
            $product->product_chosen=0;
            $product->save();
        } 
    
        foreach($solds as $sold){
            $sold->delete();
        }
        

        $request->user()->tokens()->delete();
        
        return response([
            'logged out'
        ]);
    }
    
    
}




// public function login(AuthRequest $request)
// {
   
//     $user = User::where('email', $request->email)->first();
 
//     if (! $user || ! Hash::check($request->password, $user->password)) {
//        return response(['The provided credentials are incorrect.']);
//     }
 
//     return response([

//         'token' => $user->createToken($user->name)->plainTextToken
//     ]);
// }