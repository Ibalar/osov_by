<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Service\Pages;

use App\MoonShine\Fields\SeoFields;
use App\MoonShine\Resources\ServiceCategory\ServiceCategoryResource;
use App\MoonShine\Resources\ServiceSubcategory\ServiceSubcategoryResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Service\ServiceResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;


/**
 * @extends FormPage<ServiceResource>
 */
class ServiceFormPage extends FormPage
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
                    BelongsTo::make('Подкатегория', 'subcategory', resource: ServiceSubcategoryResource::class)
                        ->nullable()
                        ->searchable()
                        ->hint('Выбирайте подкатегорию, если услуга относится к ней'),

                    BelongsTo::make('Категория (родительская)', 'parentCategory', resource: ServiceCategoryResource::class)
                        ->nullable()
                        ->searchable()
                        ->hint('Выбирайте, если услуга относится напрямую к категории, а не к подкатегории'),

                    Text::make('Название', 'title')
                        ->when(
                            fn() => $this->getResource()->isCreateFormPage(),
                            fn(Text $field) => $field->reactive(),
                            fn(Text $field) => $field
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

                    Textarea::make('Краткое описание', 'excerpt')
                        ->hint('Будет отображаться на главной странице и в блоке популярных услуг'),
                    Textarea::make('Описание', 'description')->nullable(),

                    Number::make('Цена', 'price')
                        ->min(0)
                        ->step(1),

                    Switcher::make('Популярная услуга', 'is_popular'),
                    Switcher::make('Активность', 'is_active'),

                    Number::make('Сортировка', 'sort_order')->default(0),
                ]),
                Tab::make('Hero секция', [
                    Textarea::make('Заголовок', 'hero_title')
                        ->nullable()
                        ->hint('Заголовок в hero секции'),
                    Textarea::make('Подзаголовок', 'hero_subtitle')
                        ->nullable()
                        ->hint('Подзаголовок в hero секции'),
                    Image::make('Фоновое изображение', 'hero_bg_image')
                        ->dir('services')
                        ->disk('public')
                        ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp'])
                        ->nullable()
                        ->removable()
                        ->hint('Фоновое изображение для hero секции (header-body__img)'),
                    Json::make('Преимущества', 'hero_items')
                        ->fields([
                            Text::make('Текст', 'text')
                                ->hint('Текст преимущества'),
                            Image::make('Иконка', 'icon')
                                ->disk('public')
                                ->dir('services/hero')
                                ->hint('Иконка преимущества (если не задана, будет использоваться стандартная через CSS)')
                                ->removable()
                                ->nullable(),
                        ])
                        ->removable()
                        ->nullable()
                        ->hint('4 преимущества в hero секции'),
                ]),
                Tab::make('Описание', [
                    TinyMce::make('Описание', 'description')
                        ->addPlugins(['table', 'lists', 'link', 'image', 'media'])
                        ->nullable(),
                ]),
                Tab::make('Типы/Виды услуг', [
                    Textarea::make('Заголовок секции', 'types_title')
                        ->nullable()
                        ->hint('Заголовок секции типов'),
                    Json::make('Типы', 'types')
                        ->fields([
                            Text::make('Название', 'title')
                                ->hint('Название типа'),
                            Text::make('Цена', 'price')
                                ->hint('Цена типа'),
                            Select::make('Ед. изм.', 'unit')
                                ->options([
                                    'м²' => 'м²',
                                    'м³' => 'м³',
                                    'м.пог' => 'м.пог',
                                    'шт.' => 'шт.',
                                ])
                                ->hint('Единица измерения')
                                ->nullable(),
                            Image::make('Изображение', 'image')
                                ->disk('public')
                                ->dir('services/types')
                                ->hint('Изображение типа'),
                        ])
                        ->removable()
                        ->nullable()
                        ->hint('Массив типов (название, цена, единица измерения, изображение)'),
                ]),
                Tab::make('Галерея', [
                    Textarea::make('Заголовок', 'gallery_title')
                        ->nullable()
                        ->hint('Заголовок галереи'),
                    Json::make('Изображения', 'gallery_images')
                        ->fields([
                            Image::make('Фото', 'image')
                                ->disk('public')
                                ->dir('services/gallery')
                                ->hint('Изображение галереи'),
                        ])
                        ->removable()
                        ->nullable()
                        ->hint('Изображения галереи'),
                ]),


                Tab::make('Примеры работ', [
                    Textarea::make('Заголовок', 'examples_title')
                        ->nullable()
                        ->hint('Заголовок секции выполненных работ'),
                    Json::make('Примеры', 'examples')
                        ->fields([
                            Text::make('Название')
                                ->hint('Название примера'),
                            Textarea::make('Описание', 'description')
                                ->hint('Описание примера')
                                ->nullable(),
                            Image::make('Изображение')
                                ->disk('public')
                                ->dir('services/examples')
                                ->hint('Изображение примера'),
                        ])
                        ->removable()
                        ->nullable()
                        ->hint('Выполненные работы'),
                ]),

                Tab::make('Цены', [
                    Textarea::make('Заголовок', 'price_title')
                        ->nullable()
                        ->hint('Заголовок таблицы цен'),
                    Json::make('Таблица цен', 'price_table')
                        ->fields([
                            Text::make('Наименование')
                                ->hint('Наименование услуги'),
                            Text::make('Цена')
                                ->hint('Цена услуги'),
                            Text::make('Ед. изм.')
                                ->hint('Единица измерения')
                                ->nullable(),
                        ])
                        ->removable()
                        ->nullable()
                        ->hint('Таблица цен'),
                ]),
                Tab::make('Отзывы', [
                    Textarea::make('Заголовок', 'reviews_title')
                        ->nullable()
                        ->hint('Заголовок отзывов'),
                    Json::make('Отзывы', 'reviews')
                        ->fields([
                            Text::make('Имя')
                                ->hint('Имя клиента'),
                            Textarea::make('Текст')
                                ->hint('Текст отзыва'),
                            Text::make('Дата', 'date')
                                ->hint('Дата отзыва')
                                ->nullable(),
                            Number::make('Рейтинг', 'rating')
                                ->hint('Рейтинг от 1 до 5')
                                ->min(1)
                                ->max(5)
                                ->default(5)
                                ->nullable(),
                        ])
                        ->removable()
                        ->nullable()
                        ->hint('Отзывы (слайдер)'),
                ]),
                Tab::make('Калькулятор', [
                    Switcher::make('Включить калькулятор', 'calculator_enabled'),

                    Text::make('Заголовок калькулятора', 'calculator_title')
                        ->nullable()
                        ->hint('Заголовок секции с калькулятором'),

                    Textarea::make('Описание калькулятора', 'calculator_description')
                        ->nullable()
                        ->hint('Текст под заголовком калькулятора'),

                    Text::make('Подпись результата', 'calculator_result_label')
                        ->default('Итоговая стоимость')
                        ->hint('Подпись под результатом расчета'),

                    Text::make('Валюта', 'calculator_currency')
                        ->default('BYN')
                        ->hint('Символ валюты (например: BYN, руб., $)'),

                    Textarea::make('Формула расчета', 'calculator_formula')
                        ->nullable()
                        ->hint('Формула: используйте {field_key} для подстановки значений. Например: {width} * {length} * {price}'),

                    Json::make('Поля калькулятора', 'calculator_fields')
                        ->fields([
                            Text::make('Ключ', 'key')
                                ->required()
                                ->hint('Уникальный идентификатор поля (латиница, без пробелов)'),
                            Text::make('Название', 'label')
                                ->required()
                                ->hint('Отображаемое название поля'),
                            Text::make('Тип', 'type')
                                ->default('number')
                                ->hint('Тип поля: number, text, select, radio, checkbox, range'),
                            Text::make('Значение по умолчанию', 'default_value')
                                ->nullable()
                                ->hint('Значение по умолчанию'),
                            Text::make('Плейсхолдер', 'placeholder')
                                ->nullable()
                                ->hint('Подсказка в поле ввода'),
                            Text::make('Минимум', 'min')
                                ->nullable()
                                ->hint('Минимальное значение (для number/range)'),
                            Text::make('Максимум', 'max')
                                ->nullable()
                                ->hint('Максимальное значение (для number/range)'),
                            Text::make('Шаг', 'step')
                                ->nullable()
                                ->hint('Шаг (для number/range)'),
                            Json::make('Варианты выбора', 'options')
                                ->fields([
                                    Text::make('Название', 'label'),
                                    Text::make('Значение', 'value'),
                                ])
                                ->nullable()
                                ->hint('Варианты для select/radio (не используется для number)'),
                        ])
                        ->removable()
                        ->nullable()
                        ->hint('Настройка полей калькулятора'),
                ]),
                // 🔥 SEO-блок
                Tab::make('SEO', SeoFields::make()),
            ]),
        ];
    }

    protected function beforeSave(): void
    {
        if ($this->getItem()->service_subcategory_id) {
            $this->getItem()->service_category_id = null;
        }

        if ($this->getItem()->service_category_id) {
            $this->getItem()->service_subcategory_id = null;
        }
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
