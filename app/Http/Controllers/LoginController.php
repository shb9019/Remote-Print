<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Adldap\Laravel\Facades\Adldap;
use Carbon\Carbon;

class LoginController extends Controller
{
	public function redirect(Request $request)
	{
		$current_time = Carbon::now();

		if($request->session()->has('users'))
		{
			$username = $request->session()->get('username');
			return view('dashboard');
		}

		else
		{
			return view('auth/login',['data' => 'First Redirection']);
		}
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
			return redirect('login')->withErrors($validator)->withInput();
		}
		else
		{
			$ldap = $this->ldapAuth($data);
			
			if($ldap)
			{
				$request->session()->put('key','one');
				return view('home');
			}
			else
			{
				return view('auth/login',['data' => 'Invalid Credentials']);
			}	
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
		try{
			Adldap::connect();
			
			if(Adldap::auth()->attempt($data['username'],$data['password'],$bindAsUser=true)) {
				return true;
			}	 
			return false;
		
		} catch (\Exception $e){
			abort(500);
		}
	}
}