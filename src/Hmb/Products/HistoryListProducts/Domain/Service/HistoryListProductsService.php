<?php

namespace Products\HistoryListProducts\Domain\Service;

use Products\HistoryListProducts\Domain\Model\HistoryListProductsRepository;

class HistoryListProductsService
{
    public function __construct(
        private readonly HistoryListProductsRepository $repository
    ){}
    public function execute(): mixed
    {
        return $this->repository->search();
    }
}
