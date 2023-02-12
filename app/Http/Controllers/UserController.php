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


    public function  Create(Request $request)
    {
 
        $user= new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->password=bcrypt($request->password);
        $user->save();
       return 'User created successfully';

    }

    public function Update(Request $request)
    {

        $user =User::findOrFail($request->id);
       if($request->name!=null) $user->name=$request->name;
       if($request->email!=null) $user->email=$request->email;
       if($request->phone!=null) $user->phone=$request->phone;
       if($request->password!=null) $user->password=bcrypt($request->password);
        $user->save();
        return $user;
 
    }

    public function  userDelete(Request $request)
    {
        $user =User::findOrFail($request->id);
        $user->delete();
        return 'User deleted';
    }

}
