<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\PortfolioItem;
use App\Models\Project;
use App\Models\Service;
use App\Models\Page as PageModel;
use App\MoonShine\Resources\Page\PageResource;
use App\MoonShine\Resources\Service\ServiceResource;
use App\MoonShine\Resources\Project\ProjectResource;
use App\MoonShine\Resources\PortfolioItem\PortfolioItemResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Heading;
use MoonShine\UI\Components\Layout\Div;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Components\ActionButton;

#[\MoonShine\MenuManager\Attributes\SkipMenu]

class Dashboard extends Page
{
    protected string $title = 'Панель управления';

    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return $this->title ?: 'Панель управления';
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        $serviceResource = app(ServiceResource::class);
        $projectResource = app(ProjectResource::class);
        $portfolioItemResource = app(PortfolioItemResource::class);
        $pageResource = app(PageResource::class);

        return [
            ActionButton::make('На главную сайта', route('home'))
                ->icon('home')
                ->blank()
                ->secondary()
                ->class('mb-6'),

            Grid::make([
                Column::make([
                    $this->dashboardBox(
                        count: Service::query()->where('is_active', true)->count(),
                        title: 'Услуги',
                        icon: 'home-modern',
                        createUrl: $serviceResource->getFormPageUrl(),
                    ),
                ], 3, 12),

                Column::make([
                    $this->dashboardBox(
                        count: Project::query()->where('is_active', true)->count(),
                        title: 'Готовые проекты',
                        icon: 'building-library',
                        createUrl: $projectResource->getFormPageUrl(),
                    ),
                ], 3, 12),

                Column::make([
                    $this->dashboardBox(
                        count: PortfolioItem::query()->where('is_active', true)->count(),
                        title: 'Портфолио',
                        icon: 'camera',
                        createUrl: $portfolioItemResource->getFormPageUrl(),
                    ),
                ], 3, 12),

                Column::make([
                    $this->dashboardBox(
                        count: PageModel::query()->count(),
                        title: 'Инфостраницы',
                        icon: 'clipboard-document-list',
                        createUrl: $pageResource->getFormPageUrl(),
                    ),
                ], 3, 12),


            ]),
        ];

    }

    private function getResourceRoute(string $resourceClass, string $action = 'index'): string
    {
        $resource = new $resourceClass();
        return "/admin/{$resource->getUriKey()}/{$action}";
    }

    private function dashboardBox(int $count, string $title, string $icon, string $createUrl): Box
    {
        return Box::make($title, [
            Div::make([
                Heading::make((string) $count)
                    ->h(1)
                    ->class('text-4xl font-bold'),

                ActionButton::make('Создать', $createUrl)
                    ->icon('plus')
                    ->primary(),
            ])->class('flex flex-col items-center gap-4'),
        ])->icon($icon);
    }

}
