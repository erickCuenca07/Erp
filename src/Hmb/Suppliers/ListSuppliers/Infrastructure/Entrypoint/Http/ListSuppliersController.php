<?php
namespace Suppliers\ListSuppliers\Infrastructure\Entrypoint\Http;

use Inertia\Inertia;
use Inertia\Response;
use Suppliers\ListSuppliers\Application\Handler\HandlerListSuppliers;
use Suppliers\ListSuppliers\Domain\Service\ListSupplierService;
use Suppliers\ListSuppliers\Infrastructure\Persistence\Mysql\MysqlListSuppliers;
class ListSuppliersController
{
    public function index(): Response
    {
        $listSuppliers = (new HandlerListSuppliers(
            new ListSupplierService(new MysqlListSuppliers())
        ))->handle();
        return Inertia::render('Hmb/Suppliers/ListSuppliers/Index',[
            'listSuppliers' => $listSuppliers
        ]);
    }
}
