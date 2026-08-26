<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Nieuws
            </h2>
            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('news.create') }}" class="text-sm text-indigo-600 hover:underline">
                        + Nieuw bericht
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded">
                    {{ session('status') }}
                </div>
            @endif

            @forelse ($newsItems as $item)
                <x-news-card :news="$item" />
            @empty
                <p class="text-gray-500">Er zijn nog geen nieuwsberichten.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>