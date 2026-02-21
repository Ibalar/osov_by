<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Request\Pages;
use MoonShine\Laravel\Pages\Crud\DetailPage;
/**
 * @extends DetailPage<\App\MoonShine\Resources\Request\RequestResource>
 */
class RequestDetailPage extends DetailPage
{
    protected string $title = 'Просмотр заявки';
}
