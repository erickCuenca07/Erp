<?php

namespace Suppliers\ListCreditors\Infrastructure\Entrypoint\Http;

use Inertia\Inertia;
use Inertia\Response;
use Suppliers\ListCreditors\Application\Handler\HandlerListCreditors;
use Suppliers\ListCreditors\Infrastructure\Persistence\Mysql\MysqlListCreditors;
use Suppliers\ListCreditors\Infrastructure\Persistence\ApiDelSol\ApiListCreditors;
use Suppliers\ListCreditors\Domain\Service\ListCreditorsService;
class ListCreditorsController
{
    public function index(): Response
    {
        $listCreditors = (new HandlerListCreditors(
            new ListCreditorsService(new ApiListCreditors())
        ))->handle();
        return Inertia::render('Hmb/Suppliers/ListCreditors/Index',[
            'listCreditors' => $listCreditors
        ]);
    }
}
