<?php
namespace Products\ListProducts\Infrastructure\Entrypoint\Http;
use Inertia\Inertia;
use Inertia\Response;
use Products\ListProducts\Application\Handler\HandlerSearchListProducts;
use Products\ListProducts\Domain\Service\SearchListProductsService;
use Products\ListProducts\Infrastructure\Persistence\Mysql\MysqlListProducts;
class ListProductsController
{
    public function index(): Response
    {
        $listProducts = (new HandlerSearchListProducts(
            new SearchListProductsService(new MysqlListProducts())
        ))->handle();
        return Inertia::render('Hmb/Products/ListProducts/Index', ['listProducts' => $listProducts]);
    }
}
