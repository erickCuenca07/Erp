<?php

namespace Products\HistoryListProducts\Application\Handler;

use Products\HistoryListProducts\Domain\Service\HistoryListProductsService;
class HandlerHistoryListProducts
{
    public function __construct(
        private readonly HistoryListProductsService $service
    ){}
    public function handle(): mixed
    {
        return $this->service->execute();
    }
}
