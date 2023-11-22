<div>
    <div class="mb-5 flex flex-col md:flex-row justify-between items-center md:items-start">
        <div class="flex items-center">
            <h2 class="text-3xl font-extrabold text-gray-200 mt-2 md:mt-0 ml-2 transform hover:scale-105 transition-transform duration-300 ease-in-out">Enseignants</h2>
        </div>
        <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
            <div class="relative">
                <input type="text" placeholder="Rechercher" class="border rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring focus:border-to-purple-300" wire:model.live="search">
                <div class="absolute left-3 top-2">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
            <a href="{{ route('enseignant.create') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
                <i class="fas fa-plus mr-2"></i> Ajouter Enseignant
            </a>
        </div>
    </div>
    
    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <x-table-header :direction="$orderDirection" label="IdEnseignant" name="IdEnseignant" :field="$orderField" class="py-3 px-6 text-left">Id</x-table-header>
                    <x-table-header :direction="$orderDirection" label="NomEnseignant" name="NomEnseignant" :field="$orderField" class="py-3 px-6 text-left">Nom</x-table-header>
                    <x-table-header :direction="$orderDirection" label="PrenomEnseignant" name="PrenomEnseignant" :field="$orderField" class="py-3 px-6 text-left">Prénom</x-table-header>
                    <x-table-header :direction="$orderDirection" label="AdresseEnseignant" name="AdresseEnseignant" :field="$orderField" class="py-3 px-6 text-left">Adresse</x-table-header>
                    <x-table-header :direction="$orderDirection" label="Contact" name="Contact" :field="$orderField" class="py-3 px-6 text-left">Contact</x-table-header>
                    <x-table-header :direction="$orderDirection" label="IdUtilisateur" name="IdUtilisateur" :field="$orderField" class="py-3 px-6 text-left">IdUtilisateur</x-table-header>
                    <th class="py-3 px-6 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @foreach($enseignants as $enseignant)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="pl-5">{{ $enseignant->IdEnseignant }}</td>
                    <td class="pl-5 text-purple-600">{{ $enseignant->NomEnseignant }}</td>
                    <td class="pl-5 text-purple-600">{{ $enseignant->PrenomEnseignant }}</td>
                    <td class="py-3 px-6">{{ $enseignant->AdresseEnseignant }}</td>
                    <td class="py-3 px-6">{{ $enseignant->Contact }}</td>
                    <td class="py-3 px-6">{{ $enseignant->IdUtilisateur }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <a href="{{ route('enseignant.show', $enseignant->IdEnseignant) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('enseignant.edit', $enseignant->IdEnseignant) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('enseignant.destroy', $enseignant->IdEnseignant) }}" method="POST">
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
        {{ $enseignants->links() }}
    </div>
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
                            // Si l'utilisateur a cliqué sur OK, soumettre le formulaire de suppression
                            e.target.closest('form').submit();
                        }
                    });
                });
            });
        });
    </script>
</div>
