<?php

namespace App\Models;

use App\Models\Traits\Seoable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    use Seoable;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'description',
        'price',
        'is_popular',
        'sort_order',
        'is_active',

        // связи
        'service_category_id',
        'service_subcategory_id',

        // Hero Section
        'hero_title',
        'hero_subtitle',
        'hero_bg_image',
        'hero_items',

        // Types Section
        'types_title',
        'types',

        // Examples Section
        'examples_title',
        'examples',

        // Gallery Section
        'gallery_title',
        'gallery_images',

        // Price Table Section
        'price_title',
        'price_table',

        // Reviews Section
        'reviews_title',
        'reviews',

        // Calculator Section
        'calculator_enabled',
        'calculator_title',
        'calculator_description',
        'calculator_formula',
        'calculator_currency',
        'calculator_result_label',
        'calculator_fields',
    ];

    protected $casts = [
        'is_popular' => 'boolean',
        'price'      => 'decimal:2',
        'is_active'  => 'boolean',
        'calculator_enabled' => 'boolean',
        'calculator_fields' => 'array',
        'hero_items' => 'array',
        'types' => 'array',
        'examples' => 'array',
        'gallery_images' => 'array',
        'price_table' => 'array',
        'reviews' => 'array',
    ];

    /* -----------------------------------------------------------------
     | Relationships
     | -----------------------------------------------------------------
     */

    /**
     * Подкатегория услуги
     */
    public function subcategory()
    {
        return $this->belongsTo(ServiceSubcategory::class, 'service_subcategory_id');
    }

    /**
     * Родительская категория (прямая)
     * ❗ НУЖНА для MoonShine
     */
    public function parentCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    /**
     * Универсальная категория (через подкатегорию или напрямую)
     */
    public function getCategoryAttribute(): ?ServiceCategory
    {
        return $this->subcategory?->category ?? $this->parentCategory;
    }

    /* -----------------------------------------------------------------
     | Helpers
     | -----------------------------------------------------------------
     */

    public function getHasSubcategoryAttribute(): bool
    {
        return !is_null($this->service_subcategory_id);
    }

    public function getHasDirectCategoryAttribute(): bool
    {
        return is_null($this->service_subcategory_id)
            && !is_null($this->service_category_id);
    }

    /* -----------------------------------------------------------------
     | Scopes
     | -----------------------------------------------------------------
     */

    public function scopePopular(Builder $query): Builder
    {
        return $query->where('is_popular', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopeBySlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    /* -----------------------------------------------------------------
     | Accessors
     | -----------------------------------------------------------------
     */

    public function getFormattedPriceAttribute(): ?string
    {
        return $this->price
            ? number_format($this->price, 0, '.', ' ') . ' BYN'
            : null;
    }

    /* -----------------------------------------------------------------
     | Landing Blocks Accessors
     | -----------------------------------------------------------------
     */

    /**
     * URL изображений галереи
     */
    public function getGalleryImagesUrlsAttribute(): array
    {
        return collect($this->gallery_images ?? [])
            ->map(function ($image) {
                $filename = is_array($image) ? ($image['image'] ?? $image['фото'] ?? null) : $image;
                return $filename ? asset('storage/' . ltrim($filename, '/')) : null;
            })
            ->filter()
            ->toArray();
    }

    /**
     * Типы с URL изображений
     */
    public function getTypesImagesUrlsAttribute(): array
    {
        return collect($this->types ?? [])
            ->map(function ($type) {
                $type['image_url'] = isset($type['image']) ? asset('storage/services/' . $this->slug . '/types/' . $type['image']) : null;
                return $type;
            })
            ->toArray();
    }

    /**
     * Примеры с URL изображений
     */
    public function getExamplesImagesUrlsAttribute(): array
    {
        return collect($this->examples ?? [])
            ->map(function ($example) {
                $example['image_url'] = isset($example['image']) ? asset('storage/services/' . $this->slug . '/examples/' . $example['image']) : null;
                return $example;
            })
            ->toArray();
    }

    /**
     * URL фонового изображения hero секции
     */
    public function getHeroBgImageUrlAttribute(): ?string
    {
        return $this->hero_bg_image
            ? asset('storage/services/' . $this->slug . '/' . $this->hero_bg_image)
            : null;
    }

    /**
     * Hero items с URL иконок
     */
    public function getHeroItemsWithIconsAttribute(): array
    {
        return collect($this->hero_items ?? [])
            ->map(function ($item) {
                $item['icon_url'] = isset($item['icon']) ? asset('storage/services/' . $this->slug . '/hero/' . $item['icon']) : null;
                return $item;
            })
            ->toArray();
    }
}
