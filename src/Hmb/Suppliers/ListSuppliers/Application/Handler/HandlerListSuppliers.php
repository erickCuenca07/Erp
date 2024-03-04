<?php
namespace Suppliers\ListSuppliers\Application\Handler;
use Suppliers\ListSuppliers\Domain\Service\ListSupplierService;
class HandlerListSuppliers
{
    public function __construct(
        private readonly ListSupplierService $service
    ){}
    public function handle()
    {
        return $this->service->execute();
    }
}
