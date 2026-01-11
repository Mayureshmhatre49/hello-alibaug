<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();

            // Category relation
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete()->index();

            /* -------------------------------------------------
             | CORE IDENTITY
             ------------------------------------------------- */
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            /* -------------------------------------------------
             | LISTING TYPE
             ------------------------------------------------- */
            $table->enum('type', [
                'stay',
                'eat',
                'events',
                'explore',
                'services',
                'real_estate'
            ])->index();

            /* -------------------------------------------------
             | LOCATION
             ------------------------------------------------- */
            $table->string('location')->index();       // Mandwa, Nagaon
            $table->string('address')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            /* -------------------------------------------------
             | MEDIA
             ------------------------------------------------- */
            $table->string('cover_image')->nullable();
            $table->json('gallery')->nullable();

            /* -------------------------------------------------
             | CONTACT & BUSINESS
             ------------------------------------------------- */
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();

            /* -------------------------------------------------
             | DISPLAY & PRICING
             ------------------------------------------------- */
            $table->string('price_label')->nullable();
            $table->integer('starting_price')->nullable(); // for sorting/filtering

            /* -------------------------------------------------
             | CATEGORY-SPECIFIC ATTRIBUTES (JSON)
             ------------------------------------------------- */
            $table->json('attributes')->nullable();

            /* -------------------------------------------------
             | FLAGS & VISIBILITY
             ------------------------------------------------- */
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_verified')->default(false); // TRUST BADGE
            $table->integer('sort_order')->default(0);      // manual ranking

            $table->enum('status', [
                'draft',
                'pending',
                'approved',
                'rejected'
            ])->default('pending')->index();

            /* -------------------------------------------------
             | SEO (VERY IMPORTANT)
             ------------------------------------------------- */
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable(); // SEO keywords
            $table->json('schema_overrides')->nullable(); // future schema control

            // Ratings & reviews (optional)
            $table->float('rating')->nullable();
            $table->integer('reviews_count')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
