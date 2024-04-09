<?php

namespace Buy\Scandal\Application\Handler;

use Buy\Scandal\Domain\Service\ServiceScandalCreate;
class HandlerScandalCreate
{

    public function __construct(
        private readonly ServiceScandalCreate $service
    ){}

    public function handle(): mixed
    {
        return $this->service->execute();
    }
}
