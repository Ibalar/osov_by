<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\SeoMeta;
use App\Models\Traits\Seoable;

class Project extends Model
{
    use HasFactory;

    use Seoable;

    /**
     * Массово заполняемые поля
     */
    protected $fillable = [
        'project_category_id',
        'title',
        'slug',
        'cover_image',
        'gallery',
        'description',
        'area',
        'floors',
        'rooms',
        'price',
        'show_on_home',
        'is_active',
    ];

    /**
     * Приведение типов
     */
    protected $casts = [
        'area'         => 'integer',
        'floors'       => 'integer',
        'rooms'        => 'integer',
        'gallery'      => 'array',
        'price'        => 'decimal:2',
        'show_on_home' => 'boolean',
        'is_active'    => 'boolean',
    ];

    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * Категория проекта
     */
    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

    /* -----------------------------------------------------------------
     |  Scopes
     | -----------------------------------------------------------------
     */

    /**
     * Для главной страницы
     */
    public function scopeOnHome(Builder $query): Builder
    {
        return $query->where('show_on_home', true);
    }

    /**
     * Сортировка по названию
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('title');
    }

    /**
     * Фильтр по цене
     */
    public function scopePriceBetween(
        Builder $query,
        ?int $from = null,
        ?int $to = null
    ): Builder {
        return $query
            ->when($from, fn ($q) => $q->where('price', '>=', $from))
            ->when($to, fn ($q) => $q->where('price', '<=', $to));
    }

    /**
     * Фильтр по площади
     */
    public function scopeAreaBetween(
        Builder $query,
        ?int $from = null,
        ?int $to = null
    ): Builder {
        return $query
            ->when($from, fn ($q) => $q->where('area', '>=', $from))
            ->when($to, fn ($q) => $q->where('area', '<=', $to));
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
     * Форматированная цена
     */
    public function getFormattedPriceAttribute(): ?string
    {
        if (!$this->price) {
            return null;
        }

        return number_format($this->price, 0, '.', ' ') . ' BYN';
    }

    /**
     * URL заглавного изображения
     */
    public function getCoverImageUrlAttribute(): ?string
    {
        return $this->cover_image
            ? asset('storage/' . $this->cover_image)
            : null;
    }

    /**
     * Галерея с абсолютными URL
     */
    public function getGalleryImagesAttribute(): array
    {
        return collect($this->gallery ?? [])
            ->map(fn ($image) => asset('storage/' . $image))
            ->toArray();
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }
}
