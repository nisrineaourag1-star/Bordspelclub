<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $news->title }}
            </h2>
            @auth
                @if (auth()->user()->isAdmin())
                    <div class="space-x-3">
                        <a href="{{ route('news.edit', $news) }}" class="text-sm text-indigo-600 hover:underline">
                            Wijzig
                        </a>
                        <form action="{{ route('news.destroy', $news) }}" method="POST" class="inline"
                              onsubmit="return confirm('Weet je zeker dat je dit bericht wil verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:underline">
                                Verwijder
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($news->image_path)
                    <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title }}" class="w-full h-64 object-cover rounded mb-4">
                @endif

                <p class="text-sm text-gray-500 mb-4">
                    Gepubliceerd op {{ $news->published_at->format('d/m/Y') }} door {{ $news->author->name }}
                </p>

                <div class="prose max-w-none text-gray-800">
                    {{ $news->content }}
                </div>

                <a href="{{ route('news.index') }}" class="inline-block mt-6 text-indigo-600 hover:underline">
                    ← Terug naar nieuws
                </a>
            </div>
        </div>
    </div>
</x-app-layout>