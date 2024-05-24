<?php

namespace Buy\Scandal\Application\Handler;

use Buy\Scandal\Domain\Service\ServiceScandalSearchPayment;
class HandlerScandalSearchPayment
{

    public function __construct(
        private readonly ServiceScandalSearchPayment $service
    ){}
    public function handle(): mixed
    {
        return $this->service->execute();
    }
}
