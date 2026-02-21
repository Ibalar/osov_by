<?php
declare(strict_types=1);
namespace App\MoonShine\Resources\Request\Pages;
use MoonShine\Laravel\Pages\Crud\IndexPage;
/**
 * @extends IndexPage<\App\MoonShine\Resources\Request\RequestResource>
 */
class RequestIndexPage extends IndexPage
{
    protected string $title = 'Заявки';
}
