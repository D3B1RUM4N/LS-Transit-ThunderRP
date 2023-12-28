<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paie;
use App\Models\MyUser;


class PaieController extends Controller
{
    public function create(Request $request){
        if(!$request->filled(['id', 'montant', 'date']))
            return to_route('employees_list')->with('message', 'Remplissez tout les champs.');

        $paie = new Paie;
        $paie->emp = $request->id;
        $paie->montant = $request->montant;
        $paie->datePaie = $request->date;

        $emp = MyUser::where('id', $request->id)->first();
        $emp->montant = 0;
        $emp->km = 0;
        $emp->save();
        
        try{
            $paie->save();
        } catch(\Exception $e){
            return to_route('employees_list')->with('message',$e->getMessage());
        }
        return to_route('employees_list')->with('message', 'Prime créée.');
    }
}
