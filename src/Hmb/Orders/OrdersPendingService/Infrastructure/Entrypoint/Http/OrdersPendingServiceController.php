<?php

namespace Orders\OrdersPendingService\Infrastructure\Entrypoint\Http;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Orders\OrdersPendingService\Application\Handler\HandlerOrdersPendingService;
use Orders\OrdersPendingService\Domain\Service\ServiceOrdersPendingService;
use Orders\OrdersPendingService\Infrastructure\Persistence\Mysql\MysqlOrdersPendingService;
use Orders\OrdersPendingService\Application\Handler\HandlerGetDataOrdersPendingService;
use Orders\OrdersPendingService\Domain\Service\ServiceGetDataOrdersPending;

class OrdersPendingServiceController
{
    public function index(): Response
    {
        $ordersPendingService = (new HandlerOrdersPendingService(
            new ServiceOrdersPendingService(new MysqlOrdersPendingService())
        ))->handle();
        return Inertia::render('Hmb/Orders/OrdersPendingService/Index',['ordersPendingService' => $ordersPendingService]);
    }
    public function getData(Request $request)
    {
        $data = [
          'order' => $request->input('order')
        ];
        return (new HandlerGetDataOrdersPendingService(
            new ServiceGetDataOrdersPending(new MysqlOrdersPendingService())
        ))->handle($data);
    }
}
