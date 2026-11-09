@extends('layouts.app')

@section('title', $post->title . ' – Barangay Bulletin')

@section('content')

@php
    $ink = [
        'Announcement'  => 'text-[#2F6B4F]',
        'Health'        => 'text-[#A33A3A]',
        'Peace & Order' => 'text-[#2C4A7C]',
        'Ayuda'         => 'text-[#B07D0F]',
        'Lost & Found'  => 'text-[#6B3F72]',
    ];
    $edge = [
        'Announcement'  => 'border-l-[#2F6B4F]',
        'Health'        => 'border-l-[#A33A3A]',
        'Peace & Order' => 'border-l-[#2C4A7C]',
        'Ayuda'         => 'border-l-[#B07D0F]',
        'Lost & Found'  => 'border-l-[#6B3F72]',
    ];
@endphp

<a href="{{ route('posts.index') }}"
   class="inline-block border-b border-[#1F4D3A] pb-0.5 text-[14px] font-medium text-[#1F4D3A]">
    Bumalik sa lahat ng abiso
</a>

<article class="mt-6 border-l-[6px] bg-white px-6 py-8 sm:px-12 sm:py-12
                {{ $post->is_pinned ? 'border-l-[#C9A227]' : ($edge[$post->category] ?? 'border-l-[#CFC7B2]') }}">

    @if ($post->is_pinned)
        <p class="text-[13px] font-medium text-[#8A6E12]">Nakapaskil sa board</p>
    @endif

    <p class="mt-1 text-[13px] font-medium {{ $ink[$post->category] ?? 'text-[#4A463C]' }}">
        {{ $post->category }}
    </p>

    <h1 class="mt-3 max-w-[24ch] text-[30px] font-semibold leading-[1.12] sm:text-[42px]">
        {{ $post->title }}
    </h1>

    <div class="mt-5 flex flex-wrap gap-x-8 gap-y-2 border-y border-[#EFEAD9] py-4 text-[13px] text-[#7A7465]">
        <span>Inilathala {{ $post->published_at->format('j F Y') }}</span>
        <span>{{ $post->views }} nabasa</span>
        <span>Opisyal #{{ $post->author_id }}</span>
    </div>

    <div class="mt-7 max-w-[66ch] whitespace-pre-line text-[17px] leading-[1.75] text-[#3A362D]">
        {{ $post->body }}
    </div>

</article>

@endsection