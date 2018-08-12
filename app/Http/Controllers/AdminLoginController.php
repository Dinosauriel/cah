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
			'username' => static::getRandomUsername(),
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

	public static function getRandomUsername() {
		$userFile = file(base_path() . '/resources/assets/usernames.json');
		$users = json_decode($userFile[0]);

		return $users[random_int(0, count($users) - 1)];
	}
}
