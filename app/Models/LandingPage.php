<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LandingPage extends Model
{
    use HasFactory;

    /**
     * Массово заполняемые поля
     */
    protected $fillable = [
        'slug',
        'title',
        'hero_title',
        'hero_subtitle',
        'hero_items',
        'foundations_title',
        'foundation_types',
        'help_text',
        'examples_title',
        'examples',
        'gallery_title',
        'gallery_images',
        'price_title',
        'price_table',
        'calculator_title',
        'calculator_text',
        'facility_title',
        'facility_text',
        'reviews_title',
        'reviews',
        'faq_title',
        'faq',
        'meta_title',
        'meta_description',
        'is_active',
        'sort_order',
    ];

    /**
     * Приведение типов
     */
    protected $casts = [
        'hero_items'       => 'array',
        'foundation_types' => 'array',
        'examples'         => 'array',
        'gallery_images'   => 'array',
        'price_table'      => 'array',
        'reviews'          => 'array',
        'faq'              => 'array',
        'is_active'        => 'boolean',
    ];

    /* -----------------------------------------------------------------
     |  Scopes
     | -----------------------------------------------------------------
     */

    /**
     * Активные лендинги
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * По slug
     */
    public function scopeBySlug(Builder $query, string $slug): Builder
    {
        return $query->where('slug', $slug);
    }

    /**
     * Сортировка по порядку
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    /* -----------------------------------------------------------------
     |  Accessors
     | -----------------------------------------------------------------
     */

    /**
     * URL страницы
     */
    public function getUrlAttribute(): string
    {
        return route('landings.show', $this->slug);
    }

    /**
     * SEO title
     */
    public function getSeoTitleAttribute(): string
    {
        return $this->meta_title ?: $this->title;
    }

    /**
     * URL изображений галереи
     */
    public function getGalleryImagesUrlsAttribute(): array
    {
        return collect($this->gallery_images ?? [])
            ->map(fn($image) => asset('storage/landings/' . $this->slug . '/' . $image))
            ->toArray();
    }

    /**
     * Типы фундаментов с URL изображений
     */
    public function getFoundationImagesUrlsAttribute(): array
    {
        return collect($this->foundation_types ?? [])
            ->map(function ($type) {
                $type['image_url'] = asset('storage/landings/' . $this->slug . '/foundations/' . ($type['image'] ?? ''));
                return $type;
            })
            ->toArray();
    }
}
