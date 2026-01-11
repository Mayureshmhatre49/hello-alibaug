@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 pb-24">

    {{-- ================= HERO GALLERY ================= --}}
    <section class="mt-6">
        <div class="grid grid-cols-4 gap-2 rounded-xl overflow-hidden">
            <img
                src="{{ $listing->featured_image ?? 'https://via.placeholder.com/1200x675?text=' . urlencode($listing->title) }}"
                alt="{{ $listing->title }}"
                class="col-span-4 md:col-span-3 aspect-video object-cover"
            >

            @if(!empty($listing->gallery_images))
                @foreach(array_slice($listing->gallery_images, 0, 2) as $img)
                    <img
                        src="{{ $img }}"
                        class="hidden md:block aspect-square object-cover"
                    >
                @endforeach
            @endif
        </div>
    </section>

    {{-- ================= TITLE BLOCK ================= --}}
    <section class="mt-6">
        <h1 class="text-2xl md:text-3xl font-semibold text-slate-900">
            {{ $listing->title }}
        </h1>

        <p class="mt-2 text-slate-600 text-sm">
            📍 {{ $listing->location }}
            @if($listing->category)
                · {{ $listing->category->name }}
            @endif
        </p>

        @if($listing->rating || $listing->reviews_count)
            <p class="text-sm text-slate-500 mt-1">
                @if($listing->rating)
                    ⭐ {{ number_format($listing->rating, 1) }}
                @endif
                @if($listing->reviews_count)
                    ({{ $listing->reviews_count }} reviews)
                @endif
            </p>
        @endif
    </section>

    {{-- ================= MAIN GRID ================= --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 mt-10">

        {{-- ================= LEFT CONTENT ================= --}}
        <div class="lg:col-span-2 space-y-10">

            {{-- ABOUT --}}
            @if($listing->description)
                <section>
                    <h2 class="text-xl font-semibold mb-3">About</h2>
                    <p class="text-slate-600 leading-relaxed">
                        {{ $listing->description }}
                    </p>
                </section>
            @endif

            {{-- HIGHLIGHTS --}}
            @if(!empty($listing->highlights))
                <section>
                    <h2 class="text-xl font-semibold mb-4">Highlights</h2>
                    <div class="grid grid-cols-2 gap-3 text-slate-600 text-sm">
                        @foreach($listing->highlights as $item)
                            <div>✔ {{ $item }}</div>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- AMENITIES --}}
            @if(!empty($listing->amenities))
                <section>
                    <h2 class="text-xl font-semibold mb-4">Amenities</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 text-slate-600 text-sm">
                        @foreach($listing->amenities as $amenity)
                            <span>✓ {{ $amenity }}</span>
                        @endforeach
                    </div>
                </section>
            @endif

            {{-- LOCATION MAP --}}
            @if($listing->latitude && $listing->longitude)
                <section>
                    <h2 class="text-xl font-semibold mb-4">Location</h2>
                    <iframe
                        class="w-full h-64 rounded-xl"
                        src="https://maps.google.com/maps?q={{ $listing->latitude }},{{ $listing->longitude }}&z=15&output=embed"
                        loading="lazy">
                    </iframe>
                </section>
            @endif

        </div>

        {{-- ================= RIGHT STICKY CARD ================= --}}
        <aside class="hidden lg:block">
            <div class="sticky top-24 border rounded-xl p-6 shadow-sm bg-white">

                <div class="mb-4">
                    <span class="text-2xl font-semibold text-slate-900">
                        {{ $listing->price_label ?? 'Contact for price' }}
                    </span>

                    @if($listing->rating)
                        <p class="text-sm text-slate-500 mt-1">
                            ⭐ {{ number_format($listing->rating, 1) }} rating
                            @if($listing->reviews_count)
                                · {{ $listing->reviews_count }} reviews
                            @endif
                        </p>
                    @endif
                </div>

                <div class="space-y-3">
                    <button
                        class="w-full bg-slate-900 text-white py-3 rounded-lg hover:bg-black transition">
                        Check Availability
                    </button>

                    <button
                        class="w-full border py-3 rounded-lg hover:bg-slate-50 transition">
                        Contact
                    </button>
                </div>

                <p class="text-xs text-slate-500 mt-4 text-center">
                    No payment required now
                </p>
            </div>
        </aside>
    </div>
</div>

{{-- ================= MOBILE STICKY CTA ================= --}}
<div class="fixed bottom-0 left-0 right-0 bg-white border-t p-4 lg:hidden z-50">
    <button class="w-full bg-slate-900 text-white py-3 rounded-lg text-sm">
        Check Availability
    </button>
</div>
@endsection
