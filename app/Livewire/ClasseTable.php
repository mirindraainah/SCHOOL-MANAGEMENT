<?php

namespace App\Livewire;
use App\Models\Classe;
use Livewire\WithPagination;
use Livewire\Component;

class ClasseTable extends Component
{
    use WithPagination;
    public $selectedClasse = '';
    public string $search= '';
    public string $orderField = 'NomClasse';
    public string $orderDirection = 'ASC';
    public int $editId = 0;
    
    // garde la valeur saisie au champs même après réactualisation
    protected $queryString = [
        'search' => ['except' => ''],
        'orderField' => ['except' => 'NomClasse'],
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
        return view('livewire.classe-table', [
            'classes' => Classe::where('NomClasse', 'LIKE', "%{$this->search}%")
                ->when($this->selectedClasse, function ($query) {
                    $query->where('IdClasse', $this->selectedClasse);
                })
                ->orderBy($this->orderField, $this->orderDirection)
                ->paginate(4),
            'allClasses' => Classe::pluck('NomClasse', 'IdClasse'),
        ]);
    }
    
}
