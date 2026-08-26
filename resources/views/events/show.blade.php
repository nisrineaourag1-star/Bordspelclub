<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('status'))
                    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-6">
                        {{ session('status') }}
                    </div>
                @endif

                <p class="text-sm text-gray-500 mb-2">
                    {{ $event->event_date->format('d/m/Y H:i') }}
                    @if ($event->location)
                        · {{ $event->location }}
                    @endif
                </p>

                <p class="text-gray-800 mb-6">
                    {{ $event->description }}
                </p>

                @auth
                    @php
                        $isRegistered = $event->participants->contains(auth()->id());
                    @endphp

                    @if ($isRegistered)
                        <form action="{{ route('events.unregister', $event) }}" method="POST">
                            @csrf
                            <x-danger-button>Uitschrijven</x-danger-button>
                        </form>
                    @else
                        <form action="{{ route('events.register', $event) }}" method="POST">
                            @csrf
                            <x-primary-button>Inschrijven</x-primary-button>
                        </form>
                    @endif
                @else
                    <p class="text-gray-500">
                        <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Log in</a> om je in te schrijven.
                    </p>
                @endauth

                <div class="mt-8">
                    <h3 class="font-semibold text-gray-800 mb-2">
                        Ingeschreven leden ({{ $event->participants->count() }})
                    </h3>
                    @forelse ($event->participants as $participant)
                        <p class="text-gray-600">
                            {{ $participant->profile->username ?? $participant->name }}
                        </p>
                    @empty
                        <p class="text-gray-400 italic">Nog niemand ingeschreven.</p>
                    @endforelse
                </div>

                <a href="{{ route('events.index') }}" class="inline-block mt-6 text-indigo-600 hover:underline">
                    ← Terug naar evenementen
                </a>
            </div>
        </div>
    </div>
</x-app-layout>