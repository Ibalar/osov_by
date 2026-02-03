<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\Traits\Seoable;

class Page extends Model
{
    use Seoable;

    protected $fillable = [
        'key',
        'title',
        'content',
        'show_in_menu',
        'menu_title',
        'menu_order',
    ];

    protected $casts = [
        'seo' => 'array',
    ];

}
