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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    @if ($item->image_path)
                        <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover rounded mb-4">
                    @endif

                    <h3 class="text-xl font-bold mb-1">
                        <a href="{{ route('news.show', $item) }}" class="hover:underline">{{ $item->title }}</a>
                    </h3>

                    <p class="text-sm text-gray-500 mb-2">
                        {{ $item->published_at->format('d/m/Y') }}
                    </p>

                    <p class="text-gray-700">
                        {{ Str::limit($item->content, 150) }}
                    </p>

                    <a href="{{ route('news.show', $item) }}" class="inline-block mt-3 text-indigo-600 hover:underline">
                        Lees meer
                    </a>
                </div>
            @empty
                <p class="text-gray-500">Er zijn nog geen nieuwsberichten.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>