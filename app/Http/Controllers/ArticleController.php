<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('status', 'published')->latest()->paginate(9);
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        if ($article->status !== 'published') {
            abort(404);
        }
        $latestArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();
        return view('articles.show', compact('article', 'latestArticles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        // Simple store for now, matching the Admin version but maybe with different validation or status
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']) . '-' . rand(1000, 9999);
        $validated['author_id'] = auth()->id();
        $validated['status'] = 'draft'; // Public submissions stay as draft

        Article::create($validated);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dikirim dan menunggu moderasi.');
    }
}
