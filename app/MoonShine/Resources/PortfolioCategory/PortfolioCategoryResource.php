<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PortfolioCategory;

use Illuminate\Database\Eloquent\Model;
use App\Models\PortfolioCategory;
use App\MoonShine\Resources\PortfolioCategory\Pages\PortfolioCategoryIndexPage;
use App\MoonShine\Resources\PortfolioCategory\Pages\PortfolioCategoryFormPage;
use App\MoonShine\Resources\PortfolioCategory\Pages\PortfolioCategoryDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<PortfolioCategory, PortfolioCategoryIndexPage, PortfolioCategoryFormPage, PortfolioCategoryDetailPage>
 */
class PortfolioCategoryResource extends ModelResource
{
    protected string $model = PortfolioCategory::class;

    protected string $title = 'Категории портфолио';

    protected string $column = 'title';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            PortfolioCategoryIndexPage::class,
            PortfolioCategoryFormPage::class,
            PortfolioCategoryDetailPage::class,
        ];
    }
}
