<?php

namespace Products\SearchArticleMassive\Infrastructure\Entrypoint\Http;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Products\SearchArticleMassive\Application\Handler\HandlerSearchArticleMassive;
use Products\SearchArticleMassive\Domain\Service\ServiceSearchArticleMassive;
use Products\SearchArticleMassive\Infrastructure\Persistence\Mysql\MysqlSearchArticleMassive;

class ControllerSearchArticleMassive
{
    public function index(): Response
    {
        return Inertia::render('Hmb/Products/SearchArticleMassive/Index');
    }

    public function search(Request $request)
    {
        $dates = $request->input('dates');
        return (new HandlerSearchArticleMassive(new ServiceSearchArticleMassive(new MysqlSearchArticleMassive())))->handle($dates);
    }
}
