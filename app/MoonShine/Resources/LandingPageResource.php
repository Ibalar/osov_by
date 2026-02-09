<?php

namespace App\MoonShine\Resources;

use App\Models\LandingPage;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;

class LandingPageResource extends ModelResource
{
    protected string $model = LandingPage::class;

    protected string $title = 'Лендинги';

    protected bool $createInModal = false;

    protected bool $editInModal = false;

    public function fields(): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Slug', 'slug')
                ->required()
                ->unique(),

            Text::make('Название', 'title')
                ->required(),

            Switcher::make('Активность', 'is_active')
                ->default(true),

            Number::make('Порядок сортировки', 'sort_order')
                ->default(0),
        ];
    }

    public function indexFields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug', 'slug'),
            Text::make('Название', 'title'),
            Switcher::make('Активность', 'is_active'),
        ];
    }

    public function formFields(): array
    {
        return [
            Grid::make([
                Column::make([
                    Box::make('Основное', [
                        Text::make('Slug', 'slug')
                            ->hint('URL лендинга, например: foundations')
                            ->required()
                            ->unique(),

                        Text::make('Название', 'title')
                            ->required(),

                        Switcher::make('Активность', 'is_active')
                            ->default(true),

                        Number::make('Порядок сортировки', 'sort_order')
                            ->default(0),
                    ]),
                ])->columnSpan(12),
            ]),

            Grid::make([
                Column::make([
                    Box::make('SEO', [
                        Text::make('Meta Title', 'meta_title'),
                        Textarea::make('Meta Description', 'meta_description')
                            ->rows(3),
                    ]),
                ])->columnSpan(6),

                Column::make([
                    Box::make('Hero секция', [
                        Text::make('Заголовок', 'hero_title'),
                        Textarea::make('Подзаголовок', 'hero_subtitle')
                            ->rows(2),
                        Json::make('Преимущества', 'hero_items')
                            ->fields([
                                Text::make('Текст', 'text'),
                            ]),
                    ]),
                ])->columnSpan(6),
            ]),

            Grid::make([
                Column::make([
                    Box::make('Типы фундаментов', [
                        Text::make('Заголовок', 'foundations_title'),
                        Json::make('Типы', 'foundation_types')
                            ->fields([
                                Text::make('Название', 'title'),
                                Text::make('Цена', 'price'),
                                Text::make('Изображение', 'image')
                                    ->hint('Путь к изображению в storage/landings/{slug}/foundations/'),
                            ]),
                    ]),
                ])->columnSpan(12),
            ]),

            Grid::make([
                Column::make([
                    Box::make('Выполненные работы', [
                        Text::make('Заголовок', 'examples_title'),
                        Json::make('Примеры', 'examples')
                            ->fields([
                                Text::make('Название', 'title'),
                                Text::make('Описание', 'description'),
                                Text::make('Изображение', 'image'),
                            ]),
                    ]),
                ])->columnSpan(6),

                Column::make([
                    Box::make('Галерея', [
                        Text::make('Заголовок', 'gallery_title'),
                        Json::make('Изображения', 'gallery_images')
                            ->fields([
                                Text::make('Имя файла', 'value'),
                            ]),
                    ]),
                ])->columnSpan(6),
            ]),

            Grid::make([
                Column::make([
                    Box::make('Цены', [
                        Text::make('Заголовок', 'price_title'),
                        Textarea::make('Таблица цен (JSON)', 'price_table')
                            ->hint('Формат: [{"Услуга":"...","Цена":"...","Срок":"..."}]')
                            ->rows(5),
                    ]),
                ])->columnSpan(6),

                Column::make([
                    Box::make('Калькулятор', [
                        Text::make('Заголовок', 'calculator_title'),
                        Textarea::make('Описание', 'calculator_text')
                            ->rows(3),
                    ]),
                ])->columnSpan(6),
            ]),

            Grid::make([
                Column::make([
                    Box::make('Преимущества', [
                        Text::make('Заголовок', 'facility_title'),
                        Textarea::make('Текст', 'facility_text')
                            ->rows(5),
                    ]),
                ])->columnSpan(6),

                Column::make([
                    Box::make('Отзывы', [
                        Text::make('Заголовок', 'reviews_title'),
                        Json::make('Отзывы', 'reviews')
                            ->fields([
                                Text::make('Имя', 'name'),
                                Text::make('Дата', 'date'),
                                Number::make('Рейтинг', 'rating')->min(1)->max(5),
                                Textarea::make('Текст', 'text'),
                            ]),
                    ]),
                ])->columnSpan(6),
            ]),

            Box::make('FAQ', [
                Text::make('Заголовок', 'faq_title'),
                Json::make('Вопросы', 'faq')
                    ->fields([
                        Text::make('Вопрос', 'question'),
                        Textarea::make('Ответ', 'answer'),
                    ]),
            ]),
        ];
    }

    public function rules(): array
    {
        return [
            'slug' => ['required', 'unique:landing_pages,slug,' . $this->getItemID()],
            'title' => ['required'],
        ];
    }
}
