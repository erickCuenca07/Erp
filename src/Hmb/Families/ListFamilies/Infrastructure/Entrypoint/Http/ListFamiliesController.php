<?php

namespace Families\ListFamilies\Infrastructure\Entrypoint\Http;


use Families\ListFamilies\Application\Handler\HandlerListFamilies;
use Families\ListFamilies\Domain\Service\ListFamiliesService;
use Families\ListFamilies\Infrastructure\Persistence\Mysql\MysqlListFamilies;
use Inertia\Inertia;
use Inertia\Response;

class ListFamiliesController
{
    public function index(): Response
    {
        $listFamilies = (new HandlerListFamilies(
            new ListFamiliesService(new MysqlListFamilies())
        ))->handle();
        return Inertia::render('Hmb/Families/ListFamilies/Index', ['listFamilies' => $listFamilies]);
    }
}
