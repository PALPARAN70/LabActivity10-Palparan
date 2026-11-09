@extends('layouts.app')

@section('title', 'Barangay Bulletin – Purok Palparan')

@section('content')

    <form method="GET" action="{{ route('posts.index') }}"
          class="flex flex-col sm:flex-row gap-2 mb-6">

        <input type="text" name="q" value="{{ request('q') }}"
               placeholder="Search title"
               class="flex-1 rounded border border-slate-300 px-3 py-2">

        <select name="category"
                class="rounded border border-slate-300 px-3 py-2">
            <option value="">All categories</option>
            @foreach ($categories as $c)
                <option value="{{ $c }}" @selected(request('category') === $c)>
                    {{ $c }}
                </option>
            @endforeach
        </select>

        <button type="submit"
                class="rounded bg-blue-700 px-4 py-2 text-white hover:bg-blue-800">
            Filter
        </button>
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        @forelse ($posts as $post)
            <article class="rounded bg-white p-4 shadow">

                @if ($post->is_pinned)
                    <span class="inline-block rounded bg-amber-200 px-2 py-1 text-xs font-semibold text-amber-900">
                        Pinned
                    </span>
                @endif

                <h2 class="mt-2 font-semibold">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">
                        {{ $post->title }}
                    </a>
                </h2>

                <span class="mt-2 inline-block rounded bg-slate-200 px-2 py-1 text-xs">
                    {{ $post->category }}
                </span>

                <p class="mt-2 text-sm text-slate-500">
                    {{ $post->published_at->format('M d, Y') }} &middot;
                    {{ $post->views }} views &middot;
                    Author #{{ $post->author_id }}
                </p>
            </article>
        @empty
            <p class="col-span-full">No posts match your search.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $posts->links() }}
    </div>

    <p class="mt-2 text-sm text-slate-600">
        Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
    </p>

@endsection