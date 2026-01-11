<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Hello Alibaug')</title>
    <meta name="description" content="@yield('meta_description', 'Discover the best villas, cafes and experiences in Alibaug.')">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-900 antialiased">

{{-- HEADER --}}
<header class="sticky top-0 z-50 glass-nav border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">

        {{-- Logo --}}
        <a href="/" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-teal-500 to-emerald-500 flex items-center justify-center text-white font-bold">HA</div>
            <div class="hidden sm:block">
                <div class="text-lg font-semibold tracking-tight">Hello<span class="text-teal-600">Alibaug</span></div>
                <div class="text-xs text-gray-500">Premium stays & experiences</div>
            </div>
        </a>

        {{-- Navigation --}}
        <nav class="hidden md:flex items-center gap-8 text-sm font-medium">
            <a href="#" class="hover:text-teal-600 transition">Explore</a>
            <a href="#" class="hover:text-teal-600 transition">Villas</a>
            <a href="#" class="hover:text-teal-600 transition">Cafes</a>
            <a href="#" class="hover:text-teal-600 transition">Experiences</a>
        </nav>

        {{-- Actions --}}
        <div class="flex items-center gap-4">
            <a href="#" class="hidden sm:inline-block text-sm font-medium text-gray-600 hover:text-teal-600 transition">Sign in</a>

            <a href="#" class="btn-primary">List your place</a>

            {{-- Mobile menu toggle (simple) --}}
            <button class="md:hidden ml-2 p-2 rounded-lg text-gray-600 hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</header>

{{-- PAGE CONTENT --}}
<main>
    @yield('content')
</main>

{{-- FOOTER --}}

<footer class="bg-gray-50 border-t border-gray-100 mt-24">
    <div class="max-w-7xl mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-4 gap-12">

        {{-- Brand --}}
        <div>
            <h3 class="text-lg font-semibold mb-4">
                Hello<span class="text-teal-600">Alibaug</span>
            </h3>
            <p class="text-sm text-gray-600 leading-relaxed">
                A curated guide to the best stays, cafes and experiences in Alibaug.
            </p>
        </div>

        {{-- Links --}}
        <div>
            <h4 class="text-sm font-semibold mb-4">Explore</h4>
            <ul class="space-y-3 text-sm text-gray-600">
                <li><a href="#" class="hover:text-green-600">Villas</a></li>
                <li><a href="#" class="hover:text-green-600">Cafes</a></li>
                <li><a href="#" class="hover:text-green-600">Beaches</a></li>
                <li><a href="#" class="hover:text-green-600">Experiences</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-sm font-semibold mb-4">For Owners</h4>
            <ul class="space-y-3 text-sm text-gray-600">
                <li><a href="#" class="hover:text-green-600">List Property</a></li>
                <li><a href="#" class="hover:text-green-600">Pricing</a></li>
                <li><a href="#" class="hover:text-green-600">Support</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-sm font-semibold mb-4">Company</h4>
            <ul class="space-y-3 text-sm text-gray-600">
                <li><a href="#" class="hover:text-green-600">About</a></li>
                <li><a href="#" class="hover:text-green-600">Contact</a></li>
                <li><a href="#" class="hover:text-green-600">Privacy Policy</a></li>
            </ul>
        </div>
    </div>

</div>
    <div class="border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 py-6 text-sm text-gray-500 flex flex-col sm:flex-row sm:justify-between gap-2">
            <span>© {{ date('Y') }} Hello Alibaug</span>
            <span>Made with ❤️ in Alibaug</span>
        </div>
    </div>
</footer>

</body>
</html>
