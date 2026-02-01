<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceSubcategory extends Model
{
    use HasFactory;

    /**
     * Массово заполняемые поля
     */
    protected $fillable = [
        'service_category_id',
        'title',
        'slug',
        'sort_order',
    ];

    /* -----------------------------------------------------------------
     |  Relationships
     | -----------------------------------------------------------------
     */

    /**
     * Родительская категория
     */
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    /**
     * Услуги подкатегории
     */
    public function services()
    {
        return $this->hasMany(Service::class)
            ->orderBy('sort_order')
            ->orderBy('id');
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
