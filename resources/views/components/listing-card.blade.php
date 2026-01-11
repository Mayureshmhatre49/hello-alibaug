@props([
    'listing'
])

<a href="{{ route('listings.show', $listing->slug) }}"
   class="group block rounded-2xl bg-white overflow-hidden border border-slate-100 hover:border-blue-300 shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

    {{-- Image Container --}}
    <div class="relative overflow-hidden rounded-t-2xl aspect-[4/3] bg-gradient-to-br from-slate-100 to-slate-50">
        <img
            src="{{ $listing->featured_image ?? 'https://via.placeholder.com/600x450?text=' . urlencode($listing->title) }}"
            alt="{{ $listing->title }}"
            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110"
            loading="lazy"
            decoding="async"
        >
        
        {{-- Badge --}}
        @if($listing->is_featured)
            <div class="absolute top-3 right-3 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                ⭐ Featured
            </div>
        @endif

        @if($listing->is_verified)
            <div class="absolute top-3 left-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg flex items-center gap-1">
                ✓ Verified
            </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="p-5 space-y-3">

        {{-- Title --}}
        <h3 class="text-lg font-bold text-slate-900 line-clamp-2 group-hover:text-blue-600 transition">
            {{ $listing->title }}
        </h3>

        {{-- Location + Category --}}
        <p class="text-sm text-slate-500 flex items-center gap-1">
            📍 {{ $listing->location }}
            @if($listing->category)
                <span class="text-slate-300">·</span>
                <span class="font-medium text-slate-700">{{ $listing->category->name }}</span>
            @endif
        </p>

        {{-- Meta (conditional safe) --}}
        @if(!empty($listing->card_meta))
            <p class="text-sm text-slate-600 line-clamp-1">
                {{ implode(' · ', array_slice($listing->card_meta, 0, 2)) }}
            </p>
        @endif

        {{-- Rating & Reviews --}}
        @if($listing->rating || $listing->reviews_count)
            <div class="flex items-center gap-2 text-sm">
                @if($listing->rating)
                    <span class="text-yellow-500">⭐ {{ number_format($listing->rating, 1) }}</span>
                @endif
                @if($listing->reviews_count)
                    <span class="text-slate-500">({{ $listing->reviews_count }} reviews)</span>
                @endif
            </div>
        @endif

        {{-- Price / CTA --}}
        <div class="flex items-center justify-between pt-3 border-t border-slate-100">
            <span class="text-lg font-bold text-slate-900">
                {{ $listing->price_label ?? 'View details' }}
            </span>

            <span class="text-slate-400 group-hover:text-blue-600 transition text-xl">
                →
            </span>
        </div>

    </div>
</a>