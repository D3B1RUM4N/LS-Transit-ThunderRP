<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarifs;

class TarifsController extends Controller
{
    public function all() {
        $tarifs = Tarifs::all();
        return view('addFacture', ['vehicules'=>$tarifs]);
    }
}
