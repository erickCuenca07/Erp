<?php

namespace Suppliers\ListCreditors\Application\Handler;

use Suppliers\ListCreditors\Domain\Service\ListCreditorsService;
class HandlerListCreditors
{

    public function __construct(
        private readonly ListCreditorsService $service
    ) {}

    public function handle(): mixed
    {
        return $this->service->execute();
    }
}
