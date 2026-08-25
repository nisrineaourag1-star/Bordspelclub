<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nieuwsbericht wijzigen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if ($news->image_path)
                    <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title }}" class="w-full h-48 object-cover rounded mb-6">
                @endif

                <form action="{{ route('news.update', $news) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="title" value="Titel" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $news->title)" required />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="published_at" value="Publicatiedatum" />
                        <x-text-input id="published_at" name="published_at" type="date" class="mt-1 block w-full" :value="old('published_at', $news->published_at->format('Y-m-d'))" required />
                        <x-input-error class="mt-2" :messages="$errors->get('published_at')" />
                    </div>

                    <div>
                        <x-input-label for="image" value="Nieuwe afbeelding (optioneel)" />
                        <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-600" />
                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                    </div>

                    <div>
                        <x-input-label for="content" value="Inhoud" />
                        <textarea id="content" name="content" rows="8" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('content', $news->content) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('content')" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>Opslaan</x-primary-button>
                        <a href="{{ route('news.index') }}" class="text-sm text-gray-600 hover:underline">Annuleren</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>