@extends('accueil')

@section('content')
<div class="mb-5 flex flex-col md:flex-row justify-between items-center md:items-start">
    <div class="flex items-center">
        <h2 class="text-3xl font-extrabold text-gray-200 mt-2 md:mt-0 ml-2 transform hover:scale-105 transition-transform duration-300 ease-in-out">Éditer un Examen</h2>
    </div>
</div>

<div class="bg-white shadow-md rounded-lg p-6">
    <form action="{{ route('examen.update', $examen->IdExamen) }}" method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="LibelleExamen" class="block text-sm font-medium text-gray-700">Libellé de l'Examen</label>
            <input type="text" id="LibelleExamen" name="LibelleExamen" class="form-input mt-1 p-2 border rounded-md w-full" value="{{ $examen->LibelleExamen }}">
        </div>

        <div class="col-span-2 mt-6">
            <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-md hover:bg-gradient-to-r hover:from-indigo-600 hover:to-purple-600 focus:outline-none focus:bg-gradient-to-r focus:from-indigo-600 focus:to-purple-600">
                <i class="fa fa-dot-circle-o"></i> Modifier
            </button>
            <a href="{{ route('examen.index') }}" class="ml-2 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">
                <i class="fa fa-ban mr-2"></i> Annuler
            </a>
        </div>
    </form>
</div>

@endsection
