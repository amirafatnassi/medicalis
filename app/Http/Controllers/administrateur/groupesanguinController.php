<?php

namespace App\Http\Controllers\administrateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bloodtype;

class groupesanguinController extends Controller
{
    public function index()
    {
        return view('administrateur.groupesanguins.index');
    }

    public function create()
    {
        return view('administrateur.groupesanguins.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['lib']);
        Bloodtype::create($data);
        return redirect('administrateur/groupesanguins/index');
    }

    public function edit($id)
    {
       $groupesanguin = Bloodtype::findorFail($id);
        return view('administrateur.groupesanguins.edit', compact('groupesanguin'));
    }

    public function update(Request $request, $id)
    {
        $groupesanguin = Bloodtype::FindOrFail($id);
        $groupesanguin->lib = $request->input('lib');
        $groupesanguin->save();
        return redirect('/administrateur/groupesanguins/index');
    }

    public function deletegroupesanguin($id)
    {
        Bloodtype::destroy($id);
        return redirect('/administrateur/groupesanguins');
    }
}
