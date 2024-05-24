<?php

namespace Products\ListProducts\Infrastructure\Entrypoint\Http;

use Buy\CreateArticle\Application\Handler\HandlerGetGama;
use Buy\CreateArticle\Application\Handler\HandlerGetRates;
use Buy\CreateArticle\Domain\Service\ServiceGetGama;
use Buy\CreateArticle\Domain\Service\ServiceGetRates;
use Buy\CreateArticle\Infrastructure\Persistence\Mysql\MysqlGetGama;
use Buy\CreateArticle\Infrastructure\Persistence\Mysql\MysqlGetRates;
use Families\ListFamilies\Application\Handler\HandlerListFamilies;
use Families\ListFamilies\Domain\Service\ListFamiliesService;
use Families\ListFamilies\Infrastructure\Persistence\Mysql\MysqlListFamilies;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Products\ListProducts\Application\Handler\HandlerSearchProduct;
use Products\ListProducts\Application\Handler\HanlderListProducts;
use Products\ListProducts\Domain\Service\ListProductsService;
use Products\ListProducts\Domain\Service\ServiceSearchProduct;
use Products\ListProducts\Infrastructure\Persistence\Mysql\MysqlListProducts;
use Products\ListProducts\Infrastructure\Persistence\Mysql\MysqlSearchProduct;

class ListProductsController
{
    public function index(): Response
    {
        $listProducts = (new HanlderListProducts(
            new ListProductsService(new MysqlListProducts())
        ))->handler();
        return Inertia::render('Hmb/Products/ListProducts/Index',['listProducts' => $listProducts]);
    }
    public function editProducts($id ): Response
    {
        $searchProduct = (new HandlerSearchProduct(new ServiceSearchProduct(new MysqlSearchProduct())))->handler($id);
        $getFamilies = (new HandlerListFamilies(new ListFamiliesService(new MysqlListFamilies())))->handle();
        $getRates = (new HandlerGetRates(new ServiceGetRates(new MysqlGetRates())))->handle();
        $getGama = ( new HandlerGetGama(new ServiceGetGama(new MysqlGetGama())))->handle();
        return Inertia::render('Hmb/Products/ListProducts/EditProducts',
            ['searchProduct' => $searchProduct,
                'families' => $getFamilies,
                'rates' => $getRates,
                'gama' => $getGama
            ]);
    }
}
