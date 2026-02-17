<?php

namespace App\Models;

use App\Models\Traits\Seoable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceCategory extends Model
{
    use HasFactory;
    use Seoable;

    /**
     * Массово заполняемые поля
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'faq',
        'sort_order',
        'is_active',
        'is_popular',
        'project_category_id',
        // Calculator fields
        'calculator_title',
        'calculator_description',
        'calculator_enabled',
        'calculator_fields',
        'calculator_formula',
        'calculator_currency',
        'calculator_result_label',
        // Landing blocks
        'hero_title',
        'hero_subtitle',
        'hero_bg_image',
        'hero_items',
        'types_title',
        'types',
        'examples_title',
        'examples',
        'gallery_title',
        'gallery_images',
        'price_title',
        'price_table',
        'reviews_title',
        'reviews',
    ];

    /**
     * Приведение типов
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
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
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * Подкатегории услуги
     */
    public function subcategories()
    {
        return $this->hasMany(ServiceSubcategory::class)
            ->orderBy('sort_order')
            ->orderBy('id');
    }

    /**
     * Все услуги категории (через подкатегории)
     */
    public function services()
    {
        return $this->hasManyThrough(
            Service::class,
            ServiceSubcategory::class,
            'service_category_id',    // FK в подкатегории
            'service_subcategory_id', // FK в сервисе
            'id',                     // PK категории
            'id'                      // PK подкатегории
        );
    }

    /**
     * Связанная категория проектов
     */
    public function projectCategory()
    {
        return $this->belongsTo(\App\Models\ProjectCategory::class, 'project_category_id');
    }

    /* -----------------------------------------------------------------
     |  Scopes
     | -----------------------------------------------------------------
     */

    /**
     * Только активные категории
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * Только популярные категории
     */
    public function scopePopular(Builder $query): Builder
    {
        return $query->where('is_popular', true);
    }

    /**
     * Сортировка
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    /**
     * По slug
     */
    public function scopeBySlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    /* -----------------------------------------------------------------
     |  Accessors
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
                $type['image_url'] = isset($type['image']) ? asset('storage/services/categories/' . $this->slug . '/types/' . $type['image']) : null;
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
                $example['image_url'] = isset($example['image']) ? asset('storage/services/categories/' . $this->slug . '/examples/' . $example['image']) : null;
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
            ? asset('storage/services/categories/' . $this->slug . '/' . $this->hero_bg_image)
            : null;
    }

    /**
     * Hero items с URL иконок
     */
    public function getHeroItemsWithIconsAttribute(): array
    {
        return collect($this->hero_items ?? [])
            ->map(function ($item) {
                $item['icon_url'] = isset($item['icon']) ? asset('storage/services/categories/' . $this->slug . '/hero/' . $item['icon']) : null;
                return $item;
            })
            ->toArray();
    }
}
