<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Player;

class LoginController extends Controller
{

	use AuthenticatesUsers;

	public function username()
	{
    	return 'username';
	}

    /**
     * display an admin login
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminLogin(Request $request)
    {
        return view('admin_login');
    }

    /**
     * display a generic login
     *
     * @return \Illuminate\Http\Response
     */
    public function showLogin(Request $request)
    {
		return view('login');
    }

	/**
	 * checks the password and logs in the user using the sessions provider
	 * returns the cah_token for future ajax requests
	 * 
	 * @return: redirect to lobby
	 */
	public function login(Request $request) {
		if (Auth::guard('web')->check()) {
			return response()->json([
				'message' => 'already logged in'
			], 200);
		}

		//validate the form
		$validator = Validator::make($request->all(), [
			'username' => 'required',
			'password' => 'required'
		]);

		if ($validator->fails()) {
			return response()->json([
				'message' => 'missing credentials'
			], 400);
		}

		//verify the password
		if (Auth::guard('web')->attempt($request->only(['username', 'password']))) {
			return response()->json([
				'message' => 'success',
				'player' => Auth::user()
			], 202);
		} else {
			return response()->json([
				'message' => 'invalid credentials'
			], 401);
		}
	}

	/**
	 * logs out the current player
	 */
	public function logout() {
		Auth::guard('web')->logout();
		return response()->json([
			'message' => 'logout-success'
		], 200);
	}
}
