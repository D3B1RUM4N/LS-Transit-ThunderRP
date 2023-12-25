<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyUser;

class MyUserController extends Controller
{
    /**************************************************************************
	 * Connect a user with login and password.
	 */
    public function connect(Request $request) {
		if ( !$request->filled(['login','password']) )
			return to_route('view_signin')->with('message',"Remplissez tout les champs.");

		$user = MyUser::where( 'login', $request->login )->first();

		if ( !$user || !password_verify($request->password,$user->password) )
			return to_route('view_signin')->with('message','Mauvais login/mot de passe.');

		$request->session()->put('user',$user);

		return to_route('view_account');
	}

    /**************************************************************************
	 * Create a new user.
	 */
	public function create(Request $request) {
		if ( !$request->filled(['login','password','confirm']) )
			return to_route('view_signup')->with('message',"Remplissez tout les champs.");

		if ( $request->password !== $request->confirm )
			return to_route('view_signup')->with('message',"Les mots de passes differes.");

		$user = new MyUser;
		$user->login = $request->login;
		$user->password = password_hash($request->password,PASSWORD_DEFAULT);

		try {
			$user->save();
		}
		catch (\Exception $e) {
			return to_route('view_signup')->with('message',$e->getMessage());
		}

		return to_route('view_signin')->with('message',"Compte créé, connectez vous.");
	}

    /**************************************************************************
	 * Disconnect the connected user.
	 */
	public function disconnect(Request $request) {
		$request->session()->flush();
		return to_route('view_signin');
	}
}