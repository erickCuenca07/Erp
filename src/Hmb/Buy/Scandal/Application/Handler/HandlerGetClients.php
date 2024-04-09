<?php

namespace Buy\Scandal\Application\Handler;

use Buy\Scandal\Domain\Service\ServiceGetClients;
class HandlerGetClients
{

    public function __construct(
        private readonly ServiceGetClients $service
    ){}

    public function handle(): mixed
    {
        return $this->service->execute();
    }
}
