<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\models\Ville;

class villeController extends Controller
{
    public function getListeMedecin(Request $request)
    {
        $id_countr = $request->country_id;
        $id_spe = $request->specID;
        $id_vile = $request->villeID;
        if ($id_countr == "d") {
            $id_country = "";
        } else {
            $id_country = $request->country_id;
        }
        if ($id_spe == "d") {
            $id_spec = "";
        } else {
            $id_spec = $request->specID;
        }
        if ($id_vile == "d") {
            $id_ville = "";
        } else {
            $id_ville = $request->villeID;
        }

        $meds = User::where('role_id',3)
            ->where('country_id', 'like', '%' . $id_country . '%')
            ->where('ville_id', 'like', '%' . $id_ville . '%')
            ->where('specialite_id', 'like', '%' . $id_spec . '%')
            ->pluck("nom", "id");

        $villes = DB::table("villes")
            ->where('code', '=', $id_country)
            ->pluck("name", "id_ville");

        return response()->json([
            'meds' => $meds,
            'villes' => $villes
        ]);
    }

    public function getCities(Request $request)
    {
        $villes = Ville::where('code', '=', $request->input('pays'))
            ->pluck("name", "id_ville");
        return $villes;
    }
}
