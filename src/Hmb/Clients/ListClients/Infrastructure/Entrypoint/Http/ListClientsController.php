<?php
namespace Clients\ListClients\Infrastructure\Entrypoint\Http;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Clients\ListClients\Application\Handler\HandlerListClients;
use Clients\ListClients\Domain\Service\ListClientsService;
use Clients\ListClients\Infrastructure\Persistence\Mysql\MysqlListClients;
class ListClientsController
{
    public function index(): Response
    {
        $listClients = (new HandlerListClients(
            new ListClientsService(new MysqlListClients())
        ))->handle();
        return Inertia::render('Hmb/Clients/ListClients/Index', ['listClients' => $listClients]);
    }
}
