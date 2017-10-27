<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Adldap\Laravel\Facades\Adldap;
use Carbon\Carbon;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirect(Request $request)
    {
        $current_time = Carbon::now();

        if($request->session()->has('users'))
        {
            $username = $request->session()->get('username');
            return view('dashboard',$data);
        }

        else
        {
            return view('auth/login');
        }

        //return view('welcome');
    }

    public function loginValidate(Request $request)
    {
        $data = Input::except(array('_token')) ;

        $data = $this->sanitize($data);

        $rules = array('username' => 'required|integer|min:100000000|max:999999999',
                'password' => 'required'
        );

        $messages = array(
            'required' => 'The :attribute field is required',
            'integer' => ':attribute is an integer '
        );

        $validator = Validator::make($data,$rules);

        if($validator->fails())
        {           
            return $this->ldapAuth($data);
        }
        else
        {
            return view('dashboard',['username' => $data['username'], 'password' => $data['password']]); 
        }
    }

    public function sanitize($data)
    {
        $data['password'] = filter_var($data['password'],FILTER_SANITIZE_STRING);
        $data['username'] = filter_var($data['username'],FILTER_SANITIZE_STRING);

        return $data;
    }

    public function ldapAuth($data)
    {
        
    }
}
