<?php

namespace App\Http\Controllers\administrateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class medecinController extends Controller
{

    public function index()
    {
        $medecins = User::with('Specialite', 'Ville', 'Country', 'Organisme')
            ->get();

        return view('administrateur.medecins.index', compact('medecins'));
    }

    public function create()
    {
        return view('administrateur.medecins.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $medecin = new User();
        $medecin->fill($request->only($medecin->getfillable()));
        $medecin->save();
        return redirect('administrateur/medecins');
    }

    public function show($id)
    {
        $medecin = User::with('Specialite', 'Ville', 'Country', 'Organisme', 'Sexe')
            ->findorFail($id);
        return view('administrateur.medecins.show', compact('medecin'));
    }

    public function edit($id)
    {
        $medecin = User::with('Specialite', 'Ville', 'Country', 'Organisme', 'Sexe')
            ->findorFail($id);
        return view('administrateur.medecins.edit', compact('medecin'));
    }

    public function update(Request $request, $id)
    {
        $medecin = User::FindOrFail($id);
        $medecin->nom = $request->input('nom');
        $medecin->prenom = $request->input('prenom');
        $medecin->sexe = $request->input('sexe');
        $medecin->specialite = $request->input('specialite');
        $medecin->organisme = $request->input('organisme');
        $medecin->tel = $request->input('tel');
        $medecin->email = $request->input('email');
        $medecin->pays = $request->input('pays');
        $medecin->ville = $request->input('ville');
        $medecin->cp = $request->input('cp');
        $medecin->rue = $request->input('rue');
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $filename = $request->input('nom') . '_' . $request->input('prenom') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/medecin/', $filename);
            $medecin->image = $filename;
        }
        $medecin->save();
        return  redirect('/administrateur/medecins/show/' . $id);
    }

    public function destroy(Request $request, $id)
    {
        Medecin::destroy($id);
        return redirect()->route('administrateur.medecins.index');
    }

    public function deleteMedecin($id)
    {
        User::findorFail($id)->delete();
        return redirect('/administrateur/medecins');
    }
}
