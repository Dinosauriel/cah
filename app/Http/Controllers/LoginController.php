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
			'password' => 'required'
		]);

		//verify the password
		$adminPassword = config('auth.cah_admin_password');
		$isCorrectPassword = Hash::check($request->admin_password, $adminPassword);
		if (!$isCorrectPassword) {
			return redirect()->route('root');
		}

		//create a new player
		$player = Player::create([
			'username' => 'hi',
			'is_admin' => 1,
		]);

		//log In player
		auth()->login($player);

		return redirect()->route('listGames');
	}

	/**
	 * logs out the current admin
	 */
	public function logout() {
		auth()->logout();

		return redirect()->route('root');
	}
}
