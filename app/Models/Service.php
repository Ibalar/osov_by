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

        // связи
        'service_category_id',
        'service_subcategory_id',
    ];

    protected $casts = [
        'is_popular' => 'boolean',
        'price'      => 'decimal:2',
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
}
