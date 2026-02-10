<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use MoonShine\Laravel\DependencyInjection\MoonShine;
use MoonShine\Laravel\DependencyInjection\MoonShineConfigurator;
use App\MoonShine\Resources\MoonShineUser\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRole\MoonShineUserRoleResource;
use App\MoonShine\Resources\ServiceCategory\ServiceCategoryResource;
use App\MoonShine\Resources\ServiceSubcategory\ServiceSubcategoryResource;
use App\MoonShine\Resources\Service\ServiceResource;
use App\MoonShine\Resources\ProjectCategory\ProjectCategoryResource;
use App\MoonShine\Resources\Project\ProjectResource;
use App\MoonShine\Resources\PortfolioCategory\PortfolioCategoryResource;
use App\MoonShine\Resources\PortfolioItem\PortfolioItemResource;
use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\SiteSetting\SiteSettingResource;
use App\MoonShine\Resources\LandingPage\LandingPageResource;

class MoonShineServiceProvider extends ServiceProvider
{
    /**
     * @param  CoreContract<MoonShineConfigurator>  $core
     */
    public function boot(CoreContract $core): void
    {
        $core
            ->resources([
                MoonShineUserResource::class,
                MoonShineUserRoleResource::class,
                ServiceCategoryResource::class,
                ServiceSubcategoryResource::class,
                ServiceResource::class,
                ProjectCategoryResource::class,
                ProjectResource::class,
                PortfolioCategoryResource::class,
                PortfolioItemResource::class,
                PageResource::class,
                SiteSettingResource::class,
                LandingPageResource::class,
            ])
            ->pages([
                ...$core->getConfig()->getPages(),
            ])
        ;
    }
}
