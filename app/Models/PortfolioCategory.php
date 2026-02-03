<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Seoable;

class PortfolioCategory extends Model
{
    use Seoable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'is_active',
        'sort_order',
        'seo',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'seo' => 'array',
    ];

    /*
     |--------------------------------------------------------------------------
     | Relations
     |--------------------------------------------------------------------------
     */

    public function items()
    {
        return $this->hasMany(
            PortfolioItem::class,
            'portfolio_category_id'
        );
    }
}
