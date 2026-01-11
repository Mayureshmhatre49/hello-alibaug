<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingController extends Controller
{
    public function show(string $slug)
{
    $listing = Listing::where('slug', $slug)->firstOrFail();

    return view('listings.show', compact('listing'));
}
}
