<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\Palettes\PurplePalette;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use App\MoonShine\Resources\ServiceCategory\ServiceCategoryResource;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\ServiceSubcategory\ServiceSubcategoryResource;
use App\MoonShine\Resources\Service\ServiceResource;
use App\MoonShine\Resources\ProjectCategory\ProjectCategoryResource;
use App\MoonShine\Resources\Project\ProjectResource;
use App\MoonShine\Resources\PortfolioCategory\PortfolioCategoryResource;
use App\MoonShine\Resources\PortfolioItem\PortfolioItemResource;
use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\SiteSetting\SiteSettingResource;

final class MoonShineLayout extends AppLayout
{
    /**
     * @var null|class-string<PaletteContract>
     */
    protected ?string $palette = PurplePalette::class;

    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        return [
            MenuGroup::make('Наши услуги', [
                MenuItem::make(ServiceResource::class, 'Услуги'),
                MenuItem::make(ServiceCategoryResource::class, 'Категории услуг'),
                MenuItem::make(ServiceSubcategoryResource::class, 'Подкатегории услуг'),
            ]),
            MenuGroup::make('Готовые проекты', [
                MenuItem::make(ProjectResource::class, 'Проекты'),
                MenuItem::make(ProjectCategoryResource::class, 'Категории проектов'),
            ]),
            MenuItem::make(PortfolioCategoryResource::class, 'PortfolioCategories'),
            MenuItem::make(PortfolioItemResource::class, 'PortfolioItems'),
            MenuItem::make(PageResource::class, 'Pages'),
            MenuItem::make(SiteSettingResource::class, 'SiteSettings'),
            ...parent::menu(),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }
}
