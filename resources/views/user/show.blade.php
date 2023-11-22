@extends('accueil')

@section('content')
<div class="mb-5 flex flex-col md:flex-row justify-between items-center md:items-start">
    <div class="flex items-center">
        <h2 class="text-3xl font-extrabold text-gray-200 mt-2 md:mt-0 ml-2 transform hover:scale-105 transition-transform duration-300 ease-in-out">Détails de l'Utilisateur</h2>
    </div>
    <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
        <a href="{{ route('user.index') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
            <i class="fas fa-list mr-2"></i> Liste des Utilisateurs
        </a>
    </div>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <table class="flex justify-center border-collapse">
        <tbody>
            <tr>
                <th class="p-2">Photo</th>
                <td>
                    <div class="rounded-full overflow-hidden w-20 h-20 mb-2">
                        <img src="{{ asset('imageUser/' . $user->photo) }}" alt="Néant" class="w-full h-full object-cover">
                    </div>
                </td>
            </tr>
            <tr>
                <th class="p-2">ID Utilisateur</th>
                <td class="p-2">{{ $user->IdUtilisateur }}</td>
            </tr>
            <tr>
                <th class="p-2">Nom</th>
                <td class="p-2">{{ $user->name }}</td>
            </tr>
            <tr>
                <th class="p-2">Email</th>
                <td class="p-2">{{ $user->email }}</td>
            </tr>
            <tr>
                <th class="p-2">Rôle</th>
                <td class="p-2">{{ $user->role }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
