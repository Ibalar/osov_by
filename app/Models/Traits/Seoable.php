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

    public function getSeoTitleAttribute(): string
    {
        return $this->seo['title']
            ?? $this->title
            ?? config('app.name');
    }

    public function getSeoH1Attribute(): string
    {
        return $this->seo['h1']
            ?? $this->seo_title
            ?? $this->title;
    }

    public function getSeoDescriptionAttribute(): ?string
    {
        if (!empty($this->seo['description'])) {
            return $this->seo['description'];
        }

        if (!empty($this->content)) {
            return Str::limit(
                strip_tags($this->content),
                160
            );
        }

        return null;
    }

    public function getSeoKeywordsAttribute(): ?string
    {
        return $this->seo['keywords'] ?? null;
    }

    public function getOgTitleAttribute(): string
    {
        return $this->seo_title;
    }

    public function getOgDescriptionAttribute(): ?string
    {
        return $this->seo_description;
    }

}
