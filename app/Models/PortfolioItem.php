<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\SeoMeta;
use App\Models\Traits\Seoable;

class PortfolioItem extends Model
{
    use Seoable;

    protected $fillable = [
        'portfolio_category_id',
        'title',
        'slug',
        'excerpt',
        'description',
        'content',
        'cover_image',
        'images',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
    ];

    /*
     |--------------------------------------------------------------------------
     | Relations
     |--------------------------------------------------------------------------
     */

    public function category()
    {
        return $this->belongsTo(
            PortfolioCategory::class,
            'portfolio_category_id'
        );
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    /*
     |--------------------------------------------------------------------------
     | Accessors
     |--------------------------------------------------------------------------
     */

    public function getGalleryAttribute(): array
    {
        return $this->images ?? [];
    }

    public function getGalleryImagesAttribute(): array
    {
        $gallery = collect();
        
        // Add cover image first if exists
        if (!empty($this->cover_image)) {
            $gallery->push($this->cover_image);
        }
        
        // Then add all images from the gallery
        $images = $this->images ?? [];
        foreach ($images as $image) {
            $gallery->push($image);
        }
        
        return $gallery
            ->map(fn ($image) => $this->normalizeImageUrl($image))
            ->filter()
            ->unique()
            ->values()
            ->toArray();
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        // First check cover_image field
        if (!empty($this->cover_image)) {
            return $this->normalizeImageUrl($this->cover_image);
        }
        
        // Fallback to first image in gallery
        $images = $this->images ?? [];
        if (!empty($images) && isset($images[0])) {
            return $this->normalizeImageUrl($images[0]);
        }
        
        return null;
    }

    private function normalizeImageUrl(string $image): ?string
    {
        if (empty($image)) {
            return null;
        }

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        return asset('storage/' . ltrim($image, '/'));
    }
}
