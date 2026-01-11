@props(['listing'])

<a href="{{ route('listings.show', $listing->slug) }}"
   class="group block rounded-xl bg-white overflow-hidden
          border border-slate-200
          transition hover:shadow-md hover:border-slate-300">

    {{-- IMAGE --}}
    <div class="relative aspect-[4/3] overflow-hidden bg-slate-100">
        <img
            src="{{ $listing->featured_image_url }}"
            alt="{{ $listing->title }}"
            class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
            loading="lazy"
        />

        {{-- TYPE --}}
        <span class="absolute top-3 left-3
                     bg-white/90 text-slate-900
                     text-xs font-semibold px-3 py-1
                     rounded-full backdrop-blur">
            {{ ucfirst($listing->type) }}
        </span>

        {{-- BADGES --}}
        @if($listing->is_featured || $listing->is_verified)
            <div class="absolute top-3 right-3 flex gap-2">
                @if($listing->is_featured)
                    <span class="bg-yellow-400 text-white text-xs px-2 py-1 rounded-full">
                        Featured
                    </span>
                @endif
                @if($listing->is_verified)
                    <span class="bg-emerald-600 text-white text-xs px-2 py-1 rounded-full">
                        Verified
                    </span>
                @endif
            </div>
        @endif
    </div>

    {{-- CONTENT --}}
    <div class="p-4 space-y-2.5">

        {{-- LOCATION --}}
        <p class="text-xs uppercase tracking-wide text-slate-500">
            {{ $listing->location }}
            @if($listing->category)
                · {{ $listing->category->name }}
            @endif
        </p>

        {{-- TITLE --}}
        <h3 class="text-base font-semibold text-slate-900 leading-snug line-clamp-2">
            {{ $listing->title }}
        </h3>

        {{-- META --}}
        @if(!empty($listing->card_meta))
            <p class="text-xs text-slate-600 line-clamp-1">
                {{ implode(' · ', array_slice($listing->card_meta, 0, 3)) }}
            </p>
        @endif

        {{-- DIVIDER --}}
        <div class="h-px bg-slate-100"></div>

        {{-- ACTION ROW --}}
        <div class="flex items-center justify-between">

            {{-- CTA --}}
            <span class="text-sm font-semibold text-blue-600 group-hover:text-blue-700 transition">
                {{ $listing->price_label ?? 'View details' }}
            </span>

            {{-- ACTION ICONS --}}
            <div class="flex items-center gap-2">

                {{-- WhatsApp --}}
                @if($listing->whatsapp)
                    <a href="https://wa.me/{{ $listing->whatsapp }}"
                       target="_blank"
                       class="flex h-9 w-9 items-center justify-center
                              rounded-full border border-slate-200
                              text-green-600
                              hover:bg-green-50 transition"
                       title="Chat on WhatsApp">
                        🟢
                    </a>
                @endif

                {{-- Open --}}
                <span class="flex h-9 w-9 items-center justify-center
                             rounded-full border border-slate-200
                             text-slate-400
                             group-hover:bg-slate-100 group-hover:text-slate-700 transition">
                    →
                </span>
            </div>
        </div>
    </div>
</a>