<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Eleve;
use App\Models\Matiere;
use App\Models\Examen;
use App\Models\Faire;
use App\Models\Classe;

class FaireController extends Controller
{
    public function studentsByClass()
    {
        // enseignant actuellement connecté
        $enseignant = Auth::user()->enseignant;
    
        // classes enseignées par cet enseignant
        $classesEnseignees = $enseignant->classes;
    
        // élèves pour chaque classe
        $studentsByClass = [];
    
        foreach ($classesEnseignees as $classe) {
            $studentsByClass[$classe->NomClasse] = $classe->eleves;
        }
    
        $classes = $enseignant->classes;
    
        return view('professor.students_by_class', compact('studentsByClass', 'classes'));
    }
    

 
    public function ajouterNote()
    {
        // enseignant actuellement connecté
        $enseignant = Auth::user()->enseignant;
    
        // classes enseignées par cet enseignant
        $classesEnseignees = $enseignant->classes->unique();
    
        // élèves 
        $eleves = Eleve::all();
    
        // examens
        $examens = Examen::all();
    
        // tableau associatif pour stocker les matières par classe
        $matieresParClasse = [];
    
        foreach ($classesEnseignees as $classe) {
            // matières enseignées par l'enseignant dans cette classe
            $matieres = $enseignant->matieres()->where('IdClasse', $classe->IdClasse)->get();
            $matieresParClasse[$classe->IdClasse] = $matieres;
        }
    
        return view('professor.ajouter-note', compact('enseignant', 'classesEnseignees', 'examens', 'matieresParClasse', 'eleves'));
    }
    
    
    

    public function enregistrerNote(Request $request)
    {
        $coefficient = $request->input('coefficient');
    
        $request->validate([
            'classe' => 'required',
            'examen' => 'required',
            'matiere' => 'required',
            'matricule' => 'required|array',
            'note' => [
                'required',
                'array',
                function ($attribute, $value, $fail) use ($coefficient) {
                    foreach ($value as $note) {
                        // Vérification si la note dépasse la limite en fonction du coefficient
                        if ($note > (10 * $coefficient)) {
                            $fail('La note ne peut pas dépasser ' . (10 * $coefficient));
                        }
                    }
                },
            ],
            'date_examen' => 'required|date',
            'coefficient' => 'required|numeric',
        ]);
    
        $classe = $request->input('classe');
        $examen = $request->input('examen');
        $matiere = $request->input('matiere');
        $matricules = $request->input('matricule');
        $notes = $request->input('note'); 
        
        
    
        // Vérification si les tableaux ne sont pas nuls
        if ($matricules && $notes) {
            
            foreach ($matricules as $key => $matricule) {
                $existingEntry = Faire::where([
                    'Matricule' => $matricule,
                    'IdExamen' => $examen,
                    'CodeMatiere' => $matiere,
                ])->first();
                if(!$existingEntry) {
                    Faire::create([
                        'Matricule' => $matricule,
                        'IdExamen' => $examen,
                        'CodeMatiere' => $matiere,
                        'Note' => $notes[$key], 
                        'Date' => now(), 
                        'DateExamen' => $request->input('date_examen'), 
                        'Coefficient' => $request->input('coefficient'),
                    ]);
                }
            }
                
            Alert::toast('Ajouté avec succès','success');
            
            return redirect()->route('professor.ajouter-note')->with('success', 'Les notes ont été enregistrées avec succès.')->withInput();
        }
    
        return redirect()->back()->with('error', 'Une erreur s\'est produite. Veuillez réessayer.')->withInput();
    }
    

    public function afficherNotes(Request $request)
    {
        // enseignant actuellement connecté
        $enseignant = Auth::user()->enseignant;

        // classes enseignées par l'enseignant
        $classes = $enseignant->classes->unique('IdClasse');

        // matières par classe et stockage dans un tableau associatif
        $matieresParClasse = [];
        foreach ($classes as $classe) {
            $matieresParClasse[$classe->IdClasse] = $classe->matieres->pluck('LibelleMatiere', 'CodeMatiere');
        }

        // examens
        $examens = Examen::all();

        // classe, examen et matière 
        $classeId = $request->input('classe');
        $examenId = $request->input('examen');
        $matiereCode = $request->input('matiere');

        // notes
        $notes = Faire::where('IdExamen', $examenId)
            ->where('CodeMatiere', $matiereCode)
            ->whereHas('eleve', function ($query) use ($classeId) {
                $query->where('IdClasse', $classeId);
            })
            ->get();

        $dateExamen = $notes->isNotEmpty() ? $notes->first()->DateExamen : null;
        $coefficient = $notes->isNotEmpty() ? $notes->first()->Coefficient : null;

        return view('professor.afficher-note', compact('notes', 'classes', 'matieresParClasse', 'examens', 'dateExamen', 'coefficient'));
    }

    public function afficherNotesAdmin(Request $request)
    {

        // classes enseignées par l'enseignant
        $classes = Classe::all();

        // matières par classe et stockage dans un tableau associatif
        $matieresParClasse = [];
        foreach ($classes as $classe) {
            $matieresParClasse[$classe->IdClasse] = $classe->matieres->pluck('LibelleMatiere', 'CodeMatiere');
        }

        // examens 
        $examens = Examen::all();

        // classe, examen et matière
        $classeId = $request->input('classe');
        $examenId = $request->input('examen');
        $matiereCode = $request->input('matiere');

        // notes des élèves
        $notes = Faire::where('IdExamen', $examenId)
            ->where('CodeMatiere', $matiereCode)
            ->whereHas('eleve', function ($query) use ($classeId) {
                $query->where('IdClasse', $classeId);
            })
            ->get();

        $dateExamen = $notes->isNotEmpty() ? $notes->first()->DateExamen : null;
        $coefficient = $notes->isNotEmpty() ? $notes->first()->Coefficient : null; 

        return view('admin.afficher-note-admin', compact('notes', 'classes', 'matieresParClasse', 'examens', 'dateExamen', 'coefficient'));
    }

 
    public function afficherNotes2(Request $request)
    {
        // enseignant actuellement connecté
        $enseignant = Auth::user()->enseignant;
    
        // matières enseignées par l'enseignant
        $matieresEnseignees = $enseignant->matieres->pluck('CodeMatiere');
    
        // classes enseignées par l'enseignant
        $classes = $enseignant->classes->unique('IdClasse');
    
        // classe, matière et examen 
        $classeId = $request->input('classe');
        $matiereCode = $request->input('matiere');
        $examenId = $request->input('examen');
        $params = [
            "classeId"=> $classeId,
            "matiereCode" => $matiereCode,
            "examenId" => $examenId
        ];
    
        // notes des élèves en fonction des critères
        $query = Faire::query();
    
        // if ($classeId) {
        //     $query->whereHas('eleve', function ($query) use ($classeId) {
        //         $query->where('IdClasse', $classeId);
        //     });
        // } 
    
        if ($matiereCode) {
            $query->where('CodeMatiere', $matiereCode);
        } else {
            $query->whereIn('CodeMatiere', $matieresEnseignees);
        }
    
        if ($examenId) {
            $query->where('IdExamen', $examenId);
        }
       
        // $notes = null;
        if ($classeId) {
            $classId = $classes->pluck('IdClasse')->toArray();
            $notes = $query->whereHas('eleve', function ($query) use ($classeId) {
                $query->where('IdClasse', $classeId);
            })->get();
        } else {
            // $classes = $enseignant->classes->unique('IdClasse');
            // $classIds = $classes->pluck('IdClasse')->toArray();
            // $notes = $query->whereHas('eleve', function ($query) use ($classIds) {
            //     $query->whereIn('IdClasse', $classIds);
            // })->get();
            $notes = []; 
        }
    
        $matieresParClasse = [];
    
        foreach ($classes as $classe) {
            // matières enseignées par l'enseignant dans cette classe
            $matieres = $enseignant->matieres()->where('IdClasse', $classe->IdClasse)->get();
            $matieresParClasse[$classe->IdClasse] = $matieres;
        }
        $examens = Examen::all();
        if (count($notes) > 0) {
            $dateExamen = $notes[0]->DateExamen; 
            $coefficient = $notes[0]->Coefficient;
        } else {
            $dateExamen = null; 
            $coefficient = null; 
        }
    
        return view('professor.afficher-notes', compact('notes', 'classes', 'matieres', 'examens', 'matieresParClasse', 'params', 'dateExamen', 'coefficient'));
    }
    

    public function edit($Matricule, $IdExamen, $CodeMatiere)
    {
        // note
        $note = Faire::where('Matricule', $Matricule)
            ->where('IdExamen', $IdExamen)
            ->where('CodeMatiere', $CodeMatiere)
            ->firstOrFail();
    
        // élève associé à la note
        $eleve = $note->eleve;
    
        // classe de l'élève
        $classe = $eleve->classe;
    
        // examen associé à la note
        $examen = Examen::find($IdExamen);
    
        // matière associée à la note
        $matiere = Matiere::find($CodeMatiere);
    
        return view('professor.modifier-note', compact('note', 'eleve', 'classe', 'examen', 'matiere'));
    }
    
    
    public function update(Request $request, $Matricule, $IdExamen, $CodeMatiere)
    {
        // note
        $notes = Faire::where('Matricule', $Matricule)
        ->where('IdExamen', $IdExamen)
        ->where('CodeMatiere', $CodeMatiere)
        ->firstOrFail();

        // coefficient
        $coefficient = $notes->Coefficient;

        $request->validate([
            'note' => [
                'required',
                function ($attribute, $value, $fail) use ($coefficient) {
                
                    if ($value > (10 * $coefficient)) {
                        $fail('La note ne peut pas dépasser ' . (10 * $coefficient));
                    }
                },
            ],
        ]);
    
        //mise à jour 
        Faire::updateOrInsert(
            [
                'Matricule' => $Matricule,
                'IdExamen' => $IdExamen,
                'CodeMatiere' => $CodeMatiere,
            ],
            [
                'Note' => $request->input('note'),
                'Date' => now()
            ]
        );

        Alert::toast('Modifié avec succès','info');
        return redirect()->route('professor.afficher-notes')->with('success', 'La note a été mise à jour avec succès.');

        
    }
    
    
    
    public function destroy($Matricule, $IdExamen, $CodeMatiere)
    {
        try {
            // clés primaires
            $result = Faire::where('Matricule', $Matricule)
                ->where('IdExamen', $IdExamen)
                ->where('CodeMatiere', $CodeMatiere)
                ->delete();
    
            if ($result) {
                Alert::toast('Supprimé avec succès','info');
                return redirect()->route('professor.afficher-notes')->with('success', 'La note a été supprimée avec succès.');
            } else {
                // enregistrement pas trouvé
                return redirect()->route('professor.afficher-notes')->with('error', 'L\'enregistrement n\'a pas été trouvé.');
            }
        } catch (\Exception $e) {
            return redirect()->route('professor.afficher-notes')->with('error', 'Une erreur s\'est produite lors de la suppression de la note.');
        }
    }
    

}

