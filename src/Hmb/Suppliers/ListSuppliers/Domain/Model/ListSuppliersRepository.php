<?php

namespace Suppliers\ListSuppliers\Domain\Model;

interface ListSuppliersRepository
{
    public function search(): mixed;
}
