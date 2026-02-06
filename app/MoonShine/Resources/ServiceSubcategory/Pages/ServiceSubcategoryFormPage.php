<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ServiceSubcategory\Pages;

use App\MoonShine\Fields\SeoFields;
use App\MoonShine\Resources\ProjectCategory\ProjectCategoryResource;
use App\MoonShine\Resources\ServiceCategory\ServiceCategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\ServiceSubcategory\ServiceSubcategoryResource;
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
use Throwable;


/**
 * @extends FormPage<ServiceSubcategoryResource>
 */
class ServiceSubcategoryFormPage extends FormPage
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
                    BelongsTo::make('Категория', 'category', resource: ServiceCategoryResource::class)
                        ->searchable()
                        ->required(),
                    Text::make('Название', 'title')
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
                    BelongsTo::make('Категория проектов', 'projectCategory', resource: ProjectCategoryResource::class)
                        ->nullable()
                        ->sortable(),
                    Switcher::make('Активность', 'is_active'),
                    Number::make('Сортировка', 'sort_order')->default(0),
                    TinyMce::make('Описание', 'description')->nullable(),
                    Image::make('Изображение', 'image')
                        ->dir('services/subcategories')
                        ->disk('public')
                        ->nullable(),

                    Json::make('Вопрос–ответ', 'faq')
                        ->fields([
                            Text::make('Вопрос', 'question'),
                            Text::make('Ответ', 'answer'),
                        ])
                        ->nullable(),
                ]),
                // 🔥 SEO-блок
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
