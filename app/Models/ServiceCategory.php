<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceCategory extends Model
{
    use HasFactory;

    /**
     * Массово заполняемые поля
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'sort_order',
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
            'service_category_id', // Foreign key on subcategories
            'service_subcategory_id', // Foreign key on services
            'id', // Local key on categories
            'id'  // Local key on subcategories
        );
    }

    /* -----------------------------------------------------------------
     |  Scopes
     | -----------------------------------------------------------------
     */

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
}
