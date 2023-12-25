<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factures;
use App\Models\Tarifs;

class FacturesController extends Controller
{
    public function create(Request $request) {
        if ( !$request->filled(['client','kilometrique','vehicule','montant','dateFacture']) )
            return to_route('factures_new')->with('message',"Remplissez tout les champs.");

        $tarif = Tarifs::where( 'tarif', $request->vehicule )->first();
        $facture = new Factures;
        $facture->client = $request->client;
        $facture->login = session('user')->login;
        $facture->kilometrique = $request->kilometrique;
        $facture->vehicule = $tarif->vehicule;
        $facture->montant = $request->montant;
        $facture->dateFacture = $request->dateFacture;

        try {
            $facture->save();
        }
        catch (\Exception $e) {
            return to_route('factures_new')->with('message',$e->getMessage());
        }

        return to_route('factures_list')->with('message',"Facture créé.");
    }

    public function all() {
        $factures = Factures::all()->filter(function($facture) {
            return $facture->user_id == session('user')->id;
        });
        return view('showFactures', ['factures' => $factures]);
    }
}


