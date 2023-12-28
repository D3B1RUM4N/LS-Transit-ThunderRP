<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grades;

class GradesController extends Controller
{  
    public function all() {
        $grades = Grades::all();
        return view('gestionGrades', ['grades'=>$grades]);
    }

    public function create(Request $request) {
        if ( !$request->filled(['label', 'part']) )
            return to_route('grades_list')->with('message',"Remplissez tout les champs.");

        $grade = new Grades;
        $grade->label = $request->label;
        $grade->part = $request->part;

        try {
            $grade->save();
        }
        catch (\Exception $e) {
            return to_route('grades_list')->with('message',$e->getMessage());
        }

        return to_route('grades_list')->with('message',"Grade créé.");
    }

    public function edit(Request $request) {
        if ( !$request->filled(['id','part']) )
            return to_route('grades_list')->with('message',"Remplissez tout les champs.");

        $grade = Grades::where( 'id', $request->id )->first();
        $grade->part = (float) $request->part;

        try {
            //dd($tarif);
            $grade->save();
        }
        catch (\Exception $e) {
            return to_route('grades_list')->with('message',$e->getMessage());
        }

        return to_route('grades_list')->with('message',"Grade modifié.");
    }

    public function delete(Request $request) {
        if ( !$request->filled(['id']) )
            return to_route('grades_list')->with('message',"Remplissez tout les champs.");

        $grade = Grades::where( 'id', $request->id )->first();
        if ( !$grade )
            return to_route('grades_list')->with('message',"grade introuvable.");

        try {
            $grade->delete();
        }
        catch (\Exception $e) {
            return to_route('grades_list')->with('message',$e->getMessage());
        }

        return to_route('grades_list')->with('message',"Grade supprimé.");
    }
}

