<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Matiere;
use App\Models\Enseignant;

class MatiereController extends Controller
{
    public function index()
    {
        $matieres = Matiere::all();
        return view('matiere.index', compact('matieres'));
    }

    public function create()
    {
        
        return view('matiere.create');
    }

    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([

            'LibelleMatiere' => 'required|max:50',
            
        ]);

        Matiere::create($validatedData);

        Alert::toast('Ajoutée avec succès','success');
        return redirect()->route('matiere.index')->with('success', 'Matière ajoutée avec succès.');
    }

    public function edit($CodeMatiere)
    {
        $matiere = Matiere::findOrFail($CodeMatiere);
      
        return view('matiere.edit', compact('matiere'));
    }
    
    public function update(Request $request, $CodeMatiere)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'LibelleMatiere' => 'required',
            
        ]);
    
        // Mise à jour de la matière
        $matiere = Matiere::findOrFail($CodeMatiere);
        $matiere->update($validatedData);

        Alert::toast('Modifiée avec succès','info');
        return redirect()->route('matiere.index')->with('success', 'Matière mise à jour avec succès.');
    }
    
    public function destroy($CodeMatiere)
    {
        $matiere = Matiere::findOrFail($CodeMatiere);
        $matiere->delete();

        Alert::toast('Supprimé avec succès','info');
        return redirect()->route('matiere.index')->with('success', 'Matière supprimée avec succès.');
    }
    
    public function show($CodeMatiere)
    {
        $matiere = Matiere::findOrFail($CodeMatiere);
        return view('matiere.show', compact('matiere'));
    }
}
