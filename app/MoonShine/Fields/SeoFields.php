<?php

namespace App\MoonShine\Fields;



use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

class SeoFields
{
    public static function make(): array
    {
        return [
            Text::make('Meta title', 'seo.title')
                ->hint('Meta title (до 255 символов)'),

            Text::make('H1', 'seo.h1')
                ->hint('Основной заголовок страницы'),

            Textarea::make('Description', 'seo.description')
                ->hint('Meta description'),

            Textarea::make('Keywords', 'seo.keywords')
                ->hint('Meta keywords'),
        ];
    }
}
