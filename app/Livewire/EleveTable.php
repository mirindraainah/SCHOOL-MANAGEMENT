<?php

namespace App\Livewire;

use App\Models\Classe;
use App\Models\Eleve;
use Livewire\WithPagination;
use Livewire\Component;

class EleveTable extends Component
{
    use WithPagination;

    public $selectedClasse = '';
    public string $search= '';
    public string $orderField = 'NomEleve';
    public string $orderDirection = 'ASC';
    public int $editId = 0;
    
    // garde la valeur saisie au champs même après réactualisation
    protected $queryString = [
        'search' => ['except' => ''],
        'orderField' => ['except' => 'NomEleve'],
        'orderDirection' => ['except' => 'ASC']
    ];

    public function updating($name){
        if($name === 'search'){
            $this->resetPage();
        }
    }

    // ordre tableau
    public function setOrderField(string $name){
        if($name === $this->orderField){
            $this->orderDirection = $this->orderDirection === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->orderField = $name;
            $this->orderDirection = 'ASC';
        }
    }


    public function render()
    {
        return view('livewire.eleve-table', [
            'eleves' => Eleve::where(function ($query) {
                $query->where('Matricule', 'LIKE', "%{$this->search}%")
                    ->orWhere('NomEleve', 'LIKE', "%{$this->search}%")
                    ->orWhere('PrenomEleve', 'LIKE', "%{$this->search}%")
                    ->orWhere('Sexe', 'LIKE', "%{$this->search}%")
                    ->orWhere('AdresseEleve', 'LIKE', "%{$this->search}%");
            })
            ->when($this->selectedClasse, function ($query) {
                $query->where('eleve.IdClasse', $this->selectedClasse);
            }) // Ajoutez 'eleve.' avant IdClasse pour spécifier la table.
            ->orderBy($this->orderField, $this->orderDirection)
            ->orderBy('classe.NomClasse', $this->orderDirection)
            ->join('classe', 'eleve.IdClasse', '=', 'classe.IdClasse')
            ->paginate(4),
            'classes' => Classe::pluck('NomClasse', 'IdClasse'),
        ]);
    }
    
    
    
}
