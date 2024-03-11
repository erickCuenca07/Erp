<?php

namespace Products\ListProducts\Domain\Service;

use Products\ListProducts\Domain\Model\ListProductsRepository;
class ListProductsService
{
    public function __construct(
        private readonly ListProductsRepository $repository
    ){}

    public function execute(): mixed
    {
        return $this->repository->search();
    }
}
