@props([
    'listing'
])

<a href="{{ route('listings.show', $listing->slug) }}"
   class="group block rounded-xl bg-white overflow-hidden border border-slate-100 shadow-sm hover:shadow-lg hover:border-slate-200 transition-all duration-300 hover:-translate-y-0.5">

    {{-- Image Container --}}
    <div class="relative overflow-hidden rounded-t-xl aspect-[4/3] bg-gradient-to-br from-slate-100 to-slate-50">
        <img
            src="{{ $listing->featured_image ?? 'https://via.placeholder.com/600x450?text=' . urlencode($listing->title) }}"
            alt="{{ $listing->title }}"
            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
            loading="lazy"
            decoding="async"
        >
        
        {{-- Badge --}}
        @if($listing->is_featured || $listing->is_verified)
            <div class="absolute top-3 right-3 flex gap-2">
                @if($listing->is_featured)
                    <span class="bg-yellow-400 text-white px-2 py-1 rounded-lg text-xs font-semibold shadow-md">
                        ⭐ Featured
                    </span>
                @endif

                @if($listing->is_verified)
                    <span class="bg-green-500 text-white px-2 py-1 rounded-lg text-xs font-semibold shadow-md">
                        ✓ Verified
                    </span>
                @endif
            </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="p-4 space-y-2.5">

        {{-- Title --}}
        <h3 class="text-base font-semibold text-slate-900 line-clamp-2 group-hover:text-blue-600 transition">
            {{ $listing->title }}
        </h3>

        {{-- Location + Category --}}
        <div class="flex items-start gap-2 text-xs text-slate-500">
            <span>📍</span>
            <div class="flex-1">
                <p class="font-medium text-slate-700">{{ $listing->location }}</p>
                @if($listing->category)
                    <p class="text-slate-500">{{ $listing->category->name }}</p>
                @endif
            </div>
        </div>

        {{-- Meta (conditional safe) --}}
        @if(!empty($listing->card_meta))
            <p class="text-xs text-slate-600 line-clamp-1">
                {{ implode(' · ', array_slice($listing->card_meta, 0, 2)) }}
            </p>
        @endif

        {{-- Rating & Reviews --}}
        @if($listing->rating || $listing->reviews_count)
            <div class="flex items-center gap-2 text-xs pt-1">
                @if($listing->rating)
                    <span class="text-yellow-500 font-semibold">⭐ {{ number_format($listing->rating, 1) }}</span>
                @endif
                @if($listing->reviews_count)
                    <span class="text-slate-500">({{ $listing->reviews_count }})</span>
                @endif
            </div>
        @endif

        {{-- Price / CTA --}}
        <div class="flex items-center justify-between pt-2 border-t border-slate-100 mt-3">
            <span class="text-sm font-bold text-slate-900">
                {{ $listing->price_label ?? 'View details' }}
            </span>

            <span class="text-slate-300 group-hover:text-blue-600 transition text-lg">
                →
            </span>
        </div>

    </div>
</a>