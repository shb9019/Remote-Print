<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class LoginController extends Controller
{
	public function login(Request $request)
	{
		if($request->session()->has('users'))
		{
			return view('');
		}	

	}

}
