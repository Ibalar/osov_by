<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Request;

use Illuminate\Database\Eloquent\Model;
use App\Models\Request;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Request, RequestIndexPage, RequestFormPage, RequestDetailPage>
 */
class RequestResource extends ModelResource
{
    protected string $model = Request::class;

    protected string $title = 'Заявки';

    protected string $column = 'id';

    protected bool $withStack = true;

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            \App\MoonShine\Resources\Request\Pages\RequestIndexPage::class,
            \App\MoonShine\Resources\Request\Pages\RequestFormPage::class,
            \App\MoonShine\Resources\Request\Pages\RequestDetailPage::class,
        ];
    }

    /**
     * List of fields to use on index page
     */
    protected function indexFields(): array
    {
        return [
            Text::make('ID', 'id')->sortable(),
            Text::make('Телефон', 'phone')->sortable(),
            Text::make('Имя', 'name'),
            Text::make('Источник', 'source_type_label'),
            Text::make('Название', 'source_title'),
            Select::make('Статус', 'status')
                ->options(Request::getStatusOptions())
                ->sortable(),
            Date::make('Создано', 'created_at')->sortable(),
        ];
    }

    /**
     * List of fields to use on form page
     */
    protected function formFields(): array
    {
        return [
            Text::make('Телефон', 'phone')
                ->required(),
            Text::make('Имя', 'name'),
            Select::make('Тип источника', 'source_type')
                ->options([
                    'service' => 'Услуга',
                    'service_category' => 'Категория услуг',
                    'landing' => 'Лендинг',
                    'unknown' => 'Другое',
                ]),
            Text::make('Название источника', 'source_title'),
            Textarea::make('Комментарий', 'comment'),
            Select::make('Статус', 'status')
                ->options(Request::getStatusOptions()),
        ];
    }

    /**
     * List of fields to use on detail page
     */
    protected function detailFields(): array
    {
        return [
            Text::make('ID', 'id'),
            Text::make('Телефон', 'phone'),
            Text::make('Имя', 'name'),
            Text::make('Тип источника', 'source_type_label'),
            Text::make('Название источника', 'source_title'),
            Textarea::make('Комментарий', 'comment'),
            Select::make('Статус', 'status')
                ->options(Request::getStatusOptions()),
            Date::make('Создано', 'created_at'),
            Date::make('Обновлено', 'updated_at'),
        ];
    }

    /**
     * Determine if the resource is searchable
     */
    protected function isSearchable(): bool
    {
        return true;
    }

    /**
     * Determine if the resource is sortable
     */
    protected function isSortable(): bool
    {
        return true;
    }
}
