<?php

namespace App\Http\Controllers\administrateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Motif;

class motifController extends Controller
{
    public function index()
    {
        return view('administrateur.motifs.index');
    }

    public function create()
    {
        return view('administrateur.motifs.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['lib']);
        Motif::create($data);
        return redirect('administrateur/motifs/index');
    }

    public function edit($id)
    {
        $motif = Motif::findorFail($id);
        return view('administrateur.motifs.edit', compact('motif'));
    }

    public function update(Request $request, $id)
    {
        $motif = Motif::FindOrFail($id);
        $motif->lib = $request->input('lib');
        $motif->save();
        return redirect('/administrateur/motifs/index');
    }

    public function deleteMotif($id)
    {
        Motif::destroy($id);
        return redirect('/administrateur/motifs');
    }
}
