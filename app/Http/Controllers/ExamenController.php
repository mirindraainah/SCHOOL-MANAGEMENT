<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Examen;

class ExamenController extends Controller
{
    public function index()
    {
        $examens = Examen::all();
        return view('examen.index', compact('examens'));
    }

    public function create()
    {
        return view('examen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'LibelleExamen' => 'required|max:25',
        ]);

        Examen::create($request->all());

        Alert::toast('Ajouté avec succès','success');
        return redirect()->route('examen.index')->with('success', 'Examen ajouté avec succès.');
    }

    public function edit($IdExamen)
    {
        $examen = Examen::findOrFail($IdExamen);
        return view('examen.edit', compact('examen'));
    }

    public function update(Request $request, $IdExamen)
    {
        $request->validate([
            'LibelleExamen' => 'required|max:25',
        ]);

        $examen = Examen::findOrFail($IdExamen);
        $examen->update($request->all());

        Alert::toast('Modifié avec succès','info');
        return redirect()->route('examen.index')->with('success', 'Examen mis à jour avec succès.');
    }

    public function destroy($IdExamen)
    {
        $examen = Examen::findOrFail($IdExamen);
        Alert::toast('Supprimé avec succès','info');
        $examen->delete();

        return redirect()->route('examen.index')->with('success', 'Examen supprimé avec succès.');
    }
}

