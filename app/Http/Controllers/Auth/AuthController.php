<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Requests;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;
use App\Activity;
use Mail;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'user_name'=> 'required|min:4|max:255',
            'password'=>'required|min:8|max:255'
            ]);

        if (Auth::attempt($request->only(['user_name','password']),
            $request->has('remember')))
        {   
            $user = $request->user()->id;
            if($this->auth->user()->hasRole('administrator'))
            {
                ////////// Activity Log/////////////
                $from_user   = $request->user()->id;
                $description = " signed into the account.";
                Activity::create(['from_user'=> $from_user,'description'=> $description]);
                ///////////////////////////////////

                return redirect()->route('admin-home');
            }
            if($this->auth->user()->hasRole('receptionist') && !$this->auth->user()->hasRole('doctor') && !$this->auth->user()->hasRole('nurse'))
            {   
                ////////// Activity Log/////////////
                $from_user   = $request->user()->id;
                $description = " signed into the account.";
                Activity::create(['from_user'=> $from_user,'description'=> $description]);
                ///////////////////////////////////

                return redirect()->route('reception-home');
            }
            if($this->auth->user()->hasRole('triage'))
            {
                ////////// Activity Log/////////////
                $from_user   = $request->user()->id;
                $description = " signed into the account.";
                Activity::create(['from_user'=> $from_user,'description'=> $description]);
                ///////////////////////////////////

                return redirect()->route('triage-home');
            }
            if($this->auth->user()->hasRole('doctor') && $this->auth->user()->hasRole('receptionist'))
            {
                ////////// Activity Log/////////////
                $from_user   = $request->user()->id;
                $description = " signed into the account.";
                Activity::create(['from_user'=> $from_user,'description'=> $description]);
                ///////////////////////////////////

                return redirect()->route('doctor-home');
            }
            if($this->auth->user()->hasRole('accountant'))
            {
                ////////// Activity Log/////////////
                $from_user   = $request->user()->id;
                $description = " signed into the account.";
                Activity::create(['from_user'=> $from_user,'description'=> $description]);
                ///////////////////////////////////

                return redirect()->route('accounts-home');
            }
            if($this->auth->user()->hasRole('pharmacy'))
            {
                ////////// Activity Log/////////////
                $from_user   = $request->user()->id;
                $description = " signed into the account.";
                Activity::create(['from_user'=> $from_user,'description'=> $description]);
                ///////////////////////////////////

                return redirect()->route('pharmacy-home');
            }
            if($this->auth->user()->hasRole('nurse'))
            {
                ////////// Activity Log/////////////
                $from_user   = $request->user()->id;
                $description = " signed into the account.";
                Activity::create(['from_user'=> $from_user,'description'=> $description]);
                ///////////////////////////////////

                return redirect()->route('nurse-home');
            }
            if($this->auth->user()->hasRole('laboratorist'))
            {
                ////////// Activity Log/////////////
                $from_user   = $request->user()->id;
                $description = " signed into the account.";
                Activity::create(['from_user'=> $from_user,'description'=> $description]);
                ///////////////////////////////////

                return redirect()->route('lab-home');
            }

        } else {
            ////////// Activity Log/////////////
            $from_user   = $request->input('user_name');
            $description = " failed to sign into the account.";
            Activity::create(['from_user'=> $from_user,'description'=> $description]);
            ///////////////////////////////////

            return redirect()->route('home')->with('error','We are sorry. Your username or password is incorrect. We could not sign you in with those details. Please try again.');
        }
    }

    public function changePassword()
    {
        return view('templates.main.change-password');
  }

  public function getLogout(Request $request)
  {   
    ////////// Activity Log/////////////
    $from_user   = $request->user()->id;
    $description = " signed out from the account.";
    Activity::create(['from_user'=> $from_user,'description'=> $description]);
    ///////////////////////////////////

    Auth::logout();

    return redirect()->route('home')->with('success','You have signed out successfully. Thank you for using cHealth.');;
}

public function homeCheck(Request $request){

    if (Auth::check()) {
        ////////// Activity Log/////////////
        $from_user   = $request->user()->id;
        $description = " was signed out from the account and forced to sign in.";
        Activity::create(['from_user'=> $from_user,'description'=> $description]);
        ///////////////////////////////////
        Auth::logout();
    }

    return redirect()->route('home')->with('error','Kindly, Sign in to continue.');
}

}
