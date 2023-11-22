<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- IdUtilisateur -->
        <div class="mt-4">
            <x-input-label for="IdUtilisateur" :value="__('Id Utilisateur')" />
            <x-text-input id="IdUtilisateur" class="block mt-1 w-full" type="text" name="IdUtilisateur" :value="old('IdUtilisateur')" required autofocus />
            <x-input-error :messages="$errors->get('IdUtilisateur')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nom')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Rôle')" />
            <select id="role" class="block mt-1 w-full" name="role" required>
                <option value="administrateur">Administrateur</option>
                <option value="professeur">Professeur</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmation du mot de passe')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Déjà enregistré?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('S \'enregistrer') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
