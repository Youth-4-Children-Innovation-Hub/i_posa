<?php

namespace App\Http\Controllers;

use App\Mail\password;
use App\Mail\HelloMail;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;







class UserController extends Controller
{

    public function GetUsers(Request $request)
    {

        if (!$request->session()->exists('pagination_number')) {
            $request->session()->put('pagination_number', 3);
        }
        if ($_GET) {

            if (isset($_GET['number'])) {
                $number =  $_GET['number'];
                $request->session()->put('pagination_number', $_GET['number']);
            }
        }


        $userData = auth()->user();
        $id = $userData->id;
        $userRole = DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', $id)
            ->select('roles.role')
            ->first();

        $roles = Role::all();

        $users = User::select('users.id', 'users.name', 'users.phone_number', 'users.email', 'roles.role')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->orderBy('users.created_at', 'DESC')->get();

        return view('users.users', ['roles' => $roles, 'users' => $users, 'userData' => $userData, 'userRole' => $userRole, 'paginate' => $request->session()->get('pagination_number')]);
    }

    public function UpdateForm($id)
    {

        $user = User::select('users.id', 'users.name', 'users.phone_number', 'users.email', 'roles.role', 'roles.id AS role_id')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->where('users.id', $id)
            ->first();


        $roles = Role::all();
        $users = User::leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->paginate(10);

        return view('users.update_user', ['user' => $user, 'roles' => $roles, 'users' => $users, 'update_user' => $user]);
    }

    public function Update(Request $request)
    {
        try {
            $user = User::find($request->user_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->national_id = $request->nida;
            $user->role_id = $request->role;
            $user->save();
            return redirect('users')->with('success', 'User added successfully.');
        } catch (Exception $e) {
        }
    }

    public function createUser(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $generated_password = 12345678;
        $user->password = Hash::make($generated_password);
        $user->role_id = $request->input('role');
        $user->save();
        dd('successful');

    }

    

    public function Create(Request $request)
    {
      
           
        try {
            $name1 = $request->name;
            // $nameArray = explode(' ', $name1);
            // $firstName = $nameArray[0];
          
            try {
                // Mail::to($request->email)
                //     ->send(new HelloMail($firstName . 123456, $request->name));
                    $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = Hash::make('12345678');
                    $user->role_id = $request->input('role');
                    $user->save();

                    $userToEmail = User::where('email', $request->email)->first();

                  
                    // $details = [
                    //     'greeting'=>'hi ' . $userToEmail->name,
                    //     'body'=>'You have been registered in the IPOSA system. Click the button below to set password
                    //     for access.',
                    //     'actiontext'=>'Set password',
                    //     'actionurl'=>'http://127.0.0.1:8000/reports_page',
                    //     'lastline'=>'This is the last line',
                    // ];
        
                    // Notification::send($userToEmail, new mailNotification($details));
                   
                return redirect('users')->with('success', 'User added successfully.');
            } catch (\Exception $e) {
                return $e->getMessage();
            }

            

            
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function Search()
    {
        $querry = $_GET['search_querry'];

        if ($querry != null) {
            $userData = auth()->user();
            $id = $userData->id;
            $userRole = DB::table('users')
                ->join('roles', 'users.role_id', '=', 'roles.id')
                ->where('users.id', $id)
                ->select('roles.role')
                ->first();

            $roles = Role::all();
            $users = User::select('users.id', 'users.name', 'users.phone_number', 'users.email', 'roles.role')
                ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
                ->where('name', 'LIKE', '%' . $querry . '%')
                ->orWhere('email', 'LIKE', '%' . $querry . '%')
                ->orWhere('role', 'LIKE', '%' . $querry . '%')
                ->orderBy('users.created_at', 'DESC')
                ->paginate(5);
            return view('users.users', ['roles' => $roles, 'users' => $users, 'userData' => $userData, 'userRole' => $userRole]);
        } else {
            return redirect('users');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);

        return response()->json(
            [
                'status' => 200,
                'user' => $user
            ]
        );
    }

    public function delete(Request $request) {

        $user = User::find($request->id);

        if($user->delete()){
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }

}
