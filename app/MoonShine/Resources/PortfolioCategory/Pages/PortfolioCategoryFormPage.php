<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PortfolioCategory\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\PortfolioCategory\PortfolioCategoryResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Components\Layout\Box;
use App\MoonShine\Fields\SeoFields;
use Throwable;


/**
 * @extends FormPage<PortfolioCategoryResource>
 */
class PortfolioCategoryFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make('Основная информация', [
                ID::make()
                    ->sortable(),

                Text::make('Название', 'title')
                    ->required(),

                Text::make('Slug', 'slug')
                    ->required()
                    ->hint('URL-адрес категории (латиница, цифры и дефисы)'),

                Textarea::make('Описание', 'description')
                    ->hint('Описание категории'),

                Switcher::make('Активна', 'is_active')
                    ->default(true),

                Number::make('Порядок сортировки', 'sort_order')
                    ->default(0)
                    ->hint('Чем меньше число, тем выше в списке'),
            ]),

            Box::make('SEO', SeoFields::make()),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function formButtons(): ListOf
    {
        return parent::formButtons();
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9-]+$/', 'unique:portfolio_categories,slug,' . ($item->getKey() ?? 'NULL')],
            'description' => ['nullable', 'string'],
            'is_active' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
        ];
    }

    /**
     * @param  FormBuilder  $component
     *
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
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
