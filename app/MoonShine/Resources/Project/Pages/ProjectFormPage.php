<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Project\Pages;

use App\MoonShine\Fields\SeoFields;
use App\MoonShine\Resources\ProjectCategory\ProjectCategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Project\ProjectResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;


/**
 * @extends FormPage<ProjectResource>
 */
class ProjectFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Tabs::make([
                Tab::make('Основное', [
                    ID::make(),
                    BelongsTo::make(
                        'Категория проекта',
                        'category',
                        resource: ProjectCategoryResource::class
                    )
                        ->searchable()
                        ->required(),

                    Text::make('Название проекта', 'title')
                        ->when(
                            fn() => $this->getResource()->isCreateFormPage(),
                            fn(Text $field) => $field->reactive(),
                            fn(Text $field) => $field // без reactive при редактировании
                        )
                        ->required(),
                    Slug::make('Slug')
                        ->unique()
                        ->locked()
                        ->when(
                            fn() => $this->getResource()->isCreateFormPage(),
                            fn(Slug $field) => $field->from('title')->live(),
                            fn(Slug $field) => $field->readonly()
                        ),
                    Number::make('Стоимость', 'price')->min(0)->step(1000),

                    Switcher::make('Показывать на главной', 'show_on_home'),
                ]),
                Tab::make('Описание', [
                    Textarea::make('Описание', 'description'),
                ]),
                Tab::make('Характеристики', [
                    Number::make('Площадь, м²', 'area')->min(0),
                    Number::make('Этажей', 'floors')->min(1),
                    Number::make('Комнат', 'rooms')->min(1),
                ]),
                Tab::make('Превью и галерея', [
                    Image::make('Заглавное изображение', 'cover_image')
                        ->disk('public')
                        ->dir('projects/covers')
                        ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                        ->removable(),

                    Json::make('Галерея проекта', 'gallery')
                        ->fields([
                            Image::make('Изображение')
                                ->disk('public')
                                ->dir('projects/gallery')
                                ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                                ->removable(),
                        ])
                        ->nullable(),
                ]),
                Tab::make('SEO', SeoFields::make()),
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
        return [];
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
