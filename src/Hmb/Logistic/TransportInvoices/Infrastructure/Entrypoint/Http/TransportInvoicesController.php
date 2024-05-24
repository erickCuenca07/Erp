<?php

namespace Logistic\TransportInvoices\Infrastructure\Entrypoint\Http;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Logistic\TransportInvoices\Application\Handler\HandlerSearchTransportInvoices;
use Logistic\TransportInvoices\Domain\Service\ServiceTransportInvoices;
use Logistic\TransportInvoices\Infrastructure\Persistence\Mysql\MysqlSearchTransportInvoices;
class TransportInvoicesController
{

    public function index(): Response
    {
        return Inertia::render('Hmb/Logistic/TransportInvoices/Index');
    }
    public function searchTransportInvoices(Request $request)
    {
        $data = [
            'dateStart' => $request->input('dateStart'),
            'dateEnd' => $request->input('dateEnd')
        ];
        return (new HandlerSearchTransportInvoices(
            new ServiceTransportInvoices(new MysqlSearchTransportInvoices())
        ))->handle($data);
    }
}
