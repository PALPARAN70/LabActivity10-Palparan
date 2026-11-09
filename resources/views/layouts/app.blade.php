<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Barangay Bulletin – Purok Palparan')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Zilla+Slab:wght@500;600;700&family=Inter:wght@400;500;600&display=swap">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#FAF6EC] text-[#27251E]">

    <header class="bg-[#1F4D3A]">
        <div class="mx-auto max-w-4xl px-5 pt-10 pb-8">
            <p class="text-[13px] text-[#9BBCA8]">Barangay Matina Crossing, Davao City</p>

            <h1 class="mt-1 text-[28px] font-semibold leading-tight text-[#FAF6EC] sm:text-[38px]">
                <a href="{{ route('posts.index') }}">Barangay Bulletin</a>
            </h1>

            <p class="mt-1 text-[15px] text-[#C7DBCF]">Purok Palparan</p>
        </div>
        <div class="h-[3px] bg-[#C9A227]"></div>
    </header>

    <main class="mx-auto max-w-4xl px-5 py-10">
        @yield('content')
    </main>

    <footer class="mx-auto max-w-4xl px-5 pb-12">
        <div class="border-t border-[#E2DCCB] pt-5 text-[13px] leading-relaxed text-[#7A7465]">
            Mga abiso mula sa Barangay Matina Crossing Hall.<br>
            Para sa katanungan, dumulog sa barangay hall tuwing Lunes hanggang Biyernes.
        </div>
    </footer>

</body>
</html>