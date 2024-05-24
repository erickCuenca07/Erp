<?php
namespace Products\HistoryListProducts\Infrastructure\Entrypoint\Http;
use Inertia\Inertia;
use Inertia\Response;
use Products\HistoryListProducts\Application\Handler\HandlerHistoryListProducts;
use Products\HistoryListProducts\Domain\Service\HistoryListProductsService;
use Products\HistoryListProducts\Infrastructure\Persistence\Mysql\MysqlHistoryListProducts;
class HistoryListProductsController
{
    public function index(): Response
    {
        $listProducts = (new HandlerHistoryListProducts(
            new HistoryListProductsService(new MysqlHistoryListProducts())
        ))->handle();
        return Inertia::render('Hmb/Products/HistoryListProducts/Index', ['HistoryListProducts' => $listProducts]);
    }
}
