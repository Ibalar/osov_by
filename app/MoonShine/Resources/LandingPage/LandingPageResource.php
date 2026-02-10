<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\LandingPage;

use Illuminate\Database\Eloquent\Model;
use App\Models\LandingPage;
use App\MoonShine\Resources\LandingPage\Pages\LandingPageIndexPage;
use App\MoonShine\Resources\LandingPage\Pages\LandingPageFormPage;
use App\MoonShine\Resources\LandingPage\Pages\LandingPageDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<LandingPage, LandingPageIndexPage, LandingPageFormPage, LandingPageDetailPage>
 */
class LandingPageResource extends ModelResource
{
    protected string $model = LandingPage::class;

    protected string $title = 'LandingPages';
    
    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            LandingPageIndexPage::class,
            LandingPageFormPage::class,
            LandingPageDetailPage::class,
        ];
    }
}
