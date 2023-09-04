<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class dossierController extends Controller
{
    public function editmondossier()
    {
        if (Auth::check()) {
            $dossier = Dossier::with('user')->where('user_id', Auth::user('patient')->id)->first();
        }
        return view('patient.dossiers.editmondossier', compact('dossier'));
    }

    public function updatemondossier(Request $request)
    {
        $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        $user = User::findorFail(Auth::user()->id);

        $user->update([
            'nom' => $request->input('nom'),
            'prenom' => $request->input('prenom'),
            'lieunaissance' => $request->input('lieunaissance'),
            'tel' => $request->input('tel'),
            'profession_id' => $request->input('profession'),
            'country_id'=>$request->input('pays'),
            'ville_id'=>$request->input('ville'),
            'cp'=>$request->input('cp'),
            'rue'=>$request->input('rue')
        ]);
        $dossier->update([
            'contactdurgence' => $request->input('contactdurgence'),
            'taille' => $request->input('taille'),
            'poids' => $request->input('poids'),
            'groupe_sanguin' => $request->input('groupe_sanguin'),
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $request->input('nom') . '_' . $request->input('prenom') . '_' . $dossier->id . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/dossier/', $filename);
            $user->image = $filename;
        }

        $user->save();

        return redirect('patient/mondossier');
    }

    public function mondossier()
    {
        if (Auth::check()) {
            $dossier = Dossier::where('user_id', Auth::user()->id)->first();
        }
        return view('patient.dossiers.mondossier', compact('dossier'));
    }
}
