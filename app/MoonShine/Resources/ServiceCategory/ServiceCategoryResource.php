<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ServiceCategory;

use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceCategory;
use App\MoonShine\Resources\ServiceCategory\Pages\ServiceCategoryIndexPage;
use App\MoonShine\Resources\ServiceCategory\Pages\ServiceCategoryFormPage;
use App\MoonShine\Resources\ServiceCategory\Pages\ServiceCategoryDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<ServiceCategory, ServiceCategoryIndexPage, ServiceCategoryFormPage, ServiceCategoryDetailPage>
 */
class ServiceCategoryResource extends ModelResource
{
    protected string $model = ServiceCategory::class;

    protected string $title = 'Категории услуг';

    protected string $column = 'title';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ServiceCategoryIndexPage::class,
            ServiceCategoryFormPage::class,
            ServiceCategoryDetailPage::class,
        ];
    }
}
