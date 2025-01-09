<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

      protected function attemptLogin(Request $request){

        $credentials = $this->credentials($request);

        $user = \App\Models\User::where('email',$credentials['email'])->first();
          if ($user && $user->status != 1){
            throw ValidationException::withMessages([
                $this->username() => ['Your account is suspended']
            ]);
          }

          return $this->guard()->attempt($credentials);

      }

    public function authenticated(Request $request, $userData)
{   
    // $id = $userData->id;
    //     $userRole= DB::table('users')
    //                     ->join('roles', 'users.role_id', '=', 'roles.id')
    //                     ->where('users.id', $id)
    //                     ->select('roles.role')
    //                     ->first();
    // return view('home')->with('userData', $userData)->with('userRole', $userRole);
    
}


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

