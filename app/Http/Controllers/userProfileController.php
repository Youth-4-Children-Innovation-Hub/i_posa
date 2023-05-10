<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class userProfileController extends Controller
{
    public function index()
    {
        
        $userData = auth()->user();
        $id = $userData->id;
        $userRole= DB::table('users')
                        ->join('roles', 'users.role_id', '=', 'roles.id')
                        ->where('users.id', $id)
                        ->select('roles.role')
                        ->first();
        return view('users.user-profile', compact('userData', 'userRole'));
    }

    public function edit(Request $request)
    {
     
      $name = $request->fullName;
      $email = $request->email;
      $userData=auth()->user();
      $user_id=$userData->id;
      DB::update('update users set name = ?, email = ? where id = ?'
        ,[$name, $email, $user_id]);
      return redirect()->back();


    }

    public function changePass(Request $request){
      $userData = auth()->user();
      $old_password = $request->password;
      $new_password = $request->newpassword;
      $renewpassword = $request->renewpassword;
      $user_id = $userData->id;

      if (Hash::check($old_password, $userData->password)) { 
        if($new_password == $renewpassword){
          $renewpassword = Hash::make($renewpassword);
          DB::update('update users set password = ? where id = ?' ,[$renewpassword, $user_id]);
          return redirect()->back();
        } else{
          echo 'hell no';
        }
    }
    else{
      echo 'Your old password is invalid  ';
    }

    }


}
