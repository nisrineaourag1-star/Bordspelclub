<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Veelgestelde vragen
            </h2>
            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('faq.manage') }}" class="text-sm text-indigo-600 hover:underline">
                        Beheer FAQ
                    </a>
                @endif
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @forelse ($categories as $category)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold mb-4">{{ $category->name }}</h3>

                    <div class="space-y-4">
                        @forelse ($category->items as $item)
                            <div>
                                <p class="font-medium text-gray-900">{{ $item->question }}</p>
                                <p class="text-gray-600 mt-1">{{ $item->answer }}</p>
                            </div>
                        @empty
                            <p class="text-gray-400 italic">Nog geen vragen in deze categorie.</p>
                        @endforelse
                    </div>
                </div>
            @empty
                <p class="text-gray-500">Er zijn nog geen FAQ-categorieën.</p>
            @endforelse

        </div>
    </div>
</x-app-layout>