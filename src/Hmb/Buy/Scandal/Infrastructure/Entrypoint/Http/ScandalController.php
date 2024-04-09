<?php

namespace Buy\Scandal\Infrastructure\Entrypoint\Http;

use Inertia\Inertia;
use Inertia\Response;
use Buy\Scandal\Application\Handler\HandlerGetClients;
use Buy\Scandal\Domain\Service\ServiceGetClients;
use Buy\Scandal\Infrastructure\Persistence\Mysql\MysqlGetClients;
class ScandalController
{
    public function index(): Response
    {
        return Inertia::render('Hmb/Buy/Scandal/Index');
    }
    public function createArticle(): Response
    {
        $getClients = (new HandlerGetClients(
            new ServiceGetClients(new MysqlGetClients()))
        )->handle();
        return Inertia::render('Hmb/Buy/Scandal/CreateArticle',[
            'clients' => $getClients
        ]);
    }
}
