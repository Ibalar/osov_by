<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PortfolioItem\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\PortfolioItem\PortfolioItemResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\TinyMce;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\File;
use MoonShine\UI\Fields\Relationships\BelongsTo;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use App\MoonShine\Fields\SeoFields;
use Throwable;


/**
 * @extends FormPage<PortfolioItemResource>
 */
class PortfolioItemFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Grid::make([
                Column::make([
                    Box::make('Основная информация', [
                        ID::make()
                            ->sortable(),

                        BelongsTo::make('Категория', 'category', resource: 'portfolio_category')
                            ->required(),

                        Text::make('Название', 'title')
                            ->required(),

                        Text::make('Slug', 'slug')
                            ->required()
                            ->hint('URL-адрес проекта (латиница, цифры и дефисы)'),

                        Textarea::make('Краткое описание', 'excerpt')
                            ->hint('Используется в превью проекта'),

                        Textarea::make('Описание', 'description')
                            ->hint('Краткое описание проекта'),

                        TinyMce::make('Подробное описание', 'content')
                            ->hint('Полное описание проекта'),

                        Switcher::make('Активен', 'is_active')
                            ->default(true),

                        Number::make('Порядок сортировки', 'sort_order')
                            ->default(0)
                            ->hint('Чем меньше число, тем выше в списке'),
                    ]),

                    Box::make('SEO', SeoFields::make()),
                ])->columnSpan(8),

                Column::make([
                    Box::make('Изображения', [
                        Image::make('Обложка', 'cover_image')
                            ->disk('public')
                            ->dir('portfolio')
                            ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                            ->hint('Основное изображение проекта'),

                        File::make('Галерея', 'images')
                            ->disk('public')
                            ->dir('portfolio/gallery')
                            ->multiple()
                            ->removable()
                            ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                            ->hint('Загрузите изображения для галереи проекта'),
                    ]),
                ])->columnSpan(4),
            ]),
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
            'portfolio_category_id' => ['required', 'exists:portfolio_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9-]+$/', 'unique:portfolio_items,slug,' . ($item->getKey() ?? 'NULL')],
            'excerpt' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'string'],
            'images' => ['nullable', 'array'],
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
