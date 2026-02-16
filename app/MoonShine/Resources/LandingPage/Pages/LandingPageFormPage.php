<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\LandingPage\Pages;

use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\LandingPage\LandingPageResource;
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
 * @extends FormPage<LandingPageResource>
 */
class LandingPageFormPage extends FormPage
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
                    Text::make('Заголовок', 'title')
                        ->when(
                            fn() => $this->getResource()->isCreateFormPage(),
                            fn(Text $field) => $field->reactive(),
                            fn(Text $field) => $field // без reactive при редактировании
                        )
                        ->required(),
                    Slug::make('Slug', 'slug')
                        ->unique()
                        ->locked()
                        ->when(
                            fn() => $this->getResource()->isCreateFormPage(),
                            fn(Slug $field) => $field->from('title')->live(),
                            fn(Slug $field) => $field->readonly()
                        ),
                    Switcher::make('Активен', 'is_active'),
                    Number::make('Сортировка', 'sort_order')
                        ->default(0),
                ]),
                Tab::make('Hero секция', [
                    Textarea::make('Заголовок', 'hero_title'),
                    Textarea::make('Подзаголовок', 'hero_subtitle'),

                    Json::make('Преимущества', 'hero_items')
                        ->fields([
                            Text::make('Текст', 'text'),
                        ])
                        ->removable()
                        ->nullable(),
                ]),
                Tab::make('Типы фундаментов', [
                    Textarea::make('Заголовок секции', 'foundations_title'),
                    Json::make('Типы фундаментов', 'foundation_types')
                        ->fields([
                            Text::make('Название', 'title'),
                            Text::make('Цена', 'price'),
                            Image::make('Изображение', 'image')
                                ->disk('public'),
                        ])
                    ->removable(),
                ]),
                Tab::make('Выполненные работы', [
                    Textarea::make('Заголовок', 'examples_title'),

                    Json::make('Примеры', 'examples')
                        ->fields([
                            Text::make('Название'),
                            Image::make('Изображение')->disk('public'),
                        ]),
                ]),
                Tab::make('Галерея', [
                    Textarea::make('Заголовок', 'gallery_title'),

                    Json::make('Изображения', 'gallery_images')
                        ->fields([
                            Image::make('Фото')->disk('public'),
                        ]),
                ]),
                Tab::make('Цены', [
                    Textarea::make('Заголовок', 'price_title'),
                    Json::make('Таблица цен', 'price_table')
                        ->fields([
                            Text::make('Наименование'),
                            Text::make('Цена'),
                            Text::make('Ед. изм.'),
                        ]),
                ]),
                Tab::make('Отзывы', [
                    Textarea::make('Заголовок', 'reviews_title'),

                    Json::make('Отзывы', 'reviews')
                        ->fields([
                            Text::make('Имя'),
                            Textarea::make('Текст'),
                        ]),
                ]),
                Tab::make('FAQ', [
                    Textarea::make('Заголовок', 'faq_title'),

                    Json::make('Вопросы', 'faq')
                        ->fields([
                            Text::make('Вопрос'),
                            Textarea::make('Ответ'),
                        ]),
                ]),
                Tab::make('SEO', [
                    Text::make('Meta title', 'meta_title'),
                    Textarea::make('Meta description', 'meta_description'),
                ]),
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
