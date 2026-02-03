<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Page;

use Illuminate\Database\Eloquent\Model;
use App\Models\Page;
use App\MoonShine\Resources\Page\Pages\PageIndexPage;
use App\MoonShine\Resources\Page\Pages\PageFormPage;
use App\MoonShine\Resources\Page\Pages\PageDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<Page, PageIndexPage, PageFormPage, PageDetailPage>
 */
class PageResource extends ModelResource
{
    protected string $model = Page::class;

    protected string $title = 'Страницы';

    protected string $column = 'title';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            PageIndexPage::class,
            PageFormPage::class,
            PageDetailPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'key' => ['required', 'string', 'unique:pages,key,' . $item?->id],
            'title' => ['required', 'string'],

            'menu_title' => ['nullable', 'string'],
            'menu_order' => ['nullable', 'integer'],

            // SEO
            'seo.title' => ['nullable', 'string', 'max:255'],
            'seo.h1' => ['nullable', 'string', 'max:255'],
            'seo.description' => ['nullable', 'string'],
            'seo.keywords' => ['nullable', 'string'],
        ];
    }


}
