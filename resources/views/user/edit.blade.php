@extends('accueil')

@section('content')
<div class="mb-5 flex flex-col md:flex-row justify-between items-center md:items-start">
    <div class="flex items-center">
        <h2 class="text-3xl font-extrabold text-gray-200 mt-2 md:mt-0 ml-2 transform hover:scale-105 transition-transform duration-300 ease-in-out">Modifier l'Utilisateur</h2>
    </div>
    <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
        <a href="{{ route('user.index') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
            <i class="fas fa-list mr-2"></i> Liste des Utilisateurs
        </a>
    </div>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('user.update', $user->IdUtilisateur) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            
            <div class="flex items-center">
                <div class="rounded-full overflow-hidden w-20 h-20">
                    <img id="photo-preview" src="{{ asset('imageUser/' . $user->photo) }}" alt="Ancienne photo de profil" class="w-full h-full object-cover">
                </div>
                <div class="ml-4">
                    <label for="photo" class="cursor-pointer flex items-center space-x-2">
                        <span class="text-indigo-500">Changer</span>
                        <input type="file" name="photo" id="photo" class="hidden" onchange="previewPhoto()">
                    </label>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <label for="IdUtilisateur" class="block text-sm font-medium text-gray-700">ID Utilisateur</label>
            <input type="text" name="IdUtilisateur" class="form-input bg-gray-100 border-2 rounded-md p-2 w-full" value="{{ $user->IdUtilisateur }}" readonly>
        </div>
        <div class="mb-4">
            <label for="role" class="block text-sm font-medium text-gray-700">Rôle</label>
            <select name="role" class="form-select bg-gray-100 border-2 rounded-md p-2 w-full" disabled>
                <option value="administrateur" {{ $user->role == 'administrateur' ? 'selected' : '' }}>Administrateur</option>
                <option value="professeur" {{ $user->role == 'professeur' ? 'selected' : '' }}>Enseignant</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input type="text" name="name" class="form-input bg-gray-100 border-2 rounded-md p-2 w-full" value="{{ $user->name }}" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" class="form-input bg-gray-100 border-2 rounded-md p-2 w-full" value="{{ $user->email }}" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe (optionnel)</label>
            <input type="password" name="password" class="form-input bg-gray-100 border-2 rounded-md p-2 w-full">
        </div>


        <div class="col-span-2 mt-6">
            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
                <i class="fas fa-dot-circle-o"></i> Mettre à jour
            </button>
            <a href="{{ route('user.index') }}" class="ml-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                <i class="fas fa-ban mr-2"></i> Annuler
            </a>
        </div>
    </form>
</div>

<script>
function previewPhoto() {
    const fileInput = document.getElementById('photo');
    const photoPreview = document.getElementById('photo-preview');

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            photoPreview.src = e.target.result;
        }

        reader.readAsDataURL(fileInput.files[0]);
    }
}
</script>

@endsection
