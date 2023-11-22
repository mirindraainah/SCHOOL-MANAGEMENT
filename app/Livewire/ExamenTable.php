<?php

namespace App\Livewire;
use App\Models\Examen;
use Livewire\WithPagination;
use Livewire\Component;

class ExamenTable extends Component
{
    use WithPagination;

    public string $search= '';
    public string $orderField = 'LibelleExamen';
    public string $orderDirection = 'ASC';
    public int $editId = 0;
    
    // garde la valeur saisie au champs même après réactualisation
    protected $queryString = [
        'search' => ['except' => ''],
        'orderField' => ['except' => 'LibelleExamen'],
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
        return view('livewire.examen-table', [
            'examens' => Examen::where('LibelleExamen', 'LIKE', "%{$this->search}%")
            ->orderBy($this->orderField, $this->orderDirection)
            ->paginate(4)
        ]);
    }
}
