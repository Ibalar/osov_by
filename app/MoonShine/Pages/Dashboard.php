<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\PortfolioItem;
use App\Models\Project;
use App\Models\Service;
use App\MoonShine\Resources\Service\ServiceResource;
use App\MoonShine\Resources\Project\ProjectResource;
use App\MoonShine\Resources\PortfolioItem\PortfolioItemResource;
use MoonShine\Laravel\Pages\Page;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Metrics\Wrapped\Metric;
use MoonShine\UI\Components\ActionButton;

#[\MoonShine\MenuManager\Attributes\SkipMenu]

class Dashboard extends Page
{
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
        $serviceCount = Service::count();
        $projectCount = Project::count();
        $portfolioCount = PortfolioItem::count();

        return [
            Grid::make([
                Column::make([
                    Box::make([
                        Metric::make('Услуги', $serviceCount)
                            ->icon('heroicons.list-bullet'),
                    ])->class('dashboard-metric'),
                ])->columnSpan(4),

                Column::make([
                    Box::make([
                        Metric::make('Готовые проекты', $projectCount)
                            ->icon('heroicons.building-office'),
                    ])->class('dashboard-metric'),
                ])->columnSpan(4),

                Column::make([
                    Box::make([
                        Metric::make('Портфолио', $portfolioCount)
                            ->icon('heroicons.photo'),
                    ])->class('dashboard-metric'),
                ])->columnSpan(4),
            ]),

            Box::make('Быстрые действия', [
                Grid::make([
                    Column::make([
                        ActionButton::make('Добавить услугу', 
                            fn() => $this->getResourceRoute(ServiceResource::class, 'create')
                        )
                            ->icon('heroicons.plus')
                            ->primary(),
                    ])->columnSpan(4),

                    Column::make([
                        ActionButton::make('Добавить проект', 
                            fn() => $this->getResourceRoute(ProjectResource::class, 'create')
                        )
                            ->icon('heroicons.plus')
                            ->primary(),
                    ])->columnSpan(4),

                    Column::make([
                        ActionButton::make('Добавить в портфолио', 
                            fn() => $this->getResourceRoute(PortfolioItemResource::class, 'create')
                        )
                            ->icon('heroicons.plus')
                            ->primary(),
                    ])->columnSpan(4),
                ]),
            ]),
        ];
    }

    private function getResourceRoute(string $resourceClass, string $action = 'index'): string
    {
        $resource = new $resourceClass();
        return "/admin/{$resource->getUriKey()}/{$action}";
    }
}
