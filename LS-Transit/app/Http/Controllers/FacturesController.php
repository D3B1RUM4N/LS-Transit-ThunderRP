<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factures;
use App\Models\MyUser;
use App\Models\Tarifs;

class FacturesController extends Controller
{
    public function create(Request $request) {
        if ( !$request->filled(['client','kilometrique','vehicule','montant','dateFacture']) )
            return to_route('factures_new')->with('message',"Remplissez tout les champs.");

        $tarif = Tarifs::where( 'tarif', $request->vehicule )->first();
        $facture = new Factures;
        $facture->client = $request->client;
        $facture->emp = session('user')->id;
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

    public function empFacture() {
        $factures = Factures::all()->filter(function($facture) {
            return $facture->emp == session('user')->id;
        });
        return view('showFactures', ['factures' => $factures]);
    }

    public function all() {
        // select * + u.login from factures join myusers u on u.id = factures.emp
        $factures = Factures::all()->map(function($facture) {
            $user = MyUser::where('id',$facture->emp)->first();
            $facture->emp = $user->login;
            return $facture;
        });

        return view('gestionFacture', ['factures' => $factures]);
    }
}


