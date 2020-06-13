<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Modules\Core\Models\AdminUser;


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
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        $user = AdminUser::where([
            'email' => $request->email,
            'password' => md5(md5($request->password))
        ])->first();


        if ($user)       
        {
            $this->guard()->login($user, $request->has('remember'));
            return redirect()->route('home');
        }
        else{
            return redirect()->route('login')
                ->with('error','Incorrect Email and Password.');
        }
    }
}
