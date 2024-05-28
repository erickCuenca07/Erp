<?php

namespace Products\UpdateArticleMassive\Infrastructure\Entrypoint\Http;

use Buy\CreateArticle\Application\Handler\HandlerGetBrand;
use Buy\CreateArticle\Application\Handler\HandlerGetGama;
use Buy\CreateArticle\Domain\Service\ServiceGetBrand;
use Buy\CreateArticle\Domain\Service\ServiceGetGama;
use Buy\CreateArticle\Infrastructure\Persistence\Mysql\MysqlGetBrand;
use Buy\CreateArticle\Infrastructure\Persistence\Mysql\MysqlGetGama;
use Families\ListFamilies\Application\Handler\HandlerListFamilies;
use Families\ListFamilies\Domain\Service\ListFamiliesService;
use Families\ListFamilies\Infrastructure\Persistence\Mysql\MysqlListFamilies;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Products\UpdateArticleMassive\Application\Handler\HandlerSearchPartidaArancelaria;
use Products\UpdateArticleMassive\Domain\Service\ServiceSearchPartidaArancelaria;
use Products\UpdateArticleMassive\Infrastructure\Persistence\Mysql\MysqlSearchPartidaArancelaria;
use Suppliers\ListSuppliers\Application\Handler\HandlerListSuppliers;
use Suppliers\ListSuppliers\Domain\Service\ListSupplierService;
use Suppliers\ListSuppliers\Infrastructure\Persistence\Mysql\MysqlListSuppliers;

class ControllerUpdateArticleMassive
{
    public function index(): Response
    {
        $tariffArancelaria = (new HandlerSearchPartidaArancelaria(new ServiceSearchPartidaArancelaria(new MysqlSearchPartidaArancelaria())))->handle();
        $getGama = ( new HandlerGetGama(new ServiceGetGama(new MysqlGetGama())))->handle();
        $getFamilies = (new HandlerListFamilies(new ListFamiliesService(new MysqlListFamilies())))->handle();
        $listSuppliers = (new HandlerListSuppliers(new ListSupplierService(new MysqlListSuppliers())))->handle();
        $getBrand = (new HandlerGetBrand(new ServiceGetBrand(new MysqlGetBrand())))->handle();
        return Inertia::render('Hmb/Products/UpdateArticleMassive/Index', [
            'tariffArancelaria' => $tariffArancelaria,
            'gama' => $getGama,
            'families' => $getFamilies,
            'suppliers' => $listSuppliers,
            'brand' => $getBrand
        ]);
    }
}
