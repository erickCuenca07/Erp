<?php

namespace Orders\OrdersPendingService\Application\Handler;

use Orders\OrdersPendingService\Domain\Service\ServiceOrdersPendingService;
class HandlerOrdersPendingService
{
    public function __construct(
        private readonly ServiceOrdersPendingService $service
    ){}

    public function handle(): mixed
    {
        return $this->service->execute();
    }
}
