@props(['news'])

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    @if ($news->image_path)
        <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title }}" class="w-full h-48 object-cover rounded mb-4">
    @endif

    <h3 class="text-xl font-bold mb-1">
        <a href="{{ route('news.show', $news) }}" class="hover:underline">{{ $news->title }}</a>
    </h3>

    <p class="text-sm text-gray-500 mb-2">
        {{ $news->published_at->format('d/m/Y') }}
    </p>

    <p class="text-gray-700">
        {{ Str::limit($news->content, 150) }}
    </p>

    <a href="{{ route('news.show', $news) }}" class="inline-block mt-3 text-indigo-600 hover:underline">
        Lees meer
    </a>
</div>