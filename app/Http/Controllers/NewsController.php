<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Publieke lijst van alle nieuwsberichten.
     */
    public function index()
    {
        $newsItems = News::orderByDesc('published_at')->get();

        return view('news.index', [
            'newsItems' => $newsItems,
        ]);
    }

    /**
     * Publieke detailpagina van één nieuwsbericht.
     */
    public function show(News $news)
    {
        return view('news.show', [
            'news' => $news,
        ]);
    }

    /**
     * Formulier om een nieuw nieuwsbericht aan te maken (admin only).
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Nieuw nieuwsbericht opslaan (admin only).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'published_at' => ['required', 'date'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $news = new News();
        $news->user_id = $request->user()->id;
        $news->title = $validated['title'];
        $news->content = $validated['content'];
        $news->published_at = $validated['published_at'];

        if ($request->hasFile('image')) {
            $news->image_path = $request->file('image')->store('news', 'public');
        }

        $news->save();

        return redirect()->route('news.index')->with('status', 'Nieuwsbericht toegevoegd.');
    }

    /**
     * Formulier om een nieuwsbericht te wijzigen (admin only).
     */
    public function edit(News $news)
    {
        return view('news.edit', [
            'news' => $news,
        ]);
    }

    /**
     * Nieuwsbericht bijwerken (admin only).
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'published_at' => ['required', 'date'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $news->title = $validated['title'];
        $news->content = $validated['content'];
        $news->published_at = $validated['published_at'];

        if ($request->hasFile('image')) {
            $news->image_path = $request->file('image')->store('news', 'public');
        }

        $news->save();

        return redirect()->route('news.index')->with('status', 'Nieuwsbericht bijgewerkt.');
    }

    /**
     * Nieuwsbericht verwijderen (admin only).
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')->with('status', 'Nieuwsbericht verwijderd.');
    }
}