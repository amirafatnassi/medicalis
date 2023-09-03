<?php

namespace App\Http\Controllers\administrateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisme;

class organismeController extends Controller
{
    public function index()
    {
        return view('administrateur.organismes.index');
    }

    public function create()
    {
        return view('administrateur.organismes.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['lib']);
        Organisme::create($data);
        return redirect('administrateur/organismes/index');
    }

    public function edit($id)
    {
        $organisme = Organisme::findorFail($id);
        return view('administrateur.organismes.edit', compact('organisme'));
    }

    public function update(Request $request, $id)
    {
        $organisme = Organisme::FindOrFail($id);
        $organisme->lib = $request->input('lib');
        $organisme->save();
        return redirect('/administrateur/organismes/index');
    }

    public function deleteorganisme($id)
    {
        Organisme::destroy($id);
        return redirect('/administrateur/organismes');
    }
}
