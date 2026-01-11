<?php

namespace App\Models;
use App\Models\Category;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Listing extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'type',
        'location',
        'address',
        'latitude',
        'longitude',
        'cover_image',
        'gallery',
        'phone',
        'whatsapp',
        'email',
        'website',
        'price_label',
        'starting_price',
        'attributes',
        'is_featured',
        'is_verified',
        'sort_order',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'schema_overrides',
        'category_id',
        'rating',
        'reviews_count',
    ];

    protected $casts = [
        'gallery' => 'array',
        'attributes' => 'array',
        'schema_overrides' => 'array',
        'is_featured' => 'boolean',
        'is_verified' => 'boolean',
        'rating' => 'float',
        'reviews_count' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($listing) {
            if (empty($listing->slug)) {
                $listing->slug = Str::slug($listing->title);
            }
        });
    }

    public function category()
{
    return $this->belongsTo(Category::class);
}

    // Provide a friendly `featured_image` accessor that maps to `cover_image`
    public function getFeaturedImageAttribute()
    {
        return $this->cover_image;
    }

    // Provide `gallery_images` which returns the decoded gallery JSON array
    public function getGalleryImagesAttribute(): array
    {
        return $this->gallery ?? [];
    }

    /**
     * Fallback magic getter: if an attribute isn't a real column or relation,
     * attempt to return it from the `attributes` JSON column.
     */
    public function __get($key)
    {
        $parent = null;

        try {
            $parent = parent::__get($key);
        } catch (\Exception $e) {
            $parent = null;
        }

        if (!is_null($parent)) {
            return $parent;
        }

        $json = $this->attributes['attributes'] ?? null;
        if ($json) {
            $arr = is_array($json) ? $json : json_decode($json, true);
            if (is_array($arr) && array_key_exists($key, $arr)) {
                return $arr[$key];
            }
        }

        return $parent;
    }

public function getHighlightsAttribute(): array
{
    return match ($this->category_type) {

        'villa' => array_filter([
            $this->guests ? "👥 {$this->guests} Guests" : null,
            $this->bedrooms ? "🛏 {$this->bedrooms} Bedrooms" : null,
            $this->bathrooms ? "🚿 {$this->bathrooms} Baths" : null,
            $this->pool ? "🏊 Private Pool" : null,
        ]),

        'restaurant' => array_filter([
            $this->cuisine ? "🍽 {$this->cuisine}" : null,
            $this->food_type ? "🥗 {$this->food_type}" : null,
            $this->timing ? "⏰ {$this->timing}" : null,
        ]),

        'activity' => array_filter([
            $this->duration ? "⏱ {$this->duration}" : null,
            $this->age_group ? "👨‍👩‍👧 {$this->age_group}" : null,
            $this->difficulty ? "⚡ {$this->difficulty}" : null,
        ]),

        'event' => array_filter([
            $this->event_date ? "📅 {$this->event_date}" : null,
            $this->entry_type ? "🎟 {$this->entry_type}" : null,
            $this->timing ? "⏰ {$this->timing}" : null,
        ]),

        default => [],
    };
}

public function getAmenitiesAttribute(): array
{
    return match ($this->category_type) {

        'villa' => array_filter([
            'WiFi',
            'Parking',
            $this->ac ? 'Air Conditioning' : null,
            $this->power_backup ? 'Power Backup' : null,
        ]),

        'restaurant' => array_filter([
            'Dine-in',
            'Takeaway',
            $this->parking ? 'Parking Available' : null,
        ]),

        'activity' => array_filter([
            'Instructor Included',
            'Safety Gear',
        ]),

        default => [],
    };
}

public function getInfoSectionsAttribute(): array
{
    return match ($this->category_type) {

        'villa' => [
            'Check-in' => $this->check_in_time,
            'Check-out' => $this->check_out_time,
            'House Rules' => $this->house_rules,
        ],

        'restaurant' => [
            'Opening Hours' => $this->timing,
            'Cuisine' => $this->cuisine,
        ],

        'activity' => [
            'Duration' => $this->duration,
            'Best Time' => $this->best_time,
        ],

        default => [],
    };
}

public function getCategoryTypeAttribute(): ?string
{
    return $this->category?->slug; 
}


    public function getCardMetaAttribute(): array
{
    return array_filter([
        $this->guests ? "👥 {$this->guests} Guests" : null,
        $this->bedrooms ? "🛏 {$this->bedrooms} Beds" : null,
        $this->duration ? "⏱ {$this->duration}" : null,
        $this->timing ? "⏰ {$this->timing}" : null,
        $this->food_type ? "🍽 {$this->food_type}" : null,
    ]);
}

}
