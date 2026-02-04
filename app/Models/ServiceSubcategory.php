<?php

namespace App\Models;

use App\Models\Traits\Seoable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceSubcategory extends Model
{
    use HasFactory;
    use Seoable;

    /**
     * Массово заполняемые поля
     */
    protected $fillable = [
        'service_category_id',
        'title',
        'slug',
        'description',
        'image',
        'faq',
        'sort_order',
        'is_active',
        'project_category_id',
        'seo',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'seo' => 'array',
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

    // Связь с категорией проектов
    public function projectCategory()
    {
        return $this->belongsTo(\App\Models\ProjectCategory::class, 'project_category_id');
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
