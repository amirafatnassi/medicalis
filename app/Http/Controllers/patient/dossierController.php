<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dossier;
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
        $patient = Dossier::where('user_id', Auth::user()->id)->first();
        $patient->fill($request->only([
            'nom', 'prenom', 'lieunaissance', 'tel', 'email', 'profession',
            'contactdurgence', 'pays', 'ville', 'cp', 'rue'
        ]));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $id_image = $request->input('nom') . '_' . $request->input('prenom') . '_' . $patient->id;
            $filename = $id_image . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/dossier/', $filename);
            $patient->image = $filename;
        }

        $patient->save();

        return redirect('patient/dossiers/mondossier');
    }

    public function mondossier()
    {
        if (Auth::check()) {
            $dossier = Dossier::with('user', 'bloodtype')->where('user_id', Auth::user()->id)->first();
        }
        return view('patient.dossiers.mondossier', compact('dossier'));
    }
}
