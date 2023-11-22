@extends('accueil')

@section('content')
<div class="mb-5 flex flex-col md:flex-row justify-between items-center md:items-start">
    <div class="flex items-center">
        <h2 class="text-3xl font-extrabold text-gray-200 mt-2 md:mt-0 ml-2 transform hover:scale-105 transition-transform duration-300 ease-in-out">Ajouter un Utilisateur</h2>
    </div>
    <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
        <a href="{{ route('user.index') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
            <i class="fas fa-list mr-2"></i> Liste des Utilisateurs
        </a>
    </div>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Rôle</label>
            <select name="role" class="form-select mt-1 p-2 border rounded-md w-full" required>
                <option value="administrateur">Administrateur</option>
                <option value="professeur">Enseignant</option>
            </select>
        </div>
        <div class="mb-4" id="idUtilisateurField">
            <label for="IdUtilisateur" class="block text-sm font-medium text-gray-700">ID Utilisateur</label>
            <input type="text" name="IdUtilisateur" class="form-input mt-1 p-2 border rounded-md w-full" required>
        </div>
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="name" class="form-input mt-1 p-2 border rounded-md w-full" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" class="form-input mt-1 p-2 border rounded-md w-full" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input type="password" name="password" class="form-input mt-1 p-2 border rounded-md w-full" required>
        </div>
        <div class="mb-4">
            <label for="photo" class="block text-sm font-medium text-gray-700">Photo de profil</label>
            <input type="file" name="photo" class="form-input mt-1 p-2 border rounded-md w-full">
        </div>

        <div class="col-span-2 mt-6">
            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
                <i class="fas fa-dot-circle-o"></i> Ajouter
            </button>
            <a href="{{ route('user.index') }}" class="ml-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                <i class="fas fa-ban mr-2"></i> Annuler
            </a>
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const roleSelect = document.querySelector('select[name="role"]');
        const idUtilisateurField = document.getElementById('idUtilisateurField');

        roleSelect.addEventListener('change', function () {
            if (this.value === 'professeur') {
                idUtilisateurField.innerHTML = `
                    <label for="IdUtilisateur" class="block text-sm font-medium text-gray-700">ID Utilisateur</label>
                    <select name="IdUtilisateur" class="form-select mt-1 p-2 border rounded-md w-full" required>
                        <option value="">Sélectionner un utilisateur</option>
                        @foreach($enseignants as $enseignant)
                            <option value="{{ $enseignant->IdUtilisateur }}">{{ $enseignant->IdUtilisateur }} ({{ $enseignant->NomEnseignant }} {{ $enseignant->PrenomEnseignant }})</option>
                        @endforeach
                    </select>
                `;
            } else {
                idUtilisateurField.innerHTML = `
                    <label for="IdUtilisateur" class="block text-sm font-medium text-gray-700">ID Utilisateur</label>
                    <input type="text" name="IdUtilisateur" class="form-input mt-1 p-2 border rounded-md w-full" required>
                `;
            }
        });
    });
</script>

@endsection
