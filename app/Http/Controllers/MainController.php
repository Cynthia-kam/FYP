<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MainController extends Controller
{
    //insert users credentials into datanbase
    public function store(Request $request)
    {
        $data= $request ->validate([
        'username'=>'required',
        'password'=>'required'
        ]);
   $users= User::create($data);
 return response()->json([
'status'=>true,
'message'=>'user created',
'data'=>$users,
    ],201);

}

    //login into the system
public function check(Request $request){
      $request->validate([
   'username'=>'required',
    'password'=>'required']);

   $userInfo= User::where('username','=',$request->username)->first();
   if (!$userInfo) {
       return response()->json([
'status'=>true,
'message'=>'user not found',
'data'=>$request,
    ]);
}
 else{
        //check password
        if ($request->password==$userInfo->password) {
           // $request->session()->put('LoggedUser',$userInfo->phone);
               return response()->json([
'status'=>true,
'message'=>'successfully logged in',
'data'=>$request,
    ]);
            
        }}
}

    //send image data into database



    //retrieve user data from database
 public function getUsers(Request $request){
    $users= user::all();
         return response()->json([
'status'=>true,
'message'=>'users retrieved',
'data'=>$users,
    ]);

 }
}