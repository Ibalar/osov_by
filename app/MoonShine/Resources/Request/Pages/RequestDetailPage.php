<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Request\Pages;

use MoonShine\Laravel\Pages\DetailPage;

/**
 * @extends DetailPage<\App\Models\Request>
 */
class RequestDetailPage extends DetailPage
{
    protected string $title = 'Просмотр заявки';
}
