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
        'project_category_id',
        // Calculator fields
        'calculator_title',
        'calculator_description',
        'calculator_enabled',
        'calculator_fields',
        'calculator_formula',
        'calculator_currency',
        'calculator_result_label',
    ];

    /**
     * Приведение типов
     */
    protected $casts = [
        'is_active' => 'boolean',
        'calculator_enabled' => 'boolean',
        'calculator_fields' => 'array',
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
