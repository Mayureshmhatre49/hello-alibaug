@extends('layouts.app')

@section('title', 'Hello Alibaug – Premium Villas, Cafes & Experiences')

@section('content')

{{-- HERO : MODERN STYLE --}}
<section class="bg-gradient-to-b from-slate-50 via-blue-50 to-white pb-32 pt-6">

    {{-- SEARCH BAR --}}
    <div class="max-w-6xl mx-auto px-4 relative z-20">
        <div class="bg-white rounded-3xl shadow-xl p-6 flex flex-col md:flex-row gap-4 border border-slate-100">

            {{-- Where --}}
            <div class="flex-1 flex items-center gap-3 border border-slate-200 rounded-2xl px-5 py-3.5 hover:border-blue-300 transition">
                <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M12 21s-6-5.686-6-10a6 6 0 1112 0c0 4.314-6 10-6 10z"/>
                </svg>
                <input type="text"
                       placeholder="Where to? (Villa, Cafe, Beach...)"
                       class="w-full focus:outline-none text-sm text-slate-700 placeholder-slate-400">
            </div>

            {{-- When --}}
            <div class="flex items-center gap-3 border border-slate-200 rounded-2xl px-5 py-3.5 hover:border-blue-300 transition">
                <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-sm text-slate-500">Any date</span>
            </div>

            {{-- Category --}}
            <div class="flex items-center gap-3 border border-slate-200 rounded-2xl px-5 py-3.5 hover:border-blue-300 transition">
                <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <span class="text-sm text-slate-500">All listings</span>
            </div>

            {{-- Search Button --}}
            <button class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-10 py-3.5 rounded-2xl text-sm font-semibold hover:shadow-lg hover:from-blue-700 hover:to-blue-800 transition transform hover:scale-105">
                Search
            </button>

        </div>
    </div>

    {{-- HERO IMAGE --}}
    <div class="max-w-7xl mx-auto px-4 mt-16">
        <div class="relative rounded-3xl overflow-hidden shadow-2xl group">

            <img src="https://helloalibaug.com/wp-content/uploads/2025/06/casa-frangipani-657c43.webp"
                 alt="Discover Alibaug"
                 class="w-full h-[450px] object-cover transition-transform duration-500 group-hover:scale-105"
                 loading="lazy">

            <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-black/20"></div>

            {{-- Text Overlay --}}
            <div class="absolute inset-0 flex items-center">
                <div class="px-10 max-w-2xl text-white">
                    <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                        Discover Alibaug,
                        <br>
                        <span class="bg-gradient-to-r from-yellow-300 to-yellow-200 bg-clip-text text-transparent">Beautifully</span>
                    </h1>

                    <p class="mt-6 text-gray-100 text-lg md:text-xl max-w-2xl">
                        Handpicked villas, cafes, beaches & experiences curated just for you.
                    </p>

                    <a href="#featured"
                       class="inline-block mt-8 bg-white text-slate-900 px-8 py-4 rounded-2xl font-semibold hover:bg-blue-50 transition shadow-lg hover:shadow-xl">
                        Explore listings →
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- CATEGORY CARDS --}}
    <div class="max-w-7xl mx-auto px-4 mt-16">
        <h2 class="text-2xl md:text-3xl font-bold mb-8 text-slate-900">Explore by Category</h2>
        
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
            @foreach (['Villas' => '🏠', 'Cafes' => '☕', 'Beaches' => '🏖️', 'Hotels' => '🏨', 'Experiences' => '🎯', 'Services' => '✨'] as $item => $emoji)
                <a href="#" class="group bg-white rounded-2xl shadow-sm hover:shadow-lg transition p-4 text-center border border-slate-100 hover:border-blue-300">
                    <div class="text-3xl mb-2">{{ $emoji }}</div>
                    <p class="text-sm font-semibold text-slate-900 group-hover:text-blue-600">{{ $item }}</p>
                </a>
            @endforeach
        </div>
    </div>

</section>


{{-- FEATURED LISTINGS --}}
<section id="featured" class="max-w-7xl mx-auto px-4 py-24">
    <div class="mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-2">
            Featured Experiences
        </h2>
        <p class="text-slate-600 text-lg">
            Handpicked selections from our premium collection
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
        @forelse($featured as $listing)
            <x-listing-card :listing="$listing" />
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-slate-500 text-lg">Featured listings coming soon...</p>
            </div>
        @endforelse
    </div>
</section>

{{-- LOCATIONS --}}
<section class="bg-gradient-to-b from-white to-slate-50 py-24">
    <div class="max-w-7xl mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-slate-900 mb-2">
                Explore Popular Locations
            </h2>
            <p class="text-center text-slate-600 text-lg">
                Discover the charm of Alibaug's best destinations
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach (['Mandwa' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=400&h=300&fit=crop', 'Nagaon' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&h=300&fit=crop', 'Kashid' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400&h=300&fit=crop', 'Revdanda' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop'] as $place => $img)
                <a href="#" class="group relative h-48 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition">
                    <img src="{{ $img }}" 
                         alt="{{ $place }}"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                         loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <p class="absolute bottom-4 left-4 text-white font-bold text-xl">
                        {{ $place }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA SECTION --}}
<section class="bg-gradient-to-r from-blue-600 to-blue-800 py-24">
    <div class="max-w-5xl mx-auto px-4 text-center text-white">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">
            Own a Place in Alibaug?
        </h2>
        <p class="text-blue-100 mb-10 text-lg max-w-2xl mx-auto">
            Get discovered by travelers looking for premium stays, dining, and unforgettable experiences.
        </p>
        <a href="#"
           class="inline-block bg-white text-blue-700 px-12 py-4 rounded-2xl font-semibold hover:bg-blue-50 transition shadow-lg hover:shadow-xl transform hover:scale-105">
            List Your Property
        </a>
    </div>
</section>

@endsection
