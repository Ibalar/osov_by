<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PortfolioItem\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Resources\PortfolioItem\PortfolioItemResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\Relationships\BelongsTo;
use App\MoonShine\Fields\SeoFields;
use Throwable;


/**
 * @extends DetailPage<PortfolioItemResource>
 */
class PortfolioItemDetailPage extends DetailPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),

            BelongsTo::make('Категория', 'category', resource: 'portfolio_category'),

            Text::make('Название', 'title'),

            Text::make('Slug', 'slug'),

            Textarea::make('Краткое описание', 'excerpt'),

            Textarea::make('Описание', 'description'),

            Textarea::make('Подробное описание', 'content'),

            Image::make('Обложка', 'cover_image')
                ->disk('public'),

            File::make('Галерея', 'images')
                ->disk('public')
                ->multiple(),

            Switcher::make('Активен', 'is_active'),

            Number::make('Порядок сортировки', 'sort_order'),

            ...SeoFields::make(),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    /**
     * @param  TableBuilder  $component
     *
     * @return TableBuilder
     */
    protected function modifyDetailComponent(ComponentContract $component): ComponentContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
