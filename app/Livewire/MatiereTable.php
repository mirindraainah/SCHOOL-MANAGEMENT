<?php

namespace App\Livewire;
use App\Models\Matiere;
use App\Models\Classe;
use Livewire\WithPagination;
use Livewire\Component;


class MatiereTable extends Component
{
    use WithPagination;
    public $selectedClasse = '';
    public string $search= '';
    public string $orderField = 'LibelleMatiere';
    public string $orderDirection = 'ASC';
    public int $editId = 0;
    
    // garde la valeur saisie au champs même après réactualisation
    protected $queryString = [
        'search' => ['except' => ''],
        'orderField' => ['except' => 'LibelleMatiere'],
        'orderDirection' => ['except' => 'ASC']
    ];

    // modification
    public function startEdit(int $id){
        $this->editId = $id;
    }

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
        return view('livewire.matiere-table', [
            'matieres' => Matiere::where(function ($query) {
                $query->where('LibelleMatiere', 'LIKE', "%{$this->search}%");
            })
            ->when($this->selectedClasse, function ($query) {
                $query->whereHas('classes', function ($subquery) {
                    $subquery->where('NomClasse', $this->selectedClasse);
                });
            })
            ->orderBy($this->orderField, $this->orderDirection)
            ->paginate(4),
            'allClasses' => Classe::distinct('NomClasse')->pluck('NomClasse'),
        ]);
    }
    
}
