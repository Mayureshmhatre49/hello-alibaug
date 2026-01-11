<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListingResource\Pages;
use App\Models\Listing;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Illuminate\Support\Str;

/* ---------- FORMS ---------- */
use Filament\Forms\Components\{
    TextInput,
    Textarea,
    RichEditor,
    Select,
    Toggle,
    Section,
    FileUpload,
    Repeater
};

/* ---------- TABLE ---------- */
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    /* =====================================================
     | FORM
     ===================================================== */
    public static function form(Form $form): Form
    {
        return $form->schema([

            /* ================= BASIC DETAILS ================= */
            Section::make('Basic Details')
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) =>
                            $set('slug', Str::slug($state))
                        ),

                    TextInput::make('slug')
                        ->disabled()
                        ->dehydrated()
                        ->required(),

                    RichEditor::make('description')
                        ->columnSpanFull()
                        ->toolbarButtons([
                            'attachFiles',
                            'blockquote',
                            'bold',
                            'bulletList',
                            'codeBlock',
                            'heading',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ]),

                    Select::make('type')
                        ->label('Listing Type')
                        ->required()
                        ->options([
                            'stay' => 'Stay',
                            'eat' => 'Eat',
                            'events' => 'Events',
                            'explore' => 'Explore',
                            'services' => 'Services',
                            'real_estate' => 'Real Estate',
                        ])
                        ->live(),

                    TextInput::make('location')->required(),
                    TextInput::make('address'),
                ])
                ->columns(2),

            /* ================= MEDIA ================= */
            Section::make('Media')
                ->schema([
                    FileUpload::make('cover_image')
                        ->image()
                        ->directory('listings/cover')
                        ->imagePreviewHeight('200'),

                    FileUpload::make('gallery')
                        ->image()
                        ->multiple()
                        ->directory('listings/gallery'),
                ]),

            /* ================= CONTACT ================= */
            Section::make('Contact Information')
                ->schema([
                    TextInput::make('phone'),
                    TextInput::make('whatsapp'),
                    TextInput::make('email')->email(),
                    TextInput::make('website')->url(),
                ])
                ->columns(2),

            /* ================= PRICING & DISPLAY ================= */
            Section::make('Pricing & Display')
                ->schema([
                    TextInput::make('price_label')
                        ->placeholder('From ₹8,000 / night'),

                    TextInput::make('starting_price')
                        ->numeric()
                        ->label('Starting Price'),

                    Toggle::make('is_featured'),
                    Toggle::make('is_verified')->label('Verified Listing'),

                    TextInput::make('sort_order')
                        ->numeric()
                        ->default(0),
                ])
                ->columns(3),

            /* =====================================================
             | CONDITIONAL CATEGORY FORMS
             ===================================================== */

            /* ---------- STAY ---------- */
            Section::make('Stay Details')
                ->schema([
                    TextInput::make('attributes.bedrooms')
                        ->numeric()
                        ->label('Bedrooms'),

                    TextInput::make('attributes.bathrooms')
                        ->numeric()
                        ->label('Bathrooms'),

                    TextInput::make('attributes.max_guests')
                        ->numeric()
                        ->label('Max Guests'),

                    Repeater::make('attributes.amenities')
                        ->label('Amenities')
                        ->simple(
                            TextInput::make('name')
                                ->placeholder('WiFi, Pool, Parking')
                        ),
                ])
                ->visible(fn ($get) => $get('type') === 'stay'),

            /* ---------- EAT ---------- */
            Section::make('Restaurant Details')
                ->schema([
                    TextInput::make('attributes.cuisine')
                        ->label('Cuisine'),

                    Select::make('attributes.food_type')
                        ->options([
                            'veg' => 'Veg',
                            'non_veg' => 'Non-Veg',
                            'both' => 'Both',
                        ])
                        ->label('Food Type'),

                    TextInput::make('attributes.opening_hours')
                        ->placeholder('10 AM – 11 PM'),
                ])
                ->visible(fn ($get) => $get('type') === 'eat'),

            /* ---------- EVENTS ---------- */
            Section::make('Event Details')
                ->schema([
                    TextInput::make('attributes.event_date')
                        ->type('date')
                        ->label('Event Date'),

                    TextInput::make('attributes.event_time')
                        ->placeholder('7:00 PM'),

                    TextInput::make('attributes.ticket_price')
                        ->placeholder('₹500'),
                ])
                ->visible(fn ($get) => $get('type') === 'events'),

            /* ---------- EXPLORE ---------- */
            Section::make('Explore Details')
                ->schema([
                    TextInput::make('attributes.best_time')
                        ->placeholder('Oct – Feb'),

                    TextInput::make('attributes.duration')
                        ->placeholder('2–3 hours'),

                    TextInput::make('attributes.entry_fee')
                        ->placeholder('Free / ₹100'),
                ])
                ->visible(fn ($get) => $get('type') === 'explore'),

            /* ---------- SERVICES ---------- */
            Section::make('Service Details')
                ->schema([
                    TextInput::make('attributes.service_type')
                        ->placeholder('Yoga, Taxi, Water Sports'),

                    TextInput::make('attributes.availability')
                        ->placeholder('Daily / On Call'),
                ])
                ->visible(fn ($get) => $get('type') === 'services'),

            /* ---------- REAL ESTATE ---------- */
            Section::make('Property Details')
                ->schema([
                    TextInput::make('attributes.property_type')
                        ->placeholder('Villa, Plot, Apartment'),

                    TextInput::make('attributes.area_sqft')
                        ->numeric()
                        ->label('Area (sq.ft)'),

                    TextInput::make('attributes.price')
                        ->placeholder('₹1.2 Cr'),

                    Select::make('attributes.furnishing')
                        ->options([
                            'furnished' => 'Furnished',
                            'semi' => 'Semi Furnished',
                            'unfurnished' => 'Unfurnished',
                        ]),
                ])
                ->visible(fn ($get) => $get('type') === 'real_estate'),

            /* ================= SEO ================= */
            Section::make('SEO')
                ->schema([
                    TextInput::make('meta_title'),
                    Textarea::make('meta_description')->rows(3),
                    TextInput::make('meta_keywords')
                        ->helperText('Comma separated keywords'),
                ]),
        ]);
    }

    /* =====================================================
     | TABLE
     ===================================================== */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('type')->badge(),
                TextColumn::make('location'),
                TextColumn::make('status')->badge(),
                ToggleColumn::make('is_featured'),
                ToggleColumn::make('is_verified'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type'),
                Tables\Filters\SelectFilter::make('status'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'edit' => Pages\EditListing::route('/{record}/edit'),
        ];
    }
}
