<?php

namespace App\Http\Controllers;

use App\Mail\password;
use App\Mail\HelloMail;
use App\Notifications\mailNotification;
use Illuminate\Support\Facades\Notification;
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

        $users = User::select('users.id', 'users.name', 'users.phone_number', 'users.email', 'roles.role', 'users.status')
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
            $user->phone_number = $request->phone;
            $user->email = $request->email;
            $user->role_id = $request->role;
            $user->save();
            
            return redirect()->back()->with('sweet_success', "User {$user->name} updated successfully.");
        } catch (Exception $e) {
            return $e->getMessage();
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

    

    // Only keep the Create method for user creation
    public function Create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => ['required', 'regex:/^0[67][0-9]{8}$/', 'unique:users,phone_number'],
            'role' => 'required|integer|exists:roles,id',
        ], [
            'email.unique' => 'The email address is already registered.',
            'phone.unique' => 'The phone number is already registered.',
            'phone.regex' => 'Phone number must start with 06 or 07 and be 10 digits.',
            'role.required' => 'Please select a valid role.',
            'role.integer' => 'Please select a valid role.',
            'role.exists' => 'Please select a valid role.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = new User();
            $user->name = $request->name;
            $user->phone_number = $request->phone;
            $user->email = $request->email;
            $user->password = Hash::make('12345678');
            $user->role_id = $request->input('role');
            $user->save();

            return response()->json([
                'success' => true,
                'message' => "User {$user->name} added successfully."
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create user. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function setStatus($id){
        $user = DB::table('users')->find($id);
        if(!$user) {
            return redirect('users')->with('sweet_error', 'User not found');
        }
        $newStatus = $user->status == 1 ? 0 : 1;
        DB::table('users')->where('id', $id)->update(['status' => $newStatus]);
        $message = $newStatus ? 'User activated successfully.' : 'User deactivated successfully.';
        $type = $newStatus ? 'success' : 'info';
        return redirect('users')->with('sweet_success', $message);
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
            return response()->json(['status' => true, 'message' => "User {$user->name} deleted successfully."]);
        }
        return response()->json(['status' => false, 'message' => "Failed to delete user {$user->name}."]);
    }

}
