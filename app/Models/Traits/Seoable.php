<?php

namespace App\Models\Traits;

use App\Models\SeoMeta;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait Seoable
{
    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoable')->withDefault();
    }

    /**
     * Удобный доступ: $model->seo
     */
    public function getSeoAttribute(): SeoMeta
    {
        return $this->seo()->firstOrNew();
    }
}
