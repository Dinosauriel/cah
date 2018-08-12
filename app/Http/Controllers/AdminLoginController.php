<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Player;

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

		//validate the form
		$this->validate($request, [
			'admin_password' => 'required'
		]);

		//verify the password
		$adminPassword = config('auth.cah_admin_password');
		$isCorrectPassword = Hash::check($request->admin_password, $adminPassword);
		if (!$isCorrectPassword) {
			return redirect()->route('root');
		}

		//create a new player
		$player = Player::create([
			'username' => 'admin',
			'is_admin' => 1,
		]);

		//log In player
		auth()->login($player);

		return redirect()->route('listGames');
	}
}
