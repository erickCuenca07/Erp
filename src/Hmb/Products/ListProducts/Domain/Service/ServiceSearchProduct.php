<?php

namespace Products\ListProducts\Domain\Service;

use Products\ListProducts\Domain\Model\RepositorySearchProduct;

class ServiceSearchProduct
{
    public function __construct(
        private readonly RepositorySearchProduct $repository
    ){}
    public function execute($id): mixed
    {
        return $this->repository->search($id);
    }
}
