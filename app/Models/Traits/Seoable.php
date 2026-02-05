<?php

namespace App\Models\Traits;

use App\Models\SeoMeta;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;

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
        return $this->seo['title']
            ?? $this->seo_title
            ?? $this->title
            ?? config('app.name');
    }

    public function getOgDescriptionAttribute(): ?string
    {
        return $this->seo['description']
            ?? $this->seo_description
            ?? $this->seo_description;
    }

    public function getOgImageAttribute(): ?string
    {
        // Для проектов и портфолио - использовать cover_image
        if (method_exists($this, 'getCoverImageUrlAttribute')) {
            return $this->cover_image_url;
        }

        // Для категорий с изображением
        if (!empty($this->image)) {
            return asset('storage/' . $this->image);
        }

        // Default OG image
        return asset('images/og-image-default.jpg');
    }

}
