<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoMeta extends Model
{
    protected $table = 'seo_meta';

    protected $fillable = [
        'title',
        'h1',
        'description',
        'keywords',
    ];

    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}
