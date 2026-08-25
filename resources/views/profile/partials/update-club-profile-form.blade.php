<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">Mijn clubprofiel</h2>
        <p class="mt-1 text-sm text-gray-600">
            Username, verjaardag, profielfoto en "over mij"-tekst.
        </p>
    </header>

    <form method="post" action="{{ route('profile.club.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="username" value="Username" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full"
                :value="old('username', $user->profile->username ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="birthday" value="Verjaardag" />
            <x-text-input id="birthday" name="birthday" type="date" class="mt-1 block w-full"
                :value="old('birthday', optional($user->profile->birthday ?? null)->format('Y-m-d'))" />
            <x-input-error class="mt-2" :messages="$errors->get('birthday')" />
        </div>

        <div>
            <x-input-label for="avatar" value="Profielfoto" />
            <input id="avatar" name="avatar" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-600" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div>
            <x-input-label for="bio" value="Over mij" />
            <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Opslaan</x-primary-button>

            @if (session('club-profile-updated'))
                <p class="text-sm text-gray-600">Opgeslagen.</p>
            @endif
        </div>
    </form>
</section>