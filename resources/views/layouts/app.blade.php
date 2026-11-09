<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Barangay Bulletin – Purok Palparan')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-800">

    <header class="bg-blue-800 text-white">
        <div class="max-w-5xl mx-auto px-4 py-5">
            <a href="{{ route('posts.index') }}" class="text-xl sm:text-2xl font-bold">
                Barangay Bulletin – Purok Palparan
            </a>
            <p class="text-sm text-blue-200">Barangay Matina Crossing, Davao City</p>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-6">
        @yield('content')
    </main>

    <footer class="max-w-5xl mx-auto px-4 py-6 text-sm text-slate-500">
        Barangay Matina Crossing Hall
    </footer>

</body>
</html>