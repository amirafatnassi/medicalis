<?php

namespace App\Http\Controllers\coordinateur;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\RepresentantCoordinateur;

class representantController extends Controller
{
    public function index()
    {
        $representants = User::where('role_id', 5)->get();
        return view('coordinateur.representants.index', compact('representants'));
    }

    public function show($id)
    {
        $representant = User::findorFail($id);
        return view('coordinateur.representants.show', compact('representant'));
    }

    public function activate($id)
    {
        // Check if the relationship already exists
        $representant = User::findOrFail($id);
        if ($representant->representingCoordinateur->isEmpty()) {
            $representantCoordinateur = new RepresentantCoordinateur([
                'representant_id' => $id,
                'coordinateur_id'=>Auth::user()->id,
                'actif' => true,
            ]);
            $representant->representingCoordinateur()->save($representantCoordinateur);
        } else {
            // If the relationship exists, update the actif column
            $representantCoordinateur = $representant->representingCoordinateur->first();
            $representantCoordinateur->actif = true;
            $representantCoordinateur->save();
        }

        return Redirect::back();
    }
    public function deactivate($id)
    {
        $representant = User::findOrFail($id);
        if (!$representant->representingCoordinateur->isEmpty()) {
            $representantCoordinateur = $representant->representingCoordinateur->first();
            $representantCoordinateur->actif = false;
            $representantCoordinateur->save();
        }
        return Redirect::back();
    }
}
