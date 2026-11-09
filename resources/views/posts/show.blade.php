@extends('layouts.app')

@section('title', $post->title . ' – Barangay Bulletin')

@section('content')

    <a href="{{ route('posts.index') }}" class="text-sm text-blue-700 hover:underline">
        &larr; Back to all posts
    </a>

    <article class="mt-4 rounded bg-white p-5 shadow sm:p-8">

        @if ($post->is_pinned)
            <span class="inline-block rounded bg-amber-200 px-2 py-1 text-xs font-semibold text-amber-900">
                Pinned
            </span>
        @endif

        <h1 class="mt-2 text-2xl font-bold sm:text-3xl">{{ $post->title }}</h1>

        <p class="mt-2 text-sm text-slate-500">
            <span class="rounded bg-slate-200 px-2 py-1">{{ $post->category }}</span>
            &middot; {{ $post->published_at->format('M d, Y') }}
            &middot; {{ $post->views }} views
            &middot; Author #{{ $post->author_id }}
        </p>

        <div class="mt-5 whitespace-pre-line leading-relaxed">
            {{ $post->body }}
        </div>

    </article>

@endsection