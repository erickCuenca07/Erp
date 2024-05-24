<?php

namespace Products\ListProducts\Application\Handler;

use Products\ListProducts\Domain\Service\ListProductsService;
class HanlderListProducts
{

    public function __construct(
        private readonly ListProductsService $service
    ){}

    public function handler(): mixed
    {
        return $this->service->execute();
    }
}
