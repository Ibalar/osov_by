<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\PortfolioItem;

use Illuminate\Database\Eloquent\Model;
use App\Models\PortfolioItem;
use App\MoonShine\Resources\PortfolioItem\Pages\PortfolioItemIndexPage;
use App\MoonShine\Resources\PortfolioItem\Pages\PortfolioItemFormPage;
use App\MoonShine\Resources\PortfolioItem\Pages\PortfolioItemDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<PortfolioItem, PortfolioItemIndexPage, PortfolioItemFormPage, PortfolioItemDetailPage>
 */
class PortfolioItemResource extends ModelResource
{
    protected string $model = PortfolioItem::class;

    protected string $title = 'Портфолио';

    protected string $column = 'title';

    protected ?string $sortColumn = 'sort_order';

    protected ?string $sortDirection = 'asc';
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            PortfolioItemIndexPage::class,
            PortfolioItemFormPage::class,
            PortfolioItemDetailPage::class,
        ];
    }
}
