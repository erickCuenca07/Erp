<?php

namespace Buy\Scandal\Infrastructure\Entrypoint\Http;

use Buy\CreateArticle\Application\Handler\HandlerGetClients;
use Buy\CreateArticle\Domain\Service\ServiceGetClients;
use Buy\CreateArticle\Infrastructure\Persistence\Mysql\MysqlGetClients;
use Buy\Scandal\Application\Handler\HandlerScandalSearchContainer;
use Buy\Scandal\Application\Handler\HandlerScandalSearchScandalId;
use Buy\Scandal\Application\Handler\HandlerScandalSearchSupplier;
use Buy\Scandal\Domain\Service\ServiceScandalSearchContainer;
use Buy\Scandal\Domain\Service\ServiceScandalSearchScandalId;
use Buy\Scandal\Domain\Service\ServiceScandalSearchSupplier;
use Buy\Scandal\Infrastructure\Persistence\Mysql\MysqlScandalSearchContainer;
use Buy\Scandal\Infrastructure\Persistence\Mysql\MysqlScandalSearchScandalId;
use Buy\Scandal\Infrastructure\Persistence\Mysql\MysqlScandalSearchSupplier;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Buy\Scandal\Application\Handler\HandlerScandalSearchPayment;
use Buy\Scandal\Domain\Service\ServiceScandalSearchPayment;
use Buy\Scandal\Infrastructure\Persistence\Mysql\MysqlScandalSearchPayment;
use Buy\Scandal\Application\Handler\HandlerScandalSearchPort;
use Buy\Scandal\Domain\Service\ServiceScandalSearchPort;
use Buy\Scandal\Infrastructure\Persistence\Mysql\MysqlScandalSearchPort;
use Buy\Scandal\Application\Handler\HandlerScandalSearchArticle;
use Buy\Scandal\Domain\Service\ServiceScandalSearchArticle;
use Buy\Scandal\Infrastructure\Persistence\Mysql\MysqlScandalSearchArticle;
class ScandalController
{
    public function index(): Response
    {
        $payment = (new HandlerScandalSearchPayment(new ServiceScandalSearchPayment(new MysqlScandalSearchPayment())))->handle();
        $port = (new HandlerScandalSearchPort(new ServiceScandalSearchPort(new MysqlScandalSearchPort())))->handle();
        $getClients = (new HandlerGetClients(new ServiceGetClients(new MysqlGetClients())))->handle();
        $container = (new HandlerScandalSearchContainer(new ServiceScandalSearchContainer(new MysqlScandalSearchContainer())))->handle();
        $scandalCounter = ( new HandlerScandalSearchScandalId(new ServiceScandalSearchScandalId(new MysqlScandalSearchScandalId())))->handle();
        return Inertia::render('Hmb/Buy/CreateScandal/Index',[
            'payment' => $payment,
            'port' => $port,
            'clients' => $getClients,
            'container' => $container,
            'scandalCounter' => $scandalCounter
        ]);
    }
    public function searchSupplier(Request $request)
    {
       $data = [
           'idSupplier' => $request->input('idSupplier'),
       ];
       return (new HandlerScandalSearchSupplier(new ServiceScandalSearchSupplier(new MysqlScandalSearchSupplier())))->handle($data);
    }
    public function searchArticle(Request $request)
    {
        $data = [
            'idArticle' => $request->input('idArticle'),
        ];
        return (new HandlerScandalSearchArticle(new ServiceScandalSearchArticle(new MysqlScandalSearchArticle())))->handle($data);
    }
}
