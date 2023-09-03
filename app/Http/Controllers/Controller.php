<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Radio;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function getCities(Request $request)
    {
        $villes = DB::table("villes")
            ->where('code', '=', $request->input('pays'))
            ->pluck("name", "id_ville");
        return $villes;
    }

    public function getStateList(Request $request)
    {
        $states = Radio::where("typeradio", $request->typeradio)->pluck("lib", "id");
        return response()->json($states);
    }
}
