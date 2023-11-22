<?php

namespace App\Livewire;
use Livewire\WithPagination;
use App\Models\Enseignant;
use Livewire\Component;

class EnseignantTable extends Component
{
    use WithPagination;

    public string $search= '';
    public string $orderField = 'NomEnseignant';
    public string $orderDirection = 'ASC';
    public int $editId = 0;
    
    // garde la valeur saisie au champs même après réactualisation
    protected $queryString = [
        'search' => ['except' => ''],
        'orderField' => ['except' => 'NomEnseignant'],
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
        return view('livewire.enseignant-table', [
            'enseignants' => Enseignant::where(function ($query) {
                $query->where('IdEnseignant', 'LIKE', "%{$this->search}%")
                    ->orWhere('NomEnseignant', 'LIKE', "%{$this->search}%")
                    ->orWhere('PrenomEnseignant', 'LIKE', "%{$this->search}%")
                    ->orWhere('AdresseEnseignant', 'LIKE', "%{$this->search}%")
                    ->orWhere('Contact', 'LIKE', "%{$this->search}%")
                    ->orWhere('IdUtilisateur', 'LIKE', "%{$this->search}%");
            })
            ->orderBy($this->orderField, $this->orderDirection)
            ->paginate(4)
        ]);
        
    }
}
