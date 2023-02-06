<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{


    public function List()
    {
    return   User::limit(10)->get();  
    }


    public function Show(Request $request)
    {
        return  User::where('id',$request->id)->first(); 
    }


    public function Create(Request $request)
    {
 
        User::create($request->all());
       return 'User created successfully';

    }

    public function Update(Request $request)
    {

        $user =User::findOrFail($request->id);
        $user->update($request->all());
        return $user;
 
    }

    public function  userDelete(Request $request)
    {
        $user =User::findOrFail($request->id);
        $user->delete();
        return 'User deleted';
    }








}
