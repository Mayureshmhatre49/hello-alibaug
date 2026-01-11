@props([
    'listing'
])

<a href="{{ route('listings.show', $listing->slug) }}"
   class="group block rounded-[14px] bg-white shadow-sm hover:shadow-lg transition">

    {{-- Image --}}
    <div class="relative overflow-hidden rounded-t-[14px] aspect-[4/3]">
        <img
            src="{{ $listing->featured_image ?? 'https://via.placeholder.com/600x450?text=' . urlencode($listing->title) }}"
            alt="{{ $listing->title }}"
            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.03]"
        >
    </div>

    {{-- Content --}}
    <div class="p-4 space-y-2">

        {{-- Title --}}
        <h3 class="text-[17px] font-semibold text-slate-900 leading-snug">
            {{ $listing->title }}
        </h3>

        {{-- Location + Category --}}
        <p class="text-[13px] text-slate-500">
            {{ $listing->location }}
            @if($listing->category)
                · {{ $listing->category->name }}
            @endif
        </p>

        {{-- Meta (conditional safe) --}}
        @if(!empty($listing->card_meta))
            <p class="text-[13px] text-slate-600">
                {{ implode(' · ', array_slice($listing->card_meta, 0, 2)) }}
            </p>
        @endif

        {{-- Price / CTA --}}
        <div class="flex items-center justify-between pt-2">
            <span class="text-[16px] font-semibold text-slate-900">
                {{ $listing->price_label ?? 'View details' }}
            </span>

            <span class="text-slate-400 group-hover:text-[#C2A35D] transition">
                →
            </span>
        </div>

    </div>
</a>