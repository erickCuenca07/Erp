<?php

namespace Products\ListProducts\Application\Handler;
use Products\ListProducts\Domain\Service\ServiceSearchProduct;
class HandlerSearchProduct
{
    public function __construct(
        private readonly ServiceSearchProduct $service
    ){}
    public function handler($id): mixed
    {
        return $this->service->execute($id);
    }
}
