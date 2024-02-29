<?php

namespace Products\ListProducts\Application\Handler;

use Products\ListProducts\Domain\Service\SearchListProductsService;
class HandlerSearchListProducts
{
    public function __construct(
        private readonly SearchListProductsService $service
    ){}
    public function handle(): mixed
    {
        return $this->service->execute();
    }
}
