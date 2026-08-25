<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Profiel van {{ $profileUser->profile->username ?? $profileUser->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($profileUser->profile && $profileUser->profile->avatar_path)
                    <img src="{{ Storage::url($profileUser->profile->avatar_path) }}"
                         alt="Profielfoto"
                         class="w-32 h-32 rounded-full object-cover mb-4">
                @endif

                <h3 class="text-2xl font-bold mb-2">
                    {{ $profileUser->profile->username ?? $profileUser->name }}
                </h3>

                @if ($profileUser->profile && $profileUser->profile->birthday)
                    <p class="text-gray-600 mb-2">
                        Verjaardag: {{ $profileUser->profile->birthday->format('d/m/Y') }}
                    </p>
                @endif

                @if ($profileUser->profile && $profileUser->profile->bio)
                    <p class="text-gray-800 mt-4">
                        {{ $profileUser->profile->bio }}
                    </p>
                @else
                    <p class="text-gray-400 italic mt-4">Deze gebruiker heeft nog geen "over mij"-tekst ingevuld.</p>
                @endif

                @auth
                    @if (auth()->id() === $profileUser->id)
                        <a href="{{ route('profile.edit') }}" class="inline-block mt-6 text-indigo-600 hover:underline">
                            Bewerk mijn profiel
                        </a>
                    @endif
                @endauth

            </div>
        </div>
    </div>
</x-app-layout>