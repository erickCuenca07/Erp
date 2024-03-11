<?php

namespace Products\ListProducts\Infrastructure\Entrypoint\Http;

use Inertia\Inertia;
use Inertia\Response;
use Products\ListProducts\Application\Handler\HanlderListProducts;
use Products\ListProducts\Domain\Service\ListProductsService;
use Products\ListProducts\Infrastructure\Persistence\Mysql\MysqlListProducts;
class ListProductsController
{
    public function index(): Response
    {
        $listProducts = (new HanlderListProducts(
            new ListProductsService(new MysqlListProducts())
        ))->handler();
        return Inertia::render('Hmb/Products/ListProducts/Index',['listProducts' => $listProducts]);
    }
}
