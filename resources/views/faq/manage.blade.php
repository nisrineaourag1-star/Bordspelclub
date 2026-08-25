<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            FAQ beheren
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-8">

            @if (session('status'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Nieuwe categorie toevoegen -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Nieuwe categorie</h3>
                <form action="{{ route('faq.category.store') }}" method="POST" class="flex gap-4">
                    @csrf
                    <input type="text" name="name" placeholder="Naam van de categorie" required
                           class="flex-1 border-gray-300 rounded-md shadow-sm">
                    <x-primary-button>Toevoegen</x-primary-button>
                </form>
            </div>

            <!-- Nieuwe vraag toevoegen -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Nieuwe vraag</h3>
                <form action="{{ route('faq.item.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Categorie</label>
                        <select name="faq_category_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Vraag</label>
                        <input type="text" name="question" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Antwoord</label>
                        <textarea name="answer" rows="3" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    <x-primary-button>Toevoegen</x-primary-button>
                </form>
            </div>

            <!-- Overzicht met verwijder-mogelijkheid -->
            @foreach ($categories as $category)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">{{ $category->name }}</h3>
                        <form action="{{ route('faq.category.destroy', $category) }}" method="POST"
                              onsubmit="return confirm('Categorie en al zijn vragen verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:underline">Verwijder categorie</button>
                        </form>
                    </div>

                    <div class="space-y-3">
                        @forelse ($category->items as $item)
                            <div class="flex justify-between items-start border-t pt-3">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $item->question }}</p>
                                    <p class="text-gray-600 text-sm mt-1">{{ $item->answer }}</p>
                                </div>
                                <form action="{{ route('faq.item.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('Deze vraag verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:underline whitespace-nowrap ml-4">Verwijder</button>
                                </form>
                            </div>
                        @empty
                            <p class="text-gray-400 italic">Nog geen vragen.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>