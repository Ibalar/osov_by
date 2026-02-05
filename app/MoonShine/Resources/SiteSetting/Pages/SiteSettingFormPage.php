<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\SiteSetting\Pages;

use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\SiteSetting\SiteSettingResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;


/**
 * @extends FormPage<SiteSettingResource>
 */
class SiteSettingFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Heading::make('Контактные данные'),

                Text::make('Телефон', 'phone')
                    ->placeholder('+375 (xx) xxx-xx-xx'),

                Email::make('Email', 'email'),

                Textarea::make('Адрес', 'address'),

                Heading::make('Социальные сети'),

                Json::make('Соцсети', 'social_links')
                    ->fields([
                        Position::make(),
                        Text::make('key'),
                        Text::make('value'),
                    ])
                    ->hint('Формат: key = название, value = ссылка'),

                Heading::make('Логотипы'),

                Image::make('Логотип (светлый)', 'logo_path')
                    ->disk('public')
                    ->dir('site')
                    ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp']),

                Image::make('Логотип (тёмный)', 'logo_dark_path')
                    ->disk('public')
                    ->dir('site')
                    ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp']),

                Image::make('Логотип в футере', 'logo_footer_path')
                    ->disk('public')
                    ->dir('site')
                    ->allowedExtensions(['jpg', 'jpeg', 'png', 'webp', 'svg']),
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
