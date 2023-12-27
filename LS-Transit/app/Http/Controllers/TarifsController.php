<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarifs;

class TarifsController extends Controller
{
    public function allSelect() {
        $tarifs = Tarifs::all();
        return view('addFacture', ['vehicules'=>$tarifs]);
    }
    
    public function all() {
        $tarifs = Tarifs::all();
        return view('gestionTarifs', ['tarifs'=>$tarifs]);
    }

    public function create(Request $request) {
        if ( !$request->filled(['vehicule','tarif']) )
            return to_route('tarifs_list')->with('message',"Remplissez tout les champs.");

        $tarif = new Tarifs;
        $tarif->vehicule = $request->vehicule;
        $tarif->tarif = $request->tarif;

        try {
            $tarif->save();
        }
        catch (\Exception $e) {
            return to_route('tarifs_list')->with('message',$e->getMessage());
        }

        return to_route('tarifs_list')->with('message',"Tarif créé.");
    }

    public function edit(Request $request) {
        if ( !$request->filled(['id','tarif']) )
            return to_route('tarifs_list')->with('message',"Remplissez tout les champs.");

        $tarif = Tarifs::where( 'id', $request->id )->first();
        $tarif->tarif = (float) $request->tarif;

        try {
            //dd($tarif);
            $tarif->save();
        }
        catch (\Exception $e) {
            return to_route('tarifs_list')->with('message',$e->getMessage());
        }

        return to_route('tarifs_list')->with('message',"Tarif modifié.");
    }

    public function delete(Request $request) {
        if ( !$request->filled(['id']) )
            return to_route('tarifs_list')->with('message',"Remplissez tout les champs.");

        $tarif = Tarifs::where( 'id', $request->id )->first();
        if ( !$tarif )
            return to_route('tarifs_list')->with('message',"Tarif introuvable.");

        try {
            $tarif->delete();
        }
        catch (\Exception $e) {
            return to_route('tarifs_list')->with('message',$e->getMessage());
        }

        return to_route('tarifs_list')->with('message',"Tarif supprimé.");
    }
}
