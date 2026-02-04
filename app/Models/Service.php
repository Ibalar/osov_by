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

    /**
     * Массово заполняемые поля
     */
    protected $fillable = [
        'service_subcategory_id',
        'title',
        'slug',
        'excerpt',
        'description',
        'price',
        'is_popular',
        'sort_order',
    ];

    /**
     * Приведение типов
     */
    protected $casts = [
        'is_popular' => 'boolean',
        'price'      => 'decimal:2',
    ];

    /* -----------------------------------------------------------------
     |  Relationships
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
     * Категория услуги (через подкатегорию)
     */
    public function category()
    {
        return $this->hasOneThrough(
            ServiceCategory::class,
            ServiceSubcategory::class,
            'id',                   // PK подкатегории
            'id',                   // PK категории
            'service_subcategory_id', // FK в services
            'service_category_id'     // FK в subcategories
        );
    }

    /* -----------------------------------------------------------------
     |  Scopes
     | -----------------------------------------------------------------
     */

    /**
     * Только популярные услуги
     */
    public function scopePopular(Builder $query): Builder
    {
        return $query->where('is_popular', true);
    }

    /**
     * Сортировка по sort_order
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
     * Форматированная цена
     */
    public function getFormattedPriceAttribute(): ?string
    {
        if (!$this->price) {
            return null;
        }

        return number_format($this->price, 0, '.', ' ') . ' BYN';
    }
}
