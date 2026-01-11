@extends('layouts.app')

@section('content')
<div class="bg-white">

    {{-- ================= HERO GALLERY ================= --}}
    <section class="bg-slate-50">
        <div class="max-w-7xl mx-auto">
            {{-- Main Image --}}
            <div class="relative aspect-video md:aspect-auto md:h-[500px] overflow-hidden bg-slate-200 group">
                <img
                    src="{{ 'storage/' . $listing->featured_image }}"
                    alt="{{ $listing->title }}"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                    loading="lazy"
                    decoding="async"
                >
            </div>

            {{-- Gallery Grid --}}
            @if(!empty($listing->gallery_images))
                <div class="grid grid-cols-4 gap-2 p-4 md:p-6">
                    @foreach(array_slice($listing->gallery_images, 0, 4) as $index => $img)
                        <button class="group relative aspect-square overflow-hidden rounded-lg bg-slate-200 hover:opacity-75 transition" data-modal-trigger="gallery-{{ $index }}">
                            <img
                                src="{{ $img }}"
                                alt="Gallery image {{ $index + 1 }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                                loading="lazy"
                                decoding="async"
                            >
                            @if($index === 3 && count($listing->gallery_images) > 4)
                                <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                    <span class="text-white font-bold text-xl">+{{ count($listing->gallery_images) - 4 }}</span>
                                </div>
                            @endif
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ================= MAIN CONTENT ================= --}}
    <section class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-10">

            {{-- ================= LEFT CONTENT (2/3) ================= --}}
            <div class="lg:col-span-2 space-y-10">

                {{-- HEADER --}}
                <div class="border-b border-slate-200 pb-6">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-4">
                        <div class="flex-1">
                            <h1 class="text-4xl md:text-5xl font-bold text-slate-900 leading-tight">
                                {{ $listing->title }}
                            </h1>

                            <p class="mt-4 flex flex-wrap gap-4 text-sm md:text-base">
                                <span class="flex items-center gap-2 text-slate-600">
                                    📍 {{ $listing->location }}
                                </span>
                                @if($listing->category)
                                    <span class="inline-block px-4 py-1 rounded-full bg-blue-100 text-blue-700 font-medium text-sm">
                                        {{ $listing->category->name }}
                                    </span>
                                @endif
                            </p>
                        </div>

                        {{-- Share & Save --}}
                        <div class="flex gap-2">
                            <button class="p-3 rounded-full border border-slate-200 hover:bg-slate-100 transition">
                                ♥️
                            </button>
                            <button class="p-3 rounded-full border border-slate-200 hover:bg-slate-100 transition">
                                📤
                            </button>
                        </div>
                    </div>

                    {{-- Rating & Reviews --}}
                    <div class="flex flex-wrap items-center gap-6">
                        @if($listing->rating)
                            <div class="flex items-center gap-2">
                                <div class="flex gap-0.5">
                                    @for($i = 0; $i < 5; $i++)
                                        <span class="text-lg">{{ $i < floor($listing->rating) ? '⭐' : '☆' }}</span>
                                    @endfor
                                </div>
                                <span class="font-bold text-slate-900">{{ number_format($listing->rating, 1) }}</span>
                                @if($listing->reviews_count)
                                    <span class="text-slate-500 text-sm">({{ $listing->reviews_count }} reviews)</span>
                                @endif
                            </div>
                        @endif

                        @if($listing->is_verified)
                            <div class="flex items-center gap-2 px-4 py-2 bg-green-50 rounded-full border border-green-200">
                                <span class="text-green-600 font-bold">✓</span>
                                <span class="text-sm font-medium text-green-700">Verified Property</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- HIGHLIGHTS --}}
                @if(!empty($listing->highlights))
                    <section>
                        <h2 class="text-2xl font-bold text-slate-900 mb-6">What This Place Offers</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($listing->highlights as $item)
                                <div class="flex items-start gap-3 p-4 rounded-lg bg-slate-50 hover:bg-blue-50 transition">
                                    <span class="text-2xl flex-shrink-0">✓</span>
                                    <span class="text-slate-700 font-medium">{{ $item }}</span>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- ABOUT --}}
                @if($listing->description)
                    <section>
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">About This Listing</h2>
                        <div class="prose prose-sm max-w-none text-slate-600 leading-relaxed text-lg">
                            {!! $listing->description !!}
                        </div>
                    </section>
                @endif

                {{-- AMENITIES --}}
                @if(!empty($listing->amenities))
                    <section>
                        <h2 class="text-2xl font-bold text-slate-900 mb-6">Amenities & Facilities</h2>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($listing->amenities as $amenity)
                                <div class="flex items-center gap-3 p-4 rounded-lg bg-slate-50">
                                    <span class="text-2xl">🎯</span>
                                    <span class="text-slate-700 font-medium">{{ $amenity }}</span>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- LOCATION MAP --}}
                @if($listing->latitude && $listing->longitude)
                    <section>
                        <h2 class="text-2xl font-bold text-slate-900 mb-4">Location</h2>
                        <div class="rounded-2xl overflow-hidden shadow-lg">
                            <iframe
                                class="w-full h-96"
                                src="https://maps.google.com/maps?q={{ $listing->latitude }},{{ $listing->longitude }}&z=15&output=embed"
                                loading="lazy"
                                style="border:0"
                                allowfullscreen=""
                                aria-hidden="false"
                                tabindex="0">
                            </iframe>
                        </div>
                        @if($listing->address)
                            <p class="mt-4 text-slate-600">
                                <strong>Address:</strong><br>
                                {{ $listing->address }}
                            </p>
                        @endif
                    </section>
                @endif

            </div>

            {{-- ================= RIGHT SIDEBAR (1/3) ================= --}}
            <aside class="lg:col-span-1">
                {{-- STICKY BOOKING CARD --}}
                <div class="sticky top-24 rounded-2xl border border-slate-200 p-8 shadow-lg bg-white space-y-6">

                    {{-- PRICE SECTION --}}
                    <div class="border-b border-slate-200 pb-6">
                        <p class="text-slate-500 text-sm font-medium mb-2">Price Starting From</p>
                        <div class="flex items-baseline gap-2">
                            <span class="text-4xl font-bold text-slate-900">
                                {{ $listing->price_label ?? 'Contact for price' }}
                            </span>
                        </div>
                        @if($listing->starting_price)
                            <p class="text-slate-500 text-sm mt-2">
                                From ₹{{ number_format($listing->starting_price) }} onwards
                            </p>
                        @endif
                    </div>

                    {{-- TRUST INDICATORS --}}
                    <div class="space-y-3">
                        @if($listing->is_verified)
                            <div class="flex items-center gap-2 text-green-700 text-sm">
                                <span class="text-lg">✓</span>
                                <span>Verified & Trusted</span>
                            </div>
                        @endif
                        <div class="flex items-center gap-2 text-slate-600 text-sm">
                            <span class="text-lg">🔒</span>
                            <span>Secure Booking</span>
                        </div>
                        <div class="flex items-center gap-2 text-slate-600 text-sm">
                            <span class="text-lg">📞</span>
                            <span>24/7 Support</span>
                        </div>
                    </div>

                    {{-- CTA BUTTONS --}}
                    <div class="space-y-3 pt-4">
                        <button class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-4 rounded-xl font-semibold hover:shadow-lg transition transform hover:scale-105">
                            Check Availability
                        </button>

                        <button class="w-full border-2 border-blue-600 text-blue-600 py-3.5 rounded-xl font-semibold hover:bg-blue-50 transition">
                            Contact Host
                        </button>
                    </div>

                    {{-- CONTACT INFO --}}
                    <div class="border-t border-slate-200 pt-4 space-y-3">
                        @if($listing->phone)
                            <a href="tel:{{ $listing->phone }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-100 transition">
                                <span class="text-lg">📱</span>
                                <span class="text-sm text-slate-700">{{ $listing->phone }}</span>
                            </a>
                        @endif

                        @if($listing->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $listing->whatsapp) }}" target="_blank" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-100 transition">
                                <span class="text-lg">💬</span>
                                <span class="text-sm text-slate-700">WhatsApp</span>
                            </a>
                        @endif

                        @if($listing->email)
                            <a href="mailto:{{ $listing->email }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-100 transition">
                                <span class="text-lg">✉️</span>
                                <span class="text-sm text-slate-700">{{ $listing->email }}</span>
                            </a>
                        @endif

                        @if($listing->website)
                            <a href="{{ $listing->website }}" target="_blank" class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-100 transition">
                                <span class="text-lg">🌐</span>
                                <span class="text-sm text-slate-700">Visit Website</span>
                            </a>
                        @endif
                    </div>

                    <p class="text-xs text-slate-500 text-center">
                        No payment required to inquire
                    </p>
                </div>

                {{-- SHARE CARD --}}
                <div class="mt-6 rounded-2xl border border-slate-200 p-6 bg-white">
                    <h3 class="font-bold text-slate-900 mb-4">Share This Listing</h3>
                    <div class="flex gap-3">
                        <button class="flex-1 p-3 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition font-medium text-sm">
                            Facebook
                        </button>
                        <button class="flex-1 p-3 bg-cyan-100 text-cyan-600 rounded-lg hover:bg-cyan-200 transition font-medium text-sm">
                            Twitter
                        </button>
                        <button class="flex-1 p-3 bg-green-100 text-green-600 rounded-lg hover:bg-green-200 transition font-medium text-sm">
                            WhatsApp
                        </button>
                    </div>
                </div>
            </aside>

        </div>
    </section>

    {{-- ================= SIMILAR LISTINGS ================= --}}
    <section class="bg-gradient-to-b from-white to-slate-50 py-24">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-slate-900 mb-10">
                Similar Listings You Might Like
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Add similar listings component here --}}
            </div>
        </div>
    </section>

    {{-- ================= MOBILE STICKY CTA ================= --}}
    <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 p-4 md:hidden shadow-2xl z-50">
        <div class="flex gap-3">
            <button class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-xl font-semibold">
                Check Availability
            </button>
            <button class="flex-1 border-2 border-blue-600 text-blue-600 py-2.5 rounded-xl font-semibold">
                Contact
            </button>
        </div>
    </div>

</div>

@endsection
