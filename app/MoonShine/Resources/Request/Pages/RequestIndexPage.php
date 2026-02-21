<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Request\Pages;

use MoonShine\Laravel\Pages\ListPage;

/**
 * @extends ListPage<\App\Models\Request>
 */
class RequestIndexPage extends ListPage
{
    protected string $title = 'Заявки';

    protected array $items = [];
}
