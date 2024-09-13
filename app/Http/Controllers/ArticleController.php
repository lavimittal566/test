<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;


class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return response()->json($articles,200);
    }
    
    public function store(Request $request)
    {
        $id = Auth::id();
        dd($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);
    
        $article = Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => $id,
        ]);
    
        return response()->json($article, 201);
    }

    public function show($id)
    {
         $article = Article::find($id);
         return response()->json($article,200);
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return response()->json(null, 204);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

         $validated = $request->validate([
        'title' => 'string|max:255',
        'content' => 'string',
         ]);

        $article->update($validated);
        return response()->json($article, 200);

    }
}
