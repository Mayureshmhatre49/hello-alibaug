<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Listing;
use Illuminate\Support\Str;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        $listings = [

            /* ================= STAY ================= */
            [
                'title' => 'Luxury Beachside Villa',
                'type' => 'stay',
                'location' => 'Mandwa',
                'price_label' => 'From ₹9,000 / night',
                'starting_price' => 9000,
                'attributes' => [
                    'bedrooms' => 3,
                    'bathrooms' => 3,
                    'max_guests' => 6,
                    'amenities' => ['Pool', 'WiFi', 'Parking'],
                ],
                'cover_image' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6',
            ],
            [
                'title' => 'Private Garden Villa',
                'type' => 'stay',
                'location' => 'Nagaon',
                'price_label' => 'From ₹7,500 / night',
                'starting_price' => 7500,
                'attributes' => [
                    'bedrooms' => 2,
                    'bathrooms' => 2,
                    'max_guests' => 4,
                    'amenities' => ['Garden', 'WiFi'],
                ],
                'cover_image' => 'https://images.unsplash.com/photo-1570129477492-45c003edd2be',
            ],

            /* ================= EAT ================= */
            [
                'title' => 'Sunset Beach Cafe',
                'type' => 'eat',
                'location' => 'Alibaug',
                'price_label' => '₹500 for two',
                'starting_price' => 500,
                'attributes' => [
                    'cuisine' => 'Continental, Italian',
                    'food_type' => 'both',
                    'opening_hours' => '10 AM – 11 PM',
                ],
                'cover_image' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de',
            ],
            [
                'title' => 'Local Konkan Kitchen',
                'type' => 'eat',
                'location' => 'Revdanda',
                'price_label' => '₹300 for two',
                'starting_price' => 300,
                'attributes' => [
                    'cuisine' => 'Malvani',
                    'food_type' => 'non_veg',
                    'opening_hours' => '9 AM – 10 PM',
                ],
                'cover_image' => 'https://images.unsplash.com/photo-1528605248644-14dd04022da1',
            ],

            /* ================= EVENTS ================= */
            [
                'title' => 'Beachside Music Night',
                'type' => 'events',
                'location' => 'Mandwa',
                'price_label' => 'Tickets from ₹999',
                'starting_price' => 999,
                'attributes' => [
                    'event_date' => '2026-03-25',
                    'event_time' => '7:00 PM',
                    'ticket_price' => '₹999',
                ],
                'cover_image' => 'https://images.unsplash.com/photo-1506157786151-b8491531f063',
            ],
            [
                'title' => 'Full Moon Party',
                'type' => 'events',
                'location' => 'Nagaon',
                'price_label' => 'Entry ₹799',
                'starting_price' => 799,
                'attributes' => [
                    'event_date' => '2026-04-10',
                    'event_time' => '8:00 PM',
                    'ticket_price' => '₹799',
                ],
                'cover_image' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30',
            ],

            /* ================= EXPLORE ================= */
            [
                'title' => 'Kashid Beach',
                'type' => 'explore',
                'location' => 'Kashid',
                'price_label' => 'Free Entry',
                'attributes' => [
                    'best_time' => 'October – March',
                    'duration' => '2–3 hours',
                    'entry_fee' => 'Free',
                ],
                'cover_image' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e',
            ],
            [
                'title' => 'Revdanda Fort',
                'type' => 'explore',
                'location' => 'Revdanda',
                'price_label' => '₹25 Entry',
                'starting_price' => 25,
                'attributes' => [
                    'best_time' => 'Morning',
                    'duration' => '1–2 hours',
                    'entry_fee' => '₹25',
                ],
                'cover_image' => 'https://images.unsplash.com/photo-1590487988174-62d9d9c25b0f',
            ],

            /* ================= SERVICES ================= */
            [
                'title' => 'Alibaug Taxi Service',
                'type' => 'services',
                'location' => 'Alibaug',
                'price_label' => 'On Call',
                'attributes' => [
                    'service_type' => 'Taxi',
                    'availability' => '24x7',
                ],
                'cover_image' => 'https://images.unsplash.com/photo-1502877338535-766e1452684a',
            ],
            [
                'title' => 'Beach Yoga Sessions',
                'type' => 'services',
                'location' => 'Nagaon',
                'price_label' => '₹500 / session',
                'starting_price' => 500,
                'attributes' => [
                    'service_type' => 'Yoga',
                    'availability' => 'Morning',
                ],
                'cover_image' => 'https://images.unsplash.com/photo-1554344058-5f07b9e6d0c0',
            ],

            /* ================= REAL ESTATE ================= */
            [
                'title' => 'Sea View Luxury Villa',
                'type' => 'real_estate',
                'location' => 'Mandwa',
                'price_label' => '₹2.5 Cr',
                'starting_price' => 25000000,
                'attributes' => [
                    'property_type' => 'Villa',
                    'area_sqft' => 3500,
                    'price' => '₹2.5 Cr',
                    'furnishing' => 'furnished',
                ],
                'cover_image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c',
            ],
            [
                'title' => 'Residential Plot Near Beach',
                'type' => 'real_estate',
                'location' => 'Kihim',
                'price_label' => '₹75 Lakh',
                'starting_price' => 7500000,
                'attributes' => [
                    'property_type' => 'Plot',
                    'area_sqft' => 2500,
                    'price' => '₹75 Lakh',
                    'furnishing' => 'unfurnished',
                ],
                'cover_image' => 'https://images.unsplash.com/photo-1598928506311-c55ded91a20c',
            ],
        ];

        foreach ($listings as $data) {
            Listing::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'description' => 'This is a premium listing curated for Hello Alibaug.',
                'type' => $data['type'],
                'location' => $data['location'],
                'cover_image' => $data['cover_image'],
                'price_label' => $data['price_label'] ?? null,
                'starting_price' => $data['starting_price'] ?? null,
                'attributes' => $data['attributes'] ?? [],
                'is_featured' => true,
                'is_verified' => true,
                'status' => 'approved',
                'meta_title' => $data['title'] . ' in Alibaug',
                'meta_description' => 'Discover ' . $data['title'] . ' in Alibaug. Verified and curated listing.',
                'meta_keywords' => 'Alibaug, ' . $data['type'] . ', ' . $data['location'],
            ]);
        }
    }
}
