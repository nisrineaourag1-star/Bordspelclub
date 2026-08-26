<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Evenementen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @forelse ($events as $event)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-xl font-bold mb-1">
                        <a href="{{ route('events.show', $event) }}" class="hover:underline">{{ $event->title }}</a>
                    </h3>

                    <p class="text-sm text-gray-500 mb-2">
                        {{ $event->event_date->format('d/m/Y H:i') }}
                        @if ($event->location)
                            · {{ $event->location }}
                        @endif
                    </p>

                    <p class="text-gray-700 mb-3">
                        {{ $event->description }}
                    </p>

                    <p class="text-sm text-gray-500 mb-3">
                        {{ $event->participants->count() }} ingeschreven
                    </p>

                    <a href="{{ route('events.show', $event) }}" class="inline-block text-indigo-600 hover:underline">
                        Bekijk / inschrijven
                    </a>
                </div>
            @empty
                <p class="text-gray-500">Er zijn nog geen evenementen.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>