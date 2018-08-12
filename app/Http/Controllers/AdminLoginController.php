<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin_login');
	}
	
	/**
	 * checks the password and logs in the user
	 * 
	 * @return: redirect to lobby
	 */
	public function login(Request $request) {

		//dd($request->admin_password);

		return redirect()->route('listGames');
	}
}
