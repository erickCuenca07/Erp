<?php

namespace Suppliers\ListSuppliers\Domain\Service;
use Suppliers\ListSuppliers\Domain\Model\ListSuppliersRepository;
class ListSupplierService
{
    public function __construct(
        private readonly ListSuppliersRepository $repository
    ){}
    public function execute(): mixed
    {
        return $this->repository->search();
    }
}
