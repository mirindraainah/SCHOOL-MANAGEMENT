<div>
    <div class="mb-5 flex justify-between items-center">
        <h2 class="text-3xl font-extrabold text-gray-200">Utilisateurs</h2>
        <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
            <div class="relative">
                <input type="text" placeholder="Rechercher" class="border rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring focus:border-to-purple-300" wire:model.live.debounce.300ms="search">
                <div class="absolute left-3 top-2">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
            </div>
            <div class="relative">
                <select class="border rounded-full py-2 px-4 pl-10 focus:outline-none focus:ring focus:border-to-purple-300" wire:model.live="selectedRole">
                    <option value="">Tous les rôles</option>
                    @foreach($allRoles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                </select>
            </div>
            <a href="{{ route('user.create') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
                <i class="fas fa-plus mr-2"></i> Ajouter
            </a>
        </div>
    </div>
    
    <div class="bg-white shadow rounded-sm my-2.5 overflow-x-auto">
        <table class="min-w-max w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <x-table-header :direction="$orderDirection" label="IdUtilisateur" name="IdUtilisateur" :field="$orderField" class="py-3 px-6 text-left">Id</x-table-header>
                    <th class="py-3 px-6 text-left">Photo</th>
                    <x-table-header :direction="$orderDirection" label="name" name="name" :field="$orderField" class="py-3 px-6 text-left">Nom</x-table-header>
                    <x-table-header :direction="$orderDirection" label="email" name="email" :field="$orderField" class="py-3 px-6 text-left">Email</x-table-header>
                    <x-table-header :direction="$orderDirection" label="role" name="role" :field="$orderField" class="py-3 px-6 text-left">Rôle</x-table-header>
                    <th class="py-3 px-6 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm">
                @foreach($users as $user)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="pl-5">{{ $user->IdUtilisateur }}</td>
                    <td>
                        @if($user->photo)
                            <img src="{{ asset('imageUser/' . $user->photo) }}" alt="" class="w-12 h-12 rounded-full">
                        @endif
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td class="py-3 px-6 text-right">
                        <div class="flex items-center justify-end">
                            <a href="{{ route('user.show', $user->IdUtilisateur) }}" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('user.edit', $user->IdUtilisateur) }}" method="GET"> 
                                @csrf
                                <button type="submit" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>
    
                            <form action="{{ route('user.destroy', $user->IdUtilisateur) }}" method="POST">
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
        {{ $users->links() }}
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
                            // Si l'utilisateur a cliqué sur OK, soumettez le formulaire de suppression
                            e.target.closest('form').submit();
                        }
                    });
                });
            });
        });
    </script>
</div>
