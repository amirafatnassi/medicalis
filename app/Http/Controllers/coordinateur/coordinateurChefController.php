<?php

namespace App\Http\Controllers\coordinateur;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class coordinateurChefController extends Controller
{
    public function show()
    {
        $user = User::findorFail(Auth::user()->id);
        $supervisor = null; 
        if ($user->supervisor_id) {
            $supervisor = User::findOrFail($user->supervisor_id);
        }
        return view('coordinateur.coordinateurChef.show', compact('supervisor'));
    }
}
