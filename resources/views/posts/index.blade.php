@extends('layouts.app')

@section('title', 'Barangay Bulletin – Purok Palparan')

@section('content')

@php
    $spine = [
        'Announcement'  => 'border-l-[#2F6B4F]',
        'Health'        => 'border-l-[#A33A3A]',
        'Peace & Order' => 'border-l-[#2C4A7C]',
        'Ayuda'         => 'border-l-[#B07D0F]',
        'Lost & Found'  => 'border-l-[#6B3F72]',
    ];
    $ink = [
        'Announcement'  => 'text-[#2F6B4F]',
        'Health'        => 'text-[#A33A3A]',
        'Peace & Order' => 'text-[#2C4A7C]',
        'Ayuda'         => 'text-[#B07D0F]',
        'Lost & Found'  => 'text-[#6B3F72]',
    ];
@endphp

<form method="GET" action="{{ route('posts.index') }}" class="mb-10">

    <label for="q" class="mb-2 block text-[13px] font-medium text-[#5C5749]">
        Hanapin ang abiso
    </label>

    <div class="flex flex-col gap-3 sm:flex-row">

        <div class="relative flex-1">
            <svg class="pointer-events-none absolute left-3.5 top-1/2 h-[18px] w-[18px] -translate-y-1/2"
                 viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <circle cx="11" cy="11" r="6.5" stroke="#8A8474" stroke-width="2"/>
                <path d="m16 16 4.5 4.5" stroke="#8A8474" stroke-width="2" stroke-linecap="round"/>
            </svg>

            <input id="q" type="search" name="q" value="{{ request('q') }}"
                 
                   class="w-full rounded-[3px] border border-[#CFC7B2] bg-white py-2.5 pl-11 pr-3
                          text-[15px] placeholder:text-[#A39C8A]
                          focus:border-[#1F4D3A] focus:outline-none focus:ring-2 focus:ring-[#1F4D3A]/20">
        </div>

        <select name="category" aria-label="Kategorya"
                class="rounded-[3px] border border-[#CFC7B2] bg-white px-3 py-2.5 text-[15px]
                       focus:border-[#1F4D3A] focus:outline-none focus:ring-2 focus:ring-[#1F4D3A]/20">
            <option value="">Lahat ng kategorya</option>
            @foreach ($categories as $c)
                <option value="{{ $c }}" @selected(request('category') === $c)>{{ $c }}</option>
            @endforeach
        </select>

        <button type="submit"
                class="rounded-[3px] bg-[#1F4D3A] px-7 py-2.5 text-[15px] font-medium text-[#FAF6EC]
                       hover:bg-[#163A2B] focus:outline-none focus:ring-2 focus:ring-[#C9A227]">
            Hanapin
        </button>
    </div>

    @if (request()->filled('q') || request()->filled('category'))
        <p class="mt-3 text-[13px] text-[#7A7465]">
            {{ $posts->total() }} abisong tumugma.
            <a href="{{ route('posts.index') }}" class="ml-1 border-b border-[#1F4D3A] pb-px font-medium text-[#1F4D3A]">
                Alisin ang filter
            </a>
        </p>
    @endif
</form>

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

    @forelse ($posts as $post)

        @if ($loop->first && $post->is_pinned)

            <article class="relative col-span-full rounded-[3px] border border-[#E2DCCB] border-l-[6px] border-l-[#C9A227] bg-white px-6 pt-11 pb-7 sm:px-10 sm:pt-12">

                <svg class="absolute left-6 top-4 h-7 w-7 sm:left-10" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M14.5 2.5 21.5 9.5l-2.6 1.1a4 4 0 0 0-2 2l-1.5 3.6-6.6-6.6 3.6-1.5a4 4 0 0 0 2-2z" fill="#C9A227"/>
                    <path d="M8.8 15.2 3 21" stroke="#8A6E12" stroke-width="2" stroke-linecap="round"/>
                    <circle cx="17.9" cy="6.1" r="2.4" fill="#E4C14F"/>
                </svg>

                <p class="text-[13px] font-medium text-[#8A6E12]">Nakapaskil sa board</p>

                <h2 class="mt-2 max-w-[28ch] text-[26px] font-semibold leading-[1.15] sm:text-[34px]">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">
                        {{ $post->title }}
                    </a>
                </h2>

                <p class="mt-4 max-w-[62ch] text-[16px] leading-[1.7] text-[#4A463C]">
                    {{ Str::limit($post->body, 200) }}
                </p>

                <div class="mt-6 flex flex-wrap gap-x-8 gap-y-2 border-t border-[#EFEAD9] pt-4 text-[13px] text-[#7A7465]">
                    <span class="font-medium {{ $ink[$post->category] ?? 'text-[#4A463C]' }}">{{ $post->category }}</span>
                    <span>{{ $post->published_at->format('j F Y') }}</span>
                    <span>{{ $post->views }} nabasa</span>
                    <span>Opisyal #{{ $post->author_id }}</span>
                </div>
            </article>

        @else

            <article class="flex flex-col rounded-[3px] border border-[#E2DCCB] border-l-4 bg-white px-5 py-6 {{ $spine[$post->category] ?? 'border-l-[#CFC7B2]' }}">

                <p class="text-[12px] font-medium {{ $ink[$post->category] ?? 'text-[#4A463C]' }}">
                    {{ $post->category }}
                </p>

                <h2 class="mt-2 max-w-[32ch] text-[18px] font-semibold leading-[1.3]">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">
                        {{ $post->title }}
                    </a>
                </h2>

                <div class="mt-auto flex flex-wrap gap-x-5 gap-y-1 pt-6 text-[12px] text-[#8A8474]">
                    <span>{{ $post->published_at->format('j M Y') }}</span>
                    <span>{{ $post->views }} nabasa</span>
                    <span>Opisyal #{{ $post->author_id }}</span>
                </div>
            </article>

        @endif

    @empty
        <div class="col-span-full rounded-[3px] border border-dashed border-[#CFC7B2] bg-white px-6 py-16 text-center">
            <p class="font-notice text-[20px]">No posts match your search.</p>
            <p class="mt-2 text-[14px] text-[#7A7465]">
                Subukang alisin ang kategorya o gumamit ng mas maikling salita.
            </p>
            <a href="{{ route('posts.index') }}"
               class="mt-5 inline-block border-b border-[#1F4D3A] pb-0.5 text-[14px] font-medium text-[#1F4D3A]">
                Ibalik ang lahat ng abiso
            </a>
        </div>
    @endforelse

</div>

<div class="mt-8 border-t border-[#E2DCCB] pt-6">
    {{ $posts->links() }}

    <p class="mt-3 text-[13px] text-[#7A7465]">
        Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
    </p>
</div>

@endsection