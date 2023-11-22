<?php

namespace App\Livewire;
use Livewire\WithPagination;
use App\Models\User;
use Livewire\Component;

class UserTable extends Component
{
    use WithPagination;

    public $selectedRole = '';
    public string $search= '';
    public string $orderField = 'name';
    public string $orderDirection = 'ASC';
    public int $editId = 0;
    
    // garde la valeur saisie au champs même après réactualisation
    protected $queryString = [
        'search' => ['except' => ''],
        'orderField' => ['except' => 'name'],
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
        return view('livewire.user-table', [
            'users' => User::where(function ($query) {
                $query->where('name', 'LIKE', "%{$this->search}%")
                    ->orWhere('email', 'LIKE', "%{$this->search}%")
                    ->orWhere('role', 'LIKE', "%{$this->search}%");
            })
            ->when($this->selectedRole, function ($query) {
                $query->where('role', $this->selectedRole);
            })
            ->orderBy($this->orderField, $this->orderDirection)
            ->paginate(4),
            'allRoles' => User::distinct('role')->pluck('role'),
        ]);
    }
}
