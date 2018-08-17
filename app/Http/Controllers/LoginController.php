<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Player;

class LoginController extends Controller
{
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
	 * checks the password and logs in the user
	 * 
	 * @return: redirect to lobby
	 */
	public function login(Request $request) {
		//validate the form
		$this->validate($request, [
			'username' => 'required',
			'password' => 'required'
		]);

		//verify the password
		auth()->attempt(request(['username', 'password']));

		return redirect()->route('listGames');
	}

	/**
	 * logs out the current player
	 */
	public function logout() {
		auth()->logout();
	}
}
