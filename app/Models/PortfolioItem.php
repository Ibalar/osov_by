<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Seoable;

class PortfolioItem extends Model
{
    use Seoable;

    protected $fillable = [
        'portfolio_category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'cover_image',
        'gallery',
        'is_active',
        'sort_order',
        'seo',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'gallery' => 'array',
        'seo' => 'array',
    ];

    /*
     |--------------------------------------------------------------------------
     | Relations
     |--------------------------------------------------------------------------
     */

    public function category()
    {
        return $this->belongsTo(
            PortfolioCategory::class,
            'portfolio_category_id'
        );
    }
}
