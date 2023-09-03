<?php

namespace App\Http\Controllers\administrateur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Ville;

class paysController extends Controller
{
    public function index()
    {
        return view('administrateur.pays.index');
    }

    public function create()
    {
        return view('administrateur.pays.create');
    }

    public function store(Request $request)
    {
    $validatedData = $request->validate([
    'lib' => 'required|max:255',
    'code' => 'required|min:2|max:3|unique:countries',
    ]);

    $pays = new Country;
    $pays->lib = $validatedData['lib'];
    $pays->code = $validatedData['code'];
    $pays->save();
    return redirect('administrateur/pays/index');
    }

    public function show($code)
    {   $pays=Country::where('code',$code)->firstorFail();
        $villes = Ville::where('code', $code)->get();
        return view('administrateur.pays.show', ['villes' => $villes,'pays'=>$pays]);
    }

    public function edit($code)
    {
        $pays = Country::where('code',$code)->firstorFail();
        return view('administrateur.pays.edit', ['pays' => $pays]);
    }

    public function update(Request $request, $code)
    {
        $country = Country::where('code', $code)->firstOrFail();
        $country->update(['lib' => $request->input('lib')]);
        return redirect('/administrateur/pays/index');
    }

    public function deletepays($code)
    {
        $country = Country::findOrFail($code);
        $country->delete();
        return redirect('/administrateur/pays/index');
    }

    public function createville($id)
    {
        return view('administrateur.ville.create', [ 'id' => $id]);
    }

    public function storeville(Request $request)
    {
        $ville = new Ville();
        $ville->name = $request->input('lib');
        $ville->code = $request->input('code');
        $ville->save();
        return redirect('/administrateur/pays/show/'.$ville->code);    }

    public function editville($id)
    {
        $ville = Ville::where('id_ville',$id)->firstorFail();
        return view('administrateur.ville.edit', ['ville' => $ville]);
    }

    public function updateville(Request $request, $id)
    {
        $ville = Ville::where('id_ville',$id)->firstorFail();
        $ville->update(['name'=> $request->input('lib')]);
        return redirect('/administrateur/pays/show/'.$ville->code);
    }
    
    public function deleteville($id)
    {
        $ville = Ville::where('id_ville',$id)->firstorFail();
        $pays=$ville->code;
        $ville->delete();
        return redirect('/administrateur/pays/show/'.$pays);
    }
}