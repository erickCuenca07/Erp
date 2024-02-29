<?php

namespace Products\ListProducts\Domain\Service;

use Products\ListProducts\Domain\Model\SearchListProductsRepository;

class SearchListProductsService
{
    public function __construct(
        private readonly SearchListProductsRepository $repository
    ){}
    public function execute(): mixed
    {
        return $this->repository->search();
    }
}
