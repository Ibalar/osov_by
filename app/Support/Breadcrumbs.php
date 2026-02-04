<?php

namespace App\Support;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Breadcrumbs
{
    public static function generate(): array
    {
        $route = Route::current();
        $breadcrumbs = [];

        // Главная всегда первая
        $breadcrumbs[] = [
            'title' => 'Главная',
            'url' => route('home'),
        ];

        if (!$route) {
            return $breadcrumbs;
        }

        $routeName = $route->getName();
        $params = $route->parameters();

        switch ($routeName) {

            case 'services.index':
                $breadcrumbs[] = [
                    'title' => 'Услуги',
                ];
                break;

            case 'services.category':
                $breadcrumbs[] = [
                    'title' => 'Услуги',
                    'url' => route('services.index'),
                ];
                $breadcrumbs[] = [
                    'title' => $params['category']->title ?? 'Категория',
                ];
                break;

            case 'services.show':
                $service = $params['service'];

                $breadcrumbs[] = [
                    'title' => 'Услуги',
                    'url' => route('services.index'),
                ];

                if ($service->category) {
                    $breadcrumbs[] = [
                        'title' => $service->category->title,
                        'url' => route('services.category', $service->category->slug),
                    ];
                }

                $breadcrumbs[] = [
                    'title' => $service->title,
                ];
                break;

            case 'projects.index':
                $breadcrumbs[] = [
                    'title' => 'Проекты',
                ];
                break;

            case 'portfolio.index':
                $breadcrumbs[] = [
                    'title' => 'Портфолио',
                ];
                break;

            default:
                // fallback по имени роута
                $breadcrumbs[] = [
                    'title' => Str::title(str_replace('.', ' ', $routeName)),
                ];
        }

        return $breadcrumbs;
    }
}
