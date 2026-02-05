<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\SeoMeta;
use App\Models\Traits\Seoable;

class PortfolioCategory extends Model
{
    use Seoable;

    protected $fillable = [
        'title',
        'slug',
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

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }
}
