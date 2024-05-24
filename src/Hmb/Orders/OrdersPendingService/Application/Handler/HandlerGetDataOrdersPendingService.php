<?php

namespace Orders\OrdersPendingService\Application\Handler;

use Orders\OrdersPendingService\Domain\Service\ServiceGetDataOrdersPending;
class HandlerGetDataOrdersPendingService
{
    public function __construct(
        private readonly ServiceGetDataOrdersPending $service
    ){}
    public function handle($order): array
    {
        return $this->service->execute($order);
    }
}
