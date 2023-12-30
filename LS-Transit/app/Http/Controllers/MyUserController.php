<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MyUser;
use App\Models\Factures;
use App\Models\Grades;
use App\Models\Paie;

class MyUserController extends Controller
{
	/**************************************************************************
	 * Check if there is an Admin, else create it.
	 */
	public function test() {
		$grade = Grades::where('id',0)->first();
		if ( !$grade ) {
			$grade = new Grades;
			$grade->id = 0;
			$grade->label = 'Employé';
			$grade->part = 35;
			$grade->save();
		}

		$user = MyUser::where('admin',true)->first();
		if ( !$user ) {
			$user = new MyUser;
			$user->login = 'admin';
			$user->password = password_hash('admin',PASSWORD_DEFAULT);
			$user->admin = true;
			$user->save();
		}

		return to_route('view_signin');
	}

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
		if ( !$request->filled(['login']) )
			return to_route('employees_list')->with('message',"Remplissez tout les champs.");
		
		$user = new MyUser;
		$user->login = $request->login;
		$user->password = password_hash($request->login,PASSWORD_DEFAULT);
		if ( $request->filled(['admin']) )
			$user->admin = true;

		try {
			$user->save();
		}
		catch (\Exception $e) {
			return to_route('employees_list')->with('message',$e->getMessage());
		}

		return to_route('employees_list')->with('message',"Compte créé.");
	}

    /**************************************************************************
	 * Disconnect the connected user.
	 */
	public function disconnect(Request $request) {
		$request->session()->flush();
		return to_route('view_signin');
	}

	/**************************************************************************
	 * List of employees.
	 */
	public function employees() {
		$employees = MyUser::all()->sortBy('login')->sortByDesc('admin')->map(function($employees) {
			$employees->labelGrade = Grades::where('id',$employees->grade)->first()->label;
			return $employees;
		});
		return view('gestionEmployee',['employees' => $employees]);
	}

	public function changeLogin(Request $request) {
		if ( !$request->filled(['login', 'grade']) )
			return to_route('employees_list')->with('message',"Remplissez tout les champs.");

		$user = MyUser::where('id',$request->id)->first();
		if ( !$user )
			return to_route('employees_list')->with('message',"L'utilisateur n'existe pas.");
		$user->login = $request->login;
		if ( $request->filled(['admin']) )
			$user->admin = true;
		else
			$user->admin = false;

		$user->grade = $request->grade;		
		
		try {
			$user->save();
		}
		catch (\Exception $e) {
			return to_route('employees_list')->with('message',$e->getMessage());
		}

		return to_route('employees_list')->with('message',"Login changé.");
	}

	public function delete(Request $request) {
		$user = MyUser::where('id',$request->id)->first();
		if ( !$user )
			return to_route('employees_list')->with('message',"L'utilisateur n'existe pas.");
		$user->delete();
		return to_route('employees_list')->with('message',"Utilisateur supprimé.");
	}

	public function emp(Request $request) {
		$emp = MyUser::all()->map(function($emp) {
			$factures = Factures::all()->filter(function($facture) use ($emp) {
				return $facture->emp == $emp->id;
			});
			$emp->paies = Paie::all()->filter(function($paie) use ($emp) {
				return $paie->emp == $emp->id;
			});
			$emp->part = Grades::where('id',$emp->grade)->first()->part;
			$emp->factures = $factures;
			return $emp;
		});

		$emp = $emp->filter(function($emp) use ($request) {
			return $emp->id == $request->id;
		})->first();

		$grades = Grades::all();


		return view('employeShow',['employe' => $emp, 'grades' => $grades]);
	}

	public static function updateKm($id, $km) {
		$user = MyUser::where('id',$id)->first();
		if ( !$user )
			return;
		$user->km += $km;
		$user->save();
	}

	public static function updateMontant($id, $montant) {
		$user = MyUser::where('id',$id)->first();
		if ( !$user )
			return;
		$user->montant += $montant;
		$user->save();
	}

}