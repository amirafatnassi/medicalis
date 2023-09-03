<?php

namespace App\Http\Controllers\administrateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialite;

class specialiteController extends Controller
{
    public function index()
    {
        return view('administrateur.specialites.index');
    }

    public function create()
    {
       return view('administrateur.specialites.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['lib']);
        Specialite::create($data);
        return redirect('administrateur/specialites/index');
    }

    public function edit($id)
    {
        $specialite = Specialite::findorFail($id);
        return view('administrateur.specialites.edit', compact('specialite'));
    }

    public function update(Request $request, $id)
    {
        $specialite = Specialite::FindOrFail($id);
        $specialite->id = $request->input('id');
        $specialite->lib = $request->input('lib');
        $specialite->save();
        return redirect('/administrateur/specialites/index');
    }

    public function deletespecialite($id)
    {
        Specialite::destroy($id);
        return redirect('/administrateur/specialites');
    }
}
