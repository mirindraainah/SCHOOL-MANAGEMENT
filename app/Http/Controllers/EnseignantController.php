<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Enseignant;
use App\User;
use Illuminate\Support\Str;

class EnseignantController extends Controller
{
    public function index()
    {
        $enseignants = Enseignant::all();
        return view('enseignant.index', compact('enseignants'));
    }

    public function create()
    {
        return view('enseignant.create');
    }


    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'IdEnseignant' => 'required|unique:ENSEIGNANT,IdEnseignant|max:10',
            'NomEnseignant' => 'required|max:50',
            'PrenomEnseignant' => 'required|max:50',
            'AdresseEnseignant' => 'required|max:50',
            'Contact' => 'nullable',
            'IdUtilisateur' => 'nullable',
        ]);
    
        
        Enseignant::create($validatedData);
    
        Alert::toast('Ajouté avec succès','success');
       
        return redirect()->route('enseignant.index')->with('success', 'Enseignant ajouté avec succès.');
    }
    
    
    public function edit($IdEnseignant)
    {
        $enseignant = Enseignant::findOrFail($IdEnseignant);
        return view('enseignant.edit', compact('enseignant'));
    }
    
    public function update(Request $request, $IdEnseignant)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'NomEnseignant' => 'required|max:50',
            'PrenomEnseignant' => 'required|max:50',
            'AdresseEnseignant' => 'required|max:50',
            'Contact' => 'nullable',
            'IdUtilisateur' => 'nullable',
        ]);
    
        // Mise à jour de l'enseignant
        $enseignant = Enseignant::findOrFail($IdEnseignant);
        $enseignant->update($validatedData);

        Alert::toast('Modifié avec succès','info');
        return redirect()->route('enseignant.index')->with('success', 'Enseignant mis à jour avec succès.');

    }
    
    public function destroy($IdEnseignant)
    {
        $enseignant = Enseignant::findOrFail($IdEnseignant);
        $enseignant->delete();

        Alert::toast('Supprimé avec succès','info');
        return redirect()->route('enseignant.index')->with('success', 'Enseignant supprimé avec succès.');
    }
    
    public function show($IdEnseignant)
    {
        $enseignant = Enseignant::findOrFail($IdEnseignant);
        return view('enseignant.show', compact('enseignant'));
    }
    
}
