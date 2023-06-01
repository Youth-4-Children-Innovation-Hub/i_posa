<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Picture;

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
          return redirect()->back()->with('message', 'Password is successfully changed.');
        } else{
          return redirect()->back()->with('error', 'New password confirmation failed. Try again');
        }
    }
    else{
      return redirect()->back()->with('error2', 'old password is wrong, try again');
    }

    }

    public function changeProfilePicture(Request $request){
      $request->validate([
        'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);
      $user_id = auth()->user()->id;
      $photo_name =$request->file('picture')->getClientOriginalName();
      $path = $request->file('picture')->storeAs('images', $photo_name, 'public');
      $total_path = '/storage/'.$path;
      DB::update('update users set profile_photo = ? where id = ?' ,[$total_path, $user_id]);
      return redirect()->back();

    }


}
