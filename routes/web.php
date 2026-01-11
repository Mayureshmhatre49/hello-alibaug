<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Http\Controllers\ListingController;

// Home - featured listings
Route::get('/listings/{slug}', [ListingController::class, 'show'])
    ->name('listings.show');

Route::get('/', function () {
    $featured = Listing::where('status', 'approved')
        ->where('is_featured', true)
        ->orderBy('sort_order')
        ->latest()
        ->take(6)
        ->get();

    return view('home', compact('featured'));
});

Route::get('/alibaug/{type}/{listing:slug}', function ($type, Listing $listing) {
    abort_unless(
        $listing->status === 'approved' && $listing->type === $type,
        404
    );

    return view('listings.show', compact('listing'));
})->name('listing.show');

