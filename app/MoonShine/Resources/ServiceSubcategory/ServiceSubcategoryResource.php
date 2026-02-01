<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\ServiceSubcategory;

use Illuminate\Database\Eloquent\Model;
use App\Models\ServiceSubcategory;
use App\MoonShine\Resources\ServiceSubcategory\Pages\ServiceSubcategoryIndexPage;
use App\MoonShine\Resources\ServiceSubcategory\Pages\ServiceSubcategoryFormPage;
use App\MoonShine\Resources\ServiceSubcategory\Pages\ServiceSubcategoryDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<ServiceSubcategory, ServiceSubcategoryIndexPage, ServiceSubcategoryFormPage, ServiceSubcategoryDetailPage>
 */
class ServiceSubcategoryResource extends ModelResource
{
    protected string $model = ServiceSubcategory::class;

    protected string $title = 'ServiceSubcategories';
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            ServiceSubcategoryIndexPage::class,
            ServiceSubcategoryFormPage::class,
            ServiceSubcategoryDetailPage::class,
        ];
    }
}
