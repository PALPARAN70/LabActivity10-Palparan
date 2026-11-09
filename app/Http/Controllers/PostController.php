<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->where('is_published', true)
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('q') . '%');
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category', $request->input('category'));
            })
            ->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate(8)
            ->withQueryString();

        $categories = Post::query()
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show($id)
    {
        $post = Post::where('is_published', true)->findOrFail($id);

        $post->views = $post->views + 1;
        $post->save();

        return view('posts.show', compact('post'));
    }
}