@extends('layouts.app')

@section('title', 'Hello Alibaug – Premium Villas, Cafes & Experiences')

@section('content')

{{-- HERO --}}
<section class="bg-gray-50 pb-24">

    {{-- SEARCH BAR --}}
    <div class="max-w-6xl mx-auto px-4 pt-10 relative z-20">
        <div class="bg-white rounded-2xl shadow-xl p-4 flex flex-col md:flex-row gap-3">

            {{-- Where --}}
            <div class="flex-1 flex items-center gap-3 bg-gray-50 rounded-xl px-4 py-3">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M12 21s-6-5.686-6-10a6 6 0 1112 0c0 4.314-6 10-6 10z"/>
                </svg>
                <input
    type="text"
    placeholder="Where to? (Villa, Cafe, Beach...)"
    class="w-full bg-transparent text-sm leading-tight
           border-0 outline-none ring-0
           focus:border-0 focus:outline-none focus:ring-0"
/>


            </div>

            {{-- When --}}
            <div class="flex items-center gap-3 bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-500">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Any date
            </div>

            {{-- Category --}}
            <div class="flex items-center gap-3 bg-gray-50 rounded-xl px-4 py-3 text-sm text-gray-500">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                All listings
            </div>

            {{-- Search --}}
            <button
                class="bg-emerald-600 text-white px-8 py-3 rounded-xl text-sm font-semibold
                    border-0 outline-none ring-0
                    focus:outline-none focus:ring-0
                    hover:bg-emerald-700 transition shadow-md hover:shadow-lg">
                Search
            </button>



        </div>
    </div>

    {{-- HERO IMAGE --}}
    <div class="max-w-7xl mx-auto px-4 mt-12">
        <div class="relative rounded-3xl overflow-hidden shadow-lg">

            <img
                src="https://helloalibaug.com/wp-content/uploads/2025/06/casa-frangipani-657c43.webp"
                alt="Discover Alibaug"
                class="w-full h-[420px] object-cover"
            />

            {{-- Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>

            {{-- Text --}}
            <div class="absolute inset-0 flex items-center">
                <div class="px-10 max-w-xl text-white">
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight">
                        Discover Alibaug,<br>
                        <span class="text-emerald-300">Beautifully</span>
                    </h1>

                    <p class="mt-4 text-gray-200 text-lg">
                        Handpicked villas, cafes, beaches & experiences.
                    </p>

                    <a
                        href="#"
                        class="inline-block mt-6 bg-white text-gray-900 px-6 py-3 rounded-xl
                               font-semibold hover:bg-gray-100 transition shadow">
                        Explore listings
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- CATEGORIES --}}
    <div class="max-w-7xl mx-auto px-4 mt-12">
        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-6">

            @foreach (['Villas','Cafes','Beaches','Hotels','Experiences','Services'] as $item)
                <div
                    class="bg-white rounded-2xl p-4 text-center cursor-pointer
                           transition-all duration-300
                           hover:-translate-y-1 hover:shadow-lg">
                    <div class="h-24 rounded-lg bg-gray-200 mb-3"></div>
                    <p class="text-sm font-medium">{{ $item }}</p>
                </div>
            @endforeach

        </div>
    </div>

</section>

{{-- FEATURED --}}
<section class="max-w-7xl mx-auto px-4 py-24">
    <div class="text-center mb-14">
        <h2 class="text-3xl font-semibold">Featured Stays</h2>
        <p class="text-gray-500 mt-2">Handpicked places travelers love</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach($featured as $listing)
            <x-listing-card :listing="$listing" />
        @endforeach
    </div>
</section>

{{-- LOCATIONS --}}
<section class="max-w-7xl mx-auto px-4 py-24">
    <h2 class="text-3xl font-semibold text-center mb-14">
        Explore Popular Locations
    </h2>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        @foreach (['Mandwa','Nagaon','Kashid','Revdanda'] as $place)
            <div
                class="relative h-48 rounded-2xl overflow-hidden bg-gray-300
                       cursor-pointer transition hover:shadow-lg">
                <div class="absolute inset-0 bg-black/40"></div>
                <p class="absolute bottom-4 left-4 text-white font-semibold text-lg">
                    {{ $place }}
                </p>
            </div>
        @endforeach
    </div>
</section>

{{-- CTA --}}
<section class="bg-emerald-700 py-24">
    <div class="max-w-5xl mx-auto px-4 text-center text-white">
        <h2 class="text-4xl font-bold mb-6">
            Own a Place in Alibaug?
        </h2>
        <p class="text-emerald-100 mb-10">
            Get discovered by travelers looking for premium stays and experiences.
        </p>
        <a
            href="#"
            class="inline-block bg-white text-emerald-700 px-10 py-4 rounded-xl
                   font-semibold hover:bg-emerald-50 transition shadow-lg">
            List Your Property
        </a>
    </div>
</section>

@endsection
