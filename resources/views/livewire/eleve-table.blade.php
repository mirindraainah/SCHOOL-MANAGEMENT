<div>
    <div class="mb-5 flex flex-col md:flex-row justify-between items-center md:items-start">
        <div class="flex items-center">
            <h2 class="text-3xl font-extrabold text-gray-200 mt-2 md:mt-0 ml-2 transform hover:scale-105 transition-transform duration-300 ease-in-out">Elèves</h2>
        </div>
        <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
            <div class="relative">
                <input type="text" placeholder="Rechercher" class="border rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring focus:border-to-purple-300" wire:model.live.debounce.300ms="search">
                <div class="absolute left-3 top-2">
                    <i class="fa fa-search text-gray-400"></i>
                </div>
            </div>
            
            <div class="relative">
                <select class="border rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring focus:border-to-purple-300" wire:model.live="selectedClasse">
                    <option value="">Toutes les classes</option>
                    @foreach($classes as $classeId => $classeName)
                        <option value="{{ $classeId }}">{{ $classeName }}</option>
                    @endforeach
                </select>
            </div>
            
            <a href="{{ route('eleve.create') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
                <i class="fas fa-plus mr-2"></i> Ajouter Elève
            </a>
        </div>
    </div>
    
    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <x-table-header :direction="$orderDirection" label="Matricule" name="Matricule" :field="$orderField" class="py-3 px-6 text-left">Matricule</x-table-header>
                    <th class="py-3 px-6 text-left">Image</th>
                    <x-table-header :direction="$orderDirection" label="NomEleve" name="NomEleve" :field="$orderField" class="py-3 px-6 text-left">Nom</x-table-header>
                    <x-table-header :direction="$orderDirection" label="PrenomEleve" name="PrenomEleve" :field="$orderField" class="py-3 px-6 text-left">Prénom</x-table-header>
                    <x-table-header :direction="$orderDirection" label="Sexe" name="Sexe" :field="$orderField" class="py-3 px-6 text-left">Sexe</x-table-header>
                    <x-table-header :direction="$orderDirection" label="DateNaissance" name="DateNaissance" :field="$orderField" class="py-3 px-6 text-left">Date de naissance</x-table-header>
                    <x-table-header :direction="$orderDirection" label="AdresseEleve" name="AdresseEleve" :field="$orderField" class="py-3 px-6 text-left">Adresse</x-table-header>
                    <x-table-header :direction="$orderDirection" label="NomClasse" name="NomClasse" :field="$orderField" class="py-3 px-6 text-left">Classe</x-table-header>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @foreach($eleves as $eleve)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="pl-5">{{ $eleve->Matricule }}</td>
                    <td><img class="w-8 h-8 rounded-full" src="/imageEleve/{{ $eleve->image }}" width="100" height="100" alt=""></td>
                    <td>{{ $eleve->NomEleve }}</td>
                    <td>{{ $eleve->PrenomEleve }}</td>
                    <td>{{ $eleve->Sexe }}</td>
                    <td>{{ $eleve->DateNaissance }}</td>
                    <td>{{ $eleve->AdresseEleve }}</td>
                    <td class="pl-5 text-purple-600">{{ $eleve->classe ? $eleve->classe->NomClasse : 'Non attribuée' }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <a href="{{ route('eleve.show', $eleve->Matricule) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('eleve.edit', $eleve->Matricule) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('eleve.destroy', $eleve->Matricule) }}" method="POST" data-confirm-delete="true">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer delete-button">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $eleves->links() }}
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Êtes-vous sûr?',
                        text: 'Une fois supprimé, vous ne pourrez pas revenir en arrière!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: 'gray',
                        confirmButtonText: 'OK',
                        cancelButtonText: 'Annuler'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Si l'utilisateur a cliqué sur OK, soumettez le formulaire de suppression
                            e.target.closest('form').submit();
                        }
                    });
                });
            });
        });
    </script>

</div>
