<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Incident;
use Image;

class MainController extends Controller
{
    //insert users credentials into datanbase
    public function store(Request $request)
    {
        $data=$request ->validate([
        'name'=>'required',
        'cooperative'=>'required',
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
 public function storeCase(Request $request)
    {
        $request ->validate([
        'image'=>'required',
        'disease'=>'required',
        'status'=>'required'
        ]);


        if($request->hasFile('image')){
          $photo=$request->file('image') ;
        $filename = $request->file('image')->getClientOriginalName();
    Image::make($photo)->save(public_path('/image/'.$filename));
    $id=IdGenerator::generate(['table'=>'incidents','length'=>10,'prefix'=>'INC-']);
    $input= new Incident([
    "farmer"=>$request->farmer,
    "cooperative"=>$request->cooperative,
    "disease"=>$request->disease,
    "image"=>$filename,
    ]);
    //$post->save();
         $input->save();
         //Student::create($input);
      }
  // $users= Incident::create($data);
 return response()->json([
'status'=>true,
'message'=>'user created',
'data'=>$users,
    ]);

}


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