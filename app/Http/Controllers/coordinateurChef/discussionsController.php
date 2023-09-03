<?php

namespace App\Http\Controllers\coordinateurChef;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\DemandeDevis;
use App\Models\Medecin;
use App\Models\DemandeConsultation;
use App\Models\DemandeDevisFiles;
use App\Models\Temp;
use App\Models\TypeDemande;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class discussionsController extends Controller
{
    public function index()
    {
        $listcoordinateurchefs=User::where('role_id','=', 4)->get();;
        
        $listcoordinateurs=User::where('role_id', 5)->get();
        $listpatients=User::where('role_id', 3)->get();
        $listmedecins=User::where('role_id', 2)->get();
        $listrepresentants=User::where('role_id', 1)->get();
        //dd($listpatients);
        return view ('coordinateurChef.discussions.index',[
            'listcoordinateurchefs' => $listcoordinateurchefs,
            'listcoordinateurs' => $listcoordinateurs,
            'listpatients' => $listpatients,
            'listmedecins' => $listmedecins,
            'listrepresentants' => $listrepresentants
        ]);
    }
}