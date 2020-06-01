<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') && 
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        
        if ($this->attemptLogin($request)) {
            $user = \Illuminate\Support\Facades\Auth::user();
            if($user->hasVerifiedEmail()) { 
                $request->session()->flash('op', 'logged');
                
                // $name = \Auth::user()->name;
                // $id = \Auth::user()->id;
                // $request->session()->flash('op', 'Welcome '. $name);
                // $request->session()->put('iduser', $id);
                return $this->sendLoginResponse($request);
            } else {
                $user->sendEmailVerificationNotification();
                \Illuminate\Support\Facades\Auth::logout(); 
                $request->session()->flash('op', 'reverification');
            }
        }
        $this->incrementLoginAttempts($request); 
        return $this->sendFailedLoginResponse($request);
    }

    public function showLoginForm(Request $request)
    {
        // $opSession = $request->session()->put('op');
        // $request->session()->put('op', 'verified');
        
         $messages = [
            'verified' => 'Usuario verificado, ya puede iniciar sesion',
        ];  
        
        $opSession = $request->session()->get('op');
        $alertMessage = null;

        if(isset($messages[$opSession])) {
            $alertMessage = $messages[$opSession];
        } else {
             $alertMessage = $opSession;
        }
      
        // $alertMessage = null;
        // if($opSession !== null) {
        //     $alertMessage = 'No se ha podido identificar, correo de verificación reenviado';
        // }
        return view('auth.login')->with((['alertMessage' => $alertMessage]));
    }
    
}
