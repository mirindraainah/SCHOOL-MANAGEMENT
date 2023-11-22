<?php

// app/Http/Livewire/StudentsByClass.php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Eleve;

class StudentsByClass extends Component
{
    public $selectedClasse = '';
    public $classesEnseignees;
    public $search = '';

    public function mount()
    {
        // Récupérez l'enseignant actuellement connecté
        $enseignant = Auth::user()->enseignant;

        // Récupérez les classes enseignées par cet enseignant
        $this->classesEnseignees = $enseignant->classes->pluck('NomClasse')->unique();

        // Sélectionnez la première classe par défaut
        if ($this->classesEnseignees->count() > 0) {
            $this->selectedClasse = $this->classesEnseignees[0];
        }
    }

    public function render()
    {
        return view('livewire.students-by-class', [
            'studentsByClass' => Eleve::where(function ($query) {
                    $query->where('NomEleve', 'LIKE', "%{$this->search}%")
                        ->orWhere('PrenomEleve', 'LIKE', "%{$this->search}%")
                        ->orWhere('DateNaissance', 'LIKE', "%{$this->search}%")
                        ->orWhere('Sexe', 'LIKE', "%{$this->search}%");
                })
                ->when($this->selectedClasse, function ($query) {
                    $query->whereHas('classe', function ($subquery) {
                        $subquery->where('NomClasse', $this->selectedClasse);
                    });
                })
                ->paginate(4),
            'classesEnseignees' => $this->classesEnseignees,
        ]);
    }
    
}
